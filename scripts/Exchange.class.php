<?php
/*------------------------------------------------------------*/
// to be called from cron
// send several requests over the next minute or so
/*------------------------------------------------------------*/
class Exchange extends Mcontroller {
	/*------------------------------------------------------------*/
	private $interactive;
	private $qps; // when not interactive
	/*------------------------------------------------------------*/
	private $bidderUtils;
	private $logger;
	private $mCurl;
	/*------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
		$topDir = dirname(__DIR__);
		$logsDir = "$topDir/logs/exchange";
		$today = date("Y-m-d");
		$logFileName = "exchange.$today.log";
		$logFile = "$logsDir/$logFileName";
		$this->mCurl = new Mcurl;
		$this->logger = new Logger($logFile);
		$this->bidderUtils = new BidderUtils($logFile);
		$this->qps = 0.9;
	}
	/*------------------------------------------------------------*/
	public function run($argv) {
		$this->parseArgs($argv);
		if ( $this->interactive ) {
			$this->interactive();
			return;
		}
		// a once a minute single cron run:
		$microSecondsInAminute = 60 * 1000 * 1000;
		$numRequests = $this->qps * 60;
		$numRequests = round($numRequests * rand(50, 150)/100);
		for ($i=0;$i<$numRequests;$i++) {
			$usleepTime = round(
					(rand(30, 200)/100.0) *
					( $microSecondsInAminute / $numRequests )
				);
			usleep($usleepTime);
			$this->go();
		}
	}
	/*------------------------------------------------------------*/
	private function parseArgs($argv) {
		if ( count($argv) == 1 )
			return;
		// interactive
		array_shift($argv);
		$this->interactive = true;
	}
	/*------------------------------------------------------------*/
	private function interactive() {
		while ( true ) {
			usleep(500*1000);
			$done = $this->go();
			if ( $done )
				break;
		}
	}
	/*------------------------------------------------------------*/
	// the funnel is made up to be 10% reduction in each stage
	// to easily test the numbers
	private function go() {
		if ( ($bid = $this->sendRequest()) == null )
			return(false);
		if ( rand(1, 100) < 10 ) 
			return(true);
		if ( ! $this->sendWin($bid) )
			return(false);
		if ( rand(1, 100) < 10 ) 
			return(true);
		$this->sendView($bid);
		if ( rand(1, 100) < 30 ) 
			return(true);
		$this->sendClick($bid);
		if ( rand(1, 100) < 40 ) 
			return(true);
		$this->sendCpa($bid);
		return(true);
	}
	/*------------------------------------------------------------*/
	private function sendWin($bid) {
		$bid0 = @$bid['seatbid'][0]['bid'];
		$nurl = @$bid0['nurl'];
		if ( ! $nurl ) {
			$this->error("sendWin: no nurl in bid");
			return(false);
		}

		$bidPrice = $bid0['price'];
		$cost = $bidPrice * rand(85, 100) / 100;
		$url = str_replace('${AUCTION_PRICE}', $cost, $nurl);
		$httpCode = $this->mCurl->getHttpCode($url);
		$this->log("sendWin: $url: $httpCode", 1);
		return(true);
	}
	/*------------------------------------------------------------*/
	private function sendView($bid) {
		$bidId = @$bid['seatbid'][0]['bid']['id'];
		$viewServer = VIEW_SERVER;
		$viewUrl = "http://$viewServer/view?bidId=$bidId";
		$httpCode = $this->mCurl->getHttpCode($viewUrl);
		$this->log("sendView: $viewUrl: $httpCode", 1);
		return(true);
	}
	/*------------------------------------------------------------*/
	// Thu Jul 30 21:57:03 IDT 2020
	// this returns with a redirtect to the landing page of the campaign
	// which is here ignored
	private function sendClick($bid) {
		$bidId = @$bid['seatbid'][0]['bid']['id'];
		$clickServer = CLICK_SERVER;
		$clickUrl = "http://$clickServer/click?bidId=$bidId";
		$httpCode = $this->mCurl->getHttpCode($clickUrl);
		$this->log("sendClick: $clickUrl: $httpCode", 1);
		return(true);
	}
	/*------------------------------------------------------------*/
	private function sendCpa($bid) {
		$bid0 = $bid['seatbid'][0]['bid'];
		$bidId = $bid0['id'];
		$price = $bid0['price'];
		$cpaServer = CPA_SERVER;
		$cpa = ($price/1000.0) * (rand(300, 800)/100.0)  ; // in dollars - price is in pm - $$*1000
		$cpaUrl = "http://$cpaServer/cpa?bidId=$bidId&cpa=$cpa";
		$httpCode = $this->mCurl->getHttpCode($cpaUrl);
		$this->log("sendCpa: $cpaUrl: $httpCode", 1);
		return(true);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function sendRequest() {
		$topDir = dirname(__DIR__);
		$samplePath = "$topDir/docs/request.json";
		$contents = file_get_contents($samplePath);
		$bidRequest = json_decode($contents, true);
		$this->massage($bidRequest);


		$vhosts = $this->bidderUtils->exchangeVhosts();
		$key = array_rand($vhosts);
		$vhost = $vhosts[$key];
		$url = "http://$vhost.bidder.theora.com";
		$bid = $this->mCurl->post($url, $bidRequest);
		$httpCode = $this->mCurl->lastHttpCode();

		if ( $httpCode === false ) {
			$this->error("sendRequest: false httpCode: $url");
			return(null);
		} elseif ( $httpCode == 204 ) {
			$this->log("sendRequest:  204: $url", 1);
			return(null);
		} else {
			$this->log("sendRequest: 200: $url", 2);
			$pr = print_r($bid, true);
			$this->log($pr, 2);
			return($bid);
		}
	}
	/*------------------------------*/
	private function massage(&$bidRequest) {
		$sql = "select * from exchangeTraffic order by strength desc";
		$rows = $this->Mmodel->getRows($sql, 300);
		$totalStrength = Mutils::arraySum($rows, "strength");
		$randStrength = rand(0, $totalStrength - 1 );
		$strength = 0;
		$randKey = null;
		foreach ( $rows as $key => $row ) {
			$strength += $row['strength'];
			if ( $strength >= $randStrength ) {
				$randKey = $key;
				break;
			}
		}
		$sample = $rows[$randKey];
		$banner = $bidRequest['imp'][0]['banner'];
		$bidRequest['imp'][0]['banner']['w'] = $sample['w'];
		$bidRequest['imp'][0]['banner']['h'] = $sample['h'];
		$bidRequest['device']['geo']['country'] = $sample['geo'];
		$thisYear = date("Y");
		$bidRequest['user']['yob'] = $thisYear - rand(9, 45);
		$rnd = rand(1, 100);
		$bidRequest['user']['gender'] = $rnd < 20 ? "F" : ( $rnd < 40 ? "M" : ( $rnd < 45 ? "O" : null ) ) ;

		// app names I made up, so not really as it appears in a bid request
		$apps = array(
			'facebook' => 100,
			'instagram' => 100,
			'skype' => 100,
			'Subway Surfers' => 60,
			'Twitter' => 60,
			'SHAREit' => 40,
			'facebook Light' => 40,
			'line' => 30,
			'Viber' => 30,
			'Flipboard' => 20,
			'My Talking Tom' => 10,
		);
		$sum = array_sum(array_values($apps));
		$rnd = rand(1, $sum);
		$n = 0;
		foreach ( $apps as $appName => $weight ) {
			$n += $weight;
			if ( $rnd < $n ) {
				$app = $appName;
				break;
			}
			
		}
		$bidRequest['app']['name'] = $app;
		$words = explode(" ", $app);
		$lastWord = end($words);
		$domain = "$lastWord.com";
		$bidRequest['app']['domain'] = $domain;


		$bidRequest['id'] = $this->newBidRequestId();
	}
	/*------------------------------------------------------------*/
	private function newBidRequestId() {
		$microtime = microtime(true);
		$rand = rand(1, 1000000);
		$str = $rand.$microtime;
		$newBidRequestId = sha1($str);
		return($newBidRequestId);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function error($msg, $r = 100) {
		$this->log("ERROR: $msg", $r);
	}
	/*------------------------------------------------------------*/
	private function log($msg, $r = 100) {
		if ( $this->interactive )
			$r = 100;
		if ( rand(1, 100 * 1000) > $r * 1000 )
			return;
		$now = date("Y-m-d G:i:s");
		if ( $r == 100 )
			$str = "$now: $msg";
		else
			$str = "$now: $r/100: $msg";
		echo "$str\n";
		$this->logger->log($str, false);
	}
	/*------------------------------------------------------------*/
}

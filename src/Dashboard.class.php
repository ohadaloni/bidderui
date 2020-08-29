<?php
/*------------------------------------------------------------*/
class Dashboard extends BidderUI {
	/*------------------------------------------------------------*/
	private $campaignId;
	private $campaign;
	/*------------------------------------------------------------*/
	protected function before() {
		parent::before();
		$this->campaignId = @$_REQUEST['campaignId'];
		if ( $this->campaignId )
			$this->campaign = $this->bidderUtils->campaign($this->campaignId, false);
		$bannerServer = BANNER_SERVER;
		$bannerUrl = "http://$bannerServer/banners";
		$this->Mview->assign('bannerUrl', $bannerUrl);
	}
	/*------------------------------------------------------------*/
	public function index() {
		$this->controlPanel();
		$this->br(2);
		$this->ticker();
		$this->br(3);
		$this->board();
	}
	/*------------------------------------------------------------*/
	private function controlPanel() {
		if ( $this->campaignId ) {
			$this->Mview->showTpl("campaigns/controlPanel.tpl", array(
				'campaign' => $this->campaign,
			));
			$blackLists = $this->bidderUIUtils->blackListsOf($this->campaignId);
			$this->Mview->showTpl("blackLists/selectBlackLists.tpl", array(
				'campaignId' => $this->campaignId,
				'blackLists' => $blackLists,
			));
			$whiteLists = $this->bidderUIUtils->whiteListsOf($this->campaignId);
			$this->Mview->showTpl("whiteLists/selectWhiteLists.tpl", array(
				'campaignId' => $this->campaignId,
				'whiteLists' => $whiteLists,
			));
		} else {
			$this->Mview->msg("Control Panel");
			$controlPanel = $this->bidderUtils->controlPanel(true);
			$this->Mview->showTpl("dashboard/controlPanel.tpl", array(
				'controlPanel' => $controlPanel,
			));
			$blackLists = $this->bidderUIUtils->blackListsOf(0);
			$this->Mview->showTpl("blackLists/selectBlackLists.tpl", array(
				'campaignId' => 0,
				'blackLists' => $blackLists,
			));
		}
	}
	/*------------------------------------------------------------*/
	private function campaignTicker() {
		$lastCampaignBid = $this->memUtils->lastCampaignBid($this->campaignId);
		$bidDescription = $this->bidderUtils->bidDescription($lastCampaignBid);
		$this->Mview->msg("Last Bid: $bidDescription");
	}
	/*------------------------------*/
	private function ticker() {
		if ( $this->campaignId ) {
			$this->campaignTicker();
			return;
		}
		$mkey = $this->keyNames->bidderCounter("bidRequests", "thisMinute");
		$cnt = $this->Mmemcache->rawGet($mkey);
		$elapsed = date("s");
		if ( $elapsed == 0 )
			$qps = $cnt;
		else
			$qps = $cnt / $elapsed ;

		$qps = round($qps, 3);

		$lastBid = $this->memUtils->lastBid();
		/*	Mview::print_r($lastBid, "lastBid", basename(__FILE__), __LINE__, null, false);	*/
		$bidDescription = $this->bidderUtils->bidDescription($lastBid);

		$lastRequest = $this->memUtils->lastRequest();
		$requestDescription = $this->bidderUtils->requestDescription($lastRequest);

		$placementIdsQname = $this->keyNames->placementIdsQname();
		$placementIdsQlength = $this->Mmemcache->msgQlength($placementIdsQname);

		$winQname = $this->keyNames->winQname();
		$winQlength = $this->Mmemcache->msgQlength($winQname);

		$revenueQname = $this->keyNames->revenueQname();
		$revenueQlength = $this->Mmemcache->msgQlength($revenueQname);

		$memcachedHealth = $this->memcachedHealth();
		$msgs = array(
			"QPS this minute: $qps",
			"Last Bid: $bidDescription",
			"Last Request: $requestDescription",
			"\ntech stuff:",
			"memcached: $memcachedHealth",
			"placementIds Q length:  $placementIdsQlength",
			"wins Q length:  $winQlength",
			"revenue Q length:  $revenueQlength",
		);
		$msgs = implode("\n", $msgs);
		$this->Mview->msg($msgs);
	}
	/*------------------------------------------------------------*/
	private function memcachedHealth() {
			$randKey = "randKey-".rand(1,100000);
			$randValue = rand(1,100000);
			$setRet = $this->Mmemcache->set($randKey, $randValue, 5);
			if ( ! $setRet  )
					return("unable to set");
			$get = $this->Mmemcache->get($randKey);
			if ( $get == $randValue )
					return("healthy");
			else
					return("failed to get after successful set");
	}
	/*------------------------------------------------------------*/
	private function board() {
		$timeSlots = $this->bidderUtils->timeSlots();
		$cntMetrics = $this->bidderUtils->cntMetrics($this->campaignId == null);
		$rateMetrics = $this->bidderUtils->rateMetrics($this->campaignId == null);
		$board = array();
		$floatMetrics = $this->bidderUtils->floatMetrics();
		foreach ( $cntMetrics as $cntMetric ) {
			$board[$cntMetric] = array();
			foreach ( $timeSlots as $timeSlot ) {
				if ( $this->campaignId )
					$mkey = $this->keyNames->campaignCounter($cntMetric, $timeSlot, $this->campaignId);
				else
					$mkey = $this->keyNames->bidderCounter($cntMetric, $timeSlot);
				$value = $this->Mmemcache->rawGet($mkey);
				if ( $timeSlot == 'thisMinute' ) {
					if ( in_array($cntMetric, $floatMetrics) )
						$board[$cntMetric]['thisMinute'] = $this->memUtils->memInt2double($value);
					else
						$board[$cntMetric]['thisMinute'] = $value;
				} else {
					$board[$cntMetric][$timeSlot] =
						$value +
						$board[$cntMetric]['thisMinute'];
				}
			}
		}
		foreach ( $rateMetrics as $rateMetric )
			$board[$rateMetric] = array();
		$board['profit'] = array();
		$board['ppm'] = array();
		foreach ( $timeSlots as $timeSlot ) {
			$board['profit'][$timeSlot] = $board['revenue'][$timeSlot] - $board['cost'][$timeSlot];
			if ( ! $this->campaignId ) {
				$board['bidRate'][$timeSlot] = $this->bidderUtils->bidRate(
					$board['bids'][$timeSlot], 
					$board['bidRequests'][$timeSlot]
				);
			}
			$board['winRate'][$timeSlot] = $this->bidderUtils->winRate(
				$board['wins'][$timeSlot], 
				$board['bids'][$timeSlot]
			);
			$board['cpm'][$timeSlot] = $this->bidderUtils->cpm(
				$board['cost'][$timeSlot], 
				$board['wins'][$timeSlot]
			);
			$board['viewRate'][$timeSlot] = $this->bidderUtils->viewRate(
				$board['views'][$timeSlot], 
				$board['wins'][$timeSlot]
			);
			$board['cpv'][$timeSlot] = $this->bidderUtils->cpv(
				$board['cost'][$timeSlot], 
				$board['views'][$timeSlot]
			);
			$board['clickRate'][$timeSlot] = $this->bidderUtils->clickRate(
				$board['clicks'][$timeSlot], 
				$board['wins'][$timeSlot]
			);
			$board['cpc'][$timeSlot] = $this->bidderUtils->cpc(
				$board['cost'][$timeSlot], 
				$board['clicks'][$timeSlot]
			);
			$board['rpm'][$timeSlot] = $this->bidderUtils->rpm(
				$board['revenue'][$timeSlot], 
				$board['wins'][$timeSlot]
			);
			$board['ppm'][$timeSlot] = $this->bidderUtils->ppm(
				$board['profit'][$timeSlot], 
				$board['wins'][$timeSlot]
			);
		}
		if ( $this->campaign )
			$this->Mview->msg("{$this->campaign['name']}: Dashboard");
		else
			$this->Mview->msg("Dashboard");
		$this->Mview->showTpl("dashboard/board.tpl", array(
			'campaign' => $this->campaign,
			'datetime' => date("Y-m-d H:i:s"),
			'timeSlots' => $timeSlots,
			'board' => $board,
		));
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}

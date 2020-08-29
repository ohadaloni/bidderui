<?php
/*------------------------------------------------------------*/
class Publisher extends BidderUI {
	/*------------------------------------------------------------*/
	private $forceCampaignId = 1;
	/*------------------------------------------------------------*/
	public function index() {
		$this->roundTrip();
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function roundTrip() {
		$bid = $this->sendRequest();
		if ( ! $bid )
			return;
		$adm = @$bid['seatbid'][0]['bid']['adm'];
		if ( ! $adm ) {
			$this->Mview->error("roundTrip: no adm in bid");
			return;
		}
		$this->Mview->pushOutput("<hr>$adm<hr>\n");
		/*	...	*/
		$pr = print_r($bid, true);
		$html = htmlspecialchars($pr);
		$html = nl2br($html);
		$this->Mview->pushOutput("<pre>$html</pre>\n");
	}
	/*------------------------------------------------------------*/
	private function sendRequest() {
		$vhosts = $this->bidderUtils->exchangeVhosts();
		$key = array_rand($vhosts);
		$vhost = $vhosts[$key];
		$forceCampaignId = $this->forceCampaignId;
		$url = "http://$vhost.bidder.theora.com?forceCampaignId=$forceCampaignId";
		$this->Mview->msg("sendRequest: $url");

		$mCurl = new Mcurl;

		$rnd = rand(10000, 99999);
		$id = "forceCampaignId:$rnd";
		$bidRequest = array(
			'id' => $id,
			'imp'  => array(
				array(
					'id' => 1,
					'banner' => array(
						'w' => 377,
						'h' => 133,
					),
				),
			),
			'device'  => array(
				'geo' => array(
					'country' => "ISR",
				),
			),
		);
		$bid = $mCurl->post($url, $bidRequest);
		$httpCode = $mCurl->lastHttpCode();


		if ( $httpCode === false ) {
			$this->Mview->error("sendRequest: false httpCode");
			return(null);
		} elseif ( $httpCode == 204 ) {
			$this->Mview->error("sendRequest:  204", 1);
			return(null);
		} else {
			return($bid);
		}
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}

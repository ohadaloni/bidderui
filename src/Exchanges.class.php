<?php
/*------------------------------------------------------------*/
class Exchanges extends BidderUI {
	/*------------------------------------------------------------*/
	protected function before() {
		parent::before();
		$this->Mview->assign(array(
			'genders' => $this->bidderUtils->genders(),
			'kinds' => $this->bidderUtils->kinds(),
			'countries' => $this->bidderUtils->countries(),
			'ageGroups' => $this->bidderUtils->ageGroups(),
		));
	}
	/*------------------------------------------------------------*/
	public function index() {
		$this->dashboard();
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	// summary always shows the last hour activity
	// for all metrics
	/*------------------------------*/
	public function dashboard() {
		$this->Mview->msg("Exchanges This Hour Summary:");
		$dbExchanges = $this->bidderUtils->exchanges();
		foreach ( $dbExchanges as $key => $dbExchange ) {
			$exchanges[] = $this->exchangeSummary($dbExchange);
		}
		$this->Mview->showTpl("exchanges/lastHourSummary.tpl", array(
			'hour' => date("Y-m-d G"),
			'exchanges' => $exchanges,
		));
	}
	/*------------------------------*/
	private function exchangeSummary($dbExchange) {
		$exchange = array();
		$cntMetrics = $this->bidderUtils->cntMetrics();
		$rateMetrics = $this->bidderUtils->rateMetrics();
		$floatMetrics = $this->bidderUtils->floatMetrics();

		$exchangeId = $dbExchange['id'];
		$exchange['name'] = $dbExchange['name'];
		$exchange['id'] = $dbExchange['id'];
		foreach ( $cntMetrics as $cntMetric ) {
			$mkey = $this->keyNames->exchangeCounter($cntMetric, "thisHour", $exchangeId);
			$value = $this->Mmemcache->rawGet($mkey);
			$exchange[$cntMetric] = $value;
		}
		foreach ( $rateMetrics as $rateMetric )
			$exchange[$rateMetric] = 0;
		$exchange['profit'] = 0;
		$exchange['ppm'] = 0;

		$exchange['profit'] = $exchange['revenue'] - $exchange['cost'];
		$exchange['bidRate'] = $this->bidderUtils->bidRate(
			$exchange['bids'], 
			$exchange['bidRequests']
		);
		$exchange['winRate'] = $this->bidderUtils->winRate(
			$exchange['wins'], 
			$exchange['bids']
		);
		$exchange['cpm'] = $this->bidderUtils->cpm(
			$exchange['cost'], 
			$exchange['wins']
		);
		$exchange['viewRate'] = $this->bidderUtils->viewRate(
			$exchange['views'], 
			$exchange['wins']
		);
		$exchange['cpv'] = $this->bidderUtils->cpv(
			$exchange['cost'], 
			$exchange['views']
		);
		$exchange['clickRate'] = $this->bidderUtils->clickRate(
			$exchange['clicks'], 
			$exchange['wins']
		);
		$exchange['cpc'] = $this->bidderUtils->cpc(
			$exchange['cost'], 
			$exchange['clicks']
		);
		$exchange['rpm'] = $this->bidderUtils->rpm(
			$exchange['revenue'], 
			$exchange['wins']
		);
		$exchange['ppm'] = $this->bidderUtils->ppm(
			$exchange['profit'], 
			$exchange['wins']
		);
		return($exchange);
	}
	/*------------------------------------------------------------*/
	public function showTraffic() {
		$sql = "select * from exchangeTraffic order by strength desc, kind, w, h, geo";
		$rows = $this->Mmodel->getRows($sql);
		$this->Mview->showTpl("exchanges/showTraffic.tpl", array(
			'rows' => $rows,
		));
	}
	/*------------------------------------------------------------*/
	public function newTraffic() {
		$this->Mview->showTpl("exchanges/newTraffic.tpl");
	}
	/*------------------------------*/
	public function insertTraffic() {
		$this->dbInsert("exchangeTraffic", $_REQUEST);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function editTraffic() {
		$id = $_REQUEST['id'];
		$row = $this->Mmodel->getById("exchangeTraffic", $id);
		$this->Mview->showTpl("exchanges/editTraffic.tpl", array(
			'row' => $row,
		));
	}
	/*------------------------------*/
	public function updateTraffic() {
		$this->dbUpdate("exchangeTraffic", @$_REQUEST['id'], $_REQUEST);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function dupTraffic() {
		$id = $_REQUEST['id'];
		$srcRow = $this->Mmodel->getById("exchangeTraffic", $id);
		$this->dbInsert("exchangeTraffic", $srcRow);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function deleteTraffic() {
		$id = $_REQUEST['id'];
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->dbDelete("exchangeTraffic", $id);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function redir() {
		$this->redirect("/exchanges");
	}
	/*------------------------------------------------------------*/
}
/*------------------------------------------------------------*/

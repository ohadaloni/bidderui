<?php
/*------------------------------------------------------------*/
class BidderUIUtils extends Mcontroller {
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();

		$this->bidderUtils = new BidderUtils($this->logFile());
	}
	/*------------------------------------------------------------*/
	public function logFile() {
		$topDir = dirname(__DIR__);
		$logsDir = "$topDir/logs/bidderUI";
		$today = date("Y-m-d");
		$logFileName = "bidderUI.$today.log";
		$logFile = "$logsDir/$logFileName";
		return($logFile);
	}
	/*------------------------------------------------------------*/
	public function prior($controller, $action, $loginName, $loginType, $loginId) {
		$loginName = $loginName;
		$loginType = $loginType;
		$loginId = $loginId;
		$this->Mview->assign(array(
			'controller' => $controller,
			'action' => $action,
			'loginName' => $loginName,
			'loginType' => $loginType,
			'loginId' => $loginId,
		));
		$this->registerFilters();
	}
	/*------------------------------*/
	private function registerFilters() {
		$this->Mview->register_modifier("numberFormat", array("Mutils", "numberFormat",));
		$this->Mview->register_modifier("terse", array("Mutils", "terse",));
		$this->Mview->register_modifier("weekday", array("BidderUIUtils", "weekday",));
		$this->Mview->register_modifier("timeUnit", array("BidderUIUtils", "timeUnit",));
		$this->Mview->register_modifier("exchangeName", array($this, "exchangeName",));
		$this->Mview->register_modifier("campaignName", array($this, "campaignName",));
		$this->Mview->register_modifier("monthlname", array("Mdate", "monthlname",));
	}
	/*------------------------------------------------------------*/
	public function exchangeName($exchangeId) {
		$exchangeName = $this->bidderUtils->exchangeName($exchangeId);
		return($exchangeName);
	}
	/*------------------------------------------------------------*/
	public function campaignName($campaignId) {
		$campaignName = $this->bidderUtils->campaignName($campaignId);
		return($campaignName);
	}
	/*------------------------------------------------------------*/
	public static function timeUnit($timeSlot) {
		$timeUnits = array(
			'thisMinute' => 'minute',
			'thisHour' => 'hour',
			'today' => 'day',
			'thisMonth' => 'month',
			'thisYear' => 'year',
			'allTime' => 'allTime',
		);
		return($timeUnits[$timeSlot]);

	}
	/*------------------------------------------------------------*/
	public function ammendRows(&$rows) {
		foreach ( $rows as $key => $row )
			$this->ammendRow($rows[$key]);
	}
	/*------------------------------*/
	public function ammendRow(&$row) {
		$row['winRate'] = $this->bidderUtils->winRate($row['wins'], $row['bids']);
		$row['cpm'] = $this->bidderUtils->cpm($row['cost'], $row['wins']);
		$row['viewRate'] = $this->bidderUtils->viewRate($row['views'], $row['wins']);
		$row['cpv'] = $this->bidderUtils->cpv($row['cost'], $row['views']);
		$row['clickRate'] = $this->bidderUtils->clickRate($row['clicks'], $row['wins']);
		$row['cpc'] = $this->bidderUtils->cpc($row['cost'], $row['clicks']);
		$row['rpm'] = $this->bidderUtils->rpm($row['revenue'], $row['wins']);
		$row['profit'] = $row['revenue'] - $row['cost'];
		$row['ppm'] = $this->bidderUtils->ppm($row['profit'], $row['wins']);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function whiteListsOf($campaignId) {
		$sql = "select * from whiteLists order by name";
		$whiteLists = $this->Mmodel->getRows($sql);
		$sql = "select whiteListId from campaignWhiteLists where campaignId = $campaignId";
		$whiteListIds = $this->Mmodel->getStrings($sql);
		if ( $whiteListIds ) {
			foreach ( $whiteLists as $key => $whiteList )
				if ( in_array($whiteList['id'], $whiteListIds) )
					$whiteLists[$key]['on'] = true;
		}
		return($whiteLists);
	}
	/*------------------------------------------------------------*/
	public function blackListsOf($campaignId) {
		$sql = "select * from blackLists order by name";
		$blackLists = $this->Mmodel->getRows($sql);
		$sql = "select blackListId from campaignBlackLists where campaignId = $campaignId";
		$blackListIds = $this->Mmodel->getStrings($sql);
		if ( $blackListIds ) {
			foreach ( $blackLists as $key => $blackList )
				if ( in_array($blackList['id'], $blackListIds) )
					$blackLists[$key]['on'] = true;
		}
		return($blackLists);
	}
	/*------------------------------------------------------------*/
}

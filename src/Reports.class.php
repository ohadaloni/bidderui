<?php
/*------------------------------------------------------------*/
class Reports extends BidderUI {
	/*------------------------------------------------------------*/
	private $ttl = 3600;
	/*------------------------------------------------------------*/
	public function index() {
		$this->drill();
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function drill() {
		$entity = $_REQUEST['entity'];
		$timeUnit = $_REQUEST['timeUnit'];
		$time = @$_REQUEST['time'];
		if ( ! $entity || ! $timeUnit || ( $timeUnit != 'allTime' && ! $time ) ) {
			$this->Mview->error("entity=bidder|campaign|exchange|placement, timeUnit=allTime,year,month,day,hour,minute time=...");
			return;
		}
		$this->title();
		if ( $timeUnit == 'minute' ) {
			$this->minute();
			return;
		}
		$tname = $this->drillTname($entity, $timeUnit);
		$entityCond = $this->entityCond($entity);
		$timeConds = $this->timeConds($timeUnit, $time);
		$orderBy = $this->orderBy($timeUnit);
		$sql = "select * from $tname where $entityCond and $timeConds $orderBy";
		$rows = $this->Mmodel->getRows($sql, $this->ttl);
		$this->bidderUIUtils->ammendRows($rows);
		$drillUpTime = $this->drillUpTime($timeUnit, $time);
		$tplArgs = array(
			'entity' => $entity,
			'time' => $time,
			'rows' => $rows,
			'drillUpTime' => $drillUpTime,
			'campaignId' => @$_REQUEST['campaignId'],
			'placementId' => @$_REQUEST['placementId'],
			'exchangeId' => @$_REQUEST['exchangeId'],
		);
		$this->Mview->showTpl("reports/$timeUnit.tpl", $tplArgs);
	}
	/*------------------------------------------------------------*/
	private function minute() {
		$entity = $_REQUEST['entity'];
		$time = $_REQUEST['time'];
		$timeConds = $this->timeConds('minute', $time);
		$entityCond = $this->entityCond($entity);
		$sql = "select * from wins where $timeConds and $entityCond order by id";
		$rows = $this->Mmodel->getRows($sql);
		$sql = "select * from revenue where $timeConds and $entityCond";
		$revenue = $this->Mmodel->getRows($sql);
		$revenue = Mutils::reIndexBy($revenue, "bidId");
		foreach ( $rows as $key => $row )
			$rows[$key]['revenue'] = @$revenue[$row['bidId']]['revenue'];
		$drillUpTime = $this->drillUpTime("minute", $time);
		$tplArgs = array(
			'entity' => $entity,
			'time' => $time,
			'rows' => $rows,
			'drillUpTime' => $drillUpTime,
			'campaignId' => @$_REQUEST['campaignId'],
			'placementId' => @$_REQUEST['placementId'],
			'exchangeId' => @$_REQUEST['exchangeId'],
		);
		$this->Mview->showTpl("reports/minute.tpl", $tplArgs);
	}
	/*------------------------------------------------------------*/
	private function title() {
		$entity = $_REQUEST['entity'];
		$timeUnit = $_REQUEST['timeUnit'];
		$time = @$_REQUEST['time'];
		$timeDescription = $this->timeDescription($timeUnit, $time);
		switch ( $entity ) {
			case 'bidder':
					$title = "bidder: $timeDescription";
				break;
			case 'campaign':
					$campaignId = $_REQUEST['campaignId'];
					$campaignName = $this->bidderUtils->campaignName($campaignId);
					$title = "campaign: $campaignName: $timeDescription";
				break;
			case 'exchange':
					$exchangeId = $_REQUEST['exchangeId'];
					$exchangeName = $this->bidderUtils->exchangeName($exchangeId);
					$title = "exchange: $exchangeName: $timeDescription";
				break;
			case 'placement':
					$placementId = $_REQUEST['placementId'];
					$title = "placement: $placementId: $timeDescription";
				break;
		}
		$this->Mview->msg("Report: $title");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function entityCond($entity) {
		switch($entity) {
			case 'bidder':
					$entityCond = "true";
				break;
			case 'campaign':
					$campaignId = $_REQUEST['campaignId'];
					$entityCond = "campaignId = $campaignId";
				break;
			case 'exchange':
					$exchangeId = $_REQUEST['exchangeId'];
					$entityCond = "exchangeId = $exchangeId";
				break;
			case 'placement':
					$placementId = $_REQUEST['placementId'];
					$entityCond = "placementId = '$placementId'";
				break;
		}
		return($entityCond);
	}
	/*------------------------------------------------------------*/
	private function drillUpTime($timeUnit, $time) {
		switch($timeUnit) {
			case 'allTime':
					return(null); // no drill up
				break;
			case 'year':
					return(null); // allTime - so no time value
				break;
			case 'month':
					if ( $time == 'now' )
						$time = date("Y-m");
					return(substr($time, 0, 4));
				break;
			case 'day':
					if ( $time == 'now' )
						$time = date("Y-m-d");
					return(substr($time, 0, 7));
				break;
			case 'hour':
					if ( $time == 'now' )
						$time = date("Y-m-d-H");
					return(substr($time, 0, 10));
				break;
			case 'minute':
					if ( $time == 'now' )
						$time = date("Y-m-d-H:i");
					return(substr($time, 0, 13));
				break;
		}
		// notReached
		return(null);
	}
	/*------------------------------------------------------------*/
	private function orderBy($timeUnit) {
		switch($timeUnit) {
			case 'allTime':
					$orderBy = "year";
				break;
			case 'year':
					$orderBy = "month";
				break;
			case 'month':
					$orderBy = "date";
				break;
			case 'day':
					$orderBy = "date, hour";
				break;
			case 'hour':
					$orderBy = "date, hour, minute";
				break;
			case 'minute':
					// Tue May 19 14:11:11 IDT 2020
					// from wins & revenue
					$orderBy = "date, hour, datetime"; 
				break;
		}
		return("order by $orderBy");
	}
	/*------------------------------------------------------------*/
	private function timeDescription($timeUnit, $time) {
		switch($timeUnit) {
			case 'allTime':
					$timeDescription = "allTime";
				break;
			case 'year':
					$timeDescription = $time == 'now' ? date("Y") : $time ;
				break;
			case 'month':
					$timeDescription = $time == 'now' ? date("Y-m") : $time ;
				break;
			case 'day':
					$timeDescription = $time == 'now' ? date("Y-m-d") : $time;
				break;
			case 'hour':
					if ( $time == 'now' ) {
						$timeDescription = date("Y-m-d G");
					} else {
						$parts = explode("-", $time);
						$year = $parts[0];
						$month = $parts[1];
						$day = $parts[2];
						$hour = (int)$parts[3];
						$date = "$year-$month-$day";
						$timeDescription = "$date $hour";
					}
				break;
			case 'minute':
					if ( $time == 'now' ) {
						$timeDescription = date("Y-m-d G:i");
					} else {
						$parts = explode("-", $time);
						$year = $parts[0];
						$month = $parts[1];
						$day = $parts[2];

						$date = "$year-$month-$day";
						$hmParts = explode(":", $parts[3]);
						$hour = (int)$hmParts[0];
						$minute = sprintf("%02d", $hmParts[1]);
					}
					$timeDescription = "$date $hour:$minute";
				break;
		}
		return($timeDescription);

	}
	/*------------------------------------------------------------*/
	private function timeConds($timeUnit) {
		$time = @$_REQUEST['time'];
		switch($timeUnit) {
			case 'allTime':
					$timeConds = "true";
				break;
			case 'year':
					$year = $time == 'now' ? date("Y") : $time ;
					$timeConds = "month like '$year-%'";
				break;
			case 'month':
					$month = $time == 'now' ? date("Y-m") : $time ;
					$timeConds = "left(date, 7) = '$month'";
				break;
			case 'day':
					$date = $time == 'now' ? date("Y-m-d") : $time;
					$timeConds = "date = '$date'";
				break;
			case 'hour':
					if ( $time == 'now' ) {
						$date = date("Y-m-d");
						$hour = date("G");
					} else {
						$parts = explode("-", $time);
						$year = $parts[0];
						$month = $parts[1];
						$day = $parts[2];
						$hour = (int)$parts[3];
						$date = "$year-$month-$day";
					}
					$timeConds = "date = '$date' and hour = $hour";
				break;
			case 'minute':
					if ( $time == 'now' ) {
						$date = date("Y-m-d");
						$hour = date("G");
						$minute = date("i");
					} else {
						$parts = explode("-", $time);
						$year = $parts[0];
						$month = $parts[1];
						$day = $parts[2];

						$date = "$year-$month-$day";
						$hmParts = explode(":", $parts[3]);
						$hour = (int)$hmParts[0];
						$minute = (int)$hmParts[1];
					}
					$timeConds = "date = '$date' and hour = $hour and minute = $minute";
				break;
		}
		return($timeConds);

	}
	/*------------------------------------------------------------*/
	private function drillTname($entity, $timeUnit) {
		$entityPreFixes = array(
			'bidder' => "",
			'exchange' => "ex",
			'campaign' => "c",
			'placement' => "pl",
		);
		$timeUnitTablePostFixes = array(
			'allTime' => 'Year',
			'year' => 'Month',
			'month' => 'Day',
			'day' => 'Hour',
			'hour' => 'Minute',
		);
		$prefix = $entityPreFixes[$entity];
		$postfix = $timeUnitTablePostFixes[$timeUnit];
		$cntName = $prefix ? "Cnt" : "cnt";
		$tname = "$prefix$cntName$postfix";
		return($tname);

	}
	/*------------------------------------------------------------*/
}
/*------------------------------------------------------------*/

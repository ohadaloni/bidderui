<?php
/*------------------------------------------------------------*/
class ControlPanel extends BidderUI {
	/*------------------------------------------------------------*/
	public function on() {
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->newStatus("onOff", 1);
		else
			$this->Mview->msg("check the box and click button to confirm turning on");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function off() {
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->newStatus("onOff", 0);
		else
			$this->Mview->msg("check the box and click button to confirm turning off");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function setDailyBudget() {
		$dailyBudget = $_REQUEST['dailyBudget'];
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->newStatus("dailyBudget", $dailyBudget);
		else
			$this->Mview->error("check the box to confirm Daily Budget change");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function newStatus($fname, $value) {
		$controlPanel = $this->bidderUtils->controlPanel(true);
		$controlPanel['date'] = date("Y-m-d");
		$controlPanel['datetime'] = date("Y-m-d H:i:s");
		$controlPanel['updatedBy'] = $this->loginName;
		$controlPanel[$fname] = $value;
		$this->dbInsert("controlPanel", $controlPanel);
	}
	/*------------------------------------------------------------*/
	private function redir() {
		$this->redirect("/dashboard");
	}
	/*------------------------------------------------------------*/
}

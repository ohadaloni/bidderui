<?php
/*------------------------------------------------------------*/
class WhiteLists extends BidderUI {
	/*------------------------------------------------------------*/
	public function index() {
		$this->show();
	}
	/*------------------------------------------------------------*/
	public function show() {
		$sql = "select * from whiteLists";
		$rows = $this->Mmodel->getRows($sql);
		foreach ( $rows as $key => $row ) {
			$whiteListId = $row['id'];
			$sql = "select count(*) from whiteListItems where whiteListId = $whiteListId";
			$items = $this->Mmodel->getInt($sql);
			$rows[$key]['items'] = $items;
		}
		$this->Mview->showTpl("whiteLists/show.tpl", array(
			'rows' => $rows,
		));
	}
	/*------------------------------------------------------------*/
	public function update() {
		$this->dbUpdate("whiteLists", $_REQUEST['id'], $_REQUEST);
		$this->redir();
	}
	/*------------------------------*/
	public function edit() {
		$id = $_REQUEST['id'];
		$row = $this->Mmodel->getById("whiteLists", $id);
		$sql = "select * from whiteListItems where whiteListId = $id order by domain";
		$items = $this->Mmodel->getRows($sql);
		$this->Mview->showTpl("whiteLists/edit.tpl", array(
			'row' => $row,
			'items' => $items,
		));
	}
	/*------------------------------------------------------------*/
	public function insert() {
		$this->dbInsert("whiteLists", $_REQUEST);
		$this->redir();
	}
	/*------------------------------*/
	public function newWhiteList() {
		$this->Mview->showTpl("whiteLists/new.tpl");
	}
	/*------------------------------------------------------------*/
	public function newItem() {
		$this->dbInsert("whiteListItems", $_REQUEST);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function deleteItem() {
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->dbDelete("whiteListItems", $_REQUEST['itemId']);
		else
			$this->Mview->error("check the box and click button to confirm removing the whitelist item");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function whiteListOn() {
		$whiteListId = $_REQUEST['whiteListId'];
		$campaignId = @$_REQUEST['campaignId'];
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->addWhiteList($campaignId, $whiteListId);
		else
			$this->Mview->error("check the box and click button to confirm adding the whitelist");
		$this->redir(true);
	}
	/*------------------------------*/
	public function whiteListOff() {
		$whiteListId = $_REQUEST['whiteListId'];
		$campaignId = @$_REQUEST['campaignId'];
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->removeWhiteList($campaignId, $whiteListId);
		else
			$this->Mview->error("check the box and click button to confirm removing dding the whitelist");
		$this->redir(true);
	}
	/*------------------------------------------------------------*/
 	private function addWhiteList($campaignId, $whiteListId) {
 		if ( ! $campaignId )
 			$campaignId = 0; // bidder
 		$this->dbInsert("campaignWhiteLists", array(
 			'campaignId' => $campaignId,
 			'whiteListId' => $whiteListId,
 		));
 	}
 	/*------------------------------*/
 	private function removeWhiteList($campaignId, $whiteListId) {
 		if ( ! $campaignId )
 			$campaignId = 0; // bidder
 		$conds = "campaignId = $campaignId and whiteListId = $whiteListId";
 		$sql = "delete from campaignWhiteLists where $conds";
 		$this->sql($sql);
 	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function redir($controlPanelOnOff = false) {
		if ( $controlPanelOnOff ) {
			$campaignId = @$_REQUEST['campaignId'];
			if ( $campaignId )
				$this->redirect("/dashboard?campaignId=$campaignId");
			else
				$this->redirect("/dashboard");
		} elseif ( @$_REQUEST['whiteListId'] )
			$this->redirect("/whiteLists/edit?id={$_REQUEST['whiteListId']}");
		else
			$this->redirect("/whiteLists");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}

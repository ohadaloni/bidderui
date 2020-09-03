<?php
/*------------------------------------------------------------*/
class BlackLists extends BidderUI {
	/*------------------------------------------------------------*/
	public function index() {
		$this->show();
	}
	/*------------------------------------------------------------*/
	public function show() {
		$sql = "select * from blackLists";
		$rows = $this->Mmodel->getRows($sql);
		foreach ( $rows as $key => $row ) {
			$blackListId = $row['id'];
			$sql = "select count(*) from blackListItems where blackListId = $blackListId";
			$items = $this->Mmodel->getInt($sql);
			$rows[$key]['items'] = $items;
		}
		$this->Mview->showTpl("blackLists/show.tpl", array(
			'rows' => $rows,
		));
	}
	/*------------------------------------------------------------*/
	public function update() {
		$this->dbUpdate("blackLists", $_REQUEST['id'], $_REQUEST);
		$this->redir();
	}
	/*------------------------------*/
	public function edit() {
		$id = $_REQUEST['id'];
		$row = $this->Mmodel->getById("blackLists", $id);
		$sql = "select * from blackListItems where blackListId = $id order by domain";
		$items = $this->Mmodel->getRows($sql);
		$this->Mview->showTpl("blackLists/edit.tpl", array(
			'row' => $row,
			'items' => $items,
		));
	}
	/*------------------------------------------------------------*/
	public function insert() {
		$this->dbInsert("blackLists", $_REQUEST);
		$this->redir();
	}
	/*------------------------------*/
	public function newBlackList() {
		$this->Mview->showTpl("blackLists/new.tpl");
	}
	/*------------------------------------------------------------*/
	private function domainOf($str) {
		$str = trim($str);
		if ( strstr($str, " ") )
			return(null);
		if ( substr($str, 0, 4) == "http" ) {
			$parsed = parse_url($str);
			$str = @$parsed['host'];
		}
		$str = strtolower($str);
		return($str);
	}
	/*------------------------------*/
	public function upload() {
		$blackListId = @$_REQUEST['blackListId'];
		if ( ! $blackListId ) {
			$this->Mview->error("BlackLists::upload: No blackListId");
			return;
		}
		$filePath = @$_FILES['fileName']['tmp_name'];
		if ( ! $filePath ) {
			$this->Mview->error("BlackLists::upload: No file");
			return;
		}
		$lines = file($filePath);
		$num = 0;
		foreach ( $lines as $line ) {
			$line = trim($line);
			if ( ! $line )
				continue;
			$domain = $this->domainOf($line);
			if ( ! $domain ) {
				$this->Mview->msg("upload: $line: ignored");
				continue;
			}
			$this->dbInsert("blackListItems", array(
				'blackListId' => $blackListId,
				'domain' => $domain,
			));
		}
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function newItem() {
		$this->dbInsert("blackListItems", $_REQUEST);
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function deleteItem() {
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->dbDelete("blackListItems", $_REQUEST['itemId']);
		else
			$this->Mview->msg("check the box and click button to confirm removing the blacklist item");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function blackListOn() {
		$blackListId = $_REQUEST['blackListId'];
		$campaignId = @$_REQUEST['campaignId'];
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->addBlackList($campaignId, $blackListId);
		else
			$this->Mview->msg("check the box and click button to confirm adding the blacklist");
		$this->redir(true);
	}
	/*------------------------------*/
	public function blackListOff() {
		$blackListId = $_REQUEST['blackListId'];
		$campaignId = @$_REQUEST['campaignId'];
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->removeBlackList($campaignId, $blackListId);
		else
			$this->Mview->msg("check the box and click button to confirm removing dding the blacklist");
		$this->redir(true);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
 	private function addBlackList($campaignId, $blackListId) {
 		if ( ! $campaignId )
 			$campaignId = 0; // bidder
 		$this->dbInsert("campaignBlackLists", array(
 			'campaignId' => $campaignId,
 			'blackListId' => $blackListId,
 		));
 	}
 	/*------------------------------*/
 	private function removeBlackList($campaignId, $blackListId) {
 		if ( ! $campaignId )
 			$campaignId = 0; // bidder
 		$conds = "campaignId = $campaignId and blackListId = $blackListId";
 		$sql = "delete from campaignBlackLists where $conds";
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
		} elseif ( @$_REQUEST['blackListId'] )
			$this->redirect("/blackLists/edit?id={$_REQUEST['blackListId']}");
		else
			$this->redirect("/blackLists");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}

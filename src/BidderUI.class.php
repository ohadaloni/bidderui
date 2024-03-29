<?php
/*------------------------------------------------------------*/
class BidderUI extends Mcontroller {
	/*------------------------------------------------------------*/
	protected $loginName;
	protected $loginId;
	protected $loginType;
	/*------------------------------*/
	protected $bidderUIUtils;
	protected $bidderUtils;
	protected $memUtils;
	protected $keyNames;
	/*------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();

		// permit is called before before()
		// and if fails, before is not called.
		$this->loginId = BidderUILogin::loginId();
		$this->loginName = BidderUILogin::loginName();
		$this->loginType = BidderUILogin::loginType();

		$this->memUtils = new MemUtils;
		$this->keyNames = new KeyNames;
		$this->bidderUIUtils = new BidderUIUtils;
		$logFile = $this->bidderUIUtils->logFile();
		$this->logger = new Logger($logFile);
		$this->bidderUtils = new BidderUtils($logFile);
		$sql = "select * from countries order by name";
		$countries = $this->Mmodel->getRows($sql, 24*3600);
		$this->Mview->assign("countries", $countries);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	protected function before() {
		ini_set('max_execution_time', 10);
		ini_set("memory_limit", "5M");

		$this->bidderUIUtils->prior($this->controller, $this->action, $this->loginName, $this->loginType, $this->loginId);
		$this->Mview->assign(array(
			'controller' => $this->controller,
			'action' => $this->action,
		));
		if ( $this->showMargins()) {
			$this->Mview->showTpl("head.tpl");
			$this->Mview->showTpl("header.tpl");
			$menu = new Menu;
			$menu->index();
			$this->Mview->showMsgs();
		}
		$method = @$_SERVER['REQUEST_METHOD'];
		if ( $method == "GET" ) {
			$url = @$_SERVER['REQUEST_URI'];
			if ( $this->redirectable($url) ) {
				$this->Mview->setCookie("lastVisit", $url);
			}
		}
	}
	/*------------------------------*/
	protected function after() {
		if ( ! $this->showMargins())
			return;
		$this->Mview->showTpl("footer.tpl");
		$this->Mview->showTpl("foot.tpl");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function index() {
		$loginType = BidderUILogin::loginType();
		$loginId = BidderUILogin::loginId();
		if ( $loginId ) {
			$sql = "select landHere from users where id = $loginId";
			$landHere = $this->Mmodel->getString($sql);
			if ( $this->redirectable($landHere) ) {
				$this->redirect($landHere);
				return;
			}
			$lastVisit = @$_COOKIE['lastVisit'];
			if ( $this->redirectable($lastVisit) ) {
				$this->redirect($lastVisit);
				return;
			}
		}
		$this->redirect("/dashboard");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function landHere() {
		$referer = $_SERVER['HTTP_REFERER'];
		$parts = explode("/", $referer, 4);
		$landHere = "/".$parts[3];
		$affected = $this->dbUpdate("users", $this->loginId, array(
			'landHere' => $landHere,
		));
		$this->Mview->tell("landHere page set to $landHere", array(
			'rememberForNextPage' => true,
		));
		$this->redirect($landHere);
	}
	/*------------------------------------------------------------*/
	public function unland() {
		$affected = $this->dbUpdate("users", $this->loginId, array(
			'landHere' => null,
		));
		$this->Mview->tell("landHere page set to auto", array(
			'rememberForNextPage' => true,
		));
		$this->redirect("/");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function redirectable($url) {
		if ( ! $url )
			return(false);
		if ( $url == "/" )
			return(false);

		$parts = explode("?", $url);
		$parts = explode("/", $parts[0]);
		$pathParts = array();
		foreach ( $parts as $part )
			if ( $part != "" )
				$pathParts[] = $part;
		if ( ! $pathParts )
			$pathParts = array("bidderUI", "x");

		$className = $pathParts[0];
		$action = @$pathParts[1];
		$action = $action ? $action : "index";
		$nots = array(
			'bidderUI' => array(
				'unland',
				'changePasswd',
				'updatePasswd',
				'phpinfo',
			),
			'docs' => array(
				'showText',
			),
		);
		foreach( $nots as $notClassName => $notClass )
			foreach( $notClass as $notAction )
				if ( strcasecmp($notClassName, $className) == 0
						&& 
						( strcasecmp($notAction, $action) == 0 || $notAction == 'any' )
					) {
						return(false);
					}

		$files = Mutils::listDir(".", "php");
		$baseName = null;
		foreach ( $files as $file ) {
			$fileParts = explode(".", $file);
			$baseName = reset($fileParts);
			if(strtolower($className) != strtolower($baseName) )
				continue;
			require_once($file);
			if ( ! class_exists($baseName) ) {
				return(false);
			}
			break;
		}
		if ( ! method_exists($baseName, $action) ) {
			return(false);
		}
		return(true);
	}
	/*------------------------------------------------------------*/
	private function showMargins() {
		if ( Mutils::isAjax() ) {
			return(false);
		}
		$nots = array(
			'bidderUI' => array(
				'unland',
				'phpinfo',
			),
			'docs' => array(
				'showText',
			),
		);
		$controller = $this->controller;
		$action = $this->action;
		foreach( $nots as $notClassName => $notClass )
			foreach( $notClass as $notAction )
				if ( strcasecmp($notClassName, $controller) == 0
						&& 
						( strcasecmp($notAction, $action) == 0 || $notAction == 'any' )
					) {
						return(false);
					}
		return(true);
	}
	/*------------------------------------------------------------*/
	public function phpinfo() {
		phpinfo();
	}
	/*------------------------------------------------------------*/
	public function memcacheTest() {
		Mutils::memcacheTest();
	}
	/*------------------------------------------------------------*/
	public function memcacheStats() {
		Mutils::memcacheStats();
	}
	/*------------------------------------------------------------*/
	public function changePasswd() {
		$this->Mview->showTpl("admin/changePasswd.tpl");
	}
	/*------------------------------*/
	public function updatePasswd() {
		$loginName = $this->loginName;
		$oldPasswd = @$_REQUEST['oldPasswd'];
		$newPasswd = @$_REQUEST['newPasswd'];
		$newPasswd2 = @$_REQUEST['newPasswd2'];
		if ( ! $oldPasswd || ! $newPasswd || ! $newPasswd2 ) {
			$this->Mview->error("updatePasswd: please fill in all 3 fields");
			return;
		}
		if ( $newPasswd != $newPasswd2 ) {
			$this->Mview->error("updatePasswd: new passwords are not the same");
			return;
		}
		$sql = "select * from users where loginName = '$loginName'";
		$loginRow = $this->Mmodel->getRow($sql);
		if ( ! $loginRow ) {
			$this->Mview->error("updatePasswd: no login row");
			return;
		}
		$dbPasswd = $loginRow['passwd'];
		if ( $dbPasswd != $oldPasswd && $dbPasswd != sha1($oldPasswd) ) {
			$this->Mview->error("updatePasswd: old password incorrect");
			return;
		}
		$newDbPasswd = sha1($newPasswd);
		$this->dbUpdate("users", $loginRow['id'], array(
			'passwd' => $newDbPasswd,
		));
		$this->Mview->msg("Password changed");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	protected function dbInsert($tableName, $data) {
		if ( $this->loginName )
			return($this->Mmodel->dbInsert($tableName, $data));
		$this->Mview->msg("Not logged in. insert ignored");
		return(null);
	}
	/*------------------------------*/
	protected function dbUpdate($tableName, $id, $data) {
		if ( $this->loginName )
			return($this->Mmodel->dbUpdate($tableName, $id, $data));
		$this->Mview->error("Not logged in. Update ignored");
		return(null);
	}
	/*------------------------------*/
	protected function dbDelete($tableName, $id) {
		if ( $this->loginName )
			return($this->Mmodel->dbDelete($tableName, $id));
		$this->Mview->error("Not logged in. delete ignored");
		return(null);
	}
	/*------------------------------*/
	protected function sql($sql) {
		if ( $this->loginName )
			return($this->Mmodel->sql($sql));
		$this->Mview->error("Not logged in. db change ignored");
		return(null);
		
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	protected function error($msg, $r = 100) {
		$this->log("ERROR: $msg", $r);
	}
	/*------------------------------------------------------------*/
	protected function log($msg, $r = 100) {
		if ( rand(1, 100 * 1000) > $r * 1000 )
			return;
		if ( $r == 100 )
			$str = $msg;
		else
			$str = "$r/100: $msg";
		$this->logger->log($str);
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}

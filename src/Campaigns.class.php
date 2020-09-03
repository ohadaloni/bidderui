<?php
/*------------------------------------------------------------*/
class Campaigns extends BidderUI {
	/*------------------------------------------------------------*/
	private $ttl;
	/*------------------------------------------------------------*/
	protected function before() {
		parent::before();
		$this->ttl = 30;
		$bannerServer = BANNER_SERVER;
		$bannerUrl = "http://$bannerServer/banners";
		$dayHours = array();
		for($i=0;$i<24;$i++)
			$dayHours[] = $i;
		$this->Mview->assign(array(
			'bannerUrl' => $bannerUrl,
			'kinds' => $this->bidderUtils->kinds(),
			'dayHours' => $dayHours,
		));
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	public function index() {
		$this->show();
	}
	/*------------------------------------------------------------*/
	public function show() {
		$sql = "select * from campaigns";
		$rows = $this->Mmodel->getRows($sql);
		$this->Mview->showTpl("campaigns/show.tpl", array(
			'rows' => $rows,
		));
	}
	/*------------------------------------------------------------*/
	public function on() {
		$campaignId = $_REQUEST['campaignId'];
		$campaignName = $this->bidderUtils->campaignName($campaignId);
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->dbUpdate("campaigns", $campaignId, array(
				'onSwitch' => 1,
				'lastUpdated' => date("Y-m-d H:i:s"),
				'lastUpdatedBy' => $this->loginName,
			));
		else
			$this->Mview->msg("$campaignName: check the box and click button to confirm turning on");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function off() {
		$campaignId = $_REQUEST['campaignId'];
		$campaignName = $this->bidderUtils->campaignName($campaignId);
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" )
			$this->dbUpdate("campaigns", $campaignId, array(
				'onSwitch' => 0,
				'lastUpdated' => date("Y-m-d H:i:s"),
				'lastUpdatedBy' => $this->loginName,
			));
		else
			$this->Mview->msg("$campaignName: check the box and click button to confirm turning off");
		$this->redir();
	}
	/*------------------------------------------------------------*/
	public function changeCampaign() {
		$campaignId = $_REQUEST['campaignId'];
		$campaignName = $this->bidderUtils->campaignName($campaignId);
		$ok = @$_REQUEST['ok'];
		if ( $ok == "on" ) {
			$data = $_REQUEST;
			if ( @$data['hours'] )
				$data['hours'] = implode(",", $data['hours']);
			else
				$data['hours'] = null;
			$data['lastUpdated'] = date("Y-m-d H:i:s");
			$data['lastUpdatedBy'] = $this->loginName;
			$this->dbUpdate("campaigns", $campaignId, $data);
		} else {
			$this->Mview->error("$campaignName: check the box and click button to change");
		}
		$this->redir();
	}
	/*------------------------------*/
	public function edit() {
		$campaignId = $_REQUEST['campaignId'];
		$campaign = $this->Mmodel->getById("campaigns", $campaignId);
		if ( $campaign['hours'] )
			$campaignHours = explode(",", $campaign['hours']);
		else
			$campaignHours = null;
		$this->Mview->showTpl("campaigns/edit.tpl", array(
			'campaign' => $campaign,
			'campaignHours' => $campaignHours,
		));
	}
	/*------------------------------------------------------------*/
	public function newBanner() {
		if ( ! $this->loginName ) {
			$this->Mview->error("Not logged in");
			return;
		}
		$campaignId = $_REQUEST['campaignId'];
		$files = @$_FILES['files'];
		$names = $files['name'];
		$tmpNames = $files['tmp_name'];
		if ( ! @$names[0] ) {
			$this->Mview->error("No baner uploaded");
			return;
		}
		$fileName = $names[0];
		$tmpName = $tmpNames[0];
		$bannerDir = BANNER_DIR;
		$filePath = "$bannerDir/$fileName";
		@unlink($filePath);
		copy($tmpName, $filePath);
		$imageSize = getimagesize($filePath);
		if ( ! $imageSize ) {
			$this->Mview->error("cannot get image size");
			Mview::print_r($filePath, "filePath", basename(__FILE__), __LINE__, null, false);
			return;
		}
		$w = $imageSize[0];
		$h = $imageSize[1];
		$this->dbUpdate("campaigns", $campaignId, array(
			'banner' => $fileName,
			'w' => $w,
			'h' => $h,
			'lastUpdated' => date("Y-m-d H:i:s"),
			'lastUpdatedBy' => $this->loginName,
		));
		$this->redirect("/campaigns/edit?campaignId=$campaignId");
	}
	/*------------------------------------------------------------*/
	public function insertCampaign() {
		$data = $_REQUEST;
		$data['owner'] = $this->loginName;
		if ( ! $data['name'] )
			$data['name'] = "C".date("Y-m-d-G:i:s");
		if ( ! $data['kind'] )
			$data['kind'] = "app";
		if ( @$data['hours'] )
			$data['hours'] = implode(",", $data['hours']);
		$this->dbInsert("campaigns", $data);
		$this->redir();
	}
	/*------------------------------*/
	public function newCampaign() {
		$this->Mview->showTpl("campaigns/new.tpl");
	}
	/*------------------------------------------------------------*/
	public function dup() {
		$campaignId = $_REQUEST['campaignId'];
		$campaign = $this->Mmodel->getById("campaigns", $campaignId);
		$baseName = $campaign['name'];

		$today = date("Y-m-d");
		$rand = rand(1000, 9999);
		$newName = "$baseName--dupped-on-$today-$rand";
		$campaign['name'] = $newName;
		$campaign['onSwitch'] = false;
		$campaignId = $this->dbInsert("campaigns", $campaign);
		$this->redirect("/campaigns/edit?campaignId=$campaignId");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function redir() {
		$campaignId = @$_REQUEST['campaignId'];
		$dash = @$_REQUEST['dash'];
		if ( $dash )
			$this->redirect("/dashboard?campaignId={$_REQUEST['campaignId']}");
		else
			$this->redirect("/campaigns");
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
}

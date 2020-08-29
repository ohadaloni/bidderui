<?php
/*------------------------------------------------------------*/
class Menu extends Mcontroller {
	/*------------------------------------------------------------*/
	public function index() {
			$this->Mview->showTpl("menuDriver.tpl", array(
				'menu' => $this->dd(),
			));
	}
	/*------------------------------------------------------------*/
	/*------------------------------------------------------------*/
	private function dd() {
		$menu = array(
			'Bidder' => array(
				array(
					'name' => 'dashboard',
					'title' => 'Dashboard',
					'url' => "/Dashboard",
				),
				array(
					'name' => 'Campaigns',
					'title' => 'Campaigns',
					'url' => "/Campaigns",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'whiteLists',
					'title' => 'White Lists',
					'url' => "/whiteLists",
				),
				array(
					'name' => 'blackLists',
					'title' => 'Black Lists',
					'url' => "/blackLists",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'Placements',
					'title' => 'Placements',
					'url' => "/Placements",
				),
			),
			'Exchanges' => array(
				array(
					'name' => 'dashboard',
					'title' => 'Dashboard',
					'url' => "/exchanges/dashboard",
				),
				array(
					'name' => 'showTraffic',
					'title' => 'Show Traffic Simulation Varieties',
					'url' => "/exchanges/showTraffic",
				),
			),
			'Publisher' => array(
				array(
					'name' => 'publisher',
					'title' => 'Show Publisher Page',
					'url' => "/publisher",
					'target' => "publisher",
				),
			),
			'Docs' => array(
				array(
					'name' => 'architecture',
					'title' => 'Architecture Overview',
					'url' => "/docs/showText?doc=architecture.txt",
					'target' => "arch",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'rtb',
					'title' => 'RTB Protocol Definition',
					'url' => "https://www.iab.com/wp-content/uploads/2015/05/OpenRTB_API_Specification_Version_2_3_1.pdf",
					'target' => "rtb",
				),
				array(
					'name' => 'smapleRequest',
					'title' => 'Bid Request Example',
					'url' => "/docs/showText?doc=request.json",
					'target' => "showText",
				),
				array(
					'name' => 'smapleBid',
					'title' => 'Bid Example',
					'url' => "/docs/showText?doc=bid.json",
					'target' => "showText",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'OpenRTB',
					'title' => 'OpenRTB',
					'url' => "http://openrtb.github.io/OpenRTB/",
					'target' => "_blank",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'Smaato',
					'title' => 'Smaato',
					'url' => "https://developers.smaato.com/demand-partners/",
					'target' => "Smaato",
				),
				array(
					'name' => 'MoPub',
					'title' => 'MoPub',
					'url' => "https://developers.mopub.com/dsps/",
					'target' => "MoPub",
				),
				array(
					'name' => 'axonix',
					'title' => 'Axonix',
					'url' => "https://axonix.com/dsps/",
					'target' => "axonix",
				),
				array(
					'name' => 'AdX',
					'title' => 'AdX',
					'url' => "https://developers.google.com/authorized-buyers/rtb/start",
					'target' => "AdX",
				),
				array(
					'name' => 'Vdopia',
					'title' => 'Vdopia',
					'url' => "https://online.vdopia.com/index.php?page=advertisers",
					'target' => "Vdopia",
				),
				array(
					'name' => 'Adxperience',
					'title' => 'Adxperience',
					'url' => "https://adxperience.com/",
					'target' => "Adxperience",
				),
				array(
					'name' => 'Flurry',
					'title' => 'Flurry',
					'url' => "https://www.flurry.com/",
					'target' => "Flurry",
				),
				array(
					'name' => 'MobFox',
					'title' => 'MobFox',
					'url' => "https://mobfox.atlassian.net/wiki/spaces/PUMD/pages/466518062/Integrate+as+a+DSP",
					'target' => "MobFox",
				),
				array(
					'name' => 'OpenX',
					'title' => 'OpenX',
					'url' => "https://docs.openx.com/Content/demandpartners/demand-get-started.html",
					'target' => "OpenX",
				),
				array(
					'name' => 'onebyaol',
					'title' => 'One by AOL (verison)',
					'url' => "https://www.verizonmedia.com/advertising",
					'target' => "onebyaol",
				),
				array(
					'name' => 'appnexus',
					'title' => 'AppNexus (xandr)',
					'url' => "https://www.xandr.com/",
					'target' => "appnexus",
				),
				array(
					'name' => 'verizon',
					'title' => 'Verizon Media',
					'url' => "https://www.verizonmedia.com/advertising",
					'target' => "verizon",
				),
				array(
					'name' => 'rubicon',
					'title' => 'Rubicon Project',
					'url' => "https://rubiconproject.com/buyers/",
					'target' => "rubicon",
				),
				array(
					'name' => 'pubmatic',
					'title' => 'PubMatic',
					'url' => "https://pubmatic.com/solutions/buyers/",
					'target' => "pubmatic",
				),
				array(
					'name' => 'indexexchange',
					'title' => 'Index Exchange',
					'url' => "https://api.indexexchange.com/reference",
					'target' => "indexexchange",
				),
				array(
					'name' => 'smartyads',
					'title' => 'SmartyAds',
					'url' => "https://smartyads.com/docs/advertisers/dsp-guide",
					'target' => "smartyads",
				),
			),
			'admin' => array(
				array(
					'name' => 'showSource',
					'title' => 'Show Source Code',
					'url' => "/showSource",
				),
				array(
					'name' => 'clone bidder',
					'title' => 'Clone',
					'url' => "https://github.com/ohadaloni/bidder",
					'target' => "clone",
				),
				array(
					'name' => 'cloneUI',
					'title' => 'Clone UI',
					'url' => "https://github.com/ohadaloni/bidderUI",
					'target' => "clone",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'bidderLog',
					'title' => 'Bidder log',
					'url' => "/logtracker?name=bidder",
				),
				array(
					'name' => 'exchangeLog',
					'title' => 'Exchanges & Advertisers Simulator log',
					'url' => "/logtracker?name=exchange",
				),
				array(
					'name' => 'minuteSaverLog',
					'title' => 'minuteSaver log',
					'url' => "/logtracker?name=minuteSaver",
				),
				array(
					'name' => 'aggregatorLog',
					'title' => 'aggregator log',
					'url' => "/logtracker?name=aggregator",
				),
				array(
					'name' => 'placementPpmCacherLog',
					'title' => 'placementPpmCacher log',
					'url' => "/logtracker?name=placementPpmCacher",
				),
				array(
					'name' => 'winsCollectorLog',
					'title' => 'winsCollector log',
					'url' => "/logtracker?name=winsCollector",
				),
				array(
					'name' => 'revenueCollectorLog',
					'title' => 'revenueCollector log',
					'url' => "/logtracker?name=revenueCollector",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'phpinfo',
					'title' => 'phpinfo',
					'url' => "/bidderUI/phpinfo",
				),
				array(
					'name' => 'memcacheTest',
					'title' => 'memcacheTest',
					'url' => "/bidderUI/memcacheTest",
				),
				array(
					'name' => 'memcacheStats',
					'title' => 'memcacheStats',
					'url' => "/bidderUI/memcacheStats",
				),
			),
		);
		$loginName = BidderUILogin::loginName();
		if ( $loginName )
			$menu[$loginName] = array(
				array(
					'name' => 'landHere',
					'title' => 'Land Here',
					'url' => "/bidderUI/landHere",
				),
				array(
					'name' => 'UnLand',
					'title' => 'unland (land latest)',
					'url' => "/bidderUI/unland",
				),
				array(
					'name' => 'chpass',
					'title' => 'Change Password',
					'url' => "/bidderUI/changePasswd",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'timeIn',
					'title' => 'Time In',
					'url' => "/timewatch/in",
				),
				array(
					'name' => 'timeOut',
					'title' => 'Time Out',
					'url' => "/timewatch/out",
				),
				array(
					'name' => 'timewatchThisMonth',
					'title' => 'TimeWatch This Month',
					'url' => "/timewatch",
				),
				array(
					'name' => 'timeWatchSummary',
					'title' => 'TimeWatch Summary',
					'url' => "/timewatch/summary",
				),
				array(
					'divider' => '-----------------------',
				),
				array(
					'name' => 'logout',
					'title' => 'Log Off',
					'url' => "/?logOut=logOut",
				),
			);
		return($menu);
	}
	/*------------------------------------------------------------*/
}


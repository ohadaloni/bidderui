<?php
/*------------------------------------------------------------*/
require_once("bidderUIConfig.php");
require_once(M_DIR."/mfiles.php");
require_once("bidderUIFiles.php");
require_once("BidderUI.class.php");
/*------------------------------------------------------------*/
$startTime = microtime(true);
/*------------------------------------------------------------*/
$ua = @$_SERVER['HTTP_USER_AGENT'];
if (
	! $ua
	|| stristr($ua, "bot")
	|| stristr($ua, "crawl")
	|| stristr($ua, "spider")
	) {
	http_response_code(204);
	exit;
}
/*------------------------------------------------------------*/
global $Mview;
global $Mmodel;
$Mview = new Mview;
$Mmodel = new Mmodel;
$Mview->holdOutput();
/*------------------------------------------------------------*/
$bidderUI = new BidderUI;
$bidderUI->startTime($startTime);
$bidderUILogin = new BidderUILogin;
if ( isset($_REQUEST['logOut']) ) {
	$bidderUI = new BidderUI;
	$bidderUILogin->logOut();
}
$isLoggedIn = $bidderUILogin->enterSession();
$bidderUI->control();
$Mview->flushOutput();
/*------------------------------------------------------------*/
/*------------------------------------------------------------*/

<?php
/*------------------------------------------------------------*/
require_once("bidderUIConfig.php");
require_once(M_DIR."/mfiles.php");
require_once("bidderUIFiles.php");
require_once("BidderUI.class.php");
/*------------------------------------------------------------*/
global $Mview;
global $Mmodel;
$Mview = new Mview;
$Mmodel = new Mmodel;
$Mview->holdOutput();
/*------------------------------------------------------------*/
$bidderUI = new BidderUI;
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

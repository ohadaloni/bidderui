<?php
/*------------------------------------------------------------*/
error_reporting(E_ALL | E_NOTICE | E_STRICT );
/*------------------------------------------------------------*/
date_default_timezone_set("UTC");
/*------------------------------------------------------------*/
$topDir = dirname(__DIR__);
/*------------------------------------------------------------*/
define('BIDDER_DIR', "/var/www/vhosts/bidder.theora.com");
/*------------------------------------------------------------*/
$bidderDir = BIDDER_DIR;
require_once("$bidderDir/src/sharedConfig.php");
require_once(M_DIR."/mfiles.php");
require_once("$topDir/src/BidderUIUtils.class.php");
require_once("$bidderDir/src/BidderUtils.class.php");
require_once("$bidderDir/src/MemUtils.class.php");
require_once("$bidderDir/src/KeyNames.class.php");
/*------------------------------------------------------------*/

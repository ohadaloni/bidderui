<?php
/*------------------------------------------------------------*/
error_reporting(E_ALL | E_NOTICE | E_STRICT );
/*------------------------------------------------------------*/
date_default_timezone_set("UTC");
/*------------------------------------------------------------*/
if ( strstr(__DIR__, "ohad") )
	define('BIDDER_DIR', "/var/www/vhosts/ohad.bidder.theora.com");
else
	define('BIDDER_DIR', "/var/www/vhosts/bidder.theora.com");
/*------------------------------------------------------------*/
require_once(BIDDER_DIR."/src/sharedConfig.php");
/*------------------------------------------------------------*/

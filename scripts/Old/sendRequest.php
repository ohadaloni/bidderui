<?php
require_once("scriptsConfig.php");
$topDir = dirname(__DIR__);
$samplePath = "$topDir/docs/request.json";
$url = "http://pocketmath.bidder.theora.com";
$cmd = "curl -d @$samplePath $url";
/*	echo "$cmd\n";	*/
$curelResponse = `$cmd`;
/*	echo "------------------------------\n$curelResponse\n-------------------------\n\n";	*/

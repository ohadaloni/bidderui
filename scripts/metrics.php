<?php
require_once("scriptsConfig.php");
$bu = new BidderUtils;
$metrics = ( @$argv[1] == 'r' ) ?
	$bu->rateMetrics() :
	( @$argv[1] == 'c' ? $bu->cntMetrics() : $bu->metrics() );
$metrics = implode("\n", $metrics);
echo "$metrics\n";

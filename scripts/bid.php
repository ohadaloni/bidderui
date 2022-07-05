<?php
require_once("scriptsConfig.php");
$bidId = $argv[1];
$mu = new MemUtils;
$bu = new BidderUtils;
$bid = $mu->bid($bidId);
$request = $mu->bidRequest($bid['id']);
print_r($request);
print_r($bid);

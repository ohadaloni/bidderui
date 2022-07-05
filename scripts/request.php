<?php
require_once("scriptsConfig.php");
$bidRequestId = $argv[1];
$mu = new MemUtils;
$request = $mu->bidRequest($bidRequestId);
print_r($request);

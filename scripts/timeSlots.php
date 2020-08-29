<?php
require_once("scriptsConfig.php");
$bu = new BidderUtils;
$timeSlots = $bu->timeSlots();
$timeSlots = implode("\n", $timeSlots);
echo "$timeSlots\n";

<?php
require_once("scriptsConfig.php");
require_once("Exchange.class.php");
$exchange = new Exchange;
$exchange->run($argv);

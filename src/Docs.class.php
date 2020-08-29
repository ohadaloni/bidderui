<?php
/*------------------------------------------------------------*/
class Docs extends BidderUI {
	/*------------------------------------------------------------*/
	public function showText() {
		$doc = $_REQUEST['doc'];
		$topDir = dirname(__DIR__);
		$path = "$topDir/docs/$doc";
		$contents = @file_get_contents($path);
		header("Content-type: text/plain");
		echo $contents;
	}
	/*------------------------------------------------------------*/
}

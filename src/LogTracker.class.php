<?php
/*------------------------------------------------------------*/
class LogTracker extends BidderUI {
		/*------------------------------------------------------------*/
		/*------------------------------------------------------------*/
		public function index() {
				$this->track(@$_REQUEST['name']);
		}
		/*------------------------------------------------------------*/
		private function track($name) {
			$v = "/var/www/vhosts";
			if ( $name == 'exchange' )
				$dir = "$v/bidderui.theora.com/logs/$name";
			else
				$dir = "$v/bidder.theora.com/logs/$name";
			$logFile = `/bin/ls -tr $dir | tail -1`;
			$logFile = trim($logFile);
			$numLines = 30;
			$contents = `tail -$numLines $dir/$logFile`;
			$contents = trim($contents);
			$lines = explode("\n", $contents);
			$text = implode("<br />\n", $lines);
			$this->Mview->msg($logFile);
			$this->Mview->pushOutput($text);
		}
		/*------------------------------------------------------------*/
}

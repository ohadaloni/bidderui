<?php
/*------------------------------------------------------------*/
class ShowSource extends BidderUI {
	/*------------------------------------------------------------*/
	public function index() {
		$V = "/var/www/vhosts";
		$fileList = $this->fileList();
		$tplArgs = $fileList;
		$file = @$_REQUEST['file'];
		$topDir = @$_REQUEST['topDir'];
		if ( $file ) {
			$fpath = "$V/$topDir.theora.com/$file";
			if ( file_exists($fpath) ) {
				$parts = explode("/", $file);
				$sourceFileName = end($parts);
				$source = highlight_file($fpath, true);
				$tplArgs['topDir'] = $topDir;
				$tplArgs['sourceFile'] = $sourceFileName;
				Mview::print_r($tplArgs, "tplArgs", basename(__FILE__), __LINE__, null, false);
				$tplArgs['source'] = $source;
			}
		}
		$this->Mview->showTpl("showSource/showSource.tpl", $tplArgs);
	}
	/*------------------------------------------------------------*/
	private function fileList() {
		$V = "/var/www/vhosts";
		$bidderTopDir = "$V/bidder.theora.com";
		$uiTopDir = "$V/bidderui.theora.com";
		$bidderFiles = `cd $bidderTopDir ; echo src/*.php scripts/*.php src/tpl/*.tpl src/tpl/*/*.tpl src/tpl/*/*/*.tpl`;
		$bidderFiles = preg_split('/\s+/', $bidderFiles);
		array_pop($bidderFiles);
		foreach ( $bidderFiles as $key => $bidderFile )
			if ( strstr($bidderFile, "*") )
				unset($bidderFiles[$key]);
		$uiFiles = `cd $uiTopDir ; echo src/*.php scripts/*.php src/tpl/*.tpl src/tpl/*/*.tpl`;
		$uiFiles = preg_split('/\s+/', $uiFiles);
		array_pop($uiFiles);
		foreach ( $uiFiles as $key => $uiFile )
			if ( strstr($uiFile, "*") )
				unset($uiFiles[$key]);
		return(array(
			'bidderFiles' => $bidderFiles,
			'uiFiles' => $uiFiles,
		));
	}
	/*------------------------------------------------------------*/
}
/*------------------------------------------------------------*/

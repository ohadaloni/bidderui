<?php
/*------------------------------------------------------------*/
class Placements extends BidderUI {
	/*------------------------------------------------------------*/
	public function index() {
		ini_set("memory_limit", "128M");
		$this->summary();
	}
	/*------------------------------------------------------------*/
	public function summary() {
		$placements = $this->bidderUtils->placements();
		usort($placements, array($this, "byPpmDesc"));
		$numTops = 50;
		$tops = array_slice($placements, 0, $numTops);
		$agoDays = PLACEMENT_OPT_WINDOW;
		$ago = date("Y-m-d", time() - $agoDays*24*3600);
		$minWins = PLACEMENT_MIN_WINS ;
		$this->Mview->msg("Placements summary: showing top $numTops with at least $minWins wins since $ago");
		$this->Mview->showTpl("placements/summary.tpl", array(
			'rows' => $tops,
		));
	}
	/*------------------------------------------------------------*/
	private function byPpmDesc($row1, $row2) {
		$diff =  $row2['ppm'] - $row1['ppm'];
		$order = $diff > 0 ? 1 : ( $diff < 0 ? -1 : 0 ) ;
		return($order);
	}
	/*------------------------------------------------------------*/
}

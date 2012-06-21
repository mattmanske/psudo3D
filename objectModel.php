<?php // Model

class riftObject {

	public function randPiece($max = 3, $only = false){
		$spaces = array('x', 'y', 'z');
		$plane = array_rand($spaces, 1);
		$start1 = rand(0, $max);
		$start2 = rand(0, $max);
		$static = 0; //rand(0, $max);

		$adders = array(1, 2);
		shuffle($adders);

		$switch = (!$only ? $spaces[$plane] : $only);

		switch ($switch):
			case 'x':
				$ray = array(array($static, $start1, $start2), array($static, $start1 + $adders[0], $start2 + $adders[1]), 1);
				break;
			case 'y':
				$ray = array(array($start1, $static, $start2), array($start1 + $adders[0], $static, $start2 + $adders[1]), 1);
				break;
			case 'z':
				$ray = array(array($start1, $start2, $static), array($start1 + $adders[0], $start2 + $adders[1], $static), 1);
				break;
		endswitch;

		return ($ray ? new singlePiece($ray) : false);
	}
} ?>
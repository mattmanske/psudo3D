<?php // Model

class riftObject {

	public function randPiece($max = 3){
		$spaces = array('x', 'y', 'z');
		$plane = array_rand($spaces, 1);
		$start1 = rand(0, $max);
		$start2 = rand(0, $max);

		switch ($spaces[$plane]):
			case 'x':
				return array(array(0, $start1, $start2), array(0, $start1+2, $start2+1), 1);
			case 'y':
				return array(array($start1, 0, $start2), array($start1+2, 0, $start2+1), 1);
			case 'z':
				return array(array($start1, $start2, 0), array($start1+2, $start2+1, 0), 1);
			default:
				return $plane;
		endswitch;
	}
} ?>
<?php // Point Object

class singlePiece {

	static $row;
	static $plane;
	static $faceing;
	static $corners;

	public function __construct($ray){
		$this->faceing = $ray[2];
		self::findCorners($ray);
	}

	public function findCorners($p){

		if ($p[0][0] == $p[1][0]):
			$this->plane = 'x';
			$this->row = $p[0][0];
			$this->corners = array(array($p[0][0], $p[0][1], $p[1][2]), $p[0], array($p[0][0], $p[1][1], $p[0][2]), $p[1]);
		elseif ($p[0][1] == $p[1][1]):
			$this->plane = 'y';
			$this->row = $p[0][1];
			$this->corners = array(array($p[0][0], $p[0][1], $p[1][2]), $p[0], array($p[1][0], $p[0][1], $p[0][2]), $p[1]);
		elseif ($p[0][2] == $p[1][2]):
			$this->plane = 'z';
			$this->row = $p[0][2];
			$this->corners = array(array($p[0][0], $p[1][1], $p[0][2]), $p[0], array($p[1][0], $p[0][1], $p[0][2]), $p[1]);
		else:
			$this->corners = false;
		endif;

	}
}
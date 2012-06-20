<?php // Controller

class riftController {

	static $size;
	static $spacing;
	static $orientation;

	static $dimensions;
	static $center;
	static $multiplier;

	public function __construct($size = 5, $spacing = 10, $orientation = 'front'){
        $this->size = $size;
        $this->spacing = $spacing;
        $this->orientation = $orientation;

        $this->center = array(
        	'v'	=> ((($this->size * 2) * $this->spacing) * self::vert()),
        	'h'	=> ((($this->size * 2) * $this->spacing) * self::horz()) / 2,
        );
        $this->dimensions = array(
        	'height'	=> ($this->center['v'] * 2) + 3,
        	'width'		=> ($this->center['h'] * 2) + 3,
        );
        switch ($orientation):
        	case 'back':
        		$this->multiplier = array(
        			'x' => array('v' => self::vert(1),	'h' => self::horz(1)),
        			'y' => array('v' => -1,				'h' => 0),
        			'z' => array('v' => self::vert(1),	'h' => self::horz(-1)));
        		break;
        	case 'side':
        		$this->multiplier = array(
        			'x' => array('v' => self::vert(1),	'h' => self::horz(1)),
        			'y' => array('v' => -1,				'h' => 0),
        			'z' => array('v' => self::vert(1),	'h' => self::horz(-1)));
        		break;
        	case 'bottom':
        		$this->multiplier = array(
        			'x' => array('v' => self::vert(1),	'h' => self::horz(1)),
        			'y' => array('v' => -1,				'h' => 0),
        			'z' => array('v' => self::vert(1),	'h' => self::horz(-1)));
        		break;
        	default: 		// case 'front'
        		$this->multiplier = array(
        			'x' => array('v' => self::vert(1),	'h' => self::horz(1)),
        			'y' => array('v' => -1,				'h' => 0),
        			'z' => array('v' => self::vert(1),	'h' => self::horz(-1)));
        endswitch;
    }

    private function vert($val = 1){
	    return round($val / sqrt(3), 5);
    }

    private function horz($val = 1){
	    return round(2 * ($val / sqrt(3)), 5);
    }

    private function offset($x, $y, $z){
    	$offset['top'] 	= round($this->center['v']
    		+ ($x * $this->multiplier['x']['v'] * $this->spacing)
    		+ ($y * $this->multiplier['y']['v'] * $this->spacing)
    		+ ($z * $this->multiplier['z']['v'] * $this->spacing), 1);
    	$offset['left'] = round($this->center['h']
    		+ ($x * $this->multiplier['x']['h'] * $this->spacing)
    		+ ($y * $this->multiplier['y']['h'] * $this->spacing)
    		+ ($z * $this->multiplier['z']['h'] * $this->spacing), 1);
	    return $offset;
    }

	public function drawGrid(){
		echo '<div id="stage" style="height:'.$this->dimensions['height'].'px; width:'.$this->dimensions['width'].'px;">';

		for ($z = 0; $z <= $this->size; $z++):
			for ($y = 0; $y <= $this->size; $y++):
				for ($x = 0; $x <= $this->size; $x++):
					if ($x == 0 || $y ==0 || $z ==0)
						self::drawDot($x, $y, $z);
				endfor;
			endfor;
		endfor;
	}

	public function drawDot($x, $y, $z, $class = ''){
		$offset = self::offset($x, $y, $z);
		echo '<div class="griddot '.$class.'" style="top:'.$offset['top'].'px; left:'.$offset['left'].'px"></div>';
	}

	public function drawPiece($piece){
		$corners = self::parsePiece($piece);
		foreach($corners as $corner):
			self::drawDot($corner[0], $corner[1], $corner[2], 'piecedot');
		endforeach;
	}

	public function parsePiece($piece){
		if ($piece[0][0] == $piece[1][0]):		// X Plane
			return array(
				$piece[0], $piece[1],
				array($piece[0][0], $piece[0][1], $piece[1][2]),
				array($piece[0][0], $piece[1][1], $piece[0][2]),
			);
		elseif ($piece[0][1] == $piece[1][1]):	// Y Plane
			return array(
				$piece[0], $piece[1],
				array($piece[0][0], $piece[0][1], $piece[1][2]),
				array($piece[1][0], $piece[0][1], $piece[0][2]),
			);
		elseif ($piece[0][2] == $piece[1][2]):	// Z Plane
			return array(
				$piece[0], $piece[1],
				array($piece[0][0], $piece[1][1], $piece[0][2]),
				array($piece[1][0], $piece[0][1], $piece[0][2]),
			);
		else:
			return false;
		endif;
	}

} ?>
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

	//	self:drawFloor();
		echo '<div id="stage_dots">';
			for ($z = 0; $z <= $this->size; $z++):
				for ($y = 0; $y <= $this->size; $y++):
					for ($x = 0; $x <= $this->size; $x++):
						if ($x == 0 || $y ==0 || $z ==0)
							self::drawDot($x, $y, $z);
					endfor;
				endfor;
			endfor;
		echo '</div>';
	}

	public function drawDot($x, $y, $z, $class = ''){
		$offset = self::offset($x, $y, $z);
		echo '<div class="griddot '.$class.'" style="top:'.($offset['top']-2).'px; left:'.($offset['left']-2).'px"></div>';
	}

	public function drawPiece($piece){
		$topValues = $leftValues = array();
		foreach($piece->corners as $corner):
			$offset = self::offset($corner[0], $corner[1], $corner[2]);
			$topValues[] = $offset['top'];
			$leftValues[] = $offset['left'];

			self::drawDot($corner[0], $corner[1], $corner[2], 'piecedot');
		endforeach;

		switch ($piece->plane):
			case 'x':
				$height = max($topValues) - min($topValues) - self::vert($this->spacing);
				$width = max($leftValues) - min($leftValues);
				$top = min($topValues) + self::vert($this->spacing / 2);
				$left = min($leftValues);
				break;
			case 'y':
				$height = $this->spacing;
				$width = 100;
				$top = min($topValues) + self::vert($this->spacing);
				$left = min($leftValues) + self::vert($this->spacing);
				break;
			case 'z':
				$height = max($topValues) - min($topValues) - (2 * self::vert($this->spacing));
				$width = max($leftValues) - min($leftValues);
				$top = min($topValues) + (2 * self::vert($this->spacing / 2));
				$left = min($leftValues);
				break;
			default:
				$width = $height = $top = $left = 0;
		endswitch;

		echo '<div class="single_piece '.$piece->plane.'_plane '.$piece->plane.'_row '.(true ? 'tall' : 'long').'"
			style="top:'.$top.'px; left:'.$left.'px; height:'.$height.'px; width:'.$width.'px;"></div>';

		print_nice(array(min($topValues), min($leftValues), $piece->plane));
	}

} ?>
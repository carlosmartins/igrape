<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	class Rectangle {
		/**
		 * Top left X.
		 */
		public $x1;

		/**
		 * Top left Y.
		 */
		public $y1;
		
		/**
		 * Bottom right X.
		 */
		public $x2;
		
		/**
		 * Bottom right Y.
		 */
		public $y2;
	
		/**
		 * Constructor of Rectangle.
		 *
		 * @param x1 Left edge coordinate
		 * @param y1 Upper edge coordinate
		 * @param x2 Right edge coordinate
		 * @param y2 Bottom edge coordinate
		 */
		public function Rectangle($x1, $y1, $x2, $y2) {
			$this->x1 = $x1;
			$this->y1 = $y1;
			$this->x2 = $x2;
			$this->y2 = $y2;
		}
		
		/**
		 * Apply a padding and returns the resulting rectangle.
		 * The result is an enlarged rectangle.
		 *
		 * @return Padded rectangle
		 */
		public function getPaddedRectangle($padding) {
			$rectangle = new Rectangle(
					$this->x1 + $padding->left,
					$this->y1 + $padding->top,
					$this->x2 - $padding->right,
					$this->y2 - $padding->bottom
			);
			
			//echo "(" . $this->x1 . "," . $this->y1 . ") (" . $this->x2 . "," . $this->y2 . ")<br>";
			return $rectangle;
		}
	}
?>
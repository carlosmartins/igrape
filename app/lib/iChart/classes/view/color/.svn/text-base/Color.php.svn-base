<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	class Color {
		private $red;
		private $green;
		private $blue;
		private $alpha;
		private $gdColor;
	
		/**
		 * Creates a new color
		 *
		 * @param integer red [0..255]
		 * @param integer green [0..255]
		 * @param integer blue [0..255]
		 * @param integer alpha [0..255]
		 */
		public function Color($red, $green, $blue, $alpha = 0) {
			$this->red = (int) $red;
			$this->green = (int) $green;
			$this->blue = (int) $blue;
			$this->alpha = (int) round($alpha * 127.0 / 255);
			
			$this->gdColor = null;
		}
		
		/**
		 * Get GD color.
		 *
		 * @param $img GD image resource
		 */
		public function getColor($img) {
			// Checks if color has already been allocated
			if (!$this->gdColor) {
				if ($this->alpha == 0 || !function_exists('imagecolorallocatealpha')) {
					$this->gdColor = imagecolorallocate($img, $this->red, $this->green, $this->blue);
				} else {
					$this->gdColor = imagecolorallocatealpha($img, $this->red, $this->green, $this->blue, $this->alpha);
				}
			}
			
			// Returns GD color
			return $this->gdColor;
		}
		
		/**
		 * Clip a color component in the interval [0..255]
		 *
		 * @param integer Component
		 * @return Clipped component
		 */
		public function clip($component) {
			if ($component < 0) {
				$component = 0;
			} else if ($component > 255) {
				$component = 255;
			}
			
			return $component;
		}
		
		/**
		 * Return a new color, which is a shadow of this one.
		 *
		 * @param double Multiplication factor
		 * @return Shadow color
		 */
		public function getShadowColor($shadowFactor) {
			$red = $this->clip($this->red * $shadowFactor);
			$green = $this->clip($this->green * $shadowFactor);
			$blue = $this->clip($this->blue * $shadowFactor);
			$shadowColor = new Color($red, $green, $blue);
			
			return $shadowColor;
		}
	}
?>
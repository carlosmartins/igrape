<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	class ColorSet {
		public $colorList;
		public $shadowColorList;
	
		/**
		 * ColorSet constructor.
		 *
		 * @param $shadowFactor Shadow factor
		 * @param $colorArray Colors as an array
		 */
		public function ColorSet($colorList, $shadowFactor) {
			$this->colorList = $colorList;
			$this->shadowColorList = array();

			// Generate the shadow color set
			foreach ($colorList as $color) {
				$shadowColor = $color->getShadowColor($shadowFactor);

				array_push($this->shadowColorList, $shadowColor);
			}
		}
		
		/**
		 * Reset the iterator over the collections of colors.
		 */
		public function reset() {
			reset($this->colorList);
			reset($this->shadowColorList);
		}

		/**
		 * Iterate over the colors and shadow colors. When we go after the last one, loop over.
		 *
		 */
		public function next() {
			$value = next($this->colorList);
			next($this->shadowColorList);
			
			// When we go after the last value, loop over.
			if ($value == FALSE) {
				$this->reset();
			}
		}

		/**
		 * Returns the current color.
		 *
		 * @return Current color
		 */
		public function currentColor() {
			return current($this->colorList);
		}

		/**
		 * Returns the current shadow color.
		 *
		 * @return Current shadow color
		 */
		public function currentShadowColor() {
			return current($this->shadowColorList);
		}
	}
?>
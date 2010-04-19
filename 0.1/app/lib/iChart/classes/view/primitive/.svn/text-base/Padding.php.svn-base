<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	
	/**
	 * Primitive geometric object representing a padding. 
	 *
	 * @author Thiago Avelino (thiagoavelinoster@gmail.com)
	 * @Created on 27 july 2008
	 */
	class Padding {
		/**
		 * Top padding.
		 */
		public $top;
		
		/**
		 * Right padding.
		 */
		public $right;
		
		/**
		 * Bottom padding.
		 */
		public $bottom;
	
		/**
		 * Left padding.
		 */
		public $left;

		/**
		 * Creates a new padding.
		 *
		 * @param integer Top padding
		 * @param integer Right padding
		 * @param integer Bottom padding
		 * @param integer Left padding
		 */
		public function Padding($top, $right = null, $bottom = null, $left = null) {
			$this->top = $top;
			if ($right == null) {
				$this->right = $top;
				$this->bottom = $top;
				$this->left = $top;
			} else {
				$this->right = $right;
				$this->bottom = $bottom;
				$this->left = $left;
			}
		}
	}
?>
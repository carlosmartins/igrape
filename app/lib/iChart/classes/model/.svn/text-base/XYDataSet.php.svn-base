<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	class XYDataSet extends DataSet {
		private $pointList;
	
		/**
		 * Constructor of XYDataSet.
		 *
		 */
		public function XYDataSet() {
			$this->pointList = array();
		}
	
		/**
		 * Add a new point to the dataset.
		 *
		 * @param Point Point to add to the dataset
		 */
		
		public function addPoint($point) {
			array_push($this->pointList, $point);
		}

		/**
		 * Getter of pointList.
		 *
		 * @return List of points.
		 */
		public function getPointList() {
			return $this->pointList;
		}
	}
?>
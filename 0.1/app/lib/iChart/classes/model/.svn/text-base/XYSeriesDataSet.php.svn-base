<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	class XYSeriesDataSet extends DataSet {
		/**
		 * List of titles
		 */
		private $titleList;
	
		/**
		 * List of XYDataSet.
		 */
		private $serieList;
		
		/**
		 * Constructor of XYSeriesDataSet.
		 *
		 */
		public function XYSeriesDataSet() {
			$this->titleList = array();
			$this->serieList = array();
		}
	
		/**
		 * Add a new serie to the dataset.
		 *
		 * @param string Title (label) of the serie.
		 * @param XYDataSet Serie of points to add
		 */
		public function addSerie($title, $serie) {
			array_push($this->titleList, $title);
			array_push($this->serieList, $serie);
		}
		
		/**
		 * Getter of titleList.
		 *
		 * @return List of titles.
		 */
		public function getTitleList() {
			return $this->titleList;
		}

		/**
		 * Getter of serieList.
		 *
		 * @return List of series.
		 */
		public function getSerieList() {
			return $this->serieList;
		}
	}
?>
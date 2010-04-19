<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	abstract class Chart {
		/**
		 * The data set.
		 */
		protected $dataSet;
	
		/**
		 * Plot (holds graphical attributes).
		 */
		protected $plot;

		/**
		 * Abstract constructor of Chart.
		 *
		 * @param integer width of the image
		 * @param integer height of the image
		 */
		protected function Chart($width, $height) {
			// Creates the plot
			$this->plot = new Plot($width, $height);
			$this->plot->setTitle("Untitled chart");
			$this->plot->setLogoFileName(dirname(__FILE__) . "/../../../images/PoweredBy.png");
		}

		/**
		 * Checks the data model before rendering the graph.
		 */
		protected function checkDataModel() {
			// Check if a dataset was defined
			if (!$this->dataSet) {
				die("Error: No dataset defined.");
			}
			
			// Maybe no points are defined, but that's ok. This will yield and empty graph with default boundaries.
		}
		
		/**
		 * Create the image.
		 */
		protected function createImage() {
			$this->plot->createImage();
		}

		/**
		 * Sets the data set.
		 *
		 * @param dataSet The data set
		 */
		public function setDataSet($dataSet) {
			$this->dataSet = $dataSet;
		}
		
		/**
		 * Return the plot.
		 *
		 * @return plot
		 */
		public function getPlot() {
			return $this->plot;
		}
		
		/**
		 * Sets the title.
		 *
		 * @param string New title
		 */
		public function setTitle($title) {
			$this->plot->setTitle($title);
		}
	}
?>
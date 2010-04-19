<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	class HorizontalBarChart extends BarChart {
		/**
		 * Ratio of empty space beside the bars.
		 */
		private $emptyToFullRatio;
	
		/**
		 * Creates a new horizontal bar chart.
		 *
		 * @param integer width of the image
		 * @param integer height of the image
		 */
		public function HorizontalBarChart($width = 600, $height = 250) {
			parent::BarChart($width, $height);

			$this->emptyToFullRatio = 1 / 5;
			$this->plot->setGraphPadding(new Padding(5, 30, 30, 50));
		}

		/**
		 * Computes the layout.
		 */
		protected function computeLayout() {
			if ($this->hasSeveralSerie) {
				$this->plot->setHasCaption(true);
			}
			$this->plot->computeLayout();
		}
		
		/**
		 * Print the axis.
		 */
		protected function printAxis() {
			$minValue = $this->axis->getLowerBoundary();
			$maxValue = $this->axis->getUpperBoundary();
			$stepValue = $this->axis->getTics();

			// Get graphical obects
			$img = $this->plot->getImg();
			$palette = $this->plot->getPalette();
			$text = $this->plot->getText();
			
			// Get the graph area
			$graphArea = $this->plot->getGraphArea();

			// Horizontal axis
			for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
				$x = $graphArea->x1 + ($value - $minValue) * ($graphArea->x2 - $graphArea->x1) / ($this->axis->displayDelta);

				imagerectangle($img, $x - 1, $graphArea->y2 + 2, $x, $graphArea->y2 + 3, $palette->axisColor[0]->getColor($img));
				imagerectangle($img, $x - 1, $graphArea->y2, $x, $graphArea->y2 + 1, $palette->axisColor[1]->getColor($img));

				$text->printText($img, $x, $graphArea->y2 + 5, $this->plot->getTextColor(), $value, $text->fontCondensed, $text->HORIZONTAL_CENTER_ALIGN);
			}

			// Get first serie of a list
			$pointList = $this->getFirstSerieOfList();

			// Vertical Axis
			$pointCount = count($pointList);
			reset($pointList);
			$rowHeight = ($graphArea->y2 - $graphArea->y1) / $pointCount;
			reset($pointList);
			for ($i = 0; $i <= $pointCount; $i++) {
				$y = $graphArea->y2 - $i * $rowHeight;

				imagerectangle($img, $graphArea->x1 - 3, $y, $graphArea->x1 - 2, $y + 1, $palette->axisColor[0]->getColor($img));
				imagerectangle($img, $graphArea->x1 - 1, $y, $graphArea->x1, $y + 1, $palette->axisColor[1]->getColor($img));

				if ($i < $pointCount) {
					$point = current($pointList);
					next($pointList);
	
					$label = $point->getX();

					$text->printText($img, $graphArea->x1 - 5, $y - $rowHeight / 2, $this->plot->getTextColor(), $label, $text->fontCondensed, $text->HORIZONTAL_RIGHT_ALIGN | $text->VERTICAL_CENTER_ALIGN);
				}
			}
		}

		/**
		 * Print the bars.
		 */
		protected function printBar() {
			// Get the data as a list of series for consistency
			$serieList = $this->getDataAsSerieList();
			
			// Get graphical obects
			$img = $this->plot->getImg();
			$palette = $this->plot->getPalette();
			$text = $this->plot->getText();

			// Get the graph area
			$graphArea = $this->plot->getGraphArea();

			$minValue = $this->axis->getLowerBoundary();
			$maxValue = $this->axis->getUpperBoundary();
			$stepValue = $this->axis->getTics();
			
			$barColorSet = $palette->barColorSet;
			$barColorSet->reset();

			$serieCount = count($serieList);
			for ($j = 0; $j < $serieCount; $j++) {
				$serie = $serieList[$j];
				$pointList = $serie->getPointList();
				$pointCount = count($pointList);
				reset($pointList);
				
				// Get the next color
				$color = $barColorSet->currentColor();
				$shadowColor = $barColorSet->currentShadowColor();
				$barColorSet->next();

				$rowHeight = ($graphArea->y2 - $graphArea->y1) / $pointCount;
				for ($i = 0; $i < $pointCount; $i++) {
					$y = $graphArea->y2 - $i * $rowHeight;

					$point = current($pointList);
					next($pointList);

					$value = $point->getY();
					
					$xmax = $graphArea->x1 + ($value - $minValue) * ($graphArea->x2 - $graphArea->x1) / ($this->axis->displayDelta);

					// Bar dimensions
					$yWithMargin = $y - $rowHeight * $this->emptyToFullRatio;
					$rowWidthWithMargin = $rowHeight * (1 - $this->emptyToFullRatio * 2);
					$barWidth = $rowWidthWithMargin / $serieCount;
					$barOffset = $barWidth * $j;
					$y1 = $yWithMargin - $barWidth - $barOffset;
					$y2 = $yWithMargin - $barOffset - 1;

					// Text
					$text->printText($img, $xmax + 5, $y2 - $barWidth / 2, $this->plot->getTextColor(), $value, $text->fontCondensed, $text->VERTICAL_CENTER_ALIGN);

					imagefilledrectangle($img, $graphArea->x1 + 1, $y1, $xmax, $y2, $shadowColor->getColor($img));
					
					// Prevents drawing a small box when x = 0
					if ($graphArea->x1 != $xmax) {
						imagefilledrectangle($img, $graphArea->x1 + 2, $y1 + 1, $xmax - 4, $y2, $color->getColor($img));
					}
				}
			}
		}
		
		/**
		 * Renders the caption.
		 */
		protected function printCaption() {
			// Get the list of labels
			$labelList = $this->dataSet->getTitleList();
			
			// Create the caption
			$caption = new Caption();
			$caption->setPlot($this->plot);
			$caption->setLabelList($labelList);
			
			$palette = $this->plot->getPalette();
			$barColorSet = $palette->barColorSet;
			$caption->setColorSet($barColorSet);
			
			// Render the caption
			$caption->render();
		}

		/**
		 * Render the chart image.
		 *
		 * @param string name of the file to render the image to (optional)
		 */
		public function render($fileName = null) {
			// Check the data model
			$this->checkDataModel();
			
			$this->bound->computeBound($this->dataSet);
			$this->computeAxis();
			$this->computeLayout();
			$this->createImage();
			$this->plot->printLogo();
			$this->plot->printTitle();
			if (!$this->isEmptyDataSet(1)) {
				$this->printAxis();
				$this->printBar();
				if ($this->hasSeveralSerie) {
					$this->printCaption();
				}
			}

			$this->plot->render($fileName);
		}
	}
?>
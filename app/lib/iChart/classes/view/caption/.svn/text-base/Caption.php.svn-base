<?php
/**
 * @package iGrape
 * @subpackage iChart
 * 
 * @author Thiago Avelino <thiagoavelinoster@gmail.com>
 *
 */
	class Caption {
		protected $labelBoxWidth;
		protected $labelBoxHeight;
	
		// Plot
		protected $plot;
		
		// Label list
		protected $labelList;
		
		// Color set
		protected $colorSet;
		
		/**
		 * Constructor of Caption
		 */
		public function Caption() {
			$this->labelBoxWidth = 15;
			$this->labelBoxHeight = 15;
		}
		
		/**
		 * Render the caption.
		 */
		public function render() {
			// Get graphical obects
			$img = $this->plot->getImg();
			$palette = $this->plot->getPalette();
			$text = $this->plot->getText();
			$primitive = $this->plot->getPrimitive();
			
			// Get the caption area
			$captionArea = $this->plot->getCaptionArea();

			// Get the pie color set
			$colorSet = $this->colorSet;
			$colorSet->reset();
			
			$i = 0;
			foreach ($this->labelList as $label) {
				// Get the next color
				$color = $colorSet->currentColor();
				$colorSet->next();

				$boxX1 = $captionArea->x1;
				$boxX2 = $boxX1 + $this->labelBoxWidth;
				$boxY1 = $captionArea->y1 + 5 + $i * ($this->labelBoxHeight + 5);
				$boxY2 = $boxY1 + $this->labelBoxHeight;

				$primitive->outlinedBox($boxX1, $boxY1, $boxX2, $boxY2, $palette->axisColor[0], $palette->axisColor[1]);
				imagefilledrectangle($img, $boxX1 + 2, $boxY1 + 2, $boxX2 - 2, $boxY2 - 2, $color->getColor($img));

				$text->printText($img, $boxX2 + 5, $boxY1 + $this->labelBoxHeight / 2, $this->plot->getTextColor(), $label, $text->fontCondensed, $text->VERTICAL_CENTER_ALIGN);

				$i++;
			}
		}

		/**
		 * Sets the plot.
		 *
		 * @param Plot The plot
		 */
		public function setPlot($plot) {
			$this->plot = $plot;
		}
		
		/**
		 * Sets the label list.
		 *
		 * @param Array label list
		 */
		public function setLabelList($labelList) {
			$this->labelList = $labelList;
		}
		
		
		/**
		 * Sets the color set.
		 *
		 * @param Array Color set
		 */
		public function setColorSet($colorSet) {
			$this->colorSet = $colorSet;
		}
	}
?>
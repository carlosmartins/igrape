<?php
class IchartController extends Controller {

    function before() {
        # Load LIB iChart
        if($this->action != 'index'){
            load("iChart/classes/ichart.php");
            header("Content-type: image/png");
        }
	}

	function index() {
        
	}

    function Vertical_Bar(){
        $chart = new VerticalBarChart(500,250);

        $dataSet = new XYDataSet();
        $dataSet->addPoint(new Point("Jan 2009", 4670));
        $dataSet->addPoint(new Point("Feb 2009", 7652));
        $dataSet->addPoint(new Point("March 2009", 4987));
        $dataSet->addPoint(new Point("April 2009", 7669));   
     	$chart->setDataSet($dataSet);

        $chart->setTitle("Test for iChart :: iGrape Framework");
        $chart->render();
    }

    function Horizontal_Bar(){
        $chart = new HorizontalBarChart(500, 250);

        $dataSet = new XYDataSet();
        $dataSet->addPoint(new Point("Jan 2009", 20));
        $dataSet->addPoint(new Point("Feb 2009", 35));
        $dataSet->addPoint(new Point("March 2009", 68));
        $chart->setDataSet($dataSet);

        $chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));
        $chart->setTitle("Test for iChart :: iGrape Framework");
        $chart->render();
    }

    function Pie(){
        $chart = new PieChart(500, 260);

        $dataSet = new XYDataSet();
        $dataSet->addPoint(new Point("Jan 2009", 80));
        $dataSet->addPoint(new Point("Feb 2009", 75));
        $dataSet->addPoint(new Point("March 2009", 50));
        $chart->setDataSet($dataSet);

        $chart->setTitle("Test for iChart :: iGrape Framework");
        $chart->render();
    }

    function Line(){
        $chart = new LineChart();

        $serie1 = new XYDataSet();
        $serie1->addPoint(new Point("09-01", 273));
        $serie1->addPoint(new Point("09-02", 421));
        $serie1->addPoint(new Point("09-03", 642));
        $serie1->addPoint(new Point("09-04", 799));
        $serie1->addPoint(new Point("09-05", 1009));
        $serie1->addPoint(new Point("09-06", 1106));

        $serie2 = new XYDataSet();
        $serie2->addPoint(new Point("09-01", 280));
        $serie2->addPoint(new Point("09-02", 300));
        $serie2->addPoint(new Point("09-03", 212));
        $serie2->addPoint(new Point("09-04", 542));
        $serie2->addPoint(new Point("09-05", 600));
        $serie2->addPoint(new Point("09-06", 850));

        $serie3 = new XYDataSet();
        $serie3->addPoint(new Point("09-01", 180));
        $serie3->addPoint(new Point("09-02", 400));
        $serie3->addPoint(new Point("09-03", 512));
        $serie3->addPoint(new Point("09-04", 642));
        $serie3->addPoint(new Point("09-05", 700));
        $serie3->addPoint(new Point("09-06", 900));

        $serie4 = new XYDataSet();
        $serie4->addPoint(new Point("09-01", 280));
        $serie4->addPoint(new Point("09-02", 500));
        $serie4->addPoint(new Point("09-03", 612));
        $serie4->addPoint(new Point("09-04", 742));
        $serie4->addPoint(new Point("09-05", 800));
        $serie4->addPoint(new Point("09-06", 1000));

        $serie5 = new XYDataSet();
        $serie5->addPoint(new Point("09-01", 380));
        $serie5->addPoint(new Point("09-02", 600));
        $serie5->addPoint(new Point("09-03", 712));
        $serie5->addPoint(new Point("09-04", 842));
        $serie5->addPoint(new Point("09-05", 900));
        $serie5->addPoint(new Point("09-06", 1200));

        $dataSet = new XYSeriesDataSet();
        $dataSet->addSerie("Product 1", $serie1);
        $dataSet->addSerie("Product 2", $serie2);
        $dataSet->addSerie("Product 3", $serie3);
        $dataSet->addSerie("Product 4", $serie4);
        $dataSet->addSerie("Product 5", $serie5);
        $chart->setDataSet($dataSet);

        $chart->setTitle("Test for iChart :: iGrape Framework");
        $chart->getPlot()->setGraphCaptionRatio(0.73);

        $chart->render();
    }

    function Vertical_Bar2(){
        $chart = new VerticalBarChart();

        $serie1 = new XYDataSet();
        $serie1->addPoint(new Point("YT", 64));
        $serie1->addPoint(new Point("NT", 63));
        $serie1->addPoint(new Point("BC", 58));
        $serie1->addPoint(new Point("AB", 58));
        $serie1->addPoint(new Point("SK", 46));

        $serie2 = new XYDataSet();
        $serie2->addPoint(new Point("YT", 61));
        $serie2->addPoint(new Point("NT", 60));
        $serie2->addPoint(new Point("BC", 56));
        $serie2->addPoint(new Point("AB", 57));
        $serie2->addPoint(new Point("SK", 52));

        $serie3 = new XYDataSet();
        $serie3->addPoint(new Point("YT", 68));
        $serie3->addPoint(new Point("NT", 69));
        $serie3->addPoint(new Point("BC", 57));
        $serie3->addPoint(new Point("AB", 51));
        $serie3->addPoint(new Point("SK", 50));

        $serie4 = new XYDataSet();
        $serie4->addPoint(new Point("YT", 78));
        $serie4->addPoint(new Point("NT", 79));
        $serie4->addPoint(new Point("BC", 47));
        $serie4->addPoint(new Point("AB", 21));
        $serie4->addPoint(new Point("SK", 80));

        $dataSet = new XYSeriesDataSet();
        $dataSet->addSerie("Jan 2009", $serie1);
        $dataSet->addSerie("Feb 2009", $serie2);
        $dataSet->addSerie("March 2009", $serie3);
        $dataSet->addSerie("April 2009", $serie4);
        $chart->setDataSet($dataSet);
        $chart->getPlot()->setGraphCaptionRatio(0.65);

        $chart->setTitle("Test for iChart :: iGrape Framework");
        $chart->render();
    }

    function Horizontal_Bar2(){
        $chart = new HorizontalBarChart(450, 250);

        $serie1 = new XYDataSet();
        $serie1->addPoint(new Point("18-24", 22));
        $serie1->addPoint(new Point("25-34", 17));
        $serie1->addPoint(new Point("35-44", 20));
        $serie1->addPoint(new Point("45-54", 25));

        $serie2 = new XYDataSet();
        $serie2->addPoint(new Point("18-24", 13));
        $serie2->addPoint(new Point("25-34", 18));
        $serie2->addPoint(new Point("35-44", 23));
        $serie2->addPoint(new Point("45-54", 22));

        $dataSet = new XYSeriesDataSet();
        $dataSet->addSerie("Jan 2009", $serie1);
        $dataSet->addSerie("Feb 2009", $serie2);
        $chart->setDataSet($dataSet);

        $chart->setTitle("Test for iChart :: iGrape Framework");
        $chart->render();
    }
}
?>
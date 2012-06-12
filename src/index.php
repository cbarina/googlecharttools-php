<?php

/*
 * Copyright 2012 Patrick Strobel.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Examples showing how to create charts with this API
 *
 * @author Patrick Strobel
 * @license http://www.apache.org/licenses/LICENSE-2.0  Apache License, Version 2.0
 * @link http://code.google.com/p/googlecharttools-php
 * @version $Id$
 * @package default
 */


use googlecharttools\model\Cell;
use googlecharttools\model\Column;
use googlecharttools\model\DataTable;
use googlecharttools\model\Row;
use googlecharttools\view\AreaChart;
use googlecharttools\view\BarChart;
use googlecharttools\view\BubbleChart;
use googlecharttools\view\CandlestickChart;
use googlecharttools\view\ColumnChart;
use googlecharttools\view\ComboChart;
use googlecharttools\view\LineChart;
use googlecharttools\view\PieChart;
use googlecharttools\view\ScatterChart;
use googlecharttools\view\SteppedAreaChart;
use googlecharttools\view\ChartManager;
use googlecharttools\view\options\Axis;
use googlecharttools\view\options\BackgroundColor;
use googlecharttools\view\options\Bubble;
use googlecharttools\view\options\ChartArea;
use googlecharttools\view\options\Legend;
use googlecharttools\view\options\Series;
use googlecharttools\view\options\TextStyle;
use googlecharttools\view\options\Tooltip;

error_reporting(E_ALL);
require_once("./googlecharttools/ClassLoader.class.php");
googlecharttools\ClassLoader::register();

// Prepare data
// ------------

// Used for area, bar and column charts
$companyData = new DataTable();
$companyData->addColumn(new Column(Column::TYPE_STRING, "y", "Year"));
$companyData->addColumn(new Column(Column::TYPE_NUMBER, "s", "Sales"));
$companyData->addColumn(new Column(Column::TYPE_NUMBER, "e", "Expenses"));

$row2004 = new Row();
$row2004->addCell(new Cell(2004));
$row2004->addCell(new Cell(1000));
$row2004->addCell(new Cell(400));
$companyData->addRow($row2004);

$row2005 = new Row();
$row2005->addCell(new Cell(2005));
$row2005->addCell(new Cell(1170));
$row2005->addCell(new Cell(460));
$companyData->addRow($row2005);

$row2006 = new Row();
$row2006->addCell(new Cell(2006));
$row2006->addCell(new Cell(660));
$row2006->addCell(new Cell(1120));
$companyData->addRow($row2006);

$row2007 = new Row();
$row2007->addCell(new Cell(2007));
$row2007->addCell(new Cell(1030));
$row2007->addCell(new Cell(540));
$companyData->addRow($row2007);

// Used for bubble chart
$correlationData = new DataTable();
$correlationData->addColumn(new Column(Column::TYPE_STRING, "i", "ID"));
$correlationData->addColumn(new Column(Column::TYPE_NUMBER, "l", "Life Expectancy"));
$correlationData->addColumn(new Column(Column::TYPE_NUMBER, "f", "Fertility Rate"));
$correlationData->addColumn(new Column(Column::TYPE_STRING, "r", "Region"));
$correlationData->addColumn(new Column(Column::TYPE_NUMBER, "p", "Population"));

$rowCan = new Row();
$rowCan->addCell(new Cell("CAN"));
$rowCan->addCell(new Cell(80.66));
$rowCan->addCell(new Cell(1.67));
$rowCan->addCell(new Cell("North America"));
$rowCan->addCell(new Cell(33739900));
$correlationData->addRow($rowCan);

$rowDeu = new Row();
$rowDeu->addCell(new Cell("DEU"));
$rowDeu->addCell(new Cell(79.84));
$rowDeu->addCell(new Cell(1.36));
$rowDeu->addCell(new Cell("Europe"));
$rowDeu->addCell(new Cell(81902307));
$correlationData->addRow($rowDeu);

$rowDnk = new Row();
$rowDnk->addCell(new Cell("DNK"));
$rowDnk->addCell(new Cell(78.6));
$rowDnk->addCell(new Cell(1.84));
$rowDnk->addCell(new Cell("Europe"));
$rowDnk->addCell(new Cell(5523095));
$correlationData->addRow($rowDnk);

$rowEgy = new Row();
$rowEgy->addCell(new Cell("EGY"));
$rowEgy->addCell(new Cell(72.73));
$rowEgy->addCell(new Cell(2.78));
$rowEgy->addCell(new Cell("Middle East"));
$rowEgy->addCell(new Cell(79716203));
$correlationData->addRow($rowEgy);

$rowGbr = new Row();
$rowGbr->addCell(new Cell("GBR"));
$rowGbr->addCell(new Cell(80.5));
$rowGbr->addCell(new Cell(2));
$rowGbr->addCell(new Cell("Europe"));
$rowGbr->addCell(new Cell(61801570));
$correlationData->addRow($rowGbr);

$rowIrn = new Row();
$rowIrn->addCell(new Cell("IRN"));
$rowIrn->addCell(new Cell(72.49));
$rowIrn->addCell(new Cell(1.7));
$rowIrn->addCell(new Cell("Middle East"));
$rowIrn->addCell(new Cell(73137148));
$correlationData->addRow($rowIrn);

$rowIrq = new Row();
$rowIrq->addCell(new Cell("IRQ"));
$rowIrq->addCell(new Cell(68.09));
$rowIrq->addCell(new Cell(4.77));
$rowIrq->addCell(new Cell("Middle East"));
$rowIrq->addCell(new Cell(31090763));
$correlationData->addRow($rowIrq);

$rowIsr = new Row();
$rowIsr->addCell(new Cell("ISR"));
$rowIsr->addCell(new Cell(81.55));
$rowIsr->addCell(new Cell(2.96));
$rowIsr->addCell(new Cell("Middle East"));
$rowIsr->addCell(new Cell(7485600));
$correlationData->addRow($rowIsr);

$rowRus = new Row();
$rowRus->addCell(new Cell("RUS"));
$rowRus->addCell(new Cell(68.6));
$rowRus->addCell(new Cell(1.54));
$rowRus->addCell(new Cell("Europe"));
$rowRus->addCell(new Cell(141850000));
$correlationData->addRow($rowRus);

$rowUsa = new Row();
$rowUsa->addCell(new Cell("USA"));
$rowUsa->addCell(new Cell(78.09));
$rowUsa->addCell(new Cell(2.05));
$rowUsa->addCell(new Cell("North America"));
$rowUsa->addCell(new Cell(307007000));
$correlationData->addRow($rowUsa);

// Used for candlestick chart
$daysData = new DataTable();
$daysData->addColumn(new Column(Column::TYPE_STRING));
$daysData->addColumn(new Column(Column::TYPE_NUMBER));
$daysData->addColumn(new Column(Column::TYPE_NUMBER));
$daysData->addColumn(new Column(Column::TYPE_NUMBER));
$daysData->addColumn(new Column(Column::TYPE_NUMBER));

$rowMon = new Row();
$rowMon->addCell(new Cell("Mon"));
$rowMon->addCell(new Cell(20));
$rowMon->addCell(new Cell(28));
$rowMon->addCell(new Cell(38));
$rowMon->addCell(new Cell(45));
$daysData->addRow($rowMon);

$rowTue = new Row();
$rowTue->addCell(new Cell("Tue"));
$rowTue->addCell(new Cell(31));
$rowTue->addCell(new Cell(38));
$rowTue->addCell(new Cell(55));
$rowTue->addCell(new Cell(66));
$daysData->addRow($rowTue);

$rowWed = new Row();
$rowWed->addCell(new Cell("Wed"));
$rowWed->addCell(new Cell(50));
$rowWed->addCell(new Cell(55));
$rowWed->addCell(new Cell(77));
$rowWed->addCell(new Cell(80));
$daysData->addRow($rowWed);

$rowThu = new Row();
$rowThu->addCell(new Cell("Thu"));
$rowThu->addCell(new Cell(77));
$rowThu->addCell(new Cell(77));
$rowThu->addCell(new Cell(66));
$rowThu->addCell(new Cell(50));
$daysData->addRow($rowThu);

$rowFri = new Row();
$rowFri->addCell(new Cell("Fri"));
$rowFri->addCell(new Cell(68));
$rowFri->addCell(new Cell(66));
$rowFri->addCell(new Cell(22));
$rowFri->addCell(new Cell(15));
$daysData->addRow($rowFri);

// Used for combo chart
$coffeeData = new DataTable();
$coffeeData->addColumn(new Column(Column::TYPE_STRING, "m", "Month"));
$coffeeData->addColumn(new Column(Column::TYPE_NUMBER, "b", "Bolivia"));
$coffeeData->addColumn(new Column(Column::TYPE_NUMBER, "e", "Ecuador"));
$coffeeData->addColumn(new Column(Column::TYPE_NUMBER, "m", "Madagascar"));
$coffeeData->addColumn(new Column(Column::TYPE_NUMBER, "p", "Papua New Guinea"));
$coffeeData->addColumn(new Column(Column::TYPE_NUMBER, "r", "Rwanda"));
$coffeeData->addColumn(new Column(Column::TYPE_NUMBER, "a", "Average"));

$row2004 = new Row();
$row2004->addCell(new Cell("2004/05"));
$row2004->addCell(new Cell(165));
$row2004->addCell(new Cell(938));
$row2004->addCell(new Cell(522));
$row2004->addCell(new Cell(998));
$row2004->addCell(new Cell(450));
$row2004->addCell(new Cell(614.6));
$coffeeData->addRow($row2004);

$row2005 = new Row();
$row2005->addCell(new Cell("2005/06"));
$row2005->addCell(new Cell(135));
$row2005->addCell(new Cell(1120));
$row2005->addCell(new Cell(599));
$row2005->addCell(new Cell(1268));
$row2005->addCell(new Cell(288));
$row2005->addCell(new Cell(682));
$coffeeData->addRow($row2005);

$row2006 = new Row();
$row2006->addCell(new Cell("2006/07"));
$row2006->addCell(new Cell(157));
$row2006->addCell(new Cell(1167));
$row2006->addCell(new Cell(587));
$row2006->addCell(new Cell(807));
$row2006->addCell(new Cell(397));
$row2006->addCell(new Cell(623));
$coffeeData->addRow($row2006);

$row2007 = new Row();
$row2007->addCell(new Cell("2007/08"));
$row2007->addCell(new Cell(139));
$row2007->addCell(new Cell(1110));
$row2007->addCell(new Cell(615));
$row2007->addCell(new Cell(968));
$row2007->addCell(new Cell(215));
$row2007->addCell(new Cell(609.4));
$coffeeData->addRow($row2007);

$row2008 = new Row();
$row2008->addCell(new Cell("2008/09"));
$row2008->addCell(new Cell(136));
$row2008->addCell(new Cell(691));
$row2008->addCell(new Cell(629));
$row2008->addCell(new Cell(1026));
$row2008->addCell(new Cell(366));
$row2008->addCell(new Cell(569.6));
$coffeeData->addRow($row2008);

// Used for pie chart
$activitiesData = new DataTable();
$activitiesData->addColumn(new Column(Column::TYPE_STRING, "t", "Task"));
$activitiesData->addColumn(new Column(Column::TYPE_NUMBER, "h", "Hours per Day"));

$rowWork = new Row();
$rowWork->addCell(new Cell("Work"));
$rowWork->addCell(new Cell(11));
$activitiesData->addRow($rowWork);

$rowEat = new Row();
$rowEat->addCell(new Cell("Eat"));
$rowEat->addCell(new Cell(2));
$activitiesData->addRow($rowEat);

$rowCommute = new Row();
$rowCommute->addCell(new Cell("Commute"));
$rowCommute->addCell(new Cell(2));
$activitiesData->addRow($rowCommute);

$rowWatch = new Row();
$rowWatch->addCell(new Cell("Watch TV"));
$rowWatch->addCell(new Cell(2));
$activitiesData->addRow($rowWatch);

$rowSleep = new Row();
$rowSleep->addCell(new Cell("Sleep"));
$rowSleep->addCell(new Cell(7));
$activitiesData->addRow($rowSleep);

// Used for scatter chart
$weightData = new DataTable();
$weightData->addColumn(new Column(Column::TYPE_NUMBER, "a", "Age"));
$weightData->addColumn(new Column(Column::TYPE_NUMBER, "w", "Weight"));

$row8 = new Row();
$row8->addCell(new Cell(8))->addCell(new Cell(12));
$weightData->addRow($row8);

$row4a = new Row();
$row4a->addCell(new Cell(4))->addCell(new Cell(5.5));
$weightData->addRow($row4a);

$row11 = new Row();
$row11->addCell(new Cell(11))->addCell(new Cell(14));
$weightData->addRow($row11);

$row4b = new Row();
$row4b->addCell(new Cell(4))->addCell(new Cell(5));
$weightData->addRow($row4b);

$row3 = new Row();
$row3->addCell(new Cell(3))->addCell(new Cell(3.5));
$weightData->addRow($row3);

$row6 = new Row();
$row6->addCell(new Cell(6.5))->addCell(new Cell(7));
$weightData->addRow($row6);

// Used for stepped area chart
$ratingData = new DataTable();
$ratingData->addColumn(new Column(Column::TYPE_STRING, "d", "Director (Year)"));
$ratingData->addColumn(new Column(Column::TYPE_NUMBER, "r", "Rotten Tomatoes"));
$ratingData->addColumn(new Column(Column::TYPE_NUMBER, "i", "IMDB"));

$rowHitchcock = new Row();
$rowHitchcock->addCell(new Cell("Alfred Hitchcock (1935)"));
$rowHitchcock->addCell(new Cell(8.4));
$rowHitchcock->addCell(new Cell(7.9));
$ratingData->addRow($rowHitchcock);

$rowThomas = new Row();
$rowThomas->addCell(new Cell("Ralph Thomas (1959)"));
$rowThomas->addCell(new Cell(6.9));
$rowThomas->addCell(new Cell(6.5));
$ratingData->addRow($rowThomas);

$rowSharp = new Row();
$rowSharp->addCell(new Cell("Don Sharp (1978)"));
$rowSharp->addCell(new Cell(6.5));
$rowSharp->addCell(new Cell(6.4));
$ratingData->addRow($rowSharp);

$rowHawes = new Row();
$rowHawes->addCell(new Cell("James Hawes (2008)"));
$rowHawes->addCell(new Cell(4.4));
$rowHawes->addCell(new Cell(6.2));
$ratingData->addRow($rowHawes);

// Prepare charts
// --------------
$manager = new ChartManager();

// Default charts
$companyYearAxis = new Axis("year", new TextStyle("red"));

$areaChart = new AreaChart("companyArea", $companyData);
$areaChart->setTitle("Company Performance");
$areaChart->setHAxis($companyYearAxis);

$barChart = new BarChart("companyBar", $companyData);
$barChart->setTitle("Company Performance");
$barChart->setHAxis($companyYearAxis);

$bubbleChart = new BubbleChart("correlationBubble", $correlationData);
$bubbleChart->setTitle("Correlation between life expectancy, fertility rate and population of some world countries (2010)");
$bubbleChart->setHAxis(new Axis("Life Expectancy"));
$bubbleChart->setVAxis(new Axis("Fertility Rate"));
$bubbleChart->setBubble(new Bubble(null, null, new TextStyle(null, null, 11)));

$candlestickChart = new CandlestickChart("daysCandlestick", $daysData);
$candlestickChart->setLegend(new Legend(Legend::POSITION_NONE));

$columnChart = new ColumnChart("companyColumn", $companyData);
$columnChart->setTitle("Company Performance");
$columnChart->setHAxis($companyYearAxis);

$comboChart = new ComboChart("coffeeCombo", $coffeeData);
$comboChart->setTitle("Monthly Coffee Production by Country");
$comboChart->setHAxis(new Axis("Month"));
$comboChart->setVAxis(new Axis("Cups"));
$comboChart->setSeriesType(ComboChart::SERIES_BARS);
$comboChart->setSeries(array(5 => new Series(Series::TYPE_LINE)));

$lineChart = new LineChart("companyLine", $companyData);
$lineChart->setTitle("Company Performance");

$pieChart = new PieChart("activitiesPie", $activitiesData);
$pieChart->setTitle("My Daily Activities");

$scatterChart = new ScatterChart("weightScatter", $weightData);
$scatterChart->setTitle("Age vs. Weight comparison");
$scatterChart->setHAxis(new Axis("Age", null, 0, 15));
$scatterChart->setVAxis(new Axis("Weight", null, 0, 15));
$scatterChart->setLegend(new Legend(Legend::POSITION_NONE));

$steppedAreaChart = new SteppedAreaChart("ratingSteppedArea", $ratingData);
$steppedAreaChart->setTitle("The decline of 'The 39 Steps'");
$steppedAreaChart->setVAxis(new Axis("Accumulated Rating"));
$steppedAreaChart->setIsStacked(true);

$manager->addChart($areaChart);
$manager->addChart($barChart);
$manager->addChart($bubbleChart);
$manager->addChart($candlestickChart);
$manager->addChart($columnChart);
$manager->addChart($comboChart);
$manager->addChart($lineChart);
$manager->addChart($pieChart);
$manager->addChart($scatterChart);
$manager->addChart($steppedAreaChart);

// Customized chart
$backgroundColor = new BackgroundColor("#666", 10, "lightgrey");
$legend = new Legend(Legend::POSITION_IN, new TextStyle("blue", "arial", 12));
$tooltip = new Tooltip(true, null, new TextStyle("red", "verdana", 12));
$customizedLineChart = new LineChart("companyLineCustomized", $companyData);
$customizedLineChart->setTitle("Company Performance");
$customizedLineChart->setBackgroundColor($backgroundColor);
$customizedLineChart->setFontSize(10);
$customizedLineChart->setFontName("Times new roman");
$customizedLineChart->setColors(array("yellow", "green"));
$customizedLineChart->setLegend($legend);
$customizedLineChart->setReverseCategories(true);
$customizedLineChart->setTooltip($tooltip);
$manager->addChart($customizedLineChart);

?>
<html>
    <head>
        <title>Chart examples</title>
<?php echo $manager->getHtmlHeaderCode(); ?>
    </head>
    <body>
        <h1>Chart examples</h1>
        <h2>Area chart</h2>
<?php echo $areaChart->getHtmlContainer(); ?>

        <h2>Bar chart</h2>
<?php echo $barChart->getHtmlContainer(); ?>

        <h2>Bubble chart</h2>
<?php echo $bubbleChart->getHtmlContainer(); ?>

        <h2>Candlestick chart</h2>
<?php echo $candlestickChart->getHtmlContainer(); ?>

        <h2>Column chart</h2>
<?php echo $columnChart->getHtmlContainer(); ?>

        <h2>Combo chart</h2>
<?php echo $comboChart->getHtmlContainer(); ?>

        <h2>Line chart</h2>
<?php echo $lineChart->getHtmlContainer(); ?>

        <h2>Pie chart</h2>
<?php echo $pieChart->getHtmlContainer(); ?>

        <h2>Scatter chart</h2>
<?php echo $scatterChart->getHtmlContainer(); ?>

        <h2>Stepped area chart</h2>
<?php echo $steppedAreaChart->getHtmlContainer(); ?>

        <h2>Customized line chart</h2>
<?php echo $customizedLineChart->getHtmlContainer(); ?>
    </body>
</html>

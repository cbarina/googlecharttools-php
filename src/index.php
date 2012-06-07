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
use googlecharttools\view\LineChart;
use googlecharttools\view\ChartManager;
use googlecharttools\view\options\BackgroundColor;
use googlecharttools\view\options\ChartArea;
use googlecharttools\view\options\Legend;
use googlecharttools\view\options\TextStyle;
use googlecharttools\view\options\Tooltip;

error_reporting(E_ALL);
require_once("./googlecharttools/ClassLoader.class.php");
googlecharttools\ClassLoader::register();


// Used for area and bar charts
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

$manager = new ChartManager();

// Default charts
$areaChart = new AreaChart("companyArea", $companyData, "Company Performance");
$manager->addChart($areaChart);

// Customized chart
$backgroundColor = new BackgroundColor("#666", 10, "lightgrey");
$legend = new Legend(Legend::POSITION_IN, new TextStyle("blue", "arial", 12));
$tooltip = new Tooltip(true, null, new TextStyle("red", "verdana", 12));
$customizedLineChart = new LineChart("companyLine", $companyData, "Company Performance");
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

        <h2>Customized line chart</h2>
<?php echo $customizedLineChart->getHtmlContainer(); ?>
    </body>
</html>

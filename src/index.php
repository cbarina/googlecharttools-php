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
 * @version 0.1.0
 * @package default
 */


use googlecharttools\model\Cell;
use googlecharttools\model\Column;
use googlecharttools\model\DataTable;
use googlecharttools\model\Row;
use googlecharttools\view\AreaChart;
use googlecharttools\view\LineChart;
use googlecharttools\view\ChartManager;

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
$areaChart = new AreaChart("companyArea");
$areaChart->setData($companyData);
$manager->addChart($areaChart);

$lineChart = new LineChart("companyLine");
$lineChart->setData($companyData);
$manager->addChart($lineChart);

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

        <h2>Line chart</h2>
<?php echo $lineChart->getHtmlContainer(); ?>
    </body>
</html>

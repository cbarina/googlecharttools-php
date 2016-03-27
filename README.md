# GoogleChartTools-PHP
Automatically exported from code.google.com/p/googlecharttools-php

Ported because I wanted to fork/document what I've done with this...Happy to relinquish ownership back to original creator if they want it (may be abandoned as it was last updated in 2012).

GoogleChartTools-PHP provides an easy-to-use wrapper for Google Chart Tools.
It is designed to create charts based on Google Chart Tools in PHP5 fast and without writing JavaScript code by hand. All required JavaScript code is generated by this API automatically. However, additional JavaScript code can be added manually to customize the charts.

## Example ##
This chart can be generated with the code below. You will find more examples in the [example script file](https://googlecharttools-php.googlecode.com/hg-history/v0.1/src/index.php).

![http://wiki.googlecharttools-php.googlecode.com/hg/images/piechart_example.png](http://wiki.googlecharttools-php.googlecode.com/hg/images/piechart_example.png)

### Prepare data and chart ###
```
$activitiesData = new DataTable();
$activitiesData->addColumn(new Column(Column::TYPE_STRING, "t", "Task"));
$activitiesData->addColumn(new Column(Column::TYPE_NUMBER, "h", "Hours per Day"));

$rowWork = new Row();
$rowWork->addCell(new Cell("Work"))->addCell(new Cell(11));;
$activitiesData->addRow($rowWork);

$rowEat = new Row();
$rowEat->addCell(new Cell("Eat"))->addCell(new Cell(2));
$activitiesData->addRow($rowEat);

$rowCommute = new Row();
$rowCommute->addCell(new Cell("Commute"))->addCell(new Cell(2));
$activitiesData->addRow($rowCommute);

$rowWatch = new Row();
$rowWatch->addCell(new Cell("Watch TV"))->addCell(new Cell(2));
$activitiesData->addRow($rowWatch);

$rowSleep = new Row();
$rowSleep->addCell(new Cell("Sleep"))->addCell(new Cell(7));
$activitiesData->addRow($rowSleep);

$pieChart = new PieChart("activitiesPie", $activitiesData);
$pieChart->setTitle("My Daily Activities");

$manager = new ChartManager();
$manager->addChart($pieChart);
```

### Add Chart to the HTML-Page ###
```
<html>
    <head>
        <title>My Charts</title>
<?php echo $manager->getHtmlHeaderCode(); ?>
    </head>
    <body>
        <h1>My Charts</h1>
<?php echo $pieChart->getHtmlContainer(); ?>
    </body>
</html>
```
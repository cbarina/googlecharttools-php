# Data and DataTable #

All data visualized in a chart is stored in a [DataTable](https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/model/DataTable.html), which is the PHP representation of the DataTable used by Google's JavaScript API. The `DataTable` can be seen as a table having a header-row and one or more data-rows. The header-row defines which data-types can be inserted in each column and the columns' IDs, names and properties. The data is then inserted into the data-rows.

Google Chart Tools defines different formats of the `DataTable`, depending on the chart it is used for. For example if the `DataTable` is used for a cartesian-chart (like area-, line-, scatter-charts), the `DataTable` has to have at least two columns, where the data in the first column is used for the data-point's x-values and the data in the other columns as y-values (whereas the data-points are grouped together by the y-values-column).

Please visit Google's [Chart Gallery](https://google-developers.appspot.com/chart/interactive/docs/gallery) for the actual format of the `DataTable` for your desired chart-type.

In this API, all classes needed to prepare the charts data and to generate/fill the DataTable are located in the `googlecharttools\model` package.


## Column definition ##

After you have instantiated the `DataTable`, you have to define each column. To do so, create a definition column by calling the constructor of the [Column](https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/model/Column.html) class and pass the created instance to the `DataTable`'s `addColumn()`-method. The `Column`s constructor requires at least one $type-parameter, through which the data-type that will be inserted into this column by the data-rows is set. Mostly the charts accept only a few data-types in a column (e. g. in cartesian-chart, the y-values typically have to be numbers or dates/datetimes).


## Adding data ##

Now that the columns are defined, the actual data can be added to the `DataTable`. This is done by the `DataTable`'s `addRow()`-method. The `addRow()`-method accepts an instance of the [Row](https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/model/Row.html)-class, that represents a single data-row. To each `Row`, [Cells](https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/model/Cell.html) are added which stores the `Row`'s data and (optional) options and properties. The mapping between `Column`s and `Cell`s is done by the order they are added to the `DataTable` and `Row`, respectively (so the first `Cell` added to the `Row` has to have the type defined by the first `Column` added to the `DataTable` and so on).


## Example ##

Assume we want to create the chart shown on the [pie chart's gallery-page](https://google-developers.appspot.com/chart/interactive/docs/gallery/piechart). To do so, we need a DataTable having the following format and content:

| **Name: Task**<br>Type: string<table><thead><th> <b>Name: Hours per Day</b><br>Type: Number</th></thead><tbody>
<tr><td>        Work                   </td><td>              11                           </td></tr>
<tr><td>        Eat                    </td><td>              2                            </td></tr>
<tr><td>        Commute                </td><td>              2                            </td></tr>
<tr><td>        Watch TV               </td><td>              2                            </td></tr>
<tr><td>        Sleep                  </td><td>              7                            </td></tr></tbody></table>

Our <code>DataTable</code> has two columns: The first (named "Task") stores string-data, the second (named "Hours per Day") stores number-data:<br>
<br>
<pre><code>$activitiesData = new DataTable();<br>
$activitiesData-&gt;addColumn(new Column(Column::TYPE_STRING, "t", "Task"));<br>
$activitiesData-&gt;addColumn(new Column(Column::TYPE_NUMBER, "h", "Hours per Day"));<br>
</code></pre>

After the columns have been defined, the data can be added:<br>
<br>
<pre><code>$rowWork = new Row();<br>
$rowWork-&gt;addCell(new Cell("Work"))-&gt;addCell(new Cell(11));;<br>
$activitiesData-&gt;addRow($rowWork);<br>
<br>
$rowEat = new Row();<br>
$rowEat-&gt;addCell(new Cell("Eat"))-&gt;addCell(new Cell(2));<br>
$activitiesData-&gt;addRow($rowEat);<br>
<br>
$rowCommute = new Row();<br>
$rowCommute-&gt;addCell(new Cell("Commute"))-&gt;addCell(new Cell(2));<br>
$activitiesData-&gt;addRow($rowCommute);<br>
<br>
$rowWatch = new Row();<br>
$rowWatch-&gt;addCell(new Cell("Watch TV"))-&gt;addCell(new Cell(2));<br>
$activitiesData-&gt;addRow($rowWatch);<br>
<br>
$rowSleep = new Row();<br>
$rowSleep-&gt;addCell(new Cell("Sleep"))-&gt;addCell(new Cell(7));<br>
$activitiesData-&gt;addRow($rowSleep);<br>
</code></pre>

As you might have seen, the <code>addCell()</code>-methods can be concatenated, as this method will always return a reference to the <code>Row</code>-object it belongs to.<br>
<br>
(I have omitted the PHP-<code>use</code>-statements to keep the example short).<br>
<br>
<h1>Creating the chart</h1>

After the data has been added to a <code>DataTable</code>, the chart can be created. GoogleChartTools-PHP provides a separate class for each chart introduced at Google's <a href='https://google-developers.appspot.com/chart/interactive/docs/gallery'>Chart Gallery</a>. All these chart-classes are located in the <code>googlecharttools\view</code> package and extends the abstract class "<a href='https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/view/Chart.html'>Chart</a>".<br>
<br>
To instantiate a object of the desired chart-type, you have to pass a identifier to the chart class' constructor. This identifier will be used later in the generated JavaScript-code as part of several identifiers. Therefore, every ID passed to a chart-object has to be a valid JavaScript identifier. That is, no white-spaces are allowed and the ID's first character has to be a letter. I recommend to use the characters A-Z and a-z only to avoid running into problems.<br>
<br>
Before the JavaScript-code can be generated, the data (the <code>DataTable</code>) has to be passed to the chart (if this is not done, a <a href='https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/exceptions/CodeGenerationException.html'>CodeGenerationException</a> will be thrown when you try to generate the JavaScript code). This can be done through the <code>Chart</code>s constructor's second parameter or via the <code>setData()</code>-method.<br>
<br>
All charts come with various set-methods through which the chart's appearance and behaviour can be customized (like setting a title with <code>setTitle()</code>). You will find more information about the supported options for the specific chart in the <a href='https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/index.html'>API-documentation</a> or at the chart's subpage at Google's <a href='https://google-developers.appspot.com/chart/interactive/docs/gallery'>Chart Gallery</a>.<br>
<br>
<br>
<h2>Example</h2>

To continue with our pie chart-example from the <a href='https://google-developers.appspot.com/chart/interactive/docs/gallery/piechart'>gallery</a>, we now want to create the chart itself for our prepared <code>DataTable</code>.<br>
<br>
<pre><code>$pieChart = new PieChart("activitiesPie", $activitiesData);<br>
$pieChart-&gt;setTitle("My Daily Activities");<br>
</code></pre>

As you can see, the chart's ID is "activitiesPie" and a title has been assigned to it.<br>
<br>
(I have omitted the PHP-<code>use</code>-statement again to keep the example short).<br>
<br>
<br>
<h1>Integrating the chart into the page</h1>

The last step to do in order to get our chart displayed, is to add it to the PHP-scripts HTML-output. To do this, Google Chart Tools requires two things: First of all, the external JavaScript-API has to be included into the page's header-element and the charts have to be prepared in  the header (in a JavaScript script-element), too. Afterwards a div-container has to be added inside the pages-body where the chart will be displayed in.<br>
<br>
All code that has to be inserted into the HTML-header is generated by the <a href='https://googlecharttools-php.googlecode.com/svn/trunk/docs/api/view/ChartManager.html'>ChartManager</a>. To do so, the <code>ChartManager</code> has to know each chart that should be displayed on the page. Thus, every chart that will be displayed later on has to be added to the <code>ChartManager</code> through the <code>addChart()</code>-method.<br>
<br>
After all charts have been added to the <code>ChartManager</code>, all required code for the HTML-header is generated by calling the <code>ChartManager</code>s <code>	getHtmlHeaderCode()</code>-method.<br>
<br>
There is nothing more you have to do inside the page's header-element. The last thing to do is to insert the div-container in the HTML-body where you want the chart to be displayed. For this purpose, all charts have the method <code>getHtmlContainer()</code> that returnes this container (with the ID and size set to the chart's properties).<br>
<br>
<br>
<h2>Example</h2>

After we have prepared our pie chart's data and the chart itself in the sections above, it can now be inserted into the HTML output:<br>
<br>
<pre><code>&lt;html&gt;<br>
    &lt;head&gt;<br>
        &lt;title&gt;Page with some charts&lt;/title&gt;<br>
<br>
        &lt;!-- Add the generated JavaScript to the page-header --&gt;<br>
        &lt;?php echo $manager-&gt;getHtmlHeaderCode(); ?&gt;<br>
<br>
    &lt;/head&gt;<br>
    &lt;body&gt;<br>
        &lt;h1&gt;My page with some charts&lt;/h1&gt;<br>
<br>
        &lt;!-- Add the div-container the chart will be displayed in --&gt;<br>
        &lt;?php echo $pieChart-&gt;getHtmlContainer(); ?&gt;<br>
<br>
    &lt;/body&gt;<br>
&lt;/html&gt;<br>
</code></pre>
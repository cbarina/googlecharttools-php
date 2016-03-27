# Requirements #

GoogleChartTools-PHP requires PHP 5.3 or newer, since the API uses features (like namespaces) that have been introduced in PHP 5.3.

# Installation #
To install GoogleChartTools-PHP, download the latest ZIP-archive from the downloads-section (or checkout the source-files from the svn-repository).

The archive contains two elements in its root directory:

  * Folder "googlecharttools"
  * File "index.php"

The folder "googlecharttools" contains all files (and classes) that are required by the API and hence needs to be copied onto your web-server or into your working directory (for example, in a "lib" subdirectory). The file "index.php" contains example charts only, so it mustn't be copied, too.

After you have copied the directory, the next step is to include the API's PHP-files into every script-file that uses charts. To avoid manual inclusion of every single class-file, the API comes with a class-loader. This class-loader load's every PHP-file that contains a class automatically upon the first new-statement. Therefore, only the class-loader has to be included into your PHP-files by hand:

```
// If the "googlecharttools" folder is in the same directory as this PHP-file
require_once("./googlecharttools/ClassLoader.class.php");
```
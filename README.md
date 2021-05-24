# php-read-write-data-to-excel

It is a very simple and straightforward implementation of readin and writing data to excel files. In this project I am using [PhpSpreadsheet Lib](https://github.com/PHPOffice/PhpSpreadsheet).
In the import.php file, you have to update the following line to your excel file and the visit the url ```/import.php```

```
if ( $xlsx = SimpleXLSX::parse('filename.xlsx') )

```

and it will read the data from the excel file and store it in mysql database. You have to create your own database/tables as per your excel file format/columns.

In the ```match-duplicates.php``` file, I am handling my business logic and then writing the data back to the excel file.
Following code writes the data and saves the excel file.

```

$spreadsheet->setActiveSheetIndex(0)->setCellValue("A1", "Value");
$writer->save("filename.xlsx");

```

Happy Coding!

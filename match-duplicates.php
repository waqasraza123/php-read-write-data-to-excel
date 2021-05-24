<?php
use Phppot\DataSource;
use Phppot\MatchWith;

require_once 'DataSource.php';
require_once 'handle-form-data.php';
require_once 'SimpleXLSX.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$db = new DataSource();
$matchWith = new MatchWith();
$conn = $db->getConnection();

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("Duplicate_users_test-with.xlsx");
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

if ( $xlsx = SimpleXLSX::parse('Duplicate_users_test-with.xlsx') ) {

    $i = 0;

    foreach ($xlsx->rows() as $column) {

        if($i > 0){
            $email = "";
            if (isset($column[0])) {
                $email = $column[0];
            }
            $lastName = "";
            if (isset($column[1])) {
                $lastName = $db->getPlainString($column[1]);
            }
            $firstName = "";
            if (isset($column[2])) {
                $firstName = $db->getPlainString($column[2]);
            }
            $dob = "";
            if (isset($column[3])) {
                $dob = $column[3];
            }
            $postalCode = "";
            if (isset($column[4])) {
                $postalCode = $db->getPostalCode($column[4]);
            }

            $j = $i+1;
            $rowIndex = "F$j";

            echo $rowIndex . '<br>';

            $matchWith->userExists($email, $firstName, $lastName, $dob, $postalCode, $rowIndex, $spreadsheet);

        }

        //increment to next row in excel file
        $i++;
    }
    $writer->save("Updated_Duplicate_users_test-with.xlsx");

} else {
    echo SimpleXLSX::parseError();
}

?>
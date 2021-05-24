<?php
use Phppot\DataSource;

require_once 'DataSource.php';
require_once 'SimpleXLSX.php';
$db = new DataSource();
$conn = $db->getConnection();
if ( $xlsx = SimpleXLSX::parse('Duplicate_users_test-against.xlsx') ) {

    $i = 0;

    foreach ($xlsx->rows() as $column) {

        if($i > 0){
            $email = "";
            if (isset($column[0])) {
                $email = mysqli_real_escape_string($conn, $column[0]);
            }
            $lastName = "";
            if (isset($column[1])) {
                $lastName = mysqli_real_escape_string($conn, $db->getPlainString($column[1]));
            }
            $firstName = "";
            if (isset($column[2])) {
                $firstName = mysqli_real_escape_string($conn, $db->getPlainString($column[2]));
            }
            $dob = "";
            if (isset($column[3])) {
                $dob = (mysqli_real_escape_string($conn, $column[3]));
            }
            $postalCode = "";
            if (isset($column[4])) {
                $postalCode = mysqli_real_escape_string($conn, $db->getPostalCode($column[4]));
            }


            $sqlInsert = "INSERT into users (email, f_name, l_name, dob, postal_code)
                   values (?,?,?,?,?)";
            $paramType = "sssss";
            $paramArray = array(
                $email,
                $firstName,
                $lastName,
                $dob,
                $postalCode
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

            if (! empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }

        $i++;
    }

    echo $message;

} else {
    echo SimpleXLSX::parseError();
}

?>
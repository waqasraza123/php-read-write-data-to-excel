<?php

namespace Phppot;
use Phppot\DataSource;

require_once 'DataSource.php';


Class MatchWith{

    private $db;
    private $conn;
    private $spreadsheet;
    private $writer;

    public function __construct(){

        $this->db = new DataSource();
        $this->conn = $this->db->getConnection();
    }


    public function userExists($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet){

        $db = $this->db;
        $conn = $this->conn;

        $email = mysqli_real_escape_string($conn, $email);

        $sql = "SELECT email FROM users where email = '$email' OR email_2 = '$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($rowIndex, "User caught with Email");

            echo 'user email found.';

        } else {

            //go to next check
            $this->dob_last_first_n($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet);
        }
    }

    /**
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $dob
     * @param $postal_code
     * @param $rowIndex
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function dob_last_first_n($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet){

        $db = $this->db;
        $conn = $this->conn;

        $sql = "SELECT * FROM users WHERE dob = '$dob' AND l_name = '$lastName' AND f_name = '$firstName'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE users SET dob_last_first_n = dob_last_first_n + 1 WHERE dob = '$dob' AND l_name = '$lastName' AND f_name = '$firstName' ";

            if ($conn->query($sql) === TRUE) {

                $sql = "SELECT * FROM users WHERE dob = '$dob' AND l_name = '$lastName' AND f_name = '$firstName' LIMIT 1";

                if ($result = $conn -> query($sql)) {

                    while ($obj = $result->fetch_object()) {
                        $obj->dob_last_first_n;
                        echo 'user exists for combination dob_last_first_n. <br> Tried '.$obj->dob_last_first_n. ' Times ';
                        echo $rowIndex;
                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue($rowIndex, "User caught with combination dob_last_first_name");

                    }
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }

        } else {
            //go to next check
            $this->dob_first_postal($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet);
        }
    }

    /**
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $dob
     * @param $postal_code
     * @param $db
     * @param $conn
     */
    public function dob_first_postal($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet){

        $db = $this->db;
        $conn = $this->conn;

        $sql = "SELECT * FROM users where dob = '$dob' AND f_name = '$firstName' AND postal_code = '$postal_code'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE users SET dob_first_postal=dob_first_postal+1 where dob = '$dob' AND f_name = '$firstName' AND postal_code = '$postal_code'";

            if ($conn->query($sql) === TRUE) {

                $sql = "SELECT * FROM users WHERE dob = '$dob' AND f_name = '$firstName' AND postal_code = '$postal_code' LIMIT 1";

                if ($result = $conn -> query($sql)) {

                    while ($obj = $result->fetch_object()) {

                        echo 'user exists for combination dob_first_postal. <br> Tried '.$obj->dob_first_postal. ' Times';

                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue($rowIndex, "User caught with combination dob_first_postal");
                    }
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }

        } else {
            //go to next check
            $this->dob_last_postal($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet);
        }
    }


    public function dob_last_postal($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet){

        $db = $this->db;
        $conn = $this->conn;

        $sql = "SELECT * FROM users where dob = '$dob' AND l_name = '$lastName' AND postal_code = '$postal_code'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $sql = "UPDATE users SET dob_last_postal=dob_last_postal+1 where dob = '$dob' AND l_name = '$lastName' AND postal_code = '$postal_code'";

            if ($conn->query($sql) === TRUE) {

                $sql = "SELECT * FROM users WHERE dob = '$dob' AND l_name = '$lastName' AND postal_code = '$postal_code' LIMIT 1";

                if ($result = $conn -> query($sql)) {

                    while ($obj = $result->fetch_object()) {

                        echo 'user exists for combination dob_last_postal. <br> Tried '.$obj->dob_last_postal. ' Times';

                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue($rowIndex, "User caught with combination dob_last_postal");

                    }
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }

        } else {

            //go to next check
            $this->dob_first_last_postal($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet);
        }

    }


    public function dob_first_last_postal($email, $firstName, $lastName, $dob, $postal_code, $rowIndex, $spreadsheet){

        $db = $this->db;
        $conn = $this->conn;

        $sql = "SELECT * FROM users where dob = '$dob' AND f_name = '$firstName' AND l_name = '$lastName' AND postal_code = '$postal_code'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {


            $sql = "UPDATE users SET dob_first_last_postal=dob_first_last_postal+1 where dob = '$dob' AND f_name = '$firstName' AND l_name = '$lastName' AND postal_code = '$postal_code'";

            if ($conn->query($sql) === TRUE) {

                $sql = "SELECT * FROM users WHERE dob = '$dob' AND f_name = '$firstName' AND l_name = '$lastName' AND postal_code = '$postal_code' LIMIT 1";

                if ($result = $conn -> query($sql)) {

                    while ($obj = $result->fetch_object()) {

                        echo 'user exists for combination dob_first_last_postal. <br> Tried '.$obj->dob_first_last_postal. ' Times';

                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue($rowIndex, "User caught with combination dob_first_last_postal");
                    }
                }

            } else {
                echo "Error updating record: " . $conn->error;
            }

        } else {
            echo "Could not find user for all combinations";
        }
    }
}
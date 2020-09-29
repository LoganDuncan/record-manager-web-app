<?php // Advanced Search Logic

require_once __DIR__ . "/../db/mysqli_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];
$db_value= 0;
$yes = '';
$no = '';
$degree_program = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql_data = [];

    $first = (!empty($_POST['first'])) ? $db->real_escape_string($_POST['first']) : '';
    (!empty($first)) ? array_push($sql_data, "first_name LIKE '%$first%' ") : null;

    $last = (!empty($_POST['last'])) ? $db->real_escape_string($_POST['last']) : '';
    (!empty($last)) ? array_push($sql_data, "last_name LIKE '%$last%' ") : null;

    $sid = (!empty($_POST['student_id'])) ? $db->real_escape_string($_POST['sid']) : '';
    (!empty($sid)) ? array_push($sql_data, "student_id LIKE '%$sid%' ") : null;

    $email = (!empty($_POST['email'])) ? $db->real_escape_string($_POST['email']) : '';
    (!empty($email)) ? array_push($sql_data, "email LIKE '%$email%' ") : null;

    $phone = (!empty($_POST['phone'])) ? $db->real_escape_string($_POST['phone']) : '';
    (!empty($phone)) ? array_push($sql_data, "phone LIKE '%$phone%' ") : null;

    $gpa = (!empty($_POST['gpa'])) ? $db->real_escape_string($_POST['gpa']) : '';
    (!empty($gpa)) ? array_push($sql_data, "gpa LIKE '%$gpa%' ") : null;

    $graduation_date = (!empty($_POST['graduation_date'])) ? $db->real_escape_string($_POST['graduation_date']) : '';
    (!empty($graduation_date)) ? array_push($sql_data, "graduation_date LIKE '%$graduation_date%' ") : null;

    $degree_program = (!empty($_POST['degree_program'])) ? $db->real_escape_string($_POST['degree_program']) : '';
    array_push($sql_data, "degree_program = '$degree_program'");

    if (isset($_POST['financial_aid'])) {
        if ($_POST['financial_aid'] == "yes") {
            array_push($sql_data, "financial_aid = 1 ");
            $db_value = 1;
            $yes = 'checked';
        } else {
            array_push($sql_data, "financial_aid = 0 ");
            $db_value = 0;
            $no = 'checked';
        }
    }

    $sql = "SELECT * FROM $db_table WHERE " . implode(" and ", $sql_data);

}
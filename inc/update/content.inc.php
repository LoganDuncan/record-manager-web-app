<?php // Filename: connect.inc.php

require_once __DIR__ . "/../db/mysqli_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";
// require_once __DIR__ . "/../functions/functions.inc.php";

$error_bucket = [];
$db_value= 0;
$yes = '';
$no = '';
$degree_program = '';

// http://php.net/manual/en/mysqli.real-escape-string.php

if($_SERVER['REQUEST_METHOD']=="POST"){
    // grab primary key from hidden field
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    }
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        $first = $db->real_escape_string(strip_tags($_POST['first']));
    }
    if (empty($_POST['last'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        $last = $db->real_escape_string(strip_tags($_POST['last']));
    }
    if (empty($_POST['student_id'])) {
        array_push($error_bucket,"<p>A student ID is required.</p>");
    } else {
        $sid = $db->real_escape_string(strip_tags($_POST['student_id']));
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }
    if (empty($_POST['phone'])) {
        array_push($error_bucket,"<p>A phone number is required.</p>");
    } else {
        $phone = $db->real_escape_string(strip_tags($_POST['phone']));
    }
    if (empty($_POST['gpa'])) {
        array_push($error_bucket,"<p>A GPA must be entered.</p>");
    } else {
        $gpa = $db->real_escape_string($_POST['gpa']);
    }
    // Check Radio Button value yes or no
    if ($_POST['financial_aid'] == 'yes') {
        $yes = 'checked';
        $db_value = 1;
        
    } elseif ($_POST['financial_aid'] == 'no') {
        $no = 'checked';
        $db_value = 0;
    } // Sets $degree_program to selected value to maintain stickyness
    if (isset($_POST['degree_program'])) { 
        $degree_program = $_POST['degree_program'];
    }

    if (isset($_POST['graduation_date'])) {
        $graduation_date = $_POST['graduation_date'];
    } else {
        $graduation_date = '';
    }

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "UPDATE $db_table SET first_name='$first', last_name='$last', student_id=$sid, email='$email',phone='$phone',gpa='$gpa',financial_aid='$db_value',degree_program='$degree_program', graduation_date='$graduation_date' WHERE id=$id";

        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            // header() is a built-in php function that changes the url immediately!
             header ('Location: display-records.php?message=The record has been updated');
             }
    } else {
        display_error_bucket($error_bucket);
    } // end of error bucket
} else {
    // check for record id (primary key)
    $id = $_GET['id'];
    // now we need to query the database and get the data for the record
    // note limit 1
    $sql = "SELECT * FROM $db_table WHERE id=$id LIMIT 1";
    // query database
    $result = $db->query($sql);
    // get the one row of data
    while($row = $result->fetch_assoc()) {
        $first = $row['first_name'];
        $last = $row['last_name'];
        $sid = $row['student_id'];
        $email = $row['email'];
        $phone = $row['phone'];
        $gpa = $row['gpa'];
        $degree_program = $row['degree_program'];
        if ($db_value == 1) {
            $db_value = $row['financial_aid'];
            $yes = 'checked';
        }
        elseif ($db_value == 0) {
            $db_value = $row['financial_aid'];
            $no = 'checked';
        }
        $graduation_date = $row['graduation_date'];
    }
}
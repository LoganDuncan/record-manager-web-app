<?php // Filename: connect.inc.php

require_once __DIR__ . "/../db/mysqli_connect.inc.php";
// require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

// Sets an empty arrary for errors, and sets a boolean value to a variable and defines yes and no vairable for radio
$error_bucket = [];
$db_value= 0;
$yes = '';
$no = '';
$degree_program = '';

// http://php.net/manual/en/mysqli.real-escape-string.php

if($_SERVER['REQUEST_METHOD']=="POST"){
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        # Old way
        #$first = $_POST['first'];
        # New way
        $first = $db->real_escape_string(strip_tags($_POST['first']));
    }
    if (empty($_POST['last'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        #$last = $_POST['last'];
        $last = $db->real_escape_string(strip_tags($_POST['last']));
    }
    if (empty($_POST['student_id'])) {
        array_push($error_bucket,"<p>A student ID is required.</p>");
    } else {
        #$id = $_POST['id'];
        $sid = $db->real_escape_string(strip_tags($_POST['student_id']));
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        #$email = $_POST['email'];
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }
    if (empty($_POST['phone'])) {
        array_push($error_bucket,"<p>A phone number is required.</p>");
    } else {
        #$phone = $_POST['phone'];
        $phone = $db->real_escape_string(strip_tags($_POST['phone']));
    }
    if (empty($_POST['gpa'])) {
        array_push($error_bucket,"<p>A GPA must be entered.</p>");
    } else {
        $gpa = $db->real_escape_string(strip_tags($_POST['gpa']));
    }
    // Check Radio Button value yes or no
    if (!empty($_POST['financial_aid'])) {
    if ($_POST['financial_aid'] == 'yes') {
        $yes = 'checked';
        $db_value = 1;
        
    } elseif ($_POST['financial_aid'] == 'no') {
        $no = 'checked';
        $db_value = 0;
    }
    } // Sets $degree_program to selected value to maintain stickyness
    if (isset($_POST['degree_program'])) { 
        $degree_program = $_POST['degree_program'];
    }
    if (!empty($_POST['graduation_date'])) {
        $graduation_date = $db->real_escape_string(strip_tags($_POST['graduation_date']));
    } else {
        $graduation_date = '';
    }

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "INSERT INTO $db_table (first_name,last_name,student_id,email,phone,gpa,financial_aid,degree_program,graduation_date) ";
        $sql .= "VALUES ('$first','$last',$sid,'$email','$phone','$gpa','$db_value','$degree_program','$graduation_date')";

        // comment in for debug of SQL
        // echo $sql;

        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            I saved that new record for you!
          </div>';
            unset($first);
            unset($last);
            unset($sid);
            unset($email);
            unset($phone);
            unset($gpa);
            unset($gradutaion_date);
        }
    } else {
        display_error_bucket($error_bucket);
    }
}

?>

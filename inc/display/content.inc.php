<?php // Filename: connect.inc.php

require __DIR__ . "/../db/mysqli_connect.inc.php";
// require __DIR__ . "/../functions/functions.inc.php";

$orderby = 'last_name';
$filter = '';

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

if (isset($_GET['sortby'])) {
    $orderby = $_GET['sortby'];
}

if (isset($_GET['clearfilter'])){
    $filter = '';
}

$sql = "SELECT * FROM $db_table WHERE last_name LIKE '$filter%' ORDER BY $orderby ASC";

$result = $db->query($sql);

if ($result->num_rows == 0) {
    echo "<h2 class=\"mt-4 alert alert-warning\">No Records for <strong>last names</strong> starting with <strong>$filter</strong></h2>";
} else {
    if(empty($filter)){
        $text = '';
    } else {
        $text = " - last names starting with $filter";
    }
    echo "<h2 class=\"mt-4 alert alert-primary\">$result->num_rows Records" . $text . '</h2>';
}

// display alphabet filters
display_letter_filters($filter);

// display message if any
display_message();

// display the data
display_record_table($result);

# close the database
$db->close();
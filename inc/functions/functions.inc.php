<?php // Filename: function.inc.php

function display_message(){
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo '<div class="mt-4 alert alert-success" role="alert">';
        echo $message;
        echo '</div>';
    }
}


function display_letter_filters($filter){  
    echo '<span class="d-inline-block mr-3">Filter by <strong>Last Name</strong></span>';
 
    $letters = range('A','Z');

    for($i=0 ; $i < count($letters) ; $i++){ 
        if ($filter == $letters[$i]) {
            $class = 'class="d-inline-block text-light font-weight-bold p-1 mr-3 bg-dark"';
        } else {
            $class = 'class="d-inline-block text-secondary p-1 mr-3 bg-light border rounded"';
        }
        echo "<u><a $class href='?filter=$letters[$i]' title='$letters[$i]'>$letters[$i]</a></u>";
    }
    echo '<a class="text-secondary p-2 mr-2 bg-success text-light border rounded" href="?clearfilter" title="Reset Filter">Reset</a>&nbsp;&nbsp;';
}

// The following function builds a table to display all of the records. I added in table headers for each new column with the same sort feature the originals had
function display_record_table($result){ 
    echo '<div class="table-responsive">';
    echo "<table class=\"table table-striped table-hover table-sm mt-3 table-bordered\">";
    echo '<thead class="thead-dark"><tr><th class="bg-primary">Actions</th><th><a href="?sortby=student_id">Student ID</a></th><th><a href="?sortby=first_name">First Name</a></th><th><a href="?sortby=last_name">Last Name</a></th><th><a href="?sortby=email">Email</a></th><th><a href="?sortby=phone">Phone</a></th><th><a href="?sortyby=gpa">GPA</a></th><th><a href="?sortby=financial_aid">Financial Aid</a></th><th><a href="?sortyby=degree_program">Degree Program</a></th><th><a href="?sortby=graduation_date">Graduation Date</a></th></tr></thead>';
    # $row will be an associative array containing one row of data at a time
    while ($row = $result->fetch_assoc()){
        # display rows and columns of data
        echo '<tr>';
        echo "<td><a href=\"update-record.php?id={$row['id']}\">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"delete-record.php?id={$row['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        echo "<td>{$row['student_id']}</td>";
        echo "<td><strong>{$row['first_name']}</strong></td>";
        echo "<td><strong>{$row['last_name']}</strong></td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['gpa']}</td>";
        // if to set financial aid to yes or no based on 1 or 0
        if ($row['financial_aid'] == 0) { 
            echo "<td>No</td>";
        } elseif ($row['financial_aid'] == 1) {
            echo "<td>Yes</td>";
        }
        // Check to see if the degree was specified, and if not fill td with Not Specified
        if (!empty($row['degree_program'])) {
            echo "<td>{$row['degree_program']}</td>";
        } else {
            echo "<td>Undeclared</td>";
        }
        if (!empty($row['graduation_date'])) {
            echo "<td>{$row['graduation_date']}</td>";
        } else {
            echo "<td>Unknown</td>";
        }
        echo '</tr>';
    } // end while
    // closing table tag and div
    echo '</table>';
    echo '</div>';
}


function display_error_bucket($error_bucket){
    echo '<div class="pt-4 alert alert-warning" role="alert">';
    echo '<p><strong>The following errors were detected:</strong></p>';
        echo '<ul>';
        foreach ($error_bucket as $text){
            echo '<li>' . $text . '</li>';
        }
        echo '</ul>';
        echo '<p>All of these fields are required. Please fill them in.</p>';
    echo '</div>';
}

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}
?>
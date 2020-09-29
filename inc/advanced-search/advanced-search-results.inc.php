<?php // Advanced Search Results

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $result = $db->query($sql);
    if ($result) {
        echo '<div class="alert alert-info">';
        echo '<h2>Search Results</h2>';
        echo '</div>';
        display_record_table($result);
    } else {
        echo '<h2>No Results</h2>';
    }
} else {
    echo '<div class="alert alert-info">';
    echo '<h2>Search results will appear here</h2>';
    echo '</div>';
}
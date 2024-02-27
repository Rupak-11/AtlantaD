<?php

include("connect.php");

// SQL query to delete records from the tform table
$sql1 = "DELETE FROM tform";

// SQL query to delete records from the Jupiter table
$sql2 = "DELETE FROM user1";

// Execute the first delete query
if ($con->query($sql1) === TRUE) {
    echo "Records deleted successfully from tform. ";
} else {
    echo "Error deleting records from tform: " . $con->error;
}

// Execute the second delete query
if ($con->query($sql2) === TRUE) {
    echo "Records deleted successfully from Jupiter.";
} else {
    echo "Error deleting records from Jupiter: " . $con->error;
}

// Close the connection
$con->close();

?>

<?php
include 'connect.php';

// Check if the tasktitle is set in the URL
if (isset($_GET['tasktitle'])) {
    $tasktitle = $_GET['tasktitle'];

    // Prepare the SQL statement with a placeholder
    $sql = "SELECT attachments FROM task WHERE tasktitle = ?";
    
    // Initialize a prepared statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind the task title parameter to the prepared statement
    mysqli_stmt_bind_param($stmt, "s", $tasktitle);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

   // Bind the result variables
    mysqli_stmt_bind_result($stmt, $attachments);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    if ($attachments !== null) {
        // Display attachments
        $attachmentsArray = explode(',', $attachments);
        foreach ($attachmentsArray as $attachments) {
            $filePath = 'C:\attachments' . $attachments;
            echo "<a href='$C:\attachments' target='_blank'>$attachments</a><br>";
        }
    } else {
        echo "No attachments found for the given task title";
    }
} else {
    echo "Invalid task title";
}

// Close the database connection
mysqli_close($con);
?>

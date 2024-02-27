<?php

include("connect.php");

// Array containing table names
$tables = array("user1", "tform");

// Iterate through each table
foreach ($tables as $tableName) {
    // Fetch all records from the current table
    $sql = "SELECT * FROM $tableName";
    $result = $con->query($sql);
    
    // Check if there are records in the table
    if ($result->num_rows > 0) {
        // Print table name
        echo "<h2>Records from table: $tableName</h2>";
        
        // Print table header
        echo "<table border='1'><tr>";
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            echo "<th>$field->name</th>";
        }
        echo "</tr>";

        // Print table data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "No records found in table: $tableName<br>";
    }
}

// Close the connection
$con->close();
?>

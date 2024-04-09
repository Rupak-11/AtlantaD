<?php
include 'connect.php';

if(isset($_POST['tname'])) { 
    $tname = $_POST['tname']; 

    
    $name = explode('-', $tname)[0];

    $query = "SELECT username FROM user1 WHERE name = '$name'";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['username'];
    } else {
        echo ""; 
    }
} else {
    echo "Error: No tname provided";
}
?>

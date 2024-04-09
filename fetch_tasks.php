<?php
include 'connect.php';
session_start();

if(isset($_GET['tname'])) {
    $member = $_GET['tname'];

    
    $query = "SELECT tname FROM tform WHERE username = '$member'";
    $result = mysqli_query($con, $query);

    $tasks = array();
    while($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }

    echo json_encode($tasks);
}
?>

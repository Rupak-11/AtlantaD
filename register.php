<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $name= htmlspecialchars($_POST["name"]);
    $lname= htmlspecialchars($_POST["lname"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $fullname=$name ." ". $lname;
    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        echo "<script>alert('Name should contain only alphabetic characters');window.location.href = 'register.html';</script>";
        exit; // Stop further execution
    }
    
    
    $check_query = "SELECT * FROM user1 WHERE username='$username'";
    $result = $con->query($check_query);
    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists'); window.location.href = 'register.html';</script>";
        exit; // Stop further execution
    }


    
    $query = "INSERT INTO user1 (name,username, password,role) VALUES ('$fullname','$username', '$password','member')";

    if ($con->query($query) === TRUE) {
        header("Location:welcome.html");
        exit; // You should exit after a successful header redirection to prevent further execution
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }

    $con->close();
}
?>
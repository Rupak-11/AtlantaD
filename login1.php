<?php
include 'connect.php';
session_start();





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];

    $query = "SELECT id, role FROM user1 WHERE name='$name' AND username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_role"] = $row["role"];
            $_SESSION["username"] = $username;

            if ($_SESSION["user_role"] == "admin") {
                header("Location: adore.php");
            } else if ($_SESSION["user_role"] == "manager") {
                header("Location: home.php");
            } else if ($_SESSION["user_role"] == "member") {
                header("Location: member.php");
            } else {
                header("Location: member.php");
            }
            exit; // Ensure no further code execution after redirection
        } else {
            echo "No matching user found."; // Debug message
        }
    } else {
        echo "Error in query: " . mysqli_error($con); // Debug message
    }

    mysqli_close($con);
} else {
    echo "Invalid request method."; // Debug message
}
?>

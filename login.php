<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $cpassword = htmlspecialchars($_POST["cpassword"]);

    include 'connect.php';

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM user WHERE username=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password (you should use password_verify() in a real-world scenario)
        if ($row["password"] == $password) {
            echo "Login successful!";
            session_start();
            $_SESSION['username'] = $username;
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $con->close();
}
?>

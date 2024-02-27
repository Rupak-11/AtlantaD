<?php
include 'connect.php';
session_start();
$username = '';


if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
  $username = $_SESSION["username"];
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $tname = $_POST['tname'];
    $name = $_POST['name'];
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
    $recipient_email = $_POST['recipient_email'];
    $message = $_POST['message'];
    $currentDate = date("Y-m-d"); 

    // Validate the email address
    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        // Use $userEmail as the 'From' address in your mailer
        $fromEmail = $userEmail;
        echo "Data inserted successfully";
        
        // Insert data into the database
        $sql = "INSERT INTO tform(tname, name, username, recipient_email, message, currentDate) 
                VALUES('$tname', '$name', '$username', '$recipient_email', '$message', '$currentDate')";
        
        $result = mysqli_query($con, $sql);
        
        if (!$result) {
            die(mysqli_error($con));
        }
    } else {
        // Handle the case where the email address is invalid
        echo "Invalid email address";
    }
}

// Fetch user data including role
$query = "SELECT id, username, name, role FROM user1";
$result = mysqli_query($con, $query);
$userOptions = "";

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $userOptions .= "<option value='{$row['name']}-{$row['role']}'>{$row['name']} - {$row['role']}</option>";
    }
} else {
    echo "Query failed: " . mysqli_error($con);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600);
/*
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-weight: 300;
            font-size: 12px;
            line-height: 30px;
            color: #272727;
            background: rgb(25, 199, 155);
        }

        .container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            position: relative;
        }

        #contact input,
        #contact textarea,
        #contact select {
            font: 400 12px/16px;
            width: 100%;
            border: 1px solid #CCC;
            background: #FFF;
            margin: 10 5px;
            padding: 10px;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 30px;
        }

        #contact {
            background: #F9F9F9;
            padding: 25px;
            margin: 50px 0;
        }

        fieldset {
            border: medium none !important;
            margin: 0 0 10px;
            min-width: 100%;
            padding: 0;
            width: 100%;
        }

        textarea {
            height: 100px;
            max-width: 100%;
            resize: none;
            width: 100%;
        }

        button {
            cursor: pointer;
            width: 100%;
            border: none;
            background: rgb(17, 146, 60);
            color: #FFF;
            margin: 0 0 5px;
            padding: 10px;
            font-size: 20px;
        }

        button:hover {
            background-color: rgb(15, 95, 42);
        }
        */
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4070f4;
}
.wrapper{
  position: relative;
  max-width: 430px;
  width: 100%;
  background: #fff;
  padding: 34px;
  border-radius: 6px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}
.wrapper h2{
  position: relative;
  font-size: 22px;
  font-weight: 600;
  color: #333;
}
.wrapper h2::before{
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 28px;
  border-radius: 12px;
  background: #4070f4;
}
.wrapper form{
  margin-top: 30px;
}
.wrapper form .input-box {
    margin: 18px 0;
}

form .input-box input{
  height: 70%;
  width: 100%;
  outline: none;
  padding: 0 15px;
  font-size: 17px;
  font-weight: 400;
  color: #333;
  border: 1.5px solid #C7BEBE;
  border-bottom-width: 2.5px;
  border-radius: 6px;
  transition: all 0.3s ease;
}
.input-box input:focus,
.input-box input:valid{
  border-color: #4070f4;
}
.input-box textarea,
.input-box select {
    width: 100%;
    height: 70%;
    outline: none;
    padding: 0 15px;
    font-size: 17px;
    font-weight: 400;
    color: #333;
    border: 1.5px solid #C7BEBE;
    border-bottom-width: 2.5px;
    border-radius: 6px;
    transition: all 0.3s ease;
}
.input-box textarea,select:focus,
.input-box textarea,select:valid{
  border-color: #4070f4;
}
form .policy{
  display: flex;
  align-items: center;
}
form h3{
  color: #707070;
  font-size: 14px;
  font-weight: 500;
  margin-left: 10px;
}
.input-box.button input {
    color: #fff;
    letter-spacing: 1px;
    border: none;
    background: #4070f4;
    cursor: pointer;
    width: 100%; /* Add this line to make the button full width */
}
.input-box.button input:hover{
  background: #0e4bf1;
}
form .text h3{
 color: #333;
 width: 100%;
 text-align: center;
}
form .text h3 a{
  color: #4070f4;
  text-decoration: none;
}
form .text h3 a:hover{
  text-decoration: underline;
}
select {
  width: 500px;
  margin: 10px;
}
select:focus {
  min-width: 150px;
  width: auto;
}


    </style>

</head>
<body>
<div class="wrapper">

        <div class="form-container">
            <form id="contact" action="mail.php" method="post">
                <h1>Task Form</h1>
                <?php echo $_SESSION["username"]; ?>
                <input type="hidden" name="email" value="<?php echo $username; ?>">

                <div class="input-box">
                <select name="tname" id="tname" tabindex="8">
                        <?php echo $userOptions; ?>
                    </select>
                    <label for="name">Task Been Given to Team Member:</label>
                    <select name="name" placeholder="Task been already given to team members" id="name" style="width:350px;">
                        <?php
                        $query = "SELECT tname, name FROM tform WHERE username = '$username'";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $optionValue = $row['name'] . '-' . $row['tname'];
                                echo "<option value='" . $optionValue . "'>" . $optionValue . "</option>";
                            }
                        } else {
                            echo "Query failed: " . mysqli_error($con);
                        }
                        ?>
                         
                    </select>
                    <label for="name">Task Name:</label>
                    <input type="text" id="name" name="name" style="width:350px;" placeholder="Enter Name" style="display:none;">
                </div>

                <div class="input-box">
                    <input id="recipient_email" name="recipient_email" placeholder="recipient-email" type="email" tabindex="3">
                </div>

                <br>

                <div class="input-box">
                    <textarea id="message" name="message" placeholder="Remarks" tabindex="5" rows="15" cols="50" style="width:370px; height: 70px;"></textarea>
                </div>

                <div class="input-box">
                    <label for="currentDate">Date:</label>
                    <input type="date" id="currentDate" name="currentDate" tabindex="6">
                </div>

                <br>

                <div class="input-box button">
                    <input type="submit" name="send" id="contact-submit">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
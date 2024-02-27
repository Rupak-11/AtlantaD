<?php
include 'connect.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"]))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $userEmail = isset($_SESSION["username"]) ? $_SESSION["username"] : '';

  $recipient_email=$_POST['recipient_email'];
  $task_type=$_POST['task_type'];
  $message=$_POST['message']; // Add the missing single quote here

  $sql="INSERT INTO tform(name,email,recipient_email,task_type,message)
  values('$name','$email','$recipient_email','$task_type','$message')";

  $result=mysqli_query($con,$sql);
  if($result){
    echo "data inserted successfully";
  } else {
    die(mysqli_error($con));  
  }
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
.wrapper form .input-box{
  height: 52px;
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
form .input-box textarea,select{
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
.input-box.button input{
  color: #fff;
  letter-spacing: 1px;
  border: none;
  background: #4070f4;
  cursor: pointer;
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
       

<?php

include 'connect.php';

// Assume the user is logged in, and their email is stored in the session
$userEmail = $_SESSION["username"];



?>

<p> <?php 
echo $_SESSION["username"]; 



?>
</p>
            <input type="hidden" name="email" value="<?php echo $userEmail; ?>">
        <div class="input-box">
        <label for="taskList"><b>task name:<b></label>
    <select name="taskList" id="taskList" style="width:350px;">
        <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "to-do";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch tasks from the database
            $sql = "SELECT distinct name FROM tform  ";
            $result = $conn->query($sql);

            // Populate dropdown list with tasks
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
            }

            // Close the database connection
            $conn->close();
        ?>
    </select>
</div>
<br>
        <div class="input-box">
            <input id="recipient_email" name="recipient_email"placeholder="recipient-email" type="email" tabindex="3">
    </div>
        <div class="input-box">
            <textarea id="message" name="message" placeholder="Remarks" tabindex="5" rows="15" cols="50"style="width:370px; height: 70px;"></textarea>
    </div>
    <br>
    
        <div class="input-box button">
                    <input type="Submit" value="Submit now">
                
    </div>
    </form>
    </div>
    </div>
</body>

</html>
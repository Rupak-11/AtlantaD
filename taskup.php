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

    if (filter_var($recipient_email, FILTER_VALIDATE_EMAIL)) {
       
        $fromEmail = $recipient_email;
        echo "Data inserted successfully";
        
        $sql = "INSERT INTO tform(tname, name, username, recipient_email, message, currentDate) 
                VALUES('$tname', '$name', '$username', '$recipient_email', '$message', '$currentDate')";
        
        $result = mysqli_query($con, $sql);
        
        if (!$result) {
            die(mysqli_error($con));
        }
    } else {
        
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
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4070f4;
        }
        .wrapper {
            position: relative;
            max-width: 430px;
            width: 100%;
            background: #fff;
            padding: 34px;
            border-radius: 6px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .wrapper h2 {
            position: relative;
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }
        .wrapper h2::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 28px;
            border-radius: 12px;
            background: #4070f4;
        }
        .wrapper form {
            margin-top: 30px;
            width: 100%;
        }
        .wrapper form .input-box {
            margin: 18px 0;
        }
        form .input-box input,
        form .input-box select,
        form .input-box textarea {
            width: calc(100% - 20px);
            outline: none;
            padding: 10px;
            font-size: 17px;
            font-weight: 400;
            color: #333;
            border: 1.5px solid #C7BEBE;
            border-bottom-width: 2.5px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        form .input-box label {
            display: block;
            margin-bottom: 5px;
        }
        form .input-box input:focus,
        form .input-box select:focus,
        form .input-box textarea:focus {
            border-color: yellow;
            outline: none;
        }
        form .input-box.button input {
            color: #fff;
            letter-spacing: 1px;
            border: none;
            background: #4070f4;
            cursor: pointer;
            width: 100%;
            display: block;
        }
        form .input-box.button input:hover {
            background: #0e4bf1;
        }
        form .text h3 {
            color: #333;
            width: 100%;
            text-align: center;
        }
        form .text h3 a {
            color: #4070f4;
            text-decoration: none;
        }
        form .text h3 a:hover {
            text-decoration: underline;
        }
        #date-input input[type="date"] {
            width: calc(100% - 22px);
            padding: 9px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="form-container">
            <form id="contact" action="mail.php" method="post">
                <h1>Task Form</h1>
                <?php echo $username; ?>
                <input type="hidden" name="email" value="<?php echo $username; ?>">

                <div class="input-box">
                    <label for="tname">Task To Be Given To:</label>
                    <select name="tname" id="tname" tabindex="8">
                        <?php echo $userOptions; ?>
                    </select>
                </div>

                <div class="input-box">
                    <label for="name">Task Been Given to Team Member:</label>
                    <select name="name" id="name" style="width:350px;">
                      
                    </select>
                </div>

                <div class="input-box">
                    <label for="taskName">Task Name:</label>
                    <input type="text" id="taskName" name="taskName" placeholder="Task Name">
                </div>

                <div class="input-box">
                    <label for="recipient_email">Recipient Email:</label>
                    <input type="email" id="recipient_email" name="recipient_email" placeholder="Recipient Email">
                </div>

                <div class="input-box">
                    <label for="message">Remarks:</label>
                    <textarea id="message" name="message" placeholder="Remarks" style="width:370px; height: 70px;"></textarea>
                </div>

                <div class="input-box" id="date-input">
                    <label for="currentDate">Date:</label>
                    <input type="date" name="currentDate">
                </div>

                <div class="input-box button">
                    <input type="submit" name="send" id="contact-submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>

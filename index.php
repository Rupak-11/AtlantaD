<?php
session_start();

if (isset($_SESSION["username"])) {
    // Redirect to the homepage or another appropriate page
    header("Location: member.php");
    exit();
}


    

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Borel&family=Caveat:wght@700&family=Dancing+Script:wght@700&family=Handjet&family=Kanit:wght@400;500;800&family=Lilita+One&family=Luxurious+Roman&family=Montserrat:wght@700&family=Mukta:wght@400;500&family=Pacifico&family=Poppins&family=Roboto+Slab:wght@400;500&family=Shadows+Into+Light&family=Signika:wght@600&display=swap"
        rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<style>
          @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        margin: 0;
        padding: 0;
        background: url('bg.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    #page-1 {

        position: relative;
        align-items: center;
        height: 100%;
        width: 100%;





    }

    #background img {

        height: 100%;
        width: 100%;
        top: 0%;
        z-index: -1;
        position: fixed;


    }

    #page-1 #container {

        position: absolute;
        margin: 25px 4px;
        padding: 20px 10px;
        top: 5%;
        right: 34%;
        height: 570px;
        width: 30%;
        background-color: #fff;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;

    }


    #container h1 {
        position: absolute;
        top: 5%;
        color: rgb(45, 3, 85);


    }

    .form-box h2 {

        margin-top: 50px;
        margin-bottom: 15px;
        color: #05010c;
        padding: 4px 4px;

    }


    .form-box .input-field {
        background: #eaeaea;
        border-radius: 5px;
        padding: 9px 40px;
        margin: 15px 3px;
        cursor: pointer;

    }

    .form-box img {
        height: 70px;
        width: 220px;
        position: absolute;
        right: 25%;
        top: 3%;

    }

    input {
        /* width: 15%; */
        background: transparent;
        border: 0;
        outline: 0;
        /* padding: 18px 50px; */
    }

    #remember {

        position: relative;
        right: 25%;
        top: 5%;
        margin-top: 28px;


    }

    #remember+label {
        position: relative;
        right: 24%;
        bottom: 13%;
        font-weight: bold;
    }

   



    .input-field i {
        /* color: #999; */

    }


    form p {
        text-align: left;
        font-size: 15px;
    }

    form p a {
        text-decoration: none;
        color: #3c00a0;
    }

    .btn-link {
        text-decoration: none;
    }

    .btn-field button a {
        text-decoration: none;
        color: inherit;
    }

  
    .btn-field {
        width: 100%;
        display: flex;
        justify-content: space-between;
        gap: 30px;
        margin-top: 15px;
        text-decoration: none;
    }

    .btn-field button {

        margin-top: 10px;
        border: 0;
        outline: 0;
        cursor: pointer;
        flex-basis: 100%;
        padding: 3px 3px;
        height: 40px;
        background:royalblue;
        color: whitesmoke;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 500;
        transition: 0.3s all ease;





    }


    .btn-field button:hover {
        background: rgb(3, 182, 3);
        color: black;
        transition: 0.3s all ease;
    }

    .btn-field button.disable {
        text-decoration: none;
        background: grey;
        color: black;

    }

    #Forgot_pass {
        position: relative;
        text-decoration: none;
        display: inline-block;
        right: 22%;
        margin: 5px 80px;
        color: #05010c;
        font-weight: 500px;
        transition: all ease 0.5s;

    }

    #New-User a{
        color: inherit;
        text-decoration: none;
    }
 

   #New-User {
        width: 100%;
        border: 0;
        outline: 0;
        cursor: pointer;
        flex-basis: 100%;
        padding: 3px 3px;
        height: 40px;
        background:royalblue;
        color: whitesmoke;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 500;
        transition: 0.3s all ease;

    }
        
    #New-User:hover{
        background: rgb(3, 182, 3);
        color: black;

    }

    #Forgot_pass:hover {
        color: red;
    }

    h6{
        padding: 6px;
        text-align: center; 
   
    }

    @media (min-width:200px) and (max-width:720px) {
        body {}

        #page-1 #container {
            position: absolute;
            width: 84%;
            right: 7%;
            top: 7%;
        }


        .form-box img {
            position: absolute;
            width: 180px;
            overflow: hidden;
        }

    }

    @media (min-width:730px) and (max-width:1030px) {
      

        #page-1 {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            align-items: center;
        }

        #page-1 #container {
            position: absolute;
            width: 84%;
            right: 7%;
            top: 7%;
            margin: 300px 5px;
        }

        .form-box img {
            position: absolute;
            width: 190px;
            padding: 3px 7px;
            overflow: hidden;
            margin: -6px 80px;
        }
    }
</style>

<body>
   

    <div id="page-1">

        <div id="container">
            <div class="form-box">
             <!-- <img src="https://adoreearth.org/assets/images/ADORE.png" alt="" id="img1"> -->
                <h3 id="title" style="margin-bottom:20px ; border-bottom:2px solid royalblue; color:royalblue;">Task-Management System</h3>
                <form action="login1.php" method="post">

                <div class="form-container">

                
                    <div class="input-group">
                    <h4 style="text-align:left ; font-size:18px;">Enter Your Name:</h4>
                        <div class="input-field" id="name">
                           
                            <i class="ri-user-fill"></i>
                            <input type="text" placeholder="Your Name" id="name" name="name" required>
                        </div>

                    <div class="input-group">
                    <h4 style="text-align:left ; font-size:18px;">Enter Your E-mail:</h4>
                        <div class="input-field" id="Email">
                        <i class="ri-mail-fill"></i>
                            <input type="email" placeholder="Email ID" id="username" name="username" required>
                        </div>
                        <h4 style="text-align:left; font-size:18px;">Enter Your Password:</h4>
                        <div class="input-field" id="Password">
                            <i class="ri-lock-fill"></i>
                            <input type="password" placeholder="Password" id="password" name="password" required>
                        </div>
                    </div>
                    </div>

                    <input type="checkbox" id="remember" name="remember"><label for="">Remember Me</label>
                    <div class="btn-field">
                        <!-- <button type="button" class="disable" id="signupBtn"><a href="sign-up.html" target="_blank">Sign-up</a></button> -->
                        <!-- Change the button type to "submit" -->
                        <button type="submit" id="signupBtn"  value="Login">Login</button>
                     
                    </div>
                    <h6>OR</h6>
                    <div class="btn-registration">
                      <button id="New-User" onclick="redirectTo('Index.html')" ><a href="register.html">New User Registration</a></button>
                    </div>

                   


                </form>


            </div>


        </div>

    </div>

    
</body>

</html>

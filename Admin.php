<?php
session_start();

include 'connect.php';


if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: index.php"); // Redirect to the login page after logout
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .navbar-brand {
      color: white;
      font-size: 2rem;
      font-weight: 600;
    }

  
    .nav-item a {
      color: white;
      font-size: 1.3rem;
      font-weight: 500;
  
    }
  
    .nav-item button {
      font-weight: 500;
      margin-top: 5px;
      margin-left: 15px;
    }

    .Task-section{
      
      height: 70vh;
      width: 100%;
      margin-top: 15px;
      display: flex;
      justify-content: space-evenly;
      align-items: center;
    }

    #my-tasks, #mem-task{
      border-radius: 20px;
     
    }

   

    #my-tasks{
   
      height: 50vh;
      width: 40%;
      background: #1844bf;
      text-align: center;
      scale: 1;
      transition: all ease 0.5s;
   
    }
    #my-tasks:hover{
      scale: 1.1;
    }


    #mem-task{
      height: 50vh;
      width: 40%;
      background: rgb(152, 73, 231);
      scale: 1;
      transition: all ease 0.5s;
    }

    #mem-task:hover{
      scale: 1.1;
    }

    #span-text{
      height: 25vh;
      width: 40%;
      margin: auto;
      margin-top: 100px;
      text-align: left;
      color: whitesmoke;
      border-left: 3px solid white;
    }


  .Task-section a{
      text-decoration: none;
    }


    #span-text h1{
      font-size: 3rem;
      font-weight: 600;
      padding-left: 15px;

    }

    #soan-text :hover{
      color: black;
    }



    #my-tasks, #mem-task{
      border-radius: 20px;
     
    }

   

    #my-tasks{
   
      height: 50vh;
      width: 40%;
      background: #1844bf;
      text-align: center;
      scale: 1;
      transition: all ease 0.5s;
   
    }
    #my-tasks:hover{
      scale: 1.1;
    }


    #mem-task{
      height: 50vh;
      width: 40%;
      background: rgb(152, 73, 231);
      scale: 1;
      transition: all ease 0.5s;
    }

    #mem-task:hover{
      scale: 1.1;
    }
    
    @media (min-width:200px) and (max-width :800px)
    {
      .Task-section{
      
      height: 70vh;
      width: 100%;
      margin-top: 15px;
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      flex-direction: column;
    }

    #my-tasks{
   
   height: 50vh;
   width: 70%;
   background: #1844bf;
   text-align: center;
   margin-bottom: 100px;
   scale: 1;
   transition: all ease 0.5s;

 }
 #my-tasks:hover{
   scale: 1.1;
 }


 #mem-task{
   height: 50vh;
   width: 70%;
   background: rgb(152, 73, 231);
   scale: 1;
   transition: all ease 0.5s;
 }

 #span-text{
      height: 25vh;
      width: 55%;
      margin: auto;
      margin-top: 100px;
      text-align: center;
      color: whitesmoke;
     border: none;
     font-size: 1rem;
    }

    #span-text h1 {
    font-size: 2.2rem;
    font-weight: 600;
    /* padding-left: 15px; */
}
    }

   
  </style>
  
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Admin's Page</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link " href="adore.php">Approval Page</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="taskup.php">Task Form</a>
              </li>
              <li class="nav-item">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <button class=" btn btn-light" type="submit" name="logout">Logout</button>
                </form>
  
              </li>
  
            </ul>
          </div>
        </div>
      </nav>
      <?php
include 'connect.php'; // Assuming this file contains your database connection

$query = "SELECT * FROM tform";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>
<main>


<section class="Task-section">
<div id="my-tasks">
  <a href="AdminTasks.php">
  <div id="span-text">
  <span><h1>MY</h1></span>
  <span><h1>TASKS</h1></span>
 </div>

  </a>
 
</div>
<div id="mem-task">
<a href="Admintable.php">
  <div id="span-text">
  <span><h1>MEMBER'S</h1></span>
  <span><h1>TASKS</h1></span>
 </div>

  </a>
</div>

</section>
</main>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>
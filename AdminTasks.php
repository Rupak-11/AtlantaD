
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
    <title>Admin Tasks</title>
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

    .btn{
      margin: 3px 4px;
      
    }
  </style>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">My Tasks</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="task.php">Task Form</a>
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

      <header>
      <table class="table table-bordered table-striped align-middle">
  <thead>
    <tr>
     
      <th scope="col" >Tasks Pending</th>
      <th scope="col" >My Tasks</th>
      <th scope="col">Date Added</th>
      <th scope="col">Add / Remove Tasks</th>
    </tr>
  </thead>
  <tbody>
    <tr >
    
      <td scope="row">1</td>
      <td >Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae pariatur enim nobis voluptatem 
      </td>
      <td>Otto</td>
      <td>
        <button class="btn btn-sm btn-primary">ADD NEW</button>
        <button class="btn btn-sm btn-danger">REMOVE</button>
      </td>
    </tr>
  
  </tbody>
</table>
      </header>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>
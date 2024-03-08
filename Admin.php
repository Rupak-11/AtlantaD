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
  <title>Admin-Page</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
</style>

<body>
  <main>
    <nav class="navbar navbar-expand-lg bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Tasks Page</a>
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
    <?php
include 'connect.php'; // Assuming this file contains your database connection

$query = "SELECT * FROM tform";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>
    <table class="table table-striped table-bordered">
  <thead>
    <tr>
      
      <th scope="col">Task Name</th>
      <th scope="col">Task Given By</th>
      <th scope="col">Task Given To</th>
      <th scope="col">Date Of Allocation</th>
      <th scope="col">Task Status</th>
    </tr>
  </thead>
  <tbody>
  <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                 
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['recipient_email']}</td>";
                    
                    echo "<td>{$row['currentDate']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
</table>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
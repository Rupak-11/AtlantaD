<?php
session_start();

include 'connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';



$query = "SELECT tname, name, status FROM tform WHERE recipient_email = '$username'";
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($con, $searchTerm);
    $query .= " AND name LIKE '%$searchTerm%'";
}

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}


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
    <title>Member's Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="Home.css"> -->
</head>

    <style>
    * {
    margin: 0;
    padding: 0;
    /* font-family: 'Roboto Slab', serif; */
}


nav{
    background: royalblue;
    margin: 0px -3px;
    height: 50px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 40px;
    border: 0;
   
    
}

nav ul{
    display: flex;
    justify-content: center;
    align-items: center;
   
}

nav ul li{
    list-style: none;
    margin : 10px 5px;
    padding: 3px 4px;
    
}

header img{
    position: relative;
    height: 100px;
    width:300px;
    right:7%;
}

header a{
    text-decoration: none;
    color: black;
    transition: all 0.3s ease 0s;
}

header a:hover{
    color: whitesmoke;
}

#nav-title{
   font-size: 2.5rem;
   margin-right: 2%;
   color: black;
}

#page-1{
    height: 100%;
    width: 100%;
}

#task-container{
    position: absolute;
    height: 30px;
    width: 130px;
    background :#f06a6a;
    display: flex;
    align-items: center;
    justify-content: center;
    right: 25%;
    top: 3%;
    padding: 5px 4px;
    border-radius: 15px;
    outline: 0;
}

#task-container p{
    margin: 0px -5px;
    padding: 3px 4px;
}

#task-container:hover{
    cursor: pointer;
}


#task-container i{
    padding: 3px 4px;
    size: 30px; 
}
 label{
    color: whitesmoke;
    font-weight: 500;
    font-size: 1.4rem;
    margin-top: 5px;

 }

 #s-bar{
    padding: 4px 5px;
    border: 0;
    border-radius: 5px;

 }

#s-btn{
    padding: 3px 7px;
    background: green;
    color: whitesmoke;
    border-radius: 5px;
}

#lg-btn{
    padding: 3px 7px;
    background: green;
    color: whitesmoke;
    border-radius: 5px;
    margin-top: 5px;
}



        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #3B9EBF;
        }

        tr:nth-child(even) {
            background-color: #90EE90;
        }
        tr:nth-child(odd) {
            background-color: #cbcccb;
        }

       


        input[type=text]:focus {
            outline: none;
            border-color: #0066cc;
        }
        .center {
  margin-left: auto;
  margin-right: auto;
}

.highlight {
            background-color: yellow; /* You can change this color */
        }
</style>

<body>
    <header>
        <!-- <img src="https://adoreearth.org/assets/images/ADORE.png" alt="" id="background"> -->
        <nav>
            <h2 style="color:#fff;">Member's Page</h2>
            <ul class="ms-auto">

                <li>
                <form method="GET">
                    <label for="s-bar">Search Task Name:</label>
                    <input type="text" name="search" id="s-bar" placeholder="Enter task name" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" id="s-btn">Search</button>
                </form>
                </li>
                <li>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <button type="submit" name="logout" id="lg-btn">Logout</button>
        </form>
                </li>
            </ul>
           
            
           
        </nav>
        
    </header>

<!-- Displaying records in a table -->
<h2 style="text-align: center;">Task Records</h2>
        <br>
        <br>
        <!-- <table class="table">
            <thead>
                <tr>
                    <th>Team Member Name</th>
                    <th>Task Name</th>
                    <th>status</th>
                    <th>update</th>
                </tr>
            </thead> -->
  <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Task name</th>
      
      <th scope="col">Task Status</th>
      <th scope="col">Updates</th>
    </tr>
  </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $taskName = $row['name'];
                $highlightClass = $searchTerm != '' && stripos($taskName, $searchTerm) !== false ? 'highlight' : '';
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>"; // Display Team Member Name
                

                echo "<td>" . $row['status'] . "</td>";  // Display Status
                echo '<td><a href="update.php?selectedTask=' . urlencode($taskName) . '">Update</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
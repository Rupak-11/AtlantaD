<?php
session_start();
include 'connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve task name and status from the form submission
    $taskName = isset($_POST["taskName"]) ? $_POST["taskName"] : '';
    $status = isset($_POST["status"]) ? $_POST["status"] : '';

    // Update the status in the database
    $updateQuery = "UPDATE tform SET status = '$status' WHERE name = '$taskName'";
    $updateResult = mysqli_query($con, $updateQuery);

    if (!$updateResult) {
        die("Update query failed: " . mysqli_error($con));
    }

    // Redirect to member.php after updating
    header("Location: member.php");
    exit();
}

// Fetch task names from the database
$query = "SELECT DISTINCT name FROM tform";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Form</title>
    <link rel="stylesheet" href="status.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <style>
        body {
            background: url('bg.jpg');
            /* font-family: "Kanit", sans-serif; */
        }

        h2 {
            color: royalblue;
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            text-decoration: underline;
            margin-bottom: 55px;
        }

        .wrapper {

            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 65vh;
            width: 35%;
            /* background:rgb(147, 243, 51); */
            background: white;
            border-radius: 10px;
            border: 0;
            margin: auto;
            justify-content: center;
            align-items: center;


        }

        form {
            /* background: blue; */
            margin: -30px 30px;
            padding: 4px 50px;
        }

        h3 {
            color: black;
            font-size: 1.4rem;
            margin: 10px 4px;

        }

        form>label {
            font-size: 1.3rem;
        }

        #input1 input {
            height: 25px;
            width: 250px;
            margin: 0px 3px;
            padding: 3px 4px;
            border: 2px solid black;
            border-radius: 10px;
        }

        #status {
            height: 28px;
            width: 250px;
            margin: 2px 3px;
            padding: 0px 50px;
            font-size: 1rem;
            border-radius: 10px;
            text-align: center;
        }

        select {
            width: 250px;
            margin: 2px 3px;
            padding: 3px 50px;
            font-size: 1rem;
            border-radius: 10px;
            text-align: center;
        }

        #status option {}

        #status:hover {
            cursor: pointer;
        }

        .text {
            margin: 7px 50px;
        }


        #button button {
            font-weight: bold;
        }

        button {
            margin: 30px 5px;
            padding: 2px 5px;
            border-radius: 10px;
            height: 40px;
            width: 110px;
            font-size: 1rem;
            font-weight: 500;
            background: lawngreen;
            color: black;
        }

        button:hover {
            cursor: pointer;
            background: limegreen;
            color: white;

        }
    </style>
</head>



<body>
    <div class="wrapper">
        <h2>Status Form</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h3>Task Name:</h3>
            <div id="input1">
                
            <?php
                // Fetch task name from the URL parameter
                $selectedTask = isset($_GET['selectedTask']) ? $_GET['selectedTask'] : '';

                // Display the selected task name
                echo "<span>" . htmlspecialchars($selectedTask) . "</span>";
                ?>
                <input type="hidden" name="taskName" value="<?php echo htmlspecialchars($selectedTask); ?>">
            </div>

            <h3>Task Status:</h3>
            <!-- <label for="status">Select status:</label> -->
            <select id="status" name="status">
                <option value="completed">Completed</option>
                <option value="in-progress">In-Progress</option>
            </select>

            <div id="button">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
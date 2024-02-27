<?php
session_start();

include 'connect.php'; 
$query = "SELECT * FROM user1";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health & Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" id="name">Name</th>
            <th scope="col" id="email" name="email">Email</th>
            <th scope="col" id="Role">Status</th>
            <th scope="col">Approve</th>
          </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th scope='row'>{$row['id']}</th>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>";
                echo "<label for='Status'>Status:</label>";
                echo "<select name='member' class='status-select' data-member-id='{$row['id']}' data-member-email='{$row['username']}'>";
                echo "<option value='member'>Member</option>";
                echo "<option value='Admin'>Admin</option>";
                echo "<option value='Manager'>Manager</option>";
                echo "</select>";
                echo "</td>";
                echo "<td><button class='btn btn-success approve-btn' data-member-id='{$row['id']}'>Approve</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Add event listeners for all approve buttons
            const approveButtons = document.querySelectorAll(".approve-btn");
            approveButtons.forEach(button => {
                button.addEventListener("click", function () {
                    // Get the selected status and email
                    const memberId = this.getAttribute("data-member-id");
                    const selectElement = document.querySelector(`.status-select[data-member-id="${memberId}"]`);
                    
                    // Check if 'email' key exists in the URL
                    if (window.location.search.includes('email')) {
                        const selectedEmail = selectElement.getAttribute("data-member-email");
                        const selectedStatus = selectElement.value;
                        
                        // Redirect based on selected status (adjust the URLs accordingly)
                        if (selectedStatus === "Manager") {
                            window.location.href = "home.php";
                        } else if(selectedStatus === "Admin") {
                            window.location.href = `task.php?email=${selectedEmail}`;
                        } else if(selectedStatus === "Member") {
                            window.location.href = `member.php?email=${selectedEmail}`;
                            // Handle other cases or leave empty if not needed
                        }
                    } else {
                        console.error("'email' parameter is missing in the URL.");
                    }
                });
            });
        });
    </script>
</body>
</html>

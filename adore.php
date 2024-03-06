<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task-Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z8vwuK7l3o6zY4g5z9DIcVKjc29vX+K1z9Y2bx" crossorigin="anonymous"></script>
    <style>
    .disapprove-btn{
        margin-left: 15px;
    }

    @media (min-width:200px) and (max-width:800px){
        .disapprove-btn{
        margin-top: 15px;
        margin-left: 0px;
    }
    }
</style>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="logout">Logout</button>
    </form>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" id="name" name="name">Name</th>
            <th scope="col" id="email" name="email">Email</th>
            <th scope="col" id="role" name="role">Status</th>
            <th scope="col">Approve/Disapprove</th>
          </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['username']}</td>"; // Corrected this line to display the email
                echo "<td>";
                echo "<form method='POST' action='adore.php'>";
                echo "<input type='hidden' name='username' value='{$row['username']}'>";
                echo "<label for='Status'>Status:</label>";
                echo "<select name='member' class='status-select' data-member-id='{$row['id']}' data-member-email='{$row['username']}'>";
                echo "<option value='Select the Role'>Select Your Role</option>";
                echo "<option value='Admin'"; if ($row['role'] == 'Admin') echo " selected"; echo ">Admin</option>";
                echo "<option value='Manager'"; if ($row['role'] == 'Manager') echo " selected"; echo ">Manager</option>";
                echo "<option value='Member'"; if ($row['role'] == 'Member') echo " selected"; echo ">Member</option>";
                echo "</select>";
                
                echo "</td>";
                echo "<td>";
                if ($row['role'] == 'Approved') { 
                    echo "<button type='button' class='btn btn-success' disabled>Approved</button>";
                } else if ($row['role'] == 'Canceled') { 
                    echo "<button type='button' class='btn btn-danger' disabled>Canceled</button>";
                } else {
                    echo "<button type='button' class='btn btn-success approve-btn' data-member-id='{$row['id']}' data-role='{$row['role']}'>Approve</button>";
                    echo "<button type='button' class='btn btn-danger disapprove-btn' data-member-id='{$row['id']}' data-role='{$row['role']}'>Disapprove</button>";
                }
                
                echo "</td>";
                echo "</form>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            $(".approve-btn, .disapprove-btn").click(function(){
                var username = $(this).closest("tr").find("[name='username']").val();
                var role = $(this).closest("tr").find(".status-select").val();
                var button = $(this);
                $.ajax({
                    type: 'POST',
                    url: 'adore.php',
                    data: {
                        username: username,
                        member: role,
                        updatebtn: $(this).hasClass("approve-btn") ? 1 : 0, // 1 for approve, 0 for disapprove
                        disapprovebtn: $(this).hasClass("disapprove-btn") ? 1 : 0
                    },
                    success: function(response){
                        alert(response);
                        // Update button status if needed
                        if (role == 'Approved') { 
                            button.closest("td").html("<button type='button' class='btn btn-success' disabled>Approved</button>");
                        } else if (role == 'Canceled') { 
                            button.closest("td").html("<button type='button' class='btn btn-danger' disabled>Canceled</button>");
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

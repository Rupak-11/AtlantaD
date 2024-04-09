<?php
include 'connect.php';


if(isset($_POST['tname'])) {
   
    $tname = mysqli_real_escape_string($con, $_POST['tname']);

  
    $query = "SELECT name FROM tform WHERE tname = '$tname'";

    
    $result = mysqli_query($con, $query);

    
    if($result) {
        
        if(mysqli_num_rows($result) > 0) {
           
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['name']}'>{$row['name']}</option>";
            }
        } else {
           
            echo "<option value=''>No names found</option>";
        }
    } else {
       
        echo "<option value=''>Error fetching names</option>";
    }
} else {
  
    echo "<option value=''>No tname provided</option>";
}
?>

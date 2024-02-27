<?php

$con=new mysqli('localhost','root','','to-do');

if(!$con)
{
  die(mysqli_error($con));

}

?>
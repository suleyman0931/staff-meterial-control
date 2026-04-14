<?php

 include ('connection.php');

$id = $_GET['universityId'];

  $query = " DELETE FROM student  WHERE universityId = '$id' ";

  if(mysqli_query($conn,$query))
  {
    header('location: View Student.php');
  }
else{
  echo mysqli_error($db);
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       .super{
          background-color:aqua;
          width:400px;
          padding-left:60px;
          border-style:none;
          border-radius:10px;
             }
    </style>
</head>
<?php
$message="";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 //Check connection
// if ($conn->connect_error) {
//     die("Connection failed: ".$conn->connect_error);}

// echo "Connected successfully";

if(isset($_POST['submit'])){
    $Department_id = $_POST["Department_id"];
    $Department_name = $_POST["Department_name"];
    $Location = $_POST["Location"];
    $college =  $_POST["college"];
    $start_Date = $_POST["start_Date"];
   
    // Prepare the SQL statement
    
    $query = "Insert Into dep (Department_id,Department_name,Location,college, start_Date)
    values( '$Department_id', '$Department_name', '$Location','$college','$start_Date')";

    $execute = mysqli_query($conn,$query) or die("Unable to insert the record, because of ".mysqli_error($conn,$query));
    
    if($execute) {
      
      $message = "You have registered the student successfully!!";
}
}
?>
<body>
<div class="super">
    <!-- <form id="student_form" action="?<method="post"> -->
    <form id="student_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <h1>student register</h1>
    <p><?php  echo $message; ?></p>
    <p>Department_id:
        <input type="text" name="Department_id" id="Department_id">
        <span id="Department_id_error" style="color: red;"></span> <!-- Error message -->
    </p>
    <p>Department_name:
        <input type="text" name="Department_name" id="Department_name">
        <span id="Department_name_error" style="color: red;"></span> <!-- Error message -->
    </p>
    <p>Location:
        <input type="text" name="Location" id="Location">
        <span id="Location_error" style="color: red;"></span> <!-- Error message -->
    </p>
    <p>college:
        <select id="college" value="college" name="college">
            <option value="school of computing">school of computing</option>
        
        </select>
    <p>start_Date:
        <input type="date" name="start_Date" id="start_Date">
    </p> <br>
    <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>
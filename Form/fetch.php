<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      .body{
        background-color:lightblue;
      }

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="diplay.css">
    
   <!-- // <link rel="stylesheet" href="student.css"> -->
</head>
<body>
<div class="body">
  <?php
  // $conn=mysqli_connect("localhost","root","","");
  // $result=mysqli_query($conn,"CREATE DATABASE DB ");
  ?>
    <h2>students info </h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
       <?php
       $message = "";
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "registration";
       // Create connection
       $conn = new mysqli($servername, $username, $password, $dbname);
       
$result=mysqli_query($conn, "SELECT Department_name FROM dep");

// Check if there are results
 if(mysqli_num_rows($result) > 0) {
    // Start the select element
    ?>
    <select name="department" required>';
    <?php
    // Output each row's column value as an option
    while($row = $result->fetch_assoc()) {
        echo "<option value= $row[Department_name]>$row[Department_name] </option>";
    }
    ?>
    </select>
    <?php
} else {
    echo "0 results";
}?>
<div class="submit">
      <input type="submit" name="submit"value="submit" style="background-color: yellow; width: 100px; height: 20px; display:block;">
      </div>
    </form>
    <div class="table">
     <table>
     
        <thead class="th">
          <tr>
            <td>university_id</td>
            <td>full_name</td>
            <td>birthdate</td>
            <td>gpa</td>
            <td>department</td>
            <td>gender</td>
            <td>batch</td>
            <td>remark</td>
          </tr>   
        </thead>
        </div>
        </div>
        <?php
$message = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['submit'])) {
    $id = $_POST['department'];

    $sql = "SELECT * FROM studentform WHERE department = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>". $row["university_id"]. "</td>
            <td>". $row["full_name"]. "</td>
            <td>". $row["birthdate"]. "</td>
            <td>". $row["gpa"]. "</td>
            <td>". $row["department"]. "</td>
            <td>". $row["gender"]. "</td>
            <td>". $row["batch"]. "</td>
            <td>". $row["remark"]. "</td>
          </tr>";
        }
    } else {
        echo "no result";
    }
}
?>
     </table>      
    
</body>
</html>
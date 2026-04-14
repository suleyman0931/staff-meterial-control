<?php
include ('connection.php'); 
if(isset($_GET['submit'])){
    $departmentId = $_GET["departmentId"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="display.css">
</head>
<style>
      table{
        background-color: aliceblue;
        width: 99%;
    }
    th{
        background-color: rgb(63, 54, 54);
        color: rgb(226, 227, 229);
    }
    tr:nth-child(even){
        background-color: #cac0c0;
    }
    tr:nth-child(odd){
        background-color: #fff;
    }
    td{
      margin-left:8px;
      padding-left:5px;
    }
    .update ,.delete{
        color: white;
        width: 40px;
        height: 20px;

    }
    .opp{
        display: inline;
        margin-left:15px;
        margin-right:-30px;
        border:none;
        margin-top: -0px;
    }
    .update{
        background-color: #0283d4;
        padding:2px 10px 5px 10px;
        border:none;
        margin-left:5px;
    }
    .update:hover{
        background-color: #1b9ad1;
    }
    .delete{
        background-color: #d32f2f;
        padding:2px 10px 5px 10px;
        border:none;
        margin-left:5px;
    }
    .delete:hover{
        background-color: #bf1212;
    }
    table ,th ,td{
        border: 1px solid black;
        border-collapse: collapse;
        padding: 6px 0;
        border-radius: 4px;
       margin-left: 10px;
    }
    a{
      text-decoration: none;
      color: aliceblue;
    }
    .table{
      margin-left:230px;
    }
</style>
  <body>
        <nav>
            <?php require "navigation.php"; ?>
        </nav>
        <div class="table">
            <form  method="post">
            <label style="font-size:large;
                font-style:italic;
            ">Select Your department to Display:</label><br/>
                <select id ="departmentId" class="inputs" name ="departmentId" >
                    <?php 
                        
                        $dep='SELECT * from department';
                        // $dep=$conn->query($dep);
                       $dep = mysqli_query($conn,$dep);
                       while($row = mysqli_fetch_array($dep)) {

                    ?>

                    <option style="width:150px;
                    padding:8px;" value="<?php echo $row['departmentId']?>" > <?php echo $row['departmentName'] ?> </option>

                    <?php } ?>
                </select>
                <input type="submit" value="submit" name="submit">
            </form>
            
                <?php
                    
                
                ?>
        <h1>Registered Students List</h1>
        <table>
        <thead>
          <tr>
            <th>Number</th>
              <th>ID</th>
              <th>Name</th>
              <th>Birth Date</th>
              <th>GPA</th>
              <th>Department</th>
              <th>Gender</th>
              <th>Batch</th>
              <th>Remark</th>
              <th>Action</th>
          </tr>
        </thead> 
        <tbody>
            <?php
            include ('connection.php');
              if(isset($_POST['submit'])){
                $departmentId = $_POST["departmentId"];
                $sql1="SELECT * FROM student WHERE department = '$departmentId'";  
                $result1 = $conn->query($sql1);
                $i =1;
                if($result1->num_rows > 0){
                    while($student=$result1->fetch_assoc()){
                      ?>
                      <tr?>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $student["universityId"]; ?></td>
                        <td><?php echo $student["fullName"]; ?></td>
                        <td><?php echo $student["birthDate"]; ?></td>
                        <td><?php echo $student["gpa"];?></td>
                        <td><?php echo $student["department"]; ?></td>
                        <td><?php echo $student["gender"]; ?></td>
                        <td><?php echo $student["batch"]; ?></td>
                        <td><?php echo $student["remark"]; ?></td>             
                      <td class='opp'>
                      <a class="update" href="update.php?id=<?php echo $student['universityId']; ?>" >Update</a>
                      <a class="delete" href="delete.php?id=<?php echo $student['universityId']; ?>" >Delete</a>
                      </td>
                    </tr>
                  <?php
                    }
                  
                }else{

                }
            }//OUTER
                
             ?> 
        </tbody> 
      </table>
        </div>   
      
  </body>
</html>
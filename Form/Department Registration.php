
 <?php
    include "connection.php";
    $error = "";
    $success = "";
    if(isset($_POST['submit'])){
        $departmentId = $_POST["departmentId"];
        $departmentCode = $_POST["departmentCode"];
        $departmentName = $_POST["departmentName"];
        $departmentLocation = $_POST["departmentLocation"];
        $startDate = $_POST["startDate"];
        $college = $_POST["college"];

        $sql1="SELECT * FROM department WHERE departmentId = '$departmentId'";
        $sql2="SELECT * FROM department WHERE departmentName='$departmentName'";
        $sql3="SELECT * FROM department WHERE departmentCode = '$departmentCode'";

        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
        
        if($result2->num_rows>0 && $result1->num_rows>0){
            $error = "The Department Name and Id already exists";
        }else if($result1->num_rows>0){
            $error = "The Department Id  already exists";
        }else if($result2->num_rows>0){
            $error = "The Department Name  already exists";
        }else if($result3->num_rows>0){
            $error = "The Department Code  already exists";
        }else{
            $query = "INSERT INTO department (departmentId,departmentCode,departmentName,departmentLocation,startDate,college)
            values('$departmentId', '$departmentCode', '$departmentName', '$departmentLocation','$startDate','$college')";
    
            $execute = mysqli_query($conn,$query) or die("Unable to insert the record ");
    
            if($execute) {
                $success = "Department registered  successfully!!";
            }
        }   

    }

?>

<!DOCTYPE html>

<html lang="en">
        <head>
        <meta charset ="utf-8">
        <meta name="viewport"
            content="width= device -width,initial-scale =1.0">
        <title>Department registration</title>
        <link rel="stylesheet" href="css/Registration.css">
        </head>
        <style>
            .container{
                margin-left:450px;
            }
            .error{
                color:red;
            }
            .success{
                color:green;
            }
        </style>
        <body>  
        <nav>
            <?php require "Navigation.php"; ?>   
        </nav>       
            <div class="container" id="container">
                
                <div class="error"><?php echo $error;?></div>
                <div class="success"><?php echo $success;?></div>
                <h1>Department Registration</h1>                    
                <form  id="registration" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for ="departmentId">Depatment Id:</label>
                        <input type ="text" class="inputs" id ="departmentId" name ="departmentId" ><br>
                        <span id="idError" class="error"></span>
                    <label for ="departmentCode">Department Code</label>
                        <input type ="text" class="inputs" id ="departmentCode" name ="departmentCode" ><br>
                        <span id="codeError" class="error"></span>
                    <label for ="departmentName">Department Name:</label>
                        <input type ="text" class="inputs" id="departmentName" name="departmentName" ><br>
                        <span id="nameError" class="error"></span>
                    <label for ="departmentLocation">Department Location</label>
                        <input type ="text" class="inputs" id ="departmentLocation" name ="departmentLocation"><br>
                        <span id="locationError" class="error"></span>
                    <label for ="startDate">Department Start Date</label>
                        <input type ="date" class="inputs" id ="startDate" name ="startDate"><br>
                        <span id="startDateError" class="error"></span>
                    <label for ="Collage">College of Department :</label>

                        <select id ="college" class="inputs" name ="college" >
                            
                            <option value="selected">Select the College of the Department </option>
                            <?php  
                            include "connection.php";
                                $col="SELECT * from college";
                                // $col=$conn->query($col);
                            $col = mysqli_query($conn,$col);
                            while($row = mysqli_fetch_array($col)) {

                            ?>

                            <option value="<?php echo $row['collegeId']?>" ><?php echo $row['collegeName'] ?> </option>

                            <?php } ?>
                        </select>
                        <span id="collegeError" class="error"></span>
                    <button style="background-color:cornflowerblue;" type ="submit" name='submit' id="butsub" class="submit">Submit</button>
                    <button  type ="reset" name='reset' id="butres" class="reset">Reset</button>
                </form>
            </div>
        <!-- <script type="text/javascript"  src ="js/Department Registration.js"></script> -->
    </body>
</html>
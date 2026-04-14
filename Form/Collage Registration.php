
<?php
    include "connection.php";
    

    if(isset($_POST['submit'])){
        $collegeId = $_POST["collegeId"];
        $collegeName = $_POST["collegeName"];
        $startDate = $_POST["startDate"];



        // $sql1="SELECT * FROM college WHERE collegeId = '$collegeId'";
        // $sql2="SELECT * FROM college WHERE collegeName='$collegeName'";

        // $result1 = $conn->query($sql1);
        // $result2 = $conn->query($sql2);
        
        // if($result2->num_rows>0 && $result1->num_rows>0){
        //     $error = "The College Name and Id already exists";
        // }else if($result1->num_rows>0){
        //     $error = "The College Id  already exists";
        // }else if($result2->num_rows>0){
        //     $error = "The College Name  already exists";
        // }else{
            $query = "INSERT INTO college (collegeId,collegeName,startDate)
            values('$collegeId',  '$collegeName', '$startDate')";
    
            $execute = mysqli_query($conn,$query) or die("Unable to insert the record ");
    
            if($execute) {
                $success = "College registered  successfully!!";
            }
        // }   

    }

?>

<!DOCTYPE html>

<html lang="en">
        <head>
        <meta charset ="utf-8">
        <meta name="viewport"
            content="width= device -width,initial-scale =1.0">
        <title>College Registration</title>
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
<!--  -->
                <h1>College Registration</h1>                    
                <form  id="registration" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for ="collegeId">College Id:</label>
                        <input type ="text" class="inputs" id ="collegeId" name ="collegeId" ><br>
                        <span id="idError" class="error"></span>
                    <label for ="collegeName">College Name:</label>
                        <input type ="text" class="inputs" id="collegeName" name="collegeName" ><br>
                        <span id="nameError" class="error"></span>
                    <label for ="startDate">College Start Date</label>
                        <input type ="date" class="inputs" id ="startDate" name ="startDate"><br>
                        <span id="startDateError" class="error"></span>

                    <button style="background-color:cornflowerblue;" type ="submit" name='submit' id="butsub" class="submit">Submit</button>
                    <button  type ="reset" name='reset' id="butres" class="reset">Reset</button>
                </form>
            </div>
        <!-- <script type="text/javascript"  src ="js/Department Registration.js"></script> -->
    </body>
</html>
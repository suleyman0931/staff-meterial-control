<?php
// include "connection.php";

//     if(isset($_POST['submit']))
//     {
//     $universityId = $_POST["universityId"];
//     $fullName = $_POST["fullName"];
//     $birthDate = $_POST["birthDate"];
//     $gpa = $_POST["gpa"];
//     $departmentId = $_POST["departmentId"];
//     $gender = $_POST["gender"];
//     $batch = $_POST["batch"];
//     $remark = $_POST["remark"];



//     $query = " UPDATE student set  fullName ='$fullName', birthDate ='$birth_date' ,gpa ='$gpa', department ='$department', gender ='$gender', batch ='$batch',remark ='$remark'  WHERE universityId='$universityId'";
//     $update= mysqli_query($conn,$query);
    
//     if($update){
//         header('location: View Student.php');
//     }
    
// }
?>

<?php

 include ('connection.php');
if(isset($_POST['update'])){

$universityId = $_POST["universityId"];
$fullName = $_POST["fullName"];
$birthDate = $_POST["birthDate"];
$gpa = $_POST["gpa"];
$departmentId = $_POST["departmentId"];
$gender = $_POST["gender"];
$batch = $_POST["batch"];
$remark = $_POST["remark"];


 // Prepare the SQL statement

$query = " UPDATE student set  fullName ='$fullName',birthDate ='$birthDate' ,gpa ='$gpa', departmentId ='$departmentId',gender ='$gender', batch ='$batch',remark ='$remark'  WHERE universityId='$universityId'";
$query_run= mysqli_query($conn,$query);
  
if($query_run){

     header('location: /form/View Student.php');
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <title>Update Student Data</title>
   <link rel="stylesheet" href="css/Registration.css">
</head>
<body>
<div class="container">
  
        <h1>Update Student Data</h1>                    
        <form  id="registration"   action="Update.php" method="get">
            <label for ="universityId">University Id:</label>
                <input type ="text" class="inputs" id ="universityId" name ="universityId" ><br>
                <span id="idError" class="error"></span>
            <label for ="fullName">Full name</label>
                <input type ="text" class="inputs" id ="fullName" name ="fullName" ><br>
                <span id="nameError" class="error"></span>
            <label for ="birthDate">Birth date:</label>
                <input type ="date" class="inputs"  id="birthDate" name="birthDate" ><br>
                <span id="birthError" class="error"></span>
            <label for ="gpa">GPA</label>
                <input type ="text" class="inputs" id ="gpa" name ="gpa"><br>
                <span id="gpaError" class="error"></span>
            <label for ="department">Department:</label>
                <select id ="departmentId" class="inputs" name ="departmentId" >
                    <?php  
                       $dep = mysqli_query($conn,'SELECT * from department');
                       while($row = mysqli_fetch_array($dep)) {

                    ?>

                    <option value="<?php echo $row['departmentId']?>" > <?php echo $row['departmentName'] ?> </option>

                    <?php } ?>
                </select>
                <span id="departmentError" class="error"></span>
            <label for="gender">Gender:</label>
            <div class="radio">
                <div>
                    <input type="radio" id="male" name="gender" value="male" />
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="female" />
                    <label for="female">Female</label>
                </div>
                <span id="genderError" class="error"></span>
           
            </div>
                
            <label for ="batch">Batch :</label>
                <input type ="text"   class="batch" id ="batch" name ="batch" ><br>
                <span id="batchError" class="error"></span>
            <label for ="remark" >Remarks:</label><br>
                <textarea id="remark " rows="10" cols="50" name ="remark"></textarea><br>
                <span id="messageError" class="error"></span>
            <button  type ="submit" name='update' value="update" class="reset">Submit</button>
            <button  type ="reset" name='reset' class="reset">Reset</button>

            </form>
    </div>
    <script type="text/javascript"  src="js/registration.js"></script>
</body>
</html>
<?php

if(isset($_POST['submit'])){
        $universityId = $_POST["universityId"];
        $fullName = $_POST["fullName"];
        $birthDate = $_POST["birthDate"];
        $gpa = $_POST["gpa"];
        $department = $_POST["department"];
        $gender = $_POST["gender"];
        $batch = $_POST["batch"];
        $remark = $_POST["remark"];

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $fullName=($_POST["fullName"]);

            $query2="select * from student where fullName='$fullName'";
            $result=mysqli_query($conn,$query2);
            if(mysqli_num_rows($result)>0){
                echo "the name already exists";
                exit;
            } 
        }        
        $query = "INSERT INTO student (universityId,fullName,birthDate,gpa, department,gender,batch,remark)
        values('$universityId','$fullName','$birthDate','$gpa','$department','$gender','$batch','$remark')";


        $result=$conn->query($query);
        if($result){
            echo "You have registered the student successfully!!";
        }

        header("location: /form/Student Registration.php");
       
    }
    
?>
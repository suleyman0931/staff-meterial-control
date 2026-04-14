<?php

include "connection.php";
?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <title>student registration</title>
    <link rel="stylesheet" href="css/Registration.css">
</head>
<style>
    .container {
        margin-left: 330px;
    }
</style>

<body>
    <nav>
        <?php require "navigation.php"; ?>
    </nav>
    <div class="container">
        <h1>Student Registration</h1>
        <form id="registration" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="universityId">University Id:</label>
            <input type="text" class="inputs" id="universityId" name="universityId"><br>
            <span id="idError" class="error"></span>
            <label for="fullName">Full name</label>
            <input type="text" class="inputs" id="fullName" name="fullName"><br>
            <span id="nameError" class="error"></span>
            <label for="birthDate">Birth date:</label>
            <input type="date" class="inputs" id="birthDate" name="birthDate"><br>
            <span id="birthError" class="error"></span>
            <label for="gpa">GPA</label>
            <input type="text" class="inputs" id="gpa" name="gpa"><br>
            <span id="gpaError" class="error"></span>
            <label for="collegeId">College:</label>
            <select id="college" class="inputs" name="collegeId">
                <option value="">Select college</option>
                <?php
                include "connection.php";
                $col = "SELECT * from college";
                // $col=$conn->query($col);
                $col = mysqli_query($conn, $col);
                while ($row = mysqli_fetch_array($col)) {

                    ?>

                    <option value="<?php echo $row['collegeId'] ?>"><?php echo $row['collegeName'] ?> </option>

                <?php } ?>
            </select>
            <span id="collegeError" class="error"></span>

            <label for="department">Department:</label>
            <select id="department" class="inputs" name="department">
                <option value="">Select Department</option>

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

            <label for="batch">Batch :</label>
            <input type="text" class="batch" id="batch" name="batch"><br>
            <span id="batchError" class="error"></span>
            <label for="remark">Remarks:</label><br>
            <textarea id="remark " rows="10" cols="50" name="remark"></textarea><br>
            <span id="messageError" class="error"></span>
            <button style="background-color:cornflowerblue;" type="submit" name='submit' class="reset">Submit</button>
            <button style="background-color:brown;" type="reset" name='reset' class="reset"
                onclick="resetForm()">Reset</button>

        </form>
    </div>

    <script type="text/javascript" src="js/registration.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#college').on('change', function () {
                var $college = $('#college').value;

                $.ajax({
                    url: "department_ajax.php",
                    type: "POST",
                    data: {
                        college: college
                    },
                    cache: false,
                    success: function (data) {
                        $("#department").html(data);
                        // console.log(data);
                    }
                });
            });
        });

    </script>
</body>

</html>
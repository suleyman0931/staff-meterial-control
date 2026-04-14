<?php
include "connection.php";

$error = "";
$success = "";

if (isset($_POST['submit'])) {
    $universityId = $_POST["universityId"];
    $fullName = $_POST["fullName"];
    $birthDate = $_POST["birthDate"];
    $gpa = $_POST["gpa"];
    $collegeId = $_POST["collegeId"];
    $department = $_POST["department"];
    $gender = $_POST["gender"];
    $batch = $_POST["batch"];
    $remark = $_POST["remark"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the universityId already exists
        $query1 = "SELECT * FROM student WHERE universityId='$universityId'";
        $result1 = mysqli_query($conn, $query1);

        if (mysqli_num_rows($result1) > 0) {
            $error = "The university ID already exists";
        } else {
            // Check if the fullName already exists
            $query2 = "SELECT * FROM student WHERE fullName='$fullName'";
            $result2 = mysqli_query($conn, $query2);

            if (mysqli_num_rows($result2) > 0) {
                $error = "The name already exists";
            } else {
                // Insert new student record
                $query = "INSERT INTO student (universityId, fullName, birthDate, gpa, collegeId, department, gender, batch, remark)
                          VALUES ('$universityId', '$fullName', '$birthDate', '$gpa', '$collegeId', '$department', '$gender', '$batch', '$remark')";

                $result = mysqli_query($conn, $query);
                if ($result) {
                    $success = "You have registered the student successfully!!";
                } else {
                    $error = "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="css/Registration.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .inputs,
        .batch {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .submit,
        .reset {
            padding: 10px 15px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit {
            background-color: cornflowerblue;
            color: #fff;
        }

        .reset {
            background-color: brown;
            color: #fff;
        }

        .error,
        .success {
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            .inputs,
            .batch,
            .submit,
            .reset {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav>
        <?php require "navigation.php"; ?>
    </nav>
    <div class="container">
        <h1>Student Registration</h1>
        <div class="error"><?php echo $error; ?></div>
        <div class="success"><?php echo $success; ?></div>
        <form id="registration" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="universityId">University Id:</label>
            <input type="text" class="inputs" id="universityId" name="universityId" required><br>
            <span id="idError" class="error"></span>
            <label for="fullName">Full Name:</label>
            <input type="text" class="inputs" id="fullName" name="fullName" required><br>
            <span id="nameError" class="error"></span>
            <label for="birthDate">Birth Date:</label>
            <input type="date" class="inputs" id="birthDate" name="birthDate" required><br>
            <span id="birthError" class="error"></span>
            <label for="gpa">GPA:</label>
            <input type="text" class="inputs" id="gpa" name="gpa" required><br>
            <span id="gpaError" class="error"></span>
            <label for="collegeId">College:</label>
            <select id="college" class="inputs" name="collegeId" required>
                <option value="">Select College</option>
                <?php
                $col = "SELECT * FROM college";
                $col = mysqli_query($conn, $col);
                while ($row = mysqli_fetch_array($col)) {
                    echo "<option value='" . $row['collegeId'] . "'>" . $row['collegeName'] . "</option>";
                }
                ?>
            </select>
            <span id="collegeError" class="error"></span>
            <label for="department">Department:</label>
            <select id="department" class="inputs" name="department" required>
                <option value="">Select Department</option>
            </select>
            <span id="departmentError" class="error"></span>
            <label for="gender">Gender:</label>
            <div class="radio">
                <div>
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="female" required>
                    <label for="female">Female</label>
                </div>
                <span id="genderError" class="error"></span>
            </div>
            <label for="batch">Batch:</label>
            <input type="text" class="batch" id="batch" name="batch" required><br>
            <span id="batchError" class="error"></span>
            <label for="remark">Remarks:</label><br>
            <textarea class="inputs" id="remark" rows="4" cols="50" name="remark"></textarea><br>
            <span id="messageError" class="error"></span>
            <button type="submit" name="submit" class="submit">Submit</button>
            <button type="reset" name="reset" class="reset" onclick="resetForm()">Reset</button>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#college').on('change', function () {
                var collegeId = $(this).val();
                $.ajax({
                    url: "department_ajax.php",
                    type: "POST",
                    data: { collegeId: collegeId },
                    cache: false,
                    success: function (data) {
                        $("#department").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>
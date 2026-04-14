<?php
include "connection.php";
$error = "";
$success = "";
if (isset($_POST['submit'])) {
    $departmentId = $_POST["departmentId"];
    $departmentCode = $_POST["departmentCode"];
    $departmentName = $_POST["departmentName"];
    $departmentLocation = $_POST["departmentLocation"];
    $startDate = $_POST["startDate"];
    $collegeId = $_POST["collegeId"];

    $sql1 = "SELECT * FROM department WHERE departmentId = '$departmentId'";
    $sql2 = "SELECT * FROM department WHERE departmentName = '$departmentName'";
    $sql3 = "SELECT * FROM department WHERE departmentCode = '$departmentCode'";

    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);

    if ($result2->num_rows > 0 && $result1->num_rows > 0) {
        $error = "The Department Name and Id already exist";
    } else if ($result1->num_rows > 0) {
        $error = "The Department Id already exists";
    } else if ($result2->num_rows > 0) {
        $error = "The Department Name already exists";
    } else if ($result3->num_rows > 0) {
        $error = "The Department Code already exists";
    } else {
        $query = "INSERT INTO department (departmentId, departmentCode, departmentName, departmentLocation, startDate, collegeId)
                  VALUES ('$departmentId', '$departmentCode', '$departmentName', '$departmentLocation', '$startDate', '$collegeId')";

        $execute = mysqli_query($conn, $query) or die("Unable to insert the record");

        if ($execute) {
            $success = "Department registered successfully!!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Registration</title>
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

        .inputs {
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
            background-color: #ccc;
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
            .submit,
            .reset {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <?php require "Navigation.php"; ?>
    </nav>
    <div class="container" id="container">
        <div class="error"><?php echo $error; ?></div>
        <div class="success"><?php echo $success; ?></div>
        <h1>Department Registration</h1>
        <form id="registrationForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="departmentId">Department ID:</label>
            <input type="text" class="inputs" id="departmentId" name="departmentId" required><br>
            <span id="idError" class="error"></span>

            <label for="departmentCode">Department Code:</label>
            <input type="text" class="inputs" id="departmentCode" name="departmentCode" required><br>
            <span id="codeError" class="error"></span>

            <label for="departmentName">Department Name:</label>
            <input type="text" class="inputs" id="departmentName" name="departmentName" required><br>
            <span id="nameError" class="error"></span>

            <label for="departmentLocation">Department Location:</label>
            <input type="text" class="inputs" id="departmentLocation" name="departmentLocation" required><br>
            <span id="locationError" class="error"></span>

            <label for="startDate">Department Start Date:</label>
            <input type="date" class="inputs" id="startDate" name="startDate" required><br>
            <span id="startDateError" class="error"></span>

            <label for="collegeId">College of Department:</label>
            <select id="collegeId" class="inputs" name="collegeId" required>
                <option value="" selected disabled>Select the College of the Department</option>
                <?php
                include "connection.php";
                $col = "SELECT * from college";
                $col = mysqli_query($conn, $col);
                while ($row = mysqli_fetch_array($col)) {
                    ?>
                    <option value="<?php echo $row['collegeId']; ?>"><?php echo $row['collegeName']; ?></option>
                <?php } ?>
            </select>
            <span id="collegeError" class="error"></span>
            <button type="submit" name="submit" id="submitButton" class="submit">Submit</button>
            <button type="reset" name="reset" id="resetButton" class="reset">Reset</button>
        </form>
    </div>
</body>

</html>
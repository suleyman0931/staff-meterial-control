<?php
include "connection.php";

if (isset($_POST['submit'])) {
    $collegeId = $_POST["collegeId"];
    $collegeName = $_POST["collegeName"];
    $startDate = $_POST["startDate"];
    $error = '';

    // Check if the collegeId already exists
    $sql1 = "SELECT * FROM college WHERE collegeId = '$collegeId'";
    $result1 = mysqli_query($conn, $sql1);

    // Check if the collegeName already exists
    $sql2 = "SELECT * FROM college WHERE collegeName = '$collegeName'";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0) {
        $error = "The College Name and Id already exist";
    } else if (mysqli_num_rows($result1) > 0) {
        $error = "The College Id already exists";
    } else if (mysqli_num_rows($result2) > 0) {
        $error = "The College Name already exists";
    } else {
        $query = "INSERT INTO college (collegeId, collegeName, startDate)
                  VALUES ('$collegeId', '$collegeName', '$startDate')";

        $execute = mysqli_query($conn, $query) or die("Unable to insert the record");

        if ($execute) {
            $success = "College registered successfully!!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Registration</title>
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
        <h1>College Registration</h1>
        <form id="registration" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="collegeId">College Id:</label>
            <input type="text" class="inputs" id="collegeId" name="collegeId"><br>
            <span id="idError"
                class="error"><?php echo isset($error) && strpos($error, 'Id') !== false ? $error : ''; ?></span>

            <label for="collegeName">College Name:</label>
            <input type="text" class="inputs" id="collegeName" name="collegeName"><br>
            <span id="nameError"
                class="error"><?php echo isset($error) && strpos($error, 'Name') !== false ? $error : ''; ?></span>

            <label for="startDate">College Start Date:</label>
            <input type="date" class="inputs" id="startDate" name="startDate"><br>
            <span id="startDateError" class="error"></span>

            <button type="submit" name="submit" id="butsub" class="submit">Submit</button>
            <button type="reset" name="reset" id="butres" class="reset">Reset</button>

            <?php if (isset($success)): ?>
                <span class="success"><?php echo $success; ?></span>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>
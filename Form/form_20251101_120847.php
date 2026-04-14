<!DOCTYPE html>
<html>

<head>
    <title>student register</title>
    <style>
        div {
            background-color: aqua;
            margin: 50px;
            padding-left: 100px;
            padding-right: 100px;
            width: 450px;
            border-radius: 10px;
        }

        body {
            /*display: flex;
    justify-content: space-around;*/
            width: 760px;
            height: 640px;
            margin: auto;
            padding: 20px;
            background-image: url(78b92e9cd09b67ed4936da40fd4acd82.jpg);
        }

        h1 {
            text-align: center;
            color: black;
        }
    </style>
</head>
<?php
$message = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
//if ($conn->connect_error) {
//  die("Connection failed: ". $conn->connect_error);}
//echo "Connected successfully";
if (isset($_POST['submit'])) {
    $university_id = $_POST["university_id"];
    $full_name = $_POST["full_name"];
    $birthdate = $_POST["birthdate"];
    $gpa = $_POST["gpa"];
    $department = $_POST["department"];
    $college = $_POST["college"];
    $gender = $_POST["gender"];
    $batch = $_POST["batch"];
    $remark = $_POST["remark"];


    // Prepare the SQL statement

    $query = "Insert Into studentform (university_id,full_name,birthdate, gpa,college, department, gender, batch,remark)
    values('$university_id', '$full_name', '$birthdate', '$gpa', '$department','$college' ,'$gender', '$batch','$remark')";
    $execute = mysqli_query($conn, $query) or die("Unable to insert the record, because of " . mysqli_error($conn, $query));

    if ($execute) {

        $message = "You have registered the student successfully!!";
    }

}
?>

<body>
    <div>
        <!-- <form id="student_form" action="?<method="post"> -->
        <form id="student_form" action="" method="post">

            <h1>student register</h1>
            <p style="color: green;"><?php echo $message; ?></p>
            <p>university id:
                <input type="text" name="university_id" id="university_id">
                <span id="university_id_error" style="color: red;"></span> <!-- Error message -->
            </p>
            <p>full name:
                <input type="text" name="full_name" id="full_name">
                <span id="full_name_error" style="color: red;"></span> <!-- Error message -->
            </p>
            <p>birthdate:
                <input type="date" name="birthdate" id="birthdate">
                <span id="birthdate_error" style="color: red;"></span> <!-- Error message -->
            </p>
            <p>GPA:
                <input type="number" name="gpa" id="gpa" step="0.01">
                <span id="gpa_error" style="color: red;"></span> <!-- Error message -->
            </p>
            <p>college:
                <select id="college" value="college" name="college">
                    <option value="school of computing">school of computing</option>

                </select>
            </p>
            <p>department:
                <select id="department" value="IT" name="department">
                    <option value="computer science">computer science</option>
                    <option value="software engineering">software engineering</option>
                    <option value="IT">IT</option>
                </select>
            </p>
            <p>gender:
                <input type="radio" name="gender" value="male" id="male">male:
                <input type="radio" name="gender" value="male" id="female">female:
            </p>
            <p>batch:
                <input type="number" name="batch" id="batch" min="1" max="6">
                <span id="batch_error" style="color: red;"></span> <!-- Error message -->
            </p>
            <p>Remark:
                <textarea name="remark" id="remark" cols="30" rows="10"></textarea>
            </p>

            <div id="error_message" style="color: gray; font-size: large;"></div>
            <p>
                <input type="submit" name="submit" value="submit" style="background-color: blue; width: 200px; height: 30px;
        border:none; border-radius:5px;
        " onclick="return validateForm()">
                <input type="button" value="clear" style="background-color: red; width: 200px; height: 30px;  border:none; border-radius:5px;
    " onclick="clearForm()">
            </p>

        </form>
    </div>
    <script>
        function validateForm() {
            var universityId = document.getElementById("university_id").value;
            var fullName = document.getElementById("full_name").value;
            var birthdate = new Date(document.getElementById("birthdate").value);
            var gpa = document.getElementById("gpa").value;
            var batch = document.getElementById("batch").value;
            var errorMessage = document.getElementById("error_message");
            // Clear previous error messages
            errorMessage.innerHTML = "";
            // University ID validation
            var universityIdError = document.getElementById("university_id_error");
            universityIdError.innerHTML = "";
            if (!universityId.match(/^wdu\s\d{6}$/)) {
                universityIdError.innerHTML = "University ID must start with 'wdu', followed by a space, and then 6 digits.";
            }
            // Full name validation
            var fullNameError = document.getElementById("full_name_error");
            fullNameError.innerHTML = "";
            if (!fullName.match(/^[a-zA-Z\s]{3,}$/)) {
                fullNameError.innerHTML = "Full name must contain only alphabets and whitespace and have a minimum length of 3 characters.";
            }
            // Birthdate validation
            var birthdateError = document.getElementById("birthdate_error");
            birthdateError.innerHTML = "";
            var today = new Date();
            var age = today.getFullYear() - birthdate.getFullYear();
            var m = today.getMonth() - birthdate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            if (age < 18) {
                birthdateError.innerHTML = "You must be at least 18 years old to register.";
            }
            // GPA validation
            var gpaError = document.getElementById("gpa_error");
            gpaError.innerHTML = "";
            if (isNaN(gpa) || gpa < 2 || gpa > 4) {
                gpaError.innerHTML = "GPA must be a number between 2 and 4.";
            }
            // Batch validation
            var batchError = document.getElementById("batch_error");
            batchError.innerHTML = "";
            if (isNaN(batch) || batch < 1 || batch > 6) {
                batchError.innerHTML = "Batch must be a number between 1 and 6.";
            }
            // If there are validation errors
            if (universityIdError.innerHTML !== "" || fullNameError.innerHTML !== "" || birthdateError.innerHTML !== "" || gpaError.innerHTML !== "" || batchError.innerHTML !== "") {
                return false;
            }
            // If all validations pass
            return true;
        }
        function clearForm() {
            document.getElementById("student_form").reset();
            // Clear error messages
            var errorElements = document.querySelectorAll('[id$="_error"]');
            for (var i = 0; i < errorElements.length; i++) {
                errorElements[i].innerHTML = "";
            }
        }
    </script>
</body>

</html>
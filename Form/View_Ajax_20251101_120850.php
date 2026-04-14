<?php
include 'connection.php';

if (isset($_GET['department'])) {
    $department = $_GET['department'];

    // Change the SQL query to use the correct data type for binding
    $sql = "SELECT * FROM student WHERE department =  ? ";
    $stmt = $conn->prepare($sql);
    
    // Check if the prepare() function succeeded
    if ($stmt === false) {
        echo json_encode(["error" => "Failed to prepare the SQL query: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $department);
    $stmt->execute();
    $result = $stmt->get_result();

    $students = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
    echo json_encode($students);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students by Department</title>
    <link href="student-style.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <h1>Students by Department</h1>
        <label for="departments">Select Department:</label>
        <select id="department" onchange="fetchStudents()">
            <!-- Options will be populated here by PHP -->
            ,<option value="default" selected="selected">Select Department</option>
            <?php
            $sql = "SELECT departmentId, departmentName FROM department";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['departmentId']."'>".$row['departmentName']."</option>";
                }
            }
            ?>
        </select>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>GPA</th>
                    <th>Department</th>
                    <th>Gender</th>
                    <th>Batch</th>
                    <th>Remark</th>


                </tr>
            </thead>
            <tbody id="students-table">
                <!-- Student rows will be populated here by JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        function fetchStudents() {
            
            const department = document.getElementById('department').value;
            alert(department);
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `View_Ajax.php?department=${department}`, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    console.log('Request finished with status: ' + xhr.status);
                    if (xhr.status == 200) {
                        console.log('Response: ' + xhr.responseText);

                        try {
                            
                            const students = JSON.parse(xhr.responseText);
                            if (students.error) {
                                console.error(students.error);
                                return;
                            }
                            const studentsTable = document.getElementById('students-table');
                            studentsTable.innerHTML = ''; // Clear previous rows
                            students.forEach(student => {
                                const row = document.createElement('tr');
                                const idCell = document.createElement('td');
                                const nameCell = document.createElement('td');
                                const birthDate = document.createElement('td');
                                const gpaCell = document.createElement('td');
                                const departmentCell = document.createElement('td');
                                const genderCell = document.createElement('td');
                                const batchCell = document.createElement('td');
                                const remarkCell = document.createElement('td');   
                                
                                
                                // const 

                                idCell.textContent = student.universityId;
                                nameCell.textContent = student.fullName;
                                birthDate.textContent = student.birthDate;
                                gpaCell.textContent = student.gpa;
                                departmentCell.textContent = student.department;
                                genderCell.textContent = student.gender;
                                batchCell.textContent = student.batch;
                                remarkCell.textContent = student.remark;


                                row.appendChild(idCell);
                                row.appendChild(nameCell);
                                row.appendChild(birthDate);
                                row.appendChild(gpaCell);
                                row.appendChild(departmentCell);
                                row.appendChild(genderCell);
                                row.appendChild(batchCell);
                                row.appendChild(remarkCell);

                                studentsTable.appendChild(row);
                            });
                        } catch (e) {
                            console.error('Error parsing JSON response: ', e);
                        }
                    } else {
                        console.error('Error fetching data');
                    }
                }
            };

            console.log('Sending request to: ' + `View_Ajax.php?department=${department}`);
            xhr.send();
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchStudents(); // Fetch students for the default department on page load
        });
    </script>
</body>
</html>

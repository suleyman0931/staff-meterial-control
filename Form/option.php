<?php
include 'connection.php';

if (isset($_GET['college'])) {
    $college = $_GET['college'];

    // Change the SQL query to use the correct data type for binding
    $sql = "SELECT * FROM department WHERE college =  ? ";
    $stmt = $conn->prepare($sql);
    
    // Check if the prepare() function succeeded
    if ($stmt === false) {
        echo json_encode(["error" => "Failed to prepare the SQL query: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $college);
    $stmt->execute();
    $result = $stmt->get_result();

    $departments = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }
    }
    echo json_encode($departments);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>department by college</title>
    <link href="student-style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1>department by college</h1>
        <label for="colleges">Select college:</label>
        <select id="college" onchange="fetchDepartment()">
            <!-- Options will be populated here by PHP -->
            <option value="default" selected="selected">Select college</option>
            <?php
            $sql = "SELECT collegeId, collegeName FROM college";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['collegeId']."'>".$row['collegeName']."</option>";
                }
            }
            ?>
        </select>
        <label for="departments">Select department:</label>
        <select id="department">

        </select>

        
    </div>

    <script>
        function fetchDepartment() {
            
            const college = document.getElementById('college').value;
            // alert(college);
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `option?college=${college}`, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    console.log('Request finished with status: ' + xhr.status);
                    if (xhr.status == 200) {
                        // console.log('Response: ' + xhr.responseText);
            alert(college);


                        try {
                            
                            const department = JSON.parse(xhr.responseText);
                            if (department.error) {
                                console.error(department.error);
                                return;
                            }
                            const departmentOption = document.getElementById('department');
                            departmentOption.innerHTML = ''; // Clear previous rows
                            department.forEach(department => {
                                const selection = document.createElement('option');
                                const selection2 = document.createElement('select');

                          
                                
                                // const 

                                selection2.textContent = "Select Department";
                                selection.textContent = department.departmentName;




                                row.appendChild(selection2);
                                row.appendChild(selection);


                        
                                departmentOption.appendChild(selection);
                            });
                        } catch (e) {
                            console.error('Error parsing JSON response: ', e);
                        }
                    } else {
                        console.error('Error fetching data');
                    }
                }
            };

            console.log('Sending request to: ' + `option.php?college=${college}`);
            xhr.send();
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchDepartment(); // Fetch department for the default college on page load
        });
    </script>
</body>
</html>

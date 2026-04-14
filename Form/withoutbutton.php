<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <style>
    table {
            width:10px ;
            border-collapse: collapse;
            background-color:yellow;
        }
    th, td {
            border: 1px solid black;
            padding: 15px;
            text-align: left;
        }
    th {
            background-color: #f2f2f2;
        }
        body{
           background-color:lightgray;

        }
    </style>
</head>
<body class="body">
<div class="div">
    <h2>students info </h2>
    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
       <?php
       $message = "";
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "registration";
       
       // Create connection
       $conn = new mysqli($servername, $username, $password, $dbname);
       
       $queryy = "SELECT Department_name FROM dep";
       $result = $conn->query($queryy);

       // Check if there are results
       if ($result->num_rows > 0) {
           // Start the select element
           echo '<select name="department" id="department" required onchange="updateTable(this.value)">';
           
           // Output each row's column value as an option
           while($row = $result->fetch_assoc()) {
               echo '<option value="'. $row['Department_name']. '">'. $row['Department_name']. '</option>';
           }
           
           // Close the select element
           echo '</select>';
       } else {
           echo "0 results";
       }
      ?>
    </form>
</div>
     <table id="student-table">
     
      
        <?php
        $message = "";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "registration";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if (isset($_POST['submit'])) {
            $id = $_POST['department'];

            $sql = "SELECT * FROM studentform WHERE department = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
            
                    <td>". $row["university_id"]. "</td>
                    <td>". $row["full_name"]. "</td>
                    <td>". $row["birthdate"]. "</td>
                    <td>". $row["gpa"]. "</td>
                    <td>". $row["department"]. "</td>
                    <td>". $row["gender"]. "</td>
                    <td>". $row["batch"]. "</td>
                    <td>". $row["remark"]. "</td>
                  </tr>";
                }
            } else {
                echo "no result";
            }
        }

        // Get the department value from the query parameter
        $department = isset($_GET['department'])? $_GET['department'] : '';

        if (!empty($department)) {
            $sql = "SELECT * FROM studentform WHERE department = '$department'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table id='student-table'>";
                echo "<thead class='th'>";
                echo "<tr>";
                echo "<td>university_id</td>";
                echo "<td>full_name</td>";
                echo "<td>birthdate</td>";
                echo "<td>gpa</td>";
                echo "<td>department</td>";
                echo "<td>gender</td>";
                echo "<td>batch</td>";
                echo "<td>remark</td>";
                echo "</tr>";
                echo "</thead>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row["university_id"]. "</td>";
                    echo "<td>" . $row["full_name"]. "</td>";
                    echo "<td>". $row["birthdate"]. "</td>";
                    echo "<td>". $row["gpa"]. "</td>";
                    echo "<td>". $row["department"]. "</td>";
                    echo "<td>". $row["gender"]. "</td>";
                    echo "<td>". $row["batch"]. "</td>";
                    echo "<td>". $row["remark"]. "</td>";
                    echo "</``r>";
                }

                echo "</table>";
            } else {
                echo "no result";
            }
        }

        $conn->close();
        ?>
     </table>      

<script>
    function updateTable(department) {
        window.location.href = "?department=" + department;
    }
</script>

</body>
</html>
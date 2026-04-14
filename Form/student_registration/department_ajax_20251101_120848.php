<?php
        include  "connection.php";
        if(isset($_GET['college'])){
            $college = $_GET['college'];
            $sql = "SELECT * From department WHERE college='$college' ";
            $dep = mysqli_query($conn ,$sql);
?>
    <select name="department" class="department" id="department">
        <option selected="selected">Select Department</option>
        <?php
            while ($row = mysqli_fetch_assoc($dep)){?>
                <option value="<?php echo $row['departmentId']?>" ><?php echo $row['departmentName'] ?> </option>
            <?php    
            }
        ?>
    </select>
<?php
    }
?>
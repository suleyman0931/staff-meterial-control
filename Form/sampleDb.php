<?php
require "connectionN.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php

$sqll = "CREATE TABLE STUDD(
Username varchar(255) not null,
Email varchar(255) not null,
password varchar(255) not null
)";
 
 if($conn->query($sqll) === true){
    echo "table created successfully";
 }
else{
    echo "error creating table".$conn->error;
}


?>
<body>
    
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div>
                  <label for="Username">Username</label><br>
        <input type="text" name="name" id="name">
        </div>
        <div>
        <label for="Email">Email</label><br>
        <input type="email" name="email" id="email">
        </div>
        <div>
        <label for="password">password</label><br>
        <input type="password" name="password" id="password">
        </div>
        <div>
        <input type="submit" value="submit">
        </div>
            </form>
       
    </div>
</body>
</html>
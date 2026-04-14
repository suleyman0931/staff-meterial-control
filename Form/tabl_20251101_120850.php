<?php
include("conc.php");
//$result=mysqli_query($conn," DROP table stud");
$result=mysqli_query($conn,"CREATE table stud(id int primary key,
username varchar(20) not null,
password varchar(20) not null,
email varchar(20) not null,
phone varchar(20)
)");
if($result){
    echo "table crate seccessfully";
}
?>
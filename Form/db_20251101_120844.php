<?php
include("conc.php");
$result=mysqli_query($conn,"CREATE DATABASE DHHH");
if(!$result){
    echo "database not create";
}
?>
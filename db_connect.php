<?php

$conn=mysqli_connect("localhost","root","");//initialize connection to the database
mysqli_select_db($conn,"quiz");//select the database to access

//check for success
if(!$conn){
  die("connection failed");
}

 ?>

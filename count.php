<?php
  require 'db_connect.php';
  $limit=2;
  $count = 0;
  $sql1="select count(sno) from data";
  //Execute the query against the database
  if(!($result1=mysqli_query($conn,$sql1))){
    die("Problem in SQL statement");
  }else {
    $row=mysqli_fetch_array($result1,MYSQLI_NUM);
    $count=$row[0];
    mysqli_free_result($result1);
  }
  if($count==0){
    echo "No Records found";
  }else {
    echo "Records are ".$count."<br>";
  }
?>

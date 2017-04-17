<?php
  session_start();
  require 'count.php';
  require 'db_connect.php';
  $xml=simplexml_load_file("file.php");
  $arr = array();
  $cnt=$_POST['cont'];
  for ($i=0; $i < $cnt ; $i++) {
    $st = ($i+1)."d";
    $arr[$i] = $_POST[$st];
    $str[$i] = $xml->answer[$i]->ans;
  }
  //$arr[0] = $_POST["1d"];
  //$arr[1] = $_POST["2d"];
  /*$myfile=fopen("file.php","r");
  //flock($myfile,LOCK_UN);
  $j=0;
  while(!feof($myfile)) {
    $str[$j]=fgets($myfile);
    $str[$j]=rtrim($str[$j]);
    $j=$j+1;
  }*/
  $cnt1=0;
  for ($i=0; $i < $cnt; $i++) {
    $a1=$arr[$i];
    $a2=$str[$i];
    if(!strcmp($a1,$a2)){
      $cnt1=$cnt1+1;
    }
    //echo $arr[$i]<=>$str[$i];
    //echo $arr[$i]."-----".$str[$i]."<br>";
  }
  if(!isset($_SESSION['mark'])){
	  $_SESSION['mark']=$cnt1;
  }
  $sql="INSERT INTO marks VALUES('".$_SESSION["user"]."','".$_SESSION['mark']."')";
  if(mysqli_query($conn,$sql)){
  echo "<br><br><br><h1 align='center'>Hello<b style='color:slateblue'> ".$_SESSION["user"]."</b> ";//<a href='logout.php'>Logout</a></h1>";
  echo "<br><br><br><h1 align='center'>Your score out of <b style='color:brown'>".($cnt)."</b> is <b style='color:green'>".$_SESSION['mark']."</b></h1>";
  
  echo "<br><br><br><h1 align='center'>Thank you</h1>";
  }else{
	echo "<br><br><br><h1 align='center'>Error ".mysqli_error($conn)."</h1>";
  }
  /*echo "<br><br><br><b style='color:green'>Reasons for the Answer</b><br><br>";
  for($i=0;$i < $cnt;$i++){
    echo ($i+1).")<b>Reason</b> : ".$xml->answer[$i]->rea."<br>";
  }*/
 ?>

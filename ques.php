<?php
  require 'count.php';
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
    echo $arr[$i]."-----".$str[$i]."<br>";
  }
  echo "Score out of ".($cnt)." is ".$cnt1;
  echo "<br><br>Reasons for the Answer<br><br>";
  for($i=0;$i < $cnt;$i++){
    echo ($i+1).")Reason : ".$xml->answer[$i]->rea."<br>";
  }
 ?>

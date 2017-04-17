<?php
session_start();
if(!isset($_SESSION["user"])){
	$_SESSION["user"]=$_POST["user"];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <title>Hello</title>
<?php
  require 'count.php';
  if(isset($_GET["page"])){
    $page = $_GET["page"];
  }else{
    $page=1;
  }
  $cnt=0;
  $start_from = ($page-1)*$limit;
  //echo $page." ".$start_from;
  $split=ceil($count/$limit);
try{
  //file_put_contents("file.php","");
  $myfile = fopen("file.php","w");
  $txt="<?xml version='1.0' encoding='UTF-8'?>\n<all>";
}catch(Exception $e){}
 ?>
<script>
   function hot1(cnt){
     let a=document.getElementById('ayan');
     n=a.length;
     //document.write(n);
     for(i=0,l=1;i<n;i++){
       if(a[i].checked){
         var b=document.getElementById(l);
          b.value=a[i].value;
          l++;
       }
     }
     //cnt=<?php echo $cnt; ?>;
     document.getElementById("cnt").value=cnt;
     l=l-1;
     //alert(cnt);alert(l);
     if(cnt==l && cnt!=0 && l!=0){
       //alert("Click the SUBMIT QUERY button");
       document.getElementById("go").click();
     }else{
       alert("Missed some Question :(");
     }
   }
</script>
</head>
<body>
	<div class="container">
        <div class="page-header">
          <div class="row">
            <div class="col-sm-6"><h1>Quiz For Us</h1></div>
	    <div class="col-sm-3">Welcome <b><?php echo $_SESSION["user"] ?></b></div>
            <div class="col-sm-3"><?php echo date("d-m-y") ?></div>
          </div>
           
        </div>
<?php
  //queries to pass
  //$sql="select * from data ORDER BY sno ASC LIMIT 0,2";
  $sql="select * from data ORDER BY sno ASC LIMIT ".$start_from.",".$limit;
  //echo $sql;

  if(!($result=mysqli_query($conn,$sql))){
    die("Problem in SQL statement");
  }
  $c="ch";
  //$txt="";
  $j=0;
  //displaying the records fetched from database
  if(mysqli_num_rows($result)>0){
    echo "<form id='ayan'>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<h3><div style='color:blue;'>".($j+1)."-";
      echo $row["ques"];echo "?</div></h3><div class='jumbotron'><div class='row'>";
      echo "<div class='col-sm-3'><input type='radio' name='".$c.$row["sno"]."' id='".$c.$row["sno"]."a"."' value='a' />".$row["a"];echo "</div>";
      echo "<div class='col-sm-3'><input type='radio' name='".$c.$row["sno"]."' id='".$c.$row["sno"]."b"."' value='b' />".$row["b"];echo "</div>";
      echo "<div class='col-sm-3'><input type='radio' name='".$c.$row["sno"]."' id='".$c.$row["sno"]."c"."' value='c' />".$row["c"];echo "</div>";
      echo "<div class='col-sm-3'><input type='radio' name='".$c.$row["sno"]."' id='".$c.$row["sno"]."d"."' value='d' />".$row["d"];echo "</div></div></div>";
      $txt=$txt."<answer>\n";
      $txt=$txt."<ans>".$row["ans"]."</ans>"."\n";
      $txt=$txt."<rea>".$row["reason"]."</rea>"."\n";
      $txt=$txt."</answer>"; 
      $cnt=$cnt+1;     
      //echo $row["reason"];
      $j=$j+1;
    }
  }
      $txt=$txt."</all>\n";
  
 ?>
 
 <div class="row">
 <div class="col-sm-4"></div><!--col-sm-3-->
 <div class="col-sm-4">
 <input align="center" class="btn btn-success btn-block " value='Sumbit' onclick="hot1(<?php echo $cnt; ?>);"/>
 </div><!--col-sm-3-->
 <div class="col-sm-4"></div><!--col-sm-3-->
 </div><!--row-->
 </form>
 <form action="ques.php" method="post">
   <?php
      for($i=1;$i<=$limit;$i++)
        echo "<input type='hidden' id='$i' name='".$i."d"."' />";
    ?>
    <input type="hidden" id="cnt" name="cont" />
    <input type="submit" id="go"  />
    <script> document.getElementById("go").style.visibility="hidden"; </script>
  </form>
     <ul class="pager">
      <!--<li class="previous"><a href="?page=<?php //if($page > 1){$page-=1;}echo $page; ?>">Previous</a></li>
      <li class="next"><a href="?page=<?php// if($page=) ?>">Next</a></li>-->
      <?php
        for ($i=1; $i <= $split; $i++) { 
          echo "<li><a href='?page=".$i."'>".$i."</a></li>";
        }
      ?>
    </ul>
    </div><!--Container-->
 
<?php
try{
  if(flock($myfile,LOCK_EX)){
    fwrite($myfile,$txt);
    flock($myfile,LOCK_UN);
    fclose($myfile);
    //echo "good to go";
  }else{
    echo "error";
  }
}catch(Exception $e){

}
  mysqli_close($conn);
?>
</body>
</html>

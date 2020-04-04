<?php

if(!isset($_GET['step'])){
  $step = 1;
  session_destroy();
}else{
  $step = $_GET['step'];
}

if($step == 1){
    include("step1.php");
}
if($step == 2){
    include("step2.php");
}
if($step == 3){
    include("step3.php");
}




?>

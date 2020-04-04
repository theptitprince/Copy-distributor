<?php

include("listing.php");

if(isset($_POST) && !empty($_POST)){
  if(!isset($_POST['email_prof']) OR empty($_POST['email_prof'])){
    $_SESSION['flash'] = "Merci de compléter convenablement le formulaire.";
  }
  if(isset($_POST['emails_list']) AND !empty($_POST['emails_list'])){
    return true;
  }elseif(isset($_POST['class_list']) AND !empty($_POST['class_list'])){
    $_POST['emails_list'] = $list[$_POST['class_list']];
  }else{
    $_SESSION['flash'] = "Merci de compléter convenablement le formulaire.";
  }
}

if(!isset($_SESSION['flash'])){
  $emails_list = prepare_email($_POST['emails_list']);
  $email_prof = prepare_email($_POST['email_prof']);

  if(empty($emails_list) OR empty($email_prof)){
    $_SESSION['flash'] = "Nous n'avons pas pu trouver d'adresse email valide dans la liste fournie...";
  }
}

if(isset($_SESSION['flash'])){
  include("step1.php");
}else{
    $email_prof = array_map('prepare_data',$email_prof);
    $emails_list = array_map('prepare_data',$emails_list);
    include("step2-form.php");
}

?>

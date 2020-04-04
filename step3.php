<?php
echo "<pre>";

if (get_magic_quotes_gpc()){
    $nom = prepare_data($_POST['email_prof']);
    $nom = stripslashes(htmlentities($nom['prenom']." ".$nom['nom']));
    $email_from = stripslashes(htmlentities($_POST['email_prof']));
    $message_commun = stripslashes(htmlentities($_POST['class_comment']));
}else{
//Avoid injections in case of HTML Mail
    $nom = prepare_data($_POST['email_prof']);
    $nom = htmlentities($nom['prenom']." ".$nom['nom']);
    $email_from = htmlentities($_POST['email_prof']);
    $message_commun = htmlentities($_POST['class_comment']);
}

$passage_ligne = "\r\n";
$email_subject = $nom." vous a rendu une copie."; //Subject
$boundary = md5(rand());

//$headers = "From: \"".$nom."\"<".$email_from.">" . $passage_ligne; //Sender
$headers = "Reply-to: \"".$nom."\" <".$email_from.">" . $passage_ligne; //Sender
$headers.= "MIME-Version: 1.0" . $passage_ligne; //MIME Version
$headers.= 'Content-Type: multipart/mixed; boundary='.$boundary .' '. $passage_ligne; //Content (2 versions ex:text/plain et text/html)

$email_message = '--' . $boundary . $passage_ligne; //Opening boundary
$email_message .= "Content-Type: text/html; charset=\"utf-8\"" . $passage_ligne; //Content type
$email_message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne; //Encoding
$email_message .= $passage_ligne .clean_string($message_commun). $passage_ligne; //Content

foreach($_POST['eleve'] as $key => $value){

  $email_to = $value['email'];
  $email_perso = $email_message;
  $email_perso .= "<br/>".clean_string($value['comment']). $passage_ligne;

  if(isset($_FILES['eleve']['name'][$key]['file']) && $_FILES['eleve']['name'][$key]['file'] != ""){
    $nom_fichier = $_FILES['eleve']['name'][$key]['file'];
    $source = $_FILES['eleve']['tmp_name'][$key]['file'];
    $type_fichier = $_FILES['eleve']['type'][$key]['file'];
    $taille_fichier = $_FILES['eleve']['size'][$key]['file'];

    if($nom_fichier != ".htaccess"){
      if($type_fichier == "image/jpeg" || $type_fichier == "image/pjpeg"  || $type_fichier == "application/pdf"){

        $tabRemplacement = array("é"=>"e", "è"=>"e", "à"=>"a"); //Changing special characters

        $handle = fopen($source, 'r'); //File opening
        $content = fread($handle, $taille_fichier); //File reading
        $encoded_content = chunk_split(base64_encode($content)); //Encoding
        $f = fclose($handle); //File closing

        $email_perso .= $passage_ligne . "--" . $boundary . $passage_ligne; //Second boundary opening
        $email_perso .= 'Content-type:'.$type_fichier.';name="'.$nom_fichier.'"'."\n"; //Content type (application/pdf or image/jpeg)
        $email_perso .='Content-Disposition: attachment; filename="'.$nom_fichier.'"'."\n"; //Inform there is an attachment
        $email_perso .= 'Content-transfer-encoding:base64'."\n"; //Encoding
        $email_perso .= "\n"; //Blank line. IMPORTANT !
        $email_perso .= $encoded_content."\n"; //Attachment

      }
    }
  }
  $email_perso .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne; //Closing boundary

  if(mail($email_to,$email_subject, $email_perso, $headers)==true){  //Sending mail
      echo "Email bien envoyé à ".$email_to."<br/>"; //Redirection
  }else{
    echo "Email non envoyé à ".$email_to."<br/>";
  }
}



//print_r($_POST);
//print_r($_FILES);
echo "</pre>";
 ?>

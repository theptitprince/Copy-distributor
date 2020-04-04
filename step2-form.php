<h1>Etape 2: Sélectionnez les copie et commentez</h1>

<form method="POST" enctype='multipart/form-data' action="index.php?step=3">

<fieldset><legend> Vous : <?php echo $email_prof[0]['prenom'].' '.$email_prof[0]['nom']; ?></legend>
  <input name="email_prof" size="20"  maxlength="40" value="<?php echo $email_prof[0]['email']; ?>" id="email" type="hidden"/>

  <label for="class_comment">Votre commentaire pour toute la classe (celui ci apparaitra en entête de tous les emails):</label>
  <textarea name="class_comment" id="class_comment"></textarea>

</fieldset>

<h2>La liste de vos élèves</h2>
<?php
foreach($emails_list as $key=>$value){
  echo "<fieldset><legend>".$value['prenom']." ".$value['nom']."</legend>";
  echo "<input name=eleve[".$key."][email] value=".$value['email']." type=hidden>";
  echo "<label>Le devoir à rendre à ".$value['prenom']." ".$value['nom']." :</label>";
  echo "<input type=file name=eleve[".$key."][file]>";
  echo "<label>Votre commentaire pour seulement ".$value['prenom']." ".$value['nom']." :</label>";
  echo "<textarea name=eleve[".$key."][comment]></textarea>";
  echo "</fieldset>";
}
?>

 <p>
 <input type="submit" value="Envoyer" />
 </p>

</form>

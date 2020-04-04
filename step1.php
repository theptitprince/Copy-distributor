<h1>Etape 1: Sélection des adresses emails</h1>
<?php
if(isset($_SESSION['flash'])){
  echo "<div id=flash>".$_SESSION['flash']."</div>";
  unset($_SESSION['flash']);
} ?>
<form method="POST" action="index.php?step=2">

  <label for="email_prof">Votre adresse email d'enseignant</label>
  <input id="email_prof" name="email_prof" value=""></input>

<label for="class_list">Sélectionner la classe</label>
<select name="class_list" id="class_list">
  <option value="">-- Selectionnez une classe --</option>
  <option value="test">Test Etienne</option>
  <option value="test_leonardo">Test Leonardo</option>
</select>
  <br/>
<p><b>NB</b>: Seul les adresse email @sdomain.tld sont valables.<br/>
  <b>NB2</b>: Séparez les emails par un point virgurl <b>;</b></p>

  <input type="submit" value="Continuer" />
</form>

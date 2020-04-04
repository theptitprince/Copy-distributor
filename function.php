<?php

mb_internal_encoding('UTF-8');
setlocale(LC_CTYPE, 'fr_FR.UTF-8');

function prepare_data($str){
  $return['email'] = $str;
  $str = explode('@', $str);
  $str = explode('.', $str[0]);
  $return['prenom'] = ucfirst($str[0]);
  $return['nom'] = strtoupper($str[1]);

  return $return;
}

function prepare_email($str){
  $str = explode(";",$str);
  $str = array_map('mise_en_forme', $str);
  $str = array_map('supp_erreur', $str);
  $str = array_map('check_domain', $str);
  $str = array_filter($str);
  return $str;
}

function mise_en_forme($str){
  $str = strtolower($str);
  $str=  str_replace(' ', '', $str);
  return $str;
}

function supp_erreur($str){
  if(filter_var($str, FILTER_VALIDATE_EMAIL)){
    return $str;
  }else{
    return '';
  }
}

function check_domain($str){
  $domain = explode('@', $str);
  if($domain['1'] == "domain.tld"){
    return $str;
  }else{
    return '';
  }
}

function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
}

?>

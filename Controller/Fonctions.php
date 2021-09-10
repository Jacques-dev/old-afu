
<?php

  error_reporting(0);
  function encrypt_decrypt($action, $string) {
    $secret_key = "MPDG";
    $output = false;
    $encrypt_method = "AES-256-CBC";
    //
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
  }

  function check_email_address($email) {
    return (!preg_match( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) ? false : true;
  }

  function checkIfIsManager($email) {
    include("../BDD/Connexion.php");
    $sql = "SELECT * FROM manager WHERE email = '$email'";

    $result = $con->query($sql);

    if ($result->num_rows === 1){
      return true;
    }

    return false;

  }

  function render(string $view, $parameters = []) {
    extract($parameters);
    include("{$view}.php");
  }

  function show($x) {
    echo "<pre class='show'>";
    print_r($x);
    echo "</pre>";
  }

  function whatMarkINeed($seuil, $coefMarks, $valueMarks, $coefMissingMark, $UE) {
    // show("---------".$coefMissingMark."---------");
    // show($valueMarks);
    if ($UE) {
      $sumMarks = getValueXCoefForUE($valueMarks, $coefMarks);
      $sumCoef = getSumCoefForUE($coefMarks);
    } else {
      $sumMarks = getValueXCoef($valueMarks, $coefMarks);
      $sumCoef = getSumCoef($coefMarks);
    }
    $res = ($seuil * $sumCoef - $sumMarks) / $coefMissingMark;
    $res *= 10;
    $res += 1;
    $res = (int)$res;
    $res = (float)$res / 10;
    return $res;
  }

  function getSumCoef($l) {

    $res = 0;
    for ($i = 0 ; $i  < count($l) ; $i++) {
      $res += $l[$i][2];
    }
    return $res;
  }

  function getValueXCoef($values, $coefs) {
    $res = 0;
    for($i = 0 ; $i < count($coefs) ; $i++) {
      $res += ($values[$i] * $coefs[$i][2]);
    }
    return $res;
  }

  function getValueXCoefForUE($values, $coefs) {
    $res = 0;
    for($i = 0 ; $i < count($coefs) ; $i++) {
      $res += ($values[$i][1] * $coefs[$i][3]);
    }
    return $res;
  }

  function getSumCoefForUE($l) {

    $res = 0;
    for ($i = 0 ; $i  < count($l) ; $i++) {
      $res += $l[$i][3];
    }
    return $res;
  }

?>

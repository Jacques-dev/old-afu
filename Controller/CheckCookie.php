

<?php

  include("../BDD/Connexion.php");
  include('Fonctions.php');
  session_start();

  $_SESSION["cookiechecked"] = true;

  if (isset($_COOKIE['RememberMe'])) {
    $rememberme = explode(",", $_COOKIE["RememberMe"]);
    $cookie_email = $rememberme[0];
    $cookie_password = $rememberme[1];

    $sql = "SELECT password FROM Profil WHERE email = '$cookie_email'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows == 1) {

      $decrypted_password = encrypt_decrypt('decrypt', $row['password']);
      $decrypted_cookie_password = encrypt_decrypt('decrypt', $cookie_password);

      if ($decrypted_password == $decrypted_cookie_password) {

        $_SESSION["email"] = $cookie_email;
        $popupResult = array("type" => "success", "title" => "Validé", "message" => "Vous êtes connecté.", "time" => 1000);

      } else {
        $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Mot de passe incorrect.");
      }

    } else {
      $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Cette adresse mail n'existe pas.");
    }

    $_SESSION["popupResult"] = $popupResult;
  }



  header('Location: /old-AFU/Vue/Body?page=Home');
  exit();

?>

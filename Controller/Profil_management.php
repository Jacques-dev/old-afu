<?php
include('Fonctions.php');
include("../BDD/Connexion.php");
session_start();

if (isset($_POST['update_infos'])){

  $sql = $con->prepare('UPDATE student SET name = ?, firstname = ?, school = ?, promotion = ?, td_group = ?, email = ?, confidentiality = ? WHERE email = ?');
  $sql->bind_param('ssssssss', $new_name, $new_firstname, $new_school, $new_promotion, $new_td_group, $new_email, $new_confidentiality , $old_email);

  $new_firstname=$_POST['new_firstname'];
  $new_name=$_POST['new_name'];
  $new_school=$_POST['new_school'];
  $new_promotion=$_POST['new_promotion'];
  $new_td_group=$_POST['new_td_group'];
  $new_email=$_POST["new_email"];
  $new_confidentiality=$_POST["new_confidentiality"];
  $old_email=$_SESSION["email"];

  $sql->execute();

  $profil = array(
    "firstname" => $new_firstname,
    "name" => $new_name,
    "school" => $new_school,
    "td_group" => $new_td_group,
    "promotion" => $new_promotion,
    "confidentiality" => $new_confidentiality
  );

  $_SESSION["profil"] = $profil;

  $popupResult = array("type" => "success", "title" => "Validé", "message" => "Modification enregistré.", "time" => 1000);

} else {
  $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Erreur dans la modification.");
}

$_SESSION["popupResult"] = $popupResult;

header('Location: /old-AFU/Vue/Body?page=Profil');
exit();
?>

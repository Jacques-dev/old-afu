

<?php

  include("../BDD/Connexion.php");
  include('Fonctions.php');
  session_start();

  // show($_POST);

  if (isset($_POST["insertSemester"])) {
    $sql = $con->prepare("INSERT INTO semester (num, school) VALUES (?, ?)");
    $sql->bind_param('ss', $num, $school);

    $num = $_POST["insertSemester"];
    $school = $_SESSION["profil"]["school"];

    $sql->execute();

    $sql = "SELECT * FROM semester WHERE school = '$school'";
    $result = $con->query($sql);
    $nb = $result->num_rows;

    $sql = "UPDATE school SET nb_semester = $nb WHERE name = '$school'";
    $con->query($sql);

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Nouveau semestre enregistré.", "time" => 500);
  }

  if (isset($_POST["deleteSemester"])) {
    $id = $_POST["deleteSemester"];
    $school = $_SESSION["profil"]["school"];

    $sql = "DELETE FROM semester WHERE id = $id AND school = '$school'";
    $con->query($sql);

    $sql = "SELECT * FROM semester WHERE school = '$school'";
    $result = $con->query($sql);
    $nb = $result->num_rows;

    $sql = "UPDATE school SET nb_semester = $nb WHERE name = '$school'";
    $con->query($sql);

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Suppression enregistré.", "time" => 500);
  }

  if (isset($_POST["insertUE"])) {
    $sql = $con->prepare("INSERT INTO ue (name, school, id_semester, coefficient) VALUES (?, ?, ?, ?)");
    $sql->bind_param('ssid', $name, $school, $id_semester, $coefficient);

    $name = "nom";
    $school = $_SESSION["profil"]["school"];
    $id_semester = $_POST["insertUE"];
    $coefficient = 0;

    $sql->execute();

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Nouveau semestre enregistré.", "time" => 500);
  }

  if (isset($_POST["deleteUE"])) {
    $id = $_POST["deleteUE"];
    $school = $_SESSION["profil"]["school"];

    $sql = "DELETE FROM ue WHERE id = $id AND school = '$school'";
    $con->query($sql);

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Suppression enregistré.", "time" => 500);
  }

  if (isset($_POST["insertSubject"])) {
    $sql = $con->prepare("INSERT INTO subject (name, id_ue, coefficient) VALUES (?, ?, ?)");
    $sql->bind_param('sid', $name, $id_ue, $coefficient);

    $name = "nom";
    $id_ue = $_POST["insertSubject"];
    $coefficient = 0;

    $sql->execute();

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Nouvelle matière enregistré.", "time" => 500);
  }

  if (isset($_POST["deleteSubject"])) {
    $id = $_POST["deleteSubject"];

    $sql = "DELETE FROM subject WHERE id = $id";
    $con->query($sql);

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Suppression enregistré.", "time" => 500);
  }

  if (isset($_POST["insertMark"])) {
    $sql = $con->prepare("INSERT INTO mark (type, id_subject, coefficient) VALUES (?, ?, ?)");
    $sql->bind_param('sid', $type, $id_subject, $coefficient);

    $type = "DE";
    $id_subject = $_POST["insertMark"];
    $coefficient = 0;

    $sql->execute();

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Nouvelle note enregistré.", "time" => 500);
  }

  if (isset($_POST["deleteMark"])) {
    $id = $_POST["deleteMark"];

    $sql = "DELETE FROM mark WHERE id = $id";
    $con->query($sql);

    $popupResult = array("type" => "success", "title" => "Validé", "message" => "Suppression enregistré.", "time" => 500);
  }

  if (isset($_POST["submitManagerEditing"])) {
    $school = $_SESSION["profil"]["school"];
    foreach ($_POST as $res => $editValue) {

      if ($editValue != "" && $editValue != null) {
        $editContent = explode("_", $res);
        $type = $editContent[0];
        $id = $editContent[1];
        $attribut = $editContent[2];


        if ($type === "semester") {
          $sql = "UPDATE semester SET num = $editValue WHERE id = $id";
          $con->query($sql);
        }

        if ($type === "ue") {
          if ($attribut === "name") {
            $sql = "UPDATE ue SET name = '$editValue' WHERE id = $id";
          } elseif ($attribut === "coef") {
            $sql = "UPDATE ue SET coefficient = $editValue WHERE id = $id";
          }
          $con->query($sql);
        }

        if ($type === "subject") {
          if ($attribut === "name") {
            $sql = "UPDATE subject SET name = '$editValue' WHERE id = $id";
          } elseif ($attribut === "coef") {
            $sql = "UPDATE subject SET coefficient = $editValue WHERE id = $id";
          }
          $con->query($sql);
        }

        if ($type === "mark") {
          if ($attribut === "type") {
            $sql = "UPDATE mark SET type = '$editValue' WHERE id = $id";
          } elseif ($attribut === "coef") {
            $sql = "UPDATE mark SET coefficient = $editValue WHERE id = $id";
          }
          $con->query($sql);
        }

      }
    }

  }

  if (isset($_POST["save"])) {
    $tab = $_SESSION["apiv3"];
    $var = urlencode(serialize($tab));
    // show($tab);
    // die();
    // Enregistrement de l'information
    $fp = fopen('../Model/Save.txt', 'w');
    fputs($fp, $var);
    fclose($fp);
    $file = "../Model/Save.txt";

    header("Cache-control: public");
    header("Content-description: File Transfer");
    header("Content-Disposition: attachment; filename=".basename($file));
    header("Content-Type: text/plain");
    header("Content-Transfer-Encoding: binary");
    readfile($file);
    exit;
  }

  if (isset($_POST["load"])) {
    //// LECTURE
    // Chargement du fichier
    $tab = file('../Model/Save.txt');

    // Désérialisation
    $var = unserialize(urldecode($tab[0]));
    $_SESSION["load"] = $var;
  }


  $_SESSION["popupResult"] = $popupResult;
  header('Location: /old-AFU/Vue/Management.php');
  exit();

?>

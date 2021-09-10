
<?php
  session_start();

  if (isset($_SESSION["profil"]["id"])) {
    $idProfil = $_SESSION["profil"]["id"];
    include("../Controller/StartAPI.php");
    include("../Controller/StartMarks.php");
  }
  
  include("../BDD/Connexion.php");

  if (isset($_SESSION["cookie"])) {
    $emailCookie = $_SESSION["cookie"][0];
    $passwordCookie = $_SESSION["cookie"][1];
    $timeCookie = $_SESSION["cookie"][2];

    $array = array($emailCookie, $passwordCookie, $timeCookie);
    $values = implode(",", $array);

    setcookie("RememberMe", $values, time() + 60 * 60 * 24 * 365);
    unset($_SESSION["cookie"]);
  }

  if (isset($_SESSION["cookiechecked"]) && $_SESSION["cookiechecked"] === false) {
    header('Location: ../Controller/CheckCookie.php');
  }

  if (isset($_SESSION["logout"])) {
    unset($_COOKIE["RememberMe"]);
    setcookie("RememberMe", "", time() - 3600);
    unset($_SESSION["logout"]);
  }

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Academix Follow-Up</title>
    <!-- Font family -->
    <link href="http://fonts.cdnfonts.com/css/krona-one" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/fredoka-one" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Recursive&display=swap" rel="stylesheet">

    <!-- icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- BootStrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Popup CSS -->
    <link href="https://cdn.isfidev.net/asalertmessage/v1.0/css/as-alert-message.min.css" rel="stylesheet">
    <script src="https://cdn.isfidev.net/asalertmessage/v1.0/js/as-alert-message.min.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/Main.css">
    <link rel="stylesheet" href="CSS/Home.css">
    <link rel="stylesheet" href="CSS/Average.css">
    <link rel="stylesheet" href="CSS/Manager.css">
    <link rel="stylesheet" href="CSS/Ranking.css">
    <link rel="stylesheet" href="CSS/Contact.css">
    <link rel="stylesheet" href="CSS/Research.css">
    <link rel="stylesheet" href="CSS/MyMarks.css">
    <link rel="stylesheet" href="CSS/Buttons.css">
    <link rel="stylesheet" href="CSS/Input.css">

    </head>
    <body>

      <?php
      if (isset($_SESSION["popupResult"])) {
        $type = $_SESSION["popupResult"]["type"];
        $title = $_SESSION["popupResult"]["title"];
        $message = $_SESSION["popupResult"]["message"];
        $time = isset($_SESSION["popupResult"]["time"]) ? $_SESSION["popupResult"]["time"] : 2000;
        ?>
        <script type="text/javascript">
          asAlertMsg({
            type: "<?= $type ?>",
            title: "<?= $title ?>",
            message: "<?= $message ?>",
            timer: <?= $time ?>
          })
          setTimeout(function() {
            <?php unset($_SESSION["popupResult"]); ?>
          }, 2000);
        </script>
      <?php } ?>

      <div id="navbar">
        <nav id="navbarSub1" class="navbar navbar-expand-md">
          <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a href="Body?page=Home">
                  <img class="nav-link <?= $activePage === 'Home' ? 'active' : '' ?>" src="IMAGES/logo1.png" id="logo1">
                </a>
              </li>
              <a class="navbarSub1" href="Body?page=Contact">Nous contacter</a>
              <?php if(isset($_SESSION["email"]) && isset($_SESSION["manager"])): ?>
                <li class="nav-item">
                  <a class="nav-link <?= $activePage === 'Management' ? 'active' : '' ?>" href="Management.php">Management</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
              <?php if(isset($_SESSION["email"]) && !isset($_SESSION["manager"]) ): ?>
                <li class="nav-item">
                  <a class="nav-link <?= $activePage === 'Profil' ? 'active' : '' ?>" href="Body?page=Profil"><?= $_SESSION["profil"]["firstname"]; ?></a>
                </li>
              <?php endif; ?>
              <?php include("LoginForm.php"); ?>
              <?php include("RegisterForm.php"); ?>
            </ul>
          </div>
        </nav>

        <nav id="navbarSub2" class="navbar navbar-expand-md">
          <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
              <?php if(isset($_SESSION["email"]) && !isset($_SESSION["manager"])): ?>
                <li class="nav-item">
                  <a class="nav-link <?= $activePage === 'MarksForm' ? 'active' : '' ?>" href="Body?page=MarksForm">Mes notes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= $activePage === 'Ranking' ? 'active' : '' ?>" href="Body?page=Ranking">Mon classement</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= $activePage === 'Research' ? 'active' : '' ?>" href="Body?page=Research">Rechercher</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </nav>
      </div>

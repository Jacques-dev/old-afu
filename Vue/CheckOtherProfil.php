
<?php
  
  if (isset($_POST["checkProfilSubmit"])) {
    $checkProfil = $_POST["checkProfilResults"];
  } else {
    header("Location: 404.php");
  }

  $idProfil = $checkProfil[0];
?>


<div class="container">

  <div class="row">
    <div class="col-lg-12">
      <?php
      $info = ["id", "Prenom", "Nom", "Ecole", "Niveau d'étude", "Groupe de TD"];

      for ($i = 1 ; $i != count($checkProfil) ; $i++) :?>

        <div class="row">
          <div class="col-lg-2 ml-lg-auto">
            <?= $info[$i]; ?>
          </div>
          <div class="col-lg-2 mr-lg-auto"><?= $checkProfil[$i]; ?></div>
        </div>

      <?php endfor; ?>
    </div>
  </div>

  <?php
    render("MyMarks", ["idProfil" => $idProfil]);
  ?>

</div>

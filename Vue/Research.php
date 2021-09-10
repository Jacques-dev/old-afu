
<?php include("../BDD/Connexion.php"); ?>

<div class="container-fluid">

  <form class="row formResearch1" action="Body?page=CheckOtherProfil" method="post">
    <div class="col-lg-4 research-container-title">
      <p> Recherchez le profil d'une connaissance</p>
    </div>
    <div class="col-lg-6 mr-lg-auto research-container">
      <div class="row">
        <div class="col-lg-4">
          <div class="form__group field">
            <input type="input" class="form__field" placeholder="Nom" name="SearchProfilName" id="SearchProfilName" required />
            <label for="SearchProfilName" class="form__label"></label>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form__group field">
            <input type="input" class="form__field" placeholder="Prénom" name="SearchProfilFirstName" id="SearchProfilFirstName" required />
            <label for="SearchProfilFirstName" class="form__label"></label>
          </div>
        </div>
        <div class="col-lg-4">
          <input type="submit" name="SearchProfilSubmit" value="Chercher" class="btn btn-primary">
        </div>
      </div>

      <!-- <input type="text" name="SearchProfilName" placeholder="Nom" required> -->
      <!-- <input type="text" name="SearchProfilFirstName" placeholder="Prénom" required> -->
      <!-- <input type="submit" name="SearchProfilSubmit" value="Chercher" class="btn btn-primary"> -->
    </div>
  </form>


  <?php
    $email = $_SESSION["email"];
    $sql = "SELECT id, name, firstname, school, promotion, td_group FROM student WHERE confidentiality = 'Publique' AND email != '$email'";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
      $array = [
        "id" => $row["id"],
        "name" => $row["name"],
        "firstname" => $row["firstname"],
        "school" => $row["school"],
        "promotion" => $row["promotion"],
        "td_group" => $row["td_group"]
      ];

    ?>

    <form class="row formResearch2" action="Body?page=CheckOtherProfil" method="post">
      <div class="col-lg-2 ml-lg-auto mr-lg-auto">
        <input type="submit" name="checkProfilSubmit" id="checkProfil" value="Voir +" class="btn btn-primary">
      </div>

      <?php foreach($array as $attr) :?>
        <input type="hidden" name="checkProfilResults[]" value="<?= $attr; ?>">
      <?php endforeach; ?>

      <div class="col-lg-2 ml-lg-auto mr-lg-auto"><?= $row["name"]; ?></div>
      <div class="col-lg-2 ml-lg-auto mr-lg-auto"><?= $row["firstname"]; ?></div>
      <div class="col-lg-2 ml-lg-auto mr-lg-auto"><?= $row["school"]; ?></div>
      <div class="col-lg-2 ml-lg-auto mr-lg-auto"><?= $row["promotion"]; ?></div>
      <div class="col-lg-2 ml-lg-auto mr-lg-auto"><?= $row["td_group"]; ?></div>
    </form>

  <?php } ?>

</div>

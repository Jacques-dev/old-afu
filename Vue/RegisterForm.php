

<form action="/old-AFU/Controller/LoginRegister.php" method="post" id="popupRegister" class="popupLoginRegister">

  <div class="row">
    <div class="col-lg-12">
      <h1>Inscription</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      Email
    </div>
    <div class="col-lg-12">
      <input type="text" placeholder="email" name="email">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      Mot de passe
    </div>
    <div class="col-lg-12">
      <input type="password" placeholder="Mot de passe" name="password">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      Prenom
    </div>
    <div class="col-lg-12">
      <input type="text" placeholder="Prenom" name="firstname"/>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      Nom
    </div>
    <div class="col-lg-12">
      <input type="text" placeholder="Nom" name="name"/>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      Ecole
    </div>
    <div class="col-lg-12">
      <select name="school">
        <option value="<?= $_SESSION["profil"]["school"]?>" selected> Ecole</option>
        <option value="EFREI Paris">EFREI Paris</option>
        <option value="ECE Paris">ECE Paris</option>
        <option value="EPITA">EPITA</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      Promotion :
    </div>
    <div class="col-lg-12">
      <select name="promotion">
        <option value="" disabled selected>Promotion</option>
        <option value="2025">2025</option>
        <option value="2024">2024</option>
        <option value="2023">2023</option>
        <option value="2022">2022</option>
        <option value="2021">2021</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      Groupe de TD :
    </div>
    <div class="col-lg-12">
      <input type="text" placeholder="groupe de td " name="td_group"/>
    </div>
  </div>

  <input type="submit" name="submitRegister" value="Je m'inscris" class="btn btn-primary">
  <!-- <button type="submit" name="submitRegister">Je m'inscris</button> -->
  <input type="submit" value="Annuler" class="btn btn-primary">
  <!-- <button type="submit">Annuler</button> -->
</form>

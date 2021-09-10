

<div class="container-fluid">

  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <h2>Mon profil</h2>
      </div>
      <div class="row">
        <form class="col-lg-8" name="inscription" method="post" action="/academic-follow-up/Controller/Profil_management.php">
          <div class="row">
            <div class="form__group field">
              <input type="input" class="form__field" placeholder="Email" name="new_email" id="emailProfil" value="<?= $_SESSION["email"]?>"/>
            </div>
          </div>
          <div class="row">
            <div class="form__group field">
              <input type="input" class="form__field" placeholder="Prénom" name="new_firstname" id="firstNameProfil" value="<?= $_SESSION["profil"]["firstname"]?>"/>
            </div>
          </div>
          <div class="row">
            <div class="form__group field">
              <input type="input" class="form__field" placeholder="Nom" name="new_name" id="firstNameProfil" value="<?= $_SESSION["profil"]["name"]?>"/>
            </div>
          </div>
          <div class="row">
            <div class="form__group field">
              <select class="form__field" name="new_school" id="new_school">
                <option value="<?= $_SESSION["profil"]["school"]?>" selected> <?= $_SESSION["profil"]["school"]?> </option>
                <option value="EFREI Paris">EFREI Paris</option>
                <option value="ECE Paris">ECE Paris</option>
                <option value="EPITA">EPITA</option>
              </select>
            </div>
          </div>
            <div class="row">
              <div class="form__group field">
                <select class="form__field" name="new_promotion" id="new_promotion">
                  <option value="<?= $_SESSION["profil"]["promotion"]?>" selected> <?= $_SESSION["profil"]["promotion"]?></option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form__group field">
                <input type="input" class="form__field" placeholder="Nom" name="new_td_group" id="new_td_group" value="<?= $_SESSION["profil"]["td_group"]?>"/>
              </div>
            </div>
            <div class="row">
              <div class="form__group field">
                <select class="form__field" name="new_confidentiality" id="new_confidentiality">
                  <option value="<?= $_SESSION["profil"]["confidentiality"]?>" selected> <?= $_SESSION["profil"]["confidentiality"]?></option>
                  <option value="Privée">Privée</option>
                  <option value="Publique">Publique</option>
                </select>
              </div>
            </div>
            <div class="row">
              <button class="learn-more btn-1" type="submit" name="update_infos">
                <span class="circle" aria-hidden="true">
                  <span class="icon arrow"></span>
                </span>
                <span class="button-text">Enregistrer</span>
              </button>
            </div>
        </form>
        <!-- <div class="col-lg-4">
          <p>ON MET LA PHOTO ICI</p>
          <img src="" alt="">
        </div> -->
      </div>

      <div class="row">
        <?php render("MyMarks", ["idProfil" => $_SESSION["profil"]["id"]]); ?>
      </div>

    </div>
  </div>
</div>

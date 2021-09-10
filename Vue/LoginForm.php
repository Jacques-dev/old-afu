<?php
  if (isset($_SESSION["email"])) {
?>
  <li class="nav-item">
    <form action="../Controller/LoginRegister.php" method="post" id="LoginRegisterButton">
      <button type="submit" class="nav-link popupLoginLogoutButton" name="logout">logout</button>
    </form>
  </li>
<?php
  } else {
?>
  <li class="nav-item">
    <button type="button" class="nav-link popupLoginLogoutButton" onclick="popupLogin()">Login</button>
  </li>
  <li class="nav-item">
    <button type="button" class="nav-link popupRegisterButton" onclick="popupRegister()">Register</button>
  </li>
<?php
  }
?>

  <form action="../Controller/LoginRegister.php" method="post" id="popupLogin" class="popupLoginRegister">
    Se connecter
    <div class="col-lg-12">
      <input type="text" name="email" placeholder="email">
    </div>
    <div class="col-lg-12">
        <input type="password" name="password" placeholder="mot de passe">
    </div>
    <div class="col-lg-12">
      <input type="checkbox" name="remember" id="remember">
      <label for="remember">Se souvenir de moi</label>
    </div>
    <div class="col-lg-12">
      <input type="submit" name="submitConnexion" value="Se connecter" class="btn btn-primary">
      <!-- <button type="submit" name="submitConnexion">Se connecter</button> -->
    </div>
    <div class="col-lg-12">
      <input type="submit" value="Annuler" class="btn btn-primary">
      <!-- <button type="submit">Annuler</button> -->
    </div>
  </form>

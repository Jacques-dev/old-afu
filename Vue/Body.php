<?php
  $page = $_GET["page"];
  include("../BDD/Connexion.php");
  include("../Controller/Fonctions.php");
  render("Header", ["activePage" => $page]);
?>

<div class="container-fluid" id="body">

  <div class="row">
    <div class="col-lg-2" id="leftpan">
      <?php render("LeftPan", []); ?>
    </div>
    <div class="col-lg-10" id="rightpan">
      <?php render($page, []); ?>
    </div>

</div>

<?php render("Footer", []); ?>

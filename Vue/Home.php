
<?php
  if (isset($_SESSION["profil"]["id"])) {
    $logged = true;
  } else {
    $logged = false;
  }
?>

<div class="container">

  <div class="comments-section">
    <div class="comments">
      <div id="comments-container">
        <?php if ($logged) { ?>
          <div class="comment">
            <div class="comment-user">
              <span class="user-details"><span class="username">Jacques </span><span>le </span><span>7 Mars 2021</span></span>
            </div>
            <div class="comment-text">
              Consulter vos notes, on vous dira lesquelles on besoin d'un petit ajustement
              <a href="Body?Profil">-Profil-</a>
            </div>
          </div>
          <div class="comment">
            <div class="comment-user">
              <span class="user-details"><span class="username">Jacques </span><span>le </span><span>7 Mars 2021</span></span>
            </div>
            <div class="comment-text">
              Enregistrer vos notes dans l'onglet <a href="Body?MarksForm">-Mes notes-</a>.
            </div>
          </div>
          <div class="comment">
            <div class="comment-user">
              <span class="user-details"><span class="username">Jacques </span><span>le </span><span>7 Mars 2021</span></span>
            </div>
            <div class="comment-text">
              Passer un coup sur <a href="Body?Ranking">-Mon classement-</a>
              pour avoir votre classement sur les semestres, ue, matières, notes.
            </div>
          </div>
          <div class="comment">
            <div class="comment-user">
              <span class="user-details"><span class="username">Jacques </span><span>le </span><span>7 Mars 2021</span></span>
            </div>
            <div class="comment-text">
              Rechercher une ou un pote sur l'onglet <a href="Body?Research">-Rechercher-</a>.
            </div>
          </div>

        <?php } else { ?>
          <div class="comment">
            <div class="comment-user">
              <span class="user-details"><span class="username">Jacques </span><span>le </span><span>27 Avril 2021</span></span>
            </div>
            <div class="comment-text">
              Nous vous proposons ce site afin que vous puissiez suivre d'un peu plus près votre profil scolaire.<br>
              Oui toi qui étudie, toi qui souhaite avoir ton ou tes diplômes.<br>
              Sache que sur MAFU, tu peux renseigner tes notes, te comparer aux autres étudiants de ta promo (s'ils sont sur le site aussi),
              puis jeter un coup d'oeil à tes résultats.
              Tu verras, le site est simple et cool.
            </div>
          </div>
          <div class="comment">
            <div class="comment-user">
              <span class="user-details"><span class="username">Jacques </span><span>le </span><span>27 Avril 2021</span></span>
            </div>
            <div class="comment-text">
              Fait circuler le site pour avoir un classement concret !!!<br>
              Le plus de monde de ta promo y sera, plus le classement sera crédible !
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>

</div>

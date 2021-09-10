
<div class="container-fluid" id="mymarks">
  <?php
    session_start();
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="well no-padding">
        <div>
          <ul class="nav nav-list nav-menu-list-style">
            <?php for($i = 0 ; $i < count($_SESSION["marksv4"]) ; $i++) {?>
              <?php $sem = $_SESSION["apiv2"]->getSemesterName($_SESSION["marksv4"][$i][0]); ?>
              <li style="width: 100%;">
                <label class="tree-toggle nav-header glyphicon-icon-rpad">
                  <i class="fas fa-arrow-alt-circle-right"></i>
                  Semestre <?= $sem; ?> --- (<?= $_SESSION["marksv4"][$i][1]; ?>/20)
                  <span class="menu-collapsible-icon glyphicon glyphicon-chevron-down"></span>
                </label>
                <?php for($j = 0 ; $j < count($_SESSION["marksv4"][$i][2]) ; $j++) { ?>
                  <?php $ue = $_SESSION["apiv2"]->getUEName($_SESSION["marksv4"][$i][2][$j][0]); ?>
                  <ul class="nav nav-list tree tree1">
                    <li class="ue-big-container">
                      <label class="tree-toggle nav-header">
                        <i class="fas fa-arrow-alt-circle-right"></i>
                        UE --- <?= $ue; ?> (<?= $_SESSION["marksv4"][$i][2][$j][1]; ?>/20)
                        coef <?= $_SESSION["apiv3"][$i][2][$j][3]; ?>
                        <?php if ($_SESSION["marksv4"][$i][2][$j][1] < 10 && isset($_SESSION["marksv4"][$i][2][$j][1])) { ?>
                          <span style="color: red">Cette UE n'est pas acceptable...</span>
                        <?php } ?>
                      </label>
                      <?php for($k = 0 ; $k < count($_SESSION["marksv4"][$i][2][$j][2]) ; $k++ ) { ?>
                        <?php $sub = $_SESSION["apiv2"]->getSubjectName($_SESSION["marksv4"][$i][2][$j][2][$k][0]); ?>
                        <ul class="nav nav-list tree tree2">
                          <li class="subject-big-container">
                            <label class="tree-toggle nav-header">
                              <i class="fas fa-arrow-alt-circle-right"></i>
                              Matiere --- <?= $sub; ?> (<?= $_SESSION["marksv4"][$i][2][$j][2][$k][1]; ?>/20)
                              coef <?= $_SESSION["apiv3"][$i][2][$j][2][$k][3]; ?>

                              <?php if ($_SESSION["marksv4"][$i][2][$j][2][$k][1] < 6 && isset($_SESSION["marksv4"][$i][2][$j][2][$k][1])) { ?>
                                <span style="color: red">Un petit coup de pouce ?</span>
                              <?php } elseif (!isset($_SESSION["marksv4"][$i][2][$j][2][$k][1]) && isset($_SESSION["marksv4"][$i][2][$j][1])) { ?>
                                <span style="color: blue">
                                  Espérons un
                                  <?= whatMarkINeed(10, $_SESSION["apiv3"][$i][2][$j][2], $_SESSION["marksv4"][$i][2][$j][2], $_SESSION["apiv3"][$i][2][$j][2][$k][3], true); ?>
                                  pour celle-ci !
                                </span>
                              <?php } elseif ($_SESSION["marksv4"][$i][2][$j][2][$k][1] >= 6 && isset($_SESSION["marksv4"][$i][2][$j][2][$k][1])) { ?>
                                <span style="color: green">La matière est sauve</span>
                              <?php } ?>
                            </label>
                            <?php for($l = 0 ; $l < count($_SESSION["marksv4"][$i][2][$j][2][$k][2]) ; $l++ ) { ?>
                              <ul class="nav nav-list tree tree3">
                                <li class="mark-container">
                                  Note ---
                                  <?= $_SESSION["apiv3"][$i][2][$j][2][$k][2][$l][1]; ?>
                                  <?= $_SESSION["marksv4"][$i][2][$j][2][$k][2][$l]; ?>/20
                                  coef <?= $_SESSION["apiv3"][$i][2][$j][2][$k][2][$l][2]; ?>
                                  <?php if ($_SESSION["marksv4"][$i][2][$j][2][$k][1] < 6 && isset($_SESSION["marksv4"][$i][2][$j][2][$k][1])) {
                                    if (!isset($_SESSION["marksv4"][$i][2][$j][2][$k][2][$l])) { ?>
                                      <span style="color: red">
                                        Un petit
                                        <?= whatMarkINeed(6, $_SESSION["apiv3"][$i][2][$j][2][$k][2], $_SESSION["marksv4"][$i][2][$j][2][$k][2], $_SESSION["apiv3"][$i][2][$j][2][$k][2][$l][2], false); ?>
                                        pour remonter ça ?
                                      </span>
                                   <?php
                                    }
                                  } ?>
                                </li>
                              </ul>
                            <?php } ?>
                          </li>
                        </ul>
                      <?php } ?>
                    </li>
                  </ul>
                <?php } ?>
              </li>
              <li class="divider"></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>

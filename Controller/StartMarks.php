


<?php

  include("../BDD/Connexion.php");
  session_start();
  $apiv2 = $_SESSION["apiv2"];
  $apiv3 = $_SESSION["apiv3"];

  $markToAdd = ["semester", "ue", "subject", "marks"];

  $marks = [];
  $marksv2 = [];
  $marksv3 = [];
  $marksv4 = [];

  for ($i = 0 ; $i != count($markToAdd) ; $i++) {
    $pile = [];

    $table = $markToAdd[$i];
    if ($table != "marks") {
      $sql = "SELECT sx.average FROM student s INNER JOIN student_$table sx WHERE s.id = sx.id_student AND s.id = $idProfil";
    } else {
      $sql = "SELECT sx.mark, sx.id_mark, sx.id_student, sx.id_subject FROM student s INNER JOIN student_$table sx WHERE s.id = sx.id_student AND s.id = $idProfil";
    }

    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
      array_push($pile, $row);
    }

    $marks[$markToAdd[$i]] = $pile;
  }

  // show($marks);
  if (count($marks["marks"]) != 0) {

    for ($i = 0 ; $i != count($markToAdd) ; $i++) {
      $pile = [];

      if ($markToAdd[$i] != "marks") {
        $sql = "SELECT sx.* FROM student s INNER JOIN student_$markToAdd[$i] sx WHERE s.id = sx.id_student AND s.id = $idProfil";
      } else {
        $sql = "SELECT sx.mark, sx.id_mark, sx.id_student, sx.id_subject FROM student s INNER JOIN student_$markToAdd[$i] sx WHERE s.id = sx.id_student AND s.id = $idProfil";
      }

      $result = $con->query($sql);

      while ($row = $result->fetch_assoc()) {
        array_push($pile, $row);
      }

      $marksv2[$markToAdd[$i]] =  $pile;
    }

    // show($marksv2);


    for ($a = 0 ; $a != count($marksv2["semester"]) ; $a++) {

      $le_semestre = $marksv2["semester"][$a];
      $un_semestre = [$le_semestre["id_semester"], $le_semestre["average"], []];

      for ($b = 0 ; $b != count($marksv2["ue"]); $b++) {

        $l_ue = $marksv2["ue"][$b];
        $une_ue = [$l_ue["id_ue"], $l_ue["average"], []];
        $o = 0;

        if ($l_ue["id_semester"] === $le_semestre["id_semester"]) {
          array_push($un_semestre[2], $une_ue);

          for ($i = 0; $i != count($marksv2["subject"]); $i++) {

            $la_matiere = $marksv2["subject"][$i];
            $une_matiere = [$la_matiere["id_subject"], $la_matiere["average"]];

            if ($la_matiere["id_ue"] === $l_ue["id_ue"]) {
              array_push($un_semestre[2][$b][2], $une_matiere);

              for ($j = 0; $j != count($marksv2["marks"]); $j++) {

                $la_note = $marksv2["marks"][$j];
                $une_note = [$la_note["mark"]];

                if ($la_note["id_subject"] === $la_matiere["id_subject"]) {
                  array_push($un_semestre[2][$b][2][$o], $une_note);

                }

              }

              $o++;

            }

          }

        }


      }
      array_push($marksv3, $un_semestre);
    }



    // show($apiv3);
    // show($marksv2);

    $indexSemester = 0;
    $indexUE = 0;
    $indexSubject = 0;
    $indexMark = 0;

    for ($a = 0 ; $a != count($apiv3) ; $a++) {
      // show("semester : ".$marksv2["semester"][$indexSemester]["id_semester"]." == ".$apiv3[$a][0]);
      if ($marksv2["semester"][$indexSemester]["id_semester"] === $apiv3[$a][0]) {
        $le_semestre = $marksv2["semester"][$indexSemester];
        $un_semestre = [$le_semestre["id_semester"], $le_semestre["average"], []];
        $indexSemester ++;
      } else {
        $un_semestre = [$apiv3[$a][0], null, []];
      }

      // show("count ue : ".count($apiv3[$a][2]));
      for ($b = 0 ; $b != count($apiv3[$a][2]); $b++) {
        // show("ue : ".$marksv2["ue"][$indexUE]["id_ue"]." == ".$apiv3[$a][2][$b][0]);
        if ($marksv2["ue"][$indexUE]["id_ue"] === $apiv3[$a][2][$b][0]) {
          $l_ue = $marksv2["ue"][$indexUE];
          $une_ue = [$l_ue["id_ue"], $l_ue["average"], []];
          $indexUE ++;
        } else {
          $une_ue = [$apiv3[$a][2][$b][0], null, []];
        }

        if ($l_ue["id_semester"] === $le_semestre["id_semester"]) {
          array_push($un_semestre[2], $une_ue);
        }

        // show("count subject : ".count($apiv3[$a][2][$b][2]));
        for ($i = 0; $i != count($apiv3[$a][2][$b][2]); $i++) {
          // show("subject : ".$marksv2["subject"][$indexSubject]["id_subject"]." == ".$apiv3[$a][2][$b][2][$i][0]);
          if ($marksv2["subject"][$indexSubject]["id_subject"] === $apiv3[$a][2][$b][2][$i][0]) {
            $la_matiere = $marksv2["subject"][$indexSubject];
            $une_matiere = [$la_matiere["id_subject"], $la_matiere["average"], []];
            $indexSubject ++;
            if ($la_matiere["id_ue"] === $l_ue["id_ue"]) {
              array_push($un_semestre[2][$b][2], $une_matiere);
            }
          } else {
            $une_matiere = [$apiv3[$a][2][$b][2][$i][0], null, []];
            if ($la_matiere["id_ue"] === $l_ue["id_ue"]) {
              array_push($un_semestre[2][$b][2], $une_matiere);
            }
          }


          // show("count mark : ".count($apiv3[$a][2][$b][2][$i][2]));
          for ($j = 0; $j != count($apiv3[$a][2][$b][2][$i][2]); $j++) {

            // show("mark : ".$marksv2["marks"][$indexMark]["id_mark"]." == ".$apiv3[$a][2][$b][2][$i][2][$j][0]);
            if ((int)$marksv2["marks"][$indexMark]["id_mark"] === (int)$apiv3[$a][2][$b][2][$i][2][$j][0]) {
              $la_note = $marksv2["marks"][$indexMark];
              $une_note = $la_note["mark"];
              $indexMark ++;
            } else {
              $une_note = null;
            }

            if ($la_note["id_subject"] === $la_matiere["id_subject"]) {
              array_push($un_semestre[2][$b][2][$i][2], $une_note);
            }

          }

        }

      }
      array_push($marksv4, $un_semestre);
      // $indexSemester = 0;
    }
  }

  // show($_SESSION["apiv3"]);
  // show($marksv4);

  $_SESSION["marks"] = $marks;
  $_SESSION["marksv2"] = $marksv2;
  $_SESSION["marksv3"] = $marksv3;
  $_SESSION["marksv4"] = $marksv4;
?>

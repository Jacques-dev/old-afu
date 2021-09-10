

<?php

  include("../BDD/Connexion.php");
  include('Fonctions.php');
  session_start();

  // show($_POST);

  // $studentId = $_SESSION["profil"]["id"];


    $index = 0;
    foreach ($_POST as $res => $markValue) {
      if ($index != 0 && $markValue != "" && $markValue != null) {
        $markContent = explode("_", $res);
        $markStudent = $markContent[0];
        $markSemester = $markContent[1];
        $markUE = $markContent[2];
        $markSubject = $markContent[3];
        $markId = $markContent[4];

        // show($markContent);
        show("Student id = ".$markStudent." Semester id = ".$markSemester." UE id = ".$markUE." Subject id = ".$markSubject." mark id = ".$markId);

        //SI LA NOTE EST DEJA ENREGISTRER POUR CET ETUDIANT DANS CETTE MATIERE, ON UPDATE LA NOTE
        $sqlCheck = "SELECT id FROM student_marks WHERE id_student = $markStudent AND id_mark = $markId AND id_subject = $markSubject";
        $result = $con->query($sqlCheck);

        if ($result->num_rows != 0) {
          $row = $result->fetch_assoc();
          $id_mark = $row["id"];
          $sqlMark = $con->prepare("UPDATE student_marks SET mark = ? WHERE id = $id_mark");
          $sqlMark->bind_param('d', $markValue);
          $sqlMark->execute();

        // SINON ON L'AJOUTE
        } else {

          $sqlMark = $con->prepare("INSERT INTO student_marks (mark, id_student, id_mark, id_subject) VALUES (?, ?, ?, ?)");
          $sqlMark->bind_param('diii', $mark, $id_student, $id_mark, $id_subject);

          $sqlSubject = $con->prepare("INSERT INTO student_subject (average, id_student, id_subject, id_ue) VALUES (?, ?, ?, ?)");
          $sqlSubject->bind_param('diii', $averageSubject, $id_student, $id_subject, $id_ue);

          $sqlUE = $con->prepare("INSERT INTO student_UE (average, id_student, id_ue, id_semester) VALUES (?, ?, ?, ?)");
          $sqlUE->bind_param('diii', $averageUE, $id_student, $id_ue, $id_semester);

          $sqlSemester = $con->prepare("INSERT INTO student_semester (average, id_student, id_semester) VALUES (?, ?, ?)");
          $sqlSemester->bind_param('dii', $averageSemester, $id_student, $id_semester);

          $mark = $markValue;
          $id_student = $markStudent;
          $id_mark = $markId;
          $id_subject = $markSubject;
          $id_ue = $markUE;
          $id_semester = $markSemester;

          $averageSubject = 0;
          $averageUE = 0;
          $averageSemester = 0;

          $sqlMark->execute();
          $sqlSubject->execute();
          $sqlUE->execute();
          $sqlSemester->execute();

        }


        // UNE FOIS LA NOTE AJOUTE AU BON ENDROIT ON CALCULE LES MOYENNES

        // show("markSubject : ".$markSubject." - markStudent : ".$markStudent);
        // die();
        $sqlSubjectUpdate = $con->prepare("UPDATE student_subject SET average = ? WHERE id_subject = $markSubject AND id_student = $markStudent");
        $sqlSubjectUpdate->bind_param('d', $averageSubject);

        $sqlUEUpdate = $con->prepare("UPDATE student_ue SET average = ? WHERE id_ue = $markUE AND id_student = $markStudent");
        $sqlUEUpdate->bind_param('d', $averageUE);

        $sqlSemesterUpdate = $con->prepare("UPDATE student_semester SET average = ? WHERE id_semester = $markSemester AND id_student = $markStudent");
        $sqlSemesterUpdate->bind_param('d', $averageSemester);

        (float)$averageSubject = getAverage("student_marks", "mark", $markSubject, $markStudent, "mark", "subject");
        // show("moyenne subject = ".$averageSubject);
        $sqlSubjectUpdate->execute();

        (float)$averageUE = getAverage("student_subject", "subject", $markUE, $markStudent, "average", "ue");
        // show("moyenne ue = ".$averageUE);
        $sqlUEUpdate->execute();

        (float)$averageSemester = getAverage("student_ue", "ue", $markSemester, $markStudent, "average", "semester");
        // show("moyenne semester = ".$averageSemester);
        $sqlSemesterUpdate->execute();

      }
      $index++;
    }

    function getAverage($student_table, $tableToAverage, $tableId, $studentId, $averageWanted, $tableRes) {
      include("../BDD/Connexion.php");

      $sql = "SELECT SUM(st.$averageWanted * t.coefficient) / SUM(t.coefficient) as 'average' FROM $student_table st INNER JOIN $tableToAverage t WHERE st.id_$tableToAverage = t.id AND id_student = $studentId AND t.id_$tableRes = $tableId";
      $result = $con->query($sql);
      $row = $result->fetch_assoc();
      return $row["average"];
    }

    header('Location: /old-AFU/Vue/Body?page=MarksForm');
    exit();
?>

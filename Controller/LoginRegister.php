
<?php
  session_start();

  include("../BDD/Connexion.php");

  include('Fonctions.php');

  if (isset($_POST["submitConnexion"])) {

    if (!empty($_POST["email"]) && !empty($_POST["password"])) {

      if (check_email_address($_POST['email'])) {

        $email = $_POST['email'];
        $sql = "SELECT password FROM user WHERE email = '$email'";

        $sqll = "SELECT id, firstname, name, school, promotion, td_group, confidentiality FROM student WHERE email = '$email'";
        // $notes = "SELECT mark, type FROM student_marks WHERE student = '$email'";
        // show($sql_count_student);
        $sqlll = "SELECT school FROM manager WHERE email = '$email'";

        $result = $con->query($sql);
        $resultt = $con->query($sqll);
        $resulttt = $con->query($sqlll);
        // $result_marks = $con->query($sqll);

        // $rowww = $result_marks->fetch_assoc();

        $row = $result->fetch_assoc();
        $roww = $resultt->fetch_assoc();
        $rowww = $resulttt->fetch_assoc();

        if (checkIfIsManager($email)){
          $_SESSION["manager"] = "manager";
        }

        if ($result->num_rows == 1) {

          $decrypted_txt = encrypt_decrypt('decrypt', $row['password']);

          if ($decrypted_txt == $_POST['password']) {

            // $sql_count_student = "SELECT COUNT(*) FROM student";
            // $nb_student_bdd = $con->query($sql_count_student);
            // $row_nb_student = $nb_student_bdd->fetch_assoc();
            // $global_infos = array(
            // "nb_student" => $row_nb_student["COUNT(*)"]
            //   );

            // $all_student = [];
            // $sql_all_student = "SELECT id, name, firstname, school, promotion, td_group FROM student WHERE confidentiality  = 'publique'";
            // $result_all_student = $con->query($sql_all_student);
            //   while ($row = $result_all_student->fetch_assoc()) {
            //     $array = [
            //       "id" => $row["id"],
            //       "name" => $row["name"],
            //       "firstname" => $row["firstname"],
            //       "school" => $row["school"],
            //       "promotion" => $row["promotion"],
            //       "td_group" => $row["td_group"]
            //     ];
            //     array_push($all_student,$array);
            //   }
            //   $_SESSION["l_student"] = $all_student;
            //
            //   //
            //   $all_student_marks = [];
            //   $sql_all_student_marks = "SELECT mark, id_student, id_subject, coefficient FROM student_marks s_m INNER JOIN student s WHERE s.id = s_m.id_student and confidentiality  = 'publique'";
            //   $result_all_student_marks = $con->query($sql_all_student_marks);
            //
            //   $_SESSION["l_student_with_marks"] = $all_student_marks;
            //
            //   $_SESSION["global_infos"] = $global_infos;
            // show($_SESSION["global_infos"]["nb_student"]);
            // die();
            if (! checkIfIsManager($email)){
              $profil = array (
                "id" => $roww["id"],
                "firstname" => $roww["firstname"],
                "name" => $roww["name"],
                "school" => $roww["school"],
                "td_group" => $roww["td_group"],
                "promotion" => $roww["promotion"],
                "confidentiality" => $roww["confidentiality"]
              );
            } else {
              $profil = array (
                "school" => $rowww["school"]
              );
            }

              // $marks = array(
              //   "mark" => $rowww["mark"],
              //   "mark_type" => $rowww["mark_type"],
              //   "student" => $rowww["student"]
              // );
              // $_SESSION["marks"] = $marks;

              $_SESSION["profil"] = $profil;
            // }

            $_SESSION["email"] = $email;

            $popupResult = array("type" => "success", "title" => "Validé", "message" => "Bon retour", "time" => 1000);

            if (isset($_POST["remember"])) {
              $time = time()*60*60*24*365;  //STOCKS 1 YEAR IN THE VAR
              $_SESSION["cookie"] = array($email, $row['password'], $time);
            }

            // if (checkIfIsManager($email)) {
            //   $_SESSION["manager"] = true;
            // }

          } else {
            $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Mot de passe incorrect.");
          }

        } else {
          $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Cette adresse mail n'existe pas.");
        }

      } else {
       $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Cette adresse mail n'est pas valide.");
     }

    } else {
      $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Veuillez remplir tous les champs.");
    }

  }

  if (isset($_POST['submitRegister'])) {

    if (!empty($_POST["email"]) && !empty($_POST["password"])) {

      if (check_email_address($_POST["email"])) {

        $email = $_POST['email'];
        // creer un profil à chaque utilisateur et remplir les champs du profil avec les informations de $_SESSION
        // Profil p = new Profil($name,$school,$promotio);
        $sql = $con->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
        $sql->bind_param('ss', $email, $password);
        $sqll = $con->prepare("INSERT INTO student (name, firstname, school, promotion, td_group, email, confidentiality) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sqll->bind_param('sssssss', $name , $firstname, $school, $promotion, $td_group, $email, $default_confidentiality);

        $sqlTest = "SELECT * FROM user WHERE email = '".$email."'";
        $result = $con->query($sqlTest);

        if ($result->num_rows == 0) {


          $email = $_POST['email'];
          $password = encrypt_decrypt('encrypt', $_POST['password']);
          $firstname = $_POST['firstname'];
          $name = $_POST['name'];
          $school = $_POST['school'];
          $promotion = $_POST['promotion'];
          $td_group = $_POST['td_group'];
          $default_confidentiality = "privée";

          $sql->execute();

          $sqll->execute();

          $popupResult = array("type" => "success", "title" => "Validé", "message" => "Ça y est, c'est partie", "time" => 1000);
        } else {
          $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Ce compte existe déjà.");
        }

      } else {
        $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Cette adresse mail n'est pas valide.");
      }

    } else {
      $popupResult = array("type" => "warning", "title" => "Attention", "message" => "Veuillez entrer un email et un mot de passe.");
    }
  }

  if (isset($_POST['logout'])) {
    if (isset($_SESSION["email"])) {
      session_destroy();
      session_start();
      $_SESSION["logout"] = true;
      $popupResult = array("type" => "success", "title" => "Validé", "message" => "À plus tard !", "time" => 1000);
    }
  }

  $_SESSION["popupResult"] = $popupResult;
  header('Location: /old-AFU/Vue/Body?page=Home');
  exit();
?>

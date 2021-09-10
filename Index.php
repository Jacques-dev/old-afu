<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> <!-- family-font-->
    <link rel="stylesheet" type="text/css" href="Vue/CSS/Index.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <meta http-equiv="refresh" content="3.9; Vue/Body?page=Home">

    <title>Jacques Tellier</title>

  </head>

  <body id="body">

    <div id="intro">Vos notes</div>

    <div id="intro2">Votre suivit</div>

    <script>
      window.onload = function() {
        var body = document.getElementById("body");
        body.classList.add("color-change-2x");

        var intro = document.getElementById("intro");
        var intro2 = document.getElementById("intro2");
        intro.classList.add("slide-in-top");

        setTimeout(function() {
          intro.classList.add("slide-rotate-hor-top");
          intro2.style.display = "block";
          intro2.classList.add("text-focus-in");
          setTimeout(function() {
            intro2.classList.add("puff-out-center");
          }, 1500);
        }, 1500);

      }
    </script>

  </body>
</html>

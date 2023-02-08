<!DOCTYPE html>
<html lang="en">
<?php
require_once("dbutils.php");
$conDb = conectarDB();
$resultados = getAllMazos($conDb);
?>

<head>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Mr+Dafoe);
    @import url(https://fonts.googleapis.com/css?family=Titillium+Web:900);
    @import url(https://fonts.googleapis.com/css?family=Righteous);
    @import url(https://fonts.googleapis.com/css?family=Candal);

    @import url(https://fonts.googleapis.com/css?family=Permanent+Marker);

    @import url(https://fonts.googleapis.com/css?family=Monoton);

    .chrome {
      position: relative;
      background-image: -webkit-linear-gradient(#378DBC 0%, #B6E8F1 46%, #ffffff 50%, #32120E 54%, #FFC488 58%, #582C11 90%, #EC9B4E 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      -webkit-text-stroke: 4px #f5f5f5;
      font-size: 100px;
      font-family: 'Titillium Web', sans-serif;
      font-style: italic;
      margin: 0;
      line-height: 1;
    }

    .dreams {
      position: absolute;
      margin: 20px;
      font-family: 'Mr Dafoe', cursive;
      font-size: 80px;
      color: #F975F7;
      transform: rotate(-15deg);
      -ms-transform: rotate(-15deg);
      /* IE 9 */
      -webkit-transform: rotate(-15deg);
      /* Safari and Chrome */
      margin-left: 900px;
      margin-top: -60px;
      -webkit-text-stroke: 1px #f008b7;
      -webkit-filter: drop-shadow(2px 2px 20px #f008b7);
      z-index: 20;
    }

    .windows .dreams {
      -webkit-text-stroke: 4px #f008b7;
    }
  </style>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <title>INICIO</title>
</head>

<body style="background-color: #212121">
  <br /><br /><br />
  <center>
    <div id="wrapper">
      <h1 class="chrome">TIMELINE</h1>
      <h3 class="dreams">Juego</h3>
    </div>
    <br><br>

    <form method="post" id="mainform">
      <button onclick="irAdmin()" type="button" id="botonAdmin" class="btn btn-outline-light">
        ADMIN
      </button>
      <br><br>
      <select class="select" name="mazoElegido" default="null">
        <option hidden selected value="null">Elige un mazo</option>
        <?php
        foreach ($resultados as $mazo) {
          echo "<option value='" . $mazo['ID'] . "'>" . $mazo['NOMBRE'] . "</option>";
        }
        ?>
      </select>
      <br><br>
      <button onclick="irPuntuacion()" type="button" id="botonJugar" class="btn btn-outline-light">
        JUGAR
      </button>
    </form>
  </center>
  <script type="text/javascript">
    function irAdmin() {
      document.getElementById("mainform").action = "admin/admin.php";
      document.getElementById("mainform").submit();
    }

    function irPuntuacion() {
      document.getElementById("mainform").action = "ranking/puntuacion.php";
      document.getElementById("mainform").submit();
    }
  </script>
</body>
<script </html>
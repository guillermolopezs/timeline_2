<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$mazo = $_SESSION['mazo'];
require_once('dbutilsranking.php');
$conDb = conectarDB();
if (isset($_POST['puntuacion'])) {
    $insertada = insertarPuntuacion($conDb, "AAA", $_POST['puntuacion'], $mazo);
}
$mazos = getAllMazos($conDb);
if (isset($_POST['siglas1']) || isset($_POST['siglas2']) || isset($_POST['siglas3'])) {
    $modificada = modificarIniciales($conDb, $_POST['siglas1'] . $_POST['siglas2'] . $_POST['siglas3'], $_POST['boton']);
}
$ranking = getRanking($conDb);
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
            margin-left: 800px;
            margin-top: -60px;
            -webkit-text-stroke: 1px #f008b7;
            -webkit-filter: drop-shadow(2px 2px 20px #f008b7);
            z-index: 20;
        }

        .windows .dreams {
            -webkit-text-stroke: 4px #f008b7;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 800px;
            color: #dddddd;
            background-color: #212121;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            border-color: #378DBC;
        }

        .styled-table thead tr {
            background-color: #378DBC;
            color: #dddddd;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #F975F7;
            color: #212121;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #212121;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #212121;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>Ranking</title>
</head>

<body style="background-color: #212121">
    <br>
    <center>
        <br /><br /><br />
        <div id="wrapper">
            <h1 class="chrome">TIMELINE</h1>
            <h3 class="dreams">Juego</h3>
        </div>
        <br><br>
        <table class="styled-table">
            <thead>
                <tr>
                    <th scope="col">Pos</th>
                    <th scope="col">Jugador</th>
                    <th scope="col">Puntuacion</th>
                    <th scope="col">Mazo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contPos = 1;
                foreach ($ranking as $puntuacion) {
                    echo "<tr>";
                    echo "<td>" . $contPos . "</td>";
                    $cont = 0;
                    foreach ($puntuacion as $item) {
                        if ($cont == 0) {
                            $id = '' . $item . '';
                            $idpasar = $item;
                        }
                        if (isset($insertada)) {
                            if ($id == $insertada) {
                                if ($cont != 0) {
                                    if ($cont == 3) {
                                        foreach ($mazos as $it) {
                                            if ($it['ID'] == $puntuacion['MAZO']) {
                                                echo "<td>" . $it['NOMBRE'] . "</td>";
                                            }
                                        }
                                    } elseif ($cont == 1) {
                                        echo "<td><form method='post' action='ranking.php'><label for='siglas'>Siglas:</label><input type='text' id='siglas' name='siglas1' maxlength='1'>
                                        <input type='text' name='siglas2' maxlength='1'><input type='text'  name='siglas3' maxlength='1'><button name='boton' class='btn btn-outline-dark' value=" . $idpasar . ">OK</button></form></td>";
                                    } else {
                                        echo "<td>" . $item . "</td>";
                                    }
                                }
                            }
                        } else {
                            if ($cont != 0) {
                                if ($cont == 3) {
                                    foreach ($mazos as $it) {
                                        if ($it['ID'] == $puntuacion['MAZO']) {
                                            echo "<td>" . $it['NOMBRE'] . "</td>";
                                        }
                                    }
                                } else {
                                    echo "<td>" . $item . "</td>";
                                }
                            }
                        }
                        $cont++;
                    }
                    echo "</tr>";
                    $contPos++;
                }
                ?>
            </tbody>
        </table>
        <br>
        <form id="mainform">
            <button onclick="irInicio()" type="button" id="botonJugar" class="btn btn-outline-light">
                INICIO
            </button>
        </form>

    </center>

    <script type="text/javascript">
        function irInicio() {
            document.getElementById("mainform").action = "../index.php";
            document.getElementById("mainform").submit();
        }
    </script>
</body>

</html>
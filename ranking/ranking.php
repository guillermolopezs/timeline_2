<!DOCTYPE html>
<html lang="en">
<?php
require_once('dbutilsranking.php');
$conDb = conectarDB();
if (isset($_POST['puntuacion'])) {
    $insertada = insertarPuntuacion($conDb, "AAA", $_POST['puntuacion'], $_POST['mazoElegido']);
}
$mazos = getAllMazos($conDb);
if (isset($_POST['siglas'])) {
    $modificada = modificarIniciales($conDb, $_POST['siglas'], $_POST['boton']);
}
$ranking = getRanking($conDb);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>Ranking</title>
</head>

<body>
    <br><br>
    <center>
        <table class="table">
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
                                        echo "<td><form method='post' action='ranking.php'><label for='siglas'>Siglas:</label><input type='text' id='siglas' name='siglas'><button name='boton' class='btn btn-outline-dark' value=" . $idpasar . ">OK</button></form></td>";
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
    </center>

</body>

</html>
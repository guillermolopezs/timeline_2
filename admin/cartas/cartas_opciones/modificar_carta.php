<!DOCTYPE html>
<html lang="en">
<?php
require_once("dbutilscartas.php");
$conDb = conectarDB();
$uploaddir = '/admin/cartas/cartas_opciones/img/';
$faltanDatos = false;
$formato = true;
if (isset($_POST['botonModificar'])) {
    if (isset($_POST['cartaModificar']) && $_POST['cartaModificar'] != null) {
        if ($_POST['nombre'] == '' && $_POST['fecha'] == '' && $_FILES['imagen']['name'] == '' && $_POST['mazo'] == null) {
            $faltanDatos = true;
        } else {
            $carta = getCarta($conDb, $_POST['cartaModificar'])[0];
            var_export($carta);
            if ($_POST['nombre'] == '') {
                $nombre = $carta['NOMBRE'];
            } else {
                $nombre = $_POST['nombre'];
            }
            if ($_POST['fecha'] == '') {
                $fecha = $carta[2];
            } else {
                $fecha = $_POST['fecha'];
            }
            if ($_FILES['imagen']['name'] == '') {
                $imagen = $carta['IMAGEN'];
            } else {
                if (
                    $_FILES['imagen']['type'] != "image/jpg" && $_FILES['imagen']['type']
                    != "image/png" && $_FILES['imagen']['type']  != "image/jpeg" && $_FILES['imagen']['type']  != "image/gif"
                ) {
                    $formato = false;
                } else {
                    $imagen = $uploaddir . basename($_FILES['imagen']['name']);
                    $rutaImg = 'img/' . basename($_FILES['imagen']['name']);
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImg);
                }
            }
            if ($_POST['mazoElegido'] == null) {
                $mazo = $carta['ID_MAZO'];
            } else {
                $mazo = $_POST['mazoElegido'];
            }
            $modificada = modificarCarta($conDb, $_POST['cartaModificar'], $nombre, $fecha, $imagen, $mazo);
        }
    } else {
        $faltanDatos = true;
    }
}
$resultadosCarta = getAllCartas($conDb);
$resultados = getAllMazos($conDb);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>MODIFICAR CARTA</title>
    <style>
        #errorDatos {
            padding: 20px;
            background-color: #f44336;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        #mazoModificado {
            padding: 20px;
            background-color: #4dc959;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        /* The close button */
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body style="background-color: #212121">
    <?php
    if ($faltanDatos == true) {
        echo '<center><div id="errorDatos" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Faltan campos</div></center>';
    } elseif (isset($modificada) && isset($_POST['botonModificar'])) {
        echo '<center><div id="mazoModificado" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Carta modificada</div></center>';
    }
    ?>
    <center>
        <br><br>
        <h1 style="color: #ffffff">MODIFICAR CARTA</h1>
        <br><br>
        <form enctype="multipart/form-data" method="post" id="createform" action="modificar_carta.php">
            <br><br>
            <select class="select" name="cartaModificar" default="null">
                <option hidden selected value="null">Elige una carta</option>
                <?php
                foreach ($resultadosCarta as $carta1) {
                    echo "<option value='" . $carta1['ID'] . "'>" . $carta1['NOMBRE'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="text" name="nombre" placeholder="Nombre de la carta..." />
            <br><br>
            <input type="number" name="fecha" placeholder="Introduce la fecha..." />
            <br><br>
            <div class="mb-3">
                <label for="formFile" class="form-label">Selecciona la imagen</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                <input class="form-control" type="file" id="formFile" name="imagen" width="50">
            </div>

            <!-- <input type="text" name="imagen" placeholder="Ruta de la imagen" /> -->
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
            <button name="botonModificar" class="btn btn-outline-light" value="set">CREAR</button><br><br>
            <button name="botonAtras" onclick="volverAtras()" class="btn btn-outline-light" value="set">ATRAS</button>
        </form>
    </center>
    <script type="text/javascript">
        function volverAtras() {
            document.getElementById("modificarForm").action = "../index_mazos.php";
            document.getElementById("modificarForm").submit();
        }
    </script>
</body>

</html>
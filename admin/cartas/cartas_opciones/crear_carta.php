<!DOCTYPE html>
<html lang="en">
<?php
require_once("dbutilscartas.php");
$conDb = conectarDB();
$resultados = getAllMazos($conDb);
$uploaddir = '/admin/cartas/cartas_opciones/img/';
$formato = true;
$faltacampo = false;
if (isset($_POST['botonCrear'])) {
    if ($_POST['nombre'] == '' || $_POST['fecha'] == '' || $_POST['mazoElegido'] == null) {
        $faltacampo = true;
    } elseif (
        $_FILES['imagen']['type'] != "image/jpg" && $_FILES['imagen']['type']  != "image/png" && $_FILES['imagen']['type']  != "image/jpeg" &&
        $_FILES['imagen']['type']  != "image/gif"
    ) {
        $formato = false;
    } else {
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $imagen = $uploaddir . basename($_FILES['imagen']['name']);
        $rutaImg = 'img/' . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImg);
        $mazo = $_POST['mazoElegido'];
        $insertada = insertarCarta($conDb, $nombre, $fecha, $imagen, $mazo);
    }
} else {
    $faltacampo = false;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>CREAR CARTA</title>
    <style>
        #errorDatos {
            padding: 20px;
            background-color: #f44336;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        #cartaCreada {
            padding: 20px;
            background-color: #4dc959;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

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

        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body style="background-color: #212121">
    <?php
    if ($faltacampo == true) {
        echo '<center><div id="errorDatos" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Faltan campos</div></center>';
    } elseif (!$formato) {
        echo '<center><div id="errorDatos" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>La imagen debe ser .jpg, .jpeg, .png o .gif</div></center>';
    } elseif (isset($insertada) && isset($_POST['botonCrear'])) {
        echo '<center><div id="cartaCreada" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Carta insertada</div></center>';
    }
    ?>
    <br><br>
    <center>
        <br>
        <h1 style="color: #ffffff">CREAR CARTA</h1>
        <form enctype="multipart/form-data" method="post" id="createform" action="crear_carta.php">
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
            <button name="botonCrear" class="btn btn-outline-light" value="set">CREAR</button><br><br>
            <button name="botonAtras" onclick="volverAtras()" class="btn btn-outline-light" value="set">ATRAS</button>
        </form>
    </center>
    <script type="text/javascript">
        function volverAtras() {
            document.getElementById("createform").action = "../index_cartas.php";
            document.getElementById("createform").submit();
        }
    </script>
</body>

</html>
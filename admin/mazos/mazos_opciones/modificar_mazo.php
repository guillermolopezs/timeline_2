<!DOCTYPE html>
<html lang="en">
<?php
require_once("dbutilsmazos.php");
$conDb = conectarDB();

$faltanDatos = false;
if (isset($_POST['botonModificar'])) {
    if (isset($_POST['mazoModificar']) && $_POST['mazoModificar'] != null) {
        var_export($_POST);
        if ($_POST['nombre'] != null && $_POST['nombre'] != '' && $_POST['descripcion'] != null && $_POST['descripcion'] != '') {
            $modificado = modificarMazo($conDb, $_POST['nombre'], $_POST['descripcion'], $_POST['mazoModificar']);
            $faltanDatos = false;
        } elseif ($_POST['nombre'] == null || $_POST['nombre'] == '') {
            $modificado = modificarMazoDescripcion($conDb, $_POST['descripcion'], $_POST['mazoModificar']);
            $faltanDatos = false;
        } elseif ($_POST['descripcion'] == null || $_POST['descripcion'] == '') {
            $modificado = modificarMazoNombre($conDb, $_POST['nombre'], $_POST['mazoModificar']);
            $faltanDatos = false;
        } else {
            $faltanDatos = true;
        }
    }
}
$resultados = getAllMazos($conDb);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>MODIFICAR MAZO</title>
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
    if ($faltanDatos == true || (isset($_POST['mazoModificar']) && $_POST['mazoModificar'] == null)) {
        echo '<center><div id="errorDatos" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Faltan campos</div></center>';
    } elseif (isset($modificado) && isset($_POST['botonModificar'])) {
        echo '<center><div id="mazoModificado" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Mazo modificado</div></center>';
    }
    ?>
    <center>
        <br><br>
        <h1 style="color: #ffffff">MODIFICAR MAZO</h1>
        <br><br>
        <form method="post" id="modificarForm" action="modificar_mazo.php">
            <select class="select" name="mazoModificar" default="null">
                <option hidden selected value="null">Elige un mazo</option>
                <?php
                foreach ($resultados as $mazo) {
                    echo "<option value='" . $mazo['ID'] . "'>" . $mazo['NOMBRE'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="text" name="nombre" placeholder="Introduce el nombre..." />
            <br><br>
            <textarea name="descripcion" cols="30" rows="15" placeholder="Introduce la descripción..."></textarea>
            <br><br>
            <button name="botonModificar" class="btn btn-outline-light" value="set">MODIFICAR</button><br><br>
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
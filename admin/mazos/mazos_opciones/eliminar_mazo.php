<!DOCTYPE html>
<html lang="en">
<?php
require_once("dbutilsmazos.php");
$conDb = conectarDB();
if (isset($_POST['botonEliminar'])) {
    if (isset($_POST['mazoEliminar']) && $_POST['mazoEliminar'] != null) {
        $borrado = borrarMazo($conDb, $_POST['mazoEliminar']);
    }
}
$resultados = getAllMazos($conDb);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>BORRAR MAZO</title>
    <style>
        #errorDatos {
            padding: 20px;
            background-color: #f44336;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        #mazoEliminado {
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
    if (isset($borrado) && isset($_POST['botonEliminar'])) {
        echo '<center><div id="mazoEliminado" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Mazo eliminado</div></center>';
    }
    ?>
    <center>
        <br><br>
        <h1 style="color: #ffffff">ELIMINAR MAZO</h1>
        <br><br>
        <form method="post" id="borrarForm" action="eliminar_mazo.php">
            <select class="select" name="mazoEliminar" default="null">
                <option hidden selected value="null">Elige un mazo</option>
                <?php
                foreach ($resultados as $mazo) {
                    echo "<option value='" . $mazo['ID'] . "'>" . $mazo['NOMBRE'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <button name="botonEliminar" class="btn btn-outline-light" value="set">ELIMINAR</button><br><br>
            <button name="botonAtras" onclick="volverAtras()" class="btn btn-outline-light" value="set">ATRAS</button>
        </form>
    </center>
    <script type="text/javascript">
        function volverAtras() {
            document.getElementById("borrarForm").action = "../index_mazos.php";
            document.getElementById("borrarForm").submit();
        }
    </script>
</body>

</html>
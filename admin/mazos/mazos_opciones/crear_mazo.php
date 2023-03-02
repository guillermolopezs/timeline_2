<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_POST['botonCrear'])) {
    if ($_POST['nombre'] == '' || $_POST['descripcion'] == '') {
        $faltacampo = true;
    } else {
        $faltacampo = false;
        require_once("dbutilsmazos.php");
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $conDb = conectarDB();
        $insertada = insertarMazo($conDb, $nombre, $descripcion);
    }
} else {
    $faltacampo = false;
}
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

        #errorDatos {
            padding: 20px;
            background-color: #f44336;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        #mazoCreado {
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>CREAR MAZO</title>
</head>

<body style="background-color: #212121">
    <?php
    if ($faltacampo == true) {
        echo '<center><div id="errorDatos" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Faltan campos</div></center>';
    } elseif (isset($insertada) && isset($_POST['botonCrear'])) {
        echo '<center><div id="mazoCreado" class="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Mazo insertado</div></center>';
    }
    ?>
    <br><br>
    <center>
        <div id="wrapper">
            <h1 class="chrome">TIMELINE</h1>
            <h3 class="dreams">Crear</h3>
        </div>
        <br><br>
        <h1 style="color: #ffffff">CREAR MAZO</h1>
        <form method="POST" id="formcrear" action="crear_mazo.php">
            <input type="text" name="nombre" placeholder="Introduce el nombre..." />
            <br><br>
            <textarea name="descripcion" cols="30" rows="15" placeholder="Introduce la descripción..."></textarea>
            <br><br>
            <button name="botonCrear" class="btn btn-outline-light" value="set">CREAR</button><br><br>
            <button name="botonAtras" onclick="volverAtras()" class="btn btn-outline-light" value="set">ATRAS</button>
        </form>
    </center>
    <script type="text/javascript">
        function volverAtras() {
            document.getElementById("formcrear").action = "../index_mazos.php";
            document.getElementById("formcrear").submit();
        }
    </script>
</body>

</html>
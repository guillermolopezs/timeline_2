<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>ADMIN</title>
</head>

<body style="background-color: #212121">
    <br /><br /><br />
    <center>
        <form method="post" id="mainform">
            <button type="button" onclick="irMazos()" class="btn btn-outline-light">MAZOS</button>
            <br />
            <br />
            <button type="button" onclick="irCartas()" class="btn btn-outline-light">CARTAS</button>
        </form>
    </center>
    <script type="text/javascript">
        function irMazos() {
            document.getElementById("mainform").action = "mazos/index_mazos.php";
            document.getElementById("mainform").submit();
        }

        function irCartas() {
            document.getElementById("mainform").action = "cartas/index_cartas.php";
            document.getElementById("mainform").submit();
        }
    </script>
</body>

</html>
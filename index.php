<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <title>INICIO</title>
</head>

<body style="background-color: #212121">
  <br /><br /><br />
  <center>
    <form method="post" id="mainform">
      <button onclick="irAdmin()" type="button" id="botonAdmin" class="btn btn-outline-light">
        ADMIN
      </button>
    </form>
  </center>
  <script type="text/javascript">
    function irAdmin() {
      document.getElementById("mainform").action = "admin/admin.php";
      document.getElementById("mainform").submit();
    }
  </script>
</body>
<script </html>
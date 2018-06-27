<!DOCTYPE html>
<html>
<head>
  <link href="esti.css" rel="stylesheet" type="text/css">
 <title>SNS</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
    <!-- estilos -->
    <link rel="stylesheet" href="views/css/e.css" type="text/css">
  <!--  -->
  <!-- <link rel="manifest" href="/material-components-web-catalog/manifest.json"><link rel="shortcut icon" href="/material-components-web-catalog/static/media/mdc_web_48dp.png"> -->
  <!-- <link href="/material-components-web-catalog/static/css/main.996a751b.css" rel="stylesheet"> -->

</head>
<body>
  <?php
    //nav
    include ('modulos/cuerpo/nav.php');
    //cuerpo de la pagina
    $mvc=new MvcController();
    $mvc->enlacesPaginasController();
    //footer
    include ('modulos/cuerpo/footer.php');
  ?>

<script type="text/javascript" src="views/js/jquery.js"></script>
<script type="text/javascript" src="views/js/javas.js"></script>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
  <title>Editar Persona</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="resources/css/main.css">
</head>
<body>
  <div class="container">
    <br/>
    <h1>Crear Nueva Persona</h1>
    <hr>
    <?php
    require_once("php_action/servicio/Persona_servicio.php");
    require_once("php_action/modelo/Persona_class.php");
    use php_action\modelo\Persona;
    use php_action\servicio\PersonaServicio;

    $servicio = new PersonaServicio();
    $registrosActualizados='0';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $persona=new Persona();
      $persona->cargar(null, $_POST["dni"], $_POST["nombre"], $_POST["edad"], $_POST["direccion"]);

      $registrosActualizados=$servicio->registrarPersona($persona);
      $estilo='';
        if(substr( $registrosActualizados, 0, 3 )==='Err'){
          $estilo= 'alert-warning';
        }else{
          $estilo= 'alert-success';
        }
        echo  '<div class="alert '.$estilo.'  alert-dismissible fade show" role="alert">';
        echo '   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>';
        if(substr( $registrosActualizados, 0, 3 )==='Err'){
          echo '<i class="fa fa-times" aria-hidden="true"></i> '.$registrosActualizados;
        }else{
          echo '<i class="fa fa-check" aria-hidden="true"></i> Registro creado exitosamente! </div>';
        }
    }
    ?>



    <br/>
    <form data-toggle="validator" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="update">

      <div class="form-group" >
        <label for="dni">DNI</label>
        <input type="text" class="form-control" name="dni" id="dni" value="" placeholder="" />
      </div>
      <div class="form-group">
        <label for="nombre">Nombres Completos</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="" value="" required/>
      </div>
      <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="" value="" required/>
      </div>
      <div class="form-group">
        <label for="edad">Edad</label>
        <input type="text" class="form-control" name="edad" id="edad" placeholder="" value="" required/>
      </div>
      <div align="center">
        <button type="submit"  class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Registrar</button>
        <a href="index.php"  class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a>
      </div>
    </form>


  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js" integrity="sha256-yazfaIh2SXu8rPenyD2f36pKgrkv5XT+DQCDpZ/eDao=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js" integrity="sha256-0IXY0aA9BMZHp1azQSgmyQTG4+8NwTeDlKmjpQYrcXs=" crossorigin="anonymous"></script>
  <script src="resources/js/form-validator.js"></script>
</body>
</html>

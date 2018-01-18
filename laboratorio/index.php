<!doctype html>
<html lang="en">
<head>
  <title></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <br/>
    <div align="center">
      <h1>Administración de Personas</h1>
    </div>
    <hr>
    <br/>
    <table class="table table-striped table-bordered" >
      <thead>
        <tr>
          <td>ID</td>
          <td>DNI</td>
          <td>NOMBRES COMPLETOS</td>
          <td>EDAD</td>
          <td>DIRECCIÓN</td>
          <td>Acciones</td>
        </tr>
      </thead>
      <tbody>
        <?php
        use php_action\servicio\PersonaServicio;

include("php_action/servicio/Persona_servicio.php");
        $servicio = new PersonaServicio();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idEliminar=$_POST["idEliminar"];
            $registrosActualizados=$servicio->eliminarPersona($idEliminar);
            $estilo='';
            if (substr($registrosActualizados, 0, 3)==='Err') {
                $estilo= 'alert-warning';
            } else {
                $estilo= 'alert-success';
            }
            echo  '<div class="alert '.$estilo.'  alert-dismissible fade show" role="alert">';
            echo '   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>';
            if (substr($registrosActualizados, 0, 3)==='Err') {
                echo '<i class="fa fa-times" aria-hidden="true"></i> '.$registrosActualizados;
            } else {
                echo '<i class="fa fa-check" aria-hidden="true"></i> Registro eliminado exitosamente! </div>';
            }
        }
        $lista=$servicio->listarTodasPersonas();
        if (!empty($lista)) {
            foreach ($lista as $persona) {
                print('<tr>');
                print('<td>'.$persona->getId().'</td>');
                print('<td>'.$persona->getDni().'</td>');
                print('<td>'.$persona->getNombre().'</td>');
                print('<td>'.$persona->getEdad().'</td>');
                print('<td>'.$persona->getDireccion().'</td>');
                print('<td> <div class="btn-group" role="group" aria-label="Basic example">');
                print('<a class="btn btn-primary" href="editar.php?id=');
                print($persona->getId());
                print('"><i class="fa fa-pencil-square" aria-hidden="true"></i> Editar</a>');
                print('<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarPersona" data-whatever="'.$persona->getId().'</div>">
          <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
          </button>');
                print('</td>');
                print('</tr>');
            }
        } else {
            echo '<tr><td colspan="6"><i class="fa fa-users" aria-hidden="true"></i> No existen registros disponibles.</td></tr>';
        }






        ?>
      </tbody>
    </table>

    <div class="modal fade" id="eliminarPersona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <input id="idEliminar" name="idEliminar" type="hidden" value="" />
              <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:orange; font-size:40px;"></i>  Esta seguro que desea eliminar el registro?

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
              <button type="submit" class="btn btn-danger"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Eliminar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <a href="crear.php"  class="btn btn-primary"><i class="fa fa-address-book-o" aria-hidden="true"></i> Registrar nueva persona</a>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script type="text/javascript">
    $(function() {
      $('#eliminarPersona').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)

        modal.find('.modal-body input').val(id)
      });
    });
    </script>
  </div>
</body>
</html>

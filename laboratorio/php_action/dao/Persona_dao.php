<?php
namespace php_action\dao;

use php_action\modelo\Persona;
use php_action\base\BaseUtil;

include("php_action/base/BaseUtil.php");
include("php_action/modelo/Persona_class.php");

/**
 * [PersonaDao Clase para gestionar las operaciones CRUD de la tabla persona]
 */
class PersonaDao
{
    private $baseUtil;
/**
 * [__construct constructor de la clase]
 * @method __construct
 */
    public function __construct()
    {
        $this->baseUtil = new BaseUtil();
    }

/**
 * [listarPorId Metodo para listar objetos de litpo Persona por pk de tabla]
 * @method listarPorId
 * @param  [type]      $id [pk]
 * @return [type]          [array de Personas]
 */
    public function listarPorId($id)
    {
        $query="SELECT * FROM personas where id=? ";
        $resultados = array();

        $resultados = $this
->baseUtil
->listarDesdeTabla($query, 'i', array($id));
        return $this->procesarRegistros($resultados);

    }
/**
 * [listarTodo Metodo para listar todas las personas]
 * @method listarTodo
 * @return [type]     [array de Personas]
 */
    public function listarTodo()
    {
        $query = "SELECT * FROM personas";
        $resultados = array();

        $resultados = $this
    ->baseUtil
    ->listarDesdeTabla($query, null, null);
        return $this->procesarRegistros($resultados);

    }
/**
 * [actualizar Metodo para actualizar los datos de la persona]
 * @method actualizar
 * @param  [type]     $persona [objeto Persona]
 * @return [type]              [Mensaje de ok o de error]
 */
    public function actualizar($persona)
    {
        $query = 'update personas set dni="'.$persona->getDni().'", nombre="'.$persona->getNombre().'",direccion="'.$persona->getDireccion().'",edad='.$persona->getEdad().' where id='.$persona->getId().';';


        return $this
    ->baseUtil
    ->actualizar($query);


    }

    /**
     * [guardar Metodo para registrar los datos de la persona]
     * @method guardar
     * @param  [type]     $persona [objeto Persona]
     * @return [type]              [Mensaje de ok o de error]
     */
    public function guardar($persona)
    {
        $query = 'INSERT into personas(dni,nombre,direccion,edad) values ("'.$persona->getDni().'", "'.$persona->getNombre().'","'.$persona->getDireccion().'",'.$persona->getEdad().');';


        return $this
    ->baseUtil
    ->guardar($query);


    }

    /**
     * [eliminar Metodo para eliminar los datos de la persona]
     * @method eliminar
     * @param  [type]     $persona [objeto Persona]
     * @return [type]              [Mensaje de ok o de error]
     */
    public function eliminar($id)
    {
        $query = 'DELETE from personas where id="'.$id.'";';


        return $this
    ->baseUtil
    ->eliminar($query);


    }
    /**
     * [procesarRegistros Metodo para generar Objetos de tipo Persona desde un array de array]
     * @method procesarRegistros
     * @param  array             $filas [array de filas]
     * @return [type]                   [array de Persona]
     */
    private function procesarRegistros(array $filas)
    {

      $personas=array();
        foreach ($filas as $fila) {
             $p1= new Persona();

             $p1->cargar($fila['id'],$fila['dni'],$fila['nombre'],$fila['edad'],$fila['direccion']);

       array_push($personas,$p1);
        }

        return $personas;
    }
}

<?php
namespace php_action\modelo;
/**
 * [Persona Clase para representar una persona]
 */
class Persona
{
    private $id;
    private $dni;
    private $nombre;
    private $edad;
    private $direccion;
/**
 * [__construct Contructor de la persona]
 * @method __construct
 */
    public function __construct()
    {
    }




/**
 * [cargar Metodo para cargar los datos de una persona a través de los parametros de entrada]
 * @method cargar
 * @param  [type] $idp        [id]
 * @param  [type] $dnip       [dni]
 * @param  [type] $nombrep    [nombre de la persona]
 * @param  [type] $edadp      [edad]
 * @param  [type] $direccionp [dirección]
 * @return [type]             [Objeto Persona]
 */
    public function cargar($idp, $dnip, $nombrep, $edadp, $direccionp)
    {
        $this->setId($idp);
        $this->setNombre($nombrep);
        $this->setDni($dnip);
        $this->setEdad($edadp);
        $this->setDireccion($direccionp);
        return $this;
    }
/**
 * [obtenerArray Metodo para obtener los datos de una persona en un array]
 * @method obtenerArray
 * @return [type]       [array]
 */
    public function obtenerArray()
    {
        $keys = array('dni', 'nombre', 'edad', 'direccion');
        return array_fill_keys($keys, $this->getDni(), $this->getNombre(), $this->getEdad(), $this->getDireccion());
    }

    /*
    Getters y Setters
    */
    public function getId()
    {
        return $this->id;
    }
    public function getDni()
    {
        return $this->dni;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getEdad()
    {
        return $this->edad;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setId($value)
    {
        $this->id=$value;
    }
    public function setDni($value)
    {
        $this->dni=$value;
    }
    public function setNombre($value)
    {
        $this->nombre=$value;
    }
    public function setEdad($value)
    {
        $this->edad=$value;
    }
    public function setDireccion($value)
    {
        $this->direccion=$value;
    }
}

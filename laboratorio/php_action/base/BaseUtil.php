<?php
namespace php_action\base;

use Mysqli;

/**
 * [BaseUtil Clase utilitaria para gestionar las conexiones a la base]
 */
class BaseUtil
{
    private $propiedades;
    private $host;
    private $port;
    private $socket;
    private $user;
    private $password;
    private $dbname;
    /**
     * [__construct contructor de la clase]
     * @method __construct
     */
    public function __construct()
    {
        $this->propiedades = parse_ini_file("php_action/config/db.ini");
        $this->host        = $this->propiedades['host'];
        $this->port        = $this->propiedades['port'];
        $this->socket      = $this->propiedades['socket'];
        $this->user        = $this->propiedades['user'];
        $this->password    = $this->propiedades['password'];
        $this->dbname      = $this->propiedades['dbname'];
    }
    /**
     * [obtenerConexion Metodo para oobtener una conexion a la base de datos]
     * @method obtenerConexion
     * @return [type]          [conexion mysqli]
     */
    private function obtenerConexion()
    {
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port, $this->socket);
        if ($conexion->connect_error) {
            exit('Error de Conexión (' . $conexion->connect_error . ') ');
        }
        return $conexion;
    }
    /**
     * [cerrarConexion Metodo para cerra la conexion]
     * @method cerrarConexion
     * @param  [type]         $conexion [conexion mysqli]
     */
    private function cerrarConexion($conexion)
    {
        $conexion->close();
    }
    /**
     * [eliminar Metodo para eliminar registros de la base de datos]
     * @method eliminar
     * @param  [type]   $query [cadena sql de ejecucion]
     * @return [type]          [Mensaje de confirmacion o error]
     */
    public function eliminar($query)
    {
        $conexion = $this->obtenerConexion();

        if ($conexion->query($query) === true) {
            $this-> cerrarConexion($conexion);

            return "Record deleted successfully";
        } else {

            $resultado="Error deleting record: " . $conexion->error;
            $this-> cerrarConexion($conexion);
            return $resultado;
        }
    }
    /**
     * [guardar Metodo para guardar un registro en la base de datos]
     * @method guardar
     * @param  [type]  $query [cadena de consulta]
     * @return [type]         [Mensaje de confirmacion o error]
     */
    public function guardar($query)
    {
        $conexion = $this->obtenerConexion();

        if ($conexion->query($query) === true) {
            $this-> cerrarConexion($conexion);
            return "Record insert successfully";
        } else {
            $resultado="Error inserting record: " . $conexion->error;
            $this-> cerrarConexion($conexion);
            return $resultado;
        }
    }
    /**
     * [actualizar Metodo para actualizar un registro]
     * @method actualizar
     * @param  [type]     $query [cadena de consulta]
     * @return [type]            [Mensaje de confirmacion o error]
     */
    public function actualizar($query)
    {
        $conexion = $this->obtenerConexion();

        if ($conexion->query($query) === true) {
            $this-> cerrarConexion($conexion);
            return "Record updated successfully";
        } else {
            $resultado="Error updating record: " . $conexion->error;
            $this-> cerrarConexion($conexion);
            return $resultado;
        }
    }
    /**
     * [listarDesdeTabla Metodo para listar todos los registros de una tabla]
     * @method listarDesdeTabla
     * @param  [type]           $query          [cadena de consulta]
     * @param  [type]           $tipoParametros [i,s,d,f]
     * @param  [type]           $parametros     [array de parametros a enviar en la consulta]
     * @return [type]                           [array de objetos]
     */
    public function listarDesdeTabla($query, $tipoParametros, $parametros)
    {
        $conexion = $this->obtenerConexion();
        $resultados= array();
        if ($stmt = $conexion->prepare($query)) {

      /* bind parameters for markers */
            if (!is_null($parametros)) {
                $stmt->bind_param($tipoParametros, ...$parametros);
            }


            /* execute query */
            $stmt->execute();



            $res = $stmt->get_result();
            while ($row = $res->fetch_assoc()) {
                array_push($resultados, $row);
            }



            /* close statement */
            $stmt->close();
            $this-> cerrarConexion($conexion);
            return $resultados;
        }
    }
}

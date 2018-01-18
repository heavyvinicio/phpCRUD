<?php

namespace php_action\servicio;

use php_action\dao\PersonaDao;

include("php_action/dao/Persona_dao.php");
/**
 * [PersonaServicio Clase para dar un servicio al DAO de Persona. Implementa FACADE]
 */
class PersonaServicio
{
    private $personaDao;
    /**
     * [__construct Constructor de la clase]
     * @method __construct
     */
    public function __construct()
    {
        $this->personaDao=new PersonaDao();
    }

    /**
     * [listarTodasPersonas Metodo para listar todas las personas]
     * @method listarTodasPersonas
     * @return [type]              [array de Personas]
     */
    public function listarTodasPersonas()
    {
        return $this->personaDao->listarTodo();
    }

    /**
     * [obtenerPersonaId Metodo para obtener una persona por id]
     * @method obtenerPersonaId
     * @param  [type]           $id [pk]
     * @return [type]               [Persona]
     */
    public function obtenerPersonaId($id)
    {
        $lista= $this->personaDao->listarPorId($id);
        return $lista[0];
    }

    /**
     * [actualizarPersona Metodo para actualizar una Persona]
     * @method actualizarPersona
     * @param  [type]            $persona [Persona]
     * @return [type]                     [Mensaje de respuesta]
     */
    public function actualizarPersona($persona)
    {
        return $this->personaDao->actualizar($persona);
    }

    /**
     * [registrarPersona Metodo para registrar una persona nueva]
     * @method registrarPersona
     * @param  [type]           $persona [Persona]
     * @return [type]                    [Mensaje de respuesta]
     */
    public function registrarPersona($persona)
    {
        return $this->personaDao->guardar($persona);
    }

    /**
     * [eliminarPersona Metodo para eliminar una persona]
     * @method eliminarPersona
     * @param  [type]          $id [pk]
     * @return [type]              [Mensjae de respuesta]
     */
    public function eliminarPersona($id)
    {

        return $this->personaDao->eliminar($id);
    }
}

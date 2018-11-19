<?php
namespace TP2\Models;

use Exception;
use TP2\DB\DBConection;
use TP2\\Models\Perfil;

class Usuario {
    private $id;
    private $nombre;
    private $apellido;
    private $dni;
    private $email;
    private $pass;
    private $perfil;

    public function getForId($idUsuario) {
        $db = DBConnection::getConnection();
		$query = "SELECT ID_USUARIO, NOMBRE, APELLIDO, EMAIL, CLAVE, PERFIL FROM usuario
				WHERE ID = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$idUsuario]);
		if($fila = $stmt->fetch()) {
			$this->cargarDatosDeArray($fila);
			return true;
		} else {
			return false;
		}
    }

    public function getForUserName($userName) {
        $db = DBConnection::getConnection();
		$query = "SELECT ID_USUARIO, NOMBRE, APELLIDO, EMAIL, CLAVE FROM usuario
				WHERE EMAIL = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$userName]);
		if($fila = $stmt->fetch()) {
			$this->cargarDatosDeArray($fila);
			return true;
		} else {
			return false;
		}
    }
    
    	/**
	 * Carga los datos de la $fila en el objeto.
	 *
	 * @param array $fila
	 */
	public function cargarDatosDeArray($fila)
	{
		$this->idUsuario	= $fila['ID'];
		$this->nombre  	    = $fila['NOMBRE'];
		$this->apellido  	= $fila['APELLIDO'];
		$this->email  	    = $fila['EMAIL'];
        $this->pass 		= $fila['CLAVE'];
        $this->perfil       = new Perfil($fila['PERFIL']);
    }
    
 /**
	 * Devuelve el dato $ del objeto usuario
	 */
	 public function getID() {
        return $this->id;
    }

/**
    * Devuelve el dato $userName del objeto usuario
    */
   public function GetEmail() {
       return $this->email;
   }

/**
    * Devuelve el dato $pass del objeto usuario
    */
   public function getPass() {
       return $this->pass;
   }

/**
    * Devuelve el dato $nombre del objeto usuario
    */
    public function getNombre() {
        return $this->nombre;
    }
/**
    * Devuelve el dato $perfil del objeto usuario
    */
    public function getPerfil() {
        return $this->perfil;
    }

 /**
    * Devuelve el dato $apellido del objeto usuario
    */
   public function getApellido() {
        return $this->apellido;
    }
}

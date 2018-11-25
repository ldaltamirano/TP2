<?php
namespace RedSocial\Models;

use Exception;
use RedSocial\DB\DBConection;

class Perfil {
    protected $id;
    protected $perfil;

    public Perfil() {}
    public Perfil($idPerfil) {
        $db = DBConnection::getConnection();
		$query = "SELECT ID_PERFIL, PERFIL FROM perfil
				WHERE ID = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$idPerfil]);
		if($fila = $stmt->fetch()) {
			$this->cargarDatosDeArray($fila);
        }
        //TODO: Probar retornar nulo
    }

        	/**
	 * Carga los datos de la $fila en el objeto.
	 *
	 * @param array $fila
	 */
	public function cargarDatosDeArray($fila)
	{
		$this->idPerfil	    = $fila['ID'];
        $this->perfil       = $fila['PERFIL'];
    }

    /**
    * Devuelve el dato $perfil del objeto usuario
    */
    public function getPerfil() {
        return $this->perfil;
    }

}

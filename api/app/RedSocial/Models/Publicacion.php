<?php
namespace RedSocial\Models;

use RedSocial\DB\DBConnection;
use JsonSerializable;
use Exception;

class Publicacion implements JsonSerializable {
    protected $id;
    protected $fecha;
    protected $creadoPor;
    protected $titulo;
    protected $descripcion;

    /**
     * Listado de propiedades Clase Publicacion
     * @propiedad array
     */
    protected $propiedades = ['id','fecha','creadoPor','titulo','descripcion'];
    
    /**
     * Devuelve el array de propiedades de la clase
     * @devuelve array 
     */
    public function jsonSerialize(){
        /*Retorno las propiedades*/
        return[
            'id'=> $this->id,
            'fecha'=> $this->fecha,
            'creadoPor'=> $this->creadoPor,
            'titulo'=> $this->titulo,
            'descripcion'=> $this->descripcion
        ];
    }
    /**
     * Capturo los datos guardados en mi base de datos
     * @devuelve array 
     */
    public function datos(){
        $db = DBConnection::getConnection();
        $query = "SELECT * FROM publicacion
                  INNER JOIN usuario
                    ON publicacion.FKID_USUARIO = usuario.ID_USUARIO
                  ORDER BY publicacion.ID_PUBLICACION";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $salida = [];
        while($fila = $stmt->fetch()){
            $pub = new Publicacion;
            $pub->cargarDatos($fila);
            $salida[] = $pub;
        }
        return $salida;
    }

    /**
     * Capturo los datos de la base dependiendo la propiedad $id
     * @param int $id
     */
    public function datosPorId($id){
        $db = DBConnection::getConnection();
        $query = "SELECT * FROM publicacion
                  INNER JOIN usuario
                    ON publicacion.FKID_USUARIO = usuario.ID_USUARIO
                  WHERE publicacion.ID_PUBLICACION = ?
                  ORDER BY publicacion.ID_PUBLICACION";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $fila = $stmt->fetch();
        $this->cargarDatos($fila);
    }
    /**
     * Cargamos los datos que obtuvimos de la base de datos
     * @param array $fila
     */
    public function cargarDatos($fila){
        $this->id = $fila['ID_PUBLICACION'];
        $this->fecha = $fila['FECHA_PUBLICACION'];
        $this->creadoPor = $fila['FKID_USUARIO'];
        $this->titulo = $fila['TITULO'];
        $this->descripcion = $fila['DESCRIPCION'];
    }
    /**
     * Guardar publicaciones en la base de datos
     * @param array $fila
     */
    public function crear($fila){
        $db = DBConnection::getConnection();
        $query = "INSERT INTO publicacion (FECHA_PUBLICACION, FKID_USUARIO, TITULO, DESCRIPCION)
                VALUES (:FECHA_PUBLICACION, :FKID_USUARIO, :TITULO, :DESCRIPCION)";
        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'FECHA_PUBLICACION' => $fila['FECHA_PUBLICACION'],
            'FKID_USUARIO' => $fila['FKID_USUARIO'],
            'TITULO' => $fila['TITULO'],
            'DESCRIPCION' => $fila['DESCRIPCION'],
        ]);
        if(!$exito){
            return false; 
        } else {
            return true;
        }
    }

    /**
     * Edita publicaciones ya existentes
     * @param int $id
     */
    public function editar($id){
        $db = DBConnection::getConnection();
		$query = 'UPDATE publicacion 
                  SET  FKID_USUARIO=?, TITULO=?, DESCRIPCION=? ,FECHA_PUBLICACION=?
                  WHERE ID_PUBLICACION=?';
        $stmt  = $db->prepare($query);
        $exito = $stmt->execute([
            $this->creadoPor,
            $this->titulo,
            $this->descripcion,
            $this->fecha,
            $this->id
        ]);
        if(!$exito) {
            return false;
        } else {
            return true;
        }
	}
    /**
     * Elimina publicaciones en la base de datos
     * @param int $id
     */
	public function eliminar($id){
        $this->datosPorId($id);
        $db = DBConnection::getConnection();
        $query = "DELETE FROM publicacion 
                  WHERE publicacion.ID_PUBLICACION=$id";
        $stmt = $db->prepare($query);
        $exito = $stmt->execute([$id]);
        if(!$exito) {
            return false;
        } else {
            return true;
        }
	}
}
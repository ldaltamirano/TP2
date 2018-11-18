<?php
namespace TP2\DB;

use PDO;

class DBConnection
{
	private static $host = "localhost";
	private static $user = "root";
	private static $pass = "";
	private static $base = "DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA";
	private static $db;

	private function __construct() {}

	public static function getConnection()
	{
		if(is_null(self::$db)) {
			$dsn = "mysql:host=" . self::$host . ":3308;dbname=" . self::$base . ";charset=utf8";
			try {
				self::$db = new PDO($dsn, self::$user, self::$pass);
			} catch(Exception $e) {
				die("Oops. Parece que hubo un error de conexión a la base. Ya hemos despachado a nuestra escuadra de monos ninja a arreglar el asunto. Probá de nuevo más tarde.");
			}
		}
		return self::$db;
	}
}
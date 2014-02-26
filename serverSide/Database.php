<?php
require_once "Configuracion.php";
class Database {
	/*
	 * Clase Database:
	 * Creada por Kelvin Atencio: 19 de Octubre de 2011
	 * Permite realizar varias conexiones a base de datos no redundantes,
	 * utiliza la filosofia singleton pero no de una sola instancia sino de varias,
	 * es decir, verifica si no hay conexiones, de no haber el crea la primera instancia
	 * con los parametros que le fueron suministrados. Si ya hay conexiones creadas
	 * el verifica que los parametros suministrados no sean los mismos para crear la conexion pasada,
	 * de ser los mismos parametros que la anterior devuelve la misma conexion, si no crea una nueva.
	 * De tal manera que crea conexiones nueva si y solo si, no hay conexiones creadas con esos parametros suministrados.
	 * En conclusion, puede haber varias conexiones creadas, pero ninguna repetida con los mismos parametros de conexion
	 *
	 */
	public $conectado = false;
	private static $instances = array();
	private static $conteoInstancias = 0;
	private static $modulo = "alfa";
	private $nroInstancia = 0;

	static function setModulo($modulo) {
		if(strcasecmp($modulo, "alfa") == 0 || strcasecmp($modulo, "gamma") == 0) {//si es igual a alfa o gamma sin importar mayusculas ni minusculas
			self::$modulo = strtolower($modulo);
		} else {
			self::$modulo = "alfa";
		}
	}

	static function getModulo() {
		return self::$modulo;
	}

	function getConnection() {
		/*if($objDatabase instanceof Database){
		 return $objDatabase::$instances[$objDatabase->nroInstancia]["conn"];
		 }else{
		 return null;
		 }*/
		return self::$instances[$this -> nroInstancia]["conn"];
	}

	private function __construct($sv, $username, $password) {
		$dbLocal = ($sv) ? "sv" : "universidad";
		$this -> nroInstancia = self::$conteoInstancias;
		self::$instances[self::$conteoInstancias]["host"] = Configuracion::dbserver . ":" . Configuracion::dbpath . "\\" . self::$modulo . "\db\\" . $dbLocal . ".gdb";
		//echo "<br>";
		//echo "Username: $username <br>Password: $password<br>HOST: ".self::$instances[self::$conteoInstancias]["host"]."<br>";
		$this -> conectado = self::$instances[$this -> nroInstancia]["conn"] = @ibase_connect(self::$instances[self::$conteoInstancias]["host"], self::$instances[self::$conteoInstancias]["username"], self::$instances[self::$conteoInstancias]["password"]) or die('Error conectando');

	}

	public static function getSingletonInstance($sv, $username, $password) {
		//echo "¿VACIO?:".empty(self::$instances)."<br>";
		if(empty(self::$instances)) {
			self::$instances[0]["modulo"] = self::$modulo;
			self::$instances[0]["sv"] = $sv;
			self::$instances[0]["username"] = $username;
			self::$instances[0]["password"] = $password;
			self::$instances[0]["instance"] = new Database($sv, $username, $password);
			return self::$instances[0]["instance"];
		} else {
			$i = 0;
			for($i = 0; $i < count(self::$instances); $i++) {
				$mismasVariablesConexion = (self::$instances[$i]["modulo"] == self::$instances[$i]["modulo"] && $sv == self::$instances[$i]["sv"] && $username == self::$instances[$i]["username"] && $password == self::$instances[$i]["password"]);
				if($mismasVariablesConexion) {
					return self::$instances[$i]["instance"];
				}
			}
			//echo "Username: $username <br>Password: $password<br>HOST: ".self::$instances[self::$conteoInstancias]["host"]."<br>";
			self::$conteoInstancias++;
			self::$instances[self::$conteoInstancias]["modulo"] = self::$modulo;
			self::$instances[self::$conteoInstancias]["sv"] = $sv;
			self::$instances[self::$conteoInstancias]["username"] = $username;
			self::$instances[self::$conteoInstancias]["password"] = $password;
			self::$instances[self::$conteoInstancias]["instance"] = new Database($sv, $username, $password);
			return self::$instances[self::$conteoInstancias]["instance"];
		}
		return null;
	}

	function execute($sql) {
		//echo "<br>" . $sql . "<br>";
		//Se ejecuta en base a la conexion que hizo la llamada
		//var_dump(self::$instances[$this -> nroInstancia]["conn"]);
		return  ibase_query(self::$instances[$this -> nroInstancia]["conn"], $sql);
	}

	function executeWithParam($sql, $param) {
		//echo "<br>" . $sql . "<br>";
		//Se ejecuta en base a la conexion que hizo la llamada
		return  ibase_query(self::$instances[$this -> nroInstancia]["conn"], $sql, $param);
	}

	function obtenerSiguienteFila($rs) {
		return  ibase_fetch_assoc($rs, IBASE_TEXT);
	}

	function close() {
		if(!@ibase_close(self::$instances[$this -> nroInstancia]["conn"])) {
			self::$instances[$this -> nroInstancia]["modulo"] = null;
			self::$instances[$this -> nroInstancia]["sv"] = null;
			self::$instances[$this -> nroInstancia]["username"] = null;
			self::$instances[$this -> nroInstancia]["password"] = null;
			self::$instances[$this -> nroInstancia]["conn"] = null;
			self::$instances[$this -> nroInstancia]["host"] = null;
			//self::$instances[$this->nroInstancia]["trans"] = null;
		}
	}

	function comenzarTranssaccion() {
		//echo var_dump(self::$instances[$this->nroInstancia]["conn"]);
		//echo "<BR>COMENZANDO TRANSACCION<BR>";
		//echo "NRO_INSTANCIAS: ".$this->nroInstancia."<br>";
		//echo "CONTEO_INSTANCIAS: ".self::$conteoInstancias."<br>";
		self::$instances[$this -> nroInstancia]["trans"] = ibase_trans(IBASE_DEFAULT, self::$instances[$this -> nroInstancia]["conn"]);
		//echo var_dump(self::$instances[$this->nroInstancia]["trans"]);
	}

	function cometerTransaccion() {
		ibase_commit(self::$instances[$this -> nroInstancia]["trans"]);
	}

	function deshacerCambiosDeTransaccion() {
		ibase_rollback(self::$instances[$this -> nroInstancia]["trans"]);
	}

	function db_blob_info($blob) {
		return  ibase_blob_info(self::$instances[$this -> nroInstancia]["conn"], $blob);
	}

	function db_blob_open($blob) {
		return  ibase_blob_open(self::$instances[$this -> nroInstancia]["conn"], $blob);
	}

	function db_blob_get($handle, $longitud) {
		return  ibase_blob_get($handle, $longitud);
	}

	function db_blob_close($blob_hndl) {
		return  ibase_blob_close($blob_hndl);
	}
}
?>
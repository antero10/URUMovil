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

	public static $module = "";
	public static $ids = -1;
	static $instances = array();

	static function getModule() {
		return self::$modulo;
	}

	static function getConnection($ticket) {
		return self::$instances[$ticket]["conn"];
	}

	public static function getConnectTicket($DBCRA) {
		/*
		 * DBCRA: Data Connection Request Array
		 * Arreglo de la Solicitud de Conexión a base de datos
		 * 
		 */
		
		
		$conexionFallo = false;
		for($i = 0; $i <= self::$ids; $i++) {
			$mismasVariablesConexion = ($DBCRA["module"] == self::$instances[$i]["module"] && $DBCRA["sv"] == self::$instances[$i]["sv"] && $DBCRA["username"] == self::$instances[$i]["username"] && $DBCRA["password"]== self::$instances[$i]["password"]);
			if($mismasVariablesConexion) {
				//Sin son parametros de conexion ya realizada: 
				//Retornar ticket de conexion ya existente
				return $i;
			}
		}
		/*
		 * Crear conexion nueva
		 */
		self::$ids++;
		$dbLocal = $DBCRA['sv']?'sv':'universidad';
		self::$instances[self::$ids]['module'] = $DBCRA["module"];
		self::$instances[self::$ids]['sv'] = $DBCRA['sv'];
		self::$instances[self::$ids]['username'] = $DBCRA['username'];
		self::$instances[self::$ids]['password'] = $DBCRA['password'];
		$host = self::$instances[self::$ids]["host"] = Configuracion::dbserver . ":" . Configuracion::dbpath . "\\" . $DBCRA["module"] . "\db\\$dbLocal.gdb";
		//self::$instances[self::$ids]["conn"] = @odbc_connect($host, $DBCRA["username"], $DBCRA["password"]) or $conexionFallo = true;
		//echo "Username: ".$DBCRA["username"]." <br>Password: ".$DBCRA["password"]."<br>HOST: ".$host."<br>";
		self::$instances[self::$ids]["conn"] = @ibase_connect($host, $DBCRA['username'], $DBCRA['password']) or $conexionFallo = true;
		if(!$conexionFallo){
			return self::$ids;
		}else{
			return -1;
		}
	}

	public static function execute($ticket, $query) {
		/*echo "Printing Conn:";
		var_dump(self::$instances[$ticket]["conn"]);
		echo "<br>";*/
		//return  odbc_exec(self::$instances[$ticket]["conn"], $query);
		return @ibase_query(self::$instances[$ticket]["conn"], $query);
	}

	public static function nextReg($rs) {
		/*$registro = array();
		odbc_fetch_into($rs, $registro);*/
		return ibase_fetch_row($rs, IBASE_TEXT);
	}

	/*function close() {
		if(!@ibase_close(self::$instances[$this -> nroInstancia]["conn"])) {
			self::$instances[$this -> nroInstancia]["modulo"] = null;
			self::$instances[$this -> nroInstancia]["sv"] = null;
			self::$instances[$this -> nroInstancia]["username"] = null;
			self::$instances[$this -> nroInstancia]["password"] = null;
			self::$instances[$this -> nroInstancia]["conn"] = null;
			self::$instances[$this -> nroInstancia]["host"] = null;
			//self::$instances[$this->nroInstancia]["trans"] = null;
		}
	}*/

	static function begin($ticket) {
		//echo var_dump(self::$instances[$this->nroInstancia]["conn"]);
		//echo "<BR>COMENZANDO TRANSACCION<BR>";
		//echo "NRO_INSTANCIAS: ".$this->nroInstancia."<br>";
		//echo "CONTEO_INSTANCIAS: ".self::$conteoInstancias."<br>";
		//self::$instances[$ticket]["trans"] = odbc_autocommit(self::$instances[$ticket]["conn"], false);
		self::$instances[$ticket]["trans"] = ibase_trans(IBASE_DEFAULT, self::$instances[$ticket]["conn"]);
		//echo var_dump(self::$instances[$this->nroInstancia]["trans"]);
	}

	static function commit($ticket) {
		//odbc_commit(self::$instances[$ticket]["conn"]);
		ibase_commit(self::$instances[$ticket]["trans"]);
	}

	static function rollback($ticket) {
		//odbc_rollback(self::$instances[$ticket]["conn"]);
		ibase_commit(self::$instances[$ticket]["trans"]);
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
<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require_once 'Slim/Slim.php';
require_once 'Configuracion.php';
require_once 'Database.php';


\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim();
$app->response->headers->set('Content-Type', 'application/json');



$app->post(
    '/login/:id/:pass',
    function ($id,$pass) use($app){
		$DBCRA = array("module"=>Configuracion::moduloAlfa,"sv"=>true,"username"=>Configuracion::dbmasteruser,"password"=>Configuracion::dbmasterpasswd);
		$dbTicket = Database::getConnectTicket($DBCRA);
		// Access-Control headers are received during OPTIONS requests
    	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){  
				header('Access-Control-Allow-Headers: X-Requested-With');
			}

        	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            	header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    	}
		$decodePass = base64_decode($pass);
		$query = "SELECT * FROM ESTUDIANTES WHERE CEDULA = $id AND CLAVE = '$decodePass'";
        $rs = Database::execute($dbTicket, $query);
		if(Database::nextRegAsso($rs) == false){
			$app->response->status(404);
		}
		else{
			$app->response->status(200);
		}
		
		
    }
)->via("OPTIONS");


$app->get(
    '/getCourses/:id',
    function ($id) use($app) {
		$DBCRA = array("module"=>Configuracion::moduloAlfa,"sv"=>false,"username"=>Configuracion::dbmasteruser,"password"=>Configuracion::dbmasterpasswd);
		$dbTicket = Database::getConnectTicket($DBCRA);

		if (isset($_SERVER['HTTP_ORIGIN'])) {
       			header('Access-Control-Allow-Credentials: true');
        		header('Access-Control-Max-Age: 86400');    // cache for 1 day
    		}
    		// Access-Control headers are received during OPTIONS requests
    		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
						header('Access-Control-Allow-Headers: X-Requested-With');
				}

        		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    		}
		$array = array();
		$count= 0;
        $query = "SELECT PERIODO,CODIGO,DESCRIPCION,NOTA from cursos c,materias m,notas n where c.materia=m.codigo and c.curso=n.curso and n.estudiante=$id";
        $rs = Database::execute($dbTicket, $query);
		if($rs == 'false'){
			$app->response->status(404);
		}
		else{
			while($row = Database::nextRegAsso($rs)){
				$array[$count] = array("semester"=>$row['PERIODO'],"code"=>$row['CODIGO'],"name"=>utf8_encode($row["DESCRIPCION"]),"qualification"=>$row["NOTA"]);
				$count++;
			}
			$result = array("Courses"=>$array);
			$app->response->write(json_encode($result));
			
		}
		
    }
)->via("OPTIONS");

$app->get(
	'/getSchedule/:id',
	function($id) use($app){
		$DBCRA = array("module"=>Configuracion::moduloAlfa,"sv"=>false,"username"=>Configuracion::dbmasteruser,"password"=>Configuracion::dbmasterpasswd);
		$dbTicket = Database::getConnectTicket($DBCRA);

		if (isset($_SERVER['HTTP_ORIGIN'])) {
       			header('Access-Control-Allow-Credentials: true');
        		header('Access-Control-Max-Age: 86400');    // cache for 1 day
    		}
    		// Access-Control headers are received during OPTIONS requests
    		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
						header('Access-Control-Allow-Headers: X-Requested-With');
				}

        		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    		}
		$array = array();
		$count= 0;
		$query = "SELECT DESCRIPCION,COMIENZO,FINAL,SALON,DIA FROM materias m, horarios h, cursos c, configuracion conf, notas n WHERE c.curso = h.curso AND conf.periodopreinscripcion = c.periodo AND c.curso = n.curso AND c.materia = m.codigo AND n.estudiante =$id ORDER BY DIA,COMIENZO";
        $rs = Database::execute($dbTicket, $query);
		if($rs == 'false'){
			$app->response->status(404);
		}
		else{
			while($row = Database::nextRegAsso($rs)){
			$array[$count] = array("name"=>utf8_encode($row['DESCRIPCION']),"start"=>$row['COMIENZO'],"end"=>utf8_encode($row["FINAL"]),"day"=>$row['DIA'],"classroom"=>$row["SALON"]);
			$count++;
			}
			$result = array("Schedule"=>$array);
			$app->response->write(json_encode($result));
		}
		
		
	}
)->via("OPTIONS");
$app->get(
	'/getStatus/:id',
	function($id) use($app){
		$DBCRA = array("module"=>Configuracion::moduloAlfa,"sv"=>false,"username"=>Configuracion::dbmasteruser,"password"=>Configuracion::dbmasterpasswd);
		$dbTicket = Database::getConnectTicket($DBCRA);

		if (isset($_SERVER['HTTP_ORIGIN'])) {
       			header('Access-Control-Allow-Credentials: true');
        		header('Access-Control-Max-Age: 86400');    // cache for 1 day
    		}
    		// Access-Control headers are received during OPTIONS requests
    		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
						header('Access-Control-Allow-Headers: X-Requested-With');
				}

        		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    	}
		$array = array();
		$allPayment = "SELECT sum(monto) as payment from pagos where estudiante = $id";
        $rs = Database::execute($dbTicket, $allPayment);
		$array = array_merge($array,Database::nextRegAsso($rs));
		//$dbTicket2 = Database::getConnectTicket($DBCRA);
		
		$chargesQuery = "SELECT sum(monto) as charges from cargos where estudiante = $id";
		$rs2 = Database::execute($dbTicket,$chargesQuery);
		$array = array_merge($array,Database::nextRegAsso($rs2));
		
		$lPaymentQuery = "SELECT sum(monto) as latePayment from cargos where estudiante = $id and vencimiento <= current_date";
		$rs = Database::execute($dbTicket,$lPaymentQuery);
		$array = array_merge($array,Database::nextRegAsso($rs));
		
		
		//$response = array('Status',$array);
		$app->response->write(json_encode($array));

	}
)->via("OPTIONS");
$app->run();

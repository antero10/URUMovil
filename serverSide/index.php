<?php

require_once 'Slim/Slim.php';
require_once 'Configuracion.php';
require_once 'Database.php';

\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim();



// GET route
$app->post('/login',function(){
        /*
            Esta solicitud recibira estudiante y contraseña devuelve 200 si paso
            y 400 cuando no
         */
        
        $DBCRA = array("module"=>Configuracion::alfa, "sv"=>true,"username"=>Configuracion::dbuser,"password"=>Configuracion::dbpasswd);
        $dbTicket = Database::getConnectTicket($DBCRA);
        $query = 'SELECT c.periodo as "semester", c.materia as "code", m.descripcion as "name", n.nota as "qualification" FROM notas n, cursos c, materias m WHERE n.curso = c.curso and c.materia = m.codigo and n.estudiante = 19415408';
        $rs = Database::execute($dbTicket,$query);  
        echo json_decode($rs);      
    }
);
$app->get('/getCourses',function(){
        /*
            Esta solicitud recibe un estudiante como parametro y devuelve todas las materias que esta viendo
         */
        $id  = $_GET['user'];
        $con=mysql_connect('localhost','root','');
        if(!mysqli_connect_errno()){
        mysql_select_db('tesis',$con);
        $query = 'SELECT * FROM courses WHERE student_id= '.intval($id);
        $rs = mysql_query($query,$con) or die(http_response_code(300));
        $rows = array();
        while($r = mysql_fetch_assoc($rs)) {
            $rows[] = $r;
        }
            echo json_encode($rows);
        
        }
        else{
            http_response_code(300);
        }
        
    }
);
$app->get('/getStatus',function(){
        /*
            Esta solicitud recibe un estudiante como parametro y devuelve sus deudas
         */
        
        
    }
);
$app->get('/getSchedule',function(){
        /*
            Esta solicitud recibe un estudiante como parametro y deuvelve su horario.
         */
        $id  = $_GET['user'];
        $con=mysql_connect('localhost','root','');
        if(!mysqli_connect_errno()){
        mysql_select_db('tesis',$con);
        $query = 'SELECT * FROM schedule_courses WHERE student_id= '.intval($id);
        $rs = mysql_query($query,$con) or die(http_response_code(300));
        $rows = array();
        while($r = mysql_fetch_assoc($rs)) {
            $rows[] = $r;
        }
            echo json_encode($rows);
        
        }
        else{
            http_response_code(300);
        }
        
    }
);


$app->run();

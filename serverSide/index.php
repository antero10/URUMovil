<?php
	require_once 'vendor/autoload.php';
	require_once 'Configuracion.php';
	require_once 'Database.php';
	$app = new \Slim\Slim();
	$app->post('/login','login');
	$app->get('/getAllCoursesGrades','getAllCoursesGrades');	
	$app->config('debug', true);
	$app->run();

	function login(){
		$app = new \Slim\Slim();
		$req = $app->request();
		$body = $req->getBody();
		$json = json_decode($body);
		echo $json->id;

	}
	function getAllCoursesGrades(){
		$app = new \Slim\Slim();
		
	}
?>
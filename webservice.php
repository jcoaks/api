<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// GET route
$app->get('/', function () {
	echo "Hola Mundo!";
});

// POST route
$app->post('/guardar', function () use ($app) 
{
	//decodificando la entrada
	$request = $app->request();
	$body = $request->getBody();
	$input = json_decode($body);

	//Guardando el JSON
	$fp = fopen('archivo.json', 'w');
	fwrite($fp, json_encode($input));
	fclose($fp);

	//Variables de la Base de datos
	$dbname = 'name';
	$dbuser = 'user';
	$dbpass = 'pass';
	$dbhost = 'localhost';
	$dbtable = "usuario";

	//Connectando a la base de datos
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("No se puede conectar a '$dbhost'");
	mysql_select_db($dbname) or die("No se puede abrir la db '$dbname'");

	//Insertando en la base de datos
	$test_query = "INSERT INTO $dbtable SET nombre='".$input->nombre."'";
	$resultado = mysql_query($test_query);

	return $resultado;
});

$app->run();
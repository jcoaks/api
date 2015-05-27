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
	$request = $app->request();
	$body = $request->getBody();
	$input = json_decode($body);

	$fp = fopen('archivo.json', 'w');
	fwrite($fp, json_encode($input));
	fclose($fp);

	header("Content-Type: application/json");
	echo json_encode($input);
});

$app->run();
<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require 'vendor/autoload.php';
require 'Personas.php';




$config = ['settings' => [
    'addContentLengthHeader' => false,
]];




// Run app
$app = new \Slim\App($config);

// -- metodo traer todas las personas
$app->get('/mostrar[/]', function (Request $request, Response $response) {

	$Listado = Persona::TraerTodasLasPersonas();
	$listadoEncodeadoEnJson = json_encode($Listado);
    $response->write($listadoEncodeadoEnJson);

    return $response;
});




// -- metodo traer una persona por id
$app->get('/mostrarun[/]', function ($request, $response, $args) {

	$datosPost = $request->getQueryParams(); //tomo lo que le mande por parametro y lo parse a php

    $unaPersona = Persona::TraerUnaPersona($datosPost['id']);
    $unaPersonaEncodeadaEnJson = json_encode($unaPersona);
    $response->write($unaPersonaEncodeadaEnJson);

    return $response;
});




// -- metodo recibe una parsona y da de alta
$app->post('/persona[/]', function ($request, $response, $args) {
	$datosPost = $request->getQueryParams(); //tomo lo que le mande por parametro y lo parse a php

    //armo el objeto persona
    $unaPersona = new Persona();
    $unaPersona->nombre = $datosPost['nombre'];
    $unaPersona->apellido = $datosPost['apellido'];
    $unaPersona->dni = $datosPost['dni'];

    Persona::InsertarPersona($unaPersona);
    $response->write("Persona insertada con exito -->");
    return $response;
});



// -- metodo borrar una persona por id
$app->delete('/persona[/]', function ($request, $response, $args) {

	$datosPost = $request->getQueryParams(); //tomo lo que le mande por parametro y lo parse a php
    Persona::BorrarPersona($datosPost['id']);
    $response->write("Persona Borrada con exito");
    return $response;
});


// -- metodo recibe una parsona y la modifica
$app->put('/persona[/]', function ($request, $response, $args) {
	$datosPost = $request->getQueryParams(); //tomo lo que le mande por parametro y lo parse a php

    //armo el objeto persona
    $unaPersona = new Persona();
    $unaPersona->id = $datosPost['id'];
    $unaPersona->nombre = $datosPost['nombre'];
    $unaPersona->apellido = $datosPost['apellido'];
    $unaPersona->dni = $datosPost['dni'];

    Persona::ModificarPersona($unaPersona);
    $response->write("Persona modificada con exito");
    return $response;
});
$app->run();
?>
<?php
require 'vendor/autoload.php';
require 'personas.php';




$config = ['settings' => [
    'addContentLengthHeader' => false,
]];




// Run app




$app = new \Slim\App($config);
$app->put('/persona/:id', function ($id) {
    
});

$app->run();
?>
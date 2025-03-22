<?php

use Controller\NoteController;
use Core\Router;
use Core\App;

$request = App::container()->resolve(NoteController::class);


Router::get('/api/', [$request, 'index']);
Router::post('/api/', [$request, 'store']);
Router::patch('/api/', [$request, 'update']);
Router::delete('/api/', [$request, 'destroy']);


<?php
use Controller\NoteController;
use Core\Router;

Router::get('/api/', NoteController::class, 'index');
Router::post('/api/', NoteController::class, 'store');
Router::patch('/api/', NoteController::class, 'update');
Router::delete('/api/', NoteController::class, 'destroy');


// $request = App::container()->resolve(NoteController::class);

// Router::get('/api/', [$request, 'index']);
// Router::post('/api/', [$request, 'store']);
// Router::patch('/api/', [$request, 'update']);
// Router::delete('/api/', [$request, 'destroy']);

// var_dump([NoteController::class, 'index']);
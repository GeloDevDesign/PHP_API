<?php

use Core\Router;

//  make $request  

// change ?id = 1 into {note};

Router::get('/api/', 'NoteController@index');
Router::post('/api/', 'NoteController@store');


// REQUEST $request

// id 1  slug note-1



//change ?id= 1 into note 
Router::patch('/api/{slug}', 'NoteController@update');
Router::delete('/api/{note}', 'NoteController@destroy');

// Router::get('/api/', NoteController::class, 'index');

// Router::get('/api/', [NoteController::class, 'index']);
// Router::get('/api/', NoteController::class, 'index');


// Router::post('/api/', [NoteController::class, 'store']);
// Router::patch('/api/', [NoteController::class, 'update']);
// Router::delete('/api/', [NoteController::class, 'destroy']);


// $request = App::container()->resolve(NoteController::class);

// Router::get('/api/', [$request, 'index']);
// Router::post('/api/', [$request, 'store']);
// Router::patch('/api/', [$request, 'update']);
// Router::delete('/api/', [$request, 'destroy']);

// var_dump([NoteController::class, 'index']);
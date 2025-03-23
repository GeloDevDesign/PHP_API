<?php

use Core\Router;

Router::get('/api/{note}', 'NoteController@index');
Router::post('/api/', 'NoteController@store');
Router::patch('/api/{note}', 'NoteController@update');
Router::delete('/api/{note}', 'NoteController@destroy');


// NEXT TASK 
// REQUEST $request;

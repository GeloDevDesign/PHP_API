<?php

use Core\Router;

Router::get('/api/',  'note/index.php');
Router::post('/api/',  'note/store.php');
Router::patch('/api/',  'note/update.php');
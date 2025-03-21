<?php

use Core\Container;
use Core\Database;
use Core\App;

$container = new Container();

$container->bind('Core\Database', function () {
  $config = require BASE_PATH . './config.php';
  return new Database($config['database']);
});
  
$container->bind('Service\NoteService', function () use ($container) {
  return new Service\NoteService($container->resolve('Core\Database'));
});


App::setContainer($container);
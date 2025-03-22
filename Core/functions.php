<?php

use Core\Response;

function dd($value)
{
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
  die();
}

function abort($status = 404)
{
  $status = http_response_code($status);
  require base_path("views/{$status}.php");
  die();
}




function response($message, $status = 200,$data = [])
{
  http_response_code($status);
  echo json_encode([
    'message' => $message,
    'data' => $data
  ]);
  die();
}


function base_path($path)
{
  return BASE_PATH . $path;
}

function redirect($path)
{
  header("Location: {$path}");
  exit();
}

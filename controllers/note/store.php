<?php

use Service\NoteService;
use Core\App;

$body = $_POST['body'] ?? "";

$notes = App::container()->resolve(NoteService::class);


try {

  $result = $notes->store($body);

  if (is_array($result) && isset($result['error'])) {
    response($result['error']['message'], 400);
  }

  response($body . " stored successfully", 200);
} catch (\Throwable $th) {
  response("Unknown error during note storage.", 500);
}

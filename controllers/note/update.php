<?php

use Service\NoteService;
use Core\App;

$id = $_GET['id'] ?? 1;
$body = $_POST['body'] ?? "";

$notes = App::container()->resolve(NoteService::class);

try {

  $result = $notes->update($id, $body);

  if (is_array($result['error'])) {
    response($result['error']['message'], 400);
  }

  response($body . " stored successfully", 200);
} catch (\Throwable $th) {
  response($th, 500);
}

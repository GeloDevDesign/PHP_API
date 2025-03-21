<?php

use Service\NoteService;
use Core\App;


$id = $_GET['id'] ?? 1;
$notes = App::container()->resolve(NoteService::class);

try {
  $result = $notes->destroy($id);

  if (is_array($result) && isset($result['error'])) {
    response($result['error']['message'], 400);
  }

  response("Deleted successfully", 201);

} catch (\Throwable $th) {
  response($th, 500);
}

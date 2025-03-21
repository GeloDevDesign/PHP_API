<?php

use Service\NoteService;
use Core\App;

$service = App::container()->resolve(NoteService::class);


try {
  $notes = $service->getAll();

  echo json_encode(['status' => 200, "data" => $notes, "message" => "Fetch Data Success"]);
} catch (\Throwable $th) {

  echo json_encode(['status' => 201, "message" => "$th"]);
}

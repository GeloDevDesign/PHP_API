<?php

namespace Controller;

use Service\NoteService;
use Core\Database;


class NoteController extends NoteService
{
  protected $notes = [];


  public function __construct(protected Database $db,  protected ?int $currentUserId = 1)
  {

    parent::__construct($this->db, $this->currentUserId);
  }

  public function index()
  {

    try {
      $this->notes = $this->getAll();

      if (empty($this->notes)) {
        response("No Data for this user.", 404);
      }

      response("Fetch Success No Data Found.", 200, $this->notes);
    } catch (\Throwable $th) {
      echo $th;
    }
  }


  public function store()
  {

    $body = $_POST['body'] ?? "";

    try {

      $result = $this->storeNotes($body);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 400);
      }

      response($body . " stored successfully", 200);
    } catch (\Throwable $th) {
      response("Unknown error during note storage.", 500);
    }
  }


  public function update()
  {

    $id = $_GET['id'] ?? 1;
    $body = $_POST['body'] ?? '';

    try {
      $result = $this->updateNotes($id, $body);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 400);
      }

      response($body . " updated successfully", 200);
    } catch (\Throwable $th) {
      response($th, 500);
    }
  }

  public function destroy()
  {

    $id = $_GET['id'] ?? 1;

    try {
      $result = $this->destroyNotes($id);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 400);
      }

      response("Deleted successfully", 201);
    } catch (\Throwable $th) {
      response($th, 500);
    }
  }
}

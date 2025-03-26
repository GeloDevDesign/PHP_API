<?php

namespace Controller;

use Service\NoteService;
use Core\Database;
use Core\Router;

class NoteController extends NoteService
{

  protected $notes = [];


  public function __construct(protected Database $db,  protected ?int $currentUserId = 1)
  {

    parent::__construct($this->db, $this->currentUserId);

  }

  public function index($params)
  {

    try {
      $this->notes = $this->getAll($params['id']);

      if (empty($this->notes)) {
        response("No Data for this user.", 404);
      }

      response("Fetch Success No Data Found.", 200, $this->notes);
    } catch (\Throwable $th) {
      echo $th;
    }
  }

  
  public function store($params)
  {
  

    try {

      $result = $this->storeNotes($params['body']);

    ;

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 400);
      }

      response($params['body'] . " stored successfully", 200);

    } catch (\Throwable $th) {
      response("Unknown error during note storage.", 500);
    }
  }


  public function update($params)
  {
    try {
      $result = $this->updateNotes($params['id'], $params['body']);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 404);
      }

      response($params['body'] . " updated successfully", 200);
    } catch (\Throwable $th) {
      response($th, 500);
    }
  }


  // require params $id;
  public function destroy($params)
  {

    try {
      $result = $this->destroyNotes($params['id']);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 400);
      }

      response("Deleted successfully", 201);
    } catch (\Throwable $th) {
      response($th, 500);
    }
  }
}

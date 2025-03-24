<?php

namespace Controller;

use Service\NoteService;
use Core\Database;
use Core\Router;

class NoteController extends NoteService
{

  protected $notes = [];
  protected $idParams;
  protected $payload;



  public function __construct(protected Database $db,  protected ?int $currentUserId = 1)
  {

    parent::__construct($this->db, $this->currentUserId);
    $this->idParams = Router::getRouteParam();
    
    parse_str(file_get_contents('php://input'), $this->payload);

  }

  public function index()
  {

    try {
      $this->notes = $this->getAll($this->idParams);

      if (empty($this->notes)) {
        response("No Data for this user.", 404);
      }

      response("Fetch Success No Data Found.", 200, $this->notes);
    } catch (\Throwable $th) {
      echo $th;
    }
  }

  // REQUEST $request
  public function store()
  {

    try {

      $result = $this->storeNotes($this->payload);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 400);
      }

      response($this->payload['body'] . " stored successfully", 200);
    } catch (\Throwable $th) {
      response("Unknown error during note storage.", 500);
    }
  }



  // require params $id;

  public function update()
  {
    
  

    try {
      $result = $this->updateNotes($this->idParams, $this->payload);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 404);
      }

      response($this->payload['body'] . " updated successfully", 200);
    } catch (\Throwable $th) {
      response($th, 500);
    }
  }


  // require params $id;
  public function destroy()
  {
   

    try {
      $result = $this->destroyNotes($this->idParams);

      if (is_array($result) && isset($result['error'])) {
        response($result['error']['message'], 400);
      }

      response("Deleted successfully", 201);
    } catch (\Throwable $th) {
      response($th, 500);
    }
  }
}

<?php

namespace Controller;

use Service\NoteService;
use Core\Database;


class NoteController extends NoteService
{
  protected $notes = [];


  public function __construct(protected Database $db,  protected ?int $currentUserId = 1)
  {

    parent::__construct($db, $currentUserId);
  }

  public  function index()
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

  
}

<?php

namespace Service;

use Core\Database;


class NoteService
{

  public function __construct(protected Database $db,  protected ?int $currentUserId = 1)
  {
    $this->db = $db;
    $this->currentUserId = $currentUserId ?? (int) ($_SESSION['user']['id'] ?? 1);
  }

  public function getAll($id)
  {
    if(empty($id))
    {
      return $this->db->query(
        "SELECT *  FROM notes WHERE user_id = :id",
        ['id' => 1]
      )->get();
    } 


    return $this->db->query(
      "SELECT id , body  FROM notes WHERE id = :id",
      ['id' => $id]
    )->find();
  }

  public function storeNotes($data)
  {
    ;

    if (empty($data)) {
      return [
        "error" => [
          "message" => "Body string must not be empty"
        ]
      ];
    }

    $result = $this->db->query(
      "INSERT INTO notes (body, user_id) VALUES (:body, :user_id)",
      ['body' => $data, 'user_id' => $this->currentUserId]
    );

    return $result; 
  }


  public function updateNotes($id, $payload)
  {

    $note = $this->db->query(
      "SELECT * FROM notes WHERE id = :id",
      ['id' => $id]
    )->findOrFail();


    if (!$note) {
      return [
        "error" => [
          "status" => 404,
          "message" => "Notes Not found"
        ]
      ];
    }

    if (empty($payload)) {
      return [
        "error" => [
          "status" => 403,
          "message" => "body must not be empty"
        ]
      ];
    }

    $result = $this->db->query(
      "UPDATE notes SET body = :body WHERE id = :id",
      [
        'id' => $id,
        'body' => $payload
      ]
    );
  }

  public function destroyNotes(int $id)
  {
    $note = $this->db->query(
      "SELECT * FROM notes WHERE id = :id",
      ['id' => $id]
    )->findOrFail();

    if (!$note) {
      return [
        "error" => [
          "status" => 404,
          "message" => "Notes Not found"
        ]
      ];
    }
    
    $result = $this->db->query("DELETE FROM notes WHERE id = :id", ['id' => $id]);

    if ($result) {
      echo "Deleted successfully";
    } else {
      echo "No record found";
    }
  }
}

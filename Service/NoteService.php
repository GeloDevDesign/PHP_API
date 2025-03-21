<?php

namespace Service;

use Core\Database;


class NoteService
{

  public function __construct(protected Database $db,  protected ?int $currentUserId = null)
  {
    $this->db = $db;
    $this->currentUserId = $currentUserId ?? (int) ($_SESSION['user']['id'] ?? 1);
  }

  public function getAll(): array
  {
    return $this->db->query(
      "SELECT body FROM notes WHERE user_id = :id",
      ['id' => $this->currentUserId]
    )->get();
  }

  public function store($body)
  {

    if (empty($body)) {
      return [
        "error" => [
          "message" => "Body string must not be empty"
        ]
      ];
    }

    $result = $this->db->query(
      "INSERT INTO notes (body, user_id) VALUES (:body, :user_id)",
      ['body' => $body, 'user_id' => $this->currentUserId]
    );

    return $result;
  }


  public function update($id,$body)
  {

    $note = $this->db->query(
      "SELECT * FROM notes WHERE id = :id",
      ['id' => $id]
    )->findOrFail();


    if (empty($note)) {
      return [
        "error" => [
          "status" => 404,
          "message" => "Notes Not found"
        ]
      ];
    }

    $result = $this->db->query(
      "UPDATE notes SET body  = :body WHERE id = :id",
      [
        'id' => 1,
        'body' => $body
      ]
    );

    return $result;
  }

  public function destroy(int $noteId)
  {
    $note = $this->db->query(
      "SELECT * FROM notes WHERE id = :id",
      ['id' => $noteId]
    )->findOrFail();

    if (!$note) {
      error(404, "Notes not found");
    }

    $result = $this->db->query("DELETE FROM notes WHERE id = :id", ['id' => $noteId]);

    if ($result) {
      echo "Deleted successfully";
    } else {
      echo "No record found";
    }
  }
}

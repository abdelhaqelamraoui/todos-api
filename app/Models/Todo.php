<?php

namespace App\Models;

use App\Database\Database;

/**
 * The model
 * @author Abdelhaq EL AMRAOUI
 */
class Todo
{

  private Database $db;

  function __construct()
  {
    $this->db = new Database();
  }

  function __destruct()
  {
    $this->db->disconnect();
    unset($this->db);
  }

  function getAll()
  {
    return $this->db->query('select * from todos');
  }


  function get($id)
  {
    return $this->db->query('select * from todos where id = ?', [$id]);
  }


  function getByUserId($userId)
  {
    return $this->db->query('select * from todos where userId = ?', [$userId]);
  }


  function add($userId, $title, $completed)
  {
    $this->db->execute(
      'insert into todos(userId, title, completed) values(?,?,?)',
      [$userId, $title, $completed]
    );
  }


  function update($id, $title, $completed)
  {
    $this->db->execute(
      'update todos set title = ?, completed = ? where id = ?',
      [$title, $completed, $id]
    );
  }


  function customUpdate($id, array $arr)
  {

    $assigns = array_map(
      function($key){
        return "$key = ?";
      },
      array_keys($arr)
    );

    $expr = implode(',', $assigns);

    $this->db->execute(
      "update todos set $expr where id = ?",
      array_merge(array_values($arr), [$id])
    );
  }


  function remove($id)
  {
    $this->db->execute('delete from todos where id = ?',  [$id]);
  }
}

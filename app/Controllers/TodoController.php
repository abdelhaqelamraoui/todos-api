<?php

namespace App\Controllers;

define('VIEWS_PATH', __DIR__ . '/../../views/');

use App\Helpers\Functions;
use \App\Models\Todo;

/**
 * The controller
 * @author Abdelhaq EL AMRAOUI
 */
class TodoController
{

   private Todo $todoModel;

   public function __construct()
   {
      $this->todoModel = new Todo();
   }


   public function index($userId = false)
   {
      $response = $userId ? $this->todoModel->getByUserId($userId) : $this->todoModel->getAll();
      Functions::respond($response);
   }


   public function show($id)
   {
      Functions::respond($this->todoModel->get((int)$id));
   }


   public function store($userId, $title, $completed)
   {
      return $this->todoModel->add($userId, $title, $completed);
   }


   public function update($id, $title, $completed)
   {
      // return $this->todoModel->update($id, $title, $completed);
      return $this->todoModel->customUpdate($id, ['title' => $title, 'completed' => $completed]);
   }


   public function customUpdate($id, array $arr)
   {
      return $this->todoModel->customUpdate($id, $arr);
   }


   public function destroy($id)
   {
      $this->todoModel->remove($id);
   }
}

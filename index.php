<?php


require_once __DIR__ . '/app/autoload.php';

use App\Controllers\TodoController;
use App\Helpers\Functions;
use App\Models\Todo;

$resources = [
   'todos' => 'todos'
];

$controller = new TodoController();
$model = new Todo();

$arrPath = explode('/', $_SERVER['PATH_INFO']);
$resource = $arrPath[1];

if(! isset($resources[$resource])) {
   echo 'The given resource is not supported -_-';
   exit(-1);
}

if(Functions::is_get()) {
   switch(count($arrPath)) {
      case 2:
         $controller->index($_GET['userId'] ?? false);
         break;
      case 3:
         $id = (int) $arrPath[2];
         $controller->show($id);
         break;
      default:
         return;
   }
}

else if(Functions::is_post()) {
   switch (count($arrPath)) {
      case 2:
         $todoObj = json_decode(file_get_contents('php://input'));
         $controller->store(
            $todoObj->userId,
            $todoObj->title,
            $todoObj->completed
         );
         break;

      default:
         exit;
   }
}


else if (Functions::is_delete()) {
   switch (count($arrPath)) {
      case 3:
         $id = (int) $arrPath[2];
         $controller->destroy($id);
         break;
      default:
         exit;
   }
}


else if (Functions::is_put()) {
   switch (count($arrPath)) {
      case 3:
         $id = (int) $arrPath[2];
         $todoObj = json_decode(file_get_contents('php://input'));
         $controller->update(
            $id,
            $todoObj->title,
            $todoObj->completed
         );
         break;
      default:
         exit;
   }
}


else if (Functions::is_patch()) {
   switch (count($arrPath)) {
      case 3:
         $id = (int) $arrPath[2];
         $todoObj = json_decode(file_get_contents('php://input'));
         $controller->customUpdate($id, get_object_vars($todoObj));
         break;
      default:
         exit;
   }
}
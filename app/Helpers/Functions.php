<?php

namespace App\Helpers;

/**
 * Class of helpful static functions
 * @author Abdelhaq EL AMRAOUI
 */
class Functions
{

  public static function is_post(): bool
  {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
  }


  public static function is_get(): bool
  {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
  }


  public static function is_put(): bool
  {
    return $_SERVER['REQUEST_METHOD'] === 'PUT';
  }


  public static function is_delete(): bool
  {
    return $_SERVER['REQUEST_METHOD'] === 'DELETE';
  }


  public static function is_patch(): bool
  {
    return $_SERVER['REQUEST_METHOD'] === 'PATCH';
  }


  public static function prettyPrint($val, bool $dump = false)
  {
    echo '<pre>';
    $dump === true ? var_dump($val) : print_r($val);
    echo '</pre>';
  }


  public static function respond($data)
  {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
}

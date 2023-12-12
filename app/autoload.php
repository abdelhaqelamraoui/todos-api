<?php

namespace App;

/**
 * Autoloading classes via thier fully qualified names
 */

spl_autoload_register(function($class) {
  $classPath = __DIR__ . '/../' . str_replace('\\', '/', lcfirst($class)) . '.php';
  if(file_exists($classPath)) {
    require $classPath;
  }
});
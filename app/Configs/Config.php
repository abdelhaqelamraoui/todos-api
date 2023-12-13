<?php

namespace App\Configs;

/**
 * The configurations required by the App
 * @author Abdelhaq EL AMRAOUI
 */
class Config
{

   /*----------------------------------------------------------
    *
    * Edit these configuration constants to match yours.
    *
    *--------------------------------------------------------*/

   const ENGINE   = 'mysql';
   const HOSTNAME = 'localhost';
   const PORT     = 3306;
   const DBNAME   = 'ofppt_api';
   const USERNAME = 'root';
   const PASSWORD = 'root';

   /**
    * The number of rows to initialize the database with.
    */
   const MAX_INIT_ROWS = 20;


}
<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 27/01/2018
 * Time: 07h19
 */
require 'Database.php';

use app\config\Database;

  class App
  {
      CONST DB_NAME = 'i_salomon_db';
      CONST DB_USER = 'root';
      CONST DB_PASS = '';
      CONST DB_HOST = 'localhost';

      private static $database;



      public static function getDB(){

          if(self::$database === null)
          {
              self::$database = new Database(self::DB_HOST, self::DB_NAME, self::DB_USER, self::DB_PASS);
          }

         return self::$database;
      }

  }


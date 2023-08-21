<?php

namespace Yc\framework;

abstract class Migration
{

   abstract public function up();
   abstract public function down();
   protected static array $varchar = [];

   protected static function createTable(string $table, string $query)
   {
      $db = App::$instance::DB();
      $SQL =  "CREATE TABLE IF NOT EXISTS $table($query) ENGINE=INNODB;";
      $db->connection->exec($SQL);
   }

   protected function dropTable(string $table)
   {
      $db = App::$instance::$DB;
      $SQL =  "DROP TABLE  IF EXISTS $table;";
      $db->connection->exec($SQL);
   }
}

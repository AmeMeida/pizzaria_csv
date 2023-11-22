<?php

namespace DB;

use PDO;

class Database {
  private static $instance = null;
  private $connection;

  private function __construct() {
    $this->connection = new PDO('sqlite:' . __DIR__ . '/database.db');
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new Database();
    }

    return self::$instance->connection;
  }
}

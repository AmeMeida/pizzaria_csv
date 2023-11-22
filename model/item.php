<?php
require_once __DIR__ . '/../database/database.php';

use DB\Database as DB;

class Item {
  public $id;
  public $name;
  public $price;
  public $description;

  function __construct(?int $id, string $name, int $price, string $description) {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->description = $description;
  }

  public static function all($name = null) {
    $list = [];
    $db = DB::getInstance();

    if ($name == null) {
      $req = $db->query('SELECT id, name, price, description FROM items');
    } else {
      $req = $db->prepare('SELECT id, name, price, description FROM items WHERE name LIKE :name');
      $req->execute(['name' => "%$name%"]);
    }

    foreach($req->fetchAll() as $item) {
      $list[] = new Item($item['id'], $item['name'], $item['price'], $item['description']);
    }

    return $list;
  }

  public static function find($id) {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT id, name, price, description FROM items WHERE id = :id');
    $req->execute(['id' => $id]);
    $item = $req->fetch();

    return $item == null ? null : new Item($item['id'], $item['name'], $item['price'], $item['description']);
  }

  public function exists() {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT id FROM items WHERE id = :id');
    $req->execute(['id' => $this->id]);
    $item = $req->fetch();

    return $item ? true : false;
  }

  public function create() {
    $db = DB::getInstance();
    $req = $db->prepare('INSERT INTO items (name, price, description) VALUES (:name, :price, :description)');
    $req->execute([
      'name' => $this->name,
      'price' => $this->price,
      'description' => $this->description
    ]);

    $this->id = $db->lastInsertId();
  }

  public function update() {
    $db = DB::getInstance();
    $req = $db->prepare('UPDATE items SET name = :name, price = :price, description = :description WHERE id = :id');
    $req->execute([
      'id' => $this->id,
      'name' => $this->name,
      'price' => $this->price,
      'description' => $this->description
    ]);
  }
}

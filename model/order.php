<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/item.php';

use DB\Database as DB;

class Order {
  public  $id;
  public $costumer;
  public $address;
  public $item;
  public $quantity;
  public $date;

  function __construct(?int $id, string $costumer, string $address, int $quantity = 1, ?Item $item = null, ?string $date = null) {
    $this->id = $id;
    $this->costumer = $costumer;
    $this->address = $address;
    $this->quantity = $quantity;
    $this->item = $item;
    $this->date = $date;
  }

  public static function all(?string $name = null): array {
    $list = [];
    $db = DB::getInstance();

    if ($name == null) {
      $req = $db->query('SELECT orders.id, costumer, address, created_at as `date`, quantity,
                                items.id as item_id, items.name as item_name, items.price as item_price, items.description as item_description
                        FROM orders
                        INNER JOIN items ON orders.item_id = items.id
                        ORDER BY created_at DESC;
                      ');
    } else {
      $req = $db->prepare('SELECT orders.id, costumer, address, created_at as `date`, quantity,
                                  items.id as item_id, items.name as item_name, items.price as item_price,
                                  items.description as item_description
                           FROM orders
                           INNER JOIN items ON orders.item_id = items.id
                           WHERE items.name LIKE :name
                           ORDER BY created_at DESC;
                         ');

      $req->execute(['name' => "%$name%"]);
    }

    foreach($req->fetchAll() as $order) {
      $item = new Item($order['item_id'], $order['item_name'], $order['item_price'], $order['item_description']);

      $list[] = new Order($order['id'], $order['costumer'], $order['address'], $order["quantity"], $item, $order['date']);
    }

    return $list;
  }

  public static function find(int $id) {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT orders.id, costumer, address, created_at as `date`, quantity,
                                items.id as item_id, items.name as item_name, items.price as item_price, items.description as item_description
                         FROM orders
                         INNER JOIN items ON orders.item_id = items.id
                         WHERE orders.id = :id
                         ORDER BY created_at DESC;
                      ');
    $req->execute(['id' => $id]);
    $order = $req->fetch();

    $item = new Item($order['item_id'], $order['item_name'], $order['item_price'], $order['item_description']);

    return new Order($order['id'], $order['costumer'], $order['address'], $order['quantity'], $item, $order['date']);
  }

  public function exists(): bool {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT id FROM orders WHERE id = :id');
    $req->execute(['id' => $this->id]);
    $order = $req->fetch();

    return $order ? true : false;
  }

  public function create(int $itemId): void {
    $db = DB::getInstance();
    $req = $db->prepare('INSERT INTO orders (costumer, address, quantity, item_id)
                        VALUES (:costumer, :address, :quantity, :item_id)');
    $req->execute([
      'costumer' => $this->costumer,
      'address' => $this->address,
      'quantity' => $this->quantity,
      'item_id' => $itemId
    ]);

    $this->id = $db->lastInsertId();
  }

  public function update(): void {
    $db = DB::getInstance();
    $req = $db->prepare('UPDATE orders SET costumer = :costumer, address = :address, item_id = :item_id WHERE id = :id');
    $req->execute([
      'id' => $this->id,
      'costumer' => $this->costumer,
      'address' => $this->address,
      'item_id' => $this->item->id
    ]);
  }
}

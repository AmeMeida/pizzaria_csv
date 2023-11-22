<?php
require_once __DIR__ . "/../../model/order.php";

$costumer = isset($_GET['name']) && $_GET["name"] ? $_GET['name'] : null;


if (!isset($_GET['id']) || !$_GET['id']) {
  $orders = Order::all($costumer);
} else {
  $order = Order::find($_GET['id']);
  $orders = $order ? [$order] : [];
}
?>

<table role="grid">
  <thead>
    <tr>
      <th>Id</th>
      <th>Customer</th>
      <th>Address</th>
      <th>Item</th>
      <th>Price</th>
      <th>Quantity</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $order): ?>
      <tr>
        <td><?= $order->id ?></td>
        <td><?= $order->costumer ?></td>
        <td><?= $order->address ?></td>
        <td><?= $order->item->name ?></td>
        <td><?= $order->item->price ?></td>
        <td><?= $order->quantity ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

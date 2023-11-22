<?php
require_once __DIR__ . "/../../model/order.php";

$customer = isset($_GET['name']) && $_GET["name"] ? $_GET['name'] : null;


if (!isset($_GET['id']) || !$_GET['id']) {
  $orders = Order::all($customer);
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
      <th>Subtotal</th>
      <th>Notes</th>
      <th>Quantity</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $order): ?>
      <tr>
        <td><?= $order->id ?></td>
        <td><?= $order->customer ?></td>
        <td><?= $order->address ?></td>
        <td><?= $order->item->name ?></td>
        <td><?= $order->item->price * $order->quantity ?></td>
        <td><?= $order->notes ?></td>
        <td><?= $order->quantity ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

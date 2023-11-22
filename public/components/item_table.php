<?php
require_once __DIR__ . '/../../model/item.php';

if (!isset($_GET['id']) || !$_GET['id']) {
  $itemName = isset($_GET['name']) && $_GET["name"] ? $_GET['name'] : null;
  $items = Item::all($itemName);
} else {
  $item = Item::find($_GET['id']);
  $items = $item ? [$item] : [];
}
?>

<table role="grid">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Price</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item): ?>
      <tr>
        <td><?= $item->id ?></td>
        <td><?= $item->name ?></td>
        <td><?= $item->price ?></td>
        <td><?= $item->description ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

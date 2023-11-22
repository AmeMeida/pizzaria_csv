<?php
require_once __DIR__ . "/../../model/item.php";

$items = Item::all();
?>

<select name="item" required="<?= $required ?>">
  <?php foreach ($items as $item): ?>
    <option value="<?= $item->id ?>"><?= $item->name ?></option>
  <?php endforeach ?>
</select>

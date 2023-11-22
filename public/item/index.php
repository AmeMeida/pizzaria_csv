<?php $title = "Items";
require_once __DIR__ . "/../../partials/head.php" ?>

<main>
  <hgroup>
    <h1>Items</h1>
    <h3><a href="/csv/item/new.php">Create a new item</a></h3>
  </hgroup>

  <?php require_once __DIR__ . '/../components/item_table.php' ?>
</main>

<?php require_once __DIR__ . "/../../partials/end.php" ?>

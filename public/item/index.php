<?php
$id = isset($_GET["id"]) && $_GET["id"] ? $_GET["id"] : null;

$title = "Items";
require_once __DIR__ . "/../../partials/head.php"
?>

<main>
  <hgroup>
    <h1>Items</h1>
    <h3><a href="./item/new.php">Create a new item</a></h3>
  </hgroup>

  <form>
    <div class="grid">
      <label for="name">
        Filter by item name
        <input type="text" name="name">
      </label>

      <label for="id">
        Filter by item id
        <input type="number" name="id" id="id"
          <?php if ($id): ?> value="<?= $id ?>" <?php endif; ?>>
      </label>
    </div>

    <div class="grid">
      <button type="submit">Search</button>
    </div>
  </form>

  <?php require_once __DIR__ . '/../../partials/items_download.php' ?>

  <?php require_once __DIR__ . '/../components/item_table.php' ?>
</main>

<?php require_once __DIR__ . "/../../partials/end.php" ?>

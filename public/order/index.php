<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$id = isset($_GET["id"]) && $_GET["id"] ? $_GET["id"] : null;
?>

<?php $title = "Orders"; require_once __DIR__ . "/../../partials/head.php" ?>

<main>
  <hgroup>
    <h1>Orders</h1>
    <h3><a href="/csv/order/new.php">Create a new order</a></h3>
  </hgroup>

  <form>
    <div class="grid">
      <label for="costumer">
        Filter by costumer name
        <input type="text" name="customer">
      </label>

      <label for="id">
        Filter by order id
        <input type="number" name="id" id="id"
          <?php if ($id): ?> value="<?= $id ?>" <?php endif; ?>>
      </label>
    </div>

    <div class="grid">
      <button type="submit">Search</button>
    </div>
  </form>

  <?php require_once __DIR__ . '/../components/order_table.php' ?>
</main>

<?php require_once __DIR__ . "/../../partials/end.php" ?>

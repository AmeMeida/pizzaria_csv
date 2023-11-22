<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  require_once __DIR__ . "/../../model/order.php";

  $order = new Order(null, $_POST["costumer"], $_POST["address"], $_POST["quantity"]);

  $order->create($_POST["item"]);
}

require_once __DIR__ . "/../../model/item.php";
?>

<?php $title = "New order";
require_once __DIR__ . "/../../partials/head.php" ?>

<main>
  <hgroup>
    <h1>New order</h1>
    <h3><a href="./order">See all orders</a></h3>
  </hgroup>

  <form action="./order/new.php" method="post">
    <div class="grid">
      <label for="costumer">
        Costumer name
        <input type="text" required name="costumer">
      </label>

      <label for="address">
        Costumer address
        <input type="text" required name="address">
      </label>

      <label for="quantity">
        Quantity
        <input type="number" required name="quantity" min="1" value="1">
      </label>
    </div>

    <label for="item">
      Ordered item
      <?php require_once __DIR__ . "/../components/item_selector.php"; ?>
    </label>

    <button type="submit">Create</button>
  </form>
</main>

<?php require_once __DIR__ . "/../../partials/end.php" ?>

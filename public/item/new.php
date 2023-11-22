<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  try {
    require_once __DIR__ . "/../../database/database.php";

    require_once __DIR__ . "/../../model/item.php";

    $item = new Item(null, $_POST["name"], $_POST["price"], $_POST["description"]);

    $item->create();
  } catch (Exception $e) {
    echo $e->getMessage();
  }

}

?>

<?php $title = "New item";
require_once __DIR__ . "/../../partials/head.php" ?>

<main>
  <hgroup>
    <h1>Create a new item</h1>
    <h3><a href="./item">See all items</a></h3>
  </hgroup>

  <form action="./item/new.php" method="post">
    <div class="grid">
      <label for="name">
        Item name
        <input type="text" required name="name">
      </label>
      <label for="price">
        Price
        <input type="text" name="price" required min="0" inputmode="numeric"
          pattern="^(?:([1-9][0-9]*(\.[0-9]{1,2})?)|0(?!\.00)(\.[0-9]{1,2}))$">
      </label>
    </div>

    <label for="description">
      Short description of the item
      <textarea name="description" id="description" required rows="6"></textarea>
    </label>

    <button type="submit">Create</button>
  </form>
</main>

<?php require_once __DIR__ . "/../../partials/end.php" ?>

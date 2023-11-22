<?php
$title = "Metrics";
require_once __DIR__ . "/../../partials/head.php";

$button = true;
?>

<main>
  <hgroup>
    <h1>Metrics</h1>
    <h3>Download CSV files</h3>
  </hgroup>

  <div class="grid">
    <?php require_once __DIR__ . '/../../partials/orders_download.php' ?>
    <?php require_once __DIR__ . '/../../partials/items_download.php' ?>
  </div>
</main>

<?php require_once __DIR__ . "/../../partials/end.php" ?>

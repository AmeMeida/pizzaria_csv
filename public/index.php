<?php

require_once __DIR__ . "/../database/database.php";

use DB\Database as DB;

$db = DB::getInstance();

$res = $db->query('SELECT 1 + 1 as result');

$row = $res->fetch();

?>

<?php $title = "Home"; require_once __DIR__ . "/../partials/head.php" ?>

<main>
  <h1>Pizzaria</h1>
  <?= $row['result'] ?>
</main>

<?php require_once __DIR__ . "/../partials/end.php" ?>

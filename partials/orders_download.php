<?php
require_once __DIR__ . "/../model/order.php";

$csv_path = __DIR__ . "/../public/uploads/csv/orders.csv";
$file = fopen($csv_path, "w");

$header = [
  "id",
  "name",
  "price",
  "description"
];
fputcsv($file, $header);

$orders = Order::all();

foreach ($orders as $order) {
  $row = [
    $order->id,
    $order->costumer,
    $order->address,
    $order->quantity,
    $order->item->id,
    $order->date
  ];

  fputcsv($file, $row);
}

fclose($file);
?>

<?php if (isset($button) && $button): ?>
  <a href="./uploads/csv/orders.csv" role="button" download>Orders CSV</a>
<?php else: ?>
  <a href="./uploads/csv/orders.csv" download>Orders CSV</a>
<?php endif; ?>

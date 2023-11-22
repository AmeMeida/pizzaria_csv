<?php
require_once __DIR__ . "/../model/item.php";

$csv_path = __DIR__ . "/../public/uploads/csv/items.csv";
$file = fopen($csv_path, "w");

$header = [
  "id",
  "name",
  "price",
  "description"
];
fputcsv($file, $header);

$items = Item::all();

foreach ($items as $item) {
  $row = [
    $item->id,
    $item->name,
    $item->price,
    $item->description
  ];

  fputcsv($file, $row);
}

fclose($file);
?>

<?php if (isset($button) && $button): ?>
  <a href="./uploads/csv/items.csv" role="button" download>Items CSV</a>
<?php else: ?>
  <a href="./uploads/csv/items.csv" download>Items CSV</a>
<?php endif; ?>

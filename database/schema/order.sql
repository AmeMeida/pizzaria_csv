--- sqlite3

CREATE TABLE items (
  id INTEGER PRIMARY KEY,
  `name` TEXT NOT NULL,
  price INTEGER NOT NULL,
  `description` TEXT NOT NULL
);

CREATE TABLE orders (
  id INTEGER PRIMARY KEY,
  customer TEXT NOT NULL,
  `address` TEXT NOT NULL,
  notes TEXT,
  item_id INTEGER NOT NULL,
  quantity INTEGER NOT NULL DEFAULT 1,
  created_at INTEGER NOT NULL DEFAULT (strftime('%s')),

  FOREIGN KEY (item_id) REFERENCES items(id)
);

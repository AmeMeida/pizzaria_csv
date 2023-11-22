--- sqlite3

CREATE TABLE items (
  id SERIAL PRIMARY KEY,
  `name` VARCHAR(64) NOT NULL,
  price INTEGER NOT NULL,
  `description` TEXT NOT NULL
);

CREATE TABLE orders (
  id SERIAL PRIMARY KEY,
  costumer VARCHAR(64) NOT NULL,
  `address` VARCHAR(64) NOT NULL,
  item_id BIGINT UNSIGNED NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT (NOW()),

  FOREIGN KEY (item_id) REFERENCES items(id)
);

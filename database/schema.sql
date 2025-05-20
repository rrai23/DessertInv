/*Initial database and table structure*/

/*Use this to create the database*/
CREATE DATABASE IF NOT EXISTS `dessert_inventory`;

/*Use this to create the item table*/
CREATE TABLE IF NOT EXISTS `crem_de_la_crem` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(100),
    description TEXT,
    image_path VARCHAR(255),
    last_restocked DATE NOT NULL,
    is_available TINYINT(1) NOT NULL DEFAULT 1,
    sell_price FLOAT NOT NULL,
    cost_price FLOAT NOT NULL,
    quantity INT NOT NULL,
    active TINYINT(1) NOT NULL DEFAULT 1
);

/*Use this to create the restock history table*/
CREATE TABLE IF NOT EXISTS restock_history(
    restock_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    item_id INT NOT NULL,
    datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    old_quantity INT NOT NULL,
    quantity_added INT NOT NULL CHECK (quantity_added>0),
    new_quantity INT NOT NULL CHECK (new_quantity = old_quantity + quantity_added),
    updated_by VARCHAR(64) NOT NULL,
    FOREIGN KEY (item_id) REFERENCES crem_de_la_crem(id)
);
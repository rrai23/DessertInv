/*Initial database and table structure*/

/*Use this to create the database*/
CREATE DATABASE IF NOT EXISTS `dessert_inventory`;

/*Use this to create the table*/
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
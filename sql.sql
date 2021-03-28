CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50)NOT NULL,
    password VARCHAR(255)NOT NULL,
    group_user INT NOT NULL
);
ALTER TABLE users ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE permission_groups(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)NOT NULL
);
ALTER TABLE permission_groups ADD COLUMN id_companies INT NOT NULL AFTER id
ALTER TABLE permission_groups ADD COLUMN params INT NOT NULL AFTER id_companies

CREATE TABLE permission_params(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)NOT NULL,
    params VARCHAR(200)NOT NULL
);
ALTER TABLE permission_params ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE clients(
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(100)NOT NULL,
     email VARCHAR(100),
     phone VARCHAR(50),
     address VARCHAR(100),
     address_neighb VARCHAR(100),
     address_city VARCHAR(50),
     address_state VARCHAR(50),
     address_country VARCHAR(50),
     address_zipcode VARCHAR(50),
     stars INT(3)NOT NULL,
     internal_obs TEXT
);
ALTER TABLE clients ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE inventory(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)NOT NULL,
    price FLOAT NOT NULL,
    quant INT NOT NULL,
    min_quant INT NOT NULL
);
ALTER TABLE inventory ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE inventory_history(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_product INT NOT NULL,
    id_user INT NOT NULL,
    action VARCHAR(3)NOT NULL,
    date_action DATETIME NOT NULL
);
ALTER TABLE inventory_history ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE sales(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_user INT NOT NULL,
    date_sale DATETIME NOT NULL,
    total_price FLOAT NOT NULL
);
ALTER TABLE sales ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE sales_products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_sale INT NOT NULL,
    id_product INT NOT NULL,
    quant INT NOT NULL,
    sale_price FLOAT NOT NULL
);
ALTER TABLE sales_products ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE purchases(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    date_purchase DATETIME NOT NULL,
    total_price FLOAT
);
ALTER TABLE purchases ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE purchases_products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_purchase INT NOT NULL,
    name VARCHAR(100)NOT NULL,
    quant INT NOT NULL,
    purchase_price FLOAT
);
ALTER TABLE purchases_products ADD COLUMN id_companies INT NOT NULL AFTER id

CREATE TABLE companies(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)NOT NULL
);

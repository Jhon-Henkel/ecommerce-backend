-- criando database --
CREATE DATABASE ecommerce;

-- criando tabela marca --
CREATE TABLE IF NOT EXISTS brand (
    brand_id int(10) NOT NULL AUTO_INCREMENT,
    brand_code varchar(50) NOT NULL,
    brand_name varchar(255) NOT NULL,
    PRIMARY KEY (brand_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela categoria --
CREATE TABLE IF NOT EXISTS category (
    category_id int(20) NOT NULL AUTO_INCREMENT,
    category_code varchar(50) NOT NULL,
    category_name varchar(255) NOT NULL,
    category_father_id int(10) DEFAULT NULL,
    PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela cor --
CREATE TABLE IF NOT EXISTS color (
    color_id int(10) NOT NULL AUTO_INCREMENT,
    color_code varchar(50) NOT NULL,
    color_name varchar(255) NOT NULL,
    PRIMARY KEY (color_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela tamanho --
CREATE TABLE IF NOT EXISTS size (
    size_id int(10) NOT NULL AUTO_INCREMENT,
    size_code varchar(50) NOT NULL,
    size_name varchar(255) NOT NULL,
    PRIMARY KEY (size_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela produto estoque --
CREATE TABLE IF NOT EXISTS product_stock (
    product_stock_id int(10) NOT NULL AUTO_INCREMENT,
    product_stock_code varchar(50) NOT NULL,
    product_stock_quantity int(10) NOT NULL,
    product_stock_color_id int(10) NOT NULL,
    product_stock_size_id int(10) NOT NULL,
    product_stock_brand_id int(10) NOT NULL,
    PRIMARY KEY (product_stock_id),
    FOREIGN KEY (product_stock_color_id) REFERENCES color(color_id),
    FOREIGN KEY (product_stock_size_id) REFERENCES size(size_id),
    FOREIGN KEY (product_stock_brand_id) REFERENCES brand(brand_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela produtos --
CREATE TABLE IF NOT EXISTS product (
    product_id int(10) NOT NULL AUTO_INCREMENT,
    product_code varchar(50) NOT NULL,
    product_name varchar(255) NOT NULL,
    product_stock_id int(10) NOT NULL,
    product_description text DEFAULT NULL,
    product_category_id int(10) NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (product_stock_id) REFERENCES product_stock(product_stock_id),
    FOREIGN KEY (product_category_id) REFERENCES category(category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
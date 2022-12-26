-- criando database --
CREATE DATABASE ecommerce DEFAULT CHARSET = utf8mb4;

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

-- criando tabela produtos --
CREATE TABLE IF NOT EXISTS product (
    product_id int(10) NOT NULL AUTO_INCREMENT,
    product_code varchar(50) NOT NULL,
    product_name varchar(255) NOT NULL,
    product_url varchar(255) NOT NULL,
    product_description text DEFAULT NULL,
    product_category_id int(10) NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (product_category_id) REFERENCES category(category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela produto estoque --
CREATE TABLE IF NOT EXISTS product_stock (
    product_stock_id int(10) NOT NULL AUTO_INCREMENT,
    product_stock_code varchar(50) NOT NULL,
    product_stock_name varchar(255) NOT NULL,
    product_stock_quantity int(10) NOT NULL,
    product_stock_color_id int(10) NOT NULL,
    product_stock_size_id int(10) NOT NULL,
    product_stock_brand_id int(10) NOT NULL,
    product_stock_product_id int(10) NOT NULL,
    product_stock_price decimal(6, 2) NOT NULL,
    product_stock_width int(10) NOT NULL,
    product_stock_height int(10) NOT NULL,
    product_stock_length int(10) NOT NULL,
    product_stock_gross_weight int(10) NOT NULL,
    PRIMARY KEY (product_stock_id),
    FOREIGN KEY (product_stock_color_id) REFERENCES color(color_id),
    FOREIGN KEY (product_stock_size_id) REFERENCES size(size_id),
    FOREIGN KEY (product_stock_brand_id) REFERENCES brand(brand_id),
    FOREIGN KEY (product_stock_product_id) REFERENCES product(product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela cliente --
CREATE TABLE IF NOT EXISTS client (
    client_id int(10) NOT NULL AUTO_INCREMENT,
    client_name varchar(255) NOT NULL,
    client_document_type int(10) NOT NULL,
    client_document varchar(20) NOT NULL UNIQUE,
    client_main_phone varchar(20) DEFAULT NULL,
    client_second_phone varchar(20) DEFAULT NULL,
    client_email varchar(150) NOT NULL UNIQUE,
    client_birth_date datetime NOT NULL,
    client_password varchar(255) NOT NULL,
    client_created_at datetime DEFAULT current_timestamp(),
    client_updated_at datetime DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (client_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela endereço cliente --
CREATE TABLE IF NOT EXISTS address (
    address_id int(10) NOT NULL AUTO_INCREMENT,
    address_client_id int(10) NOT NULL,
    address_street varchar(255) NOT NULL,
    address_zip_code varchar(10) NOT NULL,
    address_number int(10) DEFAULT NULL,
    address_complement varchar(255) DEFAULT NULL,
    address_district varchar(255) NOT NULL,
    address_city varchar(255) NOT NULL,
    address_state varchar(255) NOT NULL,
    address_reference varchar(255) DEFAULT NULL,
    address_created_at datetime DEFAULT current_timestamp(),
    address_updated_at datetime DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (address_id),
    FOREIGN KEY (address_client_id) REFERENCES client(client_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela cupom desconto --
CREATE TABLE IF NOT EXISTS gift_card (
    gift_card_id int(10) NOT NULL AUTO_INCREMENT,
    gift_card_code varchar(100) NOT NULL,
    gift_card_discount_type int(10) NOT NULL,
    gift_card_discount decimal(6, 2) NOT NULL,
    gift_card_usages int(10) NOT NULL DEFAULT 0,
    gift_card_max_usages int(100) NOT NULL,
    gift_card_status int(10) NOT NULL,
    gift_card_created_at datetime DEFAULT current_timestamp(),
    gift_card_updated_at datetime DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (gift_card_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela carrinho --
CREATE TABLE IF NOT EXISTS cart (
    cart_id int(10) NOT NULL AUTO_INCREMENT,
    cart_client_id int(10) NOT NULL,
    cart_order_done int(1) NOT NULL DEFAULT 0,
    cart_hash varchar(100) NOT NULL,
    cart_gift_card_id int(10) DEFAULT NULL,
    cart_created_at datetime DEFAULT current_timestamp(),
    cart_updated_at datetime DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (cart_id),
    FOREIGN KEY (cart_client_id) REFERENCES client(client_id),
    FOREIGN KEY (cart_gift_card_id) REFERENCES gift_card(gift_card_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela item carrinho --
CREATE TABLE IF NOT EXISTS cart_item (
    cart_item_id int(10) NOT NULL AUTO_INCREMENT,
    cart_item_cart_id int(10) NOT NULL,
    cart_item_stock_id int(10) NOT NULL,
    cart_item_quantity int(10) NOT NULL,
    cart_item_created_at datetime DEFAULT current_timestamp(),
    cart_item_updated_at datetime DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (cart_item_id),
    FOREIGN KEY (cart_item_cart_id) REFERENCES cart(cart_id),
    FOREIGN KEY (cart_item_stock_id) REFERENCES product_stock(product_stock_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- criando tabela pedidos --
CREATE TABLE IF NOT EXISTS order_data (
    order_data_id int(10) NOT NULL AUTO_INCREMENT,
    order_data_client_name varchar(255) NOT NULL,
    order_data_client_document_type int(10) NOT NULL,
    order_data_client_document varchar(20) NOT NULL,
    order_data_client_main_phone varchar(20) NOT NULL,
    order_data_client_second_phone varchar(20) NOT NULL,
    order_data_client_email varchar(150) NOT NULL,
    order_data_address_street varchar(255) NOT NULL,
    order_data_address_zip_code varchar(10) NOT NULL,
    order_data_address_number int(10) NOT NULL,
    order_data_address_complement varchar(255) DEFAULT NULL,
    order_data_address_district varchar(255) NOT NULL,
    order_data_address_city varchar(255) NOT NULL,
    order_data_address_state varchar(255) NOT NULL,
    order_data_address_reference varchar(255) DEFAULT NULL,
    order_data_status int(10) NOT NULL DEFAULT 5,
    order_data_cart_id int(10) NOT NULL,
    order_data_itens_quantity int(10) NOT NULL,
    order_data_gift_card_code varchar(255) DEFAULT NULL,
    order_data_gift_card_value decimal(6, 2) DEFAULT NULL,
    order_data_shipping_value decimal(6, 2) DEFAULT NULL,
    order_data_itens_value decimal(6, 2) NOT NULL,
    order_data_extra_fare_value decimal(6, 2) DEFAULT NULL,
    order_data_total_value decimal(6, 2) NOT NULL,
    order_data_shipping_deadline int(10) DEFAULT NULL,
    order_data_created_at datetime DEFAULT current_timestamp(),
    order_data_updated_at datetime DEFAULT NULL ON UPDATE current_timestamp(),
    PRIMARY KEY (order_data_id),
    FOREIGN KEY (order_data_cart_id) REFERENCES cart(cart_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
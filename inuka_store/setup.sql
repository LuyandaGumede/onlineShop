CREATE TABLE `toy_comp_db`.`products` ( 
    `id` INT(5) NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) NOT NULL , 
    `desc` VARCHAR(255) NOT NULL , 
    `code` VARCHAR(255) NOT NULL , 
    `image` BLOB NOT NULL , 
    `price` DOUBLE(10,2) NOT NULL , 
    `stock` INT(5) NOT NULL , 
    PRIMARY KEY (`id`), 
    UNIQUE (`code`)
) ENGINE = InnoDB;

CREATE TABLE `toy_comp_db`.`orders` (
    `id` INT(8) NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) NOT NULL , 
    `email` VARCHAR(255) NOT NULL , 
    `phone` VARCHAR(10) NOT NULL , 
    `address` VARCHAR(255) NOT NULL ,
    `ref` VARCHAR(255) NOT NULL , 
    `total` DOUBLE(10,2) NOT NULL ,
    `prod_arr` VARCHAR(255) NOT NULL , 
    `paid` TINYINT(1) NOT NULL DEFAULT '0' ,
    `delivered` TINYINT(1) NOT NULL DEFAULT '0' ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `products` (`id`, `name`, `desc`, `code`, `price`, `stock`) VALUES 
(NULL, 'Fidget Spinner', 'Fidget Spinner that spins', 'fdgspi', 50.00, 50), 
(NULL, 'Bottle Opener Ring', 'Bottle Opener Ring that opens bottles', 'btlrng', 120.00, 50), 
(NULL, 'Fidget Cube', 'Fidget Cube that cubes', 'fdgcub', 60.00, 50)
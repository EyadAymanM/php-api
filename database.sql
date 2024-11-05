CREATE DATABASE products;

CREATE TABLE `product`. (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `sku` VARCHAR(50) NOT NULL , 
  `name` VARCHAR(100) NOT NULL , 
  `price` INT NOT NULL , 
  `type` VARCHAR(50) NOT NULL , 
  `attribute_value` VARCHAR(50) NOT NULL , 
  PRIMARY KEY (`id`), UNIQUE `SKU` (`sku`)) 
  ENGINE = InnoDB;
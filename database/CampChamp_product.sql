
-- -----------------------------------------------------
-- Schema CampChamp_Product
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS CampChamp_Product ;

-- -----------------------------------------------------
-- Schema CampChamp_Product
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS CampChamp_Product DEFAULT CHARACTER SET utf8 ;
USE CampChamp_Product ;

-- -----------------------------------------------------
-- Table Product
-- -----------------------------------------------------
DROP TABLE IF EXISTS Product ;

CREATE TABLE IF NOT EXISTS Product (
  prod_id INT NOT NULL,
  prod_name VARCHAR(45) NOT NULL,
  prod_descript VARCHAR(255) NOT NULL,
  img_loc VARCHAR(255) NOT NULL,
  PRIMARY KEY (prod_id))
;

-- -----------------------------------------------------
-- Table ProductInventory
-- -----------------------------------------------------
DROP TABLE IF EXISTS ProductInventory ;

CREATE TABLE IF NOT EXISTS ProductInventory (
  prod_id INT NOT NULL,
  prod_quant INT NOT NULL,
  prod_stock INT NOT NULL,
  prod_alt_date DATE NOT NULL,
  PRIMARY KEY (prod_id),
  CONSTRAINT fk_ProductInventory_Product1
    FOREIGN KEY (prod_id)
    REFERENCES Product (prod_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table Price
-- -----------------------------------------------------
DROP TABLE IF EXISTS Price ;

CREATE TABLE IF NOT EXISTS Price (
  prod_id INT NOT NULL,
  price_sdate DATE NOT NULL,
  price FLOAT NOT NULL,
  PRIMARY KEY (prod_id, price_sdate),
  CONSTRAINT fk_Price_Product1
    FOREIGN KEY (prod_id)
    REFERENCES Product (prod_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table PriceHistory
-- -----------------------------------------------------
DROP TABLE IF EXISTS PriceHistory ;

CREATE TABLE IF NOT EXISTS PriceHistory (
  prod_id INT NOT NULL,
  price_sdate DATE NOT NULL,
  price_edate DATE NOT NULL,
  PRIMARY KEY (prod_id, price_sdate),
  CONSTRAINT fk_PriceHistory_Price1
    FOREIGN KEY (prod_id , price_sdate)
    REFERENCES Price (prod_id , price_sdate)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table Part
-- -----------------------------------------------------
DROP TABLE IF EXISTS Part ;

CREATE TABLE IF NOT EXISTS Part (
  part_id INT NOT NULL,
  part_name VARCHAR(45) NOT NULL,
  vid INT NOT NULL,
  PRIMARY KEY (part_id),
  CONSTRAINT fk_Part_Vendor
    FOREIGN KEY (vid)
    REFERENCES CampChamp_Vendor.Vendor (vid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table ProductPart
-- -----------------------------------------------------
DROP TABLE IF EXISTS ProductPart ;

CREATE TABLE IF NOT EXISTS ProductPart (
  prod_id INT NOT NULL,
  part_id INT NOT NULL,
  req_num INT NOT NULL,
  PRIMARY KEY (prod_id, part_id),
  CONSTRAINT fk_ProductPart_Part1
    FOREIGN KEY (part_id)
    REFERENCES Part (part_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_ProductPart_Product1
    FOREIGN KEY (prod_id)
    REFERENCES Product (prod_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table PartInventory
-- -----------------------------------------------------
DROP TABLE IF EXISTS PartInventory ;

CREATE TABLE IF NOT EXISTS PartInventory (
  part_id INT NOT NULL,
  part_quant INT NOT NULL,
  part_stock INT NOT NULL,
  part_alt_date DATE NOT NULL,
  PRIMARY KEY (part_id),
  CONSTRAINT fk_PartInventory_Part1
    FOREIGN KEY (part_id)
    REFERENCES Part (part_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

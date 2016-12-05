
-- -----------------------------------------------------
-- Schema CampChamp_Order
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS CampChamp_Order ;

-- -----------------------------------------------------
-- Schema CampChamp_Order
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS CampChamp_Order DEFAULT CHARACTER SET utf8 ;
USE CampChamp_Order ;

-- -----------------------------------------------------
-- Table Order
-- -----------------------------------------------------
DROP TABLE IF EXISTS CustomerOrder ;

CREATE TABLE IF NOT EXISTS CustomerOrder (
  order_id INT NOT NULL,
  order_date DATE NOT NULL,
  sales_tax FLOAT NOT NULL,
  shipping_cost FLOAT NOT NULL,
  PRIMARY KEY (order_id))
;

-- -----------------------------------------------------
-- Table OrderItem
-- -----------------------------------------------------
DROP TABLE IF EXISTS OrderItem ;

CREATE TABLE IF NOT EXISTS OrderItem (
  order_id INT NOT NULL,
  prod_id INT NOT NULL,
  quant INT NOT NULL,
  PRIMARY KEY (order_id, prod_id),
  CONSTRAINT fk_OrderItem_Order1
    FOREIGN KEY (order_id)
    REFERENCES CustomerOrder (order_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_OrderItem_Product
    FOREIGN KEY (prod_id)
    REFERENCES CampChamp_Product.Product (prod_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table OrderPayment
-- -----------------------------------------------------
DROP TABLE IF EXISTS OrderPayment ;

CREATE TABLE IF NOT EXISTS OrderPayment (
  order_id INT NOT NULL,
  uid INT NOT NULL,
  method_id INT NOT NULL,
  pay_id CHAR(16) NOT NULL,
  PRIMARY KEY (order_id),
  CONSTRAINT fk_OrderPayment_Order1
    FOREIGN KEY (order_id)
    REFERENCES CustomerOrder (order_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_OrderPayment_CustomerPayment
    FOREIGN KEY (uid , method_id)
    REFERENCES CampChamp_Customer.CustomerPayment (uid , method_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table StatusCode
-- -----------------------------------------------------
DROP TABLE IF EXISTS StatusCode ;

CREATE TABLE IF NOT EXISTS StatusCode (
  stat_id INT NOT NULL,
  stat_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (stat_id))
;

-- -----------------------------------------------------
-- Table OrderStatus
-- -----------------------------------------------------
DROP TABLE IF EXISTS OrderStatus ;

CREATE TABLE IF NOT EXISTS OrderStatus (
  order_id INT NOT NULL,
  stat_id INT NOT NULL,
  start_date DATE NOT NULL,
  uid INT NOT NULL,
  PRIMARY KEY (order_id, stat_id, start_date),
  CONSTRAINT fk_OrderStatus_Status1
    FOREIGN KEY (stat_id)
    REFERENCES StatusCode (stat_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_OrderStatus_Order1
    FOREIGN KEY (order_id)
    REFERENCES CustomerOrder (order_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_OrderStatus_Employee
    FOREIGN KEY (uid)
    REFERENCES CampChamp_Employee.Employee (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table OrderStatusHistory
-- -----------------------------------------------------
DROP TABLE IF EXISTS OrderStatusHistory ;

CREATE TABLE IF NOT EXISTS OrderStatusHistory (
  order_id INT NOT NULL,
  stat_id INT NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  PRIMARY KEY (order_id, stat_id, start_date),
  CONSTRAINT fk_OrderStatusHistory_OrderStatus1
    FOREIGN KEY (order_id , stat_id , start_date)
    REFERENCES OrderStatus (order_id , stat_id , start_date)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


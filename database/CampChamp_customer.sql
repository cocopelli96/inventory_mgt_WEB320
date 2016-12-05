
-- -----------------------------------------------------
-- Schema CampChamp_Customer
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS CampChamp_Customer ;

-- -----------------------------------------------------
-- Schema CampChamp_Customer
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS CampChamp_Customer DEFAULT CHARACTER SET utf8 ;
USE CampChamp_Customer ;

-- -----------------------------------------------------
-- Table Title
-- -----------------------------------------------------
DROP TABLE IF EXISTS Title ;

CREATE TABLE IF NOT EXISTS Title (
  title_id INT NOT NULL,
  title_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (title_id))
;

-- -----------------------------------------------------
-- Table Customer
-- -----------------------------------------------------
DROP TABLE IF EXISTS Customer ;

CREATE TABLE IF NOT EXISTS Customer (
  uid INT NOT NULL,
  title_id INT NOT NULL,
  PRIMARY KEY (uid),
  CONSTRAINT fk_Customer_User
    FOREIGN KEY (uid)
    REFERENCES CampChamp_User.User (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Customer_Title1
    FOREIGN KEY (title_id)
    REFERENCES Title (title_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table PaymentMethod
-- -----------------------------------------------------
DROP TABLE IF EXISTS PaymentMethod ;

CREATE TABLE IF NOT EXISTS PaymentMethod (
  method_id INT NOT NULL,
  method_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (method_id))
;

-- -----------------------------------------------------
-- Table CustomerPayment
-- -----------------------------------------------------
DROP TABLE IF EXISTS CustomerPayment ;

CREATE TABLE IF NOT EXISTS CustomerPayment (
  uid INT NOT NULL,
  method_id INT NOT NULL,
  PRIMARY KEY (uid , method_id),
  CONSTRAINT fk_CustomerPayment_Customer1
    FOREIGN KEY (uid )
    REFERENCES Customer (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_CustomerPayment_PaymentMethod1
    FOREIGN KEY (method_id)
    REFERENCES PaymentMethod (method_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table CreditDebit
-- -----------------------------------------------------
DROP TABLE IF EXISTS CreditDebit ;

CREATE TABLE IF NOT EXISTS CreditDebit (
  uid INT NOT NULL,
  method_id INT NOT NULL,
  card_id CHAR(16) NOT NULL,
  card_type VARCHAR(45) NOT NULL,
  card_owner VARCHAR(45) NOT NULL,
  ccv2 INT(4) NOT NULL,
  zip VARCHAR(5) NOT NULL,
  exp_month INT(2) NOT NULL,
  exp_year INT(4) NOT NULL,
  PRIMARY KEY (uid, method_id, card_id),
  CONSTRAINT fk_CreditDebit_CustomerPayment1
    FOREIGN KEY (uid , method_id)
    REFERENCES CustomerPayment (uid , method_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table Bank
-- -----------------------------------------------------
DROP TABLE IF EXISTS Bank ;

CREATE TABLE IF NOT EXISTS Bank (
  routing_id CHAR(11) NOT NULL,
  bank_name VARCHAR(45) NOT NULL,
  PRIMARY KEY (routing_id))
;

-- -----------------------------------------------------
-- Table Checking
-- -----------------------------------------------------
DROP TABLE IF EXISTS Checking ;

CREATE TABLE IF NOT EXISTS Checking (
  uid INT NOT NULL,
  method_id INT NOT NULL,
  account_id CHAR(16) NOT NULL,
  routing_id CHAR(11) NOT NULL,
  PRIMARY KEY (uid, method_id, account_id),
  CONSTRAINT fk_Checking_Bank1
    FOREIGN KEY (routing_id)
    REFERENCES Bank (routing_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Checking_CustomerPayment1
    FOREIGN KEY (uid , method_id)
    REFERENCES CustomerPayment (uid , method_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


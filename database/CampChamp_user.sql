
-- -----------------------------------------------------
-- Schema CampChamp_User
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS CampChamp_User ;

-- -----------------------------------------------------
-- Schema CampChamp_User
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS CampChamp_User DEFAULT CHARACTER SET utf8 ;
USE CampChamp_User ;

-- -----------------------------------------------------
-- Table User
-- -----------------------------------------------------
DROP TABLE IF EXISTS User ;

CREATE TABLE IF NOT EXISTS User (
  uid INT NOT NULL,
  ufn VARCHAR(45) NOT NULL,
  uln VARCHAR(45) NOT NULL,
  PRIMARY KEY (uid))
;

-- -----------------------------------------------------
-- Table Permissions
-- -----------------------------------------------------
DROP TABLE IF EXISTS Permissions ;

CREATE TABLE IF NOT EXISTS Permissions (
  perm_id INT NOT NULL,
  perm_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (perm_id))
;

-- -----------------------------------------------------
-- Table UserAccount
-- -----------------------------------------------------
DROP TABLE IF EXISTS UserAccount ;

CREATE TABLE IF NOT EXISTS UserAccount (
  uid INT NOT NULL,
  uname VARCHAR(45) NOT NULL,
  upass VARCHAR(20) NOT NULL,
  perm_id INT NOT NULL,
  PRIMARY KEY (uid),
  CONSTRAINT fk_UserAccount_User
    FOREIGN KEY (uid)
    REFERENCES User (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_UserAccount_Permissions1
    FOREIGN KEY (perm_id)
    REFERENCES Permissions (perm_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table AddressType
-- -----------------------------------------------------
DROP TABLE IF EXISTS AddressType ;

CREATE TABLE IF NOT EXISTS AddressType (
  add_type_id INT NOT NULL,
  type_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (add_type_id))
;

-- -----------------------------------------------------
-- Table Address
-- -----------------------------------------------------
DROP TABLE IF EXISTS Address ;

CREATE TABLE IF NOT EXISTS Address (
  aid INT NOT NULL,
  street VARCHAR(45) NOT NULL,
  city VARCHAR(45) NOT NULL,
  zip VARCHAR(5) NOT NULL,
  state VARCHAR(2) NOT NULL,
  PRIMARY KEY (aid))
;

-- -----------------------------------------------------
-- Table Contact
-- -----------------------------------------------------
DROP TABLE IF EXISTS Contact ;

CREATE TABLE IF NOT EXISTS Contact (
  cont_id INT NOT NULL,
  cont_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (cont_id))
;

-- -----------------------------------------------------
-- Table UserContact
-- -----------------------------------------------------
DROP TABLE IF EXISTS UserContact ;

CREATE TABLE IF NOT EXISTS UserContact (
  uid INT NOT NULL,
  cont_id INT NOT NULL,
  PRIMARY KEY (uid, cont_id),
  CONSTRAINT fk_UserContact_User1
    FOREIGN KEY (uid)
    REFERENCES User (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_UserContact_Contact1
    FOREIGN KEY (cont_id)
    REFERENCES Contact (cont_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table UserAddress
-- -----------------------------------------------------
DROP TABLE IF EXISTS UserAddress ;

CREATE TABLE IF NOT EXISTS UserAddress (
  uid INT NOT NULL,
  add_type_id INT NOT NULL,
  aid INT NOT NULL,
  PRIMARY KEY (uid, add_type_id, aid),
  CONSTRAINT fk_UserAddress_User1
    FOREIGN KEY (uid)
    REFERENCES User (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_UserAddress_AddressType1
    FOREIGN KEY (add_type_id)
    REFERENCES AddressType (add_type_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_UserAddress_Address1
    FOREIGN KEY (aid)
    REFERENCES Address (aid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table Phone
-- -----------------------------------------------------
DROP TABLE IF EXISTS Phone ;

CREATE TABLE IF NOT EXISTS Phone (
  uid INT NOT NULL,
  cont_id INT NOT NULL,
  area_code VARCHAR(3) NOT NULL,
  mid_num VARCHAR(3) NOT NULL,
  end_num VARCHAR(4) NOT NULL,
  PRIMARY KEY (uid, cont_id),
  CONSTRAINT fk_Phone_UserContact1
    FOREIGN KEY (uid , cont_id)
    REFERENCES UserContact (uid , cont_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table Email
-- -----------------------------------------------------
DROP TABLE IF EXISTS Email ;

CREATE TABLE IF NOT EXISTS Email (
  uid INT NOT NULL,
  cont_id INT NOT NULL,
  email VARCHAR(45) NOT NULL,
  PRIMARY KEY (uid, cont_id),
  CONSTRAINT fk_Email_UserContact1
    FOREIGN KEY (uid , cont_id)
    REFERENCES UserContact (uid , cont_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;



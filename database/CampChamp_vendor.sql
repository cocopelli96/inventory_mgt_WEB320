
-- -----------------------------------------------------
-- Schema CampChamp_Vendor
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS CampChamp_Vendor ;

-- -----------------------------------------------------
-- Schema CampChamp_Vendor
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS CampChamp_Vendor DEFAULT CHARACTER SET utf8 ;
USE CampChamp_Vendor ;

-- -----------------------------------------------------
-- Table Vendor
-- -----------------------------------------------------
DROP TABLE IF EXISTS Vendor ;

CREATE TABLE IF NOT EXISTS Vendor (
  vid INT NOT NULL,
  vname VARCHAR(45) NOT NULL,
  PRIMARY KEY (vid))
;

-- -----------------------------------------------------
-- Table Rep
-- -----------------------------------------------------
DROP TABLE IF EXISTS Rep ;

CREATE TABLE IF NOT EXISTS Rep (
  rep_id INT NOT NULL,
  rep_fn VARCHAR(45) NOT NULL,
  rep_ln VARCHAR(45) NOT NULL,
  PRIMARY KEY (rep_id))
;

-- -----------------------------------------------------
-- Table VendorRep
-- -----------------------------------------------------
DROP TABLE IF EXISTS VendorRep ;

CREATE TABLE IF NOT EXISTS VendorRep (
  vid INT NOT NULL,
  rep_id INT NOT NULL,
  PRIMARY KEY (vid, rep_id),
  CONSTRAINT fk_VendorRep_Rep1
    FOREIGN KEY (rep_id)
    REFERENCES Rep (rep_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_VendorRep_Vendor1
    FOREIGN KEY (vid)
    REFERENCES Vendor (vid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table RepContact
-- -----------------------------------------------------
DROP TABLE IF EXISTS RepContact ;

CREATE TABLE IF NOT EXISTS RepContact (
  rep_cid INT NOT NULL,
  rep_con_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (rep_cid))
;

-- -----------------------------------------------------
-- Table VendorContact
-- -----------------------------------------------------
DROP TABLE IF EXISTS VendorContact ;

CREATE TABLE IF NOT EXISTS VendorContact (
  rep_id INT NOT NULL,
  rep_cid INT NOT NULL,
  rep_contact VARCHAR(45) NOT NULL,
  PRIMARY KEY (rep_id, rep_cid),
  CONSTRAINT fk_VendorContact_Rep1
    FOREIGN KEY (rep_id)
    REFERENCES Rep (rep_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_VendorContact_RepContact1
    FOREIGN KEY (rep_cid)
    REFERENCES RepContact (rep_cid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

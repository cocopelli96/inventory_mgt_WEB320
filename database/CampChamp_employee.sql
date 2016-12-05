
-- -----------------------------------------------------
-- Schema CampChamp_Employee
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS CampChamp_Employee ;

-- -----------------------------------------------------
-- Schema CampChamp_Employee
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS CampChamp_Employee DEFAULT CHARACTER SET utf8 ;
USE CampChamp_Employee ;

-- -----------------------------------------------------
-- Table Employee
-- -----------------------------------------------------
DROP TABLE IF EXISTS Employee ;

CREATE TABLE IF NOT EXISTS Employee (
  uid INT NOT NULL,
  init_sdate DATE NOT NULL,
  PRIMARY KEY (uid),
  CONSTRAINT fk_Employee_User
    FOREIGN KEY (uid)
    REFERENCES CampChamp_User.User (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table Department
-- -----------------------------------------------------
DROP TABLE IF EXISTS Department ;

CREATE TABLE IF NOT EXISTS Department (
  did INT NOT NULL,
  dept_name VARCHAR(45) NOT NULL,
  PRIMARY KEY (did))
;

-- -----------------------------------------------------
-- Table Position
-- -----------------------------------------------------
DROP TABLE IF EXISTS Position ;

CREATE TABLE IF NOT EXISTS Position (
  pos_id INT NOT NULL,
  pos_title VARCHAR(45) NOT NULL,
  low_sal INT NOT NULL,
  high_sal INT NOT NULL,
  did INT NOT NULL,
  PRIMARY KEY (pos_id),
  CONSTRAINT fk_Position_Department1
    FOREIGN KEY (did)
    REFERENCES Department (did)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table EmployeeJob
-- -----------------------------------------------------
DROP TABLE IF EXISTS EmployeeJob ;

CREATE TABLE IF NOT EXISTS EmployeeJob (
  uid INT NOT NULL,
  pos_id INT NOT NULL,
  pos_sdate DATE NOT NULL,
  salary VARCHAR(45) NOT NULL,
  PRIMARY KEY (uid , pos_id, pos_sdate),
  CONSTRAINT fk_EmployeeJob_Employee1
    FOREIGN KEY (uid )
    REFERENCES Employee (uid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_EmployeeJob_Position1
    FOREIGN KEY (pos_id)
    REFERENCES Position (pos_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table PromotionType
-- -----------------------------------------------------
DROP TABLE IF EXISTS PromotionType ;

CREATE TABLE IF NOT EXISTS PromotionType (
  prom_id INT NOT NULL,
  prom_descript VARCHAR(45) NOT NULL,
  PRIMARY KEY (prom_id))
;

-- -----------------------------------------------------
-- Table EmployeeJobHistory
-- -----------------------------------------------------
DROP TABLE IF EXISTS EmployeeJobHistory ;

CREATE TABLE IF NOT EXISTS EmployeeJobHistory (
  uid INT NOT NULL,
  pos_id INT NOT NULL,
  pos_sdate DATE NOT NULL,
  pos_edate DATE NOT NULL,
  prom_id INT NOT NULL,
  PRIMARY KEY (uid, pos_id, pos_sdate),
  CONSTRAINT fk_EmployeeJobHistory_EmployeeJob1
    FOREIGN KEY (uid , pos_id , pos_sdate)
    REFERENCES EmployeeJob (uid , pos_id , pos_sdate)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_EmployeeJobHistory_PromotionType1
    FOREIGN KEY (prom_id)
    REFERENCES PromotionType (prom_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


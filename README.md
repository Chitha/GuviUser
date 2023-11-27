# GuviUser

Step1 : Run the below script in MySql DB

CREATE SCHEMA IF NOT EXISTS `guviuser` DEFAULT CHARACTER SET utf8mb4 

CREATE TABLE IF NOT EXISTS `guviuser`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `age` INT(11) NULL DEFAULT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `contact` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8mb4

Step2: Update in DB details and username/Passord  in Config.php

 

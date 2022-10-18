CREATE TABLE `systems`.`client_info` (
  `client_ID` INT(11) AUTO_INCREMENT=100000,
  `clientname` VARCHAR(40) NULL,
  `clientsurname` VARCHAR(50) NULL,
  `idNumber` VARCHAR(25) NULL,
  `gender` CHAR(1) NULL,
  `email` VARCHAR(40) NULL,
  `phoneCode` INT(11) NULL,
  `phone` BIGINT(20) NULL,
  `Travelling_with_infant` CHAR(1) NULL,
  PRIMARY KEY (`client_ID`));

CREATE TABLE `systems`.`reservation` (
  `reservation_id` INT(11) NOT NULL AUTO_INCREMENT=100000,
  `Travelling_From` CHAR(1) NULL,
  `Travelling_To` CHAR(1) NULL,
  `Time_Of_Travel` CHAR(1) NULL,
  `Departure_Date` DATE NULL,
  PRIMARY KEY (`reservation_id`));


CREATE TABLE `systems`.`payment` (
  `Payment_id` INT(11) NOT NULL AUTO_INCREMENT=100000,
  `Bank_Name` CHAR(20) NULL,
  `Account_Number` CHAR(15) NULL,
  `Card_Number` CHAR(20) NULL,
  `Security_Code` int(3) NULL,
  PRIMARY KEY (`payment_id`));

ALTER TABLE `systems`.`reservation` 
ADD CONSTRAINT `client_id`
  FOREIGN KEY (`reservation_id`)
  REFERENCES `system`.`client_info` (`client_ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `systems`.`payment` 
ADD CONSTRAINT `reservation_id`
  FOREIGN KEY (`payment_id`)
  REFERENCES `system`.`reservation` (`reservation_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

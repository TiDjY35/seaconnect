CREATE TABLE `radio`.`watertemperature` (

`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique ID',
`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Event Date and Time',
`idkeyarduino` VARCHAR( 10 ) NOT NULL COMMENT 'Key ID of Arduino',
`temperature` VARCHAR( 10 ) NOT NULL COMMENT 'Measured Temperature Air in Celsius',
INDEX ( `date` , `temperature` )
) ENGINE = InnoDB;

CREATE TABLE `radio`.`arduino` (

`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique ID',
`create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Event Date and Time',
`idkeyarduino` VARCHAR( 10 ) NOT NULL COMMENT 'Key ID of Arduino',
`name` VARCHAR( 10 ) NOT NULL COMMENT 'Name of Arduino',
INDEX ( `date` , `name` )
) ENGINE = InnoDB;

CREATE TABLE `radio`.`waterlevel` (

`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique ID',
`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Event Date and Time',
`idkeyarduino` VARCHAR( 10 ) NOT NULL COMMENT 'Key ID of Arduino',
`level` VARCHAR( 10 ) NOT NULL COMMENT 'Measured Water Level',
INDEX ( `date` , `level` )
) ENGINE = InnoDB;

CREATE TABLE `radio`.`alertsvalues` (

`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique ID',
`idkeyarduino` VARCHAR( 10 ) NOT NULL COMMENT 'Key ID of Arduino',
`tempmin` VARCHAR( 10 ) NOT NULL COMMENT 'Temperature Min',
`tempmax` VARCHAR( 10 ) NOT NULL COMMENT 'Temperature Max',
INDEX ( `tempmin` , `tempmax` )
) ENGINE = InnoDB;
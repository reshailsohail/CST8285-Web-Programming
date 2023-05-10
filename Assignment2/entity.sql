-- Create the database
CREATE DATABASE IF NOT EXISTS demo;

-- Grant user access to the database
CREATE USER 'root'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON demo.* TO 'root'@'localhost';
FLUSH PRIVILEGES;

-- Switch to the demo database
USE demo;

-- Table structure for `entity`
CREATE TABLE IF NOT EXISTS `entity` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `number` INT NOT NULL,
  `text` TEXT NOT NULL,
  `date` DATE NOT NULL,
  `image` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

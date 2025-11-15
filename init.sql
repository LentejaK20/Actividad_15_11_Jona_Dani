
CREATE DATABASE IF NOT EXISTS `trabajo15-11`;
USE `trabajo15-11`; 

CREATE TABLE IF NOT EXISTS nombres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);
INSERT INTO nombres (nombre) VALUES
('Dani Marchant'),
('Jona Rojas');
-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2021 at 12:43 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

DROP TABLE IF EXISTS list;
CREATE TABLE IF NOT EXISTS list (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

DROP TABLE IF EXISTS to_do;
CREATE TABLE IF NOT EXISTS to_do (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL,
  note varchar(250)  COLLATE utf8mb4_turkish_ci,
  done boolean NOT NULL,
  listid int(11) NOT NULL,
  PRIMARY KEY (id)/*,
  CONSTRAINT FOREIGN KEY (listid) REFERENCES list(id)*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;


INSERT INTO to_do (id, title, note, done, listid) VALUES
(1, 'CTIS 256 Project', 'due 10th october', FALSE, 1),
(2, 'Bananas', '1kg', FALSE, 2),
(3, 'Apples', '1kg green', TRUE, 2);
COMMIT;

INSERT INTO list (id, title) VALUES
(1, 'Assignments'),
(2, 'Shopping List');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

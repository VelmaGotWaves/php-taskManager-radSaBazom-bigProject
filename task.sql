-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2022 at 10:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazapodataka`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TaskID` int(50) NOT NULL,
  `Id` int(50) NOT NULL,
  `Naslov` varchar(255) NOT NULL,
  `Telo` varchar(255) NOT NULL,
  `Datum` date NOT NULL,
  `Completed` tinyint(1) NOT NULL,
  `KorisnikCompleted` tinyint(1) NOT NULL,
  `Kategorija` varchar(255) NOT NULL,
  `Komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TaskID`, `Id`, `Naslov`, `Telo`, `Datum`, `Completed`, `KorisnikCompleted`, `Kategorija`, `Komentar`) VALUES
(7, 1, 'aaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2022-07-13', 1, 1, 'aaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaa'),
(8, 27, 'ZADATAK NOVI 1', 'ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1ZADATAK NOVI 1', '2022-07-12', 0, 0, 'Marketing', ''),
(9, 25, 'PrviFormaTask', 'PrviFormaTaskPrviFormaTaskPrviFormaTaskPrviFormaTaskPrviFormaTask', '2022-07-14', 0, 0, 'Marketing', ''),
(10, 25, 'DRUGIFormaTask', 'DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask DRUGIFormaTask ', '2022-07-07', 1, 1, 'Management', ''),
(11, 25, 'TRECII TRECIITRECII', 'TRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECIITRECII', '2022-07-14', 0, 1, 'Development', ''),
(12, 25, 'Cetvri TAsk sa fORMwe', 'Cetvri TAsk sa fORMweCetvri TAsk sa fORMweCetvri TAsk sa fORMweCetvri TAsk sa fORMweCetvri TAsk sa fORMweCetvri TAsk sa fORMweCetvri TAsk sa fORMweCetvri TAsk sa fORMweCetvri TAsk sa fORMwe', '2021-09-08', 0, 0, 'Design', 'adasdadas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TaskID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TaskID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

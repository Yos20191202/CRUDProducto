-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 01:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda01`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `tipo`, `descripcion`) VALUES
(1, 'Tipo A', 'Imagen tipo A\r\n'),
(1, 'Tipo A', 'Imagen tipo A\r\n'),
(0, 'Tipo', 'Imagen tipo 2'),
(0, 'Imagen 2', 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `tipo`, `descripcion`) VALUES
(1, 'Categoría A', 'categoria_A.jpg'),
(2, 'Categoría B', 'categoria_B.jpg'),
(3, 'Categoría C', 'categoria_C.jpg'),
(4, 'Imagen tipo A', 'Tipo_A.png'),
(5, 'Imagen tipo B', 'Tipo_B.png'),
(6, 'Categoria Tipo C', 'Tipo_C.png'),
(7, 'Tipo D', 'dsfdf'),
(8, 'Tipo pueba', 'tipo prueba');

-- --------------------------------------------------------

--
-- Table structure for table `imagen`
--

CREATE TABLE `imagen` (
  `id_img` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imagen`
--

INSERT INTO `imagen` (`id_img`, `img`, `descripcion`) VALUES
(1, 'imagen1.jpg', 'Descripción de la imagen 1'),
(2, 'imagen2.jpg', 'Descripción de la imagen 2'),
(3, 'imagen3.jpg', 'Descripción de la imagen 3');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `estilo` varchar(50) DEFAULT NULL,
  `f_img` int(11) DEFAULT NULL,
  `f_cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `talla`, `estilo`, `f_img`, `f_cat`) VALUES
(33, 'sdsd', 'sdfdf', 'M', 'dsfd', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbimagen`
--

CREATE TABLE `tbimagen` (
  `id` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbimagen`
--

INSERT INTO `tbimagen` (`id`, `imagen`, `descripcion`) VALUES
(1, 'uni_hombre.png', 'imagen2'),
(2, 'uni_mujer.png', 'imagen3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_img`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_img` (`f_img`),
  ADD KEY `f_cat` (`f_cat`);

--
-- Indexes for table `tbimagen`
--
ALTER TABLE `tbimagen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbimagen`
--
ALTER TABLE `tbimagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`f_cat`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`f_img`) REFERENCES `tbimagen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

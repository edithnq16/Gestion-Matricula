-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 04:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colegio`
--

-- --------------------------------------------------------

--
-- Table structure for table `boletapago`
--

CREATE TABLE `boletapago` (
  `ID` int(11) NOT NULL,
  `NumeroBoleta` varchar(250) NOT NULL,
  `MontoBoleta` decimal(18,2) NOT NULL,
  `Estado` varchar(2) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `UsuarioCreacion` varchar(50) NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `UsuarioModificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `ID` int(11) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Estado` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `UsuarioCreacion` varchar(50) NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `UsuarioModificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`ID`, `Descripcion`, `Estado`, `FechaCreacion`, `UsuarioCreacion`, `FechaModificacion`, `UsuarioModificacion`) VALUES
(1, 'INGLES', 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL),
(2, 'MATEMATICA', 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL),
(3, 'COMUNICACION', 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL),
(4, 'COMPUTACION', 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grado`
--

CREATE TABLE `grado` (
  `ID` int(11) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `MontoID` int(11) DEFAULT NULL,
  `Estado` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `UsuarioCreacion` varchar(50) NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `UsuarioModificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grado`
--

INSERT INTO `grado` (`ID`, `Descripcion`, `MontoID`, `Estado`, `FechaCreacion`, `UsuarioCreacion`, `FechaModificacion`, `UsuarioModificacion`) VALUES
(1, 'PRIMER GRADO', 1, 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL),
(2, 'SEGUNDO GRADO', 2, 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL),
(3, 'TERCER GRADO', 3, 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL),
(4, 'CUARTO GRADO', 4, 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL),
(5, 'QUINTO GRADO', 5, 1, '2024-01-16 03:37:46', 'BD_INSERT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matricula`
--

CREATE TABLE `matricula` (
  `ID` int(11) NOT NULL,
  `PersonaID` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `ApoderadoMatricula` varchar(150) NOT NULL,
  `GradoID` int(11) NOT NULL,
  `BoletaID` int(11) NOT NULL,
  `CursosID` varchar(50) DEFAULT NULL,
  `Fechacreacion` datetime NOT NULL,
  `Usuariocreacion` varchar(50) NOT NULL,
  `Fechamodificacion` datetime DEFAULT NULL,
  `Usuariomodificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monto`
--

CREATE TABLE `monto` (
  `ID` int(11) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Monto` decimal(18,2) NOT NULL,
  `Estado` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `UsuarioCreacion` varchar(50) NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `UsuarioModificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monto`
--

INSERT INTO `monto` (`ID`, `Descripcion`, `Monto`, `Estado`, `FechaCreacion`, `UsuarioCreacion`, `FechaModificacion`, `UsuarioModificacion`) VALUES
(1, 'PRIMER GRADO SECUNDARIA - CURSO', 10.00, 1, '2024-01-16 03:54:51', 'BD_INSERT', NULL, NULL),
(2, 'SEGUNDO GRADO - CURSO', 20.00, 1, '2024-01-16 03:59:12', 'BD_INSERT', NULL, NULL),
(3, 'TERCER GRADO - CURSO', 30.00, 1, '2024-01-16 03:59:12', 'BD_INSERT', NULL, NULL),
(4, 'CUARTO GRADO - CURSO', 40.00, 1, '2024-01-16 03:59:12', 'BD_INSERT', NULL, NULL),
(5, 'QUINTO GRADO - CURSO', 50.00, 1, '2024-01-16 03:59:12', 'BD_INSERT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `ID` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(150) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Domicilio` varchar(150) DEFAULT NULL,
  `Genero` varchar(10) DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `RolID` int(11) DEFAULT NULL,
  `FechaCreacion` datetime DEFAULT NULL,
  `UsuarioCreacion` varchar(50) NOT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `UsuarioModificacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`ID`, `DNI`, `Nombre`, `Apellido`, `Edad`, `Domicilio`, `Genero`, `Telefono`, `Email`, `RolID`, `FechaCreacion`, `UsuarioCreacion`, `FechaModificacion`, `UsuarioModificacion`) VALUES
(1, 73739151, 'EDITH', 'NAVARRO QUISPE', 18, 'LOS OLIVOS, LIMA', 'FEMENINO', 999999999, 'edithnq@yopmail.com', 2, '2024-01-15 21:13:31', 'BD_INSERT', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `ID` int(11) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Fechacreacion` datetime NOT NULL,
  `Usuariocreacion` varchar(50) NOT NULL,
  `Fechamodificacion` datetime DEFAULT NULL,
  `Usuariomodificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`ID`, `Descripcion`, `Estado`, `Fechacreacion`, `Usuariocreacion`, `Fechamodificacion`, `Usuariomodificacion`) VALUES
(1, 'ALUMNO', 1, '2024-01-16 02:56:56', 'ADMIN', NULL, NULL),
(2, 'ADMINISTRADOR', 1, '2024-01-16 02:56:56', 'ADMIN', NULL, NULL),
(3, 'DOCENTE', 1, '2024-01-16 02:56:56', 'ADMIN', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `monto`
--
ALTER TABLE `monto`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grado`
--
ALTER TABLE `grado`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monto`
--
ALTER TABLE `monto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2020 a las 13:06:52
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `preinscripciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ID_ADMIN` varchar(15) NOT NULL,
  `NOMBRE_A` varchar(20) NOT NULL,
  `A_PATERNOA` varchar(20) NOT NULL,
  `A_MATERNOA` varchar(20) NOT NULL,
  `CONTRASENA_A` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`ID_ADMIN`, `NOMBRE_A`, `A_PATERNOA`, `A_MATERNOA`, `CONTRASENA_A`) VALUES
('2020150100', 'Aymeric', 'Laporte', 'Santillan', 'julio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `N_BOLETA` varchar(12) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `A_PATERNO` varchar(20) NOT NULL,
  `A_MATERNO` varchar(20) NOT NULL,
  `CORREO` varchar(40) DEFAULT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL,
  `CONTRASENA` varchar(50) DEFAULT NULL,
  `AUDITORIA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`N_BOLETA`, `NOMBRE`, `A_PATERNO`, `A_MATERNO`, `CORREO`, `TELEFONO`, `CONTRASENA`, `AUDITORIA`) VALUES
('-', '-', '-', '-', '-', '-', '-', NULL),
('2014630370', 'Noh', 'Hye', 'Ran', 'yellowyello@hotmail.com', '5546644664', 'hyeran1234', NULL),
('2014630371', 'Paolo', 'Maldini', 'Gatusso', 'maldini@gmail.com', '221334321', 'yosoymaldini', NULL),
('2014630372', 'Javier', 'Zanetti', 'Cuccitini', NULL, NULL, NULL, NULL),
('2016630370', 'Julio Zael', 'Santillán', 'Ruíz', 'inter_milan_a7x@hotmail.com', '5566030879', 'Anne23julio1', '2020-06-10 03:07:08'),
('2016630371', 'Kim', 'Seung', 'Yeon', 'anne@gmail.com', '5566030879', 'Anne23julio', '2020-06-11 03:12:45'),
('2016630382', 'Alondra', 'Gomez', 'Prado', 'soyalondra@gmail.com', '4545454545', 'yosoyalondra', NULL),
('2016630383', 'Joy', 'Gomez', 'Alfajor', 'soyjoy@gmail.com', '4545454545', 'yosoyjoy', NULL),
('2016630390', 'Andriy', 'Shevchenko', 'Mykolayovych', 'shevchenko@gmail.com', '55446677', 'yosoyshevchenko', NULL),
('2016640480', 'sergio', 'Elkun', 'aguero', 'sergio@outlook.com', '88997722', 'soyelkun', NULL),
('2018280280', 'Jose', 'Jimenez', 'Jerez', 'jerez@hotmail.com', '55667788', 'soyjose', NULL),
('2018630370', 'Andrés', 'Iniesta', 'Luján', 'ainiesta@gmail.com', '66778899', 'soyandresiniesta', '2020-06-15 04:14:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `ID_MATERIA` varchar(20) NOT NULL,
  `NOMBRE_MATERIA` varchar(50) NOT NULL,
  `INSCRITOS` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`ID_MATERIA`, `NOMBRE_MATERIA`, `INSCRITOS`) VALUES
('ADA3', 'Análisis de algoritmos', 0),
('ADOO2', 'Análisis y Diseño Orientado a Objetos', 0),
('AFC1', 'Análisis fundamental de circuitos', 0),
('AI3', 'Artificial Intelligence', 0),
('BDD2', 'Bases de datos', 0),
('CAL1', 'Cálculo', 0),
('COE1', 'Comunicación Oral y Escrita', 0),
('EC4', 'Evolutionary Computing', 0),
('ECDIF1', 'Ecuaciones Diferenciales', 0),
('ESD1', 'Estructuras de Datos', 0),
('FIS1', 'Física', 0),
('FL4', 'Fuzzy Logic', 0),
('IES1', 'Ingeniería Social y Ética', 0),
('IS3', 'Ingeniería de Software', 0),
('LID4', 'Liderazgo', 0),
('MAI2', 'Matemáticas Avanzadas para la Ingeniería', 0),
('MATD', 'Matemáticas Discretas', 0),
('NN4', 'Neural Networks', 0),
('POO2', 'Programación Orientada a Objetos', 0),
('RED2', 'Redes de computadoras', 0),
('SOP2', 'Sistemas Operativos', 0),
('TCS', 'Teoría de Comunicaciones y Señales', 0),
('TW2', 'Tecnologías para la Web ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_alumno`
--

CREATE TABLE `materias_alumno` (
  `N_BOLETA` varchar(12) NOT NULL,
  `ID_MATERIA` varchar(20) NOT NULL,
  `NOMBRE_MATERIA` varchar(50) NOT NULL,
  `ESTADO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias_alumno`
--

INSERT INTO `materias_alumno` (`N_BOLETA`, `ID_MATERIA`, `NOMBRE_MATERIA`, `ESTADO`) VALUES
('2016630370', 'AI3', 'Artificial Intelligence', 1),
('2016630370', 'BDD2', 'Bases de datos', 0),
('2016630370', 'TW2', 'Tecnologías para la Web ', 0),
('2016630370', 'IS3', 'Ingeniería de Software', 0),
('2016630370', 'ECDIF1', 'Ecuaciones Diferenciales', 0),
('2016630370', 'LID4', 'Liderazgo', 0),
('2016630370', 'ADA3', 'Análisis de algoritmos', 0),
('2016630371', 'AI3', 'Artificial Intelligence', 0),
('2016630371', 'COE1', 'Comunicación Oral y Escrita', 0),
('2016630371', 'EC4', 'Evolutionary Computing', 1),
('2016630390', 'AI3', 'Artificial Inteligence', 0),
('2016630390', 'MAI2', 'Matemáticas Avanzadas para la Ingeniería', 1),
('2016630390', 'IES1', 'Ingeniería Social y Ética', 1),
('2016630390', 'EC4', 'Evolutionary Computing', 0),
('2018630370', 'ADOO2', 'Análisis y Diseño Orientado a Objetos', 0),
('2018630370', 'BDD2', 'Bases de datos', 0),
('2018630370', 'CAL1', 'Cálculo', 0),
('2018630370', 'FIS1', 'Física', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`N_BOLETA`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`ID_MATERIA`);

--
-- Indices de la tabla `materias_alumno`
--
ALTER TABLE `materias_alumno`
  ADD KEY `LISTAMATERIAS1` (`N_BOLETA`),
  ADD KEY `LISTAMATERIAS2` (`ID_MATERIA`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materias_alumno`
--
ALTER TABLE `materias_alumno`
  ADD CONSTRAINT `LISTAMATERIAS1` FOREIGN KEY (`N_BOLETA`) REFERENCES `alumnos` (`N_BOLETA`),
  ADD CONSTRAINT `LISTAMATERIAS2` FOREIGN KEY (`ID_MATERIA`) REFERENCES `materia` (`ID_MATERIA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-04-2018 a las 19:39:37
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine`
--
CREATE DATABASE IF NOT EXISTS `cine` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cine`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechastitulos`
--

CREATE TABLE `fechastitulos` (
  `id_visionado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_titulo` int(11) NOT NULL,
  `medio` varchar(20) NOT NULL,
  `formato` varchar(30) NOT NULL,
  `audio` varchar(40) NOT NULL,
  `rewatch` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculasactores`
--

CREATE TABLE `peliculasactores` (
  `id_pelicula` int(11) NOT NULL,
  `id_actor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculasfotografos`
--

CREATE TABLE `peliculasfotografos` (
  `id_pelicula` int(11) NOT NULL,
  `id_foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculasguionistas`
--

CREATE TABLE `peliculasguionistas` (
  `id_pelicula` int(11) NOT NULL,
  `id_guionista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculasmusicos`
--

CREATE TABLE `peliculasmusicos` (
  `id_pelicula` int(11) NOT NULL,
  `id_musico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(4) NOT NULL DEFAULT '0',
  `nombre_persona` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulopelicula`
--

CREATE TABLE `titulopelicula` (
  `id_pelicula` int(11) NOT NULL,
  `año` int(11) NOT NULL,
  `titulo` varchar(1500) NOT NULL,
  `titulo_original` varchar(1500) NOT NULL,
  `duracion` int(11) NOT NULL,
  `pais` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulosdirectores`
--

CREATE TABLE `titulosdirectores` (
  `id_titulo` int(11) NOT NULL,
  `id_director` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fechastitulos`
--
ALTER TABLE `fechastitulos`
  ADD PRIMARY KEY (`id_visionado`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `titulopelicula`
--
ALTER TABLE `titulopelicula`
  ADD PRIMARY KEY (`id_pelicula`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

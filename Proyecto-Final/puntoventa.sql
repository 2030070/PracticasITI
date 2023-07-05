-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-07-2023 a las 05:36:50
-- Versión del servidor: 8.0.32-0ubuntu0.22.04.2
-- Versión de PHP: 8.1.2-1ubuntu2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `puntoventa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `descripcion` text COLLATE utf8mb3_general_mysql500_ci,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `empresa` varchar(200) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int NOT NULL,
  `referencia` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `fecha` date NOT NULL,
  `estatus` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `total` double NOT NULL,
  `pagado` double DEFAULT NULL,
  `adeudo` double DEFAULT NULL,
  `estatus_pago` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `id_proveedor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id_cotizacion` int NOT NULL,
  `referencia` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `estatus` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `total` double NOT NULL,
  `id_producto` int NOT NULL,
  `id_cliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle_venta` int NOT NULL,
  `cantidad` int NOT NULL,
  `descuento` double NOT NULL,
  `subtotal` double NOT NULL,
  `impuestos` double NOT NULL,
  `id_producto` int NOT NULL,
  `id_venta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id_devolucion` int NOT NULL,
  `fecha` date NOT NULL,
  `estatus` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `total` double NOT NULL,
  `pagado` double DEFAULT NULL,
  `adeudo` double DEFAULT NULL,
  `estatus_pago` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `id_producto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb3_general_mysql500_ci,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `precio_compra` double NOT NULL,
  `precio_venta` double NOT NULL,
  `unidades` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_categoria` int NOT NULL,
  `id_subcategoria` int DEFAULT NULL,
  `id_marca` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE `recibos` (
  `id_recibo` int NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `estatus` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `descripcion` text COLLATE utf8mb3_general_mysql500_ci,
  `id_categoria` int NOT NULL,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `fotografia` varchar(50) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `apellido` varchar(200) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_general_mysql500_ci DEFAULT NULL,
  `estatus` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int NOT NULL,
  `referencia` varchar(50) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `fecha` date NOT NULL,
  `estatus` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `pago` varchar(20) COLLATE utf8mb3_general_mysql500_ci NOT NULL,
  `total` double DEFAULT NULL,
  `pagado` double DEFAULT NULL,
  `adeudo` double DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `id_recibo` int NOT NULL,
  `id_cliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_mysql500_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `fk_categoria_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `fk_compra_proveedor_idx` (`id_proveedor`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id_cotizacion`),
  ADD KEY `fk_cotizacion_producto_idx` (`id_producto`),
  ADD KEY `kk_cotizacion_cliente_idx` (`id_cliente`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `fk_detalles_venta_idx` (`id_venta`),
  ADD KEY `fk_detalles_producto_idx` (`id_producto`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `fk_devoluciones_producto_idx` (`id_producto`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`),
  ADD KEY `fk_marca_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_usuario_idx` (`id_usuario`),
  ADD KEY `fk_producto_categoria_idx` (`id_categoria`),
  ADD KEY `fk_producto_subcategoria_idx` (`id_subcategoria`),
  ADD KEY `fk_producto_marca_idx` (`id_marca`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`id_recibo`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `fk_subcategoria_usuario_idx` (`id_usuario`),
  ADD KEY `fk_subcategoria_categoria_idx` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_venta_usuario_idx` (`id_usuario`),
  ADD KEY `fk_venta_recibo_idx` (`id_recibo`),
  ADD KEY `fk_venta_cliente_idx` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id_cotizacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_venta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id_devolucion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id_recibo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compra_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `fk_cotizacion_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `kk_cotizacion_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_detalles_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `fk_detalles_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `fk_devoluciones_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `fk_marca_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_producto_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `fk_producto_subcategoria` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`),
  ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcategoria_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_subcategoria_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_venta_recibo` FOREIGN KEY (`id_recibo`) REFERENCES `recibos` (`id_recibo`),
  ADD CONSTRAINT `fk_venta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

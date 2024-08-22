-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 09:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidrieria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `imagen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `imagen`) VALUES
(1, 'Ventanas y Puertas', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Ventanas%20y%20Puertas.jpg?alt=media&token=be2dbdca-06a4-4ced-b646-9f0884'),
(2, 'Espejos', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Espejos.webp?alt=media&token=6b4b067d-17e8-4f23-812d-7dd87b44b66e'),
(3, 'Cristales Decorativos', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Cristales%20Decorativos.jpg?alt=media&token=005125ad-504b-4f4a-a0a5-10f80'),
(4, 'Muebles', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Muebles.jpg?alt=media&token=34304e75-e298-4c32-8e17-1b6cda87debb'),
(5, 'Seguridad', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Seguridad.png?alt=media&token=a9e31415-d6ce-479a-bc67-3ac4f101ef4e'),
(6, 'Fachadas y Divisiones', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Fachadas.webp?alt=media&token=c93ac02d-7d87-47c9-aaad-5c94630a5ab2'),
(7, 'Accesorios de Montaje', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Accesorios.png?alt=media&token=37b25685-ae65-4f69-b353-35aecc180bcf'),
(8, 'Limpieza y Mantenimiento', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Limpieza.png?alt=media&token=57cf4c6f-fb84-47b7-8360-530e204da237'),
(9, 'Automóviles', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Automoviles.jpeg?alt=media&token=f0a4cb1f-b959-4967-8fe4-1722b539f219'),
(10, 'Decoración', 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Decoracion.jpg?alt=media&token=2c0aa8a2-bd2e-4dbf-aefd-be1a0af887d8');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `perfil` varchar(100) NOT NULL DEFAULT 'default.png',
  `token` varchar(100) DEFAULT NULL,
  `verify` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `correo`, `clave`, `perfil`, `token`, `verify`) VALUES
(1, 'Joseph', 'pruebasvarias1721@gmail.com', '$2y$10$oeINGRuUs.RzZorInM4sJOzwfkbxXa10a0Tw.kDr3vrzRBEcCx1QW', 'default.png', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `producto`, `precio`, `cantidad`, `id_pedido`) VALUES
(1, 'Vidrio Templado', 120.00, 1, 1),
(2, 'Espejos Decorativos', 200.00, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(80) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `email` varchar(80) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `email_user` varchar(80) NOT NULL,
  `proceso` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_transaccion`, `monto`, `estado`, `fecha`, `email`, `nombre`, `apellido`, `direccion`, `ciudad`, `email_user`, `proceso`) VALUES
(1, '03W03846P4220150R', 85.47, 'COMPLETED', '2024-08-22 08:47:04', 'sb-trs43v31982409@personal.example.com', 'Joseph', 'Diaz', 'Av. Fernando Belaunde Terry', 'Collique - Comas', 'pruebasvarias1721@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(150) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`, `id_categoria`) VALUES
(1, 'Vidrio Laminado', 'Compuesto por dos o más capas de vidrio unidas con una lámina de PVB, ofreciendo alta resistencia y seguridad. Utilizado en ventanas de seguridad y escaparates.', 130.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Laminado.jpg?alt=media&token=b856fe57-7258-44d2-9d49-16ddee5dddc', 1),
(2, 'Vidrio Templado', 'Vidrio tratado térmicamente para aumentar su resistencia y seguridad. Ideal para puertas de vidrio y áreas de alto tráfico.', 120.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Templado.jpg?alt=media&token=ef9884b1-e447-412b-b5d1-8a5c7d98c6f', 1),
(3, 'Vidrio Doble', 'Vidrio compuesto por dos o tres capas con una cámara de aire entre ellas, proporcionando mejor aislamiento térmico y acústico.', 100.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Doble.jpg?alt=media&token=d41ccc6b-233c-4a22-8a5f-75a9af6ed18b', 1),
(4, 'Vidrio Simple', 'Vidrio estándar, utilizado comúnmente en ventanas y puertas interiores. Disponible en diferentes grosores.', 30.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Simple.jpg?alt=media&token=8a3e336b-81c1-4c72-810c-e57c8b0af3d6', 1),
(5, 'Espejos de Baño', 'Espejos diseñados específicamente para baños, a menudo con tratamientos anti-vaho y marcos resistentes a la humedad.', 50.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Espejo%20de%20Ba%C3%B1o.png?alt=media&token=8a4fa801-5456-4fdd-84a7-5223f', 2),
(6, 'Espejos Decorativos', 'Espejos con diseños estéticos para decoración de interiores, disponibles en diversas formas y estilos.', 200.00, 7, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Espejo%20Decorativo.jpeg?alt=media&token=74e2f2ba-3821-4004-aa18-7bec8e0d', 2),
(7, 'Espejos Personalizados', 'Espejos hechos a medida según las especificaciones del cliente, con opciones de grabado y diferentes tipos de bordes.', 250.00, 60, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Espejo%20Personalizado.jpg?alt=media&token=d1d3a2bf-6eb1-4181-bf7b-2a0dfa', 2),
(8, 'Cristales Esmerilados', 'Vidrio con acabado esmerilado que proporciona privacidad sin sacrificar la luz natural. Ideal para baños y oficinas.', 80.00, 9, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Cristales%20Esmerilados.png?alt=media&token=dddb593a-b276-4808-b00f-a0324', 3),
(9, 'Vidrio Coloreado', 'Vidrio teñido en varios colores, utilizado en ventanas decorativas y muebles.', 70.00, 65, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Coloreado.jpg?alt=media&token=4c8ee28c-a271-466c-a5d3-6c2735b5cd', 3),
(10, 'Vidrio Grabado', 'Vidrio con diseños grabados mediante técnicas de arenado o grabado químico, utilizado en puertas y particiones decorativas.', 100.00, 1, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Grabado.jpg?alt=media&token=606d8204-83cb-4056-8a08-a8f29eaf43f8', 3),
(12, 'Tableros de Mesa', 'Superficies de vidrio para mesas, disponibles en varios tamaños y grosores. Ideal para mesas de comedor y de centro.', 150.00, 7, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Tablero%20de%20Mesa.png?alt=media&token=071e2e32-7707-4422-9687-d2e407817', 4),
(13, 'Estantes de Vidrio', 'Estantes de vidrio templado, ideales para vitrinas y estanterías decorativas.', 50.00, 7, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Estantes%20de%20Vidrio.jpg?alt=media&token=0069a651-0975-45ef-aa08-5a4c9a', 4),
(14, 'Puertas de Armario de Vidrio', 'Puertas de vidrio para armarios, disponibles en vidrio transparente, esmerilado o coloreado.', 180.00, 85, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Puertas%20de%20Armario.jpg?alt=media&token=90a76de9-c2ce-4ed7-b2cb-637c29', 4),
(15, 'Vidrio Blindado', 'Vidrio de alta resistencia compuesto por múltiples capas, utilizado en aplicaciones de seguridad como bancos y vehículos blindados.', 600.00, 0, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Blindado.png?alt=media&token=678b7040-3002-4aaf-a049-d92a34069a6', 5),
(16, 'Vidrio Anti-Rotura', 'Vidrio diseñado para resistir impactos y evitar roturas peligrosas. Utilizado en escaparates y ventanas de seguridad.', 200.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Anti%20Rotura.jpg?alt=media&token=a654c1f5-225e-4b19-aa67-2c90d7', 5),
(17, 'Muros Cortina', 'Estructuras de vidrio utilizadas en fachadas de edificios, proporcionando un aspecto moderno y permitiendo la entrada de luz natural.', 400.00, 4, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Muro%20Cortina.jpg?alt=media&token=c09c2357-4e89-4902-886c-db251b3912f5', 6),
(18, 'Mamparas de Oficina', 'Divisiones de vidrio para oficinas, disponibles en vidrio transparente, esmerilado o coloreado, proporcionando privacidad y diseño moderno.', 300.00, 8, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Mampara%20de%20Oficina.png?alt=media&token=93441c19-f289-4151-ac13-05656a', 6),
(19, 'Vidrio Arquitectónico', 'Vidrio utilizado en aplicaciones arquitectónicas, disponible en diferentes acabados y colores para adaptarse a cualquier diseño.', 250.00, 9, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Vidrio%20Arquitectonico.jpg?alt=media&token=ccc46bc2-5a06-4254-ba81-c5b1d', 6),
(20, 'Marcos y Perfiles de Aluminio', 'Marcos y perfiles de aluminio para la instalación de vidrios, disponibles en diferentes acabados y colores.', 50.00, 3, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Marcos%20y%20Perfiles.jpg?alt=media&token=ee118d13-0bd9-4b6d-afc2-536e54d', 7),
(21, 'Herrajes y Bisagras', 'Accesorios de montaje como bisagras, soportes y manillas para puertas y ventanas de vidrio.', 20.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Bisagras.png?alt=media&token=369436bd-f24a-4e7e-9acf-67c9810a9e99', 7),
(22, 'Selladores y Siliconas', 'Productos de sellado para asegurar la estanqueidad y durabilidad de las instalaciones de vidrio.', 10.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Selladores.jpg?alt=media&token=eefe835f-6eb4-47ed-b3b1-709125120e83', 7),
(23, 'Limpiadores de Vidrio', 'Productos especializados para la limpieza de superficies de vidrio, proporcionando un acabado sin rayas.', 8.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Limpiadores.jpg?alt=media&token=724974ad-3328-4f2a-ab2d-313e441a04d2', 8),
(25, 'Kit Limpieza', 'Kits de herramientas como escobillas, paños y rasquetas para la limpieza eficaz de vidrios.', 20.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Kit%20Limpieza.jpg?alt=media&token=a7d7d522-da1c-4c78-8bef-ccfa4eee099d', 8),
(26, 'Lámparas de Vidrio', 'Elegantes y modernas, nuestras lámparas de vidrio son perfectas para iluminar cualquier espacio con estilo. ', 120.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Lamparas%20de%20Vidrio.png?alt=media&token=33b49da8-b270-47a4-a8b7-797a23', 10),
(27, 'Objetos Decorativos de Vidrio', 'Una colección de objetos decorativos de vidrio que incluye vasos, jarrones, centros de mesa y más. Cada pieza está cuidadosamente diseñada para añadir un toque de elegancia y distinción a tu hogar u oficina.', 75.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Objetos%20Decorativos.jpg?alt=media&token=3a223def-5e9f-4c43-8954-b35b7af', 10),
(28, 'Ventanas Laterales', 'Vidrios instalados en las puertas del vehículo, disponibles en versiones manuales y eléctricas.', 130.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Ventanas%20Laterales.png?alt=media&token=079b4a58-7b9f-4138-8acb-59908e9e', 9),
(29, 'Ventanas Traseras', 'Vidrio ubicado en la parte trasera del vehículo, a menudo con calefacción para evitar la condensación.', 225.00, 5, 'https://firebasestorage.googleapis.com/v0/b/delivery-app-55fc4.appspot.com/o/Ventanas%20Traseras.png?alt=media&token=564a8d69-0dd5-4c27-961e-83dc78e26', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

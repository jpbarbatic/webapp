-- Adminer 4.8.1 MySQL 11.6.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1,	'Tecnología'),
(2,	'Ropa y Modas'),
(3,	'Hogar y Decoración'),
(4,	'Deportes'),
(5,	'Alimentación');

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) NOT NULL,
  `descripcion` char(100) NOT NULL,
  `depende_de` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `permisos` (`id`, `nombre`, `descripcion`, `depende_de`) VALUES
(1,	'usuarios.consulta',	'',	0),
(2,	'usuarios.crear',	'',	0),
(3,	'usuarios.borrar',	'',	1),
(4,	'usuarios.actualizar',	'',	1);

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `num_fotos` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `id_categoria`, `num_fotos`) VALUES
(1,	'Laptop Gamer',	'Equipo de alto rendimiento para videojuegos exigentes',	4500.50,	100,	1,	1),
(2,	'Mouse USB',	'Sensor óptico de 1600 DPI con diseño ergonómico',	25.00,	200,	1,	0),
(3,	'Teclado Mecánico',	'Switches blue y retroiluminación LED ajustable',	85.00,	120,	1,	0),
(4,	'Monitor 24 IPS',	'Panel Full HD con filtro de luz azul integrado',	190.00,	60,	1,	0),
(5,	'Webcam HD',	'Resolución 1080p y micrófono integrado estéreo',	45.00,	10,	1,	0),
(6,	'Disco SSD 500GB',	'Almacenamiento NVMe ultrarrápido para carga instantánea',	65.00,	90,	1,	0),
(7,	'Cargador Rápido',	'Adaptador de pared 65W compatible con USB-C',	30.00,	300,	1,	0),
(8,	'Hub USB 3.0',	'Multiplicador de 4 puertos con carcasa aluminio',	20.00,	250,	1,	0),
(9,	'Soporte Laptop',	'Base ventilada con ángulo ajustable y antideslizante',	35.00,	180,	1,	0),
(10,	'Cable HDMI 2m',	'Transmisión 4K HDR con blindaje antiinterferencias',	12.00,	400,	1,	0),
(11,	'Camiseta Básica',	'Algodón 100% prelavado, corte clásico unisex',	15.00,	500,	2,	0),
(12,	'Jeans Clásico',	'Mezclilla resistente con elastano para mayor comodidad',	40.00,	320,	2,	0),
(13,	'Zapatillas Run',	'Suela de goma antideslizante y malla transpirable',	85.00,	110,	2,	0),
(14,	'Chaqueta Sport',	'Tejido impermeable y transpirable con cremallera YKK',	70.00,	95,	2,	0),
(15,	'Sudadera Capucha',	'Interior felpado y ajuste relajado para invierno',	38.00,	NULL,	2,	0),
(16,	'Calcetines Pack x3',	'Fibras naturales con refuerzo en talón y punta',	10.00,	600,	2,	0),
(17,	'Gorra Deportiva',	'Visera curvada y cierre ajustable de velcro',	18.00,	350,	2,	0),
(18,	'Cinturón Cuero',	'Cuero genuino con hebilla de acero inoxidable',	25.00,	280,	2,	0),
(19,	'Bufanda Lana',	'Tejido suave y cálido, disponible en varios colores',	22.00,	150,	2,	0),
(20,	'Mochila Escolar',	'Compartimentos acolchados y respaldo ergonómico',	45.00,	130,	2,	0),
(21,	'Silla Oficina',	'Respaldo reclinable y reposabrazos ajustables',	150.00,	40,	3,	0),
(22,	'Escritorio Madera',	'MDF de 18mm con patas metálicas antirrayaduras',	120.00,	35,	3,	0),
(23,	'Lámpara LED',	'Luz regulable y temperatura de color ajustable',	35.00,	200,	3,	0),
(24,	'Organizador',	'Sistema modular de cajones transparentes apilables',	28.00,	180,	3,	0),
(25,	'Cuadro Decorativo',	'Impresión en canvas con marco de pino natural',	40.00,	NULL,	3,	0),
(26,	'Alfombra Sala',	'Fibra sintética de bajo mantenimiento, 150x200cm',	55.00,	70,	3,	0),
(27,	'Reloj Pared',	'Mecanismo silencioso de cuarzo y esfera minimalista',	25.00,	160,	3,	0),
(28,	'Maceta Cerámica',	'Drenaje inferior incluido, diseño geométrico moderno',	18.00,	220,	3,	0),
(29,	'Jarrón Cristal',	'Vidrio soplado a mano con acabado transparente',	30.00,	85,	3,	0),
(30,	'Cojines x2',	'Relleno de fibra hueca y funda lavable a máquina',	20.00,	300,	3,	0),
(31,	'Balón Fútbol',	'Cosa térmica y cámara de butilo para mayor rebote',	25.00,	150,	4,	0),
(32,	'Raqueta Tenis',	'Grafito ligero con empuñadura antivibración',	60.00,	80,	4,	0),
(33,	'Mancuernas 5kg',	'Recubrimiento de neopreno para agarre seguro',	35.00,	200,	4,	0),
(34,	'Esterilla Yoga',	'PVC ecológico de 6mm con correa de transporte',	20.00,	250,	4,	0),
(35,	'Botella Térmica',	'Acero inoxidable 18/8, mantiene temperatura 12h',	18.00,	NULL,	4,	0),
(36,	'Cuerda Saltar',	'Mango ergonómico y cable de acero recubierto',	12.00,	500,	4,	0),
(37,	'Bandas Elásticas',	'Set de 3 niveles de resistencia con anclaje',	15.00,	350,	4,	0),
(38,	'Rodillera Sport',	'Compresión graduada y tejido transpirable',	22.00,	280,	4,	0),
(39,	'Guantes Boxeo',	'Relleno de espuma multicapa y cierre velcro',	45.00,	90,	4,	0),
(40,	'Casco Ciclismo',	'Ventilación optimizada y sistema de ajuste rápido',	55.00,	70,	4,	0),
(41,	'Café Molido 500g',	'Tueste medio, origen Colombia, aroma intenso',	12.00,	600,	5,	0),
(42,	'Té Verde 100s',	'Hojas seleccionadas, alto contenido antioxidante',	8.00,	750,	5,	0),
(43,	'Miel Pura 1kg',	'Recolectada artesanalmente, sin aditivos químicos',	15.00,	300,	5,	0),
(44,	'Aceite Oliva 1L',	'Primera prensada en frío, denominación de origen',	10.00,	450,	5,	0),
(45,	'Pasta Integral',	'',	3.00,	0,	5,	0),
(46,	'Arroz Basmati',	'Grano largo aromático, cocción suelta y ligera',	4.00,	700,	5,	0),
(47,	'Sal Marina',	'Recolección natural, sin refinamiento químico',	2.00,	900,	5,	0),
(48,	'Vino Tinto 750ml',	'Uva Tempranillo, crianza 12 meses en barrica',	20.00,	150,	5,	0),
(49,	'Chocolate 70%',	'Cacao de origen único, bajo contenido azúcar',	5.00,	500,	5,	0);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) NOT NULL,
  `descripcion` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1,	'admin',	'Administrador');

DROP TABLE IF EXISTS `roles_permisos`;
CREATE TABLE `roles_permisos` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  KEY `id_rol` (`id_rol`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `roles_permisos` (`id_rol`, `id_permiso`) VALUES
(1,	1),
(1,	2);

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(20) NOT NULL,
  `apellidos` char(30) NOT NULL,
  `email` char(50) NOT NULL,
  `telefono` char(12) DEFAULT NULL,
  `password` char(60) NOT NULL DEFAULT '',
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `telefono`, `password`, `id_rol`) VALUES
(1,	'Admin',	'Administrador',	'admin@example.com',	'111112',	'$2y$10$xuReHiJqh4EfiRHf6/jsc..8tt6dLUyTj9BXEnmQ0z2YmX6qgjao6',	1),
(4,	'María',	'Martínez Ruiz',	'maria.martinez.02@test.com',	'+34611000002',	'hashed_pass_02',	1),
(5,	'Juan',	'Rodríguez Pérez',	'juan.rodriguez.03@test.com',	'+34611000003',	'hashed_pass_03',	1),
(7,	'Pedro',	'López Fernández',	'pedro.lopez.05@test.com',	'+34611000005',	'hashed_pass_05',	1),
(8,	'Laura',	'Gómez Martín',	'laura.gomez.06@test.com',	'+34611000006',	'hashed_pass_06',	1),
(9,	'Diego',	'Hernández Díaz',	'diego.hernandez.07@test.com',	'+34611000007',	'hashed_pass_07',	1),
(12,	'Carmen',	'Alonso Gutiérrez',	'carmen.alonso.10@test.com',	'+34611000010',	'hashed_pass_10',	1),
(13,	'Miguel',	'Navarro Rubio',	'miguel.navarro.11@test.com',	'+34611000011',	'hashed_pass_11',	1),
(14,	'Isabel',	'Molina Serrano',	'isabel.molina.12@test.com',	'+34611000012',	'hashed_pass_12',	1),
(15,	'Francisco',	'Castro Ortega',	'francisco.castro.13@test.com',	'+34611000013',	'hashed_pass_13',	1),
(16,	'Rosa',	'Suárez Delgado',	'rosa.suarez.14@test.com',	'+34611000014',	'hashed_pass_14',	1),
(17,	'Antonio',	'Jiménez Castillo',	'antonio.jimenez.15@test.com',	'+34611000015',	'hashed_pass_15',	1),
(18,	'Pilar',	'Reyes Cano',	'pilar.reyes.16@test.com',	'+34611000016',	'hashed_pass_16',	1),
(19,	'José',	'Vargas Peña',	'jose.vargas.17@test.com',	'+34611000017',	'hashed_pass_17',	1),
(20,	'Marta',	'Romero Navarro',	'marta.romero.18@test.com',	'+34611000018',	'hashed_pass_18',	1),
(21,	'David',	'Guerrero Prieto',	'david.guerrero.19@test.com',	'+34611000019',	'hashed_pass_19',	1),
(22,	'Elena',	'Medina Iglesias',	'elena.medina.20@test.com',	'+34611000020',	'hashed_pass_20',	1),
(23,	'Luis',	'Ortiz Vega',	'luis.ortiz.21@test.com',	'+34611000021',	'hashed_pass_21',	1),
(24,	'Teresa',	'Santos Blanco',	'teresa.santos.22@test.com',	'+34611000022',	'hashed_pass_22',	1),
(25,	'Manuel',	'Delgado Pascual',	'manuel.delgado.23@test.com',	'+34611000023',	'hashed_pass_23',	1),
(26,	'Lucía',	'Herrera Luna',	'lucia.herrera.24@test.com',	'+34611000024',	'hashed_pass_24',	1),
(27,	'Alejandro',	'Cruz Molina',	'alejandro.cruz.25@test.com',	'+34611000025',	'hashed_pass_25',	1),
(28,	'Andrea',	'Ramos Cabrera',	'andrea.ramos.26@test.com',	'+34611000026',	'hashed_pass_26',	1),
(29,	'Pablo',	'Reyes Vargas',	'pablo.reyes.27@test.com',	'+34611000027',	'hashed_pass_27',	1),
(30,	'Claudia',	'Gil Serrano',	'claudia.gil.28@test.com',	'+34611000028',	'hashed_pass_28',	1),
(31,	'Sergio',	'Hidalgo Medina',	'sergio.hidalgo.29@test.com',	'+34611000029',	'hashed_pass_29',	1),
(32,	'Irene',	'Navarro Suárez',	'irene.navarro.30@test.com',	'+34611000030',	'hashed_pass_30',	1),
(33,	'Álvaro',	'Fuentes Castro',	'alvaro.fuentes.31@test.com',	'+34611000031',	'hashed_pass_31',	1),
(34,	'Noelia',	'Herrero Jiménez',	'noelia.herrero.32@test.com',	'+34611000032',	'hashed_pass_32',	1),
(35,	'Fernando',	'Medina Alonso',	'fernando.medina.33@test.com',	'+34611000033',	'hashed_pass_33',	1),
(36,	'Julia',	'Rubio Hernández',	'julia.rubio.34@test.com',	'+34611000034',	'hashed_pass_34',	1),
(37,	'Rubén',	'Romero Torres',	'ruben.romero.35@test.com',	'+34611000035',	'hashed_pass_35',	1),
(38,	'Sara',	'Muñoz González',	'sara.munoz.36@test.com',	'+34611000036',	'hashed_pass_36',	1),
(39,	'Adrián',	'Pérez Martínez',	'adrian.perez.37@test.com',	'+34611000037',	'hashed_pass_37',	1),
(40,	'Beatriz',	'López García',	'beatriz.lopez.38@test.com',	'+34611000038',	'hashed_pass_38',	1),
(41,	'Alberto',	'Sánchez Rodríguez',	'alberto.sanchez.39@test.com',	'+34611000039',	'hashed_pass_39',	1),
(42,	'Cristina',	'Fernández Gómez',	'cristina.fernandez.40@test.com',	'+34611000040',	'hashed_pass_40',	1),
(43,	'Marcos',	'Martín Hernández',	'marcos.martin.41@test.com',	'+34611000041',	'hashed_pass_41',	1),
(44,	'Patricia',	'Díaz Torres',	'patricia.diaz.42@test.com',	'+34611000042',	'hashed_pass_42',	1),
(45,	'Víctor',	'Moreno Alonso',	'victor.moreno.43@test.com',	'+34611000043',	'hashed_pass_43',	1),
(46,	'Montserrat',	'Gutiérrez Navarro',	'montserrat.gutierrez.44@test.com',	'+34611000044',	'hashed_pass_44',	1),
(47,	'Raúl',	'Romero Muñoz',	'raul.romero.45@test.com',	'+34611000045',	'hashed_pass_45',	1),
(48,	'Héctor',	'Torres Hernández',	'hector.torres.46@test.com',	'+34611000046',	'hashed_pass_46',	1),
(49,	'Natalia',	'López Martínez',	'natalia.lopez.47@test.com',	'+34611000047',	'hashed_pass_47',	1);

-- 2026-06-26 20:02:01


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 05:07 PM
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
-- Database: `criticine`
--

-- --------------------------------------------------------

--
-- Table structure for table `peliculas`
--

CREATE TABLE `peliculas` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peliculas`
--

INSERT INTO `peliculas` (`movie_id`, `title`, `genre`, `release_date`, `director`, `duration`, `description`, `poster_url`, `created_at`, `updated_at`) VALUES
(1, 'Jaws (1975)', 'Aventura, Misterio, Thriller', '1975-06-20', 'Steven Spielberg', 124, 'Cuando un tiburón asesino desata el caos en una comunidad playera de Long Island, el sheriff local, un biólogo marino y un viejo marinero deben dar caza a la bestia.', 'https://m.media-amazon.com/images/I/81i0SawSjDL._AC_SL1500_.jpg', '2024-06-18 10:13:54', '2024-06-18 10:13:54'),
(3, 'The Shawshank Redemption', 'Drama', '1994-09-23', 'Frank Darabont', 142, 'Dos hombres encarcelados establecen una profunda amistad mientras encuentran consuelo y redención a través de actos de bondad.', 'https://m.media-amazon.com/images/M/MV5BNDE3ODcxYzMtY2YzZC00NmNlLWJiNDMtZDViZWM2MzIxZDYwXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_.jpg', '2024-06-18 11:01:24', '2024-06-18 11:01:24'),
(4, 'The Godfather', 'Crimen, Drama', '1972-03-24', 'Francis Ford Coppola', 175, 'El patriarca envejecido de una dinastía criminal transfiere el control de su imperio clandestino a su hijo renuente.', 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', '2024-06-18 11:02:18', '2024-06-19 12:47:35'),
(5, 'The Dark Knight', 'Acción, Crimen, Drama', '2008-07-18', 'Christopher Nolan', 152, 'Cuando el Joker siembra el caos en Gotham, Batman debe enfrentar una de sus mayores pruebas psicológicas y físicas para luchar contra la injusticia.', 'https://m.media-amazon.com/images/S/pv-target-images/e9a43e647b2ca70e75a3c0af046c4dfdcd712380889779cbdc2c57d94ab63902.jpg', '2024-06-18 11:02:50', '2024-06-18 11:02:50'),
(6, 'Pulp Fiction', 'Crimen, Drama', '1994-10-14', 'Quentin Tarantino', 154, 'Las vidas de dos sicarios, un boxeador, un gánster y su esposa, y dos ladrones de restaurantes se entrelazan en cuatro historias de violencia y redención.', 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_FMjpg_UX1000_.jpg', '2024-06-18 15:30:12', '2024-06-18 15:30:12'),
(7, 'The Lord of the Rings: The Return of the King', 'Aventura, Drama, Fantasía', '2003-12-17', 'Peter Jackson', 201, 'Gandalf y Aragorn lideran al mundo de los hombres contra el ejército de Sauron para desviar su atención de Frodo y Sam mientras se acercan al Monte del Destino con el Anillo Único.', 'https://m.media-amazon.com/images/M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', '2024-06-18 15:30:51', '2024-06-18 15:30:51'),
(8, 'Forrest Gump', 'Drama, Romance', '1994-07-06', 'Robert Zemeckis', 142, 'Las presidencias de Kennedy y Johnson, los eventos de Vietnam, Watergate y otros eventos históricos se desarrollan a través de la perspectiva de un hombre de Alabama con un coeficiente intelectual de 75, cuyo único deseo es reunirse con su amor de la infancia.', 'https://m.media-amazon.com/images/M/MV5BNWIwODRlZTUtY2U3ZS00Yzg1LWJhNzYtMmZiYmEyNmU1NjMzXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_FMjpg_UX1000_.jpg', '2024-06-18 15:31:45', '2024-06-18 15:31:45'),
(9, 'Inception', 'Acción, Aventura, Ciencia ficción', '2010-07-16', 'Christopher Nolan', 148, 'Un ladrón que roba secretos corporativos a través del uso de la tecnología de intercambio de sueños recibe la tarea inversa de plantar una idea en la mente de un CEO.', 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_FMjpg_UX1000_.jpg', '2024-06-18 15:32:36', '2024-06-18 15:32:36'),
(10, 'The Matrix', 'Acción, Ciencia ficción', '1999-03-31', 'Lana Wachowski, Lilly Wachowski', 136, 'Un pirata informático descubre la verdad sobre su realidad y su papel en la guerra contra las máquinas inteligentes.', 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_FMjpg_UX1000_.jpg', '2024-06-18 15:33:43', '2024-06-18 15:33:43'),
(11, 'Schindler\'s List', 'Biografía, Drama, Historia', '1993-12-15', 'Steven Spielberg', 195, 'En la Polonia ocupada por los nazis, el industrial Oskar Schindler gradualmente se convierte en preocupado por sus trabajadores judíos después de presenciar su persecución brutal por parte de los nazis.', 'https://m.media-amazon.com/images/M/MV5BNDE4OTMxMTctNmRhYy00NWE2LTg3YzItYTk3M2UwOTU5Njg4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_FMjpg_UX1000_.jpg', '2024-06-18 15:35:19', '2024-06-18 15:35:19'),
(12, 'Avatar', 'Acción, Aventura, Fantasía', '2009-12-10', 'James Cameron', 162, 'Un marine parapléjico enviado a la luna Pandora en una misión única se debate entre seguir sus órdenes y proteger el mundo que siente como su hogar.', 'https://m.media-amazon.com/images/M/MV5BZDA0OGQxNTItMDZkMC00N2UyLTg3MzMtYTJmNjg3Nzk5MzRiXkEyXkFqcGdeQXVyMjUzOTY1NTc@._V1_FMjpg_UX1000_.jpg', '2024-06-19 12:52:49', '2024-06-19 12:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `ratings_peliculas`
--

CREATE TABLE `ratings_peliculas` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings_peliculas`
--

INSERT INTO `ratings_peliculas` (`rating_id`, `user_id`, `movie_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 3, '2024-06-19 12:33:38', '2024-06-19 14:53:52'),
(2, 5, 10, 4, '2024-06-19 12:35:34', '2024-06-19 12:35:38'),
(3, 1, 9, 5, '2024-06-19 13:29:51', '2024-06-19 13:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `ratings_series`
--

CREATE TABLE `ratings_series` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `series_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews_peliculas`
--

CREATE TABLE `reviews_peliculas` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pelicula_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews_peliculas`
--

INSERT INTO `reviews_peliculas` (`review_id`, `user_id`, `pelicula_id`, `title`, `content`, `created_at`) VALUES
(1, 1, 9, 'Muy buena pelicula', 'Fue una gran experiencia', '2024-06-19 13:15:05'),
(2, 1, 4, 'Clasico', 'Un clasico absoluto del cine.', '2024-06-19 13:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `reviews_series`
--

CREATE TABLE `reviews_series` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `series_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews_series`
--

INSERT INTO `reviews_series` (`review_id`, `user_id`, `series_id`, `title`, `content`, `created_at`) VALUES
(1, 1, 3, 'Muy buena serie', 'Fue de las mejores del año durante su lanzamiento', '2024-06-19 13:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(3, 'admin'),
(2, 'moderador'),
(1, 'usuario');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `series_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `seasons` int(11) DEFAULT NULL,
  `episodes` int(11) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`series_id`, `title`, `genre`, `release_date`, `seasons`, `episodes`, `director`, `description`, `poster_url`, `created_at`, `updated_at`) VALUES
(1, 'Breaking Bad', 'Crimen, Drama, Suspenso', '2008-01-20', 5, 62, 'Vince Gilligan', 'Un profesor de química se convierte en un fabricante de metanfetaminas para asegurar el futuro de su familia después de ser diagnosticado con cáncer.', 'https://m.media-amazon.com/images/M/MV5BYmQ4YWMxYjUtNjZmYi00MDQ1LWFjMjMtNjA5ZDdiYjdiODU5XkEyXkFqcGdeQXVyMTMzNDExODE5._V1_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(2, 'Game of Thrones', 'Acción, Aventura, Drama', '2011-04-17', 8, 73, 'David Benioff, D.B. Weiss', 'Nueve familias nobles luchan por el control de las tierras de Westeros, mientras una antigua enemiga regresa después de estar dormida por miles de años.', 'https://m.media-amazon.com/images/M/MV5BN2IzYzBiOTQtNGZmMi00NDI5LTgxMzMtN2EzZjA1NjhlOGMxXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_FMjpg_UX1000_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(3, 'Stranger Things', 'Drama, Fantasía, Terror', '2016-07-15', 4, 34, 'Matt Duffer, Ross Duffer', 'Cuando un niño desaparece, su madre, un jefe de policía y sus amigos deben enfrentarse a fuerzas terroríficas para recuperarlo.', 'https://upload.wikimedia.org/wikipedia/en/b/b1/Stranger_Things_season_1.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(4, 'The Witcher', 'Acción, Aventura, Drama', '2019-12-20', 2, 16, 'Lauren Schmidt Hissrich', 'Geralt de Rivia, un cazador de monstruos, lucha por encontrar su lugar en un mundo donde las personas a menudo son más perversas que las bestias.', 'https://m.media-amazon.com/images/M/MV5BMDEwOWVlY2EtMWI0ZC00OWVmLWJmZGItYTk3YjYzN2Y0YmFkXkEyXkFqcGdeQXVyMTUzMTg2ODkz._V1_FMjpg_UX1000_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(5, 'The Mandalorian', 'Acción, Aventura, Fantasía', '2019-11-12', 2, 16, 'Jon Favreau', 'Después de las historias de Jango y Boba Fett, surge otro guerrero en el universo de Star Wars. El Mandaloriano tiene lugar después de la caída del Imperio y antes de la aparición de la Primera Orden.', 'https://m.media-amazon.com/images/M/MV5BN2M5YWFjN2YtYzU2YS00NzBlLTgwZWUtYWQzNWFhNDkyYjg3XkEyXkFqcGdeQXVyMDM2NDM2MQ@@._V1_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(6, 'Friends', 'Comedia, Romance', '1994-09-22', 10, 236, 'David Crane, Marta Kauffman', 'Sigue las vidas personales y profesionales de seis amigos que viven en Manhattan.', 'https://m.media-amazon.com/images/M/MV5BNDVkYjU0MzctMWRmZi00NTkxLTgwZWEtOWVhYjZlYjllYmU4XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(7, 'The Office', 'Comedia', '2005-03-24', 9, 201, 'Greg Daniels', 'Un grupo de empleados de oficina se enfrenta a la monotonía del trabajo cotidiano en una sucursal de Scranton, Pensilvania, de la compañía Dunder Mifflin.', 'https://m.media-amazon.com/images/M/MV5BMDNkOTE4NDQtMTNmYi00MWE0LWE4ZTktYTc0NzhhNWIzNzJiXkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(8, 'Sherlock', 'Crimen, Drama, Misterio', '2010-07-25', 4, 13, 'Steven Moffat, Mark Gatiss', 'Una actualización moderna de los cuentos de Sherlock Holmes, con Benedict Cumberbatch como el detective titular y Martin Freeman como su colega, el Dr. Watson.', 'https://m.media-amazon.com/images/M/MV5BMWEzNTFlMTQtMzhjOS00MzQ1LWJjNjgtY2RhMjFhYjQwYjIzXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_FMjpg_UX1000_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(9, 'Westworld', 'Drama, Misterio, Ciencia Ficción', '2016-10-02', 3, 28, 'Jonathan Nolan, Lisa Joy', 'Situada en un parque temático del futuro donde los huéspedes interactúan con androides, se cuestiona la inteligencia artificial y la naturaleza de la conciencia.', 'https://m.media-amazon.com/images/M/MV5BZDg1OWRiMTktZDdiNy00NTZlLTg2Y2EtNWRiMTcxMGE5YTUxXkEyXkFqcGdeQXVyMTM2MDY0OTYx._V1_FMjpg_UX1000_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23'),
(10, 'The Crown', 'Biografía, Drama, Historia', '2016-11-04', 4, 40, 'Peter Morgan', 'Sigue la vida de la Reina Isabel II desde su boda en 1947 hasta principios del siglo XXI.', 'https://m.media-amazon.com/images/M/MV5BMjAxOTA2Mjc3MF5BMl5BanBnXkFtZTgwMTMxMzIxNDM@._V1_.jpg', '2024-06-19 09:36:48', '2024-06-19 09:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Agustin', 'agustin@gmail.com', '$2y$10$ulEKZOu8O7O4wnBGWNiudeqZ2Py9et6wJQsS5TDdvQXR6Nioc2tnu', '2024-06-18 10:21:28', '2024-06-18 10:36:06', 2),
(2, 'JuanAngel', 'juanangel@gmail.com', '$2y$10$/xGfjF8FRRjcsUh/zIxbmunaCcZ7S/hbUSgS6tpYeYuqlfyzACKlq', '2024-06-19 11:40:43', '2024-06-19 11:40:43', NULL),
(4, 'juan___21', 'juan@mail.com', '$2y$10$DpkSPKLoJhIKg1YWlVObBOaQ4Cb7S9UKC6G7G/VZgPdaV0BUWHcrK', '2024-06-19 11:42:46', '2024-06-19 11:42:46', NULL),
(5, 'Agustin2', 'agustin2@gmail.com', '$2y$10$Hina3DtjkFAhrM/Uinmk/OW/bZHSbvlI2tyQUaWHKKTkUPAhu7lfq', '2024-06-19 12:35:21', '2024-06-19 12:35:21', NULL),
(6, 'Hermosilla', 'hermosilla@gmail.com', '$2y$10$CZC..KBezIdwmzEsDve60uviBmffxt8qN/lHdI4kMjslP4OFkiVqS', '2024-06-19 13:49:53', '2024-06-19 14:40:18', 3),
(7, 'admin', 'admin@criticine.com', '$2y$10$airDTAOqiNpkjaz.wDuST.lrUV8KgzJaJxoh74TiWTZ8iMk6.jXBe', '2024-06-19 14:30:00', '2024-06-19 14:30:18', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `ratings_peliculas`
--
ALTER TABLE `ratings_peliculas`
  ADD PRIMARY KEY (`rating_id`),
  ADD UNIQUE KEY `unique_rating_peliculas` (`user_id`,`movie_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `ratings_series`
--
ALTER TABLE `ratings_series`
  ADD PRIMARY KEY (`rating_id`),
  ADD UNIQUE KEY `unique_rating_series` (`user_id`,`series_id`),
  ADD KEY `series_id` (`series_id`);

--
-- Indexes for table `reviews_peliculas`
--
ALTER TABLE `reviews_peliculas`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`pelicula_id`),
  ADD KEY `fk_pelicula_id` (`pelicula_id`);

--
-- Indexes for table `reviews_series`
--
ALTER TABLE `reviews_series`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`series_id`),
  ADD KEY `fk_series_id` (`series_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`series_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuarios_roles` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ratings_peliculas`
--
ALTER TABLE `ratings_peliculas`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ratings_series`
--
ALTER TABLE `ratings_series`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews_peliculas`
--
ALTER TABLE `reviews_peliculas`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews_series`
--
ALTER TABLE `reviews_series`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `series_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings_peliculas`
--
ALTER TABLE `ratings_peliculas`
  ADD CONSTRAINT `ratings_peliculas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`),
  ADD CONSTRAINT `ratings_peliculas_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `peliculas` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings_series`
--
ALTER TABLE `ratings_series`
  ADD CONSTRAINT `ratings_series_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`),
  ADD CONSTRAINT `ratings_series_ibfk_2` FOREIGN KEY (`series_id`) REFERENCES `series` (`series_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews_peliculas`
--
ALTER TABLE `reviews_peliculas`
  ADD CONSTRAINT `fk_pelicula_id` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`movie_id`),
  ADD CONSTRAINT `fk_user_id_peliculas` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`);

--
-- Constraints for table `reviews_series`
--
ALTER TABLE `reviews_series`
  ADD CONSTRAINT `fk_series_id` FOREIGN KEY (`series_id`) REFERENCES `series` (`series_id`),
  ADD CONSTRAINT `fk_user_id_series` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

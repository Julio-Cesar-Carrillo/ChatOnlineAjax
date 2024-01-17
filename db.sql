
--
CREATE DATABASE `bd_chat_ajax`;
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mensaje`
--

CREATE TABLE `tbl_mensaje` (
  `id_chat` int(11) NOT NULL,
  `user_emi_chat` int(11) NOT NULL,
  `user_rec_chat` int(11) NOT NULL,
  `historial_chat` text NOT NULL,
  `fecha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `tbl_solicitud`
--

CREATE TABLE `tbl_solicitud` (
  `id` int(11) NOT NULL,
  `num_telf_user_emi` int(11) NOT NULL,
  `num_telf_user_rec` int(11) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `num_telf_user` varchar(9) NOT NULL,
  `user_user` varchar(10) NOT NULL,
  `nom_user` varchar(20) NOT NULL,
  `cognom_user` varchar(50) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `pwd_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indices de la tabla `tbl_mensaje`
--
ALTER TABLE `tbl_mensaje`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `fk_mensaje_user_emi` (`user_emi_chat`),
  ADD KEY `fk_mensaje_user_rec` (`user_rec_chat`);

--
-- Indices de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitud_user_emi` (`num_telf_user_emi`),
  ADD KEY `fk_solicitud_user_rec` (`num_telf_user_rec`);

--
-- Indices de la tabla `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_mensaje`
--
ALTER TABLE `tbl_mensaje`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;


--
-- Filtros para la tabla `tbl_mensaje`
--
ALTER TABLE `tbl_mensaje`
  ADD CONSTRAINT `fk_mensaje_user_emi` FOREIGN KEY (`user_emi_chat`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `fk_mensaje_user_rec` FOREIGN KEY (`user_rec_chat`) REFERENCES `tbl_user` (`id`);

--
-- Filtros para la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  ADD CONSTRAINT `fk_solicitud_user_emi` FOREIGN KEY (`num_telf_user_emi`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `fk_solicitud_user_rec` FOREIGN KEY (`num_telf_user_rec`) REFERENCES `tbl_user` (`id`);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Volcado de datos para la tabla `assign`
--

INSERT INTO `assign` (`student_id`, `group_id`) VALUES
(22, 1),
(23, 1),
(22, 1),
(23, 1);

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrator', '2', NULL),
('Student', '22', NULL),
('Student', '23', NULL),
('Tutor', '21', 1463434789);

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Administrator', 12, 'Administrator', NULL, NULL, NULL, NULL),
('Student', 12, 'Student', NULL, NULL, NULL, NULL),
('Tutor', 1, 'Tutor', NULL, NULL, 1462235561, 1462235561);

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `group`
--

INSERT INTO `group` (`id`, `tutor_id`, `name`) VALUES
(1, 21, 'Equipo1');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `auth_key`, `access_token`, `name`, `last_name`, `email`) VALUES
(2, 'admin', '$2y$13$L/tH2EXGbObmmSewK6iynuffqS2GCguccxaUXX0fesnQcy8z3ZMHy', 'CuQvUoucvOsQJlqkR60ytERQxdwWei2K', '3P3bxow4BsX5qpBE_8xJlzzNx7MVXQx8', 'admin', 'admin', 'admin@admin'),
(21, 'Tutor', '$2y$13$Mst66/Ye6tWCt27t4zCQie1eCcQFL8BC7RZ7bLpfWlW0cyzOaawtO', 'NUpA-Pt1ZZ4Ddn_BIC01HojptlReQrpH', 'MSBLhfet07VTjPXHlcoTVf8UsuJ1wehS', 'tutor', 'tutor', 'tutor@gmail.com'),
(22, 'student1', '$2y$13$UxZjMcqpOcmqqwnJYJ4SOuky7drQcXvhS02gVjnzYdJIVSKCBqoF2', 'QxchXZBAlX-_UQ2H0y02fjfsWOmyLshX', 'ybaRo4-c2UQkagnr1RlkbSoOll_hlzDR', 'student', 'student', 'student1@gmail.com'),
(23, 'student2', '$2y$13$JVGTCttnY5UXpH6/onRjAOD1psGjSEILQoAh.qzV5HD6WYww4BETq', 'x0CpvyQWJKO7KozBQvD561zi8FAFR6R7', 'KPoWTngcYWzdpCCFmecG8hrZQjaAeNel', 'student', 'student', 'student1@gmail.com');

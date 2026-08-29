-- LC-ADVANCE Backup 2026-07-02 12:25:42

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `tipo` enum('info','success','warning','danger') NOT NULL DEFAULT 'info',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_badge` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `icono` varchar(100) DEFAULT 'badge_default.png',
  `orden` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('1','Primer Paso','Completaste tu primera lección','🏁','0');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('2','Estrella del Código','Puntaje perfecto en un quiz','🎯','1');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('3','Maestro del Nivel','Alcanzaste el nivel 5','⭐','2');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('4','Coleccionista','Obtuviste 5 insignias','👑','3');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('5','Racha de 7 Días','Estudiaste 7 días seguidos','🔥','4');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('6','Novato','Acumulaste 500 XP','🥉','5');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('7','Explorador','Acumulaste 1,000 XP','🥈','6');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('8','Élite','Acumulaste 2,000 XP','🥇','7');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('9','Leyenda','Acumulaste 5,000 XP','🏆','8');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('10','Dios del Conocimiento','Acumulaste 10,000 XP','🌌','9');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('11','Estudiante Dedicado','Completaste 10 lecciones','📖','10');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('12','Sabio','Completaste 25 lecciones','🧙‍♂️','11');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('13','Erudito','Completaste 50 lecciones','📜','12');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('14','Genio','Completaste 100 lecciones','🧠','13');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('15','Quizzero','Pasaste 10 quizzes','⚡','14');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('16','Maestro Quiz','Pasaste 50 quizzes','🪐','15');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('17','Racha de 14 Días','Estudiaste 14 días seguidos','☄️','16');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('18','Racha de 30 Días','Estudiaste 30 días seguidos','☀️','17');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('19','Matemático','Completaste todas las lecciones de Pensamiento Matemático','📐','18');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('20','Científico','Completaste Química I y Física I','🧪','19');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('21','Humanista','Completaste todas las lecciones de Humanidades I','🏛️','20');
INSERT INTO `badges` (`id`,`nombre_badge`,`descripcion`,`icono`,`orden`) VALUES ('22','Políglota','Completaste todas las lecciones de Inglés','🗣️','21');

CREATE TABLE `credenciales` (
  `clave` varchar(100) NOT NULL,
  `valor` text NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('github_client_id_dev','Ov23liR2ex0RxXcrUfAz','GitHub OAuth Client ID (dev)','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('github_client_id_prod','Ov23ligyvD096zr7u85V','GitHub OAuth Client ID (prod)','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('github_client_secret_dev','dc8524f64a5a4dff43d8aa1d6e9e7f01d57e968d','GitHub OAuth Client Secret (dev)','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('github_client_secret_prod','0c1a890c637e28fbf27579982b5b79c6a524d69e','GitHub OAuth Client Secret (prod)','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('google_client_id','317866808413-8odsje97n8j7k150j3ag1lr89ughotb7.apps.googleusercontent.com','Google OAuth Client ID','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('google_client_secret','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','Google OAuth Client Secret','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('openrouter_api_key','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','OpenRouter API Key','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('smtp_from_email','lcadvance40@gmail.com','SMTP From Email','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('smtp_password','jbgt frey azdf fsjo','SMTP Password','2026-07-02 08:13:12');
INSERT INTO `credenciales` (`clave`,`valor`,`descripcion`,`actualizado_en`) VALUES ('smtp_username','lcadvance40@gmail.com','SMTP Username','2026-07-02 08:13:12');

CREATE TABLE `daily_quests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `quest_type` varchar(50) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` varchar(500) DEFAULT '',
  `objetivo` int(11) NOT NULL DEFAULT 1,
  `progreso` int(11) NOT NULL DEFAULT 0,
  `recompensa_xp` int(11) NOT NULL DEFAULT 50,
  `completada` tinyint(1) NOT NULL DEFAULT 0,
  `reclamada` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_date_type` (`usuario_id`,`fecha`,`quest_type`),
  KEY `idx_user_date` (`usuario_id`,`fecha`),
  CONSTRAINT `daily_quests_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `daily_quests` (`id`,`usuario_id`,`fecha`,`quest_type`,`titulo`,`descripcion`,`objetivo`,`progreso`,`recompensa_xp`,`completada`,`reclamada`,`created_at`) VALUES ('1','1','2026-07-02','examen_aprobado','Aprobar exámenes (80%+)','Progreso: 0/1','1','0','50','0','0','2026-07-02 08:46:28');
INSERT INTO `daily_quests` (`id`,`usuario_id`,`fecha`,`quest_type`,`titulo`,`descripcion`,`objetivo`,`progreso`,`recompensa_xp`,`completada`,`reclamada`,`created_at`) VALUES ('2','1','2026-07-02','completar_lecciones','Completar lecciones','Progreso: 0/2','2','0','35','0','0','2026-07-02 08:46:28');
INSERT INTO `daily_quests` (`id`,`usuario_id`,`fecha`,`quest_type`,`titulo`,`descripcion`,`objetivo`,`progreso`,`recompensa_xp`,`completada`,`reclamada`,`created_at`) VALUES ('3','1','2026-07-02','ganar_xp','Ganar XP','Progreso: 0/150','150','0','25','0','0','2026-07-02 08:46:28');

CREATE TABLE `dialogosmapa` (
  `IDPersonajeC` varchar(100) NOT NULL,
  `IdDialogoM` varchar(100) NOT NULL,
  `DialogoM` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `dilogoscombate` (
  `IDPersonajeC` varchar(100) NOT NULL,
  `IDDialogoC` varchar(100) NOT NULL,
  `TipodialogoC` varchar(100) NOT NULL,
  `DialogoC` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Cu','1','Continuo','¡Quiubo, compadre! ¿Cómo anda? Lo veo con los mjmmm en el piso, ¿qué trae?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Cu','2','Continuo','¿El marranito que traían? ¡Jajajaja! No, compadre, no me digas que se peló…');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Cu','3','Pregunta','Híjole, compadre… pues ojalá lo encuentres, porque esos animalitos luego son más listos que los alumnos, ¡ja! Pero bueno, ni modo, la vida sigue. Y hablando de cosas importantes… ¿ya te chutaste el examen que te dejé? Porque ese sí no se va a escapar como el cochino, ¿eh?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Cu','4','Pregunta','Falta poco compadre');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Cu','5','Final','Ya acabaste? eso es todo compadre');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Es','1','Continuo','Bienvenido estudiante, hoy practicaremos cálculo diferencial');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Es','2','Continuo','Las derivadas son fundamentales en matemáticas avanzadas');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Es','3','Pregunta','Ahora resolvamos unos problemas de derivadas');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Es','4','Pregunta','Vas bien, continúa');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Es','5','Final','Excelente trabajo, has dominado las derivadas correctamente');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','1','Continuo','Hola compadre, hoy exploraremos los números primos');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','2','Continuo','La teoría de números es fascinante y desafiante');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','3','Pregunta','¿Estás listo para resolver estos problemas?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','4','Pregunta','Muy bien, casi terminas');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','5','Final','Bravo, demostraste entender bien la teoría de números');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1He','1','Continuo','Hola estudiante, ¿listos para física y química?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1He','2','Pregunta','Recuerden que deben dominar estos conceptos fundamentales');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1He','3','Pregunta','Ya casi terminas, vamos bien');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1He','4','Final','Excelente desempeño en ciencias exactas');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ca','1','Continuo','Bienvenido a la clase de biología');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ca','2','Pregunta','La ecología es vital para entender nuestro planeta');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ca','3','Pregunta','Sigue adelante, te va muy bien');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ca','4','Final','Perfecto, comprendes bien los conceptos biológicos');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Go','1','Continuo','How are you today?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Go','2','Pregunta','Ready for English practice?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Go','3','Pregunta','Keep going, you are doing great');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Go','4','Final','Congratulations, excellent English level');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ma','1','Continuo','Hola, bienvenido a programación');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ma','2','Pregunta','Aprenderemos algoritmos y estructuras de datos');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ma','3','Pregunta','Excelente, sigue así');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ma','4','Final','Perfecto, dominas la programación');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Me','1','Continuo','Hola estudiante, hoy practicaremos SQL');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Me','2','Pregunta','Las bases de datos son esenciales en informática');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Me','3','Pregunta','Casi terminas, vamos bien');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Me','4','Final','Excelente, dominas SQL correctamente');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Pa','1','Continuo','¡Qué onda joven como esta!');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Pa','2','Pregunta','Vamos al salón que les toca examen');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Pa','3','Pregunta','Ándele ya casi acaba');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Pa','4','Final','¡Hasta luego joven!');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','1','Continuo','Hola estudiante, hoy hablaremos de la historia de México');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','2','Pregunta','Estamos en un momento crucial de nuestro pasado');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','3','Pregunta','Vas muy bien, continuemos');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','4','Final','Excelente, has demostrado conocer nuestra historia');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Es','5','Final','Muy bien, eso fue excelente. Recuerda siempre practicar tus derivadas.');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','1','Continuo','Hola compadre, ¿listos para explorar los números primos?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','2','Pregunta','¿Vamos a resolver algunos problemas de teoría de números?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','3','Pregunta','Excelente, sigamos adelante');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Le','4','Final','Bravo, demostraste entender bien la teoría de números.');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','1','Continuo','¡Hola estudiante! Hoy hablaremos de la historia de México');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','2','Pregunta','¿Estás listo para aprender sobre nuestro pasado?');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','3','Pregunta','Vas muy bien, continuemos');
INSERT INTO `dilogoscombate` (`IDPersonajeC`,`IDDialogoC`,`TipodialogoC`,`DialogoC`) VALUES ('1Ar','4','Final','Excelente, has demostrado conocer nuestra historia.');

CREATE TABLE `grade_changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `old_score` int(11) DEFAULT NULL,
  `new_score` int(11) DEFAULT NULL,
  `changed_by` int(11) NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_grade_changes_user` (`user_id`),
  KEY `idx_grade_changes_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `group_lecciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_group_lesson` (`grupo_id`,`slug`),
  KEY `idx_group_lecciones_slug` (`slug`),
  KEY `idx_group_lecciones_grupo` (`grupo_id`),
  CONSTRAINT `group_lecciones_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `grupo_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_grupo_usuario` (`grupo_id`,`usuario_id`),
  KEY `idx_grupo_usuarios_usuario` (`usuario_id`),
  CONSTRAINT `grupo_usuarios_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grupo_usuarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `codigo_acceso` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_acceso` (`codigo_acceso`),
  KEY `idx_grupos_profesor` (`profesor_id`),
  CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `idsmaestros` (
  `PersonajeC` varchar(100) NOT NULL,
  `IDPersonajeC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Espindola','1Es');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Miguel Márquez','1Le');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Herson','1He');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Carolina','1Ca');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Enrique','1Go');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Manuel','1Ma');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('M. Meza','1Me');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Cuco','1Cu');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('R. Padilla','1Pa');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Armando','1Ar');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Espindola','1Es');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Miguel Márquez','1Le');
INSERT INTO `idsmaestros` (`PersonajeC`,`IDPersonajeC`) VALUES ('Armando','1Ar');

CREATE TABLE `imgcombate` (
  `IDPersonajeC` varchar(100) NOT NULL,
  `IDImgC` varchar(100) NOT NULL,
  `ImgC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `imgcombate` (`IDPersonajeC`,`IDImgC`,`ImgC`) VALUES ('1Cu','1','cucoidle');
INSERT INTO `imgcombate` (`IDPersonajeC`,`IDImgC`,`ImgC`) VALUES ('1Cu','2','cucoatk1');

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leaderboard` AS select `u`.`id` AS `id`,`u`.`nombre_usuario` AS `nombre_usuario`,`u`.`puntos` AS `puntos`,`u`.`nivel` AS `nivel`,count(`ub`.`badge_id`) AS `total_badges` from (`usuarios` `u` left join `usuarios_badges` `ub` on(`u`.`id` = `ub`.`usuario_id`)) group by `u`.`id` order by `u`.`puntos` desc;

INSERT INTO `leaderboard` (`id`,`nombre_usuario`,`puntos`,`nivel`,`total_badges`) VALUES ('1','dgeti168','0','1','0');

CREATE TABLE `lecciones_completadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `completada_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`,`slug`),
  CONSTRAINT `lecciones_completadas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `maestroact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDPersonajeC` varchar(100) NOT NULL,
  `Maestro_Actual` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'info',
  `titulo` varchar(200) NOT NULL,
  `mensaje` text DEFAULT NULL,
  `leida` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_notificaciones_usuario` (`usuario_id`,`leida`,`created_at`),
  CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(128) NOT NULL,
  `expiracion` datetime NOT NULL,
  `usado` tinyint(1) NOT NULL DEFAULT 0,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `token` (`token`),
  CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `preguntas` (
  `IDPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `IDPersonajeC` varchar(10) DEFAULT NULL,
  `Pregunta` text NOT NULL,
  `TipoPreguntaC` varchar(100) NOT NULL,
  `Opcion1` varchar(255) NOT NULL,
  `Opcion2` varchar(255) NOT NULL,
  `Opcion3` varchar(255) NOT NULL,
  `RespuestaCorrecta` tinyint(4) NOT NULL,
  PRIMARY KEY (`IDPregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('1','1Cu','1. El bienestar social busca principalmente:','Continua','A) Que cada individuo compita por sus propios intereses','B) La satisfacción equilibrada de las necesidades colectivas e individuales','C) La acumulación de bienes materiales','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('2','1Cu','2. Una norma jurídica se diferencia de una norma social porque:','Continua','A) No requiere sanción alguna','B) Se cumple solo si la persona quiere','C) Es obligatoria y respaldada por el poder del Estado','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('3','1Cu','3. ¿Cuál de los siguientes elementos caracteriza al Estado moderno?','Continua','A) Población, territorio y soberanía','B) Multiplicidad de gobiernos','C) Falta de territorio definido','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('4','1Cu','4. Cuando un grupo social ejerce influencia sobre las decisiones públicas mediante el voto o la opinión, está participando en:','Continua','A) La organización productiva','B) Las relaciones de poder político','C) El sistema educativo','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('5','1Cu','5. Las normas sociales tienen como finalidad principal:5. Las normas sociales tienen como finalidad principal:','Continua','A) Proteger el patrimonio nacional','B) Regular la convivencia entre los miembros de una comunidad','C) Imponer sanciones económicas','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('6','1Cu','6. Según Henry Fayol, las etapas del proceso administrativo son:','Continua','A) Planeación, control, evaluación y sanción','B) Planeación, organización, dirección y control','C) Diagnóstico, planeación, operación y medición','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('7','1Cu','7. La eficiencia en la administración se refiere a:','Continua','A) Lograr las metas con el menor uso posible de recursos','B) Alcanzar los objetivos planeados sin importar los recursos usados','C) Cumplir con las normas jurídicas','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('8','1Cu','8. ¿Cuál es el principal aporte de Frederick W. Taylor a la administración?','Continua','A) El concepto de motivación laboral','B) La teoría de sistemas','C) La administración científica basada en el estudio del trabajo','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('9','1Cu','9. El valor instrumental de la administración significa que:','Continua','A) Es un medio para alcanzar los objetivos de una organización','B) Depende exclusivamente del capital financiero','C) Sirve solo en instituciones privadas','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('11','1Es','La derivada de una función f(x) representa:','Continua','A) El área bajo la curva','B) La tasa de cambio instantánea','C) El volumen de revolución','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('12','1Es','La regla de la potencia establece que:','Continua','A) d/dx[x^n] = x^{n-1}','B) d/dx[x^n] = n x^{n-1}','C) d/dx[x^n] = n x^n','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('13','1Es','La derivada de una constante es:','Continua','A) La misma constante','B) 1','C) 0','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('14','1Es','Geométricamente, f\'(a) es la pendiente de:','Continua','A) La recta secante','B) La recta tangente en x = a','C) La curva en x = a','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('15','1Es','El dominio de cualquier función polinómica es:','Continua','A) Solo números positivos','B) Todos los reales excepto cero','C) Todos los números reales','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('16','1Es','Si f\'(x) > 0 en un intervalo, la función es:','Continua','A) Decreciente','B) Constante','C) Creciente','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('17','1Es','La regla del producto dice que (fg)\' =','Continua','A) f\'g\'','B) f\'g + fg\'','C) fg\' - f\'g','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('18','1Es','En física, la derivada de la posición respecto al tiempo es:','Continua','A) Aceleración','B) Velocidad','C) Fuerza','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('19','1Es','La derivada de f(x) = 5x^4 - 3x^2 + 7 es:','Continua','A) 20x^3 - 6x','B) 20x^3 + 6x','C) 5x^3 - 3x','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('20','1Es','Si f\'(c) = 0, entonces en x = c puede haber:','Continua','A) Máximo, mínimo o punto de inflexión','B) Siempre un máximo','C) Siempre un mínimo','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('21','1Le','Un número primo es aquel que:','Continua','A) Es divisible solo por 1 y por sí mismo','B) Tiene exactamente 3 divisores','C) Es siempre impar','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('22','1Le','La conjetura de Goldbach dice que todo entero par mayor que 2:','Continua','A) Es suma de dos primos','B) Es impar','C) Es potencia de 2','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('23','1Le','En una progresión aritmética, la diferencia entre términos consecutivos es:','Continua','A) Variable','B) Constante','C) Cero','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('24','1Le','La sucesión de Fibonacci comienza:','Continua','A) 0, 1, 1, 2, 3, 5...','B) 1, 1, 2, 3, 5...','C) Ambas son válidas','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('25','1Le','El número áureo φ vale aproximadamente:','Continua','A) 1.414','B) 1.618','C) 2.718','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('26','1Le','En teoría de números, un número perfecto es igual a:','Continua','A) La suma de sus divisores propios','B) La suma de todos sus divisores','C) Su doble','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('27','1Le','El teorema fundamental del álgebra dice que todo polinomio de grado n tiene:','Continua','A) n raíces reales','B) n raíces complejas (contando multiplicidad)','C) Al menos una raíz real','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('28','1Le','El logaritmo natural se denota:','Continua','A) log x','B) ln x','C) lg x','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('29','1Le','La función seno es periódica con periodo:','Continua','A) π','B) 2π','C) 4π','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('30','1Le','En criptografía moderna se usa mucho la factorización de números:','Continua','A) Primos','B) Compuestos grandes','C) Perfectos','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('31','1He','La primera ley de Newton se conoce como ley de:','Continua','A) La acción-reacción','B) La inercia','C) La gravitación','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('32','1He','La unidad de fuerza en el SI es:','Continua','A) Joule','B) Newton','C) Watt','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('33','1He','La energía cinética se calcula como:','Continua','A) mv','B) ½ mv²','C) mgh','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('34','1He','En química, el número de Avogadro es aproximadamente:','Continua','A) 6.022 × 10²³','B) 3.14 × 10⁸','C) 9.8 m/s²','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('35','1He','El pH de una solución neutra es:','Continua','A) 0','B) 7','C) 14','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('36','1He','La ley de Boyle dice que a T constante:','Continua','A) P ∝ V','B) P ∝ 1/V','C) V ∝ T','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('37','1He','El elemento con mayor electronegatividad es:','Continua','A) Oxígeno','B) Flúor','C) Hidrógeno','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('38','1He','La velocidad de la luz en el vacío es:','Continua','A) 3 × 10⁸ m/s','B) 3 × 10⁶ m/s','C) 340 m/s','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('39','1He','En una reacción nuclear, la masa:','Continua','A) Se conserva exactamente','B) Se convierte parcialmente en energía','C) Aumenta','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('40','1He','El principio de Arquímedes se aplica a:','Continua','A) Flotación de cuerpos','B) Caída libre','C) Movimiento circular','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('41','1Ca','Los productores en una cadena trófica son:','Continua','A) Los carnívoros','B) Los organismos fotosintéticos','C) Los descomponedores','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('42','1Ca','Un bioma caracterizado por menos de 25 cm de lluvia al año es:','Continua','A) Taiga','B) Desierto','C) Selva tropical','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('43','1Ca','La sucesión ecológica que comienza en roca desnuda es:','Continua','A) Secundaria','B) Primaria','C) Climática','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('44','1Ca','El efecto invernadero es causado principalmente por:','Continua','A) Ozono','B) CO₂ y metano','C) Oxígeno','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('45','1Ca','La capa de ozono se encuentra en la:','Continua','A) Troposfera','B) Estratosfera','C) Mesosfera','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('46','1Ca','Un ejemplo de relación mutualista es:','Continua','A) Depredador-presa','B) Liquen (alga + hongo)','C) Parásito-hospedador','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('47','1Ca','La biodiversidad es mayor en:','Continua','A) Polos','B) Zonas templadas','C) Trópicos','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('48','1Ca','Los detritívoros son importantes porque:','Continua','A) Producen oxígeno','B) Reciclan materia orgánica','C) Fijan nitrógeno','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('49','1Ca','El calentamiento global provoca:','Continua','A) Disminución del nivel del mar','B) Fusión de glaciares','C) Más lluvias en desiertos','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('50','1Ca','Un ecosistema con alta resiliencia:','Continua','A) Se recupera lento tras perturbación','B) Se recupera rápido','C) Nunca se recupera','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('51','1Go','How do you start a casual conversation?','Continua','A) Goodbye','B) Hi! How are you?','C) Thank you','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('52','1Go','After someone says \"I\'m fine\", you usually say:','Continua','A) Bye','B) And you?','C) No','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('53','1Go','To show interest you can say:','Continua','A) I don\'t care','B) Really? That\'s cool!','C) Whatever','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('54','1Go','A polite way to end a conversation is:','Continua','A) I hate you','B) See you later!','C) Shut up','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('55','1Go','If you didn\'t understand, you say:','Continua','A) What?','B) Can you repeat, please?','C) Never mind','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('56','1Go','To ask about hobbies you say:','Continua','A) What do you do for fun?','B) How much money do you have?','C) Where do you live?','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('57','1Go','A good filler in English is:','Continua','A) Well...','B) Never','C) Always no','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('58','1Go','To react to good news you say:','Continua','A) That\'s terrible','B) Congratulations!','C) I don\'t care','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('59','1Go','The best way to improve speaking is:','Continua','A) Only reading','B) Talking every day','C) Never speaking','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('60','1Go','At B1 level you can:','Continua','A) Only say hello','B) Have real conversations','C) Speak perfectly','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('61','1Ma','En pseudocódigo, ¿cómo se representa una condición?','Continua','A) SI ... ENTONCES ... FIN SI','B) PARA ... HACER ... FIN PARA','C) MIENTRAS ... HACER','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('62','1Ma','Un algoritmo debe tener:','Continua','A) Entrada, proceso y salida','B) Solo entrada','C) Infinidad de pasos','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('63','1Ma','En diagramas de flujo, el rombo representa:','Continua','A) Decisión','B) Proceso','C) Entrada/Salida','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('64','1Ma','La estructura SECUENCIAL ejecuta instrucciones:','Continua','A) Una tras otra','B) Solo si se cumple condición','C) Repetidas veces','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('65','1Ma','¿Cuál NO es un tipo de dato básico?','Continua','A) Entero','B) Cadena','C) Arreglo','3');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('66','1Ma','El bucle WHILE se ejecuta mientras:','Continua','A) La condición sea falsa','B) La condición sea verdadera','C) Siempre','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('67','1Ma','Una variable es:','Continua','A) Un espacio en memoria con nombre','B) Un valor fijo','C) Una función','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('68','1Ma','En programación estructurada se evita:','Continua','A) GOTO','B) IF','C) FOR','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('69','1Ma','Un subprograma también se conoce como:','Continua','A) Función o procedimiento','B) Variable global','C) Ciclo infinito','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('70','1Ma','La modularidad permite:','Continua','A) Dividir el programa en partes más manejables','B) Hacer todo en un solo bloque','C) Eliminar variables','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('71','1Me','¿Cuál es el comando para seleccionar todos los datos de una tabla?','Continua','A) INSERT INTO','B) SELECT * FROM','C) UPDATE','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('72','1Me','Para filtrar resultados se usa:','Continua','A) ORDER BY','B) WHERE','C) GROUP BY','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('73','1Me','El comando para agregar datos es:','Continua','A) SELECT','B) INSERT INTO','C) DELETE','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('74','1Me','Para ordenar resultados ascendentemente:','Continua','A) ORDER BY columna DESC','B) ORDER BY columna ASC','C) SORT BY','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('75','1Me','¿Qué hace INNER JOIN?','Continua','A) Todos los registros','B) Solo los que coinciden en ambas tablas','C) Solo los de la tabla izquierda','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('76','1Me','Para eliminar datos se usa:','Continua','A) DROP','B) DELETE FROM','C) TRUNCATE','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('77','1Me','COUNT(*) devuelve:','Continua','A) El número de filas','B) La suma de una columna','C) El promedio','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('78','1Me','La cláusula HAVING se usa con:','Continua','A) WHERE','B) GROUP BY','C) ORDER BY','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('79','1Me','PRIMARY KEY significa:','Continua','A) Valor único y no nulo','B) Valor que puede repetirse','C) Valor opcional','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('80','1Me','Para crear una tabla se usa:','Continua','A) CREATE TABLE','B) MAKE TABLE','C) NEW TABLE','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('81','1Cu','El bienestar social busca principalmente:','Continua','A) Competencia individual','B) Satisfacción equilibrada de necesidades colectivas e individuales','C) Acumulación de riqueza','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('82','1Cu','Una norma jurídica es obligatoria porque:','Continua','A) La gente quiere cumplirla','B) Está respaldada por el Estado','C) Es tradición','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('83','1Cu','El Estado moderno requiere:','Continua','A) Población, territorio y soberanía','B) Solo territorio','C) Varios gobiernos','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('84','1Cu','La participación política se da mediante:','Continua','A) El voto y la opinión pública','B) Solo el pago de impuestos','C) La educación','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('85','1Cu','Las normas sociales regulan:','Continua','A) Solo el comportamiento económico','B) La convivencia en sociedad','C) Solo castigos','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('86','1Cu','El poder político se ejerce a través de:','Continua','A) Instituciones y leyes','B) Solo la fuerza','C) La religión','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('87','1Cu','La soberanía significa que el Estado:','Continua','A) Depende de otro país','B) No reconoce autoridad superior','C) No tiene territorio','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('88','1Cu','La democracia permite:','Continua','A) Que una persona decida todo','B) Participación ciudadana','C) Solo votación cada 10 años','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('89','1Cu','Los derechos humanos son:','Continua','A) Universales e inalienables','B) Solo para ciudadanos','C) Cambiables por ley','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('90','1Cu','El contrato social es una idea de:','Continua','A) Marx','B) Rousseau','C) Platón','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('91','1Pa','La Constitución es la norma:','Continua','A) Más baja en jerarquía','B) Suprema del Estado','C) Solo para jueces','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('92','1Pa','El principio de separación de poderes es de:','Continua','A) Montesquieu','B) Hobbes','C) Locke','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('93','1Pa','La igualdad ante la ley significa:','Continua','A) Todos tienen los mismos bienes','B) Nadie está por encima de la ley','C) Solo igualdad económica','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('94','1Pa','Un régimen autoritario se caracteriza por:','Continua','A) Libertad de expresión total','B) Concentración del poder','C) Elecciones libres','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('95','1Pa','La globalización afecta principalmente:','Continua','A) Solo la economía','B) Economía, cultura y política','C) Solo el clima','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('96','1Pa','La ciudadanía implica:','Continua','A) Derechos y obligaciones','B) Solo derechos','C) Solo obligaciones','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('97','1Pa','El Estado de derecho significa que:','Continua','A) El gobernante está por encima de la ley','B) Todos están sujetos a la ley','C) No hay leyes','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('98','1Pa','La justicia social busca:','Continua','A) Reducir desigualdades','B) Aumentar diferencias','C) Solo castigar delitos','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('99','1Pa','La ONU se creó en:','Continua','A) 1919','B) 1945','C) 1989','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('100','1Pa','La dignidad humana es la base de:','Continua','A) Los derechos humanos','B) Las leyes económicas','C) Las tradiciones','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('101','1Ar','La Revolución Mexicana inició en:','Continua','A) 1910','B) 1821','C) 1857','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('102','1Ar','El primer presidente de México independiente fue:','Continua','A) Hidalgo','B) Guadalupe Victoria','C) Juárez','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('103','1Ar','La Independencia de México se consumó en:','Continua','A) 1810','B) 1821','C) 1836','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('104','1Ar','Las Leyes de Reforma fueron promulgadas por:','Continua','A) Santa Anna','B) Benito Juárez','C) Porfirio Díaz','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('105','1Ar','El Porfiriato duró aproximadamente:','Continua','A) 10 años','B) 35 años','C) 70 años','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('106','1Ar','El Plan de Ayala fue redactado por:','Continua','A) Madero','B) Zapata','C) Villa','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('107','1Ar','La Constitución de 1917 es considerada:','Continua','A) La primera constitución mexicana','B) La más avanzada socialmente de su época','C) Copia de la de EE.UU.','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('108','1Ar','El asesinato de Francisco I. Madero ocurrió en:','Continua','A) La Decena Trágica','B) El Plan de San Luis','C) La Batalla de Celaya','1');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('109','1Ar','El Tratado de Guadalupe Hidalgo fue en:','Continua','A) 1821','B) 1848','C) 1917','2');
INSERT INTO `preguntas` (`IDPregunta`,`IDPersonajeC`,`Pregunta`,`TipoPreguntaC`,`Opcion1`,`Opcion2`,`Opcion3`,`RespuestaCorrecta`) VALUES ('110','1Ar','¿Quién gritó el Grito de Dolores en 1810?','Continua','A) Morelos','B) Miguel Hidalgo','C) Iturbide','2');

CREATE TABLE `security_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento_tipo` varchar(80) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT '',
  `creado_en` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_evento_tipo` (`evento_tipo`),
  KEY `idx_creado_en` (`creado_en`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('1','LOGIN_FAIL',NULL,'Usuario: admin','::1','2026-07-02 08:15:00');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('2','LOGIN_SUCCESS','1','Usuario: dgeti168 (ID: 1)','::1','2026-07-02 08:15:23');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('3','ADMIN_OTP_SENT','1','OTP enviado a lcadvance40@gmail.com','::1','2026-07-02 08:15:27');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('4','ADMIN_OTP_SUCCESS','1','Verificación 2FA exitosa','::1','2026-07-02 08:15:55');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('5','LOGOUT','1','Usuario ID: 1','::1','2026-07-02 09:36:31');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('6','LOGIN_SUCCESS','1','Usuario: dgeti168 (ID: 1)','::1','2026-07-02 09:37:06');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('7','ADMIN_OTP_SENT','1','OTP enviado a lcadvance40@gmail.com','::1','2026-07-02 09:37:10');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('8','ADMIN_OTP_SUCCESS','1','Verificación 2FA exitosa','::1','2026-07-02 09:37:33');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('9','TIMEOUT','1','Sesión expirada','::1','2026-07-02 10:25:27');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('10','LOGIN_SUCCESS','1','Usuario: dgeti168 (ID: 1)','::1','2026-07-02 10:25:38');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('11','ADMIN_OTP_SENT','1','OTP enviado a lcadvance40@gmail.com','::1','2026-07-02 10:25:43');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('12','ADMIN_OTP_SUCCESS','1','Verificación 2FA exitosa','::1','2026-07-02 10:25:59');
INSERT INTO `security_logs` (`id`,`evento_tipo`,`usuario_id`,`detalle`,`ip`,`creado_en`) VALUES ('13','ADMIN_BACKUP','1','Backup creado: backup_2026-07-02_12-24-01.sql (61741 bytes)','::1','2026-07-02 12:24:02');

CREATE TABLE `settings` (
  `clave` varchar(100) NOT NULL,
  `valor` text DEFAULT NULL,
  `tipo` varchar(20) DEFAULT 'text',
  `descripcion` varchar(255) DEFAULT NULL,
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `settings` (`clave`,`valor`,`tipo`,`descripcion`,`actualizado_en`) VALUES ('maintenance_message','Estamos realizando tareas de mantenimiento. Volvemos pronto.','text','Mensaje mostrado en modo mantenimiento','2026-07-02 12:11:13');
INSERT INTO `settings` (`clave`,`valor`,`tipo`,`descripcion`,`actualizado_en`) VALUES ('maintenance_mode','0','boolean','Activar modo mantenimiento (bloquea acceso a usuarios no-admin)','2026-07-02 12:11:13');
INSERT INTO `settings` (`clave`,`valor`,`tipo`,`descripcion`,`actualizado_en`) VALUES ('max_weekly_lessons','0','number','Límite semanal de lecciones (0 = sin límite)','2026-07-02 12:11:13');
INSERT INTO `settings` (`clave`,`valor`,`tipo`,`descripcion`,`actualizado_en`) VALUES ('points_per_lesson','50','number','Puntos base por completar lección','2026-07-02 12:11:13');
INSERT INTO `settings` (`clave`,`valor`,`tipo`,`descripcion`,`actualizado_en`) VALUES ('registration_enabled','1','boolean','Permitir registro de nuevos usuarios','2026-07-02 12:11:13');
INSERT INTO `settings` (`clave`,`valor`,`tipo`,`descripcion`,`actualizado_en`) VALUES ('xp_per_quiz_correct','10','number','XP por respuesta correcta en quiz','2026-07-02 12:11:13');

CREATE TABLE `user_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `score` int(11) DEFAULT 0,
  `lesson_xp` int(11) DEFAULT 0,
  `completed` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_lesson` (`user_id`,`slug`),
  KEY `idx_user_progress_user_id` (`user_id`),
  KEY `idx_user_progress_slug` (`slug`),
  CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena_hash` varchar(255) NOT NULL,
  `avatar` varchar(100) DEFAULT 'default.png',
  `puntos` int(11) DEFAULT 0,
  `nivel` int(11) DEFAULT 1,
  `google_id` varchar(255) DEFAULT NULL,
  `github_id` varchar(255) DEFAULT NULL,
  `genero` enum('M','W') DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires` timestamp NULL DEFAULT NULL,
  `tipo` enum('student','teacher','admin') NOT NULL DEFAULT 'student',
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verify_token` varchar(128) DEFAULT NULL,
  `ultimo_login` date DEFAULT NULL,
  `racha_actual` int(11) NOT NULL DEFAULT 0,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `notas_admin` text DEFAULT NULL,
  `twofa_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `twofa_secret` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `google_id` (`google_id`),
  UNIQUE KEY `github_id` (`github_id`),
  KEY `idx_usuarios_puntos` (`puntos`),
  KEY `idx_usuarios_nivel` (`nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`,`nombre_usuario`,`correo`,`contrasena_hash`,`avatar`,`puntos`,`nivel`,`google_id`,`github_id`,`genero`,`otp_code`,`otp_expires`,`tipo`,`email_verified`,`email_verify_token`,`ultimo_login`,`racha_actual`,`creado_en`,`notas_admin`,`twofa_enabled`,`twofa_secret`) VALUES ('1','dgeti168','lcadvance40@gmail.com','$2y$10$7/.MgzuvL4HFTmkD4KXCh.gxCekGquKJgeXfUCNueYOevNth3g.NW','default.png','0','1',NULL,NULL,NULL,NULL,NULL,'admin','1',NULL,'2026-07-02','0','2026-07-02 08:13:11',NULL,'0',NULL);

CREATE TABLE `usuarios_badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `obtenido_en` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`,`badge_id`),
  KEY `badge_id` (`badge_id`),
  CONSTRAINT `usuarios_badges_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `usuarios_badges_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



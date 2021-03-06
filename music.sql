CREATE TABLE `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `bio` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
INSERT INTO `artists` VALUES (1,'Lewis Capaldi','2019-07-21',''),(2,'Post Malone','2019-09-27',''),(3,'Justin Bieber, Quavo','2020-01-02','');
CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `releaseDate` date NOT NULL,
  `artwork` varchar(100) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `songs` (`name`),
  UNIQUE KEY `image` (`artwork`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
INSERT INTO `songs` VALUES (1,'Someone you Loved','2019-07-21','20062022173415SomeoneYouLoved.jpg',1,0),(2,'Circles','2019-09-27','20062022173433circles.jpg',2,0),(3,'Intentions','2020-01-02','20062022173452intentions.jpg',3,0);
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
INSERT INTO `users` VALUES (1,'sharath','$2y$10$BGH2YmllWZaMQj5w83agdu1tVUkw/fH0PfaXce5uEoeK3Npbmfs6.','2022-06-20 15:27:40');

USE jarditou;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE utilisateurs(
    'uti_id' INT NOT NULL AUTO_INCREMENT,
    'nom' VARCHAR(50) NOT NULL,
    'prenom' VARCHAR(50) NOT NULL,
    'email' VARCHAR (50) NOT NULL,
    'pseudo' VARCHAR(50) NOT NULL,
    'password' VARCHAR(50) NOT NULL,
    `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(uti_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;
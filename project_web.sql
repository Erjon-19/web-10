SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- 
--
CREATE DATABASE IF NOT EXISTS `project_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project_web`;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `usr` varchar(20) NOT NULL,
  `psw` varchar(20) NOT NULL,
  PRIMARY KEY (`usr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `admin`
--

INSERT INTO `admin` (`usr`, `psw`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `curve`
--

CREATE TABLE IF NOT EXISTS `curve` (
  `time_v` int(11) NOT NULL,
  `dvalue` double(20,10) NOT NULL,
  `id_polyg` int(11) NOT NULL,
  KEY `id_polyg` (`id_polyg`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `polygon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `population` int(11) NOT NULL,
  `places` int(11) NOT NULL,
  `coords` text NOT NULL,
  `center` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87866 ;


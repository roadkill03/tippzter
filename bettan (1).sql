-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Tid vid skapande: 21 feb 2016 kl 20:17
-- Serverversion: 5.6.21
-- PHP-version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `bettan`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `bets`
--

CREATE TABLE IF NOT EXISTS `bets` (
`bet_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `goal_home` int(11) NOT NULL,
  `goal_away` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `bets`
--

INSERT INTO `bets` (`bet_id`, `game_id`, `user_id`, `tournament_id`, `goal_home`, `goal_away`) VALUES
(9, 1, 5, 7, 2, 1),
(10, 2, 5, 7, 5, 3),
(11, 1, 7, 7, 2, 2),
(12, 2, 7, 7, 5, 0),
(13, 3, 5, 7, 3, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur `extra_bets`
--

CREATE TABLE IF NOT EXISTS `extra_bets` (
`extra_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `winning_team` int(11) NOT NULL,
  `winning_player` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `extra_bets`
--

INSERT INTO `extra_bets` (`extra_id`, `user_id`, `tournament_id`, `winning_team`, `winning_player`) VALUES
(1, 5, 7, 22, 'Zlatan Ibrahimovic'),
(2, 7, 7, 22, 'Christiano Ronaldo'),
(3, 5, 6, 29, 'Zlatan Ibrahimovic');

-- --------------------------------------------------------

--
-- Tabellstruktur `game_match`
--

CREATE TABLE IF NOT EXISTS `game_match` (
`game_id` int(11) NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `game_start` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `game_match`
--

INSERT INTO `game_match` (`game_id`, `home_team_id`, `away_team_id`, `game_start`) VALUES
(1, 23, 24, '2016-01-08 21:00:00'),
(2, 22, 25, '2016-01-09 15:00:00'),
(3, 29, 28, '2016-06-11 18:00:00'),
(4, 26, 27, '2016-06-11 21:00:00'),
(5, 37, 34, '2016-06-12 15:00:00'),
(6, 32, 31, '2016-06-12 18:00:00'),
(7, 30, 33, '2016-06-12 21:00:00'),
(8, 36, 35, '2016-06-13 15:00:00'),
(9, 40, 41, '2016-06-13 18:00:00'),
(10, 38, 39, '2016-06-13 21:00:00'),
(11, 42, 43, '2016-06-14 18:00:00'),
(12, 45, 44, '2016-06-14 21:00:00'),
(13, 27, 28, '2016-06-15 15:00:00'),
(14, 24, 25, '2016-06-15 18:00:00'),
(15, 23, 22, '2016-06-15 21:00:00'),
(16, 26, 29, '2016-06-16 15:00:00'),
(17, 33, 31, '2016-06-16 18:00:00'),
(18, 30, 32, '2016-06-16 21:00:00'),
(19, 39, 41, '2016-06-17 15:00:00'),
(20, 35, 34, '2016-06-17 18:00:00'),
(21, 36, 37, '2016-06-17 21:00:00'),
(22, 38, 40, '2016-06-18 15:00:00'),
(23, 44, 43, '2016-06-18 18:00:00'),
(24, 45, 42, '2016-06-18 21:00:00'),
(25, 25, 23, '2016-06-19 21:00:00'),
(26, 24, 22, '2016-06-19 21:00:00'),
(27, 28, 26, '2016-06-20 21:00:00'),
(28, 27, 29, '2016-06-20 21:00:00'),
(29, 31, 30, '2016-06-21 18:00:00'),
(30, 33, 32, '2016-06-21 18:00:00'),
(31, 34, 36, '2016-06-21 21:00:00'),
(32, 35, 37, '2016-06-21 21:00:00'),
(33, 44, 42, '2016-06-22 18:00:00'),
(34, 43, 45, '2016-06-22 18:00:00'),
(35, 41, 38, '2016-06-22 21:00:00'),
(36, 39, 40, '2016-06-22 21:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `goals`
--

CREATE TABLE IF NOT EXISTS `goals` (
`goal_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `goal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `results`
--

CREATE TABLE IF NOT EXISTS `results` (
`result_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `result_goal_home` int(11) NOT NULL,
  `result_goal_away` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `results`
--

INSERT INTO `results` (`result_id`, `game_id`, `result_goal_home`, `result_goal_away`) VALUES
(45, 1, 5, 5),
(46, 2, 5, 3),
(47, 3, 2, 2),
(48, 15, 5, 0),
(49, 26, 1, 3),
(50, 9, 2, 3),
(51, 7, 1, 2),
(52, 4, 4, 4),
(53, 5, 3, 4),
(54, 6, 2, 1),
(55, 11, 2, 2),
(56, 8, 5, 0),
(57, 10, 2, 1),
(58, 16, 1, 0),
(59, 12, 3, 1),
(60, 13, 1, 1),
(61, 14, 3, 2),
(62, 17, 3, 4),
(63, 18, 1, 2),
(64, 19, 2, 2),
(65, 20, 3, 5),
(66, 21, 2, 2),
(67, 22, 2, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `results_extra`
--

CREATE TABLE IF NOT EXISTS `results_extra` (
`results_extra_id` int(11) NOT NULL,
  `winner_team` int(11) NOT NULL,
  `winner_player` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `results_extra`
--

INSERT INTO `results_extra` (`results_extra_id`, `winner_team`, `winner_player`) VALUES
(3, 22, 'Zlatan Ibrahimovic');

-- --------------------------------------------------------

--
-- Tabellstruktur `slutspel`
--

CREATE TABLE IF NOT EXISTS `slutspel` (
`slutspel_id` int(11) NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `game_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `slutspel`
--

INSERT INTO `slutspel` (`slutspel_id`, `home_team_id`, `away_team_id`, `game_date`) VALUES
(1, 23, 34, '2016-06-25 15:00:00'),
(2, 0, 0, '2016-06-25 18:00:00'),
(3, 0, 0, '2016-06-25 21:00:00'),
(4, 0, 0, '2016-06-26 15:00:00'),
(5, 0, 0, '2016-06-26 18:00:00'),
(6, 0, 0, '2016-06-26 21:00:00'),
(7, 0, 0, '2016-06-27 18:00:00'),
(8, 0, 0, '2016-06-27 21:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `slutspel_bets`
--

CREATE TABLE IF NOT EXISTS `slutspel_bets` (
`slutspel_bet_id` int(11) NOT NULL,
  `slutspel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `goal_home` int(11) NOT NULL,
  `goal_away` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `slutspel_result`
--

CREATE TABLE IF NOT EXISTS `slutspel_result` (
`slutspel_result_id` int(11) NOT NULL,
  `slutspel_id` int(11) NOT NULL,
  `result_goal_home` int(11) NOT NULL,
  `result_goal_away` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `slutspel_result`
--

INSERT INTO `slutspel_result` (`slutspel_result_id`, `slutspel_id`, `result_goal_home`, `result_goal_away`) VALUES
(3, 1, 3, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
`team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `group_nr` varchar(255) NOT NULL,
  `team_flag` varchar(255) NOT NULL,
  `team_points` int(11) NOT NULL,
  `plus_goals` int(11) NOT NULL,
  `minus_goals` int(11) NOT NULL,
  `goal_diff` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `group_nr`, `team_flag`, `team_points`, `plus_goals`, `minus_goals`, `goal_diff`) VALUES
(22, 'Albanien', 'A', 'ALB.png', 6, 8, 9, -1),
(23, 'Frankrike', 'A', 'FRA.png', 4, 10, 5, 5),
(24, 'Rumänien', 'A', 'ROU.png', 3, 5, 10, -5),
(25, 'Schweiz', 'A', 'SUI.png', 0, 5, 8, -3),
(26, 'England', 'B', 'ENG.png', 4, 5, 4, 1),
(27, 'Ryssland', 'B', 'RUS.png', 2, 5, 5, 0),
(28, 'Slovakien', 'B', 'SVK.png', 2, 3, 3, 0),
(29, 'Wales', 'B', 'WAL.png', 1, 2, 3, -1),
(30, 'Tyskland', 'C', 'GER.png', 0, 2, 4, -2),
(31, 'Nordirland', 'C', 'NIR.png', 3, 5, 5, 0),
(32, 'Polen', 'C', 'POL.png', 6, 4, 2, 2),
(33, 'Ukraina', 'C', 'UKR.png', 3, 5, 5, 0),
(34, 'Kroatien', 'D', 'CRO.png', 6, 9, 6, 3),
(35, 'Tjeckoslovakien', 'D', 'CZE.png', 0, 3, 10, -7),
(36, 'Spanien', 'D', 'ESP.png', 4, 7, 2, 5),
(37, 'Turkiet', 'D', 'TUR.png', 1, 5, 6, -1),
(38, 'Belgien', 'E', 'BEL.png', 6, 4, 2, 2),
(39, 'Italien', 'E', 'ITA.png', 1, 3, 4, -1),
(40, 'Irland', 'E', 'IRL.png', 0, 3, 5, -2),
(41, 'Sverige', 'E', 'SWE.png', 4, 5, 4, 1),
(42, 'Österrike', 'F', 'AUT.png', 1, 2, 2, 0),
(43, 'Ungern', 'F', 'HUN.png', 1, 2, 2, 0),
(44, 'Island', 'F', 'ISL.png', 0, 1, 3, -2),
(45, 'Portugal', 'F', 'POR.png', 3, 3, 1, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
`tournament_id` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tournament_text` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `tournament`
--

INSERT INTO `tournament` (`tournament_id`, `tournament_name`, `user_id`, `tournament_text`) VALUES
(2, 'Eriks Liga', 7, 'Tjenare mannen!'),
(3, 'Lisa Hawks', 1, ''),
(4, 'Galna gänget', 1, ''),
(5, 'Goofy', 1, ''),
(7, 'Snoopy', 5, ''),
(8, 'Den där skumma ligan', 7, 'Detta är en test för att betta!!'),
(9, 'Ballabollen', 5, '');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `admin` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `admin`) VALUES
(1, 'lisaadmin', 'drug6bAx!', 'lisahjarpe@hotmail.com', 'true'),
(5, 'lisafisa', 'drug6bAx!', 'lisahjarpe@gmail.com', 'false'),
(7, 'erik', 'hiho1234', 'erik.elmehed@live.se', 'false');

-- --------------------------------------------------------

--
-- Tabellstruktur `user_tournaments`
--

CREATE TABLE IF NOT EXISTS `user_tournaments` (
`user_tournaments_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `user_points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `user_tournaments`
--

INSERT INTO `user_tournaments` (`user_tournaments_id`, `user_id`, `user_name`, `tournament_id`, `user_points`) VALUES
(1, 7, 'erik', 2, 0),
(2, 1, 'lisaadmin', 3, 0),
(3, 1, 'lisaadmin', 4, 0),
(4, 1, 'lisaadmin', 5, 0),
(5, 5, 'lisafisa', 6, 30),
(6, 5, 'lisafisa', 7, 95),
(7, 7, 'erik', 8, 0),
(8, 5, 'lisafisa', 9, 0),
(9, 7, 'erik', 7, 60);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `bets`
--
ALTER TABLE `bets`
 ADD PRIMARY KEY (`bet_id`), ADD UNIQUE KEY `bet_id` (`bet_id`);

--
-- Index för tabell `extra_bets`
--
ALTER TABLE `extra_bets`
 ADD PRIMARY KEY (`extra_id`);

--
-- Index för tabell `game_match`
--
ALTER TABLE `game_match`
 ADD PRIMARY KEY (`game_id`);

--
-- Index för tabell `goals`
--
ALTER TABLE `goals`
 ADD PRIMARY KEY (`goal_id`);

--
-- Index för tabell `results`
--
ALTER TABLE `results`
 ADD PRIMARY KEY (`result_id`);

--
-- Index för tabell `results_extra`
--
ALTER TABLE `results_extra`
 ADD PRIMARY KEY (`results_extra_id`);

--
-- Index för tabell `slutspel`
--
ALTER TABLE `slutspel`
 ADD PRIMARY KEY (`slutspel_id`);

--
-- Index för tabell `slutspel_bets`
--
ALTER TABLE `slutspel_bets`
 ADD PRIMARY KEY (`slutspel_bet_id`);

--
-- Index för tabell `slutspel_result`
--
ALTER TABLE `slutspel_result`
 ADD PRIMARY KEY (`slutspel_result_id`);

--
-- Index för tabell `teams`
--
ALTER TABLE `teams`
 ADD PRIMARY KEY (`team_id`), ADD UNIQUE KEY `team_id` (`team_id`);

--
-- Index för tabell `tournament`
--
ALTER TABLE `tournament`
 ADD PRIMARY KEY (`tournament_id`), ADD UNIQUE KEY `tournament_id` (`tournament_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_id` (`user_id`,`user_name`);

--
-- Index för tabell `user_tournaments`
--
ALTER TABLE `user_tournaments`
 ADD PRIMARY KEY (`user_tournaments_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `bets`
--
ALTER TABLE `bets`
MODIFY `bet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT för tabell `extra_bets`
--
ALTER TABLE `extra_bets`
MODIFY `extra_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `game_match`
--
ALTER TABLE `game_match`
MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT för tabell `goals`
--
ALTER TABLE `goals`
MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `results`
--
ALTER TABLE `results`
MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT för tabell `results_extra`
--
ALTER TABLE `results_extra`
MODIFY `results_extra_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `slutspel`
--
ALTER TABLE `slutspel`
MODIFY `slutspel_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT för tabell `slutspel_bets`
--
ALTER TABLE `slutspel_bets`
MODIFY `slutspel_bet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `slutspel_result`
--
ALTER TABLE `slutspel_result`
MODIFY `slutspel_result_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `teams`
--
ALTER TABLE `teams`
MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT för tabell `tournament`
--
ALTER TABLE `tournament`
MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT för tabell `user_tournaments`
--
ALTER TABLE `user_tournaments`
MODIFY `user_tournaments_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

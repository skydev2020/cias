-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2020 at 02:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cias`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `swimming` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`swimming`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `customer_id`, `name`, `date_start`, `date_end`, `date_added`, `swimming`) VALUES
(1, 1, 'Test Object', '2020-02-01', '2020-02-02', '2020-02-08', '{\r\n    \"TimeOfDay\": \"9:35\",\r\n    \"EventName\": \"GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventRecord\": \"\",\r\n    \"EventNumber\": 2,\r\n    \"HeatNumber\": 1,\r\n    \"Lengths\": 8,\r\n    \"RunningTime\": \"  :49.8 \",\r\n    \"HomeScore\": 0,\r\n    \"Guest1Score\": 0,\r\n    \"Guest2Score\": 0,\r\n    \"Guest3Score\": 0,\r\n    \"Mod15\": \"\",\r\n    \"ScoreboardCurrentState\": 3,\r\n    \"ExportLiveResults\": true,\r\n    \"EventHeatName\": \"Event: 2 Heat: 1 - GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventNumberName\": \"2: GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"LaneAthleteTeam\": [\r\n      {\r\n        \"LaneID\": 1,\r\n        \"LaneNumber\": \"1\",\r\n        \"AthleteName\": \"RMYO  C\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 2,\r\n        \"LaneNumber\": \"2\",\r\n        \"AthleteName\": \"RCNT  B\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 3,\r\n        \"LaneNumber\": \"3\",\r\n        \"AthleteName\": \"RMYO  A\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 4,\r\n        \"LaneNumber\": \"4\",\r\n        \"AthleteName\": \"RCNT  A\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 5,\r\n        \"LaneNumber\": \"5\",\r\n        \"AthleteName\": \"RMYO  B\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 6,\r\n        \"LaneNumber\": \"6\",\r\n        \"AthleteName\": \"RCNT  C\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 7,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 8,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 9,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 10,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      }\r\n    ]\r\n  }'),
(3, 1, 'Olympic', '2020-02-01', '2020-02-02', '2020-02-08', '{\r\n    \"TimeOfDay\": \"9:35\",\r\n    \"EventName\": \"GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventRecord\": \"\",\r\n    \"EventNumber\": 2,\r\n    \"HeatNumber\": 1,\r\n    \"Lengths\": 8,\r\n    \"RunningTime\": \"  :49.8 \",\r\n    \"HomeScore\": 0,\r\n    \"Guest1Score\": 0,\r\n    \"Guest2Score\": 0,\r\n    \"Guest3Score\": 0,\r\n    \"Mod15\": \"\",\r\n    \"ScoreboardCurrentState\": 3,\r\n    \"ExportLiveResults\": true,\r\n    \"EventHeatName\": \"Event: 2 Heat: 1 - GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventNumberName\": \"2: GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"LaneAthleteTeam\": [\r\n      {\r\n        \"LaneID\": 1,\r\n        \"LaneNumber\": \"1\",\r\n        \"AthleteName\": \"RMYO  C\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 2,\r\n        \"LaneNumber\": \"2\",\r\n        \"AthleteName\": \"RCNT  B\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 3,\r\n        \"LaneNumber\": \"3\",\r\n        \"AthleteName\": \"RMYO  A\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 4,\r\n        \"LaneNumber\": \"4\",\r\n        \"AthleteName\": \"RCNT  A\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 5,\r\n        \"LaneNumber\": \"5\",\r\n        \"AthleteName\": \"RMYO  B\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 6,\r\n        \"LaneNumber\": \"6\",\r\n        \"AthleteName\": \"RCNT  C\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 7,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 8,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 9,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 10,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      }\r\n    ]\r\n  }'),
(4, 1, 'World Cup', '2020-02-01', '2020-02-02', '2020-02-08', '{\r\n    \"TimeOfDay\": \"9:35\",\r\n    \"EventName\": \"GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventRecord\": \"\",\r\n    \"EventNumber\": 2,\r\n    \"HeatNumber\": 1,\r\n    \"Lengths\": 8,\r\n    \"RunningTime\": \"  :49.8 \",\r\n    \"HomeScore\": 0,\r\n    \"Guest1Score\": 0,\r\n    \"Guest2Score\": 0,\r\n    \"Guest3Score\": 0,\r\n    \"Mod15\": \"\",\r\n    \"ScoreboardCurrentState\": 3,\r\n    \"ExportLiveResults\": true,\r\n    \"EventHeatName\": \"Event: 2 Heat: 1 - GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventNumberName\": \"2: GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"LaneAthleteTeam\": [\r\n      {\r\n        \"LaneID\": 1,\r\n        \"LaneNumber\": \"1\",\r\n        \"AthleteName\": \"RMYO  C\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 2,\r\n        \"LaneNumber\": \"2\",\r\n        \"AthleteName\": \"RCNT  B\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 3,\r\n        \"LaneNumber\": \"3\",\r\n        \"AthleteName\": \"RMYO  A\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 4,\r\n        \"LaneNumber\": \"4\",\r\n        \"AthleteName\": \"RCNT  A\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 5,\r\n        \"LaneNumber\": \"5\",\r\n        \"AthleteName\": \"RMYO  B\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 6,\r\n        \"LaneNumber\": \"6\",\r\n        \"AthleteName\": \"RCNT  C\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 7,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 8,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 9,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 10,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      }\r\n    ]\r\n  }'),
(5, 1, 'Youth Women', '2020-02-01', '2020-02-02', '2020-02-08', '{\r\n    \"TimeOfDay\": \"9:35\",\r\n    \"EventName\": \"GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventRecord\": \"\",\r\n    \"EventNumber\": 2,\r\n    \"HeatNumber\": 1,\r\n    \"Lengths\": 8,\r\n    \"RunningTime\": \"  :49.8 \",\r\n    \"HomeScore\": 0,\r\n    \"Guest1Score\": 0,\r\n    \"Guest2Score\": 0,\r\n    \"Guest3Score\": 0,\r\n    \"Mod15\": \"\",\r\n    \"ScoreboardCurrentState\": 3,\r\n    \"ExportLiveResults\": true,\r\n    \"EventHeatName\": \"Event: 2 Heat: 1 - GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"EventNumberName\": \"2: GIRLS 200 MEDLEY RELAY VARSITY\",\r\n    \"LaneAthleteTeam\": [\r\n      {\r\n        \"LaneID\": 1,\r\n        \"LaneNumber\": \"1\",\r\n        \"AthleteName\": \"RMYO  C\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 2,\r\n        \"LaneNumber\": \"2\",\r\n        \"AthleteName\": \"RCNT  B\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 3,\r\n        \"LaneNumber\": \"3\",\r\n        \"AthleteName\": \"RMYO  A\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 4,\r\n        \"LaneNumber\": \"4\",\r\n        \"AthleteName\": \"RCNT  A\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 5,\r\n        \"LaneNumber\": \"5\",\r\n        \"AthleteName\": \"RMYO  B\",\r\n        \"Team\": \"RMYO\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 6,\r\n        \"LaneNumber\": \"6\",\r\n        \"AthleteName\": \"RCNT  C\",\r\n        \"Team\": \"RCNT\",\r\n        \"SplitTime\": \".\",\r\n        \"FinalTime\": \"  :49.8 \",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 7,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 8,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 9,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      },\r\n      {\r\n        \"LaneID\": 10,\r\n        \"LaneNumber\": \" \",\r\n        \"AthleteName\": \"\",\r\n        \"Team\": \"\",\r\n        \"SplitTime\": \"\",\r\n        \"FinalTime\": \"\",\r\n        \"Place\": \" \",\r\n        \"Firstname\": \"\",\r\n        \"Middlename\": \"\",\r\n        \"Lastname\": \"\"\r\n      }\r\n    ]\r\n  }');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-05 00:54:00'),
(2, 2, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Manager\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-05 00:54:40'),
(3, 3, '{\"role\":\"3\",\"roleText\":\"Employee\",\"name\":\"Employee\"}', '127.0.0.1', 'Edge 17.17134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/17.17134', 'Windows 10', '2020-02-05 00:56:48'),
(4, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-06 16:29:06'),
(5, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-06 16:41:04'),
(6, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-06 16:42:47'),
(7, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-06 16:49:35'),
(8, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-06 16:49:36'),
(9, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-06 16:51:29'),
(10, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-06 20:28:10'),
(11, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-07 06:33:43'),
(12, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-07 18:35:07'),
(13, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-07 21:35:33'),
(14, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-07 21:35:57'),
(15, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 06:14:04'),
(16, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 06:16:18'),
(17, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 06:17:11'),
(18, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 06:17:34'),
(19, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 06:27:15'),
(20, 2, '{\"role\":\"2\",\"roleText\":null,\"name\":\"Manager\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 07:39:05'),
(21, 2, '{\"role\":\"2\",\"roleText\":null,\"name\":\"Manager\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 08:00:52'),
(22, 2, '{\"role\":\"2\",\"roleText\":null,\"name\":\"Manager\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 08:41:40'),
(23, 1, '{\"role\":\"1\",\"roleText\":null,\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 08:44:19'),
(24, 1, '{\"role\":\"1\",\"roleText\":null,\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 10:48:20'),
(25, 1, '{\"role\":\"1\",\"roleText\":null,\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 10:52:35'),
(26, 2, '{\"role\":\"2\",\"roleText\":null,\"name\":\"Manager\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-08 21:31:12'),
(27, 1, '{\"role\":\"1\",\"roleText\":null,\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-09 02:10:18'),
(28, 1, '{\"role\":\"1\",\"roleText\":null,\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-09 02:14:20'),
(29, 1, '{\"role\":\"1\",\"roleText\":null,\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-09 04:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Employee'),
(3, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `verification_code` tinytext NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isVerified`, `verification_code`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@example.com', '$2y$10$6NOKhXKiR2SAgpFF2WpCkuRgYKlSqFJaqM0NgIM3PT1gKHEM5/SM6', 'System Administrator', '9890098900', 1, 1, '', 0, 0, '2015-07-01 18:56:49', 1, '2020-02-08 03:30:56'),
(2, 'manager@example.com', '$2y$10$6NOKhXKiR2SAgpFF2WpCkuRgYKlSqFJaqM0NgIM3PT1gKHEM5/SM6', 'Manager', '9890098900', 2, 1, '', 0, 1, '2016-12-09 17:49:56', 1, '2020-02-08 00:42:22'),
(3, 'employee@example.com', '$2y$10$1okjuMFMa177dw/YOeqRIuhvl.gOsk9cnem/Ih7vn78iN3erJ1Gw.', '345123', '9890098900', 3, 1, '', 0, 1, '2016-12-09 17:50:22', 1, '2020-02-07 19:16:51'),
(43, 'manager3@example.com', '$2y$10$lCX4ecgiWK99LCe/sdFBcedPPAR.9nIIWL86UHUi9TpHLOgwgqsQ6', 'A', '9890098900', 0, 0, '17442646515e3fb20ba669b6.14509027', 0, 0, '2020-02-09 08:17:31', NULL, NULL),
(51, 'skyteam2019@outlook.com', '$2y$10$wkuFsbXMQ.7t5gVcNcgau.hFQ.ktfbn14RwjsQ4JE16JdWxMRQpiS', '234', '9890098900', 0, 1, '', 0, 0, '2020-02-09 13:34:27', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

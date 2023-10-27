-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 03:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `badmintonclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminPhoto` varchar(100) NOT NULL DEFAULT 'IMG-64186f4a115801.93357402.jpg',
  `adminID` varchar(20) NOT NULL,
  `adminPassword` varchar(30) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `adminEmail` varchar(100) NOT NULL,
  `adminGender` varchar(1) NOT NULL,
  `adminPhone` varchar(15) NOT NULL,
  `superAdmin` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminPhoto`, `adminID`, `adminPassword`, `adminName`, `adminEmail`, `adminGender`, `adminPhone`, `superAdmin`, `Status`) VALUES
('A22019-644e202f529c46.20280153.jpg', 'A22019', 'A220191!', 'Sia Wei Hang', 'siaweihang@gmail.com', 'M', '011-1028 8158', 1, 1),
('A22020-6450fb3114a4c5.75952553.jpg', 'A22020', 'A1234567', 'Lew Kai Wen', 'TheLew@gmail.com', 'M', '012-234 5678', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coachbooking`
--

CREATE TABLE `coachbooking` (
  `StudentName` varchar(50) NOT NULL,
  `StudentID` char(10) NOT NULL,
  `PhoneNumber` char(14) NOT NULL,
  `StudentEmail` varchar(30) NOT NULL,
  `CoachID` char(4) NOT NULL,
  `Time` char(12) NOT NULL,
  `EndTrain` date NOT NULL,
  `Payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coachbooking`
--

INSERT INTO `coachbooking` (`StudentName`, `StudentID`, `PhoneNumber`, `StudentEmail`, `CoachID`, `Time`, `EndTrain`, `Payment`) VALUES
('Lin Chen Ying', '22WMD01234', '012-372 2618', 'lincy-wm22@student.tarc.edu.my', 'C001', '7.30 ~ 9.00', '2023-06-13', '22WMD01234-6450f90ab21d59.70950614.jpg'),
('Sia Wei Hang', '22WMD01517', '012-345 6783', 'siawh-wm22@student.tarc.edu.my', 'C001', '6.00 ~ 7.30', '2023-06-06', '22WMD01517-644fc90214d7c4.16634179.jpg'),
('Sim Kai An', '22WMD01733', '012-345 6789', 'simka-wm22@student.tarc.edu.my', 'C001', '6.00 ~ 7.30', '2023-05-30', '22WMD01733-643fb46c86e024.12976354.png');

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `CoachID` char(4) NOT NULL,
  `CoachName` varchar(30) NOT NULL,
  `CoachProfile` text NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` char(1) NOT NULL,
  `BirthDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`CoachID`, `CoachName`, `CoachProfile`, `Age`, `Gender`, `BirthDate`) VALUES
('C001', 'Ow Kah Rok', 'KR.jpeg', 22, 'M', '2001-11-08'),
('C002', 'Kenneph Ooi Wei Jie', 'KEN.jpeg', 20, 'M', '2003-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `coachrewards`
--

CREATE TABLE `coachrewards` (
  `RewardID` int(11) NOT NULL,
  `CoachID` char(4) NOT NULL,
  `Rewards` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coachrewards`
--

INSERT INTO `coachrewards` (`RewardID`, `CoachID`, `Rewards`) VALUES
(1, 'C001', '2019 Men\'s Single Tournament Champion'),
(2, 'C001', '2019 Men\'s Doubles Tournament Runner-up'),
(3, 'C001', '2020 Shell Open Men\'s Single Champion'),
(4, 'C001', '2020 Winter All Open Men\'s Single Runner-up'),
(5, 'C001', '2021 Spring Open Men\'s Doubles Third Place'),
(6, 'C001', '2022 KAIEN Fight Men\'s Single Champion'),
(7, 'C002', '2020 Shell Open Men\'s Single Runner-up'),
(8, 'C002', '2020 Winter All Open Men\'s Single Third Place'),
(9, 'C002', '2021 Spring Open Men\'s Doubles Champion'),
(10, 'C002', '2022 KAIEN Fight Men\'s Single Runner-up'),
(11, 'C002', '2022 Machos Men\'s Doubles Champion');

-- --------------------------------------------------------

--
-- Table structure for table `eventbooking`
--

CREATE TABLE `eventbooking` (
  `EB_ID` int(11) NOT NULL,
  `StudentID` char(10) NOT NULL,
  `StudentName` varchar(30) NOT NULL,
  `Payment` text NOT NULL,
  `EventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `eventbooking`
--

INSERT INTO `eventbooking` (`EB_ID`, `StudentID`, `StudentName`, `Payment`, `EventID`) VALUES
(1, '22WMD01517', 'Sia Wei Hang', 'skdjkal.jpg', 5),
(7, '22WMD01733', 'Sim Kai An', '22WMD01733-643fbc09344345.60895352.png', 13),
(13, '22WMD01517', 'Sia Wei Hang', '22WMD01517-6450f823ac0388.67456650.jpg', 14),
(14, '22WMD01517', 'Sia Wei Hang', '22WMD01517-6450f8329092c8.38868155.jpg', 13),
(15, '22WMD01517', 'Sia Wei Hang', '22WMD01517-6450f841bb8591.01205924.jpg', 12),
(16, '22WMD01517', 'Sia Wei Hang', '22WMD01517-6450f858911db5.35309107.png', 11),
(17, '22WMD01234', 'Lin Chen Ying', '22WMD01234-6450f89d5cf7b4.69646623.png', 14),
(18, '22WMD01234', 'Lin Chen Ying', '22WMD01234-6450f8c5822379.77017962.jpg', 13),
(19, '22WMD01234', 'Lin Chen Ying', '22WMD01234-6450f8de3a44a8.97257525.jpg', 12),
(20, '22WMD01234', 'Lin Chen Ying', '22WMD01234-6450f8e9677cc5.06143544.jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `eventdetails`
--

CREATE TABLE `eventdetails` (
  `EventID` int(11) NOT NULL,
  `EventPoster` char(50) NOT NULL,
  `EventName` char(100) NOT NULL,
  `Venue` varchar(100) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Max` int(11) NOT NULL,
  `EventDetails` varchar(1000) NOT NULL,
  `Fee` int(11) NOT NULL,
  `Availability` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `eventdetails`
--

INSERT INTO `eventdetails` (`EventID`, `EventPoster`, `EventName`, `Venue`, `StartDate`, `EndDate`, `StartTime`, `EndTime`, `Max`, `EventDetails`, `Fee`, `Availability`) VALUES
(1, 'past.jpg', 'Badminton Tournament Championship', 'Sport Complex TARUC', '2019-10-14', '2019-10-15', '10:00:00', '15:00:00', 50, 'A Badminton Tournament Championship is a high-level competition in which the best players from different regions or countries compete to win the championship title. The championship could be organized by various organizations, such as the Badminton World Federation, national badminton associations, or private companies. The tournament could feature both singles and doubles events for men and women, and players would need to go through several rounds to reach the final.The championship could attract top-ranked players, including Olympic and World champions, who would showcase their skills, tactics, and sportsmanship in front of a global audience. Spectators would witness thrilling rallies, impressive smashes, and acrobatic dives, as players strive to outscore their opponents. The tournament could also provide a platform for emerging players to gain recognition, gain experience, and earn ranking points.', 40, 0),
(2, '2020past1.jpg', 'Men\'s Badminton Tournament', 'Sport Complex TARUC', '2020-04-03', '2020-04-09', '11:00:00', '16:00:00', 80, 'A men\'s badminton tournament is a highly competitive event where male players come together to showcase their skills in the sport of badminton. The tournament is usually conducted in a series of rounds, with players being eliminated in each round until the winner is decided. The tournament format can vary depending on the number of participants, with the most common formats being single-elimination, double-elimination, round-robin, and Swiss-system tournaments. Before the tournament, the players are seeded based on their rankings, which are determined by their past performances in tournaments or league matches. The top-seeded players are given a bye in the first round and do not have to play until the second round. During the tournament, each match is typically played as a best-of-three games, with each game being played to 21 points. The winner of each game is the first player to reach 21 points, with a two-point lead required to win. If the score reaches 20-20, the game continues unt', 35, 0),
(3, '2020past2.jpg', 'BBA Badminton Tournament', 'Sport Complex TARUC', '2020-08-18', '2020-08-20', '10:00:00', '14:00:00', 60, 'It is likely that the BBA Badminton Tournament is also a badminton tournament organized by the TARUC Badminton Club at the Sport Complex TARUC in Malaysia.\r\nLike the FAB Badminton Tournament, the BBA Badminton Tournament could be open to players of all skill levels and could feature both singles and doubles events for men and women. As a campus-based tournament, the BBA Badminton Tournament could attract a range of participants, including students, faculty members, and staff. The tournament could be an excellent opportunity for players to showcase their skills, compete against their peers, and build relationships with other badminton enthusiasts on campus.', 45, 0),
(4, '2020past3.jpg', 'FAB Badminton Tournament', 'Sport Complex TARUC', '2020-11-16', '2020-11-19', '09:00:00', '14:00:00', 80, 'The FAB Badminton Tournament is likely a badminton tournament organized by the TARUC Badminton Club, which is a badminton club based at the Tunku Abdul Rahman University College (TARUC) in Malaysia. The tournament is likely held at the Sport Complex TARUC, which is a sports facility located on the campus of the university college.\r\nThe tournament is likely open to players of all skill levels and could feature both singles and doubles events for men and women. As a campus-based tournament, the FAB Badminton Tournament could attract a range of participants, from casual players to competitive athletes. The tournament provides an excellent opportunity for students to showcase their skills, gain experience, and build camaraderie with other badminton enthusiasts on their campus.', 30, 0),
(5, '2021past1.jpg', 'Badminton Team Tournament', 'Sport Complex TARUC', '2021-06-05', '2021-06-06', '11:00:00', '15:00:00', 60, 'A badminton team tournament is a competitive event where multiple teams of players compete against each other to determine the best team. Typically, team tournaments involve teams of three or four players representing their club, organization, or country. The matches are usually played in a round-robin format, where each team plays against every other team in the tournament. Points are awarded for each match won, and the team with the highest number of points at the end of the tournament is declared the winner. Team tournaments often generate a high level of excitement and energy, as the players are not only representing themselves but their team as well. They provide an opportunity for players to showcase their skills and compete in a team environment, which can be a unique and rewarding experience.', 25, 0),
(6, '2021past2.jpg', 'SAA Badminton Tournament', 'SXCCE Indoor Badminton Court', '2021-09-25', '2021-09-27', '10:00:00', '13:30:00', 50, 'The SAA Badminton Tournament is likely a badminton tournament organized by a campus badminton club at a particular college or university. The tournament is an excellent opportunity for the members of the badminton club to compete against each other in a friendly and supportive environment.\r\nThe tournament may feature both men\'s and women\'s singles and doubles events and could be open to players of all skill levels. It is usually held on the campus of the college or university, with the matches being played in the badminton facility of the school\'s athletic center or gymnasium\r\nThe SAA Badminton Tournament provides an excellent opportunity for students to showcase their skills, gain experience, and build camaraderie with other badminton enthusiasts on their campus.', 50, 0),
(7, '2021past3.jpg', 'Analis Badminton Cup 2021', 'Sport Complex TARUC', '2021-12-10', '2021-12-11', '09:00:00', '14:00:00', 40, 'The Analis Badminton Cup 2021 is a badminton tournament that was held in Indonesia in August 2021. The tournament was organized by Analis, a company that specializes in the production of badminton equipment and aimed to promote the sport of badminton in Indonesia.\r\nThe tournament featured both men\'s and women\'s singles and doubles events and attracted a strong field of players from Indonesia and other countries. The matches were played at the Gelora Bung Karno Sports Complex in Jakarta, Indonesia, which is a renowned sporting venue in the country.\r\nThe Analis Badminton Cup 2021 was a highly competitive event, with players vying for prize money and ranking points. The tournament provided an excellent platform for players to showcase their skills and gain recognition, and helped to raise the profile of badminton in Indonesia.', 60, 0),
(8, '2022past1.jpg', 'Expatriate Badminton Championship', 'Desa Petaling Sport Complex', '2022-06-18', '2022-06-21', '14:00:00', '18:00:00', 60, 'The Expatriate Badminton Championship is a badminton tournament that brings together expatriates living in a foreign country to compete against each other. The tournament is typically organized by local expat communities and aims to promote cultural exchange, camaraderie, and sportsmanship among expats.\r\nThe championship is usually open to players of all skill levels and attracts a diverse range of players from different countries and backgrounds. The tournament typically involves multiple rounds of matches, with players being eliminated in each round until a winner is declared.\r\nThe Expatriate Badminton Championship provides an excellent opportunity for expats to meet new people, make friends, and participate in a fun and competitive sporting event. The tournament is an excellent way to stay active and engaged while living abroad and provides a unique cultural experience. Expatriate Badminton Championship also helps to foster a sense of community among expats and promotes cross-cultur', 40, 0),
(9, '2022past2.jpg', 'Singapore Badminton Open 2022', 'Singapore Indoor Stadium', '2022-07-12', '2022-07-17', '18:00:00', '22:00:00', 20, 'The Singapore Badminton Open 2022 is a major badminton tournament that will be held in Singapore in 2022. The tournament is part of the Badminton World Federation (BWF) World Tour, which features top badminton players from around the world. The Singapore Badminton Open attracts a strong field of players and offers significant ranking points, making it a highly competitive event.\r\nThe tournament is scheduled to take place in April 2022 and will feature both men\'s and women\'s singles and doubles events. The matches will be played at the Singapore Indoor Stadium, which has hosted many major sporting events in the past. The Singapore Badminton Open 2022 promises to be an exciting event, with fans eagerly anticipating the performances of their favorite players and teams.', 100, 0),
(10, '2022past3.jpg', 'NRY Badminton Tournament', 'Setapak Badminton Centre', '2022-11-09', '2022-11-16', '16:00:00', '20:00:00', 50, 'The NRY Badminton Tournament is a sporting event organized by NRY (New Rock Youth) , a youth organization that promotes sports and fitness among young people. The tournament is designed to provide a platform for young badminton players to showcase their skills and compete against each other in a friendly and supportive environment.The tournament usually involves multiple rounds of matches, with players being paired randomly or with their friends to form teams. The tournament is open to players of all skill levels, from beginners to advanced players.The NRY Badminton Tournament is an excellent opportunity for young players to gain experience, build their confidence, and make new friends within the badminton community. The tournament helps to promote sportsmanship, teamwork, and a healthy lifestyle among young people, encouraging them to stay active and engaged in their community.', 40, 0),
(11, 'professionalmatch.jpg', 'Badminton Professional Tournament', 'Stadium Bukit Jalil', '2023-05-02', '2023-05-05', '13:00:00', '17:00:00', 30, 'A Badminton Professional Tournament is a highly competitive event that brings together the world\'s top badminton players. These tournaments are organized by the Badminton World Federation (BWF) and feature a series of competitions that take place throughout the year. Professional tournaments are designed to provide players with a platform to showcase their skills and compete for prize money and ranking points.\r\nProfessional tournaments follow a rigorous schedule that involves multiple rounds of matches, with players being eliminated in each round until a winner is declared. The tournaments use a range of formats, including single-elimination, double-elimination, and round-robin formats.\r\nThe Badminton Professional Tournament is a major event in the sport of badminton, and it attracts a significant audience of fans and media attention. It provides an opportunity for players to demonstrate their talent, gain recognition, and earn a living by playing the sport they love. The tournament al', 50, 1),
(12, 'internationalmatch.jpg', 'Badminton International Tournament', 'Sport Complex TARUMT', '2023-08-20', '2023-08-22', '10:30:00', '14:30:00', 40, 'A Badminton International Tournament is a major event that features the world\'s top badminton players competing against each other. The tournament is typically organized by the Badminton World Federation (BWF) and attracts players from all over the world. The tournament is held at different locations each year and usually involves multiple rounds of matches, with players being eliminated in each round until a winner is determined. The Badminton International Tournament is highly competitive and attracts a large audience of badminton fans. It provides an excellent platform for players to showcase their skills, gain international recognition, and earn ranking points towards their world rankings.', 80, 1),
(13, 'internalmatch.jpg', 'Badminton Internal Tournament', 'Sport Complex TARUMT', '2023-07-02', '2023-07-05', '18:00:00', '21:00:00', 60, 'A Badminton Internal Tournament is a competition held within a specific organization or institution, such as a company, school, or club. The tournament is typically designed for members of the organization to compete against each other, creating a fun and competitive atmosphere within the group.\r\nThe format of the tournament can vary depending on the number of participants, but it typically involves multiple rounds of matches, with winners advancing to the next round and losers being eliminated. The tournament can be organized as a single-elimination, double-elimination, or round-robin format.\r\nThe Badminton Internal Tournament provides an opportunity for members of the organization to showcase their skills and compete against their peers. It also helps to promote teamwork and camaraderie within the organization, bringing members together in a shared passion for the sport of badminton.', 30, 1),
(14, 'friendlymatch.jpg', 'Badminton friendship Tournament', 'Sport Complex TARUMT', '2023-06-16', '2023-06-20', '18:00:00', '21:00:00', 60, 'A Badminton Friendship Tournament is a sporting event that is organized to foster friendship and promote the spirit of sportsmanship among badminton players. Unlike competitive tournaments, this event is usually more relaxed and focused on building social connections and strengthening relationships between players.In a Badminton Friendship Tournament, players are usually paired up randomly or with their friends to form teams. The teams then play against each other in a friendly and supportive environment, with the focus on having fun and enjoying the game rather than winning or losing.The tournament typically involves several rounds of matches, with each match being played in a friendly and supportive atmosphere. Players are encouraged to cheer each other on and help each other improve their skills.The Badminton Friendship Tournament is an excellent opportunity for players to meet new people, make new friends, and network with other players in the badminton community. The event h', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Faculty` char(4) NOT NULL,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`ID`, `Name`, `Email`, `Faculty`, `Message`) VALUES
(1, 'Sia', 'sia@dsadji.vmc', 'VDSA', 'ASDASDASDASDAS'),
(17, 'Valarie', 'siawh-wm22@student.tarc.edu.my', 'FOET', 'asdasdasdasdasd'),
(18, 'Sim Kai An', 'simka-wm22@student.tarc.edu.my', 'FOCS', 'I love badminton'),
(19, 'Lin Chen Ying', 'lincy-wm22@student.tarc.edu.my', 'FOCS', 'I like swimming'),
(20, 'Lew Kai Wen', 'lewkw-wm22@student.tarc.edu.my', 'FOCS', 'I\'m a macho man!');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `StudentID` varchar(10) NOT NULL,
  `StudentProfile` text NOT NULL DEFAULT 'IMG-64186f4a115801.93357402.jpg',
  `StudentName` varchar(50) NOT NULL,
  `Gender` char(1) NOT NULL,
  `StudentEmail` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`StudentID`, `StudentProfile`, `StudentName`, `Gender`, `StudentEmail`, `Password`, `Status`) VALUES
('22WMD01234', 'IMG-64186f4a115801.93357402.jpg', 'Lin Chen Ying', 'F', 'lincy-wm22@student.tarc.edu.my', 'cfba44509949126fe22b4c83c27c209b4813d17f', 1),
('22WMD01333', 'IMG-64216dacb6d444.28216401.jpg', 'Pang Zhen Xian', 'M', 'pangzx-wm22@student.tarc.edu.m', 'd84b335c15e75b759cfffbeb7748f2a6c8f538a1', 1),
('22WMD01517', 'IMG-64216cae4c4d25.26295212.jpeg', 'Sia Wei Hang', 'M', 'siawh-wm22@student.tarc.edu.my', 'b98624bb94ee59914368218b3ad6fc8be7ae3a99', 1),
('22WMD01653', 'IMG-641c1e688d2709.04493301.jpeg', 'Lew Kai Wen', 'M', 'lewkw-wm22@student.tarc.edu.my', 'cff8d67551677984903f7d35c24745d0a5ce29e6', 1),
('22WMD01660', 'IMG-64186f4a115801.93357402.jpg', 'Law Seong Chun', 'M', 'lawsc-wm22@student.tarc.edu.my', '4807cc9def4356727afc68a4e498679c79204bfc', 1),
('22WMD01733', 'IMG-641b14f863df85.24442825.jpeg', 'Sim Kai An', 'M', 'simka-wm22@student.tarc.edu.my', '77677521cd3965ab1415541d5e0932d878c5cbc0', 1),
('22WMD01746', 'IMG-64238563142658.45160418.jpeg', 'Ow Kah Rok', 'M', 'owkr-wm22@student.tarc.edu.my', 'dbc71db12f2a3e4ec6b5a7ac3082405e5ba64d96', 1),
('22WMD01761', 'IMG-64237a24d4d070.41877894.jpg', 'tcw', 'F', 'tcw@gmail.com', '734aac163ad6aa5b75aa2e8de356c5af5a4583c0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `adminID` (`adminID`),
  ADD UNIQUE KEY `adminEmail` (`adminEmail`),
  ADD UNIQUE KEY `adminPhone` (`adminPhone`);

--
-- Indexes for table `coachbooking`
--
ALTER TABLE `coachbooking`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `StudentID` (`StudentID`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`),
  ADD UNIQUE KEY `StudentEmail` (`StudentEmail`),
  ADD KEY `StudentID_2` (`StudentID`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`CoachID`),
  ADD UNIQUE KEY `CoachID` (`CoachID`),
  ADD KEY `CoachID_2` (`CoachID`);

--
-- Indexes for table `coachrewards`
--
ALTER TABLE `coachrewards`
  ADD PRIMARY KEY (`RewardID`);

--
-- Indexes for table `eventbooking`
--
ALTER TABLE `eventbooking`
  ADD PRIMARY KEY (`EB_ID`),
  ADD UNIQUE KEY `EB_ID` (`EB_ID`),
  ADD KEY `EB_ID_2` (`EB_ID`);

--
-- Indexes for table `eventdetails`
--
ALTER TABLE `eventdetails`
  ADD PRIMARY KEY (`EventID`),
  ADD UNIQUE KEY `EventID` (`EventID`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `ID_2` (`ID`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `StudentID` (`StudentID`),
  ADD UNIQUE KEY `StudentEmail` (`StudentEmail`),
  ADD KEY `StudentID_2` (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coachrewards`
--
ALTER TABLE `coachrewards`
  MODIFY `RewardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `eventbooking`
--
ALTER TABLE `eventbooking`
  MODIFY `EB_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `eventdetails`
--
ALTER TABLE `eventdetails`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cse442_542_2019_summer_teamb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `StudentTeams`
--

CREATE TABLE IF NOT EXISTS `StudentTeams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teamid` (`teamid`),
  KEY `studentid` (`studentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `StudentTeams`
--

INSERT INTO `StudentTeams` (`id`, `teamid`, `studentid`) VALUES
(1, 14, 1),
(2, 14, 3),
(3, 15, 2),
(4, 15, 4),
(6, 16, 2),
(7, 17, 3),
(8, 17, 4),
(9, 16, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `StudentTeams`
--
ALTER TABLE `StudentTeams`
  ADD CONSTRAINT `student_id_fk` FOREIGN KEY (`studentid`) REFERENCES `Logininfo` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teamid_fk` FOREIGN KEY (`teamid`) REFERENCES `Teams` (`teamid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

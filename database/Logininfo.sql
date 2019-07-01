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
-- Table structure for table `Logininfo`
--

CREATE TABLE IF NOT EXISTS `Logininfo` (
  `studentid` int(11) NOT NULL AUTO_INCREMENT,
  `studentname` varchar(32) NOT NULL,
  `emailaddress` varchar(32) NOT NULL,
  PRIMARY KEY (`studentid`),
  KEY `emailaddress` (`emailaddress`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Logininfo`
--

INSERT INTO `Logininfo` (`studentid`, `studentname`, `emailaddress`) VALUES
(1, 'Shikhar Chaure', 'schaure@buffalo.edu'),
(2, 'Lingbo Hu', 'lingbohu@buffalo.edu'),
(3, 'Amanda Pellechia', 'aepellec@buffalo.edu'),
(4, 'Matthew Hertz', 'mhertz@buffalo.edu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

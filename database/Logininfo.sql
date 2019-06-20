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
  `confirmationcode` varchar(50) DEFAULT NULL,
  `coursrenumber` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`studentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Logininfo`
--

INSERT INTO `Logininfo` (`studentid`, `studentname`, `emailaddress`, `confirmationcode`, `coursrenumber`) VALUES
(1, 'Shikhar Chaure', 'schaure@buffalo.edu', 'H5EYcCf+Vr2ShiaFUrKueCcMhvWxB0zT', 'CSE542'),
(2, 'Lingbo Hu', 'lingbohu@buffalo.edu', 'H5EYciShU7yWgSGHBLKueCcMgP+yAEDQ', 'CSE542'),
(3, 'Amanda Pellechia', 'aepellec@buffalo.edu', 'H5EYdXf+VrrPgyGNALKueCcMhf62A0HU', 'CSE542'),
(4, 'Matthew Hertz', 'mhertz@buffalo.edu', NULL, 'CSE542');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

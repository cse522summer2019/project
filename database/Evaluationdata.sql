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
-- Table structure for table `Evaluationdata`
--

CREATE TABLE IF NOT EXISTS `Evaluationdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `role` int(1) DEFAULT NULL,
  `leadership` int(1) DEFAULT NULL,
  `participation` int(1) DEFAULT NULL,
  `professionalism` int(1) DEFAULT NULL,
  `quality` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `studentid` (`studentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Evaluationdata`
--

INSERT INTO `Evaluationdata` (`id`, `studentid`, `role`, `leadership`, `participation`, `professionalism`, `quality`) VALUES
(1, 4, NULL, NULL, NULL, NULL, NULL),
(2, 3, NULL, NULL, NULL, NULL, NULL),
(3, 2, NULL, NULL, NULL, NULL, NULL),
(4, 1, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Evaluationdata`
--
ALTER TABLE `Evaluationdata`
  ADD CONSTRAINT `Evaluationdata_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `Logininfo` (`studentid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

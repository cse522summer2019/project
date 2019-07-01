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
  `Evaluator` int(11) NOT NULL,
  `role` int(1) DEFAULT NULL,
  `leadership` int(1) DEFAULT NULL,
  `participation` int(1) DEFAULT NULL,
  `professionalism` int(1) DEFAULT NULL,
  `quality` int(1) DEFAULT NULL,
  `courseid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `studentid` (`studentid`),
  KEY `EvalStudent` (`Evaluator`),
  KEY `courseid` (`courseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `Evaluationdata`
--

INSERT INTO `Evaluationdata` (`id`, `studentid`, `Evaluator`, `role`, `leadership`, `participation`, `professionalism`, `quality`, `courseid`) VALUES
(22, 4, 4, 2, 0, 1, 2, 2, 1),
(29, 3, 3, 3, 3, 3, 3, 3, 1),
(30, 1, 3, 0, 0, 0, 0, 3, 1),
(40, 3, 3, 1, 2, 2, 2, 0, 2),
(41, 2, 3, 2, 2, 2, 1, 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Evaluationdata`
--
ALTER TABLE `Evaluationdata`
  ADD CONSTRAINT `Evaluationdata_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `Courses` (`courseid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Evaluationdata_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `Logininfo` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

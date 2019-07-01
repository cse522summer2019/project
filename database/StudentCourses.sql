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
-- Table structure for table `StudentCourses`
--

CREATE TABLE IF NOT EXISTS `StudentCourses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `confirmationcode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `studentid` (`studentid`),
  KEY `confirmationcode` (`confirmationcode`),
  KEY `courseid` (`courseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `StudentCourses`
--

INSERT INTO `StudentCourses` (`id`, `studentid`, `courseid`, `confirmationcode`) VALUES
(1, 1, 1, 'H5EZIyXwUO+WhHaCBrKueCcNi/63CU3W'),
(2, 2, 1, ''),
(3, 3, 1, 'H5EZIyD0V7+W0HXXDLKueCcOgve1Akbd'),
(4, 4, 1, ''),
(5, 1, 2, 'H5EZIyX/BezOhCeFDLKueCcNi/62A0bX'),
(6, 2, 2, ''),
(8, 4, 3, ''),
(9, 3, 2, 'H5EZIyehALjFhijXVrKueCcOgve2A0LU');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `StudentCourses`
--
ALTER TABLE `StudentCourses`
  ADD CONSTRAINT `StudentCourses_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `Logininfo` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StudentCourses_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `Courses` (`courseid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

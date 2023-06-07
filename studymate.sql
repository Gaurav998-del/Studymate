-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 12:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knowledgehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `abuseword`
--

CREATE TABLE `abuseword` (
  `ab_id` int(11) NOT NULL,
  `a_word` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `abuseword`
--

INSERT INTO `abuseword` (`ab_id`, `a_word`) VALUES
(1, 'porn'),
(2, 'bitch'),
(3, 'kiss'),
(4, 'asshole'),
(5, 'fuckoff'),
(6, 'sonoofbitch');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `on`) VALUES
('admin@studymate.com', '99dcaea79885b8606afc556adc464f036bbd41a9', '2018-08-13 08:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `awardedbadges`
--

CREATE TABLE `awardedbadges` (
  `awardId` int(11) NOT NULL,
  `badgeId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `awnserreplies`
--

CREATE TABLE `awnserreplies` (
  `arid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `qaid` int(11) NOT NULL,
  `reply` text NOT NULL,
  `votes` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `awnsers`
--

CREATE TABLE `awnsers` (
  `qaid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `description` text NOT NULL,
  `votes` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `badgeId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badgeId`, `name`, `type`, `description`, `priority`, `value`, `on`) VALUES
(1, 'Favorite', 1, 'Question voted by <value> users ', 3, 25, '2018-08-06 11:30:14'),
(2, 'Nice Question', 1, 'Question score of <value> or more ', 3, 10, '2018-08-06 11:31:04'),
(3, 'Good Question', 1, 'Question score of <value> or more', 3, 25, '2018-08-06 11:33:56'),
(4, 'Great Question', 1, 'Question score of <value> or more', 3, 100, '2018-08-06 11:36:31'),
(5, 'Popular Question', 1, 'Question with <value> views', 1, 1000, '2018-08-06 11:42:11'),
(6, 'Scholar', 1, 'Ask a question and accept an answer', 3, 0, '2018-08-06 11:44:37'),
(7, 'Student', 1, 'First question with score of <value> or more', 3, 1, '2018-08-06 11:45:01'),
(9, 'Guru', 2, 'Answer and score of <value> or more', 3, 40, '2018-08-06 11:46:59'),
(10, 'Nice Answer', 2, 'Answer score of <value> or more', 3, 10, '2018-08-06 11:48:28'),
(11, 'Good Answer', 2, 'Answer score of <value> or more ', 3, 25, '2018-08-06 11:48:46'),
(12, 'Great Answer', 2, 'Answer score of <value> or more', 2, 100, '2018-08-06 11:50:13'),
(13, 'Self-Learner', 2, 'Answer your own question with score of <value> or more', 3, 3, '2018-08-06 11:50:35'),
(14, 'Teacher', 2, 'Answer a question with score of <value> or more ', 3, 1, '2018-08-06 11:51:02'),
(15, 'Autobiographer', 3, 'Complete \"About Me\" section of user profile', 3, 0, '2018-08-06 11:52:22'),
(16, 'Commentator', 3, 'Leave <value> comments', 3, 10, '2018-08-06 11:52:41'),
(17, 'Pundit', 3, 'Leave <value> comments with score of 5 or more', 3, 5, '2018-08-06 11:53:12'),
(19, 'Yearling', 3, 'Active member for a year, earning at least <value> reputation', 1, 200, '2018-08-06 11:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(30) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `blog_category` varchar(20) NOT NULL,
  `blog_date` date NOT NULL,
  `blog_description` mediumtext NOT NULL,
  `thumbnail` varchar(20) NOT NULL,
  `main_image` varchar(20) NOT NULL,
  `tags` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permalink` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `name`, `permalink`, `description`, `status`, `on`) VALUES
(69, 'Operating System', 'Operating System', 'Operating System', 1, '2020-02-25 19:54:44'),
(70, 'Programming', '@Programming', 'C programming is one the subject which has a high weight in Competitive exams like GATE . It&#39;s not just important for GATE but also for recruitment exams for various IT and software companies .', 1, '2020-02-26 19:27:31'),
(71, 'ComputerOrganization', 'Computer organization', 'Computer Organization and Architecture is the study of internal working, structuring and implementation of a computer system. Architecture in computer system, same as anywhere else, refers to the externally visual attributes of the system.', 1, '2020-02-26 19:46:16'),
(72, 'Data Structure', 'Data Structure', 'In computer science, a data structure is a data organization, management, and storage format that enables efficient access and modification.', 0, '2020-02-26 19:47:42'),
(73, 'DBMS', 'DBMS', 'A database management system (DBMS) is a software package designed to define, manipulate, retrieve and manage data in a database.', 1, '2020-02-26 19:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `editedquestionslist`
--

CREATE TABLE `editedquestionslist` (
  `eqlId` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `aid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `uid` int(11) NOT NULL,
  `score_u` float NOT NULL DEFAULT 0,
  `rid` int(11) NOT NULL,
  `qn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_cate`
--

CREATE TABLE `exam_cate` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_cate`
--

INSERT INTO `exam_cate` (`cid`, `category_name`) VALUES
(1, 'Math'),
(3, 'quiz'),
(4, 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `exam_level`
--

CREATE TABLE `exam_level` (
  `lid` int(11) NOT NULL,
  `level_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_level`
--

INSERT INTO `exam_level` (`lid`, `level_name`) VALUES
(1, 'Easy'),
(3, 'Hard');

-- --------------------------------------------------------

--
-- Table structure for table `exam_options`
--

CREATE TABLE `exam_options` (
  `oid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `q_option_match` varchar(1000) DEFAULT NULL,
  `q_option1` text NOT NULL,
  `score` float NOT NULL DEFAULT 0,
  `q_option_match1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_options`
--

INSERT INTO `exam_options` (`oid`, `qid`, `q_option`, `q_option_match`, `q_option1`, `score`, `q_option_match1`) VALUES
(9, 3, 'a', NULL, '', 1, ''),
(10, 3, 'b', NULL, '', 0, ''),
(11, 3, 'c', NULL, '', 0, ''),
(12, 3, 'd', NULL, '', 0, ''),
(13, 4, '4', NULL, '', 1, ''),
(14, 4, '6', NULL, '', 0, ''),
(15, 4, '8', NULL, '', 0, ''),
(16, 4, '10', NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `exam_qbank`
--

CREATE TABLE `exam_qbank` (
  `qid` int(11) NOT NULL,
  `question_type` varchar(100) NOT NULL DEFAULT 'Multiple Choice Single Answer',
  `question` text NOT NULL,
  `description` text NOT NULL,
  `question1` text DEFAULT NULL,
  `description1` text DEFAULT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `no_time_served` int(11) NOT NULL DEFAULT 0,
  `no_time_corrected` int(11) NOT NULL DEFAULT 0,
  `no_time_incorrected` int(11) NOT NULL DEFAULT 0,
  `no_time_unattempted` int(11) NOT NULL DEFAULT 0,
  `inserted_by` int(11) NOT NULL,
  `inserted_by_name` varchar(100) DEFAULT NULL,
  `paragraph` text DEFAULT NULL,
  `paragraph1` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_qbank`
--

INSERT INTO `exam_qbank` (`qid`, `question_type`, `question`, `description`, `question1`, `description1`, `cid`, `lid`, `no_time_served`, `no_time_corrected`, `no_time_incorrected`, `no_time_unattempted`, `inserted_by`, `inserted_by_name`, `paragraph`, `paragraph1`, `parent_id`) VALUES
(3, 'Multiple Choice Single Answer', 'What is maths?', 'About MAths', NULL, NULL, 3, 1, 8, 0, 0, 8, 1, 'Studymate', NULL, NULL, 0),
(4, 'Multiple Choice Single Answer', 'what is 2+2', 'What is 2+2', NULL, NULL, 1, 1, 7, 0, 0, 7, 1, 'Studymate', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_qcl`
--

CREATE TABLE `exam_qcl` (
  `qcl_id` int(11) NOT NULL,
  `quid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `noq` int(11) NOT NULL,
  `i_correct` text NOT NULL,
  `i_incorrect` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_quiz`
--

CREATE TABLE `exam_quiz` (
  `quid` int(11) NOT NULL,
  `quiz_name` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `gids` text NOT NULL,
  `qids` text NOT NULL,
  `noq` int(11) NOT NULL,
  `correct_score` text NOT NULL,
  `incorrect_score` text NOT NULL,
  `ip_address` text NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 10,
  `maximum_attempts` int(11) NOT NULL DEFAULT 1,
  `pass_percentage` float NOT NULL DEFAULT 50,
  `view_answer` int(11) NOT NULL DEFAULT 1,
  `camera_req` int(11) NOT NULL DEFAULT 1,
  `question_selection` int(11) NOT NULL DEFAULT 1,
  `gen_certificate` int(11) NOT NULL DEFAULT 0,
  `certificate_text` text DEFAULT NULL,
  `with_login` int(11) NOT NULL DEFAULT 1,
  `quiz_template` varchar(100) NOT NULL DEFAULT 'Default',
  `uids` varchar(1000) DEFAULT NULL,
  `inserted_by` int(11) NOT NULL DEFAULT 1,
  `inserted_by_name` varchar(100) DEFAULT 'Admin',
  `show_chart_rank` int(11) NOT NULL DEFAULT 1,
  `quiz_price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_quiz`
--

INSERT INTO `exam_quiz` (`quid`, `quiz_name`, `description`, `start_date`, `end_date`, `gids`, `qids`, `noq`, `correct_score`, `incorrect_score`, `ip_address`, `duration`, `maximum_attempts`, `pass_percentage`, `view_answer`, `camera_req`, `question_selection`, `gen_certificate`, `certificate_text`, `with_login`, `quiz_template`, `uids`, `inserted_by`, `inserted_by_name`, `show_chart_rank`, `quiz_price`) VALUES
(1, 'Demo', 'Demo First', 1589174722, 1620710722, '1', '3', 1, '', '', '', 10, 10, 50, 1, 0, 0, 0, NULL, 1, 'Default', NULL, 1, 'Studymate', 1, 0),
(2, 'Ilts Maths', 'Maths exam for ilts', 1590842885, 1622378885, '1', '3', 1, '1', '0', '', 10, 10, 50, 1, 0, 0, 0, NULL, 1, 'Default', NULL, 1, 'Studymate', 1, 0),
(3, 'New Exam', 'Demo', 1590843713, 1622379713, '1', '4,3', 2, '1,1', '0.5,0.5', '', 10, 10, 50, 1, 0, 0, 0, NULL, 1, 'Default', NULL, 1, 'Studymate', 1, 0),
(4, 'Demo MAths', 'Maths Demo', 1589174722, 1620710722, '1', '4,3', 2, '1,1', '0,0', '', 10, 10, 50, 1, 0, 0, 0, NULL, 1, 'Default', NULL, 1, 'Studymate', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_result`
--

CREATE TABLE `exam_result` (
  `rid` int(11) NOT NULL,
  `quid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `result_status` varchar(100) NOT NULL DEFAULT 'Open',
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `categories` text NOT NULL,
  `category_range` text NOT NULL,
  `r_qids` text NOT NULL,
  `individual_time` text NOT NULL,
  `total_time` int(11) NOT NULL DEFAULT 0,
  `score_obtained` float NOT NULL DEFAULT 0,
  `percentage_obtained` float NOT NULL DEFAULT 0,
  `attempted_ip` varchar(100) NOT NULL,
  `score_individual` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `manual_valuation` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_result`
--

INSERT INTO `exam_result` (`rid`, `quid`, `uid`, `result_status`, `start_time`, `end_time`, `categories`, `category_range`, `r_qids`, `individual_time`, `total_time`, `score_obtained`, `percentage_obtained`, `attempted_ip`, `score_individual`, `photo`, `manual_valuation`) VALUES
(3, 4, 1, 'Fail', 1590848049, 1590848776, 'Math,quiz', '1,1', '4,3', '0,0', 0, 0, 0, '::1', '0,0', '', 0),
(4, 3, 1, 'Fail', 1590848786, 1590904556, 'Math,quiz', '1,1', '4,3', '0,0', 0, 0, 0, '::1', '0,0', '', 0),
(5, 4, 1, 'Fail', 1590904599, 1590904766, 'Math,quiz', '1,1', '4,3', '0,0', 0, 0, 0, '::1', '0,0', '', 0),
(6, 3, 1, 'Fail', 1590908444, 1590908461, 'Math,quiz', '1,1', '4,3', '0,0', 0, 0, 0, '::1', '0,0', '', 0),
(7, 2, 1, 'Fail', 1590908548, 1590908558, 'quiz', '1', '3', '0', 0, 0, 0, '::1', '0', '', 0),
(8, 3, 1, 'Fail', 1590908572, 1590908647, 'Math,quiz', '1,1', '4,3', '0,0', 0, 0, 0, '::1', '0,0', '', 0),
(9, 3, 1, 'Fail', 1590908827, 1590908845, 'Math,quiz', '1,1', '4,3', '0,0', 0, 0, 0, '::1', '0,0', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forgothashes`
--

CREATE TABLE `forgothashes` (
  `userid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_permalink` varchar(200) NOT NULL,
  `job_category` varchar(20) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `job_type` varchar(20) NOT NULL,
  `job_experience` varchar(20) NOT NULL,
  `technologies` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `salary` varchar(20) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `companylocation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `nid` int(11) NOT NULL,
  `nsId` int(11) NOT NULL,
  `for` int(11) NOT NULL,
  `by` int(11) DEFAULT NULL,
  `qid` int(11) DEFAULT NULL,
  `qaid` int(11) DEFAULT NULL,
  `qrid` int(11) DEFAULT NULL,
  `arid` int(11) DEFAULT NULL,
  `badgeId` int(11) DEFAULT NULL,
  `repId` int(11) DEFAULT NULL,
  `read` int(10) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notificationschema`
--

CREATE TABLE `notificationschema` (
  `nsId` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(100) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notificationschema`
--

INSERT INTO `notificationschema` (`nsId`, `title`, `description`, `permalink`, `on`) VALUES
(1, 'Received an answer on your question', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:06:35'),
(2, 'Received a reply on your question', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:07:30'),
(3, 'Received a reply on your answer', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:07:58'),
(4, 'Your question was edited', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:13:48'),
(5, 'Your question was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:12'),
(6, 'Your answer was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:24'),
(7, 'Your answer reply was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:56'),
(8, 'Your question reply was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:15:17'),
(9, 'Your question reply was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:15:33'),
(10, 'Your answer reply was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:15:39'),
(11, 'Badge received', 'You received a badge (badgeName)', 'profile/(userid)', '2018-08-28 07:16:56'),
(12, 'Reputation Change', 'You earned a reputation (reputation)', 'profile/(userid)', '2018-08-28 07:17:58'),
(13, 'Your question was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:40:04'),
(14, 'Your answer was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:40:04'),
(15, 'Your answer reply was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `qt`
--

CREATE TABLE `qt` (
  `title` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qt`
--

INSERT INTO `qt` (`title`) VALUES
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-p'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-cut-and-fail'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-a-algorithm'),
('what-is-cut-and-fail'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-a-algorithm'),
('what-is-prolog'),
('what-is-cut-and-fail'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-a-algorithm'),
('what-is-cut-and-fail'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-cut-and-fail'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('how-the-communication-is-take-place-between-alu-and-bus-system'),
('what-is-prolog'),
('what-is-p'),
('how is machine learning?'),
('what-is-prolog'),
('what-is-p'),
('how is machine learning?'),
('WHAT IS ROLLBACK TRANSCTION?');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `scatid` int(60) NOT NULL,
  `title` varchar(150) NOT NULL,
  `permalink` varchar(150) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `votes` int(11) NOT NULL,
  `awnsers` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp(),
  `onDate` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `userid`, `catid`, `scatid`, `title`, `permalink`, `tags`, `description`, `votes`, `awnsers`, `views`, `on`, `onDate`, `status`) VALUES
(6, 1, 70, 3, 'Examination of the program step by step is called', 'examination-of-the-program-step-by-step-is-called', 'Debugging', '&lt;p&gt;This set of Computer Fundamentals Multiple Choice Questions &amp; Answers (MCQs) focuses on “Debugging”.&lt;/p&gt;\n\n&lt;p&gt;1. Examination of the program step by step is called ______________&lt;br&gt;\na) Controlling&lt;br&gt;\nb) Tracing&lt;br&gt;\nc) Stepping&lt;br&gt;\nd) Testing&lt;/p&gt;', 0, 0, 1, '2020-03-01 11:12:54', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questionschema`
--

CREATE TABLE `questionschema` (
  `canVoteAfter` int(11) NOT NULL,
  `canReplyAfter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questionschema`
--

INSERT INTO `questionschema` (`canVoteAfter`, `canReplyAfter`) VALUES
(15, 50);

-- --------------------------------------------------------

--
-- Table structure for table `questionsreplies`
--

CREATE TABLE `questionsreplies` (
  `qrid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `reply` text NOT NULL,
  `userid` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reportedanswers`
--

CREATE TABLE `reportedanswers` (
  `ans` int(11) NOT NULL,
  `qaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rsid` int(11) NOT NULL,
  `on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reportedreplies`
--

CREATE TABLE `reportedreplies` (
  `reportRId` int(11) NOT NULL,
  `qrid` int(11) DEFAULT NULL,
  `arid` int(11) DEFAULT NULL,
  `rsid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reportschema`
--

CREATE TABLE `reportschema` (
  `rsid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reportschema`
--

INSERT INTO `reportschema` (`rsid`, `name`, `description`, `on`, `status`) VALUES
(1, 'Inappropriate', 'This is just inappropriate to me, that is why I m reporting it.', '2018-07-24 07:30:49', 1),
(2, 'Invalid', 'This is just invalid.', '2018-07-24 07:31:11', 1),
(3, 'Copyright', 'This has a copyrighted content.', '2018-07-24 07:31:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reputationrecord`
--

CREATE TABLE `reputationrecord` (
  `repId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `reputation` int(11) NOT NULL,
  `on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_options`
--

CREATE TABLE `savsoft_options` (
  `oid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `q_option_match` varchar(1000) DEFAULT NULL,
  `q_option1` text NOT NULL,
  `score` float NOT NULL DEFAULT 0,
  `q_option_match1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `savsoft_options`
--

INSERT INTO `savsoft_options` (`oid`, `qid`, `q_option`, `q_option_match`, `q_option1`, `score`, `q_option_match1`) VALUES
(46, 6, 'Good Morning', 'Good Night', '', 0.25, ''),
(47, 6, 'Honda', 'BMW', '', 0.25, ''),
(48, 6, 'Keyboard', 'CPU', '', 0.25, ''),
(49, 6, 'Red', 'Green', '', 0.25, ''),
(51, 7, 'Blue, Sky Blue', NULL, '', 1, ''),
(52, 3, '4', NULL, '', 0.5, ''),
(53, 3, '5', NULL, '', 0, ''),
(54, 3, 'Four', NULL, '', 0.5, ''),
(55, 3, 'Six', NULL, '', 0, ''),
(56, 1, 'Patiala', NULL, '', 0, ''),
(57, 1, 'New Delhi', NULL, '', 1, ''),
(58, 1, 'Chandigarh', NULL, '', 0, ''),
(59, 1, 'Mumbai', NULL, '', 0, ''),
(76, 14, 'A', 'B', '', 0.25, ''),
(77, 14, 'C', 'D', '', 0.25, ''),
(78, 14, 'E', 'F', '', 0.25, ''),
(79, 14, 'G', 'H', '', 0.25, ''),
(81, 15, 'Washington, Washington D.C', NULL, '', 1, ''),
(82, 13, '<p>five</p>', NULL, '', 0, ''),
(83, 13, '<p>40</p>', NULL, '', 0.5, ''),
(84, 13, '<p>fourty</p>', NULL, '', 0.5, ''),
(85, 13, '<p>six</p>', NULL, '', 0, ''),
(86, 12, '<p>five</p>', NULL, '', 0, ''),
(87, 12, '<p>14</p>', NULL, '', 1, ''),
(88, 12, '<p>three</p>', NULL, '', 0, ''),
(89, 12, '<p>six</p>', NULL, '', 0, ''),
(90, 17, '<p>5</p>', NULL, '', 1, ''),
(91, 17, '<p>6</p>', NULL, '', 0, ''),
(92, 17, '<p>7</p>', NULL, '', 0, ''),
(93, 17, '<p>9</p>', NULL, '', 0, ''),
(98, 19, '<p>sasa</p>', NULL, '', 1, ''),
(99, 19, '<p>asasas</p>', NULL, '', 0, ''),
(100, 19, '<p>sasas</p>', NULL, '', 0, ''),
(101, 19, '<p>asasas</p>', NULL, '', 0, ''),
(102, 20, '<p>dfgfgfg</p>', NULL, '', 1, ''),
(103, 20, '<p>jhjhj</p>', NULL, '', 0, ''),
(104, 20, '<p>lklklk</p>', NULL, '', 0, ''),
(105, 20, '<p>hghgh</p>', NULL, '', 0, ''),
(106, 21, '<p>fgdfgfdg</p>', NULL, '', 1, ''),
(107, 21, '<p>gfdgfdg</p>', NULL, '', 0, ''),
(108, 21, '<p>deasdsad</p>', NULL, '', 0, ''),
(109, 21, '<p>gfdgfdgfdg</p>', NULL, '', 0, ''),
(114, 34, '<p>eop1</p>', NULL, '<p>hop1</p>', 1, ''),
(115, 34, '', NULL, '', 0, ''),
(116, 34, '', NULL, '', 0, ''),
(117, 34, '', NULL, '', 0, ''),
(158, 22, '<p>Eop1</p>', NULL, '<p>Hop1</p>', 0, ''),
(159, 22, '', NULL, '', 1, ''),
(160, 22, '', NULL, '', 0, ''),
(161, 22, '', NULL, '', 0, ''),
(162, 22, '<p>Eop2</p>', NULL, '<p>Hop2</p>', 0, ''),
(163, 22, '', NULL, '', 0, ''),
(164, 22, '<p>Hop2</p>', NULL, '', 0, ''),
(165, 22, '', NULL, '', 0, ''),
(166, 22, '<p>Eop3</p>', NULL, '', 0, ''),
(167, 22, '', NULL, '', 0, ''),
(168, 22, '', NULL, '', 0, ''),
(169, 22, '', NULL, '', 0, ''),
(170, 22, '<p>Eop4</p>', NULL, '', 0, ''),
(171, 22, '', NULL, '', 0, ''),
(172, 22, '', NULL, '', 0, ''),
(173, 22, '', NULL, '', 0, ''),
(174, 35, ' 4', NULL, '', 1, ''),
(175, 35, ' 5', NULL, '', 0, ''),
(176, 35, ' 6', NULL, '', 0, ''),
(177, 35, ' 3', NULL, '', 0, ''),
(178, 36, ' 4', NULL, '', 0, ''),
(179, 36, ' 8', NULL, '', 0.5, ''),
(180, 36, ' 6', NULL, '', 0, ''),
(181, 36, ' Eight', NULL, '', 0.5, ''),
(182, 37, ' Osama', NULL, '', 0, ''),
(183, 37, ' Obama', NULL, '', 1, ''),
(184, 37, ' Arvind', NULL, '', 0, ''),
(185, 37, ' Anil', NULL, '', 0, ''),
(186, 38, ' 4', NULL, '', 1, ''),
(187, 38, ' 5', NULL, '', 0, ''),
(188, 38, ' 6', NULL, '', 0, ''),
(189, 38, ' 3', NULL, '', 0, ''),
(190, 39, ' 4', NULL, '', 0, ''),
(191, 39, ' 8', NULL, '', 0.5, ''),
(192, 39, ' 6', NULL, '', 0, ''),
(193, 39, ' Eight', NULL, '', 0.5, ''),
(194, 40, ' Osama', NULL, '', 0, ''),
(195, 40, ' Obama', NULL, '', 1, ''),
(196, 40, ' Arvind', NULL, '', 0, ''),
(197, 40, ' Anil', NULL, '', 0, ''),
(198, 41, ' 4', NULL, ' 4', 1, ''),
(199, 41, ' 5', NULL, ' 5', 0, ''),
(200, 41, ' 6', NULL, ' 6', 0, ''),
(201, 41, ' 3', NULL, ' 3', 0, ''),
(202, 42, ' 4', NULL, '', 1, ''),
(203, 42, ' 5', NULL, '', 0, ''),
(204, 42, ' 6', NULL, '', 0, ''),
(205, 42, ' 3', NULL, '', 0, ''),
(206, 43, ' 4', NULL, '', 0, ''),
(207, 43, ' 8', NULL, '', 0.5, ''),
(208, 43, ' 6', NULL, '', 0, ''),
(209, 43, ' Eight', NULL, '', 0.5, ''),
(210, 44, ' Osama', NULL, '', 0, ''),
(211, 44, ' Obama', NULL, '', 1, ''),
(212, 44, ' Arvind', NULL, '', 0, ''),
(213, 44, ' Anil', NULL, '', 0, ''),
(214, 45, 'five', NULL, '', 0, ''),
(215, 45, 'four', NULL, '', 0.5, ''),
(216, 45, 'four', NULL, '', 0.5, ''),
(217, 45, 'six', NULL, '', 0, ''),
(218, 46, 'A', 'B', '', 0.25, ''),
(219, 46, 'C', 'D', '', 0.25, ''),
(220, 46, 'E', 'F', '', 0.25, ''),
(221, 46, 'G', 'H', '', 0.25, ''),
(222, 47, 'Blue, Sky blue', NULL, '', 0.25, ''),
(223, 49, 'five', NULL, '', 0, ''),
(224, 49, 'four', NULL, '', 0.5, ''),
(225, 49, 'four', NULL, '', 0.5, ''),
(226, 49, 'six', NULL, '', 0, ''),
(227, 50, 'A', 'B', '', 0.25, ''),
(228, 50, 'C', 'D', '', 0.25, ''),
(229, 50, 'E', 'F', '', 0.25, ''),
(230, 50, 'G', 'H', '', 0.25, ''),
(231, 51, 'Blue, Sky blue', NULL, '', 0.25, ''),
(232, 53, 'five', NULL, '', 0, ''),
(233, 53, 'four', NULL, '', 0.5, ''),
(234, 53, 'four', NULL, '', 0.5, ''),
(235, 53, 'six', NULL, '', 0, ''),
(236, 54, 'A', 'B', '', 0.25, ''),
(237, 54, 'C', 'D', '', 0.25, ''),
(238, 54, 'E', 'F', '', 0.25, ''),
(239, 54, 'G', 'H', '', 0.25, ''),
(240, 55, 'Blue, Sky blue', NULL, '', 0.25, ''),
(241, 57, 'five', NULL, '', 0, ''),
(242, 57, 'four', NULL, '', 1, ''),
(243, 57, 'three', NULL, '', 0, ''),
(244, 57, 'six', NULL, '', 0, ''),
(245, 58, 'five', NULL, '', 0, ''),
(246, 58, 'four', NULL, '', 0.5, ''),
(247, 58, 'four', NULL, '', 0.5, ''),
(248, 58, 'six', NULL, '', 0, ''),
(249, 59, 'A', 'B', '', 0.25, ''),
(250, 59, 'C', 'D', '', 0.25, ''),
(251, 59, 'E', 'F', '', 0.25, ''),
(252, 59, 'G', 'H', '', 0.25, ''),
(253, 60, 'Blue, Sky blue', NULL, '', 0.25, ''),
(254, 62, 'five', NULL, '', 0, ''),
(255, 62, 'four', NULL, '', 1, ''),
(256, 62, 'three', NULL, '', 0, ''),
(257, 62, 'six', NULL, '', 0, ''),
(258, 63, 'five', NULL, '', 0, ''),
(259, 63, 'four', NULL, '', 1, ''),
(260, 63, 'three', NULL, '', 0, ''),
(261, 63, 'six', NULL, '', 0, ''),
(262, 66, 'five', NULL, '', 0, ''),
(263, 66, 'four', NULL, '', 1, ''),
(264, 66, 'three', NULL, '', 0, ''),
(265, 66, 'six', NULL, '', 0, ''),
(266, 67, 'five', NULL, '', 0, ''),
(267, 67, 'four', NULL, '', 0.5, ''),
(268, 67, 'four', NULL, '', 0.5, ''),
(269, 67, 'six', NULL, '', 0, ''),
(270, 68, 'A', 'B', '', 0.25, ''),
(271, 68, 'C', 'D', '', 0.25, ''),
(272, 68, 'E', 'F', '', 0.25, ''),
(273, 68, 'G', 'H', '', 0.25, ''),
(274, 69, 'Blue, Sky blue', NULL, '', 0.25, ''),
(275, 71, 'five', NULL, '', 0, ''),
(276, 71, 'four', NULL, '', 1, ''),
(277, 71, 'three', NULL, '', 0, ''),
(278, 71, 'six', NULL, '', 0, ''),
(279, 72, 'five', NULL, '', 0, ''),
(280, 72, 'four', NULL, '', 1, ''),
(281, 72, 'three', NULL, '', 0, ''),
(282, 72, 'six', NULL, '', 0, ''),
(283, 73, 'five', NULL, '', 0, ''),
(284, 73, 'four', NULL, '', 1, ''),
(285, 73, 'three', NULL, '', 0, ''),
(286, 73, 'six', NULL, '', 0, ''),
(287, 74, 'five', NULL, 'five', 0, ''),
(288, 74, 'four', NULL, 'four', 1, ''),
(289, 74, 'three', NULL, 'three', 0, ''),
(290, 74, 'six', NULL, 'six', 0, ''),
(291, 75, 'five', NULL, '', 0, ''),
(292, 75, 'four', NULL, '', 0.5, ''),
(293, 75, 'four', NULL, '', 0.5, ''),
(294, 75, 'six', NULL, '', 0, ''),
(295, 76, 'A', 'B', '', 0.25, ''),
(296, 76, 'C', 'D', '', 0.25, ''),
(297, 76, 'E', 'F', '', 0.25, ''),
(298, 76, 'G', 'H', '', 0.25, ''),
(299, 77, 'Blue, Sky blue', NULL, '', 0.25, ''),
(300, 79, ' 4', NULL, ' 4  second language', 1, ''),
(301, 79, ' 5', NULL, ' 5 second language', 0, ''),
(302, 79, ' 6', NULL, ' 6 second language', 0, ''),
(303, 79, ' 3', NULL, ' 3 second language', 0, ''),
(304, 80, ' 4  second language', NULL, '', 1, ''),
(305, 80, ' 5 second language', NULL, '', 0, ''),
(306, 80, ' 6 second language', NULL, '', 0, ''),
(307, 80, ' 3 second language', NULL, '', 0, ''),
(312, 82, ' Osama', NULL, '', 0, ''),
(313, 82, ' Obama', NULL, '', 1, ''),
(314, 82, ' Arvind', NULL, '', 0, ''),
(315, 82, ' Anil', NULL, '', 0, ''),
(316, 81, ' 4', NULL, '', 0, ''),
(317, 81, ' 8', NULL, '', 0.5, ''),
(318, 81, ' 6', NULL, '', 0, ''),
(319, 81, ' Eight', NULL, '', 0.5, ''),
(448, 111, ' 4', NULL, ' 4  second language', 1, ''),
(449, 111, ' 5', NULL, ' 5 second language', 0, ''),
(450, 111, ' 6', NULL, ' 6 second language', 0, ''),
(451, 111, ' 3', NULL, ' 3 second language', 0, ''),
(452, 112, ' 4  second language', NULL, '', 1, ''),
(453, 112, ' 5 second language', NULL, '', 0, ''),
(454, 112, ' 6 second language', NULL, '', 0, ''),
(455, 112, ' 3 second language', NULL, '', 0, ''),
(456, 113, ' 4', NULL, '', 0, ''),
(457, 113, ' 8', NULL, '', 0.5, ''),
(458, 113, ' 6', NULL, '', 0, ''),
(459, 113, ' Eight', NULL, '', 0.5, ''),
(460, 114, ' Osama', NULL, '', 0, ''),
(461, 114, ' Obama', NULL, '', 1, ''),
(462, 114, ' Arvind', NULL, '', 0, ''),
(463, 114, ' Anil', NULL, '', 0, ''),
(464, 115, ' 4', NULL, ' 4  second language', 1, ''),
(465, 115, ' 5', NULL, ' 5 second language', 0, ''),
(466, 115, ' 6', NULL, ' 6 second language', 0, ''),
(467, 115, ' 3', NULL, ' 3 second language', 0, ''),
(468, 116, ' 4  second language', NULL, '', 1, ''),
(469, 116, ' 5 second language', NULL, '', 0, ''),
(470, 116, ' 6 second language', NULL, '', 0, ''),
(471, 116, ' 3 second language', NULL, '', 0, ''),
(472, 117, ' 4', NULL, '', 0, ''),
(473, 117, ' 8', NULL, '', 0.5, ''),
(474, 117, ' 6', NULL, '', 0, ''),
(475, 117, ' Eight', NULL, '', 0.5, ''),
(480, 118, '<p>Osama</p>', NULL, '', 0, ''),
(481, 118, '<p>Obama</p>', NULL, '', 1, ''),
(482, 118, '<p>Arvind K</p>', NULL, '', 0, ''),
(483, 118, '<p>Anil</p>', NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `signuphashes`
--

CREATE TABLE `signuphashes` (
  `userid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signuphashes`
--

INSERT INTO `signuphashes` (`userid`, `hash`) VALUES
(1, 'b5df2b9ae6bc602f474b72870c3bb77287805e02'),
(2, 'e34e031739c63d2fad0c1119f6a3176a1fd26ce3'),
(3, '97470ed07e0b9714387aafb77af1a764672ea211'),
(4, '13b1811a1f146960a3aaf5219fd31cf74378fc13');

-- --------------------------------------------------------

--
-- Table structure for table `sitesettings`
--

CREATE TABLE `sitesettings` (
  `siteName` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `logo` varchar(40) NOT NULL,
  `favicon` varchar(40) NOT NULL,
  `facebookLink` varchar(40) NOT NULL,
  `googleLink` varchar(40) NOT NULL,
  `twitterLink` varchar(200) NOT NULL,
  `dribbleLink` varchar(200) NOT NULL,
  `imgurClientId` varchar(200) NOT NULL,
  `bannerAd` text NOT NULL,
  `sidebarAd` text NOT NULL,
  `fbAppId` varchar(50) NOT NULL,
  `fbAppSecet` varchar(50) NOT NULL,
  `googleAppId` varchar(150) NOT NULL,
  `smtpUsername` varchar(200) NOT NULL,
  `smtpPassword` varchar(200) NOT NULL,
  `googleAppSecret` varchar(100) NOT NULL,
  `googleAnalyticsCode` text NOT NULL,
  `adminApproveQuestions` tinyint(1) NOT NULL,
  `bannerAdEnable` tinyint(4) NOT NULL,
  `sidebarAdEnable` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitesettings`
--

INSERT INTO `sitesettings` (`siteName`, `tags`, `description`, `logo`, `favicon`, `facebookLink`, `googleLink`, `twitterLink`, `dribbleLink`, `imgurClientId`, `bannerAd`, `sidebarAd`, `fbAppId`, `fbAppSecet`, `googleAppId`, `smtpUsername`, `smtpPassword`, `googleAppSecret`, `googleAnalyticsCode`, `adminApproveQuestions`, `bannerAdEnable`, `sidebarAdEnable`) VALUES
('Studymate', 'question,tags,answers,comunity,find', '&lt;p&gt;Studymate is is the largest, most trusted online community for developers to learn.&lt;/p&gt;', 'e85fb3b1547636f2b2d8e6ae90d9ea2a.png', 'f03d67880af326d4eb5dc887976dac50.png', 'https://facebook.com/', 'https://googleplus.com', 'https://dribble.com', 'https://twiiter.com', '', '', '', '', '', '', '', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `scatid` int(11) NOT NULL,
  `catid` int(30) NOT NULL,
  `name` varchar(60) NOT NULL,
  `permalink` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `c_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`scatid`, `catid`, `name`, `permalink`, `description`, `status`, `c_date`) VALUES
(2, 69, 'Processing', 'Processing', 'Processing', 1, '2020-02-26 17:30:48'),
(3, 70, 'Debugging', 'Debug the code', 'Find error in code', 1, '2020-02-26 19:29:12'),
(4, 69, 'Process Schedualing', 'Process Schedualing', 'Process Schedualing', 1, '2020-02-26 19:49:42'),
(5, 71, 'Base Conversion', 'Base Conversion', 'Octa to Binary,Binary to Decimal, etc', 1, '2020-02-26 19:50:35'),
(6, 71, 'ALU', 'ALU', 'Arithmetic logical unit, Processor', 1, '2020-02-26 19:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `birthdate` varchar(70) NOT NULL,
  `contact` varchar(70) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'default-user-image.png',
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `github` varchar(200) NOT NULL,
  `password` varchar(40) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `googleplus` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `voted` int(11) NOT NULL,
  `badgesGold` int(11) NOT NULL,
  `badgesSilver` int(11) NOT NULL,
  `badgesBronze` int(11) NOT NULL,
  `peopleReached` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `badgesUpdateQ` datetime NOT NULL DEFAULT current_timestamp(),
  `badgesUpdateA` datetime NOT NULL DEFAULT current_timestamp(),
  `badgesUpdateP` datetime NOT NULL DEFAULT current_timestamp(),
  `reputationUpdate` datetime NOT NULL DEFAULT current_timestamp(),
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `name`, `birthdate`, `contact`, `image`, `title`, `description`, `website`, `location`, `twitter`, `github`, `password`, `facebook`, `googleplus`, `status`, `votes`, `voted`, `badgesGold`, `badgesSilver`, `badgesBronze`, `peopleReached`, `views`, `role`, `badgesUpdateQ`, `badgesUpdateA`, `badgesUpdateP`, `reputationUpdate`, `on`) VALUES
(1, 'mnnandoliya@gmail.com', 'Makhdum', '', '', 'default-user-image.png', '', '', '', '', '', '', '99dcaea79885b8606afc556adc464f036bbd41a9', '', '', 1, 0, 0, 0, 0, 0, 2, 2, 1, '2020-02-25 19:30:59', '2020-02-25 19:30:59', '2020-02-25 19:30:59', '2020-02-25 19:30:59', '2020-02-25 19:30:59'),
(2, 'demo@gmail.com', 'MAkhdum', '2020-05-30', '9586269430', 'default-user-image.png', '', '', '', '', '', '', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', '', '', 1, 0, 0, 0, 0, 0, 1, 1, 1, '2020-05-30 18:08:36', '2020-05-30 18:08:36', '2020-05-30 18:08:36', '2020-05-30 18:08:36', '2020-05-30 18:08:36'),
(3, 'demoq@gmail.com', 'demoq', '2020-05-15', '9977881221', 'default-user-image.png', '', '', '', '', '', '', 'cbdbe4936ce8be63184d9f2e13fc249234371b9a', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, '2020-05-31 15:29:01', '2020-05-31 15:29:01', '2020-05-31 15:29:01', '2020-05-31 15:29:01', '2020-05-31 15:29:01'),
(4, 'mkdum@gmail.com', 'makhdum', '2020-05-08', '9988776655', 'default-user-image.png', '', '', '', '', '', '', '4e983f1fac1d6150d2719d521fef53960d389140', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, '2020-05-31 15:30:43', '2020-05-31 15:30:43', '2020-05-31 15:30:43', '2020-05-31 15:30:43', '2020-05-31 15:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `votedanswers`
--

CREATE TABLE `votedanswers` (
  `voteAid` int(11) NOT NULL,
  `qaid` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votedareplies`
--

CREATE TABLE `votedareplies` (
  `votearid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `arid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votedqreplies`
--

CREATE TABLE `votedqreplies` (
  `voteqrid` int(11) NOT NULL,
  `qrid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votedquestions`
--

CREATE TABLE `votedquestions` (
  `voteQid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abuseword`
--
ALTER TABLE `abuseword`
  ADD PRIMARY KEY (`ab_id`);

--
-- Indexes for table `awardedbadges`
--
ALTER TABLE `awardedbadges`
  ADD UNIQUE KEY `awardId` (`awardId`),
  ADD KEY `userid` (`userid`),
  ADD KEY `badgeId` (`badgeId`);

--
-- Indexes for table `awnserreplies`
--
ALTER TABLE `awnserreplies`
  ADD PRIMARY KEY (`arid`),
  ADD KEY `qaid` (`qaid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `awnsers`
--
ALTER TABLE `awnsers`
  ADD PRIMARY KEY (`qaid`),
  ADD KEY `qid` (`qid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badgeId`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `editedquestionslist`
--
ALTER TABLE `editedquestionslist`
  ADD PRIMARY KEY (`eqlId`),
  ADD KEY `qid` (`qid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `exam_cate`
--
ALTER TABLE `exam_cate`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `exam_level`
--
ALTER TABLE `exam_level`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `exam_options`
--
ALTER TABLE `exam_options`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `exam_qbank`
--
ALTER TABLE `exam_qbank`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `exam_qcl`
--
ALTER TABLE `exam_qcl`
  ADD PRIMARY KEY (`qcl_id`);

--
-- Indexes for table `exam_quiz`
--
ALTER TABLE `exam_quiz`
  ADD PRIMARY KEY (`quid`);

--
-- Indexes for table `exam_result`
--
ALTER TABLE `exam_result`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `forgothashes`
--
ALTER TABLE `forgothashes`
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `qid` (`qid`),
  ADD KEY `qaid` (`qaid`),
  ADD KEY `nsId` (`nsId`),
  ADD KEY `qrid` (`qrid`),
  ADD KEY `arid` (`arid`),
  ADD KEY `badgeId` (`badgeId`),
  ADD KEY `repId` (`repId`);

--
-- Indexes for table `notificationschema`
--
ALTER TABLE `notificationschema`
  ADD PRIMARY KEY (`nsId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `questionsreplies`
--
ALTER TABLE `questionsreplies`
  ADD PRIMARY KEY (`qrid`),
  ADD KEY `qid` (`qid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `reportedanswers`
--
ALTER TABLE `reportedanswers`
  ADD PRIMARY KEY (`ans`),
  ADD KEY `qaid` (`qaid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `rsid` (`rsid`);

--
-- Indexes for table `reportedreplies`
--
ALTER TABLE `reportedreplies`
  ADD PRIMARY KEY (`reportRId`),
  ADD KEY `qrid` (`qrid`),
  ADD KEY `arid` (`arid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `rsid` (`rsid`);

--
-- Indexes for table `reportschema`
--
ALTER TABLE `reportschema`
  ADD PRIMARY KEY (`rsid`);

--
-- Indexes for table `reputationrecord`
--
ALTER TABLE `reputationrecord`
  ADD PRIMARY KEY (`repId`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `savsoft_options`
--
ALTER TABLE `savsoft_options`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `signuphashes`
--
ALTER TABLE `signuphashes`
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`scatid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `votedanswers`
--
ALTER TABLE `votedanswers`
  ADD PRIMARY KEY (`voteAid`),
  ADD KEY `qaid` (`qaid`),
  ADD KEY `by` (`by`);

--
-- Indexes for table `votedareplies`
--
ALTER TABLE `votedareplies`
  ADD PRIMARY KEY (`votearid`),
  ADD KEY `by` (`by`),
  ADD KEY `arid` (`arid`);

--
-- Indexes for table `votedqreplies`
--
ALTER TABLE `votedqreplies`
  ADD PRIMARY KEY (`voteqrid`),
  ADD KEY `qrid` (`qrid`),
  ADD KEY `by` (`by`);

--
-- Indexes for table `votedquestions`
--
ALTER TABLE `votedquestions`
  ADD PRIMARY KEY (`voteQid`),
  ADD KEY `qid` (`qid`),
  ADD KEY `by` (`by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abuseword`
--
ALTER TABLE `abuseword`
  MODIFY `ab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `awardedbadges`
--
ALTER TABLE `awardedbadges`
  MODIFY `awardId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awnserreplies`
--
ALTER TABLE `awnserreplies`
  MODIFY `arid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awnsers`
--
ALTER TABLE `awnsers`
  MODIFY `qaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `badgeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `editedquestionslist`
--
ALTER TABLE `editedquestionslist`
  MODIFY `eqlId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_cate`
--
ALTER TABLE `exam_cate`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_level`
--
ALTER TABLE `exam_level`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_options`
--
ALTER TABLE `exam_options`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `exam_qbank`
--
ALTER TABLE `exam_qbank`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_qcl`
--
ALTER TABLE `exam_qcl`
  MODIFY `qcl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_quiz`
--
ALTER TABLE `exam_quiz`
  MODIFY `quid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_result`
--
ALTER TABLE `exam_result`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notificationschema`
--
ALTER TABLE `notificationschema`
  MODIFY `nsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questionsreplies`
--
ALTER TABLE `questionsreplies`
  MODIFY `qrid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportedanswers`
--
ALTER TABLE `reportedanswers`
  MODIFY `ans` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportedreplies`
--
ALTER TABLE `reportedreplies`
  MODIFY `reportRId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportschema`
--
ALTER TABLE `reportschema`
  MODIFY `rsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reputationrecord`
--
ALTER TABLE `reputationrecord`
  MODIFY `repId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `savsoft_options`
--
ALTER TABLE `savsoft_options`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `scatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `votedanswers`
--
ALTER TABLE `votedanswers`
  MODIFY `voteAid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votedareplies`
--
ALTER TABLE `votedareplies`
  MODIFY `votearid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votedqreplies`
--
ALTER TABLE `votedqreplies`
  MODIFY `voteqrid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votedquestions`
--
ALTER TABLE `votedquestions`
  MODIFY `voteQid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awardedbadges`
--
ALTER TABLE `awardedbadges`
  ADD CONSTRAINT `awardedBadges_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `awardedBadges_ibfk_5` FOREIGN KEY (`badgeId`) REFERENCES `badges` (`badgeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `awnserreplies`
--
ALTER TABLE `awnserreplies`
  ADD CONSTRAINT `awnserReplies_ibfk_4` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `awnserReplies_ibfk_5` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `awnserReplies_ibfk_6` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `awnsers`
--
ALTER TABLE `awnsers`
  ADD CONSTRAINT `awnsers_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `awnsers_ibfk_5` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE;

--
-- Constraints for table `editedquestionslist`
--
ALTER TABLE `editedquestionslist`
  ADD CONSTRAINT `editedQuestionsList_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `editedQuestionsList_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forgothashes`
--
ALTER TABLE `forgothashes`
  ADD CONSTRAINT `forgotHashes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_10` FOREIGN KEY (`nsId`) REFERENCES `notificationschema` (`nsId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_11` FOREIGN KEY (`arid`) REFERENCES `awnserreplies` (`arid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_12` FOREIGN KEY (`badgeId`) REFERENCES `badges` (`badgeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_13` FOREIGN KEY (`repId`) REFERENCES `reputationrecord` (`repId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`qrid`) REFERENCES `questionsreplies` (`qrid`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_8` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_9` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`catid`) REFERENCES `categories` (`catid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionsreplies`
--
ALTER TABLE `questionsreplies`
  ADD CONSTRAINT `questionsReplies_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionsReplies_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reportedanswers`
--
ALTER TABLE `reportedanswers`
  ADD CONSTRAINT `reportedAnswers_ibfk_4` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportedAnswers_ibfk_5` FOREIGN KEY (`rsid`) REFERENCES `reportschema` (`rsid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportedAnswers_ibfk_6` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reportedreplies`
--
ALTER TABLE `reportedreplies`
  ADD CONSTRAINT `reportedReplies_ibfk_5` FOREIGN KEY (`qrid`) REFERENCES `questionsreplies` (`qrid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportedReplies_ibfk_6` FOREIGN KEY (`rsid`) REFERENCES `reportschema` (`rsid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportedReplies_ibfk_7` FOREIGN KEY (`arid`) REFERENCES `awnserreplies` (`arid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportedReplies_ibfk_8` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reputationrecord`
--
ALTER TABLE `reputationrecord`
  ADD CONSTRAINT `reputationRecord_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `signuphashes`
--
ALTER TABLE `signuphashes`
  ADD CONSTRAINT `signupHashes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votedanswers`
--
ALTER TABLE `votedanswers`
  ADD CONSTRAINT `votedAnswers_ibfk_3` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votedAnswers_ibfk_4` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votedareplies`
--
ALTER TABLE `votedareplies`
  ADD CONSTRAINT `votedAReplies_ibfk_4` FOREIGN KEY (`arid`) REFERENCES `awnserreplies` (`arid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votedAReplies_ibfk_5` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votedqreplies`
--
ALTER TABLE `votedqreplies`
  ADD CONSTRAINT `votedQReplies_ibfk_1` FOREIGN KEY (`qrid`) REFERENCES `questionsreplies` (`qrid`) ON DELETE CASCADE,
  ADD CONSTRAINT `votedQReplies_ibfk_2` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `votedquestions`
--
ALTER TABLE `votedquestions`
  ADD CONSTRAINT `votedQuestions_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votedQuestions_ibfk_4` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

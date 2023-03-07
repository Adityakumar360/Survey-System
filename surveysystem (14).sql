-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 06:08 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `Answer_id` int(10) NOT NULL,
  `Survey_id` int(11) NOT NULL,
  `ansquestion_id` int(20) NOT NULL,
  `question_type` varchar(50) NOT NULL,
  `Answer_description` varchar(100) NOT NULL,
  `comment` longtext DEFAULT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `Answer_submitted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`Answer_id`, `Survey_id`, `ansquestion_id`, `question_type`, `Answer_description`, `comment`, `user_name`, `user_email`, `Answer_submitted_date`) VALUES
(37, 43, 65, 'Text', 'Black', NULL, 'Aditya', 'kumaradi360@gmail.com', '2022-12-29 11:32:34'),
(38, 43, 67, 'Multiple_Choice', 'Cricket', NULL, 'Aditya', 'kumaradi360@gmail.com', '2022-12-29 11:32:34'),
(39, 43, 67, 'Multiple_Choice', 'Basketball', NULL, 'Aditya', 'kumaradi360@gmail.com', '2022-12-29 11:32:34'),
(40, 43, 70, 'MCQ', '67890', NULL, 'Aditya', 'kumaradi360@gmail.com', '2022-12-29 11:32:34'),
(41, 43, 71, 'File', 'pic 4.jpg', NULL, 'Aditya', 'kumaradi360@gmail.com', '2022-12-29 11:32:34'),
(42, 43, 65, 'Text', 'Red', NULL, 'Aadi', 'aditya.kumar@footprintseducation.in', '2023-01-04 10:58:35'),
(43, 43, 67, 'Multiple_Choice', 'Cricket', NULL, 'Aadi', 'aditya.kumar@footprintseducation.in', '2023-01-04 10:58:35'),
(44, 43, 67, 'Multiple_Choice', 'Vollyball', NULL, 'Aadi', 'aditya.kumar@footprintseducation.in', '2023-01-04 10:58:35'),
(45, 43, 70, 'MCQ', '12345', NULL, 'Aadi', 'aditya.kumar@footprintseducation.in', '2023-01-04 10:58:35'),
(46, 43, 71, 'File', '', NULL, 'Aadi', 'aditya.kumar@footprintseducation.in', '2023-01-04 10:58:35'),
(48, 43, 65, 'Text', 'White', '', 'Aditya', 'adityakumar.king9120@gmail.com', '2023-01-24 13:11:00'),
(49, 43, 67, 'Multiple_Choice', 'Cricket', '', 'Aditya', 'adityakumar.king9120@gmail.com', '2023-01-24 13:11:00'),
(50, 43, 70, 'MCQ', '67890', '', 'Aditya', 'adityakumar.king9120@gmail.com', '2023-01-24 13:11:00'),
(51, 43, 71, 'File', 'IMG_20221208_152204_548.jpg', '', 'Aditya', 'adityakumar.king9120@gmail.com', '2023-01-24 13:11:00'),
(52, 260, 77, 'RatingScale', '0', '', '', '', '2023-01-24 17:23:28'),
(53, 260, 74, 'MCQ', '123456', '', 'Aditya', 'kumaradi360@gmail.com', '2023-01-24 17:25:22'),
(54, 260, 75, 'Multiple_Choice', 'qwerty', '', 'Aditya', 'kumaradi360@gmail.com', '2023-01-24 17:25:22'),
(55, 260, 75, 'Multiple_Choice', 'asdfg', '', 'Aditya', 'kumaradi360@gmail.com', '2023-01-24 17:25:22'),
(56, 260, 77, 'RatingScale', '0', '', 'Aditya', 'kumaradi360@gmail.com', '2023-01-24 17:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `Survey_id` int(10) NOT NULL,
  `Invitation_id` int(10) NOT NULL,
  `Invitation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `Invited_by` varchar(20) NOT NULL,
  `Invitation_to` varchar(20) NOT NULL,
  `message` longtext NOT NULL,
  `invitation_email` varchar(50) NOT NULL,
  `invitation_key` varchar(50) NOT NULL,
  `submitted_time` datetime DEFAULT NULL,
  `status` enum('invited','submitted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`Survey_id`, `Invitation_id`, `Invitation_date`, `Invited_by`, `Invitation_to`, `message`, `invitation_email`, `invitation_key`, `submitted_time`, `status`) VALUES
(43, 29, '2022-12-29 11:32:03', '49', 'Aditya', 'Fill this form', 'kumaradi360@gmail.com', 'd9fb672f953556847c884c362d3dd4f7', '2023-01-24 17:25:22', 'submitted'),
(43, 30, '2023-01-04 10:57:55', '49', 'Aadi', 'Fill this form', 'aditya.kumar@footprintseducation.in', 'a6bb10b704195d95a45cf789694798ed', '2023-01-04 10:58:35', 'submitted'),
(43, 33, '2023-01-24 13:10:31', '49', 'Aditya', 'sfs we r', 'adityakumar.king9120@gmail.com', '8e073afbdd0fbe62e7cf24c9d2737c92', '2023-01-24 13:11:00', 'submitted'),
(260, 34, '2023-01-24 17:24:52', '49', 'kapil', 'fill this form', 'kapil.gupta@footprintseducation.in', '4f4341b33db3216bab22b9245fad9d4d', NULL, 'invited'),
(260, 35, '2023-01-24 17:24:55', '49', 'Aditya', 'fill this form', 'kumaradi360@gmail.com', '0804a302aa32de7151427c65dd3c9756', '2023-01-24 17:25:22', 'submitted');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `Option_id` int(10) NOT NULL,
  `question_id` int(20) NOT NULL,
  `Option_description` varchar(100) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`Option_id`, `question_id`, `Option_description`, `status`) VALUES
(60, 34, '1234', 'Active'),
(61, 34, '5678', 'Active'),
(62, 34, '9012', 'Active'),
(63, 47, '11111', 'Active'),
(64, 47, '2222', 'Active'),
(65, 47, '3333', 'Active'),
(109, 57, 'multi1', 'Active'),
(110, 57, 'multi2', 'Active'),
(111, 57, 'multi3', 'Active'),
(112, 58, 'uyiouy87', 'Active'),
(113, 58, '345ertr', 'Active'),
(114, 59, 'scc1', 'Active'),
(115, 59, 'scc2', 'Active'),
(116, 59, 'scc3', 'Active'),
(130, 66, 'single 1', 'Active'),
(131, 66, 'single2', 'Active'),
(132, 66, 'single 4', 'Active'),
(139, 67, 'Cricket', 'Active'),
(140, 67, 'Football', 'Active'),
(141, 67, 'Vollyball', 'Active'),
(142, 67, 'Basketball', 'Active'),
(153, 59, 'scc4', 'Active'),
(154, 70, '12345', 'Active'),
(155, 70, '67890', 'Active'),
(156, 70, '45678', 'Active'),
(169, 73, 'cgv', 'Active'),
(170, 73, 'i768', 'Deleted'),
(171, 73, '546456', 'Active'),
(172, 74, '123456', 'Active'),
(173, 74, '7890', 'Active'),
(174, 74, '56743', 'Active'),
(175, 75, 'qwerty', 'Active'),
(176, 75, 'asdfg', 'Active'),
(177, 75, 'zxcvb', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `Question_id` int(10) NOT NULL,
  `Survey_id` int(5) NOT NULL,
  `Question_description` varchar(100) NOT NULL,
  `Question_type` varchar(50) NOT NULL,
  `is_compulsory` enum('yes','no') DEFAULT 'no',
  `creation_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `question_modified_by` varchar(5) DEFAULT NULL,
  `question_modified_date` datetime DEFAULT current_timestamp(),
  `status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Question_id`, `Survey_id`, `Question_description`, `Question_type`, `is_compulsory`, `creation_date`, `question_modified_by`, `question_modified_date`, `status`) VALUES
(23, 26, 'Rating?', 'RatingScale', 'yes', '2022-11-22 11:16:52.389881', '49', '2022-12-01 15:49:37', 'Active'),
(34, 247, 'heyyyyy', 'MCQ', 'no', '2022-11-22 17:13:05.920405', NULL, '2022-12-01 11:52:44', 'Active'),
(47, 247, 'multiple choice', 'Multiple_ChoiceComment', 'no', '2022-11-22 17:30:28.886988', NULL, '2022-12-01 11:52:44', 'Active'),
(57, 26, 'multi comment', 'Multiple_ChoiceComment', 'no', '2022-11-24 17:17:45.494844', NULL, '2022-12-01 11:52:44', 'Active'),
(58, 247, 'yuiyuou', 'Multiple_ChoiceComment', 'no', '2022-11-24 17:39:51.185832', NULL, '2022-12-01 11:52:44', 'Active'),
(59, 26, 'single comment1', 'MCQComment', 'no', '2022-11-25 15:48:38.035910', '49', '2022-12-01 11:52:44', 'Active'),
(60, 26, 'multi', 'File', 'no', '2022-11-29 10:12:12.892416', '49', '2022-12-01 00:00:00', 'Active'),
(61, 247, 'dob?', 'Date', 'no', '2022-11-29 15:53:36.836097', NULL, '2022-12-01 11:52:44', 'Active'),
(62, 26, 'sample 2', 'Text', 'no', '2022-11-30 11:45:41.736072', NULL, '2022-12-01 11:52:44', 'Active'),
(63, 26, 'sample 2 date?', 'Date', 'no', '2022-11-30 11:46:27.362140', '49', '2022-12-02 00:00:00', 'Active'),
(64, 26, 'sample 2 file?', 'File', 'no', '2022-11-30 11:46:40.652773', '49', '2022-12-01 11:52:44', 'Deleted'),
(65, 43, 'Favourite Color?', 'Text', 'no', '2022-11-30 17:48:01.223676', '49', '2022-12-01 11:52:44', 'Active'),
(66, 26, 'single choice question 1', 'MCQ', 'yes', '2022-12-02 09:48:08.572594', '49', '2022-12-02 00:00:00', 'Active'),
(67, 43, 'Favorite Sports?', 'Multiple_Choice', 'no', '2022-12-05 12:49:25.910049', NULL, '2022-12-05 12:49:25', 'Active'),
(70, 43, 'single choice question ?', 'MCQ', 'yes', '2022-12-21 10:12:42.998303', '49', '2022-12-21 10:12:42', 'Active'),
(71, 43, 'file upload?', 'File', 'no', '2022-12-22 10:32:07.857777', '49', '2022-12-22 10:32:07', 'Active'),
(73, 26, 'qwerty', 'MCQ', 'no', '2023-01-18 17:39:01.963091', '49', '2023-01-18 17:39:01', 'Active'),
(74, 260, 'single choice ', 'MCQ', 'no', '2023-01-24 17:22:29.056976', NULL, '2023-01-24 17:22:29', 'Active'),
(75, 260, 'multiple choice', 'Multiple_Choice', 'yes', '2023-01-24 17:22:50.648159', NULL, '2023-01-24 17:22:50', 'Active'),
(76, 260, 'rating', 'RatingScale', 'yes', '2023-01-24 17:23:05.345230', NULL, '2023-01-24 17:23:05', 'Active'),
(77, 260, 'rating', 'RatingScale', 'no', '2023-01-24 17:23:08.101731', NULL, '2023-01-24 17:23:08', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `Survey_id` int(10) NOT NULL,
  `Survey_title` varchar(20) NOT NULL,
  `Survey_description` longtext NOT NULL,
  `Survey_Category` enum('Education','Sports','Health','Academics','Finance','Not Defined') NOT NULL DEFAULT 'Not Defined',
  `Survey_Created_By` varchar(20) NOT NULL,
  `survey_start_Date` date NOT NULL,
  `survey_end_date` date NOT NULL,
  `survey_created_date` date NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `survey_status` enum('Active','InActive','Expired','Deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`Survey_id`, `Survey_title`, `Survey_description`, `Survey_Category`, `Survey_Created_By`, `survey_start_Date`, `survey_end_date`, `survey_created_date`, `modified_by`, `modified_date`, `survey_status`) VALUES
(26, 'Health', 'Health, according to the World Health Organization, is \"a state of complete physical, mental and social well-being and not merely the absence of disease and infirmity\". A variety of definitions have been used for different purposes over time. Health can be promoted by encouraging healthfull.', 'Sports', '49', '2022-11-14', '2023-01-26', '2022-10-19', 49, '2022-11-14', 'Active'),
(43, 'Cricket', 'Cricket is a bat-and-ball game played between two teams of eleven players on a field at the centre of which is a 22-yard (20-metre) pitch with a wicket at each end, each comprising two bails balanced on three stumps. ', 'Sports', '49', '2023-01-19', '2023-01-25', '2023-01-03', 49, '2023-01-19', 'Active'),
(247, 'sample1', 'demo 123', 'Education', '144', '2023-01-24', '2023-01-27', '2022-11-10', NULL, NULL, 'Expired'),
(248, 'sample 2', 'demo description.', 'Sports', '144', '2022-11-11', '2023-01-05', '2022-11-10', NULL, NULL, 'Deleted'),
(259, 'iuytre', 'jkshrfuiw kfewhfrkwe klweihrfw', 'Education', '49', '2023-01-26', '2023-01-28', '2023-01-24', NULL, NULL, 'InActive'),
(260, 'sample 11', 'sample 11 description', 'Health', '49', '2023-01-24', '2023-01-31', '2023-01-24', NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `Type` enum('User','Admin') NOT NULL,
  `user_name` char(20) NOT NULL,
  `Gender` enum('Female','Male') NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Phone_No` varchar(20) NOT NULL,
  `user_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `Type`, `user_name`, `Gender`, `user_email`, `password`, `Phone_No`, `user_created_date`, `status`) VALUES
(49, 'Admin', 'Admin12', 'Male', 'admin1234@gmail.com', '03e013385d66e13295d927609a7b5c5c4fb67ea7', '7412589641', '2022-11-11 11:21:40', 'Active'),
(89, 'User', 'Aditya', 'Male', 'qwerty@gmail.com', '953f5719f9f7a5b842e89e454bc0389e', '6395287410', '2022-11-11 11:21:40', 'Active'),
(144, 'User', 'Aditya kumar', 'Male', 'kumaradi360@gmail.com', '92de39b841b61d5dc5c06b18093e7c47de1ec7b8', '7418965230', '2022-11-11 11:21:40', 'Active'),
(146, 'User', 'Aditya kumar', 'Male', 'kumaradi3609@gmail.com', 'b6df184e003d99a62636bfc5358840f6c24170c9', '6395824170', '2022-11-11 11:21:40', 'Active'),
(147, 'User', 'Ak', 'Male', 'ak@gmail.com', 'dfc120c10a92163dd172227a7557453973561221', '8520147963', '2022-11-11 11:21:40', 'Active'),
(148, 'User', 'Demo', 'Female', 'demo@gmail.com', '532c1cbe25de3f60c605dbdf65aca0a514eb8252', '6547893219', '2022-11-11 11:21:40', 'Active'),
(149, 'User', 'Demo new', 'Female', 'demo2@gmail.com', 'b3bd31058755f6b41f85f1e36668c4ad1550f8a0', '6321045879', '2022-11-11 11:21:40', 'Active'),
(150, 'User', 'new user', 'Male', 'newuser@gmail.com', '63b6161cc6e85d36530da7883ba833561500c7f2', '7104285693', '2022-11-11 11:21:40', 'Active'),
(151, 'User', 'virat', 'Male', 'virat@gmail.com', '64c5f4360cafb6fb66cf0db36e10b48d512f6e77', '9120795688', '2022-11-11 11:21:40', 'Inactive'),
(152, 'User', 'Rohit', 'Male', 'rohit@gmail.com', '142592dfef1da8e107d824dbf20ebc7911ff9693', '8737884158', '2022-11-11 11:21:40', 'Active'),
(153, 'User', 'Rahul', 'Male', 'rahul@gmail.com', 'e290f1047f6237b09ecc02d60042c5356b1d7126', '9984435000', '2022-11-11 11:21:40', 'Inactive'),
(154, 'User', 'Shreyas', 'Male', 'shreyas@gmail.com', 'ba11f03d2ff5206918f43687935a6c3477185daf', '9988776655', '2022-11-11 11:21:40', 'Inactive'),
(155, 'User', 'NEW USER', 'Female', 'user@gmail.com', 'd29e9d9cd0f5b9efd60dac912e86fc17ca1b91d0', '9966332211', '2022-11-11 11:21:40', 'Active'),
(156, 'User', 'oiueowqr', 'Female', 'kag@gmail.com', '5a6fa3dc4f7025a51d29d0c4759bd8ca14fb75e3', '7744558899', '2022-11-11 11:22:20', 'Inactive'),
(158, 'User', 'Ak kumar', 'Male', 'Akkumar@gmail.com', 'cc28f69fc9c59e940d7c880751862deb7bdfb5d7', '9636001234', '2023-01-06 17:21:00', 'Active'),
(159, 'User', 'helllo', 'Male', 'hello@gmail.com', 'ec9e87858887c684f9e9567e933485b8c2aeb4f2', '9876540321', '2023-01-10 13:07:15', 'Active'),
(160, 'User', 'Kapil Gupta', 'Male', 'kapil.gupta@footprintseducatio', '014adffbf537e1a23970e45c3246c7ba37ab3598', '7410258963', '2023-01-24 17:18:34', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`Answer_id`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`Invitation_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`Option_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Question_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`Survey_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `Answer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `Invitation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `Option_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `Question_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `Survey_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

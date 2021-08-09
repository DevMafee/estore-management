-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2020 at 09:33 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jute-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `approval_id` int(11) NOT NULL,
  `approval_officer` int(10) UNSIGNED NOT NULL,
  `approval_temp` int(10) UNSIGNED DEFAULT NULL,
  `approval_temp_officer` int(10) UNSIGNED DEFAULT NULL,
  `approval_status` int(2) NOT NULL DEFAULT 1,
  `approval_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`approval_id`, `approval_officer`, `approval_temp`, `approval_temp_officer`, `approval_status`, `approval_date`) VALUES
(3, 9, 0, 0, 1, '2020-01-21 19:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `company_settings_id` int(11) NOT NULL,
  `company_settings_name` varchar(255) NOT NULL,
  `company_settings_logo` varchar(255) NOT NULL,
  `company_settings_address` text DEFAULT NULL,
  `company_settings_phone` varchar(255) DEFAULT NULL,
  `company_settings_email` varchar(255) DEFAULT NULL,
  `company_settings_website` varchar(255) DEFAULT NULL,
  `company_settings_fb` text DEFAULT NULL,
  `company_settings_twitter` text DEFAULT NULL,
  `company_settings_youtube` text DEFAULT NULL,
  `company_settings_status` int(2) NOT NULL DEFAULT 1,
  `company_settings_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`company_settings_id`, `company_settings_name`, `company_settings_logo`, `company_settings_address`, `company_settings_phone`, `company_settings_email`, `company_settings_website`, `company_settings_fb`, `company_settings_twitter`, `company_settings_youtube`, `company_settings_status`, `company_settings_date`) VALUES
(1, 'বস্ত্র ও পাট মন্ত্রণালয়', '99d1bf9364eaf153dd570cc6f4acda04.png', 'S#12, Uttara', '9659856', 'info@simecsystem.com', 'http://simecsystem.com', 'https://www.facebook.com/SIMECSystemLimited/', 'https://twitter.com/simecsystem', 'https://www.youtube.com/channel/UCvcU-LfeoU6qI22EM5OhP3w', 1, '2019-10-12 16:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_en` varchar(255) DEFAULT NULL,
  `department_bn` varchar(255) DEFAULT NULL,
  `department_status` int(2) NOT NULL DEFAULT 1,
  `department_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_en`, `department_bn`, `department_status`, `department_date`) VALUES
(1, 'MINISTRY OF JUTE AND TEXTILES', 'পাট ও বস্ত্র মন্ত্রণালয়', 1, '2020-01-02 12:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_en` varchar(255) NOT NULL,
  `designation_bn` varchar(255) NOT NULL,
  `designation_status` int(2) NOT NULL DEFAULT 1,
  `designation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_en`, `designation_bn`, `designation_status`, `designation_date`) VALUES
(1, 'Secretary', 'সচিব', 1, '2020-01-05 16:43:40'),
(2, 'Additional Secretary', 'অতিরিক্ত সচিব', 1, '2020-01-06 17:19:20'),
(3, 'Joint secretary', 'যুগ্ন সচিব ', 1, '2020-01-27 12:39:00'),
(4, 'Deputy secretary', 'উপসচিব ', 1, '2020-01-27 12:39:47'),
(5, 'Deputy cheif', 'উপপ্রধান ', 1, '2020-01-27 12:40:31'),
(6, 'System Analyst', 'সিস্টেম এনালিস্ট ', 1, '2020-01-27 12:41:20'),
(7, 'Senior Assistant secretary', 'সিনিয়র সহকারী সচিব', 1, '2020-01-27 12:43:10'),
(8, 'Senior Assistant cheif', 'সিনিয়র সহকারী প্রধান ', 1, '2020-01-27 12:45:06'),
(9, 'Programmer', 'প্রোগ্রামার ', 1, '2020-01-27 12:45:42'),
(10, 'Public Relations Officer', 'জনসংযোগ কর্মকর্তা', 1, '2020-01-27 12:46:32'),
(11, 'Assistant Programmer', 'সহকারী প্রোগ্রামার ', 1, '2020-01-27 12:47:16'),
(12, 'Assistant secretary', 'সহকারী সচিব', 1, '2020-01-27 12:48:50'),
(13, 'The Assistant Private Secretary to the Honorable Minister', 'মাননীয় মন্ত্রীর সহকারী একান্ত সচিব ', 1, '2020-01-27 12:50:20'),
(14, 'Assistant Maintenance Engineer', 'সহকারী রক্ষণাবেক্ষণ প্রকৌশলী', 1, '2020-01-27 12:51:48'),
(15, 'Accounting Officer', 'হিসাব রক্ষণ কর্মকর্তা', 1, '2020-01-27 12:55:18'),
(16, 'Administration Officer', 'প্রশাসনিক কর্মকর্তা ', 1, '2020-01-27 15:17:34'),
(17, 'Private officers', 'ব্যক্তিগত কর্মকর্তা ', 1, '2020-01-27 15:19:07'),
(18, 'Office Helper', 'অফিস সহায়ক', 1, '2020-01-27 15:20:44'),
(19, 'Assistant Librarian', 'সহকারী লাইব্রেরিয়ান', 1, '2020-01-27 15:20:50'),
(20, 'Assistant Accounting Officer', 'সহকারী হিসাবরক্ষণ কর্মকর্তা ', 1, '2020-01-27 15:22:16'),
(21, ' Cash Government', 'ক্যাশ সরকার', 1, '2020-01-27 15:23:18'),
(22, ' Cash Government', 'ক্যাশ সরকার', 1, '2020-01-27 15:23:18'),
(23, 'Assistant Accountant', 'হিসাব রক্ষক', 1, '2020-01-27 15:23:22'),
(24, ' Despatch Rider', 'ডেসপাচ রাইডার', 1, '2020-01-27 15:24:30'),
(25, 'Office Assistant Comm Computer Operator', 'অফিস সহকারী কাম কম্পিউটার অপারেটর ', 1, '2020-01-27 15:26:09'),
(26, 'Photocopy operator', 'ফটোকপি অপারেটর', 1, '2020-01-27 15:26:11'),
(27, 'Computer Operator', 'সাঁটমুদ্রাক্ষরিক কাম কম্পিউটার অপারেটর ', 1, '2020-01-27 15:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `employee_grade`
--

CREATE TABLE `employee_grade` (
  `employee_grade_id` int(11) NOT NULL,
  `employee_grade_en` varchar(255) NOT NULL,
  `employee_grade_bn` varchar(255) NOT NULL,
  `employee_grade_rank` int(2) NOT NULL,
  `employee_grade_status` int(2) NOT NULL DEFAULT 1,
  `employee_grade_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_grade`
--

INSERT INTO `employee_grade` (`employee_grade_id`, `employee_grade_en`, `employee_grade_bn`, `employee_grade_rank`, `employee_grade_status`, `employee_grade_date`) VALUES
(1, 'A Grade', 'প্রথম শ্রেণী', 1, 1, '2020-01-05 17:39:45'),
(2, 'B Grade', '২য় শ্রেণী', 2, 1, '2020-01-06 17:22:31'),
(3, 'C Grade', '৩য় শ্রেণী', 3, 1, '2020-01-06 17:23:04'),
(4, 'D Grade', '৪র্থ শ্রেণী', 4, 1, '2020-01-06 17:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `employee_information`
--

CREATE TABLE `employee_information` (
  `employee_information_id` int(11) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `employee_section` int(10) NOT NULL,
  `employee_designation` int(10) NOT NULL,
  `employee_name_en` varchar(255) NOT NULL,
  `employee_name_bn` varchar(255) DEFAULT NULL,
  `employee_photo` varchar(255) DEFAULT NULL,
  `employee_gender` int(10) NOT NULL,
  `employee_mobile_personal` varchar(100) DEFAULT NULL,
  `employee_phone_office` varchar(100) DEFAULT NULL,
  `employee_phone_home` varchar(100) DEFAULT NULL,
  `employee_fax` varchar(100) DEFAULT NULL,
  `employee_email` varchar(200) DEFAULT NULL,
  `employee_present_address` text DEFAULT NULL,
  `employee_permanent_address` text DEFAULT NULL,
  `employee_nid_no` varchar(100) DEFAULT NULL,
  `employee_nid_file` varchar(255) DEFAULT NULL,
  `employee_type` int(10) NOT NULL,
  `employee_grade` int(10) NOT NULL,
  `employee_information_status` int(2) NOT NULL DEFAULT 1,
  `employee_information_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_information`
--

INSERT INTO `employee_information` (`employee_information_id`, `employee_id`, `employee_section`, `employee_designation`, `employee_name_en`, `employee_name_bn`, `employee_photo`, `employee_gender`, `employee_mobile_personal`, `employee_phone_office`, `employee_phone_home`, `employee_fax`, `employee_email`, `employee_present_address`, `employee_permanent_address`, `employee_nid_no`, `employee_nid_file`, `employee_type`, `employee_grade`, `employee_information_status`, `employee_information_date`) VALUES
(1, '100000005251', 13, 1, 'Lokman Hossain Miah', 'জনাব লোকমান হোসেন মিয়া', 'b68c38d1fdb4644c77a4a44f702a7e89.jpg', 1, '', '9576544', '', '	9515536', 'sectext@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:06:47'),
(2, NULL, 37, 15, 'Ms. Nasrin Akter', 'বেগম নাসরিন আকতার', '', 2, '01552408754', '9515578', '8123157', '9573807', 'anasrinakter2016@gmial.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:11:36'),
(3, '100000001899', 14, 2, 'Gulnar Nazmun Nahar', 'জনাব গুলনার নাজমুন নাহার', 'e722e8e16ede9bcc58a5af3311edeee6.jpg', 2, '01788779415', '	9576545', '	47291033', '	9515536', 'add_Sec_plan_dis@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:11:50'),
(4, NULL, 18, 12, 'SAMSUN NAHAR JESMIN', 'বেগম সামসুন নাহার জেসমিন', 'dcf568aaa7e6fef143c4eb2a635325ca.jpg', 2, '01745992563', '9545051', '-', '9515536', 'jnahar1965@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:15:21'),
(5, NULL, 14, 2, 'Sima Saha', 'সীমা সাহা', '9fc1e7e3be252acf642cd0be67d0a8d7.jpg', 2, '01711409843', '9540647', '41060010', '9573807', 'shahsima962@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:15:23'),
(6, '100000004138', 14, 2, 'Mohammad Abul Kalam,NDC', 'জনাব মোহাম্মদ আবুল কালাম, এনডিসি', 'b9323fd6787dcb423d199f58784092b7.jpg', 1, '01711402668', '9514424', '44801105', '9573807', 'add_sec_admin@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:18:25'),
(7, NULL, 32, 13, 'Aniruddha Sarkar', 'অনিরুদ্ধ সরকার', 'ada2dce6d825ed873dcf40c001f6bc46.jpg', 1, '01733870763', '-', '-', '9573807', 'ame@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:20:33'),
(8, NULL, 14, 2, 'Md Mukbul Hossain', 'জনাব মো: মকবুল হোসেন', '74306d6b12c23d29fd40dcab245843fa.jpg', 1, '01715131417', '9545052', '44801105', '9573807', 'mokbul5514@yahoo.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:22:05'),
(9, NULL, 33, 12, 'S.M Mahbubul Haque', 'জনাব এস.এম. মাহবুবুল হক', '4bebdd17fcb46654ebdf775372f501e4.jpg', 1, '01817522180', '-', '-', '', 'aslaw@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:23:33'),
(10, NULL, 13, 13, 'Mr Emdadul Haque', 'জনাব এমদাদুল হক', '381043719a83c12d4f5bfaf914a83038.jpg', 1, '01746192792', '9540231', '-', '9540766', 'emdadulhaque1471@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:29:42'),
(11, NULL, 14, 2, 'Md Abu Bakar Siddique, Ndc', 'মো: আবু বকর সিদ্দিক, এনডিসি', 'bb47a45dbbed78799ff97903223cda10.jpg', 1, '01715394735', '9540234', '8035522', '8035522', 'add_Sec_audit_jute3@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:32:35'),
(12, NULL, 20, 3, 'Shoheli Shirin Ahmed', 'সোহেলী শিরীন আহমেদ', '9a5111edd75c61ca74f129648f901351.jpg', 2, '01550153607', '9540226', '9104499', '9573807', 'js_budget@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:35:58'),
(13, NULL, 43, 3, 'Shams al-Mujahid', 'জনাব শামস্ আল-মুজাহিদ', '1e0e3b30014e33f05f4e132e1121d493.jpg', 1, '01712151686', '৯৫৫৬৫৬৬', '', '9573807', 'smujahid7378@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:38:57'),
(14, NULL, 38, 12, 'Mr Nasir Uddin', 'জনাব মো নাসির উদ্দিন', '775b5b2278495f2afd489944bfdb7749.jpg', 1, '01711130071', '9612035', '48322302', '9515536', 'motjbabi2017@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:41:13'),
(15, NULL, 20, 3, 'Narayan Chandra Sarkar', 'জনাব নারায়ন চন্দ্র সরকার', 'c233dea9fd4ed5fdb5f03d821651cd50.jpg', 1, '01711201332', '9514464', '47112011', '9573807', 'admin2@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:41:30'),
(16, NULL, 43, 3, 'Mrs Nilufa Nazneen', 'বেগম নিলুফার নাজনীন', 'c6dd163c8985bd6ff38c2b5eec1b04b7.jpg', 2, '01712044518', '9512219', '', '9515536', 'nilufernazneen@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:43:48'),
(17, NULL, 12, 12, 'Begum Shirin Sultana', 'বেগম শিরীন সুলতানা', 'f27861c78ddd5a0eed97c169fc516f05.jpg', 2, '01552457153', '9545013', '7192911', '9515536', 'ssultana69@yahoo.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:44:56'),
(18, NULL, 20, 3, 'Sabina Yeasmin', 'সাবিনা ইয়াসমিন', '99a29f2d26632068ff1624c147e720a5.jpg', 2, '01913514796', '৯৫৭৬৬৯৭', '55151617', '9573807', 'yeasmin.sabina@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:47:29'),
(19, NULL, 43, 3, 'MD OLIULLAH, NDC', 'জনাব মো: অলিউল্লাহ এনডিসি', '37c29fe7d73b7d9be42798dd3dfdd5d6.jpg', 1, '01745707209', '', '', '', 'ullah19oli@gamil.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:49:40'),
(20, NULL, 20, 3, 'Rashida Ferdouse, NDC', 'জনাব রাশিদা ফেরদৌস, এনডিসি', 'f37e483b77e2e731cb6dd232e6d7bf36.jpg', 2, '01715029471', '৯৫১৫৫৯০', '৯০১৭০১৬', '৯৫১৫৫৩৬', 'rashida_5757@yahoo.com', '', '', '', '', 1, 1, 1, '2020-01-27 13:52:03'),
(21, NULL, 20, 3, 'Md Khurshid Iqbal Rezvi', 'জনাব মো: খুরশীদ ইকবাল রেজভী', '02cd4fbf247150080a33719d2d5b021a.jpg', 1, '01970200654', '9573755', '9662816', '9573807', 'jute2@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:54:07'),
(22, NULL, 40, 4, 'K. M. Rafiqul Islam', 'জনাব খ. ম. রফিকুল ইসলাম', 'bffb6bd4446e4ad222fb10bf3853f58f.jpg', 1, '01720116148', '	9540228', '', '9573807', 'budget@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:56:45'),
(23, NULL, 32, 11, 'Md Nasir Uddin', 'মো: নাসির উদ্দিন', '76c809eb8de184aad2aa29adbc1d3988.jpg', 1, '01722657913', '9545013', '00000000000', '9573807', 'ap@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 13:56:49'),
(24, NULL, 41, 4, 'Mr. Humayun Kabir', 'জনাব হুমায়ূন কবির', '3a952b931dc8f705e1cc047567807578.jpg', 1, '01711319221', '9540230', '	47291134', '9515536', 'textile2@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:00:16'),
(25, NULL, 13, 10, 'Mr. Saikat Chnadra Halder', 'জনাব সৈকত চন্দ্র হালদার', '80e398a0ffdfc3928dea436bde81bf94.jpg', 1, '01712492665', '9540628', '-', '9540766', 'pro@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:01:53'),
(26, NULL, 40, 4, 'MD. ABUL BASHER SIDDIQUE AKAND', 'মো: আবুল বাসার সিদ্দিক আকন', '2f820527e308a8538fc03a974eaf0fdd.jpg', 1, '01726373556', '9540308', '58050252', '9573807', 'jute3@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:02:49'),
(27, NULL, 41, 4, '	Mr. MD KAMRUZZAMAN', 'জনাব মো: কামরুজ্জামান', 'd69dda737c93a656e906acabaa284144.png', 1, '01552323546', '9515607', '8090067', '9573807', 'motjsos2010@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 14:05:33'),
(28, NULL, 13, 9, 'Md Aminul Islam', 'মোঃ আমিনুল ইসলাম', 'af202ba7a405c90ecd3457fe6c90bfa3.jpg', 1, '01717924757', '02-9545922', '58051416', '9573807', 'programmer@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:05:33'),
(29, NULL, 9, 12, 'Md. Shafiur Rahman', 'মোঃ শফিউর রহমান', '04289abe8a4315528a9aaa53ae844837.jpg', 1, '01843761549', '9540525', '00000000000', '9515536', 'planing1@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:26:18'),
(30, NULL, 8, 8, 'Mr Shek Shamsur Rahman', 'জনাব শেখ শামছুর রহমান', '5087d129472d8d45610f01196ba9d624.jpg', 1, '01916481664', '9540229', '9335903', '9515536', 'mdshamsurrahman@yahoo.com', '', '', '', '', 1, 1, 1, '2020-01-27 14:29:30'),
(31, NULL, 13, 1, 'Md. Saiful Islam', 'জনাব মো: সাইফুল ইসলাম', '98b62918ac4994b95a0e6cc725351c61.png', 1, '01726800374', '02-9549051', '9540227', '02-9515536', 'saiful31ac@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 14:32:20'),
(32, NULL, 13, 7, 'MD. SAIFUL ISLAM BHUIYAN', 'জনাব সাইফুল ইসলাম ভূঞা', 'fea14d867c6f256972a9287bf839c363.png', 1, '01721181290', '9540477', '-', '9573807', 'admin1@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:34:59'),
(33, NULL, 13, 6, 'A.T.M Alimuzzaman', 'জনাব এ.টি.এম আলিমুজ্জামান', '3c0f6d9d5c46fe630ae345fc31f36260.jpg', 1, '01718400017', '9545973', '9336335', '9573807', 'systemanalyst@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:37:39'),
(34, NULL, 28, 5, 'Md. Kamal Atahar Hossian', 'মো: কামাল আতাহার হোসেন', 'd6fce28a30966c9a67e1f44d5bf0219f.png', 1, '017111132742', '9512219', '-', '9515536', 'dc_planing@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:40:43'),
(35, NULL, 25, 4, 'MAKSUDA BEGUM SIDDIKA', 'মাকসুদা বেগম সিদ্দিকা', '67773c6094fda7b811b0e6cb4c23da0c.jpg', 2, '01712559228', '9571219', '48310050', '9573807', 'mbsiddika22@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 14:43:40'),
(36, NULL, 30, 4, 'Md. Mizanur Rahman', 'মোঃ মিজানুর রহমান', 'f8dae5033ea6bec47bec1f0b71aceb8e.jpg', 1, '01712653201', '9515590', '0258052610', '9515536', 'sastextile1@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 14:47:27'),
(37, NULL, 40, 1, 'Mr PARITOSH HAJRA', 'জনাব পরিতোষ হাজরা', 'e8e8b150f35005a0c774c8e3a19e9e74.jpg', 1, '01711906111', '9540488', '9341536', '9515536', 'ps.minister@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:51:18'),
(38, NULL, 40, 4, 'khenchan', 'খেনচান', 'b6f48ce0e08238c82ea5bd4df8c363f8.jpg', 2, '01918898799', '9576546', '48954243', '	9573807', 'audit@motj.gov.bd', '', '', '', '', 1, 1, 1, '2020-01-27 14:54:58'),
(39, NULL, 10, 16, 'Mr. Mahbub Alam', 'জনাব মাহবুব আলম', '', 1, '01710697320', '', '', '', 'Netramail86@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 16:01:51'),
(40, NULL, 13, 17, 'Mr. Mohammad Mofizul Islam', 'জনাব মোহাম্মদ মফিজুল ইসলাম', '', 1, '01912914453', '', '', '', 'Islam.pomotj@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 16:05:05'),
(41, NULL, 9, 17, 'Md. Kamruzzaman Masum', 'মো: কামরুজ্জামান মাসুম ', '', 1, '01914213426', '', '', '', 'mkhq213@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 16:07:52'),
(42, NULL, 14, 16, 'Md. Shamsul Alam', 'মো: শামসুল আলম', '', 1, '01713388052', '', '', '', 'alam@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 16:14:34'),
(43, NULL, 41, 18, 'Mr. Mohammad Anwar Hossain', 'জনাব মোঃ আনোয়ার হোসেন', '', 1, '01753142736', '', '', '', 'anwarhossain7102@gmail.com', '', '', '', '', 1, 4, 1, '2020-01-27 16:34:06'),
(44, NULL, 43, 18, 'Mr. Md. Mohiuddin', 'জনাব মোঃ মহিউদ্দিন', '', 1, '01821678653', '', '', '', '0@o.com', '', '', '', '', 1, 4, 1, '2020-01-27 16:39:52'),
(45, NULL, 36, 18, ' Mr. Saleha Begum', 'জনাব সালেহা বেগম', '', 2, '01552494794', '', '', '', '0@0.com', '', '', '', '', 1, 4, 1, '2020-01-27 16:53:53'),
(46, NULL, 32, 18, 'Mosa: Mumtaz Begum', 'মোসা: মমতাজ বেগম', '', 2, '01775016066', '', '', '', '0@0.com', '', '', '', '', 1, 4, 1, '2020-01-27 16:58:04'),
(47, NULL, 30, 16, 'Kamrunnahar', 'কামরুন্নাহার ', '', 2, '01775669565', '', '', '', 'k.nahermotj@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:00:51'),
(48, NULL, 35, 18, ' Mr. Mohammed Ali', 'জনাব মোহাম্মদ আলী', '', 1, '', '', '', '', '0@0.com', '', '', '', '', 1, 4, 1, '2020-01-27 17:03:15'),
(49, NULL, 14, 17, 'Mr. Md. Akram Hossain', 'জনাব মো: আকরাম হোসেন ', '', 1, '01553288477', '', '', '', 'h.akram1961@gmail.com', '', '', '', '', 1, 1, 1, '2020-01-27 17:03:24'),
(50, NULL, 35, 18, ' Mr. Md. Mosharraf Hossain', 'জনাব মোঃ মোশাররফ হোসেন', '', 1, '0167322390', '', '', '', '0@0.com', '', '', '', '', 1, 4, 1, '2020-01-27 17:06:08'),
(51, NULL, 8, 16, 'Mr. Jewel Molla', 'জনাব জুয়েল মোল্লা ', '', 1, '01918285633', '', '', '', 'jwelmolla@yahoo.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:07:12'),
(52, NULL, 37, 18, ' Fatima Begum', 'ফাতেমা বেগম', '', 2, '01676796365', '', '', '', 'fatemabd1968@gmail.com', '', '', '', '', 1, 4, 1, '2020-01-27 17:08:56'),
(53, NULL, 26, 16, 'Darshana sarker', 'দর্শনা সরকার ', '', 2, '01712581068', '', '', '', 'Darshanasarker1962@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:09:58'),
(54, NULL, 24, 16, 'Mr. Mohammed Sirajul Islam', 'জনাব মোহাম্মদ সিরাজুল ইসলাম ', '', 1, '01729908067', '', '', '', 'Mdserajul1986@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:12:30'),
(55, NULL, 13, 18, 'Mr. Ashish Kumar Gop', 'জনাব আশীষ কুমার গোপ', '', 1, '01739207453', '', '', '', '0@0.com', '', '', '', '', 1, 4, 1, '2020-01-27 17:14:42'),
(56, NULL, 31, 16, 'Mr. Md. Harun Rashid', 'জনাব মোঃ হারুন অর রশিদ ', '', 1, '01676038777', '', '', '', 'Rashid.motj@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:17:09'),
(57, NULL, 13, 18, 'Mr. Md. Ataur Rahman', 'জনাব মোঃ আতাউর রহমান', '', 1, '01816401552', '', '', '', '0@0.com', '', '', '', '', 1, 4, 1, '2020-01-27 17:18:24'),
(58, NULL, 31, 16, 'Mr. Md. Fazlur Rahman', 'জনাব মো: ফজলুর রহমান ', '', 1, '01775241797', '', '', '', 'r.fazlur72@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:21:09'),
(59, NULL, 40, 18, 'Begum Halima Begum', 'বেগম হালিমা বেগম', '', 2, '01762418594', '', '', '', '0@0.com', '', '', '', '', 1, 4, 1, '2020-01-27 17:24:17'),
(60, NULL, 31, 16, 'Mr. Md Moksedur Rahman', 'জনাব মো: মোকসেদুর রহমান ', '', 1, '01723454495', '', '', '', 'rahmanmoksed@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:24:36'),
(61, NULL, 31, 19, 'Nur-E jannat', 'নূর এ জান্নাত ', '', 2, '01719511881', '', '', '', 'Miludinaj03@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:28:33'),
(62, NULL, 25, 16, 'Tingku rani shaha', 'টিংকু রানী সাহা ', '', 2, '01728429046', '', '', '', 'Jute2.motj@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:32:06'),
(63, NULL, 12, 17, 'Mohammad Jahangir Hossain Hang', 'মোঃ জাহাঙ্গীর হোসেন হ্যাং', '', 1, '01720015915', '', '', '', '0@0.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:32:08'),
(64, NULL, 14, 17, 'Mr. Bashir Ahmed', 'জনাব বশির আহমেদ ', '', 1, '01716883743', '', '', '', 'Boshir1976@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:36:24'),
(65, NULL, 34, 17, 'Mr. Md. Abdus Sattar', 'জনাব মো:আব্দুস সাত্তার ', '', 1, '01757382580', '', '', '', 'bdussattar51971@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:41:08'),
(66, NULL, 41, 16, 'Mr. Md. Abdul Rahim', 'জনাব মো:আব্দুর রাহিম', '', 1, '01723842078', '', '', '', 'Rahimanaf52@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:45:06'),
(67, NULL, 43, 16, 'Begum Sajia Koraishi', 'বেগম সাজিয়া কোরাইশী ', '', 2, '01683343395', '', '', '', 'Motjp2@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:48:15'),
(68, NULL, 15, 16, 'Znab Md. Ataur Rahman', 'জনাব মোঃ আতাউর রহমান', '', 1, '01715542152', '', '', '', 'shakhawatmotj@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:49:17'),
(69, NULL, 14, 17, 'Mr. Md. Motiur Rahman', 'জনাব মো: মতিউর রহমান ', '', 1, '01531247362', '', '', '', '0@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:53:35'),
(70, NULL, 27, 16, 'Mr. Md. Alauddin', 'জনাব মো: আলাউদ্দিন ', '', 1, '01552460568', '', '', '', 'Ih.law2016@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:56:02'),
(71, NULL, 36, 17, 'Mohammad Arshad Khan', ' মোহাম্মদ আরশাদ খান', '', 1, '01827575964', '', '', '', 'arshad52khan@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 17:56:28'),
(72, NULL, 12, 16, 'Mr. Mohsan Imam', 'জনাব মোঃহাসান ইমাম', '', 1, '01737629739', '', '', '', 'Motjssss2012@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 18:00:43'),
(73, NULL, 25, 16, ' Mr A, H, A M Abdullah Al Noman', 'জনাব এ,এইচ,এ ম আব্দুল্লা আল নোমান', '', 1, '01675519431', '', '', '', 'Noman3804@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 18:02:40'),
(74, NULL, 33, 16, 'Mr. Md. Abul Bashar', 'জনাব মোঃ আবুল বাসার ', '', 1, '01515244232', '', '', '', 'basharhabib112@gmail.com', '', '', '', '', 1, 2, 1, '2020-01-27 18:03:13'),
(75, NULL, 43, 16, 'Mr. Mohammad Islam Uddin', 'জনাব মোঃ ইসলাম উদ্দিন', '', 1, '01745996387', '', '', '', '0@0.com', '', '', '', '', 1, 2, 1, '2020-01-27 18:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `employee_type_id` int(11) NOT NULL,
  `employee_type_en` varchar(255) NOT NULL,
  `employee_type_bn` varchar(255) NOT NULL,
  `employee_type_status` int(2) NOT NULL DEFAULT 1,
  `employee_type_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`employee_type_id`, `employee_type_en`, `employee_type_bn`, `employee_type_status`, `employee_type_date`) VALUES
(1, 'Permanent', 'স্থায়ী', 1, '2020-01-05 17:15:21'),
(2, 'Deputation', 'ডেপুটেশন', 1, '2020-01-05 17:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL,
  `gender_en` varchar(50) NOT NULL,
  `gender_bn` varchar(50) NOT NULL,
  `gender_status` int(2) NOT NULL DEFAULT 1,
  `gender_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_en`, `gender_bn`, `gender_status`, `gender_date`) VALUES
(1, 'Male', 'পুরুষ', 1, '2020-01-05 17:03:26'),
(2, 'Female', 'মহিলা', 1, '2020-01-05 17:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `grid_setting`
--

CREATE TABLE `grid_setting` (
  `grid_setting_id` int(10) UNSIGNED NOT NULL,
  `grid_setting_name` varchar(100) NOT NULL,
  `grid_setting_icon` varchar(100) NOT NULL,
  `grid_setting_link` varchar(255) NOT NULL,
  `grid_setting_query` varchar(255) NOT NULL,
  `grid_setting_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `languages_id` int(11) NOT NULL,
  `languages_type` varchar(11) DEFAULT NULL,
  `languages_code` varchar(255) DEFAULT NULL,
  `languages_text` text DEFAULT NULL,
  `languages_status` int(2) NOT NULL DEFAULT 1,
  `languages_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`languages_id`, `languages_type`, `languages_code`, `languages_text`, `languages_status`, `languages_date`) VALUES
(1, 'en', 'LANGUAGE_SET', 'All Languages', 1, '2020-01-01 00:23:57'),
(2, 'bn', 'LANGUAGE_SET', 'সকল ভাষা', 1, '2020-01-01 00:23:57'),
(3, 'en', 'COMPANY_NAME', 'MINISTRY OF TEXTILES AND JUTE', 1, '2020-01-01 01:42:24'),
(4, 'bn', 'COMPANY_NAME', 'বস্ত্র ও পাট মন্ত্রণালয়', 1, '2020-01-01 01:42:25'),
(5, 'en', 'MODULE', 'Create New Module', 1, '2020-01-01 01:44:21'),
(6, 'bn', 'MODULE', 'নতুন মডিউল তৈরি করুন', 1, '2020-01-01 01:44:21'),
(7, 'en', 'LANGUAGE_EN', 'English', 1, '2020-01-01 01:48:56'),
(8, 'bn', 'LANGUAGE_EN', 'ইংরেজি', 1, '2020-01-01 01:48:56'),
(9, 'en', 'LANGUAGE_BN', 'Bengali', 1, '2020-01-01 01:49:41'),
(10, 'bn', 'LANGUAGE_BN', 'বাংলা', 1, '2020-01-01 01:49:41'),
(11, 'en', 'SETTING', 'Setting', 1, '2020-01-01 01:51:38'),
(12, 'bn', 'SETTING', 'সেটিং', 1, '2020-01-01 01:51:38'),
(13, 'en', 'REPORTS', 'Reports', 1, '2020-01-01 01:56:33'),
(14, 'bn', 'REPORTS', 'রিপোর্ট', 1, '2020-01-01 01:56:34'),
(15, 'en', 'COMPANY_SETTINGS', 'Company Setting', 1, '2020-01-01 01:57:51'),
(16, 'bn', 'COMPANY_SETTINGS', 'কোম্পানি সেটিং', 1, '2020-01-01 01:57:51'),
(17, 'en', 'ALL_MODULE', 'Module List', 1, '2020-01-01 02:21:10'),
(18, 'bn', 'ALL_MODULE', 'মডিউল লিস্ট', 1, '2020-01-01 02:21:10'),
(19, 'en', 'NEW_MODULE', 'Create Module', 1, '2020-01-01 02:26:22'),
(20, 'bn', 'NEW_MODULE', 'মডিউল তৈরী করুন', 1, '2020-01-01 02:26:22'),
(21, 'en', 'LANG_SET', 'Language Setting', 1, '2020-01-01 02:27:58'),
(22, 'bn', 'LANG_SET', 'ভাষা সেটিং', 1, '2020-01-01 02:27:58'),
(23, 'en', 'MODULE_SETTING', 'Module Setting', 1, '2020-01-01 05:26:09'),
(24, 'bn', 'MODULE_SETTING', 'মডিউল  সেটিং', 1, '2020-01-01 05:26:10'),
(25, 'en', 'MENU_SETTING', 'Menu Setting', 1, '2020-01-01 05:28:16'),
(26, 'bn', 'MENU_SETTING', 'মেনু সেটিং', 1, '2020-01-01 05:28:17'),
(27, 'en', 'MAIN_MENU', 'Main Menu Setting', 1, '2020-01-01 05:30:41'),
(28, 'bn', 'MAIN_MENU', 'মেইন মেনু সেটিং', 1, '2020-01-01 05:30:41'),
(29, 'en', 'SUB_MENU', 'Sub Menu Setting', 1, '2020-01-01 05:31:13'),
(30, 'bn', 'SUB_MENU', 'সাব মেনু সেটিং', 1, '2020-01-01 05:31:13'),
(31, 'en', 'DASHBOARD', 'Dashboard', 1, '2020-01-01 05:33:04'),
(32, 'bn', 'DASHBOARD', 'ড্যাশবোর্ড', 1, '2020-01-01 05:33:04'),
(33, 'en', 'USER_SETTING_ADMIN', 'User Setting', 1, '2020-01-01 05:34:56'),
(34, 'bn', 'USER_SETTING_ADMIN', 'ব্যবহারকারী সেটিং', 1, '2020-01-01 05:34:56'),
(35, 'en', 'USER_ACCESS_SETTING', 'Access Setting', 1, '2020-01-01 05:38:03'),
(36, 'bn', 'USER_ACCESS_SETTING', 'একসেস সেটিং', 1, '2020-01-01 05:38:04'),
(37, 'en', 'VIEW_ALL_USER', 'View All User', 1, '2020-01-01 05:39:11'),
(38, 'bn', 'VIEW_ALL_USER', 'সব ব্যবহারকারী দেখুন', 1, '2020-01-01 05:39:12'),
(39, 'en', 'CREATE_USER', 'Create New User', 1, '2020-01-01 05:40:20'),
(40, 'bn', 'CREATE_USER', 'ব্যবহারকারী তৈরী করুন', 1, '2020-01-01 05:40:20'),
(41, 'en', 'CREATE_USER_TYPE', 'Create User Type', 1, '2020-01-01 05:42:05'),
(42, 'bn', 'CREATE_USER_TYPE', 'ব্যবহারকারীর প্রকার তৈরী', 1, '2020-01-01 05:42:05'),
(43, 'en', 'LATEST_REQUISITION_STATUS', 'LATEST REQUISITION STATUS', 1, '2020-01-01 18:11:12'),
(44, 'bn', 'LATEST_REQUISITION_STATUS', 'লেটেস্ট রিকুইজিশন স্টেটাস', 1, '2020-01-01 18:11:12'),
(45, 'en', 'PRODUCT_LIST_BELOW_STOCK_LIMIT', 'PRODUCT\'S LIST BELOW STOCK LIMIT', 1, '2020-01-01 18:27:11'),
(46, 'bn', 'PRODUCT_LIST_BELOW_STOCK_LIMIT', 'স্টক লিমিটের নীচে পণ্যের তালিকা', 1, '2020-01-01 18:27:11'),
(47, 'en', 'TOTAL_EMPLOYEES', 'TOTAL EMPLOYEES', 1, '2020-01-01 20:07:42'),
(48, 'bn', 'TOTAL_EMPLOYEES', 'মোট কর্মকর্তা', 1, '2020-01-01 20:07:42'),
(49, 'en', 'PRODUCTS', 'PRODUCTS', 1, '2020-01-01 20:12:58'),
(50, 'bn', 'PRODUCTS', 'পণ্য সমূহ', 1, '2020-01-01 20:12:58'),
(51, 'en', 'NEW_REQUISITIONS', 'NEW REQUISITIONS', 1, '2020-01-01 20:14:33'),
(52, 'bn', 'NEW_REQUISITIONS', 'নতুন রিকুইজিশন', 1, '2020-01-01 20:14:33'),
(53, 'en', 'BELOW_STOCK', 'BELOW STOCK', 1, '2020-01-01 20:16:36'),
(54, 'bn', 'BELOW_STOCK', 'স্টকের লিমিট নেমেছে', 1, '2020-01-01 20:16:37'),
(55, 'en', 'OFFICER', 'OFFICER', 1, '2020-01-01 20:17:52'),
(56, 'bn', 'OFFICER', 'অফিসার', 1, '2020-01-01 20:17:52'),
(57, 'en', 'ORDER_NO', 'ORDER NO', 1, '2020-01-01 20:19:27'),
(58, 'bn', 'ORDER_NO', 'অর্ডার নাম্বার ', 1, '2020-01-01 20:19:27'),
(59, 'en', 'STATUS', 'STATUS', 1, '2020-01-01 20:21:18'),
(60, 'bn', 'STATUS', 'স্ট্যাটাস', 1, '2020-01-01 20:21:18'),
(61, 'en', 'ACTION', 'ACTION', 1, '2020-01-01 20:21:56'),
(62, 'bn', 'ACTION', 'অ্যাকশন', 1, '2020-01-01 20:21:56'),
(63, 'en', 'STOCK', 'STOCK', 1, '2020-01-01 20:23:57'),
(64, 'bn', 'STOCK', 'মজুদ', 1, '2020-01-01 20:23:57'),
(65, 'en', 'MASTER_CONFIGURATION', 'Master Configuration', 1, '2020-01-01 21:42:11'),
(66, 'bn', 'MASTER_CONFIGURATION', 'মাস্টার কনফিগারেশন', 1, '2020-01-01 21:42:11'),
(67, 'en', 'DEPARTMENT', 'Department', 1, '2020-01-02 11:24:25'),
(68, 'bn', 'DEPARTMENT', 'ডিপার্টমেন্ট', 1, '2020-01-02 11:24:25'),
(69, 'en', 'CREATE_DEPARTMENT', 'Create a Department', 1, '2020-01-02 11:43:00'),
(70, 'bn', 'CREATE_DEPARTMENT', 'ডিপার্টমেন্ট তৈরী করুন', 1, '2020-01-02 11:43:00'),
(71, 'en', 'OFFICE', 'Office', 1, '2020-01-02 13:18:42'),
(72, 'bn', 'OFFICE', 'অফিস', 1, '2020-01-02 13:18:42'),
(73, 'en', 'CREATE_OFFICE', 'CREATE OFFICE', 1, '2020-01-03 15:23:19'),
(74, 'bn', 'CREATE_OFFICE', 'অফিস তৈরী করুন', 1, '2020-01-03 15:23:19'),
(75, 'en', 'SECTION', 'Section', 1, '2020-01-03 17:39:48'),
(76, 'bn', 'SECTION', 'দপ্তর', 1, '2020-01-03 17:39:48'),
(77, 'en', 'DESIGNATION', 'Designation', 1, '2020-01-05 16:24:17'),
(78, 'bn', 'DESIGNATION', 'পদবী', 1, '2020-01-05 16:24:17'),
(79, 'en', 'GENDER', 'Gender', 1, '2020-01-05 16:58:52'),
(80, 'bn', 'GENDER', 'জেন্ডার', 1, '2020-01-05 16:58:52'),
(81, 'en', 'EMPLOYEE_TYPE', 'Employee Type', 1, '2020-01-05 17:12:24'),
(82, 'bn', 'EMPLOYEE_TYPE', 'কর্মচারী প্রকার', 1, '2020-01-05 17:12:24'),
(83, 'en', 'EMPLOYEE_GRADE', 'Employee Grade', 1, '2020-01-05 17:21:07'),
(84, 'bn', 'EMPLOYEE_GRADE', 'কর্মকর্তা গ্রেড', 1, '2020-01-05 17:21:07'),
(85, 'en', 'EMPLOYEE_GRADE_RANK', 'Employee Grade Rank', 1, '2020-01-05 17:47:46'),
(86, 'bn', 'EMPLOYEE_GRADE_RANK', 'কর্মকর্তার শ্রেণী ক্রোম', 1, '2020-01-05 17:47:46'),
(87, 'en', 'UNIT', 'Unit', 1, '2020-01-05 18:45:24'),
(88, 'bn', 'UNIT', 'একক', 1, '2020-01-05 18:45:25'),
(89, 'en', 'PRODUCT_CATEGORY', 'Product Category', 1, '2020-01-05 18:52:37'),
(90, 'bn', 'PRODUCT_CATEGORY', 'পণ্য প্রকারভেদ', 1, '2020-01-05 18:52:37'),
(91, 'en', 'EMPLOYEE_INFORMATION', 'Officers Information', 1, '2020-01-06 13:39:20'),
(92, 'bn', 'EMPLOYEE_INFORMATION', 'কর্মকর্তাগণের তথ্য', 1, '2020-01-06 13:39:20'),
(93, 'en', 'SUPPLIERS', 'Suppliers', 1, '2020-01-07 11:52:05'),
(94, 'bn', 'SUPPLIERS', 'সরবরাহকারী', 1, '2020-01-07 11:52:05'),
(95, 'en', 'ADDRESS', 'Address', 1, '2020-01-07 12:27:41'),
(96, 'bn', 'ADDRESS', 'ঠিকানা', 1, '2020-01-07 12:27:41'),
(97, 'en', 'MOBILE', 'Mobile', 1, '2020-01-07 12:28:13'),
(98, 'bn', 'MOBILE', 'মুঠোফোন', 1, '2020-01-07 12:28:13'),
(99, 'en', 'PHOTO', 'Photo', 1, '2020-01-07 12:47:42'),
(100, 'bn', 'PHOTO', 'ছবি', 1, '2020-01-07 12:47:42'),
(101, 'en', 'LANGUAGES', 'Languages', 1, '2020-01-07 13:56:27'),
(102, 'bn', 'LANGUAGES', 'ভাষা', 1, '2020-01-07 13:56:27'),
(103, 'en', 'MODULES', 'Modules', 1, '2020-01-07 13:59:36'),
(104, 'bn', 'MODULES', 'মডিউল', 1, '2020-01-07 13:59:36'),
(105, 'en', 'USERS', 'User', 1, '2020-01-07 14:00:50'),
(106, 'bn', 'USERS', 'ব্যবহারকারী', 1, '2020-01-07 14:00:50'),
(107, 'en', 'PRODUCT', 'Product', 1, '2020-01-08 19:04:41'),
(108, 'bn', 'PRODUCT', 'প্রোডাক্ট', 1, '2020-01-08 19:04:41'),
(109, 'en', 'STOCK_LIMIT', 'STOCK LIMIT', 1, '2020-01-08 21:30:27'),
(110, 'bn', 'STOCK_LIMIT', 'স্টক লিমিট', 1, '2020-01-08 21:30:27'),
(111, 'en', 'APPROVAL', 'Approval Authority', 1, '2020-01-09 16:56:09'),
(112, 'bn', 'APPROVAL', 'অনুমোদন কর্তৃপক্ষ', 1, '2020-01-09 16:56:09'),
(113, 'en', 'TEMP_OFFICER', 'Alternative Officer', 1, '2020-01-11 11:14:00'),
(114, 'bn', 'TEMP_OFFICER', 'পরিবর্তিত অফিসার', 1, '2020-01-11 11:14:00'),
(115, 'en', 'ALTERNATIVE', 'Alternative', 1, '2020-01-11 20:39:26'),
(116, 'bn', 'ALTERNATIVE', 'বিকল্প', 1, '2020-01-11 20:39:26'),
(117, 'en', 'STORE_RECEIVE', 'Store Receive', 1, '2020-01-12 15:04:38'),
(118, 'bn', 'STORE_RECEIVE', 'স্টোর রিসিভ', 1, '2020-01-12 15:04:38'),
(119, 'en', 'NEW_ENTRY', 'New Stock Entry', 1, '2020-01-12 20:35:23'),
(120, 'bn', 'NEW_ENTRY', 'নতুন স্টক এন্ট্রি', 1, '2020-01-12 20:35:23'),
(121, 'en', 'STORE_ALL', 'All Stock Entries', 1, '2020-01-12 20:36:26'),
(122, 'bn', 'STORE_ALL', 'সব স্টক এন্ট্রি', 1, '2020-01-12 20:36:26'),
(123, 'en', 'INDENT', 'INDENT NO', 1, '2020-01-13 16:05:58'),
(124, 'bn', 'INDENT', 'ইন্ডেন্ট নং', 1, '2020-01-13 16:05:58'),
(125, 'en', 'COMMENT', 'COMMENT', 1, '2020-01-13 16:09:43'),
(126, 'bn', 'COMMENT', 'মন্তব্য', 1, '2020-01-13 16:09:43'),
(127, 'en', 'QTY', 'Quantity', 1, '2020-01-13 16:14:21'),
(128, 'bn', 'QTY', 'পরিমাণ', 1, '2020-01-13 16:14:21'),
(129, 'en', 'DETAILS', 'DETAILS', 1, '2020-01-16 11:01:54'),
(130, 'bn', 'DETAILS', 'বিশদ বিবরণ', 1, '2020-01-16 11:01:54'),
(131, 'en', 'STOCK_REPORT', 'STOCK REPORTS', 1, '2020-01-16 13:08:19'),
(132, 'bn', 'STOCK_REPORT', 'স্টক রিপোর্ট', 1, '2020-01-16 13:08:19'),
(133, 'en', 'STOCKS', 'STOCKS', 1, '2020-01-16 13:11:08'),
(134, 'bn', 'STOCKS', 'ভাণ্ডার', 1, '2020-01-16 13:11:08'),
(135, 'en', 'IN_STOCK', 'IN STOCK', 1, '2020-01-16 13:13:30'),
(136, 'bn', 'IN_STOCK', 'স্টকে আছে', 1, '2020-01-16 13:13:31'),
(137, 'en', 'PRODUCT_LIMIT_ADD', 'PRODUCT LIMIT ADD', 1, '2020-01-16 17:53:25'),
(138, 'bn', 'PRODUCT_LIMIT_ADD', 'প্রাধিকার যোগ করুন', 1, '2020-01-16 17:53:25'),
(139, 'en', 'PRODUCT_LIMIT', 'Product Requisition Limit', 1, '2020-01-16 17:59:00'),
(140, 'bn', 'PRODUCT_LIMIT', 'প্রাধিকার', 1, '2020-01-16 17:59:00'),
(141, 'en', 'ALL_PRODUCT_LIMIT', 'All Requisition Limit', 1, '2020-01-16 18:04:02'),
(142, 'bn', 'ALL_PRODUCT_LIMIT', 'সকল প্রাধিকার', 1, '2020-01-16 18:04:02'),
(143, 'en', 'DATE', 'DATE', 1, '2020-01-20 10:44:13'),
(144, 'bn', 'DATE', 'তারিখ', 1, '2020-01-20 10:44:13'),
(145, 'en', 'REQUISITIONS', 'Requisitions', 1, '2020-01-20 12:53:13'),
(146, 'bn', 'REQUISITIONS', 'চাহিদা পত্র', 1, '2020-01-20 12:53:13'),
(147, 'en', 'CREATE_REQUISITION', 'Create Requisition', 1, '2020-01-20 13:01:00'),
(148, 'bn', 'CREATE_REQUISITION', 'চাহিদা পত্র তৈরী করুন', 1, '2020-01-20 13:01:00'),
(149, 'en', 'MY_REQUISITIONS', 'My Requisitions', 1, '2020-01-20 13:02:21'),
(150, 'bn', 'MY_REQUISITIONS', 'আমার চাহিদা পত্র', 1, '2020-01-20 13:02:21'),
(151, 'en', 'REQUISITIONS_APPROVAL', 'Requisition for Approval', 1, '2020-01-20 13:10:19'),
(152, 'bn', 'REQUISITIONS_APPROVAL', 'অনুমোদনের জন্য অনুরোধ', 1, '2020-01-20 13:10:19'),
(153, 'en', 'IN_PRADHIKAR', 'Stock Limit', 1, '2020-01-21 11:51:39'),
(154, 'bn', 'IN_PRADHIKAR', 'প্রাপ্য স্টক', 1, '2020-01-21 11:51:39'),
(155, 'en', 'COMPANY_SETTING', 'Company Setting', 1, '2020-01-24 11:13:36'),
(156, 'bn', 'COMPANY_SETTING', 'কোম্পানি সেটিং', 1, '2020-01-24 11:13:36'),
(157, 'en', 'YEAR', 'Year', 1, '2020-01-24 14:48:30'),
(158, 'bn', 'YEAR', 'বছর', 1, '2020-01-24 14:48:30'),
(159, 'en', 'MONTH', 'Month', 1, '2020-01-24 14:49:05'),
(160, 'bn', 'MONTH', 'মাস', 1, '2020-01-24 14:49:05'),
(161, 'en', 'STOCK_OUT', 'Stock Out', 1, '2020-01-24 16:43:44'),
(162, 'bn', 'STOCK_OUT', 'স্টক আউট', 1, '2020-01-24 16:43:44'),
(163, 'en', 'ALL_STOCK_OUTS', 'All Stock Outs', 1, '2020-01-24 16:47:02'),
(164, 'bn', 'ALL_STOCK_OUTS', 'সমস্ত স্টক আউট', 1, '2020-01-24 16:47:02'),
(165, 'en', 'STOCK_OUT_ENTRY', 'Stock Out Entry', 1, '2020-01-24 16:47:33'),
(166, 'bn', 'STOCK_OUT_ENTRY', 'স্টক আউট এন্ট্রি', 1, '2020-01-24 16:47:33'),
(167, 'en', 'RECEIVER', 'Receiver', 1, '2020-01-24 18:54:21'),
(168, 'bn', 'RECEIVER', 'গ্রহণকারী', 1, '2020-01-24 18:54:21'),
(169, 'en', 'DEMANDER', 'Requisition Holder', 1, '2020-01-25 11:54:40'),
(170, 'bn', 'DEMANDER', 'চাহিদাকারী', 1, '2020-01-25 11:54:40'),
(171, 'en', 'PRODUCT_LEDGER', 'Products Ledger', 1, '2020-01-25 12:07:11'),
(172, 'bn', 'PRODUCT_LEDGER', 'পণ্যের লেজার', 1, '2020-01-25 12:07:11'),
(173, 'en', 'DATE_FROM', 'Date From', 1, '2020-01-25 12:49:28'),
(174, 'bn', 'DATE_FROM', 'তারিখ হতে', 1, '2020-01-25 12:49:28'),
(175, 'en', 'DATE_TO', 'Date To', 1, '2020-01-25 12:49:48'),
(176, 'bn', 'DATE_TO', 'তারিখ পর্যন্ত', 1, '2020-01-25 12:49:48'),
(177, 'en', 'OPENING', 'OPENING', 1, '2020-01-25 14:15:20'),
(178, 'bn', 'OPENING', 'ওপেনিং', 1, '2020-01-25 14:15:20'),
(179, 'en', 'TRANSACTION', 'TRANSACTION', 1, '2020-01-25 14:15:54'),
(180, 'bn', 'TRANSACTION', 'লেনদেন', 1, '2020-01-25 14:15:54'),
(181, 'en', 'TOTAL', 'Total', 1, '2020-01-25 15:03:18'),
(182, 'bn', 'TOTAL', 'মোট', 1, '2020-01-25 15:03:18'),
(183, 'en', 'PURCHASE', 'PURCHASE', 1, '2020-01-26 12:03:08'),
(184, 'bn', 'PURCHASE', 'ক্রয় / জমা', 1, '2020-01-26 12:03:08'),
(185, 'en', 'DISTRIBUTION', 'DISTRIBUTION', 1, '2020-01-26 12:03:50'),
(186, 'bn', 'DISTRIBUTION', 'বিতরণ', 1, '2020-01-26 12:03:50'),
(187, 'en', 'RECEIVED', 'RECEIVED', 1, '2020-01-26 15:12:09'),
(188, 'bn', 'RECEIVED', 'গৃহীত', 1, '2020-01-26 15:12:09'),
(189, 'en', 'LIMIT', 'LIMIT', 1, '2020-01-26 15:12:51'),
(190, 'bn', 'LIMIT', 'সীমাবদ্ধতা', 1, '2020-01-26 15:12:51'),
(191, 'en', 'VIEW', 'View', 1, '2020-01-26 17:07:47'),
(192, 'bn', 'VIEW', 'বিস্তারিত', 1, '2020-01-26 17:07:47'),
(193, 'en', 'PENDING', 'Pending Approval', 1, '2020-01-26 17:43:31'),
(194, 'bn', 'PENDING', 'অনুমোদন অপেক্ষারত', 1, '2020-01-26 17:43:32'),
(195, 'en', 'USER_ACCESS', 'User Management', 1, '2020-01-31 17:57:56'),
(196, 'bn', 'USER_ACCESS', 'ব্যবহারকারী ব্যবস্থাপনা', 1, '2020-01-31 17:57:56'),
(197, 'en', 'EMP_ID', 'Employee ID', 1, '2020-02-02 14:01:13'),
(198, 'bn', 'EMP_ID', 'কর্মকর্তার আইডি', 1, '2020-02-02 14:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `languages_type`
--

CREATE TABLE `languages_type` (
  `languages_type_id` int(10) UNSIGNED NOT NULL,
  `languages_type_name` varchar(255) NOT NULL,
  `languages_type_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages_type`
--

INSERT INTO `languages_type` (`languages_type_id`, `languages_type_name`, `languages_type_code`) VALUES
(1, 'english', 'en'),
(2, 'Bangla', 'bn');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `main_menu_id` int(10) UNSIGNED NOT NULL,
  `main_menu_name` varchar(50) NOT NULL,
  `main_menu_icon` varchar(255) NOT NULL,
  `main_menu_rank` int(10) NOT NULL,
  `main_menu_link` varchar(255) NOT NULL DEFAULT '#',
  `main_menu_has_access` text DEFAULT NULL,
  `main_menu_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`main_menu_id`, `main_menu_name`, `main_menu_icon`, `main_menu_rank`, `main_menu_link`, `main_menu_has_access`, `main_menu_status`) VALUES
(1, 'SETTING', 'settings_applications', 999, '', '1,2,3,4', 1),
(2, 'REPORTS', 'settings_input_antenna', 7, '#', '1,2,3,4', 1),
(18, 'MASTER_CONFIGURATION', 'settings_system_daydream', 1, '', '1,2,3,4', 1),
(20, 'EMPLOYEE_INFORMATION', 'people', 2, 'employee_information/all', '1,2,3,4', 1),
(21, 'SUPPLIERS', 'add_shopping_cart', 3, 'suppliers/all', '1,2,3,4', 1),
(22, 'STORE_RECEIVE', 'shopping_basket', 3, '#', '1,4', 1),
(23, 'PRODUCT_LIMIT', 'security', 2, '#', '1,2,3,4,5', 1),
(24, 'REQUISITIONS', 'gradient', 4, '#', '1,2,3,4,5,6', 1),
(25, 'REQUISITIONS_APPROVAL', 'exit_to_app', 5, 'requisitions/approval', '1,5', 1),
(26, 'STOCK_OUT', 'card_giftcard', 6, '#', '1,4', 1),
(27, 'USER_ACCESS', 'verified_user', 1, 'employee_information/view_all', '1,2,3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `modules_id` int(10) NOT NULL,
  `modules_name` varchar(255) NOT NULL,
  `modules_table` varchar(255) NOT NULL,
  `modules_access` text DEFAULT NULL,
  `modules_status` int(1) NOT NULL DEFAULT 1,
  `modules_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`modules_id`, `modules_name`, `modules_table`, `modules_access`, `modules_status`, `modules_date`) VALUES
(1, 'Users', 'users', NULL, 1, '2019-10-12 12:27:10'),
(2, 'Company Settings', 'company_settings', NULL, 1, '2019-10-12 15:30:12'),
(3, 'Modules', 'modules', NULL, 1, '2019-10-12 12:27:10'),
(4, 'Main Menu', 'main_menu', NULL, 1, '2019-10-12 12:27:10'),
(5, 'Sub Menu', 'sub_menu', NULL, 1, '2019-10-12 12:27:10'),
(6, 'Top Menu', 'top_menu', NULL, 1, '2019-10-12 12:27:10'),
(7, 'Grid Setting', 'grid_setting', NULL, 1, '2019-10-12 12:27:10'),
(10, 'languages', 'languages', NULL, 1, '2020-01-01 00:09:06'),
(11, 'Department', 'department', NULL, 1, '2020-01-01 21:37:15'),
(12, 'Office', 'office', NULL, 1, '2020-01-02 12:15:46'),
(13, 'Section', 'section', NULL, 1, '2020-01-03 17:36:09'),
(14, 'Designation', 'designation', NULL, 1, '2020-01-05 16:22:54'),
(15, 'Gender', 'gender', NULL, 1, '2020-01-05 16:57:06'),
(16, 'Employee Type', 'employee_type', NULL, 1, '2020-01-05 17:08:37'),
(17, 'Employee Grade', 'employee_grade', NULL, 1, '2020-01-05 17:19:03'),
(18, 'Unit', 'unit', NULL, 1, '2020-01-05 18:43:06'),
(19, 'Product Category', 'product_category', NULL, 1, '2020-01-05 18:51:33'),
(20, 'Employee Information', 'employee_information', NULL, 1, '2020-01-06 13:36:07'),
(21, 'Suppliers', 'suppliers', NULL, 1, '2020-01-07 11:49:38'),
(22, 'Product', 'product', NULL, 1, '2020-01-08 18:58:24'),
(23, 'Approval', 'approval', NULL, 1, '2020-01-09 16:52:27'),
(24, 'Store Receive', 'store_receive', NULL, 1, '2020-01-12 15:02:54'),
(25, 'stocks', 'stocks', NULL, 1, '2020-01-16 13:04:28'),
(26, 'Product Limit', 'product_limit', NULL, 1, '2020-01-16 17:44:00'),
(27, 'Requisitions', 'requisitions', NULL, 1, '2020-01-20 12:51:58'),
(28, 'Stock Out', 'stock_out', NULL, 1, '2020-01-24 16:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office_department` int(10) NOT NULL,
  `office_en` varchar(255) NOT NULL,
  `office_bn` varchar(255) NOT NULL,
  `office_status` int(2) NOT NULL DEFAULT 1,
  `office_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_department`, `office_en`, `office_bn`, `office_status`, `office_date`) VALUES
(1, 1, 'MINISTRY OF JUTE AND TEXTILES', 'পাট ও বস্ত্র মন্ত্রণালয়', 1, '2020-01-03 16:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_category` int(10) DEFAULT NULL,
  `product_unit` int(10) DEFAULT NULL,
  `product_name_en` varchar(255) DEFAULT NULL,
  `product_name_bn` varchar(255) DEFAULT NULL,
  `product_stock_limit` int(10) DEFAULT NULL,
  `product_status` int(2) NOT NULL DEFAULT 1,
  `product_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_category`, `product_unit`, `product_name_en`, `product_name_bn`, `product_stock_limit`, `product_status`, `product_date`) VALUES
(8, 2, 1, 'Offset Paper A4 Size', 'অফসেট পেপার A4 সাইজ', 20, 1, '2020-01-20 13:24:30'),
(9, 2, 1, 'Offset Paper A6 Size', 'অফসেট পেপার A6 সাইজ', 20, 1, '2020-01-20 13:25:22'),
(10, 3, 1, 'Tissue Paper', 'টিস্যু পেপার', 20, 1, '2020-01-20 13:25:49'),
(11, 3, 1, 'Toilet Paper', 'টয়লেট পেপার', 20, 1, '2020-01-20 13:29:35'),
(12, 2, 1, 'General Ballpen', 'সাধারণ বলপেন', 20, 1, '2020-01-20 13:30:12'),
(13, 2, 1, 'Red Ballpen', 'লাল বলপেন', 20, 1, '2020-01-20 13:43:35'),
(14, 4, 1, 'Lux Soap', 'লাক্স সাবান', 20, 1, '2020-01-20 14:01:28'),
(15, 4, 1, 'Wheel Soap', 'হুইল সাবান', 20, 1, '2020-01-20 14:03:02'),
(16, 4, 1, 'Veem Powder', 'ভীম পাউডার', 20, 1, '2020-01-20 14:03:35'),
(17, 2, 1, 'Carment Column', 'কারমেন্ট কলাম', 20, 1, '2020-01-20 14:04:12'),
(18, 4, 1, 'Air Freshener ', 'এয়ারফ্রেশেনার', 20, 1, '2020-01-20 14:05:40'),
(19, 4, 1, 'aerosol', 'এরোসল', 20, 1, '2020-01-20 14:06:24'),
(20, 4, 1, 'Lifeboy Liquid Soap', 'লাইফবয় লিকুইড সাবান', 20, 1, '2020-01-20 14:07:19'),
(21, 2, 1, 'Link Gliser Black Ballpen', 'লিংক গ্লাইসার কালো বলপেন', 20, 1, '2020-01-20 14:09:52'),
(22, 2, 1, 'Pencill Battery', 'পেন্সিল ব্যাটারি', 20, 1, '2020-01-20 14:10:27'),
(23, 2, 1, 'Yellow Marker', 'হলুদ মার্কার', 20, 1, '2020-01-20 14:11:07'),
(24, 2, 1, 'Green Marker', 'সবুজ মার্কার', 20, 1, '2020-01-20 15:00:36'),
(25, 2, 1, 'White Flutie ', 'সাদা ফ্লুইড', 20, 1, '2020-01-20 15:02:08'),
(26, 2, 1, 'Pencill Cutter', 'পেন্সিল কাটার', 20, 1, '2020-01-20 15:02:44'),
(27, 2, 1, 'Pencill', 'পেন্সিল', 20, 1, '2020-01-20 15:03:13'),
(28, 2, 1, 'Eraser', 'রাবার', 20, 1, '2020-01-20 15:03:45'),
(29, 2, 1, 'Small White Kham', 'সাদা খাম (ছোট)', 20, 1, '2020-01-20 15:04:27'),
(30, 2, 1, 'Knife', 'ছুরি', 20, 1, '2020-01-20 15:05:04'),
(31, 2, 1, 'Anti Cutter', 'এন্ট্রি কাটার', 20, 1, '2020-01-20 15:07:59'),
(32, 2, 1, 'Scissors', 'কাঁচি', 20, 1, '2020-01-20 15:09:07'),
(33, 2, 1, 'Small Tap', 'কস্টেপ ছোট', 20, 1, '2020-01-20 15:09:40'),
(34, 2, 1, 'Big Tap', 'কস্টেপ বড়', 20, 1, '2020-01-20 15:10:19'),
(35, 2, 1, 'Stick Glue', 'স্টিক গাম', 20, 1, '2020-01-20 15:26:51'),
(36, 2, 1, 'Pilot V-5 Black Ballpen', 'পাইলট V-5 কালো বলপেন', 20, 1, '2020-01-20 15:27:56'),
(37, 2, 1, 'Pilot V-5 Green Ballpen', 'পাইলট V-5 সবুজ বলপেন', 20, 1, '2020-01-20 16:42:58'),
(38, 2, 1, 'Pilot V-5 Blue Ballpen', 'পাইলট V-5 নীল বলপেন', 20, 1, '2020-01-20 16:43:50'),
(39, 2, 1, 'Pilot V-7 Blakck Ballpen', 'পাইলট V-7 কালো বলপেন', 20, 1, '2020-01-20 16:44:26'),
(40, 2, 1, 'Stamp Pad Ink', 'ষ্ট্যাম্প প্যাড কালি', 20, 1, '2020-01-20 16:45:09'),
(41, 2, 1, 'Glue Pot', 'গামপট (বড়)', 20, 1, '2020-01-20 16:45:50'),
(42, 2, 1, 'Candles', 'মোমবাতি', 20, 1, '2020-01-20 16:56:08'),
(43, 2, 1, 'Soap Case', 'সাবান কেইস', 20, 1, '2020-01-20 16:58:03'),
(44, 2, 1, 'Steel Scale', 'ষ্টীলের স্কেল', 20, 1, '2020-01-20 16:58:36'),
(45, 2, 1, 'Punch Machine', 'পাঞ্চ মেশিন', 20, 1, '2020-01-20 18:09:03'),
(46, 2, 1, 'Napkine Paper', 'ন্যাপকিন পেপার', 20, 1, '2020-01-20 18:09:56'),
(47, 2, 1, 'Plastic File Cover', 'প্লাষ্টিক ফাইল কভার', 20, 1, '2020-01-20 18:10:29'),
(48, 2, 1, 'Pin Remover', 'পিন রিমোভার', 20, 1, '2020-01-20 18:11:15'),
(49, 2, 1, 'Stapler Machine', 'স্ট্যাপলার মেশিন', 20, 1, '2020-01-20 18:11:56'),
(50, 2, 1, 'Glue Stick', 'গ্লু-স্টিক', 20, 1, '2020-01-20 18:12:23'),
(51, 2, 1, 'Remote Battery', 'রিমোট ব্যাটারি', 20, 1, '2020-01-20 18:14:27'),
(52, 2, 1, 'Savlon (ACI)', 'স্যাভলন (এসিআই)', 20, 1, '2020-01-20 18:15:06'),
(53, 2, 1, 'Paper wet', 'পেপার ওয়েট', 20, 1, '2020-01-20 18:15:39'),
(54, 2, 1, 'Guard File', 'গার্ড ফাইল', 20, 1, '2020-01-20 18:16:02'),
(55, 2, 1, 'Register', 'রেজিষ্টার', 20, 1, '2020-01-20 18:16:23'),
(56, 2, 1, 'Magazine File', 'ম্যাগাজিন ফাইল', 20, 1, '2020-01-20 18:17:07'),
(57, 2, 1, 'Calling Bail', 'কলিং বেল', 20, 1, '2020-01-20 18:18:07'),
(58, 2, 1, 'Big Stapler Pin', 'বড় স্ট্যাপলার পিন', 20, 1, '2020-01-20 18:19:00'),
(59, 2, 1, 'James Clip', 'জেমস ক্লিপ', 20, 1, '2020-01-20 18:20:30'),
(60, 2, 1, 'Calculator', 'ক্যালকুলেটর', 20, 1, '2020-01-20 18:21:02'),
(61, 2, 1, 'Plastic Pad', 'প্লাষ্টিক প্যাড', 20, 1, '2020-01-20 18:21:56'),
(62, 2, 1, 'Basket', 'ঝুড়ি', 20, 1, '2020-01-20 18:23:17'),
(63, 3, 1, 'Harpic', 'হারপিক', 20, 1, '2020-01-20 18:25:18'),
(64, 3, 1, 'Odonill', 'অডোনীল', 20, 1, '2020-01-20 18:25:57'),
(65, 3, 1, 'bleaching powder', 'ব্লিচিং পাউডার', 20, 1, '2020-01-20 18:26:52'),
(66, 2, 1, 'Middle Stapler Pin', 'মাঝারী স্ট্যাপলার পিন', 20, 1, '2020-01-20 18:27:46'),
(67, 2, 1, 'Pin File', 'পিন ফাইল', 20, 1, '2020-01-20 18:28:05'),
(68, 2, 1, 'Punch Machine 1 hole', 'পাঞ্চ মেশিন 1 ছিদ্র', 20, 1, '2020-01-20 18:29:08'),
(69, 2, 1, 'Wall Fan', 'ওয়াল ফ্যান', 20, 1, '2020-01-20 18:30:22'),
(70, 2, 1, 'Window Screen', 'জানালার পর্দা', 20, 1, '2020-01-20 18:31:49'),
(71, 2, 1, 'wardrobe', 'ওয়ারড্রপ', 20, 1, '2020-01-20 18:33:21'),
(72, 2, 1, 'Mobile Drawer', 'মোবাইল ড্রয়ার', 20, 1, '2020-01-20 18:33:55'),
(73, 2, 1, 'Table Top Glass', 'টেবিল টপ গ্লাস', 20, 1, '2020-01-20 18:34:26'),
(74, 5, 1, 'Full Secretariat Table', 'ফুল সেক্রেটারিয়েট টেবিল ', 1, 1, '2020-01-27 16:21:18'),
(75, 5, 1, 'Utility table', 'ইউটিলিটি টেবিল', 1, 1, '2020-01-27 16:30:02'),
(76, 5, 1, 'Armored cushion chair', 'আর্মড কুশন চেয়ার  ', 1, 1, '2020-01-27 16:32:15'),
(77, 5, 1, 'Armored cushion ', 'আর্মড কুশন', 5, 1, '2020-01-27 16:33:05'),
(78, 5, 1, 'Sofa set', 'সোফা সেট ', 1, 1, '2020-01-27 16:34:27'),
(79, 5, 1, 'Bookshelf', 'বুকসেলফ', 1, 1, '2020-01-27 16:35:31'),
(80, 5, 1, 'Steel file cabinets', 'ষ্টীল ফাইল কেবিনেট ', 1, 1, '2020-01-27 16:36:34'),
(81, 5, 1, 'Steel cupboard', 'ষ্টীল আলমারি ', 1, 1, '2020-01-27 16:37:42'),
(82, 5, 1, 'Footwear', 'পা দানী', 1, 1, '2020-01-27 16:41:53'),
(83, 5, 1, 'File Keep Rack', 'ফাইল রাখার রেক', 1, 1, '2020-01-27 16:43:24'),
(84, 5, 1, 'Wall mirror', 'দেয়াল আয়না ', 1, 1, '2020-01-27 16:44:35'),
(85, 5, 1, 'Half Secretariat Table', 'হাফ সেক্রেটারিয়েট টেবিল', 1, 1, '2020-01-27 16:49:45'),
(86, 5, 1, 'Revolving Chair', 'রিভলভিং চেয়ার ', 1, 1, '2020-01-27 16:51:30'),
(87, 5, 1, 'Wooden chair', 'কাঠের চেয়ার ', 1, 1, '2020-01-27 16:52:35'),
(88, 5, 1, 'kean seated chairs', 'কেন সিটেড  চেয়ার', 1, 1, '2020-01-27 16:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `product_category_en` varchar(50) NOT NULL,
  `product_category_bn` varchar(50) NOT NULL,
  `product_category_status` int(2) NOT NULL DEFAULT 1,
  `product_category_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_en`, `product_category_bn`, `product_category_status`, `product_category_date`) VALUES
(1, 'ICT', 'আই সি টি', 1, '2020-01-05 18:59:12'),
(2, 'Stationary', 'ষ্টেশনারী', 1, '2020-01-05 19:00:52'),
(3, 'Toiletries', 'টয়লেট্রিজ', 1, '2020-01-26 13:21:47'),
(4, 'Cosmetics', 'প্রসাধনী', 1, '2020-01-26 13:23:53'),
(5, 'Office furniture', 'অফিস আসবাবপত্র', 1, '2020-01-27 16:17:28'),
(6, 'Utility table', 'ইউটিলিটি টেবিল', 0, '2020-01-27 16:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_limit`
--

CREATE TABLE `product_limit` (
  `product_limit_id` int(11) NOT NULL,
  `product_limit_section` int(10) UNSIGNED NOT NULL,
  `product_limit_year` int(10) DEFAULT NULL,
  `product_limit_month` int(10) DEFAULT NULL,
  `product_limit_product` int(10) UNSIGNED NOT NULL,
  `product_limit_requisition_limit` int(10) UNSIGNED NOT NULL,
  `product_limit_status` int(2) NOT NULL DEFAULT 1,
  `product_limit_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `requisitions_id` int(11) NOT NULL,
  `requisitions_section` int(11) DEFAULT NULL,
  `requisitions_employee` int(11) DEFAULT NULL,
  `requisitions_receiver` int(10) DEFAULT NULL,
  `requisitions_status` int(2) NOT NULL DEFAULT 1,
  `requisitions_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`requisitions_id`, `requisitions_section`, `requisitions_employee`, `requisitions_receiver`, `requisitions_status`, `requisitions_date`) VALUES
(1, 37, 2, 52, 3, '2020-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions_details`
--

CREATE TABLE `requisitions_details` (
  `requisitions_details_id` int(10) NOT NULL,
  `requisitions_id` int(10) DEFAULT NULL,
  `requisitions_product` int(10) DEFAULT NULL,
  `requisitions_product_qty` int(10) DEFAULT NULL,
  `requisitions_approve_product_qty` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requisitions_details`
--

INSERT INTO `requisitions_details` (`requisitions_details_id`, `requisitions_id`, `requisitions_product`, `requisitions_product_qty`, `requisitions_approve_product_qty`) VALUES
(1, 1, 31, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_office` int(10) NOT NULL,
  `section_en` varchar(255) NOT NULL,
  `section_bn` varchar(255) NOT NULL,
  `section_status` int(2) NOT NULL DEFAULT 1,
  `section_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_office`, `section_en`, `section_bn`, `section_status`, `section_date`) VALUES
(8, 1, 'Planning-2', 'পরিকল্পনা-২', 1, '2020-01-27 11:12:19'),
(9, 1, 'Planning-1', 'পরিকল্পনা-১', 1, '2020-01-27 11:13:14'),
(10, 1, 'Ministry', 'মাননীয় মন্ত্রী', 1, '2020-01-27 11:13:18'),
(11, 1, ' Minister of State', 'প্রতিমন্ত্রী', 1, '2020-01-27 11:14:16'),
(12, 1, 'Jute -3', 'পাট-৩', 1, '2020-01-27 11:14:57'),
(13, 1, 'Secretary', 'সচিব', 1, '2020-01-27 11:15:11'),
(14, 1, 'Additional secretary(Beob)', 'অতিরিক্ত সচিব(বেওবি)', 1, '2020-01-27 11:16:13'),
(15, 1, ' Audit Branch', 'অডিট অধিশাখা', 1, '2020-01-27 11:18:26'),
(16, 1, 'Audit section', 'অডিট অনুবিভাগ ', 1, '2020-01-27 11:20:23'),
(17, 1, 'Audit-1 branch', 'অডিট-১ শাখা', 1, '2020-01-27 11:20:30'),
(18, 1, 'Audit-2 branch', 'অডিট- ২ শাখা', 1, '2020-01-27 11:22:33'),
(19, 1, 'Jute section', 'পাট অনুবিভাগ', 1, '2020-01-27 11:23:24'),
(20, 1, 'Joint Secretary(jute-2)', 'যুগ্ন সচিব (পাট-২)', 1, '2020-01-27 11:24:53'),
(21, 1, 'Senior Assistant Secretary (Jute-1)', 'সিনিয়র সহকারী সচিব(পাট-১)', 1, '2020-01-27 11:25:52'),
(22, 1, 'Textile section', 'বস্ত্র অনুবিভাগ ', 1, '2020-01-27 11:27:17'),
(23, 1, ' Jute Branch', 'পাট অধিশাখা', 1, '2020-01-27 11:28:00'),
(24, 1, 'Textile -3', 'বস্ত্র - ৩ ', 1, '2020-01-27 11:29:29'),
(25, 1, 'Jute-1', 'পাট-১', 1, '2020-01-27 11:30:23'),
(26, 1, 'Textile -2 branch', 'বস্ত্র -২ অধিশাখা', 1, '2020-01-27 11:33:19'),
(27, 1, 'Law section', 'আইন অনুবিভাগ', 1, '2020-01-27 11:34:22'),
(28, 1, 'Planning department', 'পরিকল্পনা অনুবিভাগ', 1, '2020-01-27 11:35:57'),
(29, 1, 'Administration section', 'প্রশাসন অনুবিভাগ ', 1, '2020-01-27 11:53:58'),
(30, 1, 'Textile -1', 'বস্ত্র -১', 1, '2020-01-27 11:54:47'),
(31, 1, ' Administration-2 branch', 'প্রশাসন-২ শাখা ', 1, '2020-01-27 11:55:03'),
(32, 1, 'ICT cell', 'আইসিটি সেল ', 1, '2020-01-27 11:56:08'),
(33, 1, 'Law-2 Branch', 'আইন-২ অধিশাখা', 1, '2020-01-27 11:56:59'),
(34, 1, 'Administration Branch', 'প্রশাসন অধিশাখা ', 1, '2020-01-27 11:57:42'),
(35, 1, 'Law-1 Branch', 'আইন-১ অধিশাখা', 1, '2020-01-27 11:58:37'),
(36, 1, 'Administration-1 Branch', 'প্রশাসন-১ অধিশাখা', 1, '2020-01-27 11:58:44'),
(37, 1, 'Accounting branch', 'হিসাব শাখা ', 0, '2020-01-27 11:59:43'),
(38, 1, 'Assistant Secretary ( bay o Bi)', 'সহকারী সচিব ( বে ও বি)', 1, '2020-01-27 12:04:23'),
(39, 1, 'Planning Branch', 'পরিকল্পনা অধিশাখা', 1, '2020-01-27 12:05:51'),
(40, 1, 'Deputy Secretary (Budget)', 'উপসচিব (বাজেট)', 1, '2020-01-27 12:07:51'),
(41, 1, 'Deputy Secretary (Coordination and Parliament)', 'উপসচিব (সমন্বয় ও সংসদ)', 1, '2020-01-27 12:13:31'),
(42, 1, 'Accounting branch', 'হিসাব শাখা', 1, '2020-01-27 12:21:57'),
(43, 1, 'Joint Secretary(budget)', 'যুগ্ন সচিব (বাজেট )', 1, '2020-01-27 12:27:21'),
(44, 1, 'Textile Branch', 'বস্ত্র অধিশাখা', 1, '2020-01-27 12:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stocks_id` int(11) NOT NULL,
  `stocks_product_id` int(11) UNSIGNED NOT NULL,
  `stocks_pre_stock` double DEFAULT NULL,
  `stocks_trng_qty_in` double DEFAULT NULL,
  `stocks_trng_qty_out` double DEFAULT NULL,
  `stocks_current_stock` double DEFAULT NULL,
  `stocks_trng_type` varchar(10) NOT NULL,
  `stocks_section` int(11) UNSIGNED NOT NULL,
  `stocks_status` int(2) NOT NULL DEFAULT 1,
  `stocks_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stocks_id`, `stocks_product_id`, `stocks_pre_stock`, `stocks_trng_qty_in`, `stocks_trng_qty_out`, `stocks_current_stock`, `stocks_trng_type`, `stocks_section`, `stocks_status`, `stocks_date`) VALUES
(1, 31, 0, NULL, 1, -1, 'OUT', 37, 1, '2020-01-31 16:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `stock_out_id` int(11) NOT NULL,
  `stock_out_section` int(10) DEFAULT NULL,
  `stock_out_requisition` int(10) DEFAULT NULL,
  `stock_out_receiver` int(10) DEFAULT NULL,
  `stock_out_entry` int(10) DEFAULT NULL,
  `stock_out_status` int(2) NOT NULL DEFAULT 1,
  `stock_out_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`stock_out_id`, `stock_out_section`, `stock_out_requisition`, `stock_out_receiver`, `stock_out_entry`, `stock_out_status`, `stock_out_date`) VALUES
(1, 37, 1, 52, 0, 1, '2020-01-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_details`
--

CREATE TABLE `stock_out_details` (
  `stock_out_details_id` int(11) NOT NULL,
  `stock_out_details_stock_out_id` int(10) DEFAULT NULL,
  `stock_out_details_product` int(10) DEFAULT NULL,
  `stock_out_details_product_qty` int(10) DEFAULT NULL,
  `stock_out_details_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_out_details`
--

INSERT INTO `stock_out_details` (`stock_out_details_id`, `stock_out_details_stock_out_id`, `stock_out_details_product`, `stock_out_details_product_qty`, `stock_out_details_date`) VALUES
(1, 1, 31, 1, '2020-01-31 16:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `store_receive`
--

CREATE TABLE `store_receive` (
  `store_receive_id` int(11) NOT NULL,
  `store_receive_section` int(10) UNSIGNED NOT NULL,
  `store_receive_indent` varchar(255) NOT NULL,
  `store_receive_supplier` int(10) UNSIGNED DEFAULT NULL,
  `store_receive_comments` text DEFAULT NULL,
  `store_receive_status` int(2) NOT NULL DEFAULT 1,
  `store_receive_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_receive_details`
--

CREATE TABLE `store_receive_details` (
  `store_receive_details_id` int(10) UNSIGNED NOT NULL,
  `store_receive_details_rcv_id` int(11) UNSIGNED NOT NULL,
  `store_receive_details_section` int(11) UNSIGNED NOT NULL,
  `store_receive_details_product_id` int(10) UNSIGNED NOT NULL,
  `store_receive_details_quantity` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `sub_menu_id` int(10) UNSIGNED NOT NULL,
  `sub_menu_name` varchar(50) NOT NULL,
  `sub_menu_link` varchar(255) NOT NULL,
  `sub_menu_main` int(10) NOT NULL,
  `sub_menu_rank` int(5) NOT NULL,
  `sub_menu_icon` varchar(50) NOT NULL,
  `sub_menu_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`sub_menu_id`, `sub_menu_name`, `sub_menu_link`, `sub_menu_main`, `sub_menu_rank`, `sub_menu_icon`, `sub_menu_status`) VALUES
(1, 'COMPANY_SETTING', 'company_settings/all', 1, 1, 'add_shopping_cart', 1),
(17, 'DEPARTMENT', 'department/all', 18, 1, 'assessment', 1),
(18, 'OFFICE', 'office/all', 18, 2, 'domain', 1),
(19, 'SECTION', 'section/all', 18, 3, 'grid_on', 1),
(20, 'DESIGNATION', 'designation/all', 18, 4, 'accessible', 1),
(21, 'GENDER', 'gender/all', 18, 5, 'people', 1),
(22, 'EMPLOYEE_TYPE', 'employee_type/all', 18, 6, 'assignment_ind', 1),
(23, 'EMPLOYEE_GRADE', 'employee_grade/all', 18, 7, 'assessment', 1),
(24, 'UNIT', 'unit/all', 18, 8, 'invert_colors', 1),
(25, 'PRODUCT_CATEGORY', 'product_category/all', 18, 9, 'color_lens', 1),
(26, 'PRODUCT', 'product/all', 18, 10, 'weekend', 1),
(27, 'APPROVAL', 'approval/all', 18, 0, 'security', 1),
(28, 'NEW_ENTRY', 'store_receive/create', 22, 1, 'add_circle', 1),
(29, 'STORE_ALL', 'store_receive/all', 22, 2, 'pageview', 1),
(30, 'STOCK_REPORT', 'stocks/all', 2, 1, 'art_track', 1),
(31, 'PRODUCT_LIMIT_ADD', 'product_limit/create', 23, 1, 'next_week', 1),
(32, 'ALL_PRODUCT_LIMIT', 'product_limit/all', 23, 2, 'pages', 1),
(33, 'CREATE_REQUISITION', 'requisitions/create', 24, 1, 'iso', 1),
(34, 'MY_REQUISITIONS', 'requisitions/all', 24, 2, 'view_comfy', 1),
(35, 'STOCK_OUT_ENTRY', 'stock_out/create', 26, 1, 'redeem', 1),
(36, 'ALL_STOCK_OUTS', 'stock_out/all', 26, 2, 'exit_to_app', 1),
(37, 'PRODUCT_LEDGER', 'product_ledger/ledger', 2, 2, 'receipt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `suppliers_id` int(11) NOT NULL,
  `suppliers_en` varchar(255) DEFAULT NULL,
  `suppliers_bn` varchar(255) DEFAULT NULL,
  `suppliers_mobile_personal` varchar(255) DEFAULT NULL,
  `suppliers_phone_business` varchar(255) DEFAULT NULL,
  `suppliers_fax` varchar(255) DEFAULT NULL,
  `suppliers_email` varchar(255) DEFAULT NULL,
  `suppliers_address` text DEFAULT NULL,
  `suppliers_nid_no` varchar(255) DEFAULT NULL,
  `suppliers_nid_file` varchar(255) DEFAULT NULL,
  `suppliers_photo` varchar(255) DEFAULT NULL,
  `suppliers_status` int(2) NOT NULL DEFAULT 1,
  `suppliers_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`suppliers_id`, `suppliers_en`, `suppliers_bn`, `suppliers_mobile_personal`, `suppliers_phone_business`, `suppliers_fax`, `suppliers_email`, `suppliers_address`, `suppliers_nid_no`, `suppliers_nid_file`, `suppliers_photo`, `suppliers_status`, `suppliers_date`) VALUES
(1, 'Mahtab Store', 'মাহতাব স্টোর', '0125452458', '958745895', '5698545', 'mahtab_store@gmail.com', 'Purana Paltan, Dhaka', '9854785458745', '', '89acaf8efe450c44acb5a6226a33ab5a.png', 1, '2020-01-07 12:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `target` varchar(255) NOT NULL,
  `property` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `user_id`, `target`, `property`, `value`, `created`, `updated`) VALUES
(1, 1, 'header', 'background-color', '#CCC', '2019-10-26 06:53:02', '2019-10-26 06:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `top_menu`
--

CREATE TABLE `top_menu` (
  `top_menu_id` int(10) UNSIGNED NOT NULL,
  `top_menu_name` varchar(20) NOT NULL,
  `top_menu_icon` varchar(100) NOT NULL,
  `top_menu_rank` int(10) NOT NULL,
  `top_menu_link` varchar(255) NOT NULL,
  `top_menu_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `top_menu`
--

INSERT INTO `top_menu` (`top_menu_id`, `top_menu_name`, `top_menu_icon`, `top_menu_rank`, `top_menu_link`, `top_menu_status`) VALUES
(1, 'Users', 'fa fa-users', 1, 'users/all', 1),
(2, 'Sales', 'fas fa-shopping-cart', 2, '#', 1),
(3, 'Settings', 'fa fa-users', 1, 'users/all', 1),
(4, 'Purchase', 'fas fa-shopping-cart', 1, '#', 1),
(5, 'Purchase 2', 'fas fa-shopping-cart', 3, '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_en` varchar(25) NOT NULL,
  `unit_bn` varchar(25) NOT NULL,
  `unit_status` int(2) NOT NULL DEFAULT 1,
  `unit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_en`, `unit_bn`, `unit_status`, `unit_date`) VALUES
(1, 'PCS', 'টি', 1, '2020-01-05 18:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_id_md5` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'User',
  `user_photo` varchar(255) NOT NULL,
  `user_emp_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_signature` varchar(255) DEFAULT NULL,
  `user_status` int(10) NOT NULL DEFAULT 1,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_id_md5`, `full_name`, `username`, `password`, `user_type`, `user_photo`, `user_emp_id`, `user_signature`, `user_status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'c4ca4238a0b923820dcc509a6f75849b', 'Md Salman Sajib', 'salman', '202cb962ac59075b964b07152d234b70', '1', 'd9402d305ef30bf566890ebec092e760.jpg', 0, NULL, 1, '2019-09-02 10:06:13', NULL, NULL),
(2, 'c81e728d9d4c2f636f067f89cc14862c', 'Lokman Hossain Miah', 'sectext@gmail.com', '0339f60da83aecd0deb28e3321af2cb7', '6', 'b68c38d1fdb4644c77a4a44f702a7e89.jpg', 1, NULL, 1, '2020-01-27 13:06:47', NULL, NULL),
(3, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Ms. Nasrin Akter', '01552408754', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 2, NULL, 1, '2020-01-27 13:11:36', NULL, NULL),
(4, 'a87ff679a2f3e71d9181a67b7542122c', 'Gulnar Nazmun Nahar', '01788779415', '0339f60da83aecd0deb28e3321af2cb7', '6', 'e722e8e16ede9bcc58a5af3311edeee6.jpg', 3, NULL, 1, '2020-01-27 13:11:50', NULL, NULL),
(5, 'e4da3b7fbbce2345d7772b0674a318d5', 'SAMSUN NAHAR JESMIN', '01745992563', '0339f60da83aecd0deb28e3321af2cb7', '6', 'dcf568aaa7e6fef143c4eb2a635325ca.jpg', 4, NULL, 1, '2020-01-27 13:15:21', NULL, NULL),
(6, '1679091c5a880faf6fb5e6087eb1b2dc', 'Sima Saha', '01711409843', '0339f60da83aecd0deb28e3321af2cb7', '6', '9fc1e7e3be252acf642cd0be67d0a8d7.jpg', 5, NULL, 1, '2020-01-27 13:15:23', NULL, NULL),
(7, '8f14e45fceea167a5a36dedd4bea2543', 'Mohammad Abul Kalam,NDC', '01711402668', '0339f60da83aecd0deb28e3321af2cb7', '6', 'b9323fd6787dcb423d199f58784092b7.jpg', 6, NULL, 1, '2020-01-27 13:18:26', NULL, NULL),
(8, 'c9f0f895fb98ab9159f51fd0297e236d', 'Aniruddha Sarkar', '01733870763', '0339f60da83aecd0deb28e3321af2cb7', '6', 'ada2dce6d825ed873dcf40c001f6bc46.jpg', 7, NULL, 1, '2020-01-27 13:20:33', NULL, NULL),
(9, '45c48cce2e2d7fbdea1afc51c7c6ad26', 'Md Mukbul Hossain', '01715131417', '0339f60da83aecd0deb28e3321af2cb7', '6', '74306d6b12c23d29fd40dcab245843fa.jpg', 8, NULL, 1, '2020-01-27 13:22:05', NULL, NULL),
(10, 'd3d9446802a44259755d38e6d163e820', 'S.M Mahbubul Haque', '01817522180', '0339f60da83aecd0deb28e3321af2cb7', '6', '4bebdd17fcb46654ebdf775372f501e4.jpg', 9, NULL, 1, '2020-01-27 13:23:33', NULL, NULL),
(11, '6512bd43d9caa6e02c990b0a82652dca', 'Mr Emdadul Haque', '01746192792', '0339f60da83aecd0deb28e3321af2cb7', '6', '381043719a83c12d4f5bfaf914a83038.jpg', 10, NULL, 1, '2020-01-27 13:29:42', NULL, NULL),
(12, 'c20ad4d76fe97759aa27a0c99bff6710', 'Md Abu Bakar Siddique, Ndc', '01715394735', '0339f60da83aecd0deb28e3321af2cb7', '6', 'bb47a45dbbed78799ff97903223cda10.jpg', 11, NULL, 1, '2020-01-27 13:32:35', NULL, NULL),
(13, 'c51ce410c124a10e0db5e4b97fc2af39', 'Shoheli Shirin Ahmed', '01550153607', '0339f60da83aecd0deb28e3321af2cb7', '6', '9a5111edd75c61ca74f129648f901351.jpg', 12, NULL, 1, '2020-01-27 13:35:58', NULL, NULL),
(14, 'aab3238922bcc25a6f606eb525ffdc56', 'Shams al-Mujahid', '01712151686', '0339f60da83aecd0deb28e3321af2cb7', '6', '1e0e3b30014e33f05f4e132e1121d493.jpg', 13, NULL, 1, '2020-01-27 13:38:57', NULL, NULL),
(15, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 'Mr Nasir Uddin', '01711130071', '0339f60da83aecd0deb28e3321af2cb7', '6', '775b5b2278495f2afd489944bfdb7749.jpg', 14, NULL, 1, '2020-01-27 13:41:14', NULL, NULL),
(16, 'c74d97b01eae257e44aa9d5bade97baf', 'Narayan Chandra Sarkar', '01711201332', '0339f60da83aecd0deb28e3321af2cb7', '6', 'c233dea9fd4ed5fdb5f03d821651cd50.jpg', 15, NULL, 1, '2020-01-27 13:41:30', NULL, NULL),
(17, '70efdf2ec9b086079795c442636b55fb', 'Mrs Nilufa Nazneen', '01712044518', '0339f60da83aecd0deb28e3321af2cb7', '6', 'c6dd163c8985bd6ff38c2b5eec1b04b7.jpg', 16, NULL, 1, '2020-01-27 13:43:48', NULL, NULL),
(18, '6f4922f45568161a8cdf4ad2299f6d23', 'Begum Shirin Sultana', '01552457153', '0339f60da83aecd0deb28e3321af2cb7', '6', 'f27861c78ddd5a0eed97c169fc516f05.jpg', 17, NULL, 1, '2020-01-27 13:44:56', NULL, NULL),
(19, '1f0e3dad99908345f7439f8ffabdffc4', 'Sabina Yeasmin', '01913514796', '0339f60da83aecd0deb28e3321af2cb7', '6', '99a29f2d26632068ff1624c147e720a5.jpg', 18, NULL, 1, '2020-01-27 13:47:29', NULL, NULL),
(20, '98f13708210194c475687be6106a3b84', 'MD OLIULLAH, NDC', '01745707209', '0339f60da83aecd0deb28e3321af2cb7', '6', '37c29fe7d73b7d9be42798dd3dfdd5d6.jpg', 19, NULL, 1, '2020-01-27 13:49:40', NULL, NULL),
(21, '3c59dc048e8850243be8079a5c74d079', 'Rashida Ferdouse, NDC', '01715029471', '0339f60da83aecd0deb28e3321af2cb7', '6', 'f37e483b77e2e731cb6dd232e6d7bf36.jpg', 20, NULL, 1, '2020-01-27 13:52:03', NULL, NULL),
(22, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Md Khurshid Iqbal Rezvi', '01970200654', '0339f60da83aecd0deb28e3321af2cb7', '6', '02cd4fbf247150080a33719d2d5b021a.jpg', 21, NULL, 1, '2020-01-27 13:54:07', NULL, NULL),
(23, '37693cfc748049e45d87b8c7d8b9aacd', 'K. M. Rafiqul Islam', '01720116148', '0339f60da83aecd0deb28e3321af2cb7', '6', 'bffb6bd4446e4ad222fb10bf3853f58f.jpg', 22, NULL, 1, '2020-01-27 13:56:45', NULL, NULL),
(24, '1ff1de774005f8da13f42943881c655f', 'Md Nasir Uddin', '01722657913', '0339f60da83aecd0deb28e3321af2cb7', '6', '76c809eb8de184aad2aa29adbc1d3988.jpg', 23, NULL, 1, '2020-01-27 13:56:49', NULL, NULL),
(25, '8e296a067a37563370ded05f5a3bf3ec', 'Mr. Humayun Kabir', '01711319221', '0339f60da83aecd0deb28e3321af2cb7', '6', '3a952b931dc8f705e1cc047567807578.jpg', 24, NULL, 1, '2020-01-27 14:00:16', NULL, NULL),
(26, '4e732ced3463d06de0ca9a15b6153677', 'Mr. Saikat Chnadra Halder', '01712492665', '0339f60da83aecd0deb28e3321af2cb7', '6', '80e398a0ffdfc3928dea436bde81bf94.jpg', 25, NULL, 1, '2020-01-27 14:01:53', NULL, NULL),
(27, '02e74f10e0327ad868d138f2b4fdd6f0', 'MD. ABUL BASHER SIDDIQUE AKAND', '01726373556', '0339f60da83aecd0deb28e3321af2cb7', '6', '2f820527e308a8538fc03a974eaf0fdd.jpg', 26, NULL, 1, '2020-01-27 14:02:49', NULL, NULL),
(28, '33e75ff09dd601bbe69f351039152189', '	Mr. MD KAMRUZZAMAN', '01552323546', '0339f60da83aecd0deb28e3321af2cb7', '6', 'd69dda737c93a656e906acabaa284144.png', 27, NULL, 1, '2020-01-27 14:05:33', NULL, NULL),
(29, '6ea9ab1baa0efb9e19094440c317e21b', 'Md Aminul Islam', '01717924757', '0339f60da83aecd0deb28e3321af2cb7', '6', 'af202ba7a405c90ecd3457fe6c90bfa3.jpg', 28, NULL, 1, '2020-01-27 14:05:33', NULL, NULL),
(30, '34173cb38f07f89ddbebc2ac9128303f', 'Md. Shafiur Rahman', '01843761549', '0339f60da83aecd0deb28e3321af2cb7', '6', '04289abe8a4315528a9aaa53ae844837.jpg', 29, NULL, 1, '2020-01-27 14:26:18', NULL, NULL),
(31, 'c16a5320fa475530d9583c34fd356ef5', 'Mr Shek Shamsur Rahman', '01916481664', '0339f60da83aecd0deb28e3321af2cb7', '6', '5087d129472d8d45610f01196ba9d624.jpg', 30, NULL, 1, '2020-01-27 14:29:31', NULL, NULL),
(32, '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 'Md. Saiful Islam', '01726800374', '0339f60da83aecd0deb28e3321af2cb7', '6', '98b62918ac4994b95a0e6cc725351c61.png', 31, NULL, 1, '2020-01-27 14:32:20', NULL, NULL),
(33, '182be0c5cdcd5072bb1864cdee4d3d6e', 'MD. SAIFUL ISLAM BHUIYAN', '01721181290', '0339f60da83aecd0deb28e3321af2cb7', '6', 'fea14d867c6f256972a9287bf839c363.png', 32, NULL, 1, '2020-01-27 14:35:00', NULL, NULL),
(34, 'e369853df766fa44e1ed0ff613f563bd', 'A.T.M Alimuzzaman', '01718400017', '0339f60da83aecd0deb28e3321af2cb7', '6', '3c0f6d9d5c46fe630ae345fc31f36260.jpg', 33, NULL, 1, '2020-01-27 14:37:39', NULL, NULL),
(35, '1c383cd30b7c298ab50293adfecb7b18', 'Md. Kamal Atahar Hossian', '017111132742', '0339f60da83aecd0deb28e3321af2cb7', '6', 'd6fce28a30966c9a67e1f44d5bf0219f.png', 34, NULL, 1, '2020-01-27 14:40:43', NULL, NULL),
(36, '19ca14e7ea6328a42e0eb13d585e4c22', 'MAKSUDA BEGUM SIDDIKA', '01712559228', '0339f60da83aecd0deb28e3321af2cb7', '6', '67773c6094fda7b811b0e6cb4c23da0c.jpg', 35, NULL, 1, '2020-01-27 14:43:40', NULL, NULL),
(37, 'a5bfc9e07964f8dddeb95fc584cd965d', 'Md. Mizanur Rahman', '01712653201', '0339f60da83aecd0deb28e3321af2cb7', '6', 'f8dae5033ea6bec47bec1f0b71aceb8e.jpg', 36, NULL, 1, '2020-01-27 14:47:27', NULL, NULL),
(38, 'a5771bce93e200c36f7cd9dfd0e5deaa', 'Mr PARITOSH HAJRA', '01711906111', '0339f60da83aecd0deb28e3321af2cb7', '6', 'e8e8b150f35005a0c774c8e3a19e9e74.jpg', 37, NULL, 1, '2020-01-27 14:51:18', NULL, NULL),
(39, 'd67d8ab4f4c10bf22aa353e27879133c', 'khenchan', '01918898799', '0339f60da83aecd0deb28e3321af2cb7', '6', 'b6f48ce0e08238c82ea5bd4df8c363f8.jpg', 38, NULL, 1, '2020-01-27 14:54:58', NULL, NULL),
(40, 'd645920e395fedad7bbbed0eca3fe2e0', 'Mr. Mahbub Alam', '01710697320', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 39, NULL, 1, '2020-01-27 16:01:51', NULL, NULL),
(41, '3416a75f4cea9109507cacd8e2f2aefc', 'Mr. Mohammad Mofizul Islam', '01912914453', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 40, NULL, 1, '2020-01-27 16:05:05', NULL, NULL),
(42, 'a1d0c6e83f027327d8461063f4ac58a6', 'Md. Kamruzzaman Masum', '01914213426', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 41, NULL, 1, '2020-01-27 16:07:52', NULL, NULL),
(43, '17e62166fc8586dfa4d1bc0e1742c08b', 'Md. Shamsul Alam', '01713388052', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 42, NULL, 1, '2020-01-27 16:14:34', NULL, NULL),
(44, 'f7177163c833dff4b38fc8d2872f1ec6', 'Mr. Mohammad Anwar Hossain', '01753142736', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 43, NULL, 1, '2020-01-27 16:34:06', NULL, NULL),
(45, '6c8349cc7260ae62e3b1396831a8398f', 'Mr. Md. Mohiuddin', '01821678653', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 44, NULL, 1, '2020-01-27 16:39:52', NULL, NULL),
(46, 'd9d4f495e875a2e075a1a4a6e1b9770f', ' Mr. Saleha Begum', '01552494794', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 45, NULL, 1, '2020-01-27 16:53:53', NULL, NULL),
(47, '67c6a1e7ce56d3d6fa748ab6d9af3fd7', 'Mosa: Mumtaz Begum', '01775016066', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 46, NULL, 1, '2020-01-27 16:58:04', NULL, NULL),
(48, '642e92efb79421734881b53e1e1b18b6', 'Kamrunnahar', '01775669565', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 47, NULL, 1, '2020-01-27 17:00:51', NULL, NULL),
(49, 'f457c545a9ded88f18ecee47145a72c0', ' Mr. Mohammed Ali', '0@0.com', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 48, NULL, 1, '2020-01-27 17:03:15', NULL, NULL),
(50, 'c0c7c76d30bd3dcaefc96f40275bdc0a', 'Mr. Md. Akram Hossain', '01553288477', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 49, NULL, 1, '2020-01-27 17:03:24', NULL, NULL),
(51, '2838023a778dfaecdc212708f721b788', ' Mr. Md. Mosharraf Hossain', '0167322390', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 50, NULL, 1, '2020-01-27 17:06:08', NULL, NULL),
(52, '9a1158154dfa42caddbd0694a4e9bdc8', 'Mr. Jewel Molla', '01918285633', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 51, NULL, 1, '2020-01-27 17:07:12', NULL, NULL),
(53, 'd82c8d1619ad8176d665453cfb2e55f0', ' Fatima Begum', '01676796365', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 52, NULL, 1, '2020-01-27 17:08:56', NULL, NULL),
(54, 'a684eceee76fc522773286a895bc8436', 'Darshana sarker', '01712581068', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 53, NULL, 1, '2020-01-27 17:09:58', NULL, NULL),
(55, 'b53b3a3d6ab90ce0268229151c9bde11', 'Mr. Mohammed Sirajul Islam', '01729908067', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 54, NULL, 1, '2020-01-27 17:12:30', NULL, NULL),
(56, '9f61408e3afb633e50cdf1b20de6f466', 'Mr. Ashish Kumar Gop', '01739207453', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 55, NULL, 1, '2020-01-27 17:14:42', NULL, NULL),
(57, '72b32a1f754ba1c09b3695e0cb6cde7f', 'Mr. Md. Harun Rashid', '01676038777', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 56, NULL, 1, '2020-01-27 17:17:09', NULL, NULL),
(58, '66f041e16a60928b05a7e228a89c3799', 'Mr. Md. Ataur Rahman', '01816401552', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 57, NULL, 1, '2020-01-27 17:18:24', NULL, NULL),
(59, '093f65e080a295f8076b1c5722a46aa2', 'Mr. Md. Fazlur Rahman', '01775241797', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 58, NULL, 1, '2020-01-27 17:21:09', NULL, NULL),
(60, '072b030ba126b2f4b2374f342be9ed44', 'Begum Halima Begum', '01762418594', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 59, NULL, 1, '2020-01-27 17:24:17', NULL, NULL),
(61, '7f39f8317fbdb1988ef4c628eba02591', 'Mr. Md Moksedur Rahman', '01723454495', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 60, NULL, 1, '2020-01-27 17:24:36', NULL, NULL),
(62, '44f683a84163b3523afe57c2e008bc8c', 'Nur-E jannat', '01719511881', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 61, NULL, 1, '2020-01-27 17:28:33', NULL, NULL),
(63, '03afdbd66e7929b125f8597834fa83a4', 'Tingku rani shaha', '01728429046', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 62, NULL, 1, '2020-01-27 17:32:06', NULL, NULL),
(64, 'ea5d2f1c4608232e07d3aa3d998e5135', 'Mohammad Jahangir Hossain Hang', '01720015915', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 63, NULL, 1, '2020-01-27 17:32:08', NULL, NULL),
(65, 'fc490ca45c00b1249bbe3554a4fdf6fb', 'Mr. Bashir Ahmed', '01716883743', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 64, NULL, 1, '2020-01-27 17:36:24', NULL, NULL),
(66, '3295c76acbf4caaed33c36b1b5fc2cb1', 'Mr. Md. Abdus Sattar', '01757382580', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 65, NULL, 1, '2020-01-27 17:41:08', NULL, NULL),
(67, '735b90b4568125ed6c3f678819b6e058', 'Mr. Md. Abdul Rahim', '01723842078', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 66, NULL, 1, '2020-01-27 17:45:06', NULL, NULL),
(68, 'a3f390d88e4c41f2747bfa2f1b5f87db', 'Begum Sajia Koraishi', '01683343395', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 67, NULL, 1, '2020-01-27 17:48:15', NULL, NULL),
(69, '14bfa6bb14875e45bba028a21ed38046', 'Znab Md. Ataur Rahman', '01715542152', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 68, NULL, 1, '2020-01-27 17:49:17', NULL, NULL),
(70, '7cbbc409ec990f19c78c75bd1e06f215', 'Mr. Md. Motiur Rahman', '01531247362', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 69, NULL, 1, '2020-01-27 17:53:35', NULL, NULL),
(71, 'e2c420d928d4bf8ce0ff2ec19b371514', 'Mr. Md. Alauddin', '01552460568', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 70, NULL, 1, '2020-01-27 17:56:02', NULL, NULL),
(72, '32bb90e8976aab5298d5da10fe66f21d', 'Mohammad Arshad Khan', '01827575964', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 71, NULL, 1, '2020-01-27 17:56:28', NULL, NULL),
(73, 'd2ddea18f00665ce8623e36bd4e3c7c5', 'Mr. Mohsan Imam', '01737629739', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 72, NULL, 1, '2020-01-27 18:00:43', NULL, NULL),
(74, 'ad61ab143223efbc24c7d2583be69251', ' Mr A, H, A M Abdullah Al Noman', '01675519431', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 73, NULL, 1, '2020-01-27 18:02:40', NULL, NULL),
(75, 'd09bf41544a3365a46c9077ebb5e35c3', 'Mr. Md. Abul Bashar', '01515244232', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 74, NULL, 1, '2020-01-27 18:03:14', NULL, NULL),
(76, 'fbd7939d674997cdb4692d34de8633c4', 'Mr. Mohammad Islam Uddin', '01745996387', '0339f60da83aecd0deb28e3321af2cb7', '6', '', 75, NULL, 1, '2020-01-27 18:05:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(10) UNSIGNED NOT NULL,
  `user_type_name` varchar(50) NOT NULL,
  `user_type_access` text DEFAULT NULL,
  `user_type_status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `user_type_access`, `user_type_status`) VALUES
(1, 'Master Admin', 'all', 1),
(2, 'Admin', 'dashboard,office,department,company_settings', 1),
(3, 'System Admin', 'dashboard,stock_out,requisitions,product_limit,stocks,store_receive,approval,product,suppliers,employee_information,product_category,unit,employee_grade,employee_type,gender,designation,section,office,department,company_settings', 1),
(4, 'Store Manager', 'dashboard,stock_out,requisitions,stocks,store_receive,product,suppliers,product_category,unit,section,office,department', 1),
(5, 'Approver', 'dashboard,stock_out,requisitions,stocks,store_receive,product,suppliers,product_category,unit,section,office,department', 1),
(6, 'Employee', 'dashboard,stock_out,requisitions,product_limit,stocks,store_receive,product,product_category,unit,section', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`approval_id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`company_settings_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employee_grade`
--
ALTER TABLE `employee_grade`
  ADD PRIMARY KEY (`employee_grade_id`);

--
-- Indexes for table `employee_information`
--
ALTER TABLE `employee_information`
  ADD PRIMARY KEY (`employee_information_id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`employee_type_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `grid_setting`
--
ALTER TABLE `grid_setting`
  ADD PRIMARY KEY (`grid_setting_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`languages_id`);

--
-- Indexes for table `languages_type`
--
ALTER TABLE `languages_type`
  ADD PRIMARY KEY (`languages_type_id`);

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`main_menu_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`modules_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_limit`
--
ALTER TABLE `product_limit`
  ADD PRIMARY KEY (`product_limit_id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`requisitions_id`);

--
-- Indexes for table `requisitions_details`
--
ALTER TABLE `requisitions_details`
  ADD PRIMARY KEY (`requisitions_details_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stocks_id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`stock_out_id`);

--
-- Indexes for table `stock_out_details`
--
ALTER TABLE `stock_out_details`
  ADD PRIMARY KEY (`stock_out_details_id`);

--
-- Indexes for table `store_receive`
--
ALTER TABLE `store_receive`
  ADD PRIMARY KEY (`store_receive_id`);

--
-- Indexes for table `store_receive_details`
--
ALTER TABLE `store_receive_details`
  ADD PRIMARY KEY (`store_receive_details_id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`sub_menu_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`suppliers_id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`user_id`,`target`,`property`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `top_menu`
--
ALTER TABLE `top_menu`
  ADD PRIMARY KEY (`top_menu_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `approval_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `company_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `employee_grade`
--
ALTER TABLE `employee_grade`
  MODIFY `employee_grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_information`
--
ALTER TABLE `employee_information`
  MODIFY `employee_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `employee_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grid_setting`
--
ALTER TABLE `grid_setting`
  MODIFY `grid_setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `languages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `languages_type`
--
ALTER TABLE `languages_type`
  MODIFY `languages_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `main_menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `modules_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_limit`
--
ALTER TABLE `product_limit`
  MODIFY `product_limit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `requisitions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requisitions_details`
--
ALTER TABLE `requisitions_details`
  MODIFY `requisitions_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stocks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `stock_out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_out_details`
--
ALTER TABLE `stock_out_details`
  MODIFY `stock_out_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_receive`
--
ALTER TABLE `store_receive`
  MODIFY `store_receive_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_receive_details`
--
ALTER TABLE `store_receive_details`
  MODIFY `store_receive_details_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `sub_menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `suppliers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `top_menu`
--
ALTER TABLE `top_menu`
  MODIFY `top_menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

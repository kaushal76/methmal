-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2015 at 07:44 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `j34`
--

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_abstract`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_abstract` (
  `id` int(11) unsigned NOT NULL,
  `paper_id` int(11) NOT NULL COMMENT 'Paper ID to link the Abstract to the Paper',
  `abstract` longtext NOT NULL COMMENT 'The abstract for the paper',
  `keywords` varchar(255) NOT NULL COMMENT 'Keywords for the abstract',
  `theme` int(11) NOT NULL COMMENT 'Theme of the Abstract',
  `rev1ew_outcome` int(11) NOT NULL COMMENT 'Review outcome for this abstract',
  `rev1ew_comments` longtext NOT NULL COMMENT 'Review comments for this abstract as posted by the theme leader',
  `type_of_submission` int(11) NOT NULL COMMENT 'Type of Submission, as in the orginal(0), resubmission(1),revision(2)  ',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_author`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_author` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Title of the Author',
  `first_name` varchar(255) NOT NULL COMMENT 'First name of the author ',
  `surname` varchar(255) NOT NULL COMMENT 'Surname of the author',
  `email` varchar(255) NOT NULL COMMENT 'Email of the Author',
  `affiliation` varchar(255) NOT NULL COMMENT 'Affiliation of the author (Institutte)',
  `country` varchar(255) NOT NULL COMMENT 'Country of the author',
  `attending` tinyint(1) NOT NULL COMMENT 'Is this author attending the conference? No:0 Yes:1',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grcum_confmgr_author`
--

INSERT INTO `grcum_confmgr_author` (`id`, `title`, `first_name`, `surname`, `email`, `affiliation`, `country`, `attending`, `ordering`, `published`, `checked_out`, `checked_out_time`, `created`, `created_by`, `modified`, `version`, `params`) VALUES
(2, 'Dr', 'Kaushal', 'Keraminiyage', 'keraminiyage@yahoo.co.uk', 'UoH', 'UK', 0, 0, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 5, ''),
(3, 'Prof', 'Dilanthi', 'Amaratunga', 'd@r.com', 'UoH', 'UK', 1, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_author_for_paper`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_author_for_paper` (
  `id` int(11) unsigned NOT NULL,
  `paper_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_camera_ready_paper`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_camera_ready_paper` (
  `id` int(11) unsigned NOT NULL,
  `paper_id` int(11) NOT NULL COMMENT 'Paper ID to link the camera ready paper',
  `camera_ready_paper` varchar(255) NOT NULL COMMENT 'Upload camera ready paper',
  `type_of_submission` int(11) NOT NULL COMMENT 'Original (0), Resubmission (1), Revision (2)',
  `approved` tinyint(1) NOT NULL COMMENT 'Is the camera ready paper approved by the theme leader? Yes: 1, No:0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_full_paper`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_full_paper` (
  `id` int(11) unsigned NOT NULL,
  `paper_id` int(11) NOT NULL COMMENT 'This is the Paper ID linking the full paper to the paper table',
  `full_paper` text NOT NULL COMMENT 'Full paper upload',
  `rev1ew_outcome` int(11) NOT NULL COMMENT 'Full paper review outcome',
  `rev1ew_comments` longtext NOT NULL COMMENT 'Full paper review comments',
  `type_of_submission` int(11) NOT NULL COMMENT 'Original (0), Resubmission (1), Revision (2)',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_paper`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_paper` (
  `id` int(11) unsigned NOT NULL,
  `abstract_id` int(11) NOT NULL COMMENT 'Absrtact ID to link the paper to the absrtact',
  `full_paper_id` int(11) NOT NULL COMMENT 'Full paper ID to link with the full paper',
  `camera_ready_paper_id` int(11) NOT NULL COMMENT 'Camera ready paper ID to link the paper with the Camera ready paper',
  `presentation_id` int(11) NOT NULL COMMENT 'Linking Presentation to the Paper',
  `title` varchar(255) NOT NULL COMMENT 'Title of the paper',
  `student_paper` tinyint(1) NOT NULL COMMENT 'Is this a student paper (yes:1, No:0)',
  `created_by` int(11) NOT NULL COMMENT 'User who has created the paper',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grcum_confmgr_paper`
--

INSERT INTO `grcum_confmgr_paper` (`id`, `abstract_id`, `full_paper_id`, `camera_ready_paper_id`, `presentation_id`, `title`, `student_paper`, `created_by`, `ordering`, `published`, `checked_out`, `checked_out_time`, `created`, `modified`, `version`, `params`) VALUES
(1, 0, 0, 0, 0, 'Test title', 0, 254, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, ''),
(2, 0, 0, 0, 0, 'Title 2', 0, 254, 2, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, ''),
(13, 0, 0, 0, 0, '', 0, 0, 3, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_payment`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_payment` (
  `id` int(11) unsigned NOT NULL,
  `author_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_presentation`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_presentation` (
  `id` int(11) unsigned NOT NULL,
  `paper_id` int(11) NOT NULL COMMENT 'Paper ID to link with',
  `presentation` varchar(255) NOT NULL COMMENT 'Presentation file',
  `type_of_submission` int(11) NOT NULL COMMENT 'original (0), Resubmit (1), Revision (2)',
  `approved` tinyint(1) NOT NULL COMMENT 'Is the presentation approved by the theme leader?',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_rev1ew`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_rev1ew` (
  `id` int(11) unsigned NOT NULL,
  `outcome` int(11) NOT NULL COMMENT 'Suggested outcome\r\n(0) - Not complete\r\n(1) - Accept as it is\r\n(2) - Minor changes required\r\n(3) - Resubmission required\r\n(4) - Reject',
  `comments_to_author` longtext NOT NULL COMMENT 'Visible comments to the author',
  `comments_to_leader` longtext NOT NULL COMMENT 'Confidential comments to the theme leader',
  `mode` int(3) NOT NULL COMMENT 'Mode of the review (0) - Abstract (1) - Full',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `hits` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_rev1ewer`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_rev1ewer` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL COMMENT 'Title of the Reviewer',
  `first_name` varchar(255) NOT NULL COMMENT 'First name of the reviewer',
  `surname` varchar(255) NOT NULL COMMENT 'Surname of the reviewer',
  `email` varchar(255) NOT NULL COMMENT 'Email of the reviewer',
  `affiliation` varchar(255) NOT NULL COMMENT 'Affiliation of the reviewer (Institute)',
  `country` varchar(255) NOT NULL COMMENT 'Country of the Reviewer',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `agreed` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_rev1ewer_for_paper`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_rev1ewer_for_paper` (
  `id` int(11) unsigned NOT NULL,
  `rev1ewer_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_theme`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_theme` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Theme leaders user ID',
  `title` varchar(255) NOT NULL COMMENT 'Title of the theme',
  `description` longtext NOT NULL COMMENT 'Description of the theme',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grcum_confmgr_theme_leader`
--

CREATE TABLE IF NOT EXISTS `grcum_confmgr_theme_leader` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `theme_id` int(11) NOT NULL DEFAULT '0',
  `role` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grcum_confmgr_abstract`
--
ALTER TABLE `grcum_confmgr_abstract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_author`
--
ALTER TABLE `grcum_confmgr_author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `grcum_confmgr_author_for_paper`
--
ALTER TABLE `grcum_confmgr_author_for_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_camera_ready_paper`
--
ALTER TABLE `grcum_confmgr_camera_ready_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_full_paper`
--
ALTER TABLE `grcum_confmgr_full_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_paper`
--
ALTER TABLE `grcum_confmgr_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_payment`
--
ALTER TABLE `grcum_confmgr_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_presentation`
--
ALTER TABLE `grcum_confmgr_presentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_rev1ew`
--
ALTER TABLE `grcum_confmgr_rev1ew`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_rev1ewer`
--
ALTER TABLE `grcum_confmgr_rev1ewer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_rev1ewer_for_paper`
--
ALTER TABLE `grcum_confmgr_rev1ewer_for_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_theme`
--
ALTER TABLE `grcum_confmgr_theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grcum_confmgr_theme_leader`
--
ALTER TABLE `grcum_confmgr_theme_leader`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grcum_confmgr_abstract`
--
ALTER TABLE `grcum_confmgr_abstract`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_author`
--
ALTER TABLE `grcum_confmgr_author`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grcum_confmgr_author_for_paper`
--
ALTER TABLE `grcum_confmgr_author_for_paper`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_camera_ready_paper`
--
ALTER TABLE `grcum_confmgr_camera_ready_paper`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_full_paper`
--
ALTER TABLE `grcum_confmgr_full_paper`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_paper`
--
ALTER TABLE `grcum_confmgr_paper`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `grcum_confmgr_payment`
--
ALTER TABLE `grcum_confmgr_payment`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_presentation`
--
ALTER TABLE `grcum_confmgr_presentation`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_rev1ew`
--
ALTER TABLE `grcum_confmgr_rev1ew`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_rev1ewer`
--
ALTER TABLE `grcum_confmgr_rev1ewer`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_rev1ewer_for_paper`
--
ALTER TABLE `grcum_confmgr_rev1ewer_for_paper`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_theme`
--
ALTER TABLE `grcum_confmgr_theme`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grcum_confmgr_theme_leader`
--
ALTER TABLE `grcum_confmgr_theme_leader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

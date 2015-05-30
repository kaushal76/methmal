SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_abstracts`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_abstracts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL,
  `abstract` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `abstract_review_outcome` int(11) NOT NULL DEFAULT '0',
  `abstract_review_comments` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `theme` int(11) NOT NULL DEFAULT '0',
  `resubmitted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=293 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_authors`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `attending` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=338 ;


-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_camerareadypapers`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_camerareadypapers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL,
  `cameraready_paper` varchar(255) NOT NULL,
  `cover_page` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `jos_confmgt_camerareadypapers`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_coordinators`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_coordinators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


--
-- Table structure for table `jos_confmgt_emails`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `emailcode` varchar(15) NOT NULL,
  `placeholders` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `jos_confmgt_emails`
--

INSERT INTO `jos_confmgt_emails` (`id`, `subject`, `message`, `emailcode`, `placeholders`) VALUES
(1, 'Welcome to {SITE}', 'Dear {NAME},\r\n\r\nAn account has been created for you to access the {SITE}. Your login credentials are as follows: You may now login to the system by visiting {SITEURL}.\r\n\r\nUsername: {USERNAME}\r\nPassword: {PASSWORD}\r\n\r\nThank you.\r\n\r\n{SITE}', 'regemail', '{SITE}\r\n{NAME}\r\n(USERNAME}\r\n{PASSWORD}\r\n{SITEURL}'),
(2, 'Invitation to become a scientific committee member and a reviewer for {SITE}', 'Dear {NAME},\r\n\r\nOn behalf of the {SITE} organising committee I would like to invite you to become a scientific committee member and an academic reviewer for the above conference and your contribution will be highly appreciated. If you are happy we will request you to review a small number of papers published for this conference. Please indicate whether you would like to accept this by visiting the appropriate link below:\r\n\r\nI am happy to be a reviewer and a scientific committee member: {AGREE_LINK}\r\n\r\nI will not be able accept this at this time: {DENY_LINK}\r\n\r\nThank you and kind regards\r\n\r\n{THEME_LEADER}\r\nOn behalf of {SITE} ', 'rev_agree', '{SITE} \r\n{NAME}\r\n{AGREE_LINK}\r\n{DENY_LINK}\r\n{THEME_LEADER}'),
(3, 'Abstract received: {SITE} ', 'Dear {NAME},\r\n\r\nThank you very much for submitting the abstract titled ''{TITLE}'' for the {SITE}. Your abstract will be reviewed and the outcome will be notified in due course. You can monitor the progress of your paper by login in to the conference management system at {SITE_URL}. The details of your submission is noted below:\r\n\r\nTitle: \r\n{TITLE}\r\n\r\nAuthors: \r\n{AUTHORS}\r\n\r\nAbstract: \r\n{ABSTRACT}\r\n\r\nKeywords: \r\n{KEYWORDS}\r\n\r\nThank you.\r\nKind regards\r\n\r\n{SITE}\r\nOn behalf of the organising committee ', 'auth_abs', '{NAME}\r\n{TITLE}\r\n{SITE}\r\n{SITE_URL}\r\n{AUTHORS}\r\n{ABSTRACT}\r\n{KEYWORDS}'),
(4, 'Abstract received: {SITE} ', 'Dear {NAME},\r\n\r\nRecently {AUTHOR} has submitted an abstract titled ''{TITLE}'' for {SITE} under the theme ''{THEME}'', for which you are the theme leader. Please review this abstract  by login in to the conference management system at {SITE_URL}. At this stage, you can also assign reviewers to this abstract so that you can get external reviews to incorporate into your response to the authors. Alternatively you can assign the reviewers later in the process so that they review only the full papers. In any case, please enter the abstract review comments online and review results will be automatically notified to the corresponding author. \r\n\r\nAbstract details are as below:\r\n\r\nTitle: \r\n{TITLE}\r\n\r\nAuthors: \r\n{AUTHORS}\r\n\r\nAbstract: \r\n{ABSTRACT}\r\n\r\nKeywords: \r\n{KEYWORDS}\r\n\r\nThank you.\r\nKind regards\r\n\r\n{SITE}\r\nOn behalf of the organising committee ', 'leader_abs', '{NAME}\r\n{AUTHOR}\r\n{THEME}\r\n{TITLE}\r\n{SITE}\r\n{SITE_URL}\r\n{AUTHORS}\r\n{ABSTRACT}\r\n{KEYWORDS}'),
(5, 'Abstract review results: {SITE}', 'Dear {NAME},\r\n\r\nPaper Id: {PAPERID}\r\n\r\nThank you for submitting the abstract titled ''{TITLE}'' for {SITE}, which we have reviewed under the theme ''{THEME}''. Please see the review results for this abstract  below, which is also available to access by login in to the conference management system at {SITE_URL}. Please consider the comments below carefully and prepare for the next step.\r\n\r\nAbstract review outcome: \r\n{OUTCOME}\r\n\r\nReview comments:\r\n{COMMENTS}\r\n\r\nThank you.\r\nKind regards\r\n\r\n{SITE}\r\nOn behalf of the organising committee ', 'abs_outcome', ''),
(6, 'Full paper review results: {SITE}', 'Dear {NAME},\r\n\r\nPaper Id: {PAPERID}\r\n\r\nThank you for submitting the full paper titled ''{TITLE}'' for the {SITE}. We have now reviewed this paper. Please see the review results for this full paper below, which is also available to access by login in to the conference management system at {SITE_URL}. Please consider the comments below carefully and prepare for the next step.\r\n\r\nFull paper review outcome: \r\n{OUTCOME}\r\n\r\nReview comments:\r\n{COMMENTS}\r\n\r\nThank you.\r\nKind regards\r\n\r\n{SITE}\r\nOn behalf of the organising committee ', 'full_outcome', ''),
(7, 'Reviewer for the {SITE_NAME}', 'Dear {NAME},\r\n\r\nAs you may have already been notified, {THEME_LEADER}, one of the theme leaders for the {SITE_NAME}, has enrolled you as a reviewer for the conference. Please log on to the conference management system using your exciting login details or the login details that you must have received recently. If you have not received the login details, please be in touch with {THEME_LEADER}. Once logged in you will see a button allowing you to proceed as a reviewer. If no papers have been allocated to you yet, you will receive further emails once the papers are assigned to you for reviewing.\r\n\r\nThank you.\r\n\r\n{THEME_LEADER}\r\non behalf of {SITE_NAME}', 'rev_welcome', '');

-- --------------------------------------------------------


--
-- Table structure for table `jos_confmgt_email_log`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_email_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` text NOT NULL,
  `recipient` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `cc` text NOT NULL,
  `bcc` text NOT NULL,
  `attachment` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Table structure for table `jos_confmgt_fullpapers`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_fullpapers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL,
  `full_paper` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `full_review_outcome` int(11) NOT NULL DEFAULT '0',
  `full_review_comments` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resubmit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_papers`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_papers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `abstract` text NOT NULL,
  `abstractid` int(11) NOT NULL DEFAULT '0',
  `keywords` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `full_paper` varchar(255) NOT NULL,
  `fullpaperid` int(11) NOT NULL DEFAULT '0',
  `camera_ready` varchar(255) NOT NULL,
  `presentation` varchar(255) NOT NULL,
  `full_review_outcome` int(11) NOT NULL DEFAULT '0',
  `abstract_review_outcome` int(11) NOT NULL DEFAULT '0',
  `full_review_comments` text NOT NULL,
  `abstract_review_comments` text NOT NULL,
  `theme` int(11) NOT NULL DEFAULT '0',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL DEFAULT '0',
  `student_submission` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=402 ;


-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_presentations`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_presentations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL,
  `presentation` varchar(255) NOT NULL,
  `cover_page` varchar(255) CHARACTER SET ucs2 NOT NULL,
  `created_by` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `jos_confmgt_presentations`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_rev1ewers`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_rev1ewers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `agreed` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=216 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_rev1ewers_papers`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_rev1ewers_papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paperid` int(11) NOT NULL,
  `reviewerid` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `jos_confmgt_rev1ewers_papers`
--

-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_reviews`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recommendation` int(11) NOT NULL DEFAULT '0',
  `author_comments` text NOT NULL,
  `leader_comments` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mode` varchar(50) NOT NULL DEFAULT '0',
  `linkid` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `rand` varchar(50) NOT NULL DEFAULT '0',
  `abstractid` int(11) NOT NULL DEFAULT '0',
  `fullpaperid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `jos_confmgt_reviews`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_confmgt_themes`
--

CREATE TABLE IF NOT EXISTS `jos_confmgt_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;


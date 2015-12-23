CREATE TABLE IF NOT EXISTS `#__confmgr_paper` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`abstract_id` INT(11) NOT NULL COMMENT 'Absrtact ID to link the paper to the absrtact',
	`full_paper_id` INT(11) NOT NULL COMMENT 'Full paper ID to link with the full paper',
	`camera_ready_paper_id` INT(11) NOT NULL COMMENT 'Camera ready paper ID to link the paper with the Camera ready paper',
	`presentation_id` INT(11) NOT NULL COMMENT 'Linking Presentation to the Paper',
	`title` VARCHAR(255) NOT NULL COMMENT 'Title of the paper',
	`student_paper` BOOLEAN NOT NULL COMMENT 'Is this a student paper (yes:1, No:0)',
	`created_by` INT(11) NOT NULL COMMENT 'User who has created the paper',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_abstract` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`paper_id` INT(11) NOT NULL COMMENT 'Paper ID to link the Abstract to the Paper',
	`abstract` LONGTEXT NOT NULL COMMENT 'The abstract for the paper',
	`keywords` VARCHAR(255) NOT NULL COMMENT 'Keywords for the abstract',
	`theme` INT(11) NOT NULL COMMENT 'Theme of the Abstract',
	`rev1ew_outcome` INT(11) NOT NULL COMMENT 'Review outcome for this abstract',
	`rev1ew_comments` LONGTEXT NOT NULL COMMENT 'Review comments for this abstract as posted by the theme leader',
	`type_of_submission` INT(11) NOT NULL COMMENT 'Type of Submission, as in the orginal(0), resubmission(1),revision(2)  ',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL DEFAULT '0',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by` int(11) unsigned NOT NULL DEFAULT '0',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_full_paper` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`paper_id` INT(11) NOT NULL COMMENT 'This is the Paper ID linking the full paper to the paper table',
	`full_paper` TEXT NOT NULL COMMENT 'Full paper upload',
	`rev1ew_outcome` INT(11) NOT NULL COMMENT 'Full paper review outcome',
	`rev1ew_comments` LONGTEXT NOT NULL COMMENT 'Full paper review comments',
	`type_of_submission` INT(11) NOT NULL COMMENT 'Original (0), Resubmission (1), Revision (2)',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL DEFAULT '0',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by` int(11) unsigned NOT NULL DEFAULT '0',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_camera_ready_paper` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`paper_id` INT(11) NOT NULL COMMENT 'Paper ID to link the camera ready paper',
	`camera_ready_paper` VARCHAR(255) NOT NULL COMMENT 'Upload camera ready paper',
	`type_of_submission` INT(11) NOT NULL COMMENT 'Original (0), Resubmission (1), Revision (2)',
	`approved` BOOLEAN NOT NULL COMMENT 'Is the camera ready paper approved by the theme leader? Yes: 1, No:0',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL DEFAULT '0',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by` int(11) unsigned NOT NULL DEFAULT '0',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_presentation` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`paper_id` INT(11) NOT NULL COMMENT 'Paper ID to link with',
	`presentation` VARCHAR(255) NOT NULL COMMENT 'Presentation file',
	`type_of_submission` INT(11) NOT NULL COMMENT 'original (0), Resubmit (1), Revision (2)',
	`approved` BOOLEAN NOT NULL COMMENT 'Is the presentation approved by the theme leader?',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL DEFAULT '0',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by` int(11) unsigned NOT NULL DEFAULT '0',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_theme` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL COMMENT 'Theme leaders user ID',
	`title` VARCHAR(255) NOT NULL COMMENT 'Title of the theme',
	`description` LONGTEXT NOT NULL COMMENT 'Description of the theme',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL DEFAULT '0',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by` int(11) unsigned NOT NULL DEFAULT '0',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_author` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL COMMENT 'Title of the Author',
	`first_name` VARCHAR(255) NOT NULL COMMENT 'First name of the author ',
	`surname` VARCHAR(255) NOT NULL COMMENT 'Surname of the author',
	`email` VARCHAR(255) NOT NULL COMMENT 'Email of the Author',
	`affiliation` VARCHAR(255) NOT NULL COMMENT 'Affiliation of the author (Institutte)',
	`country` VARCHAR(255) NOT NULL COMMENT 'Country of the author',
	`attending` BOOLEAN NOT NULL COMMENT 'Is this author attending the conference? No:0 Yes:1',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_rev1ewer` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL COMMENT 'Title of the Reviewer',
	`first_name` VARCHAR(255) NOT NULL COMMENT 'First name of the reviewer',
	`surname` VARCHAR(255) NOT NULL COMMENT 'Surname of the reviewer',
	`email` VARCHAR(255) NOT NULL COMMENT 'Email of the reviewer',
	`affiliation` VARCHAR(255) NOT NULL COMMENT 'Affiliation of the reviewer (Institute)',
	`country` VARCHAR(255) NOT NULL COMMENT 'Country of the Reviewer',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_rev1ew` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`outcome` INT(11) NOT NULL COMMENT 'Suggested outcome
(0) - Not complete
(1) - Accept as it is
(2) - Minor changes required
(3) - Resubmission required
(4) - Reject',
	`comments_to_author` LONGTEXT NOT NULL COMMENT 'Visible comments to the author',
	`comments_to_leader` LONGTEXT NOT NULL COMMENT 'Confidential comments to the theme leader',
	`mode` INT(3) NOT NULL COMMENT 'Mode of the review (0) - Abstract (1) - Full',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL DEFAULT '0',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`hits` int(11) NOT NULL DEFAULT '0',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_author_for_paper` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`paper_id` INT(11) NOT NULL,
	`author_id` INT(11) NOT NULL,
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_rev1ewer_for_paper` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`rev1ewer_id` INT(11) NOT NULL,
	`paper_id` INT(11) NOT NULL,
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `#__confmgr_payment` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`author_id` INT(11) NOT NULL,
	`amount` INT(11) NOT NULL,
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` tinyint(3) NOT NULL DEFAULT '0',
	`checked_out` int(11) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`version` int(11) unsigned NOT NULL DEFAULT '1',
	`params` text NOT NULL,
	PRIMARY KEY (id)
)
CHARACTER SET utf8
COLLATE utf8_general_ci;

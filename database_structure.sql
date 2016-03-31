SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS  `admin_information`;
CREATE TABLE `admin_information` (
  `admin_id` varchar(32) NOT NULL DEFAULT '',
  `password` text,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `admin_login_information`;
CREATE TABLE `admin_login_information` (
  `admin_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(20) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_login_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `check_class_record`;
CREATE TABLE `check_class_record` (
  `check_class_record_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year` varchar(10) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `account_type` varchar(10) DEFAULT NULL,
  `account_id` varchar(15) DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `real_number` int(11) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`check_class_record_id`),
  KEY `course_id` (`course_id`),
  KEY `school_year` (`school_year`),
  KEY `term` (`term`),
  KEY `week` (`week`),
  KEY `account_id` (`account_id`),
  KEY `account_type` (`account_type`),
  KEY `recording_time` (`recording_time`)
) ENGINE=InnoDB AUTO_INCREMENT=903 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `class_information`;
CREATE TABLE `class_information` (
  `class_id` varchar(15) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `class_final_id` int(11) DEFAULT NULL,
  `major` varchar(45) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`class_id`),
  KEY `class_id` (`class_id`),
  KEY `grade` (`grade`),
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `class_login_information`;
CREATE TABLE `class_login_information` (
  `class_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` varchar(15) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`class_login_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `classroom_information`;
CREATE TABLE `classroom_information` (
  `full_number` varchar(10) NOT NULL,
  `teaching_building_number` int(11) DEFAULT NULL,
  `classroom_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`full_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `college_information`;
CREATE TABLE `college_information` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`college_id`),
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `course_class_information`;
CREATE TABLE `course_class_information` (
  `course_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year` varchar(10) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `class_id` varchar(15) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`course_class_id`),
  KEY `course_id` (`course_id`),
  KEY `school_year` (`school_year`),
  KEY `term` (`term`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5607 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `course_information`;
CREATE TABLE `course_information` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(32) DEFAULT NULL,
  `school_year` varchar(10) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `start_week` int(11) DEFAULT NULL,
  `end_week` int(11) DEFAULT NULL,
  `odd_even` int(11) DEFAULT NULL,
  `class_time` int(11) DEFAULT NULL,
  `weekday` int(11) DEFAULT NULL,
  `classroom` varchar(20) DEFAULT NULL,
  `tercher_name` varchar(20) DEFAULT NULL,
  `choices_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `course_id` (`course_id`),
  KEY `school_year` (`school_year`),
  KEY `term` (`term`),
  KEY `class_time` (`class_time`),
  KEY `weekday` (`weekday`),
  KEY `start_week` (`start_week`),
  KEY `end_week` (`end_week`),
  KEY `odd_even` (`odd_even`),
  KEY `classroom` (`classroom`)
) ENGINE=InnoDB AUTO_INCREMENT=2026 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `notification_information`;
CREATE TABLE `notification_information` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_target` varchar(10) DEFAULT NULL,
  `release_account` varchar(30) DEFAULT NULL,
  `notification_content` text,
  `release_time` datetime DEFAULT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `notification_target` (`notification_target`),
  KEY `release_account` (`release_account`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS  `practice_week_class_information`;
CREATE TABLE `practice_week_class_information` (
  `practice_week_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year` varchar(10) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `class_id` varchar(15) DEFAULT NULL,
  `practice_week_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`practice_week_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1088 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `practice_week_information`;
CREATE TABLE `practice_week_information` (
  `practice_week_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year` varchar(10) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `practice_week_name` varchar(32) DEFAULT NULL,
  `teacher_name` varchar(20) DEFAULT NULL,
  `start_week` int(11) DEFAULT NULL,
  `end_week` int(11) DEFAULT NULL,
  PRIMARY KEY (`practice_week_id`)
) ENGINE=InnoDB AUTO_INCREMENT=896 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `student_information`;
CREATE TABLE `student_information` (
  `student_id` varchar(20) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `student_name` varchar(10) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`student_id`),
  KEY `student_id` (`student_id`),
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `student_login_information`;
CREATE TABLE `student_login_information` (
  `student_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`student_login_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `suggestions`;
CREATE TABLE `suggestions` (
  `suggestions_id` int(11) NOT NULL AUTO_INCREMENT,
  `suggestions_type` varchar(10) DEFAULT NULL,
  `release_account_type` varchar(10) DEFAULT NULL,
  `release_account` varchar(30) DEFAULT NULL,
  `suggestions_content` text,
  `release_time` datetime DEFAULT NULL,
  PRIMARY KEY (`suggestions_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `system_option`;
CREATE TABLE `system_option` (
  `school_year` varchar(10) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `start_day` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `teacher_information`;
CREATE TABLE `teacher_information` (
  `teacher_id` int(11) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `teacher_name` varchar(10) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`teacher_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS  `teacher_login_information`;
CREATE TABLE `teacher_login_information` (
  `teacher_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`teacher_login_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;


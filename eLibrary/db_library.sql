-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 �?08 �?14 �?04:47
-- 服务器版本: 5.6.11
-- PHP 版本: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `db_library`
--
CREATE DATABASE IF NOT EXISTS `db_library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_library`;

-- --------------------------------------------------------

--
-- 表的结构 `tb_actioncolumn`
--

CREATE TABLE IF NOT EXISTS `tb_actioncolumn` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ActionColumnName` varchar(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tb_actioncolumn`
--

INSERT INTO `tb_actioncolumn` (`ID`, `ActionColumnName`) VALUES
(1, '系统管理权限'),
(2, '数据管理权限'),
(3, '用户管理权限'),
(4, '角色管理权限'),
(5, '普通用户权限');

-- --------------------------------------------------------

--
-- 表的结构 `tb_doc_library`
--

CREATE TABLE IF NOT EXISTS `tb_doc_library` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `status` bit(1) NOT NULL,
  `updatedate` datetime NOT NULL,
  `class` varchar(10) NOT NULL,
  `doctype` varchar(10) NOT NULL,
  `docpath` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tb_location`
--

CREATE TABLE IF NOT EXISTS `tb_location` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `type` char(20) NOT NULL,
  `route_id` varchar(20) NOT NULL,
  `route_char` varchar(50) NOT NULL,
  `level` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tb_location`
--

INSERT INTO `tb_location` (`id`, `uid`, `type`, `route_id`, `route_char`, `level`) VALUES
(1, 0, 'root', '0:1', 'root', 0),
(2, 1, '厦门四季阳光10#1402', '0:1', 'root:', 1),
(3, 2, 'bedroom01', '0:1:2', 'root:厦门四季阳光10#1402:', 2),
(4, 2, 'bedroom02', '0:1:2', 'root:厦门四季阳光10#1402:', 2),
(5, 2, 'kitchen', '0:1:2', 'root:厦门四季阳光10#1402:', 2),
(6, 2, 'bathroom', '0:1:2', 'root:厦门四季阳光10#1402:', 2),
(7, 2, 'livingroom', '0:1:2', 'root:厦门四季阳光10#1402:', 2),
(8, 3, 'closet', '0:1:2:3', 'root:厦门四季阳光10#1402:bedroom01:', 3),
(9, 8, 'L1F', '0:1:2:3:8', 'root:厦门四季阳光10#1402:bedroom01:closet:', 4);

-- --------------------------------------------------------

--
-- 表的结构 `tb_resource`
--

CREATE TABLE IF NOT EXISTS `tb_resource` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `ResourceName` varchar(30) NOT NULL,
  `ActionColumnID` int(3) NOT NULL,
  `Action` varchar(11) NOT NULL,
  `ViewMode` bit(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `tb_resource`
--

INSERT INTO `tb_resource` (`ID`, `ResourceName`, `ActionColumnID`, `Action`, `ViewMode`) VALUES
(1, '用户信息', 3, 'fullcontrol', b'0'),
(2, '用户信息', 3, 'readonly', b'0'),
(3, '用户信息', 3, 'modify', b'0'),
(4, '用户信息', 3, 'create', b'0'),
(5, '用户信息', 3, 'delete', b'0'),
(6, '角色信息', 4, 'fullcontrol', b'0'),
(7, '角色信息', 4, 'readonly', b'0'),
(8, '角色信息', 4, 'modify', b'0'),
(9, '角色信息', 4, 'create', b'0'),
(10, '角色信息', 4, 'delete', b'0'),
(11, '用户权限信息', 1, 'fullcontrol', b'0'),
(12, '用户权限信息', 1, 'readonly', b'0'),
(13, '用户权限信息', 1, 'modify', b'0'),
(14, '用户权限信息', 1, 'create', b'0'),
(15, '用户权限信息', 1, 'delete', b'0'),
(16, '物品信息', 2, 'fullcontrol', b'0'),
(17, '物品信息', 2, 'readonly', b'0'),
(18, '物品信息', 2, 'modify', b'0'),
(19, '物品信息', 2, 'create', b'0'),
(20, '物品信息', 2, 'delete', b'0'),
(21, '系统操作日志信息', 1, 'readonly', b'0'),
(22, '系统操作日志信息', 0, 'delete', b'1');

-- --------------------------------------------------------

--
-- 表的结构 `tb_resource_roles`
--

CREATE TABLE IF NOT EXISTS `tb_resource_roles` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `ResourceID` varchar(10) NOT NULL,
  `RoleID` int(3) NOT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tb_roles`
--

CREATE TABLE IF NOT EXISTS `tb_roles` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(8) NOT NULL,
  `RoleInfo` tinytext NOT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tb_roles_user`
--

CREATE TABLE IF NOT EXISTS `tb_roles_user` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `RolesID` int(3) NOT NULL,
  `UserID` int(3) NOT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `UserID` int(2) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `LastName` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `Password` varchar(32) DEFAULT NULL,
  `AccountType` varchar(10) CHARACTER SET latin1 DEFAULT 'user',
  `UserName` varchar(20) NOT NULL,
  `Avatar` varchar(30) NOT NULL,
  `Gender` bit(1) NOT NULL,
  `Birthday` date NOT NULL,
  `Height` float NOT NULL,
  `Weight` float NOT NULL,
  `ID` varchar(18) NOT NULL,
  `Passport` varchar(20) NOT NULL,
  `Tel` varchar(15) NOT NULL,
  `Cellphone` varchar(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Wechat` varchar(10) NOT NULL,
  `QQ` varchar(13) NOT NULL,
  `Description` tinytext NOT NULL,
  `Resume` text NOT NULL,
  `BirthPlace` varchar(6) NOT NULL,
  `sf` int(10) NOT NULL,
  `Alias` varchar(7) NOT NULL,
  `City` varchar(8) NOT NULL,
  `Visible_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tb_user`
--

INSERT INTO `tb_user` (`UserID`, `FirstName`, `LastName`, `Password`, `AccountType`, `UserName`, `Avatar`, `Gender`, `Birthday`, `Height`, `Weight`, `ID`, `Passport`, `Tel`, `Cellphone`, `Email`, `Wechat`, `QQ`, `Description`, `Resume`, `BirthPlace`, `sf`, `Alias`, `City`, `Visible_flag`) VALUES
(1, '?', '?', NULL, 'user', 'Simon', 'picture/test.jpg', b'1', '1972-01-20', 166, 58, '420500197201202336', '', '059288888888', '15160002172', 'qianxfuture@hotmail.com', '', '1335114200', '', '', '宜昌', 0, '', '厦门', 1),
(2, NULL, NULL, NULL, 'user', 'Dolly', '', b'0', '0000-00-00', 0, 0, '', '', '', '', '', '', '', '', '', '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `type` char(20) NOT NULL,
  `route_id` varchar(20) NOT NULL,
  `route_char` varchar(50) NOT NULL,
  `level` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `type`
--

INSERT INTO `type` (`id`, `uid`, `type`, `route_id`, `route_char`, `level`) VALUES
(1, 0, 'root', '0:1', 'root', 0),
(2, 1, 'clothes', '0:1:2', 'root:clothes', 1),
(4, 1, 'food', '0:1:4', 'root:food', 0),
(5, 2, 't_shirt', '0:1:2:5', 'root:clothes:T-shirt', 0),
(6, 4, 'orange', '0:1:4:6', '', 0),
(7, 4, 'apple', '0:1:4', 'apple', 0),
(9, 4, 'peach', ':', 'peach', 0),
(22, 4, 'test', '0:1:4', 'root:food', 0),
(23, 1, 'live', '', '', 1),
(24, 1, 'live', '0:1', 'root', 0),
(25, 24, 'bed', '0:1', 'root', 0),
(26, 0, '1', '', '1', 0);

-- --------------------------------------------------------

--
-- 表的结构 `type_info`
--

CREATE TABLE IF NOT EXISTS `type_info` (
  `id` int(10) NOT NULL,
  `typeid` int(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `info` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `sf` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `xm_lib`
--

CREATE TABLE IF NOT EXISTS `xm_lib` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `parentclass` varchar(10) NOT NULL,
  `pid` int(2) NOT NULL,
  `qid` int(3) NOT NULL,
  `content` text,
  `imagepath` varchar(36) NOT NULL,
  `imagedata` mediumblob NOT NULL,
  `imagetype` varchar(25) NOT NULL,
  `owner` varchar(6) NOT NULL,
  `place` varchar(30) NOT NULL,
  `sf` int(10) NOT NULL,
  `isvalid` tinyint(1) NOT NULL,
  `addtime` date DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `sn` varchar(10) NOT NULL,
  `description` tinytext NOT NULL,
  `expiredate` date NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `remark` tinytext NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateofissue` date NOT NULL,
  `docpath` varchar(30) NOT NULL,
  `securitylevel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`),
  KEY `qid` (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `xm_lib`
--

INSERT INTO `xm_lib` (`id`, `subject`, `alias`, `parentclass`, `pid`, `qid`, `content`, `imagepath`, `imagedata`, `imagetype`, `owner`, `place`, `sf`, `isvalid`, `addtime`, `name`, `sn`, `description`, `expiredate`, `barcode`, `remark`, `updatedate`, `dateofissue`, `docpath`, `securitylevel`) VALUES
(1, '李前的二代身份证', 'sfz', '1', 66, 14, '<div id="panel">\r\n	<h5 class="head">什么是jQuery?</h5>\r\n	<div class="content">\r\n		jQuery是继Prototype之后又一个优秀的JavaScript库，它是一个由 John Resig 创建于2006年1月的开源项目。jQuery凭借简洁的语法和跨平台的兼容性，极大地简化了JavaScript开发人员遍历HTML文档、操作DOM、处理事件、执行动画和开发Ajax。它独特而又优雅的代码风格改变了JavaScript程序员的设计思路和编写程序的方式。\r\n	</div>\r\n</div>\r\n', 'upload/2014/07/10/1404965608.png', '', '', 'simon', 'wallet', 0, 1, '2014-07-15', 'èº«ä»½è¯', 'X1407001', '', '2026-04-27', '', '', '2014-07-10 07:12:23', '2006-04-27', '', 0),
(2, '与dolly短消息记录文件', 'dxx', '2', 67, 14, NULL, '/', '', '', 'dolly', 'cellphone', 0, 1, '2014-07-15', 'SMS_20140701', 'X1407002', '', '0000-00-00', '', '', '2014-07-11 06:46:31', '0000-00-00', 'doc/sms_20140701.txt', 0),
(3, '李前的厦门市社保卡', 'sbk', '1', 66, 14, NULL, '/', '', '', 'simon', 'wallet', 0, 1, '2014-07-15', 'åŽ¦é—¨å¸‚ç¤¾ä¼šä¿éšœå¡', 'X1407003', '', '0000-00-00', '', '', '2014-07-14 02:34:40', '0000-00-00', '', 0),
(4, 'ccna认证卡', 'ccna', '1', 66, 14, NULL, '/', '', '', 'simon', 'wallet', 0, 1, '2014-07-15', 'CCNAå¡ç‰‡', 'Xp407004', '', '2009-01-08', '', '', '2014-07-14 02:44:39', '0000-00-00', '', 0),
(5, '20140630厦门领到了结婚证', 'jhz', '1', 66, 14, NULL, '/', '', '', 'simon', 'B01CM1F', 0, 1, '2014-07-15', 'ç»“å©šè¯', 'X1407005', '\r\n领证时间：20140630\r\n\r\n领证地点：思明区名汇广场婚姻登记处', '0000-00-00', '', '', '2014-07-14 02:48:29', '2014-06-30', '', 0),
(6, '中骏会员卡,物业缴费享受优惠', 'zjhyk', '1', 66, 14, NULL, '/', '', '', 'simon', 'wallet', 0, 1, '2014-07-15', 'ä¸­éªä¼šå‘˜å¡', 'X1407006', '', '0000-00-00', '', '', '2014-07-14 03:01:51', '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xm_lib_type`
--

CREATE TABLE IF NOT EXISTS `xm_lib_type` (
  `id` int(2) NOT NULL,
  `subject` varchar(30) DEFAULT NULL,
  `iconpath` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `xm_lib_type`
--

INSERT INTO `xm_lib_type` (`id`, `subject`, `iconpath`) VALUES
(66, '证件', ''),
(67, '文档', 'images/doc.jpg'),
(68, '图片', 'images/image.jpg'),
(69, '音频', 'images/audio.jpg'),
(70, '视频', 'images/video.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `xm_year`
--

CREATE TABLE IF NOT EXISTS `xm_year` (
  `id` int(2) NOT NULL,
  `subject` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `xm_year`
--

INSERT INTO `xm_year` (`id`, `subject`) VALUES
(14, 2014),
(15, 2015),
(16, 2016),
(17, 2017);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

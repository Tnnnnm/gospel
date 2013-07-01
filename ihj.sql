-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 11 日 03:08
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ihj`
--

-- --------------------------------------------------------

--
-- 表的结构 `hj_account`
--

CREATE TABLE IF NOT EXISTS `hj_account` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `isdestory` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除标识',
  `gid` tinyint(1) NOT NULL COMMENT '用户组',
  `login` varchar(15) NOT NULL COMMENT '用户名',
  `nick` varchar(15) NOT NULL COMMENT '昵称',
  `passwd` varchar(32) NOT NULL COMMENT '密码',
  `esex` tinyint(1) NOT NULL COMMENT '性别',
  `efrom` varchar(125) NOT NULL COMMENT '户籍',
  `emarriage` tinyint(1) NOT NULL COMMENT '婚否',
  `ebirth` varchar(25) NOT NULL COMMENT '出生年月',
  `ecardid` varchar(25) NOT NULL COMMENT '身份证',
  `egraduate` varchar(50) NOT NULL COMMENT '毕业院校',
  `esubject` varchar(15) NOT NULL COMMENT '专业',
  `egrade` varchar(15) NOT NULL COMMENT '学历',
  `eaddress` varchar(125) NOT NULL COMMENT '家庭住址',
  `etelephone` varchar(15) NOT NULL COMMENT '应急联系方式',
  `econtact` varchar(15) NOT NULL COMMENT '联系人',
  `ehere` varchar(15) NOT NULL COMMENT '入职时间',
  `edept` varchar(15) NOT NULL COMMENT '部门',
  `edeptwork` varchar(15) NOT NULL COMMENT '职务',
  `lastlogin` varchar(15) NOT NULL COMMENT '最后登录',
  `lastip` varchar(20) NOT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hj_account`
--

INSERT INTO `hj_account` (`id`, `status`, `isdestory`, `gid`, `login`, `nick`, `passwd`, `esex`, `efrom`, `emarriage`, `ebirth`, `ecardid`, `egraduate`, `esubject`, `egrade`, `eaddress`, `etelephone`, `econtact`, `ehere`, `edept`, `edeptwork`, `lastlogin`, `lastip`) VALUES
(1, 0, 0, 0, 'zhangs', '张三', 'c33367701511b4f6020ec61ded352059', 0, '', 0, '1361404800', '422825198708250695', '浙江万里', '计算机', '大专', '湖北宣恩', '15965212532', '13310521548', '1361750400', '', '教师', '1362553163', '127.0.0.1'),
(2, 1, 0, 2, 'wangwu', '王五', 'e10adc3949ba59abbe56e057f20f883e', 0, '湖北恩施', 2, '1361413170', '422825198708250695', '阿萨德发', '阿斯蒂芬', '阿斯蒂芬', '阿斯蒂芬', '阿斯蒂芬', '阿斯蒂芬', '1361413170', '市场部', '阿斯蒂芬', '1361498950', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `hj_action`
--

CREATE TABLE IF NOT EXISTS `hj_action` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL COMMENT '操作名称',
  `request` varchar(25) NOT NULL COMMENT '方法名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `request` (`request`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `hj_action`
--

INSERT INTO `hj_action` (`id`, `name`, `request`) VALUES
(1, '学生档案编辑', 'Student/edit'),
(2, '学生档案删除', 'Student/destory'),
(3, '学生档案更新', 'Student/update'),
(4, '财务管理首页', 'Finance/index'),
(5, '财务学费年收入', 'Finance/yearin'),
(6, '财务学费月收入', 'Finance/monthin'),
(7, '财务学费周收入', 'Finance/weekin'),
(8, '财务年支出', 'Finance/yearout'),
(9, '财务月支出', 'Finance/monthout'),
(10, '财务周支出', 'Finance/weekout'),
(11, '财务书本收入', 'Finance/booksin'),
(12, '财务其他收入', 'Finance/otherin'),
(13, '财务其他支出', 'Finance/otherout'),
(14, '课程编辑', 'System/edit'),
(15, '课程删除', 'System/destory'),
(16, '课程/员工/班级新增', 'System/create'),
(17, '员工档案编辑', 'System/emptedit'),
(18, '员工档案删除', 'System/emptdestory'),
(20, '班级信息编辑', 'System/grdedit'),
(21, '班级信息删除', 'System/grddestory'),
(22, '权限管理', 'System/grant');

-- --------------------------------------------------------

--
-- 表的结构 `hj_article`
--

CREATE TABLE IF NOT EXISTS `hj_article` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '1',
  `title` varchar(125) NOT NULL,
  `category` int(1) NOT NULL,
  `content` text NOT NULL,
  `createat` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hj_category`
--

CREATE TABLE IF NOT EXISTS `hj_category` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL,
  `title` varchar(25) NOT NULL,
  `memo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hj_course`
--

CREATE TABLE IF NOT EXISTS `hj_course` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cName` varchar(45) NOT NULL COMMENT '名称',
  `cTotalfee` int(4) NOT NULL COMMENT '费用',
  `cMemo` varchar(45) DEFAULT NULL COMMENT '备注',
  `isdestory` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hj_course`
--

INSERT INTO `hj_course` (`id`, `cName`, `cTotalfee`, `cMemo`, `isdestory`) VALUES
(1, '金笔作文', 680, '作文培训', 0),
(2, '少儿英语', 850, '小班教学', 0);

-- --------------------------------------------------------

--
-- 表的结构 `hj_grade`
--

CREATE TABLE IF NOT EXISTS `hj_grade` (
  `id` int(9) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `isdestory` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除标识',
  `gname` varchar(25) NOT NULL COMMENT '名称',
  `gteacher` varchar(15) NOT NULL COMMENT '班主任',
  `gopen` varchar(15) NOT NULL COMMENT '开班时间',
  `gclass` varchar(15) NOT NULL COMMENT '上课时间',
  `gmemo` varchar(50) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hj_grade`
--

INSERT INTO `hj_grade` (`id`, `status`, `isdestory`, `gname`, `gteacher`, `gopen`, `gclass`, `gmemo`) VALUES
(1, 0, 1, '少儿英语(1)班', '张老师', '1361404800', '1361413170', '人数已满，下周开班'),
(2, 1, 1, '金笔作文(周末班)', '谢老师', '1361577600', '1361577600', '开班了');

-- --------------------------------------------------------

--
-- 表的结构 `hj_resource`
--

CREATE TABLE IF NOT EXISTS `hj_resource` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `eid` int(3) NOT NULL COMMENT '员工id',
  `aids` varchar(255) NOT NULL COMMENT '授权操作',
  PRIMARY KEY (`id`),
  UNIQUE KEY `eid` (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `hj_resource`
--

INSERT INTO `hj_resource` (`id`, `eid`, `aids`) VALUES
(1, 1, '1,2,3,4'),
(2, 2, '3,4,5'),
(3, 3, ''),
(4, 4, ''),
(5, 5, ''),
(6, 6, ''),
(7, 7, ''),
(8, 8, ''),
(9, 9, ''),
(10, 10, '');

-- --------------------------------------------------------

--
-- 表的结构 `hj_student`
--

CREATE TABLE IF NOT EXISTS `hj_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态(0在校,1结业,2退费,3休学)',
  `cId` tinyint(1) NOT NULL COMMENT '课程',
  `gid` tinyint(1) NOT NULL COMMENT '课程',
  `tId` int(3) NOT NULL COMMENT '经手人',
  `uName` varchar(15) NOT NULL COMMENT '姓名',
  `uSchool` varchar(25) NOT NULL COMMENT '所在学校',
  `uFather` varchar(15) NOT NULL COMMENT '爸爸',
  `uFathertel` varchar(25) NOT NULL COMMENT '爸爸号码',
  `uMother` varchar(15) NOT NULL COMMENT '妈妈',
  `uMothertel` varchar(25) NOT NULL COMMENT '妈妈号码',
  `uTotalfee` varchar(15) NOT NULL COMMENT '应收续费',
  `uPayfee` varchar(15) NOT NULL COMMENT '实际缴费',
  `uFrom` varchar(15) NOT NULL COMMENT '了解渠道',
  `uBirth` varchar(15) DEFAULT NULL COMMENT '生日',
  `uSex` tinyint(1) NOT NULL COMMENT '性别',
  `uAge` tinyint(2) DEFAULT NULL COMMENT '年龄',
  `uWhere` varchar(45) DEFAULT NULL COMMENT '籍贯',
  `uMemo` varchar(50) DEFAULT NULL COMMENT '备注',
  `createat` varchar(12) NOT NULL COMMENT '创建时间',
  `endtime` varchar(15) DEFAULT NULL COMMENT '结业时间',
  `isdestory` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `hj_student`
--

INSERT INTO `hj_student` (`id`, `status`, `cId`, `gid`, `tId`, `uName`, `uSchool`, `uFather`, `uFathertel`, `uMother`, `uMothertel`, `uTotalfee`, `uPayfee`, `uFrom`, `uBirth`, `uSex`, `uAge`, `uWhere`, `uMemo`, `createat`, `endtime`, `isdestory`) VALUES
(1, 0, 2, 2, 0, '123123', '123', '', '', '', '', '', '123', '2', '123', 0, 123, '123', '123', '1361347588', NULL, 0),
(2, 3, 1, 2, 0, 'abc', 'abc', '', '', '', '', '', 'abc', '2', 'abc', 1, 0, 'abc', 'abcabc', '1361347896', NULL, 0),
(3, 0, 1, 2, 0, '123', '123', '', '', '', '', '', '123', '2', '123', 1, 123, '123', '123123', '1361411923', NULL, 0),
(4, 1, 1, 1, 0, 'abc1', 'abc2', 'abc4', 'abc6', 'abc5', 'abc7', '', 'abc3', '2', 'abc9', 1, 8, 'abc11', 'abc111', '1361497186', NULL, 0),
(5, 0, 1, 2, 0, '123123', '1231212312', '1231231', '123123', '12312312312', '12312312', '', '3123123123', '3', '12312312', 0, 127, '123123', '1231231', '1361412500', NULL, 0),
(6, 0, 2, 1, 0, '123123', '1231212312', '1231231', '123123', '12312312312', '12312312', '', '3123123123', '3', '12312312', 0, 127, '123123', '1231231', '1361412706', NULL, 0),
(7, 0, 2, 1, 0, '123123', '1231212312', '1231231', '123123', '12312312312', '12312312', '', '3123123123', '3', '12312312', 0, 127, '123123', '1231231', '1361412850', NULL, 0),
(8, 0, 2, 1, 2, 'eeee', 'eeee', 'eeee', 'eeee', 'eeeee', 'eeee', '', 'eeee', '4', 'dddd', 2, 5, 'ddddd', 'dddd', '1361412893', NULL, 0),
(9, 0, 1, 1, 2, 'eeee', 'eeee', 'eeee', 'eeee', 'eeeee', 'eeee', '', 'eeee', '4', 'dddd', 2, 5, 'ddddd', 'dddd', '1361413170', NULL, 0),
(10, 0, 2, 2, 1, 'adasd', 'adasdf', 'asdfa', '123123123', 'asdfadsf', '12123123', '', '22222', '1', '123123123123', 2, 12, '123123', '12312312', '1361761532', NULL, 0),
(11, 0, 1, 1, 2, '12312', '123123', '23123123', '12312', '1231', '312312312', '', '1231231', '1', '123123', 1, 127, '12312312', '123123', '1361761546', NULL, 0),
(12, 0, 2, 2, 2, '12321', '123123123123', '31231231', '1231231', '3123123123', '123123', '', '12312312312', '1', '123123123123123', 1, 127, '123123123', '123123', '1361761565', NULL, 0),
(13, 0, 1, 2, 2, '4534534', '34534', '53453453', '345', '4534', '3453', '', '5345345345', '1', '345345345', 1, 127, '345345345', '34534534', '1361761584', NULL, 0),
(14, 0, 1, 1, 2, '565656', '56565', '5656565', '5656', '5656565', '56565656', '', '565656', '1', '565656', 1, 127, '565656', '5656565', '1361761598', NULL, 0),
(15, 0, 1, 1, 1, '76867', '867867867', '678678', '678678', '678678', '678678', '', '67867', '1', '67867867', 1, 127, '678678678', '67867867', '1361761618', NULL, 0),
(16, 0, 1, 1, 1, '98089', '89089089', '890890', '890', '890890', '89089', '', '89089', '1', '89089089', 1, 127, '89089', '890890', '1361761632', NULL, 0),
(17, 0, 2, 1, 1, '1515', '15151', '151', '1515', '1515', '15151', '', '1515', '3', '1515151', 1, 127, '15151', '15151', '1361761650', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

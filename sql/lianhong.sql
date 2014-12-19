-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 08 月 24 日 16:55
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `lianhong`
--

-- --------------------------------------------------------

--
-- 表的结构 `lh_adplace`
--

DROP TABLE IF EXISTS `lh_adplace`;
CREATE TABLE IF NOT EXISTS `lh_adplace` (
  `id` int(11) NOT NULL auto_increment,
  `adpAlias` varchar(20) NOT NULL COMMENT '广告位别名',
  `adpTitle` varchar(100) NOT NULL COMMENT '广告位名称',
  `adpWidth` int(8) NOT NULL default '0' COMMENT '广告位宽度',
  `adpHeight` int(8) NOT NULL default '0' COMMENT '高度',
  `adpDes` varchar(200) NOT NULL COMMENT '描述',
  `adpNum` int(5) NOT NULL default '0' COMMENT '取数据条数',
  `adpRand` tinyint(1) NOT NULL default '0' COMMENT '是否随机取',
  `adpCache` int(5) NOT NULL default '0' COMMENT '缓存时间',
  `updateTime` int(10) NOT NULL COMMENT '更新时间',
  `createTime` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `adpAlias_UNIQUE` (`adpAlias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告位置' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `lh_adplace`
--

INSERT INTO `lh_adplace` (`id`, `adpAlias`, `adpTitle`, `adpWidth`, `adpHeight`, `adpDes`, `adpNum`, `adpRand`, `adpCache`, `updateTime`, `createTime`) VALUES
(1, 'iAT', '关于联泓', 730, 88, '关于联泓导航下图片', 1, 0, 0, 1345791594, 1345791523),
(2, 'iST', '总裁致辞', 730, 88, '总裁致辞', 1, 0, 0, 1345791588, 1345791569),
(3, 'iIT', '公司介绍', 730, 270, '公司介绍', 1, 0, 0, 1345791628, 1345791628),
(4, 'iTT', '管理团队', 730, 88, '管理团队', 1, 0, 0, 1345795157, 1345791715),
(5, 'iOT', '组织结构', 730, 88, '组织结构', 1, 0, 0, 1345795149, 1345791754),
(6, 'iDT', '发展历程', 730, 278, '发展历程', 1, 0, 0, 1345791813, 1345791813),
(7, 'iConT', '联系我们', 730, 88, '联系我们', 1, 0, 0, 1345791881, 1345791881),
(8, 'iCulT', '文化', 730, 88, '文化', 1, 0, 0, 1345792015, 1345791948),
(10, 'iMT', '管理', 730, 88, '管理', 1, 0, 0, 1345792005, 1345791989),
(11, 'cLT', '旗下企业列表页', 960, 277, '旗下企业列表页', 1, 0, 0, 1345792554, 1345792082),
(12, 'cVT', '旗下企业内容页', 735, 270, '旗下企业内容页', 1, 0, 0, 1345792561, 1345792124),
(13, 'nT', '联泓动态', 735, 104, '联泓动态', 1, 0, 0, 1345792543, 1345792311),
(14, 'rLT', '人才需求列表页', 730, 88, '人才需求列表页', 1, 0, 0, 1345795140, 1345792365),
(15, 'rVT', '人才需求内容页', 735, 267, '人才需求内容页', 1, 0, 0, 1345792531, 1345792404);

-- --------------------------------------------------------

--
-- 表的结构 `lh_ads`
--

DROP TABLE IF EXISTS `lh_ads`;
CREATE TABLE IF NOT EXISTS `lh_ads` (
  `id` int(11) NOT NULL auto_increment,
  `adTitle` varchar(100) NOT NULL COMMENT '标题',
  `adPlace` varchar(20) NOT NULL COMMENT '广告位',
  `adType` varchar(10) NOT NULL default '0' COMMENT '广告类型',
  `adUrl` varchar(100) NOT NULL COMMENT '广告链接',
  `adContent` text NOT NULL COMMENT '内容',
  `updateTime` int(10) NOT NULL COMMENT '更新时间',
  `createTime` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `lh_ads`
--

INSERT INTO `lh_ads` (`id`, `adTitle`, `adPlace`, `adType`, `adUrl`, `adContent`, `updateTime`, `createTime`) VALUES
(1, '关于联泓', 'iAT', 'img', '', './Public/uploads/admin/20120824/50372b179084a.jpg', 1345792793, 1345792793),
(2, '总裁致辞', 'iST', 'img', '', './Public/uploads/admin/20120824/50372b7d3360d.jpg', 1345792894, 1345792894),
(3, '公司介绍', 'iIT', 'img', '', './Public/uploads/admin/20120824/50372e0d092bc.jpg', 1345793550, 1345793550),
(4, '发展历程', 'iDT', 'img', '', './Public/uploads/admin/20120824/50372e2ccd818.jpg', 1345793581, 1345793581),
(5, '联系我们', 'iConT', 'img', '', './Public/uploads/admin/20120824/50372e406b97b.jpg', 1345793601, 1345793601),
(6, '旗下企业列表页', 'cLT', 'img', '', './Public/uploads/admin/20120824/50372ebac3bfe.jpg', 1345793723, 1345793723),
(7, '旗下企业内容页', 'cVT', 'img', '', './Public/uploads/admin/20120824/50372ef14ef0e.jpg', 1345793777, 1345793777),
(8, '联泓动态', 'nT', 'img', '', './Public/uploads/admin/20120824/50372f14d62ef.jpg', 1345793813, 1345793813),
(9, '文化', 'iCulT', 'img', '', './Public/uploads/admin/20120824/50372f787f8a0.jpg', 1345793913, 1345793913),
(10, '管理', 'iMT', 'img', '', './Public/uploads/admin/20120824/50372f88921e5.jpg', 1345794026, 1345793929),
(11, '人才需求内容页', 'rVT', 'img', '', './Public/uploads/admin/20120824/50373023dd84c.jpg', 1345794084, 1345794084),
(12, '管理团队', 'iTT', 'img', '', './Public/uploads/admin/20120824/5037342b1d76a.jpg', 1345795115, 1345795115),
(13, '组织结构', 'iOT', 'img', '', './Public/uploads/admin/20120824/5037346b689bf.jpg', 1345795179, 1345795179);

-- --------------------------------------------------------

--
-- 表的结构 `lh_course`
--

DROP TABLE IF EXISTS `lh_course`;
CREATE TABLE IF NOT EXISTS `lh_course` (
  `id` int(11) NOT NULL auto_increment COMMENT '历程id',
  `courseTime` varchar(20) NOT NULL default '' COMMENT '发展时间',
  `courseTitle` varchar(100) NOT NULL COMMENT '发展事件',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='发展历程' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lh_course`
--

INSERT INTO `lh_course` (`id`, `courseTime`, `courseTitle`) VALUES
(1, '2000年8月1日', '联泓公司成立'),
(2, '2001年8月1日', '联泓公司上海分公司成立');

-- --------------------------------------------------------

--
-- 表的结构 `lh_dict`
--

DROP TABLE IF EXISTS `lh_dict`;
CREATE TABLE IF NOT EXISTS `lh_dict` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `dictSort` int(5) NOT NULL default '0',
  `dictName` varchar(20) NOT NULL COMMENT '名称',
  `dictType` varchar(10) NOT NULL COMMENT '分类',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='数据字典' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lh_dict`
--

INSERT INTO `lh_dict` (`id`, `pid`, `dictSort`, `dictName`, `dictType`) VALUES
(1, 0, 0, '公司新闻', 'news'),
(2, 0, 0, '媒体新闻', 'news');

-- --------------------------------------------------------

--
-- 表的结构 `lh_download`
--

DROP TABLE IF EXISTS `lh_download`;
CREATE TABLE IF NOT EXISTS `lh_download` (
  `id` int(11) NOT NULL auto_increment,
  `dlTitle` varchar(100) NOT NULL COMMENT '标题',
  `dlFile` varchar(100) NOT NULL COMMENT '附件地址',
  `dlType` varchar(20) NOT NULL COMMENT '分类',
  `codeImg` varchar(255) NOT NULL COMMENT '二维码图片路径',
  `codeDesc` text NOT NULL COMMENT '二维码描述',
  `isIndex` tinyint(1) NOT NULL default '0' COMMENT '是否首页',
  `isTop` tinyint(1) NOT NULL default '0' COMMENT '是否置顶',
  `dlContent` text NOT NULL COMMENT '内容',
  `updateTime` int(10) NOT NULL COMMENT '更新时间',
  `createTime` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='下载' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lh_download`
--


-- --------------------------------------------------------

--
-- 表的结构 `lh_links`
--

DROP TABLE IF EXISTS `lh_links`;
CREATE TABLE IF NOT EXISTS `lh_links` (
  `id` int(11) NOT NULL auto_increment,
  `linkName` varchar(20) NOT NULL,
  `linkType` varchar(10) NOT NULL default '0',
  `linkAlias` varchar(20) NOT NULL COMMENT '赞助名称',
  `linkSort` int(8) NOT NULL default '0',
  `linkUrl` varchar(100) NOT NULL,
  `linkImg` varchar(100) NOT NULL COMMENT '友情链接图片',
  `linkContent` text NOT NULL,
  `isIndex` tinyint(1) NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lh_links`
--


-- --------------------------------------------------------

--
-- 表的结构 `lh_nav`
--

DROP TABLE IF EXISTS `lh_nav`;
CREATE TABLE IF NOT EXISTS `lh_nav` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `navName` varchar(20) NOT NULL COMMENT '导航名称',
  `navSort` int(5) NOT NULL default '0',
  `navType` varchar(10) NOT NULL COMMENT '导航类型',
  `navDescription` text NOT NULL COMMENT '栏目描述',
  `navImg` varchar(100) NOT NULL COMMENT '栏目图片',
  `navUrl` varchar(100) NOT NULL COMMENT '导航地址',
  `status` tinyint(1) NOT NULL default '0' COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导航' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lh_nav`
--


-- --------------------------------------------------------

--
-- 表的结构 `lh_news`
--

DROP TABLE IF EXISTS `lh_news`;
CREATE TABLE IF NOT EXISTS `lh_news` (
  `id` int(11) NOT NULL auto_increment,
  `newsTitle` varchar(100) NOT NULL COMMENT '标题',
  `newsType` int(11) NOT NULL default '0' COMMENT '分类',
  `newsImg` varchar(100) NOT NULL COMMENT '新闻图片',
  `newsUrl` varchar(100) NOT NULL COMMENT '外链地址',
  `newsLink` varchar(100) NOT NULL COMMENT '关联信息',
  `isIndex` tinyint(1) NOT NULL default '0' COMMENT '是否首页',
  `isTop` tinyint(1) NOT NULL default '0' COMMENT '是否置顶',
  `keywords` varchar(200) NOT NULL,
  `newsDescription` varchar(255) NOT NULL,
  `newsContent` text NOT NULL COMMENT '内容',
  `updateTime` int(10) NOT NULL COMMENT '更新时间',
  `createTime` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='新闻' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `lh_news`
--

INSERT INTO `lh_news` (`id`, `newsTitle`, `newsType`, `newsImg`, `newsUrl`, `newsLink`, `isIndex`, `isTop`, `keywords`, `newsDescription`, `newsContent`, `updateTime`, `createTime`) VALUES
(1, '联想首个化工项目落户汶上', 2, '', '', '大众日报', 0, 0, '首个', 'dfsdfsdf', 'sdfasdfasdfasd', 1345620267, 1345620267),
(2, '联泓控股有限公司成立', 1, './Public/uploads/admin/20120824/5037332e2c3c3.jpg', '', '', 0, 0, 'dddd', 'dddd\r\nas', 'fasdfasdfasdfsdfsa', 1345794863, 1345620318),
(3, '联泓在上海上市', 1, './Public/uploads/admin/20120824/5037331892ecd.jpg', '', '', 0, 0, '联泓在上海上市', '联泓在上海上市联泓在上海上市联泓在上海上市', '联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市<span style="color:#323232;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;">联泓在上海上市联泓在上海上市联泓在上海上市联泓在上海上市</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span>', 1345795247, 1345709524),
(4, '媒体新闻1', 2, '', '', '经济导报', 0, 0, '媒体新闻1', '媒体新闻1', '媒体新闻1', 1345788163, 1345788163);

-- --------------------------------------------------------

--
-- 表的结构 `lh_recruit`
--

DROP TABLE IF EXISTS `lh_recruit`;
CREATE TABLE IF NOT EXISTS `lh_recruit` (
  `id` int(11) NOT NULL auto_increment,
  `officeName` varchar(50) NOT NULL COMMENT '职位名称',
  `companyName` varchar(50) NOT NULL COMMENT '公司名称',
  `address` varchar(50) NOT NULL COMMENT '工作地点',
  `recruitNum` int(5) NOT NULL COMMENT '招聘人数',
  `degree` varchar(20) NOT NULL COMMENT '学历要求',
  `startTime` varchar(20) NOT NULL COMMENT '开始时间',
  `endTime` varchar(20) NOT NULL COMMENT '结束时间',
  `duty` text NOT NULL COMMENT '工作职责',
  `post` text NOT NULL COMMENT '职位要求',
  `contact` text NOT NULL COMMENT '联系方式',
  `sort` int(5) NOT NULL COMMENT '排序',
  `createTime` int(10) NOT NULL default '0' COMMENT '发布日期',
  `updateTime` int(10) NOT NULL default '0' COMMENT '更新日期',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='招聘' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lh_recruit`
--

INSERT INTO `lh_recruit` (`id`, `officeName`, `companyName`, `address`, `recruitNum`, `degree`, `startTime`, `endTime`, `duty`, `post`, `contact`, `sort`, `createTime`, `updateTime`) VALUES
(1, 'IT经理岗位', '', '上海', 0, '', '', '', 'IT经理岗位', 'IT经理岗位', 'IT经理岗位', 0, 1345794650, 1345794650),
(2, 'IT经理岗位1', '', '北京', 0, '', '', '', 'IT经理岗位1', 'IT经理岗位1', 'IT经理岗位1', 0, 1345794663, 1345794663);

-- --------------------------------------------------------

--
-- 表的结构 `lh_setting`
--

DROP TABLE IF EXISTS `lh_setting`;
CREATE TABLE IF NOT EXISTS `lh_setting` (
  `skey` varchar(20) NOT NULL,
  `sval` text NOT NULL,
  PRIMARY KEY  (`skey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统设置';

--
-- 转存表中的数据 `lh_setting`
--

INSERT INTO `lh_setting` (`skey`, `sval`) VALUES
('sitename', '联泓官网'),
('website', 'http://lianhong.cc'),
('copyRight', 'Copyright © 2012联泓官网'),
('record', '京ICP备12026412号'),
('smtpServer', 'smtp.qq.com'),
('smtpPort', '25'),
('smtpSsl', '1'),
('smtpUser', '200928801@qq.com'),
('smtpPw', 'net82952265!@#'),
('smtpEmail', '200928801@qq.com'),
('telephone', '010-11111111'),
('fax', '010-11111111'),
('email', 'lh@lh365.com'),
('microblog', ''),
('owner', '联泓官网'),
('siteTitle', '联泓官网'),
('goodsImg', './Public/uploads/admin/20120719/5007da66c6374.gif'),
('keywords', '联泓官网'),
('description', '联泓官网'),
('status', '0'),
('closeReason', '系统维护中。。。'),
('hotSearch', ''),
('gopay_key', 'lh365zhaocaiyu'),
('gopay_code', '0000045810'),
('storeBanner', './Public/uploads/admin/20120720/500926448f6fc.jpg'),
('sensitive', '*********,*********');

-- --------------------------------------------------------

--
-- 表的结构 `lh_single`
--

DROP TABLE IF EXISTS `lh_single`;
CREATE TABLE IF NOT EXISTS `lh_single` (
  `id` int(11) NOT NULL auto_increment,
  `singleName` varchar(20) NOT NULL COMMENT '单页别名',
  `singleType` varchar(20) NOT NULL COMMENT '单页类型',
  `singleImg` varchar(200) NOT NULL COMMENT '单页图片',
  `singleSort` int(5) NOT NULL default '0' COMMENT '排序',
  `singleTitle` varchar(50) NOT NULL COMMENT '标题',
  `singleContent` text NOT NULL COMMENT '内容',
  `updateTime` int(10) NOT NULL default '0' COMMENT '更新时间',
  `createTime` int(10) NOT NULL default '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `summitcol_UNIQUE` (`singleName`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='单页' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `lh_single`
--

INSERT INTO `lh_single` (`id`, `singleName`, `singleType`, `singleImg`, `singleSort`, `singleTitle`, `singleContent`, `updateTime`, `createTime`) VALUES
(1, 'speech', 'intro', './Public/uploads/admin/20120824/5036f47177b55.jpg', 0, '总裁致辞', '<div style="margin:0px;padding:0px;border:0px none;font-family:宋体, Arial, Helvetica, sans-serif;text-align:center;background-color:#FFFFFF;">\r\n	<img src="http://localhost/lh/Public/site/images/ceo.jpg" /><br />\r\n<span style="color:#424242;line-height:30px;">董事长兼总裁&nbsp;&nbsp;郑月明</span>\r\n</div>\r\n<div style="margin:0px 50px 0px 0px;padding:0px;border:0px none;font-family:宋体, Arial, Helvetica, sans-serif;text-align:center;background-color:#FFFFFF;">\r\n	<p style="color:#323232;text-indent:20pt;text-align:left;">\r\n		联泓集团，脱胎于联想控股。 我们由联想控股化工事业部发展而来，是联想控股中期发展战略的重要核心资产之一。依托联想控股广阔的事业发展平台，在精细化工和化工新材料领域成为有影响力的领先企业是我们的使命。 化工行业是关系国计民生的重要行业，中国经济的快速发展使得精细化工和化工新材料领域蕴藏着众多的机遇，发展空间广阔。在这个朝阳领域探究、创新、坚持、发展是我们的方向。 我们是一群志同道合的人，将个人的追求融入到企业的长远发展之中，共同为实现联想控股的战略目标，为实现联泓集团的愿景而不懈努力。<br />\r\n机遇、挑战、责任、进取。联泓集团，在路上！\r\n	</p>\r\n</div>\r\n<span style="font-family:宋体, Arial, Helvetica, sans-serif;line-height:normal;background-color:#FFFFFF;"></span><span style="font-family:宋体, Arial, Helvetica, sans-serif;line-height:normal;background-color:#FFFFFF;"></span>\r\n<div style="margin:0px;padding:0px;border:0px none;font-family:宋体, Arial, Helvetica, sans-serif;background-color:#FFFFFF;text-align:right;">\r\n	<img src="http://localhost/lh/Public/site/images/ceo_sing.jpg" style="width:187px;height:87px;" />\r\n</div>', 1345778857, 1345606117),
(2, 'company', 'intro', '', 0, '公司愿景&nbsp;:&nbsp;致力于成为精细化工和化工新材料领域有影响力的领先企业', '联泓控股有限公司是联想控股成员企业，联想控股有限公司(以下简称"联想控股")于1984年成立，经过28年的发展，已成为一间横跨多个行业的大型综合企业。先后打造出联想集团、神州数码、君联资本、弘毅投资和融科智地等一批行业领先的企业和一大批优秀人才。联想控股致力于制造卓越企业。<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;联泓控股有限公司是联想控股五大核心运营资产之一，是从事化工产业投资和管理的集团公司。公司成立于2012年4月12日，公司关注具有发展前景的新型化工产业，以精细化工和化工新材料为发展方向，致力于打造有规模、有影响力，具有综合竞争力的化工产业集群。<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;联泓控股目前拥有山东神达化工有限公司、山东昊达化学有限公司、济宁中银电化有限公司、滕州郭庄矿业有限责任公司、天津联泓锦化工贸易公司等5家子公司和常州精细化学品研发中心，员工近5000人。联泓控股正在山东滕州和济宁，分别同步建设以甲醇为原材料的高端烯烃深加工产业链和新型盐化工产业链，总投资约91亿元，建成投产后销售收入将超过100亿元。 &nbsp;', 1345779140, 1345606167),
(3, 'team', 'intro', '', 0, '管理团队', '', 1345606246, 1345606246),
(4, 'organ', 'intro', '', 0, '组织架构', '', 1345606344, 1345606344),
(5, 'contact', 'intro', '', 0, '联系我们', '', 1345606364, 1345606364),
(6, 'cultrue', 'intro', '', 0, '文化', '<pre class="reply-text mb10">【概况】\r\n        联想集团于1984年在中国北京成立，是一家全球领先的PC企业，由原联想集团和原IBM个人电脑事业部组合而成。联想2009/10财年营业额达166亿美元，该财年全球PC市场份额8.8%。联想从1997年以来蝉联中国国内市场销量第一，并连年在亚太市场（日本除外）名列前茅（数据来源：IDC）。联想集团于1994年在香港上市（股份编号992）。\r\n  \r\n【企业文化】</pre>\r\n<pre>——企业定位\r\n    ·联想从事开发、制造及销售最可靠的、安全易用的技术产品。\r\n    ·我们的成功源自于不懈地帮助客户提高生产力，提升生活品质。\r\n \r\n——使命\r\n    ·为客户利益而努力创新\r\n    ·创造世界最优秀、最具创新性的产品\r\n    ·像对待技术创新一样致力于成本创新\r\n    ·让更多的人获得更新、更好的技术\r\n    ·最低的总体拥有成本（TCO），更高的工作效率\r\n\r\n——核心价值观\r\n    · 成就客户—我们致力于每位客户的满意和成功。\r\n    · 创业创新—我们追求对客户和公司都至关重要的创新，同时快速而高效地推动其实现。 \r\n    · 诚信正直—我们秉持信任、诚实和富有责任感，无论是对内部还是外部。 \r\n    · 多元共赢—我们倡导互相理解，珍视多元性，以全球视野看待我们的文化。\r\n \r\n ——愿景\r\n        联想基于对行业的深厚理解，以及对优秀的管理和文化基因的传承，正加快技术创新步伐，在全球范围内打造高品质的产品，让消费者充分享受卓越的科技生活。联想致力于发展成为一个行业领导型企业，一个在全球内受人尊重的企业，一个基业常青的企业，为客户、股东、员工和社会创造更多的价值，让世界因联想更美好。\r\n  \r\n——企业社会责任\r\n        作为企业公民，联想积极关注来自全球各地社区的发展需求，将社会参与聚集“缩小数字鸿沟、环境保护、教育、扶贫赈灾”四大领域。通过“结合业务发展战略、引入创新公益机制、坚持传统慈善捐赠”三大手段持续加大对社会的投入。联想支持公益事业发展，积极创造条件，鼓励更多的员工投身志愿者活动，为社会奉献才智和爱心。在2003年和2005年，联想分别向中国非典防治和南亚印度洋海啸灾区提供了资金帮助，2008年5月的四川汶川地震后的第一时间，联想捐赠1000万人民币并组织员工献血。\r\n        2007年12月，联想启动公益创投计划。两年来，共支持了近30家公益组织发展壮大。2009年和2010年，联想面向以大学生为主的青年群体，启动了“联想青年公益创业计划”，支持青年群体的就业和成长，并呼吁更多机构关注青年公益创业，共同推动中国公益事业创新发展。</pre>', 1345795748, 1345613708),
(7, 'manage', 'intro', '', 0, '管理', '<p style="color:#272727;font-family:Simsun;font-size:14px;">\r\n	<strong>联想管理三要素</strong> \r\n</p>\r\n<p style="color:#272727;font-family:Simsun;font-size:14px;">\r\n	　　管理涉及到很多内容，联想将其中的三个重要因子作为管理的三要素，即建班子、定战略、带队伍，以此作为管理的重点。\r\n</p>\r\n<p style="color:#272727;font-family:Simsun;font-size:14px;">\r\n	　　建班子——领导班子是企业的大脑，涉及到企业生死存亡的重大决策全由此产生，与企业朝夕相关的事务也由它总管理，所以在企业中具有举足轻重的作用。它有如核心竞争力的内核，起着聚集力量的作用。有威信、有激情的领导班子，可以一层层地激励员工，使核心竞争力不断地扩大。\r\n</p>\r\n<p style="color:#272727;font-family:Simsun;font-size:14px;">\r\n	　　定战略——战略是企业前行的路径，不同时期、不同内容的战略有如一股股地细线，相互拧在一起，就是核心竞争力发展的主线。核心竞争力影响着战略思想，又沿着一个个战略前行，所以战略的发展过程也是核心竞争力的发展过程。企业的发展目标、方向和政策等重大问题都要形成战略，由班子制定，由全企业共同努力实现，共同促进企业发展。\r\n</p>\r\n<p style="color:#272727;font-family:Simsun;font-size:14px;">\r\n	　　带队伍——全企业的员工围绕着企业的核心层，在领导班子的带领下，沿着指明的路线奋斗。全员共同努力增强企业的综合竞争力，全员又沿着既定的方向推动核心竞争力的发展，是实现企业竞争力的具体力量。带队伍，就是不断地培养适合企业发展的人才，共同把企业做强做大。\r\n</p>\r\n<p style="color:#272727;font-family:Simsun;font-size:14px;">\r\n	　　班子牢了才能领导企业，战略有了才能发展企业，队伍强了才能壮大企业。\r\n</p>', 1345795707, 1345613719),
(8, 'about', 'intro', '', 0, '关于联泓', '关于联泓', 1345778036, 1345778036);

-- --------------------------------------------------------

--
-- 表的结构 `lh_site_seo`
--

DROP TABLE IF EXISTS `lh_site_seo`;
CREATE TABLE IF NOT EXISTS `lh_site_seo` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL COMMENT '标题',
  `group` varchar(20) NOT NULL COMMENT '分组',
  `mod` varchar(20) NOT NULL COMMENT '模块',
  `act` varchar(20) NOT NULL COMMENT '操作',
  `seoTitle` varchar(100) NOT NULL COMMENT 'seo标题 ',
  `seoKeywords` varchar(250) NOT NULL COMMENT 'seo关键字',
  `seoDescription` text NOT NULL COMMENT 'seo描述',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `lh_site_seo`
--


-- --------------------------------------------------------

--
-- 表的结构 `lh_star`
--

DROP TABLE IF EXISTS `lh_star`;
CREATE TABLE IF NOT EXISTS `lh_star` (
  `id` int(11) NOT NULL auto_increment,
  `starName` varchar(50) NOT NULL COMMENT '标题',
  `starImg` varchar(100) NOT NULL COMMENT '图片',
  `logo` varchar(100) NOT NULL COMMENT 'Logo图片路径',
  `starContent` text NOT NULL COMMENT '团队风采内容',
  `stepSort` int(8) NOT NULL COMMENT '排序',
  `photos` text NOT NULL COMMENT '组图',
  `isIndex` tinyint(1) NOT NULL default '0',
  `updateTime` int(10) NOT NULL default '0' COMMENT '更新时间',
  `createTime` int(10) NOT NULL default '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='团队风采' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lh_star`
--

INSERT INTO `lh_star` (`id`, `starName`, `starImg`, `logo`, `starContent`, `stepSort`, `photos`, `isIndex`, `updateTime`, `createTime`) VALUES
(1, '联泓上海分公司', './Public/uploads/admin/20120822/503478a95eb92.jpg', './Public/uploads/admin/20120824/50370e1a8796b.jpg', '联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司联泓上海分公司', 0, 'a:1:{i:0;s:49:"./Public/uploads/admin/20120822/50348226193b7.jpg";}', 0, 1345785372, 1345616568);

-- --------------------------------------------------------

--
-- 表的结构 `lh_sys_group`
--

DROP TABLE IF EXISTS `lh_sys_group`;
CREATE TABLE IF NOT EXISTS `lh_sys_group` (
  `id` int(11) NOT NULL auto_increment,
  `groupName` varchar(20) NOT NULL COMMENT '导航名称',
  `navTops` text NOT NULL COMMENT '头部导肮',
  `navIds` text NOT NULL COMMENT '子导航',
  `groupDescription` text NOT NULL COMMENT '栏目描述',
  `status` tinyint(1) NOT NULL default '0' COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户分组' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `lh_sys_group`
--

INSERT INTO `lh_sys_group` (`id`, `groupName`, `navTops`, `navIds`, `groupDescription`, `status`) VALUES
(1, '管理员', '1,2,3', '4,14,16,21,35,40,73,10,15,77,76,71,9,19', '', 1),
(4, '编辑', '44', '48,43,41,26,42', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `lh_sys_nav`
--

DROP TABLE IF EXISTS `lh_sys_nav`;
CREATE TABLE IF NOT EXISTS `lh_sys_nav` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `navName` varchar(20) NOT NULL COMMENT '导航名称',
  `navSort` int(5) NOT NULL default '0',
  `navDescription` text NOT NULL COMMENT '栏目描述',
  `navUrl` varchar(100) NOT NULL COMMENT '导航地址',
  `status` tinyint(1) NOT NULL default '0' COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台导航' AUTO_INCREMENT=78 ;

--
-- 转存表中的数据 `lh_sys_nav`
--

INSERT INTO `lh_sys_nav` (`id`, `pid`, `navName`, `navSort`, `navDescription`, `navUrl`, `status`) VALUES
(1, 0, '系统管理', 0, '系统设置系统设置系统设置系统设置系统设置', '', 1),
(2, 0, '内容管理', 1, '内容管理内容管理内容管理', '', 1),
(3, 0, '用户管理', 100, '用户管理用户管理用户管理', '', 1),
(4, 1, '系统设置', 101, '', 'Setting/index', 1),
(5, 1, '后台导航管理', 98, '', 'Sysnav/index', 0),
(9, 3, '管理员管理', 100, '', 'User/index', 1),
(10, 2, '新闻管理', 100, '', 'News/index', 1),
(13, 1, '前台导航管理', 98, '', 'Nav/index', 0),
(14, 1, '分类管理', 99, '', 'Dict/index', 1),
(15, 2, '单页管理', 98, '', 'Single/index', 1),
(16, 1, '广告管理', 99, '', 'Ads/index', 1),
(19, 3, '权限管理', 0, '', 'Sysgroup/index', 1),
(21, 1, '邮件设置', 101, '', 'Setting/email', 1),
(41, 44, '下载管理', 97, '下载管理', 'Download/index', 1),
(35, 1, '广告位管理', 100, '', 'Adp/index', 1),
(47, 46, '分类管理', 100, '', 'Goodscate/index', 1),
(40, 1, '清除缓存', 1, '清除缓存', 'System/clearcache', 1),
(55, 0, '地区管理', 0, '', '', 0),
(77, 2, '旗下企业', 0, '', 'Star/index', 1),
(76, 2, '人才需求', 0, '人才需求', 'Recruit/index', 1),
(71, 2, '友情链接', 0, '友情链接', 'Link/index?type=mLink', 0),
(73, 1, '网站关键字', 0, '', 'Seo/index', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lh_user`
--

DROP TABLE IF EXISTS `lh_user`;
CREATE TABLE IF NOT EXISTS `lh_user` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `bind_account` int(5) NOT NULL default '0',
  `last_login_time` int(11) unsigned NOT NULL default '0',
  `last_login_ip` varchar(40) NOT NULL,
  `login_count` mediumint(8) unsigned NOT NULL default '0',
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `lh_user`
--

INSERT INTO `lh_user` (`id`, `account`, `nickname`, `password`, `bind_account`, `last_login_time`, `last_login_ip`, `login_count`, `email`, `remark`, `create_time`, `update_time`, `status`) VALUES
(1, 'admin', '管理员', '21232f297a57a5a743894a0e4a801fc3', 1, 1345796181, '127.0.0.1', 0, '200928809@qq.com', '', 1222907803, 1343618807, 1),
(6, 'lh', 'lh', '96e79218965eb72c92a549dd5a330112', 4, 1343024950, '110.172.234.107', 0, '111@11.com', '', 1343024784, 1343024901, 1),
(8, 'liehuo', 'liehuo', '5cb7f339d923b2751c3131f12225cdcb', 1, 1343985749, '127.0.0.1', 0, 'liehuo@qq.com', '<span style="white-space:nowrap;">liehuo</span>', 1343280307, 1343377705, 1);

-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 12 月 25 日 08:05
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `market`
--

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` char(30) NOT NULL,
  `itemid` int(11) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`cid`, `uid`, `itemid`, `body`) VALUES
(1, 'zhangsan@163.com', 1, '这个手机还不错'),
(2, 'zhangsan@163.com', 1, '嗯我看不错'),
(3, 'zhangsan@163.com', 1, '小米不错'),
(4, 'zhangsan@163.com', 1, 'bvn'),
(5, 'zhangsan@163.com', 1, '不如华为好看'),
(6, 'zhangsan@163.com', 2, '太贵了'),
(7, 'zhangsan@163.com', 3, '也很不错啊'),
(8, 'zhangsan@163.com', 4, '喜欢茶轴的键盘'),
(9, 'zhangsan@163.com', 5, '设计简洁很不错'),
(10, 'zhangsan@163.com', 1, 'asidua'),
(11, 'zhangsan@163.com', 8, '还行把'),
(12, 'zhangsan@163.com', 9, '不错'),
(13, 'zhangsan@163.com', 9, '不错'),
(14, 'lisi@163.com', 9, '看起来不错啊');

-- --------------------------------------------------------

--
-- 表的结构 `governor`
--

CREATE TABLE IF NOT EXISTS `governor` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` char(30) NOT NULL,
  `gpassword` char(30) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `governor`
--

INSERT INTO `governor` (`gid`, `gname`, `gpassword`) VALUES
(1, 'wu@163.com', '111111');

-- --------------------------------------------------------

--
-- 表的结构 `itemcata`
--

CREATE TABLE IF NOT EXISTS `itemcata` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cataname` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `itemcata`
--

INSERT INTO `itemcata` (`Id`, `cataname`) VALUES
(1, '手机'),
(2, '键盘'),
(3, '耳机'),
(4, '手表'),
(5, '音响'),
(6, '相机');

-- --------------------------------------------------------

--
-- 表的结构 `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `ids` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `itemcata` char(1) NOT NULL DEFAULT '0',
  `cata` varchar(50) NOT NULL,
  `num` int(11) NOT NULL,
  `image` char(100) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`ids`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `items`
--

INSERT INTO `items` (`ids`, `name`, `price`, `itemcata`, `cata`, `num`, `image`, `body`) VALUES
(1, '小米8', 2499, '1', '北京', 989, 'item1.jpg', '小米8 全面屏游戏智能手机 6GB+64GB 蓝色 全网通4G 双卡双待\n【爆品】 骁龙845，红外人脸解锁，AI变焦双摄小米返场“暖男节”热爱继续！\n选移动，享大流量，不换号购机！'),
(2, 'Apple iPhone X', 6999, '1', '上海', 996, 'item2.jpg', 'Apple 苹果X iPhoneX 全网通4G手机 深空灰色 256G标配\r\n【国行正品 完美物流】送无线充+指环扣+壳+膜【抢购苹果XS】'),
(3, '华为 HUAWEI Mate 20 X ', 4999, '1', '南京', 493, 'item3.jpg', '华为 HUAWEI Mate 20 麒麟980AI智能芯片全面屏超微距影像超大广角徕卡三摄6GB+128GB亮黑色全网通版双4G手机\n【稀缺货源，现货开抢，加送碎屏险】7nm麒麟980智能芯片，大广角徕卡三摄，高屏占比，长续航新品不断，优惠升级》》\n选移动，享大流量，不换号购机！'),
(4, '樱桃（CHERRY）MX Board 8.0', 1799, '2', '北京', 1499, 'item4.jpg', '樱桃（CHERRY）MX Board 8.0 G80-3888HYAEU-2 RGB 背光游戏机械键盘 黑色红轴 绝地求生 吃鸡键盘\n六期白条免息！CNC阳极氧化全铝机身，RGB幻彩灯光，高端品质无处不在！'),
(5, 'Apple AirPods 蓝牙无线耳机', 1199, '3', '郑州', 500, 'item5.jpg', '苹果（Apple） 蓝牙耳机 AirPods【原装】无线耳机iPhoneX/8/7手机耳机\n点击“我要参团”下单更便捷，无需等待一键成团，拼购到手价1058 《三期免息》白条三期免息，分期购买无压力 《全国七仓》择近选仓，闪电发货 《京东好店》京东好店认证、购买更安心、服务更专业'),
(6, '荣耀 V10', 1999, '1', '山西', 1000, 'item6.jpg', '全网通高配版 6GB+64GB 幻夜黑 移动联通电信4G全面屏游戏手机 双卡双待\r\n限时优惠1999，领券立减200，成交价1799！麒麟970！全面屏！'),
(7, '乐心手环MAMBO5', 139, '4', '广州', 1000, 'item7.jpg', ' 智能手环 心率手环 运动手环 彩屏触控 快捷支付 11种运动识别 有氧监测提升 IP68防水 黑色'),
(8, '一加手机6', 2999, '1', '北京', 1000, 'item8.jpg', '一加手机6 8GB+128GB 墨岩黑 全面屏双摄游戏手机 全网通4G 双卡双待\n【优惠600元，低至2999元+白条3期免息】12月17日一加超级品牌日，敬请期待！一加6优惠600元，6T迈凯伦定制版预约抽奖中，猛戳查看>>\n选移动，享大流量，不换号购机！'),
(9, '猫王收音机 R602', 2598, '5', '北京', 993, 'item9.jpg', '猫王收音机由50年北美胡桃原木，全手工打磨铸造。每一台都有独立编号，每一台都可以说是世界唯一。怀旧外形的机器上还有一只世纪40年代至70年代特有的真空荧光显示电子管，用来显示电子信号的变化'),
(10, '佳能（Canon）EOS 80', 8599, '6', '南京', 999, 'item10.jpg', '佳能（Canon）EOS 80D 单反套机（EF-S 18-200mm f/3.5-5.6 IS） 2420万有效像素 45点十字对焦 WIFI/NFC\r\n【精选爆款】【京东自营 品质保证】经典中端旗舰单反！18-200更大焦段，一镜走天下！全45点十字型高性能自动对焦，内置Wi-Fi和NFC');

-- --------------------------------------------------------

--
-- 表的结构 `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `UserName` char(30) NOT NULL,
  `Name` char(30) NOT NULL,
  `Password` char(30) NOT NULL,
  `Account` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `login`
--

INSERT INTO `login` (`UserName`, `Name`, `Password`, `Account`) VALUES
('zhangsan@163.com', '张三', '111111', 33025),
('lisi@163.com', '李四', '222222', 44804),
('zhaosi@163.com', '尼古拉斯·赵四', '444444', 0),
('lining@163.com', '李宁', '111111', 1401);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(30) DEFAULT NULL,
  `item_id` int(11) DEFAULT '0',
  `item_num` int(11) DEFAULT NULL,
  `order_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `item_id`, `item_num`, `order_time`) VALUES
(9, 'lining@163.com', 10, 1, '2018-12-20 13:17:42'),
(8, 'lisi@163.com', 9, 2, '2018-12-15 19:54:12'),
(7, 'zhangsan@163.com', 3, 1, '2018-12-15 17:39:00'),
(6, 'zhangsan@163.com', 9, 1, '2018-12-15 17:39:00');

-- --------------------------------------------------------

--
-- 表的结构 `shopcart`
--

CREATE TABLE IF NOT EXISTS `shopcart` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(30) NOT NULL DEFAULT '',
  `item_id` varchar(255) DEFAULT NULL,
  `item_num` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `shopcart`
--

INSERT INTO `shopcart` (`order_id`, `user_id`, `item_id`, `item_num`) VALUES
(14, 'zhangsan@163.com', '4', '1'),
(6, 'zhaosi@163.com', '3', '1'),
(11, 'lisi@163.com', '9', '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

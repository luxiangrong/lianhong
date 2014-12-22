ALTER TABLE `lh_dict`
MODIFY COLUMN `dictName`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称' AFTER `dictSort`;

CREATE TABLE `lh_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `titleImg` varchar(255) COLLATE utf8_bin NOT NULL,
  `updateTime` int(10) NOT NULL,
  `createTime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 COMMENT='产品';

CREATE TABLE `lh_product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `attrName` varchar(255) COLLATE utf8_bin NOT NULL,
  `attrValue` text COLLATE utf8_bin NOT NULL,
  `updateTime` int(10) NOT NULL,
  `createTime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 COMMENT='产品详细描述';




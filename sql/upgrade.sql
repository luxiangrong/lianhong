ALTER TABLE `lh_dict`
MODIFY COLUMN `dictName`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称' AFTER `dictSort`;

CREATE TABLE `lh_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `listImg` varchar(255) COLLATE utf8_bin NOT NULL,
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

ALTER TABLE `lh_product`
DROP COLUMN `attachment`,
ADD COLUMN `attachment`  varchar(255) NOT NULL AFTER `titleImg`;

ALTER TABLE `lh_product`
ADD COLUMN `attachment_name`  varchar(255) NOT NULL AFTER `attachment`;

ALTER TABLE `lh_dict`
ADD COLUMN `bannerImg`  varchar(256) NULL AFTER `dictType`;





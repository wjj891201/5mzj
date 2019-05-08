/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : oauthtest

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-04 20:41:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '11111');
INSERT INTO `goods` VALUES ('2', '22222');
INSERT INTO `goods` VALUES ('3', '333');
INSERT INTO `goods` VALUES ('4', '444');
INSERT INTO `goods` VALUES ('5', '555');

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1524819259');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1524819261');
INSERT INTO `migration` VALUES ('m140501_075311_add_oauth2_server', '1524821007');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '访问token',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `allowance` int(10) NOT NULL COMMENT '剩余的允许的请求数量',
  `allowance_updated_at` int(10) NOT NULL COMMENT '相应的UNIX时间戳数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'wujiepeng', 'RMNz9QJxs6aLXpV3vHFw0w57S_9MCeyA', '$2y$13$pWPsnzPKZ7XOyX8.5yoOX.25ao6VVL0euKepQrvJhjdEgP4/7Y05a', null, 'J5OjbpBAK-VAKzzEMU-Bz70nX48jfBKe_1525336890', '517987404@qq.com', '10', '1524820230', '1525400808', '2', '1525400808');
INSERT INTO `user` VALUES ('2', '222', '373S_kQcuZdxNBI9tRx_QIvpN2N6Kot2', '$2y$13$V8ELU8j5R0a/i7Mx6NKQaee4YtGT0xaZUKgcyoBwe358cG9kX6OCy', null, 'B1JqIFDCejYp0nyC03AIqZMoRx-68p6a_1525341434', '222@222.com', '10', '1525335056', '1525358695', '2', '1525358695');

-- ----------------------------
-- Table structure for `user_backend`
-- ----------------------------
DROP TABLE IF EXISTS `user_backend`;
CREATE TABLE `user_backend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_backend
-- ----------------------------

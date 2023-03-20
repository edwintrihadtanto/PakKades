/*
 Navicat Premium Data Transfer

 Source Server         : Local Host
 Source Server Type    : MySQL
 Source Server Version : 100116
 Source Host           : localhost:3306
 Source Schema         : 2021_countersurat

 Target Server Type    : MySQL
 Target Server Version : 100116
 File Encoding         : 65001

 Date: 26/08/2021 14:00:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mod_group_name
-- ----------------------------
DROP TABLE IF EXISTS `mod_group_name`;
CREATE TABLE `mod_group_name`  (
  `id_group` int(16) NOT NULL,
  `group_name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_model` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `urut` int(16) NULL DEFAULT NULL,
  `submenu` int(16) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_group`) USING BTREE,
  UNIQUE INDEX `group_name`(`group_name`) USING BTREE,
  INDEX `id_group`(`id_group`, `group_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mod_group_name
-- ----------------------------
INSERT INTO `mod_group_name` VALUES (101, 'Data Akses', '<li class=\"nav-item\">\r\n<a href=\"#\" class=\"nav-link klik_menu\"  id=\"data_akses\">Data Akses</a>\r\n</li>', 'akses', 1, 0);
INSERT INTO `mod_group_name` VALUES (102, 'Data Bidang', '<li class=\"nav-item\">\r\n<a href=\"#\" class=\"nav-link klik_menu\"  id=\"data_bidang\">Data Bidang</a>\r\n</li>', 'bidang', 1, 0);
INSERT INTO `mod_group_name` VALUES (111, 'Keluar', '<li class=\"nav-item\">\r\n<a href=\"main/logout\" class=\"nav-link\">Keluar</a>\r\n</li>', 'keluar_group', NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;

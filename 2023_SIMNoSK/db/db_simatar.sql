/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100116
 Source Host           : localhost:3306
 Source Schema         : 2021_ekorsuk

 Target Server Type    : MySQL
 Target Server Version : 100116
 File Encoding         : 65001

 Date: 25/10/2021 00:23:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for _akses
-- ----------------------------
DROP TABLE IF EXISTS `_akses`;
CREATE TABLE `_akses`  (
  `code_user` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_lengkap` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` int(3) NULL DEFAULT NULL,
  `show_pass` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_buat` date NULL DEFAULT NULL,
  `aktif` int(1) NULL DEFAULT NULL,
  `modul_angg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `mod_id` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `mod_id_group` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`code_user`, `user`) USING BTREE,
  UNIQUE INDEX `code_user`(`code_user`) USING BTREE,
  INDEX `level`(`level`) USING BTREE,
  CONSTRAINT `_akses_ibfk_1` FOREIGN KEY (`level`) REFERENCES `_level` (`level`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 302 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _akses
-- ----------------------------
INSERT INTO `_akses` VALUES (301, '303-03081992-052017-8776', 'cfcd208495d565ef66e7dff9f98764da', 'Administrator', 1, '0', '2021-08-16', 1, NULL, NULL, '\'101\',\'102\',\'103\',\'111\'');

-- ----------------------------
-- Table structure for _level
-- ----------------------------
DROP TABLE IF EXISTS `_level`;
CREATE TABLE `_level`  (
  `level` int(11) NOT NULL AUTO_INCREMENT,
  `ket` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`level`) USING BTREE,
  UNIQUE INDEX `level`(`level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _level
-- ----------------------------
INSERT INTO `_level` VALUES (1, 'Admin');
INSERT INTO `_level` VALUES (2, 'Subbag Umum');
INSERT INTO `_level` VALUES (3, 'Subbag Kepegawaian');
INSERT INTO `_level` VALUES (4, 'Default');

-- ----------------------------
-- Table structure for _no_urutpertgl
-- ----------------------------
DROP TABLE IF EXISTS `_no_urutpertgl`;
CREATE TABLE `_no_urutpertgl`  (
  `years` int(4) NOT NULL,
  `tgl_out` date NOT NULL,
  `no_urut_pertgl` int(11) NOT NULL,
  `no_urut_pertgl_berlanjut` int(11) NOT NULL,
  PRIMARY KEY (`years`, `tgl_out`) USING BTREE,
  UNIQUE INDEX `tgl_out`(`tgl_out`, `no_urut_pertgl`) USING BTREE,
  UNIQUE INDEX `years`(`years`, `no_urut_pertgl`) USING BTREE,
  INDEX `tgl_out_2`(`tgl_out`) USING BTREE,
  CONSTRAINT `_no_urutpertgl_ibfk_1` FOREIGN KEY (`years`) REFERENCES `periode_urut` (`years`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _no_urutpertgl
-- ----------------------------
INSERT INTO `_no_urutpertgl` VALUES (2021, '2021-10-18', 1, 5);
INSERT INTO `_no_urutpertgl` VALUES (2021, '2021-10-19', 2, 1);
INSERT INTO `_no_urutpertgl` VALUES (2021, '2021-10-23', 3, 27);
INSERT INTO `_no_urutpertgl` VALUES (2021, '2021-10-24', 4, 5);
INSERT INTO `_no_urutpertgl` VALUES (2021, '2021-10-25', 5, 1);
INSERT INTO `_no_urutpertgl` VALUES (2021, '2021-10-31', 6, 1);

-- ----------------------------
-- Table structure for _nourut_bidang_pertgl
-- ----------------------------
DROP TABLE IF EXISTS `_nourut_bidang_pertgl`;
CREATE TABLE `_nourut_bidang_pertgl`  (
  `tgl_out` date NOT NULL,
  `code_bidang` int(11) NOT NULL,
  `jmlh_urut` int(11) NULL DEFAULT NULL,
  `nourut_tgl_out` int(11) NOT NULL,
  PRIMARY KEY (`tgl_out`, `code_bidang`) USING BTREE,
  UNIQUE INDEX `tgl_out`(`tgl_out`, `code_bidang`) USING BTREE,
  UNIQUE INDEX `tgl_out_3`(`tgl_out`, `code_bidang`) USING BTREE,
  INDEX `tb_code_urut_bidang_pertgl_ibfk_1`(`code_bidang`) USING BTREE,
  INDEX `tgl_out_2`(`tgl_out`) USING BTREE,
  CONSTRAINT `_nourut_bidang_pertgl_ibfk_1` FOREIGN KEY (`code_bidang`) REFERENCES `tb_bidang` (`code_bidang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `_nourut_bidang_pertgl_ibfk_2` FOREIGN KEY (`tgl_out`) REFERENCES `_no_urutpertgl` (`tgl_out`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _nourut_bidang_pertgl
-- ----------------------------
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-18', 2, 3, 1);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-18', 6, 1, 1);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-18', 7, 1, 1);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-19', 1, 1, 2);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-23', 1, 9, 3);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-23', 2, 13, 3);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-23', 3, 3, 3);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-23', 4, 2, 3);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-24', 1, 3, 4);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-24', 2, 1, 4);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-24', 3, 1, 4);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-25', 2, 1, 5);
INSERT INTO `_nourut_bidang_pertgl` VALUES ('2021-10-31', 4, 1, 6);

-- ----------------------------
-- Table structure for image_
-- ----------------------------
DROP TABLE IF EXISTS `image_`;
CREATE TABLE `image_`  (
  `no_image` int(11) NOT NULL AUTO_INCREMENT,
  `nama_image` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT 0,
  PRIMARY KEY (`no_image`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of image_
-- ----------------------------
INSERT INTO `image_` VALUES (1, 'tampilan_awal.png', 1);
INSERT INTO `image_` VALUES (2, 'tampilan_awal.png', 1);
INSERT INTO `image_` VALUES (3, 'tampilan_awal.png', 1);

-- ----------------------------
-- Table structure for mod_group_detail
-- ----------------------------
DROP TABLE IF EXISTS `mod_group_detail`;
CREATE TABLE `mod_group_detail`  (
  `mod_id` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mod_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `group_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi_mod` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `idmodul_target` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_group` int(16) NULL DEFAULT NULL,
  PRIMARY KEY (`mod_id`) USING BTREE,
  INDEX `id_group`(`id_group`) USING BTREE,
  CONSTRAINT `mod_group_detail_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `mod_group_name` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
INSERT INTO `mod_group_name` VALUES (103, 'Data Surat Keluar', '<li class=\"nav-item\">\r\n<a href=\"#\" class=\"nav-link klik_menu\"  id=\"data_surat_keluar\">Data Surat Keluar</a>\r\n</li>', 'surat_keluar', 1, 0);
INSERT INTO `mod_group_name` VALUES (112, 'Keluar', '<li class=\"nav-item\">\r\n<a href=\"main/logout\" class=\"nav-link\">Keluar</a>\r\n</li>', 'keluar_group', NULL, 0);

-- ----------------------------
-- Table structure for periode_urut
-- ----------------------------
DROP TABLE IF EXISTS `periode_urut`;
CREATE TABLE `periode_urut`  (
  `years` int(4) NOT NULL,
  `no_urut` int(11) NOT NULL,
  PRIMARY KEY (`years`) USING BTREE,
  UNIQUE INDEX `years`(`years`, `no_urut`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of periode_urut
-- ----------------------------
INSERT INTO `periode_urut` VALUES (2021, 40);

-- ----------------------------
-- Table structure for tb_bidang
-- ----------------------------
DROP TABLE IF EXISTS `tb_bidang`;
CREATE TABLE `tb_bidang`  (
  `code_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`code_bidang`, `name`) USING BTREE,
  UNIQUE INDEX `code_bidang`(`code_bidang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_bidang
-- ----------------------------
INSERT INTO `tb_bidang` VALUES (1, 'Bagian Tata Usaha', 0);
INSERT INTO `tb_bidang` VALUES (2, 'Bagian Keuangan dan Akuntansi', 0);
INSERT INTO `tb_bidang` VALUES (3, 'Perencanaan Program dan Evaluasi', 0);
INSERT INTO `tb_bidang` VALUES (4, 'Pelayanan Medik', 0);
INSERT INTO `tb_bidang` VALUES (5, 'Keperawatan', 0);
INSERT INTO `tb_bidang` VALUES (6, 'Penunjang Medik\n', 0);
INSERT INTO `tb_bidang` VALUES (7, 'Pendidikan dan Penelitian', 0);

-- ----------------------------
-- Table structure for tb_codesurat
-- ----------------------------
DROP TABLE IF EXISTS `tb_codesurat`;
CREATE TABLE `tb_codesurat`  (
  `code_jenissurat` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name_surat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`code_jenissurat`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_codesurat
-- ----------------------------
INSERT INTO `tb_codesurat` VALUES ('020', 'Peralatan', 1);
INSERT INTO `tb_codesurat` VALUES ('021', 'Alat Tulis', 1);
INSERT INTO `tb_codesurat` VALUES ('022', 'Mesin Kantor', 1);
INSERT INTO `tb_codesurat` VALUES ('023', 'Perabot Kantor', 1);
INSERT INTO `tb_codesurat` VALUES ('024', 'Alat Angkutan', 1);
INSERT INTO `tb_codesurat` VALUES ('025', 'Pakaian Dinas', 1);
INSERT INTO `tb_codesurat` VALUES ('026', 'Senjata', 1);
INSERT INTO `tb_codesurat` VALUES ('027', 'Pengadaan', 1);
INSERT INTO `tb_codesurat` VALUES ('028', 'Inventaris', 1);
INSERT INTO `tb_codesurat` VALUES ('045', 'Kearsipan', 1);
INSERT INTO `tb_codesurat` VALUES ('070', 'Penelitian', 1);
INSERT INTO `tb_codesurat` VALUES ('094', 'Perjalanan Dinas', 1);
INSERT INTO `tb_codesurat` VALUES ('423', 'Methode Belajar', 1);

-- ----------------------------
-- Table structure for tb_codesurat_sub
-- ----------------------------
DROP TABLE IF EXISTS `tb_codesurat_sub`;
CREATE TABLE `tb_codesurat_sub`  (
  `code_jenissurat` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code_surat_sub` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name_surat_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`code_jenissurat`, `code_surat_sub`) USING BTREE,
  UNIQUE INDEX `code_surat`(`code_jenissurat`, `code_surat_sub`) USING BTREE,
  CONSTRAINT `tb_codesurat_sub_ibfk_1` FOREIGN KEY (`code_jenissurat`) REFERENCES `tb_codesurat` (`code_jenissurat`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_codesurat_sub
-- ----------------------------
INSERT INTO `tb_codesurat_sub` VALUES ('027', '5', 'tes', 1);
INSERT INTO `tb_codesurat_sub` VALUES ('423', '4', 'Kuliah Lapanangan, Widyawisata, KKN, Studi', 1);

-- ----------------------------
-- Table structure for tb_surat_kluar
-- ----------------------------
DROP TABLE IF EXISTS `tb_surat_kluar`;
CREATE TABLE `tb_surat_kluar`  (
  `nomor_urut` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_surat_keluar` date NULL DEFAULT NULL,
  `code_suratkeluar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_surat_keluar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code_bidang` int(3) NOT NULL,
  `code_jenis_surat` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code_jenis_suratsub` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `perihal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tujuan_unit` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_upload` int(11) NOT NULL DEFAULT 0,
  `tgl_dibuat` datetime(0) NULL DEFAULT NULL,
  `code_user` int(11) NOT NULL,
  `nama_files` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`nomor_urut`, `nomor_surat_keluar`, `code_bidang`) USING BTREE,
  UNIQUE INDEX `nomor_surat_keluar`(`nomor_surat_keluar`) USING BTREE,
  UNIQUE INDEX `nomor_urut`(`nomor_urut`) USING BTREE,
  UNIQUE INDEX `tgl_surat_keluar`(`tgl_surat_keluar`, `code_suratkeluar`) USING BTREE,
  INDEX `code_user`(`code_user`) USING BTREE,
  CONSTRAINT `tb_surat_kluar_ibfk_1` FOREIGN KEY (`code_user`) REFERENCES `_akses` (`code_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1033 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_surat_kluar
-- ----------------------------
INSERT INTO `tb_surat_kluar` VALUES (1001, '2021-10-23', '3.2.3', '045/3.2.3/303/2021', 2, '045', '-', 'S', 'S', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1002, '2021-10-23', '3.3.4', '027.5/3.3.4/303/2021', 3, '027', '5', 'DFD', 'DF', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1003, '2021-10-23', '3.2.5', '028/3.2.5/303/2021', 2, '028', '-', 'D', 'D', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1004, '2021-10-23', '3.4.6', '045/3.4.6/303/2021', 4, '045', '-', 's', 's', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1005, '2021-10-23', '3.1.7', '028/3.1.7/303/2021', 1, '028', '-', 's', 's', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1006, '2021-10-23', '3.2.8', '028/3.2.8/303/2021', 2, '028', '-', 'x', 's', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1007, '2021-10-23', '3.1.9', '027.5/3.1.9/303/2021', 1, '027', '5', 'd', 'd', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1008, '2021-10-23', '3.3.10', '070/3.3.10/303/2021', 3, '070', '-', 'd', 'd', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1009, '2021-10-23', '3.2.11', '045/3.2.11/303/2021', 2, '045', '-', 'c', 'c', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1010, '2021-10-23', '3.1.12', '070/3.1.12/303/2021', 1, '070', '-', 's', 's', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1011, '2021-10-23', '3.2.13', '028/3.2.13/303/2021', 2, '028', '-', 'd', 'd', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1012, '2021-10-23', '3.2.14', '045/3.2.14/303/2021', 2, '045', '-', 's', 's', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1013, '2021-10-23', '3.2.15', '026/3.2.15/303/2021', 2, '026', '-', 'd', 'd', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1014, '2021-10-23', '3.1.16', '094/3.1.16/303/2021', 1, '094', '-', 'sd', 'sd', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1015, '2021-10-23', '3.1.17', '045/3.1.17/303/2021', 1, '045', '-', 'x', 'x', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1016, '2021-10-23', '3.4.18', '094/3.4.18/303/2021', 4, '094', '-', 'z', 'z', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1017, '2021-10-23', '3.1.19', '045/3.1.19/303/2021', 1, '045', '-', 'd', 'd', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1018, '2021-10-23', '3.1.20', '070/3.1.20/303/2021', 1, '070', '-', 'x', 'x', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1019, '2021-10-23', '3.2.21', '028/3.2.21/303/2021', 2, '028', '-', 'c', 'c', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1020, '2021-10-23', '3.2.22', '423.4/3.2.22/303/2021', 2, '423', '4', 'x', 'x', 1, '2021-10-23 00:00:00', 301, 'ok');
INSERT INTO `tb_surat_kluar` VALUES (1021, '2021-10-23', '3.2.23', '094/3.2.23/303/2021', 2, '094', '-', 'd', 'd', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1022, '2021-10-23', '3.1.24', '094/3.1.24/303/2021', 1, '094', '-', 'x', 'x', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1023, '2021-10-23', '3.1.25', '070/3.1.25/303/2021', 1, '070', '-', 'v', 'v', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1024, '2021-10-23', '3.2.26', '028/3.2.26/303/2021', 2, '028', '-', 'cc', 'c', 1, '2021-10-23 00:00:00', 301, 'ok');
INSERT INTO `tb_surat_kluar` VALUES (1025, '2021-10-23', '3.2.27', '094/3.2.27/303/2021', 2, '094', '-', 'kk', 'f', 1, '2021-10-23 00:00:00', 301, 'ok');
INSERT INTO `tb_surat_kluar` VALUES (1026, '2021-10-24', '4.2.1', '070/4.2.1/303/2021', 2, '070', '-', 'xc', 'cx', 0, '2021-10-23 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1027, '2021-10-24', '4.1.2', '423.4/4.1.2/303/2021', 1, '423', '4', 'sds', 'sd', 1, '2021-10-24 00:00:00', 301, 'ok');
INSERT INTO `tb_surat_kluar` VALUES (1028, '2021-10-24', '4.3.3', '094/4.3.3/303/2021', 3, '094', '-', 'xc', 'xc', 0, '2021-10-24 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1029, '2021-10-25', '5.2.1', '070/5.2.1/303/2021', 2, '070', '-', 'd', 'd', 0, '2021-10-24 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1030, '2021-10-24', '4.1.4', '045/4.1.4/303/2021', 1, '045', '-', 'kk', 'DSDS', 0, '2021-10-24 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1031, '2021-10-31', '6.4.1', '045/6.4.1/303/2021', 4, '045', '-', 'X', 'X', 0, '2021-10-24 00:00:00', 301, NULL);
INSERT INTO `tb_surat_kluar` VALUES (1032, '2021-10-24', '4.1.5', '070/4.1.5/303/2021', 1, '070', '-', 's', 's', 0, '2021-10-24 00:00:00', 301, NULL);

-- ----------------------------
-- Table structure for tb_surat_kluar_img
-- ----------------------------
DROP TABLE IF EXISTS `tb_surat_kluar_img`;
CREATE TABLE `tb_surat_kluar_img`  (
  `nomor_surat_keluar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_files` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_upload` datetime(0) NOT NULL,
  PRIMARY KEY (`nomor_surat_keluar`) USING BTREE,
  UNIQUE INDEX `nomor_surat_keluar`(`nomor_surat_keluar`) USING BTREE,
  CONSTRAINT `tb_surat_kluar_img_ibfk_1` FOREIGN KEY (`nomor_surat_keluar`) REFERENCES `tb_surat_kluar` (`nomor_surat_keluar`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_surat_kluar_img
-- ----------------------------
INSERT INTO `tb_surat_kluar_img` VALUES ('045/4.1.4/303/2021', '', '', '0000-00-00 00:00:00');
INSERT INTO `tb_surat_kluar_img` VALUES ('045/6.4.1/303/2021', '', '', '0000-00-00 00:00:00');
INSERT INTO `tb_surat_kluar_img` VALUES ('070/4.1.5/303/2021', '', '', '0000-00-00 00:00:00');
INSERT INTO `tb_surat_kluar_img` VALUES ('070/5.2.1/303/2021', '', '', '0000-00-00 00:00:00');

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : 2021_ekorsuk

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 07/03/2023 08:57:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for _akses
-- ----------------------------
DROP TABLE IF EXISTS `_akses`;
CREATE TABLE `_akses`  (
  `code_user` int NOT NULL AUTO_INCREMENT,
  `user` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_lengkap` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` int NULL DEFAULT NULL,
  `show_pass` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_buat` date NULL DEFAULT NULL,
  `aktif` int NULL DEFAULT NULL,
  `modul_angg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `mod_id` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `mod_id_group` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`code_user`, `user`) USING BTREE,
  UNIQUE INDEX `code_user`(`code_user` ASC) USING BTREE,
  INDEX `level`(`level` ASC) USING BTREE,
  CONSTRAINT `_akses_ibfk_1` FOREIGN KEY (`level`) REFERENCES `_level` (`level`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 302 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of _akses
-- ----------------------------
INSERT INTO `_akses` VALUES (301, 'adminITISI', 'cfcd208495d565ef66e7dff9f98764da', 'Administrator', 1, '0', '2021-08-16', 1, NULL, NULL, '\'101\',\'102\',\'103\',\'111\'');

-- ----------------------------
-- Table structure for _level
-- ----------------------------
DROP TABLE IF EXISTS `_level`;
CREATE TABLE `_level`  (
  `level` int NOT NULL AUTO_INCREMENT,
  `ket` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`level`) USING BTREE,
  UNIQUE INDEX `level`(`level` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

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
  `years` int NOT NULL,
  `tgl_out` date NOT NULL,
  `no_urut_pertgl` int NOT NULL,
  `no_urut_pertgl_berlanjut` int NOT NULL,
  PRIMARY KEY (`years`, `tgl_out`) USING BTREE,
  UNIQUE INDEX `tgl_out`(`tgl_out` ASC, `no_urut_pertgl` ASC) USING BTREE,
  UNIQUE INDEX `years`(`years` ASC, `no_urut_pertgl` ASC) USING BTREE,
  INDEX `tgl_out_2`(`tgl_out` ASC) USING BTREE,
  CONSTRAINT `_no_urutpertgl_ibfk_1` FOREIGN KEY (`years`) REFERENCES `periode_urut` (`years`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of _no_urutpertgl
-- ----------------------------

-- ----------------------------
-- Table structure for _nourut_bidang_pertgl
-- ----------------------------
DROP TABLE IF EXISTS `_nourut_bidang_pertgl`;
CREATE TABLE `_nourut_bidang_pertgl`  (
  `tgl_out` date NOT NULL,
  `code_bidang` int NOT NULL,
  `jmlh_urut` int NULL DEFAULT NULL,
  `nourut_tgl_out` int NOT NULL,
  PRIMARY KEY (`tgl_out`, `code_bidang`) USING BTREE,
  UNIQUE INDEX `tgl_out`(`tgl_out` ASC, `code_bidang` ASC) USING BTREE,
  UNIQUE INDEX `tgl_out_3`(`tgl_out` ASC, `code_bidang` ASC) USING BTREE,
  INDEX `tb_code_urut_bidang_pertgl_ibfk_1`(`code_bidang` ASC) USING BTREE,
  INDEX `tgl_out_2`(`tgl_out` ASC) USING BTREE,
  CONSTRAINT `_nourut_bidang_pertgl_ibfk_1` FOREIGN KEY (`code_bidang`) REFERENCES `tb_bidang` (`code_bidang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `_nourut_bidang_pertgl_ibfk_2` FOREIGN KEY (`tgl_out`) REFERENCES `_no_urutpertgl` (`tgl_out`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of _nourut_bidang_pertgl
-- ----------------------------

-- ----------------------------
-- Table structure for image_
-- ----------------------------
DROP TABLE IF EXISTS `image_`;
CREATE TABLE `image_`  (
  `no_image` int NOT NULL AUTO_INCREMENT,
  `nama_image` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 0,
  PRIMARY KEY (`no_image`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

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
  `id_group` int NULL DEFAULT NULL,
  PRIMARY KEY (`mod_id`) USING BTREE,
  INDEX `id_group`(`id_group` ASC) USING BTREE,
  CONSTRAINT `mod_group_detail_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `mod_group_name` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mod_group_detail
-- ----------------------------

-- ----------------------------
-- Table structure for mod_group_name
-- ----------------------------
DROP TABLE IF EXISTS `mod_group_name`;
CREATE TABLE `mod_group_name`  (
  `id_group` int NOT NULL,
  `group_name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_model` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `urut` int NULL DEFAULT NULL,
  `submenu` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_group`) USING BTREE,
  UNIQUE INDEX `group_name`(`group_name` ASC) USING BTREE,
  INDEX `id_group`(`id_group` ASC, `group_name` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

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
  `years` int NOT NULL,
  `no_urut` int NOT NULL,
  PRIMARY KEY (`years`) USING BTREE,
  UNIQUE INDEX `years`(`years` ASC, `no_urut` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of periode_urut
-- ----------------------------

-- ----------------------------
-- Table structure for tb_bidang
-- ----------------------------
DROP TABLE IF EXISTS `tb_bidang`;
CREATE TABLE `tb_bidang`  (
  `code_bidang` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`code_bidang`, `name`) USING BTREE,
  UNIQUE INDEX `code_bidang`(`code_bidang` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

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
  `status` int NULL DEFAULT 1,
  PRIMARY KEY (`code_jenissurat`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

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
  `status` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`code_jenissurat`, `code_surat_sub`) USING BTREE,
  UNIQUE INDEX `code_surat`(`code_jenissurat` ASC, `code_surat_sub` ASC) USING BTREE,
  CONSTRAINT `tb_codesurat_sub_ibfk_1` FOREIGN KEY (`code_jenissurat`) REFERENCES `tb_codesurat` (`code_jenissurat`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

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
  `nomor_urut` int NOT NULL AUTO_INCREMENT,
  `tgl_surat_keluar` date NULL DEFAULT NULL,
  `code_suratkeluar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_surat_keluar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code_bidang` int NOT NULL,
  `code_jenis_surat` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code_jenis_suratsub` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `perihal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tujuan_unit` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_upload` int NOT NULL DEFAULT 0,
  `tgl_dibuat` datetime NULL DEFAULT NULL,
  `code_user` int NOT NULL,
  `nama_files` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`nomor_urut`, `nomor_surat_keluar`, `code_bidang`) USING BTREE,
  UNIQUE INDEX `nomor_surat_keluar`(`nomor_surat_keluar` ASC) USING BTREE,
  UNIQUE INDEX `nomor_urut`(`nomor_urut` ASC) USING BTREE,
  UNIQUE INDEX `tgl_surat_keluar`(`tgl_surat_keluar` ASC, `code_suratkeluar` ASC) USING BTREE,
  INDEX `code_user`(`code_user` ASC) USING BTREE,
  CONSTRAINT `tb_surat_kluar_ibfk_1` FOREIGN KEY (`code_user`) REFERENCES `_akses` (`code_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1011 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_surat_kluar
-- ----------------------------

-- ----------------------------
-- Table structure for tb_surat_kluar_img
-- ----------------------------
DROP TABLE IF EXISTS `tb_surat_kluar_img`;
CREATE TABLE `tb_surat_kluar_img`  (
  `nomor_surat_keluar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_files` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_upload` datetime NOT NULL,
  PRIMARY KEY (`nomor_surat_keluar`) USING BTREE,
  UNIQUE INDEX `nomor_surat_keluar`(`nomor_surat_keluar` ASC) USING BTREE,
  CONSTRAINT `tb_surat_kluar_img_ibfk_1` FOREIGN KEY (`nomor_surat_keluar`) REFERENCES `tb_surat_kluar` (`nomor_surat_keluar`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_surat_kluar_img
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : qlvattu_ute_v2

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 17/12/2021 16:40:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Bút', NULL, NULL);
INSERT INTO `category` VALUES (2, 'Giấy', NULL, NULL);
INSERT INTO `category` VALUES (3, 'Bìa', NULL, NULL);
INSERT INTO `category` VALUES (4, 'Phấn', NULL, NULL);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `id` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('KCK', 'Khoa Cơ Khí');
INSERT INTO `department` VALUES ('KCNHH', 'Khoa Công Nghệ Hóa Học - Môi Trường');
INSERT INTO `department` VALUES ('KD', 'Khoa Điện');
INSERT INTO `department` VALUES ('KSPCN', 'Khoa Sư Phạm Công Nghiệp');
INSERT INTO `department` VALUES ('KXD', 'Khoa Kỹ Thuật Xây Dựng');
INSERT INTO `department` VALUES ('PCSVC', 'Phòng Cơ Sở Vật Chất');
INSERT INTO `department` VALUES ('PCTSV', 'Phòng Công Tác Sinh Viên');
INSERT INTO `department` VALUES ('PDT', 'Phòng Đào Tạo');

-- ----------------------------
-- Table structure for detail_buy
-- ----------------------------
DROP TABLE IF EXISTS `detail_buy`;
CREATE TABLE `detail_buy`  (
  `id_note` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_stationery` bigint UNSIGNED NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  `cost` decimal(10, 0) NULL DEFAULT NULL,
  `qty_handovered` int UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_note`, `id_stationery`) USING BTREE,
  INDEX `detail_buy_id_stationery_foreign`(`id_stationery`) USING BTREE,
  CONSTRAINT `detail_buy_id_note_foreign` FOREIGN KEY (`id_note`) REFERENCES `request_note` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_buy_id_stationery_foreign` FOREIGN KEY (`id_stationery`) REFERENCES `stationery` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_buy
-- ----------------------------
INSERT INTO `detail_buy` VALUES ('PM0120001', 1, 1, 30000, 4, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120001', 2, 1, 20000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120001', 3, 2, 40000, 2, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120001', 4, 3, 2000, 3, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120001', 5, 1, 10000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120001', 7, 1, 5000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120002', 3, 2, 40000, 2, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120002', 4, 6, 4000, 6, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120002', 5, 1, 2000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120002', 6, 2, 10000, 2, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120003', 1, 4, 30000, 4, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120003', 2, 4, 20000, 4, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120003', 3, 1, 40000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120003', 4, 4, 2000, 4, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120004', 1, 1, 30000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120004', 2, 1, 20000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120004', 3, 1, 40000, 1, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120004', 5, 2, 5000, 2, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120004', 6, 2, 3000, 2, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0120004', 7, 2, 5000, 2, '2020-01-19 17:46:33', '2020-01-19 17:46:33');
INSERT INTO `detail_buy` VALUES ('PM0121001', 2, 1, 20000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121001', 3, 1, 40000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121001', 4, 2, 2000, 2, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121001', 5, 1, 5000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121001', 6, 3, 3000, 3, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121001', 7, 1, 5000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121002', 1, 1, 30000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121002', 2, 3, 20000, 3, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121002', 4, 4, 2000, 4, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121002', 5, 2, 5000, 2, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121002', 7, 1, 5000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121003', 1, 2, 30000, 2, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121003', 3, 1, 40000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121003', 4, 2, 2000, 2, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121003', 5, 2, 5000, 2, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121004', 1, 1, 30000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121004', 2, 2, 20000, 2, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121004', 4, 6, 2000, 6, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121004', 5, 1, 5000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0121004', 7, 1, 5000, 1, '2021-01-16 10:28:20', '2021-01-16 10:28:20');
INSERT INTO `detail_buy` VALUES ('PM0520001', 3, 1, 40000, 1, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520001', 4, 3, 2000, 3, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520001', 5, 2, 5000, 2, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520001', 6, 2, 3000, 2, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520001', 7, 2, 5000, 2, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520002', 1, 3, 30000, 3, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520002', 2, 3, 20000, 3, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520002', 4, 3, 2000, 3, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520002', 5, 1, 5000, 1, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520002', 6, 2, 3000, 2, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520003', 2, 3, 20000, 3, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520003', 3, 1, 40000, 1, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520003', 6, 6, 3000, 6, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520003', 7, 2, 5000, 2, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520004', 1, 1, 30000, 1, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520004', 3, 1, 40000, 1, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520004', 4, 3, 2000, 3, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520004', 6, 3, 3000, 3, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0520004', 7, 1, 5000, 1, '2020-05-18 17:49:49', '2020-05-18 17:49:49');
INSERT INTO `detail_buy` VALUES ('PM0521001', 1, 1, 30000, 1, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521001', 4, 3, 2000, 3, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521001', 5, 2, 5000, 2, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521001', 7, 1, 5000, 1, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521002', 4, 3, 2000, 3, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521002', 5, 3, 5000, 3, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521002', 6, 2, 3000, 2, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521002', 7, 2, 5000, 2, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521003', 1, 2, 30000, 2, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521003', 4, 6, 2000, 6, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521003', 5, 2, 5000, 2, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521003', 6, 2, 3000, 2, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521003', 7, 1, 5000, 1, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521004', 1, 2, 30000, 2, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521004', 3, 1, 40000, 1, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521004', 6, 1, 3000, 1, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0521004', 7, 1, 5000, 1, '2021-05-19 10:29:13', '2021-05-19 10:29:13');
INSERT INTO `detail_buy` VALUES ('PM0920001', 3, 1, 40000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920001', 4, 7, 2000, 7, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920001', 5, 1, 5000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920001', 6, 2, 3000, 2, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920001', 7, 1, 5000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920002', 2, 3, 20000, 3, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920002', 3, 1, 40000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920002', 5, 1, 5000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920002', 6, 4, 3000, 4, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920002', 7, 2, 5000, 2, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920003', 1, 2, 30000, 2, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920003', 4, 4, 2000, 4, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920003', 5, 1, 5000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920003', 6, 1, 3000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920003', 7, 1, 5000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920004', 1, 1, 30000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920004', 2, 4, 20000, 4, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920004', 3, 1, 40000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920004', 5, 1, 5000, 1, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0920004', 6, 4, 3000, 4, '2020-09-16 17:50:34', '2020-09-16 17:50:34');
INSERT INTO `detail_buy` VALUES ('PM0921001', 2, 1, 20000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921001', 3, 3, 40000, 3, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921001', 4, 5, 2000, 5, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921001', 5, 1, 5000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921001', 7, 2, 5000, 2, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921002', 1, 3, 30000, 3, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921002', 2, 1, 20000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921002', 3, 1, 40000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921002', 4, 2, 2000, 2, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921002', 5, 1, 5000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921003', 1, 2, 30000, 2, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921003', 2, 1, 20000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921003', 3, 1, 40000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921003', 4, 2, 2000, 2, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921003', 5, 1, 5000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921003', 7, 1, 5000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921004', 1, 2, 30000, 2, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921004', 5, 1, 5000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921004', 6, 1, 3000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');
INSERT INTO `detail_buy` VALUES ('PM0921004', 7, 1, 5000, 1, '2021-09-18 10:29:24', '2021-09-18 10:29:24');

-- ----------------------------
-- Table structure for detail_fix
-- ----------------------------
DROP TABLE IF EXISTS `detail_fix`;
CREATE TABLE `detail_fix`  (
  `id_note` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_equipment` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cost` decimal(10, 0) NULL DEFAULT NULL,
  `is_handovered` tinyint(1) NOT NULL DEFAULT 0,
  `is_fixable` tinyint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_note`, `id_equipment`) USING BTREE,
  INDEX `detail_fix_id_equipment_foreign`(`id_equipment`) USING BTREE,
  CONSTRAINT `detail_fix_id_equipment_foreign` FOREIGN KEY (`id_equipment`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_fix_id_note_foreign` FOREIGN KEY (`id_note`) REFERENCES `request_note` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_fix
-- ----------------------------
INSERT INTO `detail_fix` VALUES ('PS0120001', 'TB000001', 'Không hiển thị', 100000, 1, 1, '2020-01-15 18:27:06', '2020-01-15 18:27:06');
INSERT INTO `detail_fix` VALUES ('PS0120001', 'TB000002', 'Không hiển thị', 100000, 1, 1, '2020-01-15 18:27:06', '2020-01-15 18:27:06');
INSERT INTO `detail_fix` VALUES ('PS0120002', 'TB000003', 'Không hiển thị 3', NULL, 0, NULL, '2020-01-15 18:23:06', '2020-01-15 18:23:06');
INSERT INTO `detail_fix` VALUES ('PS0121001', 'TB000002', 'Không hiển thị', NULL, 1, 0, '2021-01-21 12:31:48', '2021-01-21 12:31:48');
INSERT INTO `detail_fix` VALUES ('PS0220001', 'TB000006', 'Không nhận tín hiệu', 0, 1, 1, '2020-02-15 18:23:06', '2020-02-15 18:23:06');
INSERT INTO `detail_fix` VALUES ('PS0320001', 'TB000007', 'Không lên đèn', 100000, 1, 1, '2020-03-15 18:23:06', '2020-03-15 18:23:06');
INSERT INTO `detail_fix` VALUES ('PS0321001', 'TB000006', 'Không nhận tín hiệu', NULL, 0, NULL, '2021-03-03 12:32:11', '2021-03-03 12:32:11');
INSERT INTO `detail_fix` VALUES ('PS0321002', 'TB000003', 'Không hiển thị', 100000, 1, 1, '2021-03-05 12:35:29', '2021-03-05 12:35:29');
INSERT INTO `detail_fix` VALUES ('PS0321002', 'TB000012', 'Không hoạt động', 150000, 1, 1, '2021-03-05 12:35:29', '2021-03-05 12:35:29');
INSERT INTO `detail_fix` VALUES ('PS0420001', 'TB000015', 'Không lên nguồn', 100000, 1, 1, '2020-04-06 18:39:15', '2020-04-06 18:39:15');
INSERT INTO `detail_fix` VALUES ('PS0420001', 'TB000016', 'Không lên nguồn', 300000, 1, 1, '2020-04-06 18:39:15', '2020-04-06 18:39:15');
INSERT INTO `detail_fix` VALUES ('PS0420002', 'TB000009', 'Không lên đèn', NULL, 0, NULL, '2020-05-06 18:39:15', '2020-05-06 18:39:15');
INSERT INTO `detail_fix` VALUES ('PS0421001', 'TB000003', 'Không hiển thị', 100000, 1, 1, '2021-04-04 12:45:40', '2021-04-04 12:45:40');
INSERT INTO `detail_fix` VALUES ('PS0421001', 'TB000004', 'Không di chuyển được', 200000, 1, 1, '2021-04-04 12:45:40', '2021-04-04 12:45:40');
INSERT INTO `detail_fix` VALUES ('PS0421002', 'TB000005', 'Bị hư', 50000, 1, 1, '2021-04-08 12:45:40', '2021-04-08 12:45:40');
INSERT INTO `detail_fix` VALUES ('PS0621001', 'TB000007', 'Không lên đèn', NULL, 1, 0, '2021-06-05 12:51:26', '2021-06-05 12:51:26');
INSERT INTO `detail_fix` VALUES ('PS0720001', 'TB000013', 'Bị hỏng', 100000, 1, 1, '2020-07-07 19:07:19', '2020-07-07 19:07:19');
INSERT INTO `detail_fix` VALUES ('PS0720001', 'TB000014', 'Bị Hỏng', NULL, 1, 0, '2020-07-07 19:07:19', '2020-07-07 19:07:19');
INSERT INTO `detail_fix` VALUES ('PS0721001', 'TB000006', 'Không nhận tín hiệu', 100000, 1, 1, '2021-07-07 12:55:07', '2021-07-07 12:55:07');
INSERT INTO `detail_fix` VALUES ('PS0721001', 'TB000018', 'Không nhận tín hiệu', 100000, 1, 1, '2021-07-07 12:55:07', '2021-07-07 12:55:07');
INSERT INTO `detail_fix` VALUES ('PS0820001', 'TB000001', 'Bị vỡ', NULL, 1, 0, '2020-08-08 19:12:37', '2020-08-08 19:12:37');
INSERT INTO `detail_fix` VALUES ('PS0820001', 'TB000002', 'Hiển thị màu xanh', 140000, 1, 1, '2020-08-08 19:12:37', '2020-08-08 19:12:37');
INSERT INTO `detail_fix` VALUES ('PS0821001', 'TB000015', 'không lên nguồn', 260000, 1, 1, '2021-08-08 12:57:37', '2021-08-08 12:57:37');
INSERT INTO `detail_fix` VALUES ('PS0821002', 'TB000015', 'Không nhận tín hiệu', NULL, 1, 0, '2021-08-09 13:00:19', '2021-08-09 13:00:19');
INSERT INTO `detail_fix` VALUES ('PS0821002', 'TB000016', 'Không nhận tín hiệu', 170000, 1, 1, '2021-08-09 13:00:19', '2021-08-09 13:00:19');
INSERT INTO `detail_fix` VALUES ('PS0920001', 'TB000006', 'Không nhận tín hiệu', NULL, 0, NULL, '2020-09-06 19:15:37', '2020-09-06 19:15:37');
INSERT INTO `detail_fix` VALUES ('PS0921001', 'TB000012', 'Không hoạt động', 0, 1, 1, '2021-09-09 13:02:45', '2021-09-09 13:02:45');
INSERT INTO `detail_fix` VALUES ('PS1020001', 'TB000016', 'Không bật được', 120000, 1, 1, '2020-10-10 19:18:15', '2020-10-10 19:18:15');
INSERT INTO `detail_fix` VALUES ('PS1020001', 'TB000019', 'Không nhận tín hiệu', 80000, 1, 1, '2020-10-10 19:18:15', '2020-10-10 19:18:15');
INSERT INTO `detail_fix` VALUES ('PS1021001', 'TB000016', 'Không bật được', 100000, 1, 1, '2021-10-10 13:06:02', '2021-10-10 13:06:02');
INSERT INTO `detail_fix` VALUES ('PS1121001', 'TB000009', NULL, NULL, 0, NULL, '2021-11-10 13:09:03', '2021-11-10 13:09:03');
INSERT INTO `detail_fix` VALUES ('PS1121002', 'TB000008', 'Không nhận tín hiệu', 0, 1, 1, '2021-11-11 13:10:00', '2021-11-11 13:10:00');
INSERT INTO `detail_fix` VALUES ('PS1221001', 'TB000012', 'Không hoạt động', 0, 1, 1, '2021-12-09 13:12:22', '2021-12-09 13:12:22');
INSERT INTO `detail_fix` VALUES ('PS1221001', 'TB000013', 'Không hoạt động', 250000, 1, 1, '2021-12-09 13:12:22', '2021-12-09 13:12:22');
INSERT INTO `detail_fix` VALUES ('PS1221002', 'TB000009', 'Không lên đèn', NULL, 1, 0, '2021-12-10 13:12:22', '2021-12-10 13:12:22');

-- ----------------------------
-- Table structure for detail_handover_buy
-- ----------------------------
DROP TABLE IF EXISTS `detail_handover_buy`;
CREATE TABLE `detail_handover_buy`  (
  `id_note` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_stationery` bigint UNSIGNED NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_note`, `id_stationery`) USING BTREE,
  INDEX `detail_handover_buy_id_stationery_foreign`(`id_stationery`) USING BTREE,
  CONSTRAINT `detail_handover_buy_id_note_foreign` FOREIGN KEY (`id_note`) REFERENCES `handover_note` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_handover_buy_id_stationery_foreign` FOREIGN KEY (`id_stationery`) REFERENCES `stationery` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_handover_buy
-- ----------------------------
INSERT INTO `detail_handover_buy` VALUES ('BG0120001', 1, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0120001', 2, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120001', 3, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0120001', 4, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0120001', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120001', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120002', 3, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0120002', 4, 6);
INSERT INTO `detail_handover_buy` VALUES ('BG0120002', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120002', 6, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0120003', 1, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0120003', 2, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0120003', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120003', 4, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0120004', 1, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120004', 2, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120004', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0120004', 5, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0120004', 6, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0120004', 7, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0121001', 2, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121001', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121001', 4, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0121001', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121002', 6, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0121002', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121003', 1, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121003', 2, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0121003', 4, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0121003', 5, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0121003', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121004', 1, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0121004', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121004', 4, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0121004', 5, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0121005', 1, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121005', 2, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0121005', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121005', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0121006', 4, 6);
INSERT INTO `detail_handover_buy` VALUES ('BG0520001', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0520001', 4, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0520001', 5, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0520001', 6, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0520001', 7, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0520002', 1, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0520002', 2, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0520002', 4, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0520002', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0520002', 6, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0520003', 2, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0520003', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0520003', 6, 6);
INSERT INTO `detail_handover_buy` VALUES ('BG0520003', 7, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0520004', 1, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0520004', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0520004', 4, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0520004', 6, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0520004', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0521001', 1, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0521001', 4, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0521001', 5, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0521001', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0521002', 4, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0521002', 5, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0521002', 6, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0521002', 7, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0521003', 1, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0521003', 4, 6);
INSERT INTO `detail_handover_buy` VALUES ('BG0521003', 5, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0521003', 6, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0521003', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0521004', 1, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0521004', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0521004', 6, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0521004', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920001', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920001', 4, 7);
INSERT INTO `detail_handover_buy` VALUES ('BG0920001', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920001', 6, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0920001', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920002', 2, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0920002', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920002', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920002', 6, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0920002', 7, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0920003', 1, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0920003', 4, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0920003', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920003', 6, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920003', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920004', 1, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920004', 2, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0920004', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920004', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0920004', 6, 4);
INSERT INTO `detail_handover_buy` VALUES ('BG0921001', 2, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921001', 3, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0921001', 4, 5);
INSERT INTO `detail_handover_buy` VALUES ('BG0921001', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921001', 7, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0921002', 1, 3);
INSERT INTO `detail_handover_buy` VALUES ('BG0921002', 2, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921002', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921002', 4, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0921002', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921003', 1, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0921003', 2, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921003', 3, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921003', 4, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0921003', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921003', 7, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921004', 1, 2);
INSERT INTO `detail_handover_buy` VALUES ('BG0921004', 5, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921004', 6, 1);
INSERT INTO `detail_handover_buy` VALUES ('BG0921004', 7, 1);

-- ----------------------------
-- Table structure for detail_handover_fix
-- ----------------------------
DROP TABLE IF EXISTS `detail_handover_fix`;
CREATE TABLE `detail_handover_fix`  (
  `id_note` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_equipment` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_note`, `id_equipment`) USING BTREE,
  INDEX `detail_handover_fix_id_equipment_foreign`(`id_equipment`) USING BTREE,
  CONSTRAINT `detail_handover_fix_id_equipment_foreign` FOREIGN KEY (`id_equipment`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_handover_fix_id_note_foreign` FOREIGN KEY (`id_note`) REFERENCES `handover_note` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_handover_fix
-- ----------------------------
INSERT INTO `detail_handover_fix` VALUES ('BG0120005', 'TB000001');
INSERT INTO `detail_handover_fix` VALUES ('BG0120006', 'TB000002');
INSERT INTO `detail_handover_fix` VALUES ('BG0121007', 'TB000002');
INSERT INTO `detail_handover_fix` VALUES ('BG0220001', 'TB000006');
INSERT INTO `detail_handover_fix` VALUES ('BG0320001', 'TB000007');
INSERT INTO `detail_handover_fix` VALUES ('BG0321001', 'TB000003');
INSERT INTO `detail_handover_fix` VALUES ('BG0321001', 'TB000012');
INSERT INTO `detail_handover_fix` VALUES ('BG0420001', 'TB000015');
INSERT INTO `detail_handover_fix` VALUES ('BG0420001', 'TB000016');
INSERT INTO `detail_handover_fix` VALUES ('BG0421001', 'TB000003');
INSERT INTO `detail_handover_fix` VALUES ('BG0421001', 'TB000004');
INSERT INTO `detail_handover_fix` VALUES ('BG0421002', 'TB000005');
INSERT INTO `detail_handover_fix` VALUES ('BG0621001', 'TB000007');
INSERT INTO `detail_handover_fix` VALUES ('BG0720001', 'TB000013');
INSERT INTO `detail_handover_fix` VALUES ('BG0720001', 'TB000014');
INSERT INTO `detail_handover_fix` VALUES ('BG0721001', 'TB000006');
INSERT INTO `detail_handover_fix` VALUES ('BG0721001', 'TB000018');
INSERT INTO `detail_handover_fix` VALUES ('BG0820001', 'TB000001');
INSERT INTO `detail_handover_fix` VALUES ('BG0820002', 'TB000002');
INSERT INTO `detail_handover_fix` VALUES ('BG0821001', 'TB000015');
INSERT INTO `detail_handover_fix` VALUES ('BG0821002', 'TB000015');
INSERT INTO `detail_handover_fix` VALUES ('BG0821002', 'TB000016');
INSERT INTO `detail_handover_fix` VALUES ('BG0921005', 'TB000012');
INSERT INTO `detail_handover_fix` VALUES ('BG1020001', 'TB000016');
INSERT INTO `detail_handover_fix` VALUES ('BG1020001', 'TB000019');
INSERT INTO `detail_handover_fix` VALUES ('BG1021001', 'TB000016');
INSERT INTO `detail_handover_fix` VALUES ('BG1121001', 'TB000008');
INSERT INTO `detail_handover_fix` VALUES ('BG1221001', 'TB000012');
INSERT INTO `detail_handover_fix` VALUES ('BG1221001', 'TB000013');
INSERT INTO `detail_handover_fix` VALUES ('BG1221002', 'TB000009');

-- ----------------------------
-- Table structure for equipment
-- ----------------------------
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment`  (
  `id` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date_grant` date NULL DEFAULT NULL,
  `date_buy` date NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT 1 COMMENT '1: Bình thường, 2: Đang yêu cầu sửa, 3: Đã hỏng',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipment
-- ----------------------------
INSERT INTO `equipment` VALUES ('TB000001', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', '2020-05-01', '2016-01-01', 3, NULL, '2021-12-06 16:21:26', '2021-12-06 19:11:50');
INSERT INTO `equipment` VALUES ('TB000002', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', '2019-05-01', '2016-01-01', 3, NULL, '2021-12-06 16:21:26', '2021-12-07 12:39:57');
INSERT INTO `equipment` VALUES ('TB000003', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', '2019-05-02', '2016-01-01', 1, NULL, '2021-12-06 16:21:26', '2021-12-07 12:46:15');
INSERT INTO `equipment` VALUES ('TB000004', 'Chuột logitech', 'Phòng thực hành máy tính số 1', '2019-05-03', '2016-01-01', 1, NULL, '2021-12-06 16:21:26', '2021-12-11 16:11:57');
INSERT INTO `equipment` VALUES ('TB000005', 'Chuột logitech', 'Phòng thực hành máy tính số 1', '2020-05-01', '2017-01-01', 1, NULL, '2021-12-06 16:21:26', '2021-12-07 14:34:38');
INSERT INTO `equipment` VALUES ('TB000006', 'Chuột logitech', 'Phòng thực hành máy tính số 1', '2020-05-01', '2017-01-02', 1, NULL, '2021-12-06 16:21:26', '2021-12-17 15:08:08');
INSERT INTO `equipment` VALUES ('TB000007', 'Máy chiếu', 'Phòng thực hành máy tính số 1', '2020-05-01', '2017-01-03', 3, NULL, '2021-12-06 16:21:26', '2021-12-07 12:51:48');
INSERT INTO `equipment` VALUES ('TB000008', 'Máy chiếu', 'Phòng thực hành máy tính số 2', '2020-04-01', '2017-01-04', 1, NULL, '2021-12-06 16:21:26', '2021-12-07 13:10:14');
INSERT INTO `equipment` VALUES ('TB000009', 'Máy chiếu', 'Phòng thực hành máy tính số 3', '2020-04-02', '2017-01-05', 3, NULL, '2021-12-06 16:21:26', '2021-12-07 13:14:11');
INSERT INTO `equipment` VALUES ('TB000010', 'Máy in', 'Phòng công tác sinh viên', NULL, '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-06 16:21:26');
INSERT INTO `equipment` VALUES ('TB000011', 'Máy in', 'Phòng đào tạo', NULL, '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-06 16:21:26');
INSERT INTO `equipment` VALUES ('TB000012', 'Máy tính thực hành', 'Phòng thực hành máy tính số 3', '2019-05-01', '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-07 13:12:52');
INSERT INTO `equipment` VALUES ('TB000013', 'Máy tính thực hành', 'Phòng thực hành máy tính số 3', '2019-05-02', '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-07 13:12:52');
INSERT INTO `equipment` VALUES ('TB000014', 'Máy tính thực hành', 'Phòng thực hành máy tính số 1', '2019-05-03', '2017-01-05', 3, NULL, '2021-12-06 16:21:26', '2021-12-06 19:07:46');
INSERT INTO `equipment` VALUES ('TB000015', 'Máy tính thực hành', 'Phòng thực hành máy tính số 1', '2019-05-02', '2017-01-05', 3, NULL, '2021-12-06 16:21:26', '2021-12-07 13:00:14');
INSERT INTO `equipment` VALUES ('TB000016', 'Máy tính thực hành', 'Phòng thực hành máy tính số 2', '2019-05-03', '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-07 13:06:23');
INSERT INTO `equipment` VALUES ('TB000017', 'Máy tính thực hành', 'Phòng thực hành máy tính số 2', NULL, '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-06 16:21:26');
INSERT INTO `equipment` VALUES ('TB000018', 'Máy chiếu', 'Phòng thực hành máy tính số 2', '2019-05-01', '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-07 12:55:29');
INSERT INTO `equipment` VALUES ('TB000019', 'Máy chiếu', 'Phòng thực hành máy tính số 2', '2019-05-02', '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-06 19:18:39');
INSERT INTO `equipment` VALUES ('TB000020', 'Máy chiếu', 'Phòng thực hành máy tính số 1', '2019-05-03', '2017-01-05', 1, NULL, '2021-12-06 16:21:26', '2021-12-06 16:21:26');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for handover_note
-- ----------------------------
DROP TABLE IF EXISTS `handover_note`;
CREATE TABLE `handover_note`  (
  `id` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_request_note` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_creator` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed_at` datetime NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `handover_note_id_request_note_foreign`(`id_request_note`) USING BTREE,
  INDEX `handover_note_id_creator_foreign`(`id_creator`) USING BTREE,
  CONSTRAINT `handover_note_id_creator_foreign` FOREIGN KEY (`id_creator`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `handover_note_id_request_note_foreign` FOREIGN KEY (`id_request_note`) REFERENCES `request_note` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of handover_note
-- ----------------------------
INSERT INTO `handover_note` VALUES ('BG0120001', 'PM0120001', '5050008', '2020-01-20 17:53:33', '2020-01-20 17:53:33', '2021-12-06 17:53:35');
INSERT INTO `handover_note` VALUES ('BG0120002', 'PM0120002', '5050009', '2020-01-20 17:53:33', '2020-01-20 17:53:33', '2021-12-06 17:54:13');
INSERT INTO `handover_note` VALUES ('BG0120003', 'PM0120003', '5050009', '2020-01-20 17:53:33', '2020-01-20 17:53:33', '2021-12-06 17:54:33');
INSERT INTO `handover_note` VALUES ('BG0120004', 'PM0120004', '5050009', '2020-01-20 17:53:33', '2020-01-20 17:53:33', '2021-12-06 17:56:02');
INSERT INTO `handover_note` VALUES ('BG0120005', 'PS0120001', '5050009', '2020-01-17 18:23:06', '2020-01-17 18:23:06', '2021-12-06 18:27:47');
INSERT INTO `handover_note` VALUES ('BG0120006', 'PS0120001', '5050009', '2020-01-19 18:23:06', '2020-01-19 18:23:06', '2021-12-06 18:28:05');
INSERT INTO `handover_note` VALUES ('BG0121001', 'PM0121001', '5050008', '2021-01-18 10:28:20', '2021-01-18 10:28:20', '2021-12-07 10:37:45');
INSERT INTO `handover_note` VALUES ('BG0121002', 'PM0121001', '5050008', '2021-01-18 10:28:20', '2021-01-18 10:28:20', '2021-12-07 10:38:00');
INSERT INTO `handover_note` VALUES ('BG0121003', 'PM0121002', '5050008', '2021-01-18 10:28:20', '2021-01-18 10:28:20', '2021-12-07 10:39:53');
INSERT INTO `handover_note` VALUES ('BG0121004', 'PM0121003', '5050008', '2021-01-18 10:28:20', '2021-01-18 10:28:20', '2021-12-07 10:41:13');
INSERT INTO `handover_note` VALUES ('BG0121005', 'PM0121004', '5050008', '2021-01-18 10:28:20', '2021-01-18 10:28:20', '2021-12-07 10:42:48');
INSERT INTO `handover_note` VALUES ('BG0121006', 'PM0121004', '5050008', '2021-01-18 10:28:20', '2021-01-18 10:28:20', '2021-12-07 10:43:09');
INSERT INTO `handover_note` VALUES ('BG0121007', 'PS0121001', '5050008', '2021-01-23 12:31:48', '2021-01-23 12:31:48', '2021-12-07 12:41:05');
INSERT INTO `handover_note` VALUES ('BG0220001', 'PS0220001', '5050009', '2020-02-19 18:23:06', '2020-02-19 18:23:06', '2021-12-06 18:34:39');
INSERT INTO `handover_note` VALUES ('BG0320001', 'PS0320001', '5050009', '2020-03-19 18:23:06', '2020-03-19 18:23:06', '2021-12-06 18:35:08');
INSERT INTO `handover_note` VALUES ('BG0321001', 'PS0321002', '5050008', '2021-03-05 12:35:29', '2021-03-05 12:35:29', '2021-12-07 12:41:42');
INSERT INTO `handover_note` VALUES ('BG0420001', 'PS0420001', '5050009', '2020-04-06 18:39:15', '2020-04-06 18:39:15', '2021-12-06 18:41:07');
INSERT INTO `handover_note` VALUES ('BG0421001', 'PS0421001', '5050008', '2021-04-06 12:45:40', '2021-04-06 12:45:40', '2021-12-07 12:46:24');
INSERT INTO `handover_note` VALUES ('BG0421002', 'PS0421002', '5050008', '2021-04-10 12:45:40', '2021-04-10 12:45:40', '2021-12-07 12:47:30');
INSERT INTO `handover_note` VALUES ('BG0520001', 'PM0520001', '5050009', '2020-05-19 17:54:07', '2020-05-19 17:54:07', '2021-12-06 17:57:48');
INSERT INTO `handover_note` VALUES ('BG0520002', 'PM0520002', '5050009', '2020-05-19 17:54:07', '2020-05-19 17:54:07', '2021-12-06 17:57:57');
INSERT INTO `handover_note` VALUES ('BG0520003', 'PM0520003', '5050009', '2020-05-19 17:54:07', '2020-05-19 17:54:07', '2021-12-06 17:58:08');
INSERT INTO `handover_note` VALUES ('BG0520004', 'PM0520004', '5050009', '2020-05-19 17:54:07', '2020-05-19 17:54:07', '2021-12-06 17:58:17');
INSERT INTO `handover_note` VALUES ('BG0521001', 'PM0521001', '5050008', '2021-05-20 10:29:13', '2021-05-20 10:29:13', '2021-12-07 10:38:42');
INSERT INTO `handover_note` VALUES ('BG0521002', 'PM0521002', '5050008', '2021-05-20 10:29:13', '2021-05-20 10:29:13', '2021-12-07 10:40:12');
INSERT INTO `handover_note` VALUES ('BG0521003', 'PM0521003', '5050008', '2021-05-20 10:29:13', '2021-05-20 10:29:13', '2021-12-07 10:41:28');
INSERT INTO `handover_note` VALUES ('BG0521004', 'PM0521004', '5050008', '2021-05-20 10:29:13', '2021-05-20 10:29:13', '2021-12-07 10:43:41');
INSERT INTO `handover_note` VALUES ('BG0621001', 'PS0621001', '5050009', '2021-06-07 12:51:26', '2021-06-07 12:51:26', '2021-12-07 12:52:12');
INSERT INTO `handover_note` VALUES ('BG0720001', 'PS0720001', '5050009', '2020-07-10 19:07:19', '2020-07-10 19:07:19', '2021-12-06 19:08:07');
INSERT INTO `handover_note` VALUES ('BG0721001', 'PS0721001', '5050009', '2021-07-10 12:55:07', '2021-07-10 12:55:07', '2021-12-07 12:55:41');
INSERT INTO `handover_note` VALUES ('BG0820001', 'PS0820001', '5050009', '2020-08-10 19:12:37', '2020-08-10 19:12:37', '2021-12-06 19:12:08');
INSERT INTO `handover_note` VALUES ('BG0820002', 'PS0820001', '5050009', '2020-08-11 19:12:37', '2020-08-11 19:12:37', '2021-12-06 19:12:37');
INSERT INTO `handover_note` VALUES ('BG0821001', 'PS0821001', '5050008', '2021-08-11 12:57:37', '2021-08-11 12:57:37', '2021-12-07 12:58:10');
INSERT INTO `handover_note` VALUES ('BG0821002', 'PS0821002', '5050008', '2021-08-12 13:00:19', '2021-08-12 13:00:19', '2021-12-07 13:00:21');
INSERT INTO `handover_note` VALUES ('BG0920001', 'PM0920001', '5050009', '2020-09-18 17:58:24', '2020-09-18 17:58:24', '2021-12-06 17:58:25');
INSERT INTO `handover_note` VALUES ('BG0920002', 'PM0920002', '5050009', '2020-09-18 17:58:24', '2020-09-18 17:58:24', '2021-12-06 17:58:39');
INSERT INTO `handover_note` VALUES ('BG0920003', 'PM0920003', '5050009', '2020-09-18 17:58:24', '2020-09-18 17:58:24', '2021-12-06 17:58:49');
INSERT INTO `handover_note` VALUES ('BG0920004', 'PM0920004', '5050009', '2020-09-18 17:58:24', '2020-09-18 17:58:24', '2021-12-06 17:58:57');
INSERT INTO `handover_note` VALUES ('BG0921001', 'PM0921001', '5050008', '2021-09-19 10:29:13', '2021-09-19 10:29:13', '2021-12-07 10:39:07');
INSERT INTO `handover_note` VALUES ('BG0921002', 'PM0921002', '5050008', '2021-09-19 10:29:13', '2021-09-19 10:29:13', '2021-12-07 10:40:51');
INSERT INTO `handover_note` VALUES ('BG0921003', 'PM0921003', '5050008', '2021-09-19 10:29:13', '2021-09-19 10:29:13', '2021-12-07 10:41:46');
INSERT INTO `handover_note` VALUES ('BG0921004', 'PM0921004', '5050008', '2021-09-19 10:29:13', '2021-09-19 10:29:13', '2021-12-07 10:44:24');
INSERT INTO `handover_note` VALUES ('BG0921005', 'PS0921001', '5050009', '2021-09-11 13:02:45', '2021-09-11 13:02:45', '2021-12-07 13:03:44');
INSERT INTO `handover_note` VALUES ('BG1020001', 'PS1020001', '5050009', '2020-10-14 19:18:15', '2020-10-14 19:18:15', '2021-12-06 19:19:06');
INSERT INTO `handover_note` VALUES ('BG1021001', 'PS1021001', '5050009', '2021-10-12 13:06:02', '2021-10-12 13:06:02', '2021-12-07 13:06:32');
INSERT INTO `handover_note` VALUES ('BG1121001', 'PS1121002', '5050009', '2021-11-13 13:10:00', '2021-11-13 13:10:00', '2021-12-07 13:10:21');
INSERT INTO `handover_note` VALUES ('BG1221001', 'PS1221001', '5050009', '2021-12-12 13:12:22', '2021-12-12 13:12:22', '2021-12-07 13:13:11');
INSERT INTO `handover_note` VALUES ('BG1221002', 'PS1221002', '5050008', '2021-12-13 13:12:22', '2021-12-13 13:12:22', '2021-12-07 13:14:22');

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for limit_stationery
-- ----------------------------
DROP TABLE IF EXISTS `limit_stationery`;
CREATE TABLE `limit_stationery`  (
  `id_user` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_stationery` bigint UNSIGNED NOT NULL,
  `qty_used` int UNSIGNED NOT NULL,
  `qty_max` int UNSIGNED NOT NULL,
  `quarter_year` int NOT NULL,
  `year` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`, `id_stationery`) USING BTREE,
  INDEX `limit_stationery_id_stationery_foreign`(`id_stationery`) USING BTREE,
  CONSTRAINT `limit_stationery_id_stationery_foreign` FOREIGN KEY (`id_stationery`) REFERENCES `stationery` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `limit_stationery_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of limit_stationery
-- ----------------------------
INSERT INTO `limit_stationery` VALUES ('5050001', 1, 0, 2, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050001', 2, 0, 4, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050001', 3, 0, 1, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050001', 4, 0, 4, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050001', 5, 0, 1, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050001', 6, 0, 2, 3, 2021, '2021-12-07 13:31:33', '2021-12-07 13:31:33');
INSERT INTO `limit_stationery` VALUES ('5050001', 7, 0, 1, 3, 2021, '2021-12-07 13:31:33', '2021-12-07 13:31:33');
INSERT INTO `limit_stationery` VALUES ('5050002', 1, 0, 2, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050002', 2, 0, 4, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050002', 3, 0, 1, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050002', 4, 0, 4, 3, 2021, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `limit_stationery` VALUES ('5050002', 5, 0, 1, 3, 2021, '2021-12-07 13:31:33', '2021-12-07 13:31:33');
INSERT INTO `limit_stationery` VALUES ('5050002', 6, 0, 2, 3, 2021, '2021-12-07 13:31:33', '2021-12-07 13:31:33');
INSERT INTO `limit_stationery` VALUES ('5050002', 7, 0, 1, 3, 2021, '2021-12-07 13:31:33', '2021-12-07 13:31:33');
INSERT INTO `limit_stationery` VALUES ('5050003', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050004', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050004', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050004', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050004', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050004', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050004', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050004', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050005', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050005', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050005', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050005', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050005', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050005', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050005', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050006', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050006', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050006', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050006', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050006', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050006', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050006', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050007', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050007', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050007', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050007', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050007', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050007', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050007', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050008', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050008', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050008', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050008', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050008', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050008', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050008', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050009', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050009', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050009', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050009', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050009', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050009', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050009', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050010', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050010', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050010', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050010', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050010', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050010', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050010', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050011', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050011', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050011', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050011', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050011', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050011', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050011', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050012', 1, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050012', 2, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050012', 3, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050012', 4, 0, 4, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050012', 5, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050012', 6, 0, 2, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050012', 7, 0, 1, 3, 2021, '2021-12-07 13:33:11', '2021-12-07 13:33:11');
INSERT INTO `limit_stationery` VALUES ('5050013', 1, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050013', 2, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050013', 3, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050013', 4, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050013', 5, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050013', 6, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050013', 7, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050014', 1, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050014', 2, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050014', 3, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050014', 4, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050014', 5, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050014', 6, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050014', 7, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050015', 1, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050015', 2, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050015', 3, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050015', 4, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050015', 5, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050015', 6, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050015', 7, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050016', 1, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050016', 2, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050016', 3, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050016', 4, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050016', 5, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050016', 6, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050016', 7, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050017', 1, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050017', 2, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050017', 3, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050017', 4, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050017', 5, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050017', 6, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050017', 7, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050018', 1, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050018', 2, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050018', 3, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050018', 4, 0, 4, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050018', 5, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050018', 6, 0, 2, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');
INSERT INTO `limit_stationery` VALUES ('5050018', 7, 0, 1, 3, 2021, '2021-12-07 13:33:12', '2021-12-07 13:33:12');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2021_10_26_105813_create_role_table', 1);
INSERT INTO `migrations` VALUES (6, '2021_10_26_105824_create_permission_table', 1);
INSERT INTO `migrations` VALUES (7, '2021_10_27_101723_add_id_role_to_users_table', 1);
INSERT INTO `migrations` VALUES (8, '2021_11_15_125058_create_department_table', 1);
INSERT INTO `migrations` VALUES (9, '2021_11_15_125320_add_id_department_to_users_table', 1);
INSERT INTO `migrations` VALUES (10, '2021_11_15_125548_create_category_table', 1);
INSERT INTO `migrations` VALUES (11, '2021_11_15_125634_create_stationery_table', 1);
INSERT INTO `migrations` VALUES (12, '2021_11_15_130352_create_equipment_table', 1);
INSERT INTO `migrations` VALUES (13, '2021_11_15_130356_create_period_registration_table', 1);
INSERT INTO `migrations` VALUES (14, '2021_11_15_130706_create_limit_stationery_table', 1);
INSERT INTO `migrations` VALUES (15, '2021_11_15_131021_create_registration_table', 1);
INSERT INTO `migrations` VALUES (16, '2021_11_15_154249_create_request_note_table', 1);
INSERT INTO `migrations` VALUES (17, '2021_11_15_154619_create_detail_buy_table', 1);
INSERT INTO `migrations` VALUES (18, '2021_11_15_154624_create_detail_fix_table', 1);
INSERT INTO `migrations` VALUES (19, '2021_11_15_155117_add_id_note_to_registration_table', 1);
INSERT INTO `migrations` VALUES (20, '2021_11_16_145648_create_handover_note_table', 1);
INSERT INTO `migrations` VALUES (21, '2021_11_16_150019_create_detail_handover_buy_table', 1);
INSERT INTO `migrations` VALUES (22, '2021_11_16_150025_create_detail_handover_fix_table', 1);
INSERT INTO `migrations` VALUES (23, '2021_11_19_182439_add_qty_handovered_to_detail_buy_table', 1);
INSERT INTO `migrations` VALUES (24, '2021_11_22_153733_add_completed_at_to_request_note_table', 1);
INSERT INTO `migrations` VALUES (25, '2021_11_22_173512_add_is_handovered_to_detail_fix_table', 1);
INSERT INTO `migrations` VALUES (26, '2021_11_24_184519_add_is_fixable_to_detail_fix_table', 1);
INSERT INTO `migrations` VALUES (27, '2021_11_27_102512_add_code_to_users_table', 1);
INSERT INTO `migrations` VALUES (28, '2021_11_27_115423_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (29, '2021_11_28_160649_create_notifications_table', 1);
INSERT INTO `migrations` VALUES (30, '2021_12_17_145634_add_timestampe_to_detail_request_table', 2);
INSERT INTO `migrations` VALUES (32, '2021_12_17_162406_change_qty_constraint_in_tables', 3);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `notifications_notifiable_type_notifiable_id_index`(`notifiable_type`, `notifiable_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('7586a7b5-7bae-400b-99bc-6d9ff21b64c8', 'App\\Notifications\\ProcessNoteNotification', 'App\\Models\\User', 5050004, '{\"id_note\":\"PS1221003\",\"message\":\"Phi\\u1ebfu PS1221003 \\u0111\\u00e3 \\u0111\\u01b0\\u1ee3c duy\\u1ec7t\",\"path\":\"\\/phieu-sua\\/detail\\/PS1221003\"}', '2021-12-17 15:07:07', '2021-12-17 15:07:05', '2021-12-17 15:07:07');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for period_registration
-- ----------------------------
DROP TABLE IF EXISTS `period_registration`;
CREATE TABLE `period_registration`  (
  `id` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of period_registration
-- ----------------------------
INSERT INTO `period_registration` VALUES ('120', '2020-01-10 00:00:00', '2020-01-17 23:59:00', '2020-01-06 16:22:49', '2020-01-06 16:22:49');
INSERT INTO `period_registration` VALUES ('121', '2021-01-05 00:00:00', '2021-01-12 23:59:00', '2021-01-05 00:00:00', '2021-01-06 16:22:49');
INSERT INTO `period_registration` VALUES ('220', '2020-05-08 00:00:00', '2020-05-15 23:59:00', '2020-05-06 16:27:31', '2020-05-06 16:27:31');
INSERT INTO `period_registration` VALUES ('221', '2021-05-08 00:00:00', '2021-05-15 23:59:00', '2021-05-08 00:00:00', '2021-05-06 16:27:31');
INSERT INTO `period_registration` VALUES ('320', '2020-09-05 00:00:00', '2020-09-12 23:59:00', '2020-09-03 08:00:00', '2020-09-03 08:00:00');
INSERT INTO `period_registration` VALUES ('321', '2021-09-08 00:00:00', '2021-10-15 23:59:00', '2021-09-08 00:00:00', '2021-09-03 08:00:00');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES (1, 'permission-manage', 'Phân quyền');
INSERT INTO `permission` VALUES (2, 'user-manage', 'Quản lý tài khoản hệ thống');
INSERT INTO `permission` VALUES (3, 'supplies-manage', 'Quản lý vật tư');
INSERT INTO `permission` VALUES (4, 'period-manage', 'Quản lý đợt đăng ký văn phòng phẩm');
INSERT INTO `permission` VALUES (5, 'limit-manage', 'Quản lý hạn mức');
INSERT INTO `permission` VALUES (6, 'request_note-process', 'Xử lý phiếu đề nghị');
INSERT INTO `permission` VALUES (7, 'handover_note-manage', 'Quản lý phiếu bàn giao');
INSERT INTO `permission` VALUES (8, 'buy_note-manage', 'Quản lý phiếu mua');
INSERT INTO `permission` VALUES (9, 'registration-handover', 'Bàn giao văn phòng phẩm đăng ký');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for registration
-- ----------------------------
DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration`  (
  `id_user` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_stationery` bigint UNSIGNED NOT NULL,
  `id_period` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  `received_at` datetime NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_note` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`, `id_stationery`, `id_period`) USING BTREE,
  INDEX `registration_id_stationery_foreign`(`id_stationery`) USING BTREE,
  INDEX `registration_id_period_foreign`(`id_period`) USING BTREE,
  INDEX `registration_id_note_foreign`(`id_note`) USING BTREE,
  CONSTRAINT `registration_id_note_foreign` FOREIGN KEY (`id_note`) REFERENCES `request_note` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `registration_id_period_foreign` FOREIGN KEY (`id_period`) REFERENCES `period_registration` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `registration_id_stationery_foreign` FOREIGN KEY (`id_stationery`) REFERENCES `stationery` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `registration_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of registration
-- ----------------------------
INSERT INTO `registration` VALUES ('5050001', 3, '120', 1, NULL, '2021-12-06 16:51:11', '2021-12-06 17:34:58', 'PM0120002');
INSERT INTO `registration` VALUES ('5050001', 3, '121', 1, NULL, '2021-12-07 09:56:36', '2021-12-07 10:28:20', 'PM0121001');
INSERT INTO `registration` VALUES ('5050001', 3, '321', 1, NULL, '2021-12-07 10:11:38', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050001', 4, '120', 1, NULL, '2021-12-06 16:51:11', '2021-12-06 17:34:58', 'PM0120002');
INSERT INTO `registration` VALUES ('5050001', 4, '121', 2, NULL, '2021-12-07 09:56:36', '2021-12-07 10:28:20', 'PM0121001');
INSERT INTO `registration` VALUES ('5050001', 4, '220', 2, NULL, '2021-12-06 17:08:28', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050001', 4, '320', 4, NULL, '2021-12-06 17:15:30', '2021-12-06 17:35:44', 'PM0920001');
INSERT INTO `registration` VALUES ('5050001', 4, '321', 4, NULL, '2021-12-07 10:11:38', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050001', 5, '120', 1, NULL, '2021-12-06 16:51:11', '2021-12-06 17:34:58', 'PM0120002');
INSERT INTO `registration` VALUES ('5050001', 5, '121', 1, NULL, '2021-12-07 09:56:36', '2021-12-07 10:28:20', 'PM0121001');
INSERT INTO `registration` VALUES ('5050001', 5, '220', 1, NULL, '2021-12-06 17:08:28', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050001', 5, '320', 1, NULL, '2021-12-06 17:15:30', '2021-12-06 17:35:44', 'PM0920001');
INSERT INTO `registration` VALUES ('5050001', 5, '321', 1, NULL, '2021-12-07 10:11:38', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050001', 7, '220', 1, NULL, '2021-12-06 17:08:28', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050002', 4, '220', 1, NULL, '2021-12-06 17:06:52', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050002', 5, '220', 1, NULL, '2021-12-06 17:06:52', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050003', 1, '120', 2, NULL, '2021-12-06 16:55:14', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050003', 2, '320', 3, NULL, '2021-12-06 17:17:18', '2021-12-06 17:40:58', 'PM0920002');
INSERT INTO `registration` VALUES ('5050003', 3, '120', 1, NULL, '2021-12-06 16:55:14', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050003', 4, '121', 3, NULL, '2021-12-07 09:58:02', '2021-12-07 10:29:58', 'PM0121002');
INSERT INTO `registration` VALUES ('5050003', 4, '220', 2, NULL, '2021-12-06 17:08:52', '2021-12-06 17:40:41', 'PM0520002');
INSERT INTO `registration` VALUES ('5050003', 5, '121', 1, NULL, '2021-12-07 09:58:02', '2021-12-07 10:29:58', 'PM0121002');
INSERT INTO `registration` VALUES ('5050003', 5, '220', 1, NULL, '2021-12-06 17:08:52', '2021-12-06 17:40:41', 'PM0520002');
INSERT INTO `registration` VALUES ('5050003', 5, '221', 1, NULL, '2021-12-07 10:06:08', '2021-12-07 10:30:07', 'PM0521002');
INSERT INTO `registration` VALUES ('5050003', 5, '320', 1, NULL, '2021-12-06 17:17:18', '2021-12-06 17:40:58', 'PM0920002');
INSERT INTO `registration` VALUES ('5050003', 7, '121', 1, NULL, '2021-12-07 09:58:02', '2021-12-07 10:29:58', 'PM0121002');
INSERT INTO `registration` VALUES ('5050003', 7, '221', 1, NULL, '2021-12-07 10:06:08', '2021-12-07 10:30:07', 'PM0521002');
INSERT INTO `registration` VALUES ('5050003', 7, '320', 1, NULL, '2021-12-06 17:17:18', '2021-12-06 17:40:58', 'PM0920002');
INSERT INTO `registration` VALUES ('5050004', 1, '121', 1, NULL, '2021-12-07 09:58:18', '2021-12-07 10:29:58', 'PM0121002');
INSERT INTO `registration` VALUES ('5050004', 1, '220', 1, NULL, '2021-12-06 17:09:14', '2021-12-06 17:40:41', 'PM0520002');
INSERT INTO `registration` VALUES ('5050004', 2, '121', 3, NULL, '2021-12-07 09:58:18', '2021-12-07 10:29:58', 'PM0121002');
INSERT INTO `registration` VALUES ('5050004', 4, '120', 3, NULL, '2021-12-06 16:55:31', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050004', 4, '220', 1, NULL, '2021-12-06 17:09:14', '2021-12-06 17:40:41', 'PM0520002');
INSERT INTO `registration` VALUES ('5050004', 4, '321', 2, NULL, '2021-12-07 10:13:49', '2021-12-07 10:30:14', 'PM0921002');
INSERT INTO `registration` VALUES ('5050004', 5, '120', 1, NULL, '2021-12-06 16:55:31', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050004', 5, '221', 1, NULL, '2021-12-07 10:06:23', '2021-12-07 10:30:07', 'PM0521002');
INSERT INTO `registration` VALUES ('5050004', 5, '321', 1, NULL, '2021-12-07 10:13:49', '2021-12-07 10:30:14', 'PM0921002');
INSERT INTO `registration` VALUES ('5050004', 6, '220', 2, NULL, '2021-12-06 17:09:14', '2021-12-06 17:40:41', 'PM0520002');
INSERT INTO `registration` VALUES ('5050004', 6, '221', 2, NULL, '2021-12-07 10:06:23', '2021-12-07 10:30:07', 'PM0521002');
INSERT INTO `registration` VALUES ('5050004', 7, '221', 1, NULL, '2021-12-07 10:06:23', '2021-12-07 10:30:07', 'PM0521002');
INSERT INTO `registration` VALUES ('5050005', 1, '220', 2, NULL, '2021-12-06 17:09:36', '2021-12-06 17:40:41', 'PM0520002');
INSERT INTO `registration` VALUES ('5050005', 1, '321', 1, NULL, '2021-12-07 10:14:01', '2021-12-07 10:30:14', 'PM0921002');
INSERT INTO `registration` VALUES ('5050005', 2, '120', 1, NULL, '2021-12-06 16:55:45', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050005', 2, '220', 3, NULL, '2021-12-06 17:09:36', '2021-12-06 17:40:41', 'PM0520002');
INSERT INTO `registration` VALUES ('5050005', 2, '321', 1, NULL, '2021-12-07 10:14:01', '2021-12-07 10:30:14', 'PM0921002');
INSERT INTO `registration` VALUES ('5050005', 3, '320', 1, NULL, '2021-12-06 17:18:02', '2021-12-06 17:40:58', 'PM0920002');
INSERT INTO `registration` VALUES ('5050005', 4, '121', 1, NULL, '2021-12-07 09:58:34', '2021-12-07 10:29:58', 'PM0121002');
INSERT INTO `registration` VALUES ('5050005', 4, '221', 3, NULL, '2021-12-07 10:06:53', '2021-12-07 10:30:07', 'PM0521002');
INSERT INTO `registration` VALUES ('5050005', 5, '121', 1, NULL, '2021-12-07 09:58:34', '2021-12-07 10:29:58', 'PM0121002');
INSERT INTO `registration` VALUES ('5050005', 5, '221', 1, NULL, '2021-12-07 10:06:53', '2021-12-07 10:30:07', 'PM0521002');
INSERT INTO `registration` VALUES ('5050005', 6, '320', 2, NULL, '2021-12-06 17:18:02', '2021-12-06 17:40:58', 'PM0920002');
INSERT INTO `registration` VALUES ('5050005', 7, '120', 1, NULL, '2021-12-06 16:55:45', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050006', 1, '120', 2, NULL, '2021-12-06 16:56:11', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050006', 1, '321', 2, NULL, '2021-12-07 10:14:14', '2021-12-07 10:30:14', 'PM0921002');
INSERT INTO `registration` VALUES ('5050006', 3, '120', 1, NULL, '2021-12-06 16:56:11', '2021-12-06 17:39:28', 'PM0120001');
INSERT INTO `registration` VALUES ('5050006', 3, '321', 1, NULL, '2021-12-07 10:14:14', '2021-12-07 10:30:14', 'PM0921002');
INSERT INTO `registration` VALUES ('5050006', 6, '320', 2, NULL, '2021-12-06 17:17:46', '2021-12-06 17:40:58', 'PM0920002');
INSERT INTO `registration` VALUES ('5050006', 7, '320', 1, NULL, '2021-12-06 17:17:46', '2021-12-06 17:40:58', 'PM0920002');
INSERT INTO `registration` VALUES ('5050007', 2, '121', 1, NULL, '2021-12-07 09:57:24', '2021-12-07 10:28:20', 'PM0121001');
INSERT INTO `registration` VALUES ('5050007', 3, '320', 1, NULL, '2021-12-06 17:15:58', '2021-12-06 17:35:44', 'PM0920001');
INSERT INTO `registration` VALUES ('5050007', 4, '221', 2, NULL, '2021-12-07 10:05:33', '2021-12-07 10:29:13', 'PM0521001');
INSERT INTO `registration` VALUES ('5050007', 4, '320', 3, NULL, '2021-12-06 17:15:58', '2021-12-06 17:35:44', 'PM0920001');
INSERT INTO `registration` VALUES ('5050007', 5, '221', 1, NULL, '2021-12-07 10:05:33', '2021-12-07 10:29:13', 'PM0521001');
INSERT INTO `registration` VALUES ('5050007', 6, '121', 2, NULL, '2021-12-07 09:57:24', '2021-12-07 10:28:20', 'PM0121001');
INSERT INTO `registration` VALUES ('5050007', 7, '221', 1, NULL, '2021-12-07 10:05:33', '2021-12-07 10:29:13', 'PM0521001');
INSERT INTO `registration` VALUES ('5050008', 1, '221', 1, NULL, '2021-12-07 10:05:50', '2021-12-07 10:29:13', 'PM0521001');
INSERT INTO `registration` VALUES ('5050008', 3, '120', 1, NULL, '2021-12-06 16:54:22', '2021-12-06 17:34:58', 'PM0120002');
INSERT INTO `registration` VALUES ('5050008', 3, '220', 1, NULL, '2021-12-06 17:07:18', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050008', 3, '321', 1, NULL, '2021-12-07 10:12:19', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050008', 4, '120', 4, NULL, '2021-12-06 16:54:22', '2021-12-06 17:34:58', 'PM0120002');
INSERT INTO `registration` VALUES ('5050008', 4, '221', 1, NULL, '2021-12-07 10:05:50', '2021-12-07 10:29:13', 'PM0521001');
INSERT INTO `registration` VALUES ('5050008', 4, '321', 1, NULL, '2021-12-07 10:12:19', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050008', 5, '221', 1, NULL, '2021-12-07 10:05:50', '2021-12-07 10:29:13', 'PM0521001');
INSERT INTO `registration` VALUES ('5050008', 6, '220', 2, NULL, '2021-12-06 17:07:18', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050008', 6, '320', 2, NULL, '2021-12-06 17:16:22', '2021-12-06 17:35:44', 'PM0920001');
INSERT INTO `registration` VALUES ('5050008', 7, '220', 1, NULL, '2021-12-06 17:07:18', '2021-12-06 17:35:22', 'PM0520001');
INSERT INTO `registration` VALUES ('5050008', 7, '320', 1, NULL, '2021-12-06 17:16:22', '2021-12-06 17:35:44', 'PM0920001');
INSERT INTO `registration` VALUES ('5050008', 7, '321', 1, NULL, '2021-12-07 10:12:19', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050009', 2, '321', 1, NULL, '2021-12-07 10:12:42', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050009', 3, '321', 1, NULL, '2021-12-07 10:12:42', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050009', 4, '120', 1, NULL, '2021-12-06 16:53:13', '2021-12-06 17:34:58', 'PM0120002');
INSERT INTO `registration` VALUES ('5050009', 6, '120', 2, NULL, '2021-12-06 16:53:13', '2021-12-06 17:34:58', 'PM0120002');
INSERT INTO `registration` VALUES ('5050009', 6, '121', 1, NULL, '2021-12-07 09:57:38', '2021-12-07 10:28:20', 'PM0121001');
INSERT INTO `registration` VALUES ('5050009', 7, '121', 1, NULL, '2021-12-07 09:57:38', '2021-12-07 10:28:20', 'PM0121001');
INSERT INTO `registration` VALUES ('5050009', 7, '321', 1, NULL, '2021-12-07 10:12:42', '2021-12-07 10:29:24', 'PM0921001');
INSERT INTO `registration` VALUES ('5050010', 1, '120', 2, NULL, '2021-12-06 16:58:09', '2021-12-06 17:42:13', 'PM0120003');
INSERT INTO `registration` VALUES ('5050010', 1, '320', 2, NULL, '2021-12-06 17:18:30', '2021-12-06 17:42:32', 'PM0920003');
INSERT INTO `registration` VALUES ('5050010', 2, '220', 3, NULL, '2021-12-06 17:10:04', '2021-12-06 17:42:24', 'PM0520003');
INSERT INTO `registration` VALUES ('5050010', 3, '120', 1, NULL, '2021-12-06 16:58:09', '2021-12-06 17:42:13', 'PM0120003');
INSERT INTO `registration` VALUES ('5050010', 4, '120', 4, NULL, '2021-12-06 16:58:09', '2021-12-06 17:42:13', 'PM0120003');
INSERT INTO `registration` VALUES ('5050010', 4, '121', 2, NULL, '2021-12-07 09:59:17', '2021-12-07 10:30:37', 'PM0121003');
INSERT INTO `registration` VALUES ('5050010', 4, '221', 3, NULL, '2021-12-07 10:08:00', '2021-12-07 10:30:49', 'PM0521003');
INSERT INTO `registration` VALUES ('5050010', 4, '320', 4, NULL, '2021-12-06 17:18:30', '2021-12-06 17:42:32', 'PM0920003');
INSERT INTO `registration` VALUES ('5050010', 4, '321', 2, NULL, '2021-12-07 10:15:10', '2021-12-07 10:31:07', 'PM0921003');
INSERT INTO `registration` VALUES ('5050010', 5, '121', 1, NULL, '2021-12-07 09:59:17', '2021-12-07 10:30:37', 'PM0121003');
INSERT INTO `registration` VALUES ('5050010', 5, '221', 1, NULL, '2021-12-07 10:08:00', '2021-12-07 10:30:49', 'PM0521003');
INSERT INTO `registration` VALUES ('5050010', 5, '320', 1, NULL, '2021-12-06 17:18:30', '2021-12-06 17:42:32', 'PM0920003');
INSERT INTO `registration` VALUES ('5050010', 5, '321', 1, NULL, '2021-12-07 10:15:10', '2021-12-07 10:31:07', 'PM0921003');
INSERT INTO `registration` VALUES ('5050010', 6, '220', 2, NULL, '2021-12-06 17:10:04', '2021-12-06 17:42:24', 'PM0520003');
INSERT INTO `registration` VALUES ('5050010', 7, '220', 1, NULL, '2021-12-06 17:10:04', '2021-12-06 17:42:24', 'PM0520003');
INSERT INTO `registration` VALUES ('5050010', 7, '221', 1, NULL, '2021-12-07 10:08:00', '2021-12-07 10:30:49', 'PM0521003');
INSERT INTO `registration` VALUES ('5050011', 1, '120', 1, NULL, '2021-12-06 16:58:30', '2021-12-06 17:42:13', 'PM0120003');
INSERT INTO `registration` VALUES ('5050011', 1, '121', 2, NULL, '2021-12-07 09:59:32', '2021-12-07 10:30:37', 'PM0121003');
INSERT INTO `registration` VALUES ('5050011', 1, '221', 2, NULL, '2021-12-07 10:08:38', '2021-12-07 10:30:49', 'PM0521003');
INSERT INTO `registration` VALUES ('5050011', 2, '120', 1, NULL, '2021-12-06 16:58:30', '2021-12-06 17:42:13', 'PM0120003');
INSERT INTO `registration` VALUES ('5050011', 3, '121', 1, NULL, '2021-12-07 09:59:32', '2021-12-07 10:30:37', 'PM0121003');
INSERT INTO `registration` VALUES ('5050011', 3, '220', 1, NULL, '2021-12-06 17:10:44', '2021-12-06 17:42:24', 'PM0520003');
INSERT INTO `registration` VALUES ('5050011', 3, '321', 1, NULL, '2021-12-07 10:15:24', '2021-12-07 10:31:07', 'PM0921003');
INSERT INTO `registration` VALUES ('5050011', 5, '121', 1, NULL, '2021-12-07 09:59:32', '2021-12-07 10:30:37', 'PM0121003');
INSERT INTO `registration` VALUES ('5050011', 6, '220', 2, NULL, '2021-12-06 17:10:44', '2021-12-06 17:42:24', 'PM0520003');
INSERT INTO `registration` VALUES ('5050011', 6, '221', 2, NULL, '2021-12-07 10:08:38', '2021-12-07 10:30:49', 'PM0521003');
INSERT INTO `registration` VALUES ('5050011', 7, '321', 1, NULL, '2021-12-07 10:15:24', '2021-12-07 10:31:07', 'PM0921003');
INSERT INTO `registration` VALUES ('5050012', 1, '120', 1, NULL, '2021-12-06 16:58:54', '2021-12-06 17:42:13', 'PM0120003');
INSERT INTO `registration` VALUES ('5050012', 1, '321', 2, NULL, '2021-12-07 10:15:36', '2021-12-07 10:31:07', 'PM0921003');
INSERT INTO `registration` VALUES ('5050012', 2, '120', 3, NULL, '2021-12-06 16:58:54', '2021-12-06 17:42:13', 'PM0120003');
INSERT INTO `registration` VALUES ('5050012', 2, '321', 1, NULL, '2021-12-07 10:15:36', '2021-12-07 10:31:07', 'PM0921003');
INSERT INTO `registration` VALUES ('5050012', 4, '221', 3, NULL, '2021-12-07 10:08:23', '2021-12-07 10:30:49', 'PM0521003');
INSERT INTO `registration` VALUES ('5050012', 5, '221', 1, NULL, '2021-12-07 10:08:23', '2021-12-07 10:30:49', 'PM0521003');
INSERT INTO `registration` VALUES ('5050012', 6, '220', 2, NULL, '2021-12-06 17:10:21', '2021-12-06 17:42:24', 'PM0520003');
INSERT INTO `registration` VALUES ('5050012', 6, '320', 1, NULL, '2021-12-06 17:18:43', '2021-12-06 17:42:32', 'PM0920003');
INSERT INTO `registration` VALUES ('5050012', 7, '220', 1, NULL, '2021-12-06 17:10:21', '2021-12-06 17:42:24', 'PM0520003');
INSERT INTO `registration` VALUES ('5050012', 7, '320', 1, NULL, '2021-12-06 17:18:43', '2021-12-06 17:42:32', 'PM0920003');
INSERT INTO `registration` VALUES ('5050016', 1, '220', 1, NULL, '2021-12-06 17:11:24', '2021-12-06 17:43:32', 'PM0520004');
INSERT INTO `registration` VALUES ('5050016', 1, '221', 2, NULL, '2021-12-07 10:09:15', '2021-12-07 10:31:51', 'PM0521004');
INSERT INTO `registration` VALUES ('5050016', 1, '320', 1, NULL, '2021-12-06 17:19:17', '2021-12-06 17:43:43', 'PM0920004');
INSERT INTO `registration` VALUES ('5050016', 4, '121', 3, NULL, '2021-12-07 09:59:55', '2021-12-07 10:31:44', 'PM0121004');
INSERT INTO `registration` VALUES ('5050016', 5, '120', 1, NULL, '2021-12-06 17:00:26', '2021-12-06 17:43:12', 'PM0120004');
INSERT INTO `registration` VALUES ('5050016', 5, '121', 1, NULL, '2021-12-07 09:59:55', '2021-12-07 10:31:44', 'PM0121004');
INSERT INTO `registration` VALUES ('5050016', 5, '320', 1, NULL, '2021-12-06 17:19:17', '2021-12-06 17:43:43', 'PM0920004');
INSERT INTO `registration` VALUES ('5050016', 5, '321', 1, NULL, '2021-12-07 10:16:20', '2021-12-07 10:32:02', 'PM0921004');
INSERT INTO `registration` VALUES ('5050016', 6, '220', 1, NULL, '2021-12-06 17:11:24', '2021-12-06 17:43:32', 'PM0520004');
INSERT INTO `registration` VALUES ('5050016', 6, '320', 2, NULL, '2021-12-06 17:19:17', '2021-12-06 17:43:43', 'PM0920004');
INSERT INTO `registration` VALUES ('5050016', 7, '120', 1, NULL, '2021-12-06 17:00:26', '2021-12-06 17:43:12', 'PM0120004');
INSERT INTO `registration` VALUES ('5050016', 7, '221', 1, NULL, '2021-12-07 10:09:15', '2021-12-07 10:31:51', 'PM0521004');
INSERT INTO `registration` VALUES ('5050016', 7, '321', 1, NULL, '2021-12-07 10:16:20', '2021-12-07 10:32:02', 'PM0921004');
INSERT INTO `registration` VALUES ('5050017', 1, '120', 1, NULL, '2021-12-06 17:00:57', '2021-12-06 17:43:12', 'PM0120004');
INSERT INTO `registration` VALUES ('5050017', 1, '121', 1, NULL, '2021-12-07 10:00:10', '2021-12-07 10:31:44', 'PM0121004');
INSERT INTO `registration` VALUES ('5050017', 1, '321', 2, NULL, '2021-12-07 10:16:33', '2021-12-07 10:32:02', 'PM0921004');
INSERT INTO `registration` VALUES ('5050017', 2, '120', 1, NULL, '2021-12-06 17:00:57', '2021-12-06 17:43:12', 'PM0120004');
INSERT INTO `registration` VALUES ('5050017', 2, '320', 4, NULL, '2021-12-06 17:19:36', '2021-12-06 17:43:43', 'PM0920004');
INSERT INTO `registration` VALUES ('5050017', 3, '120', 1, NULL, '2021-12-06 17:00:57', '2021-12-06 17:43:12', 'PM0120004');
INSERT INTO `registration` VALUES ('5050017', 3, '221', 1, NULL, '2021-12-07 10:09:31', '2021-12-07 10:31:51', 'PM0521004');
INSERT INTO `registration` VALUES ('5050017', 4, '121', 1, NULL, '2021-12-07 10:00:10', '2021-12-07 10:31:44', 'PM0121004');
INSERT INTO `registration` VALUES ('5050017', 6, '221', 1, NULL, '2021-12-07 10:09:31', '2021-12-07 10:31:51', 'PM0521004');
INSERT INTO `registration` VALUES ('5050017', 6, '321', 1, NULL, '2021-12-07 10:16:33', '2021-12-07 10:32:02', 'PM0921004');
INSERT INTO `registration` VALUES ('5050017', 7, '121', 1, NULL, '2021-12-07 10:00:10', '2021-12-07 10:31:44', 'PM0121004');
INSERT INTO `registration` VALUES ('5050017', 7, '220', 1, NULL, '2021-12-06 17:11:45', '2021-12-06 17:43:32', 'PM0520004');
INSERT INTO `registration` VALUES ('5050018', 2, '121', 2, NULL, '2021-12-07 10:00:26', '2021-12-07 10:31:44', 'PM0121004');
INSERT INTO `registration` VALUES ('5050018', 3, '220', 1, NULL, '2021-12-06 17:12:53', '2021-12-06 17:43:32', 'PM0520004');
INSERT INTO `registration` VALUES ('5050018', 3, '320', 1, NULL, '2021-12-06 17:20:03', '2021-12-06 17:43:43', 'PM0920004');
INSERT INTO `registration` VALUES ('5050018', 4, '121', 2, NULL, '2021-12-07 10:00:26', '2021-12-07 10:31:44', 'PM0121004');
INSERT INTO `registration` VALUES ('5050018', 4, '220', 3, NULL, '2021-12-06 17:12:53', '2021-12-06 17:43:32', 'PM0520004');
INSERT INTO `registration` VALUES ('5050018', 5, '120', 1, NULL, '2021-12-06 17:01:30', '2021-12-06 17:43:12', 'PM0120004');
INSERT INTO `registration` VALUES ('5050018', 6, '120', 2, NULL, '2021-12-06 17:01:30', '2021-12-06 17:43:12', 'PM0120004');
INSERT INTO `registration` VALUES ('5050018', 6, '220', 2, NULL, '2021-12-06 17:12:53', '2021-12-06 17:43:32', 'PM0520004');
INSERT INTO `registration` VALUES ('5050018', 6, '320', 2, NULL, '2021-12-06 17:20:03', '2021-12-06 17:43:43', 'PM0920004');
INSERT INTO `registration` VALUES ('5050018', 7, '120', 1, NULL, '2021-12-06 17:01:30', '2021-12-06 17:43:12', 'PM0120004');

-- ----------------------------
-- Table structure for request_note
-- ----------------------------
DROP TABLE IF EXISTS `request_note`;
CREATE TABLE `request_note`  (
  `id` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_creator` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_handler` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_period` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_department` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_at` datetime NULL DEFAULT NULL,
  `is_buy` tinyint(1) NOT NULL,
  `status` tinyint NOT NULL COMMENT '1: Chờ duyệt, 2: Chờ bàn giao, 3: Đã hoàn thành',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `request_note_id_creator_foreign`(`id_creator`) USING BTREE,
  INDEX `request_note_id_handler_foreign`(`id_handler`) USING BTREE,
  INDEX `request_note_id_period_foreign`(`id_period`) USING BTREE,
  INDEX `request_note_id_department_foreign`(`id_department`) USING BTREE,
  CONSTRAINT `request_note_id_creator_foreign` FOREIGN KEY (`id_creator`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `request_note_id_department_foreign` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `request_note_id_handler_foreign` FOREIGN KEY (`id_handler`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `request_note_id_period_foreign` FOREIGN KEY (`id_period`) REFERENCES `period_registration` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of request_note
-- ----------------------------
INSERT INTO `request_note` VALUES ('PM0120001', '5050003', '5050008', '120', 'KD', '2020-01-19 17:46:33', 1, 3, NULL, '2020-01-19 17:46:33', '2020-01-20 17:53:33', '2020-01-20 17:53:33');
INSERT INTO `request_note` VALUES ('PM0120002', '5050007', '5050008', '120', 'PCSVC', '2020-01-19 17:46:33', 1, 3, 'Phòng cơ sở vật chất gửi phiếu', '2020-01-19 17:46:33', '2020-01-20 17:53:33', '2020-01-20 17:53:33');
INSERT INTO `request_note` VALUES ('PM0120003', '5050010', '5050008', '120', 'KXD', '2020-01-19 17:46:33', 1, 3, NULL, '2020-01-19 17:46:33', '2020-01-20 17:53:33', '2020-01-20 17:53:33');
INSERT INTO `request_note` VALUES ('PM0120004', '5050016', '5050008', '120', 'PDT', '2020-01-19 17:46:33', 1, 3, NULL, '2020-01-19 17:46:33', '2020-01-20 17:53:33', '2020-01-20 17:53:33');
INSERT INTO `request_note` VALUES ('PM0121001', '5050007', '5050008', '121', 'PCSVC', '2021-01-16 10:28:20', 1, 3, NULL, '2021-01-16 10:28:20', '2021-12-07 10:38:00', '2021-01-18 10:28:20');
INSERT INTO `request_note` VALUES ('PM0121002', '5050003', '5050008', '121', 'KD', '2021-01-16 10:28:20', 1, 3, NULL, '2021-01-16 10:28:20', '2021-12-07 10:39:53', '2021-01-18 10:28:20');
INSERT INTO `request_note` VALUES ('PM0121003', '5050010', '5050008', '121', 'KXD', '2021-01-16 10:28:20', 1, 3, NULL, '2021-01-16 10:28:20', '2021-12-07 10:41:13', '2021-01-18 10:28:20');
INSERT INTO `request_note` VALUES ('PM0121004', '5050016', '5050008', '121', 'PDT', '2021-01-16 10:28:20', 1, 3, NULL, '2021-01-16 10:28:20', '2021-12-07 10:43:09', '2021-01-18 10:28:20');
INSERT INTO `request_note` VALUES ('PM0520001', '5050007', '5050008', '220', 'PCSVC', '2020-05-18 17:49:49', 1, 3, 'Phòng cơ sở vật chất gửi phiếu', '2020-05-18 17:49:49', '2020-05-19 17:54:07', '2020-05-19 17:54:07');
INSERT INTO `request_note` VALUES ('PM0520002', '5050003', '5050008', '220', 'KD', '2020-05-18 17:49:49', 1, 3, NULL, '2020-05-18 17:49:49', '2020-05-19 17:54:07', '2020-05-19 17:54:07');
INSERT INTO `request_note` VALUES ('PM0520003', '5050010', '5050008', '220', 'KXD', '2020-05-18 17:49:49', 1, 3, NULL, '2020-05-18 17:49:49', '2020-05-19 17:54:07', '2020-05-19 17:54:07');
INSERT INTO `request_note` VALUES ('PM0520004', '5050016', '5050008', '220', 'PDT', '2020-05-18 17:49:49', 1, 3, NULL, '2020-05-18 17:49:49', '2020-05-19 17:54:07', '2020-05-19 17:54:07');
INSERT INTO `request_note` VALUES ('PM0521001', '5050007', '5050008', '221', 'PCSVC', '2021-05-19 10:29:13', 1, 3, NULL, '2021-05-19 10:29:13', '2021-12-07 10:38:42', '2021-05-20 10:29:13');
INSERT INTO `request_note` VALUES ('PM0521002', '5050003', '5050008', '221', 'KD', '2021-05-19 10:29:13', 1, 3, NULL, '2021-05-19 10:29:13', '2021-12-07 10:40:12', '2021-05-20 10:29:13');
INSERT INTO `request_note` VALUES ('PM0521003', '5050010', '5050008', '221', 'KXD', '2021-05-19 10:29:13', 1, 3, NULL, '2021-05-19 10:29:13', '2021-12-07 10:41:28', '2021-05-20 10:29:13');
INSERT INTO `request_note` VALUES ('PM0521004', '5050016', '5050008', '221', 'PDT', '2021-05-19 10:29:13', 1, 3, NULL, '2021-05-19 10:29:13', '2021-12-07 10:43:41', '2021-05-20 10:29:13');
INSERT INTO `request_note` VALUES ('PM0920001', '5050007', '5050008', '320', 'PCSVC', '2020-09-16 17:50:34', 1, 3, 'Phòng cơ sở vật chất gửi phiếu', '2020-09-16 17:50:34', '2020-09-18 17:58:24', '2020-09-18 17:58:24');
INSERT INTO `request_note` VALUES ('PM0920002', '5050003', '5050008', '320', 'KD', '2020-09-16 17:50:34', 1, 3, NULL, '2020-09-16 17:50:34', '2020-09-18 17:58:24', '2020-09-18 17:58:24');
INSERT INTO `request_note` VALUES ('PM0920003', '5050010', '5050008', '320', 'KXD', '2020-09-16 17:50:34', 1, 3, NULL, '2020-09-16 17:50:34', '2020-09-18 17:58:24', '2020-09-18 17:58:24');
INSERT INTO `request_note` VALUES ('PM0920004', '5050016', '5050008', '320', 'PDT', '2020-09-16 17:50:34', 1, 3, NULL, '2020-09-16 17:50:34', '2020-09-18 17:58:24', '2020-09-18 17:58:24');
INSERT INTO `request_note` VALUES ('PM0921001', '5050007', '5050008', '321', 'PCSVC', '2021-09-18 10:29:24', 1, 3, NULL, '2021-09-18 10:29:24', '2021-12-07 10:39:07', '2021-09-19 10:29:24');
INSERT INTO `request_note` VALUES ('PM0921002', '5050003', '5050008', '321', 'KD', '2021-09-18 10:29:24', 1, 3, NULL, '2021-09-18 10:29:24', '2021-12-07 10:40:51', '2021-09-19 10:29:24');
INSERT INTO `request_note` VALUES ('PM0921003', '5050010', '5050008', '321', 'KXD', '2021-09-18 10:29:24', 1, 3, NULL, '2021-09-18 10:29:24', '2021-12-07 10:41:46', '2021-09-19 10:29:24');
INSERT INTO `request_note` VALUES ('PM0921004', '5050016', '5050008', '321', 'PDT', '2021-09-18 10:29:24', 1, 3, NULL, '2021-09-18 10:29:24', '2021-12-07 10:44:24', '2021-09-19 10:29:24');
INSERT INTO `request_note` VALUES ('PS0120001', '5050003', '5050009', NULL, 'KD', '2020-01-15 18:27:06', 0, 3, NULL, '2020-01-15 18:27:06', '2020-01-19 18:23:06', '2020-01-19 18:23:06');
INSERT INTO `request_note` VALUES ('PS0120002', '5050005', '5050009', NULL, 'KD', '2020-01-15 18:23:06', 0, 4, NULL, '2020-01-15 18:23:06', '2021-12-06 18:30:14', NULL);
INSERT INTO `request_note` VALUES ('PS0121001', '5050003', '5050008', NULL, 'KD', '2021-01-21 12:31:48', 0, 3, NULL, '2021-01-21 12:31:48', '2021-12-07 12:41:05', '2021-12-07 12:41:05');
INSERT INTO `request_note` VALUES ('PS0220001', '5050011', '5050009', NULL, 'KXD', '2020-02-15 18:23:06', 0, 3, NULL, '2020-02-15 18:23:06', '2021-12-06 18:34:39', '2020-02-19 18:23:06');
INSERT INTO `request_note` VALUES ('PS0320001', '5050010', '5050009', NULL, 'KXD', '2020-03-15 18:23:06', 0, 3, NULL, '2020-03-15 18:23:06', '2021-12-06 18:35:08', '2020-03-19 18:23:06');
INSERT INTO `request_note` VALUES ('PS0321001', '5050003', '5050008', NULL, 'KD', '2021-03-03 12:32:11', 0, 4, NULL, '2021-03-03 12:32:11', '2021-12-07 12:41:23', NULL);
INSERT INTO `request_note` VALUES ('PS0321002', '5050005', '5050008', NULL, 'KD', '2021-03-05 12:35:29', 0, 3, NULL, '2021-03-05 12:35:29', '2021-12-07 12:41:42', '2021-12-07 12:41:42');
INSERT INTO `request_note` VALUES ('PS0420001', '5050013', '5050009', NULL, 'PDT', '2020-04-06 18:39:15', 0, 3, NULL, '2020-04-06 18:39:15', '2021-12-06 18:41:07', '2020-04-06 18:39:15');
INSERT INTO `request_note` VALUES ('PS0420002', '5050014', '5050009', NULL, 'KCNHH', '2020-05-06 18:39:15', 0, 4, NULL, '2020-05-06 18:39:15', '2021-12-06 18:41:14', NULL);
INSERT INTO `request_note` VALUES ('PS0421001', '5050007', '5050008', NULL, 'PCSVC', '2021-04-04 12:45:40', 0, 3, NULL, '2021-04-04 12:45:40', '2021-12-07 12:46:24', '2021-04-06 12:45:40');
INSERT INTO `request_note` VALUES ('PS0421002', '5050016', '5050008', NULL, 'PDT', '2021-04-08 12:45:40', 0, 3, NULL, '2021-04-08 12:45:40', '2021-12-07 12:47:30', '2021-04-10 12:45:40');
INSERT INTO `request_note` VALUES ('PS0621001', '5050013', '5050009', NULL, 'PDT', '2021-06-05 12:51:26', 0, 3, NULL, '2021-06-05 12:51:26', '2021-12-07 12:52:12', '2021-06-07 12:51:26');
INSERT INTO `request_note` VALUES ('PS0720001', '5050015', '5050009', NULL, 'KSPCN', '2020-07-07 19:07:19', 0, 3, NULL, '2020-07-07 19:07:19', '2021-12-06 19:08:07', '2020-07-10 19:07:19');
INSERT INTO `request_note` VALUES ('PS0721001', '5050012', '5050009', NULL, 'KXD', '2021-07-07 12:55:07', 0, 3, NULL, '2021-07-07 12:55:07', '2021-12-07 12:55:41', '2021-07-10 12:55:07');
INSERT INTO `request_note` VALUES ('PS0820001', '5050016', '5050009', NULL, 'PDT', '2020-08-08 19:12:37', 0, 3, NULL, '2020-08-08 19:12:37', '2020-08-08 19:12:37', '2020-08-11 19:12:37');
INSERT INTO `request_note` VALUES ('PS0821001', '5050006', '5050008', NULL, 'KD', '2021-08-08 12:57:37', 0, 3, NULL, '2021-08-08 12:57:37', '2021-12-07 12:58:10', '2021-08-11 12:57:37');
INSERT INTO `request_note` VALUES ('PS0821002', '5050011', '5050008', NULL, 'KXD', '2021-08-09 13:00:19', 0, 3, NULL, '2021-08-09 13:00:19', '2021-12-07 13:00:21', '2021-08-12 13:00:19');
INSERT INTO `request_note` VALUES ('PS0920001', '5050017', '5050009', NULL, 'PDT', '2020-09-06 19:15:37', 0, 4, NULL, '2020-09-06 19:15:37', '2021-12-06 19:15:48', NULL);
INSERT INTO `request_note` VALUES ('PS0921001', '5050005', '5050009', NULL, 'KD', '2021-09-09 13:02:45', 0, 3, NULL, '2021-09-09 13:02:45', '2021-12-07 13:03:44', '2021-09-11 13:02:45');
INSERT INTO `request_note` VALUES ('PS1020001', '5050003', '5050009', NULL, 'KD', '2020-10-10 19:18:15', 0, 3, NULL, '2020-10-10 19:18:15', '2021-12-06 19:19:06', '2020-10-14 19:18:15');
INSERT INTO `request_note` VALUES ('PS1021001', '5050011', '5050009', NULL, 'KXD', '2021-10-10 13:06:02', 0, 3, NULL, '2021-10-10 13:06:02', '2021-12-07 13:06:32', '2021-10-12 13:06:02');
INSERT INTO `request_note` VALUES ('PS1121001', '5050014', '5050009', NULL, 'KCNHH', '2021-11-10 13:09:03', 0, 4, NULL, '2021-11-10 13:09:03', '2021-12-07 13:09:12', NULL);
INSERT INTO `request_note` VALUES ('PS1121002', '5050012', '5050009', NULL, 'KXD', '2021-11-11 13:10:00', 0, 3, NULL, '2021-11-11 13:10:00', '2021-12-07 13:10:21', '2021-11-13 13:10:00');
INSERT INTO `request_note` VALUES ('PS1221001', '5050004', '5050009', NULL, 'KD', '2021-12-09 13:12:22', 0, 3, NULL, '2021-12-09 13:12:22', '2021-12-07 13:13:11', '2021-12-12 13:12:22');
INSERT INTO `request_note` VALUES ('PS1221002', '5050010', '5050008', NULL, 'KXD', '2021-12-10 13:12:22', 0, 3, NULL, '2021-12-10 13:12:22', '2021-12-07 13:14:22', '2021-12-13 13:12:22');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'Quản trị viên');
INSERT INTO `role` VALUES (2, 'Nhân viên cơ sở vật chất');
INSERT INTO `role` VALUES (3, 'Quản lý vật tư');
INSERT INTO `role` VALUES (4, 'Cán bộ');

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission`  (
  `id_role` tinyint UNSIGNED NOT NULL,
  `id_permission` smallint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`, `id_permission`) USING BTREE,
  INDEX `role_permission_id_permission_foreign`(`id_permission`) USING BTREE,
  CONSTRAINT `role_permission_id_permission_foreign` FOREIGN KEY (`id_permission`) REFERENCES `permission` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `role_permission_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES (1, 1, NULL, NULL);
INSERT INTO `role_permission` VALUES (1, 2, NULL, NULL);
INSERT INTO `role_permission` VALUES (1, 3, NULL, NULL);
INSERT INTO `role_permission` VALUES (1, 4, NULL, NULL);
INSERT INTO `role_permission` VALUES (1, 5, NULL, NULL);
INSERT INTO `role_permission` VALUES (2, 6, NULL, NULL);
INSERT INTO `role_permission` VALUES (2, 7, NULL, NULL);
INSERT INTO `role_permission` VALUES (3, 8, NULL, NULL);
INSERT INTO `role_permission` VALUES (3, 9, NULL, NULL);

-- ----------------------------
-- Table structure for stationery
-- ----------------------------
DROP TABLE IF EXISTS `stationery`;
CREATE TABLE `stationery`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit_avg` int UNSIGNED NOT NULL,
  `id_category` tinyint UNSIGNED NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `stationery_id_category_foreign`(`id_category`) USING BTREE,
  CONSTRAINT `stationery_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stationery
-- ----------------------------
INSERT INTO `stationery` VALUES (1, 'Giấy A4', 'Ram', 2, 2, NULL, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `stationery` VALUES (2, 'Phấn viên', 'Hộp', 4, 4, NULL, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `stationery` VALUES (3, 'Bút bi xanh', 'Hộp', 1, 1, NULL, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `stationery` VALUES (4, ' Bìa đựng hồ sơ', 'Cái', 4, 3, NULL, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `stationery` VALUES (5, 'Bấm ghim giấy', 'Cái', 1, 2, NULL, '2021-12-07 13:31:32', '2021-12-07 13:31:32');
INSERT INTO `stationery` VALUES (6, 'Kẹp giấy 15 mm', 'Hộp', 2, 2, NULL, '2021-12-07 13:31:33', '2021-12-07 13:31:33');
INSERT INTO `stationery` VALUES (7, 'Bút xóa nước', 'Cái', 1, 1, NULL, '2021-12-07 13:31:33', '2021-12-07 13:31:33');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NULL DEFAULT NULL,
  `id_card` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_role` tinyint UNSIGNED NOT NULL,
  `id_department` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_id_role_foreign`(`id_role`) USING BTREE,
  INDEX `users_id_department_foreign`(`id_department`) USING BTREE,
  CONSTRAINT `users_id_department_foreign` FOREIGN KEY (`id_department`) REFERENCES `department` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5050001', 'Nguyễn văn A', '1977-01-01', '201201201', '0123456789', 'admin@ute.udn.vn', '$2y$10$BiUPVIlyqDzHasufBcL2fulkXNB.CDTRbm9LBerj9KN3vf30/VpSG', NULL, '2021-12-07 13:31:08', '2021-12-07 13:31:08', 1, 'PCSVC', NULL);
INSERT INTO `users` VALUES ('5050002', 'Nguyễn Hữu Tuấn', '1977-01-01', '201818606', '0123456789', '1811505310350@sv.ute.udn.vn', '$2y$10$ivaxsNzsOMwhrFH5imJeNOb6lyCQQU7c36jbboaBP8YE4JlWTMlBO', NULL, '2021-12-07 13:31:08', '2021-12-07 13:52:00', 2, 'PCSVC', '$2y$10$qEgtmI86cgM66Gq3T49IpuVQy7l9pR5V5P4WVXK1SkMHWSB1rIoUa');
INSERT INTO `users` VALUES ('5050003', 'Trần Hoàng Vũ', '1985-01-31', '201201202', '0123456789', 'vu123@ute.udn.vn', '$2y$10$x6gA9ZnIWDz4qUceunBuuuOWTAiWTr.MhCVwG0W4v8TYuipZvRAJa', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 3, 'KD', NULL);
INSERT INTO `users` VALUES ('5050004', 'Nguyễn Thị Hà Quyên', '1977-01-01', '201201201', '0123456789', 'quyen123@ute.udn.vn', '$2y$10$WOny6.tyeikc0DiIj3gpYOavHhS1bNXSvEQZ5XyiXUD7Q6GyBHf1C', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 4, 'KD', NULL);
INSERT INTO `users` VALUES ('5050005', 'Trần Bửu Dung', '1985-02-01', '201201203', '0123456790', 'dung123@ute.udn.vn', '$2y$10$UmWUtSOcTLB6KuCRkWe74.dP.GbXStKbDvS7U/HVYl5Utk.XrJbu6', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 4, 'KD', NULL);
INSERT INTO `users` VALUES ('5050006', 'Hoàng Thị Mỹ Lệ', '1985-02-02', '201201204', '0123456791', 'le123@ute.udn.vn', '$2y$10$FzC2kdtVQdKmbUTp4bl6pebbbNJHlzV0WCBIdt8bzaDdIF0p87N4S', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 4, 'KD', NULL);
INSERT INTO `users` VALUES ('5050007', 'Nguyễn Văn B', '1985-02-03', '201201205', '0123456792', 'b123@ute.udn.vn', '$2y$10$M3yEZp6py.ufT74YK20OjOq2NvOlGw90QyzU9NlrrjyEsogTM25r6', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 3, 'PCSVC', NULL);
INSERT INTO `users` VALUES ('5050008', 'Trần Hòa', '1985-02-04', '201201206', '0123456793', 'hoa123@ute.udn.vn', '$2y$10$MUqOaRHFl406kDqh5aBpWe3u6DNxoC66vlB36kAQ9/xU5LnKdwvXa', 'eNsUWtqq00LEEVXq5R5B7SCgbSkvA5MHpxrkEVHViomRFwc87QEbtWFmPnd3', '2021-12-07 13:33:11', '2021-12-07 13:33:11', 2, 'PCSVC', NULL);
INSERT INTO `users` VALUES ('5050009', 'Lê Thu', '1985-02-05', '201201207', '0123456794', 'thu123@ute.udn.vn', '$2y$10$9nl8GMAXPNzvZiCAgDNlYuETGJA4F4K7f3zam8ze.00GU1woD2chC', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 2, 'PCSVC', NULL);
INSERT INTO `users` VALUES ('5050010', 'Nguyễn Văn C', '1985-02-06', '201201207', '0123456795', 'c123@ute.udn.vn', '$2y$10$UJ.R.qPTES3ObUOuilte5ez62OtfAMxATPNYNKz6aPvRBPd.nVV4y', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 3, 'KXD', NULL);
INSERT INTO `users` VALUES ('5050011', 'Huỳnh Sinh', '1985-02-07', '201201207', '0123456796', 'sinh123@ute.udn.vn', '$2y$10$TBnY6vNGlzTIA0hXxfSGxOXsEIMZ/6.g2qLnWOem/DJckSJsaiJtq', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 4, 'KXD', NULL);
INSERT INTO `users` VALUES ('5050012', 'Trần Long', '1985-02-08', '201201207', '0123456797', 'long123@ute.udn.vn', '$2y$10$lFYVkLlMYPpVCmD9xezgbuv3vCdIo0KfxyxTs71uoqCLW3IMW/Th.', NULL, '2021-12-07 13:33:11', '2021-12-07 13:33:11', 4, 'KXD', NULL);
INSERT INTO `users` VALUES ('5050013', 'Lê Long', '1985-02-09', '201201208', '0123123453', 'long456@ute.udn.vn', '$2y$10$3AZzLiSmVjOXqagZKRTl5.uIBwBOM8D0LbLsCzX3rMTTQivUdUx8K', NULL, '2021-12-07 13:33:12', '2021-12-07 13:33:12', 4, 'PDT', NULL);
INSERT INTO `users` VALUES ('5050014', 'Nguyễn Cảnh', '1985-02-10', '201201209', '0123124556', 'canh123@ute.udn.vn', '$2y$10$XHQ0ckwwizsHW/oDiCrql.WfyiOirXCWrEcJs3G.a7vItfpLYZqFy', NULL, '2021-12-07 13:33:12', '2021-12-07 13:33:12', 3, 'KCNHH', NULL);
INSERT INTO `users` VALUES ('5050015', 'Đào Hòa', '1985-02-11', '201201210', '0123415123', 'dao123@ute.udn.vn', '$2y$10$SL0glXSJ0MfQyQ.LD2wgpOTBsq7nE7eh0Zw89kjw5dsMhMvM9kBxO', NULL, '2021-12-07 13:33:12', '2021-12-07 13:33:12', 3, 'KSPCN', NULL);
INSERT INTO `users` VALUES ('5050016', 'Lê Lai', '1985-02-12', '201201211', '0123415124', 'lai123@ute.udn.vn', '$2y$10$cZcfth7L8Oxjq..93yqqteQTOS1dG.puOiLqSwmJdPlXnPe7c7C/a', NULL, '2021-12-07 13:33:12', '2021-12-07 13:33:12', 3, 'PDT', NULL);
INSERT INTO `users` VALUES ('5050017', 'Nguyễn Hồng', '1985-02-13', '201201212', '0123415125', 'hong123@ute.udn.vn', '$2y$10$.iayiiqTOEl3fPOqyicMcuW3xbhZUktJGNHJyw/WMrDiGJJBx/nfW', NULL, '2021-12-07 13:33:12', '2021-12-07 13:33:12', 4, 'PDT', NULL);
INSERT INTO `users` VALUES ('5050018', 'Đào Thường', '1985-02-14', '201201213', '0123415126', 'thuong123@ute.udn.vn', '$2y$10$1gr9k3dJ5/SqH926fkaxtOkwFzp0Pb5G.nLnP3oS2bnC2Le19w4iu', NULL, '2021-12-07 13:33:12', '2021-12-07 13:33:12', 4, 'PDT', NULL);

SET FOREIGN_KEY_CHECKS = 1;

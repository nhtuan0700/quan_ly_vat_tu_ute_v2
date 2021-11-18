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

 Date: 16/11/2021 14:54:17
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
  `qty` int NOT NULL,
  `cost` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_note`, `id_stationery`) USING BTREE,
  INDEX `detail_buy_id_stationery_foreign`(`id_stationery`) USING BTREE,
  CONSTRAINT `detail_buy_id_note_foreign` FOREIGN KEY (`id_note`) REFERENCES `request_note` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_buy_id_stationery_foreign` FOREIGN KEY (`id_stationery`) REFERENCES `stationery` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_buy
-- ----------------------------
INSERT INTO `detail_buy` VALUES ('PM1121001', 1, 2, NULL);
INSERT INTO `detail_buy` VALUES ('PM1121001', 2, 7, NULL);
INSERT INTO `detail_buy` VALUES ('PM1121001', 3, 5, NULL);
INSERT INTO `detail_buy` VALUES ('PM1121001', 7, 2, NULL);
INSERT INTO `detail_buy` VALUES ('PM1121002', 3, 3, 111111);
INSERT INTO `detail_buy` VALUES ('PM1121002', 4, 6, 22222);
INSERT INTO `detail_buy` VALUES ('PM1121002', 5, 3, 3333);
INSERT INTO `detail_buy` VALUES ('PM1121002', 7, 1, 44444);
INSERT INTO `detail_buy` VALUES ('PM1121003', 2, 4, NULL);
INSERT INTO `detail_buy` VALUES ('PM1121003', 4, 2, NULL);
INSERT INTO `detail_buy` VALUES ('PM1121003', 5, 6, NULL);

-- ----------------------------
-- Table structure for detail_fix
-- ----------------------------
DROP TABLE IF EXISTS `detail_fix`;
CREATE TABLE `detail_fix`  (
  `id_note` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_equipment` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cost` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_note`, `id_equipment`) USING BTREE,
  INDEX `detail_fix_id_equipment_foreign`(`id_equipment`) USING BTREE,
  CONSTRAINT `detail_fix_id_equipment_foreign` FOREIGN KEY (`id_equipment`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_fix_id_note_foreign` FOREIGN KEY (`id_note`) REFERENCES `request_note` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_fix
-- ----------------------------
INSERT INTO `detail_fix` VALUES ('PS1121001', 'TB000001', 'Không hiển thị', 100000);
INSERT INTO `detail_fix` VALUES ('PS1121001', 'TB000002', 'Không hiển thị', NULL);
INSERT INTO `detail_fix` VALUES ('PS1121002', 'TB000007', 'Không hoạt động', NULL);
INSERT INTO `detail_fix` VALUES ('PS1121003', 'TB000005', 'Bị hư', NULL);
INSERT INTO `detail_fix` VALUES ('PS1121003', 'TB000007', 'Không lên đèn', NULL);

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
INSERT INTO `equipment` VALUES ('TB000001', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', '2020-05-01', '2016-01-01', 1, NULL, '2021-11-15 21:21:11', '2021-11-16 14:01:23');
INSERT INTO `equipment` VALUES ('TB000002', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', '2019-05-01', '2016-01-01', 3, NULL, '2021-11-15 21:21:11', '2021-11-16 14:00:20');
INSERT INTO `equipment` VALUES ('TB000003', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', '2019-05-02', '2016-01-01', 1, NULL, '2021-11-15 21:21:11', '2021-11-15 21:21:11');
INSERT INTO `equipment` VALUES ('TB000004', 'Chuột logitech', 'Phòng thực hành máy tính số 1', '2019-05-03', '2016-01-01', 1, NULL, '2021-11-15 21:21:11', '2021-11-15 21:21:11');
INSERT INTO `equipment` VALUES ('TB000005', 'Chuột logitech', 'Phòng thực hành máy tính số 1', '2020-05-01', '2017-01-01', 2, NULL, '2021-11-15 21:21:11', '2021-11-16 14:37:39');
INSERT INTO `equipment` VALUES ('TB000006', 'Chuột logitech', 'Phòng thực hành máy tính số 1', '2020-05-01', '2017-01-02', 1, NULL, '2021-11-15 21:21:11', '2021-11-15 21:21:11');
INSERT INTO `equipment` VALUES ('TB000007', 'Máy chiếu', 'Phòng thực hành máy tính số 1', '2020-05-01', '2017-01-03', 2, NULL, '2021-11-15 21:21:11', '2021-11-16 14:37:39');
INSERT INTO `equipment` VALUES ('TB000008', 'Máy chiếu', 'Phòng thực hành máy tính số 2', '2020-04-01', '2017-01-04', 1, NULL, '2021-11-15 21:21:11', '2021-11-15 21:21:11');
INSERT INTO `equipment` VALUES ('TB000009', 'Máy chiếu', 'Phòng thực hành máy tính số 3', '2020-04-02', '2017-01-05', 1, NULL, '2021-11-15 21:21:11', '2021-11-15 21:21:11');

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
-- Table structure for limit_stationery
-- ----------------------------
DROP TABLE IF EXISTS `limit_stationery`;
CREATE TABLE `limit_stationery`  (
  `id_user` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_stationery` bigint UNSIGNED NOT NULL,
  `qty_used` int NOT NULL,
  `qty_max` int NOT NULL,
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
INSERT INTO `limit_stationery` VALUES ('5050001', 1, 0, 2, 3, 2021, '2021-11-14 08:59:37', '2021-11-14 08:59:37');
INSERT INTO `limit_stationery` VALUES ('5050001', 2, 0, 4, 3, 2021, '2021-11-14 08:59:37', '2021-11-14 08:59:37');
INSERT INTO `limit_stationery` VALUES ('5050001', 3, 2, 2, 3, 2021, '2021-11-14 08:59:37', '2021-11-14 09:03:28');
INSERT INTO `limit_stationery` VALUES ('5050001', 4, 5, 5, 3, 2021, '2021-11-14 08:59:37', '2021-11-14 09:03:28');
INSERT INTO `limit_stationery` VALUES ('5050001', 5, 1, 5, 3, 2021, '2021-11-14 08:59:37', '2021-11-14 09:03:28');
INSERT INTO `limit_stationery` VALUES ('5050001', 6, 0, 5, 3, 2021, '2021-11-14 08:59:37', '2021-11-14 08:59:37');
INSERT INTO `limit_stationery` VALUES ('5050001', 7, 0, 2, 3, 2021, '2021-11-14 08:59:37', '2021-11-14 08:59:37');
INSERT INTO `limit_stationery` VALUES ('5050002', 1, 1, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-15 21:31:00');
INSERT INTO `limit_stationery` VALUES ('5050002', 2, 3, 4, 3, 2021, '2021-11-14 09:00:04', '2021-11-15 21:31:00');
INSERT INTO `limit_stationery` VALUES ('5050002', 3, 2, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-15 21:31:00');
INSERT INTO `limit_stationery` VALUES ('5050002', 4, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050002', 5, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050002', 6, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050002', 7, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050003', 1, 1, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:04:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 2, 4, 4, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:04:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 3, 1, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:04:11');
INSERT INTO `limit_stationery` VALUES ('5050003', 4, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050003', 5, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050003', 6, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050003', 7, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050004', 1, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050004', 2, 0, 4, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050004', 3, 2, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:04:32');
INSERT INTO `limit_stationery` VALUES ('5050004', 4, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050004', 5, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050004', 6, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050004', 7, 2, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:04:32');
INSERT INTO `limit_stationery` VALUES ('5050005', 1, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050005', 2, 0, 4, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050005', 3, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050005', 4, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050005', 5, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050005', 6, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050005', 7, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050006', 1, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050006', 2, 0, 4, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050006', 3, 1, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:21:02');
INSERT INTO `limit_stationery` VALUES ('5050006', 4, 1, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:21:02');
INSERT INTO `limit_stationery` VALUES ('5050006', 5, 1, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:21:02');
INSERT INTO `limit_stationery` VALUES ('5050006', 6, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050006', 7, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050007', 1, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050007', 2, 0, 4, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050007', 3, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050007', 4, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050007', 5, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050007', 6, 0, 5, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050007', 7, 0, 2, 3, 2021, '2021-11-14 09:00:04', '2021-11-14 09:00:04');
INSERT INTO `limit_stationery` VALUES ('5050008', 1, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050008', 2, 0, 4, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050008', 3, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050008', 4, 0, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050008', 5, 1, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:06:25');
INSERT INTO `limit_stationery` VALUES ('5050008', 6, 0, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050008', 7, 1, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:06:25');
INSERT INTO `limit_stationery` VALUES ('5050009', 1, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050009', 2, 4, 4, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:55:35');
INSERT INTO `limit_stationery` VALUES ('5050009', 3, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050009', 4, 1, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:55:35');
INSERT INTO `limit_stationery` VALUES ('5050009', 5, 5, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:55:35');
INSERT INTO `limit_stationery` VALUES ('5050009', 6, 0, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050009', 7, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050010', 1, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050010', 2, 0, 4, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050010', 3, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050010', 4, 0, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050010', 5, 0, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050010', 6, 0, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050010', 7, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-14 09:00:05');
INSERT INTO `limit_stationery` VALUES ('5050011', 1, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-15 21:41:19');
INSERT INTO `limit_stationery` VALUES ('5050011', 2, 0, 4, 3, 2021, '2021-11-14 09:00:05', '2021-11-15 21:41:19');
INSERT INTO `limit_stationery` VALUES ('5050011', 3, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-15 21:41:19');
INSERT INTO `limit_stationery` VALUES ('5050011', 4, 1, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-15 21:41:19');
INSERT INTO `limit_stationery` VALUES ('5050011', 5, 1, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-15 21:41:19');
INSERT INTO `limit_stationery` VALUES ('5050011', 6, 0, 5, 3, 2021, '2021-11-14 09:00:05', '2021-11-15 21:41:19');
INSERT INTO `limit_stationery` VALUES ('5050011', 7, 0, 2, 3, 2021, '2021-11-14 09:00:05', '2021-11-15 21:41:19');
INSERT INTO `limit_stationery` VALUES ('5050012', 1, 0, 2, 3, 2021, '2021-11-15 21:42:48', '2021-11-15 21:42:48');
INSERT INTO `limit_stationery` VALUES ('5050012', 2, 0, 4, 3, 2021, '2021-11-15 21:42:48', '2021-11-15 21:42:48');
INSERT INTO `limit_stationery` VALUES ('5050012', 3, 0, 2, 3, 2021, '2021-11-15 21:42:48', '2021-11-15 21:42:48');
INSERT INTO `limit_stationery` VALUES ('5050012', 4, 0, 5, 3, 2021, '2021-11-15 21:42:48', '2021-11-15 21:42:48');
INSERT INTO `limit_stationery` VALUES ('5050012', 5, 0, 5, 3, 2021, '2021-11-15 21:42:48', '2021-11-15 21:42:48');
INSERT INTO `limit_stationery` VALUES ('5050012', 6, 0, 5, 3, 2021, '2021-11-15 21:42:48', '2021-11-15 21:42:48');
INSERT INTO `limit_stationery` VALUES ('5050012', 7, 0, 2, 3, 2021, '2021-11-15 21:42:48', '2021-11-15 21:42:48');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `period_registration` VALUES ('121', '2021-10-01 00:00:00', '2021-11-03 23:59:00', '2021-11-14 09:00:54', '2021-11-14 09:00:54');
INSERT INTO `period_registration` VALUES ('221', '2021-11-17 00:00:00', '2021-11-23 23:59:00', '2021-11-16 10:56:06', '2021-11-16 10:56:06');

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
  `qty` int NOT NULL,
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
INSERT INTO `registration` VALUES ('5050001', 3, '121', 2, NULL, '2021-11-14 09:03:28', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050001', 4, '121', 5, NULL, '2021-11-14 09:03:28', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050001', 5, '121', 1, NULL, '2021-11-14 09:03:28', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050002', 1, '121', 1, NULL, '2021-11-15 21:31:00', '2021-11-15 21:31:00', 'PM1121001');
INSERT INTO `registration` VALUES ('5050002', 2, '121', 3, NULL, '2021-11-15 21:31:00', '2021-11-15 21:31:00', 'PM1121001');
INSERT INTO `registration` VALUES ('5050002', 3, '121', 2, NULL, '2021-11-15 21:31:00', '2021-11-15 21:31:00', 'PM1121001');
INSERT INTO `registration` VALUES ('5050003', 1, '121', 1, NULL, '2021-11-14 09:04:11', '2021-11-14 09:16:13', 'PM1121001');
INSERT INTO `registration` VALUES ('5050003', 2, '121', 4, NULL, '2021-11-14 09:04:11', '2021-11-14 09:16:13', 'PM1121001');
INSERT INTO `registration` VALUES ('5050003', 3, '121', 1, NULL, '2021-11-14 09:04:11', '2021-11-14 09:16:13', 'PM1121001');
INSERT INTO `registration` VALUES ('5050004', 3, '121', 2, NULL, '2021-11-14 09:04:32', '2021-11-14 09:56:03', 'PM1121001');
INSERT INTO `registration` VALUES ('5050004', 7, '121', 2, NULL, '2021-11-14 09:04:32', '2021-11-14 09:56:03', 'PM1121001');
INSERT INTO `registration` VALUES ('5050006', 3, '121', 1, NULL, '2021-11-14 09:21:02', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050006', 4, '121', 1, NULL, '2021-11-14 09:21:02', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050006', 5, '121', 1, NULL, '2021-11-14 09:21:02', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050008', 5, '121', 1, NULL, '2021-11-14 09:06:25', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050008', 7, '121', 1, NULL, '2021-11-14 09:06:25', '2021-11-14 09:34:27', 'PM1121002');
INSERT INTO `registration` VALUES ('5050009', 2, '121', 4, NULL, '2021-11-14 09:55:35', '2021-11-16 10:49:59', 'PM1121003');
INSERT INTO `registration` VALUES ('5050009', 4, '121', 1, NULL, '2021-11-14 09:55:35', '2021-11-16 10:49:59', 'PM1121003');
INSERT INTO `registration` VALUES ('5050009', 5, '121', 5, NULL, '2021-11-14 09:55:35', '2021-11-16 10:49:59', 'PM1121003');
INSERT INTO `registration` VALUES ('5050011', 4, '121', 1, NULL, '2021-11-14 09:06:02', '2021-11-16 10:49:59', 'PM1121003');
INSERT INTO `registration` VALUES ('5050011', 5, '121', 1, NULL, '2021-11-14 09:06:02', '2021-11-16 10:49:59', 'PM1121003');

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
INSERT INTO `request_note` VALUES ('PM1121001', '5050002', NULL, '121', 'KD', NULL, 1, 1, NULL, '2021-11-14 09:16:13', '2021-11-14 09:16:13');
INSERT INTO `request_note` VALUES ('PM1121002', '5050006', '5050007', '121', 'PCSVC', '2021-11-16 13:12:53', 1, 2, 'abc', '2021-11-14 09:34:27', '2021-11-16 13:12:53');
INSERT INTO `request_note` VALUES ('PM1121003', '5050009', NULL, '121', 'KXD', NULL, 1, 1, 'abcc', '2021-11-16 10:49:59', '2021-11-16 10:49:59');
INSERT INTO `request_note` VALUES ('PS1121001', '5050003', '5050007', NULL, 'KD', '2021-11-16 13:24:59', 0, 2, 'a123', '2021-11-14 10:27:30', '2021-11-16 13:24:59');
INSERT INTO `request_note` VALUES ('PS1121002', '5050005', '5050007', NULL, 'KD', '2021-11-16 13:46:14', 0, 4, NULL, '2021-11-14 10:40:39', '2021-11-16 13:46:14');
INSERT INTO `request_note` VALUES ('PS1121003', '5050003', NULL, NULL, 'KD', NULL, 0, 1, NULL, '2021-11-16 11:53:22', '2021-11-16 14:37:39');

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
  `limit_avg` int NOT NULL,
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
INSERT INTO `stationery` VALUES (1, 'Giấy A4', 'Ram', 2, 2, NULL, NULL, NULL);
INSERT INTO `stationery` VALUES (2, 'Phấn viên', 'Hộp', 4, 4, NULL, NULL, NULL);
INSERT INTO `stationery` VALUES (3, 'Bút bi xanh', 'Hộp', 2, 1, NULL, NULL, NULL);
INSERT INTO `stationery` VALUES (4, ' Bìa đựng hồ sơ', 'Cái', 5, 3, NULL, NULL, NULL);
INSERT INTO `stationery` VALUES (5, 'Bấm ghim giấy', 'Cái', 5, 2, NULL, NULL, NULL);
INSERT INTO `stationery` VALUES (6, 'Kẹp giấy 15 mm', 'Hộp', 5, 2, NULL, NULL, NULL);
INSERT INTO `stationery` VALUES (7, 'Bút xóa nước', 'Cái', 2, 1, NULL, NULL, NULL);

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
INSERT INTO `users` VALUES ('5050001', 'Nguyễn văn A', '1977-01-01', '201201201', '0123456789', 'admin@ute.udn.vn', '$2y$10$XEDfutJrcXoW/06f8RK5KezgQjx34g0O/PNHFYKG7PlCj97Mm2wCy', NULL, '2021-11-15 21:13:32', '2021-11-15 21:13:32', 1, 'PCSVC');
INSERT INTO `users` VALUES ('5050002', 'Trần Hoàng Vũ', '1985-01-31', '201201202', '0123456789', 'vu123@ute.udn.vn', '$2y$10$Fk0dFbtHz41bcuu3hw.aTucV4q98Jtor3/hIS2IGlOaCHKcVH6JyK', NULL, '2021-11-15 21:14:22', '2021-11-15 21:14:22', 3, 'KD');
INSERT INTO `users` VALUES ('5050003', 'Nguyễn Thị Hà Quyên', '1977-01-01', '201201201', '0123456789', 'quyen123@ute.udn.vn', '$2y$10$snpaClkxXB8CxBFWknVlhOil/WVbOgcPT.FtZRmU2idOraDGHQrWu', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 4, 'KD');
INSERT INTO `users` VALUES ('5050004', 'Trần Bửu Dung', '1985-02-01', '201201203', '0123456790', 'dung123@ute.udn.vn', '$2y$10$bErj940z/rkr6FT2wCpMGuYFQuy2rGOdm7Vp1/6NxDTDhT2K3T5/a', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 4, 'KD');
INSERT INTO `users` VALUES ('5050005', 'Hoàng Thị Mỹ Lệ', '1985-02-02', '201201204', '0123456791', 'le123@ute.udn.vn', '$2y$10$ojIrO6Up0Z8YQrL7QBELbe3K3vaZD5PJciq0KI/DOnkyU6hs.X2Sa', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 4, 'KD');
INSERT INTO `users` VALUES ('5050006', 'Nguyễn Văn B', '1985-02-03', '201201205', '0123456792', 'b123@ute.udn.vn', '$2y$10$D25NYj3jYOU4hWffNw9ifusClK68LsktZ9eRWjIzuJ0.rEqDZvc/u', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 3, 'PCSVC');
INSERT INTO `users` VALUES ('5050007', 'Trần Hòa', '1985-02-04', '201201206', '0123456793', 'hoa123@ute.udn.vn', '$2y$10$no3954v182W2nMwnKLVTou2dA6vU/OF.L/56EMhIP4LY.NwIsbuVS', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 2, 'PCSVC');
INSERT INTO `users` VALUES ('5050008', 'Lê Thu', '1985-02-05', '201201207', '0123456794', 'thu123@ute.udn.vn', '$2y$10$aCOMurb25RIMChtRIJDw0OmnliePjkTzOS4F1wuMNIBVIJpTA23FG', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 2, 'PCSVC');
INSERT INTO `users` VALUES ('5050009', 'Nguyễn Văn C', '1985-02-06', '201201207', '0123456795', 'c123@ute.udn.vn', '$2y$10$H4EaX4JK7yuZIsIujL7z5uPafj5x5lDNL4TvBxwBdPJQ1oFt/KTl2', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 3, 'KXD');
INSERT INTO `users` VALUES ('5050010', 'Huỳnh Sinh', '1985-02-07', '201201207', '0123456796', 'sinh123@ute.udn.vn', '$2y$10$BvjZyJWLu5ait3NMt4hHj.msUxMMnsedhGwGkxaTPOF67AeET91WG', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 4, 'KXD');
INSERT INTO `users` VALUES ('5050011', 'Trần Long', '1985-02-08', '201201207', '0123456797', 'long123@ute.udn.vn', '$2y$10$5JRt2ufssR6hns697xuwLeHOvKkDahC6ROhPSeY/HLu7O832qRETK', NULL, '2021-11-15 21:14:23', '2021-11-15 21:14:23', 4, 'KXD');
INSERT INTO `users` VALUES ('5050012', 'abc', '2000-11-15', '201201201', '0702076081', 'abc@gmail.com', '$2y$10$MsSrP8a3eUHZvZNO5TNb.Op1iQqmypIehOFrnj9TNquvJw4c3WOzK', NULL, '2021-11-15 21:42:48', '2021-11-15 21:42:48', 3, 'KCNHH');

SET FOREIGN_KEY_CHECKS = 1;

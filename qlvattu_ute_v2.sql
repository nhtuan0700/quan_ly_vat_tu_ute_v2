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

 Date: 04/11/2021 17:41:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for danhmuc
-- ----------------------------
DROP TABLE IF EXISTS `danhmuc`;
CREATE TABLE `danhmuc`  (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of danhmuc
-- ----------------------------
INSERT INTO `danhmuc` VALUES (1, 'Bút', NULL, NULL);
INSERT INTO `danhmuc` VALUES (2, 'Giấy', NULL, NULL);
INSERT INTO `danhmuc` VALUES (3, 'Bìa', NULL, NULL);
INSERT INTO `danhmuc` VALUES (4, 'Phấn', NULL, NULL);

-- ----------------------------
-- Table structure for donvi
-- ----------------------------
DROP TABLE IF EXISTS `donvi`;
CREATE TABLE `donvi`  (
  `id` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_khoa` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of donvi
-- ----------------------------
INSERT INTO `donvi` VALUES ('KCK', 'Khoa Cơ Khí', 1, NULL, NULL);
INSERT INTO `donvi` VALUES ('KCNHH', 'Khoa Công Nghệ Hóa Học - Môi Trường', 1, NULL, NULL);
INSERT INTO `donvi` VALUES ('KD', 'Khoa Điện', 1, NULL, NULL);
INSERT INTO `donvi` VALUES ('KSPCN', 'Khoa Sư Phạm Công Nghiệp', 1, NULL, NULL);
INSERT INTO `donvi` VALUES ('KXD', 'Khoa Kỹ Thuật Xây Dựng', 1, NULL, NULL);
INSERT INTO `donvi` VALUES ('PCSVC', 'Phòng Cơ Sở Vật Chất', 0, NULL, NULL);
INSERT INTO `donvi` VALUES ('PCTSV', 'Phòng Công Tác Sinh Viên', 0, NULL, NULL);
INSERT INTO `donvi` VALUES ('PDT', 'Phòng Đào Tạo', 0, NULL, NULL);

-- ----------------------------
-- Table structure for dotdangky
-- ----------------------------
DROP TABLE IF EXISTS `dotdangky`;
CREATE TABLE `dotdangky`  (
  `id` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dotdangky
-- ----------------------------
INSERT INTO `dotdangky` VALUES ('121', '2021-03-03 00:00:00', '2021-03-20 23:59:00', '2021-11-03 15:55:09', '2021-11-03 16:28:03');
INSERT INTO `dotdangky` VALUES ('221', '2021-11-04 00:00:00', '2021-11-19 23:59:00', '2021-11-03 17:01:42', '2021-11-03 17:40:31');

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
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `migrations` VALUES (8, '2021_10_27_101820_create_don_vi_table', 1);
INSERT INTO `migrations` VALUES (9, '2021_10_27_102042_add_id_don_vi_to_users_table', 1);
INSERT INTO `migrations` VALUES (10, '2021_10_31_192403_create_vanphongpham_table', 1);
INSERT INTO `migrations` VALUES (11, '2021_10_31_200826_create_danhmuc_table', 1);
INSERT INTO `migrations` VALUES (12, '2021_10_31_200953_add_id_danhmuc_to_vanphongpham_table', 1);
INSERT INTO `migrations` VALUES (15, '2021_11_03_143737_create_dotdangky_table', 2);
INSERT INTO `migrations` VALUES (16, '2021_11_03_175613_create_thietbi_table', 3);

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
INSERT INTO `permission` VALUES (3, 'vattu-manage', 'Quản lý vật tư');
INSERT INTO `permission` VALUES (4, 'dk-manage', 'Quản lý đợt đăng ký văn phòng phẩm');
INSERT INTO `permission` VALUES (5, 'hanmuc-manage', 'Quản lý hạn mức');
INSERT INTO `permission` VALUES (6, 'phieu-confirm', 'Xét duyệt phiếu đề nghị');
INSERT INTO `permission` VALUES (7, 'phieubangiao-manage', 'Quản lý phiếu bàn giao');
INSERT INTO `permission` VALUES (8, 'phieumua-manage', 'Quản lý phiếu mua');
INSERT INTO `permission` VALUES (9, 'dk-confirm', 'Bàn giao văn phòng phẩm đăng ký');

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
INSERT INTO `role` VALUES (3, 'Nhân viên quản lý vật tư');
INSERT INTO `role` VALUES (4, 'Giảng viên/Cán bộ');

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
-- Table structure for thietbi
-- ----------------------------
DROP TABLE IF EXISTS `thietbi`;
CREATE TABLE `thietbi`  (
  `id` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phong` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of thietbi
-- ----------------------------
INSERT INTO `thietbi` VALUES ('TB000001', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000002', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000003', 'Màn hình Dell', 'Phòng thực hành máy tính số 1', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000004', 'Chuột logitech', 'Phòng thực hành máy tính số 1', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000005', 'Chuột logitech', 'Phòng thực hành máy tính số 1', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000006', 'Chuột logitech', 'Phòng thực hành máy tính số 1', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000007', 'Máy chiếu', 'Phòng thực hành máy tính số 1', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000008', 'Máy chiếu', 'Phòng thực hành máy tính số 2', NULL, '2021-11-04 16:50:14', '2021-11-04 16:50:14');
INSERT INTO `thietbi` VALUES ('TB000009', 'Máy chiếu', 'Phòng thực hành máy tính số 3', NULL, '2021-11-04 16:50:14', '2021-11-04 17:02:25');
INSERT INTO `thietbi` VALUES ('TB000010', 'Máy in', 'Phòng thực hành số 4', NULL, '2021-11-04 17:08:43', '2021-11-04 17:11:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `cmnd` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_role` tinyint UNSIGNED NOT NULL,
  `id_donvi` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_id_role_foreign`(`id_role`) USING BTREE,
  INDEX `users_id_donvi_foreign`(`id_donvi`) USING BTREE,
  CONSTRAINT `users_id_donvi_foreign` FOREIGN KEY (`id_donvi`) REFERENCES `donvi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Ngô Tấn Thống', '1977-01-01', '201201201', '0123456789', 'admin@ute.udn.vn', '$2y$10$ESQ4/Fq/Cq4Vd/VlsFIbQuV.5z4oF1cGCR0ptFK4onE.pEzFjhBs2', 'sSVpmLJTGgZZ7dUnXTycLnZpBjTix3H2x75vXpdTMqFZroAExmOTgXqwz0Aj', NULL, NULL, 1, 'PCSVC');
INSERT INTO `users` VALUES (2, 'Nguyễn Thị Hà Quyên', '1985-01-31', '201201201', '0123456789', 'quyen_ute@ute.udn.vn', '$2y$10$IS66wmxQcdV0R19mwBUXl.HJDNvTEtNdyIuBHKZ2J.yiIQ3me2U42', NULL, NULL, NULL, 4, 'KD');

-- ----------------------------
-- Table structure for vanphongpham
-- ----------------------------
DROP TABLE IF EXISTS `vanphongpham`;
CREATE TABLE `vanphongpham`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dvt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hanmuc_tb` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_danhmuc` tinyint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `vanphongpham_id_danhmuc_foreign`(`id_danhmuc`) USING BTREE,
  CONSTRAINT `vanphongpham_id_danhmuc_foreign` FOREIGN KEY (`id_danhmuc`) REFERENCES `danhmuc` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vanphongpham
-- ----------------------------
INSERT INTO `vanphongpham` VALUES (1, 'Giấy A4', 'Ram', 2, NULL, NULL, NULL, 2);
INSERT INTO `vanphongpham` VALUES (2, 'Phấn viên', 'Hộp', 4, NULL, NULL, NULL, 4);
INSERT INTO `vanphongpham` VALUES (3, 'Bút bi xanh', 'Hộp', 2, NULL, NULL, NULL, 1);
INSERT INTO `vanphongpham` VALUES (4, ' Bìa đựng hồ sơ', 'Cái', 5, NULL, NULL, NULL, 3);
INSERT INTO `vanphongpham` VALUES (5, 'Bấm ghim giấy', 'Cái', 5, NULL, NULL, NULL, 2);
INSERT INTO `vanphongpham` VALUES (6, 'Kẹp giấy 15 mm', 'Hộp', 5, NULL, NULL, NULL, 2);
INSERT INTO `vanphongpham` VALUES (7, 'Bút xóa nước', 'Cái', 2, NULL, NULL, NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;

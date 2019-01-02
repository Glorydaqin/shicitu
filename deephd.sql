/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : localhost:33060
 Source Schema         : deephd

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 28/09/2018 10:19:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for catch_source
-- ----------------------------
DROP TABLE IF EXISTS `catch_source`;
CREATE TABLE `catch_source`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NULL DEFAULT NULL,
  `object_id` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` enum('movie','video') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'movie',
  `catch_log` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_id`(`source_id`, `type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38789 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mail
-- ----------------------------
DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `from` enum('123filming.com','123movie.video') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '123filming.com',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie
-- ----------------------------
DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imdb_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `source_id` int(11) NULL DEFAULT NULL COMMENT '源id',
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `title` json NULL,
  `original_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '原始名称',
  `original_language` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `poster_path` json NULL COMMENT '海报',
  `backdrop_path` json NULL COMMENT '背景图么',
  `adult` tinyint(4) NULL DEFAULT 0 COMMENT '是否成人片{1，是；0，否}',
  `overview` json NULL COMMENT '描述',
  `vote_count` int(11) NULL DEFAULT NULL COMMENT '评价数',
  `vote_average` decimal(5, 1) NULL DEFAULT NULL COMMENT '评分',
  `popularity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '热度',
  `revenue` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '收益（$）',
  `runtime` int(10) NULL DEFAULT NULL COMMENT '时长',
  `release_date` date NULL DEFAULT NULL COMMENT '发布日期',
  `trailer_key` json NULL COMMENT '预览视频的key',
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_connect` tinyint(1) NULL DEFAULT 0 COMMENT '是否关联，关联的网站才展示',
  `tagline` json NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `sync_at` datetime(0) NULL DEFAULT NULL COMMENT '同步ES时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_id`(`source_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19173 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_bt
-- ----------------------------
DROP TABLE IF EXISTS `movie_bt`;
CREATE TABLE `movie_bt`  (
  `imdb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_cast
-- ----------------------------
DROP TABLE IF EXISTS `movie_cast`;
CREATE TABLE `movie_cast`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NULL DEFAULT NULL COMMENT '源id',
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` json NULL COMMENT '演员',
  `profile_path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '头像图片',
  `gender` tinyint(4) NULL DEFAULT 0 COMMENT '性别',
  `count` int(11) NULL DEFAULT 0 COMMENT '总数',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_id`(`source_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108678 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '演员' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_cast_mapping
-- ----------------------------
DROP TABLE IF EXISTS `movie_cast_mapping`;
CREATE TABLE `movie_cast_mapping`  (
  `movie_id` int(11) NOT NULL,
  `cast_id` int(11) NOT NULL,
  `character` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '角色',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  UNIQUE INDEX `movie_id`(`movie_id`, `cast_id`) USING BTREE,
  INDEX `cast_id`(`cast_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影-演员对应关系' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_company
-- ----------------------------
DROP TABLE IF EXISTS `movie_company`;
CREATE TABLE `movie_company`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NULL DEFAULT NULL COMMENT '源id',
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo_path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` json NULL COMMENT '公司名称',
  `origin_country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `count` int(11) NULL DEFAULT 0 COMMENT '总数',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_id`(`source_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10435 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影公司' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_company_mapping
-- ----------------------------
DROP TABLE IF EXISTS `movie_company_mapping`;
CREATE TABLE `movie_company_mapping`  (
  `movie_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  UNIQUE INDEX `movie_id`(`movie_id`, `company_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影-电影公司对应关系' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_country
-- ----------------------------
DROP TABLE IF EXISTS `movie_country`;
CREATE TABLE `movie_country`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NULL DEFAULT NULL COMMENT '源id',
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `iso` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'iso_3166_1',
  `name` json NULL COMMENT '国家名称',
  `count` int(11) NULL DEFAULT 0 COMMENT '总数',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `country_iso`(`iso`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 150 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影国家' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_country_mapping
-- ----------------------------
DROP TABLE IF EXISTS `movie_country_mapping`;
CREATE TABLE `movie_country_mapping`  (
  `movie_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  UNIQUE INDEX `movie_id`(`movie_id`, `country_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影-国家对应关系' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_crew
-- ----------------------------
DROP TABLE IF EXISTS `movie_crew`;
CREATE TABLE `movie_crew`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NULL DEFAULT NULL COMMENT '源id',
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` json NULL COMMENT '演员',
  `profile_path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '头像图片',
  `gender` tinyint(4) NULL DEFAULT 0 COMMENT '性别',
  `count` int(11) NULL DEFAULT 0 COMMENT '总数',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_id`(`source_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 80861 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '导演等其他人员' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_crew_mapping
-- ----------------------------
DROP TABLE IF EXISTS `movie_crew_mapping`;
CREATE TABLE `movie_crew_mapping`  (
  `movie_id` int(11) NOT NULL,
  `crew_id` int(11) NOT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '职责',
  `job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '岗位',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  UNIQUE INDEX `movie_id`(`movie_id`, `crew_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影-其他人员对应关系' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_genre
-- ----------------------------
DROP TABLE IF EXISTS `movie_genre`;
CREATE TABLE `movie_genre`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` json NULL COMMENT '类型名称',
  `count` int(11) NULL DEFAULT 0 COMMENT '总数',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_id`(`source_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '类型' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_genre_mapping
-- ----------------------------
DROP TABLE IF EXISTS `movie_genre_mapping`;
CREATE TABLE `movie_genre_mapping`  (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  UNIQUE INDEX `movie_id`(`movie_id`, `genre_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影-类型对应关系' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_image
-- ----------------------------
DROP TABLE IF EXISTS `movie_image`;
CREATE TABLE `movie_image`  (
  `movie_id` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `language` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `iso` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` enum('backdrop','poster') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'poster',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  UNIQUE INDEX `movie_id`(`movie_id`, `path`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '电影的剧照，海报' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_image_source
-- ----------------------------
DROP TABLE IF EXISTS `movie_image_source`;
CREATE TABLE `movie_image_source`  (
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '源地址',
  `type` enum('poster','profile','backdrop','logo') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'poster',
  `real_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '本地路径',
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file_size` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  UNIQUE INDEX `path`(`path`, `type`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '所以图片资源对应本地路径' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_keyword
-- ----------------------------
DROP TABLE IF EXISTS `movie_keyword`;
CREATE TABLE `movie_keyword`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` json NULL COMMENT '关键词名称',
  `count` int(11) NULL DEFAULT 0 COMMENT '总数',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `source_id`(`source_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10887 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '类型' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for movie_keyword_mapping
-- ----------------------------
DROP TABLE IF EXISTS `movie_keyword_mapping`;
CREATE TABLE `movie_keyword_mapping`  (
  `movie_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  UNIQUE INDEX `movie_id`(`movie_id`, `keyword_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '电影-类型对应关系' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : 自己的
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : 47.110.58.189:3306
 Source Schema         : jjc

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 11/04/2022 14:02:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_access
-- ----------------------------
DROP TABLE IF EXISTS `admin_access`;
CREATE TABLE `admin_access` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `admin_id` bigint(20) unsigned NOT NULL COMMENT 'admin id',
  `code_id` bigint(20) unsigned NOT NULL COMMENT '权限code id',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `key_id` (`code_id`),
  CONSTRAINT `admin_access_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `app_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_access_ibfk_2` FOREIGN KEY (`code_id`) REFERENCES `admin_code` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1536 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员权限表';

-- ----------------------------
-- Records of admin_access
-- ----------------------------
BEGIN;
INSERT INTO `admin_access` VALUES (1492, 10001, 100, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1493, 10001, 200, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1494, 10001, 300, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1495, 10001, 400, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1496, 10001, 1004, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1497, 10001, 1005, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1498, 10001, 1006, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1499, 10001, 1007, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1500, 10001, 1008, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1501, 10001, 1009, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1502, 10001, 1010, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1503, 10001, 1011, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1504, 10001, 500, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1505, 10001, 510, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1506, 10001, 511, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1507, 10001, 512, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1508, 10001, 520, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1509, 10001, 1029, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1510, 10001, 1030, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1511, 10001, 1031, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1512, 10001, 1032, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1513, 10001, 1033, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1514, 10001, 1034, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1515, 10001, 1035, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1516, 10001, 1036, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1517, 10001, 1037, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1518, 10001, 1038, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1519, 10001, 1039, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1520, 10001, 1040, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1521, 10001, 1041, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1522, 10001, 1042, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1523, 10001, 1043, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1524, 10001, 1044, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1525, 10001, 1045, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1526, 10001, 1046, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1527, 10001, 1047, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1528, 10001, 1048, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1529, 10001, 1049, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1530, 10001, 1050, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1531, 10001, 1051, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1532, 10001, 1052, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1533, 10001, 1053, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1534, 10001, 1054, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
INSERT INTO `admin_access` VALUES (1535, 10001, 1055, b'0', 0, '2021-11-10 02:59:03', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for admin_code
-- ----------------------------
DROP TABLE IF EXISTS `admin_code`;
CREATE TABLE `admin_code` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `parent_id` bigint(20) unsigned DEFAULT NULL COMMENT '父id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'code',
  `remarks` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `code` (`code`),
  KEY `admin_route_parent_id` (`parent_id`) USING BTREE,
  CONSTRAINT `admin_code_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `admin_code` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1056 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='后台权限code表';

-- ----------------------------
-- Records of admin_code
-- ----------------------------
BEGIN;
INSERT INTO `admin_code` VALUES (100, NULL, '主页', 'HOME', '123');
INSERT INTO `admin_code` VALUES (200, NULL, '用户管理', 'USER', NULL);
INSERT INTO `admin_code` VALUES (300, NULL, '信息管理', 'INFORMATION', NULL);
INSERT INTO `admin_code` VALUES (400, NULL, '权限管理', 'ADMIN', NULL);
INSERT INTO `admin_code` VALUES (500, NULL, '系统设置', 'SYSTEM', NULL);
INSERT INTO `admin_code` VALUES (510, 500, '系统设置', 'SYSTEM:SETTING:LIST', 'apps\\admin\\classier\\controller\\account\\system\\SettingController::getSettingList');
INSERT INTO `admin_code` VALUES (511, 500, '添加修改设置信息', 'SYSTEM:SETTING:ADDED', 'apps\\admin\\classier\\controller\\account\\system\\SettingController::addedSetting');
INSERT INTO `admin_code` VALUES (512, 500, '删除设置', 'SYSTEM:SETTING:DEL', 'apps\\admin\\classier\\controller\\account\\system\\SettingController::delSetting');
INSERT INTO `admin_code` VALUES (520, 500, '系统日志列表', 'SYSTEM:LOG:LIST', 'apps\\admin\\classier\\controller\\account\\SystemController::getLogList');
INSERT INTO `admin_code` VALUES (1004, 400, '修改是否超级管理员', 'ADMIN:SUPREME:SET', 'apps\\admin\\classier\\controller\\account\\AdminController::setIsSupreme');
INSERT INTO `admin_code` VALUES (1005, 400, '获取管理员', 'ADMIN:GET', 'apps\\admin\\classier\\controller\\account\\AdminController::getAdmin');
INSERT INTO `admin_code` VALUES (1006, 400, '删除管理员', 'ADMIN:DEL', 'apps\\admin\\classier\\controller\\account\\AdminController::delAdmin');
INSERT INTO `admin_code` VALUES (1007, 400, '管理员列表', 'ADMIN:LIST', 'apps\\admin\\classier\\controller\\account\\AdminController::getAdminList');
INSERT INTO `admin_code` VALUES (1008, 400, '添加编辑管理员', 'ADMIN:ADDED', 'apps\\admin\\classier\\controller\\account\\AdminController::addedAdmin');
INSERT INTO `admin_code` VALUES (1009, 400, '设置权限', 'ADMIN:ACCESS:SET', 'apps\\admin\\classier\\controller\\account\\AdminController::setAccessList');
INSERT INTO `admin_code` VALUES (1010, 400, '获取权限Code列表', 'ADMIN:ACCESS:CODE:LIST', 'apps\\admin\\classier\\controller\\account\\AccessController::getAccessCodeList');
INSERT INTO `admin_code` VALUES (1011, 400, '添加编辑权限code', 'ADMIN:ACCESS:CODE:ADDED', 'apps\\admin\\classier\\controller\\account\\AccessController::addedAccessCode');
INSERT INTO `admin_code` VALUES (1029, NULL, '登录记录', 'USER:LOGIN:LOGS', 'apps\\admin\\classier\\controller\\account\\UserController::getLoginLogs');
INSERT INTO `admin_code` VALUES (1030, NULL, '删除用户', 'USER:DEL', 'apps\\admin\\classier\\controller\\account\\UserController::delUser');
INSERT INTO `admin_code` VALUES (1031, NULL, '用户列表', 'USER:LIST', 'apps\\admin\\classier\\controller\\account\\UserController::list');
INSERT INTO `admin_code` VALUES (1032, NULL, '积分详情', 'USER:INTEGRAL:DETAILS', 'apps\\admin\\classier\\controller\\account\\user\\IntegralController::details');
INSERT INTO `admin_code` VALUES (1033, NULL, '设置积分', 'USER:INTEGRAL:SET', 'apps\\admin\\classier\\controller\\account\\user\\IntegralController::setIntegral');
INSERT INTO `admin_code` VALUES (1034, NULL, '设置信息状态', 'USER:CERTIFICATES:STATUS:SET', 'apps\\admin\\classier\\controller\\account\\InformationController::setInformationStatus');
INSERT INTO `admin_code` VALUES (1035, NULL, '删除资质', 'USER:CERTIFICATES:DEL', 'apps\\admin\\classier\\controller\\account\\user\\CertificatesController::delCertificates');
INSERT INTO `admin_code` VALUES (1036, NULL, '资质列表', 'USER:CERTIFICATES:LIST', 'apps\\admin\\classier\\controller\\account\\user\\CertificatesController::list');
INSERT INTO `admin_code` VALUES (1037, NULL, '添加编辑资质', 'USER:CERTIFICATES:ADDED', 'apps\\admin\\classier\\controller\\account\\user\\CertificatesController::addedCertificates');
INSERT INTO `admin_code` VALUES (1038, NULL, '添加编辑用户', 'USER:ADDED', 'apps\\admin\\classier\\controller\\account\\UserController::addedUser');
INSERT INTO `admin_code` VALUES (1039, NULL, '删除通知', 'SYSTEM:NOTICE:DEL', 'apps\\admin\\classier\\controller\\account\\system\\NoticeController::delNotice');
INSERT INTO `admin_code` VALUES (1040, NULL, '通知列表', 'SYSTEM:NOTICE:LIST', 'apps\\admin\\classier\\controller\\account\\system\\NoticeController::getNoticeList');
INSERT INTO `admin_code` VALUES (1041, NULL, '添加修改通知信息', 'SYSTEM:NOTICE:ADDED', 'apps\\admin\\classier\\controller\\account\\system\\NoticeController::addedNotice');
INSERT INTO `admin_code` VALUES (1042, NULL, '删除banner', 'SYSTEM:BANNER:DEL', 'apps\\admin\\classier\\controller\\account\\system\\BannerController::delBanner');
INSERT INTO `admin_code` VALUES (1043, NULL, 'banner列表', 'SYSTEM:BANNER:LIST', 'apps\\admin\\classier\\controller\\account\\system\\BannerController::getBannerList');
INSERT INTO `admin_code` VALUES (1044, NULL, '添加修改Banner信息', 'SYSTEM:BANNER:ADDED', 'apps\\admin\\classier\\controller\\account\\system\\BannerController::addedBanner');
INSERT INTO `admin_code` VALUES (1045, NULL, '删除举报', 'REPORT:DEL', 'apps\\admin\\classier\\controller\\account\\ReportController::delInformation');
INSERT INTO `admin_code` VALUES (1046, NULL, '举报列表', 'REPORT:LIST', 'apps\\admin\\classier\\controller\\account\\ReportController::list');
INSERT INTO `admin_code` VALUES (1047, NULL, '删除通知', 'NOTIFY:DEL', 'apps\\admin\\classier\\controller\\account\\NotifyController::delNotify');
INSERT INTO `admin_code` VALUES (1048, NULL, '通知列表', 'NOTIFY:LIST', 'apps\\admin\\classier\\controller\\account\\NotifyController::list');
INSERT INTO `admin_code` VALUES (1049, NULL, '删除信息', 'INFORMATION:DEL', 'apps\\admin\\classier\\controller\\account\\InformationController::delInformation');
INSERT INTO `admin_code` VALUES (1050, NULL, '信息列表', 'INFORMATION:LIST', 'apps\\admin\\classier\\controller\\account\\InformationController::list');
INSERT INTO `admin_code` VALUES (1051, NULL, '删除分类', 'CATEGORY:DEL', 'apps\\admin\\classier\\controller\\account\\CategoryController::delCategory');
INSERT INTO `admin_code` VALUES (1052, NULL, '分类列表', 'CATEGORY:LIST', 'apps\\admin\\classier\\controller\\account\\CategoryController::getCategoryList');
INSERT INTO `admin_code` VALUES (1053, NULL, '添加修改分类信息', 'CATEGORY:ADDED', 'apps\\admin\\classier\\controller\\account\\CategoryController::addedCategory');
INSERT INTO `admin_code` VALUES (1054, NULL, '添加编辑权限', 'ADMIN:ACCESS:ADDED', 'apps\\admin\\classier\\controller\\account\\AdminController::addedAccessList');
INSERT INTO `admin_code` VALUES (1055, NULL, '删除code', 'ADMIN:ACCESS:CODE:DEL', 'apps\\admin\\classier\\controller\\account\\AccessController::delAccessCode');
COMMIT;

-- ----------------------------
-- Table structure for app_admin
-- ----------------------------
DROP TABLE IF EXISTS `app_admin`;
CREATE TABLE `app_admin` (
  `id` bigint(20) unsigned NOT NULL COMMENT '管理员Id',
  `parent_id` bigint(20) unsigned DEFAULT NULL COMMENT '父id',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '管理员名称',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录账号',
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  `head_fid` bigint(11) unsigned DEFAULT NULL COMMENT '头像文件Id',
  `is_supreme` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否最高管理员',
  `remark` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1 后台系统',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `username` (`username`) USING BTREE,
  KEY `app_admin_parent_id` (`parent_id`) USING BTREE,
  CONSTRAINT `app_admin_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `app_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='后台管理员';

-- ----------------------------
-- Records of app_admin
-- ----------------------------
BEGIN;
INSERT INTO `app_admin` VALUES (10001, NULL, 'Renewds', 'wgx123', '4af08a80305a308d845bf8865dd4ee4973a923e5', 7319, b'1', '超级管理员', 1, b'0', 0, '2021-09-26 23:24:06', 10001, '2021-11-09 10:38:48');
COMMIT;

-- ----------------------------
-- Table structure for app_area
-- ----------------------------
DROP TABLE IF EXISTS `app_area`;
CREATE TABLE `app_area` (
  `id` bigint(20) unsigned NOT NULL COMMENT '区域主键',
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区域名称',
  `pinyin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '拼音',
  `pid` bigint(11) DEFAULT NULL COMMENT '区域上级标识',
  `level` tinyint(1) DEFAULT NULL COMMENT '区域等级',
  `city_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区域编码',
  `post_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮政编码',
  `longitude` float DEFAULT NULL COMMENT '东经',
  `latitude` float DEFAULT NULL COMMENT '北纬',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='地区表';

-- ----------------------------
-- Records of app_area
-- ----------------------------
BEGIN;
INSERT INTO `app_area` VALUES (100000, '中国', 'China', NULL, NULL, '', '', 116.368, 39.9151);
INSERT INTO `app_area` VALUES (110000, '北京', 'Beijing', 100000, 1, '', '', 116.405, 39.905);
INSERT INTO `app_area` VALUES (110100, '北京市', 'Beijing', 110000, 2, '010', '100000', 116.405, 39.905);
INSERT INTO `app_area` VALUES (110101, '东城区', 'Dongcheng', 110100, 3, '010', '100010', 116.41, 39.9316);
INSERT INTO `app_area` VALUES (110102, '西城区', 'Xicheng', 110100, 3, '010', '100032', 116.36, 39.9305);
INSERT INTO `app_area` VALUES (110105, '朝阳区', 'Chaoyang', 110100, 3, '010', '100020', 116.485, 39.9484);
INSERT INTO `app_area` VALUES (110106, '丰台区', 'Fengtai', 110100, 3, '010', '100071', 116.286, 39.8585);
INSERT INTO `app_area` VALUES (110107, '石景山区', 'Shijingshan', 110100, 3, '010', '100043', 116.223, 39.9056);
INSERT INTO `app_area` VALUES (110108, '海淀区', 'Haidian', 110100, 3, '010', '100089', 116.298, 39.9593);
INSERT INTO `app_area` VALUES (110109, '门头沟区', 'Mentougou', 110100, 3, '010', '102300', 116.101, 39.9404);
INSERT INTO `app_area` VALUES (110111, '房山区', 'Fangshan', 110100, 3, '010', '102488', 116.143, 39.7479);
INSERT INTO `app_area` VALUES (110112, '通州区', 'Tongzhou', 110100, 3, '010', '101149', 116.657, 39.9097);
INSERT INTO `app_area` VALUES (110113, '顺义区', 'Shunyi', 110100, 3, '010', '101300', 116.654, 40.1302);
INSERT INTO `app_area` VALUES (110114, '昌平区', 'Changping', 110100, 3, '010', '102200', 116.231, 40.2207);
INSERT INTO `app_area` VALUES (110115, '大兴区', 'Daxing', 110100, 3, '010', '102600', 116.341, 39.7267);
INSERT INTO `app_area` VALUES (110116, '怀柔区', 'Huairou', 110100, 3, '010', '101400', 116.632, 40.316);
INSERT INTO `app_area` VALUES (110117, '平谷区', 'Pinggu', 110100, 3, '010', '101200', 117.121, 40.1406);
INSERT INTO `app_area` VALUES (110228, '密云县', 'Miyun', 110100, 3, '010', '101500', 116.843, 40.3762);
INSERT INTO `app_area` VALUES (110229, '延庆县', 'Yanqing', 110100, 3, '010', '102100', 115.975, 40.4567);
INSERT INTO `app_area` VALUES (120000, '天津', 'Tianjin', 100000, 1, '', '', 117.19, 39.1256);
INSERT INTO `app_area` VALUES (120100, '天津市', 'Tianjin', 120000, 2, '022', '300000', 117.19, 39.1256);
INSERT INTO `app_area` VALUES (120101, '和平区', 'Heping', 120100, 3, '022', '300041', 117.215, 39.1172);
INSERT INTO `app_area` VALUES (120102, '河东区', 'Hedong', 120100, 3, '022', '300171', 117.226, 39.1232);
INSERT INTO `app_area` VALUES (120103, '河西区', 'Hexi', 120100, 3, '022', '300202', 117.223, 39.1096);
INSERT INTO `app_area` VALUES (120104, '南开区', 'Nankai', 120100, 3, '022', '300110', 117.151, 39.1382);
INSERT INTO `app_area` VALUES (120105, '河北区', 'Hebei', 120100, 3, '022', '300143', 117.197, 39.1482);
INSERT INTO `app_area` VALUES (120106, '红桥区', 'Hongqiao', 120100, 3, '022', '300131', 117.151, 39.1671);
INSERT INTO `app_area` VALUES (120110, '东丽区', 'Dongli', 120100, 3, '022', '300300', 117.314, 39.0863);
INSERT INTO `app_area` VALUES (120111, '西青区', 'Xiqing', 120100, 3, '022', '300380', 117.009, 39.1412);
INSERT INTO `app_area` VALUES (120112, '津南区', 'Jinnan', 120100, 3, '022', '300350', 117.385, 38.9914);
INSERT INTO `app_area` VALUES (120113, '北辰区', 'Beichen', 120100, 3, '022', '300400', 117.132, 39.2213);
INSERT INTO `app_area` VALUES (120114, '武清区', 'Wuqing', 120100, 3, '022', '301700', 117.044, 39.3842);
INSERT INTO `app_area` VALUES (120115, '宝坻区', 'Baodi', 120100, 3, '022', '301800', 117.31, 39.7176);
INSERT INTO `app_area` VALUES (120116, '滨海新区', 'Binhaixinqu', 120100, 3, '022', '300451', 117.702, 39.0267);
INSERT INTO `app_area` VALUES (120221, '宁河县', 'Ninghe', 120100, 3, '022', '301500', 117.826, 39.3305);
INSERT INTO `app_area` VALUES (120223, '静海县', 'Jinghai', 120100, 3, '022', '301600', 116.974, 38.9458);
INSERT INTO `app_area` VALUES (120225, '蓟县', 'Jixian', 120100, 3, '022', '301900', 117.408, 40.0457);
INSERT INTO `app_area` VALUES (130000, '河北省', 'Hebei', 100000, 1, '', '', 114.502, 38.0455);
INSERT INTO `app_area` VALUES (130100, '石家庄市', 'Shijiazhuang', 130000, 2, '0311', '050011', 114.502, 38.0455);
INSERT INTO `app_area` VALUES (130102, '长安区', 'Chang\'an', 130100, 3, '0311', '050011', 114.539, 38.0367);
INSERT INTO `app_area` VALUES (130104, '桥西区', 'Qiaoxi', 130100, 3, '0311', '050091', 114.47, 38.0322);
INSERT INTO `app_area` VALUES (130105, '新华区', 'Xinhua', 130100, 3, '0311', '050051', 114.463, 38.0509);
INSERT INTO `app_area` VALUES (130107, '井陉矿区', 'Jingxingkuangqu', 130100, 3, '0311', '050100', 114.065, 38.0671);
INSERT INTO `app_area` VALUES (130108, '裕华区', 'Yuhua', 130100, 3, '0311', '050031', 114.531, 38.006);
INSERT INTO `app_area` VALUES (130109, '藁城区', 'Gaocheng', 130100, 3, '0311', '052160', 114.847, 38.0216);
INSERT INTO `app_area` VALUES (130110, '鹿泉区', 'Luquan', 130100, 3, '0311', '050200', 114.313, 38.0878);
INSERT INTO `app_area` VALUES (130111, '栾城区', 'Luancheng', 130100, 3, '0311', '051430', 114.648, 37.9002);
INSERT INTO `app_area` VALUES (130121, '井陉县', 'Jingxing', 130100, 3, '0311', '050300', 114.143, 38.0369);
INSERT INTO `app_area` VALUES (130123, '正定县', 'Zhengding', 130100, 3, '0311', '050800', 114.573, 38.1445);
INSERT INTO `app_area` VALUES (130125, '行唐县', 'Xingtang', 130100, 3, '0311', '050600', 114.553, 38.4365);
INSERT INTO `app_area` VALUES (130126, '灵寿县', 'Lingshou', 130100, 3, '0311', '050500', 114.383, 38.3084);
INSERT INTO `app_area` VALUES (130127, '高邑县', 'Gaoyi', 130100, 3, '0311', '051330', 114.611, 37.6156);
INSERT INTO `app_area` VALUES (130128, '深泽县', 'Shenze', 130100, 3, '0311', '052560', 115.204, 38.1835);
INSERT INTO `app_area` VALUES (130129, '赞皇县', 'Zanhuang', 130100, 3, '0311', '051230', 114.388, 37.6614);
INSERT INTO `app_area` VALUES (130130, '无极县', 'Wuji', 130100, 3, '0311', '052460', 114.975, 38.1765);
INSERT INTO `app_area` VALUES (130131, '平山县', 'Pingshan', 130100, 3, '0311', '050400', 114.186, 38.2599);
INSERT INTO `app_area` VALUES (130132, '元氏县', 'Yuanshi', 130100, 3, '0311', '051130', 114.525, 37.7667);
INSERT INTO `app_area` VALUES (130133, '赵县', 'Zhaoxian', 130100, 3, '0311', '051530', 114.776, 37.7563);
INSERT INTO `app_area` VALUES (130181, '辛集市', 'Xinji', 130100, 3, '0311', '052360', 115.206, 37.9408);
INSERT INTO `app_area` VALUES (130183, '晋州市', 'Jinzhou', 130100, 3, '0311', '052260', 115.043, 38.0313);
INSERT INTO `app_area` VALUES (130184, '新乐市', 'Xinle', 130100, 3, '0311', '050700', 114.69, 38.3442);
INSERT INTO `app_area` VALUES (130200, '唐山市', 'Tangshan', 130000, 2, '0315', '063000', 118.175, 39.6351);
INSERT INTO `app_area` VALUES (130202, '路南区', 'Lunan', 130200, 3, '0315', '063000', 118.154, 39.625);
INSERT INTO `app_area` VALUES (130203, '路北区', 'Lubei', 130200, 3, '0315', '063000', 118.201, 39.6244);
INSERT INTO `app_area` VALUES (130204, '古冶区', 'Guye', 130200, 3, '0315', '063100', 118.458, 39.7199);
INSERT INTO `app_area` VALUES (130205, '开平区', 'Kaiping', 130200, 3, '0315', '063021', 118.262, 39.6713);
INSERT INTO `app_area` VALUES (130207, '丰南区', 'Fengnan', 130200, 3, '0315', '063300', 118.113, 39.5648);
INSERT INTO `app_area` VALUES (130208, '丰润区', 'Fengrun', 130200, 3, '0315', '064000', 118.13, 39.8244);
INSERT INTO `app_area` VALUES (130209, '曹妃甸区', 'Caofeidian', 130200, 3, '0315', '063200', 118.46, 39.2731);
INSERT INTO `app_area` VALUES (130223, '滦县', 'Luanxian', 130200, 3, '0315', '063700', 118.703, 39.7406);
INSERT INTO `app_area` VALUES (130224, '滦南县', 'Luannan', 130200, 3, '0315', '063500', 118.674, 39.5039);
INSERT INTO `app_area` VALUES (130225, '乐亭县', 'Laoting', 130200, 3, '0315', '063600', 118.912, 39.4256);
INSERT INTO `app_area` VALUES (130227, '迁西县', 'Qianxi', 130200, 3, '0315', '064300', 118.316, 40.1459);
INSERT INTO `app_area` VALUES (130229, '玉田县', 'Yutian', 130200, 3, '0315', '064100', 117.739, 39.9005);
INSERT INTO `app_area` VALUES (130281, '遵化市', 'Zunhua', 130200, 3, '0315', '064200', 117.964, 40.1874);
INSERT INTO `app_area` VALUES (130283, '迁安市', 'Qian\'an', 130200, 3, '0315', '064400', 118.701, 39.9983);
INSERT INTO `app_area` VALUES (130300, '秦皇岛市', 'Qinhuangdao', 130000, 2, '0335', '066000', 119.587, 39.9425);
INSERT INTO `app_area` VALUES (130302, '海港区', 'Haigang', 130300, 3, '0335', '066000', 119.61, 39.9345);
INSERT INTO `app_area` VALUES (130303, '山海关区', 'Shanhaiguan', 130300, 3, '0335', '066200', 119.776, 39.9787);
INSERT INTO `app_area` VALUES (130304, '北戴河区', 'Beidaihe', 130300, 3, '0335', '066100', 119.484, 39.8341);
INSERT INTO `app_area` VALUES (130321, '青龙满族自治县', 'Qinglong', 130300, 3, '0335', '066500', 118.952, 40.4074);
INSERT INTO `app_area` VALUES (130322, '昌黎县', 'Changli', 130300, 3, '0335', '066600', 119.166, 39.7088);
INSERT INTO `app_area` VALUES (130323, '抚宁县', 'Funing', 130300, 3, '0335', '066300', 119.245, 39.8754);
INSERT INTO `app_area` VALUES (130324, '卢龙县', 'Lulong', 130300, 3, '0335', '066400', 118.893, 39.8918);
INSERT INTO `app_area` VALUES (130400, '邯郸市', 'Handan', 130000, 2, '0310', '056002', 114.491, 36.6123);
INSERT INTO `app_area` VALUES (130402, '邯山区', 'Hanshan', 130400, 3, '0310', '056001', 114.484, 36.6001);
INSERT INTO `app_area` VALUES (130403, '丛台区', 'Congtai', 130400, 3, '0310', '056002', 114.493, 36.6185);
INSERT INTO `app_area` VALUES (130404, '复兴区', 'Fuxing', 130400, 3, '0310', '056003', 114.459, 36.6113);
INSERT INTO `app_area` VALUES (130406, '峰峰矿区', 'Fengfengkuangqu', 130400, 3, '0310', '056200', 114.211, 36.4194);
INSERT INTO `app_area` VALUES (130421, '邯郸县', 'Handan', 130400, 3, '0310', '056101', 114.531, 36.5938);
INSERT INTO `app_area` VALUES (130423, '临漳县', 'Linzhang', 130400, 3, '0310', '056600', 114.619, 36.3346);
INSERT INTO `app_area` VALUES (130424, '成安县', 'Cheng\'an', 130400, 3, '0310', '056700', 114.67, 36.4441);
INSERT INTO `app_area` VALUES (130425, '大名县', 'Daming', 130400, 3, '0310', '056900', 115.154, 36.2799);
INSERT INTO `app_area` VALUES (130426, '涉县', 'Shexian', 130400, 3, '0310', '056400', 113.692, 36.5807);
INSERT INTO `app_area` VALUES (130427, '磁县', 'Cixian', 130400, 3, '0310', '056500', 114.374, 36.3739);
INSERT INTO `app_area` VALUES (130428, '肥乡县', 'Feixiang', 130400, 3, '0310', '057550', 114.8, 36.5481);
INSERT INTO `app_area` VALUES (130429, '永年县', 'Yongnian', 130400, 3, '0310', '057150', 114.489, 36.7836);
INSERT INTO `app_area` VALUES (130430, '邱县', 'Qiuxian', 130400, 3, '0310', '057450', 115.174, 36.8208);
INSERT INTO `app_area` VALUES (130431, '鸡泽县', 'Jize', 130400, 3, '0310', '057350', 114.874, 36.9237);
INSERT INTO `app_area` VALUES (130432, '广平县', 'Guangping', 130400, 3, '0310', '057650', 114.947, 36.4805);
INSERT INTO `app_area` VALUES (130433, '馆陶县', 'Guantao', 130400, 3, '0310', '057750', 115.299, 36.5372);
INSERT INTO `app_area` VALUES (130434, '魏县', 'Weixian', 130400, 3, '0310', '056800', 114.935, 36.3617);
INSERT INTO `app_area` VALUES (130435, '曲周县', 'Quzhou', 130400, 3, '0310', '057250', 114.952, 36.7767);
INSERT INTO `app_area` VALUES (130481, '武安市', 'Wu\'an', 130400, 3, '0310', '056300', 114.202, 36.6928);
INSERT INTO `app_area` VALUES (130500, '邢台市', 'Xingtai', 130000, 2, '0319', '054001', 114.509, 37.0682);
INSERT INTO `app_area` VALUES (130502, '桥东区', 'Qiaodong', 130500, 3, '0319', '054001', 114.507, 37.068);
INSERT INTO `app_area` VALUES (130503, '桥西区', 'Qiaoxi', 130500, 3, '0319', '054000', 114.468, 37.0598);
INSERT INTO `app_area` VALUES (130521, '邢台县', 'Xingtai', 130500, 3, '0319', '054001', 114.566, 37.0456);
INSERT INTO `app_area` VALUES (130522, '临城县', 'Lincheng', 130500, 3, '0319', '054300', 114.504, 37.4398);
INSERT INTO `app_area` VALUES (130523, '内丘县', 'Neiqiu', 130500, 3, '0319', '054200', 114.512, 37.2867);
INSERT INTO `app_area` VALUES (130524, '柏乡县', 'Baixiang', 130500, 3, '0319', '055450', 114.693, 37.4824);
INSERT INTO `app_area` VALUES (130525, '隆尧县', 'Longyao', 130500, 3, '0319', '055350', 114.776, 37.3535);
INSERT INTO `app_area` VALUES (130526, '任县', 'Renxian', 130500, 3, '0319', '055150', 114.684, 37.1258);
INSERT INTO `app_area` VALUES (130527, '南和县', 'Nanhe', 130500, 3, '0319', '054400', 114.684, 37.0049);
INSERT INTO `app_area` VALUES (130528, '宁晋县', 'Ningjin', 130500, 3, '0319', '055550', 114.921, 37.617);
INSERT INTO `app_area` VALUES (130529, '巨鹿县', 'Julu', 130500, 3, '0319', '055250', 115.035, 37.218);
INSERT INTO `app_area` VALUES (130530, '新河县', 'Xinhe', 130500, 3, '0319', '055650', 115.25, 37.5272);
INSERT INTO `app_area` VALUES (130531, '广宗县', 'Guangzong', 130500, 3, '0319', '054600', 115.143, 37.0746);
INSERT INTO `app_area` VALUES (130532, '平乡县', 'Pingxiang', 130500, 3, '0319', '054500', 115.03, 37.0632);
INSERT INTO `app_area` VALUES (130533, '威县', 'Weixian', 130500, 3, '0319', '054700', 115.264, 36.9768);
INSERT INTO `app_area` VALUES (130534, '清河县', 'Qinghe', 130500, 3, '0319', '054800', 115.665, 37.0712);
INSERT INTO `app_area` VALUES (130535, '临西县', 'Linxi', 130500, 3, '0319', '054900', 115.501, 36.8708);
INSERT INTO `app_area` VALUES (130581, '南宫市', 'Nangong', 130500, 3, '0319', '055750', 115.391, 37.358);
INSERT INTO `app_area` VALUES (130582, '沙河市', 'Shahe', 130500, 3, '0319', '054100', 114.498, 36.8577);
INSERT INTO `app_area` VALUES (130600, '保定市', 'Baoding', 130000, 2, '0312', '071052', 115.482, 38.8677);
INSERT INTO `app_area` VALUES (130602, '新市区', 'Xinshi', 130600, 3, '0312', '071051', 115.459, 38.8775);
INSERT INTO `app_area` VALUES (130603, '北市区', 'Beishi', 130600, 3, '0312', '071000', 115.497, 38.8832);
INSERT INTO `app_area` VALUES (130604, '南市区', 'Nanshi', 130600, 3, '0312', '071001', 115.529, 38.8545);
INSERT INTO `app_area` VALUES (130621, '满城县', 'Mancheng', 130600, 3, '0312', '072150', 115.323, 38.9497);
INSERT INTO `app_area` VALUES (130622, '清苑县', 'Qingyuan', 130600, 3, '0312', '071100', 115.493, 38.7671);
INSERT INTO `app_area` VALUES (130623, '涞水县', 'Laishui', 130600, 3, '0312', '074100', 115.715, 39.394);
INSERT INTO `app_area` VALUES (130624, '阜平县', 'Fuping', 130600, 3, '0312', '073200', 114.197, 38.8476);
INSERT INTO `app_area` VALUES (130625, '徐水县', 'Xushui', 130600, 3, '0312', '072550', 115.658, 39.021);
INSERT INTO `app_area` VALUES (130626, '定兴县', 'Dingxing', 130600, 3, '0312', '072650', 115.808, 39.2631);
INSERT INTO `app_area` VALUES (130627, '唐县', 'Tangxian', 130600, 3, '0312', '072350', 114.985, 38.7451);
INSERT INTO `app_area` VALUES (130628, '高阳县', 'Gaoyang', 130600, 3, '0312', '071500', 115.779, 38.7);
INSERT INTO `app_area` VALUES (130629, '容城县', 'Rongcheng', 130600, 3, '0312', '071700', 115.872, 39.0535);
INSERT INTO `app_area` VALUES (130630, '涞源县', 'Laiyuan', 130600, 3, '0312', '074300', 114.691, 39.3539);
INSERT INTO `app_area` VALUES (130631, '望都县', 'Wangdu', 130600, 3, '0312', '072450', 115.157, 38.71);
INSERT INTO `app_area` VALUES (130632, '安新县', 'Anxin', 130600, 3, '0312', '071600', 115.936, 38.9353);
INSERT INTO `app_area` VALUES (130633, '易县', 'Yixian', 130600, 3, '0312', '074200', 115.498, 39.3489);
INSERT INTO `app_area` VALUES (130634, '曲阳县', 'Quyang', 130600, 3, '0312', '073100', 114.701, 38.6215);
INSERT INTO `app_area` VALUES (130635, '蠡县', 'Lixian', 130600, 3, '0312', '071400', 115.577, 38.4897);
INSERT INTO `app_area` VALUES (130636, '顺平县', 'Shunping', 130600, 3, '0312', '072250', 115.135, 38.8385);
INSERT INTO `app_area` VALUES (130637, '博野县', 'Boye', 130600, 3, '0312', '071300', 115.47, 38.4564);
INSERT INTO `app_area` VALUES (130638, '雄县', 'Xiongxian', 130600, 3, '0312', '071800', 116.109, 38.9944);
INSERT INTO `app_area` VALUES (130681, '涿州市', 'Zhuozhou', 130600, 3, '0312', '072750', 115.981, 39.4862);
INSERT INTO `app_area` VALUES (130682, '定州市', 'Dingzhou', 130600, 3, '0312', '073000', 114.99, 38.5162);
INSERT INTO `app_area` VALUES (130683, '安国市', 'Anguo', 130600, 3, '0312', '071200', 115.323, 38.4139);
INSERT INTO `app_area` VALUES (130684, '高碑店市', 'Gaobeidian', 130600, 3, '0312', '074000', 115.874, 39.3265);
INSERT INTO `app_area` VALUES (130700, '张家口市', 'Zhangjiakou', 130000, 2, '0313', '075000', 114.884, 40.8119);
INSERT INTO `app_area` VALUES (130702, '桥东区', 'Qiaodong', 130700, 3, '0313', '075000', 114.894, 40.7884);
INSERT INTO `app_area` VALUES (130703, '桥西区', 'Qiaoxi', 130700, 3, '0313', '075061', 114.87, 40.8195);
INSERT INTO `app_area` VALUES (130705, '宣化区', 'Xuanhua', 130700, 3, '0313', '075100', 115.065, 40.6096);
INSERT INTO `app_area` VALUES (130706, '下花园区', 'Xiahuayuan', 130700, 3, '0313', '075300', 115.287, 40.5024);
INSERT INTO `app_area` VALUES (130721, '宣化县', 'Xuanhua', 130700, 3, '0313', '075100', 115.155, 40.5662);
INSERT INTO `app_area` VALUES (130722, '张北县', 'Zhangbei', 130700, 3, '0313', '076450', 114.714, 41.1598);
INSERT INTO `app_area` VALUES (130723, '康保县', 'Kangbao', 130700, 3, '0313', '076650', 114.6, 41.8522);
INSERT INTO `app_area` VALUES (130724, '沽源县', 'Guyuan', 130700, 3, '0313', '076550', 115.689, 41.6696);
INSERT INTO `app_area` VALUES (130725, '尚义县', 'Shangyi', 130700, 3, '0313', '076750', 113.971, 41.0778);
INSERT INTO `app_area` VALUES (130726, '蔚县', 'Yuxian', 130700, 3, '0313', '075700', 114.589, 39.8407);
INSERT INTO `app_area` VALUES (130727, '阳原县', 'Yangyuan', 130700, 3, '0313', '075800', 114.151, 40.1036);
INSERT INTO `app_area` VALUES (130728, '怀安县', 'Huai\'an', 130700, 3, '0313', '076150', 114.386, 40.6743);
INSERT INTO `app_area` VALUES (130729, '万全县', 'Wanquan', 130700, 3, '0313', '076250', 114.741, 40.7669);
INSERT INTO `app_area` VALUES (130730, '怀来县', 'Huailai', 130700, 3, '0313', '075400', 115.518, 40.4154);
INSERT INTO `app_area` VALUES (130731, '涿鹿县', 'Zhuolu', 130700, 3, '0313', '075600', 115.224, 40.3764);
INSERT INTO `app_area` VALUES (130732, '赤城县', 'Chicheng', 130700, 3, '0313', '075500', 115.832, 40.9144);
INSERT INTO `app_area` VALUES (130733, '崇礼县', 'Chongli', 130700, 3, '0313', '076350', 115.28, 40.9752);
INSERT INTO `app_area` VALUES (130800, '承德市', 'Chengde', 130000, 2, '0314', '067000', 117.939, 40.9762);
INSERT INTO `app_area` VALUES (130802, '双桥区', 'Shuangqiao', 130800, 3, '0314', '067000', 117.943, 40.9747);
INSERT INTO `app_area` VALUES (130803, '双滦区', 'Shuangluan', 130800, 3, '0314', '067001', 117.745, 40.9538);
INSERT INTO `app_area` VALUES (130804, '鹰手营子矿区', 'Yingshouyingzikuangqu', 130800, 3, '0314', '067200', 117.66, 40.5474);
INSERT INTO `app_area` VALUES (130821, '承德县', 'Chengde', 130800, 3, '0314', '067400', 118.176, 40.7699);
INSERT INTO `app_area` VALUES (130822, '兴隆县', 'Xinglong', 130800, 3, '0314', '067300', 117.501, 40.4171);
INSERT INTO `app_area` VALUES (130823, '平泉县', 'Pingquan', 130800, 3, '0314', '067500', 118.702, 41.0184);
INSERT INTO `app_area` VALUES (130824, '滦平县', 'Luanping', 130800, 3, '0314', '068250', 117.333, 40.9415);
INSERT INTO `app_area` VALUES (130825, '隆化县', 'Longhua', 130800, 3, '0314', '068150', 117.73, 41.3141);
INSERT INTO `app_area` VALUES (130826, '丰宁满族自治县', 'Fengning', 130800, 3, '0314', '068350', 116.649, 41.2048);
INSERT INTO `app_area` VALUES (130827, '宽城满族自治县', 'Kuancheng', 130800, 3, '0314', '067600', 118.492, 40.6083);
INSERT INTO `app_area` VALUES (130828, '围场满族蒙古族自治县', 'Weichang', 130800, 3, '0314', '068450', 117.76, 41.9437);
INSERT INTO `app_area` VALUES (130900, '沧州市', 'Cangzhou', 130000, 2, '0317', '061001', 116.857, 38.3106);
INSERT INTO `app_area` VALUES (130902, '新华区', 'Xinhua', 130900, 3, '0317', '061000', 116.866, 38.3144);
INSERT INTO `app_area` VALUES (130903, '运河区', 'Yunhe', 130900, 3, '0317', '061001', 116.857, 38.3135);
INSERT INTO `app_area` VALUES (130921, '沧县', 'Cangxian', 130900, 3, '0317', '061000', 116.878, 38.2936);
INSERT INTO `app_area` VALUES (130922, '青县', 'Qingxian', 130900, 3, '0317', '062650', 116.803, 38.5835);
INSERT INTO `app_area` VALUES (130923, '东光县', 'Dongguang', 130900, 3, '0317', '061600', 116.537, 37.8857);
INSERT INTO `app_area` VALUES (130924, '海兴县', 'Haixing', 130900, 3, '0317', '061200', 117.498, 38.1396);
INSERT INTO `app_area` VALUES (130925, '盐山县', 'Yanshan', 130900, 3, '0317', '061300', 117.231, 38.0565);
INSERT INTO `app_area` VALUES (130926, '肃宁县', 'Suning', 130900, 3, '0317', '062350', 115.83, 38.4227);
INSERT INTO `app_area` VALUES (130927, '南皮县', 'Nanpi', 130900, 3, '0317', '061500', 116.702, 38.0411);
INSERT INTO `app_area` VALUES (130928, '吴桥县', 'Wuqiao', 130900, 3, '0317', '061800', 116.385, 37.6255);
INSERT INTO `app_area` VALUES (130929, '献县', 'Xianxian', 130900, 3, '0317', '062250', 116.127, 38.1923);
INSERT INTO `app_area` VALUES (130930, '孟村回族自治县', 'Mengcun', 130900, 3, '0317', '061400', 117.104, 38.0534);
INSERT INTO `app_area` VALUES (130981, '泊头市', 'Botou', 130900, 3, '0317', '062150', 116.578, 38.0836);
INSERT INTO `app_area` VALUES (130982, '任丘市', 'Renqiu', 130900, 3, '0317', '062550', 116.103, 38.7112);
INSERT INTO `app_area` VALUES (130983, '黄骅市', 'Huanghua', 130900, 3, '0317', '061100', 117.339, 38.3706);
INSERT INTO `app_area` VALUES (130984, '河间市', 'Hejian', 130900, 3, '0317', '062450', 116.099, 38.4455);
INSERT INTO `app_area` VALUES (131000, '廊坊市', 'Langfang', 130000, 2, '0316', '065000', 116.714, 39.5292);
INSERT INTO `app_area` VALUES (131002, '安次区', 'Anci', 131000, 3, '0316', '065000', 116.703, 39.5206);
INSERT INTO `app_area` VALUES (131003, '广阳区', 'Guangyang', 131000, 3, '0316', '065000', 116.711, 39.5228);
INSERT INTO `app_area` VALUES (131022, '固安县', 'Gu\'an', 131000, 3, '0316', '065500', 116.299, 39.4383);
INSERT INTO `app_area` VALUES (131023, '永清县', 'Yongqing', 131000, 3, '0316', '065600', 116.501, 39.3207);
INSERT INTO `app_area` VALUES (131024, '香河县', 'Xianghe', 131000, 3, '0316', '065400', 117.006, 39.7613);
INSERT INTO `app_area` VALUES (131025, '大城县', 'Daicheng', 131000, 3, '0316', '065900', 116.654, 38.7053);
INSERT INTO `app_area` VALUES (131026, '文安县', 'Wen\'an', 131000, 3, '0316', '065800', 116.458, 38.8732);
INSERT INTO `app_area` VALUES (131028, '大厂回族自治县', 'Dachang', 131000, 3, '0316', '065300', 116.989, 39.8865);
INSERT INTO `app_area` VALUES (131081, '霸州市', 'Bazhou', 131000, 3, '0316', '065700', 116.392, 39.1257);
INSERT INTO `app_area` VALUES (131082, '三河市', 'Sanhe', 131000, 3, '0316', '065200', 117.072, 39.9836);
INSERT INTO `app_area` VALUES (131100, '衡水市', 'Hengshui', 130000, 2, '0318', '053000', 115.666, 37.7351);
INSERT INTO `app_area` VALUES (131102, '桃城区', 'Taocheng', 131100, 3, '0318', '053000', 115.675, 37.735);
INSERT INTO `app_area` VALUES (131121, '枣强县', 'Zaoqiang', 131100, 3, '0318', '053100', 115.726, 37.5103);
INSERT INTO `app_area` VALUES (131122, '武邑县', 'Wuyi', 131100, 3, '0318', '053400', 115.887, 37.8018);
INSERT INTO `app_area` VALUES (131123, '武强县', 'Wuqiang', 131100, 3, '0318', '053300', 115.982, 38.0414);
INSERT INTO `app_area` VALUES (131124, '饶阳县', 'Raoyang', 131100, 3, '0318', '053900', 115.726, 38.2353);
INSERT INTO `app_area` VALUES (131125, '安平县', 'Anping', 131100, 3, '0318', '053600', 115.519, 38.2339);
INSERT INTO `app_area` VALUES (131126, '故城县', 'Gucheng', 131100, 3, '0318', '053800', 115.971, 37.3477);
INSERT INTO `app_area` VALUES (131127, '景县', 'Jingxian', 131100, 3, '0318', '053500', 116.269, 37.6926);
INSERT INTO `app_area` VALUES (131128, '阜城县', 'Fucheng', 131100, 3, '0318', '053700', 116.144, 37.8688);
INSERT INTO `app_area` VALUES (131181, '冀州市', 'Jizhou', 131100, 3, '0318', '053200', 115.579, 37.5508);
INSERT INTO `app_area` VALUES (131182, '深州市', 'Shenzhou', 131100, 3, '0318', '053800', 115.56, 38.0011);
INSERT INTO `app_area` VALUES (140000, '山西省', 'Shanxi', 100000, 1, '', '', 112.549, 37.857);
INSERT INTO `app_area` VALUES (140100, '太原市', 'Taiyuan', 140000, 2, '0351', '030082', 112.549, 37.857);
INSERT INTO `app_area` VALUES (140105, '小店区', 'Xiaodian', 140100, 3, '0351', '030032', 112.569, 37.7356);
INSERT INTO `app_area` VALUES (140106, '迎泽区', 'Yingze', 140100, 3, '0351', '030002', 112.563, 37.8633);
INSERT INTO `app_area` VALUES (140107, '杏花岭区', 'Xinghualing', 140100, 3, '0351', '030009', 112.562, 37.8843);
INSERT INTO `app_area` VALUES (140108, '尖草坪区', 'Jiancaoping', 140100, 3, '0351', '030023', 112.487, 37.9419);
INSERT INTO `app_area` VALUES (140109, '万柏林区', 'Wanbailin', 140100, 3, '0351', '030024', 112.516, 37.8592);
INSERT INTO `app_area` VALUES (140110, '晋源区', 'Jinyuan', 140100, 3, '0351', '030025', 112.48, 37.7248);
INSERT INTO `app_area` VALUES (140121, '清徐县', 'Qingxu', 140100, 3, '0351', '030400', 112.359, 37.6076);
INSERT INTO `app_area` VALUES (140122, '阳曲县', 'Yangqu', 140100, 3, '0351', '030100', 112.679, 38.0599);
INSERT INTO `app_area` VALUES (140123, '娄烦县', 'Loufan', 140100, 3, '0351', '030300', 111.795, 38.0669);
INSERT INTO `app_area` VALUES (140181, '古交市', 'Gujiao', 140100, 3, '0351', '030200', 112.169, 37.9098);
INSERT INTO `app_area` VALUES (140200, '大同市', 'Datong', 140000, 2, '0352', '037008', 113.295, 40.0903);
INSERT INTO `app_area` VALUES (140202, '城区', 'Chengqu', 140200, 3, '0352', '037008', 113.298, 40.0757);
INSERT INTO `app_area` VALUES (140203, '矿区', 'Kuangqu', 140200, 3, '0352', '037003', 113.177, 40.0368);
INSERT INTO `app_area` VALUES (140211, '南郊区', 'Nanjiao', 140200, 3, '0352', '037001', 113.149, 40.0054);
INSERT INTO `app_area` VALUES (140212, '新荣区', 'Xinrong', 140200, 3, '0352', '037002', 113.135, 40.2562);
INSERT INTO `app_area` VALUES (140221, '阳高县', 'Yanggao', 140200, 3, '0352', '038100', 113.75, 40.3626);
INSERT INTO `app_area` VALUES (140222, '天镇县', 'Tianzhen', 140200, 3, '0352', '038200', 114.093, 40.423);
INSERT INTO `app_area` VALUES (140223, '广灵县', 'Guangling', 140200, 3, '0352', '037500', 114.282, 39.7608);
INSERT INTO `app_area` VALUES (140224, '灵丘县', 'Lingqiu', 140200, 3, '0352', '034400', 114.237, 39.4404);
INSERT INTO `app_area` VALUES (140225, '浑源县', 'Hunyuan', 140200, 3, '0352', '037400', 113.696, 39.6996);
INSERT INTO `app_area` VALUES (140226, '左云县', 'Zuoyun', 140200, 3, '0352', '037100', 112.703, 40.0134);
INSERT INTO `app_area` VALUES (140227, '大同县', 'Datong', 140200, 3, '0352', '037300', 113.612, 40.0401);
INSERT INTO `app_area` VALUES (140300, '阳泉市', 'Yangquan', 140000, 2, '0353', '045000', 113.583, 37.8612);
INSERT INTO `app_area` VALUES (140302, '城区', 'Chengqu', 140300, 3, '0353', '045000', 113.601, 37.8474);
INSERT INTO `app_area` VALUES (140303, '矿区', 'Kuangqu', 140300, 3, '0353', '045000', 113.557, 37.8689);
INSERT INTO `app_area` VALUES (140311, '郊区', 'Jiaoqu', 140300, 3, '0353', '045011', 113.585, 37.9414);
INSERT INTO `app_area` VALUES (140321, '平定县', 'Pingding', 140300, 3, '0353', '045200', 113.658, 37.786);
INSERT INTO `app_area` VALUES (140322, '盂县', 'Yuxian', 140300, 3, '0353', '045100', 113.412, 38.0858);
INSERT INTO `app_area` VALUES (140400, '长治市', 'Changzhi', 140000, 2, '0355', '046000', 113.114, 36.1911);
INSERT INTO `app_area` VALUES (140402, '城区', 'Chengqu', 140400, 3, '0355', '046011', 113.123, 36.2035);
INSERT INTO `app_area` VALUES (140411, '郊区', 'Jiaoqu', 140400, 3, '0355', '046011', 113.127, 36.1992);
INSERT INTO `app_area` VALUES (140421, '长治县', 'Changzhi', 140400, 3, '0355', '047100', 113.048, 36.0472);
INSERT INTO `app_area` VALUES (140423, '襄垣县', 'Xiangyuan', 140400, 3, '0355', '046200', 113.052, 36.5353);
INSERT INTO `app_area` VALUES (140424, '屯留县', 'Tunliu', 140400, 3, '0355', '046100', 112.892, 36.3158);
INSERT INTO `app_area` VALUES (140425, '平顺县', 'Pingshun', 140400, 3, '0355', '047400', 113.436, 36.2001);
INSERT INTO `app_area` VALUES (140426, '黎城县', 'Licheng', 140400, 3, '0355', '047600', 113.388, 36.503);
INSERT INTO `app_area` VALUES (140427, '壶关县', 'Huguan', 140400, 3, '0355', '047300', 113.207, 36.113);
INSERT INTO `app_area` VALUES (140428, '长子县', 'Zhangzi', 140400, 3, '0355', '046600', 112.877, 36.1213);
INSERT INTO `app_area` VALUES (140429, '武乡县', 'Wuxiang', 140400, 3, '0355', '046300', 112.863, 36.8369);
INSERT INTO `app_area` VALUES (140430, '沁县', 'Qinxian', 140400, 3, '0355', '046400', 112.699, 36.7563);
INSERT INTO `app_area` VALUES (140431, '沁源县', 'Qinyuan', 140400, 3, '0355', '046500', 112.338, 36.5001);
INSERT INTO `app_area` VALUES (140481, '潞城市', 'Lucheng', 140400, 3, '0355', '047500', 113.229, 36.3341);
INSERT INTO `app_area` VALUES (140500, '晋城市', 'Jincheng', 140000, 2, '0356', '048000', 112.851, 35.4976);
INSERT INTO `app_area` VALUES (140502, '城区', 'Chengqu', 140500, 3, '0356', '048000', 112.853, 35.5018);
INSERT INTO `app_area` VALUES (140521, '沁水县', 'Qinshui', 140500, 3, '0356', '048200', 112.187, 35.691);
INSERT INTO `app_area` VALUES (140522, '阳城县', 'Yangcheng', 140500, 3, '0356', '048100', 112.415, 35.4861);
INSERT INTO `app_area` VALUES (140524, '陵川县', 'Lingchuan', 140500, 3, '0356', '048300', 113.281, 35.7753);
INSERT INTO `app_area` VALUES (140525, '泽州县', 'Zezhou', 140500, 3, '0356', '048012', 112.839, 35.5079);
INSERT INTO `app_area` VALUES (140581, '高平市', 'Gaoping', 140500, 3, '0356', '048400', 112.923, 35.7971);
INSERT INTO `app_area` VALUES (140600, '朔州市', 'Shuozhou', 140000, 2, '0349', '038500', 112.433, 39.3313);
INSERT INTO `app_area` VALUES (140602, '朔城区', 'Shuocheng', 140600, 3, '0349', '036000', 112.432, 39.3198);
INSERT INTO `app_area` VALUES (140603, '平鲁区', 'Pinglu', 140600, 3, '0349', '038600', 112.288, 39.5116);
INSERT INTO `app_area` VALUES (140621, '山阴县', 'Shanyin', 140600, 3, '0349', '036900', 112.817, 39.527);
INSERT INTO `app_area` VALUES (140622, '应县', 'Yingxian', 140600, 3, '0349', '037600', 113.191, 39.5528);
INSERT INTO `app_area` VALUES (140623, '右玉县', 'Youyu', 140600, 3, '0349', '037200', 112.469, 39.9901);
INSERT INTO `app_area` VALUES (140624, '怀仁县', 'Huairen', 140600, 3, '0349', '038300', 113.1, 39.8281);
INSERT INTO `app_area` VALUES (140700, '晋中市', 'Jinzhong', 140000, 2, '0354', '030600', 112.736, 37.6965);
INSERT INTO `app_area` VALUES (140702, '榆次区', 'Yuci', 140700, 3, '0354', '030600', 112.708, 37.6978);
INSERT INTO `app_area` VALUES (140721, '榆社县', 'Yushe', 140700, 3, '0354', '031800', 112.976, 37.0721);
INSERT INTO `app_area` VALUES (140722, '左权县', 'Zuoquan', 140700, 3, '0354', '032600', 113.379, 37.0824);
INSERT INTO `app_area` VALUES (140723, '和顺县', 'Heshun', 140700, 3, '0354', '032700', 113.57, 37.3296);
INSERT INTO `app_area` VALUES (140724, '昔阳县', 'Xiyang', 140700, 3, '0354', '045300', 113.705, 37.6186);
INSERT INTO `app_area` VALUES (140725, '寿阳县', 'Shouyang', 140700, 3, '0354', '045400', 113.175, 37.889);
INSERT INTO `app_area` VALUES (140726, '太谷县', 'Taigu', 140700, 3, '0354', '030800', 112.552, 37.4216);
INSERT INTO `app_area` VALUES (140727, '祁县', 'Qixian', 140700, 3, '0354', '030900', 112.334, 37.3579);
INSERT INTO `app_area` VALUES (140728, '平遥县', 'Pingyao', 140700, 3, '0354', '031100', 112.176, 37.1892);
INSERT INTO `app_area` VALUES (140729, '灵石县', 'Lingshi', 140700, 3, '0354', '031300', 111.777, 36.8481);
INSERT INTO `app_area` VALUES (140781, '介休市', 'Jiexiu', 140700, 3, '0354', '032000', 111.918, 37.0277);
INSERT INTO `app_area` VALUES (140800, '运城市', 'Yuncheng', 140000, 2, '0359', '044000', 111.004, 35.0228);
INSERT INTO `app_area` VALUES (140802, '盐湖区', 'Yanhu', 140800, 3, '0359', '044000', 110.998, 35.0151);
INSERT INTO `app_area` VALUES (140821, '临猗县', 'Linyi', 140800, 3, '0359', '044100', 110.774, 35.1446);
INSERT INTO `app_area` VALUES (140822, '万荣县', 'Wanrong', 140800, 3, '0359', '044200', 110.837, 35.4156);
INSERT INTO `app_area` VALUES (140823, '闻喜县', 'Wenxi', 140800, 3, '0359', '043800', 111.223, 35.3555);
INSERT INTO `app_area` VALUES (140824, '稷山县', 'Jishan', 140800, 3, '0359', '043200', 110.979, 35.5999);
INSERT INTO `app_area` VALUES (140825, '新绛县', 'Xinjiang', 140800, 3, '0359', '043100', 111.225, 35.6157);
INSERT INTO `app_area` VALUES (140826, '绛县', 'Jiangxian', 140800, 3, '0359', '043600', 111.567, 35.491);
INSERT INTO `app_area` VALUES (140827, '垣曲县', 'Yuanqu', 140800, 3, '0359', '043700', 111.672, 35.2992);
INSERT INTO `app_area` VALUES (140828, '夏县', 'Xiaxian', 140800, 3, '0359', '044400', 111.22, 35.1412);
INSERT INTO `app_area` VALUES (140829, '平陆县', 'Pinglu', 140800, 3, '0359', '044300', 111.217, 34.8377);
INSERT INTO `app_area` VALUES (140830, '芮城县', 'Ruicheng', 140800, 3, '0359', '044600', 110.695, 34.6938);
INSERT INTO `app_area` VALUES (140881, '永济市', 'Yongji', 140800, 3, '0359', '044500', 110.445, 34.8656);
INSERT INTO `app_area` VALUES (140882, '河津市', 'Hejin', 140800, 3, '0359', '043300', 110.712, 35.5948);
INSERT INTO `app_area` VALUES (140900, '忻州市', 'Xinzhou', 140000, 2, '0350', '034000', 112.734, 38.4177);
INSERT INTO `app_area` VALUES (140902, '忻府区', 'Xinfu', 140900, 3, '0350', '034000', 112.746, 38.4041);
INSERT INTO `app_area` VALUES (140921, '定襄县', 'Dingxiang', 140900, 3, '0350', '035400', 112.957, 38.4739);
INSERT INTO `app_area` VALUES (140922, '五台县', 'Wutai', 140900, 3, '0350', '035500', 113.253, 38.7277);
INSERT INTO `app_area` VALUES (140923, '代县', 'Daixian', 140900, 3, '0350', '034200', 112.959, 39.0672);
INSERT INTO `app_area` VALUES (140924, '繁峙县', 'Fanshi', 140900, 3, '0350', '034300', 113.263, 39.1889);
INSERT INTO `app_area` VALUES (140925, '宁武县', 'Ningwu', 140900, 3, '0350', '036700', 112.304, 39.0021);
INSERT INTO `app_area` VALUES (140926, '静乐县', 'Jingle', 140900, 3, '0350', '035100', 111.942, 38.3602);
INSERT INTO `app_area` VALUES (140927, '神池县', 'Shenchi', 140900, 3, '0350', '036100', 112.205, 39.09);
INSERT INTO `app_area` VALUES (140928, '五寨县', 'Wuzhai', 140900, 3, '0350', '036200', 111.849, 38.9076);
INSERT INTO `app_area` VALUES (140929, '岢岚县', 'Kelan', 140900, 3, '0350', '036300', 111.574, 38.7045);
INSERT INTO `app_area` VALUES (140930, '河曲县', 'Hequ', 140900, 3, '0350', '036500', 111.138, 39.3844);
INSERT INTO `app_area` VALUES (140931, '保德县', 'Baode', 140900, 3, '0350', '036600', 111.087, 39.0225);
INSERT INTO `app_area` VALUES (140932, '偏关县', 'Pianguan', 140900, 3, '0350', '036400', 111.509, 39.4361);
INSERT INTO `app_area` VALUES (140981, '原平市', 'Yuanping', 140900, 3, '0350', '034100', 112.706, 38.7318);
INSERT INTO `app_area` VALUES (141000, '临汾市', 'Linfen', 140000, 2, '0357', '041000', 111.518, 36.0841);
INSERT INTO `app_area` VALUES (141002, '尧都区', 'Yaodu', 141000, 3, '0357', '041000', 111.579, 36.083);
INSERT INTO `app_area` VALUES (141021, '曲沃县', 'Quwo', 141000, 3, '0357', '043400', 111.475, 35.6412);
INSERT INTO `app_area` VALUES (141022, '翼城县', 'Yicheng', 141000, 3, '0357', '043500', 111.718, 35.7388);
INSERT INTO `app_area` VALUES (141023, '襄汾县', 'Xiangfen', 141000, 3, '0357', '041500', 111.442, 35.8771);
INSERT INTO `app_area` VALUES (141024, '洪洞县', 'Hongtong', 141000, 3, '0357', '041600', 111.675, 36.2542);
INSERT INTO `app_area` VALUES (141025, '古县', 'Guxian', 141000, 3, '0357', '042400', 111.92, 36.2669);
INSERT INTO `app_area` VALUES (141026, '安泽县', 'Anze', 141000, 3, '0357', '042500', 112.25, 36.148);
INSERT INTO `app_area` VALUES (141027, '浮山县', 'Fushan', 141000, 3, '0357', '042600', 111.847, 35.9685);
INSERT INTO `app_area` VALUES (141028, '吉县', 'Jixian', 141000, 3, '0357', '042200', 110.681, 36.0987);
INSERT INTO `app_area` VALUES (141029, '乡宁县', 'Xiangning', 141000, 3, '0357', '042100', 110.847, 35.9707);
INSERT INTO `app_area` VALUES (141030, '大宁县', 'Daning', 141000, 3, '0357', '042300', 110.752, 36.4662);
INSERT INTO `app_area` VALUES (141031, '隰县', 'Xixian', 141000, 3, '0357', '041300', 110.939, 36.6926);
INSERT INTO `app_area` VALUES (141032, '永和县', 'Yonghe', 141000, 3, '0357', '041400', 110.632, 36.7584);
INSERT INTO `app_area` VALUES (141033, '蒲县', 'Puxian', 141000, 3, '0357', '041200', 111.097, 36.4124);
INSERT INTO `app_area` VALUES (141034, '汾西县', 'Fenxi', 141000, 3, '0357', '031500', 111.568, 36.6506);
INSERT INTO `app_area` VALUES (141081, '侯马市', 'Houma', 141000, 3, '0357', '043000', 111.372, 35.619);
INSERT INTO `app_area` VALUES (141082, '霍州市', 'Huozhou', 141000, 3, '0357', '031400', 111.755, 36.5638);
INSERT INTO `app_area` VALUES (141100, '吕梁市', 'Lvliang', 140000, 2, '0358', '033000', 111.134, 37.5244);
INSERT INTO `app_area` VALUES (141102, '离石区', 'Lishi', 141100, 3, '0358', '033000', 111.151, 37.5177);
INSERT INTO `app_area` VALUES (141121, '文水县', 'Wenshui', 141100, 3, '0358', '032100', 112.028, 37.4384);
INSERT INTO `app_area` VALUES (141122, '交城县', 'Jiaocheng', 141100, 3, '0358', '030500', 112.159, 37.5512);
INSERT INTO `app_area` VALUES (141123, '兴县', 'Xingxian', 141100, 3, '0358', '033600', 111.127, 38.4632);
INSERT INTO `app_area` VALUES (141124, '临县', 'Linxian', 141100, 3, '0358', '033200', 110.993, 37.9527);
INSERT INTO `app_area` VALUES (141125, '柳林县', 'Liulin', 141100, 3, '0358', '033300', 110.889, 37.4293);
INSERT INTO `app_area` VALUES (141126, '石楼县', 'Shilou', 141100, 3, '0358', '032500', 110.835, 36.9973);
INSERT INTO `app_area` VALUES (141127, '岚县', 'Lanxian', 141100, 3, '0358', '033500', 111.676, 38.2787);
INSERT INTO `app_area` VALUES (141128, '方山县', 'Fangshan', 141100, 3, '0358', '033100', 111.24, 37.8898);
INSERT INTO `app_area` VALUES (141129, '中阳县', 'Zhongyang', 141100, 3, '0358', '033400', 111.179, 37.3572);
INSERT INTO `app_area` VALUES (141130, '交口县', 'Jiaokou', 141100, 3, '0358', '032400', 111.181, 36.9821);
INSERT INTO `app_area` VALUES (141181, '孝义市', 'Xiaoyi', 141100, 3, '0358', '032300', 111.774, 37.1441);
INSERT INTO `app_area` VALUES (141182, '汾阳市', 'Fenyang', 141100, 3, '0358', '032200', 111.788, 37.266);
INSERT INTO `app_area` VALUES (150000, '内蒙古自治区', 'Inner Mongolia', 100000, 1, '', '', 111.671, 40.8183);
INSERT INTO `app_area` VALUES (150100, '呼和浩特市', 'Hohhot', 150000, 2, '0471', '010000', 111.671, 40.8183);
INSERT INTO `app_area` VALUES (150102, '新城区', 'Xincheng', 150100, 3, '0471', '010050', 111.666, 40.8583);
INSERT INTO `app_area` VALUES (150103, '回民区', 'Huimin', 150100, 3, '0471', '010030', 111.624, 40.8083);
INSERT INTO `app_area` VALUES (150104, '玉泉区', 'Yuquan', 150100, 3, '0471', '010020', 111.675, 40.7523);
INSERT INTO `app_area` VALUES (150105, '赛罕区', 'Saihan', 150100, 3, '0471', '010020', 111.702, 40.7921);
INSERT INTO `app_area` VALUES (150121, '土默特左旗', 'Tumotezuoqi', 150100, 3, '0471', '010100', 111.149, 40.7223);
INSERT INTO `app_area` VALUES (150122, '托克托县', 'Tuoketuo', 150100, 3, '0471', '010200', 111.191, 40.2749);
INSERT INTO `app_area` VALUES (150123, '和林格尔县', 'Helingeer', 150100, 3, '0471', '011500', 111.822, 40.3789);
INSERT INTO `app_area` VALUES (150124, '清水河县', 'Qingshuihe', 150100, 3, '0471', '011600', 111.683, 39.9097);
INSERT INTO `app_area` VALUES (150125, '武川县', 'Wuchuan', 150100, 3, '0471', '011700', 111.458, 41.0929);
INSERT INTO `app_area` VALUES (150200, '包头市', 'Baotou', 150000, 2, '0472', '014025', 109.84, 40.6582);
INSERT INTO `app_area` VALUES (150202, '东河区', 'Donghe', 150200, 3, '0472', '014040', 110.046, 40.5824);
INSERT INTO `app_area` VALUES (150203, '昆都仑区', 'Kundulun', 150200, 3, '0472', '014010', 109.839, 40.6418);
INSERT INTO `app_area` VALUES (150204, '青山区', 'Qingshan', 150200, 3, '0472', '014030', 109.901, 40.6433);
INSERT INTO `app_area` VALUES (150205, '石拐区', 'Shiguai', 150200, 3, '0472', '014070', 110.273, 40.673);
INSERT INTO `app_area` VALUES (150206, '白云鄂博矿区', 'Baiyunebokuangqu', 150200, 3, '0472', '014080', 109.974, 41.7697);
INSERT INTO `app_area` VALUES (150207, '九原区', 'Jiuyuan', 150200, 3, '0472', '014060', 109.965, 40.6055);
INSERT INTO `app_area` VALUES (150221, '土默特右旗', 'Tumoteyouqi', 150200, 3, '0472', '014100', 110.524, 40.5688);
INSERT INTO `app_area` VALUES (150222, '固阳县', 'Guyang', 150200, 3, '0472', '014200', 110.064, 41.0185);
INSERT INTO `app_area` VALUES (150223, '达尔罕茂明安联合旗', 'Damaoqi', 150200, 3, '0472', '014500', 110.433, 41.6987);
INSERT INTO `app_area` VALUES (150300, '乌海市', 'Wuhai', 150000, 2, '0473', '016000', 106.826, 39.6737);
INSERT INTO `app_area` VALUES (150302, '海勃湾区', 'Haibowan', 150300, 3, '0473', '016000', 106.822, 39.6696);
INSERT INTO `app_area` VALUES (150303, '海南区', 'Hainan', 150300, 3, '0473', '016030', 106.887, 39.4413);
INSERT INTO `app_area` VALUES (150304, '乌达区', 'Wuda', 150300, 3, '0473', '016040', 106.727, 39.505);
INSERT INTO `app_area` VALUES (150400, '赤峰市', 'Chifeng', 150000, 2, '0476', '024000', 118.957, 42.2753);
INSERT INTO `app_area` VALUES (150402, '红山区', 'Hongshan', 150400, 3, '0476', '024020', 118.958, 42.2431);
INSERT INTO `app_area` VALUES (150403, '元宝山区', 'Yuanbaoshan', 150400, 3, '0476', '024076', 119.289, 42.0401);
INSERT INTO `app_area` VALUES (150404, '松山区', 'Songshan', 150400, 3, '0476', '024005', 118.933, 42.2861);
INSERT INTO `app_area` VALUES (150421, '阿鲁科尔沁旗', 'Alukeerqinqi', 150400, 3, '0476', '025550', 120.065, 43.8799);
INSERT INTO `app_area` VALUES (150422, '巴林左旗', 'Balinzuoqi', 150400, 3, '0476', '025450', 119.38, 43.9703);
INSERT INTO `app_area` VALUES (150423, '巴林右旗', 'Balinyouqi', 150400, 3, '0476', '025150', 118.665, 43.5339);
INSERT INTO `app_area` VALUES (150424, '林西县', 'Linxi', 150400, 3, '0476', '025250', 118.047, 43.6116);
INSERT INTO `app_area` VALUES (150425, '克什克腾旗', 'Keshiketengqi', 150400, 3, '0476', '025350', 117.546, 43.265);
INSERT INTO `app_area` VALUES (150426, '翁牛特旗', 'Wengniuteqi', 150400, 3, '0476', '024500', 119.03, 42.9315);
INSERT INTO `app_area` VALUES (150428, '喀喇沁旗', 'Kalaqinqi', 150400, 3, '0476', '024400', 118.701, 41.9292);
INSERT INTO `app_area` VALUES (150429, '宁城县', 'Ningcheng', 150400, 3, '0476', '024200', 119.344, 41.5966);
INSERT INTO `app_area` VALUES (150430, '敖汉旗', 'Aohanqi', 150400, 3, '0476', '024300', 119.922, 42.2907);
INSERT INTO `app_area` VALUES (150500, '通辽市', 'Tongliao', 150000, 2, '0475', '028000', 122.263, 43.6174);
INSERT INTO `app_area` VALUES (150502, '科尔沁区', 'Keerqin', 150500, 3, '0475', '028000', 122.256, 43.6226);
INSERT INTO `app_area` VALUES (150521, '科尔沁左翼中旗', 'Keerqinzuoyizhongqi', 150500, 3, '0475', '029300', 123.319, 44.1301);
INSERT INTO `app_area` VALUES (150522, '科尔沁左翼后旗', 'Keerqinzuoyihouqi', 150500, 3, '0475', '028100', 122.357, 42.949);
INSERT INTO `app_area` VALUES (150523, '开鲁县', 'Kailu', 150500, 3, '0475', '028400', 121.319, 43.6);
INSERT INTO `app_area` VALUES (150524, '库伦旗', 'Kulunqi', 150500, 3, '0475', '028200', 121.776, 42.73);
INSERT INTO `app_area` VALUES (150525, '奈曼旗', 'Naimanqi', 150500, 3, '0475', '028300', 120.663, 42.8453);
INSERT INTO `app_area` VALUES (150526, '扎鲁特旗', 'Zhaluteqi', 150500, 3, '0475', '029100', 120.915, 44.5559);
INSERT INTO `app_area` VALUES (150581, '霍林郭勒市', 'Huolinguole', 150500, 3, '0475', '029200', 119.654, 45.5345);
INSERT INTO `app_area` VALUES (150600, '鄂尔多斯市', 'Ordos', 150000, 2, '0477', '017004', 109.99, 39.8172);
INSERT INTO `app_area` VALUES (150602, '东胜区', 'Dongsheng', 150600, 3, '0477', '017000', 109.963, 39.8224);
INSERT INTO `app_area` VALUES (150621, '达拉特旗', 'Dalateqi', 150600, 3, '0477', '014300', 110.033, 40.4001);
INSERT INTO `app_area` VALUES (150622, '准格尔旗', 'Zhungeerqi', 150600, 3, '0477', '017100', 111.236, 39.8678);
INSERT INTO `app_area` VALUES (150623, '鄂托克前旗', 'Etuokeqianqi', 150600, 3, '0477', '016200', 107.484, 38.184);
INSERT INTO `app_area` VALUES (150624, '鄂托克旗', 'Etuokeqi', 150600, 3, '0477', '016100', 107.982, 39.0946);
INSERT INTO `app_area` VALUES (150625, '杭锦旗', 'Hangjinqi', 150600, 3, '0477', '017400', 108.729, 39.8402);
INSERT INTO `app_area` VALUES (150626, '乌审旗', 'Wushenqi', 150600, 3, '0477', '017300', 108.846, 38.5909);
INSERT INTO `app_area` VALUES (150627, '伊金霍洛旗', 'Yijinhuoluoqi', 150600, 3, '0477', '017200', 109.749, 39.5739);
INSERT INTO `app_area` VALUES (150700, '呼伦贝尔市', 'Hulunber', 150000, 2, '0470', '021008', 119.758, 49.2153);
INSERT INTO `app_area` VALUES (150702, '海拉尔区', 'Hailaer', 150700, 3, '0470', '021000', 119.736, 49.2122);
INSERT INTO `app_area` VALUES (150703, '扎赉诺尔区', 'Zhalainuoer', 150700, 3, '0470', '021410', 117.793, 49.4869);
INSERT INTO `app_area` VALUES (150721, '阿荣旗', 'Arongqi', 150700, 3, '0470', '162750', 123.459, 48.1258);
INSERT INTO `app_area` VALUES (150722, '莫力达瓦达斡尔族自治旗', 'Moqi', 150700, 3, '0470', '162850', 124.515, 48.4805);
INSERT INTO `app_area` VALUES (150723, '鄂伦春自治旗', 'Elunchun', 150700, 3, '0470', '165450', 123.726, 50.5978);
INSERT INTO `app_area` VALUES (150724, '鄂温克族自治旗', 'Ewen', 150700, 3, '0470', '021100', 119.757, 49.1428);
INSERT INTO `app_area` VALUES (150725, '陈巴尔虎旗', 'Chenbaerhuqi', 150700, 3, '0470', '021500', 119.424, 49.3268);
INSERT INTO `app_area` VALUES (150726, '新巴尔虎左旗', 'Xinbaerhuzuoqi', 150700, 3, '0470', '021200', 118.27, 48.2184);
INSERT INTO `app_area` VALUES (150727, '新巴尔虎右旗', 'Xinbaerhuyouqi', 150700, 3, '0470', '021300', 116.824, 48.6647);
INSERT INTO `app_area` VALUES (150781, '满洲里市', 'Manzhouli', 150700, 3, '0470', '021400', 117.479, 49.5827);
INSERT INTO `app_area` VALUES (150782, '牙克石市', 'Yakeshi', 150700, 3, '0470', '022150', 120.712, 49.2856);
INSERT INTO `app_area` VALUES (150783, '扎兰屯市', 'Zhalantun', 150700, 3, '0470', '162650', 122.738, 48.0136);
INSERT INTO `app_area` VALUES (150784, '额尔古纳市', 'Eerguna', 150700, 3, '0470', '022250', 120.191, 50.2425);
INSERT INTO `app_area` VALUES (150785, '根河市', 'Genhe', 150700, 3, '0470', '022350', 121.522, 50.78);
INSERT INTO `app_area` VALUES (150800, '巴彦淖尔市', 'Bayan Nur', 150000, 2, '0478', '015001', 107.417, 40.7574);
INSERT INTO `app_area` VALUES (150802, '临河区', 'Linhe', 150800, 3, '0478', '015001', 107.427, 40.7583);
INSERT INTO `app_area` VALUES (150821, '五原县', 'Wuyuan', 150800, 3, '0478', '015100', 108.269, 41.0963);
INSERT INTO `app_area` VALUES (150822, '磴口县', 'Dengkou', 150800, 3, '0478', '015200', 107.009, 40.3306);
INSERT INTO `app_area` VALUES (150823, '乌拉特前旗', 'Wulateqianqi', 150800, 3, '0478', '014400', 108.652, 40.7365);
INSERT INTO `app_area` VALUES (150824, '乌拉特中旗', 'Wulatezhongqi', 150800, 3, '0478', '015300', 108.526, 41.5679);
INSERT INTO `app_area` VALUES (150825, '乌拉特后旗', 'Wulatehouqi', 150800, 3, '0478', '015500', 106.99, 41.4315);
INSERT INTO `app_area` VALUES (150826, '杭锦后旗', 'Hangjinhouqi', 150800, 3, '0478', '015400', 107.151, 40.8863);
INSERT INTO `app_area` VALUES (150900, '乌兰察布市', 'Ulanqab', 150000, 2, '0474', '012000', 113.115, 41.0341);
INSERT INTO `app_area` VALUES (150902, '集宁区', 'Jining', 150900, 3, '0474', '012000', 113.115, 41.0353);
INSERT INTO `app_area` VALUES (150921, '卓资县', 'Zhuozi', 150900, 3, '0474', '012300', 112.578, 40.8941);
INSERT INTO `app_area` VALUES (150922, '化德县', 'Huade', 150900, 3, '0474', '013350', 114.011, 41.9043);
INSERT INTO `app_area` VALUES (150923, '商都县', 'Shangdu', 150900, 3, '0474', '013450', 113.578, 41.5621);
INSERT INTO `app_area` VALUES (150924, '兴和县', 'Xinghe', 150900, 3, '0474', '013650', 113.834, 40.8719);
INSERT INTO `app_area` VALUES (150925, '凉城县', 'Liangcheng', 150900, 3, '0474', '013750', 112.496, 40.5335);
INSERT INTO `app_area` VALUES (150926, '察哈尔右翼前旗', 'Chayouqianqi', 150900, 3, '0474', '012200', 113.221, 40.7788);
INSERT INTO `app_area` VALUES (150927, '察哈尔右翼中旗', 'Chayouzhongqi', 150900, 3, '0474', '013550', 112.635, 41.2774);
INSERT INTO `app_area` VALUES (150928, '察哈尔右翼后旗', 'Chayouhouqi', 150900, 3, '0474', '012400', 113.192, 41.4355);
INSERT INTO `app_area` VALUES (150929, '四子王旗', 'Siziwangqi', 150900, 3, '0474', '011800', 111.707, 41.5331);
INSERT INTO `app_area` VALUES (150981, '丰镇市', 'Fengzhen', 150900, 3, '0474', '012100', 113.11, 40.4369);
INSERT INTO `app_area` VALUES (152200, '兴安盟', 'Hinggan', 150000, 2, '0482', '137401', 122.07, 46.0763);
INSERT INTO `app_area` VALUES (152201, '乌兰浩特市', 'Wulanhaote', 152200, 3, '0482', '137401', 122.064, 46.0624);
INSERT INTO `app_area` VALUES (152202, '阿尔山市', 'Aershan', 152200, 3, '0482', '137800', 119.943, 47.1772);
INSERT INTO `app_area` VALUES (152221, '科尔沁右翼前旗', 'Keyouqianqi', 152200, 3, '0482', '137423', 121.953, 46.0795);
INSERT INTO `app_area` VALUES (152222, '科尔沁右翼中旗', 'Keyouzhongqi', 152200, 3, '0482', '029400', 121.468, 45.056);
INSERT INTO `app_area` VALUES (152223, '扎赉特旗', 'Zhalaiteqi', 152200, 3, '0482', '137600', 122.912, 46.7267);
INSERT INTO `app_area` VALUES (152224, '突泉县', 'Tuquan', 152200, 3, '0482', '137500', 121.594, 45.3819);
INSERT INTO `app_area` VALUES (152500, '锡林郭勒盟', 'Xilin Gol', 150000, 2, '0479', '026000', 116.091, 43.944);
INSERT INTO `app_area` VALUES (152501, '二连浩特市', 'Erlianhaote', 152500, 3, '0479', '011100', 111.983, 43.653);
INSERT INTO `app_area` VALUES (152502, '锡林浩特市', 'Xilinhaote', 152500, 3, '0479', '026021', 116.086, 43.9334);
INSERT INTO `app_area` VALUES (152522, '阿巴嘎旗', 'Abagaqi', 152500, 3, '0479', '011400', 114.968, 44.0217);
INSERT INTO `app_area` VALUES (152523, '苏尼特左旗', 'Sunitezuoqi', 152500, 3, '0479', '011300', 113.651, 43.8569);
INSERT INTO `app_area` VALUES (152524, '苏尼特右旗', 'Suniteyouqi', 152500, 3, '0479', '011200', 112.657, 42.7469);
INSERT INTO `app_area` VALUES (152525, '东乌珠穆沁旗', 'Dongwuqi', 152500, 3, '0479', '026300', 116.973, 45.5111);
INSERT INTO `app_area` VALUES (152526, '西乌珠穆沁旗', 'Xiwuqi', 152500, 3, '0479', '026200', 117.61, 44.5962);
INSERT INTO `app_area` VALUES (152527, '太仆寺旗', 'Taipusiqi', 152500, 3, '0479', '027000', 115.283, 41.8773);
INSERT INTO `app_area` VALUES (152528, '镶黄旗', 'Xianghuangqi', 152500, 3, '0479', '013250', 113.845, 42.2393);
INSERT INTO `app_area` VALUES (152529, '正镶白旗', 'Zhengxiangbaiqi', 152500, 3, '0479', '013800', 115.001, 42.3071);
INSERT INTO `app_area` VALUES (152530, '正蓝旗', 'Zhenglanqi', 152500, 3, '0479', '027200', 116.004, 42.2523);
INSERT INTO `app_area` VALUES (152531, '多伦县', 'Duolun', 152500, 3, '0479', '027300', 116.486, 42.203);
INSERT INTO `app_area` VALUES (152900, '阿拉善盟', 'Alxa', 150000, 2, '0483', '750306', 105.706, 38.8448);
INSERT INTO `app_area` VALUES (152921, '阿拉善左旗', 'Alashanzuoqi', 152900, 3, '0483', '750306', 105.675, 38.8293);
INSERT INTO `app_area` VALUES (152922, '阿拉善右旗', 'Alashanyouqi', 152900, 3, '0483', '737300', 101.667, 39.2153);
INSERT INTO `app_area` VALUES (152923, '额济纳旗', 'Ejinaqi', 152900, 3, '0483', '735400', 101.069, 41.9675);
INSERT INTO `app_area` VALUES (210000, '辽宁省', 'Liaoning', 100000, 1, '', '', 123.429, 41.7968);
INSERT INTO `app_area` VALUES (210100, '沈阳市', 'Shenyang', 210000, 2, '024', '110013', 123.429, 41.7968);
INSERT INTO `app_area` VALUES (210102, '和平区', 'Heping', 210100, 3, '024', '110001', 123.42, 41.79);
INSERT INTO `app_area` VALUES (210103, '沈河区', 'Shenhe', 210100, 3, '024', '110011', 123.459, 41.7962);
INSERT INTO `app_area` VALUES (210104, '大东区', 'Dadong', 210100, 3, '024', '110041', 123.47, 41.8054);
INSERT INTO `app_area` VALUES (210105, '皇姑区', 'Huanggu', 210100, 3, '024', '110031', 123.425, 41.8204);
INSERT INTO `app_area` VALUES (210106, '铁西区', 'Tiexi', 210100, 3, '024', '110021', 123.377, 41.8027);
INSERT INTO `app_area` VALUES (210111, '苏家屯区', 'Sujiatun', 210100, 3, '024', '110101', 123.344, 41.6647);
INSERT INTO `app_area` VALUES (210112, '浑南区', 'Hunnan', 210100, 3, '024', '110015', 123.458, 41.7195);
INSERT INTO `app_area` VALUES (210113, '沈北新区', 'Shenbeixinqu', 210100, 3, '024', '110121', 123.527, 42.053);
INSERT INTO `app_area` VALUES (210114, '于洪区', 'Yuhong', 210100, 3, '024', '110141', 123.308, 41.794);
INSERT INTO `app_area` VALUES (210122, '辽中县', 'Liaozhong', 210100, 3, '024', '110200', 122.727, 41.513);
INSERT INTO `app_area` VALUES (210123, '康平县', 'Kangping', 210100, 3, '024', '110500', 123.354, 42.7508);
INSERT INTO `app_area` VALUES (210124, '法库县', 'Faku', 210100, 3, '024', '110400', 123.412, 42.5061);
INSERT INTO `app_area` VALUES (210181, '新民市', 'Xinmin', 210100, 3, '024', '110300', 122.829, 41.9985);
INSERT INTO `app_area` VALUES (210200, '大连市', 'Dalian', 210000, 2, '0411', '116011', 121.619, 38.9146);
INSERT INTO `app_area` VALUES (210202, '中山区', 'Zhongshan', 210200, 3, '0411', '116001', 121.645, 38.9186);
INSERT INTO `app_area` VALUES (210203, '西岗区', 'Xigang', 210200, 3, '0411', '116011', 121.612, 38.9147);
INSERT INTO `app_area` VALUES (210204, '沙河口区', 'Shahekou', 210200, 3, '0411', '116021', 121.58, 38.9054);
INSERT INTO `app_area` VALUES (210211, '甘井子区', 'Ganjingzi', 210200, 3, '0411', '116033', 121.566, 38.9502);
INSERT INTO `app_area` VALUES (210212, '旅顺口区', 'Lvshunkou', 210200, 3, '0411', '116041', 121.262, 38.8512);
INSERT INTO `app_area` VALUES (210213, '金州区', 'Jinzhou', 210200, 3, '0411', '116100', 121.719, 39.1004);
INSERT INTO `app_area` VALUES (210224, '长海县', 'Changhai', 210200, 3, '0411', '116500', 122.589, 39.2727);
INSERT INTO `app_area` VALUES (210281, '瓦房店市', 'Wafangdian', 210200, 3, '0411', '116300', 121.981, 39.6284);
INSERT INTO `app_area` VALUES (210282, '普兰店市', 'Pulandian', 210200, 3, '0411', '116200', 121.963, 39.3946);
INSERT INTO `app_area` VALUES (210283, '庄河市', 'Zhuanghe', 210200, 3, '0411', '116400', 122.967, 39.6881);
INSERT INTO `app_area` VALUES (210300, '鞍山市', 'Anshan', 210000, 2, '0412', '114001', 122.996, 41.1106);
INSERT INTO `app_area` VALUES (210302, '铁东区', 'Tiedong', 210300, 3, '0412', '114001', 122.991, 41.0897);
INSERT INTO `app_area` VALUES (210303, '铁西区', 'Tiexi', 210300, 3, '0413', '114013', 122.97, 41.1198);
INSERT INTO `app_area` VALUES (210304, '立山区', 'Lishan', 210300, 3, '0414', '114031', 123.029, 41.1501);
INSERT INTO `app_area` VALUES (210311, '千山区', 'Qianshan', 210300, 3, '0415', '114041', 122.96, 41.0751);
INSERT INTO `app_area` VALUES (210321, '台安县', 'Tai\'an', 210300, 3, '0417', '114100', 122.436, 41.4127);
INSERT INTO `app_area` VALUES (210323, '岫岩满族自治县', 'Xiuyan', 210300, 3, '0418', '114300', 123.289, 40.28);
INSERT INTO `app_area` VALUES (210381, '海城市', 'Haicheng', 210300, 3, '0416', '114200', 122.685, 40.8814);
INSERT INTO `app_area` VALUES (210400, '抚顺市', 'Fushun', 210000, 2, '024', '113008', 123.921, 41.876);
INSERT INTO `app_area` VALUES (210402, '新抚区', 'Xinfu', 210400, 3, '024', '113008', 123.913, 41.862);
INSERT INTO `app_area` VALUES (210403, '东洲区', 'Dongzhou', 210400, 3, '024', '113003', 124.038, 41.8519);
INSERT INTO `app_area` VALUES (210404, '望花区', 'Wanghua', 210400, 3, '024', '113001', 123.783, 41.8553);
INSERT INTO `app_area` VALUES (210411, '顺城区', 'Shuncheng', 210400, 3, '024', '113006', 123.945, 41.8832);
INSERT INTO `app_area` VALUES (210421, '抚顺县', 'Fushun', 210400, 3, '024', '113006', 124.178, 41.7122);
INSERT INTO `app_area` VALUES (210422, '新宾满族自治县', 'Xinbin', 210400, 3, '024', '113200', 125.04, 41.7341);
INSERT INTO `app_area` VALUES (210423, '清原满族自治县', 'Qingyuan', 210400, 3, '024', '113300', 124.928, 42.1022);
INSERT INTO `app_area` VALUES (210500, '本溪市', 'Benxi', 210000, 2, '0414', '117000', 123.771, 41.2979);
INSERT INTO `app_area` VALUES (210502, '平山区', 'Pingshan', 210500, 3, '0414', '117000', 123.769, 41.2997);
INSERT INTO `app_area` VALUES (210503, '溪湖区', 'Xihu', 210500, 3, '0414', '117002', 123.768, 41.3292);
INSERT INTO `app_area` VALUES (210504, '明山区', 'Mingshan', 210500, 3, '0414', '117021', 123.817, 41.3083);
INSERT INTO `app_area` VALUES (210505, '南芬区', 'Nanfen', 210500, 3, '0414', '117014', 123.745, 41.1006);
INSERT INTO `app_area` VALUES (210521, '本溪满族自治县', 'Benxi', 210500, 3, '0414', '117100', 124.127, 41.3006);
INSERT INTO `app_area` VALUES (210522, '桓仁满族自治县', 'Huanren', 210500, 3, '0414', '117200', 125.361, 41.268);
INSERT INTO `app_area` VALUES (210600, '丹东市', 'Dandong', 210000, 2, '0415', '118000', 124.383, 40.1243);
INSERT INTO `app_area` VALUES (210602, '元宝区', 'Yuanbao', 210600, 3, '0415', '118000', 124.396, 40.1365);
INSERT INTO `app_area` VALUES (210603, '振兴区', 'Zhenxing', 210600, 3, '0415', '118002', 124.36, 40.1049);
INSERT INTO `app_area` VALUES (210604, '振安区', 'Zhen\'an', 210600, 3, '0415', '118001', 124.428, 40.1583);
INSERT INTO `app_area` VALUES (210624, '宽甸满族自治县', 'Kuandian', 210600, 3, '0415', '118200', 124.782, 40.7319);
INSERT INTO `app_area` VALUES (210681, '东港市', 'Donggang', 210600, 3, '0415', '118300', 124.163, 39.8626);
INSERT INTO `app_area` VALUES (210682, '凤城市', 'Fengcheng', 210600, 3, '0415', '118100', 124.067, 40.453);
INSERT INTO `app_area` VALUES (210700, '锦州市', 'Jinzhou', 210000, 2, '0416', '121000', 121.136, 41.1193);
INSERT INTO `app_area` VALUES (210702, '古塔区', 'Guta', 210700, 3, '0416', '121001', 121.128, 41.1172);
INSERT INTO `app_area` VALUES (210703, '凌河区', 'Linghe', 210700, 3, '0416', '121000', 121.151, 41.115);
INSERT INTO `app_area` VALUES (210711, '太和区', 'Taihe', 210700, 3, '0416', '121011', 121.104, 41.1093);
INSERT INTO `app_area` VALUES (210726, '黑山县', 'Heishan', 210700, 3, '0416', '121400', 122.121, 41.6942);
INSERT INTO `app_area` VALUES (210727, '义县', 'Yixian', 210700, 3, '0416', '121100', 121.24, 41.5346);
INSERT INTO `app_area` VALUES (210781, '凌海市', 'Linghai', 210700, 3, '0416', '121200', 121.357, 41.1737);
INSERT INTO `app_area` VALUES (210782, '北镇市', 'Beizhen', 210700, 3, '0416', '121300', 121.799, 41.5954);
INSERT INTO `app_area` VALUES (210800, '营口市', 'Yingkou', 210000, 2, '0417', '115003', 122.235, 40.6674);
INSERT INTO `app_area` VALUES (210802, '站前区', 'Zhanqian', 210800, 3, '0417', '115002', 122.259, 40.6727);
INSERT INTO `app_area` VALUES (210803, '西市区', 'Xishi', 210800, 3, '0417', '115004', 122.206, 40.6664);
INSERT INTO `app_area` VALUES (210804, '鲅鱼圈区', 'Bayuquan', 210800, 3, '0417', '115007', 122.133, 40.2687);
INSERT INTO `app_area` VALUES (210811, '老边区', 'Laobian', 210800, 3, '0417', '115005', 122.38, 40.6803);
INSERT INTO `app_area` VALUES (210881, '盖州市', 'Gaizhou', 210800, 3, '0417', '115200', 122.355, 40.4045);
INSERT INTO `app_area` VALUES (210882, '大石桥市', 'Dashiqiao', 210800, 3, '0417', '115100', 122.509, 40.6457);
INSERT INTO `app_area` VALUES (210900, '阜新市', 'Fuxin', 210000, 2, '0418', '123000', 121.649, 42.0118);
INSERT INTO `app_area` VALUES (210902, '海州区', 'Haizhou', 210900, 3, '0418', '123000', 121.656, 42.0134);
INSERT INTO `app_area` VALUES (210903, '新邱区', 'Xinqiu', 210900, 3, '0418', '123005', 121.793, 42.0918);
INSERT INTO `app_area` VALUES (210904, '太平区', 'Taiping', 210900, 3, '0418', '123003', 121.679, 42.0107);
INSERT INTO `app_area` VALUES (210905, '清河门区', 'Qinghemen', 210900, 3, '0418', '123006', 121.416, 41.7831);
INSERT INTO `app_area` VALUES (210911, '细河区', 'Xihe', 210900, 3, '0418', '123000', 121.68, 42.0253);
INSERT INTO `app_area` VALUES (210921, '阜新蒙古族自治县', 'Fuxin', 210900, 3, '0418', '123100', 121.758, 42.0651);
INSERT INTO `app_area` VALUES (210922, '彰武县', 'Zhangwu', 210900, 3, '0418', '123200', 122.54, 42.3862);
INSERT INTO `app_area` VALUES (211000, '辽阳市', 'Liaoyang', 210000, 2, '0419', '111000', 123.182, 41.2694);
INSERT INTO `app_area` VALUES (211002, '白塔区', 'Baita', 211000, 3, '0419', '111000', 123.175, 41.2702);
INSERT INTO `app_area` VALUES (211003, '文圣区', 'Wensheng', 211000, 3, '0419', '111000', 123.185, 41.2627);
INSERT INTO `app_area` VALUES (211004, '宏伟区', 'Hongwei', 211000, 3, '0419', '111003', 123.193, 41.2185);
INSERT INTO `app_area` VALUES (211005, '弓长岭区', 'Gongchangling', 211000, 3, '0419', '111008', 123.42, 41.1518);
INSERT INTO `app_area` VALUES (211011, '太子河区', 'Taizihe', 211000, 3, '0419', '111000', 123.182, 41.2534);
INSERT INTO `app_area` VALUES (211021, '辽阳县', 'Liaoyang', 211000, 3, '0419', '111200', 123.106, 41.2054);
INSERT INTO `app_area` VALUES (211081, '灯塔市', 'Dengta', 211000, 3, '0419', '111300', 123.339, 41.4261);
INSERT INTO `app_area` VALUES (211100, '盘锦市', 'Panjin', 210000, 2, '0427', '124010', 122.07, 41.1245);
INSERT INTO `app_area` VALUES (211102, '双台子区', 'Shuangtaizi', 211100, 3, '0427', '124000', 122.06, 41.1906);
INSERT INTO `app_area` VALUES (211103, '兴隆台区', 'Xinglongtai', 211100, 3, '0427', '124010', 122.075, 41.124);
INSERT INTO `app_area` VALUES (211121, '大洼县', 'Dawa', 211100, 3, '0427', '124200', 122.082, 41.0024);
INSERT INTO `app_area` VALUES (211122, '盘山县', 'Panshan', 211100, 3, '0427', '124000', 121.998, 41.238);
INSERT INTO `app_area` VALUES (211200, '铁岭市', 'Tieling', 210000, 2, '024', '112000', 123.844, 42.2906);
INSERT INTO `app_area` VALUES (211202, '银州区', 'Yinzhou', 211200, 3, '024', '112000', 123.857, 42.2951);
INSERT INTO `app_area` VALUES (211204, '清河区', 'Qinghe', 211200, 3, '024', '112003', 124.159, 42.5468);
INSERT INTO `app_area` VALUES (211221, '铁岭县', 'Tieling', 211200, 3, '024', '112000', 123.773, 42.225);
INSERT INTO `app_area` VALUES (211223, '西丰县', 'Xifeng', 211200, 3, '024', '112400', 124.73, 42.7376);
INSERT INTO `app_area` VALUES (211224, '昌图县', 'Changtu', 211200, 3, '024', '112500', 124.112, 42.7843);
INSERT INTO `app_area` VALUES (211281, '调兵山市', 'Diaobingshan', 211200, 3, '024', '112700', 123.567, 42.4675);
INSERT INTO `app_area` VALUES (211282, '开原市', 'Kaiyuan', 211200, 3, '024', '112300', 124.039, 42.5458);
INSERT INTO `app_area` VALUES (211300, '朝阳市', 'Chaoyang', 210000, 2, '0421', '122000', 120.451, 41.5768);
INSERT INTO `app_area` VALUES (211302, '双塔区', 'Shuangta', 211300, 3, '0421', '122000', 120.454, 41.566);
INSERT INTO `app_area` VALUES (211303, '龙城区', 'Longcheng', 211300, 3, '0421', '122000', 120.437, 41.5926);
INSERT INTO `app_area` VALUES (211321, '朝阳县', 'Chaoyang', 211300, 3, '0421', '122000', 120.174, 41.4324);
INSERT INTO `app_area` VALUES (211322, '建平县', 'Jianping', 211300, 3, '0421', '122400', 119.644, 41.4031);
INSERT INTO `app_area` VALUES (211324, '喀喇沁左翼蒙古族自治县', 'Kalaqinzuoyi', 211300, 3, '0421', '122300', 119.742, 41.128);
INSERT INTO `app_area` VALUES (211381, '北票市', 'Beipiao', 211300, 3, '0421', '122100', 120.77, 41.802);
INSERT INTO `app_area` VALUES (211382, '凌源市', 'Lingyuan', 211300, 3, '0421', '122500', 119.401, 41.2456);
INSERT INTO `app_area` VALUES (211400, '葫芦岛市', 'Huludao', 210000, 2, '0429', '125000', 120.856, 40.7556);
INSERT INTO `app_area` VALUES (211402, '连山区', 'Lianshan', 211400, 3, '0429', '125001', 120.864, 40.7555);
INSERT INTO `app_area` VALUES (211403, '龙港区', 'Longgang', 211400, 3, '0429', '125003', 120.949, 40.7192);
INSERT INTO `app_area` VALUES (211404, '南票区', 'Nanpiao', 211400, 3, '0429', '125027', 120.75, 41.1071);
INSERT INTO `app_area` VALUES (211421, '绥中县', 'Suizhong', 211400, 3, '0429', '125200', 120.345, 40.3255);
INSERT INTO `app_area` VALUES (211422, '建昌县', 'Jianchang', 211400, 3, '0429', '125300', 119.838, 40.8245);
INSERT INTO `app_area` VALUES (211481, '兴城市', 'Xingcheng', 211400, 3, '0429', '125100', 120.725, 40.6149);
INSERT INTO `app_area` VALUES (211500, '金普新区', 'Jinpuxinqu', 210000, 2, '0411', '116100', 121.79, 39.0555);
INSERT INTO `app_area` VALUES (211501, '金州新区', 'Jinzhouxinqu', 211500, 3, '0411', '116100', 121.785, 39.0523);
INSERT INTO `app_area` VALUES (211502, '普湾新区', 'Puwanxinqu', 211500, 3, '0411', '116200', 121.813, 39.3301);
INSERT INTO `app_area` VALUES (211503, '保税区', 'Baoshuiqu', 211500, 3, '0411', '116100', 121.943, 39.2246);
INSERT INTO `app_area` VALUES (220000, '吉林省', 'Jilin', 100000, 1, '', '', 125.325, 43.8868);
INSERT INTO `app_area` VALUES (220100, '长春市', 'Changchun', 220000, 2, '0431', '130022', 125.325, 43.8868);
INSERT INTO `app_area` VALUES (220102, '南关区', 'Nanguan', 220100, 3, '0431', '130022', 125.35, 43.864);
INSERT INTO `app_area` VALUES (220103, '宽城区', 'Kuancheng', 220100, 3, '0431', '130051', 125.326, 43.9018);
INSERT INTO `app_area` VALUES (220104, '朝阳区', 'Chaoyang', 220100, 3, '0431', '130012', 125.288, 43.8334);
INSERT INTO `app_area` VALUES (220105, '二道区', 'Erdao', 220100, 3, '0431', '130031', 125.374, 43.865);
INSERT INTO `app_area` VALUES (220106, '绿园区', 'Lvyuan', 220100, 3, '0431', '130062', 125.256, 43.8805);
INSERT INTO `app_area` VALUES (220112, '双阳区', 'Shuangyang', 220100, 3, '0431', '130600', 125.656, 43.528);
INSERT INTO `app_area` VALUES (220113, '九台区', 'Jiutai', 220100, 3, '0431', '130500', 125.84, 44.1516);
INSERT INTO `app_area` VALUES (220122, '农安县', 'Nong\'an', 220100, 3, '0431', '130200', 125.185, 44.4327);
INSERT INTO `app_area` VALUES (220182, '榆树市', 'Yushu', 220100, 3, '0431', '130400', 126.557, 44.8252);
INSERT INTO `app_area` VALUES (220183, '德惠市', 'Dehui', 220100, 3, '0431', '130300', 125.705, 44.5372);
INSERT INTO `app_area` VALUES (220200, '吉林市', 'Jilin', 220000, 2, '0432', '132011', 126.553, 43.8436);
INSERT INTO `app_area` VALUES (220202, '昌邑区', 'Changyi', 220200, 3, '0432', '132002', 126.574, 43.8818);
INSERT INTO `app_area` VALUES (220203, '龙潭区', 'Longtan', 220200, 3, '0432', '132021', 126.562, 43.9105);
INSERT INTO `app_area` VALUES (220204, '船营区', 'Chuanying', 220200, 3, '0432', '132011', 126.541, 43.8334);
INSERT INTO `app_area` VALUES (220211, '丰满区', 'Fengman', 220200, 3, '0432', '132013', 126.562, 43.8224);
INSERT INTO `app_area` VALUES (220221, '永吉县', 'Yongji', 220200, 3, '0432', '132200', 126.496, 43.672);
INSERT INTO `app_area` VALUES (220281, '蛟河市', 'Jiaohe', 220200, 3, '0432', '132500', 127.344, 43.727);
INSERT INTO `app_area` VALUES (220282, '桦甸市', 'Huadian', 220200, 3, '0432', '132400', 126.746, 42.9721);
INSERT INTO `app_area` VALUES (220283, '舒兰市', 'Shulan', 220200, 3, '0432', '132600', 126.965, 44.4058);
INSERT INTO `app_area` VALUES (220284, '磐石市', 'Panshi', 220200, 3, '0432', '132300', 126.062, 42.9463);
INSERT INTO `app_area` VALUES (220300, '四平市', 'Siping', 220000, 2, '0434', '136000', 124.371, 43.1703);
INSERT INTO `app_area` VALUES (220302, '铁西区', 'Tiexi', 220300, 3, '0434', '136000', 124.374, 43.1746);
INSERT INTO `app_area` VALUES (220303, '铁东区', 'Tiedong', 220300, 3, '0434', '136001', 124.41, 43.1624);
INSERT INTO `app_area` VALUES (220322, '梨树县', 'Lishu', 220300, 3, '0434', '136500', 124.336, 43.3072);
INSERT INTO `app_area` VALUES (220323, '伊通满族自治县', 'Yitong', 220300, 3, '0434', '130700', 125.306, 43.3443);
INSERT INTO `app_area` VALUES (220381, '公主岭市', 'Gongzhuling', 220300, 3, '0434', '136100', 124.823, 43.5045);
INSERT INTO `app_area` VALUES (220382, '双辽市', 'Shuangliao', 220300, 3, '0434', '136400', 123.501, 43.521);
INSERT INTO `app_area` VALUES (220400, '辽源市', 'Liaoyuan', 220000, 2, '0437', '136200', 125.145, 42.9027);
INSERT INTO `app_area` VALUES (220402, '龙山区', 'Longshan', 220400, 3, '0437', '136200', 125.136, 42.8971);
INSERT INTO `app_area` VALUES (220403, '西安区', 'Xi\'an', 220400, 3, '0437', '136201', 125.149, 42.927);
INSERT INTO `app_area` VALUES (220421, '东丰县', 'Dongfeng', 220400, 3, '0437', '136300', 125.532, 42.6783);
INSERT INTO `app_area` VALUES (220422, '东辽县', 'Dongliao', 220400, 3, '0437', '136600', 124.986, 42.9249);
INSERT INTO `app_area` VALUES (220500, '通化市', 'Tonghua', 220000, 2, '0435', '134001', 125.937, 41.7212);
INSERT INTO `app_area` VALUES (220502, '东昌区', 'Dongchang', 220500, 3, '0435', '134001', 125.955, 41.7285);
INSERT INTO `app_area` VALUES (220503, '二道江区', 'Erdaojiang', 220500, 3, '0435', '134003', 126.043, 41.7741);
INSERT INTO `app_area` VALUES (220521, '通化县', 'Tonghua', 220500, 3, '0435', '134100', 125.759, 41.6793);
INSERT INTO `app_area` VALUES (220523, '辉南县', 'Huinan', 220500, 3, '0435', '135100', 126.047, 42.685);
INSERT INTO `app_area` VALUES (220524, '柳河县', 'Liuhe', 220500, 3, '0435', '135300', 125.745, 42.2847);
INSERT INTO `app_area` VALUES (220581, '梅河口市', 'Meihekou', 220500, 3, '0435', '135000', 125.71, 42.5383);
INSERT INTO `app_area` VALUES (220582, '集安市', 'Ji\'an', 220500, 3, '0435', '134200', 126.188, 41.1227);
INSERT INTO `app_area` VALUES (220600, '白山市', 'Baishan', 220000, 2, '0439', '134300', 126.428, 41.9425);
INSERT INTO `app_area` VALUES (220602, '浑江区', 'Hunjiang', 220600, 3, '0439', '134300', 126.422, 41.9457);
INSERT INTO `app_area` VALUES (220605, '江源区', 'Jiangyuan', 220600, 3, '0439', '134700', 126.591, 42.0566);
INSERT INTO `app_area` VALUES (220621, '抚松县', 'Fusong', 220600, 3, '0439', '134500', 127.28, 42.342);
INSERT INTO `app_area` VALUES (220622, '靖宇县', 'Jingyu', 220600, 3, '0439', '135200', 126.813, 42.3886);
INSERT INTO `app_area` VALUES (220623, '长白朝鲜族自治县', 'Changbai', 220600, 3, '0439', '134400', 128.2, 41.42);
INSERT INTO `app_area` VALUES (220681, '临江市', 'Linjiang', 220600, 3, '0439', '134600', 126.918, 41.8114);
INSERT INTO `app_area` VALUES (220700, '松原市', 'Songyuan', 220000, 2, '0438', '138000', 124.824, 45.1182);
INSERT INTO `app_area` VALUES (220702, '宁江区', 'Ningjiang', 220700, 3, '0438', '138000', 124.817, 45.1717);
INSERT INTO `app_area` VALUES (220721, '前郭尔罗斯蒙古族自治县', 'Qianguoerluosi', 220700, 3, '0438', '138000', 124.824, 45.1173);
INSERT INTO `app_area` VALUES (220722, '长岭县', 'Changling', 220700, 3, '0438', '131500', 123.967, 44.2758);
INSERT INTO `app_area` VALUES (220723, '乾安县', 'Qian\'an', 220700, 3, '0438', '131400', 124.027, 45.0107);
INSERT INTO `app_area` VALUES (220781, '扶余市', 'Fuyu', 220700, 3, '0438', '131200', 126.043, 44.9862);
INSERT INTO `app_area` VALUES (220800, '白城市', 'Baicheng', 220000, 2, '0436', '137000', 122.841, 45.619);
INSERT INTO `app_area` VALUES (220802, '洮北区', 'Taobei', 220800, 3, '0436', '137000', 122.851, 45.6217);
INSERT INTO `app_area` VALUES (220821, '镇赉县', 'Zhenlai', 220800, 3, '0436', '137300', 123.199, 45.8478);
INSERT INTO `app_area` VALUES (220822, '通榆县', 'Tongyu', 220800, 3, '0436', '137200', 123.088, 44.8139);
INSERT INTO `app_area` VALUES (220881, '洮南市', 'Taonan', 220800, 3, '0436', '137100', 122.788, 45.335);
INSERT INTO `app_area` VALUES (220882, '大安市', 'Da\'an', 220800, 3, '0436', '131300', 124.295, 45.5085);
INSERT INTO `app_area` VALUES (222400, '延边朝鲜族自治州', 'Yanbian', 220000, 2, '0433', '133000', 129.513, 42.9048);
INSERT INTO `app_area` VALUES (222401, '延吉市', 'Yanji', 222400, 3, '0433', '133000', 129.514, 42.9068);
INSERT INTO `app_area` VALUES (222402, '图们市', 'Tumen', 222400, 3, '0433', '133100', 129.844, 42.968);
INSERT INTO `app_area` VALUES (222403, '敦化市', 'Dunhua', 222400, 3, '0433', '133700', 128.232, 43.373);
INSERT INTO `app_area` VALUES (222404, '珲春市', 'Hunchun', 222400, 3, '0433', '133300', 130.366, 42.8624);
INSERT INTO `app_area` VALUES (222405, '龙井市', 'Longjing', 222400, 3, '0433', '133400', 129.426, 42.768);
INSERT INTO `app_area` VALUES (222406, '和龙市', 'Helong', 222400, 3, '0433', '133500', 129.011, 42.5464);
INSERT INTO `app_area` VALUES (222424, '汪清县', 'Wangqing', 222400, 3, '0433', '133200', 129.771, 43.3128);
INSERT INTO `app_area` VALUES (222426, '安图县', 'Antu', 222400, 3, '0433', '133600', 128.906, 43.1153);
INSERT INTO `app_area` VALUES (230000, '黑龙江省', 'Heilongjiang', 100000, 1, '', '', 126.642, 45.757);
INSERT INTO `app_area` VALUES (230100, '哈尔滨市', 'Harbin', 230000, 2, '0451', '150010', 126.642, 45.757);
INSERT INTO `app_area` VALUES (230102, '道里区', 'Daoli', 230100, 3, '0451', '150010', 126.617, 45.7559);
INSERT INTO `app_area` VALUES (230103, '南岗区', 'Nangang', 230100, 3, '0451', '150006', 126.669, 45.76);
INSERT INTO `app_area` VALUES (230104, '道外区', 'Daowai', 230100, 3, '0451', '150020', 126.649, 45.7919);
INSERT INTO `app_area` VALUES (230108, '平房区', 'Pingfang', 230100, 3, '0451', '150060', 126.637, 45.5978);
INSERT INTO `app_area` VALUES (230109, '松北区', 'Songbei', 230100, 3, '0451', '150028', 126.563, 45.8083);
INSERT INTO `app_area` VALUES (230110, '香坊区', 'Xiangfang', 230100, 3, '0451', '150036', 126.68, 45.7238);
INSERT INTO `app_area` VALUES (230111, '呼兰区', 'Hulan', 230100, 3, '0451', '150500', 126.588, 45.889);
INSERT INTO `app_area` VALUES (230112, '阿城区', 'A\'cheng', 230100, 3, '0451', '150300', 126.975, 45.5414);
INSERT INTO `app_area` VALUES (230113, '双城区', 'Shuangcheng', 230100, 3, '0451', '150100', 126.309, 45.3779);
INSERT INTO `app_area` VALUES (230123, '依兰县', 'Yilan', 230100, 3, '0451', '154800', 129.568, 46.3247);
INSERT INTO `app_area` VALUES (230124, '方正县', 'Fangzheng', 230100, 3, '0451', '150800', 128.83, 45.8516);
INSERT INTO `app_area` VALUES (230125, '宾县', 'Binxian', 230100, 3, '0451', '150400', 127.487, 45.755);
INSERT INTO `app_area` VALUES (230126, '巴彦县', 'Bayan', 230100, 3, '0451', '151800', 127.408, 46.0815);
INSERT INTO `app_area` VALUES (230127, '木兰县', 'Mulan', 230100, 3, '0451', '151900', 128.045, 45.9494);
INSERT INTO `app_area` VALUES (230128, '通河县', 'Tonghe', 230100, 3, '0451', '150900', 128.746, 45.9901);
INSERT INTO `app_area` VALUES (230129, '延寿县', 'Yanshou', 230100, 3, '0451', '150700', 128.334, 45.4554);
INSERT INTO `app_area` VALUES (230183, '尚志市', 'Shangzhi', 230100, 3, '0451', '150600', 127.962, 45.2174);
INSERT INTO `app_area` VALUES (230184, '五常市', 'Wuchang', 230100, 3, '0451', '150200', 127.168, 44.9318);
INSERT INTO `app_area` VALUES (230200, '齐齐哈尔市', 'Qiqihar', 230000, 2, '0452', '161005', 123.953, 47.3481);
INSERT INTO `app_area` VALUES (230202, '龙沙区', 'Longsha', 230200, 3, '0452', '161000', 123.958, 47.3178);
INSERT INTO `app_area` VALUES (230203, '建华区', 'Jianhua', 230200, 3, '0452', '161006', 124.013, 47.3672);
INSERT INTO `app_area` VALUES (230204, '铁锋区', 'Tiefeng', 230200, 3, '0452', '161000', 123.978, 47.3408);
INSERT INTO `app_area` VALUES (230205, '昂昂溪区', 'Angangxi', 230200, 3, '0452', '161031', 123.822, 47.1551);
INSERT INTO `app_area` VALUES (230206, '富拉尔基区', 'Fulaerji', 230200, 3, '0452', '161041', 123.629, 47.2088);
INSERT INTO `app_area` VALUES (230207, '碾子山区', 'Nianzishan', 230200, 3, '0452', '161046', 122.882, 47.5166);
INSERT INTO `app_area` VALUES (230208, '梅里斯达斡尔族区', 'Meilisi', 230200, 3, '0452', '161021', 123.753, 47.3095);
INSERT INTO `app_area` VALUES (230221, '龙江县', 'Longjiang', 230200, 3, '0452', '161100', 123.205, 47.3387);
INSERT INTO `app_area` VALUES (230223, '依安县', 'Yi\'an', 230200, 3, '0452', '161500', 125.309, 47.8931);
INSERT INTO `app_area` VALUES (230224, '泰来县', 'Tailai', 230200, 3, '0452', '162400', 123.423, 46.3939);
INSERT INTO `app_area` VALUES (230225, '甘南县', 'Gannan', 230200, 3, '0452', '162100', 123.503, 47.9244);
INSERT INTO `app_area` VALUES (230227, '富裕县', 'Fuyu', 230200, 3, '0452', '161200', 124.475, 47.7743);
INSERT INTO `app_area` VALUES (230229, '克山县', 'Keshan', 230200, 3, '0452', '161600', 125.874, 48.0326);
INSERT INTO `app_area` VALUES (230230, '克东县', 'Kedong', 230200, 3, '0452', '164800', 126.249, 48.0383);
INSERT INTO `app_area` VALUES (230231, '拜泉县', 'Baiquan', 230200, 3, '0452', '164700', 126.092, 47.6082);
INSERT INTO `app_area` VALUES (230281, '讷河市', 'Nehe', 230200, 3, '0452', '161300', 124.877, 48.4839);
INSERT INTO `app_area` VALUES (230300, '鸡西市', 'Jixi', 230000, 2, '0467', '158100', 130.976, 45.3);
INSERT INTO `app_area` VALUES (230302, '鸡冠区', 'Jiguan', 230300, 3, '0467', '158100', 130.981, 45.304);
INSERT INTO `app_area` VALUES (230303, '恒山区', 'Hengshan', 230300, 3, '0467', '158130', 130.905, 45.2107);
INSERT INTO `app_area` VALUES (230304, '滴道区', 'Didao', 230300, 3, '0467', '158150', 130.848, 45.3511);
INSERT INTO `app_area` VALUES (230305, '梨树区', 'Lishu', 230300, 3, '0467', '158160', 130.698, 45.0904);
INSERT INTO `app_area` VALUES (230306, '城子河区', 'Chengzihe', 230300, 3, '0467', '158170', 131.011, 45.3369);
INSERT INTO `app_area` VALUES (230307, '麻山区', 'Mashan', 230300, 3, '0467', '158180', 130.478, 45.2121);
INSERT INTO `app_area` VALUES (230321, '鸡东县', 'Jidong', 230300, 3, '0467', '158200', 131.124, 45.2603);
INSERT INTO `app_area` VALUES (230381, '虎林市', 'Hulin', 230300, 3, '0467', '158400', 132.937, 45.7629);
INSERT INTO `app_area` VALUES (230382, '密山市', 'Mishan', 230300, 3, '0467', '158300', 131.846, 45.5297);
INSERT INTO `app_area` VALUES (230400, '鹤岗市', 'Hegang', 230000, 2, '0468', '154100', 130.277, 47.3321);
INSERT INTO `app_area` VALUES (230402, '向阳区', 'Xiangyang', 230400, 3, '0468', '154100', 130.294, 47.3425);
INSERT INTO `app_area` VALUES (230403, '工农区', 'Gongnong', 230400, 3, '0468', '154101', 130.275, 47.3187);
INSERT INTO `app_area` VALUES (230404, '南山区', 'Nanshan', 230400, 3, '0468', '154104', 130.277, 47.314);
INSERT INTO `app_area` VALUES (230405, '兴安区', 'Xing\'an', 230400, 3, '0468', '154102', 130.24, 47.2526);
INSERT INTO `app_area` VALUES (230406, '东山区', 'Dongshan', 230400, 3, '0468', '154106', 130.317, 47.3385);
INSERT INTO `app_area` VALUES (230407, '兴山区', 'Xingshan', 230400, 3, '0468', '154105', 130.293, 47.3578);
INSERT INTO `app_area` VALUES (230421, '萝北县', 'Luobei', 230400, 3, '0468', '154200', 130.833, 47.5796);
INSERT INTO `app_area` VALUES (230422, '绥滨县', 'Suibin', 230400, 3, '0468', '156200', 131.86, 47.2903);
INSERT INTO `app_area` VALUES (230500, '双鸭山市', 'Shuangyashan', 230000, 2, '0469', '155100', 131.157, 46.6434);
INSERT INTO `app_area` VALUES (230502, '尖山区', 'Jianshan', 230500, 3, '0469', '155100', 131.158, 46.6464);
INSERT INTO `app_area` VALUES (230503, '岭东区', 'Lingdong', 230500, 3, '0469', '155120', 131.165, 46.5904);
INSERT INTO `app_area` VALUES (230505, '四方台区', 'Sifangtai', 230500, 3, '0469', '155130', 131.336, 46.595);
INSERT INTO `app_area` VALUES (230506, '宝山区', 'Baoshan', 230500, 3, '0469', '155131', 131.402, 46.5772);
INSERT INTO `app_area` VALUES (230521, '集贤县', 'Jixian', 230500, 3, '0469', '155900', 131.141, 46.7268);
INSERT INTO `app_area` VALUES (230522, '友谊县', 'Youyi', 230500, 3, '0469', '155800', 131.808, 46.7674);
INSERT INTO `app_area` VALUES (230523, '宝清县', 'Baoqing', 230500, 3, '0469', '155600', 132.197, 46.3272);
INSERT INTO `app_area` VALUES (230524, '饶河县', 'Raohe', 230500, 3, '0469', '155700', 134.02, 46.799);
INSERT INTO `app_area` VALUES (230600, '大庆市', 'Daqing', 230000, 2, '0459', '163000', 125.113, 46.5907);
INSERT INTO `app_area` VALUES (230602, '萨尔图区', 'Saertu', 230600, 3, '0459', '163001', 125.088, 46.5936);
INSERT INTO `app_area` VALUES (230603, '龙凤区', 'Longfeng', 230600, 3, '0459', '163711', 125.117, 46.5327);
INSERT INTO `app_area` VALUES (230604, '让胡路区', 'Ranghulu', 230600, 3, '0459', '163712', 124.871, 46.6522);
INSERT INTO `app_area` VALUES (230605, '红岗区', 'Honggang', 230600, 3, '0459', '163511', 124.892, 46.4013);
INSERT INTO `app_area` VALUES (230606, '大同区', 'Datong', 230600, 3, '0459', '163515', 124.816, 46.033);
INSERT INTO `app_area` VALUES (230621, '肇州县', 'Zhaozhou', 230600, 3, '0459', '166400', 125.271, 45.7041);
INSERT INTO `app_area` VALUES (230622, '肇源县', 'Zhaoyuan', 230600, 3, '0459', '166500', 125.085, 45.5203);
INSERT INTO `app_area` VALUES (230623, '林甸县', 'Lindian', 230600, 3, '0459', '166300', 124.876, 47.186);
INSERT INTO `app_area` VALUES (230624, '杜尔伯特蒙古族自治县', 'Duerbote', 230600, 3, '0459', '166200', 124.449, 46.8651);
INSERT INTO `app_area` VALUES (230700, '伊春市', 'Yichun', 230000, 2, '0458', '153000', 128.899, 47.7248);
INSERT INTO `app_area` VALUES (230702, '伊春区', 'Yichun', 230700, 3, '0458', '153000', 128.908, 47.728);
INSERT INTO `app_area` VALUES (230703, '南岔区', 'Nancha', 230700, 3, '0458', '153100', 129.284, 47.139);
INSERT INTO `app_area` VALUES (230704, '友好区', 'Youhao', 230700, 3, '0458', '153031', 128.84, 47.8537);
INSERT INTO `app_area` VALUES (230705, '西林区', 'Xilin', 230700, 3, '0458', '153025', 129.312, 47.481);
INSERT INTO `app_area` VALUES (230706, '翠峦区', 'Cuiluan', 230700, 3, '0458', '153013', 128.667, 47.725);
INSERT INTO `app_area` VALUES (230707, '新青区', 'Xinqing', 230700, 3, '0458', '153036', 129.537, 48.2907);
INSERT INTO `app_area` VALUES (230708, '美溪区', 'Meixi', 230700, 3, '0458', '153021', 129.137, 47.6351);
INSERT INTO `app_area` VALUES (230709, '金山屯区', 'Jinshantun', 230700, 3, '0458', '153026', 129.438, 47.4135);
INSERT INTO `app_area` VALUES (230710, '五营区', 'Wuying', 230700, 3, '0458', '153033', 129.245, 48.1079);
INSERT INTO `app_area` VALUES (230711, '乌马河区', 'Wumahe', 230700, 3, '0458', '153011', 128.797, 47.728);
INSERT INTO `app_area` VALUES (230712, '汤旺河区', 'Tangwanghe', 230700, 3, '0458', '153037', 129.572, 48.4518);
INSERT INTO `app_area` VALUES (230713, '带岭区', 'Dailing', 230700, 3, '0458', '153106', 129.024, 47.0255);
INSERT INTO `app_area` VALUES (230714, '乌伊岭区', 'Wuyiling', 230700, 3, '0458', '153038', 129.44, 48.596);
INSERT INTO `app_area` VALUES (230715, '红星区', 'Hongxing', 230700, 3, '0458', '153035', 129.389, 48.2394);
INSERT INTO `app_area` VALUES (230716, '上甘岭区', 'Shangganling', 230700, 3, '0458', '153032', 129.024, 47.9752);
INSERT INTO `app_area` VALUES (230722, '嘉荫县', 'Jiayin', 230700, 3, '0458', '153200', 130.398, 48.8917);
INSERT INTO `app_area` VALUES (230781, '铁力市', 'Tieli', 230700, 3, '0458', '152500', 128.032, 46.9857);
INSERT INTO `app_area` VALUES (230800, '佳木斯市', 'Jiamusi', 230000, 2, '0454', '154002', 130.362, 46.8096);
INSERT INTO `app_area` VALUES (230803, '向阳区', 'Xiangyang', 230800, 3, '0454', '154002', 130.365, 46.8078);
INSERT INTO `app_area` VALUES (230804, '前进区', 'Qianjin', 230800, 3, '0454', '154002', 130.375, 46.814);
INSERT INTO `app_area` VALUES (230805, '东风区', 'Dongfeng', 230800, 3, '0454', '154005', 130.404, 46.8226);
INSERT INTO `app_area` VALUES (230811, '郊区', 'Jiaoqu', 230800, 3, '0454', '154004', 130.327, 46.8096);
INSERT INTO `app_area` VALUES (230822, '桦南县', 'Huanan', 230800, 3, '0454', '154400', 130.554, 46.2392);
INSERT INTO `app_area` VALUES (230826, '桦川县', 'Huachuan', 230800, 3, '0454', '154300', 130.719, 47.023);
INSERT INTO `app_area` VALUES (230828, '汤原县', 'Tangyuan', 230800, 3, '0454', '154700', 129.91, 46.7276);
INSERT INTO `app_area` VALUES (230833, '抚远县', 'Fuyuan', 230800, 3, '0454', '156500', 134.296, 48.3679);
INSERT INTO `app_area` VALUES (230881, '同江市', 'Tongjiang', 230800, 3, '0454', '156400', 132.511, 47.6421);
INSERT INTO `app_area` VALUES (230882, '富锦市', 'Fujin', 230800, 3, '0454', '156100', 132.037, 47.2513);
INSERT INTO `app_area` VALUES (230900, '七台河市', 'Qitaihe', 230000, 2, '0464', '154600', 131.016, 45.7713);
INSERT INTO `app_area` VALUES (230902, '新兴区', 'Xinxing', 230900, 3, '0464', '154604', 130.932, 45.8162);
INSERT INTO `app_area` VALUES (230903, '桃山区', 'Taoshan', 230900, 3, '0464', '154600', 131.018, 45.7678);
INSERT INTO `app_area` VALUES (230904, '茄子河区', 'Qiezihe', 230900, 3, '0464', '154622', 131.068, 45.7852);
INSERT INTO `app_area` VALUES (230921, '勃利县', 'Boli', 230900, 3, '0464', '154500', 130.592, 45.755);
INSERT INTO `app_area` VALUES (231000, '牡丹江市', 'Mudanjiang', 230000, 2, '0453', '157000', 129.619, 44.583);
INSERT INTO `app_area` VALUES (231002, '东安区', 'Dong\'an', 231000, 3, '0453', '157000', 129.627, 44.5813);
INSERT INTO `app_area` VALUES (231003, '阳明区', 'Yangming', 231000, 3, '0453', '157013', 129.635, 44.596);
INSERT INTO `app_area` VALUES (231004, '爱民区', 'Aimin', 231000, 3, '0453', '157009', 129.591, 44.5965);
INSERT INTO `app_area` VALUES (231005, '西安区', 'Xi\'an', 231000, 3, '0453', '157000', 129.616, 44.5777);
INSERT INTO `app_area` VALUES (231024, '东宁县', 'Dongning', 231000, 3, '0453', '157200', 131.128, 44.0661);
INSERT INTO `app_area` VALUES (231025, '林口县', 'Linkou', 231000, 3, '0453', '157600', 130.284, 45.2781);
INSERT INTO `app_area` VALUES (231081, '绥芬河市', 'Suifenhe', 231000, 3, '0453', '157300', 131.151, 44.4125);
INSERT INTO `app_area` VALUES (231083, '海林市', 'Hailin', 231000, 3, '0453', '157100', 129.382, 44.59);
INSERT INTO `app_area` VALUES (231084, '宁安市', 'Ning\'an', 231000, 3, '0453', '157400', 129.483, 44.3402);
INSERT INTO `app_area` VALUES (231085, '穆棱市', 'Muling', 231000, 3, '0453', '157500', 130.525, 44.919);
INSERT INTO `app_area` VALUES (231100, '黑河市', 'Heihe', 230000, 2, '0456', '164300', 127.499, 50.2496);
INSERT INTO `app_area` VALUES (231102, '爱辉区', 'Aihui', 231100, 3, '0456', '164300', 127.501, 50.252);
INSERT INTO `app_area` VALUES (231121, '嫩江县', 'Nenjiang', 231100, 3, '0456', '161400', 125.226, 49.1784);
INSERT INTO `app_area` VALUES (231123, '逊克县', 'Xunke', 231100, 3, '0456', '164400', 128.479, 49.5798);
INSERT INTO `app_area` VALUES (231124, '孙吴县', 'Sunwu', 231100, 3, '0456', '164200', 127.336, 49.4254);
INSERT INTO `app_area` VALUES (231181, '北安市', 'Bei\'an', 231100, 3, '0456', '164000', 126.482, 48.2387);
INSERT INTO `app_area` VALUES (231182, '五大连池市', 'Wudalianchi', 231100, 3, '0456', '164100', 126.203, 48.5151);
INSERT INTO `app_area` VALUES (231200, '绥化市', 'Suihua', 230000, 2, '0455', '152000', 126.993, 46.6374);
INSERT INTO `app_area` VALUES (231202, '北林区', 'Beilin', 231200, 3, '0455', '152000', 126.986, 46.6373);
INSERT INTO `app_area` VALUES (231221, '望奎县', 'Wangkui', 231200, 3, '0455', '152100', 126.482, 46.8308);
INSERT INTO `app_area` VALUES (231222, '兰西县', 'Lanxi', 231200, 3, '0455', '151500', 126.29, 46.2525);
INSERT INTO `app_area` VALUES (231223, '青冈县', 'Qinggang', 231200, 3, '0455', '151600', 126.113, 46.6853);
INSERT INTO `app_area` VALUES (231224, '庆安县', 'Qing\'an', 231200, 3, '0455', '152400', 127.508, 46.8802);
INSERT INTO `app_area` VALUES (231225, '明水县', 'Mingshui', 231200, 3, '0455', '151700', 125.906, 47.1733);
INSERT INTO `app_area` VALUES (231226, '绥棱县', 'Suileng', 231200, 3, '0455', '152200', 127.116, 47.2427);
INSERT INTO `app_area` VALUES (231281, '安达市', 'Anda', 231200, 3, '0455', '151400', 125.344, 46.4177);
INSERT INTO `app_area` VALUES (231282, '肇东市', 'Zhaodong', 231200, 3, '0455', '151100', 125.962, 46.0513);
INSERT INTO `app_area` VALUES (231283, '海伦市', 'Hailun', 231200, 3, '0455', '152300', 126.968, 47.4609);
INSERT INTO `app_area` VALUES (232700, '大兴安岭地区', 'DaXingAnLing', 230000, 2, '0457', '165000', 124.712, 52.3353);
INSERT INTO `app_area` VALUES (232701, '加格达奇区', 'Jiagedaqi', 232700, 3, '0457', '165000', 124.31, 51.9814);
INSERT INTO `app_area` VALUES (232702, '新林区', 'Xinlin', 232700, 3, '0457', '165000', 124.398, 51.6734);
INSERT INTO `app_area` VALUES (232703, '松岭区', 'Songling', 232700, 3, '0457', '165000', 124.19, 51.9855);
INSERT INTO `app_area` VALUES (232704, '呼中区', 'Huzhong', 232700, 3, '0457', '165000', 123.6, 52.0335);
INSERT INTO `app_area` VALUES (232721, '呼玛县', 'Huma', 232700, 3, '0457', '165100', 126.662, 51.7311);
INSERT INTO `app_area` VALUES (232722, '塔河县', 'Tahe', 232700, 3, '0457', '165200', 124.71, 52.3343);
INSERT INTO `app_area` VALUES (232723, '漠河县', 'Mohe', 232700, 3, '0457', '165300', 122.538, 52.97);
INSERT INTO `app_area` VALUES (310000, '上海', 'Shanghai', 100000, 1, '', '', 121.473, 31.2317);
INSERT INTO `app_area` VALUES (310100, '上海市', 'Shanghai', 310000, 2, '021', '200000', 121.473, 31.2317);
INSERT INTO `app_area` VALUES (310101, '黄浦区', 'Huangpu', 310100, 3, '021', '200001', 121.493, 31.2234);
INSERT INTO `app_area` VALUES (310104, '徐汇区', 'Xuhui', 310100, 3, '021', '200030', 121.437, 31.1883);
INSERT INTO `app_area` VALUES (310105, '长宁区', 'Changning', 310100, 3, '021', '200050', 121.425, 31.2204);
INSERT INTO `app_area` VALUES (310106, '静安区', 'Jing\'an', 310100, 3, '021', '200040', 121.444, 31.2288);
INSERT INTO `app_area` VALUES (310107, '普陀区', 'Putuo', 310100, 3, '021', '200333', 121.397, 31.2495);
INSERT INTO `app_area` VALUES (310108, '闸北区', 'Zhabei', 310100, 3, '021', '200070', 121.446, 31.2808);
INSERT INTO `app_area` VALUES (310109, '虹口区', 'Hongkou', 310100, 3, '021', '200086', 121.482, 31.2779);
INSERT INTO `app_area` VALUES (310110, '杨浦区', 'Yangpu', 310100, 3, '021', '200082', 121.526, 31.2595);
INSERT INTO `app_area` VALUES (310112, '闵行区', 'Minhang', 310100, 3, '021', '201100', 121.382, 31.1125);
INSERT INTO `app_area` VALUES (310113, '宝山区', 'Baoshan', 310100, 3, '021', '201900', 121.489, 31.4045);
INSERT INTO `app_area` VALUES (310114, '嘉定区', 'Jiading', 310100, 3, '021', '201800', 121.266, 31.3747);
INSERT INTO `app_area` VALUES (310115, '浦东新区', 'Pudong', 310100, 3, '021', '200135', 121.545, 31.2225);
INSERT INTO `app_area` VALUES (310116, '金山区', 'Jinshan', 310100, 3, '021', '200540', 121.342, 30.7416);
INSERT INTO `app_area` VALUES (310117, '松江区', 'Songjiang', 310100, 3, '021', '201600', 121.229, 31.0322);
INSERT INTO `app_area` VALUES (310118, '青浦区', 'Qingpu', 310100, 3, '021', '201700', 121.124, 31.1497);
INSERT INTO `app_area` VALUES (310120, '奉贤区', 'Fengxian', 310100, 3, '021', '201400', 121.474, 30.9179);
INSERT INTO `app_area` VALUES (310230, '崇明县', 'Chongming', 310100, 3, '021', '202150', 121.398, 31.6228);
INSERT INTO `app_area` VALUES (320000, '江苏省', 'Jiangsu', 100000, 1, '', '', 118.767, 32.0415);
INSERT INTO `app_area` VALUES (320100, '南京市', 'Nanjing', 320000, 2, '025', '210008', 118.767, 32.0415);
INSERT INTO `app_area` VALUES (320102, '玄武区', 'Xuanwu', 320100, 3, '025', '210018', 118.798, 32.0486);
INSERT INTO `app_area` VALUES (320104, '秦淮区', 'Qinhuai', 320100, 3, '025', '210001', 118.798, 32.0111);
INSERT INTO `app_area` VALUES (320105, '建邺区', 'Jianye', 320100, 3, '025', '210004', 118.766, 32.031);
INSERT INTO `app_area` VALUES (320106, '鼓楼区', 'Gulou', 320100, 3, '025', '210009', 118.77, 32.0663);
INSERT INTO `app_area` VALUES (320111, '浦口区', 'Pukou', 320100, 3, '025', '211800', 118.628, 32.0588);
INSERT INTO `app_area` VALUES (320113, '栖霞区', 'Qixia', 320100, 3, '025', '210046', 118.881, 32.1135);
INSERT INTO `app_area` VALUES (320114, '雨花台区', 'Yuhuatai', 320100, 3, '025', '210012', 118.78, 31.992);
INSERT INTO `app_area` VALUES (320115, '江宁区', 'Jiangning', 320100, 3, '025', '211100', 118.84, 31.9526);
INSERT INTO `app_area` VALUES (320116, '六合区', 'Luhe', 320100, 3, '025', '211500', 118.841, 32.3422);
INSERT INTO `app_area` VALUES (320117, '溧水区', 'Lishui', 320100, 3, '025', '211200', 119.029, 31.6531);
INSERT INTO `app_area` VALUES (320118, '高淳区', 'Gaochun', 320100, 3, '025', '211300', 118.876, 31.3271);
INSERT INTO `app_area` VALUES (320200, '无锡市', 'Wuxi', 320000, 2, '0510', '214000', 120.302, 31.5747);
INSERT INTO `app_area` VALUES (320202, '崇安区', 'Chong\'an', 320200, 3, '0510', '214001', 120.3, 31.58);
INSERT INTO `app_area` VALUES (320203, '南长区', 'Nanchang', 320200, 3, '0510', '214021', 120.309, 31.5636);
INSERT INTO `app_area` VALUES (320204, '北塘区', 'Beitang', 320200, 3, '0510', '214044', 120.294, 31.6059);
INSERT INTO `app_area` VALUES (320205, '锡山区', 'Xishan', 320200, 3, '0510', '214101', 120.357, 31.5886);
INSERT INTO `app_area` VALUES (320206, '惠山区', 'Huishan', 320200, 3, '0510', '214174', 120.298, 31.6809);
INSERT INTO `app_area` VALUES (320211, '滨湖区', 'Binhu', 320200, 3, '0510', '214123', 120.295, 31.5216);
INSERT INTO `app_area` VALUES (320281, '江阴市', 'Jiangyin', 320200, 3, '0510', '214431', 120.285, 31.92);
INSERT INTO `app_area` VALUES (320282, '宜兴市', 'Yixing', 320200, 3, '0510', '214200', 119.824, 31.3398);
INSERT INTO `app_area` VALUES (320300, '徐州市', 'Xuzhou', 320000, 2, '0516', '221003', 117.185, 34.2618);
INSERT INTO `app_area` VALUES (320302, '鼓楼区', 'Gulou', 320300, 3, '0516', '221005', 117.186, 34.2885);
INSERT INTO `app_area` VALUES (320303, '云龙区', 'Yunlong', 320300, 3, '0516', '221007', 117.231, 34.249);
INSERT INTO `app_area` VALUES (320305, '贾汪区', 'Jiawang', 320300, 3, '0516', '221003', 117.453, 34.4426);
INSERT INTO `app_area` VALUES (320311, '泉山区', 'Quanshan', 320300, 3, '0516', '221006', 117.194, 34.2442);
INSERT INTO `app_area` VALUES (320312, '铜山区', 'Tongshan', 320300, 3, '0516', '221106', 117.184, 34.1929);
INSERT INTO `app_area` VALUES (320321, '丰县', 'Fengxian', 320300, 3, '0516', '221700', 116.6, 34.6997);
INSERT INTO `app_area` VALUES (320322, '沛县', 'Peixian', 320300, 3, '0516', '221600', 116.937, 34.7216);
INSERT INTO `app_area` VALUES (320324, '睢宁县', 'Suining', 320300, 3, '0516', '221200', 117.941, 33.9127);
INSERT INTO `app_area` VALUES (320381, '新沂市', 'Xinyi', 320300, 3, '0516', '221400', 118.355, 34.3694);
INSERT INTO `app_area` VALUES (320382, '邳州市', 'Pizhou', 320300, 3, '0516', '221300', 117.959, 34.3333);
INSERT INTO `app_area` VALUES (320400, '常州市', 'Changzhou', 320000, 2, '0519', '213000', 119.947, 31.7728);
INSERT INTO `app_area` VALUES (320402, '天宁区', 'Tianning', 320400, 3, '0519', '213000', 119.951, 31.7521);
INSERT INTO `app_area` VALUES (320404, '钟楼区', 'Zhonglou', 320400, 3, '0519', '213023', 119.902, 31.8022);
INSERT INTO `app_area` VALUES (320405, '戚墅堰区', 'Qishuyan', 320400, 3, '0519', '213025', 120.061, 31.7196);
INSERT INTO `app_area` VALUES (320411, '新北区', 'Xinbei', 320400, 3, '0519', '213022', 119.971, 31.8305);
INSERT INTO `app_area` VALUES (320412, '武进区', 'Wujin', 320400, 3, '0519', '213100', 119.942, 31.7009);
INSERT INTO `app_area` VALUES (320481, '溧阳市', 'Liyang', 320400, 3, '0519', '213300', 119.484, 31.4154);
INSERT INTO `app_area` VALUES (320482, '金坛市', 'Jintan', 320400, 3, '0519', '213200', 119.578, 31.7404);
INSERT INTO `app_area` VALUES (320500, '苏州市', 'Suzhou', 320000, 2, '0512', '215002', 120.62, 31.2994);
INSERT INTO `app_area` VALUES (320505, '虎丘区', 'Huqiu', 320500, 3, '0512', '215004', 120.573, 31.2953);
INSERT INTO `app_area` VALUES (320506, '吴中区', 'Wuzhong', 320500, 3, '0512', '215128', 120.632, 31.2623);
INSERT INTO `app_area` VALUES (320507, '相城区', 'Xiangcheng', 320500, 3, '0512', '215131', 120.642, 31.3689);
INSERT INTO `app_area` VALUES (320508, '姑苏区', 'Gusu', 320500, 3, '0512', '215031', 120.62, 31.2994);
INSERT INTO `app_area` VALUES (320509, '吴江区', 'Wujiang', 320500, 3, '0512', '215200', 120.638, 31.1598);
INSERT INTO `app_area` VALUES (320581, '常熟市', 'Changshu', 320500, 3, '0512', '215500', 120.752, 31.6537);
INSERT INTO `app_area` VALUES (320582, '张家港市', 'Zhangjiagang', 320500, 3, '0512', '215600', 120.555, 31.8753);
INSERT INTO `app_area` VALUES (320583, '昆山市', 'Kunshan', 320500, 3, '0512', '215300', 120.981, 31.3846);
INSERT INTO `app_area` VALUES (320585, '太仓市', 'Taicang', 320500, 3, '0512', '215400', 121.109, 31.4497);
INSERT INTO `app_area` VALUES (320600, '南通市', 'Nantong', 320000, 2, '0513', '226001', 120.865, 32.0162);
INSERT INTO `app_area` VALUES (320602, '崇川区', 'Chongchuan', 320600, 3, '0513', '226001', 120.857, 32.0098);
INSERT INTO `app_area` VALUES (320611, '港闸区', 'Gangzha', 320600, 3, '0513', '226001', 120.818, 32.0316);
INSERT INTO `app_area` VALUES (320612, '通州区', 'Tongzhou', 320600, 3, '0513', '226300', 121.073, 32.0676);
INSERT INTO `app_area` VALUES (320621, '海安县', 'Hai\'an', 320600, 3, '0513', '226600', 120.459, 32.5451);
INSERT INTO `app_area` VALUES (320623, '如东县', 'Rudong', 320600, 3, '0513', '226400', 121.189, 32.3144);
INSERT INTO `app_area` VALUES (320681, '启东市', 'Qidong', 320600, 3, '0513', '226200', 121.66, 31.8108);
INSERT INTO `app_area` VALUES (320682, '如皋市', 'Rugao', 320600, 3, '0513', '226500', 120.56, 32.376);
INSERT INTO `app_area` VALUES (320684, '海门市', 'Haimen', 320600, 3, '0513', '226100', 121.17, 31.8942);
INSERT INTO `app_area` VALUES (320700, '连云港市', 'Lianyungang', 320000, 2, '0518', '222002', 119.179, 34.6);
INSERT INTO `app_area` VALUES (320703, '连云区', 'Lianyun', 320700, 3, '0518', '222042', 119.373, 34.7529);
INSERT INTO `app_area` VALUES (320706, '海州区', 'Haizhou', 320700, 3, '0518', '222003', 119.131, 34.5699);
INSERT INTO `app_area` VALUES (320707, '赣榆区', 'Ganyu', 320700, 3, '0518', '222100', 119.129, 34.8392);
INSERT INTO `app_area` VALUES (320722, '东海县', 'Donghai', 320700, 3, '0518', '222300', 118.771, 34.5421);
INSERT INTO `app_area` VALUES (320723, '灌云县', 'Guanyun', 320700, 3, '0518', '222200', 119.239, 34.2839);
INSERT INTO `app_area` VALUES (320724, '灌南县', 'Guannan', 320700, 3, '0518', '222500', 119.356, 34.09);
INSERT INTO `app_area` VALUES (320800, '淮安市', 'Huai\'an', 320000, 2, '0517', '223001', 119.021, 33.5975);
INSERT INTO `app_area` VALUES (320802, '清河区', 'Qinghe', 320800, 3, '0517', '223001', 119.008, 33.5995);
INSERT INTO `app_area` VALUES (320803, '淮安区', 'Huai\'an', 320800, 3, '0517', '223200', 119.021, 33.5975);
INSERT INTO `app_area` VALUES (320804, '淮阴区', 'Huaiyin', 320800, 3, '0517', '223300', 119.035, 33.6317);
INSERT INTO `app_area` VALUES (320811, '清浦区', 'Qingpu', 320800, 3, '0517', '223002', 119.026, 33.5523);
INSERT INTO `app_area` VALUES (320826, '涟水县', 'Lianshui', 320800, 3, '0517', '223400', 119.261, 33.7809);
INSERT INTO `app_area` VALUES (320829, '洪泽县', 'Hongze', 320800, 3, '0517', '223100', 118.873, 33.2943);
INSERT INTO `app_area` VALUES (320830, '盱眙县', 'Xuyi', 320800, 3, '0517', '211700', 118.545, 33.0109);
INSERT INTO `app_area` VALUES (320831, '金湖县', 'Jinhu', 320800, 3, '0517', '211600', 119.023, 33.0222);
INSERT INTO `app_area` VALUES (320900, '盐城市', 'Yancheng', 320000, 2, '0515', '224005', 120.14, 33.3776);
INSERT INTO `app_area` VALUES (320902, '亭湖区', 'Tinghu', 320900, 3, '0515', '224005', 120.166, 33.3783);
INSERT INTO `app_area` VALUES (320903, '盐都区', 'Yandu', 320900, 3, '0515', '224055', 120.154, 33.3373);
INSERT INTO `app_area` VALUES (320921, '响水县', 'Xiangshui', 320900, 3, '0515', '224600', 119.57, 34.2051);
INSERT INTO `app_area` VALUES (320922, '滨海县', 'Binhai', 320900, 3, '0515', '224500', 119.821, 33.9897);
INSERT INTO `app_area` VALUES (320923, '阜宁县', 'Funing', 320900, 3, '0515', '224400', 119.802, 33.7823);
INSERT INTO `app_area` VALUES (320924, '射阳县', 'Sheyang', 320900, 3, '0515', '224300', 120.26, 33.7764);
INSERT INTO `app_area` VALUES (320925, '建湖县', 'Jianhu', 320900, 3, '0515', '224700', 119.799, 33.4724);
INSERT INTO `app_area` VALUES (320981, '东台市', 'Dongtai', 320900, 3, '0515', '224200', 120.324, 32.8508);
INSERT INTO `app_area` VALUES (320982, '大丰市', 'Dafeng', 320900, 3, '0515', '224100', 120.466, 33.1989);
INSERT INTO `app_area` VALUES (321000, '扬州市', 'Yangzhou', 320000, 2, '0514', '225002', 119.421, 32.3932);
INSERT INTO `app_area` VALUES (321002, '广陵区', 'Guangling', 321000, 3, '0514', '225002', 119.432, 32.3947);
INSERT INTO `app_area` VALUES (321003, '邗江区', 'Hanjiang', 321000, 3, '0514', '225002', 119.398, 32.3765);
INSERT INTO `app_area` VALUES (321012, '江都区', 'Jiangdu', 321000, 3, '0514', '225200', 119.567, 32.4266);
INSERT INTO `app_area` VALUES (321023, '宝应县', 'Baoying', 321000, 3, '0514', '225800', 119.312, 33.2355);
INSERT INTO `app_area` VALUES (321081, '仪征市', 'Yizheng', 321000, 3, '0514', '211400', 119.184, 32.272);
INSERT INTO `app_area` VALUES (321084, '高邮市', 'Gaoyou', 321000, 3, '0514', '225600', 119.46, 32.7813);
INSERT INTO `app_area` VALUES (321100, '镇江市', 'Zhenjiang', 320000, 2, '0511', '212004', 119.453, 32.2044);
INSERT INTO `app_area` VALUES (321102, '京口区', 'Jingkou', 321100, 3, '0511', '212003', 119.469, 32.1981);
INSERT INTO `app_area` VALUES (321111, '润州区', 'Runzhou', 321100, 3, '0511', '212005', 119.411, 32.1952);
INSERT INTO `app_area` VALUES (321112, '丹徒区', 'Dantu', 321100, 3, '0511', '212028', 119.434, 32.1318);
INSERT INTO `app_area` VALUES (321181, '丹阳市', 'Danyang', 321100, 3, '0511', '212300', 119.575, 31.9912);
INSERT INTO `app_area` VALUES (321182, '扬中市', 'Yangzhong', 321100, 3, '0511', '212200', 119.797, 32.2363);
INSERT INTO `app_area` VALUES (321183, '句容市', 'Jurong', 321100, 3, '0511', '212400', 119.165, 31.9559);
INSERT INTO `app_area` VALUES (321200, '泰州市', 'Taizhou', 320000, 2, '0523', '225300', 119.915, 32.4849);
INSERT INTO `app_area` VALUES (321202, '海陵区', 'Hailing', 321200, 3, '0523', '225300', 119.919, 32.491);
INSERT INTO `app_area` VALUES (321203, '高港区', 'Gaogang', 321200, 3, '0523', '225321', 119.881, 32.3183);
INSERT INTO `app_area` VALUES (321204, '姜堰区', 'Jiangyan', 321200, 3, '0523', '225500', 120.148, 32.5085);
INSERT INTO `app_area` VALUES (321281, '兴化市', 'Xinghua', 321200, 3, '0523', '225700', 119.852, 32.9094);
INSERT INTO `app_area` VALUES (321282, '靖江市', 'Jingjiang', 321200, 3, '0523', '214500', 120.273, 32.0159);
INSERT INTO `app_area` VALUES (321283, '泰兴市', 'Taixing', 321200, 3, '0523', '225400', 120.052, 32.1719);
INSERT INTO `app_area` VALUES (321300, '宿迁市', 'Suqian', 320000, 2, '0527', '223800', 118.293, 33.9452);
INSERT INTO `app_area` VALUES (321302, '宿城区', 'Sucheng', 321300, 3, '0527', '223800', 118.291, 33.9422);
INSERT INTO `app_area` VALUES (321311, '宿豫区', 'Suyu', 321300, 3, '0527', '223800', 118.329, 33.9467);
INSERT INTO `app_area` VALUES (321322, '沭阳县', 'Shuyang', 321300, 3, '0527', '223600', 118.769, 34.1145);
INSERT INTO `app_area` VALUES (321323, '泗阳县', 'Siyang', 321300, 3, '0527', '223700', 118.703, 33.721);
INSERT INTO `app_area` VALUES (321324, '泗洪县', 'Sihong', 321300, 3, '0527', '223900', 118.217, 33.46);
INSERT INTO `app_area` VALUES (330000, '浙江省', 'Zhejiang', 100000, 1, '', '', 120.154, 30.2875);
INSERT INTO `app_area` VALUES (330100, '杭州市', 'Hangzhou', 330000, 2, '0571', '310026', 120.154, 30.2875);
INSERT INTO `app_area` VALUES (330102, '上城区', 'Shangcheng', 330100, 3, '0571', '310002', 120.169, 30.2425);
INSERT INTO `app_area` VALUES (330103, '下城区', 'Xiacheng', 330100, 3, '0571', '310006', 120.181, 30.2815);
INSERT INTO `app_area` VALUES (330104, '江干区', 'Jianggan', 330100, 3, '0571', '310016', 120.205, 30.2572);
INSERT INTO `app_area` VALUES (330105, '拱墅区', 'Gongshu', 330100, 3, '0571', '310011', 120.142, 30.3197);
INSERT INTO `app_area` VALUES (330106, '西湖区', 'Xihu', 330100, 3, '0571', '310013', 120.13, 30.2595);
INSERT INTO `app_area` VALUES (330108, '滨江区', 'Binjiang', 330100, 3, '0571', '310051', 120.212, 30.2083);
INSERT INTO `app_area` VALUES (330109, '萧山区', 'Xiaoshan', 330100, 3, '0571', '311200', 120.265, 30.185);
INSERT INTO `app_area` VALUES (330110, '余杭区', 'Yuhang', 330100, 3, '0571', '311100', 120.3, 30.4183);
INSERT INTO `app_area` VALUES (330122, '桐庐县', 'Tonglu', 330100, 3, '0571', '311500', 119.689, 29.7978);
INSERT INTO `app_area` VALUES (330127, '淳安县', 'Chun\'an', 330100, 3, '0571', '311700', 119.043, 29.6099);
INSERT INTO `app_area` VALUES (330182, '建德市', 'Jiande', 330100, 3, '0571', '311600', 119.282, 29.476);
INSERT INTO `app_area` VALUES (330183, '富阳区', 'Fuyang', 330100, 3, '0571', '311400', 119.96, 30.0488);
INSERT INTO `app_area` VALUES (330185, '临安市', 'Lin\'an', 330100, 3, '0571', '311300', 119.725, 30.2345);
INSERT INTO `app_area` VALUES (330200, '宁波市', 'Ningbo', 330000, 2, '0574', '315000', 121.55, 29.8684);
INSERT INTO `app_area` VALUES (330203, '海曙区', 'Haishu', 330200, 3, '0574', '315000', 121.551, 29.8598);
INSERT INTO `app_area` VALUES (330204, '江东区', 'Jiangdong', 330200, 3, '0574', '315040', 121.57, 29.867);
INSERT INTO `app_area` VALUES (330205, '江北区', 'Jiangbei', 330200, 3, '0574', '315020', 121.557, 29.8878);
INSERT INTO `app_area` VALUES (330206, '北仑区', 'Beilun', 330200, 3, '0574', '315800', 121.844, 29.9007);
INSERT INTO `app_area` VALUES (330211, '镇海区', 'Zhenhai', 330200, 3, '0574', '315200', 121.716, 29.9489);
INSERT INTO `app_area` VALUES (330212, '鄞州区', 'Yinzhou', 330200, 3, '0574', '315100', 121.548, 29.8161);
INSERT INTO `app_area` VALUES (330225, '象山县', 'Xiangshan', 330200, 3, '0574', '315700', 121.869, 29.4776);
INSERT INTO `app_area` VALUES (330226, '宁海县', 'Ninghai', 330200, 3, '0574', '315600', 121.431, 29.2889);
INSERT INTO `app_area` VALUES (330281, '余姚市', 'Yuyao', 330200, 3, '0574', '315400', 121.153, 30.0387);
INSERT INTO `app_area` VALUES (330282, '慈溪市', 'Cixi', 330200, 3, '0574', '315300', 121.266, 30.1696);
INSERT INTO `app_area` VALUES (330283, '奉化市', 'Fenghua', 330200, 3, '0574', '315500', 121.41, 29.6554);
INSERT INTO `app_area` VALUES (330300, '温州市', 'Wenzhou', 330000, 2, '0577', '325000', 120.672, 28.0006);
INSERT INTO `app_area` VALUES (330302, '鹿城区', 'Lucheng', 330300, 3, '0577', '325000', 120.655, 28.0149);
INSERT INTO `app_area` VALUES (330303, '龙湾区', 'Longwan', 330300, 3, '0577', '325013', 120.831, 27.9128);
INSERT INTO `app_area` VALUES (330304, '瓯海区', 'Ouhai', 330300, 3, '0577', '325005', 120.638, 28.0071);
INSERT INTO `app_area` VALUES (330322, '洞头县', 'Dongtou', 330300, 3, '0577', '325700', 121.156, 27.8363);
INSERT INTO `app_area` VALUES (330324, '永嘉县', 'Yongjia', 330300, 3, '0577', '325100', 120.693, 28.1546);
INSERT INTO `app_area` VALUES (330326, '平阳县', 'Pingyang', 330300, 3, '0577', '325400', 120.565, 27.6625);
INSERT INTO `app_area` VALUES (330327, '苍南县', 'Cangnan', 330300, 3, '0577', '325800', 120.426, 27.5174);
INSERT INTO `app_area` VALUES (330328, '文成县', 'Wencheng', 330300, 3, '0577', '325300', 120.091, 27.7868);
INSERT INTO `app_area` VALUES (330329, '泰顺县', 'Taishun', 330300, 3, '0577', '325500', 119.718, 27.5569);
INSERT INTO `app_area` VALUES (330381, '瑞安市', 'Rui\'an', 330300, 3, '0577', '325200', 120.655, 27.7804);
INSERT INTO `app_area` VALUES (330382, '乐清市', 'Yueqing', 330300, 3, '0577', '325600', 120.962, 28.124);
INSERT INTO `app_area` VALUES (330400, '嘉兴市', 'Jiaxing', 330000, 2, '0573', '314000', 120.751, 30.7627);
INSERT INTO `app_area` VALUES (330402, '南湖区', 'Nanhu', 330400, 3, '0573', '314051', 120.785, 30.7486);
INSERT INTO `app_area` VALUES (330411, '秀洲区', 'Xiuzhou', 330400, 3, '0573', '314031', 120.709, 30.7645);
INSERT INTO `app_area` VALUES (330421, '嘉善县', 'Jiashan', 330400, 3, '0573', '314100', 120.926, 30.8299);
INSERT INTO `app_area` VALUES (330424, '海盐县', 'Haiyan', 330400, 3, '0573', '314300', 120.946, 30.5255);
INSERT INTO `app_area` VALUES (330481, '海宁市', 'Haining', 330400, 3, '0573', '314400', 120.681, 30.5097);
INSERT INTO `app_area` VALUES (330482, '平湖市', 'Pinghu', 330400, 3, '0573', '314200', 121.022, 30.6962);
INSERT INTO `app_area` VALUES (330483, '桐乡市', 'Tongxiang', 330400, 3, '0573', '314500', 120.565, 30.6302);
INSERT INTO `app_area` VALUES (330500, '湖州市', 'Huzhou', 330000, 2, '0572', '313000', 120.102, 30.8672);
INSERT INTO `app_area` VALUES (330502, '吴兴区', 'Wuxing', 330500, 3, '0572', '313000', 120.125, 30.8575);
INSERT INTO `app_area` VALUES (330503, '南浔区', 'Nanxun', 330500, 3, '0572', '313009', 120.42, 30.8669);
INSERT INTO `app_area` VALUES (330521, '德清县', 'Deqing', 330500, 3, '0572', '313200', 119.978, 30.5337);
INSERT INTO `app_area` VALUES (330522, '长兴县', 'Changxing', 330500, 3, '0572', '313100', 119.908, 31.0061);
INSERT INTO `app_area` VALUES (330523, '安吉县', 'Anji', 330500, 3, '0572', '313300', 119.682, 30.638);
INSERT INTO `app_area` VALUES (330600, '绍兴市', 'Shaoxing', 330000, 2, '0575', '312000', 120.582, 29.9971);
INSERT INTO `app_area` VALUES (330602, '越城区', 'Yuecheng', 330600, 3, '0575', '312000', 120.582, 29.989);
INSERT INTO `app_area` VALUES (330603, '柯桥区', 'Keqiao ', 330600, 3, '0575', '312030', 120.493, 30.0876);
INSERT INTO `app_area` VALUES (330604, '上虞区', 'Shangyu', 330600, 3, '0575', '312300', 120.476, 30.078);
INSERT INTO `app_area` VALUES (330624, '新昌县', 'Xinchang', 330600, 3, '0575', '312500', 120.904, 29.4999);
INSERT INTO `app_area` VALUES (330681, '诸暨市', 'Zhuji', 330600, 3, '0575', '311800', 120.236, 29.7136);
INSERT INTO `app_area` VALUES (330683, '嵊州市', 'Shengzhou', 330600, 3, '0575', '312400', 120.822, 29.5885);
INSERT INTO `app_area` VALUES (330700, '金华市', 'Jinhua', 330000, 2, '0579', '321000', 119.65, 29.0895);
INSERT INTO `app_area` VALUES (330702, '婺城区', 'Wucheng', 330700, 3, '0579', '321000', 119.571, 29.0952);
INSERT INTO `app_area` VALUES (330703, '金东区', 'Jindong', 330700, 3, '0579', '321000', 119.693, 29.0991);
INSERT INTO `app_area` VALUES (330723, '武义县', 'Wuyi', 330700, 3, '0579', '321200', 119.816, 28.8933);
INSERT INTO `app_area` VALUES (330726, '浦江县', 'Pujiang', 330700, 3, '0579', '322200', 119.892, 29.4535);
INSERT INTO `app_area` VALUES (330727, '磐安县', 'Pan\'an', 330700, 3, '0579', '322300', 120.45, 29.0573);
INSERT INTO `app_area` VALUES (330781, '兰溪市', 'Lanxi', 330700, 3, '0579', '321100', 119.46, 29.2084);
INSERT INTO `app_area` VALUES (330782, '义乌市', 'Yiwu', 330700, 3, '0579', '322000', 120.074, 29.3056);
INSERT INTO `app_area` VALUES (330783, '东阳市', 'Dongyang', 330700, 3, '0579', '322100', 120.242, 29.2894);
INSERT INTO `app_area` VALUES (330784, '永康市', 'Yongkang', 330700, 3, '0579', '321300', 120.047, 28.8884);
INSERT INTO `app_area` VALUES (330800, '衢州市', 'Quzhou', 330000, 2, '0570', '324002', 118.873, 28.9417);
INSERT INTO `app_area` VALUES (330802, '柯城区', 'Kecheng', 330800, 3, '0570', '324100', 118.871, 28.9686);
INSERT INTO `app_area` VALUES (330803, '衢江区', 'Qujiang', 330800, 3, '0570', '324022', 118.96, 28.9798);
INSERT INTO `app_area` VALUES (330822, '常山县', 'Changshan', 330800, 3, '0570', '324200', 118.51, 28.9019);
INSERT INTO `app_area` VALUES (330824, '开化县', 'Kaihua', 330800, 3, '0570', '324300', 118.416, 29.1378);
INSERT INTO `app_area` VALUES (330825, '龙游县', 'Longyou', 330800, 3, '0570', '324400', 119.172, 29.0282);
INSERT INTO `app_area` VALUES (330881, '江山市', 'Jiangshan', 330800, 3, '0570', '324100', 118.627, 28.7386);
INSERT INTO `app_area` VALUES (330900, '舟山市', 'Zhoushan', 330000, 2, '0580', '316000', 122.107, 30.016);
INSERT INTO `app_area` VALUES (330902, '定海区', 'Dinghai', 330900, 3, '0580', '316000', 122.107, 30.0198);
INSERT INTO `app_area` VALUES (330903, '普陀区', 'Putuo', 330900, 3, '0580', '316100', 122.303, 29.9491);
INSERT INTO `app_area` VALUES (330921, '岱山县', 'Daishan', 330900, 3, '0580', '316200', 122.205, 30.2439);
INSERT INTO `app_area` VALUES (330922, '嵊泗县', 'Shengsi', 330900, 3, '0580', '202450', 122.451, 30.7268);
INSERT INTO `app_area` VALUES (331000, '台州市', 'Taizhou', 330000, 2, '0576', '318000', 121.429, 28.6614);
INSERT INTO `app_area` VALUES (331002, '椒江区', 'Jiaojiang', 331000, 3, '0576', '318000', 121.443, 28.673);
INSERT INTO `app_area` VALUES (331003, '黄岩区', 'Huangyan', 331000, 3, '0576', '318020', 121.259, 28.6508);
INSERT INTO `app_area` VALUES (331004, '路桥区', 'Luqiao', 331000, 3, '0576', '318050', 121.374, 28.5802);
INSERT INTO `app_area` VALUES (331021, '玉环县', 'Yuhuan', 331000, 3, '0576', '317600', 121.232, 28.1364);
INSERT INTO `app_area` VALUES (331022, '三门县', 'Sanmen', 331000, 3, '0576', '317100', 121.394, 29.1051);
INSERT INTO `app_area` VALUES (331023, '天台县', 'Tiantai', 331000, 3, '0576', '317200', 121.008, 29.1429);
INSERT INTO `app_area` VALUES (331024, '仙居县', 'Xianju', 331000, 3, '0576', '317300', 120.729, 28.8467);
INSERT INTO `app_area` VALUES (331081, '温岭市', 'Wenling', 331000, 3, '0576', '317500', 121.386, 28.3718);
INSERT INTO `app_area` VALUES (331082, '临海市', 'Linhai', 331000, 3, '0576', '317000', 121.139, 28.856);
INSERT INTO `app_area` VALUES (331100, '丽水市', 'Lishui', 330000, 2, '0578', '323000', 119.922, 28.452);
INSERT INTO `app_area` VALUES (331102, '莲都区', 'Liandu', 331100, 3, '0578', '323000', 119.913, 28.4458);
INSERT INTO `app_area` VALUES (331121, '青田县', 'Qingtian', 331100, 3, '0578', '323900', 120.29, 28.139);
INSERT INTO `app_area` VALUES (331122, '缙云县', 'Jinyun', 331100, 3, '0578', '321400', 120.09, 28.6594);
INSERT INTO `app_area` VALUES (331123, '遂昌县', 'Suichang', 331100, 3, '0578', '323300', 119.276, 28.5929);
INSERT INTO `app_area` VALUES (331124, '松阳县', 'Songyang', 331100, 3, '0578', '323400', 119.482, 28.4494);
INSERT INTO `app_area` VALUES (331125, '云和县', 'Yunhe', 331100, 3, '0578', '323600', 119.573, 28.1164);
INSERT INTO `app_area` VALUES (331126, '庆元县', 'Qingyuan', 331100, 3, '0578', '323800', 119.063, 27.6184);
INSERT INTO `app_area` VALUES (331127, '景宁畲族自治县', 'Jingning', 331100, 3, '0578', '323500', 119.638, 27.9739);
INSERT INTO `app_area` VALUES (331181, '龙泉市', 'Longquan', 331100, 3, '0578', '323700', 119.142, 28.0743);
INSERT INTO `app_area` VALUES (331200, '舟山群岛新区', 'Zhoushan', 330000, 2, '0580', '316000', 122.318, 29.8132);
INSERT INTO `app_area` VALUES (331201, '金塘岛', 'Jintang', 331200, 3, '0580', '316000', 121.893, 30.0406);
INSERT INTO `app_area` VALUES (331202, '六横岛', 'Liuheng', 331200, 3, '0580', '316000', 122.143, 29.6629);
INSERT INTO `app_area` VALUES (331203, '衢山岛', 'Qushan', 331200, 3, '0580', '316000', 122.358, 30.4426);
INSERT INTO `app_area` VALUES (331204, '舟山本岛西北部', 'Zhoushan', 331200, 3, '0580', '316000', 122.031, 30.1404);
INSERT INTO `app_area` VALUES (331205, '岱山岛西南部', 'Daishan', 331200, 3, '0580', '316000', 122.18, 30.2773);
INSERT INTO `app_area` VALUES (331206, '泗礁岛', 'Sijiao', 331200, 3, '0580', '316000', 122.458, 30.7251);
INSERT INTO `app_area` VALUES (331207, '朱家尖岛', 'Zhujiajian', 331200, 3, '0580', '316000', 122.391, 29.9163);
INSERT INTO `app_area` VALUES (331208, '洋山岛', 'Yangshan', 331200, 3, '0580', '316000', 121.996, 30.0946);
INSERT INTO `app_area` VALUES (331209, '长涂岛', 'Changtu', 331200, 3, '0580', '316000', 122.285, 30.2489);
INSERT INTO `app_area` VALUES (331210, '虾峙岛', 'Xiazhi', 331200, 3, '0580', '316000', 122.245, 29.7529);
INSERT INTO `app_area` VALUES (340000, '安徽省', 'Anhui', 100000, 1, '', '', 117.283, 31.8612);
INSERT INTO `app_area` VALUES (340100, '合肥市', 'Hefei', 340000, 2, '0551', '230001', 117.283, 31.8612);
INSERT INTO `app_area` VALUES (340102, '瑶海区', 'Yaohai', 340100, 3, '0551', '230011', 117.309, 31.8581);
INSERT INTO `app_area` VALUES (340103, '庐阳区', 'Luyang', 340100, 3, '0551', '230001', 117.265, 31.8787);
INSERT INTO `app_area` VALUES (340104, '蜀山区', 'Shushan', 340100, 3, '0551', '230031', 117.261, 31.8512);
INSERT INTO `app_area` VALUES (340111, '包河区', 'Baohe', 340100, 3, '0551', '230041', 117.31, 31.795);
INSERT INTO `app_area` VALUES (340121, '长丰县', 'Changfeng', 340100, 3, '0551', '231100', 117.165, 32.4796);
INSERT INTO `app_area` VALUES (340122, '肥东县', 'Feidong', 340100, 3, '0551', '231600', 117.471, 31.8853);
INSERT INTO `app_area` VALUES (340123, '肥西县', 'Feixi', 340100, 3, '0551', '231200', 117.168, 31.7214);
INSERT INTO `app_area` VALUES (340124, '庐江县', 'Lujiang', 340100, 3, '0565', '231500', 117.29, 31.2515);
INSERT INTO `app_area` VALUES (340181, '巢湖市', 'Chaohu', 340100, 3, '0565', '238000', 117.874, 31.6005);
INSERT INTO `app_area` VALUES (340200, '芜湖市', 'Wuhu', 340000, 2, '0551', '241000', 118.376, 31.3263);
INSERT INTO `app_area` VALUES (340202, '镜湖区', 'Jinghu', 340200, 3, '0553', '241000', 118.385, 31.3404);
INSERT INTO `app_area` VALUES (340203, '弋江区', 'Yijiang', 340200, 3, '0553', '241000', 118.373, 31.3118);
INSERT INTO `app_area` VALUES (340207, '鸠江区', 'Jiujiang', 340200, 3, '0553', '241000', 118.392, 31.3693);
INSERT INTO `app_area` VALUES (340208, '三山区', 'Sanshan', 340200, 3, '0553', '241000', 118.225, 31.207);
INSERT INTO `app_area` VALUES (340221, '芜湖县', 'Wuhu', 340200, 3, '0553', '241100', 118.575, 31.1348);
INSERT INTO `app_area` VALUES (340222, '繁昌县', 'Fanchang', 340200, 3, '0553', '241200', 118.2, 31.0832);
INSERT INTO `app_area` VALUES (340223, '南陵县', 'Nanling', 340200, 3, '0553', '242400', 118.337, 30.9197);
INSERT INTO `app_area` VALUES (340225, '无为县', 'Wuwei', 340200, 3, '0565', '238300', 117.911, 31.3031);
INSERT INTO `app_area` VALUES (340300, '蚌埠市', 'Bengbu', 340000, 2, '0552', '233000', 117.362, 32.934);
INSERT INTO `app_area` VALUES (340302, '龙子湖区', 'Longzihu', 340300, 3, '0552', '233000', 117.394, 32.943);
INSERT INTO `app_area` VALUES (340303, '蚌山区', 'Bengshan', 340300, 3, '0552', '233000', 117.368, 32.9441);
INSERT INTO `app_area` VALUES (340304, '禹会区', 'Yuhui', 340300, 3, '0552', '233010', 117.353, 32.9334);
INSERT INTO `app_area` VALUES (340311, '淮上区', 'Huaishang', 340300, 3, '0552', '233002', 117.36, 32.9642);
INSERT INTO `app_area` VALUES (340321, '怀远县', 'Huaiyuan', 340300, 3, '0552', '233400', 117.205, 32.9701);
INSERT INTO `app_area` VALUES (340322, '五河县', 'Wuhe', 340300, 3, '0552', '233300', 117.891, 33.1446);
INSERT INTO `app_area` VALUES (340323, '固镇县', 'Guzhen', 340300, 3, '0552', '233700', 117.316, 33.318);
INSERT INTO `app_area` VALUES (340400, '淮南市', 'Huainan', 340000, 2, '0554', '232001', 117.025, 32.6459);
INSERT INTO `app_area` VALUES (340402, '大通区', 'Datong', 340400, 3, '0554', '232033', 117.053, 32.6326);
INSERT INTO `app_area` VALUES (340403, '田家庵区', 'Tianjiaan', 340400, 3, '0554', '232000', 117.017, 32.647);
INSERT INTO `app_area` VALUES (340404, '谢家集区', 'Xiejiaji', 340400, 3, '0554', '232052', 116.864, 32.5982);
INSERT INTO `app_area` VALUES (340405, '八公山区', 'Bagongshan', 340400, 3, '0554', '232072', 116.837, 32.6294);
INSERT INTO `app_area` VALUES (340406, '潘集区', 'Panji', 340400, 3, '0554', '232082', 116.816, 32.7829);
INSERT INTO `app_area` VALUES (340421, '凤台县', 'Fengtai', 340400, 3, '0554', '232100', 116.716, 32.7075);
INSERT INTO `app_area` VALUES (340500, '马鞍山市', 'Ma\'anshan', 340000, 2, '0555', '243001', 118.508, 31.6894);
INSERT INTO `app_area` VALUES (340503, '花山区', 'Huashan', 340500, 3, '0555', '243000', 118.512, 31.7001);
INSERT INTO `app_area` VALUES (340504, '雨山区', 'Yushan', 340500, 3, '0555', '243071', 118.499, 31.6822);
INSERT INTO `app_area` VALUES (340506, '博望区', 'Bowang', 340500, 3, '0555', '243131', 118.844, 31.5619);
INSERT INTO `app_area` VALUES (340521, '当涂县', 'Dangtu', 340500, 3, '0555', '243100', 118.498, 31.571);
INSERT INTO `app_area` VALUES (340522, '含山县', 'Hanshan ', 340500, 3, '0555', '238100', 118.106, 31.7278);
INSERT INTO `app_area` VALUES (340523, '和县', 'Hexian', 340500, 3, '0555', '238200', 118.351, 31.7418);
INSERT INTO `app_area` VALUES (340600, '淮北市', 'Huaibei', 340000, 2, '0561', '235000', 116.795, 33.9717);
INSERT INTO `app_area` VALUES (340602, '杜集区', 'Duji', 340600, 3, '0561', '235000', 116.83, 33.9936);
INSERT INTO `app_area` VALUES (340603, '相山区', 'Xiangshan', 340600, 3, '0561', '235000', 116.795, 33.9598);
INSERT INTO `app_area` VALUES (340604, '烈山区', 'Lieshan', 340600, 3, '0561', '235000', 116.814, 33.8936);
INSERT INTO `app_area` VALUES (340621, '濉溪县', 'Suixi', 340600, 3, '0561', '235100', 116.768, 33.9146);
INSERT INTO `app_area` VALUES (340700, '铜陵市', 'Tongling', 340000, 2, '0562', '244000', 117.817, 30.9299);
INSERT INTO `app_area` VALUES (340702, '铜官山区', 'Tongguanshan', 340700, 3, '0562', '244000', 117.815, 30.9342);
INSERT INTO `app_area` VALUES (340703, '狮子山区', 'Shizishan', 340700, 3, '0562', '244000', 117.892, 30.9263);
INSERT INTO `app_area` VALUES (340711, '郊区', 'Jiaoqu', 340700, 3, '0562', '244000', 117.809, 30.9198);
INSERT INTO `app_area` VALUES (340721, '铜陵县', 'Tongling', 340700, 3, '0562', '244100', 117.791, 30.9536);
INSERT INTO `app_area` VALUES (340800, '安庆市', 'Anqing', 340000, 2, '0556', '246001', 117.054, 30.5248);
INSERT INTO `app_area` VALUES (340802, '迎江区', 'Yingjiang', 340800, 3, '0556', '246001', 117.049, 30.5042);
INSERT INTO `app_area` VALUES (340803, '大观区', 'Daguan', 340800, 3, '0556', '246002', 117.034, 30.5122);
INSERT INTO `app_area` VALUES (340811, '宜秀区', 'Yixiu', 340800, 3, '0556', '246003', 117.061, 30.5078);
INSERT INTO `app_area` VALUES (340822, '怀宁县', 'Huaining', 340800, 3, '0556', '246100', 116.83, 30.7338);
INSERT INTO `app_area` VALUES (340823, '枞阳县', 'Zongyang', 340800, 3, '0556', '246700', 117.22, 30.6996);
INSERT INTO `app_area` VALUES (340824, '潜山县', 'Qianshan', 340800, 3, '0556', '246300', 116.576, 30.6304);
INSERT INTO `app_area` VALUES (340825, '太湖县', 'Taihu', 340800, 3, '0556', '246400', 116.309, 30.4541);
INSERT INTO `app_area` VALUES (340826, '宿松县', 'Susong', 340800, 3, '0556', '246500', 116.129, 30.1536);
INSERT INTO `app_area` VALUES (340827, '望江县', 'Wangjiang', 340800, 3, '0556', '246200', 116.688, 30.1259);
INSERT INTO `app_area` VALUES (340828, '岳西县', 'Yuexi', 340800, 3, '0556', '246600', 116.36, 30.8498);
INSERT INTO `app_area` VALUES (340881, '桐城市', 'Tongcheng', 340800, 3, '0556', '231400', 116.951, 31.0522);
INSERT INTO `app_area` VALUES (341000, '黄山市', 'Huangshan', 340000, 2, '0559', '245000', 118.317, 29.7092);
INSERT INTO `app_area` VALUES (341002, '屯溪区', 'Tunxi', 341000, 3, '0559', '245000', 118.334, 29.7114);
INSERT INTO `app_area` VALUES (341003, '黄山区', 'Huangshan', 341000, 3, '0559', '242700', 118.142, 30.2729);
INSERT INTO `app_area` VALUES (341004, '徽州区', 'Huizhou', 341000, 3, '0559', '245061', 118.337, 29.8278);
INSERT INTO `app_area` VALUES (341021, '歙县', 'Shexian', 341000, 3, '0559', '245200', 118.437, 29.8675);
INSERT INTO `app_area` VALUES (341022, '休宁县', 'Xiuning', 341000, 3, '0559', '245400', 118.181, 29.7861);
INSERT INTO `app_area` VALUES (341023, '黟县', 'Yixian', 341000, 3, '0559', '245500', 117.941, 29.9259);
INSERT INTO `app_area` VALUES (341024, '祁门县', 'Qimen', 341000, 3, '0559', '245600', 117.718, 29.8572);
INSERT INTO `app_area` VALUES (341100, '滁州市', 'Chuzhou', 340000, 2, '0550', '239000', 118.316, 32.3036);
INSERT INTO `app_area` VALUES (341102, '琅琊区', 'Langya', 341100, 3, '0550', '239000', 118.305, 32.2952);
INSERT INTO `app_area` VALUES (341103, '南谯区', 'Nanqiao', 341100, 3, '0550', '239000', 118.312, 32.3186);
INSERT INTO `app_area` VALUES (341122, '来安县', 'Lai\'an', 341100, 3, '0550', '239200', 118.434, 32.4518);
INSERT INTO `app_area` VALUES (341124, '全椒县', 'Quanjiao', 341100, 3, '0550', '239500', 118.273, 32.0852);
INSERT INTO `app_area` VALUES (341125, '定远县', 'Dingyuan', 341100, 3, '0550', '233200', 117.68, 32.5249);
INSERT INTO `app_area` VALUES (341126, '凤阳县', 'Fengyang', 341100, 3, '0550', '233100', 117.565, 32.8651);
INSERT INTO `app_area` VALUES (341181, '天长市', 'Tianchang', 341100, 3, '0550', '239300', 118.999, 32.6912);
INSERT INTO `app_area` VALUES (341182, '明光市', 'Mingguang', 341100, 3, '0550', '239400', 117.991, 32.7782);
INSERT INTO `app_area` VALUES (341200, '阜阳市', 'Fuyang', 340000, 2, '0558', '236033', 115.82, 32.897);
INSERT INTO `app_area` VALUES (341202, '颍州区', 'Yingzhou', 341200, 3, '0558', '236001', 115.807, 32.8835);
INSERT INTO `app_area` VALUES (341203, '颍东区', 'Yingdong', 341200, 3, '0558', '236058', 115.857, 32.913);
INSERT INTO `app_area` VALUES (341204, '颍泉区', 'Yingquan', 341200, 3, '0558', '236045', 115.807, 32.9249);
INSERT INTO `app_area` VALUES (341221, '临泉县', 'Linquan', 341200, 3, '0558', '236400', 115.262, 33.0676);
INSERT INTO `app_area` VALUES (341222, '太和县', 'Taihe', 341200, 3, '0558', '236600', 115.622, 33.1603);
INSERT INTO `app_area` VALUES (341225, '阜南县', 'Funan', 341200, 3, '0558', '236300', 115.586, 32.6355);
INSERT INTO `app_area` VALUES (341226, '颍上县', 'Yingshang', 341200, 3, '0558', '236200', 116.265, 32.63);
INSERT INTO `app_area` VALUES (341282, '界首市', 'Jieshou', 341200, 3, '0558', '236500', 115.374, 33.2571);
INSERT INTO `app_area` VALUES (341300, '宿州市', 'Suzhou', 340000, 2, '0557', '234000', 116.984, 33.6339);
INSERT INTO `app_area` VALUES (341302, '埇桥区', 'Yongqiao', 341300, 3, '0557', '234000', 116.977, 33.6406);
INSERT INTO `app_area` VALUES (341321, '砀山县', 'Dangshan', 341300, 3, '0557', '235300', 116.354, 34.4236);
INSERT INTO `app_area` VALUES (341322, '萧县', 'Xiaoxian', 341300, 3, '0557', '235200', 116.945, 34.1879);
INSERT INTO `app_area` VALUES (341323, '灵璧县', 'Lingbi', 341300, 3, '0557', '234200', 117.558, 33.5434);
INSERT INTO `app_area` VALUES (341324, '泗县', 'Sixian', 341300, 3, '0557', '234300', 117.91, 33.4829);
INSERT INTO `app_area` VALUES (341500, '六安市', 'Lu\'an', 340000, 2, '0564', '237000', 116.508, 31.7529);
INSERT INTO `app_area` VALUES (341502, '金安区', 'Jin\'an', 341500, 3, '0564', '237005', 116.509, 31.7557);
INSERT INTO `app_area` VALUES (341503, '裕安区', 'Yu\'an', 341500, 3, '0564', '237010', 116.48, 31.7379);
INSERT INTO `app_area` VALUES (341521, '寿县', 'Shouxian', 341500, 3, '0564', '232200', 116.785, 32.5765);
INSERT INTO `app_area` VALUES (341522, '霍邱县', 'Huoqiu', 341500, 3, '0564', '237400', 116.278, 32.353);
INSERT INTO `app_area` VALUES (341523, '舒城县', 'Shucheng', 341500, 3, '0564', '231300', 116.945, 31.4641);
INSERT INTO `app_area` VALUES (341524, '金寨县', 'Jinzhai', 341500, 3, '0564', '237300', 115.935, 31.7351);
INSERT INTO `app_area` VALUES (341525, '霍山县', 'Huoshan', 341500, 3, '0564', '237200', 116.333, 31.3929);
INSERT INTO `app_area` VALUES (341600, '亳州市', 'Bozhou', 340000, 2, '0558', '236802', 115.783, 33.8693);
INSERT INTO `app_area` VALUES (341602, '谯城区', 'Qiaocheng', 341600, 3, '0558', '236800', 115.779, 33.8753);
INSERT INTO `app_area` VALUES (341621, '涡阳县', 'Guoyang', 341600, 3, '0558', '233600', 116.217, 33.5091);
INSERT INTO `app_area` VALUES (341622, '蒙城县', 'Mengcheng', 341600, 3, '0558', '233500', 116.565, 33.2648);
INSERT INTO `app_area` VALUES (341623, '利辛县', 'Lixin', 341600, 3, '0558', '236700', 116.208, 33.142);
INSERT INTO `app_area` VALUES (341700, '池州市', 'Chizhou', 340000, 2, '0566', '247100', 117.489, 30.656);
INSERT INTO `app_area` VALUES (341702, '贵池区', 'Guichi', 341700, 3, '0566', '247100', 117.487, 30.6528);
INSERT INTO `app_area` VALUES (341721, '东至县', 'Dongzhi', 341700, 3, '0566', '247200', 117.027, 30.0969);
INSERT INTO `app_area` VALUES (341722, '石台县', 'Shitai', 341700, 3, '0566', '245100', 117.487, 30.2104);
INSERT INTO `app_area` VALUES (341723, '青阳县', 'Qingyang', 341700, 3, '0566', '242800', 117.847, 30.6393);
INSERT INTO `app_area` VALUES (341800, '宣城市', 'Xuancheng', 340000, 2, '0563', '242000', 118.758, 30.9457);
INSERT INTO `app_area` VALUES (341802, '宣州区', 'Xuanzhou', 341800, 3, '0563', '242000', 118.755, 30.9444);
INSERT INTO `app_area` VALUES (341821, '郎溪县', 'Langxi', 341800, 3, '0563', '242100', 119.179, 31.126);
INSERT INTO `app_area` VALUES (341822, '广德县', 'Guangde', 341800, 3, '0563', '242200', 119.418, 30.8937);
INSERT INTO `app_area` VALUES (341823, '泾县', 'Jingxian', 341800, 3, '0563', '242500', 118.42, 30.695);
INSERT INTO `app_area` VALUES (341824, '绩溪县', 'Jixi', 341800, 3, '0563', '245300', 118.598, 30.0707);
INSERT INTO `app_area` VALUES (341825, '旌德县', 'Jingde', 341800, 3, '0563', '242600', 118.543, 30.289);
INSERT INTO `app_area` VALUES (341881, '宁国市', 'Ningguo', 341800, 3, '0563', '242300', 118.983, 30.6238);
INSERT INTO `app_area` VALUES (350000, '福建省', 'Fujian', 100000, 1, '', '', 119.306, 26.0753);
INSERT INTO `app_area` VALUES (350100, '福州市', 'Fuzhou', 350000, 2, '0591', '350001', 119.306, 26.0753);
INSERT INTO `app_area` VALUES (350102, '鼓楼区', 'Gulou', 350100, 3, '0591', '350001', 119.304, 26.0823);
INSERT INTO `app_area` VALUES (350103, '台江区', 'Taijiang', 350100, 3, '0591', '350004', 119.309, 26.062);
INSERT INTO `app_area` VALUES (350104, '仓山区', 'Cangshan', 350100, 3, '0591', '350007', 119.315, 26.0434);
INSERT INTO `app_area` VALUES (350105, '马尾区', 'Mawei', 350100, 3, '0591', '350015', 119.455, 25.9894);
INSERT INTO `app_area` VALUES (350111, '晋安区', 'Jin\'an', 350100, 3, '0591', '350011', 119.328, 26.0818);
INSERT INTO `app_area` VALUES (350121, '闽侯县', 'Minhou', 350100, 3, '0591', '350100', 119.134, 26.1501);
INSERT INTO `app_area` VALUES (350122, '连江县', 'Lianjiang', 350100, 3, '0591', '350500', 119.534, 26.1947);
INSERT INTO `app_area` VALUES (350123, '罗源县', 'Luoyuan', 350100, 3, '0591', '350600', 119.551, 26.4875);
INSERT INTO `app_area` VALUES (350124, '闽清县', 'Minqing', 350100, 3, '0591', '350800', 118.862, 26.219);
INSERT INTO `app_area` VALUES (350125, '永泰县', 'Yongtai', 350100, 3, '0591', '350700', 118.936, 25.8682);
INSERT INTO `app_area` VALUES (350128, '平潭县', 'Pingtan', 350100, 3, '0591', '350400', 119.791, 25.5037);
INSERT INTO `app_area` VALUES (350181, '福清市', 'Fuqing', 350100, 3, '0591', '350300', 119.385, 25.7209);
INSERT INTO `app_area` VALUES (350182, '长乐市', 'Changle', 350100, 3, '0591', '350200', 119.523, 25.9628);
INSERT INTO `app_area` VALUES (350200, '厦门市', 'Xiamen', 350000, 2, '0592', '361003', 118.11, 24.4905);
INSERT INTO `app_area` VALUES (350203, '思明区', 'Siming', 350200, 3, '0592', '361001', 118.082, 24.4454);
INSERT INTO `app_area` VALUES (350205, '海沧区', 'Haicang', 350200, 3, '0592', '361026', 118.033, 24.4846);
INSERT INTO `app_area` VALUES (350206, '湖里区', 'Huli', 350200, 3, '0592', '361006', 118.146, 24.5125);
INSERT INTO `app_area` VALUES (350211, '集美区', 'Jimei', 350200, 3, '0592', '361021', 118.097, 24.5758);
INSERT INTO `app_area` VALUES (350212, '同安区', 'Tong\'an', 350200, 3, '0592', '361100', 118.152, 24.7231);
INSERT INTO `app_area` VALUES (350213, '翔安区', 'Xiang\'an', 350200, 3, '0592', '361101', 118.248, 24.6186);
INSERT INTO `app_area` VALUES (350300, '莆田市', 'Putian', 350000, 2, '0594', '351100', 119.008, 25.431);
INSERT INTO `app_area` VALUES (350302, '城厢区', 'Chengxiang', 350300, 3, '0594', '351100', 118.995, 25.4187);
INSERT INTO `app_area` VALUES (350303, '涵江区', 'Hanjiang', 350300, 3, '0594', '351111', 119.116, 25.4588);
INSERT INTO `app_area` VALUES (350304, '荔城区', 'Licheng', 350300, 3, '0594', '351100', 119.013, 25.4337);
INSERT INTO `app_area` VALUES (350305, '秀屿区', 'Xiuyu', 350300, 3, '0594', '351152', 119.106, 25.3183);
INSERT INTO `app_area` VALUES (350322, '仙游县', 'Xianyou', 350300, 3, '0594', '351200', 118.692, 25.3621);
INSERT INTO `app_area` VALUES (350400, '三明市', 'Sanming', 350000, 2, '0598', '365000', 117.635, 26.2654);
INSERT INTO `app_area` VALUES (350402, '梅列区', 'Meilie', 350400, 3, '0598', '365000', 117.646, 26.2717);
INSERT INTO `app_area` VALUES (350403, '三元区', 'Sanyuan', 350400, 3, '0598', '365001', 117.608, 26.2337);
INSERT INTO `app_area` VALUES (350421, '明溪县', 'Mingxi', 350400, 3, '0598', '365200', 117.205, 26.3529);
INSERT INTO `app_area` VALUES (350423, '清流县', 'Qingliu', 350400, 3, '0598', '365300', 116.815, 26.1714);
INSERT INTO `app_area` VALUES (350424, '宁化县', 'Ninghua', 350400, 3, '0598', '365400', 116.661, 26.2587);
INSERT INTO `app_area` VALUES (350425, '大田县', 'Datian', 350400, 3, '0598', '366100', 117.847, 25.6926);
INSERT INTO `app_area` VALUES (350426, '尤溪县', 'Youxi', 350400, 3, '0598', '365100', 118.19, 26.17);
INSERT INTO `app_area` VALUES (350427, '沙县', 'Shaxian', 350400, 3, '0598', '365500', 117.793, 26.3962);
INSERT INTO `app_area` VALUES (350428, '将乐县', 'Jiangle', 350400, 3, '0598', '353300', 117.473, 26.7284);
INSERT INTO `app_area` VALUES (350429, '泰宁县', 'Taining', 350400, 3, '0598', '354400', 117.176, 26.9001);
INSERT INTO `app_area` VALUES (350430, '建宁县', 'Jianning', 350400, 3, '0598', '354500', 116.846, 26.8309);
INSERT INTO `app_area` VALUES (350481, '永安市', 'Yong\'an', 350400, 3, '0598', '366000', 117.365, 25.9414);
INSERT INTO `app_area` VALUES (350500, '泉州市', 'Quanzhou', 350000, 2, '0595', '362000', 118.589, 24.9089);
INSERT INTO `app_area` VALUES (350502, '鲤城区', 'Licheng', 350500, 3, '0595', '362000', 118.566, 24.8874);
INSERT INTO `app_area` VALUES (350503, '丰泽区', 'Fengze', 350500, 3, '0595', '362000', 118.613, 24.8912);
INSERT INTO `app_area` VALUES (350504, '洛江区', 'Luojiang', 350500, 3, '0595', '362011', 118.671, 24.9398);
INSERT INTO `app_area` VALUES (350505, '泉港区', 'Quangang', 350500, 3, '0595', '362114', 118.916, 25.1201);
INSERT INTO `app_area` VALUES (350521, '惠安县', 'Hui\'an', 350500, 3, '0595', '362100', 118.797, 25.0306);
INSERT INTO `app_area` VALUES (350524, '安溪县', 'Anxi', 350500, 3, '0595', '362400', 118.187, 25.0563);
INSERT INTO `app_area` VALUES (350525, '永春县', 'Yongchun', 350500, 3, '0595', '362600', 118.294, 25.3218);
INSERT INTO `app_area` VALUES (350526, '德化县', 'Dehua', 350500, 3, '0595', '362500', 118.242, 25.4922);
INSERT INTO `app_area` VALUES (350527, '金门县', 'Jinmen', 350500, 3, '', '', 118.323, 24.4292);
INSERT INTO `app_area` VALUES (350581, '石狮市', 'Shishi', 350500, 3, '0595', '362700', 118.648, 24.7324);
INSERT INTO `app_area` VALUES (350582, '晋江市', 'Jinjiang', 350500, 3, '0595', '362200', 118.552, 24.7814);
INSERT INTO `app_area` VALUES (350583, '南安市', 'Nan\'an', 350500, 3, '0595', '362300', 118.386, 24.9606);
INSERT INTO `app_area` VALUES (350600, '漳州市', 'Zhangzhou', 350000, 2, '0596', '363005', 117.662, 24.5109);
INSERT INTO `app_area` VALUES (350602, '芗城区', 'Xiangcheng', 350600, 3, '0596', '363000', 117.654, 24.5108);
INSERT INTO `app_area` VALUES (350603, '龙文区', 'Longwen', 350600, 3, '0596', '363005', 117.71, 24.5032);
INSERT INTO `app_area` VALUES (350622, '云霄县', 'Yunxiao', 350600, 3, '0596', '363300', 117.341, 23.9553);
INSERT INTO `app_area` VALUES (350623, '漳浦县', 'Zhangpu', 350600, 3, '0596', '363200', 117.614, 24.1171);
INSERT INTO `app_area` VALUES (350624, '诏安县', 'Zhao\'an', 350600, 3, '0596', '363500', 117.175, 23.7115);
INSERT INTO `app_area` VALUES (350625, '长泰县', 'Changtai', 350600, 3, '0596', '363900', 117.759, 24.6253);
INSERT INTO `app_area` VALUES (350626, '东山县', 'Dongshan', 350600, 3, '0596', '363400', 117.428, 23.7011);
INSERT INTO `app_area` VALUES (350627, '南靖县', 'Nanjing', 350600, 3, '0596', '363600', 117.357, 24.5145);
INSERT INTO `app_area` VALUES (350628, '平和县', 'Pinghe', 350600, 3, '0596', '363700', 117.312, 24.364);
INSERT INTO `app_area` VALUES (350629, '华安县', 'Hua\'an', 350600, 3, '0596', '363800', 117.541, 25.0056);
INSERT INTO `app_area` VALUES (350681, '龙海市', 'Longhai', 350600, 3, '0596', '363100', 117.818, 24.4466);
INSERT INTO `app_area` VALUES (350700, '南平市', 'Nanping', 350000, 2, '0599', '353000', 118.178, 26.6356);
INSERT INTO `app_area` VALUES (350702, '延平区', 'Yanping', 350700, 3, '0600', '353000', 118.182, 26.6374);
INSERT INTO `app_area` VALUES (350703, '建阳区', 'Jianyang', 350700, 3, '0599', '354200', 118.123, 27.3321);
INSERT INTO `app_area` VALUES (350721, '顺昌县', 'Shunchang', 350700, 3, '0605', '353200', 117.81, 26.793);
INSERT INTO `app_area` VALUES (350722, '浦城县', 'Pucheng', 350700, 3, '0606', '353400', 118.54, 27.9189);
INSERT INTO `app_area` VALUES (350723, '光泽县', 'Guangze', 350700, 3, '0607', '354100', 117.333, 27.5423);
INSERT INTO `app_area` VALUES (350724, '松溪县', 'Songxi', 350700, 3, '0608', '353500', 118.785, 27.5262);
INSERT INTO `app_area` VALUES (350725, '政和县', 'Zhenghe', 350700, 3, '0609', '353600', 118.856, 27.3677);
INSERT INTO `app_area` VALUES (350781, '邵武市', 'Shaowu', 350700, 3, '0601', '354000', 117.492, 27.3403);
INSERT INTO `app_area` VALUES (350782, '武夷山市', 'Wuyishan', 350700, 3, '0602', '354300', 118.037, 27.7554);
INSERT INTO `app_area` VALUES (350783, '建瓯市', 'Jianou', 350700, 3, '0603', '353100', 118.298, 27.023);
INSERT INTO `app_area` VALUES (350800, '龙岩市', 'Longyan', 350000, 2, '0597', '364000', 117.03, 25.0916);
INSERT INTO `app_area` VALUES (350802, '新罗区', 'Xinluo', 350800, 3, '0597', '364000', 117.037, 25.0983);
INSERT INTO `app_area` VALUES (350821, '长汀县', 'Changting', 350800, 3, '0597', '366300', 116.359, 25.8277);
INSERT INTO `app_area` VALUES (350822, '永定区', 'Yongding', 350800, 3, '0597', '364100', 116.732, 24.723);
INSERT INTO `app_area` VALUES (350823, '上杭县', 'Shanghang', 350800, 3, '0597', '364200', 116.42, 25.0494);
INSERT INTO `app_area` VALUES (350824, '武平县', 'Wuping', 350800, 3, '0597', '364300', 116.102, 25.0924);
INSERT INTO `app_area` VALUES (350825, '连城县', 'Liancheng', 350800, 3, '0597', '366200', 116.755, 25.7103);
INSERT INTO `app_area` VALUES (350881, '漳平市', 'Zhangping', 350800, 3, '0597', '364400', 117.42, 25.2911);
INSERT INTO `app_area` VALUES (350900, '宁德市', 'Ningde', 350000, 2, '0593', '352100', 119.527, 26.6592);
INSERT INTO `app_area` VALUES (350902, '蕉城区', 'Jiaocheng', 350900, 3, '0593', '352100', 119.526, 26.6605);
INSERT INTO `app_area` VALUES (350921, '霞浦县', 'Xiapu', 350900, 3, '0593', '355100', 119.999, 26.8858);
INSERT INTO `app_area` VALUES (350922, '古田县', 'Gutian', 350900, 3, '0593', '352200', 118.747, 26.5768);
INSERT INTO `app_area` VALUES (350923, '屏南县', 'Pingnan', 350900, 3, '0593', '352300', 118.989, 26.911);
INSERT INTO `app_area` VALUES (350924, '寿宁县', 'Shouning', 350900, 3, '0593', '355500', 119.504, 27.46);
INSERT INTO `app_area` VALUES (350925, '周宁县', 'Zhouning', 350900, 3, '0593', '355400', 119.338, 27.1066);
INSERT INTO `app_area` VALUES (350926, '柘荣县', 'Zherong', 350900, 3, '0593', '355300', 119.9, 27.2354);
INSERT INTO `app_area` VALUES (350981, '福安市', 'Fu\'an', 350900, 3, '0593', '355000', 119.649, 27.0867);
INSERT INTO `app_area` VALUES (350982, '福鼎市', 'Fuding', 350900, 3, '0593', '355200', 120.217, 27.3243);
INSERT INTO `app_area` VALUES (360000, '江西省', 'Jiangxi', 100000, 1, '', '', 115.892, 28.6765);
INSERT INTO `app_area` VALUES (360100, '南昌市', 'Nanchang', 360000, 2, '0791', '330008', 115.892, 28.6765);
INSERT INTO `app_area` VALUES (360102, '东湖区', 'Donghu', 360100, 3, '0791', '330006', 115.899, 28.685);
INSERT INTO `app_area` VALUES (360103, '西湖区', 'Xihu', 360100, 3, '0791', '330009', 115.877, 28.6569);
INSERT INTO `app_area` VALUES (360104, '青云谱区', 'Qingyunpu', 360100, 3, '0791', '330001', 115.915, 28.632);
INSERT INTO `app_area` VALUES (360105, '湾里区', 'Wanli', 360100, 3, '0791', '330004', 115.731, 28.7153);
INSERT INTO `app_area` VALUES (360111, '青山湖区', 'Qingshanhu', 360100, 3, '0791', '330029', 115.962, 28.6821);
INSERT INTO `app_area` VALUES (360121, '南昌县', 'Nanchang', 360100, 3, '0791', '330200', 115.944, 28.5456);
INSERT INTO `app_area` VALUES (360122, '新建县', 'Xinjian', 360100, 3, '0791', '330100', 115.815, 28.6925);
INSERT INTO `app_area` VALUES (360123, '安义县', 'Anyi', 360100, 3, '0791', '330500', 115.549, 28.846);
INSERT INTO `app_area` VALUES (360124, '进贤县', 'Jinxian', 360100, 3, '0791', '331700', 116.241, 28.3768);
INSERT INTO `app_area` VALUES (360200, '景德镇市', 'Jingdezhen', 360000, 2, '0798', '333000', 117.215, 29.2926);
INSERT INTO `app_area` VALUES (360202, '昌江区', 'Changjiang', 360200, 3, '0799', '333000', 117.184, 29.2732);
INSERT INTO `app_area` VALUES (360203, '珠山区', 'Zhushan', 360200, 3, '0800', '333000', 117.202, 29.3013);
INSERT INTO `app_area` VALUES (360222, '浮梁县', 'Fuliang', 360200, 3, '0802', '333400', 117.215, 29.3516);
INSERT INTO `app_area` VALUES (360281, '乐平市', 'Leping', 360200, 3, '0801', '333300', 117.129, 28.9629);
INSERT INTO `app_area` VALUES (360300, '萍乡市', 'Pingxiang', 360000, 2, '0799', '337000', 113.852, 27.6229);
INSERT INTO `app_area` VALUES (360302, '安源区', 'Anyuan', 360300, 3, '0800', '337000', 113.891, 27.6165);
INSERT INTO `app_area` VALUES (360313, '湘东区', 'Xiangdong', 360300, 3, '0801', '337016', 113.733, 27.6401);
INSERT INTO `app_area` VALUES (360321, '莲花县', 'Lianhua', 360300, 3, '0802', '337100', 113.961, 27.1287);
INSERT INTO `app_area` VALUES (360322, '上栗县', 'Shangli', 360300, 3, '0803', '337009', 113.794, 27.8747);
INSERT INTO `app_area` VALUES (360323, '芦溪县', 'Luxi', 360300, 3, '0804', '337053', 114.03, 27.6306);
INSERT INTO `app_area` VALUES (360400, '九江市', 'Jiujiang', 360000, 2, '0792', '332000', 115.993, 29.712);
INSERT INTO `app_area` VALUES (360402, '庐山区', 'Lushan', 360400, 3, '0792', '332005', 115.989, 29.6718);
INSERT INTO `app_area` VALUES (360403, '浔阳区', 'Xunyang', 360400, 3, '0792', '332000', 115.99, 29.7279);
INSERT INTO `app_area` VALUES (360421, '九江县', 'Jiujiang', 360400, 3, '0792', '332100', 115.911, 29.6085);
INSERT INTO `app_area` VALUES (360423, '武宁县', 'Wuning', 360400, 3, '0792', '332300', 115.101, 29.2584);
INSERT INTO `app_area` VALUES (360424, '修水县', 'Xiushui', 360400, 3, '0792', '332400', 114.547, 29.0254);
INSERT INTO `app_area` VALUES (360425, '永修县', 'Yongxiu', 360400, 3, '0792', '330300', 115.809, 29.0209);
INSERT INTO `app_area` VALUES (360426, '德安县', 'De\'an', 360400, 3, '0792', '330400', 115.756, 29.3134);
INSERT INTO `app_area` VALUES (360427, '星子县', 'Xingzi', 360400, 3, '0792', '332800', 116.045, 29.4461);
INSERT INTO `app_area` VALUES (360428, '都昌县', 'Duchang', 360400, 3, '0792', '332600', 116.204, 29.2733);
INSERT INTO `app_area` VALUES (360429, '湖口县', 'Hukou', 360400, 3, '0792', '332500', 116.219, 29.7382);
INSERT INTO `app_area` VALUES (360430, '彭泽县', 'Pengze', 360400, 3, '0792', '332700', 116.55, 29.8959);
INSERT INTO `app_area` VALUES (360481, '瑞昌市', 'Ruichang', 360400, 3, '0792', '332200', 115.667, 29.6718);
INSERT INTO `app_area` VALUES (360482, '共青城市', 'Gongqingcheng', 360400, 3, '0792', '332020', 115.802, 29.2388);
INSERT INTO `app_area` VALUES (360500, '新余市', 'Xinyu', 360000, 2, '0790', '338025', 114.931, 27.8108);
INSERT INTO `app_area` VALUES (360502, '渝水区', 'Yushui', 360500, 3, '0790', '338025', 114.944, 27.801);
INSERT INTO `app_area` VALUES (360521, '分宜县', 'Fenyi', 360500, 3, '0790', '336600', 114.692, 27.8148);
INSERT INTO `app_area` VALUES (360600, '鹰潭市', 'Yingtan', 360000, 2, '0701', '335000', 117.034, 28.2386);
INSERT INTO `app_area` VALUES (360602, '月湖区', 'Yuehu', 360600, 3, '0701', '335000', 117.037, 28.2391);
INSERT INTO `app_area` VALUES (360622, '余江县', 'Yujiang', 360600, 3, '0701', '335200', 116.819, 28.2103);
INSERT INTO `app_area` VALUES (360681, '贵溪市', 'Guixi', 360600, 3, '0701', '335400', 117.242, 28.2926);
INSERT INTO `app_area` VALUES (360700, '赣州市', 'Ganzhou', 360000, 2, '0797', '341000', 114.94, 25.851);
INSERT INTO `app_area` VALUES (360702, '章贡区', 'Zhanggong', 360700, 3, '0797', '341000', 114.943, 25.8624);
INSERT INTO `app_area` VALUES (360703, '南康区', 'Nankang', 360700, 3, '0797', '341400', 114.757, 25.6617);
INSERT INTO `app_area` VALUES (360721, '赣县', 'Ganxian', 360700, 3, '0797', '341100', 115.012, 25.8615);
INSERT INTO `app_area` VALUES (360722, '信丰县', 'Xinfeng', 360700, 3, '0797', '341600', 114.923, 25.3861);
INSERT INTO `app_area` VALUES (360723, '大余县', 'Dayu', 360700, 3, '0797', '341500', 114.358, 25.3956);
INSERT INTO `app_area` VALUES (360724, '上犹县', 'Shangyou', 360700, 3, '0797', '341200', 114.541, 25.7957);
INSERT INTO `app_area` VALUES (360725, '崇义县', 'Chongyi', 360700, 3, '0797', '341300', 114.308, 25.6819);
INSERT INTO `app_area` VALUES (360726, '安远县', 'Anyuan', 360700, 3, '0797', '342100', 115.395, 25.1371);
INSERT INTO `app_area` VALUES (360727, '龙南县', 'Longnan', 360700, 3, '0797', '341700', 114.79, 24.9109);
INSERT INTO `app_area` VALUES (360728, '定南县', 'Dingnan', 360700, 3, '0797', '341900', 115.027, 24.784);
INSERT INTO `app_area` VALUES (360729, '全南县', 'Quannan', 360700, 3, '0797', '341800', 114.529, 24.7432);
INSERT INTO `app_area` VALUES (360730, '宁都县', 'Ningdu', 360700, 3, '0797', '342800', 116.016, 26.4723);
INSERT INTO `app_area` VALUES (360731, '于都县', 'Yudu', 360700, 3, '0797', '342300', 115.414, 25.9526);
INSERT INTO `app_area` VALUES (360732, '兴国县', 'Xingguo', 360700, 3, '0797', '342400', 115.363, 26.3378);
INSERT INTO `app_area` VALUES (360733, '会昌县', 'Huichang', 360700, 3, '0797', '342600', 115.786, 25.6007);
INSERT INTO `app_area` VALUES (360734, '寻乌县', 'Xunwu', 360700, 3, '0797', '342200', 115.649, 24.9551);
INSERT INTO `app_area` VALUES (360735, '石城县', 'Shicheng', 360700, 3, '0797', '342700', 116.344, 26.3262);
INSERT INTO `app_area` VALUES (360781, '瑞金市', 'Ruijin', 360700, 3, '0797', '342500', 116.027, 25.8856);
INSERT INTO `app_area` VALUES (360800, '吉安市', 'Ji\'an', 360000, 2, '0796', '343000', 114.986, 27.1117);
INSERT INTO `app_area` VALUES (360802, '吉州区', 'Jizhou', 360800, 3, '0796', '343000', 114.976, 27.1067);
INSERT INTO `app_area` VALUES (360803, '青原区', 'Qingyuan', 360800, 3, '0796', '343009', 115.017, 27.1058);
INSERT INTO `app_area` VALUES (360821, '吉安县', 'Ji\'an', 360800, 3, '0796', '343100', 114.907, 27.0405);
INSERT INTO `app_area` VALUES (360822, '吉水县', 'Jishui', 360800, 3, '0796', '331600', 115.134, 27.2107);
INSERT INTO `app_area` VALUES (360823, '峡江县', 'Xiajiang', 360800, 3, '0796', '331409', 115.317, 27.576);
INSERT INTO `app_area` VALUES (360824, '新干县', 'Xingan', 360800, 3, '0796', '331300', 115.393, 27.7409);
INSERT INTO `app_area` VALUES (360825, '永丰县', 'Yongfeng', 360800, 3, '0796', '331500', 115.442, 27.3179);
INSERT INTO `app_area` VALUES (360826, '泰和县', 'Taihe', 360800, 3, '0796', '343700', 114.908, 26.7911);
INSERT INTO `app_area` VALUES (360827, '遂川县', 'Suichuan', 360800, 3, '0796', '343900', 114.516, 26.326);
INSERT INTO `app_area` VALUES (360828, '万安县', 'Wan\'an', 360800, 3, '0796', '343800', 114.787, 26.4593);
INSERT INTO `app_area` VALUES (360829, '安福县', 'Anfu', 360800, 3, '0796', '343200', 114.62, 27.3928);
INSERT INTO `app_area` VALUES (360830, '永新县', 'Yongxin', 360800, 3, '0796', '343400', 114.242, 26.9449);
INSERT INTO `app_area` VALUES (360881, '井冈山市', 'Jinggangshan', 360800, 3, '0796', '343600', 114.289, 26.748);
INSERT INTO `app_area` VALUES (360900, '宜春市', 'Yichun', 360000, 2, '0795', '336000', 114.391, 27.8043);
INSERT INTO `app_area` VALUES (360902, '袁州区', 'Yuanzhou', 360900, 3, '0795', '336000', 114.382, 27.7965);
INSERT INTO `app_area` VALUES (360921, '奉新县', 'Fengxin', 360900, 3, '0795', '330700', 115.4, 28.6879);
INSERT INTO `app_area` VALUES (360922, '万载县', 'Wanzai', 360900, 3, '0795', '336100', 114.446, 28.1066);
INSERT INTO `app_area` VALUES (360923, '上高县', 'Shanggao', 360900, 3, '0795', '336400', 114.925, 28.2342);
INSERT INTO `app_area` VALUES (360924, '宜丰县', 'Yifeng', 360900, 3, '0795', '336300', 114.78, 28.3855);
INSERT INTO `app_area` VALUES (360925, '靖安县', 'Jing\'an', 360900, 3, '0795', '330600', 115.363, 28.8617);
INSERT INTO `app_area` VALUES (360926, '铜鼓县', 'Tonggu', 360900, 3, '0795', '336200', 114.37, 28.5231);
INSERT INTO `app_area` VALUES (360981, '丰城市', 'Fengcheng', 360900, 3, '0795', '331100', 115.771, 28.1592);
INSERT INTO `app_area` VALUES (360982, '樟树市', 'Zhangshu', 360900, 3, '0795', '331200', 115.547, 28.0533);
INSERT INTO `app_area` VALUES (360983, '高安市', 'Gao\'an', 360900, 3, '0795', '330800', 115.375, 28.4178);
INSERT INTO `app_area` VALUES (361000, '抚州市', 'Fuzhou', 360000, 2, '0794', '344000', 116.358, 27.9839);
INSERT INTO `app_area` VALUES (361002, '临川区', 'Linchuan', 361000, 3, '0794', '344000', 116.359, 27.9772);
INSERT INTO `app_area` VALUES (361021, '南城县', 'Nancheng', 361000, 3, '0794', '344700', 116.644, 27.5538);
INSERT INTO `app_area` VALUES (361022, '黎川县', 'Lichuan', 361000, 3, '0794', '344600', 116.908, 27.2823);
INSERT INTO `app_area` VALUES (361023, '南丰县', 'Nanfeng', 361000, 3, '0794', '344500', 116.526, 27.2184);
INSERT INTO `app_area` VALUES (361024, '崇仁县', 'Chongren', 361000, 3, '0794', '344200', 116.06, 27.7596);
INSERT INTO `app_area` VALUES (361025, '乐安县', 'Le\'an', 361000, 3, '0794', '344300', 115.831, 27.4281);
INSERT INTO `app_area` VALUES (361026, '宜黄县', 'Yihuang', 361000, 3, '0794', '344400', 116.236, 27.5549);
INSERT INTO `app_area` VALUES (361027, '金溪县', 'Jinxi', 361000, 3, '0794', '344800', 116.774, 27.9075);
INSERT INTO `app_area` VALUES (361028, '资溪县', 'Zixi', 361000, 3, '0794', '335300', 117.069, 27.7049);
INSERT INTO `app_area` VALUES (361029, '东乡县', 'Dongxiang', 361000, 3, '0794', '331800', 116.59, 28.2361);
INSERT INTO `app_area` VALUES (361030, '广昌县', 'Guangchang', 361000, 3, '0794', '344900', 116.325, 26.8341);
INSERT INTO `app_area` VALUES (361100, '上饶市', 'Shangrao', 360000, 2, '0793', '334000', 117.971, 28.4444);
INSERT INTO `app_area` VALUES (361102, '信州区', 'Xinzhou', 361100, 3, '0793', '334000', 117.967, 28.4312);
INSERT INTO `app_area` VALUES (361121, '上饶县', 'Shangrao', 361100, 3, '0793', '334100', 117.909, 28.4486);
INSERT INTO `app_area` VALUES (361122, '广丰县', 'Guangfeng', 361100, 3, '0793', '334600', 118.192, 28.4377);
INSERT INTO `app_area` VALUES (361123, '玉山县', 'Yushan', 361100, 3, '0793', '334700', 118.245, 28.6818);
INSERT INTO `app_area` VALUES (361124, '铅山县', 'Yanshan', 361100, 3, '0793', '334500', 117.71, 28.3155);
INSERT INTO `app_area` VALUES (361125, '横峰县', 'Hengfeng', 361100, 3, '0793', '334300', 117.596, 28.4072);
INSERT INTO `app_area` VALUES (361126, '弋阳县', 'Yiyang', 361100, 3, '0793', '334400', 117.459, 28.3745);
INSERT INTO `app_area` VALUES (361127, '余干县', 'Yugan', 361100, 3, '0793', '335100', 116.696, 28.7021);
INSERT INTO `app_area` VALUES (361128, '鄱阳县', 'Poyang', 361100, 3, '0793', '333100', 116.7, 29.0118);
INSERT INTO `app_area` VALUES (361129, '万年县', 'Wannian', 361100, 3, '0793', '335500', 117.069, 28.6954);
INSERT INTO `app_area` VALUES (361130, '婺源县', 'Wuyuan', 361100, 3, '0793', '333200', 117.861, 29.2484);
INSERT INTO `app_area` VALUES (361181, '德兴市', 'Dexing', 361100, 3, '0793', '334200', 117.579, 28.9474);
INSERT INTO `app_area` VALUES (370000, '山东省', 'Shandong', 100000, 1, '', '', 117.001, 36.6758);
INSERT INTO `app_area` VALUES (370100, '济南市', 'Jinan', 370000, 2, '0531', '250001', 117.001, 36.6758);
INSERT INTO `app_area` VALUES (370102, '历下区', 'Lixia', 370100, 3, '0531', '250014', 117.077, 36.6666);
INSERT INTO `app_area` VALUES (370103, '市中区', 'Shizhongqu', 370100, 3, '0531', '250001', 116.997, 36.651);
INSERT INTO `app_area` VALUES (370104, '槐荫区', 'Huaiyin', 370100, 3, '0531', '250117', 116.901, 36.6514);
INSERT INTO `app_area` VALUES (370105, '天桥区', 'Tianqiao', 370100, 3, '0531', '250031', 116.987, 36.678);
INSERT INTO `app_area` VALUES (370112, '历城区', 'Licheng', 370100, 3, '0531', '250100', 117.065, 36.68);
INSERT INTO `app_area` VALUES (370113, '长清区', 'Changqing', 370100, 3, '0531', '250300', 116.752, 36.5535);
INSERT INTO `app_area` VALUES (370124, '平阴县', 'Pingyin', 370100, 3, '0531', '250400', 116.456, 36.2896);
INSERT INTO `app_area` VALUES (370125, '济阳县', 'Jiyang', 370100, 3, '0531', '251400', 117.173, 36.9785);
INSERT INTO `app_area` VALUES (370126, '商河县', 'Shanghe', 370100, 3, '0531', '251600', 117.157, 37.3112);
INSERT INTO `app_area` VALUES (370181, '章丘市', 'Zhangqiu', 370100, 3, '0531', '250200', 117.537, 36.7139);
INSERT INTO `app_area` VALUES (370200, '青岛市', 'Qingdao', 370000, 2, '0532', '266001', 120.37, 36.0944);
INSERT INTO `app_area` VALUES (370202, '市南区', 'Shinan', 370200, 3, '0532', '266001', 120.388, 36.0667);
INSERT INTO `app_area` VALUES (370203, '市北区', 'Shibei', 370200, 3, '0532', '266011', 120.375, 36.0873);
INSERT INTO `app_area` VALUES (370211, '黄岛区', 'Huangdao', 370200, 3, '0532', '266500', 120.198, 35.9607);
INSERT INTO `app_area` VALUES (370212, '崂山区', 'Laoshan', 370200, 3, '0532', '266100', 120.469, 36.1072);
INSERT INTO `app_area` VALUES (370213, '李沧区', 'Licang', 370200, 3, '0532', '266021', 120.433, 36.145);
INSERT INTO `app_area` VALUES (370214, '城阳区', 'Chengyang', 370200, 3, '0532', '266041', 120.396, 36.3074);
INSERT INTO `app_area` VALUES (370281, '胶州市', 'Jiaozhou', 370200, 3, '0532', '266300', 120.034, 36.2644);
INSERT INTO `app_area` VALUES (370282, '即墨市', 'Jimo', 370200, 3, '0532', '266200', 120.447, 36.3891);
INSERT INTO `app_area` VALUES (370283, '平度市', 'Pingdu', 370200, 3, '0532', '266700', 119.96, 36.7869);
INSERT INTO `app_area` VALUES (370285, '莱西市', 'Laixi', 370200, 3, '0532', '266600', 120.518, 36.888);
INSERT INTO `app_area` VALUES (370286, '西海岸新区', 'Xihai\'an', 370200, 3, '0532', '266500', 120.198, 35.9607);
INSERT INTO `app_area` VALUES (370300, '淄博市', 'Zibo', 370000, 2, '0533', '255039', 118.048, 36.8149);
INSERT INTO `app_area` VALUES (370302, '淄川区', 'Zichuan', 370300, 3, '0533', '255100', 117.967, 36.6434);
INSERT INTO `app_area` VALUES (370303, '张店区', 'Zhangdian', 370300, 3, '0533', '255022', 118.018, 36.8068);
INSERT INTO `app_area` VALUES (370304, '博山区', 'Boshan', 370300, 3, '0533', '255200', 117.862, 36.4947);
INSERT INTO `app_area` VALUES (370305, '临淄区', 'Linzi', 370300, 3, '0533', '255400', 118.31, 36.8259);
INSERT INTO `app_area` VALUES (370306, '周村区', 'Zhoucun', 370300, 3, '0533', '255300', 117.87, 36.8032);
INSERT INTO `app_area` VALUES (370321, '桓台县', 'Huantai', 370300, 3, '0533', '256400', 118.097, 36.9604);
INSERT INTO `app_area` VALUES (370322, '高青县', 'Gaoqing', 370300, 3, '0533', '256300', 117.827, 37.172);
INSERT INTO `app_area` VALUES (370323, '沂源县', 'Yiyuan', 370300, 3, '0533', '256100', 118.171, 36.1854);
INSERT INTO `app_area` VALUES (370400, '枣庄市', 'Zaozhuang', 370000, 2, '0632', '277101', 117.558, 34.8564);
INSERT INTO `app_area` VALUES (370402, '市中区', 'Shizhongqu', 370400, 3, '0632', '277101', 117.556, 34.8639);
INSERT INTO `app_area` VALUES (370403, '薛城区', 'Xuecheng', 370400, 3, '0632', '277000', 117.263, 34.795);
INSERT INTO `app_area` VALUES (370404, '峄城区', 'Yicheng', 370400, 3, '0632', '277300', 117.591, 34.7723);
INSERT INTO `app_area` VALUES (370405, '台儿庄区', 'Taierzhuang', 370400, 3, '0632', '277400', 117.735, 34.5636);
INSERT INTO `app_area` VALUES (370406, '山亭区', 'Shanting', 370400, 3, '0632', '277200', 117.466, 35.0954);
INSERT INTO `app_area` VALUES (370481, '滕州市', 'Tengzhou', 370400, 3, '0632', '277500', 117.165, 35.1053);
INSERT INTO `app_area` VALUES (370500, '东营市', 'Dongying', 370000, 2, '0546', '257093', 118.496, 37.4613);
INSERT INTO `app_area` VALUES (370502, '东营区', 'Dongying', 370500, 3, '0546', '257029', 118.582, 37.4487);
INSERT INTO `app_area` VALUES (370503, '河口区', 'Hekou', 370500, 3, '0546', '257200', 118.525, 37.8854);
INSERT INTO `app_area` VALUES (370521, '垦利县', 'Kenli', 370500, 3, '0546', '257500', 118.548, 37.5882);
INSERT INTO `app_area` VALUES (370522, '利津县', 'Lijin', 370500, 3, '0546', '257400', 118.256, 37.4916);
INSERT INTO `app_area` VALUES (370523, '广饶县', 'Guangrao', 370500, 3, '0546', '257300', 118.407, 37.0538);
INSERT INTO `app_area` VALUES (370600, '烟台市', 'Yantai', 370000, 2, '0635', '264010', 121.391, 37.5393);
INSERT INTO `app_area` VALUES (370602, '芝罘区', 'Zhifu', 370600, 3, '0635', '264001', 121.4, 37.5406);
INSERT INTO `app_area` VALUES (370611, '福山区', 'Fushan', 370600, 3, '0635', '265500', 121.268, 37.4984);
INSERT INTO `app_area` VALUES (370612, '牟平区', 'Muping', 370600, 3, '0635', '264100', 121.601, 37.3885);
INSERT INTO `app_area` VALUES (370613, '莱山区', 'Laishan', 370600, 3, '0635', '264600', 121.445, 37.5117);
INSERT INTO `app_area` VALUES (370634, '长岛县', 'Changdao', 370600, 3, '0635', '265800', 120.738, 37.9175);
INSERT INTO `app_area` VALUES (370681, '龙口市', 'Longkou', 370600, 3, '0635', '265700', 120.506, 37.6406);
INSERT INTO `app_area` VALUES (370682, '莱阳市', 'Laiyang', 370600, 3, '0635', '265200', 120.711, 36.9801);
INSERT INTO `app_area` VALUES (370683, '莱州市', 'Laizhou', 370600, 3, '0635', '261400', 119.941, 37.1781);
INSERT INTO `app_area` VALUES (370684, '蓬莱市', 'Penglai', 370600, 3, '0635', '265600', 120.76, 37.8112);
INSERT INTO `app_area` VALUES (370685, '招远市', 'Zhaoyuan', 370600, 3, '0635', '265400', 120.405, 37.3627);
INSERT INTO `app_area` VALUES (370686, '栖霞市', 'Qixia', 370600, 3, '0635', '265300', 120.85, 37.3357);
INSERT INTO `app_area` VALUES (370687, '海阳市', 'Haiyang', 370600, 3, '0635', '265100', 121.16, 36.7762);
INSERT INTO `app_area` VALUES (370700, '潍坊市', 'Weifang', 370000, 2, '0536', '261041', 119.107, 36.7093);
INSERT INTO `app_area` VALUES (370702, '潍城区', 'Weicheng', 370700, 3, '0536', '261021', 119.106, 36.7139);
INSERT INTO `app_area` VALUES (370703, '寒亭区', 'Hanting', 370700, 3, '0536', '261100', 119.218, 36.775);
INSERT INTO `app_area` VALUES (370704, '坊子区', 'Fangzi', 370700, 3, '0536', '261200', 119.165, 36.6522);
INSERT INTO `app_area` VALUES (370705, '奎文区', 'Kuiwen', 370700, 3, '0536', '261031', 119.125, 36.7072);
INSERT INTO `app_area` VALUES (370724, '临朐县', 'Linqu', 370700, 3, '0536', '262600', 118.544, 36.5122);
INSERT INTO `app_area` VALUES (370725, '昌乐县', 'Changle', 370700, 3, '0536', '262400', 118.83, 36.7078);
INSERT INTO `app_area` VALUES (370781, '青州市', 'Qingzhou', 370700, 3, '0536', '262500', 118.479, 36.6851);
INSERT INTO `app_area` VALUES (370782, '诸城市', 'Zhucheng', 370700, 3, '0536', '262200', 119.41, 35.9966);
INSERT INTO `app_area` VALUES (370783, '寿光市', 'Shouguang', 370700, 3, '0536', '262700', 118.74, 36.8813);
INSERT INTO `app_area` VALUES (370784, '安丘市', 'Anqiu', 370700, 3, '0536', '262100', 119.219, 36.4785);
INSERT INTO `app_area` VALUES (370785, '高密市', 'Gaomi', 370700, 3, '0536', '261500', 119.757, 36.384);
INSERT INTO `app_area` VALUES (370786, '昌邑市', 'Changyi', 370700, 3, '0536', '261300', 119.398, 36.8601);
INSERT INTO `app_area` VALUES (370800, '济宁市', 'Jining', 370000, 2, '0537', '272119', 116.587, 35.4154);
INSERT INTO `app_area` VALUES (370811, '任城区', 'Rencheng', 370800, 3, '0537', '272113', 116.595, 35.4066);
INSERT INTO `app_area` VALUES (370812, '兖州区', 'Yanzhou ', 370800, 3, '0537', '272000', 116.827, 35.5523);
INSERT INTO `app_area` VALUES (370826, '微山县', 'Weishan', 370800, 3, '0537', '277600', 117.129, 34.8071);
INSERT INTO `app_area` VALUES (370827, '鱼台县', 'Yutai', 370800, 3, '0537', '272300', 116.648, 34.9967);
INSERT INTO `app_area` VALUES (370828, '金乡县', 'Jinxiang', 370800, 3, '0537', '272200', 116.311, 35.065);
INSERT INTO `app_area` VALUES (370829, '嘉祥县', 'Jiaxiang', 370800, 3, '0537', '272400', 116.342, 35.4084);
INSERT INTO `app_area` VALUES (370830, '汶上县', 'Wenshang', 370800, 3, '0537', '272501', 116.487, 35.7329);
INSERT INTO `app_area` VALUES (370831, '泗水县', 'Sishui', 370800, 3, '0537', '273200', 117.279, 35.6611);
INSERT INTO `app_area` VALUES (370832, '梁山县', 'Liangshan', 370800, 3, '0537', '272600', 116.097, 35.8032);
INSERT INTO `app_area` VALUES (370881, '曲阜市', 'Qufu', 370800, 3, '0537', '273100', 116.986, 35.5809);
INSERT INTO `app_area` VALUES (370883, '邹城市', 'Zoucheng', 370800, 3, '0537', '273500', 116.973, 35.4053);
INSERT INTO `app_area` VALUES (370900, '泰安市', 'Tai\'an', 370000, 2, '0538', '271000', 117.129, 36.195);
INSERT INTO `app_area` VALUES (370902, '泰山区', 'Taishan', 370900, 3, '0538', '271000', 117.134, 36.1941);
INSERT INTO `app_area` VALUES (370911, '岱岳区', 'Daiyue', 370900, 3, '0538', '271000', 117.042, 36.1875);
INSERT INTO `app_area` VALUES (370921, '宁阳县', 'Ningyang', 370900, 3, '0538', '271400', 116.805, 35.7599);
INSERT INTO `app_area` VALUES (370923, '东平县', 'Dongping', 370900, 3, '0538', '271500', 116.471, 35.9379);
INSERT INTO `app_area` VALUES (370982, '新泰市', 'Xintai', 370900, 3, '0538', '271200', 117.77, 35.9089);
INSERT INTO `app_area` VALUES (370983, '肥城市', 'Feicheng', 370900, 3, '0538', '271600', 116.768, 36.1825);
INSERT INTO `app_area` VALUES (371000, '威海市', 'Weihai', 370000, 2, '0631', '264200', 122.116, 37.5097);
INSERT INTO `app_area` VALUES (371002, '环翠区', 'Huancui', 371000, 3, '0631', '264200', 122.123, 37.502);
INSERT INTO `app_area` VALUES (371003, '文登区', 'Wendeng', 371000, 3, '0631', '266440', 122.057, 37.1962);
INSERT INTO `app_area` VALUES (371082, '荣成市', 'Rongcheng', 371000, 3, '0631', '264300', 122.488, 37.1652);
INSERT INTO `app_area` VALUES (371083, '乳山市', 'Rushan', 371000, 3, '0631', '264500', 121.538, 36.9192);
INSERT INTO `app_area` VALUES (371100, '日照市', 'Rizhao', 370000, 2, '0633', '276800', 119.461, 35.4286);
INSERT INTO `app_area` VALUES (371102, '东港区', 'Donggang', 371100, 3, '0633', '276800', 119.462, 35.4254);
INSERT INTO `app_area` VALUES (371103, '岚山区', 'Lanshan', 371100, 3, '0633', '276808', 119.319, 35.122);
INSERT INTO `app_area` VALUES (371121, '五莲县', 'Wulian', 371100, 3, '0633', '262300', 119.207, 35.75);
INSERT INTO `app_area` VALUES (371122, '莒县', 'Juxian', 371100, 3, '0633', '276500', 118.838, 35.5805);
INSERT INTO `app_area` VALUES (371200, '莱芜市', 'Laiwu', 370000, 2, '0634', '271100', 117.678, 36.2144);
INSERT INTO `app_area` VALUES (371202, '莱城区', 'Laicheng', 371200, 3, '0634', '271199', 117.66, 36.2032);
INSERT INTO `app_area` VALUES (371203, '钢城区', 'Gangcheng', 371200, 3, '0634', '271100', 117.805, 36.0632);
INSERT INTO `app_area` VALUES (371300, '临沂市', 'Linyi', 370000, 2, '0539', '253000', 118.326, 35.0653);
INSERT INTO `app_area` VALUES (371302, '兰山区', 'Lanshan', 371300, 3, '0539', '276002', 118.348, 35.0687);
INSERT INTO `app_area` VALUES (371311, '罗庄区', 'Luozhuang', 371300, 3, '0539', '276022', 118.285, 34.9963);
INSERT INTO `app_area` VALUES (371312, '河东区', 'Hedong', 371300, 3, '0539', '276034', 118.411, 35.088);
INSERT INTO `app_area` VALUES (371321, '沂南县', 'Yinan', 371300, 3, '0539', '276300', 118.471, 35.5513);
INSERT INTO `app_area` VALUES (371322, '郯城县', 'Tancheng', 371300, 3, '0539', '276100', 118.367, 34.6135);
INSERT INTO `app_area` VALUES (371323, '沂水县', 'Yishui', 371300, 3, '0539', '276400', 118.63, 35.7873);
INSERT INTO `app_area` VALUES (371324, '兰陵县', 'Lanling', 371300, 3, '0539', '277700', 117.857, 34.7383);
INSERT INTO `app_area` VALUES (371325, '费县', 'Feixian', 371300, 3, '0539', '273400', 117.978, 35.2656);
INSERT INTO `app_area` VALUES (371326, '平邑县', 'Pingyi', 371300, 3, '0539', '273300', 117.639, 35.5057);
INSERT INTO `app_area` VALUES (371327, '莒南县', 'Junan', 371300, 3, '0539', '276600', 118.832, 35.1754);
INSERT INTO `app_area` VALUES (371328, '蒙阴县', 'Mengyin', 371300, 3, '0539', '276200', 117.946, 35.71);
INSERT INTO `app_area` VALUES (371329, '临沭县', 'Linshu', 371300, 3, '0539', '276700', 118.653, 34.9209);
INSERT INTO `app_area` VALUES (371400, '德州市', 'Dezhou', 370000, 2, '0534', '253000', 116.307, 37.454);
INSERT INTO `app_area` VALUES (371402, '德城区', 'Decheng', 371400, 3, '0534', '253012', 116.299, 37.4513);
INSERT INTO `app_area` VALUES (371403, '陵城区', 'Lingcheng', 371400, 3, '0534', '253500', 116.576, 37.3357);
INSERT INTO `app_area` VALUES (371422, '宁津县', 'Ningjin', 371400, 3, '0534', '253400', 116.797, 37.653);
INSERT INTO `app_area` VALUES (371423, '庆云县', 'Qingyun', 371400, 3, '0534', '253700', 117.386, 37.7762);
INSERT INTO `app_area` VALUES (371424, '临邑县', 'Linyi', 371400, 3, '0534', '251500', 116.865, 37.1905);
INSERT INTO `app_area` VALUES (371425, '齐河县', 'Qihe', 371400, 3, '0534', '251100', 116.755, 36.7953);
INSERT INTO `app_area` VALUES (371426, '平原县', 'Pingyuan', 371400, 3, '0534', '253100', 116.434, 37.1663);
INSERT INTO `app_area` VALUES (371427, '夏津县', 'Xiajin', 371400, 3, '0534', '253200', 116.002, 36.9485);
INSERT INTO `app_area` VALUES (371428, '武城县', 'Wucheng', 371400, 3, '0534', '253300', 116.07, 37.214);
INSERT INTO `app_area` VALUES (371481, '乐陵市', 'Leling', 371400, 3, '0534', '253600', 117.231, 37.7316);
INSERT INTO `app_area` VALUES (371482, '禹城市', 'Yucheng', 371400, 3, '0534', '251200', 116.643, 36.9344);
INSERT INTO `app_area` VALUES (371500, '聊城市', 'Liaocheng', 370000, 2, '0635', '252052', 115.98, 36.456);
INSERT INTO `app_area` VALUES (371502, '东昌府区', 'Dongchangfu', 371500, 3, '0635', '252000', 115.974, 36.4446);
INSERT INTO `app_area` VALUES (371521, '阳谷县', 'Yanggu', 371500, 3, '0635', '252300', 115.791, 36.1144);
INSERT INTO `app_area` VALUES (371522, '莘县', 'Shenxian', 371500, 3, '0635', '252400', 115.67, 36.2342);
INSERT INTO `app_area` VALUES (371523, '茌平县', 'Chiping', 371500, 3, '0635', '252100', 116.255, 36.5797);
INSERT INTO `app_area` VALUES (371524, '东阿县', 'Dong\'e', 371500, 3, '0635', '252200', 116.25, 36.3321);
INSERT INTO `app_area` VALUES (371525, '冠县', 'Guanxian', 371500, 3, '0635', '252500', 115.442, 36.4843);
INSERT INTO `app_area` VALUES (371526, '高唐县', 'Gaotang', 371500, 3, '0635', '252800', 116.232, 36.8653);
INSERT INTO `app_area` VALUES (371581, '临清市', 'Linqing', 371500, 3, '0635', '252600', 115.706, 36.8395);
INSERT INTO `app_area` VALUES (371600, '滨州市', 'Binzhou', 370000, 2, '0543', '256619', 118.017, 37.3835);
INSERT INTO `app_area` VALUES (371602, '滨城区', 'Bincheng', 371600, 3, '0543', '256613', 118.02, 37.3852);
INSERT INTO `app_area` VALUES (371603, '沾化区', 'Zhanhua', 371600, 3, '0543', '256800', 118.132, 37.6983);
INSERT INTO `app_area` VALUES (371621, '惠民县', 'Huimin', 371600, 3, '0543', '251700', 117.511, 37.4901);
INSERT INTO `app_area` VALUES (371622, '阳信县', 'Yangxin', 371600, 3, '0543', '251800', 117.581, 37.642);
INSERT INTO `app_area` VALUES (371623, '无棣县', 'Wudi', 371600, 3, '0543', '251900', 117.614, 37.7401);
INSERT INTO `app_area` VALUES (371625, '博兴县', 'Boxing', 371600, 3, '0543', '256500', 118.134, 37.1432);
INSERT INTO `app_area` VALUES (371626, '邹平县', 'Zouping', 371600, 3, '0543', '256200', 117.743, 36.8629);
INSERT INTO `app_area` VALUES (371627, '北海新区', 'Beihaixinqu', 371600, 3, '0543', '256200', 118.017, 37.3835);
INSERT INTO `app_area` VALUES (371700, '菏泽市', 'Heze', 370000, 2, '0530', '274020', 115.469, 35.2465);
INSERT INTO `app_area` VALUES (371702, '牡丹区', 'Mudan', 371700, 3, '0530', '274009', 115.417, 35.2509);
INSERT INTO `app_area` VALUES (371721, '曹县', 'Caoxian', 371700, 3, '0530', '274400', 115.542, 34.8266);
INSERT INTO `app_area` VALUES (371722, '单县', 'Shanxian', 371700, 3, '0530', '273700', 116.087, 34.7951);
INSERT INTO `app_area` VALUES (371723, '成武县', 'Chengwu', 371700, 3, '0530', '274200', 115.89, 34.9533);
INSERT INTO `app_area` VALUES (371724, '巨野县', 'Juye', 371700, 3, '0530', '274900', 116.095, 35.3979);
INSERT INTO `app_area` VALUES (371725, '郓城县', 'Yuncheng', 371700, 3, '0530', '274700', 115.944, 35.6004);
INSERT INTO `app_area` VALUES (371726, '鄄城县', 'Juancheng', 371700, 3, '0530', '274600', 115.51, 35.5641);
INSERT INTO `app_area` VALUES (371727, '定陶县', 'Dingtao', 371700, 3, '0530', '274100', 115.573, 35.0712);
INSERT INTO `app_area` VALUES (371728, '东明县', 'Dongming', 371700, 3, '0530', '274500', 115.091, 35.2891);
INSERT INTO `app_area` VALUES (410000, '河南省', 'Henan', 100000, 1, '', '', 113.665, 34.758);
INSERT INTO `app_area` VALUES (410100, '郑州市', 'Zhengzhou', 410000, 2, '0371', '450000', 113.665, 34.758);
INSERT INTO `app_area` VALUES (410102, '中原区', 'Zhongyuan', 410100, 3, '0371', '450007', 113.613, 34.7483);
INSERT INTO `app_area` VALUES (410103, '二七区', 'Erqi', 410100, 3, '0371', '450052', 113.639, 34.7234);
INSERT INTO `app_area` VALUES (410104, '管城回族区', 'Guancheng', 410100, 3, '0371', '450000', 113.677, 34.7538);
INSERT INTO `app_area` VALUES (410105, '金水区', 'Jinshui', 410100, 3, '0371', '450003', 113.661, 34.8003);
INSERT INTO `app_area` VALUES (410106, '上街区', 'Shangjie', 410100, 3, '0371', '450041', 113.309, 34.8028);
INSERT INTO `app_area` VALUES (410108, '惠济区', 'Huiji', 410100, 3, '0371', '450053', 113.617, 34.8674);
INSERT INTO `app_area` VALUES (410122, '中牟县', 'Zhongmu', 410100, 3, '0371', '451450', 113.976, 34.719);
INSERT INTO `app_area` VALUES (410181, '巩义市', 'Gongyi', 410100, 3, '0371', '451200', 113.022, 34.7479);
INSERT INTO `app_area` VALUES (410182, '荥阳市', 'Xingyang', 410100, 3, '0371', '450100', 113.383, 34.7876);
INSERT INTO `app_area` VALUES (410183, '新密市', 'Xinmi', 410100, 3, '0371', '452300', 113.387, 34.537);
INSERT INTO `app_area` VALUES (410184, '新郑市', 'Xinzheng', 410100, 3, '0371', '451100', 113.736, 34.3955);
INSERT INTO `app_area` VALUES (410185, '登封市', 'Dengfeng', 410100, 3, '0371', '452470', 113.05, 34.4534);
INSERT INTO `app_area` VALUES (410200, '开封市', 'Kaifeng', 410000, 2, '0378', '475001', 114.341, 34.7971);
INSERT INTO `app_area` VALUES (410202, '龙亭区', 'Longting', 410200, 3, '0378', '475100', 114.355, 34.7999);
INSERT INTO `app_area` VALUES (410203, '顺河回族区', 'Shunhe', 410200, 3, '0378', '475000', 114.361, 34.7959);
INSERT INTO `app_area` VALUES (410204, '鼓楼区', 'Gulou', 410200, 3, '0378', '475000', 114.356, 34.7952);
INSERT INTO `app_area` VALUES (410205, '禹王台区', 'Yuwangtai', 410200, 3, '0378', '475003', 114.348, 34.7769);
INSERT INTO `app_area` VALUES (410212, '祥符区', 'Xiangfu', 410200, 3, '0378', '475100', 114.439, 34.7587);
INSERT INTO `app_area` VALUES (410221, '杞县', 'Qixian', 410200, 3, '0378', '475200', 114.783, 34.5503);
INSERT INTO `app_area` VALUES (410222, '通许县', 'Tongxu', 410200, 3, '0378', '475400', 114.467, 34.4752);
INSERT INTO `app_area` VALUES (410223, '尉氏县', 'Weishi', 410200, 3, '0378', '475500', 114.193, 34.4122);
INSERT INTO `app_area` VALUES (410225, '兰考县', 'Lankao', 410200, 3, '0378', '475300', 114.82, 34.8235);
INSERT INTO `app_area` VALUES (410300, '洛阳市', 'Luoyang', 410000, 2, '0379', '471000', 112.434, 34.663);
INSERT INTO `app_area` VALUES (410302, '老城区', 'Laocheng', 410300, 3, '0379', '471002', 112.469, 34.6836);
INSERT INTO `app_area` VALUES (410303, '西工区', 'Xigong', 410300, 3, '0379', '471000', 112.437, 34.67);
INSERT INTO `app_area` VALUES (410304, '瀍河回族区', 'Chanhe', 410300, 3, '0379', '471002', 112.5, 34.6799);
INSERT INTO `app_area` VALUES (410305, '涧西区', 'Jianxi', 410300, 3, '0379', '471003', 112.396, 34.6582);
INSERT INTO `app_area` VALUES (410306, '吉利区', 'Jili', 410300, 3, '0379', '471012', 112.589, 34.9009);
INSERT INTO `app_area` VALUES (410311, '洛龙区', 'Luolong', 410300, 3, '0379', '471000', 112.464, 34.6187);
INSERT INTO `app_area` VALUES (410322, '孟津县', 'Mengjin', 410300, 3, '0379', '471100', 112.444, 34.826);
INSERT INTO `app_area` VALUES (410323, '新安县', 'Xin\'an', 410300, 3, '0379', '471800', 112.132, 34.7281);
INSERT INTO `app_area` VALUES (410324, '栾川县', 'Luanchuan', 410300, 3, '0379', '471500', 111.618, 33.7858);
INSERT INTO `app_area` VALUES (410325, '嵩县', 'Songxian', 410300, 3, '0379', '471400', 112.085, 34.1347);
INSERT INTO `app_area` VALUES (410326, '汝阳县', 'Ruyang', 410300, 3, '0379', '471200', 112.473, 34.1539);
INSERT INTO `app_area` VALUES (410327, '宜阳县', 'Yiyang', 410300, 3, '0379', '471600', 112.179, 34.5152);
INSERT INTO `app_area` VALUES (410328, '洛宁县', 'Luoning', 410300, 3, '0379', '471700', 111.651, 34.3891);
INSERT INTO `app_area` VALUES (410329, '伊川县', 'Yichuan', 410300, 3, '0379', '471300', 112.429, 34.4221);
INSERT INTO `app_area` VALUES (410381, '偃师市', 'Yanshi', 410300, 3, '0379', '471900', 112.792, 34.7281);
INSERT INTO `app_area` VALUES (410400, '平顶山市', 'Pingdingshan', 410000, 2, '0375', '467000', 113.308, 33.7352);
INSERT INTO `app_area` VALUES (410402, '新华区', 'Xinhua', 410400, 3, '0375', '467002', 113.294, 33.7373);
INSERT INTO `app_area` VALUES (410403, '卫东区', 'Weidong', 410400, 3, '0375', '467021', 113.335, 33.7347);
INSERT INTO `app_area` VALUES (410404, '石龙区', 'Shilong', 410400, 3, '0375', '467045', 112.899, 33.8988);
INSERT INTO `app_area` VALUES (410411, '湛河区', 'Zhanhe', 410400, 3, '0375', '467000', 113.293, 33.7362);
INSERT INTO `app_area` VALUES (410421, '宝丰县', 'Baofeng', 410400, 3, '0375', '467400', 113.055, 33.8692);
INSERT INTO `app_area` VALUES (410422, '叶县', 'Yexian', 410400, 3, '0375', '467200', 113.351, 33.6222);
INSERT INTO `app_area` VALUES (410423, '鲁山县', 'Lushan', 410400, 3, '0375', '467300', 112.906, 33.7388);
INSERT INTO `app_area` VALUES (410425, '郏县', 'Jiaxian', 410400, 3, '0375', '467100', 113.216, 33.9707);
INSERT INTO `app_area` VALUES (410481, '舞钢市', 'Wugang', 410400, 3, '0375', '462500', 113.524, 33.2938);
INSERT INTO `app_area` VALUES (410482, '汝州市', 'Ruzhou', 410400, 3, '0375', '467500', 112.843, 34.1614);
INSERT INTO `app_area` VALUES (410500, '安阳市', 'Anyang', 410000, 2, '0372', '455000', 114.352, 36.1034);
INSERT INTO `app_area` VALUES (410502, '文峰区', 'Wenfeng', 410500, 3, '0372', '455000', 114.357, 36.0905);
INSERT INTO `app_area` VALUES (410503, '北关区', 'Beiguan', 410500, 3, '0372', '455001', 114.357, 36.1187);
INSERT INTO `app_area` VALUES (410505, '殷都区', 'Yindu', 410500, 3, '0372', '455004', 114.303, 36.1099);
INSERT INTO `app_area` VALUES (410506, '龙安区', 'Long\'an', 410500, 3, '0372', '455001', 114.348, 36.119);
INSERT INTO `app_area` VALUES (410522, '安阳县', 'Anyang', 410500, 3, '0372', '455000', 114.366, 36.067);
INSERT INTO `app_area` VALUES (410523, '汤阴县', 'Tangyin', 410500, 3, '0372', '456150', 114.358, 35.9215);
INSERT INTO `app_area` VALUES (410526, '滑县', 'Huaxian', 410500, 3, '0372', '456400', 114.521, 35.5807);
INSERT INTO `app_area` VALUES (410527, '内黄县', 'Neihuang', 410500, 3, '0372', '456350', 114.907, 35.9527);
INSERT INTO `app_area` VALUES (410581, '林州市', 'Linzhou', 410500, 3, '0372', '456550', 113.816, 36.078);
INSERT INTO `app_area` VALUES (410600, '鹤壁市', 'Hebi', 410000, 2, '0392', '458030', 114.295, 35.7482);
INSERT INTO `app_area` VALUES (410602, '鹤山区', 'Heshan', 410600, 3, '0392', '458010', 114.163, 35.9546);
INSERT INTO `app_area` VALUES (410603, '山城区', 'Shancheng', 410600, 3, '0392', '458000', 114.184, 35.8977);
INSERT INTO `app_area` VALUES (410611, '淇滨区', 'Qibin', 410600, 3, '0392', '458000', 114.299, 35.7413);
INSERT INTO `app_area` VALUES (410621, '浚县', 'Xunxian', 410600, 3, '0392', '456250', 114.549, 35.6708);
INSERT INTO `app_area` VALUES (410622, '淇县', 'Qixian', 410600, 3, '0392', '456750', 114.198, 35.6078);
INSERT INTO `app_area` VALUES (410700, '新乡市', 'Xinxiang', 410000, 2, '0373', '453000', 113.884, 35.3026);
INSERT INTO `app_area` VALUES (410702, '红旗区', 'Hongqi', 410700, 3, '0373', '453000', 113.875, 35.3037);
INSERT INTO `app_area` VALUES (410703, '卫滨区', 'Weibin', 410700, 3, '0373', '453000', 113.866, 35.3021);
INSERT INTO `app_area` VALUES (410704, '凤泉区', 'Fengquan', 410700, 3, '0373', '453011', 113.915, 35.384);
INSERT INTO `app_area` VALUES (410711, '牧野区', 'Muye', 410700, 3, '0373', '453002', 113.909, 35.3149);
INSERT INTO `app_area` VALUES (410721, '新乡县', 'Xinxiang', 410700, 3, '0373', '453700', 113.805, 35.1908);
INSERT INTO `app_area` VALUES (410724, '获嘉县', 'Huojia', 410700, 3, '0373', '453800', 113.662, 35.2652);
INSERT INTO `app_area` VALUES (410725, '原阳县', 'Yuanyang', 410700, 3, '0373', '453500', 113.94, 35.0657);
INSERT INTO `app_area` VALUES (410726, '延津县', 'Yanjin', 410700, 3, '0373', '453200', 114.203, 35.1433);
INSERT INTO `app_area` VALUES (410727, '封丘县', 'Fengqiu', 410700, 3, '0373', '453300', 114.419, 35.0417);
INSERT INTO `app_area` VALUES (410728, '长垣县', 'Changyuan', 410700, 3, '0373', '453400', 114.669, 35.2005);
INSERT INTO `app_area` VALUES (410781, '卫辉市', 'Weihui', 410700, 3, '0373', '453100', 114.065, 35.3984);
INSERT INTO `app_area` VALUES (410782, '辉县市', 'Huixian', 410700, 3, '0373', '453600', 113.807, 35.4631);
INSERT INTO `app_area` VALUES (410800, '焦作市', 'Jiaozuo', 410000, 2, '0391', '454002', 113.238, 35.239);
INSERT INTO `app_area` VALUES (410802, '解放区', 'Jiefang', 410800, 3, '0391', '454000', 113.229, 35.2402);
INSERT INTO `app_area` VALUES (410803, '中站区', 'Zhongzhan', 410800, 3, '0391', '454191', 113.183, 35.2366);
INSERT INTO `app_area` VALUES (410804, '马村区', 'Macun', 410800, 3, '0391', '454171', 113.319, 35.2691);
INSERT INTO `app_area` VALUES (410811, '山阳区', 'Shanyang', 410800, 3, '0391', '454002', 113.255, 35.2144);
INSERT INTO `app_area` VALUES (410821, '修武县', 'Xiuwu', 410800, 3, '0391', '454350', 113.448, 35.2236);
INSERT INTO `app_area` VALUES (410822, '博爱县', 'Boai', 410800, 3, '0391', '454450', 113.067, 35.1694);
INSERT INTO `app_area` VALUES (410823, '武陟县', 'Wuzhi', 410800, 3, '0391', '454950', 113.397, 35.0951);
INSERT INTO `app_area` VALUES (410825, '温县', 'Wenxian', 410800, 3, '0391', '454850', 113.081, 34.9402);
INSERT INTO `app_area` VALUES (410882, '沁阳市', 'Qinyang', 410800, 3, '0391', '454550', 112.945, 35.0894);
INSERT INTO `app_area` VALUES (410883, '孟州市', 'Mengzhou', 410800, 3, '0391', '454750', 112.791, 34.9071);
INSERT INTO `app_area` VALUES (410900, '濮阳市', 'Puyang', 410000, 2, '0393', '457000', 115.041, 35.7682);
INSERT INTO `app_area` VALUES (410902, '华龙区', 'Hualong', 410900, 3, '0393', '457001', 115.074, 35.7774);
INSERT INTO `app_area` VALUES (410922, '清丰县', 'Qingfeng', 410900, 3, '0393', '457300', 115.104, 35.8851);
INSERT INTO `app_area` VALUES (410923, '南乐县', 'Nanle', 410900, 3, '0393', '457400', 115.206, 36.0769);
INSERT INTO `app_area` VALUES (410926, '范县', 'Fanxian', 410900, 3, '0393', '457500', 115.504, 35.8518);
INSERT INTO `app_area` VALUES (410927, '台前县', 'Taiqian', 410900, 3, '0393', '457600', 115.872, 35.9692);
INSERT INTO `app_area` VALUES (410928, '濮阳县', 'Puyang', 410900, 3, '0393', '457100', 115.031, 35.7075);
INSERT INTO `app_area` VALUES (411000, '许昌市', 'Xuchang', 410000, 2, '0374', '461000', 113.826, 34.023);
INSERT INTO `app_area` VALUES (411002, '魏都区', 'Weidu', 411000, 3, '0374', '461000', 113.823, 34.0254);
INSERT INTO `app_area` VALUES (411023, '许昌县', 'Xuchang', 411000, 3, '0374', '461100', 113.847, 34.0041);
INSERT INTO `app_area` VALUES (411024, '鄢陵县', 'Yanling', 411000, 3, '0374', '461200', 114.188, 34.1032);
INSERT INTO `app_area` VALUES (411025, '襄城县', 'Xiangcheng', 411000, 3, '0374', '461700', 113.482, 33.8493);
INSERT INTO `app_area` VALUES (411081, '禹州市', 'Yuzhou', 411000, 3, '0374', '461670', 113.488, 34.1405);
INSERT INTO `app_area` VALUES (411082, '长葛市', 'Changge', 411000, 3, '0374', '461500', 113.773, 34.2185);
INSERT INTO `app_area` VALUES (411100, '漯河市', 'Luohe', 410000, 2, '0395', '462000', 114.026, 33.5759);
INSERT INTO `app_area` VALUES (411102, '源汇区', 'Yuanhui', 411100, 3, '0395', '462000', 114.006, 33.5563);
INSERT INTO `app_area` VALUES (411103, '郾城区', 'Yancheng', 411100, 3, '0395', '462300', 114.007, 33.5872);
INSERT INTO `app_area` VALUES (411104, '召陵区', 'Zhaoling', 411100, 3, '0395', '462300', 114.094, 33.586);
INSERT INTO `app_area` VALUES (411121, '舞阳县', 'Wuyang', 411100, 3, '0395', '462400', 113.598, 33.4324);
INSERT INTO `app_area` VALUES (411122, '临颍县', 'Linying', 411100, 3, '0395', '462600', 113.937, 33.8112);
INSERT INTO `app_area` VALUES (411200, '三门峡市', 'Sanmenxia', 410000, 2, '0398', '472000', 111.194, 34.7773);
INSERT INTO `app_area` VALUES (411202, '湖滨区', 'Hubin', 411200, 3, '0398', '472000', 111.2, 34.7787);
INSERT INTO `app_area` VALUES (411221, '渑池县', 'Mianchi', 411200, 3, '0398', '472400', 111.762, 34.7673);
INSERT INTO `app_area` VALUES (411222, '陕县', 'Shanxian', 411200, 3, '0398', '472100', 111.103, 34.7205);
INSERT INTO `app_area` VALUES (411224, '卢氏县', 'Lushi', 411200, 3, '0398', '472200', 111.048, 34.0544);
INSERT INTO `app_area` VALUES (411281, '义马市', 'Yima', 411200, 3, '0398', '472300', 111.874, 34.7472);
INSERT INTO `app_area` VALUES (411282, '灵宝市', 'Lingbao', 411200, 3, '0398', '472500', 110.895, 34.5168);
INSERT INTO `app_area` VALUES (411300, '南阳市', 'Nanyang', 410000, 2, '0377', '473002', 112.541, 32.9991);
INSERT INTO `app_area` VALUES (411302, '宛城区', 'Wancheng', 411300, 3, '0377', '473001', 112.54, 33.0038);
INSERT INTO `app_area` VALUES (411303, '卧龙区', 'Wolong', 411300, 3, '0377', '473003', 112.535, 32.9861);
INSERT INTO `app_area` VALUES (411321, '南召县', 'Nanzhao', 411300, 3, '0377', '474650', 112.432, 33.491);
INSERT INTO `app_area` VALUES (411322, '方城县', 'Fangcheng', 411300, 3, '0377', '473200', 113.013, 33.2545);
INSERT INTO `app_area` VALUES (411323, '西峡县', 'Xixia', 411300, 3, '0377', '474550', 111.482, 33.2977);
INSERT INTO `app_area` VALUES (411324, '镇平县', 'Zhenping', 411300, 3, '0377', '474250', 112.24, 33.0363);
INSERT INTO `app_area` VALUES (411325, '内乡县', 'Neixiang', 411300, 3, '0377', '474350', 111.85, 33.0467);
INSERT INTO `app_area` VALUES (411326, '淅川县', 'Xichuan', 411300, 3, '0377', '474450', 111.487, 33.1371);
INSERT INTO `app_area` VALUES (411327, '社旗县', 'Sheqi', 411300, 3, '0377', '473300', 112.947, 33.055);
INSERT INTO `app_area` VALUES (411328, '唐河县', 'Tanghe', 411300, 3, '0377', '473400', 112.836, 32.6945);
INSERT INTO `app_area` VALUES (411329, '新野县', 'Xinye', 411300, 3, '0377', '473500', 112.362, 32.517);
INSERT INTO `app_area` VALUES (411330, '桐柏县', 'Tongbai', 411300, 3, '0377', '474750', 113.429, 32.3792);
INSERT INTO `app_area` VALUES (411381, '邓州市', 'Dengzhou', 411300, 3, '0377', '474150', 112.09, 32.6858);
INSERT INTO `app_area` VALUES (411400, '商丘市', 'Shangqiu', 410000, 2, '0370', '476000', 115.65, 34.4371);
INSERT INTO `app_area` VALUES (411402, '梁园区', 'Liangyuan', 411400, 3, '0370', '476000', 115.645, 34.4434);
INSERT INTO `app_area` VALUES (411403, '睢阳区', 'Suiyang', 411400, 3, '0370', '476100', 115.653, 34.388);
INSERT INTO `app_area` VALUES (411421, '民权县', 'Minquan', 411400, 3, '0370', '476800', 115.146, 34.6493);
INSERT INTO `app_area` VALUES (411422, '睢县', 'Suixian', 411400, 3, '0370', '476900', 115.072, 34.4454);
INSERT INTO `app_area` VALUES (411423, '宁陵县', 'Ningling', 411400, 3, '0370', '476700', 115.305, 34.4546);
INSERT INTO `app_area` VALUES (411424, '柘城县', 'Zhecheng', 411400, 3, '0370', '476200', 115.305, 34.0911);
INSERT INTO `app_area` VALUES (411425, '虞城县', 'Yucheng', 411400, 3, '0370', '476300', 115.863, 34.4019);
INSERT INTO `app_area` VALUES (411426, '夏邑县', 'Xiayi', 411400, 3, '0370', '476400', 116.133, 34.2324);
INSERT INTO `app_area` VALUES (411481, '永城市', 'Yongcheng', 411400, 3, '0370', '476600', 116.449, 33.9291);
INSERT INTO `app_area` VALUES (411500, '信阳市', 'Xinyang', 410000, 2, '0376', '464000', 114.075, 32.1233);
INSERT INTO `app_area` VALUES (411502, '浉河区', 'Shihe', 411500, 3, '0376', '464000', 114.059, 32.1168);
INSERT INTO `app_area` VALUES (411503, '平桥区', 'Pingqiao', 411500, 3, '0376', '464100', 114.124, 32.1009);
INSERT INTO `app_area` VALUES (411521, '罗山县', 'Luoshan', 411500, 3, '0376', '464200', 114.531, 32.2028);
INSERT INTO `app_area` VALUES (411522, '光山县', 'Guangshan', 411500, 3, '0376', '465450', 114.919, 32.0099);
INSERT INTO `app_area` VALUES (411523, '新县', 'Xinxian', 411500, 3, '0376', '465550', 114.879, 31.6439);
INSERT INTO `app_area` VALUES (411524, '商城县', 'Shangcheng', 411500, 3, '0376', '465350', 115.409, 31.7999);
INSERT INTO `app_area` VALUES (411525, '固始县', 'Gushi', 411500, 3, '0376', '465250', 115.683, 32.1801);
INSERT INTO `app_area` VALUES (411526, '潢川县', 'Huangchuan', 411500, 3, '0376', '465150', 115.047, 32.1376);
INSERT INTO `app_area` VALUES (411527, '淮滨县', 'Huaibin', 411500, 3, '0376', '464400', 115.421, 32.4661);
INSERT INTO `app_area` VALUES (411528, '息县', 'Xixian', 411500, 3, '0376', '464300', 114.74, 32.3428);
INSERT INTO `app_area` VALUES (411600, '周口市', 'Zhoukou', 410000, 2, '0394', '466000', 114.65, 33.6204);
INSERT INTO `app_area` VALUES (411602, '川汇区', 'Chuanhui', 411600, 3, '0394', '466000', 114.642, 33.6256);
INSERT INTO `app_area` VALUES (411621, '扶沟县', 'Fugou', 411600, 3, '0394', '461300', 114.395, 34.06);
INSERT INTO `app_area` VALUES (411622, '西华县', 'Xihua', 411600, 3, '0394', '466600', 114.523, 33.7855);
INSERT INTO `app_area` VALUES (411623, '商水县', 'Shangshui', 411600, 3, '0394', '466100', 114.606, 33.5391);
INSERT INTO `app_area` VALUES (411624, '沈丘县', 'Shenqiu', 411600, 3, '0394', '466300', 115.099, 33.4094);
INSERT INTO `app_area` VALUES (411625, '郸城县', 'Dancheng', 411600, 3, '0394', '477150', 115.177, 33.6449);
INSERT INTO `app_area` VALUES (411626, '淮阳县', 'Huaiyang', 411600, 3, '0394', '466700', 114.888, 33.7321);
INSERT INTO `app_area` VALUES (411627, '太康县', 'Taikang', 411600, 3, '0394', '461400', 114.838, 34.0638);
INSERT INTO `app_area` VALUES (411628, '鹿邑县', 'Luyi', 411600, 3, '0394', '477200', 115.486, 33.8593);
INSERT INTO `app_area` VALUES (411681, '项城市', 'Xiangcheng', 411600, 3, '0394', '466200', 114.876, 33.4672);
INSERT INTO `app_area` VALUES (411700, '驻马店市', 'Zhumadian', 410000, 2, '0396', '463000', 114.025, 32.9802);
INSERT INTO `app_area` VALUES (411702, '驿城区', 'Yicheng', 411700, 3, '0396', '463000', 113.994, 32.9732);
INSERT INTO `app_area` VALUES (411721, '西平县', 'Xiping', 411700, 3, '0396', '463900', 114.023, 33.3845);
INSERT INTO `app_area` VALUES (411722, '上蔡县', 'Shangcai', 411700, 3, '0396', '463800', 114.268, 33.2682);
INSERT INTO `app_area` VALUES (411723, '平舆县', 'Pingyu', 411700, 3, '0396', '463400', 114.636, 32.9573);
INSERT INTO `app_area` VALUES (411724, '正阳县', 'Zhengyang', 411700, 3, '0396', '463600', 114.39, 32.6039);
INSERT INTO `app_area` VALUES (411725, '确山县', 'Queshan', 411700, 3, '0396', '463200', 114.029, 32.8028);
INSERT INTO `app_area` VALUES (411726, '泌阳县', 'Biyang', 411700, 3, '0396', '463700', 113.327, 32.7178);
INSERT INTO `app_area` VALUES (411727, '汝南县', 'Runan', 411700, 3, '0396', '463300', 114.361, 33.0046);
INSERT INTO `app_area` VALUES (411728, '遂平县', 'Suiping', 411700, 3, '0396', '463100', 114.013, 33.1457);
INSERT INTO `app_area` VALUES (411729, '新蔡县', 'Xincai', 411700, 3, '0396', '463500', 114.982, 32.7502);
INSERT INTO `app_area` VALUES (419000, '直辖县级', '', 410000, 2, '', '', 113.665, 34.758);
INSERT INTO `app_area` VALUES (419001, '济源市', 'Jiyuan', 419000, 3, '0391', '454650', 112.59, 35.0904);
INSERT INTO `app_area` VALUES (420000, '湖北省', 'Hubei', 100000, 1, '', '', 114.299, 30.5844);
INSERT INTO `app_area` VALUES (420100, '武汉市', 'Wuhan', 420000, 2, '', '430014', 114.299, 30.5844);
INSERT INTO `app_area` VALUES (420102, '江岸区', 'Jiang\'an', 420100, 3, '027', '430014', 114.309, 30.5998);
INSERT INTO `app_area` VALUES (420103, '江汉区', 'Jianghan', 420100, 3, '027', '430021', 114.271, 30.6015);
INSERT INTO `app_area` VALUES (420104, '硚口区', 'Qiaokou', 420100, 3, '027', '430033', 114.264, 30.5695);
INSERT INTO `app_area` VALUES (420105, '汉阳区', 'Hanyang', 420100, 3, '027', '430050', 114.275, 30.5492);
INSERT INTO `app_area` VALUES (420106, '武昌区', 'Wuchang', 420100, 3, '027', '430061', 114.316, 30.5539);
INSERT INTO `app_area` VALUES (420107, '青山区', 'Qingshan', 420100, 3, '027', '430080', 114.391, 30.6343);
INSERT INTO `app_area` VALUES (420111, '洪山区', 'Hongshan', 420100, 3, '027', '430070', 114.344, 30.4999);
INSERT INTO `app_area` VALUES (420112, '东西湖区', 'Dongxihu', 420100, 3, '027', '430040', 114.137, 30.6199);
INSERT INTO `app_area` VALUES (420113, '汉南区', 'Hannan', 420100, 3, '027', '430090', 114.085, 30.3088);
INSERT INTO `app_area` VALUES (420114, '蔡甸区', 'Caidian', 420100, 3, '027', '430100', 114.029, 30.582);
INSERT INTO `app_area` VALUES (420115, '江夏区', 'Jiangxia', 420100, 3, '027', '430200', 114.313, 30.3465);
INSERT INTO `app_area` VALUES (420116, '黄陂区', 'Huangpi', 420100, 3, '027', '432200', 114.375, 30.8815);
INSERT INTO `app_area` VALUES (420117, '新洲区', 'Xinzhou', 420100, 3, '027', '431400', 114.801, 30.8414);
INSERT INTO `app_area` VALUES (420200, '黄石市', 'Huangshi', 420000, 2, '0714', '435003', 115.077, 30.2201);
INSERT INTO `app_area` VALUES (420202, '黄石港区', 'Huangshigang', 420200, 3, '0714', '435000', 115.066, 30.2228);
INSERT INTO `app_area` VALUES (420203, '西塞山区', 'Xisaishan', 420200, 3, '0714', '435001', 115.11, 30.2049);
INSERT INTO `app_area` VALUES (420204, '下陆区', 'Xialu', 420200, 3, '0714', '435005', 114.961, 30.1737);
INSERT INTO `app_area` VALUES (420205, '铁山区', 'Tieshan', 420200, 3, '0714', '435006', 114.901, 30.2068);
INSERT INTO `app_area` VALUES (420222, '阳新县', 'Yangxin', 420200, 3, '0714', '435200', 115.215, 29.8304);
INSERT INTO `app_area` VALUES (420281, '大冶市', 'Daye', 420200, 3, '0714', '435100', 114.972, 30.0944);
INSERT INTO `app_area` VALUES (420300, '十堰市', 'Shiyan', 420000, 2, '0719', '442000', 110.785, 32.647);
INSERT INTO `app_area` VALUES (420302, '茅箭区', 'Maojian', 420300, 3, '0719', '442012', 110.813, 32.5915);
INSERT INTO `app_area` VALUES (420303, '张湾区', 'Zhangwan', 420300, 3, '0719', '442001', 110.771, 32.652);
INSERT INTO `app_area` VALUES (420304, '郧阳区', 'Yunyang', 420300, 3, '0719', '442500', 110.819, 32.8359);
INSERT INTO `app_area` VALUES (420322, '郧西县', 'Yunxi', 420300, 3, '0719', '442600', 110.426, 32.9935);
INSERT INTO `app_area` VALUES (420323, '竹山县', 'Zhushan', 420300, 3, '0719', '442200', 110.231, 32.2254);
INSERT INTO `app_area` VALUES (420324, '竹溪县', 'Zhuxi', 420300, 3, '0719', '442300', 109.718, 32.319);
INSERT INTO `app_area` VALUES (420325, '房县', 'Fangxian', 420300, 3, '0719', '442100', 110.744, 32.0579);
INSERT INTO `app_area` VALUES (420381, '丹江口市', 'Danjiangkou', 420300, 3, '0719', '442700', 111.515, 32.5409);
INSERT INTO `app_area` VALUES (420500, '宜昌市', 'Yichang', 420000, 2, '0717', '443000', 111.291, 30.7026);
INSERT INTO `app_area` VALUES (420502, '西陵区', 'Xiling', 420500, 3, '0717', '443000', 111.286, 30.7108);
INSERT INTO `app_area` VALUES (420503, '伍家岗区', 'Wujiagang', 420500, 3, '0717', '443001', 111.361, 30.6443);
INSERT INTO `app_area` VALUES (420504, '点军区', 'Dianjun', 420500, 3, '0717', '443006', 111.268, 30.6934);
INSERT INTO `app_area` VALUES (420505, '猇亭区', 'Xiaoting', 420500, 3, '0717', '443007', 111.441, 30.5266);
INSERT INTO `app_area` VALUES (420506, '夷陵区', 'Yiling', 420500, 3, '0717', '443100', 111.326, 30.7688);
INSERT INTO `app_area` VALUES (420525, '远安县', 'Yuan\'an', 420500, 3, '0717', '444200', 111.642, 31.0599);
INSERT INTO `app_area` VALUES (420526, '兴山县', 'Xingshan', 420500, 3, '0717', '443711', 110.75, 31.3469);
INSERT INTO `app_area` VALUES (420527, '秭归县', 'Zigui', 420500, 3, '0717', '443600', 110.982, 30.827);
INSERT INTO `app_area` VALUES (420528, '长阳土家族自治县', 'Changyang', 420500, 3, '0717', '443500', 111.201, 30.4705);
INSERT INTO `app_area` VALUES (420529, '五峰土家族自治县', 'Wufeng', 420500, 3, '0717', '443413', 110.675, 30.1986);
INSERT INTO `app_area` VALUES (420581, '宜都市', 'Yidu', 420500, 3, '0717', '443300', 111.45, 30.3781);
INSERT INTO `app_area` VALUES (420582, '当阳市', 'Dangyang', 420500, 3, '0717', '444100', 111.789, 30.8208);
INSERT INTO `app_area` VALUES (420583, '枝江市', 'Zhijiang', 420500, 3, '0717', '443200', 111.769, 30.4261);
INSERT INTO `app_area` VALUES (420600, '襄阳市', 'Xiangyang', 420000, 2, '0710', '441021', 112.144, 32.0424);
INSERT INTO `app_area` VALUES (420602, '襄城区', 'Xiangcheng', 420600, 3, '0710', '441021', 112.134, 32.0102);
INSERT INTO `app_area` VALUES (420606, '樊城区', 'Fancheng', 420600, 3, '0710', '441001', 112.135, 32.0448);
INSERT INTO `app_area` VALUES (420607, '襄州区', 'Xiangzhou', 420600, 3, '0710', '441100', 112.15, 32.0151);
INSERT INTO `app_area` VALUES (420624, '南漳县', 'Nanzhang', 420600, 3, '0710', '441500', 111.846, 31.7765);
INSERT INTO `app_area` VALUES (420625, '谷城县', 'Gucheng', 420600, 3, '0710', '441700', 111.653, 32.2638);
INSERT INTO `app_area` VALUES (420626, '保康县', 'Baokang', 420600, 3, '0710', '441600', 111.261, 31.8787);
INSERT INTO `app_area` VALUES (420682, '老河口市', 'Laohekou', 420600, 3, '0710', '441800', 111.671, 32.3848);
INSERT INTO `app_area` VALUES (420683, '枣阳市', 'Zaoyang', 420600, 3, '0710', '441200', 112.774, 32.1314);
INSERT INTO `app_area` VALUES (420684, '宜城市', 'Yicheng', 420600, 3, '0710', '441400', 112.258, 31.7197);
INSERT INTO `app_area` VALUES (420700, '鄂州市', 'Ezhou', 420000, 2, '0711', '436000', 114.891, 30.3965);
INSERT INTO `app_area` VALUES (420702, '梁子湖区', 'Liangzihu', 420700, 3, '0711', '436064', 114.685, 30.1);
INSERT INTO `app_area` VALUES (420703, '华容区', 'Huarong', 420700, 3, '0711', '436030', 114.736, 30.5333);
INSERT INTO `app_area` VALUES (420704, '鄂城区', 'Echeng', 420700, 3, '0711', '436000', 114.892, 30.4002);
INSERT INTO `app_area` VALUES (420800, '荆门市', 'Jingmen', 420000, 2, '0724', '448000', 112.204, 31.0354);
INSERT INTO `app_area` VALUES (420802, '东宝区', 'Dongbao', 420800, 3, '0724', '448004', 112.201, 31.0519);
INSERT INTO `app_area` VALUES (420804, '掇刀区', 'Duodao', 420800, 3, '0724', '448124', 112.208, 30.9732);
INSERT INTO `app_area` VALUES (420821, '京山县', 'Jingshan', 420800, 3, '0724', '431800', 113.111, 31.0224);
INSERT INTO `app_area` VALUES (420822, '沙洋县', 'Shayang', 420800, 3, '0724', '448200', 112.589, 30.7092);
INSERT INTO `app_area` VALUES (420881, '钟祥市', 'Zhongxiang', 420800, 3, '0724', '431900', 112.589, 31.1678);
INSERT INTO `app_area` VALUES (420900, '孝感市', 'Xiaogan', 420000, 2, '0712', '432100', 113.927, 30.9264);
INSERT INTO `app_area` VALUES (420902, '孝南区', 'Xiaonan', 420900, 3, '0712', '432100', 113.911, 30.9168);
INSERT INTO `app_area` VALUES (420921, '孝昌县', 'Xiaochang', 420900, 3, '0712', '432900', 113.998, 31.258);
INSERT INTO `app_area` VALUES (420922, '大悟县', 'Dawu', 420900, 3, '0712', '432800', 114.126, 31.5618);
INSERT INTO `app_area` VALUES (420923, '云梦县', 'Yunmeng', 420900, 3, '0712', '432500', 113.753, 31.0209);
INSERT INTO `app_area` VALUES (420981, '应城市', 'Yingcheng', 420900, 3, '0712', '432400', 113.573, 30.9283);
INSERT INTO `app_area` VALUES (420982, '安陆市', 'Anlu', 420900, 3, '0712', '432600', 113.686, 31.2569);
INSERT INTO `app_area` VALUES (420984, '汉川市', 'Hanchuan', 420900, 3, '0712', '432300', 113.839, 30.6612);
INSERT INTO `app_area` VALUES (421000, '荆州市', 'Jingzhou', 420000, 2, '0716', '434000', 112.238, 30.3269);
INSERT INTO `app_area` VALUES (421002, '沙市区', 'Shashi', 421000, 3, '0716', '434000', 112.255, 30.3111);
INSERT INTO `app_area` VALUES (421003, '荆州区', 'Jingzhou', 421000, 3, '0716', '434020', 112.19, 30.3526);
INSERT INTO `app_area` VALUES (421022, '公安县', 'Gong\'an', 421000, 3, '0716', '434300', 112.232, 30.059);
INSERT INTO `app_area` VALUES (421023, '监利县', 'Jianli', 421000, 3, '0716', '433300', 112.895, 29.8149);
INSERT INTO `app_area` VALUES (421024, '江陵县', 'Jiangling', 421000, 3, '0716', '434101', 112.425, 30.0417);
INSERT INTO `app_area` VALUES (421081, '石首市', 'Shishou', 421000, 3, '0716', '434400', 112.426, 29.7213);
INSERT INTO `app_area` VALUES (421083, '洪湖市', 'Honghu', 421000, 3, '0716', '433200', 113.476, 29.827);
INSERT INTO `app_area` VALUES (421087, '松滋市', 'Songzi', 421000, 3, '0716', '434200', 111.767, 30.1696);
INSERT INTO `app_area` VALUES (421100, '黄冈市', 'Huanggang', 420000, 2, '0713', '438000', 114.879, 30.4477);
INSERT INTO `app_area` VALUES (421102, '黄州区', 'Huangzhou', 421100, 3, '0713', '438000', 114.88, 30.4344);
INSERT INTO `app_area` VALUES (421121, '团风县', 'Tuanfeng', 421100, 3, '0713', '438800', 114.872, 30.6436);
INSERT INTO `app_area` VALUES (421122, '红安县', 'Hong\'an', 421100, 3, '0713', '438401', 114.622, 31.2867);
INSERT INTO `app_area` VALUES (421123, '罗田县', 'Luotian', 421100, 3, '0713', '438600', 115.4, 30.7826);
INSERT INTO `app_area` VALUES (421124, '英山县', 'Yingshan', 421100, 3, '0713', '438700', 115.681, 30.7352);
INSERT INTO `app_area` VALUES (421125, '浠水县', 'Xishui', 421100, 3, '0713', '438200', 115.269, 30.4527);
INSERT INTO `app_area` VALUES (421126, '蕲春县', 'Qichun', 421100, 3, '0713', '435300', 115.436, 30.2261);
INSERT INTO `app_area` VALUES (421127, '黄梅县', 'Huangmei', 421100, 3, '0713', '435500', 115.944, 30.0703);
INSERT INTO `app_area` VALUES (421181, '麻城市', 'Macheng', 421100, 3, '0713', '438300', 115.01, 31.1723);
INSERT INTO `app_area` VALUES (421182, '武穴市', 'Wuxue', 421100, 3, '0713', '435400', 115.56, 29.8445);
INSERT INTO `app_area` VALUES (421200, '咸宁市', 'Xianning', 420000, 2, '0715', '437000', 114.329, 29.8328);
INSERT INTO `app_area` VALUES (421202, '咸安区', 'Xian\'an', 421200, 3, '0715', '437000', 114.299, 29.8529);
INSERT INTO `app_area` VALUES (421221, '嘉鱼县', 'Jiayu', 421200, 3, '0715', '437200', 113.939, 29.9705);
INSERT INTO `app_area` VALUES (421222, '通城县', 'Tongcheng', 421200, 3, '0715', '437400', 113.816, 29.2457);
INSERT INTO `app_area` VALUES (421223, '崇阳县', 'Chongyang', 421200, 3, '0715', '437500', 114.04, 29.5556);
INSERT INTO `app_area` VALUES (421224, '通山县', 'Tongshan', 421200, 3, '0715', '437600', 114.482, 29.6063);
INSERT INTO `app_area` VALUES (421281, '赤壁市', 'Chibi', 421200, 3, '0715', '437300', 113.9, 29.7245);
INSERT INTO `app_area` VALUES (421300, '随州市', 'Suizhou', 420000, 2, '0722', '441300', 113.374, 31.7175);
INSERT INTO `app_area` VALUES (421303, '曾都区', 'Zengdu', 421300, 3, '0722', '441300', 113.371, 31.7161);
INSERT INTO `app_area` VALUES (421321, '随县', 'Suixian', 421300, 3, '0722', '441309', 113.827, 31.6179);
INSERT INTO `app_area` VALUES (421381, '广水市', 'Guangshui', 421300, 3, '0722', '432700', 113.827, 31.6179);
INSERT INTO `app_area` VALUES (422800, '恩施土家族苗族自治州', 'Enshi', 420000, 2, '0718', '445000', 109.487, 30.2831);
INSERT INTO `app_area` VALUES (422801, '恩施市', 'Enshi', 422800, 3, '0718', '445000', 109.479, 30.295);
INSERT INTO `app_area` VALUES (422802, '利川市', 'Lichuan', 422800, 3, '0718', '445400', 108.936, 30.2912);
INSERT INTO `app_area` VALUES (422822, '建始县', 'Jianshi', 422800, 3, '0718', '445300', 109.722, 30.6021);
INSERT INTO `app_area` VALUES (422823, '巴东县', 'Badong', 422800, 3, '0718', '444300', 110.341, 31.0423);
INSERT INTO `app_area` VALUES (422825, '宣恩县', 'Xuanen', 422800, 3, '0718', '445500', 109.492, 29.9871);
INSERT INTO `app_area` VALUES (422826, '咸丰县', 'Xianfeng', 422800, 3, '0718', '445600', 109.152, 29.6798);
INSERT INTO `app_area` VALUES (422827, '来凤县', 'Laifeng', 422800, 3, '0718', '445700', 109.407, 29.4937);
INSERT INTO `app_area` VALUES (422828, '鹤峰县', 'Hefeng', 422800, 3, '0718', '445800', 110.031, 29.8907);
INSERT INTO `app_area` VALUES (429000, '直辖县级', '', 420000, 2, '', '', 114.299, 30.5844);
INSERT INTO `app_area` VALUES (429004, '仙桃市', 'Xiantao', 429000, 3, '0728', '433000', 113.454, 30.365);
INSERT INTO `app_area` VALUES (429005, '潜江市', 'Qianjiang', 429000, 3, '0728', '433100', 112.897, 30.4212);
INSERT INTO `app_area` VALUES (429006, '天门市', 'Tianmen', 429000, 3, '0728', '431700', 113.166, 30.6531);
INSERT INTO `app_area` VALUES (429021, '神农架林区', 'Shennongjia', 429000, 3, '0719', '442400', 110.672, 31.7444);
INSERT INTO `app_area` VALUES (430000, '湖南省', 'Hunan', 100000, 1, '', '', 112.982, 28.1941);
INSERT INTO `app_area` VALUES (430100, '长沙市', 'Changsha', 430000, 2, '0731', '410005', 112.982, 28.1941);
INSERT INTO `app_area` VALUES (430102, '芙蓉区', 'Furong', 430100, 3, '0731', '410011', 113.032, 28.1844);
INSERT INTO `app_area` VALUES (430103, '天心区', 'Tianxin', 430100, 3, '0731', '410004', 112.99, 28.1127);
INSERT INTO `app_area` VALUES (430104, '岳麓区', 'Yuelu', 430100, 3, '0731', '410013', 112.931, 28.2351);
INSERT INTO `app_area` VALUES (430105, '开福区', 'Kaifu', 430100, 3, '0731', '410008', 112.986, 28.2558);
INSERT INTO `app_area` VALUES (430111, '雨花区', 'Yuhua', 430100, 3, '0731', '410011', 113.036, 28.1354);
INSERT INTO `app_area` VALUES (430112, '望城区', 'Wangcheng', 430100, 3, '0731', '410200', 112.82, 28.3475);
INSERT INTO `app_area` VALUES (430121, '长沙县', 'Changsha', 430100, 3, '0731', '410100', 113.081, 28.246);
INSERT INTO `app_area` VALUES (430124, '宁乡县', 'Ningxiang', 430100, 3, '0731', '410600', 112.557, 28.2536);
INSERT INTO `app_area` VALUES (430181, '浏阳市', 'Liuyang', 430100, 3, '0731', '410300', 113.643, 28.1637);
INSERT INTO `app_area` VALUES (430200, '株洲市', 'Zhuzhou', 430000, 2, '0731', '412000', 113.152, 27.8358);
INSERT INTO `app_area` VALUES (430202, '荷塘区', 'Hetang', 430200, 3, '0731', '412000', 113.173, 27.8557);
INSERT INTO `app_area` VALUES (430203, '芦淞区', 'Lusong', 430200, 3, '0731', '412000', 113.156, 27.7852);
INSERT INTO `app_area` VALUES (430204, '石峰区', 'Shifeng', 430200, 3, '0731', '412005', 113.118, 27.8755);
INSERT INTO `app_area` VALUES (430211, '天元区', 'Tianyuan', 430200, 3, '0731', '412007', 113.123, 27.831);
INSERT INTO `app_area` VALUES (430221, '株洲县', 'Zhuzhou', 430200, 3, '0731', '412100', 113.144, 27.6983);
INSERT INTO `app_area` VALUES (430223, '攸县', 'Youxian', 430200, 3, '0731', '412300', 113.344, 27.0035);
INSERT INTO `app_area` VALUES (430224, '茶陵县', 'Chaling', 430200, 3, '0731', '412400', 113.544, 26.7915);
INSERT INTO `app_area` VALUES (430225, '炎陵县', 'Yanling', 430200, 3, '0731', '412500', 113.772, 26.4882);
INSERT INTO `app_area` VALUES (430281, '醴陵市', 'Liling', 430200, 3, '0731', '412200', 113.497, 27.6462);
INSERT INTO `app_area` VALUES (430300, '湘潭市', 'Xiangtan', 430000, 2, '0731', '411100', 112.925, 27.8467);
INSERT INTO `app_area` VALUES (430302, '雨湖区', 'Yuhu', 430300, 3, '0731', '411100', 112.904, 27.8686);
INSERT INTO `app_area` VALUES (430304, '岳塘区', 'Yuetang', 430300, 3, '0731', '411101', 112.961, 27.8578);
INSERT INTO `app_area` VALUES (430321, '湘潭县', 'Xiangtan', 430300, 3, '0731', '411228', 112.951, 27.7789);
INSERT INTO `app_area` VALUES (430381, '湘乡市', 'Xiangxiang', 430300, 3, '0731', '411400', 112.535, 27.7354);
INSERT INTO `app_area` VALUES (430382, '韶山市', 'Shaoshan', 430300, 3, '0731', '411300', 112.527, 27.915);
INSERT INTO `app_area` VALUES (430400, '衡阳市', 'Hengyang', 430000, 2, '0734', '421001', 112.608, 26.9004);
INSERT INTO `app_area` VALUES (430405, '珠晖区', 'Zhuhui', 430400, 3, '0734', '421002', 112.621, 26.8936);
INSERT INTO `app_area` VALUES (430406, '雁峰区', 'Yanfeng', 430400, 3, '0734', '421001', 112.617, 26.8887);
INSERT INTO `app_area` VALUES (430407, '石鼓区', 'Shigu', 430400, 3, '0734', '421005', 112.611, 26.9023);
INSERT INTO `app_area` VALUES (430408, '蒸湘区', 'Zhengxiang', 430400, 3, '0734', '421001', 112.603, 26.8965);
INSERT INTO `app_area` VALUES (430412, '南岳区', 'Nanyue', 430400, 3, '0734', '421900', 112.738, 27.2326);
INSERT INTO `app_area` VALUES (430421, '衡阳县', 'Hengyang', 430400, 3, '0734', '421200', 112.371, 26.9706);
INSERT INTO `app_area` VALUES (430422, '衡南县', 'Hengnan', 430400, 3, '0734', '421131', 112.678, 26.7383);
INSERT INTO `app_area` VALUES (430423, '衡山县', 'Hengshan', 430400, 3, '0734', '421300', 112.868, 27.2313);
INSERT INTO `app_area` VALUES (430424, '衡东县', 'Hengdong', 430400, 3, '0734', '421400', 112.948, 27.0809);
INSERT INTO `app_area` VALUES (430426, '祁东县', 'Qidong', 430400, 3, '0734', '421600', 112.09, 26.7996);
INSERT INTO `app_area` VALUES (430481, '耒阳市', 'Leiyang', 430400, 3, '0734', '421800', 112.86, 26.4213);
INSERT INTO `app_area` VALUES (430482, '常宁市', 'Changning', 430400, 3, '0734', '421500', 112.401, 26.4069);
INSERT INTO `app_area` VALUES (430500, '邵阳市', 'Shaoyang', 430000, 2, '0739', '422000', 111.469, 27.2378);
INSERT INTO `app_area` VALUES (430502, '双清区', 'Shuangqing', 430500, 3, '0739', '422001', 111.497, 27.2329);
INSERT INTO `app_area` VALUES (430503, '大祥区', 'Daxiang', 430500, 3, '0739', '422000', 111.454, 27.2333);
INSERT INTO `app_area` VALUES (430511, '北塔区', 'Beita', 430500, 3, '0739', '422007', 111.452, 27.2465);
INSERT INTO `app_area` VALUES (430521, '邵东县', 'Shaodong', 430500, 3, '0739', '422800', 111.744, 27.2584);
INSERT INTO `app_area` VALUES (430522, '新邵县', 'Xinshao', 430500, 3, '0739', '422900', 111.461, 27.3217);
INSERT INTO `app_area` VALUES (430523, '邵阳县', 'Shaoyang', 430500, 3, '0739', '422100', 111.275, 26.9914);
INSERT INTO `app_area` VALUES (430524, '隆回县', 'Longhui', 430500, 3, '0739', '422200', 111.032, 27.1094);
INSERT INTO `app_area` VALUES (430525, '洞口县', 'Dongkou', 430500, 3, '0739', '422300', 110.574, 27.0546);
INSERT INTO `app_area` VALUES (430527, '绥宁县', 'Suining', 430500, 3, '0739', '422600', 110.156, 26.5864);
INSERT INTO `app_area` VALUES (430528, '新宁县', 'Xinning', 430500, 3, '0739', '422700', 110.851, 26.4294);
INSERT INTO `app_area` VALUES (430529, '城步苗族自治县', 'Chengbu', 430500, 3, '0739', '422500', 110.322, 26.3905);
INSERT INTO `app_area` VALUES (430581, '武冈市', 'Wugang', 430500, 3, '0739', '422400', 110.633, 26.7282);
INSERT INTO `app_area` VALUES (430600, '岳阳市', 'Yueyang', 430000, 2, '0730', '414000', 113.133, 29.3703);
INSERT INTO `app_area` VALUES (430602, '岳阳楼区', 'Yueyanglou', 430600, 3, '0730', '414000', 113.129, 29.3719);
INSERT INTO `app_area` VALUES (430603, '云溪区', 'Yunxi', 430600, 3, '0730', '414009', 113.277, 29.4736);
INSERT INTO `app_area` VALUES (430611, '君山区', 'Junshan', 430600, 3, '0730', '414005', 113.004, 29.4594);
INSERT INTO `app_area` VALUES (430621, '岳阳县', 'Yueyang', 430600, 3, '0730', '414100', 113.12, 29.1431);
INSERT INTO `app_area` VALUES (430623, '华容县', 'Huarong', 430600, 3, '0730', '414200', 112.541, 29.5302);
INSERT INTO `app_area` VALUES (430624, '湘阴县', 'Xiangyin', 430600, 3, '0730', '414600', 112.909, 28.6892);
INSERT INTO `app_area` VALUES (430626, '平江县', 'Pingjiang', 430600, 3, '0730', '414500', 113.581, 28.7066);
INSERT INTO `app_area` VALUES (430681, '汨罗市', 'Miluo', 430600, 3, '0730', '414400', 113.067, 28.8063);
INSERT INTO `app_area` VALUES (430682, '临湘市', 'Linxiang', 430600, 3, '0730', '414300', 113.45, 29.477);
INSERT INTO `app_area` VALUES (430700, '常德市', 'Changde', 430000, 2, '0736', '415000', 111.691, 29.0402);
INSERT INTO `app_area` VALUES (430702, '武陵区', 'Wuling', 430700, 3, '0736', '415000', 111.698, 29.0288);
INSERT INTO `app_area` VALUES (430703, '鼎城区', 'Dingcheng', 430700, 3, '0736', '415101', 111.681, 29.0186);
INSERT INTO `app_area` VALUES (430721, '安乡县', 'Anxiang', 430700, 3, '0736', '415600', 112.167, 29.4133);
INSERT INTO `app_area` VALUES (430722, '汉寿县', 'Hanshou', 430700, 3, '0736', '415900', 111.967, 28.903);
INSERT INTO `app_area` VALUES (430723, '澧县', 'Lixian', 430700, 3, '0736', '415500', 111.759, 29.6332);
INSERT INTO `app_area` VALUES (430724, '临澧县', 'Linli', 430700, 3, '0736', '415200', 111.652, 29.4416);
INSERT INTO `app_area` VALUES (430725, '桃源县', 'Taoyuan', 430700, 3, '0736', '415700', 111.489, 28.9047);
INSERT INTO `app_area` VALUES (430726, '石门县', 'Shimen', 430700, 3, '0736', '415300', 111.38, 29.5842);
INSERT INTO `app_area` VALUES (430781, '津市市', 'Jinshi', 430700, 3, '0736', '415400', 111.878, 29.6056);
INSERT INTO `app_area` VALUES (430800, '张家界市', 'Zhangjiajie', 430000, 2, '0744', '427000', 110.48, 29.1274);
INSERT INTO `app_area` VALUES (430802, '永定区', 'Yongding', 430800, 3, '0744', '427000', 110.475, 29.1339);
INSERT INTO `app_area` VALUES (430811, '武陵源区', 'Wulingyuan', 430800, 3, '0744', '427400', 110.55, 29.3457);
INSERT INTO `app_area` VALUES (430821, '慈利县', 'Cili', 430800, 3, '0744', '427200', 111.139, 29.4299);
INSERT INTO `app_area` VALUES (430822, '桑植县', 'Sangzhi', 430800, 3, '0744', '427100', 110.163, 29.3981);
INSERT INTO `app_area` VALUES (430900, '益阳市', 'Yiyang', 430000, 2, '0737', '413000', 112.355, 28.5701);
INSERT INTO `app_area` VALUES (430902, '资阳区', 'Ziyang', 430900, 3, '0737', '413001', 112.324, 28.591);
INSERT INTO `app_area` VALUES (430903, '赫山区', 'Heshan', 430900, 3, '0737', '413002', 112.373, 28.5742);
INSERT INTO `app_area` VALUES (430921, '南县', 'Nanxian', 430900, 3, '0737', '413200', 112.396, 29.3616);
INSERT INTO `app_area` VALUES (430922, '桃江县', 'Taojiang', 430900, 3, '0737', '413400', 112.156, 28.5181);
INSERT INTO `app_area` VALUES (430923, '安化县', 'Anhua', 430900, 3, '0737', '413500', 111.213, 28.3742);
INSERT INTO `app_area` VALUES (430981, '沅江市', 'Yuanjiang', 430900, 3, '0737', '413100', 112.354, 28.844);
INSERT INTO `app_area` VALUES (431000, '郴州市', 'Chenzhou', 430000, 2, '0735', '423000', 113.032, 25.7936);
INSERT INTO `app_area` VALUES (431002, '北湖区', 'Beihu', 431000, 3, '0735', '423000', 113.011, 25.784);
INSERT INTO `app_area` VALUES (431003, '苏仙区', 'Suxian', 431000, 3, '0735', '423000', 113.042, 25.8004);
INSERT INTO `app_area` VALUES (431021, '桂阳县', 'Guiyang', 431000, 3, '0735', '424400', 112.734, 25.7541);
INSERT INTO `app_area` VALUES (431022, '宜章县', 'Yizhang', 431000, 3, '0735', '424200', 112.951, 25.3993);
INSERT INTO `app_area` VALUES (431023, '永兴县', 'Yongxing', 431000, 3, '0735', '423300', 113.112, 26.1265);
INSERT INTO `app_area` VALUES (431024, '嘉禾县', 'Jiahe', 431000, 3, '0735', '424500', 112.369, 25.5879);
INSERT INTO `app_area` VALUES (431025, '临武县', 'Linwu', 431000, 3, '0735', '424300', 112.564, 25.276);
INSERT INTO `app_area` VALUES (431026, '汝城县', 'Rucheng', 431000, 3, '0735', '424100', 113.686, 25.552);
INSERT INTO `app_area` VALUES (431027, '桂东县', 'Guidong', 431000, 3, '0735', '423500', 113.947, 26.0799);
INSERT INTO `app_area` VALUES (431028, '安仁县', 'Anren', 431000, 3, '0735', '423600', 113.269, 26.7093);
INSERT INTO `app_area` VALUES (431081, '资兴市', 'Zixing', 431000, 3, '0735', '423400', 113.237, 25.9767);
INSERT INTO `app_area` VALUES (431100, '永州市', 'Yongzhou', 430000, 2, '0746', '425000', 111.608, 26.4345);
INSERT INTO `app_area` VALUES (431102, '零陵区', 'Lingling', 431100, 3, '0746', '425100', 111.621, 26.2211);
INSERT INTO `app_area` VALUES (431103, '冷水滩区', 'Lengshuitan', 431100, 3, '0746', '425100', 111.592, 26.4611);
INSERT INTO `app_area` VALUES (431121, '祁阳县', 'Qiyang', 431100, 3, '0746', '426100', 111.84, 26.5801);
INSERT INTO `app_area` VALUES (431122, '东安县', 'Dong\'an', 431100, 3, '0746', '425900', 111.316, 26.392);
INSERT INTO `app_area` VALUES (431123, '双牌县', 'Shuangpai', 431100, 3, '0746', '425200', 111.659, 25.9599);
INSERT INTO `app_area` VALUES (431124, '道县', 'Daoxian', 431100, 3, '0746', '425300', 111.602, 25.5277);
INSERT INTO `app_area` VALUES (431125, '江永县', 'Jiangyong', 431100, 3, '0746', '425400', 111.341, 25.2723);
INSERT INTO `app_area` VALUES (431126, '宁远县', 'Ningyuan', 431100, 3, '0746', '425600', 111.946, 25.5691);
INSERT INTO `app_area` VALUES (431127, '蓝山县', 'Lanshan', 431100, 3, '0746', '425800', 112.194, 25.3679);
INSERT INTO `app_area` VALUES (431128, '新田县', 'Xintian', 431100, 3, '0746', '425700', 112.221, 25.9095);
INSERT INTO `app_area` VALUES (431129, '江华瑶族自治县', 'Jianghua', 431100, 3, '0746', '425500', 111.588, 25.1845);
INSERT INTO `app_area` VALUES (431200, '怀化市', 'Huaihua', 430000, 2, '0745', '418000', 109.978, 27.5501);
INSERT INTO `app_area` VALUES (431202, '鹤城区', 'Hecheng', 431200, 3, '0745', '418000', 109.965, 27.5494);
INSERT INTO `app_area` VALUES (431221, '中方县', 'Zhongfang', 431200, 3, '0745', '418005', 109.945, 27.4399);
INSERT INTO `app_area` VALUES (431222, '沅陵县', 'Yuanling', 431200, 3, '0745', '419600', 110.396, 28.4555);
INSERT INTO `app_area` VALUES (431223, '辰溪县', 'Chenxi', 431200, 3, '0745', '419500', 110.189, 28.0041);
INSERT INTO `app_area` VALUES (431224, '溆浦县', 'Xupu', 431200, 3, '0745', '419300', 110.594, 27.9084);
INSERT INTO `app_area` VALUES (431225, '会同县', 'Huitong', 431200, 3, '0745', '418300', 109.736, 26.8872);
INSERT INTO `app_area` VALUES (431226, '麻阳苗族自治县', 'Mayang', 431200, 3, '0745', '419400', 109.802, 27.866);
INSERT INTO `app_area` VALUES (431227, '新晃侗族自治县', 'Xinhuang', 431200, 3, '0745', '419200', 109.172, 27.3594);
INSERT INTO `app_area` VALUES (431228, '芷江侗族自治县', 'Zhijiang', 431200, 3, '0745', '419100', 109.685, 27.443);
INSERT INTO `app_area` VALUES (431229, '靖州苗族侗族自治县', 'Jingzhou', 431200, 3, '0745', '418400', 109.698, 26.5765);
INSERT INTO `app_area` VALUES (431230, '通道侗族自治县', 'Tongdao', 431200, 3, '0745', '418500', 109.785, 26.1571);
INSERT INTO `app_area` VALUES (431281, '洪江市', 'Hongjiang', 431200, 3, '0745', '418100', 109.837, 27.2092);
INSERT INTO `app_area` VALUES (431300, '娄底市', 'Loudi', 430000, 2, '0738', '417000', 112.008, 27.7281);
INSERT INTO `app_area` VALUES (431302, '娄星区', 'Louxing', 431300, 3, '0738', '417000', 112.002, 27.7299);
INSERT INTO `app_area` VALUES (431321, '双峰县', 'Shuangfeng', 431300, 3, '0738', '417700', 112.199, 27.4542);
INSERT INTO `app_area` VALUES (431322, '新化县', 'Xinhua', 431300, 3, '0738', '417600', 111.327, 27.7266);
INSERT INTO `app_area` VALUES (431381, '冷水江市', 'Lengshuijiang', 431300, 3, '0738', '417500', 111.436, 27.6815);
INSERT INTO `app_area` VALUES (431382, '涟源市', 'Lianyuan', 431300, 3, '0738', '417100', 111.672, 27.6883);
INSERT INTO `app_area` VALUES (433100, '湘西土家族苗族自治州', 'Xiangxi', 430000, 2, '0743', '416000', 109.74, 28.3143);
INSERT INTO `app_area` VALUES (433101, '吉首市', 'Jishou', 433100, 3, '0743', '416000', 109.698, 28.2625);
INSERT INTO `app_area` VALUES (433122, '泸溪县', 'Luxi', 433100, 3, '0743', '416100', 110.217, 28.2205);
INSERT INTO `app_area` VALUES (433123, '凤凰县', 'Fenghuang', 433100, 3, '0743', '416200', 109.602, 27.9482);
INSERT INTO `app_area` VALUES (433124, '花垣县', 'Huayuan', 433100, 3, '0743', '416400', 109.482, 28.5721);
INSERT INTO `app_area` VALUES (433125, '保靖县', 'Baojing', 433100, 3, '0743', '416500', 109.66, 28.7);
INSERT INTO `app_area` VALUES (433126, '古丈县', 'Guzhang', 433100, 3, '0743', '416300', 109.948, 28.6194);
INSERT INTO `app_area` VALUES (433127, '永顺县', 'Yongshun', 433100, 3, '0743', '416700', 109.853, 29.001);
INSERT INTO `app_area` VALUES (433130, '龙山县', 'Longshan', 433100, 3, '0743', '416800', 109.443, 29.4569);
INSERT INTO `app_area` VALUES (440000, '广东省', 'Guangdong', 100000, 1, '', '', 113.281, 23.1252);
INSERT INTO `app_area` VALUES (440100, '广州市', 'Guangzhou', 440000, 2, '020', '510032', 113.281, 23.1252);
INSERT INTO `app_area` VALUES (440103, '荔湾区', 'Liwan', 440100, 3, '020', '510170', 113.244, 23.1259);
INSERT INTO `app_area` VALUES (440104, '越秀区', 'Yuexiu', 440100, 3, '020', '510030', 113.267, 23.129);
INSERT INTO `app_area` VALUES (440105, '海珠区', 'Haizhu', 440100, 3, '020', '510300', 113.262, 23.1038);
INSERT INTO `app_area` VALUES (440106, '天河区', 'Tianhe', 440100, 3, '020', '510665', 113.361, 23.1247);
INSERT INTO `app_area` VALUES (440111, '白云区', 'Baiyun', 440100, 3, '020', '510405', 113.273, 23.1579);
INSERT INTO `app_area` VALUES (440112, '黄埔区', 'Huangpu', 440100, 3, '020', '510700', 113.459, 23.1064);
INSERT INTO `app_area` VALUES (440113, '番禺区', 'Panyu', 440100, 3, '020', '511400', 113.384, 22.936);
INSERT INTO `app_area` VALUES (440114, '花都区', 'Huadu', 440100, 3, '020', '510800', 113.22, 23.4036);
INSERT INTO `app_area` VALUES (440115, '南沙区', 'Nansha', 440100, 3, '020', '511458', 113.608, 22.7714);
INSERT INTO `app_area` VALUES (440117, '从化区', 'Conghua', 440100, 3, '020', '510900', 113.587, 23.5453);
INSERT INTO `app_area` VALUES (440118, '增城区', 'Zengcheng', 440100, 3, '020', '511300', 113.83, 23.2905);
INSERT INTO `app_area` VALUES (440200, '韶关市', 'Shaoguan', 440000, 2, '0751', '512002', 113.592, 24.8013);
INSERT INTO `app_area` VALUES (440203, '武江区', 'Wujiang', 440200, 3, '0751', '512026', 113.588, 24.7926);
INSERT INTO `app_area` VALUES (440204, '浈江区', 'Zhenjiang', 440200, 3, '0751', '512023', 113.611, 24.8044);
INSERT INTO `app_area` VALUES (440205, '曲江区', 'Qujiang', 440200, 3, '0751', '512101', 113.602, 24.6791);
INSERT INTO `app_area` VALUES (440222, '始兴县', 'Shixing', 440200, 3, '0751', '512500', 114.068, 24.9476);
INSERT INTO `app_area` VALUES (440224, '仁化县', 'Renhua', 440200, 3, '0751', '512300', 113.747, 25.0874);
INSERT INTO `app_area` VALUES (440229, '翁源县', 'Wengyuan', 440200, 3, '0751', '512600', 114.134, 24.3495);
INSERT INTO `app_area` VALUES (440232, '乳源瑶族自治县', 'Ruyuan', 440200, 3, '0751', '512700', 113.277, 24.778);
INSERT INTO `app_area` VALUES (440233, '新丰县', 'Xinfeng', 440200, 3, '0751', '511100', 114.208, 24.0592);
INSERT INTO `app_area` VALUES (440281, '乐昌市', 'Lechang', 440200, 3, '0751', '512200', 113.357, 25.128);
INSERT INTO `app_area` VALUES (440282, '南雄市', 'Nanxiong', 440200, 3, '0751', '512400', 114.31, 25.1171);
INSERT INTO `app_area` VALUES (440300, '深圳市', 'Shenzhen', 440000, 2, '0755', '518035', 114.086, 22.547);
INSERT INTO `app_area` VALUES (440303, '罗湖区', 'Luohu', 440300, 3, '0755', '518021', 114.131, 22.5484);
INSERT INTO `app_area` VALUES (440304, '福田区', 'Futian', 440300, 3, '0755', '518048', 114.056, 22.5224);
INSERT INTO `app_area` VALUES (440305, '南山区', 'Nanshan', 440300, 3, '0755', '518051', 113.93, 22.5329);
INSERT INTO `app_area` VALUES (440306, '宝安区', 'Bao\'an', 440300, 3, '0755', '518101', 113.883, 22.5537);
INSERT INTO `app_area` VALUES (440307, '龙岗区', 'Longgang', 440300, 3, '0755', '518172', 114.248, 22.7199);
INSERT INTO `app_area` VALUES (440308, '盐田区', 'Yantian', 440300, 3, '0755', '518081', 114.237, 22.5578);
INSERT INTO `app_area` VALUES (440309, '光明新区', 'Guangmingxinqu', 440300, 3, '0755', '518100', 113.896, 22.7773);
INSERT INTO `app_area` VALUES (440310, '坪山新区', 'Pingshanxinqu', 440300, 3, '0755', '518000', 114.346, 22.6905);
INSERT INTO `app_area` VALUES (440311, '大鹏新区', 'Dapengxinqu', 440300, 3, '0755', '518000', 114.48, 22.5879);
INSERT INTO `app_area` VALUES (440312, '龙华新区', 'Longhuaxinqu', 440300, 3, '0755', '518100', 114.037, 22.687);
INSERT INTO `app_area` VALUES (440400, '珠海市', 'Zhuhai', 440000, 2, '0756', '519000', 113.553, 22.2559);
INSERT INTO `app_area` VALUES (440402, '香洲区', 'Xiangzhou', 440400, 3, '0756', '519000', 113.544, 22.2665);
INSERT INTO `app_area` VALUES (440403, '斗门区', 'Doumen', 440400, 3, '0756', '519110', 113.296, 22.209);
INSERT INTO `app_area` VALUES (440404, '金湾区', 'Jinwan', 440400, 3, '0756', '519040', 113.364, 22.1469);
INSERT INTO `app_area` VALUES (440500, '汕头市', 'Shantou', 440000, 2, '0754', '515041', 116.708, 23.371);
INSERT INTO `app_area` VALUES (440507, '龙湖区', 'Longhu', 440500, 3, '0754', '515041', 116.716, 23.3717);
INSERT INTO `app_area` VALUES (440511, '金平区', 'Jinping', 440500, 3, '0754', '515041', 116.704, 23.3664);
INSERT INTO `app_area` VALUES (440512, '濠江区', 'Haojiang', 440500, 3, '0754', '515071', 116.727, 23.2859);
INSERT INTO `app_area` VALUES (440513, '潮阳区', 'Chaoyang', 440500, 3, '0754', '515100', 116.602, 23.2649);
INSERT INTO `app_area` VALUES (440514, '潮南区', 'Chaonan', 440500, 3, '0754', '515144', 116.432, 23.25);
INSERT INTO `app_area` VALUES (440515, '澄海区', 'Chenghai', 440500, 3, '0754', '515800', 116.756, 23.4673);
INSERT INTO `app_area` VALUES (440523, '南澳县', 'Nanao', 440500, 3, '0754', '515900', 117.019, 23.4223);
INSERT INTO `app_area` VALUES (440600, '佛山市', 'Foshan', 440000, 2, '0757', '528000', 113.123, 23.0288);
INSERT INTO `app_area` VALUES (440604, '禅城区', 'Chancheng', 440600, 3, '0757', '528000', 113.123, 23.0084);
INSERT INTO `app_area` VALUES (440605, '南海区', 'Nanhai', 440600, 3, '0757', '528251', 113.143, 23.0288);
INSERT INTO `app_area` VALUES (440606, '顺德区', 'Shunde', 440600, 3, '0757', '528300', 113.294, 22.8045);
INSERT INTO `app_area` VALUES (440607, '三水区', 'Sanshui', 440600, 3, '0757', '528133', 112.897, 23.1556);
INSERT INTO `app_area` VALUES (440608, '高明区', 'Gaoming', 440600, 3, '0757', '528500', 112.893, 22.9002);
INSERT INTO `app_area` VALUES (440700, '江门市', 'Jiangmen', 440000, 2, '0750', '529000', 113.095, 22.5904);
INSERT INTO `app_area` VALUES (440703, '蓬江区', 'Pengjiang', 440700, 3, '0750', '529000', 113.078, 22.5951);
INSERT INTO `app_area` VALUES (440704, '江海区', 'Jianghai', 440700, 3, '0750', '529040', 113.111, 22.5602);
INSERT INTO `app_area` VALUES (440705, '新会区', 'Xinhui', 440700, 3, '0750', '529100', 113.032, 22.4588);
INSERT INTO `app_area` VALUES (440781, '台山市', 'Taishan', 440700, 3, '0750', '529200', 112.794, 22.2515);
INSERT INTO `app_area` VALUES (440783, '开平市', 'Kaiping', 440700, 3, '0750', '529337', 112.698, 22.3762);
INSERT INTO `app_area` VALUES (440784, '鹤山市', 'Heshan', 440700, 3, '0750', '529700', 112.964, 22.7652);
INSERT INTO `app_area` VALUES (440785, '恩平市', 'Enping', 440700, 3, '0750', '529400', 112.305, 22.1829);
INSERT INTO `app_area` VALUES (440800, '湛江市', 'Zhanjiang', 440000, 2, '0759', '524047', 110.406, 21.1953);
INSERT INTO `app_area` VALUES (440802, '赤坎区', 'Chikan', 440800, 3, '0759', '524033', 110.366, 21.2661);
INSERT INTO `app_area` VALUES (440803, '霞山区', 'Xiashan', 440800, 3, '0759', '524011', 110.398, 21.1918);
INSERT INTO `app_area` VALUES (440804, '坡头区', 'Potou', 440800, 3, '0759', '524057', 110.455, 21.2447);
INSERT INTO `app_area` VALUES (440811, '麻章区', 'Mazhang', 440800, 3, '0759', '524094', 110.334, 21.2633);
INSERT INTO `app_area` VALUES (440823, '遂溪县', 'Suixi', 440800, 3, '0759', '524300', 110.25, 21.3772);
INSERT INTO `app_area` VALUES (440825, '徐闻县', 'Xuwen', 440800, 3, '0759', '524100', 110.174, 20.3281);
INSERT INTO `app_area` VALUES (440881, '廉江市', 'Lianjiang', 440800, 3, '0759', '524400', 110.284, 21.6092);
INSERT INTO `app_area` VALUES (440882, '雷州市', 'Leizhou', 440800, 3, '0759', '524200', 110.101, 20.9143);
INSERT INTO `app_area` VALUES (440883, '吴川市', 'Wuchuan', 440800, 3, '0759', '524500', 110.777, 21.4458);
INSERT INTO `app_area` VALUES (440900, '茂名市', 'Maoming', 440000, 2, '0668', '525000', 110.919, 21.6598);
INSERT INTO `app_area` VALUES (440902, '茂南区', 'Maonan', 440900, 3, '0668', '525000', 110.919, 21.641);
INSERT INTO `app_area` VALUES (440904, '电白区', 'Dianbai', 440900, 3, '0668', '525400', 111.007, 21.5072);
INSERT INTO `app_area` VALUES (440981, '高州市', 'Gaozhou', 440900, 3, '0668', '525200', 110.855, 21.9206);
INSERT INTO `app_area` VALUES (440982, '化州市', 'Huazhou', 440900, 3, '0668', '525100', 110.639, 21.6639);
INSERT INTO `app_area` VALUES (440983, '信宜市', 'Xinyi', 440900, 3, '0668', '525300', 110.946, 22.3535);
INSERT INTO `app_area` VALUES (441200, '肇庆市', 'Zhaoqing', 440000, 2, '0758', '526040', 112.473, 23.0515);
INSERT INTO `app_area` VALUES (441202, '端州区', 'Duanzhou', 441200, 3, '0758', '526060', 112.485, 23.0519);
INSERT INTO `app_area` VALUES (441203, '鼎湖区', 'Dinghu', 441200, 3, '0758', '526070', 112.566, 23.1585);
INSERT INTO `app_area` VALUES (441223, '广宁县', 'Guangning', 441200, 3, '0758', '526300', 112.441, 23.6346);
INSERT INTO `app_area` VALUES (441224, '怀集县', 'Huaiji', 441200, 3, '0758', '526400', 112.184, 23.9092);
INSERT INTO `app_area` VALUES (441225, '封开县', 'Fengkai', 441200, 3, '0758', '526500', 111.503, 23.4357);
INSERT INTO `app_area` VALUES (441226, '德庆县', 'Deqing', 441200, 3, '0758', '526600', 111.786, 23.1437);
INSERT INTO `app_area` VALUES (441283, '高要市', 'Gaoyao', 441200, 3, '0758', '526100', 112.458, 23.0258);
INSERT INTO `app_area` VALUES (441284, '四会市', 'Sihui', 441200, 3, '0758', '526200', 112.734, 23.3269);
INSERT INTO `app_area` VALUES (441300, '惠州市', 'Huizhou', 440000, 2, '0752', '516000', 114.413, 23.0794);
INSERT INTO `app_area` VALUES (441302, '惠城区', 'Huicheng', 441300, 3, '0752', '516008', 114.383, 23.0838);
INSERT INTO `app_area` VALUES (441303, '惠阳区', 'Huiyang', 441300, 3, '0752', '516211', 114.456, 22.7885);
INSERT INTO `app_area` VALUES (441322, '博罗县', 'Boluo', 441300, 3, '0752', '516100', 114.29, 23.1731);
INSERT INTO `app_area` VALUES (441323, '惠东县', 'Huidong', 441300, 3, '0752', '516300', 114.72, 22.9848);
INSERT INTO `app_area` VALUES (441324, '龙门县', 'Longmen', 441300, 3, '0752', '516800', 114.255, 23.7276);
INSERT INTO `app_area` VALUES (441400, '梅州市', 'Meizhou', 440000, 2, '0753', '514021', 116.118, 24.2991);
INSERT INTO `app_area` VALUES (441402, '梅江区', 'Meijiang', 441400, 3, '0753', '514000', 116.117, 24.3106);
INSERT INTO `app_area` VALUES (441403, '梅县区', 'Meixian', 441400, 3, '0753', '514787', 116.098, 24.2867);
INSERT INTO `app_area` VALUES (441422, '大埔县', 'Dabu', 441400, 3, '0753', '514200', 116.697, 24.3533);
INSERT INTO `app_area` VALUES (441423, '丰顺县', 'Fengshun', 441400, 3, '0753', '514300', 116.182, 23.7409);
INSERT INTO `app_area` VALUES (441424, '五华县', 'Wuhua', 441400, 3, '0753', '514400', 115.779, 23.9242);
INSERT INTO `app_area` VALUES (441426, '平远县', 'Pingyuan', 441400, 3, '0753', '514600', 115.896, 24.5712);
INSERT INTO `app_area` VALUES (441427, '蕉岭县', 'Jiaoling', 441400, 3, '0753', '514100', 116.171, 24.6573);
INSERT INTO `app_area` VALUES (441481, '兴宁市', 'Xingning', 441400, 3, '0753', '514500', 115.731, 24.14);
INSERT INTO `app_area` VALUES (441500, '汕尾市', 'Shanwei', 440000, 2, '0660', '516600', 115.364, 22.7745);
INSERT INTO `app_area` VALUES (441502, '城区', 'Chengqu', 441500, 3, '0660', '516600', 115.365, 22.7789);
INSERT INTO `app_area` VALUES (441521, '海丰县', 'Haifeng', 441500, 3, '0660', '516400', 115.323, 22.9665);
INSERT INTO `app_area` VALUES (441523, '陆河县', 'Luhe', 441500, 3, '0660', '516700', 115.656, 23.3036);
INSERT INTO `app_area` VALUES (441581, '陆丰市', 'Lufeng', 441500, 3, '0660', '516500', 115.648, 22.9433);
INSERT INTO `app_area` VALUES (441600, '河源市', 'Heyuan', 440000, 2, '0762', '517000', 114.698, 23.7463);
INSERT INTO `app_area` VALUES (441602, '源城区', 'Yuancheng', 441600, 3, '0762', '517000', 114.702, 23.7341);
INSERT INTO `app_area` VALUES (441621, '紫金县', 'Zijin', 441600, 3, '0762', '517400', 115.184, 23.6387);
INSERT INTO `app_area` VALUES (441622, '龙川县', 'Longchuan', 441600, 3, '0762', '517300', 115.26, 24.1014);
INSERT INTO `app_area` VALUES (441623, '连平县', 'Lianping', 441600, 3, '0762', '517100', 114.49, 24.3716);
INSERT INTO `app_area` VALUES (441624, '和平县', 'Heping', 441600, 3, '0762', '517200', 114.938, 24.4432);
INSERT INTO `app_area` VALUES (441625, '东源县', 'Dongyuan', 441600, 3, '0762', '517583', 114.746, 23.7883);
INSERT INTO `app_area` VALUES (441700, '阳江市', 'Yangjiang', 440000, 2, '0662', '529500', 111.975, 21.8592);
INSERT INTO `app_area` VALUES (441702, '江城区', 'Jiangcheng', 441700, 3, '0662', '529500', 111.955, 21.8619);
INSERT INTO `app_area` VALUES (441704, '阳东区', 'Yangdong', 441700, 3, '0662', '529900', 112.015, 21.874);
INSERT INTO `app_area` VALUES (441721, '阳西县', 'Yangxi', 441700, 3, '0662', '529800', 111.618, 21.7523);
INSERT INTO `app_area` VALUES (441781, '阳春市', 'Yangchun', 441700, 3, '0662', '529600', 111.789, 22.1723);
INSERT INTO `app_area` VALUES (441800, '清远市', 'Qingyuan', 440000, 2, '0763', '511500', 113.037, 23.7042);
INSERT INTO `app_area` VALUES (441802, '清城区', 'Qingcheng', 441800, 3, '0763', '511515', 113.063, 23.6978);
INSERT INTO `app_area` VALUES (441803, '清新区', 'Qingxin', 441800, 3, '0763', '511810', 113.015, 23.7369);
INSERT INTO `app_area` VALUES (441821, '佛冈县', 'Fogang', 441800, 3, '0763', '511600', 113.533, 23.8723);
INSERT INTO `app_area` VALUES (441823, '阳山县', 'Yangshan', 441800, 3, '0763', '513100', 112.641, 24.4652);
INSERT INTO `app_area` VALUES (441825, '连山壮族瑶族自治县', 'Lianshan', 441800, 3, '0763', '513200', 112.08, 24.5681);
INSERT INTO `app_area` VALUES (441826, '连南瑶族自治县', 'Liannan', 441800, 3, '0763', '513300', 112.288, 24.7173);
INSERT INTO `app_area` VALUES (441881, '英德市', 'Yingde', 441800, 3, '0763', '513000', 113.415, 24.1857);
INSERT INTO `app_area` VALUES (441882, '连州市', 'Lianzhou', 441800, 3, '0763', '513400', 112.382, 24.7791);
INSERT INTO `app_area` VALUES (441900, '东莞市', 'Dongguan', 440000, 2, '0769', '523888', 113.76, 23.0489);
INSERT INTO `app_area` VALUES (441901, '莞城区', 'Guancheng', 441900, 3, '0769', '523128', 113.751, 23.0534);
INSERT INTO `app_area` VALUES (441902, '南城区', 'Nancheng', 441900, 3, '0769', '523617', 113.752, 23.0202);
INSERT INTO `app_area` VALUES (441904, '万江区', 'Wanjiang', 441900, 3, '0769', '523039', 113.739, 23.0438);
INSERT INTO `app_area` VALUES (441905, '石碣镇', 'Shijie', 441900, 3, '0769', '523290', 113.802, 23.099);
INSERT INTO `app_area` VALUES (441906, '石龙镇', 'Shilong', 441900, 3, '0769', '523326', 113.876, 23.1074);
INSERT INTO `app_area` VALUES (441907, '茶山镇', 'Chashan', 441900, 3, '0769', '523380', 113.884, 23.0624);
INSERT INTO `app_area` VALUES (441908, '石排镇', 'Shipai', 441900, 3, '0769', '523346', 113.92, 23.0863);
INSERT INTO `app_area` VALUES (441909, '企石镇', 'Qishi', 441900, 3, '0769', '523507', 114.013, 23.066);
INSERT INTO `app_area` VALUES (441910, '横沥镇', 'Hengli', 441900, 3, '0769', '523471', 113.957, 23.0257);
INSERT INTO `app_area` VALUES (441911, '桥头镇', 'Qiaotou', 441900, 3, '0769', '523520', 114.014, 22.9397);
INSERT INTO `app_area` VALUES (441912, '谢岗镇', 'Xiegang', 441900, 3, '0769', '523592', 114.141, 22.9597);
INSERT INTO `app_area` VALUES (441913, '东坑镇', 'Dongkeng', 441900, 3, '0769', '523451', 113.94, 22.9928);
INSERT INTO `app_area` VALUES (441914, '常平镇', 'Changping', 441900, 3, '0769', '523560', 114.03, 23.0161);
INSERT INTO `app_area` VALUES (441915, '寮步镇', 'Liaobu', 441900, 3, '0769', '523411', 113.885, 22.9917);
INSERT INTO `app_area` VALUES (441916, '大朗镇', 'Dalang', 441900, 3, '0769', '523770', 113.927, 22.9657);
INSERT INTO `app_area` VALUES (441917, '麻涌镇', 'Machong', 441900, 3, '0769', '523143', 113.546, 23.0453);
INSERT INTO `app_area` VALUES (441918, '中堂镇', 'Zhongtang', 441900, 3, '0769', '523233', 113.654, 23.0902);
INSERT INTO `app_area` VALUES (441919, '高埗镇', 'Gaobu', 441900, 3, '0769', '523282', 113.736, 23.0684);
INSERT INTO `app_area` VALUES (441920, '樟木头镇', 'Zhangmutou', 441900, 3, '0769', '523619', 114.066, 22.9567);
INSERT INTO `app_area` VALUES (441921, '大岭山镇', 'Dalingshan', 441900, 3, '0769', '523835', 113.783, 22.8854);
INSERT INTO `app_area` VALUES (441922, '望牛墩镇', 'Wangniudun', 441900, 3, '0769', '523203', 113.659, 23.055);
INSERT INTO `app_area` VALUES (441923, '黄江镇', 'Huangjiang', 441900, 3, '0769', '523755', 113.993, 22.8775);
INSERT INTO `app_area` VALUES (441924, '洪梅镇', 'Hongmei', 441900, 3, '0769', '523163', 113.613, 22.9927);
INSERT INTO `app_area` VALUES (441925, '清溪镇', 'Qingxi', 441900, 3, '0769', '523660', 114.156, 22.8445);
INSERT INTO `app_area` VALUES (441926, '沙田镇', 'Shatian', 441900, 3, '0769', '523988', 113.76, 23.0489);
INSERT INTO `app_area` VALUES (441927, '道滘镇', 'Daojiao', 441900, 3, '0769', '523171', 113.76, 23.0489);
INSERT INTO `app_area` VALUES (441928, '塘厦镇', 'Tangxia', 441900, 3, '0769', '523713', 114.108, 22.8229);
INSERT INTO `app_area` VALUES (441929, '虎门镇', 'Humen', 441900, 3, '0769', '523932', 113.711, 22.8262);
INSERT INTO `app_area` VALUES (441930, '厚街镇', 'Houjie', 441900, 3, '0769', '523960', 113.673, 22.9408);
INSERT INTO `app_area` VALUES (441931, '凤岗镇', 'Fenggang', 441900, 3, '0769', '523690', 114.141, 22.7446);
INSERT INTO `app_area` VALUES (441932, '长安镇', 'Chang\'an', 441900, 3, '0769', '523850', 113.804, 22.8166);
INSERT INTO `app_area` VALUES (442000, '中山市', 'Zhongshan', 440000, 2, '0760', '528403', 113.382, 22.5211);
INSERT INTO `app_area` VALUES (442001, '石岐区', 'Shiqi', 442000, 3, '0760', '528400', 113.379, 22.5252);
INSERT INTO `app_area` VALUES (442004, '南区', 'Nanqu', 442000, 3, '0760', '528400', 113.356, 22.4866);
INSERT INTO `app_area` VALUES (442005, '五桂山区', 'Wuguishan', 442000, 3, '0760', '528458', 113.411, 22.5197);
INSERT INTO `app_area` VALUES (442006, '火炬开发区', 'Huoju', 442000, 3, '0760', '528437', 113.481, 22.5661);
INSERT INTO `app_area` VALUES (442007, '黄圃镇', 'Huangpu', 442000, 3, '0760', '528429', 113.342, 22.7151);
INSERT INTO `app_area` VALUES (442008, '南头镇', 'Nantou', 442000, 3, '0760', '528421', 113.296, 22.7139);
INSERT INTO `app_area` VALUES (442009, '东凤镇', 'Dongfeng', 442000, 3, '0760', '528425', 113.261, 22.6877);
INSERT INTO `app_area` VALUES (442010, '阜沙镇', 'Fusha', 442000, 3, '0760', '528434', 113.353, 22.6664);
INSERT INTO `app_area` VALUES (442011, '小榄镇', 'Xiaolan', 442000, 3, '0760', '528415', 113.244, 22.667);
INSERT INTO `app_area` VALUES (442012, '东升镇', 'Dongsheng', 442000, 3, '0760', '528400', 113.296, 22.614);
INSERT INTO `app_area` VALUES (442013, '古镇镇', 'Guzhen', 442000, 3, '0760', '528422', 113.18, 22.611);
INSERT INTO `app_area` VALUES (442014, '横栏镇', 'Henglan', 442000, 3, '0760', '528478', 113.266, 22.5232);
INSERT INTO `app_area` VALUES (442015, '三角镇', 'Sanjiao', 442000, 3, '0760', '528422', 113.424, 22.677);
INSERT INTO `app_area` VALUES (442016, '民众镇', 'Minzhong', 442000, 3, '0760', '528441', 113.486, 22.6235);
INSERT INTO `app_area` VALUES (442017, '南朗镇', 'Nanlang', 442000, 3, '0760', '528454', 113.534, 22.4924);
INSERT INTO `app_area` VALUES (442018, '港口镇', 'Gangkou', 442000, 3, '0760', '528447', 113.382, 22.5211);
INSERT INTO `app_area` VALUES (442019, '大涌镇', 'Dayong', 442000, 3, '0760', '528476', 113.292, 22.4677);
INSERT INTO `app_area` VALUES (442020, '沙溪镇', 'Shaxi', 442000, 3, '0760', '528471', 113.328, 22.5263);
INSERT INTO `app_area` VALUES (442021, '三乡镇', 'Sanxiang', 442000, 3, '0760', '528463', 113.433, 22.3525);
INSERT INTO `app_area` VALUES (442022, '板芙镇', 'Banfu', 442000, 3, '0760', '528459', 113.32, 22.4157);
INSERT INTO `app_area` VALUES (442023, '神湾镇', 'Shenwan', 442000, 3, '0760', '528462', 113.359, 22.3125);
INSERT INTO `app_area` VALUES (442024, '坦洲镇', 'Tanzhou', 442000, 3, '0760', '528467', 113.486, 22.2613);
INSERT INTO `app_area` VALUES (445100, '潮州市', 'Chaozhou', 440000, 2, '0768', '521000', 116.632, 23.6617);
INSERT INTO `app_area` VALUES (445102, '湘桥区', 'Xiangqiao', 445100, 3, '0768', '521000', 116.628, 23.6745);
INSERT INTO `app_area` VALUES (445103, '潮安区', 'Chao\'an', 445100, 3, '0768', '515638', 116.593, 23.6437);
INSERT INTO `app_area` VALUES (445122, '饶平县', 'Raoping', 445100, 3, '0768', '515700', 117.007, 23.6699);
INSERT INTO `app_area` VALUES (445200, '揭阳市', 'Jieyang', 440000, 2, '0633', '522000', 116.356, 23.5438);
INSERT INTO `app_area` VALUES (445202, '榕城区', 'Rongcheng', 445200, 3, '0633', '522000', 116.367, 23.5251);
INSERT INTO `app_area` VALUES (445203, '揭东区', 'Jiedong', 445200, 3, '0633', '515500', 116.413, 23.5699);
INSERT INTO `app_area` VALUES (445222, '揭西县', 'Jiexi', 445200, 3, '0633', '515400', 115.839, 23.4271);
INSERT INTO `app_area` VALUES (445224, '惠来县', 'Huilai', 445200, 3, '0633', '515200', 116.296, 23.0329);
INSERT INTO `app_area` VALUES (445281, '普宁市', 'Puning', 445200, 3, '0633', '515300', 116.166, 23.2973);
INSERT INTO `app_area` VALUES (445300, '云浮市', 'Yunfu', 440000, 2, '0766', '527300', 112.044, 22.9298);
INSERT INTO `app_area` VALUES (445302, '云城区', 'Yuncheng', 445300, 3, '0766', '527300', 112.039, 22.93);
INSERT INTO `app_area` VALUES (445303, '云安区', 'Yun\'an', 445300, 3, '0766', '527500', 112.009, 23.0778);
INSERT INTO `app_area` VALUES (445321, '新兴县', 'Xinxing', 445300, 3, '0766', '527400', 112.23, 22.6973);
INSERT INTO `app_area` VALUES (445322, '郁南县', 'Yunan', 445300, 3, '0766', '527100', 111.534, 23.2331);
INSERT INTO `app_area` VALUES (445381, '罗定市', 'Luoding', 445300, 3, '0766', '527200', 111.57, 22.7697);
INSERT INTO `app_area` VALUES (450000, '广西壮族自治区', 'Guangxi', 100000, 1, '', '', 108.32, 22.824);
INSERT INTO `app_area` VALUES (450100, '南宁市', 'Nanning', 450000, 2, '0771', '530028', 108.32, 22.824);
INSERT INTO `app_area` VALUES (450102, '兴宁区', 'Xingning', 450100, 3, '0771', '530023', 108.367, 22.8535);
INSERT INTO `app_area` VALUES (450103, '青秀区', 'Qingxiu', 450100, 3, '0771', '530213', 108.495, 22.7851);
INSERT INTO `app_area` VALUES (450105, '江南区', 'Jiangnan', 450100, 3, '0771', '530031', 108.273, 22.7813);
INSERT INTO `app_area` VALUES (450107, '西乡塘区', 'Xixiangtang', 450100, 3, '0771', '530001', 108.313, 22.8339);
INSERT INTO `app_area` VALUES (450108, '良庆区', 'Liangqing', 450100, 3, '0771', '530219', 108.413, 22.7491);
INSERT INTO `app_area` VALUES (450109, '邕宁区', 'Yongning', 450100, 3, '0771', '530200', 108.487, 22.7563);
INSERT INTO `app_area` VALUES (450122, '武鸣县', 'Wuming', 450100, 3, '0771', '530100', 108.277, 23.1564);
INSERT INTO `app_area` VALUES (450123, '隆安县', 'Long\'an', 450100, 3, '0771', '532700', 107.692, 23.1734);
INSERT INTO `app_area` VALUES (450124, '马山县', 'Mashan', 450100, 3, '0771', '530600', 108.177, 23.7093);
INSERT INTO `app_area` VALUES (450125, '上林县', 'Shanglin', 450100, 3, '0771', '530500', 108.605, 23.432);
INSERT INTO `app_area` VALUES (450126, '宾阳县', 'Binyang', 450100, 3, '0771', '530400', 108.812, 23.2196);
INSERT INTO `app_area` VALUES (450127, '横县', 'Hengxian', 450100, 3, '0771', '530300', 109.266, 22.6845);
INSERT INTO `app_area` VALUES (450128, '埌东新区', 'Langdong', 450100, 3, '0771', '530000', 108.419, 22.813);
INSERT INTO `app_area` VALUES (450200, '柳州市', 'Liuzhou', 450000, 2, '0772', '545001', 109.412, 24.3146);
INSERT INTO `app_area` VALUES (450202, '城中区', 'Chengzhong', 450200, 3, '0772', '545001', 109.411, 24.3154);
INSERT INTO `app_area` VALUES (450203, '鱼峰区', 'Yufeng', 450200, 3, '0772', '545005', 109.453, 24.3187);
INSERT INTO `app_area` VALUES (450204, '柳南区', 'Liunan', 450200, 3, '0772', '545007', 109.385, 24.336);
INSERT INTO `app_area` VALUES (450205, '柳北区', 'Liubei', 450200, 3, '0772', '545002', 109.402, 24.3627);
INSERT INTO `app_area` VALUES (450221, '柳江县', 'Liujiang', 450200, 3, '0772', '545100', 109.333, 24.256);
INSERT INTO `app_area` VALUES (450222, '柳城县', 'Liucheng', 450200, 3, '0772', '545200', 109.239, 24.6495);
INSERT INTO `app_area` VALUES (450223, '鹿寨县', 'Luzhai', 450200, 3, '0772', '545600', 109.752, 24.4731);
INSERT INTO `app_area` VALUES (450224, '融安县', 'Rong\'an', 450200, 3, '0772', '545400', 109.398, 25.2246);
INSERT INTO `app_area` VALUES (450225, '融水苗族自治县', 'Rongshui', 450200, 3, '0772', '545300', 109.256, 25.0663);
INSERT INTO `app_area` VALUES (450226, '三江侗族自治县', 'Sanjiang', 450200, 3, '0772', '545500', 109.604, 25.7843);
INSERT INTO `app_area` VALUES (450227, '柳东新区', 'Liudong', 450200, 3, '0772', '545000', 109.437, 24.3292);
INSERT INTO `app_area` VALUES (450300, '桂林市', 'Guilin', 450000, 2, '0773', '541100', 110.299, 25.2742);
INSERT INTO `app_area` VALUES (450302, '秀峰区', 'Xiufeng', 450300, 3, '0773', '541001', 110.289, 25.2825);
INSERT INTO `app_area` VALUES (450303, '叠彩区', 'Diecai', 450300, 3, '0773', '541001', 110.302, 25.3138);
INSERT INTO `app_area` VALUES (450304, '象山区', 'Xiangshan', 450300, 3, '0773', '541002', 110.281, 25.2617);
INSERT INTO `app_area` VALUES (450305, '七星区', 'Qixing', 450300, 3, '0773', '541004', 110.318, 25.2525);
INSERT INTO `app_area` VALUES (450311, '雁山区', 'Yanshan', 450300, 3, '0773', '541006', 110.309, 25.0604);
INSERT INTO `app_area` VALUES (450312, '临桂区', 'Lingui', 450300, 3, '0773', '541100', 110.205, 25.2463);
INSERT INTO `app_area` VALUES (450321, '阳朔县', 'Yangshuo', 450300, 3, '0773', '541900', 110.495, 24.7758);
INSERT INTO `app_area` VALUES (450323, '灵川县', 'Lingchuan', 450300, 3, '0773', '541200', 110.329, 25.4129);
INSERT INTO `app_area` VALUES (450324, '全州县', 'Quanzhou', 450300, 3, '0773', '541503', 111.072, 25.928);
INSERT INTO `app_area` VALUES (450325, '兴安县', 'Xing\'an', 450300, 3, '0773', '541300', 110.671, 25.6117);
INSERT INTO `app_area` VALUES (450326, '永福县', 'Yongfu', 450300, 3, '0773', '541800', 109.983, 24.98);
INSERT INTO `app_area` VALUES (450327, '灌阳县', 'Guanyang', 450300, 3, '0773', '541600', 111.16, 25.488);
INSERT INTO `app_area` VALUES (450328, '龙胜各族自治县', 'Longsheng', 450300, 3, '0773', '541700', 110.012, 25.7961);
INSERT INTO `app_area` VALUES (450329, '资源县', 'Ziyuan', 450300, 3, '0773', '541400', 110.653, 26.0424);
INSERT INTO `app_area` VALUES (450330, '平乐县', 'Pingle', 450300, 3, '0773', '542400', 110.642, 24.6324);
INSERT INTO `app_area` VALUES (450331, '荔浦县', 'Lipu', 450300, 3, '0773', '546600', 110.397, 24.4959);
INSERT INTO `app_area` VALUES (450332, '恭城瑶族自治县', 'Gongcheng', 450300, 3, '0773', '542500', 110.83, 24.8329);
INSERT INTO `app_area` VALUES (450400, '梧州市', 'Wuzhou', 450000, 2, '0774', '543002', 111.316, 23.4723);
INSERT INTO `app_area` VALUES (450403, '万秀区', 'Wanxiu', 450400, 3, '0774', '543000', 111.321, 23.473);
INSERT INTO `app_area` VALUES (450405, '长洲区', 'Changzhou', 450400, 3, '0774', '543003', 111.275, 23.4857);
INSERT INTO `app_area` VALUES (450406, '龙圩区', 'Longxu', 450400, 3, '0774', '543002', 111.316, 23.4723);
INSERT INTO `app_area` VALUES (450421, '苍梧县', 'Cangwu', 450400, 3, '0774', '543100', 111.245, 23.4205);
INSERT INTO `app_area` VALUES (450422, '藤县', 'Tengxian', 450400, 3, '0774', '543300', 110.914, 23.3761);
INSERT INTO `app_area` VALUES (450423, '蒙山县', 'Mengshan', 450400, 3, '0774', '546700', 110.522, 24.2017);
INSERT INTO `app_area` VALUES (450481, '岑溪市', 'Cenxi', 450400, 3, '0774', '543200', 110.996, 22.9191);
INSERT INTO `app_area` VALUES (450500, '北海市', 'Beihai', 450000, 2, '0779', '536000', 109.119, 21.4733);
INSERT INTO `app_area` VALUES (450502, '海城区', 'Haicheng', 450500, 3, '0779', '536000', 109.117, 21.475);
INSERT INTO `app_area` VALUES (450503, '银海区', 'Yinhai', 450500, 3, '0779', '536000', 109.13, 21.4783);
INSERT INTO `app_area` VALUES (450512, '铁山港区', 'Tieshangang', 450500, 3, '0779', '536017', 109.456, 21.5966);
INSERT INTO `app_area` VALUES (450521, '合浦县', 'Hepu', 450500, 3, '0779', '536100', 109.201, 21.666);
INSERT INTO `app_area` VALUES (450600, '防城港市', 'Fangchenggang', 450000, 2, '0770', '538001', 108.345, 21.6146);
INSERT INTO `app_area` VALUES (450602, '港口区', 'Gangkou', 450600, 3, '0770', '538001', 108.38, 21.6434);
INSERT INTO `app_area` VALUES (450603, '防城区', 'Fangcheng', 450600, 3, '0770', '538021', 108.357, 21.7646);
INSERT INTO `app_area` VALUES (450621, '上思县', 'Shangsi', 450600, 3, '0770', '535500', 107.982, 22.1496);
INSERT INTO `app_area` VALUES (450681, '东兴市', 'Dongxing', 450600, 3, '0770', '538100', 107.972, 21.5471);
INSERT INTO `app_area` VALUES (450700, '钦州市', 'Qinzhou', 450000, 2, '0777', '535099', 108.624, 21.9671);
INSERT INTO `app_area` VALUES (450702, '钦南区', 'Qinnan', 450700, 3, '0777', '535099', 108.618, 21.9514);
INSERT INTO `app_area` VALUES (450703, '钦北区', 'Qinbei', 450700, 3, '0777', '535099', 108.63, 21.9513);
INSERT INTO `app_area` VALUES (450721, '灵山县', 'Lingshan', 450700, 3, '0777', '535099', 109.292, 22.4165);
INSERT INTO `app_area` VALUES (450722, '浦北县', 'Pubei', 450700, 3, '0777', '535099', 109.556, 22.2689);
INSERT INTO `app_area` VALUES (450800, '贵港市', 'Guigang', 450000, 2, '0775', '537100', 109.602, 23.0936);
INSERT INTO `app_area` VALUES (450802, '港北区', 'Gangbei', 450800, 3, '0775', '537100', 109.572, 23.1115);
INSERT INTO `app_area` VALUES (450803, '港南区', 'Gangnan', 450800, 3, '0775', '537100', 109.606, 23.0723);
INSERT INTO `app_area` VALUES (450804, '覃塘区', 'Qintang', 450800, 3, '0775', '537121', 109.443, 23.1268);
INSERT INTO `app_area` VALUES (450821, '平南县', 'Pingnan', 450800, 3, '0775', '537300', 110.391, 23.542);
INSERT INTO `app_area` VALUES (450881, '桂平市', 'Guiping', 450800, 3, '0775', '537200', 110.081, 23.3934);
INSERT INTO `app_area` VALUES (450900, '玉林市', 'Yulin', 450000, 2, '0775', '537000', 110.154, 22.6314);
INSERT INTO `app_area` VALUES (450902, '玉州区', 'Yuzhou', 450900, 3, '0775', '537000', 110.151, 22.6281);
INSERT INTO `app_area` VALUES (450903, '福绵区', 'Fumian', 450900, 3, '0775', '537023', 110.065, 22.5831);
INSERT INTO `app_area` VALUES (450904, '玉东新区', 'Yudong', 450900, 3, '0775', '537000', 110.154, 22.6314);
INSERT INTO `app_area` VALUES (450921, '容县', 'Rongxian', 450900, 3, '0775', '537500', 110.556, 22.857);
INSERT INTO `app_area` VALUES (450922, '陆川县', 'Luchuan', 450900, 3, '0775', '537700', 110.264, 22.3245);
INSERT INTO `app_area` VALUES (450923, '博白县', 'Bobai', 450900, 3, '0775', '537600', 109.977, 22.2729);
INSERT INTO `app_area` VALUES (450924, '兴业县', 'Xingye', 450900, 3, '0775', '537800', 109.876, 22.7424);
INSERT INTO `app_area` VALUES (450981, '北流市', 'Beiliu', 450900, 3, '0775', '537400', 110.353, 22.7082);
INSERT INTO `app_area` VALUES (451000, '百色市', 'Baise', 450000, 2, '0776', '533000', 106.616, 23.8977);
INSERT INTO `app_area` VALUES (451002, '右江区', 'Youjiang', 451000, 3, '0776', '533000', 106.618, 23.9009);
INSERT INTO `app_area` VALUES (451021, '田阳县', 'Tianyang', 451000, 3, '0776', '533600', 106.916, 23.7353);
INSERT INTO `app_area` VALUES (451022, '田东县', 'Tiandong', 451000, 3, '0776', '531500', 107.124, 23.6);
INSERT INTO `app_area` VALUES (451023, '平果县', 'Pingguo', 451000, 3, '0776', '531400', 107.59, 23.3297);
INSERT INTO `app_area` VALUES (451024, '德保县', 'Debao', 451000, 3, '0776', '533700', 106.619, 23.3251);
INSERT INTO `app_area` VALUES (451025, '靖西县', 'Jingxi', 451000, 3, '0776', '533800', 106.418, 23.1343);
INSERT INTO `app_area` VALUES (451026, '那坡县', 'Napo', 451000, 3, '0776', '533900', 105.842, 23.4065);
INSERT INTO `app_area` VALUES (451027, '凌云县', 'Lingyun', 451000, 3, '0776', '533100', 106.562, 24.3475);
INSERT INTO `app_area` VALUES (451028, '乐业县', 'Leye', 451000, 3, '0776', '533200', 106.561, 24.7829);
INSERT INTO `app_area` VALUES (451029, '田林县', 'Tianlin', 451000, 3, '0776', '533300', 106.229, 24.2921);
INSERT INTO `app_area` VALUES (451030, '西林县', 'Xilin', 451000, 3, '0776', '533500', 105.097, 24.4897);
INSERT INTO `app_area` VALUES (451031, '隆林各族自治县', 'Longlin', 451000, 3, '0776', '533400', 105.343, 24.7704);
INSERT INTO `app_area` VALUES (451100, '贺州市', 'Hezhou', 450000, 2, '0774', '542800', 111.552, 24.4141);
INSERT INTO `app_area` VALUES (451102, '八步区', 'Babu', 451100, 3, '0774', '542800', 111.552, 24.4118);
INSERT INTO `app_area` VALUES (451121, '昭平县', 'Zhaoping', 451100, 3, '0774', '546800', 110.811, 24.1701);
INSERT INTO `app_area` VALUES (451122, '钟山县', 'Zhongshan', 451100, 3, '0774', '542600', 111.305, 24.5248);
INSERT INTO `app_area` VALUES (451123, '富川瑶族自治县', 'Fuchuan', 451100, 3, '0774', '542700', 111.278, 24.8143);
INSERT INTO `app_area` VALUES (451124, '平桂管理区', 'Pingui', 451100, 3, '0774', '542800', 111.486, 24.458);
INSERT INTO `app_area` VALUES (451200, '河池市', 'Hechi', 450000, 2, '0778', '547000', 108.062, 24.6959);
INSERT INTO `app_area` VALUES (451202, '金城江区', 'Jinchengjiang', 451200, 3, '0779', '547000', 108.037, 24.6897);
INSERT INTO `app_area` VALUES (451221, '南丹县', 'Nandan', 451200, 3, '0781', '547200', 107.546, 24.9776);
INSERT INTO `app_area` VALUES (451222, '天峨县', 'Tiane', 451200, 3, '0782', '547300', 107.172, 24.9959);
INSERT INTO `app_area` VALUES (451223, '凤山县', 'Fengshan', 451200, 3, '0783', '547600', 107.049, 24.5422);
INSERT INTO `app_area` VALUES (451224, '东兰县', 'Donglan', 451200, 3, '0784', '547400', 107.375, 24.5105);
INSERT INTO `app_area` VALUES (451225, '罗城仫佬族自治县', 'Luocheng', 451200, 3, '0785', '546400', 108.908, 24.7792);
INSERT INTO `app_area` VALUES (451226, '环江毛南族自治县', 'Huanjiang', 451200, 3, '0786', '547100', 108.261, 24.8292);
INSERT INTO `app_area` VALUES (451227, '巴马瑶族自治县', 'Bama', 451200, 3, '0787', '547500', 107.253, 24.1413);
INSERT INTO `app_area` VALUES (451228, '都安瑶族自治县', 'Du\'an', 451200, 3, '0788', '530700', 108.101, 23.9324);
INSERT INTO `app_area` VALUES (451229, '大化瑶族自治县', 'Dahua', 451200, 3, '0789', '530800', 107.998, 23.7449);
INSERT INTO `app_area` VALUES (451281, '宜州市', 'Yizhou', 451200, 3, '0780', '546300', 108.653, 24.4939);
INSERT INTO `app_area` VALUES (451300, '来宾市', 'Laibin', 450000, 2, '0772', '546100', 109.23, 23.7338);
INSERT INTO `app_area` VALUES (451302, '兴宾区', 'Xingbin', 451300, 3, '0772', '546100', 109.235, 23.7273);
INSERT INTO `app_area` VALUES (451321, '忻城县', 'Xincheng', 451300, 3, '0772', '546200', 108.664, 24.0686);
INSERT INTO `app_area` VALUES (451322, '象州县', 'Xiangzhou', 451300, 3, '0772', '545800', 109.699, 23.9736);
INSERT INTO `app_area` VALUES (451323, '武宣县', 'Wuxuan', 451300, 3, '0772', '545900', 109.663, 23.5947);
INSERT INTO `app_area` VALUES (451324, '金秀瑶族自治县', 'Jinxiu', 451300, 3, '0772', '545799', 110.191, 24.1293);
INSERT INTO `app_area` VALUES (451381, '合山市', 'Heshan', 451300, 3, '0772', '546500', 108.886, 23.8062);
INSERT INTO `app_area` VALUES (451400, '崇左市', 'Chongzuo', 450000, 2, '0771', '532299', 107.354, 22.4041);
INSERT INTO `app_area` VALUES (451402, '江州区', 'Jiangzhou', 451400, 3, '0771', '532299', 107.347, 22.4114);
INSERT INTO `app_area` VALUES (451421, '扶绥县', 'Fusui', 451400, 3, '0771', '532199', 107.904, 22.6341);
INSERT INTO `app_area` VALUES (451422, '宁明县', 'Ningming', 451400, 3, '0771', '532599', 107.073, 22.1366);
INSERT INTO `app_area` VALUES (451423, '龙州县', 'Longzhou', 451400, 3, '0771', '532499', 106.854, 22.3394);
INSERT INTO `app_area` VALUES (451424, '大新县', 'Daxin', 451400, 3, '0771', '532399', 107.198, 22.8341);
INSERT INTO `app_area` VALUES (451425, '天等县', 'Tiandeng', 451400, 3, '0771', '532899', 107.14, 23.077);
INSERT INTO `app_area` VALUES (451481, '凭祥市', 'Pingxiang', 451400, 3, '0771', '532699', 106.755, 22.1057);
INSERT INTO `app_area` VALUES (460000, '海南省', 'Hainan', 100000, 1, '', '', 110.331, 20.032);
INSERT INTO `app_area` VALUES (460100, '海口市', 'Haikou', 460000, 2, '0898', '570000', 110.331, 20.032);
INSERT INTO `app_area` VALUES (460105, '秀英区', 'Xiuying', 460100, 3, '0898', '570311', 110.293, 20.0075);
INSERT INTO `app_area` VALUES (460106, '龙华区', 'Longhua', 460100, 3, '0898', '570145', 110.302, 20.0287);
INSERT INTO `app_area` VALUES (460107, '琼山区', 'Qiongshan', 460100, 3, '0898', '571100', 110.354, 20.0032);
INSERT INTO `app_area` VALUES (460108, '美兰区', 'Meilan', 460100, 3, '0898', '570203', 110.369, 20.0286);
INSERT INTO `app_area` VALUES (460200, '三亚市', 'Sanya', 460000, 2, '0898', '572000', 109.508, 18.2479);
INSERT INTO `app_area` VALUES (460202, '海棠区', 'Haitang', 460200, 3, '0898', '572000', 109.508, 18.2479);
INSERT INTO `app_area` VALUES (460203, '吉阳区', 'Jiyang', 460200, 3, '0898', '572000', 109.508, 18.2479);
INSERT INTO `app_area` VALUES (460204, '天涯区', 'Tianya', 460200, 3, '0898', '572000', 109.508, 18.2479);
INSERT INTO `app_area` VALUES (460205, '崖州区', 'Yazhou', 460200, 3, '0898', '572000', 109.508, 18.2479);
INSERT INTO `app_area` VALUES (460300, '三沙市', 'Sansha', 460000, 2, '0898', '573199', 112.349, 16.831);
INSERT INTO `app_area` VALUES (460321, '西沙群岛', 'Xisha Islands', 460300, 3, '0898', '572000', 112.026, 16.3313);
INSERT INTO `app_area` VALUES (460322, '南沙群岛', 'Nansha Islands', 460300, 3, '0898', '573100', 116.75, 11.4719);
INSERT INTO `app_area` VALUES (460323, '中沙群岛', 'Zhongsha Islands', 460300, 3, '0898', '573100', 117.74, 15.1129);
INSERT INTO `app_area` VALUES (469000, '直辖县级', '', 460000, 2, '', '', 109.503, 18.7399);
INSERT INTO `app_area` VALUES (469001, '五指山市', 'Wuzhishan', 469000, 3, '0898', '572200', 109.517, 18.7769);
INSERT INTO `app_area` VALUES (469002, '琼海市', 'Qionghai', 469000, 3, '0898', '571400', 110.467, 19.246);
INSERT INTO `app_area` VALUES (469003, '儋州市', 'Danzhou', 469000, 3, '0898', '571700', 109.577, 19.5175);
INSERT INTO `app_area` VALUES (469005, '文昌市', 'Wenchang', 469000, 3, '0898', '571339', 110.754, 19.613);
INSERT INTO `app_area` VALUES (469006, '万宁市', 'Wanning', 469000, 3, '0898', '571500', 110.389, 18.7962);
INSERT INTO `app_area` VALUES (469007, '东方市', 'Dongfang', 469000, 3, '0898', '572600', 108.654, 19.102);
INSERT INTO `app_area` VALUES (469021, '定安县', 'Ding\'an', 469000, 3, '0898', '571200', 110.324, 19.6992);
INSERT INTO `app_area` VALUES (469022, '屯昌县', 'Tunchang', 469000, 3, '0898', '571600', 110.103, 19.3629);
INSERT INTO `app_area` VALUES (469023, '澄迈县', 'Chengmai', 469000, 3, '0898', '571900', 110.007, 19.7371);
INSERT INTO `app_area` VALUES (469024, '临高县', 'Lingao', 469000, 3, '0898', '571800', 109.688, 19.9083);
INSERT INTO `app_area` VALUES (469025, '白沙黎族自治县', 'Baisha', 469000, 3, '0898', '572800', 109.453, 19.2246);
INSERT INTO `app_area` VALUES (469026, '昌江黎族自治县', 'Changjiang', 469000, 3, '0898', '572700', 109.053, 19.261);
INSERT INTO `app_area` VALUES (469027, '乐东黎族自治县', 'Ledong', 469000, 3, '0898', '572500', 109.175, 18.7476);
INSERT INTO `app_area` VALUES (469028, '陵水黎族自治县', 'Lingshui', 469000, 3, '0898', '572400', 110.037, 18.505);
INSERT INTO `app_area` VALUES (469029, '保亭黎族苗族自治县', 'Baoting', 469000, 3, '0898', '572300', 109.702, 18.6364);
INSERT INTO `app_area` VALUES (469030, '琼中黎族苗族自治县', 'Qiongzhong', 469000, 3, '0898', '572900', 109.84, 19.0356);
INSERT INTO `app_area` VALUES (500000, '重庆', 'Chongqing', 100000, 1, '', '', 106.505, 29.5332);
INSERT INTO `app_area` VALUES (500100, '重庆市', 'Chongqing', 500000, 2, '023', '400000', 106.505, 29.5332);
INSERT INTO `app_area` VALUES (500101, '万州区', 'Wanzhou', 500100, 3, '023', '404000', 108.409, 30.8079);
INSERT INTO `app_area` VALUES (500102, '涪陵区', 'Fuling', 500100, 3, '023', '408000', 107.39, 29.7029);
INSERT INTO `app_area` VALUES (500103, '渝中区', 'Yuzhong', 500100, 3, '023', '400010', 106.569, 29.5528);
INSERT INTO `app_area` VALUES (500104, '大渡口区', 'Dadukou', 500100, 3, '023', '400080', 106.483, 29.4845);
INSERT INTO `app_area` VALUES (500105, '江北区', 'Jiangbei', 500100, 3, '023', '400020', 106.574, 29.6066);
INSERT INTO `app_area` VALUES (500106, '沙坪坝区', 'Shapingba', 500100, 3, '023', '400030', 106.458, 29.5411);
INSERT INTO `app_area` VALUES (500107, '九龙坡区', 'Jiulongpo', 500100, 3, '023', '400050', 106.511, 29.502);
INSERT INTO `app_area` VALUES (500108, '南岸区', 'Nan\'an', 500100, 3, '023', '400064', 106.563, 29.5231);
INSERT INTO `app_area` VALUES (500109, '北碚区', 'Beibei', 500100, 3, '023', '400700', 106.396, 29.8057);
INSERT INTO `app_area` VALUES (500110, '綦江区', 'Qijiang', 500100, 3, '023', '400800', 106.927, 28.9607);
INSERT INTO `app_area` VALUES (500111, '大足区', 'Dazu', 500100, 3, '023', '400900', 105.768, 29.484);
INSERT INTO `app_area` VALUES (500112, '渝北区', 'Yubei', 500100, 3, '023', '401120', 106.631, 29.7182);
INSERT INTO `app_area` VALUES (500113, '巴南区', 'Banan', 500100, 3, '023', '401320', 106.524, 29.3831);
INSERT INTO `app_area` VALUES (500114, '黔江区', 'Qianjiang', 500100, 3, '023', '409700', 108.771, 29.5332);
INSERT INTO `app_area` VALUES (500115, '长寿区', 'Changshou', 500100, 3, '023', '401220', 107.082, 29.8536);
INSERT INTO `app_area` VALUES (500116, '江津区', 'Jiangjin', 500100, 3, '023', '402260', 106.259, 29.2901);
INSERT INTO `app_area` VALUES (500117, '合川区', 'Hechuan', 500100, 3, '023', '401520', 106.276, 29.9723);
INSERT INTO `app_area` VALUES (500118, '永川区', 'Yongchuan', 500100, 3, '023', '402160', 105.927, 29.3559);
INSERT INTO `app_area` VALUES (500119, '南川区', 'Nanchuan', 500100, 3, '023', '408400', 107.099, 29.1575);
INSERT INTO `app_area` VALUES (500120, '璧山区', 'Bishan', 500100, 3, '023', '402760', 106.231, 29.5936);
INSERT INTO `app_area` VALUES (500151, '铜梁区', 'Tongliang', 500100, 3, '023', '402560', 106.055, 29.8399);
INSERT INTO `app_area` VALUES (500223, '潼南县', 'Tongnan', 500100, 3, '023', '402660', 105.84, 30.1912);
INSERT INTO `app_area` VALUES (500226, '荣昌县', 'Rongchang', 500100, 3, '023', '402460', 105.594, 29.4049);
INSERT INTO `app_area` VALUES (500228, '梁平县', 'Liangping', 500100, 3, '023', '405200', 107.8, 30.6754);
INSERT INTO `app_area` VALUES (500229, '城口县', 'Chengkou', 500100, 3, '023', '405900', 108.665, 31.948);
INSERT INTO `app_area` VALUES (500230, '丰都县', 'Fengdu', 500100, 3, '023', '408200', 107.731, 29.8635);
INSERT INTO `app_area` VALUES (500231, '垫江县', 'Dianjiang', 500100, 3, '023', '408300', 107.354, 30.3336);
INSERT INTO `app_area` VALUES (500232, '武隆县', 'Wulong', 500100, 3, '023', '408500', 107.76, 29.3255);
INSERT INTO `app_area` VALUES (500233, '忠县', 'Zhongxian', 500100, 3, '023', '404300', 108.037, 30.289);
INSERT INTO `app_area` VALUES (500234, '开县', 'Kaixian', 500100, 3, '023', '405400', 108.393, 31.1609);
INSERT INTO `app_area` VALUES (500235, '云阳县', 'Yunyang', 500100, 3, '023', '404500', 108.697, 30.9306);
INSERT INTO `app_area` VALUES (500236, '奉节县', 'Fengjie', 500100, 3, '023', '404600', 109.465, 31.0182);
INSERT INTO `app_area` VALUES (500237, '巫山县', 'Wushan', 500100, 3, '023', '404700', 109.878, 31.0746);
INSERT INTO `app_area` VALUES (500238, '巫溪县', 'Wuxi', 500100, 3, '023', '405800', 109.631, 31.3976);
INSERT INTO `app_area` VALUES (500240, '石柱土家族自治县', 'Shizhu', 500100, 3, '023', '409100', 108.114, 30.0005);
INSERT INTO `app_area` VALUES (500241, '秀山土家族苗族自治县', 'Xiushan', 500100, 3, '023', '409900', 108.989, 28.4506);
INSERT INTO `app_area` VALUES (500242, '酉阳土家族苗族自治县', 'Youyang', 500100, 3, '023', '409800', 108.772, 28.8446);
INSERT INTO `app_area` VALUES (500243, '彭水苗族土家族自治县', 'Pengshui', 500100, 3, '023', '409600', 108.166, 29.2952);
INSERT INTO `app_area` VALUES (500300, '两江新区', 'Liangjiangxinqu', 500000, 2, '023', '400000', 106.463, 29.7292);
INSERT INTO `app_area` VALUES (500301, '北部新区', 'Beibuxinqu', 500300, 3, '023', '400000', 106.489, 29.6671);
INSERT INTO `app_area` VALUES (500302, '保税港区', 'Baoshuigangqu', 500300, 3, '023', '400000', 106.638, 29.7163);
INSERT INTO `app_area` VALUES (500303, '工业园区', 'Gongyeyuanqu', 500300, 3, '023', '400000', 106.626, 29.5555);
INSERT INTO `app_area` VALUES (510000, '四川省', 'Sichuan', 100000, 1, '', '', 104.066, 30.6595);
INSERT INTO `app_area` VALUES (510100, '成都市', 'Chengdu', 510000, 2, '028', '610015', 104.066, 30.6595);
INSERT INTO `app_area` VALUES (510104, '锦江区', 'Jinjiang', 510100, 3, '028', '610021', 104.083, 30.6561);
INSERT INTO `app_area` VALUES (510105, '青羊区', 'Qingyang', 510100, 3, '028', '610031', 104.062, 30.6739);
INSERT INTO `app_area` VALUES (510106, '金牛区', 'Jinniu', 510100, 3, '028', '610036', 104.051, 30.6913);
INSERT INTO `app_area` VALUES (510107, '武侯区', 'Wuhou', 510100, 3, '028', '610041', 104.043, 30.6423);
INSERT INTO `app_area` VALUES (510108, '成华区', 'Chenghua', 510100, 3, '028', '610066', 104.102, 30.6599);
INSERT INTO `app_area` VALUES (510112, '龙泉驿区', 'Longquanyi', 510100, 3, '028', '610100', 104.275, 30.5566);
INSERT INTO `app_area` VALUES (510113, '青白江区', 'Qingbaijiang', 510100, 3, '028', '610300', 104.251, 30.8784);
INSERT INTO `app_area` VALUES (510114, '新都区', 'Xindu', 510100, 3, '028', '610500', 104.159, 30.8231);
INSERT INTO `app_area` VALUES (510115, '温江区', 'Wenjiang', 510100, 3, '028', '611130', 103.849, 30.6844);
INSERT INTO `app_area` VALUES (510121, '金堂县', 'Jintang', 510100, 3, '028', '610400', 104.412, 30.8619);
INSERT INTO `app_area` VALUES (510122, '双流县', 'Shuangliu', 510100, 3, '028', '610200', 103.924, 30.5744);
INSERT INTO `app_area` VALUES (510124, '郫县', 'Pixian', 510100, 3, '028', '611730', 103.887, 30.8105);
INSERT INTO `app_area` VALUES (510129, '大邑县', 'Dayi', 510100, 3, '028', '611330', 103.521, 30.5874);
INSERT INTO `app_area` VALUES (510131, '蒲江县', 'Pujiang', 510100, 3, '028', '611630', 103.506, 30.1967);
INSERT INTO `app_area` VALUES (510132, '新津县', 'Xinjin', 510100, 3, '028', '611430', 103.811, 30.4098);
INSERT INTO `app_area` VALUES (510181, '都江堰市', 'Dujiangyan', 510100, 3, '028', '611830', 103.619, 30.9982);
INSERT INTO `app_area` VALUES (510182, '彭州市', 'Pengzhou', 510100, 3, '028', '611930', 103.958, 30.9901);
INSERT INTO `app_area` VALUES (510183, '邛崃市', 'Qionglai', 510100, 3, '028', '611530', 103.463, 30.4149);
INSERT INTO `app_area` VALUES (510184, '崇州市', 'Chongzhou', 510100, 3, '028', '611230', 103.673, 30.6301);
INSERT INTO `app_area` VALUES (510300, '自贡市', 'Zigong', 510000, 2, '0813', '643000', 104.773, 29.3528);
INSERT INTO `app_area` VALUES (510302, '自流井区', 'Ziliujing', 510300, 3, '0813', '643000', 104.777, 29.3375);
INSERT INTO `app_area` VALUES (510303, '贡井区', 'Gongjing', 510300, 3, '0813', '643020', 104.715, 29.3458);
INSERT INTO `app_area` VALUES (510304, '大安区', 'Da\'an', 510300, 3, '0813', '643010', 104.774, 29.3636);
INSERT INTO `app_area` VALUES (510311, '沿滩区', 'Yantan', 510300, 3, '0813', '643030', 104.88, 29.2661);
INSERT INTO `app_area` VALUES (510321, '荣县', 'Rongxian', 510300, 3, '0813', '643100', 104.418, 29.4445);
INSERT INTO `app_area` VALUES (510322, '富顺县', 'Fushun', 510300, 3, '0813', '643200', 104.975, 29.1812);
INSERT INTO `app_area` VALUES (510400, '攀枝花市', 'Panzhihua', 510000, 2, '0812', '617000', 101.716, 26.5804);
INSERT INTO `app_area` VALUES (510402, '东区', 'Dongqu', 510400, 3, '0812', '617067', 101.705, 26.5468);
INSERT INTO `app_area` VALUES (510403, '西区', 'Xiqu', 510400, 3, '0812', '617068', 101.631, 26.5975);
INSERT INTO `app_area` VALUES (510411, '仁和区', 'Renhe', 510400, 3, '0812', '617061', 101.738, 26.4984);
INSERT INTO `app_area` VALUES (510421, '米易县', 'Miyi', 510400, 3, '0812', '617200', 102.111, 26.8872);
INSERT INTO `app_area` VALUES (510422, '盐边县', 'Yanbian', 510400, 3, '0812', '617100', 101.854, 26.6885);
INSERT INTO `app_area` VALUES (510500, '泸州市', 'Luzhou', 510000, 2, '0830', '646000', 105.443, 28.8891);
INSERT INTO `app_area` VALUES (510502, '江阳区', 'Jiangyang', 510500, 3, '0830', '646000', 105.453, 28.8893);
INSERT INTO `app_area` VALUES (510503, '纳溪区', 'Naxi', 510500, 3, '0830', '646300', 105.373, 28.7734);
INSERT INTO `app_area` VALUES (510504, '龙马潭区', 'Longmatan', 510500, 3, '0830', '646000', 105.438, 28.9131);
INSERT INTO `app_area` VALUES (510521, '泸县', 'Luxian', 510500, 3, '0830', '646106', 105.382, 29.1504);
INSERT INTO `app_area` VALUES (510522, '合江县', 'Hejiang', 510500, 3, '0830', '646200', 105.835, 28.81);
INSERT INTO `app_area` VALUES (510524, '叙永县', 'Xuyong', 510500, 3, '0830', '646400', 105.445, 28.1559);
INSERT INTO `app_area` VALUES (510525, '古蔺县', 'Gulin', 510500, 3, '0830', '646500', 105.813, 28.0387);
INSERT INTO `app_area` VALUES (510600, '德阳市', 'Deyang', 510000, 2, '0838', '618000', 104.399, 31.128);
INSERT INTO `app_area` VALUES (510603, '旌阳区', 'Jingyang', 510600, 3, '0838', '618000', 104.394, 31.1391);
INSERT INTO `app_area` VALUES (510623, '中江县', 'Zhongjiang', 510600, 3, '0838', '618100', 104.679, 31.033);
INSERT INTO `app_area` VALUES (510626, '罗江县', 'Luojiang', 510600, 3, '0838', '618500', 104.51, 31.3167);
INSERT INTO `app_area` VALUES (510681, '广汉市', 'Guanghan', 510600, 3, '0838', '618300', 104.282, 30.9769);
INSERT INTO `app_area` VALUES (510682, '什邡市', 'Shifang', 510600, 3, '0838', '618400', 104.168, 31.1264);
INSERT INTO `app_area` VALUES (510683, '绵竹市', 'Mianzhu', 510600, 3, '0838', '618200', 104.221, 31.3377);
INSERT INTO `app_area` VALUES (510700, '绵阳市', 'Mianyang', 510000, 2, '0816', '621000', 104.742, 31.464);
INSERT INTO `app_area` VALUES (510703, '涪城区', 'Fucheng', 510700, 3, '0816', '621000', 104.757, 31.4552);
INSERT INTO `app_area` VALUES (510704, '游仙区', 'Youxian', 510700, 3, '0816', '621022', 104.771, 31.4657);
INSERT INTO `app_area` VALUES (510722, '三台县', 'Santai', 510700, 3, '0816', '621100', 105.091, 31.0918);
INSERT INTO `app_area` VALUES (510723, '盐亭县', 'Yanting', 510700, 3, '0816', '621600', 105.39, 31.2218);
INSERT INTO `app_area` VALUES (510724, '安县', 'Anxian', 510700, 3, '0816', '622650', 104.567, 31.5349);
INSERT INTO `app_area` VALUES (510725, '梓潼县', 'Zitong', 510700, 3, '0816', '622150', 105.162, 31.6359);
INSERT INTO `app_area` VALUES (510726, '北川羌族自治县', 'Beichuan', 510700, 3, '0816', '622750', 104.464, 31.8329);
INSERT INTO `app_area` VALUES (510727, '平武县', 'Pingwu', 510700, 3, '0816', '622550', 104.529, 32.4079);
INSERT INTO `app_area` VALUES (510781, '江油市', 'Jiangyou', 510700, 3, '0816', '621700', 104.745, 31.7778);
INSERT INTO `app_area` VALUES (510800, '广元市', 'Guangyuan', 510000, 2, '0839', '628000', 105.83, 32.4337);
INSERT INTO `app_area` VALUES (510802, '利州区', 'Lizhou', 510800, 3, '0839', '628017', 105.826, 32.4323);
INSERT INTO `app_area` VALUES (510811, '昭化区', 'Zhaohua', 510800, 3, '0839', '628017', 105.64, 32.3865);
INSERT INTO `app_area` VALUES (510812, '朝天区', 'Chaotian', 510800, 3, '0839', '628017', 105.893, 32.644);
INSERT INTO `app_area` VALUES (510821, '旺苍县', 'Wangcang', 510800, 3, '0839', '628200', 106.29, 32.2285);
INSERT INTO `app_area` VALUES (510822, '青川县', 'Qingchuan', 510800, 3, '0839', '628100', 105.239, 32.5856);
INSERT INTO `app_area` VALUES (510823, '剑阁县', 'Jiange', 510800, 3, '0839', '628300', 105.525, 32.2884);
INSERT INTO `app_area` VALUES (510824, '苍溪县', 'Cangxi', 510800, 3, '0839', '628400', 105.936, 31.7321);
INSERT INTO `app_area` VALUES (510900, '遂宁市', 'Suining', 510000, 2, '0825', '629000', 105.571, 30.5133);
INSERT INTO `app_area` VALUES (510903, '船山区', 'Chuanshan', 510900, 3, '0825', '629000', 105.581, 30.4999);
INSERT INTO `app_area` VALUES (510904, '安居区', 'Anju', 510900, 3, '0825', '629000', 105.464, 30.3578);
INSERT INTO `app_area` VALUES (510921, '蓬溪县', 'Pengxi', 510900, 3, '0825', '629100', 105.708, 30.7577);
INSERT INTO `app_area` VALUES (510922, '射洪县', 'Shehong', 510900, 3, '0825', '629200', 105.389, 30.872);
INSERT INTO `app_area` VALUES (510923, '大英县', 'Daying', 510900, 3, '0825', '629300', 105.243, 30.5943);
INSERT INTO `app_area` VALUES (511000, '内江市', 'Neijiang', 510000, 2, '0832', '641000', 105.066, 29.5871);
INSERT INTO `app_area` VALUES (511002, '市中区', 'Shizhongqu', 511000, 3, '0832', '641000', 105.068, 29.5871);
INSERT INTO `app_area` VALUES (511011, '东兴区', 'Dongxing', 511000, 3, '0832', '641100', 105.076, 29.5928);
INSERT INTO `app_area` VALUES (511024, '威远县', 'Weiyuan', 511000, 3, '0832', '642450', 104.67, 29.5282);
INSERT INTO `app_area` VALUES (511025, '资中县', 'Zizhong', 511000, 3, '0832', '641200', 104.852, 29.7641);
INSERT INTO `app_area` VALUES (511028, '隆昌县', 'Longchang', 511000, 3, '0832', '642150', 105.287, 29.3394);
INSERT INTO `app_area` VALUES (511100, '乐山市', 'Leshan', 510000, 2, '0833', '614000', 103.761, 29.582);
INSERT INTO `app_area` VALUES (511102, '市中区', 'Shizhongqu', 511100, 3, '0833', '614000', 103.762, 29.5554);
INSERT INTO `app_area` VALUES (511111, '沙湾区', 'Shawan', 511100, 3, '0833', '614900', 103.549, 29.4119);
INSERT INTO `app_area` VALUES (511112, '五通桥区', 'Wutongqiao', 511100, 3, '0833', '614800', 103.823, 29.4034);
INSERT INTO `app_area` VALUES (511113, '金口河区', 'Jinkouhe', 511100, 3, '0833', '614700', 103.079, 29.2458);
INSERT INTO `app_area` VALUES (511123, '犍为县', 'Qianwei', 511100, 3, '0833', '614400', 103.95, 29.2097);
INSERT INTO `app_area` VALUES (511124, '井研县', 'Jingyan', 511100, 3, '0833', '613100', 104.07, 29.6523);
INSERT INTO `app_area` VALUES (511126, '夹江县', 'Jiajiang', 511100, 3, '0833', '614100', 103.572, 29.7387);
INSERT INTO `app_area` VALUES (511129, '沐川县', 'Muchuan', 511100, 3, '0833', '614500', 103.904, 28.9565);
INSERT INTO `app_area` VALUES (511132, '峨边彝族自治县', 'Ebian', 511100, 3, '0833', '614300', 103.263, 29.23);
INSERT INTO `app_area` VALUES (511133, '马边彝族自治县', 'Mabian', 511100, 3, '0833', '614600', 103.546, 28.8359);
INSERT INTO `app_area` VALUES (511181, '峨眉山市', 'Emeishan', 511100, 3, '0833', '614200', 103.484, 29.6012);
INSERT INTO `app_area` VALUES (511300, '南充市', 'Nanchong', 510000, 2, '0817', '637000', 106.083, 30.7953);
INSERT INTO `app_area` VALUES (511302, '顺庆区', 'Shunqing', 511300, 3, '0817', '637000', 106.092, 30.7964);
INSERT INTO `app_area` VALUES (511303, '高坪区', 'Gaoping', 511300, 3, '0817', '637100', 106.119, 30.7816);
INSERT INTO `app_area` VALUES (511304, '嘉陵区', 'Jialing', 511300, 3, '0817', '637100', 106.071, 30.7585);
INSERT INTO `app_area` VALUES (511321, '南部县', 'Nanbu', 511300, 3, '0817', '637300', 106.067, 31.3545);
INSERT INTO `app_area` VALUES (511322, '营山县', 'Yingshan', 511300, 3, '0817', '637700', 106.566, 31.0775);
INSERT INTO `app_area` VALUES (511323, '蓬安县', 'Peng\'an', 511300, 3, '0817', '637800', 106.413, 31.0296);
INSERT INTO `app_area` VALUES (511324, '仪陇县', 'Yilong', 511300, 3, '0817', '637600', 106.3, 31.2763);
INSERT INTO `app_area` VALUES (511325, '西充县', 'Xichong', 511300, 3, '0817', '637200', 105.9, 30.9969);
INSERT INTO `app_area` VALUES (511381, '阆中市', 'Langzhong', 511300, 3, '0817', '637400', 106.005, 31.5583);
INSERT INTO `app_area` VALUES (511400, '眉山市', 'Meishan', 510000, 2, '028', '620020', 103.832, 30.0483);
INSERT INTO `app_area` VALUES (511402, '东坡区', 'Dongpo', 511400, 3, '028', '620010', 103.832, 30.0422);
INSERT INTO `app_area` VALUES (511403, '彭山区', 'Pengshan', 511400, 3, '028', '620860', 103.873, 30.1928);
INSERT INTO `app_area` VALUES (511421, '仁寿县', 'Renshou', 511400, 3, '028', '620500', 104.134, 29.996);
INSERT INTO `app_area` VALUES (511423, '洪雅县', 'Hongya', 511400, 3, '028', '620360', 103.373, 29.9066);
INSERT INTO `app_area` VALUES (511424, '丹棱县', 'Danling', 511400, 3, '028', '620200', 103.513, 30.0156);
INSERT INTO `app_area` VALUES (511425, '青神县', 'Qingshen', 511400, 3, '028', '620460', 103.848, 29.8323);
INSERT INTO `app_area` VALUES (511500, '宜宾市', 'Yibin', 510000, 2, '0831', '644000', 104.631, 28.7602);
INSERT INTO `app_area` VALUES (511502, '翠屏区', 'Cuiping', 511500, 3, '0831', '644000', 104.62, 28.7657);
INSERT INTO `app_area` VALUES (511503, '南溪区', 'Nanxi', 511500, 3, '0831', '644100', 104.981, 28.8398);
INSERT INTO `app_area` VALUES (511521, '宜宾县', 'Yibin', 511500, 3, '0831', '644600', 104.533, 28.69);
INSERT INTO `app_area` VALUES (511523, '江安县', 'Jiang\'an', 511500, 3, '0831', '644200', 105.067, 28.7239);
INSERT INTO `app_area` VALUES (511524, '长宁县', 'Changning', 511500, 3, '0831', '644300', 104.925, 28.5778);
INSERT INTO `app_area` VALUES (511525, '高县', 'Gaoxian', 511500, 3, '0831', '645150', 104.518, 28.4362);
INSERT INTO `app_area` VALUES (511526, '珙县', 'Gongxian', 511500, 3, '0831', '644500', 104.714, 28.4451);
INSERT INTO `app_area` VALUES (511527, '筠连县', 'Junlian', 511500, 3, '0831', '645250', 104.512, 28.1649);
INSERT INTO `app_area` VALUES (511528, '兴文县', 'Xingwen', 511500, 3, '0831', '644400', 105.237, 28.3044);
INSERT INTO `app_area` VALUES (511529, '屏山县', 'Pingshan', 511500, 3, '0831', '645350', 104.163, 28.6437);
INSERT INTO `app_area` VALUES (511600, '广安市', 'Guang\'an', 510000, 2, '0826', '638000', 106.633, 30.4564);
INSERT INTO `app_area` VALUES (511602, '广安区', 'Guang\'an', 511600, 3, '0826', '638000', 106.642, 30.4739);
INSERT INTO `app_area` VALUES (511603, '前锋区', 'Qianfeng', 511600, 3, '0826', '638019', 106.894, 30.4946);
INSERT INTO `app_area` VALUES (511621, '岳池县', 'Yuechi', 511600, 3, '0826', '638300', 106.441, 30.5392);
INSERT INTO `app_area` VALUES (511622, '武胜县', 'Wusheng', 511600, 3, '0826', '638400', 106.296, 30.3493);
INSERT INTO `app_area` VALUES (511623, '邻水县', 'Linshui', 511600, 3, '0826', '638500', 106.93, 30.3345);
INSERT INTO `app_area` VALUES (511681, '华蓥市', 'Huaying', 511600, 3, '0826', '638600', 106.785, 30.3901);
INSERT INTO `app_area` VALUES (511700, '达州市', 'Dazhou', 510000, 2, '0818', '635000', 107.502, 31.2095);
INSERT INTO `app_area` VALUES (511702, '通川区', 'Tongchuan', 511700, 3, '0818', '635000', 107.505, 31.2147);
INSERT INTO `app_area` VALUES (511703, '达川区', 'Dachuan', 511700, 3, '0818', '635000', 107.502, 31.2095);
INSERT INTO `app_area` VALUES (511722, '宣汉县', 'Xuanhan', 511700, 3, '0818', '636150', 107.728, 31.3552);
INSERT INTO `app_area` VALUES (511723, '开江县', 'Kaijiang', 511700, 3, '0818', '636250', 107.869, 31.0841);
INSERT INTO `app_area` VALUES (511724, '大竹县', 'Dazhu', 511700, 3, '0818', '635100', 107.209, 30.7415);
INSERT INTO `app_area` VALUES (511725, '渠县', 'Quxian', 511700, 3, '0818', '635200', 106.974, 30.8376);
INSERT INTO `app_area` VALUES (511781, '万源市', 'Wanyuan', 511700, 3, '0818', '636350', 108.036, 32.0809);
INSERT INTO `app_area` VALUES (511800, '雅安市', 'Ya\'an', 510000, 2, '0835', '625000', 103.001, 29.9877);
INSERT INTO `app_area` VALUES (511802, '雨城区', 'Yucheng', 511800, 3, '0835', '625000', 103.033, 30.0053);
INSERT INTO `app_area` VALUES (511803, '名山区', 'Mingshan', 511800, 3, '0835', '625100', 103.112, 30.0847);
INSERT INTO `app_area` VALUES (511822, '荥经县', 'Yingjing', 511800, 3, '0835', '625200', 102.847, 29.794);
INSERT INTO `app_area` VALUES (511823, '汉源县', 'Hanyuan', 511800, 3, '0835', '625300', 102.678, 29.3517);
INSERT INTO `app_area` VALUES (511824, '石棉县', 'Shimian', 511800, 3, '0835', '625400', 102.359, 29.228);
INSERT INTO `app_area` VALUES (511825, '天全县', 'Tianquan', 511800, 3, '0835', '625500', 102.759, 30.0675);
INSERT INTO `app_area` VALUES (511826, '芦山县', 'Lushan', 511800, 3, '0835', '625600', 102.928, 30.1437);
INSERT INTO `app_area` VALUES (511827, '宝兴县', 'Baoxing', 511800, 3, '0835', '625700', 102.816, 30.3684);
INSERT INTO `app_area` VALUES (511900, '巴中市', 'Bazhong', 510000, 2, '0827', '636000', 106.754, 31.8588);
INSERT INTO `app_area` VALUES (511902, '巴州区', 'Bazhou', 511900, 3, '0827', '636001', 106.769, 31.8512);
INSERT INTO `app_area` VALUES (511903, '恩阳区', 'Enyang', 511900, 3, '0827', '636064', 106.754, 31.8588);
INSERT INTO `app_area` VALUES (511921, '通江县', 'Tongjiang', 511900, 3, '0827', '636700', 107.244, 31.9129);
INSERT INTO `app_area` VALUES (511922, '南江县', 'Nanjiang', 511900, 3, '0827', '636600', 106.842, 32.3534);
INSERT INTO `app_area` VALUES (511923, '平昌县', 'Pingchang', 511900, 3, '0827', '636400', 107.104, 31.5594);
INSERT INTO `app_area` VALUES (512000, '资阳市', 'Ziyang', 510000, 2, '028', '641300', 104.642, 30.1222);
INSERT INTO `app_area` VALUES (512002, '雁江区', 'Yanjiang', 512000, 3, '028', '641300', 104.652, 30.1152);
INSERT INTO `app_area` VALUES (512021, '安岳县', 'Anyue', 512000, 3, '028', '642350', 105.336, 30.0979);
INSERT INTO `app_area` VALUES (512022, '乐至县', 'Lezhi', 512000, 3, '028', '641500', 105.032, 30.2723);
INSERT INTO `app_area` VALUES (512081, '简阳市', 'Jianyang', 512000, 3, '028', '641400', 104.549, 30.3904);
INSERT INTO `app_area` VALUES (513200, '阿坝藏族羌族自治州', 'Aba', 510000, 2, '0837', '624000', 102.221, 31.8998);
INSERT INTO `app_area` VALUES (513221, '汶川县', 'Wenchuan', 513200, 3, '0837', '623000', 103.591, 31.4733);
INSERT INTO `app_area` VALUES (513222, '理县', 'Lixian', 513200, 3, '0837', '623100', 103.172, 31.436);
INSERT INTO `app_area` VALUES (513223, '茂县', 'Maoxian', 513200, 3, '0837', '623200', 103.854, 31.682);
INSERT INTO `app_area` VALUES (513224, '松潘县', 'Songpan', 513200, 3, '0837', '623300', 103.599, 32.6387);
INSERT INTO `app_area` VALUES (513225, '九寨沟县', 'Jiuzhaigou', 513200, 3, '0837', '623400', 104.237, 33.2632);
INSERT INTO `app_area` VALUES (513226, '金川县', 'Jinchuan', 513200, 3, '0837', '624100', 102.066, 31.4762);
INSERT INTO `app_area` VALUES (513227, '小金县', 'Xiaojin', 513200, 3, '0837', '624200', 102.365, 30.9993);
INSERT INTO `app_area` VALUES (513228, '黑水县', 'Heishui', 513200, 3, '0837', '623500', 102.992, 32.0618);
INSERT INTO `app_area` VALUES (513229, '马尔康县', 'Maerkang', 513200, 3, '0837', '624000', 102.206, 31.9058);
INSERT INTO `app_area` VALUES (513230, '壤塘县', 'Rangtang', 513200, 3, '0837', '624300', 100.978, 32.2658);
INSERT INTO `app_area` VALUES (513231, '阿坝县', 'Aba', 513200, 3, '0837', '624600', 101.706, 32.903);
INSERT INTO `app_area` VALUES (513232, '若尔盖县', 'Ruoergai', 513200, 3, '0837', '624500', 102.96, 33.5743);
INSERT INTO `app_area` VALUES (513233, '红原县', 'Hongyuan', 513200, 3, '0837', '624400', 102.545, 32.7899);
INSERT INTO `app_area` VALUES (513300, '甘孜藏族自治州', 'Garze', 510000, 2, '0836', '626000', 101.964, 30.0507);
INSERT INTO `app_area` VALUES (513321, '康定县', 'Kangding', 513300, 3, '0836', '626000', 101.965, 30.0553);
INSERT INTO `app_area` VALUES (513322, '泸定县', 'Luding', 513300, 3, '0836', '626100', 102.235, 29.9147);
INSERT INTO `app_area` VALUES (513323, '丹巴县', 'Danba', 513300, 3, '0836', '626300', 101.884, 30.8766);
INSERT INTO `app_area` VALUES (513324, '九龙县', 'Jiulong', 513300, 3, '0836', '626200', 101.508, 29.0009);
INSERT INTO `app_area` VALUES (513325, '雅江县', 'Yajiang', 513300, 3, '0836', '627450', 101.015, 30.0328);
INSERT INTO `app_area` VALUES (513326, '道孚县', 'Daofu', 513300, 3, '0836', '626400', 101.126, 30.9805);
INSERT INTO `app_area` VALUES (513327, '炉霍县', 'Luhuo', 513300, 3, '0836', '626500', 100.677, 31.3917);
INSERT INTO `app_area` VALUES (513328, '甘孜县', 'Ganzi', 513300, 3, '0836', '626700', 99.9931, 31.6267);
INSERT INTO `app_area` VALUES (513329, '新龙县', 'Xinlong', 513300, 3, '0836', '626800', 100.312, 30.9407);
INSERT INTO `app_area` VALUES (513330, '德格县', 'Dege', 513300, 3, '0836', '627250', 98.5808, 31.8062);
INSERT INTO `app_area` VALUES (513331, '白玉县', 'Baiyu', 513300, 3, '0836', '627150', 98.8257, 31.209);
INSERT INTO `app_area` VALUES (513332, '石渠县', 'Shiqu', 513300, 3, '0836', '627350', 98.1016, 32.9788);
INSERT INTO `app_area` VALUES (513333, '色达县', 'Seda', 513300, 3, '0836', '626600', 100.332, 32.2684);
INSERT INTO `app_area` VALUES (513334, '理塘县', 'Litang', 513300, 3, '0836', '627550', 100.27, 29.9967);
INSERT INTO `app_area` VALUES (513335, '巴塘县', 'Batang', 513300, 3, '0836', '627650', 99.1041, 30.0042);
INSERT INTO `app_area` VALUES (513336, '乡城县', 'Xiangcheng', 513300, 3, '0836', '627850', 99.7994, 28.9355);
INSERT INTO `app_area` VALUES (513337, '稻城县', 'Daocheng', 513300, 3, '0836', '627750', 100.298, 29.0379);
INSERT INTO `app_area` VALUES (513338, '得荣县', 'Derong', 513300, 3, '0836', '627950', 99.2863, 28.713);
INSERT INTO `app_area` VALUES (513400, '凉山彝族自治州', 'Liangshan', 510000, 2, '0834', '615000', 102.259, 27.8868);
INSERT INTO `app_area` VALUES (513401, '西昌市', 'Xichang', 513400, 3, '0835', '615000', 102.264, 27.8952);
INSERT INTO `app_area` VALUES (513422, '木里藏族自治县', 'Muli', 513400, 3, '0851', '615800', 101.28, 27.9287);
INSERT INTO `app_area` VALUES (513423, '盐源县', 'Yanyuan', 513400, 3, '0836', '615700', 101.51, 27.4218);
INSERT INTO `app_area` VALUES (513424, '德昌县', 'Dechang', 513400, 3, '0837', '615500', 102.18, 27.4048);
INSERT INTO `app_area` VALUES (513425, '会理县', 'Huili', 513400, 3, '0838', '615100', 102.245, 26.6563);
INSERT INTO `app_area` VALUES (513426, '会东县', 'Huidong', 513400, 3, '0839', '615200', 102.578, 26.6343);
INSERT INTO `app_area` VALUES (513427, '宁南县', 'Ningnan', 513400, 3, '0840', '615400', 102.761, 27.0657);
INSERT INTO `app_area` VALUES (513428, '普格县', 'Puge', 513400, 3, '0841', '615300', 102.541, 27.3748);
INSERT INTO `app_area` VALUES (513429, '布拖县', 'Butuo', 513400, 3, '0842', '616350', 102.812, 27.7079);
INSERT INTO `app_area` VALUES (513430, '金阳县', 'Jinyang', 513400, 3, '0843', '616250', 103.248, 27.697);
INSERT INTO `app_area` VALUES (513431, '昭觉县', 'Zhaojue', 513400, 3, '0844', '616150', 102.847, 28.0116);
INSERT INTO `app_area` VALUES (513432, '喜德县', 'Xide', 513400, 3, '0845', '616750', 102.413, 28.3074);
INSERT INTO `app_area` VALUES (513433, '冕宁县', 'Mianning', 513400, 3, '0846', '615600', 102.171, 28.5516);
INSERT INTO `app_area` VALUES (513434, '越西县', 'Yuexi', 513400, 3, '0847', '616650', 102.508, 28.6413);
INSERT INTO `app_area` VALUES (513435, '甘洛县', 'Ganluo', 513400, 3, '0848', '616850', 102.772, 28.9662);
INSERT INTO `app_area` VALUES (513436, '美姑县', 'Meigu', 513400, 3, '0849', '616450', 103.131, 28.326);
INSERT INTO `app_area` VALUES (513437, '雷波县', 'Leibo', 513400, 3, '0850', '616550', 103.573, 28.2641);
INSERT INTO `app_area` VALUES (520000, '贵州省', 'Guizhou', 100000, 1, '', '', 106.713, 26.5783);
INSERT INTO `app_area` VALUES (520100, '贵阳市', 'Guiyang', 520000, 2, '0851', '550001', 106.713, 26.5783);
INSERT INTO `app_area` VALUES (520102, '南明区', 'Nanming', 520100, 3, '0851', '550001', 106.715, 26.5682);
INSERT INTO `app_area` VALUES (520103, '云岩区', 'Yunyan', 520100, 3, '0851', '550001', 106.725, 26.6048);
INSERT INTO `app_area` VALUES (520111, '花溪区', 'Huaxi', 520100, 3, '0851', '550025', 106.677, 26.4334);
INSERT INTO `app_area` VALUES (520112, '乌当区', 'Wudang', 520100, 3, '0851', '550018', 106.752, 26.6302);
INSERT INTO `app_area` VALUES (520113, '白云区', 'Baiyun', 520100, 3, '0851', '550014', 106.631, 26.6828);
INSERT INTO `app_area` VALUES (520115, '观山湖区', 'Guanshanhu', 520100, 3, '0851', '550009', 106.625, 26.6182);
INSERT INTO `app_area` VALUES (520121, '开阳县', 'Kaiyang', 520100, 3, '0851', '550300', 106.969, 27.0553);
INSERT INTO `app_area` VALUES (520122, '息烽县', 'Xifeng', 520100, 3, '0851', '551100', 106.738, 27.0935);
INSERT INTO `app_area` VALUES (520123, '修文县', 'Xiuwen', 520100, 3, '0851', '550200', 106.595, 26.8378);
INSERT INTO `app_area` VALUES (520181, '清镇市', 'Qingzhen', 520100, 3, '0851', '551400', 106.469, 26.5526);
INSERT INTO `app_area` VALUES (520200, '六盘水市', 'Liupanshui', 520000, 2, '0858', '553400', 104.847, 26.5846);
INSERT INTO `app_area` VALUES (520201, '钟山区', 'Zhongshan', 520200, 3, '0858', '553000', 104.878, 26.577);
INSERT INTO `app_area` VALUES (520203, '六枝特区', 'Liuzhi', 520200, 3, '0858', '553400', 105.481, 26.2012);
INSERT INTO `app_area` VALUES (520221, '水城县', 'Shuicheng', 520200, 3, '0858', '553000', 104.958, 26.5478);
INSERT INTO `app_area` VALUES (520222, '盘县', 'Panxian', 520200, 3, '0858', '561601', 104.471, 25.7136);
INSERT INTO `app_area` VALUES (520300, '遵义市', 'Zunyi', 520000, 2, '0852', '563000', 106.937, 27.7066);
INSERT INTO `app_area` VALUES (520302, '红花岗区', 'Honghuagang', 520300, 3, '0852', '563000', 106.894, 27.6447);
INSERT INTO `app_area` VALUES (520303, '汇川区', 'Huichuan', 520300, 3, '0852', '563000', 106.939, 27.7062);
INSERT INTO `app_area` VALUES (520321, '遵义县', 'Zunyi', 520300, 3, '0852', '563100', 106.833, 27.5377);
INSERT INTO `app_area` VALUES (520322, '桐梓县', 'Tongzi', 520300, 3, '0852', '563200', 106.826, 28.1381);
INSERT INTO `app_area` VALUES (520323, '绥阳县', 'Suiyang', 520300, 3, '0852', '563300', 107.191, 27.947);
INSERT INTO `app_area` VALUES (520324, '正安县', 'Zheng\'an', 520300, 3, '0852', '563400', 107.444, 28.5512);
INSERT INTO `app_area` VALUES (520325, '道真仡佬族苗族自治县', 'Daozhen', 520300, 3, '0852', '563500', 107.612, 28.864);
INSERT INTO `app_area` VALUES (520326, '务川仡佬族苗族自治县', 'Wuchuan', 520300, 3, '0852', '564300', 107.889, 28.5223);
INSERT INTO `app_area` VALUES (520327, '凤冈县', 'Fenggang', 520300, 3, '0852', '564200', 107.717, 27.9546);
INSERT INTO `app_area` VALUES (520328, '湄潭县', 'Meitan', 520300, 3, '0852', '564100', 107.488, 27.7668);
INSERT INTO `app_area` VALUES (520329, '余庆县', 'Yuqing', 520300, 3, '0852', '564400', 107.888, 27.2253);
INSERT INTO `app_area` VALUES (520330, '习水县', 'Xishui', 520300, 3, '0852', '564600', 106.213, 28.3198);
INSERT INTO `app_area` VALUES (520381, '赤水市', 'Chishui', 520300, 3, '0852', '564700', 105.698, 28.5892);
INSERT INTO `app_area` VALUES (520382, '仁怀市', 'Renhuai', 520300, 3, '0852', '564500', 106.402, 27.7923);
INSERT INTO `app_area` VALUES (520400, '安顺市', 'Anshun', 520000, 2, '0853', '561000', 105.932, 26.2455);
INSERT INTO `app_area` VALUES (520402, '西秀区', 'Xixiu', 520400, 3, '0853', '561000', 105.966, 26.2449);
INSERT INTO `app_area` VALUES (520421, '平坝区', 'Pingba', 520400, 3, '0853', '561100', 106.257, 26.4054);
INSERT INTO `app_area` VALUES (520422, '普定县', 'Puding', 520400, 3, '0853', '562100', 105.743, 26.3014);
INSERT INTO `app_area` VALUES (520423, '镇宁布依族苗族自治县', 'Zhenning', 520400, 3, '0853', '561200', 105.765, 26.0553);
INSERT INTO `app_area` VALUES (520424, '关岭布依族苗族自治县', 'Guanling', 520400, 3, '0853', '561300', 105.619, 25.9425);
INSERT INTO `app_area` VALUES (520425, '紫云苗族布依族自治县', 'Ziyun', 520400, 3, '0853', '550800', 106.084, 25.7526);
INSERT INTO `app_area` VALUES (520500, '毕节市', 'Bijie', 520000, 2, '0857', '551700', 105.285, 27.3017);
INSERT INTO `app_area` VALUES (520502, '七星关区', 'Qixingguan', 520500, 3, '0857', '551700', 104.95, 27.1536);
INSERT INTO `app_area` VALUES (520521, '大方县', 'Dafang', 520500, 3, '0857', '551600', 105.609, 27.1435);
INSERT INTO `app_area` VALUES (520522, '黔西县', 'Qianxi', 520500, 3, '0857', '551500', 106.038, 27.0249);
INSERT INTO `app_area` VALUES (520523, '金沙县', 'Jinsha', 520500, 3, '0857', '551800', 106.222, 27.4597);
INSERT INTO `app_area` VALUES (520524, '织金县', 'Zhijin', 520500, 3, '0857', '552100', 105.769, 26.6685);
INSERT INTO `app_area` VALUES (520525, '纳雍县', 'Nayong', 520500, 3, '0857', '553300', 105.375, 26.7699);
INSERT INTO `app_area` VALUES (520526, '威宁彝族回族苗族自治县', 'Weining', 520500, 3, '0857', '553100', 104.287, 26.8591);
INSERT INTO `app_area` VALUES (520527, '赫章县', 'Hezhang', 520500, 3, '0857', '553200', 104.726, 27.1192);
INSERT INTO `app_area` VALUES (520600, '铜仁市', 'Tongren', 520000, 2, '0856', '554300', 109.192, 27.7183);
INSERT INTO `app_area` VALUES (520602, '碧江区', 'Bijiang', 520600, 3, '0856', '554300', 109.192, 27.7183);
INSERT INTO `app_area` VALUES (520603, '万山区', 'Wanshan', 520600, 3, '0856', '554200', 109.212, 27.519);
INSERT INTO `app_area` VALUES (520621, '江口县', 'Jiangkou', 520600, 3, '0856', '554400', 108.848, 27.6919);
INSERT INTO `app_area` VALUES (520622, '玉屏侗族自治县', 'Yuping', 520600, 3, '0856', '554004', 108.918, 27.238);
INSERT INTO `app_area` VALUES (520623, '石阡县', 'Shiqian', 520600, 3, '0856', '555100', 108.23, 27.5194);
INSERT INTO `app_area` VALUES (520624, '思南县', 'Sinan', 520600, 3, '0856', '565100', 108.256, 27.9413);
INSERT INTO `app_area` VALUES (520625, '印江土家族苗族自治县', 'Yinjiang', 520600, 3, '0856', '555200', 108.406, 27.998);
INSERT INTO `app_area` VALUES (520626, '德江县', 'Dejiang', 520600, 3, '0856', '565200', 108.117, 28.2609);
INSERT INTO `app_area` VALUES (520627, '沿河土家族自治县', 'Yuanhe', 520600, 3, '0856', '565300', 108.496, 28.5605);
INSERT INTO `app_area` VALUES (520628, '松桃苗族自治县', 'Songtao', 520600, 3, '0856', '554100', 109.203, 28.1654);
INSERT INTO `app_area` VALUES (522300, '黔西南布依族苗族自治州', 'Qianxinan', 520000, 2, '0859', '562400', 104.898, 25.0881);
INSERT INTO `app_area` VALUES (522301, '兴义市 ', 'Xingyi', 522300, 3, '0859', '562400', 104.895, 25.0921);
INSERT INTO `app_area` VALUES (522322, '兴仁县', 'Xingren', 522300, 3, '0859', '562300', 105.187, 25.4328);
INSERT INTO `app_area` VALUES (522323, '普安县', 'Pu\'an', 522300, 3, '0859', '561500', 104.955, 25.786);
INSERT INTO `app_area` VALUES (522324, '晴隆县', 'Qinglong', 522300, 3, '0859', '561400', 105.219, 25.8352);
INSERT INTO `app_area` VALUES (522325, '贞丰县', 'Zhenfeng', 522300, 3, '0859', '562200', 105.655, 25.3846);
INSERT INTO `app_area` VALUES (522326, '望谟县', 'Wangmo', 522300, 3, '0859', '552300', 106.1, 25.1782);
INSERT INTO `app_area` VALUES (522327, '册亨县', 'Ceheng', 522300, 3, '0859', '552200', 105.812, 24.9838);
INSERT INTO `app_area` VALUES (522328, '安龙县', 'Anlong', 522300, 3, '0859', '552400', 105.443, 25.0982);
INSERT INTO `app_area` VALUES (522600, '黔东南苗族侗族自治州', 'Qiandongnan', 520000, 2, '0855', '556000', 107.977, 26.5834);
INSERT INTO `app_area` VALUES (522601, '凯里市', 'Kaili', 522600, 3, '0855', '556000', 107.981, 26.5669);
INSERT INTO `app_area` VALUES (522622, '黄平县', 'Huangping', 522600, 3, '0855', '556100', 107.902, 26.8957);
INSERT INTO `app_area` VALUES (522623, '施秉县', 'Shibing', 522600, 3, '0855', '556200', 108.126, 27.035);
INSERT INTO `app_area` VALUES (522624, '三穗县', 'Sansui', 522600, 3, '0855', '556500', 108.671, 26.9477);
INSERT INTO `app_area` VALUES (522625, '镇远县', 'Zhenyuan', 522600, 3, '0855', '557700', 108.427, 27.0493);
INSERT INTO `app_area` VALUES (522626, '岑巩县', 'Cengong', 522600, 3, '0855', '557800', 108.819, 27.1754);
INSERT INTO `app_area` VALUES (522627, '天柱县', 'Tianzhu', 522600, 3, '0855', '556600', 109.207, 26.9078);
INSERT INTO `app_area` VALUES (522628, '锦屏县', 'Jinping', 522600, 3, '0855', '556700', 109.2, 26.6763);
INSERT INTO `app_area` VALUES (522629, '剑河县', 'Jianhe', 522600, 3, '0855', '556400', 108.591, 26.6525);
INSERT INTO `app_area` VALUES (522630, '台江县', 'Taijiang', 522600, 3, '0855', '556300', 108.318, 26.6692);
INSERT INTO `app_area` VALUES (522631, '黎平县', 'Liping', 522600, 3, '0855', '557300', 109.136, 26.2311);
INSERT INTO `app_area` VALUES (522632, '榕江县', 'Rongjiang', 522600, 3, '0855', '557200', 108.521, 25.9242);
INSERT INTO `app_area` VALUES (522633, '从江县', 'Congjiang', 522600, 3, '0855', '557400', 108.905, 25.7542);
INSERT INTO `app_area` VALUES (522634, '雷山县', 'Leishan', 522600, 3, '0855', '557100', 108.077, 26.3839);
INSERT INTO `app_area` VALUES (522635, '麻江县', 'Majiang', 522600, 3, '0855', '557600', 107.592, 26.4923);
INSERT INTO `app_area` VALUES (522636, '丹寨县', 'Danzhai', 522600, 3, '0855', '557500', 107.797, 26.1982);
INSERT INTO `app_area` VALUES (522700, '黔南布依族苗族自治州', 'Qiannan', 520000, 2, '0854', '558000', 107.517, 26.2582);
INSERT INTO `app_area` VALUES (522701, '都匀市', 'Duyun', 522700, 3, '0854', '558000', 107.519, 26.2594);
INSERT INTO `app_area` VALUES (522702, '福泉市', 'Fuquan', 522700, 3, '0854', '550500', 107.517, 26.6799);
INSERT INTO `app_area` VALUES (522722, '荔波县', 'Libo', 522700, 3, '0854', '558400', 107.886, 25.4139);
INSERT INTO `app_area` VALUES (522723, '贵定县', 'Guiding', 522700, 3, '0854', '551300', 107.237, 26.5781);
INSERT INTO `app_area` VALUES (522725, '瓮安县', 'Weng\'an', 522700, 3, '0854', '550400', 107.476, 27.0681);
INSERT INTO `app_area` VALUES (522726, '独山县', 'Dushan', 522700, 3, '0854', '558200', 107.541, 25.8245);
INSERT INTO `app_area` VALUES (522727, '平塘县', 'Pingtang', 522700, 3, '0854', '558300', 107.324, 25.8329);
INSERT INTO `app_area` VALUES (522728, '罗甸县', 'Luodian', 522700, 3, '0854', '550100', 106.752, 25.4259);
INSERT INTO `app_area` VALUES (522729, '长顺县', 'Changshun', 522700, 3, '0854', '550700', 106.452, 26.023);
INSERT INTO `app_area` VALUES (522730, '龙里县', 'Longli', 522700, 3, '0854', '551200', 106.977, 26.4508);
INSERT INTO `app_area` VALUES (522731, '惠水县', 'Huishui', 522700, 3, '0854', '550600', 106.659, 26.1339);
INSERT INTO `app_area` VALUES (522732, '三都水族自治县', 'Sandu', 522700, 3, '0854', '558100', 107.875, 25.9856);
INSERT INTO `app_area` VALUES (530000, '云南省', 'Yunnan', 100000, 1, '', '', 102.712, 25.0406);
INSERT INTO `app_area` VALUES (530100, '昆明市', 'Kunming', 530000, 2, '0871', '650500', 102.712, 25.0406);
INSERT INTO `app_area` VALUES (530102, '五华区', 'Wuhua', 530100, 3, '0871', '650021', 102.708, 25.0352);
INSERT INTO `app_area` VALUES (530103, '盘龙区', 'Panlong', 530100, 3, '0871', '650051', 102.72, 25.0405);
INSERT INTO `app_area` VALUES (530111, '官渡区', 'Guandu', 530100, 3, '0871', '650200', 102.744, 25.015);
INSERT INTO `app_area` VALUES (530112, '西山区', 'Xishan', 530100, 3, '0871', '650118', 102.665, 25.038);
INSERT INTO `app_area` VALUES (530113, '东川区', 'Dongchuan', 530100, 3, '0871', '654100', 103.188, 26.083);
INSERT INTO `app_area` VALUES (530114, '呈贡区', 'Chenggong', 530100, 3, '0871', '650500', 102.801, 24.8893);
INSERT INTO `app_area` VALUES (530122, '晋宁县', 'Jinning', 530100, 3, '0871', '650600', 102.594, 24.6665);
INSERT INTO `app_area` VALUES (530124, '富民县', 'Fumin', 530100, 3, '0871', '650400', 102.498, 25.2212);
INSERT INTO `app_area` VALUES (530125, '宜良县', 'Yiliang', 530100, 3, '0871', '652100', 103.141, 24.917);
INSERT INTO `app_area` VALUES (530126, '石林彝族自治县', 'Shilin', 530100, 3, '0871', '652200', 103.271, 24.759);
INSERT INTO `app_area` VALUES (530127, '嵩明县', 'Songming', 530100, 3, '0871', '651700', 103.037, 25.3399);
INSERT INTO `app_area` VALUES (530128, '禄劝彝族苗族自治县', 'Luquan', 530100, 3, '0871', '651500', 102.467, 25.5539);
INSERT INTO `app_area` VALUES (530129, '寻甸回族彝族自治县 ', 'Xundian', 530100, 3, '0871', '655200', 103.256, 25.5596);
INSERT INTO `app_area` VALUES (530181, '安宁市', 'Anning', 530100, 3, '0871', '650300', 102.47, 24.9165);
INSERT INTO `app_area` VALUES (530300, '曲靖市', 'Qujing', 530000, 2, '0874', '655000', 103.798, 25.5016);
INSERT INTO `app_area` VALUES (530302, '麒麟区', 'Qilin', 530300, 3, '0874', '655000', 103.805, 25.4951);
INSERT INTO `app_area` VALUES (530321, '马龙县', 'Malong', 530300, 3, '0874', '655100', 103.579, 25.4252);
INSERT INTO `app_area` VALUES (530322, '陆良县', 'Luliang', 530300, 3, '0874', '655600', 103.666, 25.0233);
INSERT INTO `app_area` VALUES (530323, '师宗县', 'Shizong', 530300, 3, '0874', '655700', 103.991, 24.8282);
INSERT INTO `app_area` VALUES (530324, '罗平县', 'Luoping', 530300, 3, '0874', '655800', 104.309, 24.8844);
INSERT INTO `app_area` VALUES (530325, '富源县', 'Fuyuan', 530300, 3, '0874', '655500', 104.254, 25.6659);
INSERT INTO `app_area` VALUES (530326, '会泽县', 'Huize', 530300, 3, '0874', '654200', 103.3, 26.4108);
INSERT INTO `app_area` VALUES (530328, '沾益县', 'Zhanyi', 530300, 3, '0874', '655331', 103.821, 25.6071);
INSERT INTO `app_area` VALUES (530381, '宣威市', 'Xuanwei', 530300, 3, '0874', '655400', 104.104, 26.2173);
INSERT INTO `app_area` VALUES (530400, '玉溪市', 'Yuxi', 530000, 2, '0877', '653100', 102.544, 24.3505);
INSERT INTO `app_area` VALUES (530402, '红塔区', 'Hongta', 530400, 3, '0877', '653100', 102.545, 24.3541);
INSERT INTO `app_area` VALUES (530421, '江川县', 'Jiangchuan', 530400, 3, '0877', '652600', 102.754, 24.2886);
INSERT INTO `app_area` VALUES (530422, '澄江县', 'Chengjiang', 530400, 3, '0877', '652500', 102.908, 24.6738);
INSERT INTO `app_area` VALUES (530423, '通海县', 'Tonghai', 530400, 3, '0877', '652700', 102.766, 24.1136);
INSERT INTO `app_area` VALUES (530424, '华宁县', 'Huaning', 530400, 3, '0877', '652800', 102.928, 24.1926);
INSERT INTO `app_area` VALUES (530425, '易门县', 'Yimen', 530400, 3, '0877', '651100', 102.164, 24.6712);
INSERT INTO `app_area` VALUES (530426, '峨山彝族自治县', 'Eshan', 530400, 3, '0877', '653200', 102.406, 24.169);
INSERT INTO `app_area` VALUES (530427, '新平彝族傣族自治县', 'Xinping', 530400, 3, '0877', '653400', 101.989, 24.0689);
INSERT INTO `app_area` VALUES (530428, '元江哈尼族彝族傣族自治县', 'Yuanjiang', 530400, 3, '0877', '653300', 101.998, 23.5965);
INSERT INTO `app_area` VALUES (530500, '保山市', 'Baoshan', 530000, 2, '0875', '678000', 99.1671, 25.1118);
INSERT INTO `app_area` VALUES (530502, '隆阳区', 'Longyang', 530500, 3, '0875', '678000', 99.1633, 25.1116);
INSERT INTO `app_area` VALUES (530521, '施甸县', 'Shidian', 530500, 3, '0875', '678200', 99.1877, 24.7242);
INSERT INTO `app_area` VALUES (530522, '腾冲县', 'Tengchong', 530500, 3, '0875', '679100', 98.4941, 25.0254);
INSERT INTO `app_area` VALUES (530523, '龙陵县', 'Longling', 530500, 3, '0875', '678300', 98.6902, 24.5875);
INSERT INTO `app_area` VALUES (530524, '昌宁县', 'Changning', 530500, 3, '0875', '678100', 99.6036, 24.8276);
INSERT INTO `app_area` VALUES (530600, '昭通市', 'Zhaotong', 530000, 2, '0870', '657000', 103.717, 27.337);
INSERT INTO `app_area` VALUES (530602, '昭阳区', 'Zhaoyang', 530600, 3, '0870', '657000', 103.707, 27.32);
INSERT INTO `app_area` VALUES (530621, '鲁甸县', 'Ludian', 530600, 3, '0870', '657100', 103.547, 27.1924);
INSERT INTO `app_area` VALUES (530622, '巧家县', 'Qiaojia', 530600, 3, '0870', '654600', 102.924, 26.9124);
INSERT INTO `app_area` VALUES (530623, '盐津县', 'Yanjin', 530600, 3, '0870', '657500', 104.235, 28.1086);
INSERT INTO `app_area` VALUES (530624, '大关县', 'Daguan', 530600, 3, '0870', '657400', 103.893, 27.7488);
INSERT INTO `app_area` VALUES (530625, '永善县', 'Yongshan', 530600, 3, '0870', '657300', 103.635, 28.2279);
INSERT INTO `app_area` VALUES (530626, '绥江县', 'Suijiang', 530600, 3, '0870', '657700', 103.949, 28.5966);
INSERT INTO `app_area` VALUES (530627, '镇雄县', 'Zhenxiong', 530600, 3, '0870', '657200', 104.873, 27.4398);
INSERT INTO `app_area` VALUES (530628, '彝良县', 'Yiliang', 530600, 3, '0870', '657600', 104.05, 27.6281);
INSERT INTO `app_area` VALUES (530629, '威信县', 'Weixin', 530600, 3, '0870', '657900', 105.048, 27.8407);
INSERT INTO `app_area` VALUES (530630, '水富县', 'Shuifu', 530600, 3, '0870', '657800', 104.416, 28.6299);
INSERT INTO `app_area` VALUES (530700, '丽江市', 'Lijiang', 530000, 2, '0888', '674100', 100.233, 26.8721);
INSERT INTO `app_area` VALUES (530702, '古城区', 'Gucheng', 530700, 3, '0888', '674100', 100.226, 26.877);
INSERT INTO `app_area` VALUES (530721, '玉龙纳西族自治县', 'Yulong', 530700, 3, '0888', '674100', 100.237, 26.8215);
INSERT INTO `app_area` VALUES (530722, '永胜县', 'Yongsheng', 530700, 3, '0888', '674200', 100.747, 26.6859);
INSERT INTO `app_area` VALUES (530723, '华坪县', 'Huaping', 530700, 3, '0888', '674800', 101.266, 26.6297);
INSERT INTO `app_area` VALUES (530724, '宁蒗彝族自治县', 'Ninglang', 530700, 3, '0888', '674300', 100.851, 27.2818);
INSERT INTO `app_area` VALUES (530800, '普洱市', 'Pu\'er', 530000, 2, '0879', '665000', 100.972, 22.7773);
INSERT INTO `app_area` VALUES (530802, '思茅区', 'Simao', 530800, 3, '0879', '665000', 100.977, 22.7869);
INSERT INTO `app_area` VALUES (530821, '宁洱哈尼族彝族自治县', 'Ninger', 530800, 3, '0879', '665100', 101.047, 23.0634);
INSERT INTO `app_area` VALUES (530822, '墨江哈尼族自治县', 'Mojiang', 530800, 3, '0879', '654800', 101.692, 23.4321);
INSERT INTO `app_area` VALUES (530823, '景东彝族自治县', 'Jingdong', 530800, 3, '0879', '676200', 100.836, 24.4479);
INSERT INTO `app_area` VALUES (530824, '景谷傣族彝族自治县', 'Jinggu', 530800, 3, '0879', '666400', 100.703, 23.497);
INSERT INTO `app_area` VALUES (530825, '镇沅彝族哈尼族拉祜族自治县', 'Zhenyuan', 530800, 3, '0879', '666500', 101.107, 24.0056);
INSERT INTO `app_area` VALUES (530826, '江城哈尼族彝族自治县', 'Jiangcheng', 530800, 3, '0879', '665900', 101.858, 22.5842);
INSERT INTO `app_area` VALUES (530827, '孟连傣族拉祜族佤族自治县', 'Menglian', 530800, 3, '0879', '665800', 99.5842, 22.3292);
INSERT INTO `app_area` VALUES (530828, '澜沧拉祜族自治县', 'Lancang', 530800, 3, '0879', '665600', 99.9359, 22.5547);
INSERT INTO `app_area` VALUES (530829, '西盟佤族自治县', 'Ximeng', 530800, 3, '0879', '665700', 99.5987, 22.6477);
INSERT INTO `app_area` VALUES (530900, '临沧市', 'Lincang', 530000, 2, '0883', '677000', 100.087, 23.8866);
INSERT INTO `app_area` VALUES (530902, '临翔区', 'Linxiang', 530900, 3, '0883', '677000', 100.082, 23.895);
INSERT INTO `app_area` VALUES (530921, '凤庆县', 'Fengqing', 530900, 3, '0883', '675900', 99.9284, 24.5803);
INSERT INTO `app_area` VALUES (530922, '云县', 'Yunxian', 530900, 3, '0883', '675800', 100.128, 24.4468);
INSERT INTO `app_area` VALUES (530923, '永德县', 'Yongde', 530900, 3, '0883', '677600', 99.2533, 24.0276);
INSERT INTO `app_area` VALUES (530924, '镇康县', 'Zhenkang', 530900, 3, '0883', '677704', 98.8255, 23.7624);
INSERT INTO `app_area` VALUES (530925, '双江拉祜族佤族布朗族傣族自治县', 'Shuangjiang', 530900, 3, '0883', '677300', 99.8277, 23.4735);
INSERT INTO `app_area` VALUES (530926, '耿马傣族佤族自治县', 'Gengma', 530900, 3, '0883', '677500', 99.3979, 23.5378);
INSERT INTO `app_area` VALUES (530927, '沧源佤族自治县', 'Cangyuan', 530900, 3, '0883', '677400', 99.2455, 23.1482);
INSERT INTO `app_area` VALUES (532300, '楚雄彝族自治州', 'Chuxiong', 530000, 2, '0878', '675000', 101.546, 25.042);
INSERT INTO `app_area` VALUES (532301, '楚雄市', 'Chuxiong', 532300, 3, '0878', '675000', 101.546, 25.0329);
INSERT INTO `app_area` VALUES (532322, '双柏县', 'Shuangbai', 532300, 3, '0878', '675100', 101.642, 24.6888);
INSERT INTO `app_area` VALUES (532323, '牟定县', 'Mouding', 532300, 3, '0878', '675500', 101.54, 25.3155);
INSERT INTO `app_area` VALUES (532324, '南华县', 'Nanhua', 532300, 3, '0878', '675200', 101.273, 25.1929);
INSERT INTO `app_area` VALUES (532325, '姚安县', 'Yao\'an', 532300, 3, '0878', '675300', 101.243, 25.5047);
INSERT INTO `app_area` VALUES (532326, '大姚县', 'Dayao', 532300, 3, '0878', '675400', 101.324, 25.7222);
INSERT INTO `app_area` VALUES (532327, '永仁县', 'Yongren', 532300, 3, '0878', '651400', 101.672, 26.0579);
INSERT INTO `app_area` VALUES (532328, '元谋县', 'Yuanmou', 532300, 3, '0878', '651300', 101.877, 25.7044);
INSERT INTO `app_area` VALUES (532329, '武定县', 'Wuding', 532300, 3, '0878', '651600', 102.404, 25.5295);
INSERT INTO `app_area` VALUES (532331, '禄丰县', 'Lufeng', 532300, 3, '0878', '651200', 102.078, 25.1481);
INSERT INTO `app_area` VALUES (532500, '红河哈尼族彝族自治州', 'Honghe', 530000, 2, '0873', '661400', 103.384, 23.3668);
INSERT INTO `app_area` VALUES (532501, '个旧市', 'Gejiu', 532500, 3, '0873', '661000', 103.16, 23.3589);
INSERT INTO `app_area` VALUES (532502, '开远市', 'Kaiyuan', 532500, 3, '0873', '661600', 103.27, 23.7101);
INSERT INTO `app_area` VALUES (532503, '蒙自市', 'Mengzi', 532500, 3, '0873', '661101', 103.385, 23.3668);
INSERT INTO `app_area` VALUES (532504, '弥勒市', 'Mile ', 532500, 3, '0873', '652300', 103.437, 24.4084);
INSERT INTO `app_area` VALUES (532523, '屏边苗族自治县', 'Pingbian', 532500, 3, '0873', '661200', 103.686, 22.9842);
INSERT INTO `app_area` VALUES (532524, '建水县', 'Jianshui', 532500, 3, '0873', '654300', 102.827, 23.6347);
INSERT INTO `app_area` VALUES (532525, '石屏县', 'Shiping', 532500, 3, '0873', '662200', 102.494, 23.7144);
INSERT INTO `app_area` VALUES (532527, '泸西县', 'Luxi', 532500, 3, '0873', '652400', 103.764, 24.5285);
INSERT INTO `app_area` VALUES (532528, '元阳县', 'Yuanyang', 532500, 3, '0873', '662400', 102.833, 23.2228);
INSERT INTO `app_area` VALUES (532529, '红河县', 'Honghexian', 532500, 3, '0873', '654400', 102.421, 23.3677);
INSERT INTO `app_area` VALUES (532530, '金平苗族瑶族傣族自治县', 'Jinping', 532500, 3, '0873', '661500', 103.227, 22.7796);
INSERT INTO `app_area` VALUES (532531, '绿春县', 'Lvchun', 532500, 3, '0873', '662500', 102.397, 22.9937);
INSERT INTO `app_area` VALUES (532532, '河口瑶族自治县', 'Hekou', 532500, 3, '0873', '661300', 103.939, 22.5293);
INSERT INTO `app_area` VALUES (532600, '文山壮族苗族自治州', 'Wenshan', 530000, 2, '0876', '663000', 104.244, 23.3695);
INSERT INTO `app_area` VALUES (532601, '文山市', 'Wenshan', 532600, 3, '0876', '663000', 104.244, 23.3692);
INSERT INTO `app_area` VALUES (532622, '砚山县', 'Yanshan', 532600, 3, '0876', '663100', 104.333, 23.6072);
INSERT INTO `app_area` VALUES (532623, '西畴县', 'Xichou', 532600, 3, '0876', '663500', 104.674, 23.4394);
INSERT INTO `app_area` VALUES (532624, '麻栗坡县', 'Malipo', 532600, 3, '0876', '663600', 104.701, 23.1203);
INSERT INTO `app_area` VALUES (532625, '马关县', 'Maguan', 532600, 3, '0876', '663700', 104.395, 23.0129);
INSERT INTO `app_area` VALUES (532626, '丘北县', 'Qiubei', 532600, 3, '0876', '663200', 104.193, 24.0396);
INSERT INTO `app_area` VALUES (532627, '广南县', 'Guangnan', 532600, 3, '0876', '663300', 105.055, 24.0464);
INSERT INTO `app_area` VALUES (532628, '富宁县', 'Funing', 532600, 3, '0876', '663400', 105.631, 23.6254);
INSERT INTO `app_area` VALUES (532800, '西双版纳傣族自治州', 'Xishuangbanna', 530000, 2, '0691', '666100', 100.798, 22.0017);
INSERT INTO `app_area` VALUES (532801, '景洪市', 'Jinghong', 532800, 3, '0691', '666100', 100.8, 22.0107);
INSERT INTO `app_area` VALUES (532822, '勐海县', 'Menghai', 532800, 3, '0691', '666200', 100.449, 21.9618);
INSERT INTO `app_area` VALUES (532823, '勐腊县', 'Mengla', 532800, 3, '0691', '666300', 101.565, 21.4816);
INSERT INTO `app_area` VALUES (532900, '大理白族自治州', 'Dali', 530000, 2, '0872', '671000', 100.24, 25.5928);
INSERT INTO `app_area` VALUES (532901, '大理市', 'Dali', 532900, 3, '0872', '671000', 100.23, 25.5916);
INSERT INTO `app_area` VALUES (532922, '漾濞彝族自治县', 'Yangbi', 532900, 3, '0872', '672500', 99.9547, 25.6652);
INSERT INTO `app_area` VALUES (532923, '祥云县', 'Xiangyun', 532900, 3, '0872', '672100', 100.558, 25.4734);
INSERT INTO `app_area` VALUES (532924, '宾川县', 'Binchuan', 532900, 3, '0872', '671600', 100.577, 25.8314);
INSERT INTO `app_area` VALUES (532925, '弥渡县', 'Midu', 532900, 3, '0872', '675600', 100.491, 25.3418);
INSERT INTO `app_area` VALUES (532926, '南涧彝族自治县', 'Nanjian', 532900, 3, '0872', '675700', 100.51, 25.0435);
INSERT INTO `app_area` VALUES (532927, '巍山彝族回族自治县', 'Weishan', 532900, 3, '0872', '672400', 100.306, 25.232);
INSERT INTO `app_area` VALUES (532928, '永平县', 'Yongping', 532900, 3, '0872', '672600', 99.5409, 25.4645);
INSERT INTO `app_area` VALUES (532929, '云龙县', 'Yunlong', 532900, 3, '0872', '672700', 99.3726, 25.885);
INSERT INTO `app_area` VALUES (532930, '洱源县', 'Eryuan', 532900, 3, '0872', '671200', 99.949, 26.1083);
INSERT INTO `app_area` VALUES (532931, '剑川县', 'Jianchuan', 532900, 3, '0872', '671300', 99.9054, 26.5369);
INSERT INTO `app_area` VALUES (532932, '鹤庆县', 'Heqing', 532900, 3, '0872', '671500', 100.177, 26.558);
INSERT INTO `app_area` VALUES (533100, '德宏傣族景颇族自治州', 'Dehong', 530000, 2, '0692', '678400', 98.5784, 24.4367);
INSERT INTO `app_area` VALUES (533102, '瑞丽市', 'Ruili', 533100, 3, '0692', '678600', 97.8518, 24.0128);
INSERT INTO `app_area` VALUES (533103, '芒市', 'Mangshi', 533100, 3, '0692', '678400', 98.5886, 24.4337);
INSERT INTO `app_area` VALUES (533122, '梁河县', 'Lianghe', 533100, 3, '0692', '679200', 98.2971, 24.8066);
INSERT INTO `app_area` VALUES (533123, '盈江县', 'Yingjiang', 533100, 3, '0692', '679300', 97.9318, 24.7058);
INSERT INTO `app_area` VALUES (533124, '陇川县', 'Longchuan', 533100, 3, '0692', '678700', 97.792, 24.183);
INSERT INTO `app_area` VALUES (533300, '怒江傈僳族自治州', 'Nujiang', 530000, 2, '0886', '673100', 98.8543, 25.8509);
INSERT INTO `app_area` VALUES (533321, '泸水县', 'Lushui', 533300, 3, '0886', '673100', 98.8553, 25.8377);
INSERT INTO `app_area` VALUES (533323, '福贡县', 'Fugong', 533300, 3, '0886', '673400', 98.8697, 26.9037);
INSERT INTO `app_area` VALUES (533324, '贡山独龙族怒族自治县', 'Gongshan', 533300, 3, '0886', '673500', 98.6658, 27.7409);
INSERT INTO `app_area` VALUES (533325, '兰坪白族普米族自治县', 'Lanping', 533300, 3, '0886', '671400', 99.4189, 26.4525);
INSERT INTO `app_area` VALUES (533400, '迪庆藏族自治州', 'Deqen', 530000, 2, '0887', '674400', 99.7065, 27.8269);
INSERT INTO `app_area` VALUES (533421, '香格里拉市', 'Xianggelila', 533400, 3, '0887', '674400', 99.706, 27.8231);
INSERT INTO `app_area` VALUES (533422, '德钦县', 'Deqin', 533400, 3, '0887', '674500', 98.9108, 28.4863);
INSERT INTO `app_area` VALUES (533423, '维西傈僳族自治县', 'Weixi', 533400, 3, '0887', '674600', 99.284, 27.1793);
INSERT INTO `app_area` VALUES (540000, '西藏自治区', 'Tibet', 100000, 1, '', '', 91.1322, 29.6604);
INSERT INTO `app_area` VALUES (540100, '拉萨市', 'Lhasa', 540000, 2, '0891', '850000', 91.1322, 29.6604);
INSERT INTO `app_area` VALUES (540102, '城关区', 'Chengguan', 540100, 3, '0891', '850000', 91.1386, 29.6531);
INSERT INTO `app_area` VALUES (540121, '林周县', 'Linzhou', 540100, 3, '0891', '851600', 91.2586, 29.8944);
INSERT INTO `app_area` VALUES (540122, '当雄县', 'Dangxiong', 540100, 3, '0891', '851500', 91.1008, 30.4831);
INSERT INTO `app_area` VALUES (540123, '尼木县', 'Nimu', 540100, 3, '0891', '851300', 90.1638, 29.4335);
INSERT INTO `app_area` VALUES (540124, '曲水县', 'Qushui', 540100, 3, '0891', '850600', 90.7319, 29.3564);
INSERT INTO `app_area` VALUES (540125, '堆龙德庆县', 'Duilongdeqing', 540100, 3, '0891', '851400', 91.0003, 29.65);
INSERT INTO `app_area` VALUES (540126, '达孜县', 'Dazi', 540100, 3, '0891', '850100', 91.3576, 29.6722);
INSERT INTO `app_area` VALUES (540127, '墨竹工卡县', 'Mozhugongka', 540100, 3, '0891', '850200', 91.7281, 29.8361);
INSERT INTO `app_area` VALUES (540200, '日喀则市', 'Rikaze', 540000, 2, '0892', '857000', 88.8849, 29.2638);
INSERT INTO `app_area` VALUES (540202, '桑珠孜区', 'Sangzhuzi', 540200, 3, '0892', '857000', 88.8804, 29.2696);
INSERT INTO `app_area` VALUES (540221, '南木林县', 'Nanmulin', 540200, 3, '0892', '857100', 89.0969, 29.6821);
INSERT INTO `app_area` VALUES (540222, '江孜县', 'Jiangzi', 540200, 3, '0892', '857400', 89.6026, 28.9174);
INSERT INTO `app_area` VALUES (540223, '定日县', 'Dingri', 540200, 3, '0892', '858200', 87.1218, 28.6613);
INSERT INTO `app_area` VALUES (540224, '萨迦县', 'Sajia', 540200, 3, '0892', '857800', 88.0219, 28.903);
INSERT INTO `app_area` VALUES (540225, '拉孜县', 'Lazi', 540200, 3, '0892', '858100', 87.6341, 29.085);
INSERT INTO `app_area` VALUES (540226, '昂仁县', 'Angren', 540200, 3, '0892', '858500', 87.2386, 29.295);
INSERT INTO `app_area` VALUES (540227, '谢通门县', 'Xietongmen', 540200, 3, '0892', '858900', 88.2624, 29.4334);
INSERT INTO `app_area` VALUES (540228, '白朗县', 'Bailang', 540200, 3, '0892', '857300', 89.262, 29.1055);
INSERT INTO `app_area` VALUES (540229, '仁布县', 'Renbu', 540200, 3, '0892', '857200', 89.8423, 29.2301);
INSERT INTO `app_area` VALUES (540230, '康马县', 'Kangma', 540200, 3, '0892', '857500', 89.6853, 28.5567);
INSERT INTO `app_area` VALUES (540231, '定结县', 'Dingjie', 540200, 3, '0892', '857900', 87.7726, 28.364);
INSERT INTO `app_area` VALUES (540232, '仲巴县', 'Zhongba', 540200, 3, '0892', '858800', 84.0295, 29.7659);
INSERT INTO `app_area` VALUES (540233, '亚东县', 'Yadong', 540200, 3, '0892', '857600', 88.908, 27.4839);
INSERT INTO `app_area` VALUES (540234, '吉隆县', 'Jilong', 540200, 3, '0892', '858700', 85.2985, 28.8538);
INSERT INTO `app_area` VALUES (540235, '聂拉木县', 'Nielamu', 540200, 3, '0892', '858300', 85.98, 28.1565);
INSERT INTO `app_area` VALUES (540236, '萨嘎县', 'Saga', 540200, 3, '0892', '857800', 85.2341, 29.3294);
INSERT INTO `app_area` VALUES (540237, '岗巴县', 'Gangba', 540200, 3, '0892', '857700', 88.5207, 28.275);
INSERT INTO `app_area` VALUES (540300, '昌都市', 'Qamdo', 540000, 2, '0895', '854000', 97.1785, 31.1369);
INSERT INTO `app_area` VALUES (540302, '卡若区', 'Karuo', 540300, 3, '0895', '854000', 97.1804, 31.1385);
INSERT INTO `app_area` VALUES (540321, '江达县', 'Jiangda', 540300, 3, '0895', '854100', 98.2187, 31.5034);
INSERT INTO `app_area` VALUES (540322, '贡觉县', 'Gongjue', 540300, 3, '0895', '854200', 98.2716, 30.8594);
INSERT INTO `app_area` VALUES (540323, '类乌齐县', 'Leiwuqi', 540300, 3, '0895', '855600', 96.6002, 31.2121);
INSERT INTO `app_area` VALUES (540324, '丁青县', 'Dingqing', 540300, 3, '0895', '855700', 95.5936, 31.4162);
INSERT INTO `app_area` VALUES (540325, '察雅县', 'Chaya', 540300, 3, '0895', '854300', 97.5652, 30.6534);
INSERT INTO `app_area` VALUES (540326, '八宿县', 'Basu', 540300, 3, '0895', '854600', 96.9176, 30.0535);
INSERT INTO `app_area` VALUES (540327, '左贡县', 'Zuogong', 540300, 3, '0895', '854400', 97.8443, 29.6711);
INSERT INTO `app_area` VALUES (540328, '芒康县', 'Mangkang', 540300, 3, '0895', '854500', 98.5938, 29.6795);
INSERT INTO `app_area` VALUES (540329, '洛隆县', 'Luolong', 540300, 3, '0895', '855400', 95.8264, 30.7405);
INSERT INTO `app_area` VALUES (540330, '边坝县', 'Bianba', 540300, 3, '0895', '855500', 94.7069, 30.9343);
INSERT INTO `app_area` VALUES (542200, '山南地区', 'Shannan', 540000, 2, '0893', '856000', 91.7665, 29.236);
INSERT INTO `app_area` VALUES (542221, '乃东县', 'Naidong', 542200, 3, '0893', '856100', 91.7615, 29.2249);
INSERT INTO `app_area` VALUES (542222, '扎囊县', 'Zhanang', 542200, 3, '0893', '850800', 91.3329, 29.2399);
INSERT INTO `app_area` VALUES (542223, '贡嘎县', 'Gongga', 542200, 3, '0893', '850700', 90.9887, 29.2941);
INSERT INTO `app_area` VALUES (542224, '桑日县', 'Sangri', 542200, 3, '0893', '856200', 92.0201, 29.2664);
INSERT INTO `app_area` VALUES (542225, '琼结县', 'Qiongjie', 542200, 3, '0893', '856800', 91.6809, 29.0263);
INSERT INTO `app_area` VALUES (542226, '曲松县', 'Qusong', 542200, 3, '0893', '856300', 92.2026, 29.0641);
INSERT INTO `app_area` VALUES (542227, '措美县', 'Cuomei', 542200, 3, '0893', '856900', 91.4324, 28.4379);
INSERT INTO `app_area` VALUES (542228, '洛扎县', 'Luozha', 542200, 3, '0893', '856600', 90.8604, 28.3872);
INSERT INTO `app_area` VALUES (542229, '加查县', 'Jiacha', 542200, 3, '0893', '856400', 92.577, 29.1397);
INSERT INTO `app_area` VALUES (542231, '隆子县', 'Longzi', 542200, 3, '0893', '856600', 92.4615, 28.408);
INSERT INTO `app_area` VALUES (542232, '错那县', 'Cuona', 542200, 3, '0893', '856700', 91.9575, 27.9922);
INSERT INTO `app_area` VALUES (542233, '浪卡子县', 'Langkazi', 542200, 3, '0893', '851100', 90.4, 28.9695);
INSERT INTO `app_area` VALUES (542400, '那曲地区', 'Nagqu', 540000, 2, '0896', '852000', 92.0602, 31.476);
INSERT INTO `app_area` VALUES (542421, '那曲县', 'Naqu', 542400, 3, '0896', '852000', 92.0535, 31.4696);
INSERT INTO `app_area` VALUES (542422, '嘉黎县', 'Jiali', 542400, 3, '0896', '852400', 93.2499, 30.6423);
INSERT INTO `app_area` VALUES (542423, '比如县', 'Biru', 542400, 3, '0896', '852300', 93.6869, 31.4779);
INSERT INTO `app_area` VALUES (542424, '聂荣县', 'Nierong', 542400, 3, '0896', '853500', 92.2957, 32.1119);
INSERT INTO `app_area` VALUES (542425, '安多县', 'Anduo', 542400, 3, '0896', '853400', 91.6795, 32.2612);
INSERT INTO `app_area` VALUES (542426, '申扎县', 'Shenzha', 542400, 3, '0896', '853100', 88.7078, 30.93);
INSERT INTO `app_area` VALUES (542427, '索县', 'Suoxian', 542400, 3, '0896', '852200', 93.783, 31.8843);
INSERT INTO `app_area` VALUES (542428, '班戈县', 'Bange', 542400, 3, '0896', '852500', 90.0191, 31.3615);
INSERT INTO `app_area` VALUES (542429, '巴青县', 'Baqing', 542400, 3, '0896', '852100', 94.0532, 31.9183);
INSERT INTO `app_area` VALUES (542430, '尼玛县', 'Nima', 542400, 3, '0896', '852600', 87.2526, 31.7965);
INSERT INTO `app_area` VALUES (542431, '双湖县', 'Shuanghu', 542400, 3, '0896', '852600', 88.8378, 33.189);
INSERT INTO `app_area` VALUES (542500, '阿里地区', 'Ngari', 540000, 2, '0897', '859000', 80.1055, 32.5032);
INSERT INTO `app_area` VALUES (542521, '普兰县', 'Pulan', 542500, 3, '0897', '859500', 81.177, 30.3);
INSERT INTO `app_area` VALUES (542522, '札达县', 'Zhada', 542500, 3, '0897', '859600', 79.8026, 31.4834);
INSERT INTO `app_area` VALUES (542523, '噶尔县', 'Gaer', 542500, 3, '0897', '859400', 80.0958, 32.5002);
INSERT INTO `app_area` VALUES (542524, '日土县', 'Ritu', 542500, 3, '0897', '859700', 79.7131, 33.3874);
INSERT INTO `app_area` VALUES (542525, '革吉县', 'Geji', 542500, 3, '0897', '859100', 81.151, 32.3964);
INSERT INTO `app_area` VALUES (542526, '改则县', 'Gaize', 542500, 3, '0897', '859200', 84.063, 32.3045);
INSERT INTO `app_area` VALUES (542527, '措勤县', 'Cuoqin', 542500, 3, '0897', '859300', 85.1662, 31.021);
INSERT INTO `app_area` VALUES (542600, '林芝地区', 'Nyingchi', 540000, 2, '0894', '850400', 94.3624, 29.6547);
INSERT INTO `app_area` VALUES (542621, '林芝县', 'Linzhi', 542600, 3, '0894', '850400', 94.4839, 29.5756);
INSERT INTO `app_area` VALUES (542622, '工布江达县', 'Gongbujiangda', 542600, 3, '0894', '850300', 93.2452, 29.8858);
INSERT INTO `app_area` VALUES (542623, '米林县', 'Milin', 542600, 3, '0894', '850500', 94.2132, 29.2153);
INSERT INTO `app_area` VALUES (542624, '墨脱县', 'Motuo', 542600, 3, '0894', '855300', 95.3316, 29.327);
INSERT INTO `app_area` VALUES (542625, '波密县', 'Bomi', 542600, 3, '0894', '855200', 95.771, 29.8591);
INSERT INTO `app_area` VALUES (542626, '察隅县', 'Chayu', 542600, 3, '0894', '855100', 97.4668, 28.6618);
INSERT INTO `app_area` VALUES (542627, '朗县', 'Langxian', 542600, 3, '0894', '856500', 93.0754, 29.0455);
INSERT INTO `app_area` VALUES (610000, '陕西省', 'Shaanxi', 100000, 1, '', '', 108.948, 34.2632);
INSERT INTO `app_area` VALUES (610100, '西安市', 'Xi\'an', 610000, 2, '029', '710003', 108.948, 34.2632);
INSERT INTO `app_area` VALUES (610102, '新城区', 'Xincheng', 610100, 3, '029', '710004', 108.961, 34.2664);
INSERT INTO `app_area` VALUES (610103, '碑林区', 'Beilin', 610100, 3, '029', '710001', 108.934, 34.2304);
INSERT INTO `app_area` VALUES (610104, '莲湖区', 'Lianhu', 610100, 3, '029', '710003', 108.94, 34.2671);
INSERT INTO `app_area` VALUES (610111, '灞桥区', 'Baqiao', 610100, 3, '029', '710038', 109.065, 34.2726);
INSERT INTO `app_area` VALUES (610112, '未央区', 'Weiyang', 610100, 3, '029', '710014', 108.947, 34.293);
INSERT INTO `app_area` VALUES (610113, '雁塔区', 'Yanta', 610100, 3, '029', '710061', 108.949, 34.2225);
INSERT INTO `app_area` VALUES (610114, '阎良区', 'Yanliang', 610100, 3, '029', '710087', 109.226, 34.6622);
INSERT INTO `app_area` VALUES (610115, '临潼区', 'Lintong', 610100, 3, '029', '710600', 109.214, 34.3666);
INSERT INTO `app_area` VALUES (610116, '长安区', 'Chang\'an', 610100, 3, '029', '710100', 108.946, 34.1556);
INSERT INTO `app_area` VALUES (610122, '蓝田县', 'Lantian', 610100, 3, '029', '710500', 109.323, 34.1513);
INSERT INTO `app_area` VALUES (610124, '周至县', 'Zhouzhi', 610100, 3, '029', '710400', 108.222, 34.1634);
INSERT INTO `app_area` VALUES (610125, '户县', 'Huxian', 610100, 3, '029', '710300', 108.605, 34.1086);
INSERT INTO `app_area` VALUES (610126, '高陵区', 'Gaoling', 610100, 3, '029', '710200', 109.088, 34.5348);
INSERT INTO `app_area` VALUES (610200, '铜川市', 'Tongchuan', 610000, 2, '0919', '727100', 108.963, 34.9089);
INSERT INTO `app_area` VALUES (610202, '王益区', 'Wangyi', 610200, 3, '0919', '727000', 109.076, 35.069);
INSERT INTO `app_area` VALUES (610203, '印台区', 'Yintai', 610200, 3, '0919', '727007', 109.102, 35.1169);
INSERT INTO `app_area` VALUES (610204, '耀州区', 'Yaozhou', 610200, 3, '0919', '727100', 108.986, 34.9131);
INSERT INTO `app_area` VALUES (610222, '宜君县', 'Yijun', 610200, 3, '0919', '727200', 109.118, 35.4011);
INSERT INTO `app_area` VALUES (610300, '宝鸡市', 'Baoji', 610000, 2, '0917', '721000', 107.145, 34.3693);
INSERT INTO `app_area` VALUES (610302, '渭滨区', 'Weibin', 610300, 3, '0917', '721000', 107.15, 34.3712);
INSERT INTO `app_area` VALUES (610303, '金台区', 'Jintai', 610300, 3, '0917', '721000', 107.147, 34.3761);
INSERT INTO `app_area` VALUES (610304, '陈仓区', 'Chencang', 610300, 3, '0917', '721300', 107.387, 34.3545);
INSERT INTO `app_area` VALUES (610322, '凤翔县', 'Fengxiang', 610300, 3, '0917', '721400', 107.396, 34.5232);
INSERT INTO `app_area` VALUES (610323, '岐山县', 'Qishan', 610300, 3, '0917', '722400', 107.622, 34.4438);
INSERT INTO `app_area` VALUES (610324, '扶风县', 'Fufeng', 610300, 3, '0917', '722200', 107.9, 34.3752);
INSERT INTO `app_area` VALUES (610326, '眉县', 'Meixian', 610300, 3, '0917', '722300', 107.751, 34.2757);
INSERT INTO `app_area` VALUES (610327, '陇县', 'Longxian', 610300, 3, '0917', '721200', 106.859, 34.894);
INSERT INTO `app_area` VALUES (610328, '千阳县', 'Qianyang', 610300, 3, '0917', '721100', 107.13, 34.6422);
INSERT INTO `app_area` VALUES (610329, '麟游县', 'Linyou', 610300, 3, '0917', '721500', 107.796, 34.6784);
INSERT INTO `app_area` VALUES (610330, '凤县', 'Fengxian', 610300, 3, '0917', '721700', 106.524, 33.9117);
INSERT INTO `app_area` VALUES (610331, '太白县', 'Taibai', 610300, 3, '0917', '721600', 107.316, 34.0621);
INSERT INTO `app_area` VALUES (610400, '咸阳市', 'Xianyang', 610000, 2, '029', '712000', 108.705, 34.3334);
INSERT INTO `app_area` VALUES (610402, '秦都区', 'Qindu', 610400, 3, '029', '712000', 108.715, 34.338);
INSERT INTO `app_area` VALUES (610403, '杨陵区', 'Yangling', 610400, 3, '029', '712100', 108.083, 34.2704);
INSERT INTO `app_area` VALUES (610404, '渭城区', 'Weicheng', 610400, 3, '029', '712000', 108.722, 34.332);
INSERT INTO `app_area` VALUES (610422, '三原县', 'Sanyuan', 610400, 3, '029', '713800', 108.932, 34.6156);
INSERT INTO `app_area` VALUES (610423, '泾阳县', 'Jingyang', 610400, 3, '029', '713700', 108.843, 34.5271);
INSERT INTO `app_area` VALUES (610424, '乾县', 'Qianxian', 610400, 3, '029', '713300', 108.242, 34.5295);
INSERT INTO `app_area` VALUES (610425, '礼泉县', 'Liquan', 610400, 3, '029', '713200', 108.426, 34.4846);
INSERT INTO `app_area` VALUES (610426, '永寿县', 'Yongshou', 610400, 3, '029', '713400', 108.145, 34.6908);
INSERT INTO `app_area` VALUES (610427, '彬县', 'Binxian', 610400, 3, '029', '713500', 108.085, 35.0342);
INSERT INTO `app_area` VALUES (610428, '长武县', 'Changwu', 610400, 3, '029', '713600', 107.795, 35.2067);
INSERT INTO `app_area` VALUES (610429, '旬邑县', 'Xunyi', 610400, 3, '029', '711300', 108.334, 35.1134);
INSERT INTO `app_area` VALUES (610430, '淳化县', 'Chunhua', 610400, 3, '029', '711200', 108.58, 34.7989);
INSERT INTO `app_area` VALUES (610431, '武功县', 'Wugong', 610400, 3, '029', '712200', 108.204, 34.26);
INSERT INTO `app_area` VALUES (610481, '兴平市', 'Xingping', 610400, 3, '029', '713100', 108.491, 34.2979);
INSERT INTO `app_area` VALUES (610500, '渭南市', 'Weinan', 610000, 2, '0913', '714000', 109.503, 34.4994);
INSERT INTO `app_area` VALUES (610502, '临渭区', 'Linwei', 610500, 3, '0913', '714000', 109.493, 34.4982);
INSERT INTO `app_area` VALUES (610521, '华县', 'Huaxian', 610500, 3, '0913', '714100', 109.772, 34.5126);
INSERT INTO `app_area` VALUES (610522, '潼关县', 'Tongguan', 610500, 3, '0913', '714300', 110.244, 34.5428);
INSERT INTO `app_area` VALUES (610523, '大荔县', 'Dali', 610500, 3, '0913', '715100', 109.942, 34.7957);
INSERT INTO `app_area` VALUES (610524, '合阳县', 'Heyang', 610500, 3, '0913', '715300', 110.149, 35.238);
INSERT INTO `app_area` VALUES (610525, '澄城县', 'Chengcheng', 610500, 3, '0913', '715200', 109.934, 35.184);
INSERT INTO `app_area` VALUES (610526, '蒲城县', 'Pucheng', 610500, 3, '0913', '715500', 109.59, 34.9568);
INSERT INTO `app_area` VALUES (610527, '白水县', 'Baishui', 610500, 3, '0913', '715600', 109.593, 35.1786);
INSERT INTO `app_area` VALUES (610528, '富平县', 'Fuping', 610500, 3, '0913', '711700', 109.18, 34.7511);
INSERT INTO `app_area` VALUES (610581, '韩城市', 'Hancheng', 610500, 3, '0913', '715400', 110.442, 35.4793);
INSERT INTO `app_area` VALUES (610582, '华阴市', 'Huayin', 610500, 3, '0913', '714200', 110.088, 34.5661);
INSERT INTO `app_area` VALUES (610600, '延安市', 'Yan\'an', 610000, 2, '0911', '716000', 109.491, 36.5965);
INSERT INTO `app_area` VALUES (610602, '宝塔区', 'Baota', 610600, 3, '0911', '716000', 109.493, 36.5915);
INSERT INTO `app_area` VALUES (610621, '延长县', 'Yanchang', 610600, 3, '0911', '717100', 110.011, 36.579);
INSERT INTO `app_area` VALUES (610622, '延川县', 'Yanchuan', 610600, 3, '0911', '717200', 110.194, 36.8782);
INSERT INTO `app_area` VALUES (610623, '子长县', 'Zichang', 610600, 3, '0911', '717300', 109.675, 37.1425);
INSERT INTO `app_area` VALUES (610624, '安塞县', 'Ansai', 610600, 3, '0911', '717400', 109.327, 36.8651);
INSERT INTO `app_area` VALUES (610625, '志丹县', 'Zhidan', 610600, 3, '0911', '717500', 108.768, 36.8218);
INSERT INTO `app_area` VALUES (610626, '吴起县', 'Wuqi', 610600, 3, '0911', '717600', 108.176, 36.9278);
INSERT INTO `app_area` VALUES (610627, '甘泉县', 'Ganquan', 610600, 3, '0911', '716100', 109.35, 36.2775);
INSERT INTO `app_area` VALUES (610628, '富县', 'Fuxian', 610600, 3, '0911', '727500', 109.379, 35.988);
INSERT INTO `app_area` VALUES (610629, '洛川县', 'Luochuan', 610600, 3, '0911', '727400', 109.433, 35.7608);
INSERT INTO `app_area` VALUES (610630, '宜川县', 'Yichuan', 610600, 3, '0911', '716200', 110.172, 36.0473);
INSERT INTO `app_area` VALUES (610631, '黄龙县', 'Huanglong', 610600, 3, '0911', '715700', 109.843, 35.5835);
INSERT INTO `app_area` VALUES (610632, '黄陵县', 'Huangling', 610600, 3, '0911', '727300', 109.263, 35.5836);
INSERT INTO `app_area` VALUES (610700, '汉中市', 'Hanzhong', 610000, 2, '0916', '723000', 107.029, 33.0777);
INSERT INTO `app_area` VALUES (610702, '汉台区', 'Hantai', 610700, 3, '0916', '723000', 107.032, 33.0677);
INSERT INTO `app_area` VALUES (610721, '南郑县', 'Nanzheng', 610700, 3, '0916', '723100', 106.94, 33.003);
INSERT INTO `app_area` VALUES (610722, '城固县', 'Chenggu', 610700, 3, '0916', '723200', 107.334, 33.1566);
INSERT INTO `app_area` VALUES (610723, '洋县', 'Yangxian', 610700, 3, '0916', '723300', 107.547, 33.221);
INSERT INTO `app_area` VALUES (610724, '西乡县', 'Xixiang', 610700, 3, '0916', '723500', 107.769, 32.9841);
INSERT INTO `app_area` VALUES (610725, '勉县', 'Mianxian', 610700, 3, '0916', '724200', 106.676, 33.1527);
INSERT INTO `app_area` VALUES (610726, '宁强县', 'Ningqiang', 610700, 3, '0916', '724400', 106.26, 32.8288);
INSERT INTO `app_area` VALUES (610727, '略阳县', 'Lueyang', 610700, 3, '0916', '724300', 106.154, 33.3301);
INSERT INTO `app_area` VALUES (610728, '镇巴县', 'Zhenba', 610700, 3, '0916', '723600', 107.896, 32.5349);
INSERT INTO `app_area` VALUES (610729, '留坝县', 'Liuba', 610700, 3, '0916', '724100', 106.922, 33.6161);
INSERT INTO `app_area` VALUES (610730, '佛坪县', 'Foping', 610700, 3, '0916', '723400', 107.99, 33.525);
INSERT INTO `app_area` VALUES (610800, '榆林市', 'Yulin', 610000, 2, '0912', '719000', 109.741, 38.2902);
INSERT INTO `app_area` VALUES (610802, '榆阳区', 'Yuyang', 610800, 3, '0912', '719000', 109.735, 38.2784);
INSERT INTO `app_area` VALUES (610821, '神木县', 'Shenmu', 610800, 3, '0912', '719300', 110.499, 38.8423);
INSERT INTO `app_area` VALUES (610822, '府谷县', 'Fugu', 610800, 3, '0912', '719400', 111.067, 39.028);
INSERT INTO `app_area` VALUES (610823, '横山县', 'Hengshan', 610800, 3, '0912', '719100', 109.296, 37.958);
INSERT INTO `app_area` VALUES (610824, '靖边县', 'Jingbian', 610800, 3, '0912', '718500', 108.794, 37.5994);
INSERT INTO `app_area` VALUES (610825, '定边县', 'Dingbian', 610800, 3, '0912', '718600', 107.598, 37.5904);
INSERT INTO `app_area` VALUES (610826, '绥德县', 'Suide', 610800, 3, '0912', '718000', 110.261, 37.4978);
INSERT INTO `app_area` VALUES (610827, '米脂县', 'Mizhi', 610800, 3, '0912', '718100', 110.184, 37.7553);
INSERT INTO `app_area` VALUES (610828, '佳县', 'Jiaxian', 610800, 3, '0912', '719200', 110.494, 38.0225);
INSERT INTO `app_area` VALUES (610829, '吴堡县', 'Wubu', 610800, 3, '0912', '718200', 110.745, 37.4571);
INSERT INTO `app_area` VALUES (610830, '清涧县', 'Qingjian', 610800, 3, '0912', '718300', 110.122, 37.0885);
INSERT INTO `app_area` VALUES (610831, '子洲县', 'Zizhou', 610800, 3, '0912', '718400', 110.035, 37.6124);
INSERT INTO `app_area` VALUES (610900, '安康市', 'Ankang', 610000, 2, '0915', '725000', 109.029, 32.6903);
INSERT INTO `app_area` VALUES (610902, '汉滨区', 'Hanbin', 610900, 3, '0915', '725000', 109.027, 32.6952);
INSERT INTO `app_area` VALUES (610921, '汉阴县', 'Hanyin', 610900, 3, '0915', '725100', 108.511, 32.8913);
INSERT INTO `app_area` VALUES (610922, '石泉县', 'Shiquan', 610900, 3, '0915', '725200', 108.248, 33.0397);
INSERT INTO `app_area` VALUES (610923, '宁陕县', 'Ningshan', 610900, 3, '0915', '711600', 108.315, 33.3173);
INSERT INTO `app_area` VALUES (610924, '紫阳县', 'Ziyang', 610900, 3, '0915', '725300', 108.537, 32.5211);
INSERT INTO `app_area` VALUES (610925, '岚皋县', 'Langao', 610900, 3, '0915', '725400', 108.903, 32.3079);
INSERT INTO `app_area` VALUES (610926, '平利县', 'Pingli', 610900, 3, '0915', '725500', 109.358, 32.3911);
INSERT INTO `app_area` VALUES (610927, '镇坪县', 'Zhenping', 610900, 3, '0915', '725600', 109.525, 31.8833);
INSERT INTO `app_area` VALUES (610928, '旬阳县', 'Xunyang', 610900, 3, '0915', '725700', 109.362, 32.8321);
INSERT INTO `app_area` VALUES (610929, '白河县', 'Baihe', 610900, 3, '0915', '725800', 110.113, 32.8096);
INSERT INTO `app_area` VALUES (611000, '商洛市', 'Shangluo', 610000, 2, '0914', '726000', 109.94, 33.8683);
INSERT INTO `app_area` VALUES (611002, '商州区', 'Shangzhou', 611000, 3, '0914', '726000', 109.941, 33.8627);
INSERT INTO `app_area` VALUES (611021, '洛南县', 'Luonan', 611000, 3, '0914', '726100', 110.146, 34.0899);
INSERT INTO `app_area` VALUES (611022, '丹凤县', 'Danfeng', 611000, 3, '0914', '726200', 110.335, 33.6947);
INSERT INTO `app_area` VALUES (611023, '商南县', 'Shangnan', 611000, 3, '0914', '726300', 110.884, 33.5258);
INSERT INTO `app_area` VALUES (611024, '山阳县', 'Shanyang', 611000, 3, '0914', '726400', 109.888, 33.5293);
INSERT INTO `app_area` VALUES (611025, '镇安县', 'Zhen\'an', 611000, 3, '0914', '711500', 109.154, 33.4237);
INSERT INTO `app_area` VALUES (611026, '柞水县', 'Zhashui', 611000, 3, '0914', '711400', 109.111, 33.6831);
INSERT INTO `app_area` VALUES (611100, '西咸新区', 'Xixian', 610000, 2, '029', '712000', 108.811, 34.3071);
INSERT INTO `app_area` VALUES (611101, '空港新城', 'Konggang', 611100, 3, '0374', '461000', 108.761, 34.4409);
INSERT INTO `app_area` VALUES (611102, '沣东新城', 'Fengdong', 611100, 3, '029', '710000', 108.83, 34.2674);
INSERT INTO `app_area` VALUES (611103, '秦汉新城', 'Qinhan', 611100, 3, '029', '712000', 108.838, 34.3865);
INSERT INTO `app_area` VALUES (611104, '沣西新城', 'Fengxi', 611100, 3, '029', '710000', 108.712, 34.1905);
INSERT INTO `app_area` VALUES (611105, '泾河新城', 'Jinghe', 611100, 3, '029', '713700', 109.05, 34.4606);
INSERT INTO `app_area` VALUES (620000, '甘肃省', 'Gansu', 100000, 1, '', '', 103.824, 36.058);
INSERT INTO `app_area` VALUES (620100, '兰州市', 'Lanzhou', 620000, 2, '0931', '730030', 103.824, 36.058);
INSERT INTO `app_area` VALUES (620102, '城关区', 'Chengguan', 620100, 3, '0931', '730030', 103.825, 36.0573);
INSERT INTO `app_area` VALUES (620103, '七里河区', 'Qilihe', 620100, 3, '0931', '730050', 103.786, 36.0658);
INSERT INTO `app_area` VALUES (620104, '西固区', 'Xigu', 620100, 3, '0931', '730060', 103.628, 36.0886);
INSERT INTO `app_area` VALUES (620105, '安宁区', 'Anning', 620100, 3, '0931', '730070', 103.719, 36.1038);
INSERT INTO `app_area` VALUES (620111, '红古区', 'Honggu', 620100, 3, '0931', '730084', 102.86, 36.3454);
INSERT INTO `app_area` VALUES (620121, '永登县', 'Yongdeng', 620100, 3, '0931', '730300', 103.261, 36.7352);
INSERT INTO `app_area` VALUES (620122, '皋兰县', 'Gaolan', 620100, 3, '0931', '730200', 103.945, 36.3321);
INSERT INTO `app_area` VALUES (620123, '榆中县', 'Yuzhong', 620100, 3, '0931', '730100', 104.115, 35.8442);
INSERT INTO `app_area` VALUES (620200, '嘉峪关市', 'Jiayuguan', 620000, 2, '0937', '735100', 98.2773, 39.7865);
INSERT INTO `app_area` VALUES (620201, '雄关区', 'Xiongguan', 620200, 3, '0937', '735100', 98.2774, 39.7793);
INSERT INTO `app_area` VALUES (620202, '长城区', 'Changcheng', 620200, 3, '0937', '735106', 98.2735, 39.7874);
INSERT INTO `app_area` VALUES (620203, '镜铁区', 'Jingtie', 620200, 3, '0937', '735100', 98.2773, 39.7865);
INSERT INTO `app_area` VALUES (620300, '金昌市', 'Jinchang', 620000, 2, '0935', '737100', 102.188, 38.5142);
INSERT INTO `app_area` VALUES (620302, '金川区', 'Jinchuan', 620300, 3, '0935', '737100', 102.194, 38.521);
INSERT INTO `app_area` VALUES (620321, '永昌县', 'Yongchang', 620300, 3, '0935', '737200', 101.972, 38.2471);
INSERT INTO `app_area` VALUES (620400, '白银市', 'Baiyin', 620000, 2, '0943', '730900', 104.174, 36.5457);
INSERT INTO `app_area` VALUES (620402, '白银区', 'Baiyin', 620400, 3, '0943', '730900', 104.174, 36.5441);
INSERT INTO `app_area` VALUES (620403, '平川区', 'Pingchuan', 620400, 3, '0943', '730913', 104.825, 36.7277);
INSERT INTO `app_area` VALUES (620421, '靖远县', 'Jingyuan', 620400, 3, '0943', '730600', 104.683, 36.566);
INSERT INTO `app_area` VALUES (620422, '会宁县', 'Huining', 620400, 3, '0943', '730700', 105.053, 35.6963);
INSERT INTO `app_area` VALUES (620423, '景泰县', 'Jingtai', 620400, 3, '0943', '730400', 104.063, 37.1836);
INSERT INTO `app_area` VALUES (620500, '天水市', 'Tianshui', 620000, 2, '0938', '741000', 105.725, 34.5785);
INSERT INTO `app_area` VALUES (620502, '秦州区', 'Qinzhou', 620500, 3, '0938', '741000', 105.724, 34.5809);
INSERT INTO `app_area` VALUES (620503, '麦积区', 'Maiji', 620500, 3, '0938', '741020', 105.89, 34.5707);
INSERT INTO `app_area` VALUES (620521, '清水县', 'Qingshui', 620500, 3, '0938', '741400', 106.137, 34.7503);
INSERT INTO `app_area` VALUES (620522, '秦安县', 'Qin\'an', 620500, 3, '0938', '741600', 105.67, 34.8589);
INSERT INTO `app_area` VALUES (620523, '甘谷县', 'Gangu', 620500, 3, '0938', '741200', 105.333, 34.7366);
INSERT INTO `app_area` VALUES (620524, '武山县', 'Wushan', 620500, 3, '0938', '741300', 104.884, 34.7212);
INSERT INTO `app_area` VALUES (620525, '张家川回族自治县', 'Zhangjiachuan', 620500, 3, '0938', '741500', 106.216, 34.9958);
INSERT INTO `app_area` VALUES (620600, '武威市', 'Wuwei', 620000, 2, '0935', '733000', 102.635, 37.93);
INSERT INTO `app_area` VALUES (620602, '凉州区', 'Liangzhou', 620600, 3, '0935', '733000', 102.642, 37.9283);
INSERT INTO `app_area` VALUES (620621, '民勤县', 'Minqin', 620600, 3, '0935', '733300', 103.09, 38.6249);
INSERT INTO `app_area` VALUES (620622, '古浪县', 'Gulang', 620600, 3, '0935', '733100', 102.892, 37.4651);
INSERT INTO `app_area` VALUES (620623, '天祝藏族自治县', 'Tianzhu', 620600, 3, '0935', '733200', 103.136, 36.9771);
INSERT INTO `app_area` VALUES (620700, '张掖市', 'Zhangye', 620000, 2, '0936', '734000', 100.455, 38.9329);
INSERT INTO `app_area` VALUES (620702, '甘州区', 'Ganzhou', 620700, 3, '0936', '734000', 100.453, 38.9295);
INSERT INTO `app_area` VALUES (620721, '肃南裕固族自治县', 'Sunan', 620700, 3, '0936', '734400', 99.6141, 38.8378);
INSERT INTO `app_area` VALUES (620722, '民乐县', 'Minle', 620700, 3, '0936', '734500', 100.811, 38.4348);
INSERT INTO `app_area` VALUES (620723, '临泽县', 'Linze', 620700, 3, '0936', '734200', 100.164, 39.1525);
INSERT INTO `app_area` VALUES (620724, '高台县', 'Gaotai', 620700, 3, '0936', '734300', 99.8192, 39.3783);
INSERT INTO `app_area` VALUES (620725, '山丹县', 'Shandan', 620700, 3, '0936', '734100', 101.094, 38.7847);
INSERT INTO `app_area` VALUES (620800, '平凉市', 'Pingliang', 620000, 2, '0933', '744000', 106.685, 35.5428);
INSERT INTO `app_area` VALUES (620802, '崆峒区', 'Kongtong', 620800, 3, '0933', '744000', 106.675, 35.5426);
INSERT INTO `app_area` VALUES (620821, '泾川县', 'Jingchuan', 620800, 3, '0933', '744300', 107.366, 35.3322);
INSERT INTO `app_area` VALUES (620822, '灵台县', 'Lingtai', 620800, 3, '0933', '744400', 107.617, 35.0677);
INSERT INTO `app_area` VALUES (620823, '崇信县', 'Chongxin', 620800, 3, '0933', '744200', 107.037, 35.3034);
INSERT INTO `app_area` VALUES (620824, '华亭县', 'Huating', 620800, 3, '0933', '744100', 106.655, 35.2183);
INSERT INTO `app_area` VALUES (620825, '庄浪县', 'Zhuanglang', 620800, 3, '0933', '744600', 106.037, 35.2024);
INSERT INTO `app_area` VALUES (620826, '静宁县', 'Jingning', 620800, 3, '0933', '743400', 105.727, 35.5199);
INSERT INTO `app_area` VALUES (620900, '酒泉市', 'Jiuquan', 620000, 2, '0937', '735000', 98.5108, 39.744);
INSERT INTO `app_area` VALUES (620902, '肃州区', 'Suzhou', 620900, 3, '0937', '735000', 98.5078, 39.7451);
INSERT INTO `app_area` VALUES (620921, '金塔县', 'Jinta', 620900, 3, '0937', '735300', 98.9, 39.9773);
INSERT INTO `app_area` VALUES (620922, '瓜州县', 'Guazhou', 620900, 3, '0937', '736100', 95.7827, 40.5155);
INSERT INTO `app_area` VALUES (620923, '肃北蒙古族自治县', 'Subei', 620900, 3, '0937', '736300', 94.8765, 39.5121);
INSERT INTO `app_area` VALUES (620924, '阿克塞哈萨克族自治县', 'Akesai', 620900, 3, '0937', '736400', 94.341, 39.6343);
INSERT INTO `app_area` VALUES (620981, '玉门市', 'Yumen', 620900, 3, '0937', '735200', 97.0454, 40.2917);
INSERT INTO `app_area` VALUES (620982, '敦煌市', 'Dunhuang', 620900, 3, '0937', '736200', 94.6616, 40.1421);
INSERT INTO `app_area` VALUES (621000, '庆阳市', 'Qingyang', 620000, 2, '0934', '745000', 107.638, 35.7342);
INSERT INTO `app_area` VALUES (621002, '西峰区', 'Xifeng', 621000, 3, '0934', '745000', 107.651, 35.7307);
INSERT INTO `app_area` VALUES (621021, '庆城县', 'Qingcheng', 621000, 3, '0934', '745100', 107.883, 36.0151);
INSERT INTO `app_area` VALUES (621022, '环县', 'Huanxian', 621000, 3, '0934', '745700', 107.308, 36.5685);
INSERT INTO `app_area` VALUES (621023, '华池县', 'Huachi', 621000, 3, '0934', '745600', 107.989, 36.4611);
INSERT INTO `app_area` VALUES (621024, '合水县', 'Heshui', 621000, 3, '0934', '745400', 108.02, 35.8191);
INSERT INTO `app_area` VALUES (621025, '正宁县', 'Zhengning', 621000, 3, '0934', '745300', 108.36, 35.4917);
INSERT INTO `app_area` VALUES (621026, '宁县', 'Ningxian', 621000, 3, '0934', '745200', 107.925, 35.5016);
INSERT INTO `app_area` VALUES (621027, '镇原县', 'Zhenyuan', 621000, 3, '0934', '744500', 107.199, 35.6771);
INSERT INTO `app_area` VALUES (621100, '定西市', 'Dingxi', 620000, 2, '0932', '743000', 104.626, 35.5796);
INSERT INTO `app_area` VALUES (621102, '安定区', 'Anding', 621100, 3, '0932', '743000', 104.611, 35.5807);
INSERT INTO `app_area` VALUES (621121, '通渭县', 'Tongwei', 621100, 3, '0932', '743300', 105.242, 35.211);
INSERT INTO `app_area` VALUES (621122, '陇西县', 'Longxi', 621100, 3, '0932', '748100', 104.634, 35.0024);
INSERT INTO `app_area` VALUES (621123, '渭源县', 'Weiyuan', 621100, 3, '0932', '748200', 104.214, 35.1365);
INSERT INTO `app_area` VALUES (621124, '临洮县', 'Lintao', 621100, 3, '0932', '730500', 103.862, 35.3751);
INSERT INTO `app_area` VALUES (621125, '漳县', 'Zhangxian', 621100, 3, '0932', '748300', 104.467, 34.8498);
INSERT INTO `app_area` VALUES (621126, '岷县', 'Minxian', 621100, 3, '0932', '748400', 104.038, 34.4344);
INSERT INTO `app_area` VALUES (621200, '陇南市', 'Longnan', 620000, 2, '0939', '746000', 104.929, 33.3886);
INSERT INTO `app_area` VALUES (621202, '武都区', 'Wudu', 621200, 3, '0939', '746000', 104.927, 33.3924);
INSERT INTO `app_area` VALUES (621221, '成县', 'Chengxian', 621200, 3, '0939', '742500', 105.726, 33.7393);
INSERT INTO `app_area` VALUES (621222, '文县', 'Wenxian', 621200, 3, '0939', '746400', 104.684, 32.9434);
INSERT INTO `app_area` VALUES (621223, '宕昌县', 'Dangchang', 621200, 3, '0939', '748500', 104.393, 34.0473);
INSERT INTO `app_area` VALUES (621224, '康县', 'Kangxian', 621200, 3, '0939', '746500', 105.607, 33.3291);
INSERT INTO `app_area` VALUES (621225, '西和县', 'Xihe', 621200, 3, '0939', '742100', 105.301, 34.0143);
INSERT INTO `app_area` VALUES (621226, '礼县', 'Lixian', 621200, 3, '0939', '742200', 105.178, 34.1894);
INSERT INTO `app_area` VALUES (621227, '徽县', 'Huixian', 621200, 3, '0939', '742300', 106.085, 33.769);
INSERT INTO `app_area` VALUES (621228, '两当县', 'Liangdang', 621200, 3, '0939', '742400', 106.305, 33.9096);
INSERT INTO `app_area` VALUES (622900, '临夏回族自治州', 'Linxia', 620000, 2, '0930', '731100', 103.212, 35.5994);
INSERT INTO `app_area` VALUES (622901, '临夏市', 'Linxia', 622900, 3, '0930', '731100', 103.21, 35.5992);
INSERT INTO `app_area` VALUES (622921, '临夏县', 'Linxia', 622900, 3, '0930', '731800', 102.994, 35.4952);
INSERT INTO `app_area` VALUES (622922, '康乐县', 'Kangle', 622900, 3, '0930', '731500', 103.711, 35.3722);
INSERT INTO `app_area` VALUES (622923, '永靖县', 'Yongjing', 622900, 3, '0930', '731600', 103.32, 35.9384);
INSERT INTO `app_area` VALUES (622924, '广河县', 'Guanghe', 622900, 3, '0930', '731300', 103.569, 35.481);
INSERT INTO `app_area` VALUES (622925, '和政县', 'Hezheng', 622900, 3, '0930', '731200', 103.349, 35.4259);
INSERT INTO `app_area` VALUES (622926, '东乡族自治县', 'Dongxiangzu', 622900, 3, '0930', '731400', 103.395, 35.6647);
INSERT INTO `app_area` VALUES (622927, '积石山保安族东乡族撒拉族自治县', 'Jishishan', 622900, 3, '0930', '731700', 102.874, 35.7182);
INSERT INTO `app_area` VALUES (623000, '甘南藏族自治州', 'Gannan', 620000, 2, '0941', '747000', 102.911, 34.9864);
INSERT INTO `app_area` VALUES (623001, '合作市', 'Hezuo', 623000, 3, '0941', '747000', 102.911, 35.0002);
INSERT INTO `app_area` VALUES (623021, '临潭县', 'Lintan', 623000, 3, '0941', '747500', 103.353, 34.6951);
INSERT INTO `app_area` VALUES (623022, '卓尼县', 'Zhuoni', 623000, 3, '0941', '747600', 103.508, 34.5892);
INSERT INTO `app_area` VALUES (623023, '舟曲县', 'Zhouqu', 623000, 3, '0941', '746300', 104.372, 33.7847);
INSERT INTO `app_area` VALUES (623024, '迭部县', 'Diebu', 623000, 3, '0941', '747400', 103.223, 34.0562);
INSERT INTO `app_area` VALUES (623025, '玛曲县', 'Maqu', 623000, 3, '0941', '747300', 102.075, 33.997);
INSERT INTO `app_area` VALUES (623026, '碌曲县', 'Luqu', 623000, 3, '0941', '747200', 102.492, 34.5887);
INSERT INTO `app_area` VALUES (623027, '夏河县', 'Xiahe', 623000, 3, '0941', '747100', 102.522, 35.2049);
INSERT INTO `app_area` VALUES (630000, '青海省', 'Qinghai', 100000, 1, '', '', 101.779, 36.6232);
INSERT INTO `app_area` VALUES (630100, '西宁市', 'Xining', 630000, 2, '0971', '810000', 101.779, 36.6232);
INSERT INTO `app_area` VALUES (630102, '城东区', 'Chengdong', 630100, 3, '0971', '810007', 101.804, 36.5997);
INSERT INTO `app_area` VALUES (630103, '城中区', 'Chengzhong', 630100, 3, '0971', '810000', 101.784, 36.6228);
INSERT INTO `app_area` VALUES (630104, '城西区', 'Chengxi', 630100, 3, '0971', '810001', 101.766, 36.6283);
INSERT INTO `app_area` VALUES (630105, '城北区', 'Chengbei', 630100, 3, '0971', '810003', 101.766, 36.6501);
INSERT INTO `app_area` VALUES (630121, '大通回族土族自治县', 'Datong', 630100, 3, '0971', '810100', 101.702, 36.9349);
INSERT INTO `app_area` VALUES (630122, '湟中县', 'Huangzhong', 630100, 3, '0971', '811600', 101.572, 36.5008);
INSERT INTO `app_area` VALUES (630123, '湟源县', 'Huangyuan', 630100, 3, '0971', '812100', 101.256, 36.6824);
INSERT INTO `app_area` VALUES (630200, '海东市', 'Haidong', 630000, 2, '0972', '810700', 102.103, 36.5029);
INSERT INTO `app_area` VALUES (630202, '乐都区', 'Ledu', 630200, 3, '0972', '810700', 102.402, 36.4803);
INSERT INTO `app_area` VALUES (630221, '平安县', 'Ping\'an', 630200, 3, '0972', '810600', 102.104, 36.5027);
INSERT INTO `app_area` VALUES (630222, '民和回族土族自治县', 'Minhe', 630200, 3, '0972', '810800', 102.804, 36.3295);
INSERT INTO `app_area` VALUES (630223, '互助土族自治县', 'Huzhu', 630200, 3, '0972', '810500', 101.957, 36.8399);
INSERT INTO `app_area` VALUES (630224, '化隆回族自治县', 'Hualong', 630200, 3, '0972', '810900', 102.262, 36.0983);
INSERT INTO `app_area` VALUES (630225, '循化撒拉族自治县', 'Xunhua', 630200, 3, '0972', '811100', 102.487, 35.8472);
INSERT INTO `app_area` VALUES (632200, '海北藏族自治州', 'Haibei', 630000, 2, '0970', '812200', 100.901, 36.9594);
INSERT INTO `app_area` VALUES (632221, '门源回族自治县', 'Menyuan', 632200, 3, '0970', '810300', 101.622, 37.3761);
INSERT INTO `app_area` VALUES (632222, '祁连县', 'Qilian', 632200, 3, '0970', '810400', 100.246, 38.179);
INSERT INTO `app_area` VALUES (632223, '海晏县', 'Haiyan', 632200, 3, '0970', '812200', 100.993, 36.899);
INSERT INTO `app_area` VALUES (632224, '刚察县', 'Gangcha', 632200, 3, '0970', '812300', 100.147, 37.3216);
INSERT INTO `app_area` VALUES (632300, '黄南藏族自治州', 'Huangnan', 630000, 2, '0973', '811300', 102.02, 35.5177);
INSERT INTO `app_area` VALUES (632321, '同仁县', 'Tongren', 632300, 3, '0973', '811300', 102.018, 35.516);
INSERT INTO `app_area` VALUES (632322, '尖扎县', 'Jianzha', 632300, 3, '0973', '811200', 102.034, 35.9395);
INSERT INTO `app_area` VALUES (632323, '泽库县', 'Zeku', 632300, 3, '0973', '811400', 101.464, 35.0352);
INSERT INTO `app_area` VALUES (632324, '河南蒙古族自治县', 'Henan', 632300, 3, '0973', '811500', 101.609, 34.7348);
INSERT INTO `app_area` VALUES (632500, '海南藏族自治州', 'Hainan', 630000, 2, '0974', '813000', 100.62, 36.2804);
INSERT INTO `app_area` VALUES (632521, '共和县', 'Gonghe', 632500, 3, '0974', '813000', 100.62, 36.2841);
INSERT INTO `app_area` VALUES (632522, '同德县', 'Tongde', 632500, 3, '0974', '813200', 100.572, 35.2549);
INSERT INTO `app_area` VALUES (632523, '贵德县', 'Guide', 632500, 3, '0974', '811700', 101.432, 36.044);
INSERT INTO `app_area` VALUES (632524, '兴海县', 'Xinghai', 632500, 3, '0974', '813300', 99.9885, 35.5903);
INSERT INTO `app_area` VALUES (632525, '贵南县', 'Guinan', 632500, 3, '0974', '813100', 100.747, 35.5867);
INSERT INTO `app_area` VALUES (632600, '果洛藏族自治州', 'Golog', 630000, 2, '0975', '814000', 100.242, 34.4736);
INSERT INTO `app_area` VALUES (632621, '玛沁县', 'Maqin', 632600, 3, '0975', '814000', 100.239, 34.4775);
INSERT INTO `app_area` VALUES (632622, '班玛县', 'Banma', 632600, 3, '0975', '814300', 100.737, 32.9325);
INSERT INTO `app_area` VALUES (632623, '甘德县', 'Gande', 632600, 3, '0975', '814100', 99.9025, 33.9684);
INSERT INTO `app_area` VALUES (632624, '达日县', 'Dari', 632600, 3, '0975', '814200', 99.6518, 33.7519);
INSERT INTO `app_area` VALUES (632625, '久治县', 'Jiuzhi', 632600, 3, '0975', '624700', 101.483, 33.4299);
INSERT INTO `app_area` VALUES (632626, '玛多县', 'Maduo', 632600, 3, '0975', '813500', 98.21, 34.9157);
INSERT INTO `app_area` VALUES (632700, '玉树藏族自治州', 'Yushu', 630000, 2, '0976', '815000', 97.0085, 33.004);
INSERT INTO `app_area` VALUES (632701, '玉树市', 'Yushu', 632700, 3, '0976', '815000', 97.0088, 33.0039);
INSERT INTO `app_area` VALUES (632722, '杂多县', 'Zaduo', 632700, 3, '0976', '815300', 95.2986, 32.8932);
INSERT INTO `app_area` VALUES (632723, '称多县', 'Chenduo', 632700, 3, '0976', '815100', 97.1079, 33.369);
INSERT INTO `app_area` VALUES (632724, '治多县', 'Zhiduo', 632700, 3, '0976', '815400', 95.6157, 33.8528);
INSERT INTO `app_area` VALUES (632725, '囊谦县', 'Nangqian', 632700, 3, '0976', '815200', 96.4775, 32.2036);
INSERT INTO `app_area` VALUES (632726, '曲麻莱县', 'Qumalai', 632700, 3, '0976', '815500', 95.7976, 34.1261);
INSERT INTO `app_area` VALUES (632800, '海西蒙古族藏族自治州', 'Haixi', 630000, 2, '0977', '817000', 97.3708, 37.3747);
INSERT INTO `app_area` VALUES (632801, '格尔木市', 'Geermu', 632800, 3, '0977', '816000', 94.9033, 36.4024);
INSERT INTO `app_area` VALUES (632802, '德令哈市', 'Delingha', 632800, 3, '0977', '817000', 97.3608, 37.3695);
INSERT INTO `app_area` VALUES (632821, '乌兰县', 'Wulan', 632800, 3, '0977', '817100', 98.482, 36.9347);
INSERT INTO `app_area` VALUES (632822, '都兰县', 'Dulan', 632800, 3, '0977', '816100', 98.0923, 36.3013);
INSERT INTO `app_area` VALUES (632823, '天峻县', 'Tianjun', 632800, 3, '0977', '817200', 99.0245, 37.3033);
INSERT INTO `app_area` VALUES (640000, '宁夏回族自治区', 'Ningxia', 100000, 1, '', '', 106.278, 38.4664);
INSERT INTO `app_area` VALUES (640100, '银川市', 'Yinchuan', 640000, 2, '0951', '750004', 106.278, 38.4664);
INSERT INTO `app_area` VALUES (640104, '兴庆区', 'Xingqing', 640100, 3, '0951', '750001', 106.289, 38.4739);
INSERT INTO `app_area` VALUES (640105, '西夏区', 'Xixia', 640100, 3, '0951', '750021', 106.15, 38.4914);
INSERT INTO `app_area` VALUES (640106, '金凤区', 'Jinfeng', 640100, 3, '0951', '750011', 106.243, 38.4729);
INSERT INTO `app_area` VALUES (640121, '永宁县', 'Yongning', 640100, 3, '0951', '750100', 106.252, 38.2756);
INSERT INTO `app_area` VALUES (640122, '贺兰县', 'Helan', 640100, 3, '0951', '750200', 106.35, 38.5544);
INSERT INTO `app_area` VALUES (640181, '灵武市', 'Lingwu', 640100, 3, '0951', '750004', 106.34, 38.1027);
INSERT INTO `app_area` VALUES (640200, '石嘴山市', 'Shizuishan', 640000, 2, '0952', '753000', 106.376, 39.0133);
INSERT INTO `app_area` VALUES (640202, '大武口区', 'Dawukou', 640200, 3, '0952', '753000', 106.377, 39.0123);
INSERT INTO `app_area` VALUES (640205, '惠农区', 'Huinong', 640200, 3, '0952', '753600', 106.711, 39.1319);
INSERT INTO `app_area` VALUES (640221, '平罗县', 'Pingluo', 640200, 3, '0952', '753400', 106.545, 38.9043);
INSERT INTO `app_area` VALUES (640300, '吴忠市', 'Wuzhong', 640000, 2, '0953', '751100', 106.199, 37.9862);
INSERT INTO `app_area` VALUES (640302, '利通区', 'Litong', 640300, 3, '0953', '751100', 106.203, 37.9851);
INSERT INTO `app_area` VALUES (640303, '红寺堡区', 'Hongsibao', 640300, 3, '0953', '751900', 106.198, 37.9975);
INSERT INTO `app_area` VALUES (640323, '盐池县', 'Yanchi', 640300, 3, '0953', '751500', 107.407, 37.7833);
INSERT INTO `app_area` VALUES (640324, '同心县', 'Tongxin', 640300, 3, '0953', '751300', 105.914, 36.9812);
INSERT INTO `app_area` VALUES (640381, '青铜峡市', 'Qingtongxia', 640300, 3, '0953', '751600', 106.075, 38.02);
INSERT INTO `app_area` VALUES (640400, '固原市', 'Guyuan', 640000, 2, '0954', '756000', 106.285, 36.0046);
INSERT INTO `app_area` VALUES (640402, '原州区', 'Yuanzhou', 640400, 3, '0954', '756000', 106.288, 36.0037);
INSERT INTO `app_area` VALUES (640422, '西吉县', 'Xiji', 640400, 3, '0954', '756200', 105.731, 35.9662);
INSERT INTO `app_area` VALUES (640423, '隆德县', 'Longde', 640400, 3, '0954', '756300', 106.124, 35.6172);
INSERT INTO `app_area` VALUES (640424, '泾源县', 'Jingyuan', 640400, 3, '0954', '756400', 106.339, 35.4907);
INSERT INTO `app_area` VALUES (640425, '彭阳县', 'Pengyang', 640400, 3, '0954', '756500', 106.645, 35.8508);
INSERT INTO `app_area` VALUES (640500, '中卫市', 'Zhongwei', 640000, 2, '0955', '751700', 105.19, 37.5149);
INSERT INTO `app_area` VALUES (640502, '沙坡头区', 'Shapotou', 640500, 3, '0955', '755000', 105.19, 37.5104);
INSERT INTO `app_area` VALUES (640521, '中宁县', 'Zhongning', 640500, 3, '0955', '751200', 105.685, 37.4915);
INSERT INTO `app_area` VALUES (640522, '海原县', 'Haiyuan', 640500, 3, '0955', '751800', 105.647, 36.565);
INSERT INTO `app_area` VALUES (650000, '新疆维吾尔自治区', 'Xinjiang', 100000, 1, '', '', 87.6177, 43.7928);
INSERT INTO `app_area` VALUES (650100, '乌鲁木齐市', 'Urumqi', 650000, 2, '0991', '830002', 87.6177, 43.7928);
INSERT INTO `app_area` VALUES (650102, '天山区', 'Tianshan', 650100, 3, '0991', '830002', 87.6317, 43.7944);
INSERT INTO `app_area` VALUES (650103, '沙依巴克区', 'Shayibake', 650100, 3, '0991', '830000', 87.5979, 43.8012);
INSERT INTO `app_area` VALUES (650104, '新市区', 'Xinshi', 650100, 3, '0991', '830011', 87.5741, 43.8435);
INSERT INTO `app_area` VALUES (650105, '水磨沟区', 'Shuimogou', 650100, 3, '0991', '830017', 87.6425, 43.8325);
INSERT INTO `app_area` VALUES (650106, '头屯河区', 'Toutunhe', 650100, 3, '0991', '830022', 87.2914, 43.8549);
INSERT INTO `app_area` VALUES (650107, '达坂城区', 'Dabancheng', 650100, 3, '0991', '830039', 88.307, 43.358);
INSERT INTO `app_area` VALUES (650109, '米东区', 'Midong', 650100, 3, '0991', '830019', 87.6858, 43.9474);
INSERT INTO `app_area` VALUES (650121, '乌鲁木齐县', 'Wulumuqi', 650100, 3, '0991', '830063', 87.4094, 43.4712);
INSERT INTO `app_area` VALUES (650200, '克拉玛依市', 'Karamay', 650000, 2, '0990', '834000', 84.8739, 45.5959);
INSERT INTO `app_area` VALUES (650202, '独山子区', 'Dushanzi', 650200, 3, '0992', '834021', 84.8867, 44.3287);
INSERT INTO `app_area` VALUES (650203, '克拉玛依区', 'Kelamayi', 650200, 3, '0990', '834000', 84.8623, 45.5909);
INSERT INTO `app_area` VALUES (650204, '白碱滩区', 'Baijiantan', 650200, 3, '0990', '834008', 85.1324, 45.6877);
INSERT INTO `app_area` VALUES (650205, '乌尔禾区', 'Wuerhe', 650200, 3, '0990', '834012', 85.6914, 46.0901);
INSERT INTO `app_area` VALUES (652100, '吐鲁番地区', 'Turpan', 650000, 2, '0995', '838000', 89.1841, 42.9476);
INSERT INTO `app_area` VALUES (652101, '吐鲁番市', 'Tulufan', 652100, 3, '0995', '838000', 89.1858, 42.9351);
INSERT INTO `app_area` VALUES (652122, '鄯善县', 'Shanshan', 652100, 3, '0995', '838200', 90.214, 42.8635);
INSERT INTO `app_area` VALUES (652123, '托克逊县', 'Tuokexun', 652100, 3, '0995', '838100', 88.6582, 42.7923);
INSERT INTO `app_area` VALUES (652200, '哈密地区', 'Hami', 650000, 2, '0902', '839000', 93.5132, 42.8332);
INSERT INTO `app_area` VALUES (652201, '哈密市', 'Hami', 652200, 3, '0902', '839000', 93.5145, 42.827);
INSERT INTO `app_area` VALUES (652222, '巴里坤哈萨克自治县', 'Balikun', 652200, 3, '0902', '839200', 93.0124, 43.5999);
INSERT INTO `app_area` VALUES (652223, '伊吾县', 'Yiwu', 652200, 3, '0902', '839300', 94.694, 43.2537);
INSERT INTO `app_area` VALUES (652300, '昌吉回族自治州', 'Changji', 650000, 2, '0994', '831100', 87.304, 44.0146);
INSERT INTO `app_area` VALUES (652301, '昌吉市', 'Changji', 652300, 3, '0994', '831100', 87.3025, 44.0127);
INSERT INTO `app_area` VALUES (652302, '阜康市', 'Fukang', 652300, 3, '0994', '831500', 87.9853, 44.1584);
INSERT INTO `app_area` VALUES (652323, '呼图壁县', 'Hutubi', 652300, 3, '0994', '831200', 86.8989, 44.1898);
INSERT INTO `app_area` VALUES (652324, '玛纳斯县', 'Manasi', 652300, 3, '0994', '832200', 86.2145, 44.3044);
INSERT INTO `app_area` VALUES (652325, '奇台县', 'Qitai', 652300, 3, '0994', '831800', 89.5932, 44.0222);
INSERT INTO `app_area` VALUES (652327, '吉木萨尔县', 'Jimusaer', 652300, 3, '0994', '831700', 89.1808, 44.0005);
INSERT INTO `app_area` VALUES (652328, '木垒哈萨克自治县', 'Mulei', 652300, 3, '0994', '831900', 90.289, 43.8351);
INSERT INTO `app_area` VALUES (652700, '博尔塔拉蒙古自治州', 'Bortala', 650000, 2, '0909', '833400', 82.0748, 44.9033);
INSERT INTO `app_area` VALUES (652701, '博乐市', 'Bole', 652700, 3, '0909', '833400', 82.0713, 44.9005);
INSERT INTO `app_area` VALUES (652702, '阿拉山口市', 'Alashankou', 652700, 3, '0909', '833400', 82.5677, 45.1706);
INSERT INTO `app_area` VALUES (652722, '精河县', 'Jinghe', 652700, 3, '0909', '833300', 82.8942, 44.6077);
INSERT INTO `app_area` VALUES (652723, '温泉县', 'Wenquan', 652700, 3, '0909', '833500', 81.0313, 44.9737);
INSERT INTO `app_area` VALUES (652800, '巴音郭楞蒙古自治州', 'Bayingol', 650000, 2, '0996', '841000', 86.151, 41.7686);
INSERT INTO `app_area` VALUES (652801, '库尔勒市', 'Kuerle', 652800, 3, '0996', '841000', 86.1553, 41.766);
INSERT INTO `app_area` VALUES (652822, '轮台县', 'Luntai', 652800, 3, '0996', '841600', 84.261, 41.7764);
INSERT INTO `app_area` VALUES (652823, '尉犁县', 'Yuli', 652800, 3, '0996', '841500', 86.259, 41.3363);
INSERT INTO `app_area` VALUES (652824, '若羌县', 'Ruoqiang', 652800, 3, '0996', '841800', 88.1681, 39.0179);
INSERT INTO `app_area` VALUES (652825, '且末县', 'Qiemo', 652800, 3, '0996', '841900', 85.5297, 38.1453);
INSERT INTO `app_area` VALUES (652826, '焉耆回族自治县', 'Yanqi', 652800, 3, '0996', '841100', 86.5744, 42.059);
INSERT INTO `app_area` VALUES (652827, '和静县', 'Hejing', 652800, 3, '0996', '841300', 86.3961, 42.3184);
INSERT INTO `app_area` VALUES (652828, '和硕县', 'Heshuo', 652800, 3, '0996', '841200', 86.8639, 42.2681);
INSERT INTO `app_area` VALUES (652829, '博湖县', 'Bohu', 652800, 3, '0996', '841400', 86.6333, 41.9801);
INSERT INTO `app_area` VALUES (652900, '阿克苏地区', 'Aksu', 650000, 2, '0997', '843000', 80.2651, 41.1707);
INSERT INTO `app_area` VALUES (652901, '阿克苏市', 'Akesu', 652900, 3, '0997', '843000', 80.2634, 41.1675);
INSERT INTO `app_area` VALUES (652922, '温宿县', 'Wensu', 652900, 3, '0997', '843100', 80.2417, 41.2768);
INSERT INTO `app_area` VALUES (652923, '库车县', 'Kuche', 652900, 3, '0997', '842000', 82.9621, 41.7179);
INSERT INTO `app_area` VALUES (652924, '沙雅县', 'Shaya', 652900, 3, '0997', '842200', 82.7813, 41.225);
INSERT INTO `app_area` VALUES (652925, '新和县', 'Xinhe', 652900, 3, '0997', '842100', 82.6105, 41.5496);
INSERT INTO `app_area` VALUES (652926, '拜城县', 'Baicheng', 652900, 3, '0997', '842300', 81.8756, 41.798);
INSERT INTO `app_area` VALUES (652927, '乌什县', 'Wushi', 652900, 3, '0997', '843400', 79.2294, 41.2157);
INSERT INTO `app_area` VALUES (652928, '阿瓦提县', 'Awati', 652900, 3, '0997', '843200', 80.3834, 40.6393);
INSERT INTO `app_area` VALUES (652929, '柯坪县', 'Keping', 652900, 3, '0997', '843600', 79.0475, 40.5059);
INSERT INTO `app_area` VALUES (653000, '克孜勒苏柯尔克孜自治州', 'Kizilsu', 650000, 2, '0908', '845350', 76.1728, 39.7134);
INSERT INTO `app_area` VALUES (653001, '阿图什市', 'Atushi', 653000, 3, '0908', '845350', 76.1683, 39.7161);
INSERT INTO `app_area` VALUES (653022, '阿克陶县', 'Aketao', 653000, 3, '0908', '845550', 75.9469, 39.1489);
INSERT INTO `app_area` VALUES (653023, '阿合奇县', 'Aheqi', 653000, 3, '0997', '843500', 78.4485, 40.9395);
INSERT INTO `app_area` VALUES (653024, '乌恰县', 'Wuqia', 653000, 3, '0908', '845450', 75.2584, 39.7198);
INSERT INTO `app_area` VALUES (653100, '喀什地区', 'Kashgar', 650000, 2, '0998', '844000', 75.9891, 39.4677);
INSERT INTO `app_area` VALUES (653101, '喀什市', 'Kashi', 653100, 3, '0998', '844000', 75.9938, 39.4677);
INSERT INTO `app_area` VALUES (653121, '疏附县', 'Shufu', 653100, 3, '0998', '844100', 75.8603, 39.3753);
INSERT INTO `app_area` VALUES (653122, '疏勒县', 'Shule', 653100, 3, '0998', '844200', 76.054, 39.4062);
INSERT INTO `app_area` VALUES (653123, '英吉沙县', 'Yingjisha', 653100, 3, '0998', '844500', 76.1757, 38.9297);
INSERT INTO `app_area` VALUES (653124, '泽普县', 'Zepu', 653100, 3, '0998', '844800', 77.2714, 38.1894);
INSERT INTO `app_area` VALUES (653125, '莎车县', 'Shache', 653100, 3, '0998', '844700', 77.2432, 38.416);
INSERT INTO `app_area` VALUES (653126, '叶城县', 'Yecheng', 653100, 3, '0998', '844900', 77.4166, 37.8832);
INSERT INTO `app_area` VALUES (653127, '麦盖提县', 'Maigaiti', 653100, 3, '0998', '844600', 77.6422, 38.8966);
INSERT INTO `app_area` VALUES (653128, '岳普湖县', 'Yuepuhu', 653100, 3, '0998', '844400', 76.7723, 39.2356);
INSERT INTO `app_area` VALUES (653129, '伽师县', 'Jiashi', 653100, 3, '0998', '844300', 76.7237, 39.488);
INSERT INTO `app_area` VALUES (653130, '巴楚县', 'Bachu', 653100, 3, '0998', '843800', 78.5489, 39.7855);
INSERT INTO `app_area` VALUES (653131, '塔什库尔干塔吉克自治县', 'Tashikuergantajike', 653100, 3, '0998', '845250', 75.232, 37.7789);
INSERT INTO `app_area` VALUES (653200, '和田地区', 'Hotan', 650000, 2, '0903', '848000', 79.9253, 37.1107);
INSERT INTO `app_area` VALUES (653201, '和田市', 'Hetianshi', 653200, 3, '0903', '848000', 79.9135, 37.1121);
INSERT INTO `app_area` VALUES (653221, '和田县', 'Hetianxian', 653200, 3, '0903', '848000', 79.8287, 37.0892);
INSERT INTO `app_area` VALUES (653222, '墨玉县', 'Moyu', 653200, 3, '0903', '848100', 79.7403, 37.2725);
INSERT INTO `app_area` VALUES (653223, '皮山县', 'Pishan', 653200, 3, '0903', '845150', 78.2812, 37.6201);
INSERT INTO `app_area` VALUES (653224, '洛浦县', 'Luopu', 653200, 3, '0903', '848200', 80.1854, 37.0736);
INSERT INTO `app_area` VALUES (653225, '策勒县', 'Cele', 653200, 3, '0903', '848300', 80.81, 36.9984);
INSERT INTO `app_area` VALUES (653226, '于田县', 'Yutian', 653200, 3, '0903', '848400', 81.6672, 36.854);
INSERT INTO `app_area` VALUES (653227, '民丰县', 'Minfeng', 653200, 3, '0903', '848500', 82.6844, 37.0658);
INSERT INTO `app_area` VALUES (654000, '伊犁哈萨克自治州', 'Ili', 650000, 2, '0999', '835100', 81.3179, 43.9219);
INSERT INTO `app_area` VALUES (654002, '伊宁市', 'Yining', 654000, 3, '0999', '835000', 81.3293, 43.9129);
INSERT INTO `app_area` VALUES (654003, '奎屯市', 'Kuitun', 654000, 3, '0992', '833200', 84.9023, 44.425);
INSERT INTO `app_area` VALUES (654004, '霍尔果斯市', 'Huoerguosi', 654000, 3, '0999', '835221', 80.4182, 44.2058);
INSERT INTO `app_area` VALUES (654021, '伊宁县', 'Yining', 654000, 3, '0999', '835100', 81.5276, 43.9786);
INSERT INTO `app_area` VALUES (654022, '察布查尔锡伯自治县', 'Chabuchaerxibo', 654000, 3, '0999', '835300', 81.1496, 43.8402);
INSERT INTO `app_area` VALUES (654023, '霍城县', 'Huocheng', 654000, 3, '0999', '835200', 80.8783, 44.0533);
INSERT INTO `app_area` VALUES (654024, '巩留县', 'Gongliu', 654000, 3, '0999', '835400', 82.2285, 43.4843);
INSERT INTO `app_area` VALUES (654025, '新源县', 'Xinyuan', 654000, 3, '0999', '835800', 83.2609, 43.4284);
INSERT INTO `app_area` VALUES (654026, '昭苏县', 'Zhaosu', 654000, 3, '0999', '835600', 81.1307, 43.1583);
INSERT INTO `app_area` VALUES (654027, '特克斯县', 'Tekesi', 654000, 3, '0999', '835500', 81.84, 43.2194);
INSERT INTO `app_area` VALUES (654028, '尼勒克县', 'Nileke', 654000, 3, '0999', '835700', 82.5118, 43.799);
INSERT INTO `app_area` VALUES (654200, '塔城地区', 'Qoqek', 650000, 2, '0901', '834700', 82.9857, 46.7463);
INSERT INTO `app_area` VALUES (654201, '塔城市', 'Tacheng', 654200, 3, '0901', '834700', 82.9789, 46.7485);
INSERT INTO `app_area` VALUES (654202, '乌苏市', 'Wusu', 654200, 3, '0992', '833000', 84.6826, 44.4373);
INSERT INTO `app_area` VALUES (654221, '额敏县', 'Emin', 654200, 3, '0901', '834600', 83.6287, 46.5284);
INSERT INTO `app_area` VALUES (654223, '沙湾县', 'Shawan', 654200, 3, '0993', '832100', 85.6193, 44.3314);
INSERT INTO `app_area` VALUES (654224, '托里县', 'Tuoli', 654200, 3, '0901', '834500', 83.6059, 45.9362);
INSERT INTO `app_area` VALUES (654225, '裕民县', 'Yumin', 654200, 3, '0901', '834800', 82.99, 46.2038);
INSERT INTO `app_area` VALUES (654226, '和布克赛尔蒙古自治县', 'Hebukesaier', 654200, 3, '0990', '834400', 85.7266, 46.7936);
INSERT INTO `app_area` VALUES (654300, '阿勒泰地区', 'Altay', 650000, 2, '0906', '836500', 88.1396, 47.8484);
INSERT INTO `app_area` VALUES (654301, '阿勒泰市', 'Aletai', 654300, 3, '0906', '836500', 88.1391, 47.8317);
INSERT INTO `app_area` VALUES (654321, '布尔津县', 'Buerjin', 654300, 3, '0906', '836600', 86.8575, 47.7006);
INSERT INTO `app_area` VALUES (654322, '富蕴县', 'Fuyun', 654300, 3, '0906', '836100', 89.5268, 46.9944);
INSERT INTO `app_area` VALUES (654323, '福海县', 'Fuhai', 654300, 3, '0906', '836400', 87.4951, 47.1106);
INSERT INTO `app_area` VALUES (654324, '哈巴河县', 'Habahe', 654300, 3, '0906', '836700', 86.4209, 48.0605);
INSERT INTO `app_area` VALUES (654325, '青河县', 'Qinghe', 654300, 3, '0906', '836200', 90.383, 46.6738);
INSERT INTO `app_area` VALUES (654326, '吉木乃县', 'Jimunai', 654300, 3, '0906', '836800', 85.8781, 47.4336);
INSERT INTO `app_area` VALUES (659000, '直辖县级', '', 650000, 2, '', '', 91.1322, 29.6604);
INSERT INTO `app_area` VALUES (659001, '石河子市', 'Shihezi', 659000, 3, '0993', '832000', 86.0411, 44.3059);
INSERT INTO `app_area` VALUES (659002, '阿拉尔市', 'Aral', 659000, 3, '0997', '843300', 81.2859, 40.5419);
INSERT INTO `app_area` VALUES (659003, '图木舒克市', 'Tumxuk', 659000, 3, '0998', '843806', 79.078, 39.8673);
INSERT INTO `app_area` VALUES (659004, '五家渠市', 'Wujiaqu', 659000, 3, '0994', '831300', 87.5269, 44.1674);
INSERT INTO `app_area` VALUES (659005, '北屯市', 'Beitun', 659000, 3, '0906', '836000', 87.8085, 47.3623);
INSERT INTO `app_area` VALUES (659006, '铁门关市', 'Tiemenguan', 659000, 3, '0906', '836000', 86.1947, 41.811);
INSERT INTO `app_area` VALUES (659007, '双河市', 'Shuanghe', 659000, 3, '0909', '833408', 91.1322, 29.6604);
INSERT INTO `app_area` VALUES (710000, '台湾', 'Taiwan', 100000, 1, '', '', 121.509, 25.0443);
INSERT INTO `app_area` VALUES (710100, '台北市', 'Taipei', 710000, 2, '02', '1', 121.565, 25.0378);
INSERT INTO `app_area` VALUES (710101, '松山区', 'Songshan', 710100, 3, '02', '105', 121.577, 25.0497);
INSERT INTO `app_area` VALUES (710102, '信义区', 'Xinyi', 710100, 3, '02', '110', 121.751, 25.1294);
INSERT INTO `app_area` VALUES (710103, '大安区', 'Da\'an', 710100, 3, '02', '106', 121.535, 25.0264);
INSERT INTO `app_area` VALUES (710104, '中山区', 'Zhongshan', 710100, 3, '02', '104', 121.533, 25.0644);
INSERT INTO `app_area` VALUES (710105, '中正区', 'Zhongzheng', 710100, 3, '02', '100', 121.518, 25.0324);
INSERT INTO `app_area` VALUES (710106, '大同区', 'Datong', 710100, 3, '02', '103', 121.516, 25.066);
INSERT INTO `app_area` VALUES (710107, '万华区', 'Wanhua', 710100, 3, '02', '108', 121.499, 25.0319);
INSERT INTO `app_area` VALUES (710108, '文山区', 'Wenshan', 710100, 3, '02', '116', 121.57, 24.9898);
INSERT INTO `app_area` VALUES (710109, '南港区', 'Nangang', 710100, 3, '02', '115', 121.607, 25.0547);
INSERT INTO `app_area` VALUES (710110, '内湖区', 'Nahu', 710100, 3, '02', '114', 121.589, 25.0697);
INSERT INTO `app_area` VALUES (710111, '士林区', 'Shilin', 710100, 3, '02', '111', 121.52, 25.0928);
INSERT INTO `app_area` VALUES (710112, '北投区', 'Beitou', 710100, 3, '02', '112', 121.501, 25.1324);
INSERT INTO `app_area` VALUES (710200, '高雄市', 'Kaohsiung', 710000, 2, '07', '8', 120.312, 22.6209);
INSERT INTO `app_area` VALUES (710201, '盐埕区', 'Yancheng', 710200, 3, '07', '803', 120.287, 22.6247);
INSERT INTO `app_area` VALUES (710202, '鼓山区', 'Gushan', 710200, 3, '07', '804', 120.281, 22.6368);
INSERT INTO `app_area` VALUES (710203, '左营区', 'Zuoying', 710200, 3, '07', '813', 120.295, 22.6901);
INSERT INTO `app_area` VALUES (710204, '楠梓区', 'Nanzi', 710200, 3, '07', '811', 120.326, 22.7284);
INSERT INTO `app_area` VALUES (710205, '三民区', 'Sanmin', 710200, 3, '07', '807', 120.3, 22.6477);
INSERT INTO `app_area` VALUES (710206, '新兴区', 'Xinxing', 710200, 3, '07', '800', 120.31, 22.6311);
INSERT INTO `app_area` VALUES (710207, '前金区', 'Qianjin', 710200, 3, '07', '801', 120.294, 22.6274);
INSERT INTO `app_area` VALUES (710208, '苓雅区', 'Lingya', 710200, 3, '07', '802', 120.312, 22.6218);
INSERT INTO `app_area` VALUES (710209, '前镇区', 'Qianzhen', 710200, 3, '07', '806', 120.319, 22.5864);
INSERT INTO `app_area` VALUES (710210, '旗津区', 'Qijin', 710200, 3, '07', '805', 120.284, 22.5906);
INSERT INTO `app_area` VALUES (710211, '小港区', 'Xiaogang', 710200, 3, '07', '812', 120.338, 22.5654);
INSERT INTO `app_area` VALUES (710212, '凤山区', 'Fengshan', 710200, 3, '07', '830', 120.357, 22.6269);
INSERT INTO `app_area` VALUES (710213, '林园区', 'Linyuan', 710200, 3, '07', '832', 120.396, 22.5015);
INSERT INTO `app_area` VALUES (710214, '大寮区', 'Daliao', 710200, 3, '07', '831', 120.395, 22.6054);
INSERT INTO `app_area` VALUES (710215, '大树区', 'Dashu', 710200, 3, '07', '840', 120.433, 22.6934);
INSERT INTO `app_area` VALUES (710216, '大社区', 'Dashe', 710200, 3, '07', '815', 120.347, 22.73);
INSERT INTO `app_area` VALUES (710217, '仁武区', 'Renwu', 710200, 3, '07', '814', 120.348, 22.7019);
INSERT INTO `app_area` VALUES (710218, '鸟松区', 'Niaosong', 710200, 3, '07', '833', 120.364, 22.6593);
INSERT INTO `app_area` VALUES (710219, '冈山区', 'Gangshan', 710200, 3, '07', '820', 120.296, 22.7968);
INSERT INTO `app_area` VALUES (710220, '桥头区', 'Qiaotou', 710200, 3, '07', '825', 120.306, 22.7575);
INSERT INTO `app_area` VALUES (710221, '燕巢区', 'Yanchao', 710200, 3, '07', '824', 120.362, 22.7934);
INSERT INTO `app_area` VALUES (710222, '田寮区', 'Tianliao', 710200, 3, '07', '823', 120.36, 22.8693);
INSERT INTO `app_area` VALUES (710223, '阿莲区', 'Alian', 710200, 3, '07', '822', 120.327, 22.8837);
INSERT INTO `app_area` VALUES (710224, '路竹区', 'Luzhu', 710200, 3, '07', '821', 120.262, 22.8569);
INSERT INTO `app_area` VALUES (710225, '湖内区', 'Huna', 710200, 3, '07', '829', 120.212, 22.9082);
INSERT INTO `app_area` VALUES (710226, '茄萣区', 'Qieding', 710200, 3, '07', '852', 120.183, 22.9066);
INSERT INTO `app_area` VALUES (710227, '永安区', 'Yong\'an', 710200, 3, '07', '828', 120.225, 22.8186);
INSERT INTO `app_area` VALUES (710228, '弥陀区', 'Mituo', 710200, 3, '07', '827', 120.247, 22.7829);
INSERT INTO `app_area` VALUES (710229, '梓官区', 'Ziguan', 710200, 3, '07', '826', 120.267, 22.7605);
INSERT INTO `app_area` VALUES (710230, '旗山区', 'Qishan', 710200, 3, '07', '842', 120.484, 22.8885);
INSERT INTO `app_area` VALUES (710231, '美浓区', 'Meinong', 710200, 3, '07', '843', 120.542, 22.8979);
INSERT INTO `app_area` VALUES (710232, '六龟区', 'Liugui', 710200, 3, '07', '844', 120.633, 22.9979);
INSERT INTO `app_area` VALUES (710233, '甲仙区', 'Jiaxian', 710200, 3, '07', '847', 120.591, 23.0847);
INSERT INTO `app_area` VALUES (710234, '杉林区', 'Shanlin', 710200, 3, '07', '846', 120.539, 22.9707);
INSERT INTO `app_area` VALUES (710235, '内门区', 'Namen', 710200, 3, '07', '845', 120.462, 22.9434);
INSERT INTO `app_area` VALUES (710236, '茂林区', 'Maolin', 710200, 3, '07', '851', 120.663, 22.8862);
INSERT INTO `app_area` VALUES (710237, '桃源区', 'Taoyuan', 710200, 3, '07', '848', 120.76, 23.1591);
INSERT INTO `app_area` VALUES (710238, '那玛夏区', 'Namaxia', 710200, 3, '07', '849', 120.693, 23.217);
INSERT INTO `app_area` VALUES (710300, '基隆市', 'Keelung', 710000, 2, '02', '2', 121.746, 25.1307);
INSERT INTO `app_area` VALUES (710301, '中正区', 'Zhongzheng', 710300, 3, '02', '202', 121.518, 25.0324);
INSERT INTO `app_area` VALUES (710302, '七堵区', 'Qidu', 710300, 3, '02', '206', 121.713, 25.0957);
INSERT INTO `app_area` VALUES (710303, '暖暖区', 'Nuannuan', 710300, 3, '02', '205', 121.736, 25.0998);
INSERT INTO `app_area` VALUES (710304, '仁爱区', 'Renai', 710300, 3, '02', '200', 121.741, 25.1275);
INSERT INTO `app_area` VALUES (710305, '中山区', 'Zhongshan', 710300, 3, '02', '203', 121.739, 25.134);
INSERT INTO `app_area` VALUES (710306, '安乐区', 'Anle', 710300, 3, '02', '204', 121.723, 25.1209);
INSERT INTO `app_area` VALUES (710307, '信义区', 'Xinyi', 710300, 3, '02', '201', 121.751, 25.1294);
INSERT INTO `app_area` VALUES (710400, '台中市', 'Taichung', 710000, 2, '04', '4', 120.679, 24.1386);
INSERT INTO `app_area` VALUES (710401, '中区', 'Zhongqu', 710400, 3, '04', '400', 120.68, 24.1438);
INSERT INTO `app_area` VALUES (710402, '东区', 'Dongqu', 710400, 3, '04', '401', 120.704, 24.1366);
INSERT INTO `app_area` VALUES (710403, '南区', 'Nanqu', 710400, 3, '04', '402', 120.189, 22.9609);
INSERT INTO `app_area` VALUES (710404, '西区', 'Xiqu', 710400, 3, '04', '403', 120.671, 24.1414);
INSERT INTO `app_area` VALUES (710405, '北区', 'Beiqu', 710400, 3, '04', '404', 120.682, 24.166);
INSERT INTO `app_area` VALUES (710406, '西屯区', 'Xitun', 710400, 3, '04', '407', 120.64, 24.1813);
INSERT INTO `app_area` VALUES (710407, '南屯区', 'Nantun', 710400, 3, '04', '408', 120.643, 24.1383);
INSERT INTO `app_area` VALUES (710408, '北屯区', 'Beitun', 710400, 3, '04', '406', 120.686, 24.1822);
INSERT INTO `app_area` VALUES (710409, '丰原区', 'Fengyuan', 710400, 3, '04', '420', 120.718, 24.2422);
INSERT INTO `app_area` VALUES (710410, '东势区', 'Dongshi', 710400, 3, '04', '423', 120.828, 24.2586);
INSERT INTO `app_area` VALUES (710411, '大甲区', 'Dajia', 710400, 3, '04', '437', 120.622, 24.3489);
INSERT INTO `app_area` VALUES (710412, '清水区', 'Qingshui', 710400, 3, '04', '436', 120.56, 24.2687);
INSERT INTO `app_area` VALUES (710413, '沙鹿区', 'Shalu', 710400, 3, '04', '433', 120.566, 24.2335);
INSERT INTO `app_area` VALUES (710414, '梧栖区', 'Wuqi', 710400, 3, '04', '435', 120.532, 24.255);
INSERT INTO `app_area` VALUES (710415, '后里区', 'Houli', 710400, 3, '04', '421', 120.711, 24.3049);
INSERT INTO `app_area` VALUES (710416, '神冈区', 'Shengang', 710400, 3, '04', '429', 120.662, 24.2578);
INSERT INTO `app_area` VALUES (710417, '潭子区', 'Tanzi', 710400, 3, '04', '427', 120.705, 24.2095);
INSERT INTO `app_area` VALUES (710418, '大雅区', 'Daya', 710400, 3, '04', '428', 120.648, 24.2292);
INSERT INTO `app_area` VALUES (710419, '新社区', 'Xinshe', 710400, 3, '04', '426', 120.81, 24.2341);
INSERT INTO `app_area` VALUES (710420, '石冈区', 'Shigang', 710400, 3, '04', '422', 120.78, 24.275);
INSERT INTO `app_area` VALUES (710421, '外埔区', 'Waipu', 710400, 3, '04', '438', 120.654, 24.332);
INSERT INTO `app_area` VALUES (710422, '大安区', 'Da\'an', 710400, 3, '04', '439', 120.587, 24.3461);
INSERT INTO `app_area` VALUES (710423, '乌日区', 'Wuri', 710400, 3, '04', '414', 120.624, 24.1045);
INSERT INTO `app_area` VALUES (710424, '大肚区', 'Dadu', 710400, 3, '04', '432', 120.541, 24.1537);
INSERT INTO `app_area` VALUES (710425, '龙井区', 'Longjing', 710400, 3, '04', '434', 120.546, 24.1927);
INSERT INTO `app_area` VALUES (710426, '雾峰区', 'Wufeng', 710400, 3, '04', '413', 120.7, 24.0615);
INSERT INTO `app_area` VALUES (710427, '太平区', 'Taiping', 710400, 3, '04', '411', 120.719, 24.1265);
INSERT INTO `app_area` VALUES (710428, '大里区', 'Dali', 710400, 3, '04', '412', 120.678, 24.0994);
INSERT INTO `app_area` VALUES (710429, '和平区', 'Heping', 710400, 3, '04', '424', 120.883, 24.1748);
INSERT INTO `app_area` VALUES (710500, '台南市', 'Tainan', 710000, 2, '06', '7', 120.279, 23.1725);
INSERT INTO `app_area` VALUES (710501, '东区', 'Dongqu', 710500, 3, '06', '701', 120.224, 22.9801);
INSERT INTO `app_area` VALUES (710502, '南区', 'Nanqu', 710500, 3, '06', '702', 120.189, 22.9609);
INSERT INTO `app_area` VALUES (710504, '北区', 'Beiqu', 710500, 3, '06', '704', 120.682, 24.166);
INSERT INTO `app_area` VALUES (710506, '安南区', 'Annan', 710500, 3, '06', '709', 120.185, 23.0472);
INSERT INTO `app_area` VALUES (710507, '安平区', 'Anping', 710500, 3, '06', '708', 120.167, 23.0008);
INSERT INTO `app_area` VALUES (710508, '中西区', 'Zhongxi', 710500, 3, '06', '700', 120.206, 22.9922);
INSERT INTO `app_area` VALUES (710509, '新营区', 'Xinying', 710500, 3, '06', '730', 120.317, 23.3103);
INSERT INTO `app_area` VALUES (710510, '盐水区', 'Yanshui', 710500, 3, '06', '737', 120.266, 23.3198);
INSERT INTO `app_area` VALUES (710511, '白河区', 'Baihe', 710500, 3, '06', '732', 120.416, 23.3512);
INSERT INTO `app_area` VALUES (710512, '柳营区', 'Liuying', 710500, 3, '06', '736', 120.311, 23.2781);
INSERT INTO `app_area` VALUES (710513, '后壁区', 'Houbi', 710500, 3, '06', '731', 120.363, 23.3667);
INSERT INTO `app_area` VALUES (710514, '东山区', 'Dongshan', 710500, 3, '06', '733', 120.404, 23.3261);
INSERT INTO `app_area` VALUES (710515, '麻豆区', 'Madou', 710500, 3, '06', '721', 120.248, 23.1817);
INSERT INTO `app_area` VALUES (710516, '下营区', 'Xiaying', 710500, 3, '06', '735', 120.264, 23.2354);
INSERT INTO `app_area` VALUES (710517, '六甲区', 'Liujia', 710500, 3, '06', '734', 120.348, 23.2319);
INSERT INTO `app_area` VALUES (710518, '官田区', 'Guantian', 710500, 3, '06', '720', 120.314, 23.1947);
INSERT INTO `app_area` VALUES (710519, '大内区', 'Dana', 710500, 3, '06', '742', 120.349, 23.1195);
INSERT INTO `app_area` VALUES (710520, '佳里区', 'Jiali', 710500, 3, '06', '722', 120.177, 23.1651);
INSERT INTO `app_area` VALUES (710521, '学甲区', 'Xuejia', 710500, 3, '06', '726', 120.18, 23.2323);
INSERT INTO `app_area` VALUES (710522, '西港区', 'Xigang', 710500, 3, '06', '723', 120.204, 23.1231);
INSERT INTO `app_area` VALUES (710523, '七股区', 'Qigu', 710500, 3, '06', '724', 120.14, 23.1405);
INSERT INTO `app_area` VALUES (710524, '将军区', 'Jiangjun', 710500, 3, '06', '725', 120.157, 23.1995);
INSERT INTO `app_area` VALUES (710525, '北门区', 'Beimen', 710500, 3, '06', '727', 120.126, 23.2671);
INSERT INTO `app_area` VALUES (710526, '新化区', 'Xinhua', 710500, 3, '06', '712', 120.311, 23.0385);
INSERT INTO `app_area` VALUES (710527, '善化区', 'Shanhua', 710500, 3, '06', '741', 120.297, 23.1323);
INSERT INTO `app_area` VALUES (710528, '新市区', 'Xinshi', 710500, 3, '06', '744', 120.295, 23.079);
INSERT INTO `app_area` VALUES (710529, '安定区', 'Anding', 710500, 3, '06', '745', 120.237, 23.1215);
INSERT INTO `app_area` VALUES (710530, '山上区', 'Shanshang', 710500, 3, '06', '743', 120.353, 23.1032);
INSERT INTO `app_area` VALUES (710531, '玉井区', 'Yujing', 710500, 3, '06', '714', 120.46, 23.1239);
INSERT INTO `app_area` VALUES (710532, '楠西区', 'Nanxi', 710500, 3, '06', '715', 120.485, 23.1735);
INSERT INTO `app_area` VALUES (710533, '南化区', 'Nanhua', 710500, 3, '06', '716', 120.477, 23.0426);
INSERT INTO `app_area` VALUES (710534, '左镇区', 'Zuozhen', 710500, 3, '06', '713', 120.407, 23.058);
INSERT INTO `app_area` VALUES (710535, '仁德区', 'Rende', 710500, 3, '06', '717', 120.252, 22.9722);
INSERT INTO `app_area` VALUES (710536, '归仁区', 'Guiren', 710500, 3, '06', '711', 120.294, 22.9671);
INSERT INTO `app_area` VALUES (710537, '关庙区', 'Guanmiao', 710500, 3, '06', '718', 120.328, 22.9629);
INSERT INTO `app_area` VALUES (710538, '龙崎区', 'Longqi', 710500, 3, '06', '719', 120.361, 22.9657);
INSERT INTO `app_area` VALUES (710539, '永康区', 'Yongkang', 710500, 3, '06', '710', 120.257, 23.0261);
INSERT INTO `app_area` VALUES (710600, '新竹市', 'Hsinchu', 710000, 2, '03', '3', 120.969, 24.8067);
INSERT INTO `app_area` VALUES (710601, '东区', 'Dongqu', 710600, 3, '03', '300', 120.97, 24.8013);
INSERT INTO `app_area` VALUES (710602, '北区', 'Beiqu', 710600, 3, '03', '', 120.682, 24.166);
INSERT INTO `app_area` VALUES (710603, '香山区', 'Xiangshan', 710600, 3, '03', '', 120.957, 24.7689);
INSERT INTO `app_area` VALUES (710700, '嘉义市', 'Chiayi', 710000, 2, '05', '6', 120.453, 23.4816);
INSERT INTO `app_area` VALUES (710701, '东区', 'Dongqu', 710700, 3, '05', '600', 120.458, 23.4862);
INSERT INTO `app_area` VALUES (710702, '西区', 'Xiqu', 710700, 3, '05', '600', 120.437, 23.473);
INSERT INTO `app_area` VALUES (710800, '新北市', 'New Taipei', 710000, 2, '02', '2', 121.466, 25.0124);
INSERT INTO `app_area` VALUES (710801, '板桥区', 'Banqiao', 710800, 3, '02', '220', 121.459, 25.0096);
INSERT INTO `app_area` VALUES (710802, '三重区', 'Sanzhong', 710800, 3, '02', '241', 121.488, 25.0615);
INSERT INTO `app_area` VALUES (710803, '中和区', 'Zhonghe', 710800, 3, '02', '235', 121.499, 24.9994);
INSERT INTO `app_area` VALUES (710804, '永和区', 'Yonghe', 710800, 3, '02', '234', 121.514, 25.0078);
INSERT INTO `app_area` VALUES (710805, '新庄区', 'Xinzhuang', 710800, 3, '02', '242', 121.45, 25.0359);
INSERT INTO `app_area` VALUES (710806, '新店区', 'Xindian', 710800, 3, '02', '231', 121.542, 24.9676);
INSERT INTO `app_area` VALUES (710807, '树林区', 'Shulin', 710800, 3, '02', '238', 121.421, 24.9907);
INSERT INTO `app_area` VALUES (710808, '莺歌区', 'Yingge', 710800, 3, '02', '239', 121.355, 24.9554);
INSERT INTO `app_area` VALUES (710809, '三峡区', 'Sanxia', 710800, 3, '02', '237', 121.369, 24.9343);
INSERT INTO `app_area` VALUES (710810, '淡水区', 'Danshui', 710800, 3, '02', '251', 121.441, 25.1695);
INSERT INTO `app_area` VALUES (710811, '汐止区', 'Xizhi', 710800, 3, '02', '221', 121.629, 25.063);
INSERT INTO `app_area` VALUES (710812, '瑞芳区', 'Ruifang', 710800, 3, '02', '224', 121.81, 25.1089);
INSERT INTO `app_area` VALUES (710813, '土城区', 'Tucheng', 710800, 3, '02', '236', 121.443, 24.9722);
INSERT INTO `app_area` VALUES (710814, '芦洲区', 'Luzhou', 710800, 3, '02', '247', 121.474, 25.0849);
INSERT INTO `app_area` VALUES (710815, '五股区', 'Wugu', 710800, 3, '02', '248', 121.438, 25.0827);
INSERT INTO `app_area` VALUES (710816, '泰山区', 'Taishan', 710800, 3, '02', '243', 121.431, 25.0589);
INSERT INTO `app_area` VALUES (710817, '林口区', 'Linkou', 710800, 3, '02', '244', 121.392, 25.0775);
INSERT INTO `app_area` VALUES (710818, '深坑区', 'Shenkeng', 710800, 3, '02', '222', 121.616, 25.0023);
INSERT INTO `app_area` VALUES (710819, '石碇区', 'Shiding', 710800, 3, '02', '223', 121.659, 24.9917);
INSERT INTO `app_area` VALUES (710820, '坪林区', 'Pinglin', 710800, 3, '02', '232', 121.711, 24.9374);
INSERT INTO `app_area` VALUES (710821, '三芝区', 'Sanzhi', 710800, 3, '02', '252', 121.501, 25.258);
INSERT INTO `app_area` VALUES (710822, '石门区', 'Shimen', 710800, 3, '02', '253', 121.568, 25.2904);
INSERT INTO `app_area` VALUES (710823, '八里区', 'Bali', 710800, 3, '02', '249', 121.398, 25.1467);
INSERT INTO `app_area` VALUES (710824, '平溪区', 'Pingxi', 710800, 3, '02', '226', 121.738, 25.0257);
INSERT INTO `app_area` VALUES (710825, '双溪区', 'Shuangxi', 710800, 3, '02', '227', 121.866, 25.0334);
INSERT INTO `app_area` VALUES (710826, '贡寮区', 'Gongliao', 710800, 3, '02', '228', 121.908, 25.0224);
INSERT INTO `app_area` VALUES (710827, '金山区', 'Jinshan', 710800, 3, '02', '208', 121.636, 25.2219);
INSERT INTO `app_area` VALUES (710828, '万里区', 'Wanli', 710800, 3, '02', '207', 121.689, 25.1812);
INSERT INTO `app_area` VALUES (710829, '乌来区', 'Wulai', 710800, 3, '02', '233', 121.551, 24.8653);
INSERT INTO `app_area` VALUES (712200, '宜兰县', 'Yilan', 710000, 2, '03', '2', 121.5, 24.6);
INSERT INTO `app_area` VALUES (712201, '宜兰市', 'Yilan', 712200, 3, '03', '260', 121.753, 24.7517);
INSERT INTO `app_area` VALUES (712221, '罗东镇', 'Luodong', 712200, 3, '03', '265', 121.767, 24.677);
INSERT INTO `app_area` VALUES (712222, '苏澳镇', 'Suao', 712200, 3, '03', '270', 121.843, 24.5946);
INSERT INTO `app_area` VALUES (712223, '头城镇', 'Toucheng', 712200, 3, '03', '261', 121.823, 24.8592);
INSERT INTO `app_area` VALUES (712224, '礁溪乡', 'Jiaoxi', 712200, 3, '03', '262', 121.767, 24.8223);
INSERT INTO `app_area` VALUES (712225, '壮围乡', 'Zhuangwei', 712200, 3, '03', '263', 121.782, 24.7449);
INSERT INTO `app_area` VALUES (712226, '员山乡', 'Yuanshan', 712200, 3, '03', '264', 121.722, 24.7418);
INSERT INTO `app_area` VALUES (712227, '冬山乡', 'Dongshan', 712200, 3, '03', '269', 121.792, 24.6345);
INSERT INTO `app_area` VALUES (712228, '五结乡', 'Wujie', 712200, 3, '03', '268', 121.798, 24.6846);
INSERT INTO `app_area` VALUES (712229, '三星乡', 'Sanxing', 712200, 3, '03', '266', 121.003, 23.7753);
INSERT INTO `app_area` VALUES (712230, '大同乡', 'Datong', 712200, 3, '03', '267', 121.606, 24.676);
INSERT INTO `app_area` VALUES (712231, '南澳乡', 'Nanao', 712200, 3, '03', '272', 121.8, 24.4654);
INSERT INTO `app_area` VALUES (712300, '桃园县', 'Taoyuan', 710000, 2, '03', '3', 121.083, 25);
INSERT INTO `app_area` VALUES (712301, '桃园市', 'Taoyuan', 712300, 3, '03', '330', 121.301, 24.9938);
INSERT INTO `app_area` VALUES (712302, '中坜市', 'Zhongli', 712300, 3, '03', '320', 121.225, 24.9654);
INSERT INTO `app_area` VALUES (712303, '平镇市', 'Pingzhen', 712300, 3, '03', '324', 121.218, 24.9458);
INSERT INTO `app_area` VALUES (712304, '八德市', 'Bade', 712300, 3, '03', '334', 121.285, 24.9287);
INSERT INTO `app_area` VALUES (712305, '杨梅市', 'Yangmei', 712300, 3, '03', '326', 121.146, 24.9076);
INSERT INTO `app_area` VALUES (712306, '芦竹市', 'Luzhu', 712300, 3, '03', '338', 121.292, 25.0454);
INSERT INTO `app_area` VALUES (712321, '大溪镇', 'Daxi', 712300, 3, '03', '335', 121.287, 24.8806);
INSERT INTO `app_area` VALUES (712324, '大园乡', 'Dayuan', 712300, 3, '03', '337', 121.196, 25.0645);
INSERT INTO `app_area` VALUES (712325, '龟山乡', 'Guishan', 712300, 3, '03', '333', 121.338, 24.9925);
INSERT INTO `app_area` VALUES (712327, '龙潭乡', 'Longtan', 712300, 3, '03', '325', 121.216, 24.8639);
INSERT INTO `app_area` VALUES (712329, '新屋乡', 'Xinwu', 712300, 3, '03', '327', 121.106, 24.9722);
INSERT INTO `app_area` VALUES (712330, '观音乡', 'Guanyin', 712300, 3, '03', '328', 121.078, 25.0333);
INSERT INTO `app_area` VALUES (712331, '复兴乡', 'Fuxing', 712300, 3, '03', '336', 121.353, 24.8209);
INSERT INTO `app_area` VALUES (712400, '新竹县', 'Hsinchu', 710000, 2, '03', '3', 121.16, 24.6);
INSERT INTO `app_area` VALUES (712401, '竹北市', 'Zhubei', 712400, 3, '03', '302', 121.004, 24.8397);
INSERT INTO `app_area` VALUES (712421, '竹东镇', 'Zhudong', 712400, 3, '03', '310', 121.086, 24.7336);
INSERT INTO `app_area` VALUES (712422, '新埔镇', 'Xinpu', 712400, 3, '03', '305', 121.073, 24.8248);
INSERT INTO `app_area` VALUES (712423, '关西镇', 'Guanxi', 712400, 3, '03', '306', 121.177, 24.7888);
INSERT INTO `app_area` VALUES (712424, '湖口乡', 'Hukou', 712400, 3, '03', '303', 121.044, 24.9039);
INSERT INTO `app_area` VALUES (712425, '新丰乡', 'Xinfeng', 712400, 3, '03', '304', 120.983, 24.8996);
INSERT INTO `app_area` VALUES (712426, '芎林乡', 'Xionglin', 712400, 3, '03', '307', 121.077, 24.7744);
INSERT INTO `app_area` VALUES (712427, '横山乡', 'Hengshan', 712400, 3, '03', '312', 121.116, 24.7208);
INSERT INTO `app_area` VALUES (712428, '北埔乡', 'Beipu', 712400, 3, '03', '314', 121.053, 24.6971);
INSERT INTO `app_area` VALUES (712429, '宝山乡', 'Baoshan', 712400, 3, '03', '308', 120.986, 24.761);
INSERT INTO `app_area` VALUES (712430, '峨眉乡', 'Emei', 712400, 3, '03', '315', 121.015, 24.6861);
INSERT INTO `app_area` VALUES (712431, '尖石乡', 'Jianshi', 712400, 3, '03', '313', 121.198, 24.7044);
INSERT INTO `app_area` VALUES (712432, '五峰乡', 'Wufeng', 712400, 3, '03', '311', 121.003, 23.7753);
INSERT INTO `app_area` VALUES (712500, '苗栗县', 'Miaoli', 710000, 2, '037', '3', 120.75, 24.5);
INSERT INTO `app_area` VALUES (712501, '苗栗市', 'Miaoli', 712500, 3, '037', '360', 120.819, 24.5615);
INSERT INTO `app_area` VALUES (712521, '苑里镇', 'Yuanli', 712500, 3, '037', '358', 120.649, 24.4417);
INSERT INTO `app_area` VALUES (712522, '通霄镇', 'Tongxiao', 712500, 3, '037', '357', 120.677, 24.4891);
INSERT INTO `app_area` VALUES (712523, '竹南镇', 'Zhunan', 712500, 3, '037', '350', 120.873, 24.6855);
INSERT INTO `app_area` VALUES (712524, '头份镇', 'Toufen', 712500, 3, '037', '351', 120.895, 24.688);
INSERT INTO `app_area` VALUES (712525, '后龙镇', 'Houlong', 712500, 3, '037', '356', 120.786, 24.6126);
INSERT INTO `app_area` VALUES (712526, '卓兰镇', 'Zhuolan', 712500, 3, '037', '369', 120.823, 24.3095);
INSERT INTO `app_area` VALUES (712527, '大湖乡', 'Dahu', 712500, 3, '037', '364', 120.864, 24.4225);
INSERT INTO `app_area` VALUES (712528, '公馆乡', 'Gongguan', 712500, 3, '037', '363', 120.823, 24.4991);
INSERT INTO `app_area` VALUES (712529, '铜锣乡', 'Tongluo', 712500, 3, '037', '366', 121.003, 23.7753);
INSERT INTO `app_area` VALUES (712530, '南庄乡', 'Nanzhuang', 712500, 3, '037', '353', 120.995, 24.5968);
INSERT INTO `app_area` VALUES (712531, '头屋乡', 'Touwu', 712500, 3, '037', '362', 120.847, 24.5742);
INSERT INTO `app_area` VALUES (712532, '三义乡', 'Sanyi', 712500, 3, '037', '367', 120.742, 24.3503);
INSERT INTO `app_area` VALUES (712533, '西湖乡', 'Xihu', 712500, 3, '037', '368', 121.003, 23.7753);
INSERT INTO `app_area` VALUES (712534, '造桥乡', 'Zaoqiao', 712500, 3, '037', '361', 120.862, 24.6375);
INSERT INTO `app_area` VALUES (712535, '三湾乡', 'Sanwan', 712500, 3, '037', '352', 120.951, 24.6511);
INSERT INTO `app_area` VALUES (712536, '狮潭乡', 'Shitan', 712500, 3, '037', '354', 120.918, 24.54);
INSERT INTO `app_area` VALUES (712537, '泰安乡', 'Tai\'an', 712500, 3, '037', '365', 120.904, 24.4426);
INSERT INTO `app_area` VALUES (712700, '彰化县', 'Changhua', 710000, 2, '04', '5', 120.416, 24);
INSERT INTO `app_area` VALUES (712701, '彰化市', 'Zhanghuashi', 712700, 3, '04', '500', 120.542, 24.0809);
INSERT INTO `app_area` VALUES (712721, '鹿港镇', 'Lugang', 712700, 3, '04', '505', 120.435, 24.0569);
INSERT INTO `app_area` VALUES (712722, '和美镇', 'Hemei', 712700, 3, '04', '508', 120.5, 24.1109);
INSERT INTO `app_area` VALUES (712723, '线西乡', 'Xianxi', 712700, 3, '04', '507', 120.466, 24.1287);
INSERT INTO `app_area` VALUES (712724, '伸港乡', 'Shengang', 712700, 3, '04', '509', 120.484, 24.1461);
INSERT INTO `app_area` VALUES (712725, '福兴乡', 'Fuxing', 712700, 3, '04', '506', 120.444, 24.0479);
INSERT INTO `app_area` VALUES (712726, '秀水乡', 'Xiushui', 712700, 3, '04', '504', 120.503, 24.0353);
INSERT INTO `app_area` VALUES (712727, '花坛乡', 'Huatan', 712700, 3, '04', '503', 120.538, 24.0294);
INSERT INTO `app_area` VALUES (712728, '芬园乡', 'Fenyuan', 712700, 3, '04', '502', 120.629, 24.0137);
INSERT INTO `app_area` VALUES (712729, '员林镇', 'Yuanlin', 712700, 3, '04', '510', 120.575, 23.959);
INSERT INTO `app_area` VALUES (712730, '溪湖镇', 'Xihu', 712700, 3, '04', '514', 120.479, 23.9623);
INSERT INTO `app_area` VALUES (712731, '田中镇', 'Tianzhong', 712700, 3, '04', '520', 120.581, 23.8617);
INSERT INTO `app_area` VALUES (712732, '大村乡', 'Dacun', 712700, 3, '04', '515', 120.541, 23.9937);
INSERT INTO `app_area` VALUES (712733, '埔盐乡', 'Puyan', 712700, 3, '04', '516', 120.464, 24.0003);
INSERT INTO `app_area` VALUES (712734, '埔心乡', 'Puxin', 712700, 3, '04', '513', 120.544, 23.953);
INSERT INTO `app_area` VALUES (712735, '永靖乡', 'Yongjing', 712700, 3, '04', '512', 120.548, 23.9247);
INSERT INTO `app_area` VALUES (712736, '社头乡', 'Shetou', 712700, 3, '04', '511', 120.583, 23.8967);
INSERT INTO `app_area` VALUES (712737, '二水乡', 'Ershui', 712700, 3, '04', '530', 120.619, 23.807);
INSERT INTO `app_area` VALUES (712738, '北斗镇', 'Beidou', 712700, 3, '04', '521', 120.52, 23.8709);
INSERT INTO `app_area` VALUES (712739, '二林镇', 'Erlin', 712700, 3, '04', '526', 120.374, 23.8998);
INSERT INTO `app_area` VALUES (712740, '田尾乡', 'Tianwei', 712700, 3, '04', '522', 120.525, 23.8907);
INSERT INTO `app_area` VALUES (712741, '埤头乡', 'Pitou', 712700, 3, '04', '523', 120.463, 23.8913);
INSERT INTO `app_area` VALUES (712742, '芳苑乡', 'Fangyuan', 712700, 3, '04', '528', 120.32, 23.9242);
INSERT INTO `app_area` VALUES (712743, '大城乡', 'Dacheng', 712700, 3, '04', '527', 120.321, 23.8524);
INSERT INTO `app_area` VALUES (712744, '竹塘乡', 'Zhutang', 712700, 3, '04', '525', 120.427, 23.8601);
INSERT INTO `app_area` VALUES (712745, '溪州乡', 'Xizhou', 712700, 3, '04', '524', 120.499, 23.8512);
INSERT INTO `app_area` VALUES (712800, '南投县', 'Nantou', 710000, 2, '049', '5', 120.83, 23.83);
INSERT INTO `app_area` VALUES (712801, '南投市', 'Nantoushi', 712800, 3, '049', '540', 120.684, 23.91);
INSERT INTO `app_area` VALUES (712821, '埔里镇', 'Puli', 712800, 3, '049', '545', 120.965, 23.9648);
INSERT INTO `app_area` VALUES (712822, '草屯镇', 'Caotun', 712800, 3, '049', '542', 120.68, 23.9739);
INSERT INTO `app_area` VALUES (712823, '竹山镇', 'Zhushan', 712800, 3, '049', '557', 120.672, 23.7577);
INSERT INTO `app_area` VALUES (712824, '集集镇', 'Jiji', 712800, 3, '049', '552', 120.784, 23.829);
INSERT INTO `app_area` VALUES (712825, '名间乡', 'Mingjian', 712800, 3, '049', '551', 120.703, 23.8384);
INSERT INTO `app_area` VALUES (712826, '鹿谷乡', 'Lugu', 712800, 3, '049', '558', 120.753, 23.7445);
INSERT INTO `app_area` VALUES (712827, '中寮乡', 'Zhongliao', 712800, 3, '049', '541', 120.767, 23.8789);
INSERT INTO `app_area` VALUES (712828, '鱼池乡', 'Yuchi', 712800, 3, '049', '555', 120.936, 23.8964);
INSERT INTO `app_area` VALUES (712829, '国姓乡', 'Guoxing', 712800, 3, '049', '544', 120.859, 24.0423);
INSERT INTO `app_area` VALUES (712830, '水里乡', 'Shuili', 712800, 3, '049', '553', 120.856, 23.8121);
INSERT INTO `app_area` VALUES (712831, '信义乡', 'Xinyi', 712800, 3, '049', '556', 120.855, 23.6999);
INSERT INTO `app_area` VALUES (712832, '仁爱乡', 'Renai', 712800, 3, '049', '546', 121.134, 24.0244);
INSERT INTO `app_area` VALUES (712900, '云林县', 'Yunlin', 710000, 2, '05', '6', 120.25, 23.75);
INSERT INTO `app_area` VALUES (712901, '斗六市', 'Douliu', 712900, 3, '05', '640', 120.527, 23.6977);
INSERT INTO `app_area` VALUES (712921, '斗南镇', 'Dounan', 712900, 3, '05', '630', 120.479, 23.6797);
INSERT INTO `app_area` VALUES (712922, '虎尾镇', 'Huwei', 712900, 3, '05', '632', 120.445, 23.7082);
INSERT INTO `app_area` VALUES (712923, '西螺镇', 'Xiluo', 712900, 3, '05', '648', 120.466, 23.798);
INSERT INTO `app_area` VALUES (712924, '土库镇', 'Tuku', 712900, 3, '05', '633', 120.393, 23.6778);
INSERT INTO `app_area` VALUES (712925, '北港镇', 'Beigang', 712900, 3, '05', '651', 120.302, 23.5755);
INSERT INTO `app_area` VALUES (712926, '古坑乡', 'Gukeng', 712900, 3, '05', '646', 120.562, 23.6426);
INSERT INTO `app_area` VALUES (712927, '大埤乡', 'Dapi', 712900, 3, '05', '631', 120.431, 23.6459);
INSERT INTO `app_area` VALUES (712928, '莿桐乡', 'Citong', 712900, 3, '05', '647', 120.502, 23.7608);
INSERT INTO `app_area` VALUES (712929, '林内乡', 'Linna', 712900, 3, '05', '643', 120.611, 23.7587);
INSERT INTO `app_area` VALUES (712930, '二仑乡', 'Erlun', 712900, 3, '05', '649', 120.415, 23.7713);
INSERT INTO `app_area` VALUES (712931, '仑背乡', 'Lunbei', 712900, 3, '05', '637', 120.354, 23.7588);
INSERT INTO `app_area` VALUES (712932, '麦寮乡', 'Mailiao', 712900, 3, '05', '638', 120.252, 23.7538);
INSERT INTO `app_area` VALUES (712933, '东势乡', 'Dongshi', 712900, 3, '05', '635', 120.253, 23.6747);
INSERT INTO `app_area` VALUES (712934, '褒忠乡', 'Baozhong', 712900, 3, '05', '634', 120.31, 23.6942);
INSERT INTO `app_area` VALUES (712935, '台西乡', 'Taixi', 712900, 3, '05', '636', 120.196, 23.7028);
INSERT INTO `app_area` VALUES (712936, '元长乡', 'Yuanchang', 712900, 3, '05', '655', 120.315, 23.6495);
INSERT INTO `app_area` VALUES (712937, '四湖乡', 'Sihu', 712900, 3, '05', '654', 120.226, 23.6377);
INSERT INTO `app_area` VALUES (712938, '口湖乡', 'Kouhu', 712900, 3, '05', '653', 120.185, 23.5824);
INSERT INTO `app_area` VALUES (712939, '水林乡', 'Shuilin', 712900, 3, '05', '652', 120.246, 23.5726);
INSERT INTO `app_area` VALUES (713000, '嘉义县', 'Chiayi', 710000, 2, '05', '6', 120.3, 23.5);
INSERT INTO `app_area` VALUES (713001, '太保市', 'Taibao', 713000, 3, '05', '612', 120.333, 23.4596);
INSERT INTO `app_area` VALUES (713002, '朴子市', 'Puzi', 713000, 3, '05', '613', 120.247, 23.465);
INSERT INTO `app_area` VALUES (713023, '布袋镇', 'Budai', 713000, 3, '05', '625', 120.167, 23.378);
INSERT INTO `app_area` VALUES (713024, '大林镇', 'Dalin', 713000, 3, '05', '622', 120.471, 23.6038);
INSERT INTO `app_area` VALUES (713025, '民雄乡', 'Minxiong', 713000, 3, '05', '621', 120.429, 23.5515);
INSERT INTO `app_area` VALUES (713026, '溪口乡', 'Xikou', 713000, 3, '05', '623', 120.394, 23.6022);
INSERT INTO `app_area` VALUES (713027, '新港乡', 'Xingang', 713000, 3, '05', '616', 120.348, 23.5518);
INSERT INTO `app_area` VALUES (713028, '六脚乡', 'Liujiao', 713000, 3, '05', '615', 120.291, 23.4939);
INSERT INTO `app_area` VALUES (713029, '东石乡', 'Dongshi', 713000, 3, '05', '614', 120.154, 23.4592);
INSERT INTO `app_area` VALUES (713030, '义竹乡', 'Yizhu', 713000, 3, '05', '624', 120.243, 23.3363);
INSERT INTO `app_area` VALUES (713031, '鹿草乡', 'Lucao', 713000, 3, '05', '611', 120.308, 23.4108);
INSERT INTO `app_area` VALUES (713032, '水上乡', 'Shuishang', 713000, 3, '05', '608', 120.398, 23.4281);
INSERT INTO `app_area` VALUES (713033, '中埔乡', 'Zhongpu', 713000, 3, '05', '606', 120.523, 23.4251);
INSERT INTO `app_area` VALUES (713034, '竹崎乡', 'Zhuqi', 713000, 3, '05', '604', 120.551, 23.5232);
INSERT INTO `app_area` VALUES (713035, '梅山乡', 'Meishan', 713000, 3, '05', '603', 120.557, 23.5849);
INSERT INTO `app_area` VALUES (713036, '番路乡', 'Fanlu', 713000, 3, '05', '602', 120.555, 23.4652);
INSERT INTO `app_area` VALUES (713037, '大埔乡', 'Dapu', 713000, 3, '05', '607', 120.594, 23.2967);
INSERT INTO `app_area` VALUES (713038, '阿里山乡', 'Alishan', 713000, 3, '05', '605', 120.733, 23.468);
INSERT INTO `app_area` VALUES (713300, '屏东县', 'Pingtung', 710000, 2, '08', '9', 120.488, 22.6828);
INSERT INTO `app_area` VALUES (713301, '屏东市', 'Pingdong', 713300, 3, '08', '900', 120.488, 22.6697);
INSERT INTO `app_area` VALUES (713321, '潮州镇', 'Chaozhou', 713300, 3, '08', '920', 120.543, 22.5505);
INSERT INTO `app_area` VALUES (713322, '东港镇', 'Donggang', 713300, 3, '08', '928', 120.454, 22.4666);
INSERT INTO `app_area` VALUES (713323, '恒春镇', 'Hengchun', 713300, 3, '08', '946', 120.745, 22.0024);
INSERT INTO `app_area` VALUES (713324, '万丹乡', 'Wandan', 713300, 3, '08', '913', 120.485, 22.5898);
INSERT INTO `app_area` VALUES (713325, '长治乡', 'Changzhi', 713300, 3, '08', '908', 120.528, 22.6771);
INSERT INTO `app_area` VALUES (713326, '麟洛乡', 'Linluo', 713300, 3, '08', '909', 120.527, 22.6506);
INSERT INTO `app_area` VALUES (713327, '九如乡', 'Jiuru', 713300, 3, '08', '904', 120.49, 22.7398);
INSERT INTO `app_area` VALUES (713328, '里港乡', 'Ligang', 713300, 3, '08', '905', 120.494, 22.7792);
INSERT INTO `app_area` VALUES (713329, '盐埔乡', 'Yanpu', 713300, 3, '08', '907', 120.573, 22.7548);
INSERT INTO `app_area` VALUES (713330, '高树乡', 'Gaoshu', 713300, 3, '08', '906', 120.6, 22.8268);
INSERT INTO `app_area` VALUES (713331, '万峦乡', 'Wanluan', 713300, 3, '08', '923', 120.566, 22.572);
INSERT INTO `app_area` VALUES (713332, '内埔乡', 'Napu', 713300, 3, '08', '912', 120.567, 22.612);
INSERT INTO `app_area` VALUES (713333, '竹田乡', 'Zhutian', 713300, 3, '08', '911', 120.544, 22.5847);
INSERT INTO `app_area` VALUES (713334, '新埤乡', 'Xinpi', 713300, 3, '08', '925', 120.55, 22.47);
INSERT INTO `app_area` VALUES (713335, '枋寮乡', 'Fangliao', 713300, 3, '08', '940', 120.593, 22.3656);
INSERT INTO `app_area` VALUES (713336, '新园乡', 'Xinyuan', 713300, 3, '08', '932', 120.462, 22.544);
INSERT INTO `app_area` VALUES (713337, '崁顶乡', 'Kanding', 713300, 3, '08', '924', 120.515, 22.5148);
INSERT INTO `app_area` VALUES (713338, '林边乡', 'Linbian', 713300, 3, '08', '927', 120.515, 22.434);
INSERT INTO `app_area` VALUES (713339, '南州乡', 'Nanzhou', 713300, 3, '08', '926', 120.51, 22.4902);
INSERT INTO `app_area` VALUES (713340, '佳冬乡', 'Jiadong', 713300, 3, '08', '931', 120.552, 22.4177);
INSERT INTO `app_area` VALUES (713341, '琉球乡', 'Liuqiu', 713300, 3, '08', '929', 120.369, 22.3424);
INSERT INTO `app_area` VALUES (713342, '车城乡', 'Checheng', 713300, 3, '08', '944', 120.711, 22.0721);
INSERT INTO `app_area` VALUES (713343, '满州乡', 'Manzhou', 713300, 3, '08', '947', 120.839, 22.0209);
INSERT INTO `app_area` VALUES (713344, '枋山乡', 'Fangshan', 713300, 3, '08', '941', 120.656, 22.2603);
INSERT INTO `app_area` VALUES (713345, '三地门乡', 'Sandimen', 713300, 3, '08', '901', 120.654, 22.7139);
INSERT INTO `app_area` VALUES (713346, '雾台乡', 'Wutai', 713300, 3, '08', '902', 120.732, 22.7449);
INSERT INTO `app_area` VALUES (713347, '玛家乡', 'Majia', 713300, 3, '08', '903', 120.644, 22.7067);
INSERT INTO `app_area` VALUES (713348, '泰武乡', 'Taiwu', 713300, 3, '08', '921', 120.633, 22.5918);
INSERT INTO `app_area` VALUES (713349, '来义乡', 'Laiyi', 713300, 3, '08', '922', 120.634, 22.5259);
INSERT INTO `app_area` VALUES (713350, '春日乡', 'Chunri', 713300, 3, '08', '942', 120.629, 22.3707);
INSERT INTO `app_area` VALUES (713351, '狮子乡', 'Shizi', 713300, 3, '08', '943', 120.705, 22.2019);
INSERT INTO `app_area` VALUES (713352, '牡丹乡', 'Mudan', 713300, 3, '08', '945', 120.77, 22.1257);
INSERT INTO `app_area` VALUES (713400, '台东县', 'Taitung', 710000, 2, '089', '9', 120.916, 23);
INSERT INTO `app_area` VALUES (713401, '台东市', 'Taidong', 713400, 3, '089', '950', 121.146, 22.756);
INSERT INTO `app_area` VALUES (713421, '成功镇', 'Chenggong', 713400, 3, '089', '961', 121.38, 23.1002);
INSERT INTO `app_area` VALUES (713422, '关山镇', 'Guanshan', 713400, 3, '089', '956', 121.163, 23.0474);
INSERT INTO `app_area` VALUES (713423, '卑南乡', 'Beinan', 713400, 3, '089', '954', 121.084, 22.786);
INSERT INTO `app_area` VALUES (713424, '鹿野乡', 'Luye', 713400, 3, '089', '955', 121.136, 22.914);
INSERT INTO `app_area` VALUES (713425, '池上乡', 'Chishang', 713400, 3, '089', '958', 121.215, 23.1224);
INSERT INTO `app_area` VALUES (713426, '东河乡', 'Donghe', 713400, 3, '089', '959', 121.3, 22.9699);
INSERT INTO `app_area` VALUES (713427, '长滨乡', 'Changbin', 713400, 3, '089', '962', 121.452, 23.315);
INSERT INTO `app_area` VALUES (713428, '太麻里乡', 'Taimali', 713400, 3, '089', '963', 121.007, 22.6154);
INSERT INTO `app_area` VALUES (713429, '大武乡', 'Dawu', 713400, 3, '089', '965', 120.89, 22.3399);
INSERT INTO `app_area` VALUES (713430, '绿岛乡', 'Lvdao', 713400, 3, '089', '951', 121.493, 22.6617);
INSERT INTO `app_area` VALUES (713431, '海端乡', 'Haiduan', 713400, 3, '089', '957', 121.172, 23.1011);
INSERT INTO `app_area` VALUES (713432, '延平乡', 'Yanping', 713400, 3, '089', '953', 121.084, 22.9024);
INSERT INTO `app_area` VALUES (713433, '金峰乡', 'Jinfeng', 713400, 3, '089', '964', 120.971, 22.5955);
INSERT INTO `app_area` VALUES (713434, '达仁乡', 'Daren', 713400, 3, '089', '966', 120.884, 22.2949);
INSERT INTO `app_area` VALUES (713435, '兰屿乡', 'Lanyu', 713400, 3, '089', '952', 121.532, 22.0567);
INSERT INTO `app_area` VALUES (713500, '花莲县', 'Hualien', 710000, 2, '03', '9', 121.3, 23.83);
INSERT INTO `app_area` VALUES (713501, '花莲市', 'Hualian', 713500, 3, '03', '970', 121.607, 23.9821);
INSERT INTO `app_area` VALUES (713521, '凤林镇', 'Fenglin', 713500, 3, '03', '975', 121.452, 23.7446);
INSERT INTO `app_area` VALUES (713522, '玉里镇', 'Yuli', 713500, 3, '03', '981', 121.316, 23.3365);
INSERT INTO `app_area` VALUES (713523, '新城乡', 'Xincheng', 713500, 3, '03', '971', 121.641, 24.1281);
INSERT INTO `app_area` VALUES (713524, '吉安乡', 'Ji\'an', 713500, 3, '03', '973', 121.568, 23.9616);
INSERT INTO `app_area` VALUES (713525, '寿丰乡', 'Shoufeng', 713500, 3, '03', '974', 121.509, 23.8707);
INSERT INTO `app_area` VALUES (713526, '光复乡', 'Guangfu', 713500, 3, '03', '976', 121.423, 23.6691);
INSERT INTO `app_area` VALUES (713527, '丰滨乡', 'Fengbin', 713500, 3, '03', '977', 121.519, 23.5971);
INSERT INTO `app_area` VALUES (713528, '瑞穗乡', 'Ruisui', 713500, 3, '03', '978', 121.376, 23.4968);
INSERT INTO `app_area` VALUES (713529, '富里乡', 'Fuli', 713500, 3, '03', '983', 121.25, 23.18);
INSERT INTO `app_area` VALUES (713530, '秀林乡', 'Xiulin', 713500, 3, '03', '972', 121.62, 24.1166);
INSERT INTO `app_area` VALUES (713531, '万荣乡', 'Wanrong', 713500, 3, '03', '979', 121.407, 23.7153);
INSERT INTO `app_area` VALUES (713532, '卓溪乡', 'Zhuoxi', 713500, 3, '03', '982', 121.303, 23.3464);
INSERT INTO `app_area` VALUES (713600, '澎湖县', 'Penghu', 710000, 2, '06', '8', 119.566, 23.5697);
INSERT INTO `app_area` VALUES (713601, '马公市', 'Magong', 713600, 3, '06', '880', 119.566, 23.5658);
INSERT INTO `app_area` VALUES (713621, '湖西乡', 'Huxi', 713600, 3, '06', '885', 119.66, 23.5834);
INSERT INTO `app_area` VALUES (713622, '白沙乡', 'Baisha', 713600, 3, '06', '884', 119.598, 23.6661);
INSERT INTO `app_area` VALUES (713623, '西屿乡', 'Xiyu', 713600, 3, '06', '881', 119.507, 23.6008);
INSERT INTO `app_area` VALUES (713624, '望安乡', 'Wang\'an', 713600, 3, '06', '882', 119.501, 23.3575);
INSERT INTO `app_area` VALUES (713625, '七美乡', 'Qimei', 713600, 3, '06', '883', 119.424, 23.206);
INSERT INTO `app_area` VALUES (713700, '金门县', 'Jinmen', 710000, 2, '082', '8', 118.317, 24.4327);
INSERT INTO `app_area` VALUES (713701, '金城镇', 'Jincheng', 713700, 3, '082', '893', 118.317, 24.4167);
INSERT INTO `app_area` VALUES (713702, '金湖镇', 'Jinhu', 713700, 3, '082', '891', 118.42, 24.4386);
INSERT INTO `app_area` VALUES (713703, '金沙镇', 'Jinsha', 713700, 3, '082', '890', 118.428, 24.4811);
INSERT INTO `app_area` VALUES (713704, '金宁乡', 'Jinning', 713700, 3, '082', '892', 118.335, 24.4567);
INSERT INTO `app_area` VALUES (713705, '烈屿乡', 'Lieyu', 713700, 3, '082', '894', 118.247, 24.4331);
INSERT INTO `app_area` VALUES (713706, '乌丘乡', 'Wuqiu', 713700, 3, '082', '896', 118.32, 24.435);
INSERT INTO `app_area` VALUES (713800, '连江县', 'Lienchiang', 710000, 2, '0836', '2', 119.54, 26.1974);
INSERT INTO `app_area` VALUES (713801, '南竿乡', 'Nangan', 713800, 3, '0836', '209', 119.944, 26.144);
INSERT INTO `app_area` VALUES (713802, '北竿乡', 'Beigan', 713800, 3, '0836', '210', 120.001, 26.222);
INSERT INTO `app_area` VALUES (713803, '莒光乡', 'Juguang', 713800, 3, '0836', '211', 119.94, 25.9763);
INSERT INTO `app_area` VALUES (713804, '东引乡', 'Dongyin', 713800, 3, '0836', '212', 120.494, 26.3662);
INSERT INTO `app_area` VALUES (810000, '香港特别行政区', 'Hong Kong', 100000, 1, '', '', 114.173, 22.32);
INSERT INTO `app_area` VALUES (810100, '香港岛', 'Hong Kong Island', 810000, 2, '00852', '999077', 114.177, 22.2664);
INSERT INTO `app_area` VALUES (810101, '中西区', 'Central and Western District', 810100, 3, '00852', '999077', 114.154, 22.282);
INSERT INTO `app_area` VALUES (810102, '湾仔区', 'Wan Chai District', 810100, 3, '00852', '999077', 114.183, 22.2764);
INSERT INTO `app_area` VALUES (810103, '东区', 'Eastern District', 810100, 3, '00852', '999077', 114.256, 22.2628);
INSERT INTO `app_area` VALUES (810104, '南区', 'Southern District', 810100, 3, '00852', '999077', 114.174, 22.2468);
INSERT INTO `app_area` VALUES (810200, '九龙', 'Kowloon', 810000, 2, '00852', '999077', 114.175, 22.3271);
INSERT INTO `app_area` VALUES (810201, '油尖旺区', 'Yau Tsim Mong', 810200, 3, '00852', '999077', 114.173, 22.3117);
INSERT INTO `app_area` VALUES (810202, '深水埗区', 'Sham Shui Po', 810200, 3, '00852', '999077', 114.167, 22.3282);
INSERT INTO `app_area` VALUES (810203, '九龙城区', 'Jiulongcheng', 810200, 3, '00852', '999077', 114.195, 22.3267);
INSERT INTO `app_area` VALUES (810204, '黄大仙区', 'Wong Tai Sin', 810200, 3, '00852', '999077', 114.199, 22.3363);
INSERT INTO `app_area` VALUES (810205, '观塘区', 'Kwun Tong', 810200, 3, '00852', '999077', 114.231, 22.3094);
INSERT INTO `app_area` VALUES (810300, '新界', 'New Territories', 810000, 2, '00852', '999077', 114.202, 22.3418);
INSERT INTO `app_area` VALUES (810301, '荃湾区', 'Tsuen Wan', 810300, 3, '00852', '999077', 114.123, 22.371);
INSERT INTO `app_area` VALUES (810302, '屯门区', 'Tuen Mun', 810300, 3, '00852', '999077', 113.977, 22.391);
INSERT INTO `app_area` VALUES (810303, '元朗区', 'Yuen Long', 810300, 3, '00852', '999077', 114.04, 22.4433);
INSERT INTO `app_area` VALUES (810304, '北区', 'North District', 810300, 3, '00852', '999077', 114.149, 22.4941);
INSERT INTO `app_area` VALUES (810305, '大埔区', 'Tai Po', 810300, 3, '00852', '999077', 114.172, 22.4457);
INSERT INTO `app_area` VALUES (810306, '西贡区', 'Sai Kung', 810300, 3, '00852', '999077', 114.279, 22.3794);
INSERT INTO `app_area` VALUES (810307, '沙田区', 'Sha Tin', 810300, 3, '00852', '999077', 114.192, 22.3793);
INSERT INTO `app_area` VALUES (810308, '葵青区', 'Kwai Tsing', 810300, 3, '00852', '999077', 114.139, 22.3639);
INSERT INTO `app_area` VALUES (810309, '离岛区', 'Outlying Islands', 810300, 3, '00852', '999077', 113.946, 22.2815);
INSERT INTO `app_area` VALUES (820000, '澳门特别行政区', 'Macau', 100000, 1, '', '', 113.549, 22.199);
INSERT INTO `app_area` VALUES (820100, '澳门半岛', 'MacauPeninsula', 820000, 2, '00853', '999078', 113.549, 22.1988);
INSERT INTO `app_area` VALUES (820101, '花地玛堂区', 'Nossa Senhora de Fatima', 820100, 3, '00853', '999078', 113.552, 22.2081);
INSERT INTO `app_area` VALUES (820102, '圣安多尼堂区', 'Santo Antonio', 820100, 3, '00853', '999078', 113.564, 22.1238);
INSERT INTO `app_area` VALUES (820103, '大堂区', 'Sé', 820100, 3, '00853', '999078', 113.553, 22.1884);
INSERT INTO `app_area` VALUES (820104, '望德堂区', 'Sao Lazaro', 820100, 3, '00853', '999078', 113.551, 22.1941);
INSERT INTO `app_area` VALUES (820105, '风顺堂区', 'Sao Lourenco', 820100, 3, '00853', '999078', 113.542, 22.1874);
INSERT INTO `app_area` VALUES (820200, '氹仔岛', 'Taipa', 820000, 2, '00853', '999078', 113.578, 22.1568);
INSERT INTO `app_area` VALUES (820201, '嘉模堂区', 'Our Lady Of Carmel\'s Parish', 820200, 3, '00853', '999078', 113.565, 22.149);
INSERT INTO `app_area` VALUES (820300, '路环岛', 'Coloane', 820000, 2, '00853', '999078', 113.565, 22.1162);
INSERT INTO `app_area` VALUES (820301, '圣方济各堂区', 'St Francis Xavier\'s Parish', 820300, 3, '00853', '999078', 113.56, 22.1235);
INSERT INTO `app_area` VALUES (900000, '钓鱼岛', 'DiaoyuDao', 100000, 1, '', '', 123.478, 25.7424);
COMMIT;

-- ----------------------------
-- Table structure for app_banner
-- ----------------------------
DROP TABLE IF EXISTS `app_banner`;
CREATE TABLE `app_banner` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `file_id` bigint(20) unsigned NOT NULL COMMENT '图片文件Id',
  `bind_id` bigint(20) DEFAULT NULL COMMENT 'bind id',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1 App首页展示banner ',
  `options` json NOT NULL COMMENT '数据',
  `rank` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='banner表';

-- ----------------------------
-- Records of app_banner
-- ----------------------------
BEGIN;
INSERT INTO `app_banner` VALUES (100001, '1', 1000, NULL, 1, '{\"style\": \"background: linear-gradient(#FCAB2B, #FCAB2B);\"}', 2, 0, 100001, '2020-08-30 15:21:38', 10001, '2021-12-24 11:40:42');
COMMIT;

-- ----------------------------
-- Table structure for app_cashier
-- ----------------------------
DROP TABLE IF EXISTS `app_cashier`;
CREATE TABLE `app_cashier` (
  `id` bigint(11) unsigned NOT NULL COMMENT '订单收银关联Id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收款标题',
  `total_amount` decimal(65,2) unsigned NOT NULL COMMENT '总金额',
  `payment_amount` decimal(65,2) DEFAULT NULL COMMENT '实际付款金额',
  `pay_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付方式 1 微信、2 支付宝 3 钱包',
  `is_pay` bit(1) DEFAULT b'0' COMMENT '是否支付',
  `pay_time` datetime DEFAULT NULL COMMENT '付款时间',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='收银表';

-- ----------------------------
-- Records of app_cashier
-- ----------------------------
BEGIN;
INSERT INTO `app_cashier` VALUES (14080471046, '开通', 0.01, NULL, NULL, b'0', NULL, b'0', 78829214251, '2022-04-01 22:58:41', NULL, NULL);
INSERT INTO `app_cashier` VALUES (16727294580, '开通月卡会员', 38.00, NULL, NULL, b'0', NULL, b'0', 12500234136, '2022-04-01 19:09:42', NULL, NULL);
INSERT INTO `app_cashier` VALUES (17662843495, '充值100积分', 1.00, NULL, NULL, b'0', NULL, b'0', 77262252793, '2022-03-30 13:08:37', NULL, NULL);
INSERT INTO `app_cashier` VALUES (18854724599, '开通', 0.01, 0.01, 'wechat', b'1', '2022-04-01 20:22:45', b'0', 12500234136, '2022-04-01 20:22:39', NULL, '2022-04-01 20:22:45');
INSERT INTO `app_cashier` VALUES (20203418045, '充值1111积分', 11.11, NULL, NULL, b'0', NULL, b'0', 52126202929, '2022-03-29 22:32:34', NULL, NULL);
INSERT INTO `app_cashier` VALUES (24342087162, '开通年卡会员', 0.01, 0.01, 'wechat', b'1', '2022-04-01 19:29:59', b'0', 12500234136, '2022-04-01 19:15:41', NULL, '2022-04-01 19:29:59');
INSERT INTO `app_cashier` VALUES (26203917387, '开通月卡会员', 0.01, NULL, NULL, b'0', NULL, b'0', 12500234136, '2022-04-01 19:17:41', NULL, NULL);
INSERT INTO `app_cashier` VALUES (26494856162, '开通年卡会员', 0.01, 0.01, 'wechat', b'1', '2022-04-01 19:24:17', b'0', 12500234136, '2022-04-01 19:24:10', NULL, '2022-04-01 19:24:17');
INSERT INTO `app_cashier` VALUES (28388200319, '开通月卡会员会员', 38.00, NULL, NULL, b'0', NULL, b'0', 12500234136, '2022-04-01 19:07:11', NULL, NULL);
INSERT INTO `app_cashier` VALUES (36145517492, '充值1000积分', 10.00, NULL, NULL, b'0', NULL, b'0', 12500234136, '2022-04-08 23:05:06', NULL, NULL);
INSERT INTO `app_cashier` VALUES (53811040250, '充值100积分', 1.00, NULL, NULL, b'0', NULL, b'0', 78829214251, '2022-03-31 01:15:43', NULL, NULL);
INSERT INTO `app_cashier` VALUES (59890397494, '开通', 0.01, 0.01, 'wechat', b'1', '2022-04-01 20:23:02', b'0', 12500234136, '2022-04-01 20:22:56', NULL, '2022-04-01 20:23:02');
INSERT INTO `app_cashier` VALUES (60271064808, '开通月卡会员', 0.01, 0.01, 'wechat', b'1', '2022-04-01 20:15:13', b'0', 12500234136, '2022-04-01 20:15:06', NULL, '2022-04-01 20:15:13');
INSERT INTO `app_cashier` VALUES (60772857955, '开通月卡会员', 38.00, NULL, NULL, b'0', NULL, b'0', 12500234136, '2022-04-01 19:09:02', NULL, NULL);
INSERT INTO `app_cashier` VALUES (71060312948, '开通月卡会员', 38.00, NULL, NULL, b'0', NULL, b'0', 12500234136, '2022-04-01 19:16:26', NULL, NULL);
INSERT INTO `app_cashier` VALUES (71148317796, '开通', 0.01, 0.01, 'wechat', b'1', '2022-04-01 20:19:32', b'0', 12500234136, '2022-04-01 20:19:25', NULL, '2022-04-01 20:19:32');
INSERT INTO `app_cashier` VALUES (77956400846, '充值100积分', 1.00, NULL, NULL, b'0', NULL, b'0', 77262252793, '2022-03-30 13:01:10', NULL, NULL);
INSERT INTO `app_cashier` VALUES (84356947678, '开通年卡会员', 0.01, 0.01, 'wechat', b'1', '2022-04-01 19:24:47', b'0', 12500234136, '2022-04-01 19:10:25', NULL, '2022-04-01 19:24:47');
INSERT INTO `app_cashier` VALUES (84598151321, '充值100积分', 1.00, NULL, NULL, b'0', NULL, b'0', 52126202929, '2022-03-30 15:23:34', NULL, NULL);
INSERT INTO `app_cashier` VALUES (88174843395, '充值100积分', 1.00, NULL, NULL, b'0', NULL, b'0', 77262252793, '2022-03-30 13:08:33', NULL, NULL);
INSERT INTO `app_cashier` VALUES (90097717666, '开通月卡会员', 0.01, 0.01, 'wechat', b'1', '2022-04-01 19:31:11', b'0', 12500234136, '2022-04-01 19:16:55', NULL, '2022-04-01 19:31:11');
INSERT INTO `app_cashier` VALUES (94443630124, '开通年卡会员', 0.01, 0.01, 'wechat', b'1', '2022-04-01 19:25:33', b'0', 12500234136, '2022-04-01 19:21:14', NULL, '2022-04-01 19:25:33');
INSERT INTO `app_cashier` VALUES (99778568011, '开通月卡会员', 38.00, NULL, NULL, b'0', NULL, b'0', 12500234136, '2022-04-01 19:09:21', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_cashout
-- ----------------------------
DROP TABLE IF EXISTS `app_cashout`;
CREATE TABLE `app_cashout` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户id',
  `amount` decimal(65,2) unsigned NOT NULL COMMENT '提现金额',
  `account` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收款账户',
  `account_type` tinyint(1) unsigned NOT NULL COMMENT '账户类型 1 支付宝 2 微信',
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收款人姓名',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '提现状态 1 申请中 2 已转账 3 提现失败',
  `remark` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='充值表';

-- ----------------------------
-- Records of app_cashout
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_code
-- ----------------------------
DROP TABLE IF EXISTS `app_code`;
CREATE TABLE `app_code` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'code Id',
  `code_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板Id',
  `receiver` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '接收者 手机号码或者邮箱等',
  `code` varchar(23) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '验证码',
  `content` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '短信内容',
  `send_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '发送类型 1 短信 2 邮件',
  `send_time` int(11) NOT NULL COMMENT '发送时间',
  `check_time` int(11) DEFAULT NULL COMMENT '效验时间',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `bind_id` (`receiver`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='验证码表';

-- ----------------------------
-- Records of app_code
-- ----------------------------
BEGIN;
INSERT INTO `app_code` VALUES (1020, 'login', '+8617730673882', '5530', 'SMS_236325159', 1, 1648617672, 1648617679, b'1', 8617730673882, '2022-03-30 13:21:12', 0, '2022-03-30 13:21:19');
INSERT INTO `app_code` VALUES (1021, 'login', '+8617730673882', '0197', 'SMS_236325159', 1, 1648657501, 1648657506, b'1', 8617730673882, '2022-03-31 00:25:01', 0, '2022-03-31 00:25:06');
COMMIT;

-- ----------------------------
-- Table structure for app_collection
-- ----------------------------
DROP TABLE IF EXISTS `app_collection`;
CREATE TABLE `app_collection` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏Id',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT '绑定id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '收藏类型（1课程，2题）',
  `add_time` datetime NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `indexId` (`bind_id`,`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=564 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='收藏表';

-- ----------------------------
-- Records of app_collection
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_course
-- ----------------------------
DROP TABLE IF EXISTS `app_course`;
CREATE TABLE `app_course` (
  `id` bigint(20) unsigned NOT NULL COMMENT '主键',
  `major_id` bigint(20) unsigned NOT NULL COMMENT '专业id',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `desc` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '课程介绍',
  `question_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '题库数量',
  `collection_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `tag` json DEFAULT NULL COMMENT 'tag',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1审核通过',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`major_id`) USING BTREE,
  CONSTRAINT `app_course_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `app_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='课程表';

-- ----------------------------
-- Records of app_course
-- ----------------------------
BEGIN;
INSERT INTO `app_course` VALUES (12819831237, 1000059, '理工数学', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:04', NULL, NULL);
INSERT INTO `app_course` VALUES (19850173132, 1000059, '理工英语', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:03', NULL, NULL);
INSERT INTO `app_course` VALUES (29167916857, 1000059, '工商管理入门到精通', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:02', NULL, NULL);
INSERT INTO `app_course` VALUES (30875878943, 1000059, '工商数学', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:03', NULL, NULL);
INSERT INTO `app_course` VALUES (54890476562, 1000059, 'C/C++入门到精通', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:12:44', NULL, NULL);
INSERT INTO `app_course` VALUES (64578588523, 1000059, 'PHP全栈开发', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:04', NULL, NULL);
INSERT INTO `app_course` VALUES (79489706965, 1000056, '工商专业英语', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:01', NULL, NULL);
INSERT INTO `app_course` VALUES (82627109269, 1000059, 'C/C++入门到精通', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:04', NULL, NULL);
INSERT INTO `app_course` VALUES (90576879196, 1000059, '工商商务英语', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:02', NULL, NULL);
INSERT INTO `app_course` VALUES (99376768289, 1000056, '工商管理入门到精通', NULL, 0, 0, NULL, 1, b'0', 0, '2022-04-02 22:17:00', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_feedback
-- ----------------------------
DROP TABLE IF EXISTS `app_feedback`;
CREATE TABLE `app_feedback` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '反馈Id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户id',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系方式',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1 反馈成功(等待处理) 2 已处理 ',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='反馈表';

-- ----------------------------
-- Records of app_feedback
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_file
-- ----------------------------
DROP TABLE IF EXISTS `app_file`;
CREATE TABLE `app_file` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(256) CHARACTER SET utf8mb4 NOT NULL COMMENT '文件名',
  `size` bigint(20) unsigned NOT NULL COMMENT '文件大小',
  `md5` varchar(32) CHARACTER SET utf8mb4 NOT NULL COMMENT '文件sha1效验值',
  `mime` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT '文件MIME',
  `path` varchar(1024) CHARACTER SET utf8mb4 NOT NULL COMMENT '文件路径',
  `options` json DEFAULT NULL COMMENT '文件可选信息',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `md5` (`md5`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1011 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文件表';

-- ----------------------------
-- Records of app_file
-- ----------------------------
BEGIN;
INSERT INTO `app_file` VALUES (1000, 'pic@2x.png', 587135, '3a0a6ea7926a7e99c11f50e5b7b5c4d3', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/3/A0/3A0A6EA7926A7E99C11F50E5B7B5C4D3', NULL, b'0', 0, '2022-03-29 00:39:00', NULL, NULL);
INSERT INTO `app_file` VALUES (1001, 'tmp_1e5dd019fa1bf87ed698748de4e6c386.jpg', 1009541, 'ec8ea13b756cd88fa136d0cd4223ac10', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/E/C8/EC8EA13B756CD88FA136D0CD4223AC10', NULL, b'0', 0, '2022-03-30 13:00:11', NULL, NULL);
INSERT INTO `app_file` VALUES (1002, 'tmp_2d0a04beccd875dfe0bcfda1a5499ad3.jpg', 313032, 'c73c53d72742b94f0620edca9dbcabe3', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/C/73/C73C53D72742B94F0620EDCA9DBCABE3', NULL, b'0', 0, '2022-04-01 20:45:52', NULL, NULL);
INSERT INTO `app_file` VALUES (1003, 'mo2VzVhQnby05e1fbae51a064221a5b1010db89ba072.jpg', 359342, 'ad8c1a373f9c47bab16f7161574cf52b', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/A/D8/AD8C1A373F9C47BAB16F7161574CF52B', NULL, b'0', 0, '2022-04-02 17:00:58', NULL, NULL);
INSERT INTO `app_file` VALUES (1004, 'F9EMYABzPfESa2db00eed9adae9868ff175edef5fed9.jpg', 34213, '97e91ab10326861c642a9c072f314ab5', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/9/7E/97E91AB10326861C642A9C072F314AB5', NULL, b'0', 0, '2022-04-02 17:08:21', NULL, NULL);
INSERT INTO `app_file` VALUES (1005, 'tmp_d75ee5bef4352f1282f842a1c97221f6.jpg', 618318, '637b97c690caae306bc8f64975f7e1b2', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/6/37/637B97C690CAAE306BC8F64975F7E1B2', NULL, b'0', 0, '2022-04-02 18:07:10', NULL, NULL);
INSERT INTO `app_file` VALUES (1006, 'tmp_f1bbcce9cba374df41f9545923c4a29e.jpg', 564158, '78f3de79a16c9249bbafd53b6f494e1a', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/7/8F/78F3DE79A16C9249BBAFD53B6F494E1A', NULL, b'0', 0, '2022-04-02 18:07:38', NULL, NULL);
INSERT INTO `app_file` VALUES (1007, 'tmp_ea1a1913b92c3992f721edcc3d6aa3db.jpg', 553412, 'a20431e8cf598ea8492a3dd2f6028549', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/A/20/A20431E8CF598EA8492A3DD2F6028549', NULL, b'0', 0, '2022-04-02 18:22:27', NULL, NULL);
INSERT INTO `app_file` VALUES (1008, 'tmp_d601a499f2c7e01ac0131afcda0e528d.jpg', 846557, '5efb810753c60110022ba078e313dd40', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/5/EF/5EFB810753C60110022BA078E313DD40', NULL, b'0', 0, '2022-04-02 18:22:44', NULL, NULL);
INSERT INTO `app_file` VALUES (1009, 'tmp_3035e6aff87f45ee1a32698b1e30c453.jpg', 546367, '869cc7283045b64fb06e0bf815b35504', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/8/69/869CC7283045B64FB06E0BF815B35504', NULL, b'0', 0, '2022-04-08 23:03:58', NULL, NULL);
INSERT INTO `app_file` VALUES (1010, 'tmp_d74c70c0c7dd4e8936fc1472a810287d.jpg', 589900, '7e899a008a094e17642e5e95b628c328', 'image/webp', '/www/wwwroot/jjc.jngkbm.com/data/7/E8/7E899A008A094E17642E5E95B628C328', NULL, b'0', 0, '2022-04-08 23:04:15', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_log
-- ----------------------------
DROP TABLE IF EXISTS `app_log`;
CREATE TABLE `app_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1 运行日志 2 错误日志 3 操作日志 10 其他日志 ',
  `bind_id` bigint(20) unsigned DEFAULT NULL COMMENT 'bind id',
  `msg` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '日志消息',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '数据',
  `add_time` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9720 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统日志表';

-- ----------------------------
-- Records of app_log
-- ----------------------------
BEGIN;
INSERT INTO `app_log` VALUES (9702, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[tlod3c0ejjggy4x4f8e7kq7iott3p31g]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[26494856162]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[398728699AB641DD7F40C3BE9AA8E989]]></sign>\n<time_end><![CDATA[20220401192416]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001363202204016752489487]]></transaction_id>\n</xml>', '2022-04-01 19:24:17');
INSERT INTO `app_log` VALUES (9703, 1, NULL, '26494856162----msg:success', '', '2022-04-01 19:24:17');
INSERT INTO `app_log` VALUES (9704, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[bxlfanmld59o6mlcmu0o6my4cgfdx36f]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[84356947678]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[49A7185CAAD23F83BC7E087F5391DFA5]]></sign>\n<time_end><![CDATA[20220401191040]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001361202204013454334809]]></transaction_id>\n</xml>', '2022-04-01 19:24:47');
INSERT INTO `app_log` VALUES (9705, 1, NULL, '84356947678----msg:success', '', '2022-04-01 19:24:47');
INSERT INTO `app_log` VALUES (9706, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[pkin0mcnfj5cp7yclj71u9cjbzpbjkr5]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[94443630124]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[2F779A09AD3AA4D9D05E1AB4E0BB9697]]></sign>\n<time_end><![CDATA[20220401192126]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001355202204011731797473]]></transaction_id>\n</xml>', '2022-04-01 19:25:33');
INSERT INTO `app_log` VALUES (9707, 1, NULL, '94443630124----msg:success', '', '2022-04-01 19:25:33');
INSERT INTO `app_log` VALUES (9708, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[26ekrf9glo2d7rpbp6bnh3atxd2w9b35]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[24342087162]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[4CEC7056836BFCCC53CE906268F828C6]]></sign>\n<time_end><![CDATA[20220401191551]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001353202204010822122498]]></transaction_id>\n</xml>', '2022-04-01 19:29:59');
INSERT INTO `app_log` VALUES (9709, 1, NULL, '24342087162----msg:success', '', '2022-04-01 19:30:00');
INSERT INTO `app_log` VALUES (9710, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[wbe42fdm04wzqvv66j22qhtj1vy3m559]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[90097717666]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[312BA91494D1EBB87481D931EC23D63D]]></sign>\n<time_end><![CDATA[20220401191703]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001380202204013181457620]]></transaction_id>\n</xml>', '2022-04-01 19:31:11');
INSERT INTO `app_log` VALUES (9711, 1, NULL, '90097717666----msg:success', '', '2022-04-01 19:31:11');
INSERT INTO `app_log` VALUES (9712, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[tcdvov28nyo28nfxkkpjo7ue1xp0lzws]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[60271064808]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[450FA94D0267349F7D7B8B67470E84FE]]></sign>\n<time_end><![CDATA[20220401201512]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001391202204015054849402]]></transaction_id>\n</xml>', '2022-04-01 20:15:12');
INSERT INTO `app_log` VALUES (9713, 1, NULL, '60271064808----msg:success', '', '2022-04-01 20:15:13');
INSERT INTO `app_log` VALUES (9714, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[6rv7zk4j6zzszpehj7sn4ccgwushss5a]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[71148317796]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[BB8922E842EF78FCF64333D2A6B172E6]]></sign>\n<time_end><![CDATA[20220401201931]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001357202204014726645390]]></transaction_id>\n</xml>', '2022-04-01 20:19:32');
INSERT INTO `app_log` VALUES (9715, 1, NULL, '71148317796----msg:success', '', '2022-04-01 20:19:32');
INSERT INTO `app_log` VALUES (9716, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[jfw476kguay39573dut2tlvgb1sly87n]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[18854724599]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[865B1F29D03AD4D06E1618C2653356B8]]></sign>\n<time_end><![CDATA[20220401202245]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001394202204013849578613]]></transaction_id>\n</xml>', '2022-04-01 20:22:45');
INSERT INTO `app_log` VALUES (9717, 1, NULL, '18854724599----msg:success', '', '2022-04-01 20:22:46');
INSERT INTO `app_log` VALUES (9718, 1, NULL, 'wechatNotify start', '<xml><appid><![CDATA[wx745960d30d048006]]></appid>\n<bank_type><![CDATA[CCB_DEBIT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[N]]></is_subscribe>\n<mch_id><![CDATA[1606625697]]></mch_id>\n<nonce_str><![CDATA[jc45gfnazjsi6qyozdhn02860yoia7zj]]></nonce_str>\n<openid><![CDATA[oashD5HvDXBphoDOD4F-3i48qWW8]]></openid>\n<out_trade_no><![CDATA[59890397494]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[8451383163E73A53BF33599895AB0682]]></sign>\n<time_end><![CDATA[20220401202301]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[JSAPI]]></trade_type>\n<transaction_id><![CDATA[4200001373202204017400473371]]></transaction_id>\n</xml>', '2022-04-01 20:23:02');
INSERT INTO `app_log` VALUES (9719, 1, NULL, '59890397494----msg:success', '', '2022-04-01 20:23:02');
COMMIT;

-- ----------------------------
-- Table structure for app_major
-- ----------------------------
DROP TABLE IF EXISTS `app_major`;
CREATE TABLE `app_major` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类Id',
  `parent_id` bigint(20) unsigned DEFAULT NULL COMMENT '父id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '专业名称',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '等级',
  `course_count` int(11) NOT NULL DEFAULT '0' COMMENT '课程数量',
  `question_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '题库数量',
  `options` json DEFAULT NULL COMMENT 'options',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1000068 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='专业表';

-- ----------------------------
-- Records of app_major
-- ----------------------------
BEGIN;
INSERT INTO `app_major` VALUES (1000000, NULL, '国家开放大学', 1, 10, 0, '[]', 0, 0, '2021-10-29 11:41:58', NULL, '2022-04-02 22:17:05');
INSERT INTO `app_major` VALUES (1000001, 1000000, '专科', 2, 2, 0, NULL, 0, 0, '2021-10-29 11:41:58', NULL, '2022-04-02 22:17:01');
INSERT INTO `app_major` VALUES (1000055, 1000001, '工商管理企业管理', 3, 2, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, '2022-04-02 22:17:01');
INSERT INTO `app_major` VALUES (1000056, 1000055, '形成性考核', 4, 2, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, '2022-04-02 22:17:01');
INSERT INTO `app_major` VALUES (1000057, 1000000, '本科', 2, 8, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, '2022-04-02 22:17:05');
INSERT INTO `app_major` VALUES (1000058, 1000057, '工商管理企业管理', 3, 8, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, '2022-04-02 22:17:05');
INSERT INTO `app_major` VALUES (1000059, 1000058, '形成性考核', 4, 8, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, '2022-04-02 22:17:05');
INSERT INTO `app_major` VALUES (1000060, NULL, '工程类', 1, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `app_major` VALUES (1000061, 1000060, '建造师', 2, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `app_major` VALUES (1000062, 1000061, '一级建造师', 3, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `app_major` VALUES (1000063, 1000062, '公共科目', 4, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `app_major` VALUES (1000064, 1000061, '二级建造师', 3, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `app_major` VALUES (1000065, 1000064, '公共科目', 4, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `app_major` VALUES (1000066, 1000062, '专业科目', 4, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `app_major` VALUES (1000067, 1000064, '专业科目', 4, 0, 0, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_member
-- ----------------------------
DROP TABLE IF EXISTS `app_member`;
CREATE TABLE `app_member` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志Id',
  `major_id` bigint(20) unsigned NOT NULL COMMENT '专业id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员名称',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `desc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '介绍',
  `amount` decimal(65,2) NOT NULL COMMENT '现价',
  `original_price` decimal(65,2) DEFAULT NULL COMMENT '原价',
  `valid_time` int(11) NOT NULL COMMENT '有效期（秒）',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `userId` (`major_id`) USING BTREE,
  KEY `name` (`name`),
  CONSTRAINT `app_member_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `app_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3809 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员收费表';

-- ----------------------------
-- Records of app_member
-- ----------------------------
BEGIN;
INSERT INTO `app_member` VALUES (3805, 1000000, '', '年卡会员', '最超值，约合13元/月', 0.01, 198.00, 31536000, b'0', 0, '2022-04-01 18:43:44', NULL, NULL);
INSERT INTO `app_member` VALUES (3806, 1000000, '', '月卡会员', '最超值，约合13元/月', 0.01, 58.00, 2592000, b'0', 0, '2022-04-01 18:43:44', NULL, NULL);
INSERT INTO `app_member` VALUES (3808, 1000060, '', '年卡会员', '最超值，约合13元/月', 0.01, 200.00, 31536000, b'0', 0, '2022-04-01 20:53:51', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_notice
-- ----------------------------
DROP TABLE IF EXISTS `app_notice`;
CREATE TABLE `app_notice` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `bind_id` bigint(20) DEFAULT NULL COMMENT 'bind id',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1 App首页展示通知',
  `content` longtext COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `options` json NOT NULL COMMENT '数据',
  `rank` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='banner表';

-- ----------------------------
-- Records of app_notice
-- ----------------------------
BEGIN;
INSERT INTO `app_notice` VALUES (1, '继教处小程序上线啦~~~', NULL, 1, NULL, 'null', 1, 0, 0, '2022-03-29 00:39:47', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_notify
-- ----------------------------
DROP TABLE IF EXISTS `app_notify`;
CREATE TABLE `app_notify` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `brief` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '内容简介',
  `content` longtext COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `event` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '事件 ',
  `from_id` bigint(20) NOT NULL COMMENT '来源id',
  `sender_type` tinyint(1) NOT NULL COMMENT '发送者类型 1系统 2 用户',
  `sender_id` bigint(20) DEFAULT NULL COMMENT '发送者 id',
  `receiver_id` bigint(20) NOT NULL COMMENT '接收者id',
  `options` json DEFAULT NULL COMMENT '附加数据',
  `notify_time` datetime NOT NULL COMMENT '通知时间',
  `is_read` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否已读',
  `last_rtime` datetime DEFAULT NULL COMMENT '最后读取时间，null 就没有读取',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `from_id` (`from_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `is_read` (`is_read`,`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='通知表';

-- ----------------------------
-- Records of app_notify
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_oauth2qq
-- ----------------------------
DROP TABLE IF EXISTS `app_oauth2qq`;
CREATE TABLE `app_oauth2qq` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT 'bindid',
  `union_id` varchar(28) NOT NULL COMMENT 'unionid',
  `open_id` varchar(28) NOT NULL COMMENT 'openid',
  `nickname` varchar(256) NOT NULL COMMENT 'QQ名',
  `headimgurl` varchar(1024) NOT NULL COMMENT 'QQ头像',
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别 1 男 2 女',
  `province` varchar(50) NOT NULL COMMENT '省',
  `city` varchar(50) NOT NULL COMMENT '城市',
  `year` int(4) DEFAULT NULL COMMENT '出生年',
  `vip_info` json DEFAULT NULL COMMENT '会员信息',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`bind_id`,`union_id`,`open_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Autho2 QQ';

-- ----------------------------
-- Records of app_oauth2qq
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_oauth2wechat
-- ----------------------------
DROP TABLE IF EXISTS `app_oauth2wechat`;
CREATE TABLE `app_oauth2wechat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT 'bind id',
  `union_id` varchar(28) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'unionid',
  `open_id` varchar(28) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'openid',
  `nickname` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '微信名',
  `headimgurl` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '微信头像',
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别 1 男 2 女',
  `language` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '语言',
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '国家',
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '省',
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '城市',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index` (`bind_id`,`union_id`,`open_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Autho2 wechat';

-- ----------------------------
-- Records of app_oauth2wechat
-- ----------------------------
BEGIN;
INSERT INTO `app_oauth2wechat` VALUES (3, 10001, '', 'oLk4V6rCS2MDZzRC4HGIfMmant30', '', '', 0, 'zh_CN', '', '', '', b'0', 52257553893, '2022-04-06 12:25:01', 10001, '2022-04-09 13:47:11');
INSERT INTO `app_oauth2wechat` VALUES (5, 92880526032, '', 'oLk4V6kkKMkPqlExzQYmu3MAa_qA', '', '', 0, 'zh_CN', '', '', '', b'0', 92880526032, '2022-04-08 22:26:00', 92880526032, '2022-04-09 12:18:48');
INSERT INTO `app_oauth2wechat` VALUES (6, 22465759696, '', 'oLk4V6vYXstKyIDvytx33YKyvwIc', '', '', 0, 'zh_CN', '', '', '', b'0', 22465759696, '2022-04-10 14:17:31', NULL, NULL);
INSERT INTO `app_oauth2wechat` VALUES (7, 58361205395, '', 'oLk4V6ggewC59wXKLKabIQkC73Ag', '', '', 0, 'zh_CN', '', '', '', b'0', 58361205395, '2022-04-10 14:20:54', NULL, NULL);
INSERT INTO `app_oauth2wechat` VALUES (8, 39963992720, '', 'oLk4V6jzPre0UKPQG1g4Zsgw0YRA', '', '', 0, 'zh_CN', '', '', '', b'0', 39963992720, '2022-04-10 14:22:56', NULL, NULL);
INSERT INTO `app_oauth2wechat` VALUES (9, 15952866061, '', 'oLk4V6pcipRCIIFxCLSg7pUxgrG8', '', '', 0, 'zh_CN', '', '', '', b'0', 15952866061, '2022-04-10 14:52:03', NULL, NULL);
INSERT INTO `app_oauth2wechat` VALUES (10, 32435498462, '', 'oLk4V6mA8WGFu0TRW2_uKcpO_7WY', '', '', 0, 'zh_CN', '', '', '', b'0', 32435498462, '2022-04-10 17:37:39', 32435498462, '2022-04-10 17:38:19');
INSERT INTO `app_oauth2wechat` VALUES (11, 19242849168, '', 'oLk4V6sTdF3_PM02V5gqpLEc5cPg', '', '', 0, 'zh_CN', '', '', '', b'0', 19242849168, '2022-04-10 18:28:44', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_point
-- ----------------------------
DROP TABLE IF EXISTS `app_point`;
CREATE TABLE `app_point` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT '绑定的用户Id或者其他标识符',
  `number` decimal(65,2) NOT NULL COMMENT '点数',
  `frozen` decimal(65,2) NOT NULL DEFAULT '0.00' COMMENT '冻结点数',
  `type` tinyint(1) unsigned NOT NULL COMMENT '类型 1钱包余额 2 积分 3 贡献值',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `bindId` (`bind_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='钱包或者其他积分点数表';

-- ----------------------------
-- Records of app_point
-- ----------------------------
BEGIN;
INSERT INTO `app_point` VALUES (254, 52126202929, 6.00, 0.00, 2, b'0', 52126202929, '2022-03-30 15:22:47', 52126202929, '2022-03-30 20:35:57');
INSERT INTO `app_point` VALUES (255, 12500234136, 2003.00, 0.00, 2, b'0', 12500234136, '2022-03-30 20:33:46', 12500234136, '2022-04-08 23:04:13');
INSERT INTO `app_point` VALUES (256, 78829214251, 2021.00, 0.00, 2, b'0', 78829214251, '2022-03-30 20:35:57', 78829214251, '2022-04-09 14:36:26');
COMMIT;

-- ----------------------------
-- Table structure for app_question
-- ----------------------------
DROP TABLE IF EXISTS `app_question`;
CREATE TABLE `app_question` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键 index 先小后大写入原则',
  `course_id` bigint(20) unsigned NOT NULL COMMENT '课程id',
  `type` tinyint(1) NOT NULL COMMENT '类型 1 判断题 2 选择题 3 问答题',
  `title` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `cover_fid` bigint(20) DEFAULT NULL COMMENT '封面文件id',
  `qa_answer` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '问答题答案',
  `tips` longtext COLLATE utf8mb4_unicode_ci COMMENT '解析',
  `collection_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`course_id`) USING BTREE,
  CONSTRAINT `app_question_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `app_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='题库表';

-- ----------------------------
-- Records of app_question
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_queue
-- ----------------------------
DROP TABLE IF EXISTS `app_queue`;
CREATE TABLE `app_queue` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '队列Id',
  `parent_id` bigint(20) unsigned DEFAULT NULL COMMENT '队列消息父Id',
  `bind_id` bigint(20) unsigned DEFAULT NULL COMMENT '跟队列所关联的主键Id，用于取消队列',
  `type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `param` json NOT NULL COMMENT '参数',
  `trigger_time` bigint(13) NOT NULL COMMENT '触发时间',
  `status` tinyint(1) NOT NULL COMMENT '状态 1 等待执行 2 正在执行任务 3 执行完毕 4 执行异常',
  `status_time` bigint(13) NOT NULL COMMENT '状态发生时间',
  `remark` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `bindId` (`bind_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21219 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='消息队列表';

-- ----------------------------
-- Records of app_queue
-- ----------------------------
BEGIN;
INSERT INTO `app_queue` VALUES (21188, NULL, 1835, 'INTEGRAL_CHANGE', '{\"DID\": \"1835\", \"IID\": 52126202929}', 1648628691000, 1, 1648628691385, '', b'0', 0, '2022-03-30 16:24:51', NULL, NULL);
INSERT INTO `app_queue` VALUES (21189, NULL, 1836, 'INTEGRAL_CHANGE', '{\"DID\": \"1836\", \"IID\": 12500234136}', 1648643626000, 1, 1648643626633, '', b'0', 0, '2022-03-30 20:33:46', NULL, NULL);
INSERT INTO `app_queue` VALUES (21190, NULL, 1837, 'INTEGRAL_CHANGE', '{\"DID\": \"1837\", \"IID\": 78829214251}', 1648643757000, 1, 1648643757329, '', b'0', 0, '2022-03-30 20:35:57', NULL, NULL);
INSERT INTO `app_queue` VALUES (21191, NULL, 1838, 'INTEGRAL_CHANGE', '{\"DID\": \"1838\", \"IID\": 52126202929}', 1648643757000, 1, 1648643757442, '', b'0', 0, '2022-03-30 20:35:57', NULL, NULL);
INSERT INTO `app_queue` VALUES (21192, NULL, 1839, 'INTEGRAL_CHANGE', '{\"DID\": \"1839\", \"IID\": 12500234136}', 1648646469000, 1, 1648646469071, '', b'0', 0, '2022-03-30 21:21:09', NULL, NULL);
INSERT INTO `app_queue` VALUES (21193, NULL, 1840, 'INTEGRAL_CHANGE', '{\"DID\": \"1840\", \"IID\": 78829214251}', 1648647819000, 1, 1648647819702, '', b'0', 0, '2022-03-30 21:43:39', NULL, NULL);
INSERT INTO `app_queue` VALUES (21194, NULL, 1841, 'INTEGRAL_CHANGE', '{\"DID\": \"1841\", \"IID\": 78829214251}', 1648660429000, 1, 1648660429107, '', b'0', 0, '2022-03-31 01:13:49', NULL, NULL);
INSERT INTO `app_queue` VALUES (21195, NULL, 1842, 'INTEGRAL_CHANGE', '{\"DID\": \"1842\", \"IID\": 12500234136}', 1648672407000, 1, 1648672407744, '', b'0', 0, '2022-03-31 04:33:27', NULL, NULL);
INSERT INTO `app_queue` VALUES (21196, NULL, 1843, 'INTEGRAL_CHANGE', '{\"DID\": \"1843\", \"IID\": 12500234136}', 1648822958000, 1, 1648822958798, '', b'0', 0, '2022-04-01 22:22:38', NULL, NULL);
INSERT INTO `app_queue` VALUES (21197, NULL, 1844, 'INTEGRAL_CHANGE', '{\"DID\": \"1844\", \"IID\": 12500234136}', 1648892396000, 1, 1648892396314, '', b'0', 0, '2022-04-02 17:39:56', NULL, NULL);
INSERT INTO `app_queue` VALUES (21198, NULL, 1845, 'INTEGRAL_CHANGE', '{\"DID\": \"1845\", \"IID\": 12500234136}', 1648892613000, 1, 1648892613789, '', b'0', 0, '2022-04-02 17:43:33', NULL, NULL);
INSERT INTO `app_queue` VALUES (21199, NULL, 1846, 'INTEGRAL_CHANGE', '{\"DID\": \"1846\", \"IID\": 12500234136}', 1648892791000, 1, 1648892791065, '', b'0', 0, '2022-04-02 17:46:31', NULL, NULL);
INSERT INTO `app_queue` VALUES (21200, NULL, 1847, 'INTEGRAL_CHANGE', '{\"DID\": \"1847\", \"IID\": 12500234136}', 1648892855000, 1, 1648892855878, '', b'0', 0, '2022-04-02 17:47:35', NULL, NULL);
INSERT INTO `app_queue` VALUES (21201, NULL, 1848, 'INTEGRAL_CHANGE', '{\"DID\": \"1848\", \"IID\": 12500234136}', 1648893969000, 1, 1648893969074, '', b'0', 0, '2022-04-02 18:06:09', NULL, NULL);
INSERT INTO `app_queue` VALUES (21202, NULL, 1849, 'INTEGRAL_CHANGE', '{\"DID\": \"1849\", \"IID\": 12500234136}', 1648894029000, 1, 1648894029112, '', b'0', 0, '2022-04-02 18:07:09', NULL, NULL);
INSERT INTO `app_queue` VALUES (21203, NULL, 1850, 'INTEGRAL_CHANGE', '{\"DID\": \"1850\", \"IID\": 12500234136}', 1648894045000, 1, 1648894045375, '', b'0', 0, '2022-04-02 18:07:25', NULL, NULL);
INSERT INTO `app_queue` VALUES (21204, NULL, 1851, 'INTEGRAL_CHANGE', '{\"DID\": \"1851\", \"IID\": 12500234136}', 1648894056000, 1, 1648894056702, '', b'0', 0, '2022-04-02 18:07:36', NULL, NULL);
INSERT INTO `app_queue` VALUES (21205, NULL, 1852, 'INTEGRAL_CHANGE', '{\"DID\": \"1852\", \"IID\": 12500234136}', 1648894092000, 1, 1648894092014, '', b'0', 0, '2022-04-02 18:08:12', NULL, NULL);
INSERT INTO `app_queue` VALUES (21206, NULL, 1853, 'INTEGRAL_CHANGE', '{\"DID\": \"1853\", \"IID\": 12500234136}', 1648894946000, 1, 1648894946032, '', b'0', 0, '2022-04-02 18:22:26', NULL, NULL);
INSERT INTO `app_queue` VALUES (21207, NULL, 1854, 'INTEGRAL_CHANGE', '{\"DID\": \"1854\", \"IID\": 12500234136}', 1648894963000, 1, 1648894963361, '', b'0', 0, '2022-04-02 18:22:43', NULL, NULL);
INSERT INTO `app_queue` VALUES (21208, NULL, 1855, 'INTEGRAL_CHANGE', '{\"DID\": \"1855\", \"IID\": 12500234136}', 1648894990000, 1, 1648894990791, '', b'0', 0, '2022-04-02 18:23:10', NULL, NULL);
INSERT INTO `app_queue` VALUES (21209, NULL, 1856, 'INTEGRAL_CHANGE', '{\"DID\": \"1856\", \"IID\": 78829214251}', 1648896069000, 1, 1648896069664, '', b'0', 0, '2022-04-02 18:41:09', NULL, NULL);
INSERT INTO `app_queue` VALUES (21210, NULL, 1857, 'INTEGRAL_CHANGE', '{\"DID\": \"1857\", \"IID\": 78829214251}', 1648896091000, 1, 1648896091212, '', b'0', 0, '2022-04-02 18:41:31', NULL, NULL);
INSERT INTO `app_queue` VALUES (21211, NULL, 1858, 'INTEGRAL_CHANGE', '{\"DID\": \"1858\", \"IID\": 78829214251}', 1648896447000, 1, 1648896447357, '', b'0', 0, '2022-04-02 18:47:27', NULL, NULL);
INSERT INTO `app_queue` VALUES (21212, NULL, 1859, 'INTEGRAL_CHANGE', '{\"DID\": \"1859\", \"IID\": 78829214251}', 1648904183000, 1, 1648904183813, '', b'0', 0, '2022-04-02 20:56:23', NULL, NULL);
INSERT INTO `app_queue` VALUES (21213, NULL, 1860, 'INTEGRAL_CHANGE', '{\"DID\": \"1860\", \"IID\": 78829214251}', 1648999525000, 1, 1648999525466, '', b'0', 0, '2022-04-03 23:25:25', NULL, NULL);
INSERT INTO `app_queue` VALUES (21214, NULL, 1861, 'INTEGRAL_CHANGE', '{\"DID\": \"1861\", \"IID\": 78829214251}', 1649036006000, 1, 1649036006058, '', b'0', 0, '2022-04-04 09:33:26', NULL, NULL);
INSERT INTO `app_queue` VALUES (21215, NULL, 1862, 'INTEGRAL_CHANGE', '{\"DID\": \"1862\", \"IID\": 12500234136}', 1649409477000, 1, 1649409477739, '', b'0', 0, '2022-04-08 17:17:57', NULL, NULL);
INSERT INTO `app_queue` VALUES (21216, NULL, 1863, 'INTEGRAL_CHANGE', '{\"DID\": \"1863\", \"IID\": 12500234136}', 1649430237000, 1, 1649430237138, '', b'0', 0, '2022-04-08 23:03:57', NULL, NULL);
INSERT INTO `app_queue` VALUES (21217, NULL, 1864, 'INTEGRAL_CHANGE', '{\"DID\": \"1864\", \"IID\": 12500234136}', 1649430253000, 1, 1649430253898, '', b'0', 0, '2022-04-08 23:04:13', NULL, NULL);
INSERT INTO `app_queue` VALUES (21218, NULL, 1865, 'INTEGRAL_CHANGE', '{\"DID\": \"1865\", \"IID\": 78829214251}', 1649486186000, 1, 1649486186342, '', b'0', 0, '2022-04-09 14:36:26', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_recharge
-- ----------------------------
DROP TABLE IF EXISTS `app_recharge`;
CREATE TABLE `app_recharge` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `bind_id` bigint(20) NOT NULL COMMENT 'bind id',
  `amount` decimal(65,2) NOT NULL COMMENT '金额',
  `type` tinyint(1) unsigned NOT NULL COMMENT '充值类型 1 余额 2 积分 3 贡献值',
  `cashier_id` bigint(20) DEFAULT NULL COMMENT '收银id',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='充值表';

-- ----------------------------
-- Records of app_recharge
-- ----------------------------
BEGIN;
INSERT INTO `app_recharge` VALUES (302, 52126202929, 100.00, 2, NULL, 0, 0, '2022-03-30 15:23:34', NULL, NULL);
INSERT INTO `app_recharge` VALUES (303, 78829214251, 100.00, 2, NULL, 0, 0, '2022-03-31 01:15:43', NULL, NULL);
INSERT INTO `app_recharge` VALUES (304, 12500234136, 1000.00, 2, NULL, 0, 0, '2022-04-08 23:05:06', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_report
-- ----------------------------
DROP TABLE IF EXISTS `app_report`;
CREATE TABLE `app_report` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '举报Id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户id',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT 'bind id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '举报类型 title',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系方式',
  `status` tinyint(1) NOT NULL COMMENT '状态 1 举报成功(待处理) 2 已处理 ',
  `type` tinyint(1) NOT NULL COMMENT '举报的类型 1信息 2用户',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='举报表';

-- ----------------------------
-- Records of app_report
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_resource
-- ----------------------------
DROP TABLE IF EXISTS `app_resource`;
CREATE TABLE `app_resource` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `owner_id` bigint(20) unsigned NOT NULL COMMENT '主人 id',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT '绑定id',
  `bind_type` tinyint(1) NOT NULL COMMENT '绑定的类型 1 信息 2浏览照片',
  `file_id` bigint(20) unsigned NOT NULL COMMENT '文件id',
  `file_type` tinyint(1) NOT NULL COMMENT '文件类型 1 图片 2 视频',
  `options` json DEFAULT NULL COMMENT '其他信息，比如视频的 时长 封面等',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `owner_id` (`owner_id`),
  KEY `bind_id` (`bind_id`),
  KEY `bind_id_2` (`bind_id`,`bind_type`)
) ENGINE=InnoDB AUTO_INCREMENT=90621020513 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='资源表';

-- ----------------------------
-- Records of app_resource
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for app_setting
-- ----------------------------
DROP TABLE IF EXISTS `app_setting`;
CREATE TABLE `app_setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `attribute` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '属性',
  `content` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `remarks` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `is_delete` bit(1) NOT NULL COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2063 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统设置表';

-- ----------------------------
-- Records of app_setting
-- ----------------------------
BEGIN;
INSERT INTO `app_setting` VALUES (1, 'FILE', 'STORAGE_PATH', '${PATH_ROOT}data/{substr($0,0,1)}/{substr($0,1,2)}/{$0}', '文件存储路径', b'0', 0, '2021-02-08 13:02:39', 10001, '2021-11-09 10:25:16');
INSERT INTO `app_setting` VALUES (10, 'OSS', 'STORAGE_PATH', '{substr($0,0,1)}/{substr($0,1,2)}/{$0}', 'OSS 存储路径', b'0', 0, '2021-07-21 21:30:10', NULL, NULL);
INSERT INTO `app_setting` VALUES (1011, 'INTEGRAL_RULE', 'REGISTER', '2000', '注册赠送的积分', b'0', 0, '2021-10-06 00:28:14', 10001, '2021-12-30 16:31:15');
INSERT INTO `app_setting` VALUES (1012, 'INTEGRAL_RULE', 'SIGN', '5', '签到赠送的积分', b'0', 0, '2021-10-06 00:28:16', NULL, NULL);
INSERT INTO `app_setting` VALUES (1013, 'INTEGRAL_RULE', 'INVITE_REGISTER', '1', '邀请注册赠送的积分', b'0', 0, '2021-10-06 00:28:18', 10001, '2021-11-12 15:35:24');
INSERT INTO `app_setting` VALUES (2055, 'REPORT', 'TODAY_COUNT', '2', '每个用户每天举报多少次', b'0', 10001, '2022-01-10 14:36:37', NULL, NULL);
INSERT INTO `app_setting` VALUES (2060, 'INTEGRAL_RULE', 'SEARCH_IMAGE', '-2', '图片搜索扣除的积分', b'0', 10001, '2022-04-02 17:42:49', NULL, NULL);
INSERT INTO `app_setting` VALUES (2061, 'INTEGRAL_RULE', 'SEARCH_SPEECH', '-3', '语音搜索扣除的积分', b'0', 10001, '2022-04-02 17:43:08', 10001, '2022-04-02 17:48:30');
INSERT INTO `app_setting` VALUES (2062, 'INTEGRAL_RULE', 'BRUSH_QUESTION', '-1', '不是会员刷题扣除的积分', b'0', 10001, '2022-04-02 17:49:22', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_sign
-- ----------------------------
DROP TABLE IF EXISTS `app_sign`;
CREATE TABLE `app_sign` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `ymd` date NOT NULL COMMENT '签到日期',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `bindId` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='签到表';

-- ----------------------------
-- Records of app_sign
-- ----------------------------
BEGIN;
INSERT INTO `app_sign` VALUES (3, 52126202929, '2022-03-30', b'0', 52126202929, '2022-03-30 16:24:51', NULL, NULL);
INSERT INTO `app_sign` VALUES (4, 12500234136, '2022-03-30', b'0', 12500234136, '2022-03-30 21:21:08', NULL, NULL);
INSERT INTO `app_sign` VALUES (5, 78829214251, '2022-03-30', b'0', 78829214251, '2022-03-30 21:43:39', NULL, NULL);
INSERT INTO `app_sign` VALUES (6, 78829214251, '2022-03-31', b'0', 78829214251, '2022-03-31 01:13:48', NULL, NULL);
INSERT INTO `app_sign` VALUES (7, 12500234136, '2022-03-31', b'0', 12500234136, '2022-03-31 04:33:27', NULL, NULL);
INSERT INTO `app_sign` VALUES (8, 12500234136, '2022-04-01', b'0', 12500234136, '2022-04-01 22:22:38', NULL, NULL);
INSERT INTO `app_sign` VALUES (9, 12500234136, '2022-04-02', b'0', 12500234136, '2022-04-02 18:08:11', NULL, NULL);
INSERT INTO `app_sign` VALUES (10, 78829214251, '2022-04-02', b'0', 78829214251, '2022-04-02 18:47:27', NULL, NULL);
INSERT INTO `app_sign` VALUES (11, 78829214251, '2022-04-03', b'0', 78829214251, '2022-04-03 23:25:25', NULL, NULL);
INSERT INTO `app_sign` VALUES (12, 78829214251, '2022-04-04', b'0', 78829214251, '2022-04-04 09:33:25', NULL, NULL);
INSERT INTO `app_sign` VALUES (13, 12500234136, '2022-04-08', b'0', 12500234136, '2022-04-08 17:17:57', NULL, NULL);
INSERT INTO `app_sign` VALUES (14, 78829214251, '2022-04-09', b'0', 78829214251, '2022-04-09 14:36:26', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_token
-- ----------------------------
DROP TABLE IF EXISTS `app_token`;
CREATE TABLE `app_token` (
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'token',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT '绑定的Id可以是用户Id，或其他',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'token类型1用户0后台',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`token`) USING BTREE,
  KEY `bindId` (`bind_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Token存储表';

-- ----------------------------
-- Records of app_token
-- ----------------------------
BEGIN;
INSERT INTO `app_token` VALUES ('08a8181d70d73fc15bffa56573be8d3d', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 17:02:46', 12500234136, '2022-04-01 17:53:26');
INSERT INTO `app_token` VALUES ('0aead3d04cdb16ff24d9c80f8381fb7a', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 19:21:09', 12500234136, '2022-04-01 20:14:54');
INSERT INTO `app_token` VALUES ('0d6cac7f1f3ced45d5fdae2cd2dc9cc4', 52126202929, 'CODE', b'1', 52126202929, '2022-03-29 23:40:44', 52126202929, '2022-03-29 23:45:07');
INSERT INTO `app_token` VALUES ('125a8739f7c4cfc1b8955036f8d7c134', 78829214251, 'CODE', b'1', 78829214251, '2022-03-30 22:37:19', 78829214251, '2022-03-30 22:50:43');
INSERT INTO `app_token` VALUES ('16bb2773d0686a4867e484db59370225', 77262252793, 'CODE', b'0', 77262252793, '2022-03-30 01:06:01', NULL, NULL);
INSERT INTO `app_token` VALUES ('1ead82e27964c71b193cb51a31582f6f', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 00:46:38', 52126202929, '2022-03-30 00:46:56');
INSERT INTO `app_token` VALUES ('21f4bfc1e4427954d82edab24b3c8df3', 12500234136, 'CODE', b'1', 12500234136, '2022-04-02 18:06:33', 12500234136, '2022-04-02 20:46:42');
INSERT INTO `app_token` VALUES ('223b3587cfe295a76c8026be2f4bbc6d', 51672363106, 'CODE', b'1', 51672363106, '2022-03-30 19:58:58', 51672363106, '2022-03-30 19:59:05');
INSERT INTO `app_token` VALUES ('22d480bbf098a0fe5584b905c541358a', 52126202929, 'CODE', b'1', 52126202929, '2022-03-29 13:06:38', 52126202929, '2022-03-29 14:32:36');
INSERT INTO `app_token` VALUES ('237e5a0c6d16efec2aa8393aa5705c83', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 00:49:26', 52126202929, '2022-03-30 00:57:10');
INSERT INTO `app_token` VALUES ('24791feb78d4abd734cc38bac9229f93', 51672363106, 'CODE', b'1', 51672363106, '2022-03-30 17:10:13', 51672363106, '2022-03-30 19:58:58');
INSERT INTO `app_token` VALUES ('2cad49d4f9917fec50b8abd68b2fc11e', 51672363106, 'CODE', b'1', 51672363106, '2022-03-30 08:53:24', 51672363106, '2022-03-30 16:32:20');
INSERT INTO `app_token` VALUES ('3690063d4a200ed27c14a389f40573f3', 78829214251, 'CODE', b'1', 78829214251, '2022-04-01 20:24:16', 78829214251, '2022-04-01 21:49:09');
INSERT INTO `app_token` VALUES ('38672d626193dfc13b5b9366e652b385', 78829214251, 'CODE', b'1', 78829214251, '2022-03-30 22:50:43', 78829214251, '2022-04-01 19:03:44');
INSERT INTO `app_token` VALUES ('4310fa1e3d5347d00ba533a3a75e9316', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 18:10:50', 12500234136, '2022-04-01 19:21:09');
INSERT INTO `app_token` VALUES ('498c4b2ab040491510edff91eac6f9e7', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 16:51:25', 12500234136, '2022-04-01 16:57:57');
INSERT INTO `app_token` VALUES ('5237aa7ac0d14b5d92b3b4707fd89a8e', 78829214251, 'CODE', b'1', 78829214251, '2022-04-01 20:24:11', 78829214251, '2022-04-01 20:24:16');
INSERT INTO `app_token` VALUES ('525b0bced87b7b2967bb402a4550cc56', 51672363106, 'CODE', b'1', 51672363106, '2022-03-30 16:36:17', 51672363106, '2022-03-30 16:36:26');
INSERT INTO `app_token` VALUES ('52cf7d620fac1698ab444d7f6087deb9', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 18:10:05', 12500234136, '2022-04-01 18:10:50');
INSERT INTO `app_token` VALUES ('557fc2cb820034b7c449bb2fbd784825', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 16:07:04', 52126202929, '2022-03-30 16:24:32');
INSERT INTO `app_token` VALUES ('5c7ff2508635c178d4e10d56caa8a9e8', 78829214251, 'CODE', b'1', 78829214251, '2022-03-30 20:35:57', 78829214251, '2022-03-30 21:22:37');
INSERT INTO `app_token` VALUES ('5d65de2753f497e0d0a2c665044a150b', 12500234136, 'CODE', b'0', 12500234136, '2022-04-02 23:12:50', NULL, NULL);
INSERT INTO `app_token` VALUES ('603c612f26e7d86bbc87198fbc83582c', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 17:53:26', 12500234136, '2022-04-01 18:05:21');
INSERT INTO `app_token` VALUES ('6eb1059a6e8e320fde8d40154d1c3ec1', 52126202929, 'CODE', b'0', 52126202929, '2022-03-30 20:31:52', NULL, NULL);
INSERT INTO `app_token` VALUES ('7ae4f93e48a88a2538d14a62bd270cf1', 12500234136, 'CODE', b'1', 12500234136, '2022-03-30 20:33:46', 12500234136, '2022-03-31 00:25:06');
INSERT INTO `app_token` VALUES ('80396f6424bdeabfc3f79c81e744cfae', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 21:29:04', 12500234136, '2022-04-01 22:22:04');
INSERT INTO `app_token` VALUES ('80ba2683af6231afeb436074092f45e8', 51672363106, 'CODE', b'1', 51672363106, '2022-03-30 16:32:25', 51672363106, '2022-03-30 16:36:17');
INSERT INTO `app_token` VALUES ('83011c0e9f8d3896e9d69ea6d57830d4', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 16:24:32', 52126202929, '2022-03-30 20:31:52');
INSERT INTO `app_token` VALUES ('864be3a97ead1d3d8f4240f0b4b087bf', 78829214251, 'CODE', b'1', 78829214251, '2022-04-01 20:24:04', 78829214251, '2022-04-01 20:24:11');
INSERT INTO `app_token` VALUES ('90e78d5b7b1144358d6add6c41c57797', 52126202929, 'CODE', b'1', 52126202929, '2022-03-29 14:32:36', 52126202929, '2022-03-29 23:40:44');
INSERT INTO `app_token` VALUES ('9afa2752bd0adfa5d1ef348579ee7aae', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 22:22:04', 12500234136, '2022-04-02 17:39:07');
INSERT INTO `app_token` VALUES ('9c87c4ba2e2eb953ed9bf50c38f4273d', 51672363106, 'CODE', b'0', 51672363106, '2022-03-30 19:59:05', NULL, NULL);
INSERT INTO `app_token` VALUES ('a7c85e4911c0c3830ba90f4af2583ac4', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 00:08:15', 52126202929, '2022-03-30 00:46:38');
INSERT INTO `app_token` VALUES ('bd179dd04de9af650a2fd034525f037e', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 16:57:57', 12500234136, '2022-04-01 17:02:46');
INSERT INTO `app_token` VALUES ('c163fa9c343c0b751b065ee0dcfcce5e', 78829214251, 'CODE', b'1', 78829214251, '2022-03-30 21:22:37', 78829214251, '2022-03-30 22:37:19');
INSERT INTO `app_token` VALUES ('c4281887243cb6d5f38e5696dfe8c2eb', 12500234136, 'CODE', b'1', 12500234136, '2022-04-02 17:39:07', 12500234136, '2022-04-02 17:46:09');
INSERT INTO `app_token` VALUES ('c568d0e20344dd0c3b5847e361e3adb9', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 20:55:22', 12500234136, '2022-04-01 20:56:31');
INSERT INTO `app_token` VALUES ('c694f32a9374c5de0c89f87c97660464', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 20:14:54', 12500234136, '2022-04-01 20:55:22');
INSERT INTO `app_token` VALUES ('c8d73b47403d141f126568a35358a2ce', 12500234136, 'CODE', b'1', 12500234136, '2022-04-02 20:46:42', 12500234136, '2022-04-02 23:12:50');
INSERT INTO `app_token` VALUES ('cd78c3c2b59b412e599b3a128b715bc8', 51672363106, 'CODE', b'1', 51672363106, '2022-03-30 16:36:26', 51672363106, '2022-03-30 17:10:13');
INSERT INTO `app_token` VALUES ('d6d784cab179f2825e5d125a3f8310bf', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 13:21:19', 52126202929, '2022-03-30 16:07:04');
INSERT INTO `app_token` VALUES ('d78705b28041fca2d25fe66843d8f71a', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 18:05:21', 12500234136, '2022-04-01 18:10:05');
INSERT INTO `app_token` VALUES ('da1f7d3c82204fdd76763af0468f6b63', 12500234136, 'CODE', b'1', 12500234136, '2022-04-02 17:46:09', 12500234136, '2022-04-02 18:05:29');
INSERT INTO `app_token` VALUES ('dc1e930c8d9fed08c519d884372c68ec', 12500234136, 'CODE', b'1', 12500234136, '2022-04-01 20:56:31', 12500234136, '2022-04-01 21:29:04');
INSERT INTO `app_token` VALUES ('de8444830ed550768540323c91a8ab65', 12500234136, 'CODE', b'1', 12500234136, '2022-03-31 04:33:03', 12500234136, '2022-04-01 16:51:25');
INSERT INTO `app_token` VALUES ('f25ba03c94cf998fe0851bdf8693177d', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 00:46:56', 52126202929, '2022-03-30 00:49:26');
INSERT INTO `app_token` VALUES ('f270bce4494e2622ac690af4f69fed11', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 00:57:10', 52126202929, '2022-03-30 11:57:20');
INSERT INTO `app_token` VALUES ('f469d5cb5686425068c462b74e2078f5', 52126202929, 'CODE', b'1', 52126202929, '2022-03-30 11:57:20', 52126202929, '2022-03-30 13:21:19');
INSERT INTO `app_token` VALUES ('f4af55ebb9cf8eaee7159b0aeb3ee143', 51672363106, 'CODE', b'1', 51672363106, '2022-03-30 16:32:20', 51672363106, '2022-03-30 16:32:24');
INSERT INTO `app_token` VALUES ('f7337b9413b6fa5baf4010fa067790ee', 12500234136, 'CODE', b'1', 12500234136, '2022-04-02 18:05:29', 12500234136, '2022-04-02 18:06:33');
INSERT INTO `app_token` VALUES ('f8b8cb2c0f039fea028507e0d9c64d36', 78829214251, 'CODE', b'1', 78829214251, '2022-04-01 19:03:44', 78829214251, '2022-04-01 20:24:04');
INSERT INTO `app_token` VALUES ('f9873f8edd270ce559e105d01439eb24', 12500234136, 'CODE', b'1', 12500234136, '2022-03-31 00:25:06', 12500234136, '2022-03-31 04:33:03');
INSERT INTO `app_token` VALUES ('fb122266c3e2678c1026c79ec0d4b214', 78829214251, 'CODE', b'0', 78829214251, '2022-04-01 21:49:09', NULL, NULL);
INSERT INTO `app_token` VALUES ('fe75237eb8855a84deceafbe81dbb0bc', 52126202929, 'CODE', b'1', 52126202929, '2022-03-29 23:45:07', 52126202929, '2022-03-30 00:08:15');
INSERT INTO `app_token` VALUES ('ff738784ce48942732ab45f0b7ca6278', 10001, 'ADMIN_ACCO', b'0', 10001, '2022-03-30 01:01:01', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for app_user
-- ----------------------------
DROP TABLE IF EXISTS `app_user`;
CREATE TABLE `app_user` (
  `id` bigint(20) unsigned NOT NULL COMMENT '主键',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名称（刚注册需要自动生成）',
  `nickname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `telephone` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '区号+手机号',
  `password` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `explain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '签名',
  `head_fid` bigint(11) unsigned DEFAULT NULL COMMENT '头像文件Id',
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别 1男人 2 女人',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `register_ip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '注册Ip',
  `source` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '来源',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '当前状态 1 正常 2 申请注销中 3 已注销',
  `follower_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝数量',
  `following_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '关注数量',
  `recommend_uid` bigint(20) unsigned DEFAULT NULL COMMENT '推荐人id',
  `top_mid` bigint(20) unsigned DEFAULT NULL COMMENT 'top 专业id',
  `major_id` bigint(20) unsigned DEFAULT NULL COMMENT '专业id',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`),
  KEY `telephone` (`telephone`) USING BTREE,
  KEY `recommend_uid` (`recommend_uid`),
  KEY `top_mid` (`top_mid`),
  KEY `major_id` (`major_id`),
  FULLTEXT KEY `nickname` (`nickname`),
  CONSTRAINT `app_user_ibfk_1` FOREIGN KEY (`top_mid`) REFERENCES `app_major` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `app_user_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `app_major` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of app_user
-- ----------------------------
BEGIN;
INSERT INTO `app_user` VALUES (12500234136, 'qsQuZ1TnVb', 'Renew', '+8617730673882', NULL, '', 1002, 1, '2022-03-30', '36.43.127.111', '1', 1, 0, 0, NULL, 1000000, 1000059, b'0', 0, '2022-03-30 20:33:46', NULL, '2022-04-08 23:05:46');
INSERT INTO `app_user` VALUES (78829214251, 'Nffw15QOPa', '', '+8618986833555', NULL, '', NULL, 1, '2022-03-30', '111.183.4.213', '1', 1, 0, 0, 52126202929, 1000000, 1000056, b'0', 0, '2022-03-30 20:35:57', NULL, '2022-04-10 21:54:31');
COMMIT;

-- ----------------------------
-- Table structure for cashier_bind
-- ----------------------------
DROP TABLE IF EXISTS `cashier_bind`;
CREATE TABLE `cashier_bind` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `cashier_id` bigint(20) NOT NULL COMMENT '收银id',
  `bind_id` bigint(20) NOT NULL COMMENT '绑定id',
  `bind_type` tinyint(1) unsigned NOT NULL COMMENT '绑定类型 1 充值',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=575 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='收银关绑定表';

-- ----------------------------
-- Records of cashier_bind
-- ----------------------------
BEGIN;
INSERT INTO `cashier_bind` VALUES (551, 20203418045, 298, 1, b'0', 0, '2022-03-29 22:32:34', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (552, 77956400846, 299, 1, b'0', 0, '2022-03-30 13:01:10', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (553, 88174843395, 300, 1, b'0', 0, '2022-03-30 13:08:33', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (554, 17662843495, 301, 1, b'0', 0, '2022-03-30 13:08:37', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (555, 84598151321, 302, 1, b'0', 0, '2022-03-30 15:23:34', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (556, 53811040250, 303, 1, b'0', 0, '2022-03-31 01:15:43', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (558, 28388200319, 17181901291, 2, b'0', 0, '2022-04-01 19:07:11', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (559, 60772857955, 70925559675, 2, b'0', 0, '2022-04-01 19:09:02', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (560, 99778568011, 78916043501, 2, b'0', 0, '2022-04-01 19:09:21', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (561, 16727294580, 66741597572, 2, b'0', 0, '2022-04-01 19:09:42', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (562, 84356947678, 99342605045, 2, b'0', 0, '2022-04-01 19:10:25', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (563, 24342087162, 83412489901, 2, b'0', 0, '2022-04-01 19:15:41', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (564, 71060312948, 72920445264, 2, b'0', 0, '2022-04-01 19:16:27', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (565, 90097717666, 54103312298, 2, b'0', 0, '2022-04-01 19:16:55', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (566, 26203917387, 73273883536, 2, b'0', 0, '2022-04-01 19:17:41', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (567, 94443630124, 68913163023, 2, b'0', 0, '2022-04-01 19:21:14', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (568, 26494856162, 31359038888, 2, b'0', 0, '2022-04-01 19:24:10', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (569, 60271064808, 21957356359, 2, b'0', 0, '2022-04-01 20:15:06', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (570, 71148317796, 82792851692, 2, b'0', 0, '2022-04-01 20:19:26', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (571, 18854724599, 97222616468, 2, b'0', 0, '2022-04-01 20:22:39', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (572, 59890397494, 91416922871, 2, b'0', 0, '2022-04-01 20:22:56', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (573, 14080471046, 23646770371, 2, b'0', 0, '2022-04-01 22:58:41', NULL, NULL);
INSERT INTO `cashier_bind` VALUES (574, 36145517492, 304, 1, b'0', 0, '2022-04-08 23:05:06', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for cashier_pay
-- ----------------------------
DROP TABLE IF EXISTS `cashier_pay`;
CREATE TABLE `cashier_pay` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `cashier_id` bigint(20) unsigned NOT NULL COMMENT '收银id',
  `payee` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收款人',
  `payer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '付款人',
  `date` datetime NOT NULL COMMENT '付款时间',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付状态',
  `total_amount` decimal(65,2) unsigned NOT NULL COMMENT '总金额',
  `payment_amount` decimal(65,2) unsigned NOT NULL COMMENT '实际付款金额',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='收银实际付款表';

-- ----------------------------
-- Records of cashier_pay
-- ----------------------------
BEGIN;
INSERT INTO `cashier_pay` VALUES (237, 26494856162, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 19:24:16', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 19:24:17', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (238, 84356947678, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 19:10:40', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 19:24:47', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (239, 94443630124, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 19:21:26', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 19:25:33', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (240, 24342087162, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 19:15:51', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 19:29:59', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (241, 90097717666, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 19:17:03', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 19:31:11', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (242, 60271064808, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 20:15:12', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 20:15:13', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (243, 71148317796, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 20:19:31', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 20:19:32', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (244, 18854724599, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 20:22:45', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 20:22:45', NULL, NULL);
INSERT INTO `cashier_pay` VALUES (245, 59890397494, '16066256.97', 'oashD5HvDXBphoDOD4F-3i48qWW8', '2022-04-01 20:23:01', 'SUCCESS', 0.01, 0.01, b'0', 12500234136, '2022-04-01 20:23:02', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for cms_article
-- ----------------------------
DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `column_id` bigint(20) unsigned NOT NULL COMMENT '栏目id',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `rank` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `help_article_user_id` (`column_id`) USING BTREE,
  CONSTRAINT `cms_article_ibfk_1` FOREIGN KEY (`column_id`) REFERENCES `cms_column` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='帮助文章表';

-- ----------------------------
-- Records of cms_article
-- ----------------------------
BEGIN;
INSERT INTO `cms_article` VALUES (11, 9, '文章说明', '<p>文章说明</p>', 0, b'0', 0, '2022-02-23 14:34:23', NULL, '2022-03-30 01:03:28');
COMMIT;

-- ----------------------------
-- Table structure for cms_column
-- ----------------------------
DROP TABLE IF EXISTS `cms_column`;
CREATE TABLE `cms_column` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帮助栏目名称',
  `rank` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型，用于区分哪里展示',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='帮助表';

-- ----------------------------
-- Records of cms_column
-- ----------------------------
BEGIN;
INSERT INTO `cms_column` VALUES (9, '帮助', 4, 1, b'0', 10001, '2022-02-23 14:34:05', 10001, '2022-03-30 01:03:09');
COMMIT;

-- ----------------------------
-- Table structure for member_order
-- ----------------------------
DROP TABLE IF EXISTS `member_order`;
CREATE TABLE `member_order` (
  `id` bigint(20) unsigned NOT NULL COMMENT '订单Id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `member_id` bigint(20) unsigned NOT NULL COMMENT '会员Id',
  `cashier_id` bigint(20) unsigned DEFAULT NULL COMMENT '收银id',
  `total_fee` decimal(10,2) NOT NULL COMMENT '总金额',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单状态(1 正常，0 异常)',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `productId` (`member_id`),
  KEY `userId` (`user_id`),
  KEY `cashier_id` (`cashier_id`),
  CONSTRAINT `member_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `member_order_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `app_member` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `member_order_ibfk_3` FOREIGN KEY (`cashier_id`) REFERENCES `app_cashier` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员订单表';

-- ----------------------------
-- Records of member_order
-- ----------------------------
BEGIN;
INSERT INTO `member_order` VALUES (17181901291, 12500234136, 3806, NULL, 38.00, 1, b'0', 12500234136, '2022-04-01 19:07:11', NULL, NULL);
INSERT INTO `member_order` VALUES (21957356359, 12500234136, 3806, 60271064808, 0.01, 1, b'0', 12500234136, '2022-04-01 20:15:06', NULL, NULL);
INSERT INTO `member_order` VALUES (23646770371, 78829214251, 3806, NULL, 0.01, 1, b'0', 78829214251, '2022-04-01 22:58:41', NULL, NULL);
INSERT INTO `member_order` VALUES (31359038888, 12500234136, 3805, 26494856162, 0.01, 1, b'0', 12500234136, '2022-04-01 19:24:10', NULL, NULL);
INSERT INTO `member_order` VALUES (54103312298, 12500234136, 3806, 90097717666, 0.01, 1, b'0', 12500234136, '2022-04-01 19:16:56', NULL, NULL);
INSERT INTO `member_order` VALUES (66741597572, 12500234136, 3806, NULL, 38.00, 1, b'0', 12500234136, '2022-04-01 19:09:42', NULL, NULL);
INSERT INTO `member_order` VALUES (68913163023, 12500234136, 3805, 94443630124, 0.01, 1, b'0', 12500234136, '2022-04-01 19:21:14', NULL, NULL);
INSERT INTO `member_order` VALUES (70925559675, 12500234136, 3806, NULL, 38.00, 1, b'0', 12500234136, '2022-04-01 19:09:02', NULL, NULL);
INSERT INTO `member_order` VALUES (72920445264, 12500234136, 3806, NULL, 38.00, 1, b'0', 12500234136, '2022-04-01 19:16:27', NULL, NULL);
INSERT INTO `member_order` VALUES (73273883536, 12500234136, 3806, NULL, 0.01, 1, b'0', 12500234136, '2022-04-01 19:17:41', NULL, NULL);
INSERT INTO `member_order` VALUES (78916043501, 12500234136, 3806, NULL, 38.00, 1, b'0', 12500234136, '2022-04-01 19:09:21', NULL, NULL);
INSERT INTO `member_order` VALUES (82792851692, 12500234136, 3805, 71148317796, 0.01, 1, b'0', 12500234136, '2022-04-01 20:19:26', NULL, NULL);
INSERT INTO `member_order` VALUES (83412489901, 12500234136, 3805, 24342087162, 0.01, 1, b'0', 12500234136, '2022-04-01 19:15:41', NULL, NULL);
INSERT INTO `member_order` VALUES (91416922871, 12500234136, 3806, 59890397494, 0.01, 1, b'0', 12500234136, '2022-04-01 20:22:56', NULL, NULL);
INSERT INTO `member_order` VALUES (97222616468, 12500234136, 3805, 18854724599, 0.01, 1, b'0', 12500234136, '2022-04-01 20:22:39', NULL, NULL);
INSERT INTO `member_order` VALUES (99342605045, 12500234136, 3805, 84356947678, 0.01, 1, b'0', 12500234136, '2022-04-01 19:10:25', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for member_record
-- ----------------------------
DROP TABLE IF EXISTS `member_record`;
CREATE TABLE `member_record` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员记录id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `order_id` bigint(1) unsigned DEFAULT NULL COMMENT '会员订单Id',
  `major_id` bigint(20) unsigned NOT NULL COMMENT '专业id',
  `member_id` bigint(20) unsigned NOT NULL COMMENT '会员id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员名称',
  `mode` tinyint(1) NOT NULL COMMENT '开通方式 1 充值开通，2后台开通',
  `open_time` datetime NOT NULL COMMENT '开通时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `userId` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户会员记录表';

-- ----------------------------
-- Records of member_record
-- ----------------------------
BEGIN;
INSERT INTO `member_record` VALUES (1, 12500234136, 31359038888, 1000000, 3805, '年卡会员', 1, '2022-04-01 19:24:17', '2023-04-01 19:24:17', b'0', 12500234136, '2022-04-01 19:24:17', NULL, NULL);
INSERT INTO `member_record` VALUES (2, 12500234136, 99342605045, 1000000, 3805, '年卡会员', 1, '2022-04-01 19:24:47', '2023-04-01 19:24:47', b'0', 12500234136, '2022-04-01 19:24:47', NULL, NULL);
INSERT INTO `member_record` VALUES (3, 12500234136, 68913163023, 1000000, 3805, '年卡会员', 1, '2022-04-01 19:25:33', '2023-04-01 19:25:33', b'0', 12500234136, '2022-04-01 19:25:33', NULL, NULL);
INSERT INTO `member_record` VALUES (4, 12500234136, 83412489901, 1000000, 3805, '年卡会员', 1, '2022-04-01 19:29:59', '2023-04-01 19:29:59', b'0', 12500234136, '2022-04-01 19:29:59', NULL, NULL);
INSERT INTO `member_record` VALUES (5, 12500234136, 54103312298, 1000000, 3806, '月卡会员', 1, '2022-04-01 19:31:11', '2022-05-01 19:31:11', b'0', 12500234136, '2022-04-01 19:31:11', NULL, NULL);
INSERT INTO `member_record` VALUES (6, 12500234136, 21957356359, 1000000, 3806, '月卡会员', 1, '2022-04-01 19:24:17', '2023-05-01 19:24:17', b'0', 12500234136, '2022-04-01 20:15:13', NULL, NULL);
INSERT INTO `member_record` VALUES (7, 12500234136, 82792851692, 1000000, 3805, '', 1, '2022-04-01 20:19:32', '2023-04-01 20:19:32', b'0', 12500234136, '2022-04-01 20:19:32', NULL, NULL);
INSERT INTO `member_record` VALUES (8, 12500234136, 97222616468, 1000000, 3805, '', 1, '2022-04-01 20:22:46', '2023-04-01 20:22:46', b'0', 12500234136, '2022-04-01 20:22:46', NULL, NULL);
INSERT INTO `member_record` VALUES (9, 12500234136, 91416922871, 1000000, 3806, '', 1, '2022-04-01 20:22:46', '2023-05-01 20:22:46', b'0', 12500234136, '2022-04-01 20:23:02', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for point_detail
-- ----------------------------
DROP TABLE IF EXISTS `point_detail`;
CREATE TABLE `point_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '明细Id',
  `point_id` bigint(20) NOT NULL COMMENT '点Id',
  `number` decimal(65,2) NOT NULL COMMENT '点数',
  `frozen` decimal(65,2) NOT NULL DEFAULT '0.00' COMMENT '冻结点数',
  `describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '说明',
  `tag` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'TAG',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pointsId` (`point_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1866 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='余额或者其他积分点数表的明细表';

-- ----------------------------
-- Records of point_detail
-- ----------------------------
BEGIN;
INSERT INTO `point_detail` VALUES (1828, 250, 0.00, 0.00, '首次注册，赠送积分', 'REGISTER', b'0', 52126202929, '2022-03-29 13:06:38', NULL, NULL);
INSERT INTO `point_detail` VALUES (1829, 250, 0.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 52126202929, '2022-03-29 22:32:20', NULL, NULL);
INSERT INTO `point_detail` VALUES (1830, 250, 0.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 52126202929, '2022-03-30 00:07:13', NULL, NULL);
INSERT INTO `point_detail` VALUES (1831, 252, 0.00, 0.00, '首次注册，赠送积分', 'REGISTER', b'0', 77262252793, '2022-03-30 01:06:01', NULL, NULL);
INSERT INTO `point_detail` VALUES (1832, 250, 0.00, 0.00, '邀请用户+86181****9904', 'INVITE_REGISTER', b'0', 52126202929, '2022-03-30 01:06:01', NULL, NULL);
INSERT INTO `point_detail` VALUES (1833, 253, 0.00, 0.00, '首次注册，赠送积分', 'REGISTER', b'0', 51672363106, '2022-03-30 08:53:24', NULL, NULL);
INSERT INTO `point_detail` VALUES (1834, 250, 0.00, 0.00, '邀请用户+86189****3555', 'INVITE_REGISTER', b'0', 52126202929, '2022-03-30 08:53:24', NULL, NULL);
INSERT INTO `point_detail` VALUES (1835, 254, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 52126202929, '2022-03-30 16:24:51', NULL, NULL);
INSERT INTO `point_detail` VALUES (1836, 255, 2000.00, 0.00, '首次注册，赠送积分', 'REGISTER', b'0', 12500234136, '2022-03-30 20:33:46', NULL, NULL);
INSERT INTO `point_detail` VALUES (1837, 256, 2000.00, 0.00, '首次注册，赠送积分', 'REGISTER', b'0', 78829214251, '2022-03-30 20:35:57', NULL, NULL);
INSERT INTO `point_detail` VALUES (1838, 254, 1.00, 0.00, '邀请用户+86189****3555', 'INVITE_REGISTER', b'0', 52126202929, '2022-03-30 20:35:57', NULL, NULL);
INSERT INTO `point_detail` VALUES (1839, 255, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 12500234136, '2022-03-30 21:21:09', NULL, NULL);
INSERT INTO `point_detail` VALUES (1840, 256, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 78829214251, '2022-03-30 21:43:39', NULL, NULL);
INSERT INTO `point_detail` VALUES (1841, 256, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 78829214251, '2022-03-31 01:13:49', NULL, NULL);
INSERT INTO `point_detail` VALUES (1842, 255, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 12500234136, '2022-03-31 04:33:27', NULL, NULL);
INSERT INTO `point_detail` VALUES (1843, 255, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 12500234136, '2022-04-01 22:22:38', NULL, NULL);
INSERT INTO `point_detail` VALUES (1844, 255, 0.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-02 17:39:56', NULL, NULL);
INSERT INTO `point_detail` VALUES (1845, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-02 17:43:33', NULL, NULL);
INSERT INTO `point_detail` VALUES (1846, 255, 0.00, 0.00, '语音搜索', 'SEARCH_SPEECH', b'0', 12500234136, '2022-04-02 17:46:31', NULL, NULL);
INSERT INTO `point_detail` VALUES (1847, 255, 0.00, 0.00, '语音搜索', 'SEARCH_SPEECH', b'0', 12500234136, '2022-04-02 17:47:35', NULL, NULL);
INSERT INTO `point_detail` VALUES (1848, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-02 18:06:09', NULL, NULL);
INSERT INTO `point_detail` VALUES (1849, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-02 18:07:09', NULL, NULL);
INSERT INTO `point_detail` VALUES (1850, 255, -3.00, 0.00, '语音搜索', 'SEARCH_SPEECH', b'0', 12500234136, '2022-04-02 18:07:25', NULL, NULL);
INSERT INTO `point_detail` VALUES (1851, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-02 18:07:36', NULL, NULL);
INSERT INTO `point_detail` VALUES (1852, 255, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 12500234136, '2022-04-02 18:08:11', NULL, NULL);
INSERT INTO `point_detail` VALUES (1853, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-02 18:22:25', NULL, NULL);
INSERT INTO `point_detail` VALUES (1854, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-02 18:22:43', NULL, NULL);
INSERT INTO `point_detail` VALUES (1855, 255, -3.00, 0.00, '语音搜索', 'SEARCH_SPEECH', b'0', 12500234136, '2022-04-02 18:23:10', NULL, NULL);
INSERT INTO `point_detail` VALUES (1856, 256, -3.00, 0.00, '语音搜索', 'SEARCH_SPEECH', b'0', 78829214251, '2022-04-02 18:41:09', NULL, NULL);
INSERT INTO `point_detail` VALUES (1857, 256, -3.00, 0.00, '语音搜索', 'SEARCH_SPEECH', b'0', 78829214251, '2022-04-02 18:41:31', NULL, NULL);
INSERT INTO `point_detail` VALUES (1858, 256, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 78829214251, '2022-04-02 18:47:27', NULL, NULL);
INSERT INTO `point_detail` VALUES (1859, 256, -3.00, 0.00, '语音搜索', 'SEARCH_SPEECH', b'0', 78829214251, '2022-04-02 20:56:23', NULL, NULL);
INSERT INTO `point_detail` VALUES (1860, 256, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 78829214251, '2022-04-03 23:25:25', NULL, NULL);
INSERT INTO `point_detail` VALUES (1861, 256, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 78829214251, '2022-04-04 09:33:26', NULL, NULL);
INSERT INTO `point_detail` VALUES (1862, 255, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 12500234136, '2022-04-08 17:17:57', NULL, NULL);
INSERT INTO `point_detail` VALUES (1863, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-08 23:03:57', NULL, NULL);
INSERT INTO `point_detail` VALUES (1864, 255, -2.00, 0.00, '图片搜索', 'SEARCH_IMAGE', b'0', 12500234136, '2022-04-08 23:04:13', NULL, NULL);
INSERT INTO `point_detail` VALUES (1865, 256, 5.00, 0.00, '每日签到，赠送积分', 'SIGN', b'0', 78829214251, '2022-04-09 14:36:26', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for question_option
-- ----------------------------
DROP TABLE IF EXISTS `question_option`;
CREATE TABLE `question_option` (
  `id` bigint(20) unsigned NOT NULL COMMENT '主键',
  `question_id` bigint(20) unsigned NOT NULL COMMENT '题id',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `is_right` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否正确',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`question_id`) USING BTREE,
  CONSTRAINT `question_option_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `app_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='题库选项列表';

-- ----------------------------
-- Records of question_option
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for user_course
-- ----------------------------
DROP TABLE IF EXISTS `user_course`;
CREATE TABLE `user_course` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `course_id` bigint(20) unsigned NOT NULL COMMENT '课程id',
  `brushed_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '已刷题数量',
  `right_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '答对题数量',
  `error_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '答错题数量',
  `skip_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '跳过题数量',
  `last_qid` bigint(20) unsigned DEFAULT NULL COMMENT '最后题id',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `course_id` (`course_id`),
  KEY `user_course_ibfk_3` (`last_qid`),
  CONSTRAINT `user_course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `app_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_course_ibfk_3` FOREIGN KEY (`last_qid`) REFERENCES `app_question` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1642 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户课程表';

-- ----------------------------
-- Records of user_course
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for user_follow
-- ----------------------------
DROP TABLE IF EXISTS `user_follow`;
CREATE TABLE `user_follow` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `from_id` bigint(20) unsigned NOT NULL COMMENT '用户id',
  `to_id` bigint(20) unsigned NOT NULL COMMENT '关注的用户id',
  `status` tinyint(1) NOT NULL COMMENT '状态 1 申请中 2 已关注 3 拒绝关注',
  `apply_time` datetime NOT NULL COMMENT '申请或者关注时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `from_id_2` (`from_id`,`to_id`),
  KEY `to_id` (`to_id`),
  KEY `from_id` (`from_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户关注表';

-- ----------------------------
-- Records of user_follow
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for user_log
-- ----------------------------
DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '日志Id',
  `bind_id` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tokenId',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录方式',
  `date` datetime NOT NULL COMMENT '日期',
  `ip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录ip',
  `device` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录设备',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `userId` (`bind_id`) USING BTREE,
  KEY `tokenId` (`token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3845 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户登录日志表';

-- ----------------------------
-- Records of user_log
-- ----------------------------
BEGIN;
INSERT INTO `user_log` VALUES (3804, 52126202929, '557fc2cb820034b7c449bb2fbd784825', 'CODE', '2022-03-30 16:07:04', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-03-30 16:07:04', NULL, NULL);
INSERT INTO `user_log` VALUES (3805, 52126202929, '83011c0e9f8d3896e9d69ea6d57830d4', 'CODE', '2022-03-30 16:24:32', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-03-30 16:24:32', NULL, NULL);
INSERT INTO `user_log` VALUES (3806, 51672363106, 'f4af55ebb9cf8eaee7159b0aeb3ee143', 'CODE', '2022-03-30 16:32:20', '27.27.29.108', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/WIFI Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 16:32:20', NULL, NULL);
INSERT INTO `user_log` VALUES (3807, 51672363106, '80ba2683af6231afeb436074092f45e8', 'CODE', '2022-03-30 16:32:25', '27.27.29.108', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/WIFI Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 16:32:25', NULL, NULL);
INSERT INTO `user_log` VALUES (3808, 51672363106, '525b0bced87b7b2967bb402a4550cc56', 'CODE', '2022-03-30 16:36:18', '27.27.29.108', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/WIFI Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 16:36:18', NULL, NULL);
INSERT INTO `user_log` VALUES (3809, 51672363106, 'cd78c3c2b59b412e599b3a128b715bc8', 'CODE', '2022-03-30 16:36:26', '27.27.29.108', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/WIFI Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 16:36:26', NULL, NULL);
INSERT INTO `user_log` VALUES (3810, 51672363106, '24791feb78d4abd734cc38bac9229f93', 'CODE', '2022-03-30 17:10:13', '27.27.29.108', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/WIFI Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 17:10:13', NULL, NULL);
INSERT INTO `user_log` VALUES (3811, 51672363106, '223b3587cfe295a76c8026be2f4bbc6d', 'CODE', '2022-03-30 19:58:58', '111.183.4.213', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 19:58:58', NULL, NULL);
INSERT INTO `user_log` VALUES (3812, 51672363106, '9c87c4ba2e2eb953ed9bf50c38f4273d', 'CODE', '2022-03-30 19:59:05', '111.183.4.213', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 19:59:05', NULL, NULL);
INSERT INTO `user_log` VALUES (3813, 52126202929, '6eb1059a6e8e320fde8d40154d1c3ec1', 'CODE', '2022-03-30 20:31:52', '36.43.127.111', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-03-30 20:31:52', NULL, NULL);
INSERT INTO `user_log` VALUES (3814, 12500234136, '7ae4f93e48a88a2538d14a62bd270cf1', 'CODE', '2022-03-30 20:33:46', '36.43.127.111', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-03-30 20:33:46', NULL, NULL);
INSERT INTO `user_log` VALUES (3815, 78829214251, '5c7ff2508635c178d4e10d56caa8a9e8', 'CODE', '2022-03-30 20:35:57', '111.183.4.213', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 20:35:57', NULL, NULL);
INSERT INTO `user_log` VALUES (3816, 78829214251, 'c163fa9c343c0b751b065ee0dcfcce5e', 'CODE', '2022-03-30 21:22:37', '111.183.4.213', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand2 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 21:22:37', NULL, NULL);
INSERT INTO `user_log` VALUES (3817, 78829214251, '125a8739f7c4cfc1b8955036f8d7c134', 'CODE', '2022-03-30 22:37:19', '111.183.4.213', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 22:37:19', NULL, NULL);
INSERT INTO `user_log` VALUES (3818, 78829214251, '38672d626193dfc13b5b9366e652b385', 'CODE', '2022-03-30 22:50:44', '111.183.4.213', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-03-30 22:50:44', NULL, NULL);
INSERT INTO `user_log` VALUES (3819, 12500234136, 'f9873f8edd270ce559e105d01439eb24', 'CODE', '2022-03-31 00:25:06', '36.45.246.250', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123b) NetType/4G Language/zh_CN', b'0', 0, '2022-03-31 00:25:06', NULL, NULL);
INSERT INTO `user_log` VALUES (3820, 12500234136, 'de8444830ed550768540323c91a8ab65', 'CODE', '2022-03-31 04:33:03', '36.43.127.111', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123b) NetType/WIFI Language/zh_CN', b'0', 0, '2022-03-31 04:33:03', NULL, NULL);
INSERT INTO `user_log` VALUES (3821, 12500234136, '498c4b2ab040491510edff91eac6f9e7', 'CODE', '2022-04-01 16:51:25', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 16:51:25', NULL, NULL);
INSERT INTO `user_log` VALUES (3822, 12500234136, 'bd179dd04de9af650a2fd034525f037e', 'CODE', '2022-04-01 16:57:57', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 16:57:57', NULL, NULL);
INSERT INTO `user_log` VALUES (3823, 12500234136, '08a8181d70d73fc15bffa56573be8d3d', 'CODE', '2022-04-01 17:02:46', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 17:02:46', NULL, NULL);
INSERT INTO `user_log` VALUES (3824, 12500234136, '603c612f26e7d86bbc87198fbc83582c', 'CODE', '2022-04-01 17:53:26', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 17:53:26', NULL, NULL);
INSERT INTO `user_log` VALUES (3825, 12500234136, 'd78705b28041fca2d25fe66843d8f71a', 'CODE', '2022-04-01 18:05:21', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 18:05:21', NULL, NULL);
INSERT INTO `user_log` VALUES (3826, 12500234136, '52cf7d620fac1698ab444d7f6087deb9', 'CODE', '2022-04-01 18:10:05', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 18:10:05', NULL, NULL);
INSERT INTO `user_log` VALUES (3827, 12500234136, '4310fa1e3d5347d00ba533a3a75e9316', 'CODE', '2022-04-01 18:10:50', '192.168.0.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 18:10:50', NULL, NULL);
INSERT INTO `user_log` VALUES (3828, 78829214251, 'f8b8cb2c0f039fea028507e0d9c64d36', 'CODE', '2022-04-01 19:03:44', '111.183.63.170', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-04-01 19:03:44', NULL, NULL);
INSERT INTO `user_log` VALUES (3829, 12500234136, '0aead3d04cdb16ff24d9c80f8381fb7a', 'CODE', '2022-04-01 19:21:09', '36.43.123.129', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 19:21:09', NULL, NULL);
INSERT INTO `user_log` VALUES (3830, 12500234136, 'c694f32a9374c5de0c89f87c97660464', 'CODE', '2022-04-01 20:14:54', '36.40.130.53', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123c) NetType/4G Language/zh_CN', b'0', 0, '2022-04-01 20:14:54', NULL, NULL);
INSERT INTO `user_log` VALUES (3831, 78829214251, '864be3a97ead1d3d8f4240f0b4b087bf', 'CODE', '2022-04-01 20:24:04', '111.183.63.170', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-04-01 20:24:04', NULL, NULL);
INSERT INTO `user_log` VALUES (3832, 78829214251, '5237aa7ac0d14b5d92b3b4707fd89a8e', 'CODE', '2022-04-01 20:24:11', '111.183.63.170', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-04-01 20:24:11', NULL, NULL);
INSERT INTO `user_log` VALUES (3833, 78829214251, '3690063d4a200ed27c14a389f40573f3', 'CODE', '2022-04-01 20:24:16', '111.183.63.170', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-04-01 20:24:16', NULL, NULL);
INSERT INTO `user_log` VALUES (3834, 12500234136, 'c568d0e20344dd0c3b5847e361e3adb9', 'CODE', '2022-04-01 20:55:22', '36.43.123.129', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 20:55:22', NULL, NULL);
INSERT INTO `user_log` VALUES (3835, 12500234136, 'dc1e930c8d9fed08c519d884372c68ec', 'CODE', '2022-04-01 20:56:31', '36.40.130.53', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123c) NetType/4G Language/zh_CN', b'0', 0, '2022-04-01 20:56:31', NULL, NULL);
INSERT INTO `user_log` VALUES (3836, 12500234136, '80396f6424bdeabfc3f79c81e744cfae', 'CODE', '2022-04-01 21:29:04', '36.43.123.129', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-01 21:29:04', NULL, NULL);
INSERT INTO `user_log` VALUES (3837, 78829214251, 'fb122266c3e2678c1026c79ec0d4b214', 'CODE', '2022-04-01 21:49:09', '111.183.63.170', 'Mozilla/5.0 (Linux; Android 11; PEGM00 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 XWEB/3195 MMWEBSDK/20210902 Mobile Safari/537.36 MMWEBID/6976 MicroMessenger/8.0.15.2020(0x28000F3D) Process/appbrand0 WeChat/arm64 Weixin NetType/4G Language/zh_CN ABI/arm64 MiniProgramEnv/android', b'0', 0, '2022-04-01 21:49:09', NULL, NULL);
INSERT INTO `user_log` VALUES (3838, 12500234136, '9afa2752bd0adfa5d1ef348579ee7aae', 'CODE', '2022-04-01 22:22:05', '36.43.123.129', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123c) NetType/WIFI Language/zh_CN', b'0', 0, '2022-04-01 22:22:05', NULL, NULL);
INSERT INTO `user_log` VALUES (3839, 12500234136, 'c4281887243cb6d5f38e5696dfe8c2eb', 'CODE', '2022-04-02 17:39:07', '36.43.127.228', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-02 17:39:07', NULL, NULL);
INSERT INTO `user_log` VALUES (3840, 12500234136, 'da1f7d3c82204fdd76763af0468f6b63', 'CODE', '2022-04-02 17:46:09', '36.45.243.178', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123c) NetType/4G Language/zh_CN', b'0', 0, '2022-04-02 17:46:09', NULL, NULL);
INSERT INTO `user_log` VALUES (3841, 12500234136, 'f7337b9413b6fa5baf4010fa067790ee', 'CODE', '2022-04-02 18:05:29', '36.43.127.228', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-02 18:05:29', NULL, NULL);
INSERT INTO `user_log` VALUES (3842, 12500234136, '21f4bfc1e4427954d82edab24b3c8df3', 'CODE', '2022-04-02 18:06:33', '36.45.243.178', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123c) NetType/4G Language/zh_CN', b'0', 0, '2022-04-02 18:06:33', NULL, NULL);
INSERT INTO `user_log` VALUES (3843, 12500234136, 'c8d73b47403d141f126568a35358a2ce', 'CODE', '2022-04-02 20:46:42', '36.43.127.228', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1 wechatdevtools/1.05.2109131 MicroMessenger/8.0.5 Language/zh_CN webview/', b'0', 0, '2022-04-02 20:46:42', NULL, NULL);
INSERT INTO `user_log` VALUES (3844, 12500234136, '5d65de2753f497e0d0a2c665044a150b', 'CODE', '2022-04-02 23:12:50', '36.45.243.178', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.18(0x1800123c) NetType/4G Language/zh_CN', b'0', 0, '2022-04-02 23:12:50', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for user_member
-- ----------------------------
DROP TABLE IF EXISTS `user_member`;
CREATE TABLE `user_member` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户Id',
  `major_id` bigint(20) unsigned NOT NULL COMMENT '专业id',
  `member_id` bigint(20) unsigned NOT NULL COMMENT '会员id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员名称',
  `open_time` datetime NOT NULL COMMENT '开通时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `major_id` (`major_id`),
  KEY `member_id` (`member_id`),
  KEY `name` (`name`),
  CONSTRAINT `user_member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_member_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `app_major` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `user_member_ibfk_3` FOREIGN KEY (`member_id`) REFERENCES `app_member` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `user_member_ibfk_4` FOREIGN KEY (`name`) REFERENCES `app_member` (`name`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3811 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户会员信息';

-- ----------------------------
-- Records of user_member
-- ----------------------------
BEGIN;
INSERT INTO `user_member` VALUES (3810, 12500234136, 1000000, 3805, '', '2022-04-01 20:22:46', '2023-05-01 20:22:46', b'0', 0, '2022-04-01 20:22:46', NULL, '2022-04-01 20:23:02');
COMMIT;

-- ----------------------------
-- Table structure for user_question
-- ----------------------------
DROP TABLE IF EXISTS `user_question`;
CREATE TABLE `user_question` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user id',
  `course_id` bigint(20) unsigned NOT NULL COMMENT '课程id',
  `question_id` bigint(20) unsigned NOT NULL COMMENT '题id',
  `result` tinyint(1) NOT NULL DEFAULT '0' COMMENT '结果 0跳过 1 答错 2 答对',
  `is_delete` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否删除',
  `created_id` bigint(20) NOT NULL COMMENT '创建人Id',
  `created_time` datetime NOT NULL COMMENT '创建时间',
  `updated_id` bigint(20) DEFAULT NULL COMMENT '修改人Id',
  `updated_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `bindId` (`user_id`) USING BTREE,
  KEY `course_id` (`question_id`),
  KEY `course_id_2` (`course_id`),
  CONSTRAINT `user_question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_question_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `app_major` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_question_ibfk_4` FOREIGN KEY (`question_id`) REFERENCES `app_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1642 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户题库表';

-- ----------------------------
-- Records of user_question
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

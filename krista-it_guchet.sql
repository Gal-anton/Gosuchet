-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: krista-it.mysql
-- Generation Time: Aug 24, 2020 at 02:48 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `krista-it_guchet`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_report`
--
-- Creation: Aug 24, 2020 at 02:46 AM
--

DROP TABLE IF EXISTS `data_report`;
CREATE TABLE `data_report`
(
    `id_data_report` int(11) NOT NULL,
    `id_org`         int(11) NOT NULL,
    `id_dmu`         int(11) NOT NULL,
    `id_orgstr`      int(11) NOT NULL,
    `input`          int(11) DEFAULT '0',
    `output`         int(11) DEFAULT '0',
    `efficency`      int(11) DEFAULT NULL,
    `created_at`     date    NOT NULL,
    `updated_at`     date    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dmu`
--
-- Creation: Aug 24, 2020 at 02:44 AM
--

DROP TABLE IF EXISTS `dmu`;
CREATE TABLE `dmu`
(
    `id_dmu`     int(11)     NOT NULL,
    `dmu_dmu`    varchar(65) NOT NULL,
    `id_fun`     int(11)     NOT NULL,
    `id_mod`     int(11)     NOT NULL,
    `id_input`   int(11)     NOT NULL,
    `sum_input`  int(5)      NOT NULL DEFAULT '0',
    `id_output`  int(11)     NOT NULL,
    `sum_output` int(5)      NOT NULL DEFAULT '0',
    `efficency`  int(5)               DEFAULT NULL,
    `created_at` datetime    NOT NULL,
    `updated_at` datetime    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inputs`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `inputs`;
CREATE TABLE `inputs`
(
    `id_input`   int(11)     NOT NULL,
    `kod_input`  int(11)     NOT NULL,
    `name_input` varchar(65) NOT NULL,
    `id_fun`     int(11)     NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `journal`;
CREATE TABLE `journal`
(
    `id_j`         int(11)  NOT NULL,
    `id_dmu`       int(11)  NOT NULL,
    `minX`         int(11)  NOT NULL,
    `maxX`         int(11)  NOT NULL,
    `minY`         int(11)  NOT NULL,
    `maxY`         int(11)  NOT NULL,
    `un_efficency` int(11)  NOT NULL,
    `created_at`   datetime NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE `model`
(
    `id_mod`   int(11) NOT NULL,
    `kod_mod`  int(11) NOT NULL,
    `name_mod` varchar(65) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `okato`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `okato`;
CREATE TABLE `okato`
(
    `id_okato`   int(11)     NOT NULL,
    `kod_okato`  varchar(11) NOT NULL,
    `name_okato` varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `okopf`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `okopf`;
CREATE TABLE `okopf`
(
    `id_okopf`   int(11) NOT NULL,
    `kod_okopf`  int(11) NOT NULL,
    `name_okopf` varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oktmo`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `oktmo`;
CREATE TABLE `oktmo`
(
    `id_oktmo`   int(11)     NOT NULL,
    `kod_oktmo`  varchar(11) NOT NULL,
    `name_oktmo` varchar(255) DEFAULT NULL,
    `population` int(11)      DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `okved`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `okved`;
CREATE TABLE `okved`
(
    `id_okved`   int(11)    NOT NULL,
    `kod_okved`  varchar(8) NOT NULL,
    `name_okved` varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `organisation`;
CREATE TABLE `organisation`
(
    `id_org`     int(11)     NOT NULL,
    `reg_num`    varchar(15) NOT NULL,
    `full_name`  text        NOT NULL,
    `short_name` varchar(255) DEFAULT '',
    `inn`        varchar(11) NOT NULL,
    `ppo`        varchar(255) DEFAULT NULL,
    `id_tip`     int(11)     NOT NULL,
    `id_vid`     int(11)     NOT NULL,
    `id_okved`   int(6)      NOT NULL,
    `id_okato`   int(11)      DEFAULT NULL,
    `id_oktmo`   int(11)      DEFAULT NULL,
    `id_okfs`    int(2)      NOT NULL,
    `id_buj`     int(2)       DEFAULT NULL,
    `id_okopf`   int(5)      NOT NULL,
    `id_owner`   int(11)      DEFAULT NULL,
    `created_at` datetime    NOT NULL,
    `updated_at` datetime    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orgstruct`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `orgstruct`;
CREATE TABLE `orgstruct`
(
    `id_orgstr`   int(11) NOT NULL,
    `kod_orgstr`  int(11) NOT NULL,
    `name_orgstr` varchar(65) DEFAULT NULL,
    `id_fun`      int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `org_function`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `org_function`;
CREATE TABLE `org_function`
(
    `id_fun`   int(11) NOT NULL,
    `kod_fun`  int(11) NOT NULL,
    `name_fun` varchar(65) DEFAULT NULL,
    `id_tip`   int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `outputs`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `outputs`;
CREATE TABLE `outputs`
(
    `id_output`   int(11)     NOT NULL,
    `kod_output`  int(11)     NOT NULL,
    `name_output` varchar(65) NOT NULL,
    `id_fun`      int(11)     NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE `owner`
(
    `id_owner` int(11)      NOT NULL,
    `reg_num`  bigint(20)   NOT NULL,
    `name`     varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tip_organisation`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `tip_organisation`;
CREATE TABLE `tip_organisation`
(
    `id_tip`   int(11) NOT NULL,
    `kod_tip`  int(11) NOT NULL,
    `name_tip` varchar(65) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vid_organisation`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `vid_organisation`;
CREATE TABLE `vid_organisation`
(
    `id_vid`   int(11) NOT NULL,
    `kod_vid`  int(11) NOT NULL,
    `name_vid` varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vid_sob`
--
-- Creation: Aug 23, 2020 at 06:02 PM
--

DROP TABLE IF EXISTS `vid_sob`;
CREATE TABLE `vid_sob`
(
    `id_okfs`   int(11) NOT NULL,
    `kod_okfs`  int(11) NOT NULL,
    `name_okfs` varchar(65) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_report`
--
ALTER TABLE `data_report`
    ADD PRIMARY KEY (`id_data_report`),
    ADD KEY `id_org` (`id_org`),
    ADD KEY `id_orgstr` (`id_orgstr`),
    ADD KEY `id_dmu` (`id_dmu`);

--
-- Indexes for table `dmu`
--
ALTER TABLE `dmu`
    ADD PRIMARY KEY (`id_dmu`),
    ADD KEY `id_mod` (`id_mod`),
    ADD KEY `id_input` (`id_input`),
    ADD KEY `id_output` (`id_output`),
    ADD KEY `id_fun` (`id_fun`);

--
-- Indexes for table `inputs`
--
ALTER TABLE `inputs`
    ADD PRIMARY KEY (`id_input`),
    ADD KEY `id_fun` (`id_fun`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
    ADD PRIMARY KEY (`id_j`),
    ADD KEY `id_dmu` (`id_dmu`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
    ADD PRIMARY KEY (`id_mod`);

--
-- Indexes for table `okato`
--
ALTER TABLE `okato`
    ADD PRIMARY KEY (`id_okato`),
    ADD UNIQUE KEY `kod_okato` (`kod_okato`);

--
-- Indexes for table `okopf`
--
ALTER TABLE `okopf`
    ADD PRIMARY KEY (`id_okopf`),
    ADD UNIQUE KEY `kod_okopf` (`kod_okopf`);

--
-- Indexes for table `oktmo`
--
ALTER TABLE `oktmo`
    ADD PRIMARY KEY (`id_oktmo`),
    ADD UNIQUE KEY `kod_oktmo` (`kod_oktmo`);

--
-- Indexes for table `okved`
--
ALTER TABLE `okved`
    ADD PRIMARY KEY (`id_okved`),
    ADD UNIQUE KEY `kod_okved` (`kod_okved`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
    ADD PRIMARY KEY (`id_org`),
    ADD UNIQUE KEY `reg_num` (`reg_num`),
    ADD UNIQUE KEY `inn` (`inn`),
    ADD KEY `id_oktmo` (`id_oktmo`),
    ADD KEY `id_tip` (`id_tip`),
    ADD KEY `id_okved` (`id_okved`),
    ADD KEY `id_okopf` (`id_okopf`),
    ADD KEY `id_owner` (`id_owner`),
    ADD KEY `id_vid` (`id_vid`),
    ADD KEY `id_okfs` (`id_okfs`),
    ADD KEY `id_okato` (`id_okato`);

--
-- Indexes for table `orgstruct`
--
ALTER TABLE `orgstruct`
    ADD PRIMARY KEY (`id_orgstr`),
    ADD UNIQUE KEY `kod_orgstr` (`kod_orgstr`),
    ADD KEY `id_fun` (`id_fun`);

--
-- Indexes for table `org_function`
--
ALTER TABLE `org_function`
    ADD PRIMARY KEY (`id_fun`),
    ADD UNIQUE KEY `id_tip` (`id_tip`),
    ADD UNIQUE KEY `kod_fun` (`kod_fun`);

--
-- Indexes for table `outputs`
--
ALTER TABLE `outputs`
    ADD PRIMARY KEY (`id_output`),
    ADD KEY `id_fun` (`id_fun`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
    ADD PRIMARY KEY (`id_owner`),
    ADD UNIQUE KEY `reg_num` (`reg_num`);

--
-- Indexes for table `tip_organisation`
--
ALTER TABLE `tip_organisation`
    ADD PRIMARY KEY (`id_tip`),
    ADD UNIQUE KEY `kod_tip` (`kod_tip`);

--
-- Indexes for table `vid_organisation`
--
ALTER TABLE `vid_organisation`
    ADD PRIMARY KEY (`id_vid`),
    ADD UNIQUE KEY `kod_vid` (`kod_vid`);

--
-- Indexes for table `vid_sob`
--
ALTER TABLE `vid_sob`
    ADD PRIMARY KEY (`id_okfs`),
    ADD UNIQUE KEY `kod_okfs` (`kod_okfs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_report`
--
ALTER TABLE `data_report`
    MODIFY `id_data_report` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dmu`
--
ALTER TABLE `dmu`
    MODIFY `id_dmu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inputs`
--
ALTER TABLE `inputs`
    MODIFY `id_input` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
    MODIFY `id_j` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
    MODIFY `id_mod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `okato`
--
ALTER TABLE `okato`
    MODIFY `id_okato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `okopf`
--
ALTER TABLE `okopf`
    MODIFY `id_okopf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oktmo`
--
ALTER TABLE `oktmo`
    MODIFY `id_oktmo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `okved`
--
ALTER TABLE `okved`
    MODIFY `id_okved` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
    MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orgstruct`
--
ALTER TABLE `orgstruct`
    MODIFY `id_orgstr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `org_function`
--
ALTER TABLE `org_function`
    MODIFY `id_fun` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outputs`
--
ALTER TABLE `outputs`
    MODIFY `id_output` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
    MODIFY `id_owner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tip_organisation`
--
ALTER TABLE `tip_organisation`
    MODIFY `id_tip` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vid_organisation`
--
ALTER TABLE `vid_organisation`
    MODIFY `id_vid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vid_sob`
--
ALTER TABLE `vid_sob`
    MODIFY `id_okfs` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_report`
--
ALTER TABLE `data_report`
    ADD CONSTRAINT `data_report_ibfk_2` FOREIGN KEY (`id_org`) REFERENCES `organisation` (`id_org`),
    ADD CONSTRAINT `data_report_ibfk_3` FOREIGN KEY (`id_orgstr`) REFERENCES `orgstruct` (`id_orgstr`);

--
-- Constraints for table `dmu`
--
ALTER TABLE `dmu`
    ADD CONSTRAINT `id_fun` FOREIGN KEY (`id_fun`) REFERENCES `org_function` (`id_fun`),
    ADD CONSTRAINT `id_input` FOREIGN KEY (`id_input`) REFERENCES `inputs` (`id_input`),
    ADD CONSTRAINT `id_mod` FOREIGN KEY (`id_mod`) REFERENCES `model` (`id_mod`),
    ADD CONSTRAINT `id_output` FOREIGN KEY (`id_output`) REFERENCES `outputs` (`id_output`);

--
-- Constraints for table `inputs`
--
ALTER TABLE `inputs`
    ADD CONSTRAINT `inputs_ibfk_1` FOREIGN KEY (`id_fun`) REFERENCES `org_function` (`id_fun`);

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
    ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`id_dmu`) REFERENCES `dmu` (`id_dmu`);

--
-- Constraints for table `organisation`
--
ALTER TABLE `organisation`
    ADD CONSTRAINT `organisation_ibfk_1` FOREIGN KEY (`id_okopf`) REFERENCES `okopf` (`id_okopf`),
    ADD CONSTRAINT `organisation_ibfk_10` FOREIGN KEY (`id_owner`) REFERENCES `owner` (`id_owner`),
    ADD CONSTRAINT `organisation_ibfk_2` FOREIGN KEY (`id_tip`) REFERENCES `tip_organisation` (`id_tip`),
    ADD CONSTRAINT `organisation_ibfk_3` FOREIGN KEY (`id_okved`) REFERENCES `okved` (`id_okved`),
    ADD CONSTRAINT `organisation_ibfk_4` FOREIGN KEY (`id_okato`) REFERENCES `okato` (`id_okato`),
    ADD CONSTRAINT `organisation_ibfk_5` FOREIGN KEY (`id_vid`) REFERENCES `vid_organisation` (`id_vid`),
    ADD CONSTRAINT `organisation_ibfk_6` FOREIGN KEY (`id_okfs`) REFERENCES `vid_sob` (`id_okfs`),
    ADD CONSTRAINT `organisation_ibfk_9` FOREIGN KEY (`id_oktmo`) REFERENCES `oktmo` (`id_oktmo`);

--
-- Constraints for table `orgstruct`
--
ALTER TABLE `orgstruct`
    ADD CONSTRAINT `orgstruct_ibfk_1` FOREIGN KEY (`id_fun`) REFERENCES `org_function` (`id_fun`);

--
-- Constraints for table `org_function`
--
ALTER TABLE `org_function`
    ADD CONSTRAINT `org_function_ibfk_1` FOREIGN KEY (`id_tip`) REFERENCES `tip_organisation` (`id_tip`);

--
-- Constraints for table `outputs`
--
ALTER TABLE `outputs`
    ADD CONSTRAINT `outputs_ibfk_1` FOREIGN KEY (`id_fun`) REFERENCES `org_function` (`id_fun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;

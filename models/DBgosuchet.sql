-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 11:38 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2basic`
--

-- --------------------------------------------------------

--
-- Table structure for table `bujet`
--

CREATE TABLE `bujet` (
  `id_buj` int(11) NOT NULL,
  `kod_buj` int(11) NOT NULL,
  `name_buj` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_report`
--

CREATE TABLE `data_report` (
  `id_data_report` int(11) NOT NULL,
  `id_org` int(11) NOT NULL,
  `report_year` int(4) NOT NULL,
  `report_staff_plan` int(5) NOT NULL,
  `report_staff_fact` int(5) NOT NULL,
  `report_sum_fin` int(11) NOT NULL,
  `report_sum_fot` int(11) NOT NULL,
  `id_orgstr` int(11) NOT NULL,
  `id_fun` int(11) NOT NULL,
  `resource_sum` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dmu`
--

CREATE TABLE `dmu` (
  `id_dmu` int(11) NOT NULL,
  `dmu_dmu` varchar(65) NOT NULL,
  `kod_is` int(27) NOT NULL,
  `id_fun` int(11) NOT NULL,
  `id_mod` int(11) NOT NULL,
  `id_input` int(11) NOT NULL,
  `sum_input` int(5) NOT NULL,
  `id_output` int(11) NOT NULL,
  `sum_output` int(5) NOT NULL,
  `efficency` int(5) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE `function` (
  `id_fun` int(11) NOT NULL,
  `kod_fun` int(11) NOT NULL,
  `name_fun` varchar(65) DEFAULT NULL,
  `id_tip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inputs`
--

CREATE TABLE `inputs` (
  `id_input` int(11) NOT NULL,
  `kod_input` int(11) NOT NULL,
  `name_input` varchar(65) NOT NULL,
  `id_fun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id_j` int(11) NOT NULL,
  `id_dmu` int(11) NOT NULL,
  `minX` int(11) NOT NULL,
  `maxX` int(11) NOT NULL,
  `minY` int(11) NOT NULL,
  `maxY` int(11) NOT NULL,
  `un_efficency` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id_mod` int(11) NOT NULL,
  `kod_mod` int(11) NOT NULL,
  `name_mod` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `okato`
--

CREATE TABLE `okato` (
  `id_okato` int(11) NOT NULL,
  `kod_okato` int(11) NOT NULL,
  `name_okato` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `okopf`
--

CREATE TABLE `okopf` (
  `id_okopf` int(11) NOT NULL,
  `kod_okopf` int(11) NOT NULL,
  `name_okopf` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oktmo`
--

CREATE TABLE `oktmo` (
  `id_oktmo` int(11) NOT NULL,
  `kod_oktmo` int(11) NOT NULL,
  `name_oktmo` varchar(65) DEFAULT NULL,
  `population` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `okved`
--

CREATE TABLE `okved` (
  `id_okved` int(11) NOT NULL,
  `kod_okved` int(11) NOT NULL,
  `name_okved` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `id_org` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `short_name` varchar(65) NOT NULL,
  `inn` int(12) NOT NULL,
  `kod_ppo` int(8) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `id_vid` int(11) NOT NULL,
  `id_okved` int(6) NOT NULL,
  `id_okato` int(11) NOT NULL,
  `id_oktmo` int(11) NOT NULL,
  `id_okfs` int(2) NOT NULL,
  `id_buj` int(2) NOT NULL,
  `id_okopf` int(5) NOT NULL,
  `id_owner` varchar(65) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orgstruct`
--

CREATE TABLE `orgstruct` (
  `id_orgstr` int(11) NOT NULL,
  `kod_orgstr` int(11) NOT NULL,
  `name_orgstr` varchar(65) DEFAULT NULL,
  `id_fun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `outputs`
--

CREATE TABLE `outputs` (
  `id_output` int(11) NOT NULL,
  `kod_output` int(11) NOT NULL,
  `name_output` varchar(65) NOT NULL,
  `id_fun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ppo`
--

CREATE TABLE `ppo` (
  `id_ppo` int(11) NOT NULL,
  `kod_ppo` int(11) NOT NULL,
  `name_ppo` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tip_organisation`
--

CREATE TABLE `tip_organisation` (
  `id_tip` int(11) NOT NULL,
  `kod_tip` int(11) NOT NULL,
  `name_tip` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vid_organisation`
--

CREATE TABLE `vid_organisation` (
  `id_vid` int(11) NOT NULL,
  `kod_vid` int(11) NOT NULL,
  `name_vid` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vid_sob`
--

CREATE TABLE `vid_sob` (
  `id_okfs` int(11) NOT NULL,
  `kod_okfs` int(11) NOT NULL,
  `name_okfs` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bujet`
--
ALTER TABLE `bujet`
  ADD PRIMARY KEY (`id_buj`);

--
-- Indexes for table `data_report`
--
ALTER TABLE `data_report`
  ADD PRIMARY KEY (`id_data_report`),
  ADD KEY `id_org` (`id_org`),
  ADD KEY `id_fun` (`id_fun`),
  ADD KEY `id_orgstr` (`id_orgstr`);

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
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`id_fun`),
  ADD UNIQUE KEY `id_tip` (`id_tip`);

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
  ADD PRIMARY KEY (`id_okato`);

--
-- Indexes for table `okopf`
--
ALTER TABLE `okopf`
  ADD PRIMARY KEY (`id_okopf`);

--
-- Indexes for table `oktmo`
--
ALTER TABLE `oktmo`
  ADD PRIMARY KEY (`id_oktmo`);

--
-- Indexes for table `okved`
--
ALTER TABLE `okved`
  ADD PRIMARY KEY (`id_okved`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id_org`),
  ADD UNIQUE KEY `kod_ppo` (`kod_ppo`),
  ADD KEY `id_oktmo` (`id_oktmo`),
  ADD KEY `id_tip` (`id_tip`),
  ADD KEY `id_okved` (`id_okved`),
  ADD KEY `id_okopf` (`id_okopf`),
  ADD KEY `id_vid` (`id_vid`),
  ADD KEY `id_okfs` (`id_okfs`),
  ADD KEY `id_okato` (`id_okato`),
  ADD KEY `id_buj` (`id_buj`);

--
-- Indexes for table `orgstruct`
--
ALTER TABLE `orgstruct`
  ADD PRIMARY KEY (`id_orgstr`),
  ADD KEY `id_fun` (`id_fun`);

--
-- Indexes for table `outputs`
--
ALTER TABLE `outputs`
  ADD PRIMARY KEY (`id_output`),
  ADD KEY `id_fun` (`id_fun`);

--
-- Indexes for table `ppo`
--
ALTER TABLE `ppo`
  ADD PRIMARY KEY (`id_ppo`);

--
-- Indexes for table `tip_organisation`
--
ALTER TABLE `tip_organisation`
  ADD PRIMARY KEY (`id_tip`);

--
-- Indexes for table `vid_organisation`
--
ALTER TABLE `vid_organisation`
  ADD PRIMARY KEY (`id_vid`);

--
-- Indexes for table `vid_sob`
--
ALTER TABLE `vid_sob`
  ADD PRIMARY KEY (`id_okfs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bujet`
--
ALTER TABLE `bujet`
  MODIFY `id_buj` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
  MODIFY `id_fun` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `outputs`
--
ALTER TABLE `outputs`
  MODIFY `id_output` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppo`
--
ALTER TABLE `ppo`
  MODIFY `id_ppo` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `data_report_ibfk_1` FOREIGN KEY (`id_fun`) REFERENCES `function` (`id_fun`),
  ADD CONSTRAINT `data_report_ibfk_2` FOREIGN KEY (`id_org`) REFERENCES `organisation` (`id_org`),
  ADD CONSTRAINT `data_report_ibfk_3` FOREIGN KEY (`id_orgstr`) REFERENCES `orgstruct` (`id_orgstr`);

--
-- Constraints for table `dmu`
--
ALTER TABLE `dmu`
  ADD CONSTRAINT `id_fun` FOREIGN KEY (`id_fun`) REFERENCES `function` (`id_fun`),
  ADD CONSTRAINT `id_input` FOREIGN KEY (`id_input`) REFERENCES `inputs` (`id_input`),
  ADD CONSTRAINT `id_mod` FOREIGN KEY (`id_mod`) REFERENCES `model` (`id_mod`),
  ADD CONSTRAINT `id_output` FOREIGN KEY (`id_output`) REFERENCES `outputs` (`id_output`);

--
-- Constraints for table `function`
--
ALTER TABLE `function`
  ADD CONSTRAINT `function_ibfk_1` FOREIGN KEY (`id_tip`) REFERENCES `tip_organisation` (`id_tip`);

--
-- Constraints for table `inputs`
--
ALTER TABLE `inputs`
  ADD CONSTRAINT `inputs_ibfk_1` FOREIGN KEY (`id_fun`) REFERENCES `function` (`id_fun`);

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
  ADD CONSTRAINT `organisation_ibfk_2` FOREIGN KEY (`id_tip`) REFERENCES `tip_organisation` (`id_tip`),
  ADD CONSTRAINT `organisation_ibfk_3` FOREIGN KEY (`id_okved`) REFERENCES `okved` (`id_okved`),
  ADD CONSTRAINT `organisation_ibfk_4` FOREIGN KEY (`id_okato`) REFERENCES `okato` (`id_okato`),
  ADD CONSTRAINT `organisation_ibfk_5` FOREIGN KEY (`id_vid`) REFERENCES `vid_organisation` (`id_vid`),
  ADD CONSTRAINT `organisation_ibfk_6` FOREIGN KEY (`id_okfs`) REFERENCES `vid_sob` (`id_okfs`),
  ADD CONSTRAINT `organisation_ibfk_7` FOREIGN KEY (`kod_ppo`) REFERENCES `ppo` (`id_ppo`),
  ADD CONSTRAINT `organisation_ibfk_8` FOREIGN KEY (`id_buj`) REFERENCES `bujet` (`id_buj`),
  ADD CONSTRAINT `organisation_ibfk_9` FOREIGN KEY (`id_oktmo`) REFERENCES `oktmo` (`id_oktmo`);

--
-- Constraints for table `orgstruct`
--
ALTER TABLE `orgstruct`
  ADD CONSTRAINT `orgstruct_ibfk_1` FOREIGN KEY (`id_fun`) REFERENCES `function` (`id_fun`);

--
-- Constraints for table `outputs`
--
ALTER TABLE `outputs`
  ADD CONSTRAINT `outputs_ibfk_1` FOREIGN KEY (`id_fun`) REFERENCES `function` (`id_fun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

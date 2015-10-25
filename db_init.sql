-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2015 at 12:12 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `custom_orm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip` char(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `city`, `zip`) VALUES
(1, 4, 'Sofia', '1000'),
(2, 4, 'Varna', '9000'),
(3, 3, 'London', 'E1'),
(4, 2, 'Douglas', '85655'),
(18, 5, 'Century City', 'CA 90067');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`,`city_id`),
  KEY `city_id` (`city_id`),
  KEY `country_id_2` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `email`, `country_id`, `city_id`, `address`, `phone`) VALUES
(1, 'Chaos Group', 'contacts@chaosgroup.com', 4, 1, '147, Tsarigradsko shose Blvd.', '+359 2 422 422 1'),
(2, 'Kaufland', 'office@kaufland.bg', 4, 2, 'ul. Christo Smirnenski, 2', '052/903200'),
(3, '20th Century Fox', 'info@foxmovies.com', 5, 18, '112 Middle Rd', '004683 54652 13534');

-- --------------------------------------------------------

--
-- Table structure for table `company_products_discount`
--

CREATE TABLE IF NOT EXISTS `company_products_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_amount` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `company_products_discount`
--

INSERT INTO `company_products_discount` (`id`, `company_id`, `product_id`, `discount_amount`) VALUES
(1, 1, 1, 20),
(2, 2, 1, 8),
(3, 1, 2, 22),
(4, 1, 3, 30),
(5, 2, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `state`) VALUES
(1, 'United States', 'Alaska'),
(2, 'United States', 'Arizona'),
(3, 'United Kingdom', 'United Kingdom'),
(4, 'Bulgaria', 'Bulgaria'),
(5, 'United States', 'California');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`) VALUES
(1, 'Лева (LEV)'),
(2, 'British pound (GBP)'),
(3, 'US Dollar (USD)'),
(4, 'Euro (EUR)'),
(9, 'Russian ruble (RUB)');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE IF NOT EXISTS `employers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `employee_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `employee_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `employee_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employee_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `country_id` (`country_id`,`city_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `country_id`, `city_id`, `employee_name`, `employee_email`, `employee_address`, `employee_phone`, `company_id`) VALUES
(1, 4, 1, 'Красимир Костадинов', 'info@krasimirkostadinov.com', 'Mladost 1, et.8 ap. 16', '+359883 606064', 1),
(2, 4, 2, 'Иван Петров', 'ivan@petrov.com', 'ж.к. Възраждане, бл. 118, ет.8, ап. 75', '052/456685', 2),
(4, 4, 2, 'Г-н Петър Младенов', 'petar@kaufland.bg', NULL, '052/25 64 56', 2),
(5, 4, 2, 'Стиляна Пейчева', 'stilyana@kaufland.bg', NULL, '052 / 555555', 2),
(6, 4, 1, 'Петър Митев', 'petar@chaosgroup.com', 'Mladost 1', '0899/998899', 1),
(7, 5, 4, 'Mr. John Tompson', 'jon@century.com', NULL, '+4400 89745 3512', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_city_id` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `shipping_country_id` (`shipping_country_id`,`shipping_city_id`),
  KEY `shipping_city_id` (`shipping_city_id`),
  KEY `shipping_country_id_2` (`shipping_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `company_id`, `shipping_address`, `shipping_country_id`, `shipping_city_id`, `note`, `ip`, `created_at`) VALUES
(1, 3, '112 Middle Rd, Singapore 188970', 5, 18, 'Please add installation instruction', 296615647, '2015-08-30 11:17:34'),
(2, 2, 'Бул. Владислав Варненчик 147, до "МОЛ Варна"', 4, 2, 'Моля да добавите инструкции за инсталиране на продукта, както и гаранция. \r\nИма ли възможност да се Update през първата година?', 2654652978, '2015-08-31 18:03:22'),
(3, 3, 'London, LSE Houghton Street, London, WC2A 2AE', 3, 3, 'Please check shipping price and write to me for total amount!', 2654652978, '2015-09-01 17:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `product_discount` tinyint(4) DEFAULT NULL COMMENT 'Save for history discount amount to that moment',
  `company_discount` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Save for history discount amount to that moment',
  `currency_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `currency_id` (`currency_id`),
  KEY `currency_id_2` (`currency_id`),
  KEY `order_id_2` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `qty`, `product_discount`, `company_discount`, `currency_id`, `price`) VALUES
(1, 1, 2, 2, 0, 22, 3, 1040.00),
(2, 2, 1, 3, 3, 0, 4, 750.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_discount` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Discount in percentage (1-100)',
  `product_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `currency_id` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `currency_id` (`currency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_discount`, `product_description`, `currency_id`, `product_price`) VALUES
(1, 'V-Ray for 3ds Max', 3, 'V-Ray for 3ds Max is the core development of Chaos Group, which allows users to quickly and easily create realistic images while giving them full control over the 3D production process. ', 4, 750.00),
(2, 'V-Ray for Maya', 0, 'Built to meet the creative demands of CG artists and modern production pipelines, V-Ray 3.0 for Maya is a full suite of physically-based lighting, shading and rendering tools tightly integrated into Autodesk Maya.\n\nV-Ray 3.0 for Maya focuses on artist productivity and delivers a powerful new set of features and improvements to speed up lighting, look development and rendering workflows.', 3, 1040.00),
(3, 'Phoenix FD for 3ds Max', 0, 'Phoenix FD is a powerful tool for fluid simulations. Aimed to meet the needs of VFX artist to simulate fire, smoke, explosions as well as liquids, foam and splashes, it has now become universal simulation software for every production house. Phoenix FD offers exceptional flexibility and speed. With an adaptive grid, complete interactivity, a GPU accelerated preview and a fully multi-threaded displacement algorithm it stands out as one of the top solutions for fluid simulations in the visual effects industry. \r\n\r\nPhoenix FD 2.0 now adds the capability to generate and drag particles based on current simulations. This allows the user to add even finer detail to all types of simulations without the need to increase the simulation resolution.', 2, 210.00),
(4, 'Промишлени стоки', 3, 'За използване при домашни условия', 2, 22.00);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `companies_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `company_products_discount`
--
ALTER TABLE `company_products_discount`
  ADD CONSTRAINT `company_products_discount_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `company_products_discount_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `employers_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `employers_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `employers_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`shipping_country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`shipping_city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_products_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_products_ibfk_4` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

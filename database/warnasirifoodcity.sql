-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 06:19 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dayastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_number` varchar(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_number`, `admin_email`, `admin_password`) VALUES
(1, 'Warnasiri FoodCity', '94771875611', 'warnasirifoodcity@gmail.com', '"17867Jeashan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertise`
--

CREATE TABLE `tbl_advertise` (
  `ad_id` int(10) NOT NULL,
  `ad_name` varchar(100) NOT NULL,
  `ad_image` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_advertise`
--

INSERT INTO `tbl_advertise` (`ad_id`, `ad_name`, `ad_image`) VALUES
(2, 'Add two', 'add2.jpg'),
(1, 'Add one', 'add1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_boxes`
--

CREATE TABLE `tbl_boxes` (
  `box_id` int(11) NOT NULL,
  `box_heading` varchar(100) NOT NULL,
  `box_text` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_boxes`
--

INSERT INTO `tbl_boxes` (`box_id`, `box_heading`, `box_text`) VALUES
(1, '100% PAYMENT SECURE', 'Customers can make payments on cash on delivery.'),
(2, 'SUPPORT 24/7', 'Customers will receive technical assistance whenever necessary.'),
(3, '1 - 2 Days Delivery', 'We will deliver your package to your doorstep within 1 to 2 days wherever in Sri Lanka.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `c_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `cus_id` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float(100,2) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`c_id`, `product_id`, `cus_id`, `quantity`, `total`, `status`) VALUES
('CRT-3', 'P-3', 'CUS-1', 1, 45.00, '1'),
('CRT-4', 'P-3', 'CUS-1', 1, 45.00, '1'),
('CRT-1', 'P-3', 'CUS-1', 10, 450.00, '1'),
('CRT-2', 'P-2', 'CUS-1', 10, 4230.00, '1'),
('CRT-5', 'P-14', 'CUS-7', 1, 400.00, '1'),
('CRT-6', 'P-14', 'CUS-7', 1, 400.00, '1'),
('CRT-7', 'P-15', 'CUS-7', 1, 450.00, '1'),
('CRT-8', 'P-2', 'CUS-7', 1, 423.00, '1'),
('CRT-9', 'P-15', 'CUS-7', 1, 450.00, '1'),
('CRT-10', 'P-2', 'CUS-7', 1, 423.00, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` varchar(20) NOT NULL,
  `cat_name` varchar(30) NOT NULL,
  `cat_icon` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_icon`) VALUES
('CAT-1', 'Chilled', 'chilledImg.jpg'),
('CAT-2', 'Beverages', 'bevarageImg.jpg'),
('CAT-3', 'Bakery', 'bakeryImg.jpg'),
('CAT-4', 'Frozen', 'frozenImg.jpeg'),
('CAT-5', 'Grocery', 'GroceryImg.jpg'),
('CAT-6', 'Household', 'household.png'),
('CAT-7', 'Homeware', 'homeware.jpg'),
('CAT-8', 'Fruits and Vegetables', 'fruits&vegitableImg.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cus_id` varchar(20) NOT NULL,
  `cus_fname` varchar(20) DEFAULT NULL,
  `cus_lname` varchar(20) DEFAULT NULL,
  `cus_tele` varchar(12) DEFAULT NULL,
  `cus_nic` varchar(13) DEFAULT NULL,
  `cus_city` varchar(20) DEFAULT NULL,
  `cus_address` varchar(100) DEFAULT NULL,
  `cus_image` varchar(1000) DEFAULT NULL,
  `cus_email` varchar(50) NOT NULL,
  `cus_password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cus_id`, `cus_fname`, `cus_lname`, `cus_tele`, `cus_nic`, `cus_city`, `cus_address`, `cus_image`, `cus_email`, `cus_password`) VALUES
('CUS-1', 'Frank', 'Alvares', '94762688091', '200105102366', 'Kesbewa', '18/A Rani Mw, Ethukala, Negombo.', 'CUS-1shane.PNG', 'frankshanealvares5@gmail.com', '123'),
('CUS-2', 'frank', 'alvares', '1234567890', '1234567890', 'Mortuwa', '18/a rani mawatha\r\nethukala', 'CUS-2shane.PNG', 'frankshane2001@gmail.com', '123'),
('CUS-3', 'test', 'testlast', '12345678901', '123456789012', 'Piliyandala', 'test address', NULL, 'frankalvares.2001@gmail.com', '123'),
('CUS-4', 'Shane', 'Alvares', '12345678901', '200105102366', 'Piliyandala', '18/a rani mawatha\nethukala', NULL, 'frankshane.ict@gmail.com', '123'),
('CUS-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'peterpanpeter123pan@gmail.com', '1234'),
('CUS-5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pereramoris44@gmail.com', '123'),
('CUS-7', 'dsf', 'sdasd', '94773617736', '123456789v', 'Piliyandala', 'sdasdas', '', 'jeashan999@gmail.com', '"17867Jeashan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `faq_id` int(11) NOT NULL,
  `faq_question` varchar(100) NOT NULL,
  `faq_answer` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`faq_id`, `faq_question`, `faq_answer`) VALUES
(1, 'How to return products?', 'After place and order most items are eligible for returns except products from fruits and vegetables(Product to product return only). The items should be unused, intact and in their original packaging (labels, tags, boxes).'),
(2, 'What are the payment methods available?', 'At the moment, we only accept cash on delivery payment method.'),
(3, 'How long its takes for delivery?', 'Most orders arrive within 1-2 days of order being confirmed. An order confirmation SMS/Email will be sent to you, post which keep a watch out for a SMS/Email notification that you will receive from us, once your order is confirmed.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn`
--

CREATE TABLE `tbl_grn` (
  `grn_no` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `p_orderId` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grn`
--

INSERT INTO `tbl_grn` (`grn_no`, `date`, `p_orderId`, `description`) VALUES
('GRN-1', '2020-06-16 14:43:24', 'PORD-1', 'Thank you for quick delivery.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `pay_id` varchar(20) NOT NULL,
  `pay_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `method` varchar(20) DEFAULT NULL,
  `s_orderId` varchar(20) DEFAULT NULL,
  `pay_status` varchar(10) DEFAULT NULL,
  `total` float(100,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`pay_id`, `pay_date`, `method`, `s_orderId`, `pay_status`, `total`) VALUES
('PAY-4', '2020-06-16 16:47:57', 'Cash On Delivery', 'ORD-4', 'Paid', 45.00),
('PAY-3', '2020-06-16 16:44:44', 'Cash On Delivery', 'ORD-3', 'Paid', 45.00),
('PAY-2', '2020-06-16 16:43:12', 'Cash On Delivery', 'ORD-2', 'Paid', 4230.00),
('PAY-1', '2020-06-16 16:39:13', 'Cash On Delivery', 'ORD-1', 'Paid', 450.00),
('PAY-5', '2020-06-23 08:16:08', 'Cash On Delivery', 'ORD-5', 'Pending..', 400.00),
('PAY-6', '2020-06-29 15:12:42', 'Cash On Delivery', 'ORD-6', 'Pending..', 400.00),
('PAY-7', '2020-06-29 15:23:29', 'Cash On Delivery', 'ORD-7', 'Pending..', 450.00),
('PAY-8', '2020-06-29 15:24:40', 'Cash On Delivery', 'ORD-8', 'Pending..', 423.00),
('PAY-9', '2020-06-29 18:45:50', 'Cash On Delivery', 'ORD-9', 'Pending..', 450.00),
('PAY-10', '2020-07-01 10:08:51', 'Cash On Delivery', 'ORD-10', 'Pending..', 423.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` varchar(20) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_display_price` float(100,2) DEFAULT NULL,
  `pro_available_stock` int(10) NOT NULL,
  `pro_discount_status` int(1) NOT NULL,
  `pro_discount_amount` float(100,1) DEFAULT NULL,
  `pro_available_status` int(1) NOT NULL,
  `pro_description` varchar(600) NOT NULL,
  `cat_id` varchar(30) DEFAULT NULL,
  `pro_image` varchar(1000) NOT NULL,
  `pro_tags` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_name`, `pro_display_price`, `pro_available_stock`, `pro_discount_status`, `pro_discount_amount`, `pro_available_status`, `pro_description`, `cat_id`, `pro_image`, `pro_tags`) VALUES
('P-1', 'Nescafe 250g', 800.00, 0, 1, 5.0, 0, 'Nescafe is a brand of coffee made by Nestle.  It comes in many different forms. The name is a portmanteau of the words "Nestle" and "cafe". Nestle first introduced their flagship coffee brand in Switzerland on 1 April 1938.', 'CAT-2', 'nescafe250g-1.jpg', 'nescafe,Beverages,250g,cafe,coffee'),
('P-2', 'Milo 400g', 470.00, 13, 1, 10.0, 1, 'Milo is a chocolate and malt powder typically mixed with hot water or milk to produce a beverage popular in Oceania, South America, Southeast Asia and parts of Africa. Produced by Nestlé, Milo was originally developed by Australian inventor Thomas Mayne in 1934.', 'CAT-2', 'milo400g-1.jpg', 'milo,400g,molt,beverages'),
('P-3', 'Maggi 70g', 45.00, 22, 0, 0.0, 1, 'Maggi is an international brand of seasonings, instant soups, and noodles that originated in Switzerland in late 19th century. The Maggi company was acquired by Nestlï¿½ in 1947', 'CAT-5', 'maggi70g-1.jpg', 'maggi,noodles,70g,nestle,grocery'),
('P-4', 'Oreo 100g', 470.00, 39, 1, 1.0, 1, 'An Oreo is a sandwich cookie consisting of two wafers with a sweet crème filling. Introduced in 1912, Oreo is the best selling cookie brand in the United States. As of 2018, the version sold in the U.S. is made by the Nabisco division of Mondelez International.', 'CAT-5', 'oreo100g-2.jpg', 'biscult,oreo,grocery'),
('P-5', 'AirWick 237g', 1200.00, 50, 0, 0.0, 0, 'Air Wick is an American air freshener brand produced, and also is manufactured owned by the British company Reckitt Benckiser. It was first launched in 1943 in the United States, and is now sold worldwide.', 'CAT-7', 'airwick237g-1.jpg', 'air freshner,air wick,airwick,237g,homeware'),
('P-6', 'Harpic Lemon 700ml', 420.00, 24, 0, 0.0, 1, 'Harpic is the brand name of a toilet bowl cleaner launched in the United Kingdom in the 1920s by Reckitt Benckiser. It is currently available in Africa, the Middle East, South Asia, Asia Pacific, Europe and the Americas.', 'CAT-7', 'harpic700mllemon-1.jpg', 'harpic lemon,700ml,homeware'),
('P-7', 'lifebuoy Sampoo 100ml', 150.00, 50, 0, 0.0, 1, 'Lifebuoy is a brand of soap marketed by Unilever. Lifebuoy was originally, and for much of its history, a carbolic soap containing phenol. The soaps manufactured today under the Lifebuoy brand do not contain phenol. Currently, there are many variants of Lifebuoy.', 'CAT-6', 'lifeboy100ml-1.jpg', 'shampoo,lifeboy,lifebouy,household'),
('P-8', 'Surf Excel 1Kg', 900.00, 49, 1, 5.0, 1, 'Surf Excel is a Unilever brand that is currently marketed as the counterpart brand of OMO detergent in the India, Pakistan, Bangladesh and Sri Lanka markets.', 'CAT-6', 'surfexcel1kg-1.png', 'surf excel,1kg,household,wash,powder,washing'),
('P-9', 'Anchor 400g', 450.00, 49, 0, 0.0, 1, '\r\nAnchor Full Cream Milk Powder INSTANT FULL CREAM MILK POWDER VITAMIN ENRICHED is made from the purest and freshest New Zealand cows milk from which only the water have been removed.', 'CAT-2', 'anchor400g.jpg', 'Anchor, anchor 400g, powdwe, milk , beverages'),
('P-10', 'Anlene 400g', 420.00, 46, 0, 0.0, 1, 'product designed with a combination of nutrients to support your bones, joints and muscles. It contains higher levels of Calcium', 'CAT-2', 'Anlene-400g.jpg', 'Anlene ,Anlene 400g, milk, powder, beverages'),
('P-11', 'BONLAC 400g', 500.00, 43, 0, 0.0, 1, 'BONLAC,instant skimmed milk with natural milk calcium is formulated for those who are conscious of their general health,shape and fitness.\r\nit is also ideal for elderly and those who are concerned with bone health and cholestrol levels.\r\nmilk calcium is needed for healthy bones and stronger teeth.', 'CAT-2', 'BONLAC400G.png', 'BONLAC 400G,bonlac, 400g, milk, powder, beverages'),
('P-12', 'Nestamalt 400g', 420.00, 49, 0, 0.0, 1, 'Bringing \'Power, Strength and Energy\' from the golden goodness of malt, vitamin B and the essential nutrients of milk, Nestomalt is the perfect blend of refreshment and energy in one cup, and is even ideal to be consumed with tea!', 'CAT-2', 'nestamalt400g.jpg', 'nestamalt, nestamalt 400g,bevrages, malt, milk powder'),
('P-13', 'Maliban Cream Craker', 250.00, 40, 0, 0.0, 1, 'Biscuit lovers in Sri Lanka have grown up eating Maliban Cream Crackers. This biscuit is known for its crisp, crunchy texture and milky taste. The Cream Cracker is excellent when sandwiched with butter and jam or eaten with cheese.', 'CAT-5', 'malibancreamcrakerbig.jpg', 'maliban ,maliban ceram crakers 500g , big , grocery'),
('P-14', 'Kelloggs Corn Flakes 100G', 400.00, 39, 0, 0.0, 1, 'Kellogg\'s Corn Flakes Original is a nourishing ready-to-eat breakfast cereal at its very best.\r\nIt is prepared from corn enriched with iron and 8 key essential vitamins like A, C, and B-Group vitamins.', 'CAT-5', 'KelloggsCornFlakes100G.jpeg', 'Kelloggs Corn Flakes 100G, cereal , cereals, flacks, corn, grocery'),
('P-15', 'Kelloggs Chocos Cereal', 450.00, 42, 0, 0.0, 1, 'Nutritiously Complete Cereal That Helps 1Plus Toddler Grow Healthy & Strong! & the only toddler cereal in the market that is enriched with Probiotics. Wheat, Honey & Dates. Enriched with Probiotics. Brands: Ceregrow 1-3, Ceregrow 3-5, Growingup.lk for learning.', 'CAT-5', 'KelloggsChocosCereal375g.jpeg', 'Kelloggs Chocos Cereal 375g,350g, cereals , chocos , grocery'),
('P-16', 'Harischandra Noodles', 150.00, 46, 0, 0.0, 1, 'Harischandra Kurakkan Noodles are perfect for people who appreciate quality and taste while also eating healthy food. With just the right blend of wheat flour and kurakkan flour, Harischandra Kurakkan Noodles are a tasty and convenient way to enjoy a nutritious meal.', 'CAT-5', 'harichrandraNoddles.jpeg', 'Noodles, Harischandra Noodles Kurakkan 400g, Grocery'),
('P-17', 'Lysol 250ml', 450.00, 48, 0, 0.0, 1, 'DescriptionLysol is a brand name of cleaning and disinfecting products distributed by the Reckitt Benckiser company. The line includes liquid solutions for hard and soft surfaces, air treatment, and hand washing. ', 'CAT-7', 'lysol250ml.jpg', 'lysol 250ml, floor cleaner, homeware'),
('P-18', 'Bio Clean 250ml', 300.00, 48, 0, 0.0, 1, 'Bio Clean is the first and only Bio Degradable Toilet Bowl Cleaner in Sri Lanka, therefore provide solution for domestic trouble of blocking, overflowing of toilet septic tanks and frequent callings for gully bowser. As Bio Clean is readily bio degradable, no chemicals end up in environment and never bio accumulate, so never contribute to environmental pollution', 'CAT-7', 'biocllean250ml.png', 'bio clean 250ml, toilet cleaner, homeware'),
('P-19', 'Domex 500ml', 400.00, 49, 0, 0.0, 1, 'Domex has been providing effective sanitation to people across the globe. Over the years, Domex has provided families with protection from harmful germs.The sheer power of Domex gives you the confidence you need in eradicating all known germs. Domex is committed to raising hygiene standards by improving general hygiene and health standards in communities around the world.Domex Original Toilet Cleaner is a toilet cleaner which not only gives you a clean toilet but also kills all germs to safeguard your family from the toilet germs.', 'CAT-7', 'domex500ml.jpg', 'toilet cleaning, clean, 500ml, domex, homeware'),
('P-20', 'Dettol 1L', 900.00, 49, 1, 2.0, 1, 'Dettol Antiseptic Disinfectant Liquid to kill germs on the skin, help protect against infection from cuts, scratches and insect bites and it can also be used as a household disinfectant on surfaces or in laundry.', 'CAT-7', 'detol1l.jpg', 'detol,cleaner,clean,germ killer, germ kill, 1l,homeware, dettol'),
('P-21', 'Lifebuoy hand Wash', 370.00, 49, 0, 0.0, 1, 'Lifebuoy Total 10 Germ Protection# Hand Wash contains our patented ingredient, Active5 your hands will be clean and protected against germs. The special formula is proven to remove 99.9% germ protection.', 'CAT-6', 'lifebuoy-hand-wash-500x500.jpg', 'Lifebuoy,Lifebuoy hand wash,hand wash,life boy hand wash,lifeboy hand wash,household'),
('P-22', 'Dettol Hand Wash', 350.00, 49, 0, 0.0, 1, 'Dettol Original Liquid Hand Wash kills 99.9% of germs. Using it every day protects hands from germs and helps keep them hygienically clean. The pH-balanced formula along with Dettol\'s trusted germ protection helps your skin feeling healthy and fresh.', 'CAT-6', 'dettol-Hand-Wash-Dettol-200ml.jpg', 'dettol,dettol hand wash,hand wash,detol hand wash,household'),
('P-23', 'Sunsilk Shampoo 340ml', 250.00, 49, 0, 0.0, 1, 'Sunsilk is a hair care brand, primarily aimed at women, produced by the Unilever group. Sunsilk is Unilever’s leading hair care brand, and ranks as one of the Anglo-Dutch conglomerate\'s “billion dollar brands". Sunsilk shampoos, conditioners and other hair care products are sold in 69 countries worldwide.', 'CAT-6', 'sunsilk-shampoo.jpg', 'Shampoo, hair clean, sunsilk, household'),
('P-24', 'Signal Toothpaste 120ml', 150.00, 49, 0, 0.0, 1, 'Provides the benefit of toothpaste, mouthwash & floss\r\nPowerful action of toothpaste to fight cavity causing germs\r\nMicrogranules formula proven to be effective for interdental cleaning\r\nProvides long lasting freshness', 'CAT-6', 'signaltoothpaste120ml.jpg', 'signal toothpaste,toothpaste, house hold');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order`
--

CREATE TABLE `tbl_purchase_order` (
  `p_orderId` varchar(20) NOT NULL,
  `item_name` varchar(40) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `sup_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `order_description` varchar(600) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_order`
--

INSERT INTO `tbl_purchase_order` (`p_orderId`, `item_name`, `quantity`, `date`, `sup_id`, `product_id`, `status`, `order_description`) VALUES
('PORD-1', 'Milo 400g', '100', '2020-06-16 14:41:05', 'SUP-2 ', 'P-2', '4', 'Please delivery this stock as soon as possible - Thankyou!'),
('PORD-2', 'nescafe', '100', '2020-06-22 09:45:24', 'SUP-3', 'P-1', '1', 'dfdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_return`
--

CREATE TABLE `tbl_purchase_return` (
  `p_returnId` varchar(20) NOT NULL,
  `p_orderId` varchar(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `sup_id` varchar(20) NOT NULL,
  `description` varchar(600) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_return`
--

INSERT INTO `tbl_purchase_return` (`p_returnId`, `p_orderId`, `qty`, `date`, `status`, `sup_id`, `description`) VALUES
('RPORD-1', 'PORD-1', 50, '2020-06-16 14:46:15', '2', 'SUP-2 ', 'There 50 damaged products');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_order`
--

CREATE TABLE `tbl_sales_order` (
  `s_orderId` varchar(20) NOT NULL,
  `c_id` varchar(20) DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float(100,2) DEFAULT NULL,
  `cus_fname` varchar(20) DEFAULT NULL,
  `cus_lname` varchar(20) DEFAULT NULL,
  `cus_nic` varchar(13) DEFAULT NULL,
  `cus_address` varchar(100) DEFAULT NULL,
  `cus_city` varchar(20) DEFAULT NULL,
  `cus_tele` varchar(12) DEFAULT NULL,
  `cus_email` varchar(50) DEFAULT NULL,
  `order_status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales_order`
--

INSERT INTO `tbl_sales_order` (`s_orderId`, `c_id`, `order_date`, `total`, `cus_fname`, `cus_lname`, `cus_nic`, `cus_address`, `cus_city`, `cus_tele`, `cus_email`, `order_status`) VALUES
('ORD-4', 'CRT-4', '2020-06-16 16:47:57', 45.00, 'Frank', 'Alvares', '200105102366', '18/A Rani Mw, Ethukala, Negombo.', 'Kesbewa', '94762688091', 'frankshanealvares5@gmail.com', '4'),
('ORD-3', 'CRT-3', '2020-06-16 16:44:44', 45.00, 'Frank', 'Alvares', '200105102366', '18/A Rani Mw, Ethukala, Negombo.', 'Kesbewa', '94762688091', 'frankshanealvares5@gmail.com', '4'),
('ORD-2', 'CRT-2', '2020-06-16 16:43:12', 4230.00, 'Frank', 'Alvares', '200105102366', '18/A Rani Mw, Ethukala, Negombo.', 'Kesbewa', '94762688091', 'frankshanealvares5@gmail.com', '4'),
('ORD-1', 'CRT-1', '2020-06-16 16:39:13', 450.00, 'Frank', 'Alvares', '200105102366', '18/A Rani Mw, Ethukala, Negombo.', 'Kesbewa', '94762688091', 'frankshanealvares5@gmail.com', '4'),
('ORD-5', 'CRT-5', '2020-06-23 08:16:08', 400.00, 'dsf', 'sdasd', '123456789v', 'sdasdas', 'Piliyandala', '94773617736', 'jeashan999@gmail.com', '2'),
('ORD-6', 'CRT-6', '2020-06-29 15:12:42', 400.00, 'dsf', 'sdasd', '123456789111', 'sdasdas', 'Piliyandala', '94773617736', 'jeashan999@gmail.com', '1'),
('ORD-7', 'CRT-7', '2020-06-29 15:23:29', 450.00, 'dsf', 'sdasd', '123456789v', 'sdasdas', 'Piliyandala', '94773617736', 'jeashan999@gmail.com', '1'),
('ORD-8', 'CRT-8', '2020-06-29 15:24:40', 423.00, 'dsf', 'sdasd', '123456789012', 'sdasdas', 'Piliyandala', '94773617736', 'jeashan999@gmail.com', '1'),
('ORD-9', 'CRT-9', '2020-06-29 18:45:50', 450.00, 'dsf', 'sdasd', '123456789v', 'sdasdas', 'Piliyandala', '94773617736', 'jeashan999@gmail.com', '1'),
('ORD-10', 'CRT-10', '2020-07-01 10:08:51', 423.00, 'dsf', 'sdasd', '123456789111', 'sdasdas', 'Piliyandala', '94773617736', 'jeashan999@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_return`
--

CREATE TABLE `tbl_sales_return` (
  `s_returnId` varchar(20) NOT NULL,
  `cus_id` varchar(20) DEFAULT NULL,
  `s_orderId` varchar(20) DEFAULT NULL,
  `product_id` varchar(20) DEFAULT NULL,
  `total` float(100,2) DEFAULT NULL,
  `return_date` datetime NOT NULL,
  `return_status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales_return`
--

INSERT INTO `tbl_sales_return` (`s_returnId`, `cus_id`, `s_orderId`, `product_id`, `total`, `return_date`, `return_status`) VALUES
('SRORD-2', 'CUS-1', 'ORD-3', 'P-3', 45.00, '2020-06-16 17:04:26', '1'),
('SRORD-1', 'CUS-1', 'ORD-4', 'P-3', 45.00, '2020-06-16 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slides`
--

CREATE TABLE `tbl_slides` (
  `slide_id` int(10) NOT NULL,
  `slide_name` varchar(100) NOT NULL,
  `slide_image` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slides`
--

INSERT INTO `tbl_slides` (`slide_id`, `slide_name`, `slide_image`) VALUES
(1, 'slide one', 'slider1.jpg'),
(2, 'slide two', '2016-games-wallpapers-high-quality-Is-4K-Wallpaper.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_id` varchar(20) NOT NULL,
  `sup_nic` varchar(20) NOT NULL,
  `sup_name` varchar(50) NOT NULL,
  `sup_address` varchar(100) NOT NULL,
  `sup_tele` varchar(13) NOT NULL,
  `sup_email` varchar(50) NOT NULL,
  `item_tag` varchar(50) NOT NULL,
  `company_name` varchar(20) NOT NULL,
  `company_tele` varchar(13) NOT NULL,
  `company_address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`sup_id`, `sup_nic`, `sup_name`, `sup_address`, `sup_tele`, `sup_email`, `item_tag`, `company_name`, `company_tele`, `company_address`) VALUES
('SUP-1 ', ' 123456789v', '  hhj ', '  dsf', '  12345678901', '  asd2@gmail.com', 'mailo', '  dsfs', ' 12345678902', 'dfs'),
('SUP-2 ', '200105102366', 'Frank Shane Alvares ', '  18/A, Rani Mw, Ethukala, Negombo', ' 94762688091 ', 'frankshanealvares5@gmail.com', 'Milo', ' Nestle Pvt LTD', ' 94762688092', '  Colombo'),
('SUP-3', '123456789v', 'jeashan', 'dfg', '12345678901', 'jeashan999@gmail.com', 'nescafe', 'sdfs', '12345678903', 'gfggh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_advertise`
--
ALTER TABLE `tbl_advertise`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `tbl_boxes`
--
ALTER TABLE `tbl_boxes`
  ADD PRIMARY KEY (`box_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`c_id`,`product_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cusEmail` (`cus_email`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD PRIMARY KEY (`grn_no`),
  ADD KEY `p_orderId` (`p_orderId`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `s_orderId` (`s_orderId`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD PRIMARY KEY (`p_orderId`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sup_id` (`sup_id`);

--
-- Indexes for table `tbl_purchase_return`
--
ALTER TABLE `tbl_purchase_return`
  ADD PRIMARY KEY (`p_returnId`),
  ADD KEY `p_orderId` (`p_orderId`),
  ADD KEY `sup_id` (`sup_id`);

--
-- Indexes for table `tbl_sales_order`
--
ALTER TABLE `tbl_sales_order`
  ADD PRIMARY KEY (`s_orderId`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `tbl_sales_return`
--
ALTER TABLE `tbl_sales_return`
  ADD PRIMARY KEY (`s_returnId`),
  ADD KEY `s_orderId` (`s_orderId`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_slides`
--
ALTER TABLE `tbl_slides`
  ADD PRIMARY KEY (`slide_id`),
  ADD UNIQUE KEY `slide_image` (`slide_image`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

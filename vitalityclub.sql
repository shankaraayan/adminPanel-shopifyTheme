-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 20, 2022 at 07:16 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vitalityclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement_bars`
--

DROP TABLE IF EXISTS `announcement_bars`;
CREATE TABLE IF NOT EXISTS `announcement_bars` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `heading` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `background_color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement_bars`
--

INSERT INTO `announcement_bars` (`id`, `heading`, `description`, `background_color`, `text_color`, `created_at`, `updated_at`) VALUES
(1, '10% discount on our herbal teas!<a href=\"https://www.vitalityclub.in/shop/tea/herbal-teas\" style=\"color: #000000\"> <b>Click Here</a></b>', NULL, '#cf597e', '#f5f1ec', '2021-06-19 15:55:13', '2021-07-10 04:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `automatic_discounts`
--

DROP TABLE IF EXISTS `automatic_discounts`;
CREATE TABLE IF NOT EXISTS `automatic_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `discountTitle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountType` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `discountValue` int(11) NOT NULL,
  `discountMinPurchaseAmt` int(11) DEFAULT '0',
  `discountStartDate` date NOT NULL,
  `discountEndDate` date DEFAULT NULL,
  `discountStatus` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_img` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannerBtn_text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannerBtn_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_img`, `banner_text`, `bannerBtn_text`, `bannerBtn_link`, `created_at`, `updated_at`) VALUES
(2, 'Vitality-club-banner-2.jpg', 'Buy artisanal <b>herbal teas and tisanes</b> enriched with superfoods and ayurvedic ingredients - perfect for a wide range of health needs!', 'Herbal Teas', 'http://www.vitalityclub.in/shop/tea/herbal-teas', '2021-05-16 20:49:23', '2021-07-02 00:10:20'),
(3, 'Vitality-club-banner-3.jpg', 'Buy premium <b>black whole leaf teas</b> from Assam and Darjeeling, as well as spiced masala chai - ideal for the discerning tea connoisseur!', 'Black Teas', 'https://www.vitalityclub.in/shop/tea/black-teas', '2021-05-16 20:52:02', '2021-07-02 00:10:35'),
(4, 'Vitality-club-banner-4.jpg', 'Buy wellness <b>green teas</b>, packed with antioxidants and polyphenols - for better immunity, detox and digestion,  weight care, and more!', 'Green Teas', 'https://www.vitalityclub.in/shop/tea/green-teas', '2021-05-16 20:54:28', '2021-07-02 00:10:47'),
(5, 'Vitality-club-banner-5.jpg', 'At <b>Vitality Club</b>, we believe that proper nutrition, a good flow of life, a sense of belonging, and a peaceful mind are at the root of and wellness.', 'About Us', 'http://www.vitalityclub.in/about-us', '2021-05-17 01:32:01', '2021-06-23 00:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryImage` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_category_unique` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `banner`, `categoryImage`, `created_at`, `updated_at`) VALUES
(1, 'Tea', 'Buy our range of premium black teas from Assam and Darjeeling, as well as wellness green teas, white tea, and herbal teas for every lifestyle need!', 'Vitality-club-tea-banner.jpg', 'Vitality-club-tea-image.jpg', '2021-05-09 00:34:21', '2021-07-20 22:30:20'),
(3, 'Spices', 'Pure, high-quality spices and blends for everyday needs, as well as for maintaining immunity and wellness levels!', 'Vitality-club-spices-banner.jpg', 'Vitality-club-spices-image.jpg', '2021-05-13 19:11:04', '2021-07-20 22:37:13'),
(4, 'Honey', 'Pure, raw, lab-tested honey!', 'Vitality-club-honey-banner.jpg', 'Vitality-club-honey-image.jpg', '2021-07-18 00:22:11', '2021-07-21 03:59:12'),
(5, 'Combos and Offers', 'A handpicked and carefully curated selection of our bestsellers, \'must-buys\', deals and discounts, and much more!', 'Vitality-club-combos-and-offers-banner.jpg', 'Vitality-club-combos-and-offers-image.jpg', '2021-07-18 00:42:21', '2021-07-21 04:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

DROP TABLE IF EXISTS `checkouts`;
CREATE TABLE IF NOT EXISTS `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customers_id` bigint(20) NOT NULL,
  `customers_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `recovery_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantities` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_codes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `customers_id`, `customers_name`, `email_status`, `recovery_status`, `product_quantities`, `product_codes`, `total`, `created_at`, `updated_at`) VALUES
(3, 1, 'Krish Chowdhry', 'Not Sent', 'Not Recovered', '2', 'VC-TE-LAV', 720, '2021-06-23 05:20:04', '2021-06-23 05:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribed_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_pincode` bigint(20) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `billing_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_pincode` bigint(20) DEFAULT NULL,
  `billing_phone` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `users_id`, `email`, `subscribed_status`, `first_name`, `last_name`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_pincode`, `phone`, `billing_status`, `billing_first_name`, `billing_last_name`, `billing_address`, `billing_city`, `billing_state`, `billing_country`, `billing_pincode`, `billing_phone`, `created_at`, `updated_at`) VALUES
(1, 2, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor', 'Safdarjung Enclave', 'Delhi', 'India', 110028, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor', 'Safdarjung Enclave', 'Delhi', 'India', 110028, 9650075833, '2021-05-30 11:33:32', '2021-07-21 08:37:15'),
(2, 1, 'hello@vitalityclub.in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-03 16:16:01', '2021-06-03 16:16:01'),
(3, 1, 'sajan@tccggd.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-03 20:02:54', '2021-06-03 20:02:54'),
(4, 0, 'krish.91@gmail.com', 'Yes', 'k', 'c', 'A1/76, 1st Floor', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'k', 'c', 'A1/76, 1st Floor', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-08 03:44:59', '2021-06-20 22:13:02'),
(5, 1, 'vitalityclub@candidindia.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-18 16:07:19', '2021-06-18 16:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

DROP TABLE IF EXISTS `discount_codes`;
CREATE TABLE IF NOT EXISTS `discount_codes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `discountCode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountType` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `discountValue` int(11) NOT NULL,
  `discountMinPurchaseAmt` int(11) DEFAULT '0',
  `discountStartDate` date NOT NULL,
  `discountEndDate` date DEFAULT NULL,
  `discountStatus` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountOncePerUser` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `users_id`, `email`, `phone`, `subject`, `firstName`, `lastName`, `category`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'lolitcbacacist3265@gmail.com', 87127392646, 'XEvil 5.0: सबसे अच्छा एंटी - ReCaptcha-3 समाधान', 'Lolitoenump2369', 'Lolitaenump9986LR', 'General Enquiry', 'ज़ेविल-थ्रेड नंबर सीमा और उच्चतम परिशुद्धता के बिना असीमित संख्या में समाधान के साथ सबसे अच्छा कैप्चा सॉल्वर टूल! \r\nXEvil 5.0 समर्थन से अधिक 12.000 प्रकार की छवि कैप्चा, शामिल ReCaptcha, गूगल कैप्चा, Yandex कैप्चा, Microsoft कैप्चा, भाप कैप्चा, SolveMedia, ReCaptcha-2 और (हाँ!!!) रिक्तचा-3 भी। \r\n \r\n1.) लचीले ढंग से: आप समायोजित कर सकते हैं के लिए तर्क unstandard captchas \r\n2.) आसान: बस ज़ेविल शुरू करें, 1 बटन दबाएं-और यह स्वचालित रूप से आपके एप्लिकेशन या स्क्रिप्ट से कैप्चा स्वीकार करेगा \r\n3.) फास्ट: 0,01 सरल कैप्चा के लिए सेकंड, के बारे में 20..रेप्चा के लिए 40 सेकंड-2, और लगभग 5।..रिक्तचा के लिए 8 सेकंड-3 \r\n \r\nआप किसी भी एसईओ/एसएमएम सॉफ्टवेयर, पासवर्ड-चेकर के किसी भी पार्सर, किसी भी एनालिटिक्स एप्लिकेशन या किसी भी कस्टम स्क्रिप्ट के साथ ज़ेविल का उपयोग कर सकते हैं:  \r\n ज़ेविल समर्थन प्रसिद्ध विरोधी कैप्चा सेवाओं के सबसे API: 2Captcha.com, RuCaptcha.Com, AntiGate (Anti-Captcha), DeathByCaptcha, etc. \r\n \r\nइच्छुक हैं? बस अधिक जानकारी के लिए गूगल \"ज़ेविल\" में खोज \r\nआप इसे पढ़ते हैं-फिर यह काम करता है! ;))) \r\n \r\nसादर, Lolityenump8500', NULL, NULL),
(2, 0, 'm.shishov@mystdepersvi.bizml.ru', 81543955922, 'крыса  mysea.space Try out, just a check-up', 'CurtisGrads', 'CurtisGradsXW', 'General Enquiry', 'http://in-ter.ru/ \r\n \r\nhttp://mztservice.ru/ \r\n \r\nhttp://www.e8company.ru/ \r\n \r\nhttp://www.roswep.ru/ \r\n \r\nhttp://www.teplotex.ru/ \r\n \r\nhttp://xn--54-mlcypet.xn--p1ai/ \r\n \r\nhttps://alfalaval.moscow/ \r\n \r\nhttps://a-technologia.ru/prokladki/ \r\n \r\nhttps://brant.ru/ \r\n \r\nhttps://dupad.ru/ \r\n \r\nhttps://entech.pro/ \r\n \r\nhttps://execo.su/ \r\n \r\nhttps://gazovik-teplo.ru/ \r\n \r\nhttps://heat-energy.ru/ \r\n \r\nhttps://ink-engineering.ru/ \r\n \r\nhttps://intech-gmbh.ru/ \r\n \r\nhttps://krit-energo.ru/ \r\n \r\nhttps://laval-online.ru/ \r\n \r\nhttps://minecool.ru/ \r\n \r\nhttps://opeks.energy/ \r\n \r\nhttps://phoenix-apr.ru/ \r\n \r\nhttps://praimenergo.ru/ \r\n \r\nhttps://proteplo.org/ \r\n \r\nhttps://proxytherm.com/ \r\n \r\nhttps://ptoservis.com/ \r\n \r\nhttps://teplavam.ru/ \r\n \r\nhttps://teplo66.ru/ \r\n \r\nhttps://teplocontrol.info/ \r\n \r\nhttps://teplo-garant.com/ \r\n \r\nhttps://teplomagnat.ru/ \r\n \r\nhttps://teploobmen.ru/ \r\n \r\nhttps://teploobmennik-russia.ru/ \r\n \r\nhttps://teplo-sila.com/ \r\n \r\nhttps://termoblok.ru/ \r\n \r\nhttps://termopartner.ru/ \r\n \r\nhttps://texnoteplox.com/ \r\n \r\nhttps://ttai.ru/ \r\n \r\nhttps://vimlex.ru/ \r\n \r\nhttps://whitenord.com/ \r\n \r\nhttps://www.anvitek.ru/ \r\n \r\nhttps://www.holcom.ru/ \r\n \r\nhttps://www.kelvion.com/ \r\n \r\nhttps://www.pto-service.com/ \r\n \r\nhttps://www.ridan.ru/ \r\n \r\nhttps://www.tdv-service.com/ \r\n \r\nhttps://www.teplokomplect.ru/ \r\n \r\nhttps://www.teploprofi.com/ \r\n \r\nhttps://www.zipcentr.com/ \r\n \r\nhttps://xn----8sbbncbvabrhnoahdap5az.xn--p1ai/ \r\n \r\nhttps://xn----8sbcobbrescengbhafhaji3dfo22a.xn--p1ai/ \r\n \r\nhttps://xn--90ahbmaldjkagak4b.xn--p1ai/ \r\n \r\nhttps://zeo-pto.ru/ \r\n \r\nhttps://zipservis.com/', NULL, NULL),
(3, 0, 'padalexivan@gmail.com', 84487457151, 'https://vk.com/kupludom24', 'Bobbyjounk', 'BobbyjounkJG', 'General Enquiry', '<a href=https://vk.com/kupludom24>Продам дом Красноярск', NULL, NULL),
(4, 0, 'mchvanschaik@tele2.nl', 84837474657, 'Download Music Private FTP', 'Ernestkag', 'ErnestkagMG', 'General Enquiry', 'Hello, \r\n \r\nDownload Music FLAC Private FTP: https://0daymusic.org/premium.php \r\nServer\'s capacity 186 TB Music \r\nSupport for FTP, FTPS, SFTP, HTTP, HTTPS. \r\nOveral server\'s speed: 1 Gb/s. \r\nDownload Dance, Electro, House, Techno, Trance, Pop, Rock, Rap... \r\n \r\nBest regards, Ernest', NULL, NULL),
(5, 0, 'hasikra@yandex.ru', 88649944336, '4g прокси', 'Saralimb', 'SaralimbZO', 'General Enquiry', 'Стабильные <a href=https://proxyspace.seo-hunter.com/mobile-proxies/kazan/>  мобильные прокси для работы с социальными сетями </a> динамические', NULL, NULL),
(6, 0, 'alexpopov716253@gmail.com', 85963193794, 'Фольга 2.4533', 'Kathrynmon', 'KathrynmonQL', 'General Enquiry', 'Приглашаем Ваше предприятие к взаимовыгодному сотрудничеству в сфере производства и поставки <a href=https://redmetsplav.ru/store/nikel1/zarubezhnye_materialy/germaniya/cat2.4975/folga_2.4975/>Фольга 2.4533</a>. \r\n-       Поставка тугоплавких и жаропрочных сплавов на основе (молибдена, вольфрама, тантала, ниобия, титана, циркония, висмута, ванадия, никеля, кобальта); \r\n-	Поставка концентратов, и оксидов \r\n-	Поставка изделий производственно-технического назначения пруток, лист, проволока, сетка, тигли, квадрат, экран, нагреватель) штабик, фольга, контакты, втулка, опора, поддоны, затравкодержатели, формообразователи, диски, провод, обруч, электрод, детали,пластина, полоса, рифлёная пластина, лодочка, блины, бруски, чаши, диски, труба. \r\n-       Любые типоразмеры, изготовление по чертежам и спецификациям заказчика. \r\n-       Поставка изделий из сплавов: \r\n \r\n<a href=https://stressaav.nu/guidad-meditation-mindfulness-kroppsscanning/#comment-40466>Поковка 2.0750</a>\r\n<a href=http://175zr.com/forum.php?mod=viewthread&tid=4491&extra=>Фольга 2.4500</a>\r\n<a href=http://muchoswiry.pl/forum/viewtopic.php?f=53&t=7056%22/>Полоса ниобиевая НбП-2б  -  ГОСТ 26252-84</a>\r\n<a href=http://tubeclips.ru/ed-sheeran-bad-habits-25th-june/#comment-173231>Полоса ХН35МТЮ-ВД</a>\r\n<a href=http://freedvb.com/viewtopic.php?f=18&t=22375>Лист 42НХТЮ</a>\r\n a417933', NULL, NULL),
(7, 0, 'padalexivan@gmail.com', 85815859693, 'https://vk.com/kupludom24', 'Bobbyjounk', 'BobbyjounkJG', 'General Enquiry', '<a href=https://vk.com/kupludom24>Продам дом Красноярск', NULL, NULL),
(8, 0, 'gvfyfghj@gmail.com', 88752415158, 'loli*ta gi*rl fu*ck c*p pt*hc', 'KevvinCROGS', 'KevvinCROGSOQ', 'General Enquiry', 'loli*ta gi*rl fu*ck c*p pt*hc \r\n \r\nhttps://xor.tw/4pgec', NULL, NULL),
(9, 0, 'user.zale.v.sk.i.ja.2.2201@gmail.com', 83814218124, 'светодиодные автолампы', 'Donaldlff', 'DonaldshdNV', 'General Enquiry', 'Доброго времени суток господа \r\nWhere is administration? \r\nIt is important. \r\nThank. \r\n[url=https://burtehservice.by/]плиткорез круговой[/url]', NULL, NULL),
(10, 0, 'alexpopov716253@gmail.com', 86239763295, 'Вольфрам ВА', 'Kathrynmon', 'KathrynmonQL', 'General Enquiry', 'Приглашаем Ваше предприятие к взаимовыгодному сотрудничеству в направлении производства и поставки <a href=https://redmetsplav.ru/store/volfram/splavy-volframa-1/volfram-vm-2/>Вольфрам ВА</a>. \r\n-       Поставка тугоплавких и жаропрочных сплавов на основе (молибдена, вольфрама, тантала, ниобия, титана, циркония, висмута, ванадия, никеля, кобальта); \r\n-	Поставка порошков, и оксидов \r\n-	Поставка изделий производственно-технического назначения пруток, лист, проволока, сетка, тигли, квадрат, экран, нагреватель) штабик, фольга, контакты, втулка, опора, поддоны, затравкодержатели, формообразователи, диски, провод, обруч, электрод, детали,пластина, полоса, рифлёная пластина, лодочка, блины, бруски, чаши, диски, труба. \r\n-       Любые типоразмеры, изготовление по чертежам и спецификациям заказчика. \r\n-       Поставка изделий из сплавов: \r\n \r\n<a href=http://d8851.cn/archives/1.html#comment-39>Лист 68НМ</a>\r\n<a href=http://myklibsystem.tk/index.php/fotogalereya/item/18/asInline>Проволока 2.4640</a>\r\n<a href=https://einearchebauen.com/danke-sadhguru#comment-8166>Порошок ниобиевый НбПГ-4</a>\r\n<a href=https://appds.uk/blog/citrix-vs-wvd-or-is-it-citrix-and-wvd#comments>Фольга 2.4651</a>\r\n<a href=http://www.rechtvoorstudenten.nl/vuurwerk-duur-werk/#comment-12972>Поковка 2.0820</a>\r\n 8a41793', NULL, NULL),
(11, 0, 'phillipsariannays95412@gmail.com', 85385961977, 'warhammer end times - vermintide classes', 'RobertBal', 'RobertBalKC', 'General Enquiry', 'Looking for <h1>Warhammer end times - vermintide classes</h1>?\r\n\r\ndownload it\r\n\r\n<a href=http://traffco.su/2?keyword=warhammer+end+times+-+vermintide+classes><img src=\"https://zootovaryvsem.org/button3.png\"></a> \r\n \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nVermintide Wiki\r\nExplore Properties\r\nDifferences between classes? :: Warhammer: End Times - Vermintide Red Moon Inn | General Discussion\r\nwww.thegamer.com\r\nNavigation menu\r\n<h2>.Official Vermintide Wiki</h2>\r\nMar 09, В В· Vermintide is a co-operative, action, first-person shooter and melee combat adventure set in the End Times of the iconic Warhammer Fantasy universe. Vermintide takes place in and around Ubersreik, a city overrun by Skaven. Fight from the Magnus Tower to the Under Empire, assuming the role of one of five heroes. <Learn>More.]. Warhammer: End Times - Vermintide Alle Diskussionen Screenshots Artwork Гњbertragungen Videos Neuigkeiten Guides Rezensionen Alle Diskussionen Screenshots Artwork Гњbertragungen Videos Neuigkeiten Guides Rezensionen. Oct 20, В В· Warhammer: End Times - Vermintide. All Discussions Screenshots Artwork Broadcasts Videos News Guides Reviews Like i said, you can\'t treat them as \"classes\" the only thing that can be treated as a class is the dwarf being a tank because he is the best one at doing that bar none. #6. Warhammer Vermintide - Heroes Author: Gina, Rob If you are new to Warhammer: End Times - Vermintide and are not sure which class is best for you, then you have come to the right place.\r\n\r\n\r\n\r\nVermintide 2: Every Class & Career, Ranked Worst To Best\r\n\r\n\r\n<h3>Warhammer end times - vermintide classes.Warhammer: End Times вЂ“ Vermintide - Wikipedia</h3>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nWarhammer: End Times - Vermintide Alle Diskussionen Screenshots Artwork Гњbertragungen Videos Neuigkeiten Guides Rezensionen Alle Diskussionen Screenshots Artwork Гњbertragungen Videos Neuigkeiten Guides Rezensionen. Mar 09, В В· Vermintide is a co-operative, action, first-person shooter and melee combat adventure set in the End Times of the iconic Warhammer Fantasy universe. Vermintide takes place in and around Ubersreik, a city overrun by Skaven. Fight from the Magnus Tower to the Under Empire, assuming the role of one of five heroes. <Learn>More.]. Warhammer Vermintide - Heroes Author: Gina, Rob If you are new to Warhammer: End Times - Vermintide and are not sure which class is best for you, then you have come to the right place. Oct 20, В В· Warhammer: End Times - Vermintide. All Discussions Screenshots Artwork Broadcasts Videos News Guides Reviews Like i said, you can\'t treat them as \"classes\" the only thing that can be treated as a class is the dwarf being a tank because he is the best one at doing that bar none. #6.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n \r\n \r\n \r\n \r\nm-audio xponent softwarehalo 5 achilles helmetsamsung blu ray player bdp1600power cd g to video karaoke converteravh-4100nex firmwareshadowrun 5th edition logoredemption cemetery clock of fatehp elitebook folio 9470m driverscan you transfer gta5 from xbox 360 to ps4firewalker pack mass effect 2 \r\nhp officejet 6110 allinonegigabyte ga g31m s2lradeon r7 370 drivermatsuda jiu-jitsubluetooth remote control driver \r\nhttp://newsfromhiamaserbo3x.blogspot.com/2021/06/honeywell-xenon-1900-drivershoneywell.html\r\nhttp://newsfrom341serfebpeto8b.blogspot.com/2021/06/oxygen-8-motorist.html\r\n<a href=\"http://newsfrom743haefesporzu2z.blogspot.com/2021/06/msi-gaming-5-ethernet-driver.html\">http://newsfrom743haefesporzu2z.blogspot.com/2021/06/msi-gaming-5-ethernet-driver.html</a>\r\nhttp://newsfrom2esjudihori.blogspot.com/2021/06/atheros-ar8151-pci-e-gigabit-ethernet.html\r\nhttp://newsfrom824coetralexgebz.blogspot.com/2021/06/nxp-nearfieldproximity-provider.html\r\n \r\n \r\nresident evil 6 screenshotenable wan down browser redirect noticehow to overclock with nvidia inspectorkyocera taskalfa 4551ci driverworlds largest horse penis \r\nwordy weekend subway surfersn-trig duosense driver windows 10men of war traineramd firepro w7000 drivervisual studio 2010 shell download \r\nalienware area 51 r2 driverswho is on my wifi apkmemorex multiformat dvd recorder driver downloadred alert 2 map editorepson v700 scanner drivers \r\n \r\n<a href=http://newsfromhiamaserbo3x.blogspot.com/2021/06/microsoft-lifecam-vx-5000.html>roccat ryos mk pro driver\r\n </a> \r\n<a href=http://newsfrom7dennumnamutz.blogspot.com/2021/06/lenovo-device-that-is-pointing-windows.html>asus rog gl552vw dh71 drivers\r\n </a> \r\n<a href=http://newsfrommissgisamukz.blogspot.com/2021/06/icewind-dale-2-patchesroad-to-26-is.html>sword of the stars tech tree\r\n </a> \r\n<a href=http://newsfrom365demplimersusm.blogspot.com/2021/06/urbackupbuild-urbackup-server-and.html>windows 8.1 secure boot isn\'t configured correctly build 9600\r\n </a> \r\n<a href=http://newsfrom145litidispo9b.blogspot.com/2021/06/american-megatrends-driversdrivers.html>hp g60-125nr\r\n </a> \r\n<a href=http://newsfrom1planatpogozu.blogspot.com/2021/06/photostage-slideshow-softwarephotostage.html>hp usb key utility\r\n </a> \r\n<a href=http://newsfromsparenopsaox.blogspot.com/2021/06/pci-ven1022-satellite-c850d-pscc2e-usb.html>logitech gaming software 8.45\r\n </a> \r\n<a href=http://newsfromlogsuretpasq.blogspot.com/2021/06/microsoft-comfort-optical-mouseoptical.html>ipad air 2 motherboard\r\n </a> \r\n<a href=<a>infrastructure design suite premium\r\n </a> \r\n<a href=http://newsfromsadalaeial.blogspot.com/2021/06/sidewinder-keyboard-drivermicrosoft.html>star trek clock widget\r\n </a> \r\nhow to rename apple mousemsi dragon edition 2amd radeon hd 8280 driveramd catalyst 13.4 legacy driver 64 bit downloadlenovo x1 carbon wifi driver \r\nhow to get community operations bf4steelseries 3gc controller setupdell precision 5510 ubuntuqualcomm atheros ar3012 bluetooth 4.0 driverblack ops 2 dig \r\ndemise rise of the ku tansmartsound quicktracks plug inhow to transfer gta character from xbox one to ps4mobile pre usb driverred bull destiny promotion \r\n \r\nffjdjdkf123klds.dsjsdfkkk', NULL, NULL),
(12, 0, 'padalexivan@gmail.com', 83533464161, 'https://vk.com/kupludom24', 'Bobbyjounk', 'BobbyjounkJG', 'General Enquiry', '<a href=https://vk.com/kupludom24>Продам дом Красноярск', NULL, NULL),
(13, 0, 'r.bahramiw2@gmail.com', 88166419875, 'Best of Ali', 'Janetroulp', 'AlexandraroulpMT', 'General Enquiry', 'Best of Ali - https://bit.ly/3hx9fpd', NULL, NULL),
(14, 0, 'naummarkin5154@yandex.ru', 86968122885, 'Major', 'KennethUrina', 'KennethUrinaVQ', 'General Enquiry', 'This is a unique place for fashionable women\'s clothing and accessories. \r\nWe offer our clients women\'s clothing, jewelry, cosmetics and health products, shoes, bags and much more. \r\nhttps://fas.st/Ujfha', NULL, NULL),
(15, 0, 'padalexivan@gmail.com', 89969317955, 'https://vk.com/kupludom24', 'Bobbyjounk', 'BobbyjounkJG', 'General Enquiry', '<a href=https://vk.com/kupludom24>Продам дом Красноярск', NULL, NULL),
(16, 0, 'support@well-web.net', 84633384384, 'Виртуальный хостинг', 'RonaldVigma', 'RonaldVigmaVC', 'General Enquiry', '<a href=https://well-web.net/>Виртуальный хостинг</a> \r\n<a href=\"https://well-web.net/\">Виртуальный хостинг</a>', NULL, NULL),
(17, 0, 'gosha.kryuchenkov@mail.ru', 85338938636, 'viagarajjq.com', 'Jamesmip', 'JamesmipWP', 'General Enquiry', 'sildenafil lozenges information webmd <a href=http://viagarajjq.com/></a> viagra pill identifier', NULL, NULL),
(18, 0, 'balashiha.kupit@yandex.ru', 87473164887, 'Где можно купить скважинный насос в Балашихе', 'купить насос для скважины Балашиха', 'купить насос для скважины Балашиха', 'General Enquiry', 'IBO 4SD 16/14 (380В) - «Антипесковый» эффект отличное дополнения к глубинному насосу IBO 4SD 16/14 (380В)  достигается за счет “плавающих” рабочих колес, и зазоров между рабочим колесом и кассетой. Низ насоса оснащен надежным трехфазным мотором мощностью 4000 Вт. Хорошо сбалансированный двигатель позволил добиться отличных напорно-расходных характеристик. Максимальный напор составил 75 метров при производительности 24.48 м3/час.<a href=https://7filtrov.shop><img src=\"https://7filtrov.shop/upload/iblock/774/774f300471528dcfce3f966c74e8c51c.png\"></a> - <a href=https:/7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/2976/>IBO 4SD 16/14 (380В)</a> \r\nНасосы здесь - Насосы на выбор: <a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/>насосы для скважин Балашиха</a> \r\n \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_20_metrov/>насосы для скважин 20 метров Балашиха</a> \r\n \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_30_metrov/>купить насос для скважин 30 метров</a> \r\n \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_50_metrov/>насосы для скважин 50 метров</a> \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_60_metrov/>купить насос для скважин 60 метров</a> \r\n \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_90_metrov/>купить насос для скважин 90 метров</a> \r\n \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_110_metrov/>насосы для скважин 110 метров Балашиха</a> \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_120_metrov/>насосы для скважин 120 метров</a> \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_grundfos/>купить насос для скважин grundfos</a> \r\n \r\n<a href=https://balashiha.7filtrov.shop/catalog/nasosy/nasosy_dlya_skvazhin/nasosy_dlya_skvazhin_vodotok/>купить насос для скважин vodotok</a>.', NULL, NULL),
(19, 0, 'larskarr2016@gmail.com', 87966892591, 'biaya tanpa resep online tanpa resep w6x', 'SausaLew', 'SausaLewPD', 'General Enquiry', '<b><a href=http://fito-spray-spain.com/a/peen/aralen.html>Visit Secure Drugstore >> Click Here! << </a></b> \r\n \r\n \r\n<a href=http://fito-spray-spain.com/a/peen/chloroquine.html><img src=\"https://i.imgur.com/P8dh1bB.jpg\"></a> \r\n \r\n \r\n<b><a href=http://fito-spray-spain.com/a/peen/aralen.html>Visit Secure Drugstore >> Click Here! << </a></b> \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\nonline tanpa resep mekanisme aksi https://www.rede-do-territorio.pt/forum/viewtopic.php?pid=1014590#p1014590 harga interaksi obat tanpa resep tidak ada efek samping http://labor-economics.org/forum/viewtopic.php?f=5&t=1795509 bagaimana dan kapan menggunakan Meulaboh \r\nresep tanpa persetujuan dokter https://21vets.org/forums/topic/dimana-saya-bisa-mendapatkan-metoclopramide-tanpa-resep-beli-metoclopramide/ harga rendah aman online \r\ntanpa resep harga diskon http://ofernio.ru/forum/viewtopic.php?p=39563#39563 harga termurah Pekanbaru \r\ntanpa resep biaya https://share1s.net/viewtopic.php?f=5&t=1533051 Apotek bahan aktif harga termurah resep https://endlessnightsgamestudio.com/phpbb/viewtopic.php?f=8&t=185364 kualitas tinggi Magelang \r\ntanpa resep harga https://www.rede-do-territorio.pt/forum/viewtopic.php?pid=1014593#p1014593 dosis dengan diskon \r\nOnline Diskon http://va2na.com/forum/viewtopic.php?f=2&t=466217 tanpa resep Padang Panjang \r\n kualitas tinggi \r\ndi apotek tanpa resep tanpa resep http://scanclub.ru/remont-i-diagnostika-mitsubishi/13479-beli-dari-azelastine-beli-azelastine.html#post107056 Online Murah Langsa \r\n harga rendah \r\n harga', NULL, NULL),
(20, 0, 'confisumill1980@rambler.ru', 81886213473, 'Смартфоны-айфоны', 'NabcyGes', 'NabcyGesJZ', 'General Enquiry', '<a href=https://gallaxy-s9.ru>Aйфoны</a> \r\n \r\nнoвыe moдeлu! \r\n \r\n \r\nРазнообразный выбoр, существенные cкuдкu. \r\n \r\nYскoреннaя дoставкa по Pоccuu.', NULL, NULL),
(21, 0, 'kuznetsov-roman.96026@mail.ru', 85736661739, 'клиника кодирования от алкоголизма', 'Harrybuifs', 'HarrybuifsLL', 'General Enquiry', 'снятие ломки цены\r\nдетоксикация наркозависимых на дому\r\nмедицинское кодирование от алкоголизма\r\nпринудительное лечение от алкоголизма цена\r\nснятие ломки\r\n \r\n \r\n<a href=https://silavol.ru/>как лечить наркомана</a>', NULL, NULL),
(22, 0, 'ad56924@gmail.com', 82462834536, 'Need some advice', 'RobertSaf', 'RobertSafBL', 'General Enquiry', 'Does anyone use this <a href=https://sjmphotography.info>gay dating site</a>? What else can you recommend?', NULL, NULL),
(23, 0, 'chiefscreolecafecom@gmail.com', 85927624728, 'Kênh Trực Tiếp đá Bóng Thời Điểm Hôm Nay', 'Phillipchify', 'PhillipchifyUM', 'General Enquiry', 'Thẳng đá Bóng Ngày Hôm Nay, Liên Kết Xem Trực Tuyến Video Clip Trường Hợp<a href=\"https://virandoamor.com/detail/k-lich-chieu-phim-galaxy-nguyen-van-qua-113449.html\">giá vé galaxy</a>Real có liên tục hai bàn ở những phút cuối tuy nhiên ko thể lộn ngược tình thế bên trên bảng xếp hạng. Dù 2 trận đấu này diễn ra bên trên sân trung lập tại UAE, luật bàn thắng sảnh khách hàng vẫn được áp dụng. Theo thông báo của UEFA, những trận đấu sẽ diễn ra tập trung chuyên sâu ở thành phố Lisbon (Bồ Đào Nha).', NULL, NULL),
(24, 0, 'acavy@muzebra.space', 84333595571, 'Firmware Samsung Galaxy J7 Neo SM-J701M | J701MUBSBCUD1/J701MUUBBCUD1/J701MUBSBCUD1', 'HarryAbura', 'HarryAburaVO', 'General Enquiry', 'Download the Samsung firmware for the ? Samsung Samsung Galaxy J7 Neo ? SM-J701F with product code BNG from Bangladesh. This firmware has version number PDA J701FDDSACUA5 and CSC J701FODDACUA5. The operating system of this firmware is Android Pie , with build date 2021-02-10. Changelist 16078765. \r\nSummary description: \r\n \r\nSamsung Galaxy J7 Core SM-J701F. Display diagonal: 14 cm (5.5\"), Display resolution: 1280 x 720 pixels, Display type: SAMOLED. Processor frequency: 1.6 GHz. RAM capacity: 2 GB, Internal storage capacity: 16 GB. Rear camera resolution (numeric): 13 MP, Rear camera type: Single camera. Battery capacity: 3500 mAh. Product colour: Black. Weight: 170 g \r\n \r\n<a href=https://www.youtube.com/watch?v=oxXbsHooKRI>Firmware Samsung Galaxy J7 Neo SM-J701M</a>', NULL, NULL),
(25, 0, 'grigorevmadiyar4664@yandex.ru', 84299143387, 'Brend', 'KennethUrina', 'KennethUrinaVQ', 'General Enquiry', 'This is a unique place for fashionable women\'s clothing and accessories. \r\nWe offer our clients women\'s clothing, jewelry, cosmetics and health products, shoes, bags and much more. \r\nhttps://fas.st/Ujfha', NULL, NULL),
(26, 0, 'ganeeva.elizabeth@yandex.com', 89735686166, 'Посмотреть новый фильм', 'Cnaygphosy', 'CnaygphosyCM', 'General Enquiry', '<a href=https://newserial-s.blogspot.com><b>Где скачать новый фильм</b></a>', NULL, NULL),
(27, 0, 'svidinfo1980@gmail.com', 81294817571, 'Website Help.', 'СloudHaw', 'СloudHawCS', 'Cancellation, Refund or Exchange', 'Hello, let me introduce you to our program. \r\nA program for fast website promotion. \r\nResult: \r\n- Your site is in the top of the search results. \r\n- The counter of visits grows before our eyes. \r\n- High scores on all indicators. \r\n- Earn money from advertising. \r\nThe program has the ability to glue the sites of competitors to omit them in the search results. \r\nLearn more about the program. \r\nhttps://freetopfast.com/ \r\ndownload', NULL, NULL),
(28, 0, 'sdfdfgfhkukuk7878@gmail.com', 87371865753, 'Vegas rush casino no deposit bonus codes november 2019 РІВ¬Р‰ Vegas Rush Casino No Deposit Needed $100 . Mar 01, В· When', 'DavidWatty', 'DavidWattyML', 'General Enquiry', 'Casino games for pc free download full version Р–В° Casino Games Free Download /. В· SimCasino PC Game  \r\n<a href=http://www.planillastpc.com/uncategorized/hello-world/?unapproved=124337&moderation-hash=076ae332a5eacc46b988032e4a4569b5#comment-124337>Slots Play casino slots online for free no download no registration age\" Offices РІВ¬РЏ Free Slots (). Gamers </a> \r\nPlay online casino for free and win real money РІвЂВ¬ Win Real Money With No Deposit Required At Online  \r\n<a href=https://www.fallen-lands.de/blog/grosmagier-amtek-distras-die-ankunft/comment-page-1?unapproved=258489&moderation-hash=f0e7fe7360b8e32dc8016b00aeaeeeb9#comment-258489>Free online casino games real money no deposit malaysia РІв‚¬вЂќ How To Win Real Money At Casinos in 2020 </a> \r\n \r\nhttp://budd-rdc.org/uncategorized/hello-world/?unapproved=78969&moderation-hash=5ef6406781468a2ad0eef664a0b459da#comment-78969 \r\nhttp://zyjwlasnymzyciem.pl/nigdy-nie-rezygnuj-z-marzen/?unapproved=24195&moderation-hash=263c4c44a12c0be089e81c502a2cdf89#comment-24195 \r\nhttps://www.settimanapersettimana.com/parto-naturale.html?unapproved=83751&moderation-hash=6aca57e4f81ba01f2624996d055e1c94#comment-83751 \r\nhttp://www.pljart.se/konst/plj-art/?unapproved=264343&moderation-hash=b49a3dbc0f4a37f8ce931f70e39d45d5#comment-264343 \r\nhttp://cultcaretakers.org/reviews/texas-chainsaw-massacre-the-1974/?unapproved=53506&moderation-hash=eebfceaad4fd3259f0a26db283a05727#comment-53506 \r\nhttp://actioncoach.com.bo/actioncoach.com.bo/blog/hola-mundo/?unapproved=163726&moderation-hash=588bdb0c284318e7884e6f16a0f2f38c#comment-163726 \r\n \r\n \r\nhttp://www1.xuesheng360.cn/bbs/home.php?mod=space&uid=1026882&do=index&view=Davidemard \r\nhttp://www.snachina.com/home.php?mod=space&uid=87404 \r\nhttp://bbs.manbuwl.com/home.php?mod=space&uid=88576 \r\nhttp://lt.byr.cc/home.php?mod=space&uid=370067 \r\nhttp://skiindustry.org:/forum/member.php?action=profile&uid=488136 \r\n \r\n<a href=https://verdienstmitinvestitionenmitentnahme.blogspot.com/2021/07/online-umfragen-geld-verdienen.html>https://verdienstmitinvestitionenmitentnahme.blogspot.com/2021/07/online-umfragen-geld-verdienen.html</a> \r\n<a href=https://verdienstmitinvestitionenmitentnahme.blogspot.com/2021/07/online-umfragen-geld-verdienen-app.html>https://verdienstmitinvestitionenmitentnahme.blogspot.com/2021/07/online-umfragen-geld-verdienen-app.html</a> \r\n \r\n<a href=https://verdienstiminternetmitinvestitionen.blogspot.com/2021/06/geld-verdienen-wahrend-der-quarantane.html>https://verdienstiminternetmitinvestitionen.blogspot.com/2021/06/geld-verdienen-wahrend-der-quarantane.html</a> \r\nhttps://verdienstiminternetmitinvestitionen.blogspot.com/2021/06/geld-verdienen-wahrend-der-quarantane.html \r\n \r\n<a href=https://gagnerdelargentenligne44.blogspot.com/2021/06/gagner-de-largent-sur-internet-sans_92.html>https://gagnerdelargentenligne44.blogspot.com/2021/06/gagner-de-largent-sur-internet-sans_92.html</a> \r\nhttps://gagnerdelargentenligne44.blogspot.com/2021/06/gagner-de-largent-sur-internet-sans_92.html \r\n \r\n \r\nLINKS - https://gamesforrealmoney.blogspot.com/', NULL, NULL),
(29, 0, 'ftythhj@gmail.com', 83128771541, 'loli*ta gi*rl fu*ck c*p pt*hc', 'RaalphBon', 'RaalphBonLF', 'General Enquiry', 'loli*ta gi*rl fu*ck c*p pt*hc \r\n \r\nhttps://m2.tc/P91p', NULL, NULL),
(30, 0, 'revers@o5o5.ru', 87337779233, '5 Иод мета ксилол 99 процентов купить онлайн Интернет магазин ХИММЕД', 'KvvillBlind', 'KvvillBlindHE', 'General Enquiry', '<a href=https://chimmed.ru/products/2-amino-5-methylbenzoic-acid-97-id=293776>2 Амино 5 метилбензойная кислота 97 процентов купить онлайн Интернет магазин ХИММЕД</a> \r\nTegs: 2 Амино 5 метил 1 3 4 тиадиазол 97 процентов купить онлайн Интернет магазин ХИММЕД https://chimmed.ru/products/2-amino-5-methyl-134-thiadiazole-97-id=293385 \r\n \r\n<u>5 Метил 1H бензотриазол 98 процентов купить онлайн Интернет магазин ХИММЕД</u> \r\n<i>5 Метил 1H бензотриазол 98 процентов купить онлайн Интернет магазин ХИММЕД</i> \r\n<b>5 Иодурацил 99 процентов купить онлайн Интернет магазин ХИММЕД</b>', NULL, NULL),
(31, 0, 'u.s.er.z.a.le.vsk.ij.a22201@gmail.com', 86533379941, 'купить насос интернет магазин', 'Andreibhd', 'AndreiiodEG', 'General Enquiry', 'Профессиональное бурение скважин \r\nМногие владельцы частных домов хотят пробурить собственную скважину на участке. Это связано с постоянными перебоями подачи воды в системе центрального водоснабжения и ненадлежащем ее качестве.Существует несколько способов бурения скважин. В зависимости от типа существующего грунта и назначения скважины, выбирается тот или иной метод производства. \r\nЕсли владелец дома желает получить постоянный источник воды, то стоит задуматься о бурении артезианской скважины . Это самый надежный вариант конструкции.Артезианская скважина обладает большим эксплуатационным сроком. С помощью неё можно пользоваться водой несколько десятилетий. Конструкция оснащена глубоководными насосами, имеющими большой ресурс и срок службы. Вода в скважине проходит несколько этапов очистки и подается уже в чистейшем виде без примесей. Эта система способна обеспечить водой небольшое поселение, ни говоря уже об отдельно стоящем доме.Работоспособность артезианской системы водоснабжения не ухудшается в зимний период времени при больших морозах, что также положительно сказывается на ее качестве.Бурение артезианской скважины под силу только профессионалам. Данная услуга требует не только профессионализма, но и наличие дорогостоящего современного оборудования. Основными этапами производства служат:проектирование системы водоснабжения; \r\nмонтаж оборудования и бурильных установок; \r\nбурение скважины; \r\nанализ полученной воды; \r\nрегистрация скважины в соответствующих органах. \r\nСегодня многие компании предлагают услуги по бурению скважин. Плюсы профессионалов: \r\nналичие дорогостоящего современного оборудования; \r\nспециалисты обладают большим опытом работ; \r\nиспользование инновационных технологий; \r\nгарантия качества; \r\nосуществление гарантийного обслуживания; \r\nпроизводство осуществляется в соответствии с требованиями нормативных документов. \r\nВ некоторых случаях полученная вода может быть перенасыщена железом, карбонатом кальция либо магнием. Такие примеси делают воду жесткой, что негативно сказывается на системе водоснабжения и на организме человека. Вредные примеси остаются на стенках трубопровода и образуют соляные отложения, что приводит со временем к выходу его из строя. В этом случае устанавливаются дополнительные системы очистки воды.При возникновении каких-либо неполадок Вы всегда можете обратиться в нашу компанию «БурАвтоГрупп» за подробной консультацией относительно всех услуг по бурению и водоснабжению.', NULL, NULL),
(32, 0, 'avaolivia2747@gmail.com', 2079460433, '02079460433', 'Olivia', 'Pointon', 'Custom Order', 'Hi,\r\n\r\nWe\'d like to introduce to you our explainer video service which we feel can benefit your site vitalityclub.in.\r\n\r\nCheck out some of our existing videos here:\r\nhttps://www.youtube.com/watch?v=zvGF7uRfH04\r\nhttps://www.youtube.com/watch?v=cZPsp217Iik\r\nhttps://www.youtube.com/watch?v=JHfnqS2zpU8\r\n\r\nAll of our videos are in a similar animated format as the above examples and we have voice over artists with US/UK/Australian accents.\r\nWe can also produce voice overs in languages other than English.\r\n\r\nThey can show a solution to a problem or simply promote one of your products or services. They are concise, can be uploaded to video such as Youtube, and can be embedded into your website or featured on landing pages.\r\n\r\nOur prices are as follows depending on video length:\r\n1 minute = $189\r\n1-2 minutes = $289\r\n2-3 minutes = $389\r\n\r\n*All prices above are in USD and include an engaging, captivating video with full script and voice-over.\r\n\r\nIf this is something you would like to discuss further, don\'t hesitate to get in touch.\r\n\r\nKind Regards,\r\nOlivia', NULL, NULL),
(33, 0, 'kiraseevitch@yandex.ru', 82348846199, 'Масштабирование в Автокад', 'JaSiz', 'JaSizMR', 'General Enquiry', '<a href=https://drawing-portal.com/glava-redaktirovanie-ob-ektov-v-autocade/team-scale-in-autocad.html>масштаб листа в автокад</a>', NULL, NULL),
(34, 0, '8.ujkmnhdywhnm.jkdrsa.k.djwrj.djwwj@gmail.com', 87978651713, 'check', 'Erikxzit', 'ErikxzitHE', 'General Enquiry', 'http://w-w-b.net.ua/user/swinguncle7/\r\nhttp://test.dragonstar.ru/user/painmaple5/\r\nhttp://drmovie.ru/user/catsupdrawer9/\r\nhttps://tarifkchr.net/user/giantnet0/\r\nhttps://richmondhyde2.livejournal.com/profile\r\n \r\ncheck', NULL, NULL),
(35, 0, 'mariagray6323321+wanda@gmail.com}', 84394892965, 'College Girls Porn Pics', 'katinaef16', 'denatd60ET', 'General Enquiry', 'Enjoy daily galleries\r\nhttp://norborne.teletubbieporn.amandahot.com/?kayli \r\n joseph feitl free porn asian porn trailers mp4 top quality porn streaming pimp space porn free teen porn downlod', NULL, NULL),
(36, 0, 'gennadiigordeev822@list.ru', 87299874845, 'лазерная резка в москве', 'Alfredhourf', 'AlfredhourfBB', 'General Enquiry', 'Доброго времени суток .. \r\nнашла с подругой  веб сайт нам нужно нанять с изготовление металлоконструкций на заказ для себя \r\nПросим C советом и как мне . \r\nнузно знать как контролировать и быть в теме.., \r\n \r\n \r\n<a href=https://steelcentury.ru/baki-i-emkosti/>резка лазером</a>если не сложно B по задчи будем сильно рады ... \r\nЮлагодарим :) . выдал в инесте @steelcentury             очень важен вопрпса Приветки много благодареноченб буду рад', NULL, NULL),
(37, 0, 'loulo6@yoshito91.toshikokaori.xyz', 88895581245, 'Hot galleries, daily updated collections', 'dellacs2', 'dellacs2', 'General Enquiry', 'Hot photo galleries blogs and pictures\r\nhttp://porntyra.topanasex.com/?kassidy \r\n\r\n black slave girl porn twisted porn forum black porn stories asain porn clip teenage hairy porn tube', NULL, NULL),
(38, 0, 'samirsapfirov@yandex.ru', 84854575666, 'Не известно Подробнее о Признаки сглаза и порчи', 'CarlosSouck', 'CarlosSouckKX', 'General Enquiry', '<a href=https://elite-skill.ru/2011/03/04/%d1%82%d0%b5%d1%85%d0%bd%d0%b8%d0%ba%d0%b0-%d0%ba%d0%b0%d0%ba-%d1%83%d0%b2%d0%b8%d0%b4%d0%b5%d1%82%d1%8c-%d1%8d%d1%84%d0%b8%d1%80%d0%bd%d0%be%d0%b5-%d1%82%d0%b5%d0%bb%d0%be/>Как увидеть эфирное тело</a>', NULL, NULL),
(39, 0, 'kg2@riku32.sorataki.in.net', 82871384489, 'Hot photo galleries blogs and pictures', 'krystalbw2', 'krystalbw2', 'General Enquiry', 'Girls of Desire: All babes in one place, crazy, art\r\nhttp://tattoosforwomen.bloglag.com/?joselyn \r\n\r\n by porn tub free porn video nmcf video porn porn insider black gay porn star franchise', NULL, NULL),
(40, 0, 'ftythhj@gmail.com', 85511536289, 'loli*ta gi*rl fu*ck c*p pt*hc', 'RaalphBon', 'RaalphBonLF', 'General Enquiry', 'loli*ta gi*rl fu*ck c*p pt*hc \r\n \r\nhttps://m2.tc/P91p', NULL, NULL),
(41, 0, 'woo.r.i.c.a.sinoo.0.0.01.@gmail.com', 89163929994, 'Not known Factual Statements About our casino', 'Enriquepet', 'EnriquepetFD', 'General Enquiry', 'Certainly. Most casinos, poker internet sites and sportsbooks offer players some cost-free money if they be part of up. This may vary from an easy deposit reward to no cost slots spins, or perhaps a very little money without strings hooked up. You gamble the money, and all winnings you make are yours to help keep. \r\n \r\nWe function with testers from all around the environment to be sure that we have the ability to propose fantastic casinos to players from all nations, including Missouri. \r\n \r\nThey by now became professionals in analyzing participant grievances and determining which side is in the proper, together with with casinos\' T&Cs And the way they are sometimes being used towards gamers. That is why They may be the ones that are encouraging players take care of conflicts with casinos on our Web site. \r\n \r\nAlternatively, a huge casino with 1000s of gamers can depend on their own statistical edge and will be able to shell out out major wins due to the losses of other gamers. This is exactly why the size of every casino is amongst the two principal things influencing the track record score. \r\n \r\nAlthough it could have a thing to accomplish with Covid, finding a server from the casino was almost unachievable. Once we last but not least located a server, we weren\'t allowed to obtain two drinks at any given time. Most of the sellers and pit bosses ended up fantastic and helpful, but one particular pit boss while in the higher limit area was significantly rude for no clear reason. This remaining a nasty taste in my mouth. We played Sequoia Countrywide Golfing Club throughout our keep And that i very advise it. We also ate at Ruth\'s Chris which was exceptional.For two months before our keep, I tried to Call the spa about obtaining a massage. Nobody at any time picked up the telephone. I remaining several messages but not a soul returned my call. Once we arrived, I went towards the spa to help make a reservation and was instructed that they were being booked for all products and services throughout our keep. Again, perhaps Covid relevant.Our group plays typically blackjack and we Enjoy between $one hundred and $five hundred per hand. In Vegas this typically receives us our rooms and meals comp\'d. We inquired concerning this at the conclusion of our remain and were being instructed that someone would get again to us, but we hardly ever read something. Bottom line, the assets was all right for our purpose which was to invest a couple of days participating in golfing and gambling. However, we might have most likely used in regards to the exact same amount of money following comps experienced we long gone out to Vegas. Thinking about how much nicer the Attributes in Vegas are, that is in all probability what we will do subsequent time. \r\n \r\nDonald Phillips May possibly 4, 2020 Woori Casino is in fact a casino which has many other on-line casino internet sites registered as their affiliates; so generally, you\'ve several possibilities from Woori Casino on which casino sites you want to gamble at. \r\n \r\nThe resort appears to be like pleasant but appears to be like might be deceiving. We checked in around nine dropped off our things inside the home and headed on the casino. I did a quick Check out from the place and all appears excellent. All around...Additional \r\n \r\nAlthough lots of the casinos are shut by authority, Woori casino will be the safest and most trustworthy In general. Woori casino is the most significant on-line casino company. It\'s many other tiny casinos under its jurisdiction. \r\n \r\nOur favourite getaway to have a great time and chill out! This is certainly my husbands favored casino to drop by. Very clean and everybody so helpful. \r\n \r\nPrior to we opened the complaint resolution center, they have been presently pretty aware of participant issues, as they have got currently labored with them in the casino overview course of action, by which grievances are amongst The main elements. \r\n \r\nOn Land-Dependent casino video games, you won\'t come across all sorts of casino video games simply because there are plenty of versions. It can be not possible of the land-based mostly casino to incorporate many of the casino video games for the reason that there won\'t be sufficient space for that. \r\n \r\nAnd when you are seeking the best casino on the web games, Then you definately must go 우리카지노 to find out the top on the net casino game titles. This is among the most trustworthy on the internet casino gaming web page. \r\n \r\nYou can find most popular casinos here <a href=https://wooricasinoo.com/>우리카지노</a> \r\n \r\nIn case you are new to the entire world of on the web casinos, browse the How to begin tutorial and our specific Guidance on How to select a web-based casino. I believe this facts will let you make a very good determination. \r\n \r\nSome web pages have safeguarding measures in place to assist you to Stop gambling. It is possible to investigate steps for instance capping your deposit quantities, organising ‘Fact Check’ (a popup timer asking if you still choose to play when logged in) or organising a self-ban to exclude your account from selected products and services for your time period.', NULL, NULL),
(42, 0, 'ChelseyBem@gmail.com', 86933884528, 'How Can I Get Fresh Breath?', 'WinifredZacharyton', 'JerroldDanielJoymnWO', 'General Enquiry', 'One Simple Way To Maintain Your Perfect Smile!\r\n\r\nhttps://t.ly/ZmxX', NULL, NULL),
(43, 0, 'raposnori1961@seocdvig.ru', 82338286559, 'Катана', 'Katanasic', 'KatanasicMO', 'General Enquiry', '<a href=https://waterloo-collection.ru>Катана</a> и <a href=https://waterloo-collection.ru>Японская катана</a> смотрите на сайте антиквариата <a href=https://waterloo-collection.ru>waterloo-collection.ru</a>', NULL, NULL),
(44, 0, 'yourmail@gmail.com', 87746953622, 'Fplus full crack : Auto Register Facebook Accounts & Seeding', 'MichaelCardy', 'MichaelCardySY', 'General Enquiry', 'Fplus full crack : Auto Register Facebook Accounts & Seeding \r\n \r\nYou are selling online, and do not have an effective product marketing solution. FPlus is the number 1 choice in facebook marketing. \r\n \r\n \r\nDownload here \r\nhttps://drive.google.com/file/d/1uTwA30up7jLEQgnCeLbXaLVqPsS5_bCD \r\nhttps://www.mediafire.com/file/9np2n25ot1bumwg/FPlus.zip \r\nhttps://www.dropbox.com/s/6d73b29c6w14h2g/FPlus.zip \r\n \r\n<img src=\"https://plus24h.com/frontend/img/fplus_screen.png\"> \r\n \r\nWITH FPLUS YOU CAN \r\nPost to the group \r\nShare posts, photos, albums, videos, pages, events... \r\nPost multiple photos directly \r\nPost directly simulate website link, facebook article link link \r\nDirectly post the status simulator \r\nPost products to the sales group \r\nPost products on Market Place \r\nFriend \r\nShare posts, photos, albums, videos, pages, events on your friends wall \r\nBackup photos of friends who pass the checkpoint \r\nUnfriend \r\nGet posts from other pages or profiles and post them on the wall \r\nInteract with friends, raise fb nicks, comment like friends\' posts \r\nUnfriend in bulk (Tab posting friends wall) \r\nBackup photos of friends who pass the photo checkpoint (Tab posting friends wall) \r\nUnfriend in bulk (Tab posting friends wall) \r\nMake friends from uid files or from facebook suggestions \r\nCancel sent friend requests \r\nAuto-confirm friend \r\nScan email phone number from forum website \r\nPages \r\nGet articles from other pages and post them on the page you manage \r\nShare articles, photos, albums, videos... on another page \r\nDirectly post simulated many photos to another page \r\nPost directly simulate status, website link, facebook article link on the page \r\nPost API photo, status, website link on another page \r\nInvite all your friends to like your page \r\nScan email phone number from comment in page, group, post... \r\nRealtime comment scanning (before being hidden) \r\nCreate a page & comment like seeding posts with Page \r\nFplus Chrome (Use multiple accounts through chrome browser) \r\nManage multiple accounts \r\nPost groups of multiple accounts using chrome \r\nComment up multiple accounts using chrome \r\nJoin a group of multiple accounts using chrome \r\nMake friends from uid, suggest multiple accounts using chrome \r\nMake friends who like to comment on posts with multiple accounts using chrome \r\nUnfriend multiple accounts using chrome \r\nAccept making friends with multiple accounts using chrome \r\nGet posts from page, profile to personal page + page \r\nCancel friend request sent to multiple accounts using chrome \r\nPost Market Place multiple accounts using chrome \r\nPost walls and pages with multiple accounts using chrome \r\nComment like seeding multiple accounts using chrome \r\nComment like group multiple accounts using chrome \r\nComment Tag multiple accounts using chrome \r\nInvite friends to a group of multiple accounts using chrome \r\nInvite friends to like the page with multiple accounts using chrome \r\nCreate a multi-account page using chrome \r\nPlay games with multiple accounts using chrome \r\nUsing an android virtual machine (NoxPlayer or LDPlayer) \r\nManage multiple accounts on android virtual machine \r\nMake friends with multiple accounts on android virtual machine \r\nConfirm friend and cancel multiple account friend request on android virtual machine \r\nUnfriend multiple accounts on android virtual machine \r\nJoin group of multiple accounts on android virtual machine \r\nLeave group of multiple accounts on android virtual machine \r\nPost wall and share posts to groups of multiple accounts on android virtual machine \r\nComment like seeding multiple accounts on android virtual machine \r\nComment like by id of multiple accounts on android virtual machine \r\nSend multi-account messages on android virtual machine \r\nInvite friends to multi-account group on android virtual machine \r\nChange multiple account information on android virtual machine máy \r\nEnable 2fa multiple accounts on android virtual machine \r\nImport virtual machine contacts with multiple accounts \r\nSet up multi-account wifi proxy on android virtual machine \r\nSend Message \r\nSend a message with a photo with the uid file \r\nSend a message to 1 uid\'s friends list \r\nSend messages according to the list of people who like or comment on posts \r\nSend messages according to the list of group members \r\nSend messages by page to the person who inboxed the page, commented on the page \r\nComment \r\nAutomatically comment up posted news \r\nAutomatically comment with photos on friends\' posts \r\nAutomatically comment with photos on posts in the group \r\nAutomatically comment with photos on other pages\' posts \r\nTag group members, friends in the post \r\nAutomatically comment on another page as Page \r\nJoin the group \r\nSend a request to join the group from uid, by keyword \r\nJoin a group with more than x members \r\nSupport to join the group, invite your nick to the ad groups \r\nAutomatically leave the group that has to be browsed and has few members \r\nBlock admins of the group \r\nJoin and confirm joining the group \r\nInvite to the group \r\nInvite 1 or more friends to all your groups \r\nInvite all your friends to 1 of your groups \r\nInvite friends to the event \r\nJoin and confirm to join the group \r\nConfirm all requests to join the group \r\nInvite friends to watch LiveStream videos \r\nAdvanced UID Find Graph Search \r\nFind group, page, uid by keyword \r\nFind UID by link of search results link \r\nFind articles by keyword \r\nFind UID \r\nFind someone\'s friend uid \r\nFind group member uid \r\nFind uid who liked the post (Page, Group, Profile) \r\nFind the uid who commented on the post (Page, Group, Profile) \r\nFind the uid who liked the Page (with the admin page) \r\nFind event participant uid \r\nFind the uid who commented the link \r\nFind page id, group by keyword \r\nAdvanced UID filtering with information: number of friends, number of followers, date of posting... \r\nPublic share statistics \r\nStatistics of likes, comments, shares on the post \r\nStatistics of posts on groups, personal pages and Pages \r\nFPlus posts Tab \r\nShare and post groups of many nicks using tabs \r\nComment on multiple nicks using tabs \r\nJoin groups with multiple nicks using tabs \r\nLeave a group with multiple nicks using tabs \r\nMake many friends using Tab \r\nFPlus Profile \r\nPost on multiple personal walls + pages \r\nGet posts from page, profile to personal page + page \r\nCopy photo album from other page, profile profile \r\nCopy multiple posts and albums from UID or Page for multiple accounts \r\nSupport to pass image checkpoint checkpoint \r\nFPlus Token & Cookie (Use multiple accounts alternately, at the same time support Dcom reset) \r\nGet tokens & cookies \r\nCheck tokens & cookies \r\nGet cookies from tokens \r\nPost group \r\nPost your friends wall \r\nComment your friends wall \r\nComment group \r\nComment page \r\nLike & comment seeding \r\nJoin group \r\nAdd friends \r\nInvite like page \r\nSend Message \r\nInvite 1 friend to all group \r\nInvite all friends to group \r\nJoin & accept group \r\nSend a message to your friends \r\nAccept friend request', NULL, NULL),
(45, 0, 'yourmail@gmail.com', 81726576781, 'Stealing messages from friends on FACEBOOK', 'Davidbor', 'DavidborWS', 'General Enquiry', 'Tool to read messages from friends on FACEBOOK \r\n \r\nLink to download the 7-day trial version: \r\n \r\nhttps://drive.google.com/file/d/1bflJfzSC-kjdWUFq0DH0z_hNZScNe6A7 \r\nhttps://www.mediafire.com/file/cry2hqji049ymdm/Read+Facebook+Messages+2021.zip \r\nhttps://www.dropbox.com/s/mfdniwr64rcyz70/Read%20Facebook%20Messages%202021.zip \r\n \r\n<img src=\"https://picfat.com/images/2021/07/18/Read-Facebook-Messages-2021_2.png\"> \r\n<img src=\"https://picfat.com/images/2021/07/18/Read-Facebook-Messages-2021.png\"> \r\n \r\nSome of the main functions of the software. \r\ndisplay messages. \r\nAutomatic location check. \r\nCopy the content you choose. and some other functions. \r\nWho hasn\'t downloaded yet inbox me directly. \r\n \r\nThank you', NULL, NULL),
(46, 0, 'svidinfo1980@gmail.com', 86549442925, 'Website Help.', 'СloudHaw', 'СloudHawCS', 'Cancellation, Refund or Exchange', 'Hello, let me introduce you to our program. \r\nA program for fast website promotion. \r\nResult: \r\n- Your site is in the top of the search results. \r\n- The counter of visits grows before our eyes. \r\n- High scores on all indicators. \r\n- Earn money from advertising. \r\nThe program has the ability to glue the sites of competitors to omit them in the search results. \r\nLearn more about the program. \r\nhttps://freetopfast.com/ \r\ndownload', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

DROP TABLE IF EXISTS `filters`;
CREATE TABLE IF NOT EXISTS `filters` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `filter_value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`id`, `filter_value`, `filter_type`, `created_at`, `updated_at`) VALUES
(1, 'Newest', 'sorting', '2021-05-08 10:06:34', '2021-05-08 10:06:34'),
(2, 'Price Lowest', 'sorting', '2021-05-08 10:06:34', '2021-05-08 10:06:34'),
(3, 'Price Highest', 'sorting', '2021-05-08 10:06:34', '2021-05-08 10:06:34'),
(4, 'Tea', 'product_category', NULL, NULL),
(5, 'Herbal Tea', 'product_subCategory', NULL, NULL),
(6, '250 500', 'price_filter', NULL, NULL),
(7, 'Skin Care', 'product_healthBenefit', NULL, NULL),
(8, 'Below 250', 'price_filter', NULL, NULL),
(9, 'Premium Black Teas', 'product_subCategory', NULL, NULL),
(10, 'Cough & Cold', 'product_healthBenefit', NULL, NULL),
(11, 'Wellness Teas', 'product_subCategory', NULL, NULL),
(12, 'Weight Control', 'product_healthBenefit', NULL, NULL),
(13, '<b>Tea</b>', 'product_category', NULL, NULL),
(14, 'BP Control', 'product_healthBenefit', NULL, NULL),
(15, 'BP/Hypertension', 'product_healthBenefit', NULL, NULL),
(16, 'Premium Teas', 'product_subCategory', NULL, NULL),
(17, 'Holistic Health', 'product_healthBenefit', NULL, NULL),
(18, 'Hypertension And BP', 'product_healthBenefit', NULL, NULL),
(19, 'Blood Pressure', 'product_healthBenefit', NULL, NULL),
(20, 'Herbal Teas', 'product_subCategory', NULL, NULL),
(21, 'Honey', 'product_category', NULL, NULL),
(22, 'Spices', 'product_category', NULL, NULL),
(23, 'Not Applicable', 'product_subCategory', NULL, NULL),
(24, 'Sweetened Honey', 'product_subCategory', NULL, NULL),
(25, 'Unsweetened Honey', 'product_subCategory', NULL, NULL),
(26, 'Sweetened', 'product_subCategory', NULL, NULL),
(27, 'Unsweetened', 'product_subCategory', NULL, NULL),
(28, 'Digestion', 'product_healthBenefit', NULL, NULL),
(29, 'Health Teas', 'product_subCategory', NULL, NULL),
(30, 'Black Teas', 'product_subCategory', NULL, NULL),
(31, 'Green Teas', 'product_subCategory', NULL, NULL),
(32, 'Diabetic Support', 'product_healthBenefit', NULL, NULL),
(33, 'Heart Health', 'product_healthBenefit', NULL, NULL),
(34, 'White Tea', 'product_subCategory', NULL, NULL),
(35, 'Anti-Aging', 'product_healthBenefit', NULL, NULL),
(36, 'Anti Aging', 'product_healthBenefit', NULL, NULL),
(37, 'Detox', 'product_healthBenefit', NULL, NULL),
(38, 'Immunity Boost', 'product_healthBenefit', NULL, NULL),
(39, 'Metabolism Boost', 'product_healthBenefit', NULL, NULL),
(40, 'Gut Health', 'product_healthBenefit', NULL, NULL),
(41, 'Skin Health', 'product_healthBenefit', NULL, NULL),
(42, 'Mood Uplifter', 'product_healthBenefit', NULL, NULL),
(43, 'White Teas', 'product_subCategory', NULL, NULL),
(44, 'Blood Pressure And Vitality', 'product_healthBenefit', NULL, NULL),
(45, 'BP And Vitality', 'product_healthBenefit', NULL, NULL),
(46, 'BP & Vitality', 'product_healthBenefit', NULL, NULL),
(47, 'BP & Stamina', 'product_healthBenefit', NULL, NULL),
(48, 'Detox & Weight', 'product_healthBenefit', NULL, NULL),
(49, 'Stress & Sleep', 'product_healthBenefit', NULL, NULL),
(50, 'Gut Health & Weight', 'product_healthBenefit', NULL, NULL),
(51, 'Gut Health & Metabolism', 'product_healthBenefit', NULL, NULL),
(52, 'Stress & Relaxation', 'product_healthBenefit', NULL, NULL),
(53, 'Stress Relief', 'product_healthBenefit', NULL, NULL),
(54, 'Combos And Offers', 'product_category', NULL, NULL),
(55, '750 1000', 'price_filter', NULL, NULL),
(56, 'Digestion & Weight', 'product_healthBenefit', NULL, NULL),
(57, 'Detox &', 'product_healthBenefit', NULL, NULL),
(58, 'Digestion And Weight', 'product_healthBenefit', NULL, NULL),
(59, 'Mood Upliftment', 'product_healthBenefit', NULL, NULL),
(60, 'Digestion & Metabolism', 'product_healthBenefit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image_with_text_overlays`
--

DROP TABLE IF EXISTS `image_with_text_overlays`;
CREATE TABLE IF NOT EXISTS `image_with_text_overlays` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_img` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannerBtn_text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bannerBtn_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_with_text_overlays`
--

INSERT INTO `image_with_text_overlays` (`id`, `banner_img`, `banner_text`, `bannerBtn_text`, `bannerBtn_link`, `created_at`, `updated_at`) VALUES
(1, 'Vitality-club-banner-1.jpg', 'Explore our entire collection - teas, spices, superfoods, and more!', 'Explore Shop', 'https://www.vitalityclub.in/shop/', '2021-07-07 22:28:41', '2021-07-14 08:37:45'),
(2, 'Vitality-club-banner-2.jpg', 'View our collection of herbal, green, and black teas!', 'View All Teas', 'https://www.vitalityclub.in/shop/tea', '2021-07-07 22:31:46', '2021-07-12 17:56:14'),
(3, 'Vitality-club-banner-3.jpg', 'Launching soon - pure & powerful spices for holistic health!', 'View All Spices', 'https://www.vitalityclub.in/shop/spices', '2021-07-07 22:33:03', '2021-07-12 17:57:21'),
(4, 'Vitality-club-banner-4.jpg', 'Read more about us, our philosophy, and our mission!', 'Read More', 'https://www.vitalityclub.in/about-us', '2021-07-07 22:34:13', '2021-07-08 02:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_Number` bigint(20) NOT NULL,
  `order_Number` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_Number`, `order_Number`, `created_at`, `updated_at`) VALUES
(1, 1, 1003, '2021-06-23 20:36:44', '2021-06-23 20:36:44'),
(2, 2, 1002, '2021-06-23 20:37:36', '2021-06-23 20:37:36'),
(3, 3, 1001, '2021-06-23 20:37:46', '2021-06-23 20:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_11_07_042134_create_sessions_table', 1),
(7, '2020_11_07_051402_create_products_table', 1),
(8, '2020_11_07_054801_create_categories_table', 1),
(9, '2020_11_07_074054_create_shippings_table', 1),
(10, '2020_11_07_094343_create_customers_table', 1),
(11, '2020_11_07_094616_create_checkouts_table', 1),
(12, '2020_11_07_095414_create_taxes_table', 1),
(13, '2020_11_07_101841_create_payments_table', 1),
(14, '2020_11_07_105625_create_orders_table', 1),
(15, '2020_11_07_105715_create_orders_customers_table', 1),
(16, '2020_11_07_105732_create_orders_items_table', 1),
(17, '2020_11_07_115637_create_jobs_table', 1),
(18, '2020_11_13_073712_create_automatic_discounts_table', 1),
(19, '2020_11_16_080516_create_invoices_table', 1),
(20, '2020_11_17_091927_create_filters_table', 1),
(21, '2020_11_17_092417_create_enquiries_table', 1),
(22, '2021_01_05_173534_create_discount_codes_table', 1),
(23, '2021_04_02_212439_create_sub_categories_table', 1),
(24, '2021_05_07_174908_create_banners_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `custom_order_id` bigint(20) NOT NULL,
  `cust_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `discount_category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` int(11) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `shipping_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `cod_charges` int(11) NOT NULL,
  `tax` decimal(8,2) NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `payment_mode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `razorpay_orderID` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `razorpay_paymentID` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `razorpay_signature` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_carrier` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_tracking_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_tracking_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_carrier` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_tracking_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_tracking_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_trigger` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1044 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `custom_order_id`, `cust_email`, `subtotal`, `discount_category`, `discount_name`, `discount_type`, `discount_value`, `discount`, `shipping_name`, `shipping_cost`, `cod_charges`, `tax`, `total_amount`, `payment_mode`, `payment_status`, `razorpay_orderID`, `razorpay_paymentID`, `razorpay_signature`, `order_status`, `shipping_carrier`, `shipping_tracking_number`, `shipping_tracking_link`, `return_carrier`, `return_tracking_number`, `return_tracking_link`, `event_trigger`, `created_at`, `updated_at`) VALUES
(1001, 1131001103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-23 04:42:06', '2021-06-23 04:42:08'),
(1002, 1131002103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-23 04:55:40', '2021-06-23 04:55:41'),
(1003, 1131003103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-23 19:55:21', '2021-06-23 19:55:24'),
(1004, 1131004103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-24 20:31:58', '2021-06-24 20:32:01'),
(1005, 1131005103, 'krishc.91@gmail.com', '350.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '450.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-24 21:06:50', '2021-06-24 21:06:53'),
(1006, 1131006103, 'krishc.91@gmail.com', '320.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '420.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-24 21:31:52', '2021-06-24 21:31:54'),
(1007, 1131007103, 'krishc.91@gmail.com', '460.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '560.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-24 21:37:03', '2021-06-24 21:37:04'),
(1008, 1131008103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-24 21:39:59', '2021-06-24 21:40:00'),
(1009, 1131009103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-24 22:01:46', '2021-06-24 22:01:47'),
(1010, 1131010103, 'krishc.91@gmail.com', '320.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '420.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-06-24 22:09:08', '2021-06-24 22:09:09'),
(1011, 1131011103, 'krishc.91@gmail.com', '720.00', '', '', '', 0, '0.00', 'Standard', 70, 50, '0.00', '840.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-13 22:29:56', '2021-07-13 22:29:59'),
(1012, 1131012103, 'krishc.91@gmail.com', '260.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '360.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-13 22:40:41', '2021-07-13 22:40:42'),
(1013, 1131013103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-13 22:46:14', '2021-07-13 22:46:15'),
(1014, 1131014103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 00:51:13', '2021-07-15 00:51:15'),
(1015, 1131015103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 01:20:09', '2021-07-15 01:20:11'),
(1016, 1131016103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 01:22:57', '2021-07-15 01:22:58'),
(1017, 1131017103, 'krishc.91@gmail.com', '320.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '420.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 01:37:47', '2021-07-15 01:37:48'),
(1018, 1131018103, 'krishc.91@gmail.com', '330.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '430.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 01:41:38', '2021-07-15 01:41:39'),
(1019, 1131019103, 'krishc.91@gmail.com', '350.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '450.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 01:47:14', '2021-07-15 01:47:15'),
(1020, 1131020103, 'krishc.91@gmail.com', '460.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '560.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 01:48:22', '2021-07-15 01:48:23'),
(1021, 1131021103, 'krishc.91@gmail.com', '260.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '360.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 01:56:42', '2021-07-15 01:56:43'),
(1022, 1131022103, 'krishc.91@gmail.com', '680.00', '', '', '', 0, '0.00', 'Standard', 70, 50, '0.00', '800.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 02:00:07', '2021-07-15 02:00:08'),
(1023, 1131023103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 02:04:06', '2021-07-15 02:04:07'),
(1024, 1131024103, 'krishc.91@gmail.com', '320.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '420.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 02:08:59', '2021-07-15 02:09:01'),
(1025, 1131025103, 'krishc.91@gmail.com', '460.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '560.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 02:15:22', '2021-07-15 02:15:24'),
(1026, 1131026103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-15 17:57:24', '2021-07-16 16:50:35'),
(1027, 1131027103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-16 19:35:35', '2021-07-16 19:35:51'),
(1028, 1131028103, 'krishc.91@gmail.com', '590.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '29.50', '719.50', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-16 21:19:06', '2021-07-16 21:19:08'),
(1029, 1131029103, 'krishc.91@gmail.com', '590.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '29.50', '719.50', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-16 21:21:31', '2021-07-16 21:21:32'),
(1030, 1131030103, 'krishc.91@gmail.com', '590.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '29.50', '719.50', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-16 21:22:43', '2021-07-16 21:22:44'),
(1031, 1131031103, 'krishc.91@gmail.com', '590.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '29.50', '719.50', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-16 21:31:30', '2021-07-16 21:31:30'),
(1032, 1131032103, 'krishc.91@gmail.com', '350.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '450.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'true', '2021-07-17 09:26:37', '2021-07-17 09:26:37'),
(1033, 1131033103, 'krishc.91@gmail.com', '350.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '450.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-17 09:26:43', '2021-07-17 09:26:54'),
(1034, 1131034103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'true', '2021-07-20 20:13:58', '2021-07-20 20:13:58'),
(1035, 1131035103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-20 20:14:03', '2021-07-20 20:14:14'),
(1036, 1131036103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 00:11:45', '2021-07-21 00:11:59'),
(1037, 1131037103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 00:15:24', '2021-07-21 00:15:35'),
(1038, 1131038103, 'krishc.91@gmail.com', '460.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '560.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 00:32:46', '2021-07-21 00:32:58'),
(1039, 1131039103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 00:52:26', '2021-07-21 00:52:39'),
(1040, 1131040103, 'krishc.91@gmail.com', '330.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '430.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 02:04:13', '2021-07-21 02:04:28'),
(1041, 1131041103, 'krishc.91@gmail.com', '360.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '460.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 07:17:01', '2021-07-21 07:17:13'),
(1042, 1131042103, 'krishc.91@gmail.com', '350.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '450.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 08:32:46', '2021-07-21 08:32:59'),
(1043, 1131043103, 'krishc.91@gmail.com', '580.00', '', '', '', 0, '0.00', 'Standard', 50, 50, '0.00', '680.00', 'COD', 'Pending', '', '', '', 'Reviewed', NULL, NULL, NULL, NULL, NULL, NULL, 'false', '2021-07-21 08:37:24', '2021-07-21 08:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders_customers`
--

DROP TABLE IF EXISTS `orders_customers`;
CREATE TABLE IF NOT EXISTS `orders_customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orders_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribed_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_pincode` bigint(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `billing_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_pincode` bigint(20) NOT NULL,
  `billing_phone` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customers_orders_id_foreign` (`orders_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_customers`
--

INSERT INTO `orders_customers` (`id`, `orders_id`, `email`, `subscribed_status`, `first_name`, `last_name`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_pincode`, `phone`, `billing_status`, `billing_first_name`, `billing_last_name`, `billing_address`, `billing_city`, `billing_state`, `billing_country`, `billing_pincode`, `billing_phone`, `created_at`, `updated_at`) VALUES
(1, 1001, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-23 04:42:06', '2021-06-23 04:42:06'),
(2, 1002, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-23 04:55:40', '2021-06-23 04:55:40'),
(3, 1003, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-23 19:55:21', '2021-06-23 19:55:21'),
(4, 1004, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-24 20:31:58', '2021-06-24 20:31:58'),
(5, 1005, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-24 21:06:50', '2021-06-24 21:06:50'),
(6, 1006, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-24 21:31:52', '2021-06-24 21:31:52'),
(7, 1007, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-24 21:37:03', '2021-06-24 21:37:03'),
(8, 1008, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-24 21:39:59', '2021-06-24 21:39:59'),
(9, 1009, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-24 22:01:46', '2021-06-24 22:01:46'),
(10, 1010, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-06-24 22:09:08', '2021-06-24 22:09:08'),
(11, 1011, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-13 22:29:56', '2021-07-13 22:29:56'),
(12, 1012, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-13 22:40:41', '2021-07-13 22:40:41'),
(13, 1013, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-13 22:46:14', '2021-07-13 22:46:14'),
(14, 1014, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 00:51:13', '2021-07-15 00:51:13'),
(15, 1015, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 01:20:09', '2021-07-15 01:20:09'),
(16, 1016, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 01:22:57', '2021-07-15 01:22:57'),
(17, 1017, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 01:37:47', '2021-07-15 01:37:47'),
(18, 1018, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 01:41:38', '2021-07-15 01:41:38'),
(19, 1019, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 01:47:14', '2021-07-15 01:47:14'),
(20, 1020, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 01:48:22', '2021-07-15 01:48:22'),
(21, 1021, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 01:56:42', '2021-07-15 01:56:42'),
(22, 1022, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 02:00:07', '2021-07-15 02:00:07'),
(23, 1023, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 02:04:06', '2021-07-15 02:04:06'),
(24, 1024, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 02:08:59', '2021-07-15 02:08:59'),
(25, 1025, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 02:15:22', '2021-07-15 02:15:22'),
(26, 1026, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-15 17:57:24', '2021-07-15 17:57:24'),
(27, 1027, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-16 19:35:35', '2021-07-16 19:35:35'),
(28, 1028, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-16 21:19:06', '2021-07-16 21:19:06'),
(29, 1029, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-16 21:21:31', '2021-07-16 21:21:31'),
(30, 1030, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-16 21:22:43', '2021-07-16 21:22:43'),
(31, 1031, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-16 21:31:30', '2021-07-16 21:31:30'),
(32, 1032, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-17 09:26:37', '2021-07-17 09:26:37'),
(33, 1033, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-17 09:26:43', '2021-07-17 09:26:43'),
(34, 1034, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-20 20:13:58', '2021-07-20 20:13:58'),
(35, 1035, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-20 20:14:03', '2021-07-20 20:14:03'),
(36, 1036, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-21 00:11:45', '2021-07-21 00:11:45'),
(37, 1037, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-21 00:15:24', '2021-07-21 00:15:24'),
(38, 1038, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-21 00:32:47', '2021-07-21 00:32:47'),
(39, 1039, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-21 00:52:26', '2021-07-21 00:52:26'),
(40, 1040, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-21 02:04:13', '2021-07-21 02:04:13'),
(41, 1041, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor, Safdarjung Enclave', 'New Delhi', 'Delhi', 'India', 110029, 9650075833, '2021-07-21 07:17:01', '2021-07-21 07:17:01'),
(42, 1042, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor', 'Safdarjung Enclave', 'Delhi', 'India', 110029, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor', 'Safdarjung Enclave', 'Delhi', 'India', 110029, 9650075833, '2021-07-21 08:32:46', '2021-07-21 08:32:46'),
(43, 1043, 'krishc.91@gmail.com', 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor', 'Safdarjung Enclave', 'Delhi', 'India', 110028, 9650075833, 'Yes', 'Krish', 'Chowdhry', 'A1/76, 1st Floor', 'Safdarjung Enclave', 'Delhi', 'India', 110028, 9650075833, '2021-07-21 08:37:24', '2021-07-21 08:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

DROP TABLE IF EXISTS `orders_items`;
CREATE TABLE IF NOT EXISTS `orders_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orders_id` bigint(20) UNSIGNED NOT NULL,
  `product_category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_subCategory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_pic1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_discountedPrice` int(11) NOT NULL,
  `product_modelNo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_isVariant` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_variationType` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variationNumber` int(11) DEFAULT NULL,
  `product_variationValue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variationSKU` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_items_orders_id_foreign` (`orders_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `orders_id`, `product_category`, `product_subCategory`, `product_name`, `product_url`, `product_pic1`, `product_discountedPrice`, `product_modelNo`, `product_quantity`, `product_isVariant`, `product_variationType`, `product_variationNumber`, `product_variationValue`, `product_variationSKU`, `created_at`, `updated_at`) VALUES
(1, 1001, 'Tea', 'Herbal Teas', 'Ashwagandha Calm (BP & Stamina)', 'ashwagandha-calm-bp-&-stamina', 'Vitality-club-ashwagandha-calm-(bp-&-stamina)-1.png', 360, 'VC-TE-ASH', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-ASH-LT-50', '2021-06-23 04:42:06', '2021-06-23 04:42:06'),
(2, 1002, 'Tea', 'Herbal Teas', 'Saffron-Rose Amour (Skincare & Mood)', 'saffron-rose-amour-skincare-&-mood', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-1.png', 360, 'VC-TE-SAF', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-SAF-LT-50', '2021-06-23 04:55:40', '2021-06-23 04:55:40'),
(3, 1003, 'Tea', 'Herbal Teas', 'Saffron-Rose Amour (Skincare & Mood)', 'saffron-rose-amour-skincare-&-mood', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-1.png', 360, 'VC-TE-SAF', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-SAF-LT-50', '2021-06-23 19:55:21', '2021-06-23 19:55:21'),
(4, 1004, 'Tea', 'Herbal Teas', 'Immunity Zeal (Immunity Boost)', 'immunity-zeal-immunity-boost', 'Vitality-club-immunity-zeal-(immunity-boost)-1.png', 360, 'VC-TE-IMZ', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-IMZ-LT-50', '2021-06-24 20:31:58', '2021-06-24 20:31:58'),
(5, 1005, 'Tea', 'Black Teas', 'Masala Chai (Spiced Black Tea)', 'masala-chai-spiced-black-tea', 'Vitality-club-masala-chai-(spiced-black-tea)-1.png', 350, 'VC-TE-MAS', 1, 'Yes', 'Weight', 1, '150gm Loose Tea', 'VC-TE-MAS-LT-150', '2021-06-24 21:06:50', '2021-06-24 21:06:50'),
(6, 1006, 'Tea', 'Green Teas', 'Kashmiri Spiced Green Tea (Detox)', 'kashmiri-spiced-green-tea-detox', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-1.png', 320, 'VC-TE-KAS', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-KAS-LT-50', '2021-06-24 21:31:52', '2021-06-24 21:31:52'),
(7, 1007, 'Tea', 'White Teas', 'White Tea Silver Needle (Anti-Aging)', 'white-tea-silver-needle-anti-aging', 'Vitality-club-white-tea-silver-needle-(anti-aging)-1.png', 460, 'VC-TE-WSN', 1, 'Yes', 'Weight', 1, '30gm Loose Tea', 'VC-TE-WSN-LT-50', '2021-06-24 21:37:03', '2021-06-24 21:37:03'),
(8, 1008, 'Tea', 'Herbal Teas', 'Triphala Pep (Digestion & Metabolism)', 'triphala-pep-digestion-&-metabolism', 'Vitality-club-triphala-pep-(weight-&-metabolism)-1.png', 360, 'VC-TE-TRI', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-TRI-LT-50', '2021-06-24 21:39:59', '2021-06-24 21:39:59'),
(9, 1009, 'Tea', 'Herbal Teas', 'Moringa Bloom (Diabetic Support & Detox)', 'moringa-bloom-diabetic-support-&-detox', 'Vitality-club-moringa-bloom-(diabetic-support)-1.png', 360, 'VC-TE-MOR', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-MOR-LT-50', '2021-06-24 22:01:46', '2021-06-24 22:01:46'),
(10, 1010, 'Tea', 'Green Teas', 'Kashmiri Spiced Green Tea (Detox)', 'kashmiri-spiced-green-tea-detox', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-1.png', 320, 'VC-TE-KAS', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-KAS-LT-50', '2021-06-24 22:09:08', '2021-06-24 22:09:08'),
(11, 1011, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 360, 'VC-TE-LAV', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-LAV-LT-50', '2021-07-13 22:29:56', '2021-07-13 22:29:56'),
(12, 1011, 'Tea', 'Herbal Teas', 'Saffron-Rose Amour (Skincare & Mood)', 'saffron-rose-amour-skincare-&-mood', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-1.png', 360, 'VC-TE-SAF', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-SAF-LT-50', '2021-07-13 22:29:56', '2021-07-13 22:29:56'),
(13, 1012, 'Tea', 'Green Teas', 'Moroccan Mint Green Tea (Heart Health)', 'moroccan-mint-green-tea-heart-health', 'Vitality-club-moroccan-mint-green-tea-(heart-health)-1.png', 260, 'VC-TE-MOM', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-MOM-', '2021-07-13 22:40:41', '2021-07-13 22:40:41'),
(14, 1013, 'Tea', 'Herbal Teas', 'Immunity Zeal (Immunity Boost)', 'immunity-zeal-immunity-boost', 'Vitality-club-immunity-zeal-(immunity-boost)-1.png', 360, 'VC-TE-IMZ', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-IMZ-LT-50', '2021-07-13 22:46:14', '2021-07-13 22:46:14'),
(15, 1014, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 360, 'VC-TE-LAV', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-LAV-LT-50', '2021-07-15 00:51:13', '2021-07-15 00:51:13'),
(16, 1015, 'Tea', 'Herbal Teas', 'Moringa Bloom (Diabetic Support & Detox)', 'moringa-bloom-diabetic-support-&-detox', 'Vitality-club-moringa-bloom-(diabetic-support)-1.png', 360, 'VC-TE-MOR', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-MOR-LT-50', '2021-07-15 01:20:09', '2021-07-15 01:20:09'),
(17, 1016, 'Tea', 'Herbal Teas', 'Saffron-Rose Amour (Skincare & Mood)', 'saffron-rose-amour-skincare-&-mood', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-1.png', 360, 'VC-TE-SAF', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-SAF-LT-50', '2021-07-15 01:22:57', '2021-07-15 01:22:57'),
(18, 1017, 'Tea', 'Green Teas', 'Kashmiri Spiced Green Tea (Detox)', 'kashmiri-spiced-green-tea-detox', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-1.png', 320, 'VC-TE-KAS', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-KAS-LT-50', '2021-07-15 01:37:47', '2021-07-15 01:37:47'),
(19, 1018, 'Tea', 'Black Teas', 'Assam Tea Orthodox Leaf (Black Tea)', 'assam-tea-orthodox-leaf-black-tea', 'Vitality-club-assam-tea-orthodox-leaf-(black-tea)-1.png', 330, 'VC-TE-AOL', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-AOL-LT-50', '2021-07-15 01:41:38', '2021-07-15 01:41:38'),
(20, 1019, 'Tea', 'Black Teas', 'Masala Chai (Spiced Black Tea)', 'masala-chai-spiced-black-tea', 'Vitality-club-masala-chai-(spiced-black-tea)-1.png', 350, 'VC-TE-MAS', 1, 'Yes', 'Weight', 1, '150gm Loose Tea', 'VC-TE-MAS-LT-150', '2021-07-15 01:47:14', '2021-07-15 01:47:14'),
(21, 1020, 'Tea', 'White Teas', 'White Tea Silver Needle (Anti-Aging)', 'white-tea-silver-needle-anti-aging', 'Vitality-club-white-tea-silver-needle-(anti-aging)-1.png', 460, 'VC-TE-WSN', 1, 'Yes', 'Weight', 1, '30gm Loose Tea', 'VC-TE-WSN-LT-50', '2021-07-15 01:48:22', '2021-07-15 01:48:22'),
(22, 1021, 'Tea', 'Green Teas', 'Moroccan Mint Green Tea (Heart Health)', 'moroccan-mint-green-tea-heart-health', 'Vitality-club-moroccan-mint-green-tea-(heart-health)-1.png', 260, 'VC-TE-MOM', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-MOM-', '2021-07-15 01:56:42', '2021-07-15 01:56:42'),
(23, 1022, 'Tea', 'Herbal Teas', 'Saffron-Rose Amour (Skincare & Mood)', 'saffron-rose-amour-skincare-&-mood', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-1.png', 360, 'VC-TE-SAF', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-SAF-LT-50', '2021-07-15 02:00:07', '2021-07-15 02:00:07'),
(24, 1022, 'Tea', 'Green Teas', 'Kashmiri Spiced Green Tea (Detox)', 'kashmiri-spiced-green-tea-detox', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-1.png', 320, 'VC-TE-KAS', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-KAS-LT-50', '2021-07-15 02:00:07', '2021-07-15 02:00:07'),
(25, 1023, 'Tea', 'Herbal Teas', 'Triphala Pep (Digestion & Metabolism)', 'triphala-pep-digestion-&-metabolism', 'Vitality-club-triphala-pep-(weight-&-metabolism)-1.png', 360, 'VC-TE-TRI', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-TRI-LT-50', '2021-07-15 02:04:06', '2021-07-15 02:04:06'),
(26, 1024, 'Tea', 'Green Teas', 'Kashmiri Spiced Green Tea (Detox)', 'kashmiri-spiced-green-tea-detox', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-1.png', 320, 'VC-TE-KAS', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-KAS-LT-50', '2021-07-15 02:08:59', '2021-07-15 02:08:59'),
(27, 1025, 'Tea', 'White Teas', 'White Tea Silver Needle (Anti-Aging)', 'white-tea-silver-needle-anti-aging', 'Vitality-club-white-tea-silver-needle-(anti-aging)-1.png', 460, 'VC-TE-WSN', 1, 'Yes', 'Weight', 1, '30gm Loose Tea', 'VC-TE-WSN-LT-50', '2021-07-15 02:15:22', '2021-07-15 02:15:22'),
(28, 1026, 'Tea', 'Herbal Teas', 'Triphala Pep (Digestion & Metabolism)', 'triphala-pep-digestion-&-metabolism', 'Vitality-club-triphala-pep-(weight-&-metabolism)-1.png', 360, 'VC-TE-TRI', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-TRI-LT-50', '2021-07-15 17:57:24', '2021-07-15 17:57:24'),
(29, 1027, 'Tea', 'Herbal Teas', 'Immunity Zeal (Immunity Boost)', 'immunity-zeal-immunity-boost', 'Vitality-club-immunity-zeal-(immunity-boost)-1.png', 360, 'VC-TE-IMZ', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-IMZ-LT-50', '2021-07-16 19:35:35', '2021-07-16 19:35:35'),
(30, 1028, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 590, 'VC-TE-LAV', 1, 'Yes', 'Weight', 2, '100gm Loose Tea', 'VC-TE-LAV-LT-100', '2021-07-16 21:19:06', '2021-07-16 21:19:06'),
(31, 1029, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 590, 'VC-TE-LAV', 1, 'Yes', 'Weight', 2, '100gm Loose Tea', 'VC-TE-LAV-LT-100', '2021-07-16 21:21:31', '2021-07-16 21:21:31'),
(32, 1030, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 590, 'VC-TE-LAV', 1, 'Yes', 'Weight', 2, '100gm Loose Tea', 'VC-TE-LAV-LT-100', '2021-07-16 21:22:43', '2021-07-16 21:22:43'),
(33, 1031, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 590, 'VC-TE-LAV', 1, 'Yes', 'Weight', 2, '100gm Loose Tea', 'VC-TE-LAV-LT-100', '2021-07-16 21:31:30', '2021-07-16 21:31:30'),
(34, 1032, 'Tea', 'Black Teas', 'Masala Chai (Spiced Black Tea)', 'masala-chai-spiced-black-tea', 'Vitality-club-masala-chai-(spiced-black-tea)-1.png', 350, 'VC-TE-MAS', 1, 'Yes', 'Weight', 1, '150gm Loose Tea', 'VC-TE-MAS-LT-150', '2021-07-17 09:26:37', '2021-07-17 09:26:37'),
(35, 1033, 'Tea', 'Black Teas', 'Masala Chai (Spiced Black Tea)', 'masala-chai-spiced-black-tea', 'Vitality-club-masala-chai-(spiced-black-tea)-1.png', 350, 'VC-TE-MAS', 1, 'Yes', 'Weight', 1, '150gm Loose Tea', 'VC-TE-MAS-LT-150', '2021-07-17 09:26:43', '2021-07-17 09:26:43'),
(36, 1034, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 360, 'VC-TE-LAV', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-LAV-LT-50', '2021-07-20 20:13:58', '2021-07-20 20:13:58'),
(37, 1035, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 360, 'VC-TE-LAV', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-LAV-LT-50', '2021-07-20 20:14:03', '2021-07-20 20:14:03'),
(38, 1036, 'Tea', 'Herbal Teas', 'Saffron-Rose Amour (Skincare & Mood)', 'saffron-rose-amour-skincare-&-mood', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-1.png', 360, 'VC-TE-SAF', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-SAF-LT-50', '2021-07-21 00:11:46', '2021-07-21 00:11:46'),
(39, 1037, 'Tea', 'Herbal Teas', 'Turmeric Zest (Holistic Health)', 'turmeric-zest-holistic-health', 'Vitality-club-turmeric-zest-(holistic-health)-1.png', 360, 'VC-TE-TUR', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-TUR-LT-50', '2021-07-21 00:15:24', '2021-07-21 00:15:24'),
(40, 1038, 'Tea', 'White Teas', 'White Tea Silver Needle (Anti-Aging)', 'white-tea-silver-needle-anti-aging', 'Vitality-club-white-tea-silver-needle-(anti-aging)-1.png', 460, 'VC-TE-WSN', 1, 'Yes', 'Weight', 1, '30gm Loose Tea', 'VC-TE-WSN-LT-50', '2021-07-21 00:32:47', '2021-07-21 00:32:47'),
(41, 1039, 'Tea', 'Herbal Teas', 'Ashwagandha Calm (BP & Stamina)', 'ashwagandha-calm-bp-&-stamina', 'Vitality-club-ashwagandha-calm-(bp-&-stamina)-1.png', 360, 'VC-TE-ASH', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-ASH-LT-50', '2021-07-21 00:52:26', '2021-07-21 00:52:26'),
(42, 1040, 'Tea', 'Black Teas', 'Assam Tea Orthodox Leaf (Black Tea)', 'assam-tea-orthodox-leaf-black-tea', 'Vitality-club-assam-tea-orthodox-leaf-(black-tea)-1.png', 330, 'VC-TE-AOL', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-AOL-LT-50', '2021-07-21 02:04:13', '2021-07-21 02:04:13'),
(43, 1041, 'Tea', 'Herbal Teas', 'Moringa Bloom (Diabetic Support & Detox)', 'moringa-bloom-diabetic-support-&-detox', 'Vitality-club-moringa-bloom-(diabetic-support)-1.png', 360, 'VC-TE-MOR', 1, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-MOR-LT-50', '2021-07-21 07:17:01', '2021-07-21 07:17:01'),
(44, 1042, 'Tea', 'Black Teas', 'Masala Chai (Spiced Black Tea)', 'masala-chai-spiced-black-tea', 'Vitality-club-masala-chai-(spiced-black-tea)-1.png', 350, 'VC-TE-MAS', 1, 'Yes', 'Weight', 1, '150gm Loose Tea', 'VC-TE-MAS-LT-150', '2021-07-21 08:32:46', '2021-07-21 08:32:46'),
(45, 1043, 'Tea', 'Green Teas', 'Lemongrass Ginger Mint GT (Weight Care)', 'lemongrass-ginger-mint-gt-weight-care', 'Vitality-club-lemongrass-ginger-mint-(weight-control)-1.png', 290, 'VC-TE-LGM', 2, 'Yes', 'Weight', 1, '50gm Loose Tea', 'VC-TE-LGM-LT-50', '2021-07-21 08:37:24', '2021-07-21 08:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hello@vitalityclub.in', '$2y$10$f6wTvmdoTRxCKtEMNxP5n.mP5xPSW3hzhFQrxH1NU84Bo4jB1GqNS', '2021-06-15 17:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_mode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_order_value` int(11) NOT NULL,
  `max_order_value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `country`, `state`, `payment_mode`, `min_order_value`, `max_order_value`, `created_at`, `updated_at`) VALUES
(1, 'India', 'All', 'Online', 0, 0, '2021-05-29 12:56:58', '2021-05-29 12:56:58'),
(2, 'India', 'Delhi', 'COD', 250, 1500, '2021-06-19 01:15:48', '2021-06-19 01:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_subCategory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_pic1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_pic2` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_pic3` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_pic4` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_totalPrice` int(11) DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `price_filter` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT '0',
  `product_hasVariants` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variantType` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant2` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant3` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant4` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant5` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant1sku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant2sku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant3sku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant4sku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant5sku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variant1qty` int(11) NOT NULL DEFAULT '0',
  `product_variant2qty` int(11) NOT NULL DEFAULT '0',
  `product_variant3qty` int(11) NOT NULL DEFAULT '0',
  `product_variant4qty` int(11) NOT NULL DEFAULT '0',
  `product_variant5qty` int(11) NOT NULL DEFAULT '0',
  `product_variant1cost` int(11) NOT NULL DEFAULT '0',
  `product_variant2cost` int(11) NOT NULL DEFAULT '0',
  `product_variant3cost` int(11) NOT NULL DEFAULT '0',
  `product_variant4cost` int(11) NOT NULL DEFAULT '0',
  `product_variant5cost` int(11) NOT NULL DEFAULT '0',
  `product_variant1mrp` int(11) NOT NULL DEFAULT '0',
  `product_variant2mrp` int(11) NOT NULL DEFAULT '0',
  `product_variant3mrp` int(11) NOT NULL DEFAULT '0',
  `product_variant4mrp` int(11) NOT NULL DEFAULT '0',
  `product_variant5mrp` int(11) NOT NULL DEFAULT '0',
  `product_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_ingredients` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_nutritionalFacts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_benefits` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_otherInfo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_healthBenefit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_discountType` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_discountValue` int(11) NOT NULL DEFAULT '0',
  `product_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_most-viewed` bigint(20) NOT NULL,
  `product_bestsellers` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category`, `product_subCategory`, `product_name`, `product_url`, `product_pic1`, `product_pic2`, `product_pic3`, `product_pic4`, `product_totalPrice`, `product_price`, `price_filter`, `product_code`, `product_quantity`, `product_hasVariants`, `product_variantType`, `product_variant1`, `product_variant2`, `product_variant3`, `product_variant4`, `product_variant5`, `product_variant1sku`, `product_variant2sku`, `product_variant3sku`, `product_variant4sku`, `product_variant5sku`, `product_variant1qty`, `product_variant2qty`, `product_variant3qty`, `product_variant4qty`, `product_variant5qty`, `product_variant1cost`, `product_variant2cost`, `product_variant3cost`, `product_variant4cost`, `product_variant5cost`, `product_variant1mrp`, `product_variant2mrp`, `product_variant3mrp`, `product_variant4mrp`, `product_variant5mrp`, `product_description`, `product_ingredients`, `product_nutritionalFacts`, `product_benefits`, `product_otherInfo`, `product_healthBenefit`, `product_discountType`, `product_discountValue`, `product_status`, `product_most-viewed`, `product_bestsellers`, `created_at`, `updated_at`) VALUES
(3, 'Tea', 'Black Teas', 'Masala Chai (Spiced Black Tea)', 'masala-chai-spiced-black-tea', 'Vitality-club-masala-chai-(spiced-black-tea)-1.png', 'Vitality-club-masala-chai-(spiced-black-tea)-2.png', 'Vitality-club-masala-chai-(spiced-black-tea)-3.jpg', 'null', NULL, 350, '250 500', 'VC-TE-MAS', 0, 'Yes', 'Weight', '150gm Loose Tea', '250gm Loose Tea', NULL, NULL, NULL, 'VC-TE-MAS-LT-150', 'VC-TE-MAS-LT-250', NULL, NULL, NULL, 5, 10, 0, 0, 0, 350, 490, 0, 0, 0, 350, 490, 0, 0, 0, 'An energetic blend of strong Assamese CTC tea with cardamom, ginger, cinnamon, cloves, and black pepper. Beneficial for colds, coughs, and fevers, this tea is a staple of every Indian home, and is, both, a comfort drink, as well as the perfect fuel to start your day with!', 'CTC Tea, Cardamom, Ginger, Cinnamon, Cloves, Black Pepper.', '<p><b>BREWING INSTRUCTIONS:</b> Wash your teapot with warm water and add one teaspoon (2g) of ‘Masala Chai’ per cup. Pour freshly boiled water into the pot and cover with a tea cozy, letting the leaves infuse for 3-4 minutes to secure full flavour before straining the decoction.</p> \r\n<b><p>FOR A STRONG CUP OF ‘DHABA CHAI’ (Sweet Milk Tea):</b> Add half a cup of milk to one and a half cups of water, and put the mixture to boil in a sauce pan. As soon as it comes to a boil, add one teaspoon (2g) of Masala Chai, along with sugar and let it simmer for 1 minute. Filter the Masala Chai into tea cups.</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'Invigorating chai, packed with medicinal whole spices!', 'chai, masala chai, black tea, premium tea, spices, spiced tea, cardamom, cinnamon, cloves, ginger, black pepper, ctc tea, ctc, Assam tea, Assamese', 'Cough & Cold', NULL, 0, 'Active', 65, 0, '2021-05-09 22:41:11', '2021-07-21 08:32:46'),
(4, 'Tea', 'Green Teas', 'Lemongrass Ginger Mint GT (Weight Care)', 'lemongrass-ginger-mint-gt-weight-care', 'Vitality-club-lemongrass-ginger-mint-(weight-control)-1.png', 'Vitality-club-lemongrass-ginger-mint-(weight-control)-2.png', 'Vitality-club-lemongrass-ginger-mint-(weight-control)-3.jpg', 'null', NULL, 290, '250 500', 'VC-TE-LGM', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-LGM-LT-50', 'VC-TE-LGM-LT-100', NULL, NULL, NULL, 8, 10, 0, 0, 0, 290, 430, 0, 0, 0, 290, 430, 0, 0, 0, 'This unique blend of green tea with lemongrass, ginger, and mint leaves is ideal for detoxification and improving heart health. With an abundance of antioxidants and polyphenols, this tea improves general wellbeing, reduces inflammation, and aids weight loss!', 'Green Tea, Lemongrass, Ginger, Mint.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Heart Health, Detoxification, and Weight Management!', 'lemongrass, green, green tea, lemon, ginger, mint, weight loss, weight, detox, detoxification', 'Digestion & Weight', NULL, 0, 'Active', 119, 0, '2021-05-09 23:01:07', '2021-07-21 08:37:24'),
(5, 'Tea', 'Herbal Teas', 'Ashwagandha Calm (BP & Stamina)', 'ashwagandha-calm-bp-&-stamina', 'Vitality-club-ashwagandha-calm-(bp-&-stamina)-1.png', 'Vitality-club-ashwagandha-calm-(bp-&-stamina)-2.png', 'Vitality-club-ashwagandha-calm-(bp-&-stamina)-3.jpg', 'null', NULL, 330, '250 500', 'VC-TE-ASH', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', '20 Pyramid Bags', NULL, NULL, 'VC-TE-ASH-LT-50', 'VC-TE-ASH-LT-100', 'VC-TE-ASH-PB-20', NULL, NULL, 8, 10, 0, 0, 0, 360, 590, 390, 0, 0, 400, 650, 450, 0, 0, 'Ashwagandha, also known as Indian Ginseng, has been used for millennia to treat fatigue and stress, as well as an enhancer of vitality and vigour. The combination of the herbs in this tea, such as valerian root, jasmine, lavender, hibiscus etc., also lowers blood pressure, induces relaxation, and aids chronic hypertension!', 'Ashwagandha, Hibiscus, Lavender, Rooibos, Rosemary, Lemongrass, Valerian Root, Rose Petals, Licorice, Jasmine.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Blood Pressure Control, Increased Vitality, and Better Immunity! (10% OFF)', 'ashwagandha, ginseng, blood pressure, hypertension, energy, stamina, calm, relax, relaxation, caffeine free, uncaffeinated, tisane, herbal, decaf, decaffeinated, no caffeine', 'BP & Stamina', NULL, 0, 'Active', 330, 0, '2021-05-09 23:36:58', '2021-07-21 02:22:55'),
(6, 'Tea', 'Herbal Teas', 'Turmeric Zest (Holistic Health)', 'turmeric-zest-holistic-health', 'Vitality-club-turmeric-zest-(holistic-health)-1.png', 'Vitality-club-turmeric-zest-(holistic-health)-2.png', 'null', 'null', NULL, 360, '250 500', 'VC-TE-TUR', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', '20 Pyramid Bags', NULL, NULL, 'VC-TE-TUR-LT-50', 'VC-TE-TUR-LT-100', 'VC-TE-TUR-PB-20', NULL, NULL, 9, 10, 0, 0, 0, 360, 590, 390, 0, 0, 400, 650, 390, 0, 0, 'Turmeric is considered one of the most important spices in Ayurveda owing to its innumerable health benefits. Curcumin, its active ingredient, is one of the most potent anti-inflammatory and immunity-boosting agents, which also promotes brain health, aids in digestion, keeps the skin clear, and helps detox the liver!', 'Turmeric, Lemon Peel, Lemongrass, Ginger, Cinnamon, Cardamom, Black Pepper.', '<p><b>FOR LOOSE TEA:</b> <u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS:</b> <u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TURMERIC LATTE:</b> <u>Per Serving:</u> Brew 1 teaspoon (2g) of this tea in 150ml of boiling milk for 2-3 minutes and strain the decoction into a mug. Add honey if desired. When using teabags, dip the teabag in freshly boiled milk and let it brew for 5 minutes.</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Glowing Skin, Better Immunity, and Holistic Health! (10% OFF)', 'turmeric, immunity, herbal, lemongrass, lemon, black pepper, ginger, anti inflammation, inflammation, health, caffeine free, decaffeinated, uncaffeinated, tisane, herbal, decaf, no caffeine', 'Holistic Health', NULL, 0, 'Active', 229, 0, '2021-05-10 07:30:01', '2021-07-21 02:22:25'),
(7, 'Spices', 'Not Applicable', 'Himalayan Turmeric (High Curcumin)', 'himalayan-turmeric-high-curcumin', 'Vitality-club-himalayan-turmeric-(launching-soon)-1.png', 'null', 'null', 'null', NULL, 300, '250 500', 'VC-SP-HTR', 0, 'Yes', 'Weight', '100gm', '200gm', NULL, NULL, NULL, 'VC-SP-HTR-100', 'VC-SP-HTR-200', NULL, NULL, NULL, 0, 0, 0, 0, 0, 300, 500, 0, 0, 0, 300, 500, 0, 0, 0, 'High curcumin concentration turmeric from the Himalayas. Ideal for skincare, immunity building, and anti-inflammatory uses!', 'Pure Turmeric Powder', '<p><b>FSSAI License No.:</b> 10020011008074</p>', 'High curcumin concentration turmeric from the Himalayas. Ideal for skincare, immunity building, and anti-inflammatory uses!', 'turmeric, himalayan, himalaya, himalayas, haldi, curcumin, himalayan turmeric, high curcumin', 'Holistic Health', NULL, 0, 'Active', 135, 0, '2021-05-13 19:15:42', '2021-07-21 01:54:28'),
(9, 'Tea', 'Herbal Teas', 'Moringa Bloom (Diabetic Support & Detox)', 'moringa-bloom-diabetic-support-&-detox', 'Vitality-club-moringa-bloom-(diabetic-support)-1.png', 'Vitality-club-moringa-bloom-(diabetic-support)-2.png', 'Vitality-club-moringa-bloom-(diabetic-support)-3.jpg', 'null', NULL, 360, '250 500', 'VC-TE-MOR', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-MOR-LT-50', 'VC-TE-MOR-LT-100', NULL, NULL, NULL, 7, 10, 0, 0, 0, 360, 590, 0, 0, 0, 400, 650, 0, 0, 0, 'Moringa (commonly known as ‘drumsticks’) is rich in antioxidants and quercetin and has been known to support blood sugar levels, as well as blood purification. In combination with the other infused herbs, this herbal tea is also a potent immunity booster!', 'Moringa (drumsticks), Hibiscus, Ginger, Lemongrass, Black Pepper.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Sugar Control, Blood Purification, & Liver Detoxification! (10% OFF)', 'moringa, diabetic, detox, diabetes, blood sugar, sugar, detoxification, blood, blood purification, uncaffeinated, caffeine free, tisane, herbal, decaf, decaffeinated, uncaffeinated, caffeine free, no caffeine, tisane, herbal', 'Diabetic Support', NULL, 0, 'Active', 40, 0, '2021-06-19 00:12:49', '2021-07-21 07:17:01'),
(10, 'Tea', 'Black Teas', 'Darjeeling Tea First Flush (Black Tea)', 'darjeeling-tea-first-flush-black-tea', 'Vitality-club-darjeeling-tea-first-flush-(black-tea)-1.png', 'Vitality-club-darjeeling-tea-first-flush-(black-tea)-2.png', 'Vitality-club-darjeeling-tea-first-flush-(black-tea)-3.jpg', 'null', NULL, 360, '250 500', 'VC-TE-DFF', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-DFF-LT-50', 'VC-TE-DFF-LT-100', NULL, NULL, NULL, 10, 10, 0, 0, 0, 360, 490, 0, 0, 0, 360, 490, 0, 0, 0, 'A connoisseur’s delight: Darjeeling Tea, grown in the mystical and romantic surroundings of the Himalayan mountains of India, has no equal - so rare and unique in its flavour that it cannot be replicated anywhere in the world!', 'Darjeeling Tea (First Flush)', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. Drink without milk for best experience.</p>\r\n<p><b>FOR TEABAGS:</b> <u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. Drink without milk for best experience.</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'Fragrant and Mellow Black Tea Leaves!', 'black tea, darjeeling, tea, chai, black', 'Heart Health', NULL, 0, 'Active', 32, 0, '2021-06-19 00:30:41', '2021-07-06 06:11:29'),
(11, 'Tea', 'Green Teas', 'Moroccan Mint Green Tea (Heart Health)', 'moroccan-mint-green-tea-heart-health', 'Vitality-club-moroccan-mint-green-tea-(heart-health)-1.png', 'Vitality-club-moroccan-mint-green-tea-(heart-health)-2.png', 'Vitality-club-moroccan-mint-green-tea-(heart-health)-3.jpg', 'null', NULL, 260, '250 500', 'VC-TE-MOM', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-MOM-', 'VC-TE-MOM-LT-100', NULL, NULL, NULL, 8, 10, 0, 0, 0, 260, 410, 0, 0, 0, 260, 410, 0, 0, 0, 'This refreshing blend of gunpowder green tea with cooling mint leaves is an homage to the traditional recipe from the Maghreb region! It is ideal for detoxification, managing fatigue, and improving heart health. With an abundance of antioxidants and polyphenols, this tea improves general wellbeing and aids weight loss!', 'Gunpowder Green Tea, Mint Leaves.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Heart Health, Better Immunity, & Fatigue Management!', 'mint, green tea, moroccan, cool, cooling, summer, heart health, detox', 'Heart Health', NULL, 0, 'Active', 45, 0, '2021-06-19 00:41:32', '2021-07-15 08:09:55'),
(12, 'Tea', 'Green Teas', 'Single Estate Green Tea (Detox)', 'single-estate-green-tea-detox', 'Vitality-club-single-estate-green-tea-(detox)-1.png', 'Vitality-club-single-estate-green-tea-(detox)-2.png', 'Vitality-club-single-estate-green-tea-(detox)-3.jpg', 'null', NULL, 260, '250 500', 'VC-TE-SGT', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-SGT-LT-50', 'VC-TE-SGT-LT-100', NULL, NULL, NULL, 10, 10, 0, 0, 0, 260, 410, 0, 0, 0, 260, 410, 0, 0, 0, 'Our Single Estate Green Tea is produced in Assam, and has a pale greenish-yellow liquor. It contains a significant amount of Antioxidants and Polyphenols, which help fight blood cholesterol, heart diseases, and high blood pressure. It also aids digestion, protects tooth decay, increases alertness, and reduces fatigue!', 'Green Tea (Single Estate)', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Heart Health, Fatigue Reduction, & Weight Management!', 'green tea, green, tea, single estate, assam, assamese', 'Detox', NULL, 0, 'Active', 31, 0, '2021-06-19 00:49:12', '2021-07-21 02:19:07'),
(13, 'Tea', 'Black Teas', 'Assam Tea Orthodox Leaf (Black Tea)', 'assam-tea-orthodox-leaf-black-tea', 'Vitality-club-assam-tea-orthodox-leaf-(black-tea)-1.png', 'Vitality-club-assam-tea-orthodox-leaf-(black-tea)-2.png', 'Vitality-club-assam-tea-orthodox-leaf-(black-tea)-3.jpg', 'null', NULL, 330, '250 500', 'VC-TE-AOL', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-AOL-LT-50', 'VC-TE-AOL-LT-100', NULL, NULL, NULL, 8, 10, 0, 0, 0, 330, 460, 0, 0, 0, 330, 460, 0, 0, 0, 'This exclusive leaf tea has been specially handpicked in the month of June, and is characterised by its long leaves. Assam Orthodox Leaf is a rare combination of a strong liquor and intense aroma, and is a favourite with tea drinkers whose preference lies in a strong yet balanced cup of tea!', 'Assam Tea (Orthodox Whole Leaf)', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'Aromatic & Robust Tea Leaves!', 'black, black tea, assam, orthodox, whole leaf, loose, loose leaf, loose tea, loose leaf tea', 'Detox', NULL, 0, 'Active', 26, 0, '2021-06-19 00:55:31', '2021-07-21 02:18:52'),
(14, 'Tea', 'White Teas', 'White Tea Silver Needle (Anti-Aging)', 'white-tea-silver-needle-anti-aging', 'Vitality-club-white-tea-silver-needle-(anti-aging)-1.png', 'Vitality-club-white-tea-silver-needle-(anti-aging)-2.png', 'Vitality-club-white-tea-silver-needle-(anti-aging)-3.jpg', 'null', NULL, 460, '250 500', 'VC-TE-WSN', 0, 'Yes', 'Weight', '30gm Loose Tea', '50gm Loose Tea', NULL, NULL, NULL, 'VC-TE-WSN-LT-50', 'VC-TE-WSN-LT-50', NULL, NULL, NULL, 1, 5, 0, 0, 0, 460, 750, 0, 0, 0, 460, 750, 0, 0, 0, 'This artisanal White Tea has silvery-white buds, making it delightful to drink with a flowery, light, and slightly sweet flavour! Being the least processed form of tea, it is full of antioxidants and may help in heart protection, prevention of certain cancers, diabetes, stabilising blood pressure and cholesterol. It also strengthens the circulatory and immune systems and builds healthy skin!', 'White Tea (Silver Needle)', '<p><b>BREWING INSTRUCTIONS:</b> To secure full flavour, we recommend using 150ml mineral or spring water boiled to 100 degrees celsius and then cooled to about 80 degrees celsius (or, roughly 2-3 minutes at room temperature). Add 1 teaspoon (2g) of the tea into a pot (per serving) and pour the freshly boiled water. Let it steep for 7 minutes, and then strain the tea and pour into tea cups.</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Anti-Aging Effects, Radiant Skin, & Better Immunity!', 'white tea, silver, white, raw, white tea silver needle, silver needle, anti aging, age, skin, smooth skin, smooth, anti-aging, skincare, skin care', 'Anti Aging', NULL, 0, 'Active', 43, 0, '2021-06-19 01:05:56', '2021-07-21 10:31:42'),
(15, 'Tea', 'Herbal Teas', 'Immunity Zeal (Immunity Boost)', 'immunity-zeal-immunity-boost', 'Vitality-club-immunity-zeal-(immunity-boost)-1.png', 'Vitality-club-immunity-zeal-(immunity-boost)-2.png', 'null', 'null', NULL, 360, '250 500', 'VC-TE-IMZ', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-IMZ-LT-50', 'VC-TE-IMZ-LT-100', NULL, NULL, NULL, 7, 10, 0, 0, 0, 360, 590, 0, 0, 0, 400, 650, 0, 0, 0, 'Green Tea enriched with Amla, Tulsi, Giloy, Cinnamon, Ginger, Mint, Fennel, Black Pepper and Turmeric – which have traditionally been used in Ayurveda for their immunity-boosting properties – as well as Ashwagandha, which has been consumed for millennia for increasing energy levels, stamina, and vigour!', 'Green Tea, Amla (Indian Gooseberry), Tulsi (Holy Basil), Giloy, Cinnamon, Ginger, Mint, Fennel, Black Pepper, Turmeric, Ashwagandha (Indian Ginseng).', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Better Immunity, Increased Energy, & Physical Strength! (10% OFF)', 'immunity, immunity boost, ashwagandha, green tea, turmeric, haldi, tulsi, tulsi tea, amla, giloy, cinnamon, ginger, mint, black pepper, cough, cold, flu', 'Immunity Boost', NULL, 0, 'Active', 57, 0, '2021-06-19 06:29:03', '2021-07-18 04:14:06'),
(16, 'Tea', 'Herbal Teas', 'Triphala Pep (Digestion & Metabolism)', 'triphala-pep-digestion-&-metabolism', 'Vitality-club-triphala-pep-(weight-&-metabolism)-1.png', 'Vitality-club-triphala-pep-(weight-&-metabolism)-2.png', 'Vitality-club-triphala-pep-(weight-&-metabolism)-3.jpg', 'null', NULL, 360, '250 500', 'VC-TE-TRI', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-TRI-LT-50', 'VC-TE-TRI-LT-100', NULL, NULL, NULL, 7, 10, 0, 0, 0, 360, 590, 0, 0, 0, 400, 650, 0, 0, 0, 'This herbal tea is a unique blend of Triphala (an Ayurvedic remedy comprising of three herbs known to aid indigestion, improve the metabolism, and assist in weight loss), along with Green Tea, Mint, Lemongrass, Licorice, Cinnamon, Senna Leaves, Ajwain, Rose Petals, & Bay leaf!', 'Green Tea, Triphala (Bibhitaki, Amalaki, and Haritaki), Mint, Lemongrass, Licorice, Cinnamon, Senna Leaves, Ajwain (Carom Seeds), Rose Petals, Bay Leaf.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Better Digestion, Weight Control, & Improved Metabolism! (10% OFF)', 'weight loss, digestion, constipation, detox, metabolism, fast metabolism', 'Digestion & Weight', NULL, 0, 'Active', 47, 0, '2021-06-19 06:36:26', '2021-07-21 02:18:00'),
(17, 'Tea', 'Green Teas', 'Kashmiri Spiced Green Tea (Detox)', 'kashmiri-spiced-green-tea-detox', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-1.png', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-2.png', 'Vitality-club-kashmiri-spiced-green-tea-(detox)-3.jpg', 'null', NULL, 320, '250 500', 'VC-TE-KAS', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-KAS-LT-50', 'VC-TE-KAS-LT-100', NULL, NULL, NULL, 5, 10, 0, 0, 0, 320, 490, 0, 0, 0, 320, 490, 0, 0, 0, 'Exquisite single estate Green Tea blended with Cardamom and Cinnamon in a recipe straight from Kashmir! This spice-infused green tea is rich in powerful Antioxidants and Polyphenols, which support heart health and blood pressure management, and also aids digestion and immunity building!', 'Green Tea, Cinnamon, Cardamom.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Heart Health, Blood Pressure Control, & Better Immunity!', 'green tea, kahwa, kashmiri, kashmir, kashmiri kahwa, qahwa, kehwa, kashmiri qahwa, kashmiri kehwa, green tea, cinnamon, cardamom, spiced tea,qehwa, qehva, kahva, kehva, qahva', 'Detox', NULL, 0, 'Active', 30, 0, '2021-06-19 06:47:20', '2021-07-21 02:18:36'),
(18, 'Tea', 'Herbal Teas', 'Saffron-Rose Amour (Skincare & Mood)', 'saffron-rose-amour-skincare-&-mood', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-1.png', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-2.png', 'Vitality-club-saffron-rose-amour-(mood-uplifter)-3.jpg', 'null', NULL, 360, '250 500', 'VC-TE-SAF', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-SAF-LT-50', 'VC-TE-SAF-LT-100', NULL, NULL, NULL, 4, 10, 0, 0, 0, 360, 590, 0, 0, 0, 400, 650, 0, 0, 0, 'Saffron, the most exquisite and expensive spice on the planet, has been consumed traditionally for its many health benefits. It improves memory, uplifts the mood, and acts as a natural skin toner. In combination with rose, which has widely been used for its anti-aging properties, as well as cardamom and cinnamon, this ‘kahwa’ style herbal tea is a potent vitality elixir!', 'Green Tea, Saffron, Rose Petals, Cinnamon, Cardamom.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Increased Vitality, Glowing Skin, & Mood Upliftment! (10% OFF)', 'saffron, rose, kahwa, kehwa, qahwa, anti depression, anti depressant, depression, mood, happy, skin, skin care, radiant skin, glow, skincare, qehwa, qehva, kahva, kehva, qahva, kashmir, kashmiri, kashmiri kahwa, kashmiri kehwa, kashmiri qahwa, kashmiri qehwa', 'Mood Upliftment', NULL, 0, 'Active', 79, 0, '2021-06-19 06:55:15', '2021-07-21 02:14:37'),
(19, 'Tea', 'Herbal Teas', 'Lavender Zen (Stress-Relief & Sleep Aid)', 'lavender-zen-stress-relief-&-sleep-aid', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-1.png', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-2.png', 'Vitality-club-lavender-zen-(stress-relief-&-sleep)-3.jpg', 'null', NULL, 360, '250 500', 'VC-TE-LAV', 0, 'Yes', 'Weight', '50gm Loose Tea', '100gm Loose Tea', NULL, NULL, NULL, 'VC-TE-LAV-LT-50', 'VC-TE-LAV-LT-100', NULL, NULL, NULL, 6, 6, 0, 0, 0, 360, 590, 0, 0, 0, 400, 650, 0, 0, 0, 'Stress is the root cause of a number of modern lifestyle diseases. This unique blend of Green Tea, Lavender (which is known to relieve stress and help with anxiety), Hibiscus, and Mango Leaves is perfect for relaxation, and can also act as a sleeping aid!', 'Green Tea, Lavender, Hibiscus, Mango Leaves.', '<p><b>FOR LOOSE TEA: </b><u>Per Serving:</u> Add 1 teaspoon (2g) of this tea in 150ml freshly boiled water. Brew for 2-3 minutes, then strain the decoction into tea cups. Add sugar/honey, or lemon if desired. Reuse the tea by brewing for 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FOR TEABAGS: </b><u>Per Serving:</u> Place 1 bag in a cup and pour 150ml freshly boiled water. Brew for 2-3 minutes then remove the bag. Add sugar/honey or lemon if desired. Reuse each bag by increasing the brewing time to 5-7 minutes. For iced tea, use less water (75-100ml), and pour over a tall glass filled with ice. Add sugar/honey or lemon if desired, and garnish with fresh mint leaves!</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For Improved Sleep, Reduced Stress, & Mental Calmness! (10% OFF)', 'stress, sleep, sleeping, stress relief, sleep aid, sleeping aid, good sleep, calm, relax, relaxation, blood pressure, calmness, mango leaves, green tea, hibiscus, lavender, zen, blood pressure, bp, hypertension', 'Stress Relief', NULL, 0, 'Active', 109, 0, '2021-06-19 08:26:27', '2021-07-21 00:12:34'),
(20, 'Honey', 'Not Applicable', 'Spiced Honey (Immunity Elixir)', 'spiced-honey-immunity-elixir', 'Vitality-club-spiced-honey-(immunity-elixir)-1.png', 'null', 'null', 'null', NULL, 300, '250 500', 'VC-HN-IMM', 0, 'Yes', 'Weight', '250gm', '450gm', NULL, NULL, NULL, 'VC-HN-IMM-200', 'VC-HN-IMM-450', NULL, NULL, NULL, 0, 0, 0, 0, 0, 300, 499, 0, 0, 0, 300, 499, 0, 0, 0, 'Jungle honey from the Himalayas, blended with a medicinal combination of 10 herbs and spices - perfect for building a strong immune system and holistic health!', 'Raw Jungle Honey, Hill Turmeric, Ashwagandha, Ginger, Black Pepper, Cloves, Cinnamon, Giloy, Cardamom, Mulethi, Tulsi.', '<p><b>FSSAI License No.:</b> 10020011008074</p>', 'For increased immunity, glowing skin, & holistic health!', 'honey, jungle honey, raw honey, jungle, raw, turmeric, raw jungle honey, hill turmeric, ashwagandha, ginger, black pepper, cloves, cinnamon, giloy, cardamom, mulethi, tulsi', 'Immunity Boost', NULL, 0, 'Active', 12, 0, '2021-07-18 00:32:11', '2021-07-21 00:05:22'),
(21, 'Combos & Offers', 'Not Applicable', 'Immunity Tea Bundle', 'immunity-tea-bundle', 'Vitality-club-immunity-tea-bundle-1.png', 'Vitality-club-immunity-tea-bundle-2.png', 'Vitality-club-immunity-tea-bundle-3.png', 'Vitality-club-immunity-tea-bundle-4.png', NULL, 975, '750 1000', 'VC-CO-IMMT', 0, 'Yes', 'Weight', '3x50gm', '3x100gm', NULL, NULL, NULL, 'VC-CO-IMMT-150', 'VC-CO-IMMT-300', NULL, NULL, NULL, 0, 0, 0, 0, 0, 975, 1500, 0, 0, 0, 975, 1500, 0, 0, 0, 'Artisanal teas - handpicked for maximizing your immune system!', '<p><b>Immunity Zeal Herbal Tea</b> - Green Tea, Amla (Indian Gooseberry), Tulsi (Holy Basil), Giloy, Cinnamon, Ginger, Mint, Fennel, Black Pepper, Turmeric, Ashwagandha (Indian Ginseng).</p><p><b>Turmeric Zest Herbal Tea</b> - Turmeric, Lemon Peel, Lemongrass, Ginger, Cinnamon, Cardamom, Black Pepper.</p> <p><b>Moringa Bloom Herbal Tea</b> - Moringa (drumsticks), Hibiscus, Ginger, Lemongrass, Black Pepper.</p>', '<p>Available in <b>3x50gm</b> (150gm total weight) and <b>3x100gm</b> (300gm total weight).</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'A combination of our 3 best-selling herbal teas for improved immunity, holistic health, and detoxification!', 'combo, offer, immunity', 'Immunity Boost', NULL, 0, 'Active', 12, 0, '2021-07-18 00:55:02', '2021-07-18 05:03:28'),
(22, 'Combos & Offers', 'Not Applicable', 'Stress Relief Tea Bundle', 'stress-relief-tea-bundle', 'Vitality-club-stress-relief-tea-bundle-1.png', 'Vitality-club-stress-relief-tea-bundle-2.png', 'Vitality-club-stress-relief-tea-bundle-3.png', 'Vitality-club-stress-relief-tea-bundle-4.png', NULL, 975, '750 1000', 'VC-CO-STRT', 0, 'Yes', 'Weight', '3x50gm', '3x100gm', NULL, NULL, NULL, 'VC-CO-STRT-150', 'VC-CO-STRT-300', NULL, NULL, NULL, 0, 0, 0, 0, 0, 975, 1500, 0, 0, 0, 975, 1500, 0, 0, 0, 'Artisanal teas - handpicked for reducing stress and anxiety!', '<p><b>Ashwagandha Calm Herbal Tea</b> - Ashwagandha, Hibiscus, Lavender, Rooibos, Rosemary, Lemongrass, Valerian Root, Rose Petals, Licorice, Jasmine.</p><p><b>Saffron-Rose Amour Herbal Tea</b> - Green Tea, Saffron, Rose Petals, Cinnamon, Cardamom.</p> <p><b>Lavender Zen Herbal Tea</b> - Green Tea, Lavender, Hibiscus, Mango Leaves.</p>', '<p>Available in <b>3x50gm</b> (150gm total weight) and <b>3x100gm</b> (300gm total weight).</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'A combination of our 3 best-selling herbal teas for stress relief, blood pressure control, good sleep, and peace of mind!', 'stress, stress relief, combos, blood pressure', 'Stress Relief', NULL, 0, 'Active', 13, 0, '2021-07-18 01:06:41', '2021-08-06 04:02:03'),
(23, 'Combos & Offers', 'Not Applicable', 'Detox And Weight Tea Bundle', 'detox-and-weight-tea-bundle', 'Vitality-club-detox-and-weight-care-tea-bundle-1.png', 'Vitality-club-detox-and-weight-care-tea-bundle-2.png', 'Vitality-club-detox-and-weight-care-tea-bundle-3.png', 'Vitality-club-detox-and-weight-care-tea-bundle-4.png', NULL, 975, '750 1000', 'VC-CO-DEWT', 0, 'Yes', 'Weight', '3x50gm', '3x100gm', NULL, NULL, NULL, 'VC-CO-DEWT-150', 'VC-CO-DEWT-300', NULL, NULL, NULL, 0, 0, 0, 0, 0, 975, 1500, 0, 0, 0, 975, 1500, 0, 0, 0, 'Artisanal teas - handpicked for helping you detoxify!', '<p><b>Triphala Pep Herbal Tea</b> - Green Tea, Triphala (Bibhitaki, Amalaki, and Haritaki), Mint, Lemongrass, Licorice, Cinnamon, Senna Leaves, Ajwain (Carom Seeds), Rose Petals, Bay Leaf.</p><p><b>Lemongrass-Ginger-Mint Green Tea</b> - Green Tea, Lemongrass, Ginger, Mint.</p> <p><b>Moringa Bloom Herbal Tea</b> - Moringa (drumsticks), Hibiscus, Ginger, Lemongrass, Black Pepper.</p>', '<p>Available in <b>3x50gm</b> (150gm total weight) and <b>3x100gm</b> (300gm total weight).</p>\r\n<p><b>FSSAI License No.:</b> 10020011008074</p>', 'A combination of our 3 best-selling herbal teas for detoxification, boosting metabolism, and aiding digestion!', 'detox, weight loss, weight care, detoxification, detoxify', 'Digestion & Weight', NULL, 0, 'Active', 20, 0, '2021-07-18 01:22:02', '2021-07-21 02:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_img` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannerBtn_text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bannerBtn_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `banner_img`, `banner_text`, `bannerBtn_text`, `bannerBtn_link`, `created_at`, `updated_at`) VALUES
(1, 'Vitality-club-services-banner-1.jpg', 'View Our Herbal Teas - Infused with Superfoods and Ayurvedic Ingredients!', 'View Herbal Teas', 'https://www.vitalityclub.in/shop/tea/herbal-teas', '2021-07-22 01:59:05', '2021-07-22 02:10:58'),
(2, 'Vitality-club-services-banner-2.jpg', 'Launching Soon - Immunity Boosting Honey!', 'View Honey', 'https://www.vitalityclub.in/shop/honey', '2021-07-22 02:10:42', '2021-07-22 02:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RFZ5oPn22Wq86dJ38h2hcIjXt8mSKwbhANz6nIA5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFFmdnBhblZYMER6T3BvMnpyVkZ2T1RzUjBjVjdIQ1d4MWZ6dm5LYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mYXZpY29uLTE2eDE2LnBuZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1637932363);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

DROP TABLE IF EXISTS `shippings`;
CREATE TABLE IF NOT EXISTS `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliverable` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `min_order_value` int(11) NOT NULL,
  `max_order_value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `country`, `state`, `deliverable`, `name`, `cost`, `min_order_value`, `max_order_value`, `created_at`, `updated_at`) VALUES
(1, 'India', 'Delhi', 'Yes', 'Standard', 50, 250, 599, '2021-05-16 02:50:07', '2021-06-19 01:12:16'),
(2, 'India', 'Delhi', 'Yes', 'Standard', 70, 600, 899, '2021-06-19 01:12:50', '2021-06-19 01:13:50'),
(3, 'India', 'Delhi', 'Yes', 'Standard', 90, 900, 1199, '2021-06-19 01:13:32', '2021-06-19 01:14:03'),
(4, 'India', 'Delhi', 'Yes', 'Standard', 110, 1200, 1499, '2021-06-19 01:14:39', '2021-06-19 01:14:39'),
(5, 'India', 'Delhi', 'Yes', 'Standard', 0, 1500, 0, '2021-06-19 01:15:08', '2021-06-19 01:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subCategory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentCategory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subCategoryImage` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_categories_subcategory_unique` (`subCategory`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `subCategory`, `parentCategory`, `description`, `banner`, `subCategoryImage`, `created_at`, `updated_at`) VALUES
(1, 'Herbal Teas', 'Tea', 'Herbal teas and tisanes, enriched with superfoods and ayurvedic ingredients - perfect for a wide range of health needs, as well as an antidote to modern lifestyle issues such as anxiety, indigestion, diabetes, high blood pressure, skin problems, sleep deprivation, poor immunity etc.', 'Vitality-club-herbal-teas-banner.jpg', 'null', '2021-05-09 00:41:52', '2021-06-19 21:40:36'),
(2, 'Black Teas', 'Tea', 'Premium Black teas from Assam and Darjeeling - ideal for the discerning tea connoisseur!', 'Vitality-club-black-teas-banner.jpg', 'null', '2021-05-09 22:34:48', '2021-06-19 21:25:38'),
(3, 'Green Teas', 'Tea', 'Wellness teas packed with antioxidants and polyphenols - for heart health, better immunity, clear skin, digestion support, BP and fatigue control, weight management and more!', 'Vitality-club-green-teas-banner.jpg', 'null', '2021-05-09 22:50:49', '2021-06-19 21:17:01'),
(6, 'White Teas', 'Tea', 'The least processed form of tea - packed with antioxidants and polyphenols. Great for heart health, skin radiance, blood circulation, and building immunity!', 'Vitality-club-white-teas-banner.jpg', 'null', '2021-06-19 01:01:19', '2021-06-19 08:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` int(11) NOT NULL,
  `charge` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `country`, `tax`, `charge`, `created_at`, `updated_at`) VALUES
(1, 'India', 5, 'No', '2021-05-29 12:56:57', '2021-07-17 04:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Krish Chowdhry', 'sajan@tccggd.com', '2021-05-09 00:18:04', '$2y$10$1/3b3lKF93KzetO5O7.8YeiR3aTgM5cpg9.ShDWXWVxxVwKcGS43i', NULL, NULL, 'N7NO3pU6ECoF5PfFWqYHapwsYEOx6MDEe9XRFNzejRnp8TLk6jaRBdb9CFBS', NULL, NULL, '2021-05-09 00:16:04', '2021-08-11 12:03:10'),
(2, 'Krish Chowdhry', 'krishc.91@gmail.com', '2021-06-23 04:35:43', '$2y$10$2N4uHo5fc5NUXMcPzMKrEOGvMe/VIUI/wE1PiHRvUojBll04AA8Ye', NULL, NULL, NULL, NULL, NULL, '2021-06-23 04:33:05', '2021-06-23 04:35:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

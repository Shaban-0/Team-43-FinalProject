-- Active: 1701339889526@@127.0.0.1@3306@fragrancedb

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `fragrancedb`
-- --------------------------------------------------------

-- Table structure for table `admin`
CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` BINARY(60) NOT NULL, -- Assuming password hashing like bcrypt
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `basket`
CREATE TABLE `basket` (
  `basketID` int(11) NOT NULL AUTO_INCREMENT,
  `sessionID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`basketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `category`
CREATE TABLE `category` (
  `categoryID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `customer`
CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` BINARY(60) NOT NULL, -- Assuming password hashing like bcrypt
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE customer ADD COLUMN isActive TINYINT(1) NOT NULL DEFAULT 1;


-- --------------------------------------------------------

-- Table structure for table `customeraddress`
CREATE TABLE `customeraddress` (
  `addressID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `postcode` varchar(8) NOT NULL,
  `country` varchar(15) DEFAULT 'UK',
  PRIMARY KEY (`addressID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `discount`
CREATE TABLE `discount` (
  `discountID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`discountID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `orderitem`
CREATE TABLE `orderitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(6,2) NOT NULL,
  `bottleSize` int(11) DEFAULT NULL,
  `engraving` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `orders`
CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `paymentID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `discountID` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `payment`
CREATE TABLE `payment` (
  `paymentID` INT NOT NULL AUTO_INCREMENT,
  `paymentType` VARCHAR(255) NOT NULL,
  `cardNumber` VARCHAR(19) NOT NULL,
  `expiryDate` DATE NOT NULL,
  `CVV` SMALLINT NOT NULL,
  `paymentName` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `product`
CREATE TABLE `product` (
  `productID` INT NOT NULL AUTO_INCREMENT,
  `categoryID` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `colour` VARCHAR(255) DEFAULT NULL,
  `scent` VARCHAR(255) DEFAULT NULL,
  `season` VARCHAR(255) DEFAULT NULL,
  `images` VARCHAR(1000) DEFAULT NULL,
  `saleID` INT DEFAULT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `productinventory`
CREATE TABLE `productinventory` (
  `inventoryID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`inventoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `review`
CREATE TABLE `review` (
  `reviewID` INT NOT NULL AUTO_INCREMENT,
  `productID` INT NOT NULL,
  `customerID` INT NOT NULL,
  `rating` INT NOT NULL,
  `comment` VARCHAR(2000) DEFAULT NULL,
  PRIMARY KEY (`reviewID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `sale`
CREATE TABLE `sale` (
  `saleID` INT NOT NULL AUTO_INCREMENT,
  `salePercentage` FLOAT NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`saleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Table structure for table `shoppingsession`
CREATE TABLE `shoppingsession` (
  `sessionID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  PRIMARY KEY (`sessionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Indexes for each table
ALTER TABLE customer ADD COLUMN remember_me_token VARCHAR(128);
-- Indexes for table `basket`
ALTER TABLE `basket`
  ADD KEY `productID` (`productID`),
  ADD KEY `sessionID` (`sessionID`);

-- Indexes for table `customeraddress`
ALTER TABLE `customeraddress`
  ADD KEY `customerID` (`customerID`);

-- Indexes for table `orderitem`
ALTER TABLE `orderitem`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

-- Indexes for table `orders`
ALTER TABLE `orders`
  ADD KEY `paymentID` (`paymentID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `discountID` (`discountID`);

-- Indexes for table `product`
ALTER TABLE `product`
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `saleID` (`saleID`);

-- Indexes for table `productinventory`
ALTER TABLE `productinventory`
  ADD KEY `productID` (`productID`);

-- Indexes for table `review`
ALTER TABLE `review`
  ADD KEY `productID` (`productID`),
  ADD KEY `customerID` (`customerID`);

-- Indexes for table `shoppingsession`
ALTER TABLE `shoppingsession`
  ADD KEY `customerID` (`customerID`);

-- --------------------------------------------------------
COMMIT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`sessionID`) REFERENCES `shoppingsession` (`sessionID`);

--
-- Constraints for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD CONSTRAINT `customeraddress_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`discountID`) REFERENCES `discount` (`discountID`);
  ALTER TABLE `orders` MODIFY `paymentID` int(11) DEFAULT NULL;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`saleID`) REFERENCES `sale` (`saleID`);

--
-- Constraints for table `productinventory`
--
ALTER TABLE `productinventory`
  ADD CONSTRAINT `productinventory_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `shoppingsession`
--
ALTER TABLE `shoppingsession`
  ADD CONSTRAINT `shoppingsession_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);


--Insert statements 
INSERT INTO category (name) VALUES
('Men'),
('Women'),
('Sale'),
('Gift sets'),
('Unisex');

INSERT INTO sale (salePercentage, active) VALUES
(20.0, 1),  -- 20% discount, active sale
(15.0, 1),  -- 15% discount, active sale
(25.0, 1),  -- 25% discount, active sale
(10.0, 1),  -- 10% discount, active sale
(30.0, 1);  -- 30% discount, active sale


INSERT INTO product (categoryID, name, description, price, colour, scent, season, images) VALUES
((SELECT categoryID FROM category WHERE name = 'Men'), "L'Élégant Mystère", "A masculine fragrance with woody and spicy notes, reminiscent of Dior Sauvage", 180.00, 'Dark Blue', 'Woody, Spicy', 'Fall/Winter', 'Images/men/picture1.jpg'),
((SELECT categoryID FROM category WHERE name = 'Men'), "Le Magnifique Cuir", "A rich and leathery aroma, evoking the essence of Tom Ford Tuscan Leather", 190.00, 'Rich Brown', 'Leathery, Rich', 'Winter', 'Images/men/picture2.jpg'),
((SELECT categoryID FROM category WHERE name = 'Men'), "Le Noble Gentilhomme", "A sophisticated and classic cologne with herbal and aromatic undertones, akin to Creed Aventus", 210.00, 'Green or Gold', 'Herbal, Aromatic', 'Spring/Summer', 'Images/men/picture3.jpg'),
((SELECT categoryID FROM category WHERE name = 'Men'), "L'Énigmatique Bois", "An enigmatic blend of dark woods and oriental spices, reminiscent of Terre d'Hermès", 200.00, 'Deep Brown', 'Oriental, Woody', 'Fall/Winter', 'Images/men/picture4.jpg');

INSERT INTO product (categoryID, name, description, price, colour, scent, season, images) VALUES
((SELECT categoryID FROM category WHERE name = 'Women'), "La Belle Rose Étoilée", "A floral fragrance with a hint of sweetness, similar to Lancôme La Vie Est Belle", 160.00, 'Soft Pink', 'Floral, Sweet', 'Spring/Summer', 'Images/women/picture1.jpg'),
((SELECT categoryID FROM category WHERE name = 'Women'), "L'Amour Infini", "A romantic scent with fruity and floral notes, evoking the allure of Chanel Coco Mademoiselle", 175.00, 'Bright Red', 'Fruity, Floral', 'All Seasons', 'Images/women/picture2.jpg'),
((SELECT categoryID FROM category WHERE name = 'Women'), "La Douce Séduction", "A warm and sensual fragrance with vanilla and musk, akin to Yves Saint Laurent Black Opium", 180.00, 'Deep Purple', 'Warm, Sensual', 'Fall/Winter', 'Images/women/picture3.jpg'),
((SELECT categoryID FROM category WHERE name = 'Women'), "La Fleur Mystique", "A captivating blend of exotic blooms and spices, reminiscent of Gucci Bloom", 170.00, 'Mystical Green', 'Exotic, Spicy', 'All Seasons', 'Images/women/picture4.jpg'),
((SELECT categoryID FROM category WHERE name = 'Women'), "L'Étoile Brillante", "A sparkling and vibrant fragrance with a touch of citrus, similar to Dolce & Gabbana Light Blue", 165.00, 'Sky Blue', 'Citrus, Vibrant', 'Spring/Summer', 'Images/women/picture5.jpg');

INSERT INTO product (categoryID, name, description, price, colour, scent, season, images) VALUES
((SELECT categoryID FROM category WHERE name = 'Sale'), "Le Trésor Caché", "A discounted fragrance offering a mix of various scents, similar to clearance or limited-time promotions from top brands", 120.00, 'Assorted', 'Varied', 'All Seasons', 'Images/sale/picture1.jpg'),
((SELECT categoryID FROM category WHERE name = 'Sale'), "La Belle Affaire", "A budget-friendly fragrance with a versatile and pleasant aroma", 100.00, 'Multicolor', 'Versatile', 'All Seasons', 'Images/sale/picture2.jpg'),
((SELECT categoryID FROM category WHERE name = 'Sale'), "L'Opportunité Parfumée", "An enticing, low-cost option with a distinctive scent profile", 110.00, 'Varied', 'Distinctive', 'All Seasons', 'Images/sale/picture3.jpg'),
((SELECT categoryID FROM category WHERE name = 'Sale'), "Le Bonne Affaire", "A special offer that combines affordability with quality", 105.00, 'Varied', 'Diverse', 'All Seasons', 'Images/sale/picture4.jpg'),
((SELECT categoryID FROM category WHERE name = 'Sale'), "Le Secret Révélé", "A discounted fragrance that unveils an affordable gem", 115.00, 'Assorted', 'Unique', 'All Seasons', 'Images/sale/picture5.jpg');

INSERT INTO product (categoryID, name, description, price, colour, scent, season, images) VALUES
((SELECT categoryID FROM category WHERE name = 'Gift sets'), "Coffret Précieux", "A luxurious collection of fragrances suitable for gifting", 200.00, 'Elegant Gold', 'Assorted', 'All Seasons', 'Images/giftsets/picture1.jpg'),
((SELECT categoryID FROM category WHERE name = 'Gift sets'), "Ensemble Parfumé Exquis", "A gift set that includes a variety of scents to suit different occasions", 180.00, 'Vibrant Multicolor', 'Varied', 'All Seasons', 'Images/giftsets/picture2.jpg'),
((SELECT categoryID FROM category WHERE name = 'Gift sets'), "Collection Parfumée de Rêve", "A dreamy gift set featuring a range of scents for the recipient to explore", 210.00, 'Dreamy Blue', 'Diverse', 'All Seasons', 'Images/giftsets/picture3.jpg'),
((SELECT categoryID FROM category WHERE name = 'Gift sets'), "Le Trésor d'Aromes", "A curated set of fragrances that makes for a thoughtful gift", 190.00, 'Rich Brown', 'Assorted', 'All Seasons', 'Images/giftsets/picture4.jpg'),
((SELECT categoryID FROM category WHERE name = 'Gift sets'), "Coffret Cadeau Étoilé", "A beautifully packaged gift set with a celestial theme", 175.00, 'Starry Night Blue', 'Varied', 'All Seasons', 'Images/giftsets/picture5.jpg');

INSERT INTO product (categoryID, name, description, price, colour, scent, season, images) VALUES
((SELECT categoryID FROM category WHERE name = 'Unisex'), "L'Équilibre Épicé", "A unisex fragrance with a harmonious blend of spices, akin to Byredo Bal D'Afrique", 170.00, 'Spice Brown', 'Spicy, Harmonious', 'All Seasons', 'Images/unisex/picture1.jpg'),
((SELECT categoryID FROM category WHERE name = 'Unisex'), "Le Charme Universel", "A versatile scent that appeals to both men and women, similar to Maison Francis Kurkdjian Baccarat Rouge 540", 200.00, 'Velvet Red', 'Versatile, Universal', 'All Seasons', 'Images/unisex/picture2.jpg'),
((SELECT categoryID FROM category WHERE name = 'Unisex'), "L'Essence Mystique", "A captivating and enigmatic aroma that transcends gender, reminiscent of Tom Ford Black Orchid", 190.00, 'Mystic Purple', 'Enigmatic, Captivating', 'All Seasons', 'Images/unisex/picture3.jpg'),
((SELECT categoryID FROM category WHERE name = 'Unisex'), "La Fusion Éclatante", "An energetic and vibrant fragrance suitable for all, similar to Jo Malone London Wood Sage & Sea Salt", 175.00, 'Ocean Blue', 'Energetic, Vibrant', 'Spring/Summer', 'Images/unisex/picture4.jpg'),
((SELECT categoryID FROM category WHERE name = 'Unisex'), "Le Parfum Infini", "A timeless and unisex fragrance that embodies the essence of 'Le Paradis'", 180.00, 'Eternal Gold', 'Timeless, Unisex', 'All Seasons', 'Images/unisex/picture5.jpg');

INSERT INTO productinventory (productID, quantity) VALUES
(1, 15),  -- For "L'Élégant Mystère"
(2, 15),  -- For "Le Magnifique Cuir"
(3, 15),  -- For "Le Noble Gentilhomme"
(4, 15),  -- For "L'Énigmatique Bois"
(5, 15),  -- For "La Belle Rose Étoilée"
(6, 15),  -- For "L'Amour Infini"
(7, 15),  -- For "La Douce Séduction"
(8, 15),  -- For "La Fleur Mystique"
(9, 15),  -- For "L'Étoile Brillante"
(10, 15), -- For "Le Trésor Caché"
(11, 15), -- For "La Belle Affaire"
(12, 15), -- For "L'Opportunité Parfumée"
(13, 15), -- For "Le Bonne Affaire"
(14, 15), -- For "Le Secret Révélé"
(15, 15), -- For "Coffret Précieux"
(16, 15), -- For "Ensemble Parfumé Exquis"
(17, 15), -- For "Collection Parfumée de Rêve"
(18, 15), -- For "Le Trésor d'Aromes"
(19, 15), -- For "Coffret Cadeau Étoilé"
(20, 15), -- For "L'Équilibre Épicé"
(21, 15), -- For "Le Charme Universel"
(22, 15), -- For "L'Essence Mystique"
(23, 15), -- For "La Fusion Éclatante"
(24, 15); -- For "Le Parfum Infini"

COMMIT;
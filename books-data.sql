SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'TRADITIONAL';

USE books;

--
-- Dumping data for table book
--

SET AUTOCOMMIT = 0;
INSERT INTO book
VALUES (1,
        'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
        '2006-02-15 04:34:33',
        1491978910,
        'https://images-na.ssl-images-amazon.com/images/I/51aUTzDIxxL._SX379_BO1,204,203,200_.jpg',
        'https://www.amazon.com/Learning-PHP-MySQL-JavaScript-Javascript/dp/1491978910',
        31.15),
       (2,
        'WordPress 5 Complete: Build beautiful and feature-rich websites from scratch',
        '2006-02-15 04:34:33',
        1789532019,
        'https://images-na.ssl-images-amazon.com/images/I/51mIYYmtBQL._SX404_BO1,204,203,200_.jpg',
        'https://www.amazon.com/WordPress-Complete-beautiful-feature-rich-websites/dp/1789532019',
        40.50),
       (3,
        'Laravel: Up and Running',
        '2006-02-15 04:34:33',
        1491936088,
        'https://images-na.ssl-images-amazon.com/images/I/51mIYYmtBQL._SX404_BO1,204,203,200_.jpg',
        'https://www.amazon.com/WordPress-Complete-beautiful-feature-rich-websites/dp/1789532019',
        80.21),
       (4, 'Mastering PHP 7: Design, configure, build, and test professional web applications',
        '2006-02-15 04:34:33',
        1785882813,
        'https://images-na.ssl-images-amazon.com/images/I/51g-nakCoSL._SX404_BO1,204,203,200_.jpg',
        'https://www.amazon.com/Mastering-PHP-configure-professional-applications/dp/17858828138',
        22.39);
COMMIT;

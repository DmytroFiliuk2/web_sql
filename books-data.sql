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
        22.39),
       (5, 'Dagmar Littel',
        '2006-02-15 04:34:33',
        5988587179,
        'https://lorempixel.com/640/480/?20794',
        'http://www.heathcote.com/illum-molestiae-dicta-assumenda-fugiat-nostrum',
        79.0),
       (6, 'Miss Kaylie Walter',
        '2006-02-15 05:07:09',
        4073396577,
        'https://lorempixel.com/640/480/?66518',
        'http://stroman.com/libero-dicta-quis-et-sint.html',
        82.0);
COMMIT;


--
-- Dumping data for table film_category
--


SET AUTOCOMMIT = 0;
INSERT INTO book_tag
VALUES (1, 1, 1, '2006-02-15 05:07:09'),
       (2, 1, 2, '2006-02-15 05:07:09'),
       (3, 1, 3, '2006-02-15 05:07:09'),
       (4, 2, 1, '2006-02-15 05:07:09'),
       (5, 2, 4, '2006-02-15 05:07:09'),
       (6, 3, 5, '2006-02-15 05:07:09'),
       (8, 6, 5, '2006-02-15 05:07:09');
COMMIT;

--
-- Dumping data for table tag
--

SET AUTOCOMMIT = 0;
INSERT INTO tag
VALUES (1, 'php', '2006-02-15 04:46:27'),
       (2, 'mysql', '2006-02-15 04:46:27'),
       (3, 'jquery', '2006-02-15 04:46:27'),
       (4, 'wordpress', '2006-02-15 04:46:27'),
       (5, 'laravel', '2006-02-15 04:46:27');

COMMIT;

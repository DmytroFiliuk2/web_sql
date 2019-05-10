SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'TRADITIONAL';

DROP SCHEMA IF EXISTS books;
CREATE SCHEMA books;
USE books;


--
-- Table structure for table `book`
--


CREATE TABLE book
(
    book_id     SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name        VARCHAR(300)      NOT NULL,
    last_update TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ISBN        bigint            NOT NULL,
    poster      VARCHAR(300),
    url         VARCHAR(300),
    price       decimal(5, 2),

    PRIMARY KEY (book_id)
    -- KEY idx_actor_last_name (last_name)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;



--
-- Table structure for table `tag`
--

CREATE TABLE tag
(
    tag_id      TINYINT UNSIGNED   NOT NULL AUTO_INCREMENT,
    name        VARCHAR(25) UNIQUE NOT NULL,
    last_update TIMESTAMP          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (tag_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


--
-- Table structure for table `book_category`
--

CREATE TABLE book_tag
(
    book_tag_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    book_id     SMALLINT UNSIGNED NOT NULL,
    tag_id      TINYINT UNSIGNED  NOT NULL,
    last_update TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (book_tag_id),
    CONSTRAINT fk_film_category_film FOREIGN KEY (book_id) REFERENCES book (book_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_film_category_category FOREIGN KEY (tag_id) REFERENCES tag (tag_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE DATABASE creatives;
USE creatives;

CREATE TABLE blogs
(
    id          INT(11)   NOT NULL AUTO_INCREMENT,
    title       VARCHAR(100) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    description VARCHAR(150) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    paragraph_1 VARCHAR(300) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    paragraph_2 VARCHAR(300) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    paragraph_3 VARCHAR(300) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    paragraph_4 VARCHAR(300) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    meta        VARCHAR(500) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    created_at  TIMESTAMP NOT NULL,
    updated_at  TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE = INNODB;

CREATE TABLE blog_comments
(
    id         INT(11)   NOT NULL AUTO_INCREMENT,
    title      VARCHAR(150) CHARACTER SET utf32 COLLATE utf32_general_ci DEFAULT NULL,
    user       VARCHAR(50) CHARACTER SET utf32 COLLATE utf32_general_ci  DEFAULT NULL,
    content    VARCHAR(50) CHARACTER SET utf32 COLLATE utf32_general_ci  DEFAULT NULL,
    approved   INT(1)                                                    DEFAULT 1,
    id_blog    INT(11)                                                   DEFAULT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_blog)
        REFERENCES blogs (id)
        ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE blog_rating
(
    id         INT(11)   NOT NULL AUTO_INCREMENT,
    rating     INT(5)  DEFAULT NULL,
    id_blog    INT(11) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_blog)
        REFERENCES blogs (id)
        ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE content_translation_map
(
    id            INT(11)   NOT NULL AUTO_INCREMENT,
    field_name    VARCHAR(15)  DEFAULT NULL,
    language_type VARCHAR(3)   DEFAULT NULL,
    content       VARCHAR(500) DEFAULT NULL,
    id_blog       INT(11)      DEFAULT NULL,
    created_at    TIMESTAMP NOT NULL,
    updated_at    TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_blog)
        REFERENCES blogs (id)
        ON DELETE CASCADE
) ENGINE = INNODB;
-- Version 0 --
CREATE TABLE version (number INT UNSIGNED NOT NULL);
INSERT INTO version VALUES (0);

-- Version 1 -- 
CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (email),
    UNIQUE (username)
);
UPDATE version SET `number`=1;

-- Version 2
CREATE TABLE session (
    access_token VARCHAR(32),
    id_user INT UNSIGNED,
    expire_time BIGINT UNSIGNED,
    PRIMARY KEY (access_token),
    FOREIGN KEY (id_user) REFERENCES user (id)
);
CREATE TABLE session_stamp (
    datestamp BIGINT UNSIGNED NOT NULL
);
INSERT INTO session_stamp VALUES(0);
UPDATE version SET `number`=2;

-- Version 3
CREATE TABLE book (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    cover VARCHAR(255) NOT NULL,
    rating VARCHAR(255) NOT NULL,
    detail VARCHAR(255) NOT NULL,
    review BLOB NOT NULL,
    PRIMARY KEY (id)
);
UPDATE version SET `number`=3;

-- Version 4
ALTER TABLE user
ADD profilepic VARCHAR(255);
UPDATE version SET `number`= 4;

-- Version 5
CREATE TABLE orderbook(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    orderdate DATETIME NOT NULL,
    userid INT UNSIGNED NOT NULL,
    bookid INT UNSIGNED NOT NULL,
    total INT NOT NULL,
    rating float(2,1),
    reviewcomment VARCHAR(1024),
    FOREIGN KEY(userid) REFERENCES user(id),
    FOREIGN KEY(bookid) REFERENCES book(id),
    PRIMARY KEY(id)
);

ALTER TABLE book
DROP COLUMN rating;

UPDATE version SET `number`= 5;

-- Version 6
ALTER TABLE book
DROP COLUMN review;

UPDATE version SET `number`= 6;

-- Version 7
ALTER TABLE book
ADD COLUMN bookpicture VARCHAR(255);

ALTER TABLE orderbook
ADD COLUMN ordernumber INT UNSIGNED NOT NULL;

UPDATE version SET `number` = 7;

-- Version 8
INSERT INTO `book`(`title`, `author`, `cover`, `detail`) 
VALUES ('Bis Fantastis & Cara Menemukannya','Neue Salamander','statics/img/fantastic_beasts.jpg','Buku ini adalah buku ajaib yang berisi tentang dongeng-dongeng di masa lampau. Salah satu cerita dari buku ini adalah tentang bis ajaib.');

INSERT INTO `book`(`title`, `author`, `cover`, `detail`) 
VALUES ('Nota Hidup','Light R. D. B. ','statics/img/death_note.jpg','Buku ajaib yang berisi nama orang-orang terpilih. Jika namamu tertulis di buku ini maka kamu adalah salah satu orang yang beruntung.');
UPDATE version SET `number` = 8;

-- Version 9
ALTER TABLE orderbook
DROP COLUMN ordernumber;

UPDATE version SET `number` = 9;
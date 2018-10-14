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
UPDATE version SET `number`=2;
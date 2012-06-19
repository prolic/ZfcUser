CREATE TABLE user
(
    user_id       INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    username      VARCHAR(255) DEFAULT NULL UNIQUE,
    email         VARCHAR(255) NOT NULL UNIQUE,
    display_name  VARCHAR(50) DEFAULT NULL,
    password      VARCHAR(128) NOT NULL,
    last_login    DATETIME DEFAULT NULL,
    last_ip       INTEGER DEFAULT NULL,
    register_time DATETIME NOT NULL,
    register_ip   INTEGER NOT NULL,
    active        TINYINT(1) NOT NULL,
    enabled       TINYINT(1) NOT NULL
) ENGINE=InnoDB;

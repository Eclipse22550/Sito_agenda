CREATE DATABASE my_organizeriec;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS docenti (
    id int(11) not null AUTO_INCREMENT,
    prof_code int(32) not null,
    name text(50) not null ,
    lname text(50) not null ,
    sigla text(20) not null ,
    email varchar(255) not null ,
    matu tinyint(4) not null ,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    updated_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id),
    UNIQUE (prof_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admin (
    id int(11) not null AUTO_INCREMENT,
    user_code int(32) not null ,
    name text(50) not null ,
    lname text(50) not null ,
    email varchar(255) not null ,
    username char(100) not null ,
    password blob not null ,
    roleid int(32) not null ,
    isActive int(32) not null ,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    updated_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id),
    UNIQUE (user_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS login (
    id int(11) not null AUTO_INCREMENT,
    user_code int(32) not null,
    name text(50) not null,
    lname text(50) not null,
    email varchar(255) not null,
    username char(100) not null,
    password blob not null,
    roleid int(32)  not null,
    isActive int(32)  not null,
    matu int(32) not null,
    qta int(32) not null,
    year varchar(15) not null DEFAULT '2020 - 2021',
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    updated_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id),
    UNIQUE (user_code),
    INDEX (matu),
    INDEX (roleid)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS events (
    id int(11) not null AUTO_INCREMENT,
    events_code int(32) not null,
    tag int(32) not null,
    idate date not null,
    hour varchar(25) not null,
    ename text(50) not null,
    descr varchar(500) not null,
    prio int(32) not null,
    vis int(32) not null,
    matu int(32) not null,
    checking int(32) not null,
    writter_code int(32) not null, 
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    updated_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id),
    INDEX (writter_code),
    INDEX (tag),
    INDEX(matu),
    INDEX (vis),
    INDEX (prio),
    INDEX (checking),
    UNIQUE (events_code),
    FOREIGN KEY(writter_code) REFERENCES login (user_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS moduli (
    id int(11) not null AUTO_INCREMENT,
    modul_code int(32) not null,
    name char(50) not null,
    PRIMARY KEY(id),
    UNIQUE (modul_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tips (
    id int(11) not null AUTO_INCREMENT,
    code_tips int(32) not null,
    title text(100) not null,
    vis int(32) not null,
    matu int(32) not null,
    writter_code int(32) not null,
    PRIMARY KEY (id),
    INDEX (writter_code),
    INDEX (vis),
    INDEX (matu),
    UNIQUE (code_tips),
    FOREIGN KEY (writter_code) REFERENCES login (user_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS coder (
    id int(11) not null AUTO_INCREMENT,
    code int(32) not null,
    name text(25) not null,
    mix text(25) not null,
    PRIMARY KEY(id),
    UNIQUE(code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS block (
    id int(11) not null AUTO_INCREMENT,
    block_code int(11) not null,
    blocco int(32) not null,
    giorno int(32) not null,
    materia_1 int(32) not null,  
    materia_2 int(32) not null,
    materia_3 int(32) not null,
    materia_4 int(32) not null,
    materia_5 int(32) not null,
    materia_6 int(32) not null,
    materia_7 int(32) not null,
    materia_8 int(32) not null,
    materia_9 int(32) not null,
    materia_10 int(32) not null,
    matu int(32) not null,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    updated_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    user_code int(11) not null,
    PRIMARY KEY(id),
    UNIQUE (block_code),
    INDEX (materia_1),
    INDEX (materia_2),
    INDEX (materia_3),
    INDEX (materia_4),
    INDEX (materia_5),
    INDEX (materia_6),
    INDEX (materia_7),
    INDEX (materia_8),
    INDEX (materia_9),
    INDEX (materia_10),
    INDEX (matu)        
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS plus (
    id int(11) not null AUTO_INCREMENT,
    day timestamp not null,
    events_code int(32) not null,
    tag int(32) not null,
    idate date not null,
    hour char(50) not null,
    ename text(50) not null,
    descr varchar(500) not null,
    prio int(32) not null,
    vis int(32) not null,
    matu int(32) not null,
    user_code int(32) not null,
    checking int(32) not null,
    writter_code int(32) not null,
    PRIMARY KEY (id),
    INDEX (events_code), 
    INDEX (tag),
    INDEX (prio),
    INDEX (vis),
    INDEX (matu),
    INDEX (user_code),
    INDEX (checking),
    INDEX (writter_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS oss (
    id int(11) not null AUTO_INCREMENT,
    oss_code int(32) not null, 
    blocco int(32) not null,
    sig_doc int(32) not null,
    materia int(32) not null,
    data date not null,
    text varchar(500) not null,
    user_code int(11) not null,    
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    updated_at timestamp not null DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id),
    UNIQUE(oss_code),
    INDEX(blocco),
    INDEX(sig_doc),
    INDEX(materia),
    INDEX(user_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `sessions` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sessions_userid` varchar(256) NOT NULL,
    `sessions_name` varchar(256) NOT NULL,
    `sessions_hash` varchar(256) NOT NULL,
    `session_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS upload (
    id int(11) not null AUTO_INCREMENT,
    upload_code int(32) not null,
    title text(50) not null,
    dir varchar(128) not null,
    matu int(32) not null,
    vis int(32) not null,
    user_code int(11) not null,
    format int(32) not null,
    load_at date not null,
    date time not null,
    PRIMARY KEY(id),
    UNIQUE(upload_code),
    INDEX(matu),
    INDEX(vis),
    INDEX(user_code),
    INDEX(format)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE upload
ADD FOREIGN KEY(matu)       REFERENCES coder(code),
ADD FOREIGN KEY(vis)        REFERENCES coder(code),
ADD FOREIGN KEY(user_code)  REFERENCES login(user_code),
ADD FOREIGN KEY(format)     REFERENCES coder(code);

ALTER TABLE events
ADD FOREIGN KEY (tag)    REFERENCES tips     (code_tips),
ADD FOREIGN KEY (prio)   REFERENCES coder    (code),
ADD FOREIGN KEY (vis)    REFERENCES coder    (code),
ADD FOREIGN KEY (matu)   REFERENCES coder    (code);

ALTER TABLE tips
ADD FOREIGN KEY(vis)    REFERENCES coder (code),
ADD FOREIGN KEY(matu)   REFERENCES coder(code);

ALTER TABLE login
ADD FOREIGN KEY(matu)       REFERENCES coder (code),
ADD FOREIGN KEY(isActive)   REFERENCES coder(code),
ADD FOREIGN KEY(roleid)     REFERENCES coder (code),
ADD FOREIGN KEY(qta)        REFERENCES coder (code);

ALTER TABLE block
ADD FOREIGN KEY (blocco)        REFERENCES  coder(code),
ADD FOREIGN KEY (giorno)        REFERENCES  coder(code),
ADD FOREIGN KEY (materia_1)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_2)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_3)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_4)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_5)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_6)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_7)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_8)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_9)     REFERENCES  coder(code),
ADD FOREIGN KEY (materia_10)    REFERENCES  coder(code),
ADD FOREIGN KEY (matu)          REFERENCES  coder(code),
ADD FOREIGN KEY (user_code)     REFERENCES  login(user_code);

ALTER TABLE plus
ADD FOREIGN KEY (events_code)   REFERENCES  events(events_code),
ADD FOREIGN KEY (tag)           REFERENCES  tips(code_tips),
ADD FOREIGN KEY (prio)          REFERENCES  coder(code),
ADD FOREIGN KEY (vis)           REFERENCES  coder(code),
ADD FOREIGN KEY (matu)          REFERENCES  coder(code),
ADD FOREIGN KEY (user_code)     REFERENCES  login(user_code),
ADD FOREIGN KEY (checking)      REFERENCES  events(checking),
ADD FOREIGN KEY (writter_code)  REFERENCES  events(writter_code);

ALTER TABLE oss 
ADD FOREIGN KEY(blocco)     REFERENCES coder(code),
ADD FOREIGN KEY(sig_doc)    REFERENCES docenti(prof_code),
ADD FOREIGN KEY(materia)    REFERENCES coder(code),
ADD FOREIGN KEY(user_code)  REFERENCES login(user_code);
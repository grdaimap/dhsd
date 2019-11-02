CREATE DATABASE dhsd;
use dhsd;
CREATE TABLE IF NOT EXISTS `atb` (`ano`  INT NOT NULL,`anick` VARCHAR(20),`apsn`  VARCHAR(20) NOT NULL ,`endt`  INT NOT NULL ,PRIMARY KEY(`ano`));
CREATE TABLE IF NOT EXISTS `stb` (`sno`  VARCHAR(20) NOT NULL,`snick` VARCHAR(20),`endt`  INT NOT NULL ,PRIMARY KEY(`sno`));
CREATE TABLE IF NOT EXISTS `ztb` (`zno`  INT NOT NULL,`ano` INT ,`sno`INT,`context`  TEXT NOT NULL ,`createt`  INT NOT NULL ,`endt`  INT NOT NULL ,`good` INT ,PRIMARY KEY(`zno`));
CREATE TABLE IF NOT EXISTS `ctb` (`cno`  INT NOT NULL,`fnick` varchar(30),`fromwho` INT NOT NULL ,`zno` INT NOT NULL,`context`  TEXT NOT NULL ,`tnick` varchar(30),`towho` INT NOT NULL ,`createt`  INT NOT NULL ,PRIMARY KEY(`cno`));
CREATE TABLE IF NOT EXISTS `ktb` (`xno`  INT NOT NULL,`zno` INT  NOT NULL,`xty`VARCHAR(4) NOT NULL,`zty`TINYINT NOT NULL,PRIMARY KEY(`xno`,`zno`,`xty`,`zty`));

 drop table atb;drop table stb;drop table ztb;drop table ctb;drop table ktb;

select ctb.nick,ctb.context from ztb leftjoin ctb on ztb.zno = ctb.zno where ztb.ano =$_COOKIE["userno"] and ctb.createt>$_COOKIE["lasttime"];

select ctb.nick,ctb.context from ctb where ctb.towho =$_COOKIE["userno"] and ctb.createt>$_COOKIE["lasttime"];

INSERT IGNORE INTO


ALTER DATABASE dhsd CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`;

ALTER TABLE `atb` CONVERT TO CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`; 
ALTER TABLE `stb` CONVERT TO CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`; 
ALTER TABLE `ztb` CONVERT TO CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`; 
ALTER TABLE `ctb` CONVERT TO CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`; 
ALTER TABLE `ktb` CONVERT TO CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`; 

=====================
VARCHAR TEXT DATETIME TIME

show variables like '%char%';

mysql -u root -p

alitx19A%B,,,,,

net start mysql

set password for root@localhost = password('your password');

set character_set_results=gb2312;

UPDATE stb SET sno = "s2022259" where sno ="s202225";
UPDATE ztb SET sno = "s2022259" where sno ="s202225";
UPDATE ctb SET towho = "s2022259" where towho = "s202225";
UPDATE ktb SET xno = "s2022259" where xno = "s202225";

UPDATE ctb SET fromwho = "s1802284058" where fromwho = "18024058";









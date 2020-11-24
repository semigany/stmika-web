-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 09, 2020 at 06:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `semigany`
--

-- --------------------------------------------------------
drop view if exists users_view;
drop view if exists albums_view;
drop table if exists actus;
drop table if exists administrators;
drop table if exists albums;
drop table if exists domains;
drop table if exists ci_sessions;
drop table if exists domains;
drop table if exists events;
drop table if exists factulties;
drop table if exists photos;
drop table if exists promotions;
drop table if exists users;
drop table if exists faculties;
drop table if exists pwd_reset_links;
--
-- Table structure for table `actus`
--

CREATE TABLE `actus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `albums_view`
-- (See below for the actual view)
--
CREATE TABLE `albums_view` (
`id` bigint(20) unsigned
,`title` varchar(200)
,`url` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `description` text,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `album_id` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `release_year` int(11) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `start_year` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `promotion_id` int(11) DEFAULT NULL,
  `student` tinyint(1) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `employee` tinyint(1) DEFAULT NULL,
  `job_title` varchar(200) DEFAULT NULL,
  `organization_name` varchar(200) DEFAULT NULL,
  `organization_adress` varchar(200) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `request_date` date DEFAULT NULL,
  `validation_date` date DEFAULT NULL,
  `validation_note` text,
  `domain_id` int(11) DEFAULT NULL
);

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Structure for view `albums_view`
--
DROP TABLE IF EXISTS `albums_view`;

create or replace VIEW `albums_view`  AS  select `a`.`id` AS `id`,`a`.`title` AS `title`,`p`.`url` AS `url` from (`albums` `a` join `photos` `p`) where (`p`.`id` = (select `q`.`id` from `photos` `q` where (`q`.`album_id` = `a`.`id`) limit 1)) ;

-- --------------------------------------------------------

--
-- Structure for view `users_view`
--
DROP TABLE IF EXISTS `users_view`;

create or replace VIEW `users_view`  AS  select `u`.`id` AS `id`,`u`.`identifiant` AS `identifiant`,
`u`.`first_name` AS `first_name`,`u`.`last_name` AS `last_name`,`u`.`email` AS `email`,
`u`.`phone_number` AS `phone_number`,`u`.`adress` AS `adress`,`u`.`birth_date` AS `birth_date`,
`u`.`start_year` AS `start_year`,`u`.`end_year` AS `end_year`,`u`.`photo` AS `photo`,
`u`.`password` AS `password`,`u`.`promotion_id` AS `promotion_id`,`u`.`student` AS `student`,
`u`.`school_name` AS `school_name`,`u`.`faculty_id` AS `faculty_id`,`u`.`level` AS `level`,
`u`.`employee` AS `employee`,`u`.`job_title` AS `job_title`,`u`.`organization_name` AS `organization_name`,
`u`.`organization_adress` AS `organization_adress`,`u`.`active` AS `active`,`u`.`request_date` AS `request_date`,
`u`.`validation_date` AS `validation_date`,`u`.`validation_note` AS `validation_note`,
`u`.`domain_id` AS `domain_id`,`p`.`name` AS `promotion`,`p`.`release_year` AS `release_year`
from (`users` `u` left join `promotions` `p` on((`u`.`promotion_id` = `p`.`id`))) ;


CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

ALTER TABLE ci_sessions ADD PRIMARY KEY (id, ip_address);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actus`
--
ALTER TABLE `actus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actus`
--
ALTER TABLE `actus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


insert into administrators (first_name, last_name, username, password) values ('Administrator', 'Semigany', 'stadmin', 'stadmin-7688');

insert into faculties (title) values ('IT');
insert into faculties (title) values ('Com');
insert into faculties (title) values ('Medecine');

insert into domains (title) values ('Freelance');
insert into domains (title) values ('Exportation');

insert into promotions (release_year, name) values (1957, 'Radama');
insert into promotions (release_year, name) values (1958, 'Tananarive');
insert into promotions (release_year, name) values (1959, 'Alain Navassartian');
insert into promotions (release_year, name) values (1960, 'Juillet 1960');
insert into promotions (release_year, name) values (1961, 'Tradition et progrès');
insert into promotions (release_year, name) values (1962, 'Andry');
insert into promotions (release_year, name) values (1963, 'Voromahery');
insert into promotions (release_year, name) values (1964, 'Amitié');
insert into promotions (release_year, name) values (1965, 'Tantely');
insert into promotions (release_year, name) values (1966, 'Andrianampoina');
insert into promotions (release_year, name) values (1967, 'Firaisan-kina');
insert into promotions (release_year, name) values (1968, 'Vatolampy');
insert into promotions (release_year, name) values (1969, 'Antso');
insert into promotions (release_year, name) values (1970, 'Ako');
insert into promotions (release_year, name) values (1971, 'Ady');
insert into promotions (release_year, name) values (1972, 'Avotra');
insert into promotions (release_year, name) values (1973, '');
insert into promotions (release_year, name) values (1974, 'Ainga');
insert into promotions (release_year, name) values (1975, 'Hery');
insert into promotions (release_year, name) values (1976, 'Fanantenana');
insert into promotions (release_year, name) values (1977, 'Fihavanana');
insert into promotions (release_year, name) values (1978, 'Taratra');
insert into promotions (release_year, name) values (1979, 'Toky');
insert into promotions (release_year, name) values (1980, 'Manda');
insert into promotions (release_year, name) values (1981, 'Ezaka');
insert into promotions (release_year, name) values (1982, '');
insert into promotions (release_year, name) values (1983, 'Onja');
insert into promotions (release_year, name) values (1984, 'Sandratra');
insert into promotions (release_year, name) values (1985, 'Mahefa');
insert into promotions (release_year, name) values (1986, 'Diamondra');
insert into promotions (release_year, name) values (1987, 'Fanasina');
insert into promotions (release_year, name) values (1988, 'Centenaire');
insert into promotions (release_year, name) values (1989, 'Victoire RASOAMANARIVO');
insert into promotions (release_year, name) values (1990, 'Tsy lavo');
insert into promotions (release_year, name) values (1991, 'Saint Ignace de Loyola');
insert into promotions (release_year, name) values (1992, '');
insert into promotions (release_year, name) values (1993, 'Vonona');
insert into promotions (release_year, name) values (1994, 'Sandratra');
insert into promotions (release_year, name) values (1995, 'Aina');
insert into promotions (release_year, name) values (1996, 'Kintana');
insert into promotions (release_year, name) values (1997, 'Kiady');
insert into promotions (release_year, name) values (1998, 'Fanilo');
insert into promotions (release_year, name) values (1999, 'Sahy');
insert into promotions (release_year, name) values (2000, 'Mijoro');
insert into promotions (release_year, name) values (2001, 'Lafatra');
insert into promotions (release_year, name) values (2002, 'Taratra');
insert into promotions (release_year, name) values (2003, 'Andraina');
insert into promotions (release_year, name) values (2004, 'Amboara');
insert into promotions (release_year, name) values (2005, 'Rary');
insert into promotions (release_year, name) values (2006, 'Iloaina');
insert into promotions (release_year, name) values (2007, 'Soamihary & Velirano');
insert into promotions (release_year, name) values (2008, 'Hasin-johary');
insert into promotions (release_year, name) values (2009, 'Harisandratra');
insert into promotions (release_year, name) values (2010, 'Njamanolo');
insert into promotions (release_year, name) values (2011, 'Hajary');
insert into promotions (release_year, name) values (2012, 'Avatsy & Mahatsangy Ndrofilahy');
insert into promotions (release_year, name) values (2013, 'Andraraja');
insert into promotions (release_year, name) values (2014, 'Rohondroho & Fatsadroahoho');
insert into promotions (release_year, name) values (2015, 'Irà');
insert into promotions (release_year, name) values (2016, 'Rohy');
insert into promotions (release_year, name) values (2017, 'Raitra');
insert into promotions (release_year, name) values (2018, 'Voara');
insert into promotions (release_year, name) values (2019, 'Tsilefy & Vona');

create table pwd_reset_links (
  id integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email varchar(100) not null,
  created_at TIMESTAMP not null,
  expire_at TIMESTAMP not null default CURRENT_TIMESTAMP(),
  token varchar(100) not null
);
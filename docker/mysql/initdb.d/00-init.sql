DROP DATABASE IF EXISTS ni_assessment;
CREATE DATABASE IF NOT EXISTS ni_assessment DEFAULT CHARACTER SET utf8;

use ni_assessment;

-- create table users
create table users (
                       id int auto_increment primary key,
                       name varchar(400) not null default '',
                       email varchar(400) not null default '',
                       password varchar(400) not null default '',
                       token varchar(400) not null default '',
                       index (email(10))
) engine InnoDB;

-- create table products
CREATE TABLE products (
                          id int auto_increment primary key,
                          sku varchar (200) unique not null,
                          name varchar (200)
) engine InnoDB;

-- create table purchased
CREATE TABLE purchased (
                           id int auto_increment primary key,
                           user_id int not null,
                           product_sku varchar (200)
) engine InnoDB;

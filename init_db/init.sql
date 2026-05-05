CREATE DATABASE IF NOT EXISTS projeto_devops;
USE projeto_devops;

create table if not exists produtos(
id int auto_increment primary key,
categoria varchar(30) not null,
produto varchar(40) not null,
preco decimal(10,2) not null,
estoque int default 0) engine=innodb;

create table if not exists vendas(
id int auto_increment primary key,
categoria varchar(30) not null,
produto varchar(40) not null,
preco decimal(10,2) not null,
quantidade int not null,
estoque int default 0,
Data_registro datetime default current_timestamp,
mes_ano varchar(10) not null) engine=innodb;

create table if not exists users(
    id int auto_increment primary key,
    username varchar(50) unique not null,
    email varchar(255) not null,
    password_hash varchar(255) not null,
    created_at datetime default current_timestamp
)

insert into users (username, email, password_hash) values ('admin', 'admin@admin.com', password_hash('admin123', password_default()));

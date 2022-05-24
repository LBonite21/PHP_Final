drop database if exists PHPFinal;
create database PHPFinal;
use PHPFinal;

CREATE User if not exists 'MyUser'@'localhost' IDENTIFIED BY 'MyPass';
GRANT ALL PRIVILEGES ON PHPFinal.* TO MyUser@localhost;

create table if not exists Users (
	primary key(id),
    id				int				not null	auto_increment,
    username		varchar(100)	not null	unique,
    password_hash	varchar(100)	not null
);

create table if not exists Court (
	primary key(id),
    id				int					not null	auto_increment,
    court_name		varchar(500)		not null,
    coordinates		point				not null
);

create table if not exists FavoriteCourts (
	primary key(id),
    foreign key(court_id) references Court(id) on delete cascade,
    id				int			not null	auto_increment,
    court_id		int			not null
);
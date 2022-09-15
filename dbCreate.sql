drop database if exists PHPFinal;
create database PHPFinal;
use PHPFinal;

CREATE User if not exists 'MyUser'@'localhost' IDENTIFIED BY 'MyPass';
GRANT ALL PRIVILEGES ON PHPFinal.* TO MyUser@localhost;

create table if not exists FavoriteCourt (
	primary key(id),
    id				int					not null	auto_increment,
    court_name		varchar(500)		not null,
    location		varchar(500)		not null
);

insert into FavoriteCourt(court_name, location) values ("Mountview Basketball Courts", "1651 Fort Union Blvd, Cottonwood Heights");
insert into FavoriteCourt(court_name, location) values ("Cottonwood Heights Basketball Court", "Cottonwood Heights");
insert into FavoriteCourt(court_name, location) values ("Buttercup Park Basketball Court", "10042 Pinehurst Dr, Sandy");

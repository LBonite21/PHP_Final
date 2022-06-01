drop database if exists PHPFinal;
create database PHPFinal;
use PHPFinal;

CREATE User if not exists 'MyUser'@'localhost' IDENTIFIED BY 'MyPass';
GRANT ALL PRIVILEGES ON PHPFinal.* TO MyUser@localhost;

create table if not exists FavoriteCourt (
	primary key(id),
    id				int					not null	auto_increment,
    court_name		varchar(500)		not null,
    lat				varchar(50)			not null,
    lng				varchar(50)			not null
);

insert into FavoriteCourt(court_name, lat, lng) values ("Mountview Basketball Courts", "40.6265671", "-111.8450203");
insert into FavoriteCourt(court_name, lat, lng) values ("Cottonwood Heights Basketball Court", "40.6169213", "-111.8159971");
insert into FavoriteCourt(court_name, lat, lng) values ("Ivory Highlands Park Basketball Court", "40.63154", "-111.962031");

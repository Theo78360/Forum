drop database if exists correc;
create database correc;
use correc;

create table categorie(
	idc int(3) not null,
	titre varchar(50),
	primary key(idc)
);

create table topic (	
	idt int(3) not null,
	titre varchar(75),
	description varchar(100),
	primary key(idt)
);


create table posts(
	id int(3) not null,
	contenu varchar(500),
	primary key(id)
	);

create table users(
	id int(3) not null,
	login varchar(50),
    email varchar(50),
	password varchar(50),
	lvl int(3),
	primary key (id)
);

insert into users values (1,"Pedro","p@gmail.com","1234",2);





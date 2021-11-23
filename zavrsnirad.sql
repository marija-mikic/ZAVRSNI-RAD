drop database if exists zavrsnirad;
create database zavrsnirad;
use zavrsnirad;


create table jelo(
    sifra int  primary key not null auto_increment,
    sastav varchar(50) not null,

);

create table kupci(
    sifra int primary key not null auto_increment,
    ime varchar (30) not null,
    prezime varchar(30) not null,
    adresa varchar(40) not null,
    vrstaplacanja varchar(30) not null
    
);
create table vrste(
    sifra int primary key not null auto_increment,
    pizze varchar(30),
    rostilj varchar(30),
    salata varchar(30),
    alkoholna(30),
    bezalkoholna (30),
    pice int,
    jelo int

)
create table narudzbe(
    sifra int primary key not null auto_increment,
    vrstaplacanja varchar(30)not null,
    mjestopreuzimanja varchar(30) not null,
    datum datetime,
    kupci int
    
);


create table pice(
    sifra int primary key not null auto_increment,
    naziv varchar(30) not null,
   );




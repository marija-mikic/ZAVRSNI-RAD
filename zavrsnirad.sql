drop database if exists zavrsnirad;
create database zavrsnirad;
use zavrsnirad;

create table jelovnik(
    sifra int  primary key not null auto_increment,
    cijena decimal (18,2) not null,
    datum datetime

);

create table jelo(
    sifra int  primary key not null auto_increment,
    vrsta varchar(50) not null,
    sastav varchar(50) not null,
    jelovnik int

);

create table kupci(
    sifra int primary key not null auto_increment,
    ime varchar (30) not null,
    prezime varchar(30) not null,
    adresa varchar(40) not null,
    vrstaplacanja varchar(30) not null
    
);

create table narudzbe(
    sifra int primary key not null auto_increment,
    vrstaplacanja varchar(30)not null,
    mjestopreuzimanja varchar(30) not null,
    datum datetime,
    kupci int,
    dostavljac int,
    jelo int, 
    pice int
);
create table dostavljac(
    sifra int primary key not null auto_increment,
    ime varchar(30) not null,
    prezime varchar (30) not null,
    vozilo varchar(30),
    smjena int not null

);

create table pice(
    sifra int primary key not null auto_increment,
    naziv varchar(30) not null,
    vrsta varchar(30) not null,
    jelovnik int
);

alter table jelo add foreign key (jelovnik) references jelovnik(sifra);
alter table narudzbe add foreign key(kupci) references kupci(sifra);
alter table narudzbe add foreign key (dostavljac) references dostavljac(sifra);
alter table narudzbe add foreign key(jelo) references jelo(sifra);
alter table pice add foreign key(jelovnik) references jelovnik(sifra);
alter table narudzbe add foreign key(pice) references pice(sifra);



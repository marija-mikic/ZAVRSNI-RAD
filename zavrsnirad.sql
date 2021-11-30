drop database if exists zavrsni;
create database zavrsni;
use zavrsni;        


create table jelo (
    sifra int  primary key not null auto_increment,
    naziv varchar (50),
    sastav varchar(50) not null,
    slika varchar(100),
    cijena decimal(18,2),
    vrsta int
    
);

create table kupac(
    sifra int primary key not null auto_increment,
    ime varchar (30) not null,
    prezime varchar(30) not null,
    adresa varchar(40) not null,
    vrstaplacanja varchar(30) not null
    
);
create table vrsta(
    sifra int primary key not null auto_increment,
    naziv varchar (50)
   

);
create table narudzba(
    sifra int primary key not null auto_increment,
    vrstaplacanja varchar(30)not null,
    mjestopreuzimanja varchar(30) not null,
    datum datetime,
    kupac int
    
);


create table pice(
    sifra int primary key not null auto_increment,
    naziv varchar(30) not null,
    slika varchar(100),
    cijena decimal(18,2)not null,
    vrsta int
   );


create table narudzba_jelo(
    sifra int primary key not null auto_increment,
    jelo int,
    narudzba int,
    cijena decimal(18,2) not null,
    kolicina int not null,

);

create table narudzba_pice (
    sifra int primary key not null auto_increment,
    pice int,
    narudzba int,
    cijena decimal(18,2)not null,
    kolicina int not null
);

alter table jelo add foreign key (vrsta) references vrsta(sifra);
alter table narudzba add foreign key (kupac)references kupac (sifra);
alter table pice add foreign key (vrsta) references vrsta(sifra);
alter table narudzba_jelo add foreign key(jelo) references jelo(sifra);
alter table narudzba_pice add foreign key(pice) references pice(sifra);
alter table narudzba_jelo add foreign key(narudzba) references narudzba(sifra);
alter table narudzba_pice add foreign key(narudzba) references narudzba(sifra);







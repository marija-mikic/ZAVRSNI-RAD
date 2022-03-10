drop database if exists zavrsni;
create database zavrsni;
use zavrsni;     

alter database zavrsni character set utf8mb4;

create table operater (
    sifra int not null primary key auto_increment,
    email varchar(50) not null,
    lozinka char (60) not null,
    ime varchar (50) not null,
    prezime varchar (50) not null,
    uloga varchar (10) not null
);

create table jelo (
    sifra int  primary key not null auto_increment,
    naziv varchar (50),
    sastav varchar(50) not null,
    slika varchar(100) not null,
    cijena decimal(18,2),
    vrsta int
);

create table kupac(
    sifra int primary key not null auto_increment,
    ime varchar (30) not null,
    prezime varchar(30) not null,
    adresa varchar(40) not null,
    email varchar(50) not null,
    lozinka char (60) not null
);

create table vrsta(
    sifra int primary key not null auto_increment,
    naziv varchar (50)
);

create table narudzba(
    sifra int primary key not null auto_increment,
    proizvodi varchar(200) not null,
    mjestopreuzimanja varchar(30) not null,
    datum datetime,
    cijena int not null,
    kupac int
);

create table pice(
    sifra int primary key not null auto_increment,
    naziv varchar(30) not null,
    slika varchar(100) not null,
    cijena decimal(18,2)not null,
    vrsta int
);

create table narudzba_jelo(
    sifra int primary key not null auto_increment,
    jelo int,
    narudzba int,
    cijena decimal(18,2) not null,
    kolicina int not null
);

create table narudzba_pice (
    sifra int primary key not null auto_increment,
    pice int,
    narudzba int,
    cijena decimal(18,2)not null,
    kolicina int not null
);

alter table jelo add foreign key (vrsta) references vrsta(sifra);
alter table narudzba add foreign key (kupac) references kupac(sifra);
alter table pice add foreign key (vrsta) references vrsta(sifra);
alter table narudzba_jelo add foreign key(jelo) references jelo(sifra);
alter table narudzba_pice add foreign key(pice) references pice(sifra);
alter table narudzba_jelo add foreign key(narudzba) references narudzba(sifra);
alter table narudzba_pice add foreign key(narudzba) references narudzba(sifra);

insert into operater(email,lozinka,ime,prezime,uloga) values
# lozinka a
('admin@mamik-dj.shop','$2a$12$gcFbIND0389tUVhTMGkZYem.9rsMa733t9J9e9bZcVvZiG3PEvSla','Administrator','Mamik-dj','admin'),
# lozinka o
('oper@mamik-dj.shop','$2a$12$S6vnHiwtRDdoUW4zgxApvezBlodWj/tmTADdmKxrX28Y2FXHcoHOm','Operater','Mamik-dj','oper');

insert into vrsta(sifra,naziv) values
(null,'pivo'),
(null,'vino'),
(null,'jaka alkoholna pica'),
(null,'bezalkoholna pića'),
(null,'topli napici'),
(null,'rostilj'),
(null,'pizza');

insert into jelo(sifra,naziv,sastav,slika,cijena,vrsta) values
(null,'Ćevapi u somunu','lepinja, luk, ajvar','jelo.jpg','30',6),
(null,'Ćevapi i pommes frites','lepinja, luk, pommes frites, ajvar','jelo.jpg','30',6),
(null,'Ražnjići',' lepinja, luk, ajvar, pommes frites','jelo.jpg','30',6),
(null,'Punjena pljeskavica', 'sir, lepinja, luk, ajvar, pommes frites','jelo.jpg','31',6),
(null,'Pljeskavica','lepinja, luk, ajvar, pommes frites','jelo.jpg','31',6),
(null,'Miješano meso','lepinja, carsko, kotlet','jelo.jpg','31',6),
(null,'Bianco capri','sir, gljive, šunka, vrhnje','jelo.jpg','30',7),
(null,'Bianco','vrhnje, sir, špek, feferoni','jelo.jpg','30',7),
(null,'Peperone	rajčica',' sir, šunka, gljive, češnjak,feferoni','jelo.jpg','30',7),
(null,'Pigalo bianco', 'vrhnje, sir, suhi vrat, svježa paprika','jelo.jpg','31',7),
(null,'Pileća','rajčica, sir, gljive, piletina','jelo.jpg','31',7),
(null,'Dalmatina','rajčica, sir, pršut, masline, gljive','jelo.jpg','31',7),
(null,'Pršuto','sir, rajčica, pršut, masline, gljive, slanina','jelo.jpg','32',7),
(null,'Đakovačka','sir, rajčica, kulen, slanina, luk, ajvar','jelo.jpg','31',7),
(null,'Strossmayerova','sir, rajčica, kulen, šunka, gorgonzola, vrhnje','jelo.jpg','32',7),
(null,'Ljutica','sir, rajčica, kulen, čili, ljuti feferoni, ajvar','jelo.jpg','30',7);

insert into pice(sifra,naziv,slika,cijena,vrsta) values
(null,'pann','pice.jpg','15',1),
(null,'grasevina','pice.jpg','25',2),
(null,'cocacola','pice.jpg','10',4);

insert into kupac(sifra, ime,prezime,adresa,vrstaplacanja) values
(null,'Marija','Mikic','B.Adzije 26','gotovina'),
(null,'Ana','Jurić','B.Jelacica 30','gotovina'),
(null,'Bruno','Klaric','Stepinca 10','gotovina');

insert into narudzba (sifra,vrstaplacanja,mjestopreuzimanja,datum,kupac) values
(null,'gotovina','dostava','2021-12-05',1),
(null,'gotovina','preuzimanje','2021-12-05',2),
(null,'gotovina','dostava','2021-12-05',3);

insert into narudzba_pice (sifra,pice,narudzba,cijena,kolicina) values
(null,1,1,'20','2'),
(null,1,1,'20','2'),
(null,1,1,'20','2');

insert into narudzba_jelo (sifra,jelo,narudzba,kolicina,cijena) values
(null,1,2,'2',20),
(null,1,3,'2',20),
(null,1,2,'2',20);
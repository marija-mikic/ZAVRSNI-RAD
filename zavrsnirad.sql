drop database if exists zavrsni;
create database zavrsni;
use zavrsni;        


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
alter table narudzba add foreign key (kupac)references kupac (sifra);
alter table pice add foreign key (vrsta) references vrsta(sifra);
alter table narudzba_jelo add foreign key(jelo) references jelo(sifra);
alter table narudzba_pice add foreign key(pice) references pice(sifra);
alter table narudzba_jelo add foreign key(narudzba) references narudzba(sifra);
alter table narudzba_pice add foreign key(narudzba) references narudzba(sifra);


insert into vrsta(sifra,naziv)values
(null,'pivo'),
(null,'vino'),
(null,'jakaalkoholnapica'),
(null,'bezalkoholnapića'),
(null,'toplinapici');

insert into jelo(sifra,naziv,sastav,slika,cijena,vrsta)values
(null,'Ćevapi u somunu ','lepinja, luk, ajvar',null,'30',2),
(null,' Ćevapi i pommes frites ','lepinja, luk, pommes frites, ajvar',null,'30',2),
(null,' Ražnjići ',' lepinja, luk, ajvar, pommes frites',null,'30',2),
(null,' Punjena pljeskavica ', 'sir, lepinja, luk, ajvar, pommes frites',null,'31',2),
(null,' Pljeskavica ','lepinja, luk, ajvar, pommes frites',null,'31',2),
(null,'Miješano meso ',' lepinja, carsko, kotlet',null,'31',2 );

insert into jelo(sifra,naziv,sastav,slika,cijena,vrsta)values
(null,'Bianco capri','sir, gljive, šunka, vrhnje',null,'30',1),
(null,'Bianco','vrhnje, sir, špek, feferoni',null,'30',1),
(null,'Peperone	rajčica',' sir, šunka, gljive, češnjak,feferoni',null,'30',1),
(null,'Pigalo bianco', 'vrhnje, sir, suhi vrat, svježa paprika',null,'31',1),
(null,'Pileća','rajčica, sir, gljive, piletina',null,'31',1),
(null,'Dalmatina',' rajčica, sir, pršut, masline, gljive',null,'31',1 ),
(null,'Pršuto','sir, rajčica, pršut, masline, gljive, slanina',null,'32',1),
(null,'Đakovačka','sir, rajčica, kulen, slanina, luk, ajvar',null,'31',1 ),
(null,'Strossmayerova','sir, rajčica, kulen, šunka, gorgonzola, vrhnje',null,'32',1),
(null,'Ljutica','sir, rajčica, kulen, čili, ljuti feferoni, ajvar',null,'30',1);

insert into pice(sifra,naziv,slika,cijena,vrsta)values
(null,'pann',null,'15',1),
(null,'grasevina',null,'25',2),
(null,'cocacola',null,'10',4);

insert into kupac(sifra, ime,prezime,adresa,vrstaplacanja)values
(null,'Marija','Mikic','B.Adzije 26','gotovina'),
(null,'Ana','Jurić','B.Jelacica 30','gotovina'),
(null,'Bruno','Klaric','Stepinca 10','gotovina');

insert into narudzba (sifra,vrstaplacanja,mjestopreuzimanja,datum,kupac)values
(null,'gotovina','dostava','2021-12-05',1),
(null,'gotovina','preuzimanje','2021-12-05',2),
(null,'gotovina','dostava','2021-12-05',3);

insert into narudzba_pice (sifra,pice,narudzba,cijena,kolicina)values
(null,1,1,'20','2'),
(null,1,1,'20','2'),
(null,1,1,'20','2');

insert into narudzba_jelo (sifra,jelo,narudzba,kolicina,cijena)values
(null,1,2,'2',20),
(null,1,3,'2',20),
(null,1,2,'2',20);
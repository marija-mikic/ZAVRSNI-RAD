drop database if exists zavrsnirad;
create database zavrsnirad;
use zavrsnirad;     
# C:\xampp\mysql\bin\mysql -uedunova -pedunova --default_character_set=utf8 < D:\EdunovaPP24\zavrsnirad.sql
alter database zavrsnirad character set utf8mb4;

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
    slika varchar(100),
    naziv varchar (50),
    sastav varchar(50) not null,
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
    adresa varchar(100) not null,
    datum datetime,
    ukupno int not null,
    naruceno boolean,
    kupac int
);

create table pice(
    sifra int primary key not null auto_increment,
    slika varchar(100),
    naziv varchar(30) not null,
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
    cijena decimal(18,2) not null,
    kolicina int not null
);

create table status_narudzbe(
sifra int primary key not null auto_increment,
zaprimljeno boolean,
u_izradi boolean,
u_dostavi boolean,
dostavljeno boolean

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
(null,'salate'),
(null,'pica'),
(null,'plate'),
(null,'pizza');

insert into kupac(sifra, ime,prezime,adresa,email,lozinka) values
(null,'Marija','Mikic','B.Adzije 26','m@gmail','1'),
(null,'Ana','Jurić','B.Jelacica 30','m@gmail','2'),
(null,'Bruno','Klaric','Stepinca 10','m@gmail','3');

insert into narudzba (sifra,adresa,datum,ukupno,naruceno,kupac) values
(null,'dostava','2021-12-05','100',true,1),
(null,'dostava','2021-12-05','100',false,2),
(null,'dostava','2021-12-05','100',false,2);


insert into jelo(sifra,naziv,sastav,slika,cijena,vrsta) values
(null,'Čevapi u somunu','lepinja, luk, ajvar','mjesano.jpg','30',3),
(null,'Čevapi i pommes frites','lepinja, luk, pommes frites, ajvar','cevapisapomesom.jpg','30',3),
(null,'Ražnjići',' lepinja, luk, ajvar, pommes frites','raznjici.jpg','30',3),
(null,'Peperone	rajčica',' sir, šunka, gljive, češnjak,feferoni','pizza1.jpg','30',4),
(null,'Pršuto','sir, rajčica, pršut, masline, gljive, slanina','pizza2.jpg','32',4),
(null,'Đakovačka','sir, rajčica, kulen, slanina, luk, ajvar','pizza3.jpg','31',4),
(null,'Zelena','sir, rajčica, kulen, šunka, gorgonzola, vrhnje','zelenasalata.webp','32',1),
(null,'Rajčica','sir, rajčica, kulen, čili, ljuti feferoni, ajvar','rajcica.jpg','30',1),
(null,'Šopska','sir, rajčica, kulen, čili, ljuti feferoni, ajvar','sopskasalata.jpeg','30',1);

insert into pice(sifra,naziv,slika,cijena,vrsta) values
(null,'pann','pan.jpg','15',2),
(null,'grasevina','grasevina.jpg','25',2),
(null,'cocacola','coca-cola.jpg','10',2);

insert into narudzba_pice (sifra,pice,narudzba,cijena,kolicina) values
(null,1,1,'20','2');


insert into narudzba_jelo (sifra,jelo,narudzba,kolicina,cijena) values
(null,1,2,'2',20),
(null,1,3,'2',20),
(null,1,2,'2',20);




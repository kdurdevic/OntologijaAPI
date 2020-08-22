create database kdurdevic_19 default character set utf8;
use kdurdevic_19;
create table ontologija(
    sifra int not null primary key auto_increment,
    knjiga varchar(255) not null,
    nakladnik varchar(100) not null,
    objavljena varchar(100) not null,
    imaStranica int not null,
    dostupnost int not null,
    brPosudbi int not null,
    vrijemePosudbe varchar(255) not null
);

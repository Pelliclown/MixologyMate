create database if not exists mixologymate;
use mixologymate;


create table if not exists utenti(
	idUtente int(5) primary key auto_increment not null,
	immagine varchar(200)
); 

create table if not exists gestionePassword(
	nickname varchar(30) primary key not null,
	password varchar(30) not null,
    idUtente int(5) not null,
    foreign key (idUtente) references utenti(idUtente)
);
 
create table if not exists drink(
	idDrink int(5) primary key auto_increment not null,
	idCreatore int(5),
	immagine varchar(200),
    dataCreazione date,
	foreign key (idCreatore) references utenti(idUtente)
); 

create table if not exists gestioneDrink(
	nome varchar(20) primary key not null,
	descrizione varchar(250) not null,
    idDrink int(5) not null,
    foreign key (idDrink) references drink(idDrink)
);

create table if not exists recensioni(
	idRecensione int(5) primary key auto_increment not null,
	descrizione varchar(250) not null,
	idCreatore int(5),
	numeroStelle int(1) not null,
    dataCreazione date,
	idDrink int(5) not null,
	foreign key (idCreatore) references utenti(idUtente),
	foreign key (idDrink) references drink(idDrink)
); 

create table if not exists ingredienti(
	idIngrediente int(2) primary key auto_increment not null,
	nomeIngrediente varchar(50) not null
); 

create table if not exists associazioneIngredienti(
	idDrink int(5),
	idIngrediente int(3),
	idQuantità varchar(10) not null,
	foreign key (idIngrediente) references ingredienti(idIngrediente),
	foreign key (idDrink) references drink(idDrink)
);

create table if not exists preferiti(
	idDrink int(5),
	idUtente int(3), 
	foreign key (idUtente) references utenti(idUtente),
	foreign key (idDrink) references drink(idDrink)
);



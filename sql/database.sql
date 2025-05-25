-- active: 1684419091484@@127.0.0.1@3306@alume
drop database if exists alume;
create database alume;
use alume;

create table client (
	idclient int(5) not null auto_increment, 
	nom varchar(50), 
	ville varchar(100),
	codepostal char(5),
	rue varchar(50),
	numrue int(3), 
	email varchar(50) unique, 
	role varchar(20) default 'client',
	tel varchar(20), 
	mdp varchar(255) not null, 
	constraint pk_cli primary key (idclient)
);

create table devis (
	iddevis int(5) not null auto_increment,
	datedevis date,
	etatdevis enum("acceptee", "annulee"),
	idclient int(5) not null,
	constraint pk_devis primary key (iddevis),
	constraint fk_cli foreign key (idclient) references client(idclient)
);

create table commande(
	idcommande int(10) not null auto_increment,
	etatcom enum("en attente", "annulee", "livree", "en preparation", "confirmee"),
	iddevis int(5) not null,
	constraint pk_com primary key (idcommande),
	constraint fk_com foreign key (iddevis) references devis(iddevis)
);

create table cat_produit(
	codecat int(4) not null,
	nomcat varchar(50),
	constraint pk_cat primary key (codecat)
);

create table produit(
	idproduit int(6) not null auto_increment,
	nomproduit varchar(50),
	prix_unit decimal(8,2),
	categorie varchar(50),
	image varchar(255) default 'default_product.jpg',
	description text,
	constraint pk_produit primary key (idproduit)
);

create table ligne_com(
	idproduit int(6) not null,
	idcommande int(10) not null,
	quantite int default 0,
	constraint pk_lcom primary key (idproduit, idcommande),
	constraint fk_prod foreign key (idproduit) references produit (idproduit),
	constraint fk_lcomm foreign key (idcommande) references commande (idcommande)
);

create table technicien(
	idtechnicien int(5) not null auto_increment,
	nom varchar(50), 
	prenom varchar(50), 
	specialite enum ("services", "ateliers", "autres"), 
	email varchar(50) unique, 
	mdp varchar (50),
	role varchar(20) default 'technicien',
	constraint pk_tech primary key (idtechnicien)
);

create table intervention(
	idtechnicien int(5) not null,
	idcommande int(10) not null, 
	datehd datetime not null, 
	datehf datetime ,
	etat enum("en attente", "terminee", "annulee"),
	constraint pk_inter primary key (idtechnicien, idcommande, datehd),
	constraint fk_tech foreign key (idtechnicien) references technicien(idtechnicien),
	constraint fk_com_inter foreign key (idcommande) references commande(idcommande)
);

create table administrateur(
	idadmin int(5) not null auto_increment,
	nom varchar(50),
	prenom varchar(50),
	email varchar(50) unique,
	mdp varchar(255),
	role enum("admin", "superadmin"),
	constraint pk_admin primary key (idadmin)
);

create table panier (
	idpanier int(10) not null auto_increment,
	idclient int(5) not null,
	datecreation datetime default current_timestamp,
	statut enum('actif', 'validé', 'abandonné') default 'actif',
	constraint pk_panier primary key (idpanier),
	constraint fk_panier_client foreign key (idclient) references client(idclient)
);

create table panier_produit (
	idpanier int(10) not null,
	idproduit int(6) not null,
	quantite int(5) not null default 1,
	prixunitaire decimal(8,2) not null,
	constraint pk_panier_produit primary key (idpanier, idproduit),
	constraint fk_panier_produit_panier foreign key (idpanier) references panier(idpanier) on delete cascade,
	constraint fk_panier_produit_produit foreign key (idproduit) references produit(idproduit)
);

insert into cat_produit values 
(1, 'électricité'),
(2, 'plomberie'),
(3, 'outillage'),
(4, 'quincaillerie'),
(5, 'chauffage'),
(6, 'éclairage');

insert into produit (nomproduit, prix_unit, categorie, description) values 
('disjoncteur différentiel', 39.99, 'électricité', 'disjoncteur différentiel pour tableau électrique'),
('ampoule led e27', 6.99, 'éclairage', 'ampoule led basse consommation, culot e27'),
('ensemble douche', 129.99, 'plomberie', 'ensemble complet pour douche avec colonne'),
('perceuse visseuse', 89.99, 'outillage', 'perceuse visseuse 18v avec 2 batteries'),
('radiateur électrique', 199.99, 'chauffage', 'radiateur électrique programmable 1500w'),
('serrure 3 points', 79.99, 'quincaillerie', 'serrure haute sécurité 3 points a2p*'),
('tube per 16mm', 2.49, 'plomberie', 'tube per pour eau froide et chaude'),
('interrupteur va-et-vient', 8.99, 'électricité', 'interrupteur va-et-vient avec plaque'),
('lustre 5 branches', 149.99, 'éclairage', 'lustre moderne 5 branches avec ampoules'),
('ponceuse orbitale', 59.99, 'outillage', 'ponceuse orbitale 300w avec bac à poussière'),
('robinet mitigeur cuisine', 69.99, 'plomberie', 'mitigeur pour évier de cuisine, finition chromée'),
('thermostat connecté', 129.99, 'chauffage', 'thermostat intelligent contrôlable par smartphone');

insert into technicien (idtechnicien, nom, prenom, specialite, email, mdp) values (null, "gedeon", "allan","ateliers", "a@gmail.com", "123");

insert into administrateur values (null, 'admin', 'system', 'admin@alume.fr', '123', 'admin');

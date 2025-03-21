DROP DATABASE IF EXISTS ALUME;

-- Create the database
CREATE DATABASE ALUME;

-- Use the database
USE ALUME;

-- Create the client table
CREATE TABLE client (
    idclient INT(5) NOT NULL AUTO_INCREMENT, 
    nom VARCHAR(50), 
    ville VARCHAR(100),
    codepostal CHAR(5),
    rue VARCHAR(50),
    numrue INT(3), 
    email VARCHAR(50) UNIQUE,
    mdp VARCHAR(50), 
    tel VARCHAR(20), 
    CONSTRAINT pk_cli PRIMARY KEY (idclient)
);

-- Create the devis table
CREATE TABLE devis (
    codedevis INT(5) NOT NULL,
    datedevis DATE,
    etatdevis ENUM('acceptee', 'annulee'),
    idclient INT(5) NOT NULL,
    CONSTRAINT pk_devis PRIMARY KEY (codedevis),
    CONSTRAINT fk_cli FOREIGN KEY (idclient) REFERENCES client(idclient) ON DELETE CASCADE
);

-- Create the commande table
CREATE TABLE commande (
    codecom INT(10) NOT NULL AUTO_INCREMENT,
    etatcom ENUM('en attente', 'annulee', 'livree', 'en preparation', 'confirmee'),
    codedevis INT(5) NOT NULL,
    CONSTRAINT pk_com PRIMARY KEY (codecom),
    CONSTRAINT fk_com FOREIGN KEY (codedevis) REFERENCES devis(codedevis) ON DELETE CASCADE
);

-- Create the cat_produit table
CREATE TABLE cat_produit (
    codecat INT(4) NOT NULL,
    nomcat VARCHAR(20) UNIQUE,
    CONSTRAINT pk_cat PRIMARY KEY (codecat)
);

-- Create the produit table
CREATE TABLE produit (
    idproduit INT(6) NOT NULL AUTO_INCREMENT,
    nomproduit VARCHAR(50),
    prix_unit DECIMAL(8,2),
    codecat INT(4) NOT NULL,
    CONSTRAINT pk_produit PRIMARY KEY (idproduit),
    CONSTRAINT fk_cat FOREIGN KEY (codecat) REFERENCES cat_produit(codecat) ON DELETE CASCADE
);

-- Create the ligne_com table
CREATE TABLE ligne_com (
    idproduit INT(6) NOT NULL,
    codecom INT(10) NOT NULL,
    quantite INT NOT NULL DEFAULT 0,
    CONSTRAINT pk_lcom PRIMARY KEY (idproduit, codecom),
    CONSTRAINT fk_prod FOREIGN KEY (idproduit) REFERENCES produit(idproduit) ON DELETE CASCADE,
    CONSTRAINT fk_lcomm FOREIGN KEY (codecom) REFERENCES commande(codecom) ON DELETE CASCADE
);

-- Create the technicien table
CREATE TABLE technicien (
    idtech INT(5) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50), 
    prenom VARCHAR(50), 
    specialite ENUM('telephonie', 'Box', 'Autre'), 
    email VARCHAR(50) UNIQUE, 
    mdp VARCHAR(50), 
    CONSTRAINT pk_tech PRIMARY KEY (idtech)
);

-- Create the intervention table
CREATE TABLE intervention (
    idtech INT(5) NOT NULL,
    codecom INT(10) NOT NULL, 
    datehd DATETIME NOT NULL, 
    datehf DATETIME,
    etat ENUM('en attente', 'terminee', 'annulee'),
    CONSTRAINT pk_inter PRIMARY KEY (idtech, codecom, datehd),
    CONSTRAINT fk_tech FOREIGN KEY (idtech) REFERENCES technicien(idtech) ON DELETE CASCADE,
    CONSTRAINT fk_com_inter FOREIGN KEY (codecom) REFERENCES commande(codecom) ON DELETE CASCADE
);

create table user(
	iduser int(5) not null auto_increment,
	nom varchar(50),
	prenom varchar(50),
	email varchar(50),
	mdp varchar(255),
	role enum("admin", "user"),
	primary key (iduser)
);

insert into user values (null, "Youcef", "Gedeon", "a@gmail.com", "123", "admin");
insert into user values (null, "Allan", "Nicolas", "b@gmail.com", "456", "user");
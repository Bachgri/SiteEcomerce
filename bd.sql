CREATE DATABASE miniprojet;
USE miniprojet;
--  La table Client   --
CREATE TABLE Client(
    namec varchar(64) not null,
    email varchar(64) PRIMARY KEY,
    pass varchar(64) not null,
    adresse varchar(128),
    estAdmin int DEFAULT 0,
    imageP varchar(32) 
    );

--   La table Produits  --
CREATE TABLE Produits(
	Ref varchar(68) PRIMARY KEY,
    Designation text not null,
    prix double not null,
    categorie varchar(28) not null,
    qtt int not null DEFAULT 0,
    images varchar(128) NOT NULL
	);

--  La tables Commande  --
CREATE TABLE Commande(
    Num varchar(100) PRIMARY KEY,
    DateCmd date not null,
    emailClt varchar(64) not null,
    CONSTRAINT cmdkey FOREIGN KEY(emailClt) REFERENCES Client(email)
    );

--  la table LigneCommande  --
CREATE TABLE LigneCommande(
    NumCmd varchar(100) not null,
    refProd varchar(68) not null,
    quantite int not null,
    CONSTRAINT cmdkey0 FOREIGN KEY(NumCmd) REFERENCES Commande(Num),
    CONSTRAINT prdkey0 FOREIGN KEY(refProd) REFERENCES Produits(Ref)
    );


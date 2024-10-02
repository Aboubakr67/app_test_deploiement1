DROP DATABASE IF EXISTS app_test_deploiement1;
CREATE DATABASE app_test_deploiement1;
USE app_test_deploiement1;


CREATE TABLE PRODUITS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    quantite_stock INT NOT NULL
);


CREATE TABLE COMMANDES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_client VARCHAR(255) NOT NULL,
    id_produit INT NOT NULL,
    quantite INT NOT NULL,
    date_commande DATE NOT NULL,

    FOREIGN KEY (id_produit) REFERENCES PRODUITS(id)
);

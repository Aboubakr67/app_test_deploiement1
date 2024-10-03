<?php
require_once 'Databases.php';

function ajouterProduit($nom, $description, $prix, $quantite_stock)
{

    //   Si nom vide
    if (empty($nom)) {
        return false;
    }

    // Si description vide
    if (empty($description)) {
        return false;
    }

    // Si prix prix est négatif ou nul
    if (empty($prix) || $prix === null || $prix <= 0) {
        return false;
    }

    // Si quantité stock est négative
    if (empty($quantite_stock) || $quantite_stock === null || $quantite_stock < 0) {
        return false;
    }

    $connexion = connexion();
    $sql = "INSERT INTO PRODUITS (nom, description, prix, quantite_stock) VALUES (:nom, :description, :prix, :quantite_stock)";
    $stmt = $connexion->prepare($sql);

    if ($stmt->execute(['nom' => $nom, 'description' => $description, 'prix' => $prix, 'quantite_stock' => $quantite_stock])) {
        return true;
    } else {
        return false;
    }
}

function getProduitById($id)
{
    $connexion = connexion();
    $stmt = $connexion->prepare("SELECT * FROM PRODUITS WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function modifierProduit($id, $nom, $description, $prix, $quantite_stock)
{
    //   Si nom vide
    if (empty($nom)) {
        return false;
    }

    // Si description vide
    if (empty($description)) {
        return false;
    }

    // Si prix prix est négatif ou nul
    if (empty($prix) || $prix === null || $prix <= 0) {
        return false;
    }

    // Si quantité stock est négative
    if (empty($quantite_stock) || $quantite_stock === null || $quantite_stock < 0) {
        return false;
    }

    $connexion = connexion();
    $sql = "UPDATE produits SET nom = :nom, description = :description, prix = :prix, quantite_stock = :quantite_stock WHERE id = :id";
    $stmt = $connexion->prepare($sql);

    if ($stmt->execute(['nom' => $nom, 'description' => $description, 'prix' => $prix, 'quantite_stock' => $quantite_stock, 'id' => $id])) {
        return true;
    } else {
        return false;
    }
}


function supprimerProduit($id)
{

    $connexion = connexion();
    // On vérifie si le produit est lié à des commandes
    $sql = "SELECT COUNT(*) FROM COMMANDES WHERE id_produit = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $commandes_count = $stmt->fetchColumn();

    if ($commandes_count > 0) {
        return false;
    } else {
        $sql = "DELETE FROM PRODUITS WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        if ($stmt->execute(['id' => $id])) {
            return true;
        } else {
            return true;
        }
    }
}

// Lister tous les produits
function listerProduits()
{
    $connexion = connexion();
    $sql = "SELECT * FROM PRODUITS";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $produits;
}


// ajouterProduit("Produit 1", "Description 1", 10.5, 100);

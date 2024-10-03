<?php
require_once 'Databases.php';

function creerCommande($nom_client, $id_produit, $quantite, $date_commande)
{

    if (empty($nom_client) || $nom_client == null) {
        // echo "Erreur: Le nom du client ne peut pas être vide.";
        return false;
    }

    $connexion = connexion();

    // Vérifier si la quantité du produit est disponible
    $sql = "SELECT quantite_stock FROM PRODUITS WHERE id = :id_produit";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['id_produit' => $id_produit]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produit['quantite_stock'] < $quantite) {
        // echo "Erreur: Quantité insuffisante en stock.";
        return false;
    }

    // Créer la commande
    $sql = "INSERT INTO COMMANDES (nom_client, id_produit, quantite, date_commande) VALUES (:nom_client, :id_produit, :quantite, :date_commande)";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['nom_client' => $nom_client, 'id_produit' => $id_produit, 'quantite' => $quantite, 'date_commande' => $date_commande]);

    // Mettre à jour la quantité en stock du produit
    $sql = "UPDATE PRODUITS SET quantite_stock = quantite_stock - :quantite WHERE id = :id_produit";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['quantite' => $quantite, 'id_produit' => $id_produit]);

    return true;
}

function modifierCommande($id, $nom_client, $id_produit, $quantite, $date_commande)
{
    if (empty($nom_client) || $nom_client == null) {
        // echo "Erreur: Le nom du client ne peut pas être vide.";
        return false;
    }

    $connexion = connexion();

    // Vérifier si la quantité du produit est disponible
    $sql = "SELECT quantite_stock FROM PRODUITS WHERE id = :id_produit";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['id_produit' => $id_produit]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produit['quantite_stock'] < $quantite) {
        // echo "Erreur: Quantité insuffisante en stock.";
        return false;
    }

    // Modifier la commande
    $sql = "UPDATE COMMANDES SET nom_client = :nom_client, id_produit = :id_produit, quantite = :quantite, date_commande = :date_commande WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['nom_client' => $nom_client, 'id_produit' => $id_produit, 'quantite' => $quantite, 'date_commande' => $date_commande, 'id' => $id]);

    return true;
}


function supprimerCommande($id)
{
    $connexion = connexion();

    // Récupérer la quantité commandée avant de supprimer la commande
    $sql = "SELECT quantite, id_produit FROM COMMANDES WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['id' => $id]);
    $commande = $stmt->fetch(PDO::FETCH_ASSOC);

    // Rendre la quantité commandée au stock
    $sql = "UPDATE PRODUITS SET quantite_stock = quantite_stock + :quantite WHERE id = :id_produit";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['quantite' => $commande['quantite'], 'id_produit' => $commande['id_produit']]);

    // Supprimer la commande
    $sql = "DELETE FROM COMMANDES WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['id' => $id]);

    return true;
}

function listerCommandes()
{
    $connexion = connexion();
    $sql = "SELECT c.id, c.nom_client, c.quantite, c.date_commande, p.nom AS nom_produit, p.prix 
            FROM COMMANDES c 
            JOIN PRODUITS p ON c.id_produit = p.id";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $commandes;
}


function getCommandeById($id)
{
    $connexion = connexion();
    $sql = "SELECT c.id, c.nom_client, c.quantite, c.date_commande, c.id_produit, p.nom AS nom_produit 
            FROM COMMANDES c 
            JOIN PRODUITS p ON c.id_produit = p.id 
            WHERE c.id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

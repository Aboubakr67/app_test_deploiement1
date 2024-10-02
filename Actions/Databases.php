<?php

function connexion()
{
    $serveur = 'localhost';
    $utilisateur = 'root';
    $mot_de_passe = 'root';
    $bdd = 'app_test_deploiement1';
    $port = 3308; // Port MySQL personnalisé

    try {
        $connexion = new PDO("mysql:host=$serveur;port=$port;dbname=$bdd", $utilisateur, $mot_de_passe);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($connexion) {
            // echo "connecter";
            return $connexion;
        }
        // echo "NON connecter";
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

// connexion();

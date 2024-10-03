<?php

use PHPUnit\Framework\TestCase;

include_once 'Actions/CrudCommandes.php';
include_once 'Actions/Databases.php';

class CommandesTest extends TestCase
{
    private $connexion;

    protected function setUp(): void
    {
        $this->connexion = connexion();
    }

    // Test avec des données valides
    public function testAjouterCommandeValide()
    {
        $result = creerCommande('Jean Dupont', 1, 3, '2024-10-03');
        $this->assertTrue($result, "L'ajout d'une commande valide a échoué.");
    }

    // Ajouter une commande avec des produits sans stock suffisant
    public function testAjouterCommandeStockInsuffisant()
    {
        $result = creerCommande('Jean Dupont', 1, 100, '2024-10-03');
        $this->assertFalse($result, "L'ajout d'une commande avec stock insuffisant n'a pas échoué.");
    }


    // Ajouter une commande sans nom de client
    public function testAjouterCommandeSansNomClient()
    {
        $result = creerCommande('', 1, 3, '2024-10-03');
        $this->assertFalse($result, "L'ajout d'une commande sans nom de client n'a pas échoué.");
    }

    // Modifier une commande avec des données valides
    public function testModifierCommandeValide()
    {
        $result = modifierCommande(1, 'Jean Dupont', 1, 2, '2024-10-03');
        $this->assertTrue($result, "La modification d'une commande valide a échoué.");
    }

    // Modifier une commande avec des produits sans stock suffisant
    public function testModifierCommandeStockInsuffisant()
    {
        $result = modifierCommande(1, 'Jean Dupont', 1, 100, '2024-10-03');
        $this->assertFalse($result, "La modification d'une commande avec stock insuffisant n'a pas échoué.");
    }

    // Modifier une commande sans nom de client
    public function testModifierCommandeSansNomClient()
    {
        $result = modifierCommande(1, '', 1, 2, '2024-10-03');
        $this->assertFalse($result, "La modification d'une commande sans nom de client n'a pas échoué.");
    }

    // Supprimer une commande par un utilisateur
    // public function testSupprimerCommandeParUtilisateur()
    // {
    //     $result = supprimerCommande(1); 
    //     $this->assertFalse($result, "La suppression d'une commande par un utilisateur a échoué à être bloquée.");
    // }
}

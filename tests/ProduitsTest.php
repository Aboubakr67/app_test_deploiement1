<?php

use PHPUnit\Framework\TestCase;

include_once 'Actions/CrudProduits.php';
include_once 'Actions/Databases.php';

class ProduitsTest extends TestCase
{
    private $connexion;

    protected function setUp(): void
    {
        $this->connexion = connexion();
    }

    // ----------------------- AJOUTER ------------------------

    // Test avec des données valides
    public function testAjouterProduitValide()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', 100.00, 10);
        $this->assertTrue($result, "L'ajout du produit valide a échoué.");
    }

    // Test avec un nom vide
    public function testAjouterProduitNomVide()
    {
        $result = ajouterProduit('', 'Description Test', 100.00, 10);
        $this->assertFalse($result, "L'ajout du produit avec un nom vide devrait échouer.");
    }

    // Test avec une description vide
    public function testAjouterProduitDescriptionVide()
    {
        $result = ajouterProduit('Produit Test', '', 100.00, 10);
        $this->assertFalse($result, "L'ajout du produit avec une description vide devrait échouer.");
    }

    // Test avec un stock négatif
    public function testAjouterProduitStockNegatif()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', 100.00, -5);
        $this->assertFalse($result, "L'ajout du produit avec un stock négatif devrait échouer.");
    }

    // Test avec un prix négatif
    public function testAjouterProduitPrixNegatif()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', -100.00, 10);
        $this->assertFalse($result, "L'ajout du produit avec un prix négatif devrait échouer.");
    }

    // Test sans prix
    public function testAjouterProduitSansPrix()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', null, 10);
        $this->assertFalse($result, "L'ajout du produit sans prix devrait échouer.");
    }

    // Test sans stock
    public function testAjouterProduitSansStock()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', 100.00, null);
        $this->assertFalse($result, "L'ajout du produit sans stock devrait échouer.");
    }

    // Test sans description
    public function testAjouterProduitSansDescription()
    {
        $result = ajouterProduit('Produit Test', null, 100.00, 10);
        $this->assertFalse($result, "L'ajout du produit sans description devrait échouer.");
    }

    // ----------------------------- MODIFIER --------------------------

    // Test pour modifier un produit avec des données valides
    public function testModifierProduitDonneesValides()
    {
        $resultat = modifierProduit(1, 'Produit Test', 'Description valide', 50, 10);
        $this->assertTrue($resultat, 'Le produit devrait être modifié avec des données valides.');
    }

    // Test pour modifier un produit avec un nom vide
    public function testModifierProduitNomVide()
    {
        $resultat = modifierProduit(1, '', 'Description valide', 50, 10);
        $this->assertFalse($resultat, 'Le produit ne devrait pas être modifié avec un nom vide.');
    }

    // Test pour modifier un produit avec une description vide
    public function testModifierProduitDescriptionVide()
    {
        $resultat = modifierProduit(1, 'Produit Test', '', 50, 10);
        $this->assertFalse($resultat, 'Le produit ne devrait pas être modifié avec une description vide.');
    }

    // Test pour modifier un produit avec un stock négatif
    public function testModifierProduitStockNegatif()
    {
        $resultat = modifierProduit(1, 'Produit Test', 'Description valide', 50, -10);
        $this->assertFalse($resultat, 'Le produit ne devrait pas être modifié avec un stock négatif.');
    }

    // Test pour modifier un produit avec un prix négatif 
    public function testModifierProduitPrixNegatif()
    {
        $resultat = modifierProduit(1, 'Produit Test', 'Description valide', -50, 10);
        $this->assertFalse($resultat, 'Le produit ne devrait pas être modifié avec un prix négatif.');
    }

    // Test pour ajouter un produit sans prix
    public function testModifierProduitSansPrix()
    {
        $resultat = modifierProduit(1, 'Produit Test', 'Description valide', null, 10);
        $this->assertFalse($resultat, 'Le produit ne devrait pas être modifier sans prix.');
    }

    // Test pour ajouter un produit sans stock
    public function testModifierProduitSansStock()
    {
        $resultat = modifierProduit(1, 'Produit Test', 'Description valide', 50, null);
        $this->assertFalse($resultat, 'Le produit ne devrait pas être modifier sans stock.');
    }

    // SUPPRIMER


    //  ! A décommenter ci-besoin
    // Cas où le produit est lié à des commandes
    // public function testSupprimerProduitAvecCommandes()
    // {
    //     $resultat = supprimerProduit(1);
    //     $this->assertFalse($resultat, 'Le produit ne doit pas être supprimé car il est lié à des commandes.');
    // }

    // Cas où le produit n'est pas lié à des commandes
    // public function testSupprimerProduitSansCommandes()
    // {
    //     $resultat = supprimerProduit(2);
    //     $this->assertTrue($resultat, 'Le produit doit être supprimé car il n\'est pas lié à des commandes.');
    // }
}

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

    // 1. Test avec des données valides
    public function testAjouterProduitValide()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', 100.00, 10);
        $this->assertTrue($result, "L'ajout du produit valide a échoué.");
    }

    // 2. Test avec un nom vide
    public function testAjouterProduitNomVide()
    {
        $result = ajouterProduit('', 'Description Test', 100.00, 10);
        $this->assertFalse($result, "L'ajout du produit avec un nom vide devrait échouer.");
    }

    // 3. Test avec une description vide
    public function testAjouterProduitDescriptionVide()
    {
        $result = ajouterProduit('Produit Test', '', 100.00, 10);
        $this->assertFalse($result, "L'ajout du produit avec une description vide devrait échouer.");
    }

    // 4. Test avec un stock négatif
    public function testAjouterProduitStockNegatif()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', 100.00, -5);
        $this->assertFalse($result, "L'ajout du produit avec un stock négatif devrait échouer.");
    }

    // 5. Test avec un prix négatif
    public function testAjouterProduitPrixNegatif()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', -100.00, 10);
        $this->assertFalse($result, "L'ajout du produit avec un prix négatif devrait échouer.");
    }

    // 6. Test sans prix
    public function testAjouterProduitSansPrix()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', null, 10);
        $this->assertFalse($result, "L'ajout du produit sans prix devrait échouer.");
    }

    // 7. Test sans stock
    public function testAjouterProduitSansStock()
    {
        $result = ajouterProduit('Produit Test', 'Description Test', 100.00, null);
        $this->assertFalse($result, "L'ajout du produit sans stock devrait échouer.");
    }

    // 8. Test sans description
    public function testAjouterProduitSansDescription()
    {
        $result = ajouterProduit('Produit Test', null, 100.00, 10);
        $this->assertFalse($result, "L'ajout du produit sans description devrait échouer.");
    }
}

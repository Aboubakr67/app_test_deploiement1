<?php
include 'Actions/CrudProduits.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    supprimerProduit($id);
    header('Location: produits.php');
    exit();
}

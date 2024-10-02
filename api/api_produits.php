<?php
include 'Actions/CrudProduits.php';


$produits = listerProduits();

echo json_encode($produits);

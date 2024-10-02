<?php
include_once '../Actions/CrudProduits.php';


$produits = listerProduits();

echo json_encode($produits);

<?php
include 'Actions/CrudCommandes.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    supprimerCommande($id);
    header('Location: commandes.php');
}

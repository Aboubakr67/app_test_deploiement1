<?php
include 'Actions/CrudCommandes.php';


$commandes = listerCommandes();

echo json_encode($commandes);

<?php
include 'Actions/CrudCommandes.php';
include 'Actions/CrudProduits.php';

$message = '';
$produits = listerProduits();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_client = $_POST['nom_client'];
    $id_produit = $_POST['id_produit'];
    $quantite = $_POST['quantite'];
    $date_commande = date('Y-m-d H:i:s');

    if (creerCommande($nom_client, $id_produit, $quantite, $date_commande)) {
        $message = 'Commande créée avec succès.';
        header('Location: commandes.php');
        exit();
    } else {
        $message = 'Erreur lors de la création de la commande.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>Ajouter une Commande</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Ajouter une Commande</h2>
        <?php if ($message) : ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="add_commande.php">
            <div class="mb-3">
                <label for="nom_client" class="form-label">Nom du Client</label>
                <input type="text" class="form-control" name="nom_client" required>
            </div>

            <div class="mb-3">
                <label for="id_produit" class="form-label">Produit</label>
                <select name="id_produit" class="form-select" required>
                    <?php foreach ($produits as $produit) : ?>
                        <option value="<?= $produit['id'] ?>"><?= $produit['nom'] ?> (<?= $produit['quantite_stock'] ?> en stock)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="number" class="form-control" name="quantite" required>
            </div>

            <button type="submit" class="btn btn-success">Créer Commande</button>
            <a href="commandes.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>
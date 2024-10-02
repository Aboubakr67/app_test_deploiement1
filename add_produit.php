<?php
include 'Actions/CrudProduits.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];

    if (ajouterProduit($nom, $description, $prix, $quantite_stock)) {
        $message = 'Produit ajouté avec succès.';
        header('Location: produits.php');
        exit();
    } else {
        $message = 'Erreur lors de l\'ajout du produit.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>Ajouter un Produit</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Ajouter un Produit</h2>
        <?php if ($message) : ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="add_produit.php">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" name="prix" required>
            </div>
            <div class="mb-3">
                <label for="quantite_stock" class="form-label">Quantité en Stock</label>
                <input type="number" class="form-control" name="quantite_stock" required>
            </div>
            <button type="submit" class="btn btn-success">Ajouter Produit</button>
            <a href="produits.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>
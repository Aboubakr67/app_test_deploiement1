<?php
include 'Actions/CrudProduits.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produit = getProduitById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];

    if (modifierProduit($id, $nom, $description, $prix, $quantite_stock)) {
        header('Location: produits.php');
        exit();
    } else {
        $message = "Erreur lors de la modification.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>Modifier Produit</title>
</head>

<body>
    <?php
    include_once 'navigation.php'
    ?>
    <div class="container mt-5">
        <h2>Modifier Produit</h2>

        <form method="POST" action="edit_produit.php">
            <input type="hidden" name="id" value="<?= $produit['id'] ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" value="<?= $produit['nom'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" required><?= $produit['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" name="prix" value="<?= $produit['prix'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantite_stock" class="form-label">Quantité en Stock</label>
                <input type="number" class="form-control" name="quantite_stock" value="<?= $produit['quantite_stock'] ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Modifier Produit</button>
            <a href="produits.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>
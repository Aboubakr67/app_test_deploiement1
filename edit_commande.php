<?php
include 'Actions/CrudCommandes.php';
include 'Actions/CrudProduits.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $commande = getCommandeById($id);
    $produits = listerProduits();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nom_client = $_POST['nom_client'];
    $id_produit = $_POST['id_produit'];
    $quantite = $_POST['quantite'];
    $date_commande = $_POST['date_commande'];

    if (modifierCommande($id, $nom_client, $id_produit, $quantite, $date_commande)) {
        header('Location: commandes.php');
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
    <title>Modifier Commande</title>
</head>

<body>
    <?php
    include_once 'navigation.php'
    ?>
    <div class="container mt-5">
        <h2>Modifier Commande</h2>

        <form method="POST" action="edit_commande.php">
            <input type="hidden" name="id" value="<?= $commande['id'] ?>">
            <div class="mb-3">
                <label for="nom_client" class="form-label">Nom du Client</label>
                <input type="text" class="form-control" name="nom_client" value="<?= $commande['nom_client'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_produit" class="form-label">Produit</label>
                <select name="id_produit" class="form-select" required>
                    <?php foreach ($produits as $produit) : ?>
                        <option value="<?= $produit['id'] ?>" <?= $commande['id_produit'] == $produit['id'] ? 'selected' : '' ?>>
                            <?= $produit['nom'] ?> (<?= $produit['quantite_stock'] ?> en stock)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="number" class="form-control" name="quantite" value="<?= $commande['quantite'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="date_commande" class="form-label">Date de Commande</label>
                <input type="date" class="form-control" name="date_commande" value="<?= $commande['date_commande'] ?>" required>
            </div>

            <button type="submit" class="btn btn-warning">Modifier</button>
            <a href="commandes.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>
<?php
include 'Actions/CrudProduits.php';

$produits = listerProduits();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>Liste des Produits</title>
</head>

<body>
    <?php
    include_once 'navigation.php'
    ?>
    <div class="container mt-5">
        <h2>Liste des Produits</h2>
        <a href="add_produit.php" class="btn btn-primary mb-3">Ajouter un produit</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité en Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit) : ?>
                    <tr>
                        <td><?= $produit['nom'] ?></td>
                        <td><?= $produit['description'] ?></td>
                        <td><?= $produit['prix'] ?></td>
                        <td><?= $produit['quantite_stock'] ?></td>
                        <td>
                            <a href="edit_produit.php?id=<?= $produit['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="delete_produit.php?id=<?= $produit['id'] ?>" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
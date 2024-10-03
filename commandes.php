<?php
include 'Actions/CrudCommandes.php';

$commandes = listerCommandes();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>Liste des Commandes</title>
</head>

<body>
    <?php
    include_once 'navigation.php'
    ?>
    <div class="container mt-5">
        <h2>Liste des Commandes</h2>
        <a href="add_commande.php" class="btn btn-primary mb-3">Créer une nouvelle commande</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Date de Commande</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande) : ?>
                    <tr>
                        <td><?= $commande['nom_client'] ?></td>
                        <td><?= $commande['nom_produit'] ?></td>
                        <td><?= $commande['quantite'] ?></td>
                        <td><?= $commande['date_commande'] ?></td>
                        <td><?= $commande['prix'] ?></td>
                        <td>
                            <a href="edit_commande.php?id=<?= $commande['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="delete_commande.php?id=<?= $commande['id'] ?>" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette commande ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
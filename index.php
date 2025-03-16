<?php
include 'connexion.php';

if (isset($_POST['btn-add'])) {
    $nomproduit = $_POST['nomproduit'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO produit (titre, description, image) VALUES (:nomproduit, :description, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nomproduit' => $nomproduit, 'description' => $description, 'image' => $image]);
    header('Location: resultat.php');
    exit();
} else {
    echo 'Erreur lors de l\'ajout du produit';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Produit</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <section class="input_add">
        <form action="" method="post">

            <label for="nomproduit">Nom du Produit</label>
            <input type="text" name="nomproduit" id="nomproduit" required>
            <label for="description">Description du Produit</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <label for="image">Ajouter une image</label>
            <input type="file" name="image" id="image" required>
            <input type="submit" value="Ajouter" name="btn-add">

            <a class="btn-liste-prod" href="resultat.php">Liste des Produits</a>
        </form>

    </section>

</body>

</html>
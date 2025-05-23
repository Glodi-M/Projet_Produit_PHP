<?php
// Inclure la connexion à la base de données
include 'connexion.php';

// Vérifier si le formulaire a été soumis
if (isset($_POST['btn-add'])) {
    // Récupérer et nettoyer les données du formulaire
    $nomproduit = trim($_POST['nomproduit']);
    $description = trim($_POST['description']);

    // Valider les données
    if (empty($nomproduit) || empty($description)) {
        die("Tous les champs sont obligatoires.");
    }

    // Gérer le téléversement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $uploadDir = 'uploads/'; // Dossier où stocker les images
        $uploadFile = $uploadDir . basename($image['name']);

        // Vérifier le type de fichier (optionnel)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            die("Seuls les fichiers JPEG, PNG et GIF sont autorisés.");
        }

        // Déplacer le fichier téléversé vers le dossier de destination
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            // Insérer les données dans la base de données
            try {
                $sql = "INSERT INTO produit (titre, description, image) VALUES (:nomproduit, :description, :image)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'nomproduit' => $nomproduit,
                    'description' => $description,
                    'image' => $uploadFile // Chemin de l'image
                ]);

                // Rediriger vers la page de résultat avec un message de succès
                header('Location: resultat.php?success=1');
                exit();
            } catch (PDOException $e) {
                die("Erreur lors de l'ajout du produit : " . $e->getMessage());
            }
        } else {
            die("Erreur lors du téléversement de l'image.");
        }
    } else {
        die("Veuillez sélectionner une image valide.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="header">
        <h1>Ajouter un produit</h1>

    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nomproduit">Nom du produit :</label>
        <input type="text" id="nomproduit" name="nomproduit" required>

        <label for=" description">Description :</label>
        <textarea id="description" name="description" required cols="30" rows="10"></textarea>

        <label for="image">Image :</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit" name="btn-add" class="btn-add">Ajouter</button>
        <a class="btn-liste-prod" href="resultat.php">Voir la liste des produits</a>
    </form>
</body>

</html>
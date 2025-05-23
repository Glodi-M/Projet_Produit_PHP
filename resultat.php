<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="result">

        <div class="result-content">
            <a href="index.php">Ajout un produit</a>

            <h3>Liste des produits</h3>
            <div class="liste-produits">

                <?php
                include 'connexion.php';
                $sql = "SELECT * FROM produit";
                $stmt = $pdo->query($sql);
                $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($produits as $produit) {
                ?>

                    <!-- Produit Liste -->
                    <div class="produit">
                        <div class="image-prod">
                            <img src="<?php echo $produit['image']; ?>" alt="">
                        </div>
                        <div class="text">
                            <strong>
                                <p class="titre"> <?php echo $produit['titre']; ?></p>
                                <p class="description"><?php echo $produit['description']; ?></p>
                            </strong>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>

    </div>




</body>

</html>
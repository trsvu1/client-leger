<?php
require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// Récupération des catégories distinctes
$categories = $unControleur->selectDistinctCategories();

// Organisation des catégories par paires pour l'affichage
$categoriesPairs = array_chunk($categories, 2);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Catégories - ALUME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #080808 0%, #333333 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
            position: relative;
            border-bottom: 3px solid #FFFD55;
        }
        
        .hero-section h1 {
            font-weight: 700;
            color: #FFFD55;
            margin-bottom: 15px;
        }
        
        .category-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .category-header {
            background: linear-gradient(45deg, #080808, #333333);
            color: #FFFD55;
            padding: 20px;
            text-align: center;
            font-weight: 600;
        }
        
        .category-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .list-item {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            transition: all 0.2s ease;
        }
        
        .list-item:last-child {
            border-bottom: none;
        }
        
        .list-item:hover {
            background-color: #f8f9fa;
            padding-left: 25px;
        }
        
        .list-icon {
            color: #FFFD55;
            background-color: #080808;
            padding: 7px;
            border-radius: 50%;
            margin-right: 10px;
            font-size: 0.8rem;
        }
        
        .view-all {
            display: block;
            text-align: center;
            margin-top: 15px;
            padding: 12px;
            background-color: #080808;
            color: #FFFD55;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .view-all:hover {
            background-color: #FFFD55;
            color: #080808;
        }
        
        .contact-section {
            background: linear-gradient(135deg, #080808 0%, #333333 100%);
            border-radius: 15px;
            padding: 50px 0;
            margin-top: 50px;
        }
        
        .btn-contact {
            background-color: #FFFD55;
            color: #080808;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-contact:hover {
            background-color: #fff;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="hero-section">
        <div class="container py-5">
            <div class="text-center">
                <h1 class="display-4">Nos Catégories de Produits</h1>
                <p class="lead mb-0">Découvrez notre large gamme de solutions pour tous vos projets</p>
            </div>
        </div>
    </div>

    <main class="container">
        <!-- Catégories -->
        <section class="py-5">
            <div class="row">
                <?php if(count($categories) > 0): ?>
                    <?php foreach($categories as $index => $categorie): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="category-card h-100">
                                <div class="category-header">
                                    <div class="category-icon">
                                        <!-- Icônes différentes selon la catégorie -->
                                        <?php 
                                        $icons = ['fa-bolt', 'fa-wrench', 'fa-hammer', 'fa-paint-brush', 
                                                'fa-faucet', 'fa-toolbox', 'fa-ruler', 'fa-plug'];
                                        $icon = $icons[$index % count($icons)];
                                        ?>
                                        <i class="fas <?php echo $icon; ?>"></i>
                                    </div>
                                    <h3><?php echo htmlspecialchars($categorie['categorie']); ?></h3>
                                </div>
                                <div class="card-body">
                                    <?php 
                                    // Récupération des produits par catégorie (limité à 4 produits)
                                    $produits = $unControleur->selectProduitsByCategorie($categorie['categorie']);
                                    $produitsAffiches = array_slice($produits, 0, 4);
                                    
                                    foreach($produitsAffiches as $produit): 
                                    ?>
                                        <div class="list-item">
                                            <span class="list-icon">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <?php echo htmlspecialchars($produit['nomproduit']); ?>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <!-- Si la catégorie contient plus de produits que ceux affichés -->
                                    <?php if(count($produits) > count($produitsAffiches)): ?>
                                        <div class="list-item text-muted">
                                            <em>Et <?php echo count($produits) - count($produitsAffiches); ?> autres produits...</em>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <a href="index.php?page=produit&categorie=<?php echo urlencode($categorie['categorie']); ?>" class="view-all mt-3">
                                        Voir tous les produits
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p>Aucune catégorie disponible pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Section contact -->
        <section class="contact-section text-center py-5 mt-5">
            <div class="container py-4">
                <h2 class="text-light mb-3">Besoin d'assistance ?</h2>
                <p class="text-light mb-4">Nos experts sont à votre disposition pour vous guider dans votre projet</p>
                <a href="index.php?page=contact" class="btn btn-contact btn-lg px-4 py-2">
                    <i class="fas fa-envelope me-2"></i> Contactez-nous
                </a>
            </div>
        </section>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

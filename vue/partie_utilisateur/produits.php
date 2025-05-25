<?php
require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// Récupération des catégories distinctes
$categories = $unControleur->selectDistinctCategories();

// Traitement de l'ajout au panier
$message = '';
$messageType = '';

if (isset($_POST['add_to_cart']) && isset($_POST['idproduit'])) {
    // Vérification que l'utilisateur est connecté et est un client
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'client' && isset($_SESSION['idclient'])) {
        $idclient = $_SESSION['idclient'];
        $idproduit = $_POST['idproduit'];
        $quantite = isset($_POST['quantite']) ? intval($_POST['quantite']) : 1;
        
        // Récupération ou création du panier actif
        $panier = $unControleur->getPanierActif($idclient);
        $idpanier = $panier['idpanier'];
        
        // Ajout du produit au panier
        $resultat = $unControleur->ajouterProduitPanier($idpanier, $idproduit, $quantite);
        
        if ($resultat['success']) {
            $message = $resultat['message'];
            $messageType = 'success';
        } else {
            $message = $resultat['message'];
            $messageType = 'danger';
        }
    } else {
        $message = "Vous devez être connecté en tant que client pour ajouter des produits au panier.";
        $messageType = 'warning';
    }
}

// Récupération des produits selon les filtres
if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    $produits = $unControleur->selectProduitsByCategorie($_GET['categorie']);
    $categorieActuelle = $_GET['categorie'];
} elseif (isset($_GET['search']) && !empty($_GET['search'])) {
    $produits = $unControleur->searchProduits($_GET['search']);
    $searchTerm = $_GET['search'];
} else {
    $produits = $unControleur->selectAllProduitsFrontend();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits - ALUME</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 40px 0;
            background: linear-gradient(135deg, #080808, #333333);
            color: white;
            margin-bottom: 40px;
            border-bottom: 3px solid #FFFD55;
        }
        
        .header h1 {
            font-weight: 600;
            color: #FFFD55;
            margin-bottom: 10px;
        }

        .search-bar {
            max-width: 600px;
            margin: 20px auto;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #080808;
            border-radius: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: #FFFD55;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 253, 85, 0.25);
        }
        
        .search-button {
            position: absolute;
            right: 5px;
            top: 5px;
            padding: 10px 20px;
            background-color: #080808;
            color: #FFFD55;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .search-button:hover {
            background-color: #FFFD55;
            color: #080808;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #080808;
            border-radius: 20px;
            background: white;
            color: #080808;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn.active {
            background: #FFFD55;
            color: #080808;
            border-color: #FFFD55;
        }

        .filter-btn:hover {
            background: #080808;
            color: #FFFD55;
            border-color: #080808;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px 0;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid #eaeaea;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #FFFD55;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #aaa;
            font-size: 24px;
        }

        .product-info {
            padding: 20px;
        }

        .product-category {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .product-title {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #080808;
            font-weight: 600;
        }

        .product-price {
            font-size: 1.4em;
            font-weight: 600;
            color: #080808;
            margin-bottom: 15px;
        }

        .add-to-cart {
            width: 100%;
            padding: 12px;
            background: #080808;
            color: #FFFD55;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        .add-to-cart:hover {
            background: #FFFD55;
            color: #080808;
        }
        
        .no-products {
            text-align: center;
            padding: 50px 0;
            color: #666;
            font-size: 1.2em;
        }
        
        .products-count {
            text-align: center;
            margin: 10px 0 30px;
            color: #666;
        }

        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .product-quantity {
            width: 60px;
            text-align: center;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }
        
        .product-actions {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .product-card-form {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Notre Collection de Produits</h1>
        <p>Découvrez nos produits de qualité pour tous vos projets</p>
    </div>

    <div class="container">
        <!-- Messages de notification -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Barre de recherche -->
        <form action="index.php" method="GET" class="search-form">
            <input type="hidden" name="page" value="produit">
            <div class="search-bar">
                <input type="text" name="search" class="search-input" placeholder="Rechercher un produit..." 
                       value="<?php echo isset($searchTerm) ? htmlspecialchars($searchTerm) : ''; ?>">
                <button type="submit" class="search-button">Rechercher</button>
            </div>
        </form>

        <!-- Filtres par catégorie -->
        <div class="filters">
            <a href="index.php?page=produit" class="filter-btn <?php echo !isset($categorieActuelle) ? 'active' : ''; ?>">
                Tous
            </a>
            <?php foreach($categories as $categorie): ?>
                <a href="index.php?page=produit&categorie=<?php echo urlencode($categorie['categorie']); ?>" 
                   class="filter-btn <?php echo (isset($categorieActuelle) && $categorieActuelle == $categorie['categorie']) ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($categorie['categorie']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Compteur de produits -->
        <div class="products-count">
            <?php 
            $count = count($produits);
            echo $count . " produit" . ($count > 1 ? "s" : "") . " trouvé" . ($count > 1 ? "s" : "");
            ?>
        </div>

        <!-- Grille de produits -->
        <div class="products-grid">
            <?php if(count($produits) > 0): ?>
                <?php foreach($produits as $produit): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-category"><?php echo htmlspecialchars($produit['categorie']); ?></div>
                            <h3 class="product-title"><?php echo htmlspecialchars($produit['nomproduit']); ?></h3>
                            <div class="product-price"><?php echo number_format($produit['prix_unit'], 2, ',', ' '); ?> €</div>
                            
                            <form method="post" action="index.php?page=produit<?php echo isset($categorieActuelle) ? '&categorie=' . urlencode($categorieActuelle) : ''; ?>" class="product-card-form">
                                <input type="hidden" name="idproduit" value="<?php echo $produit['idproduit']; ?>">
                                <div class="product-actions">
                                    <input type="number" name="quantite" value="1" min="1" max="99" class="product-quantity">
                                    <button type="submit" name="add_to_cart" class="add-to-cart">
                                        <i class="fas fa-shopping-cart me-2"></i>Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-products">
                    <p>Aucun produit ne correspond à votre recherche.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>

<!-- En-tête de la page contenant la barre de navigation -->
<div>
    <!-- Barre de navigation principale -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Logo et nom du site -->
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-lightbulb me-2"></i>Alume
            </a>
            <!-- Bouton hamburger pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu principal -->
                <ul class="navbar-nav main-menu">
                    <!-- Liens de navigation -->
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=categorie">Categorie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=produit">Produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=contact">Contact</a>
                    </li>
                </ul>
                
                <!-- Conteneur d'authentification -->
                <div class="auth-container">
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'client'): 
                        // Récupération du panier actif et du nombre d'articles
                        $idclient = $_SESSION['idclient'];
                        $unPanier = $unControleur->getPanierActif($idclient);
                        $nombreArticles = $unControleur->getNombreArticlesPanier($unPanier['idpanier']);
                    ?>
                        <a href="index.php?page=panier" class="btn btn-outline-warning me-2 position-relative">
                            <i class="bi bi-cart3"></i>
                            <?php if($nombreArticles > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $nombreArticles; ?>
                                    <span class="visually-hidden">articles dans le panier</span>
                                </span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                
                    <div class="btn-group">
                        <?php 
                        // Vérifie si l'utilisateur est connecté
                        if(isset($_SESSION['email'])) { ?>

                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> 
                                <?php 
                                // Affichage personnalisé selon le rôle
                                if(isset($_SESSION['role'])) {
                                    // Récupération du nom à partir de unUser
                                    $nomUtilisateur = '';
                                    
                                    if(isset($_SESSION['unUser']['nom'])) {
                                        $nomUtilisateur = $_SESSION['unUser']['nom'];
                                    } else {
                                        $nomUtilisateur = $_SESSION['email']; // Utiliser l'email si le nom n'est pas disponible
                                    }
                                    
                                    echo $nomUtilisateur ;
                                } else {
                                    echo $_SESSION['email'];
                                }
                                ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="index.php?page=profil">Mon profil</a></li>
                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'client') { ?>
                                    <li><a class="dropdown-item" href="index.php?page=mes_commandes">Mes commandes</a></li>
                                <?php } ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="index.php?page=gestion_utilisateur&action=deconnexion">
                                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                </a></li>
                            </ul>
                        <?php } else { ?>
                            <!-- Affichage pour utilisateur non connecté -->
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="index.php?page=connexion">Connexion</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="ms-3"><i><b>Client</b></i></li>
                                <li><a class="dropdown-item" href="index.php?page=inscription_client">Démarrer mon inscription</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="ms-3"><i><b>Administration</b></i></li>
                                <li><a class="dropdown-item" href="index.php?page=connexion_admin">Accès administrateur</a></li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<!-- Styles CSS pour la barre de navigation -->
<style>
    /* Style de base de la barre de navigation */
    .navbar {
        background: linear-gradient(to right, #1a1a1a, #363636) !important;
        padding: 1rem 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Style du logo */
    .navbar-brand {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffd700 !important;
    }

    /* Style des liens de navigation */
    .nav-link {
        font-size: 1.1rem;
        margin: 0 10px;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #ffd700 !important;
    }

    .nav-link.active {
        color: #ffd700 !important;
        font-weight: bold;
    }

    .main-menu {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .auth-buttons .btn {
        margin-left: 10px;
        border-radius: 20px;
    }

    .btn-login {
        background-color: transparent;
        border: 2px solid #ffd700;
        color: #ffd700;
    }

    .btn-login:hover {
        background-color: #ffd700;
        color: #1a1a1a;
    }

    .btn-register {
        background-color: #ffd700;
        border: 2px solid #ffd700;
        color: #1a1a1a;
    }

    .btn-register:hover {
        background-color: transparent;
        color: #ffd700;
    }

    .auth-container {
        margin-left: auto;
    }

    .btn-group .btn-primary {
        background-color: #ffd700;
        border-color: #ffd700;
        color: #1a1a1a;
    }

    .btn-group .btn-primary:hover {
        background-color: transparent;
        color: #ffd700;
        border-color: #ffd700;
    }

    /* Style du menu déroulant */
    .dropdown-menu {
        background-color: #1a1a1a;
        border: 1px solid #ffd700;
    }

    .dropdown-item {
        color: #ffffff;
    }

    .dropdown-item:hover {
        background-color: #ffd700;
        color: #1a1a1a;
    }
</style>
<?php 
session_start();
require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php"); 
$unControleur = new Controleur();

// Gérer la déconnexion avant tout output
if (isset($_GET['page']) && $_GET['page'] == 10) {
    session_destroy();
    unset($_SESSION['email']);
    header("Location: index.php");
    exit();
}

// Gérer la connexion avant tout output

?>
<!DOCTYPE html>
<html>
<head>
    <title>Site ALU-ME</title>
    <style>
        .custom-title {
            background: linear-gradient(to right, #080808, #FFFD55);
            color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .navbar {
            background-color: #080808 !important;
            padding: 20px 0 !important;
        }
        
        .navbar-brand {
            font-size: 2rem !important;
            padding: 10px 15px;
        }
        
        .navbar-nav .nav-link {
            font-size: 1.2rem !important;
            padding: 12px 20px !important;
            margin: 0 8px;
        }

        .auth-container .btn-primary {
            font-size: 1.2rem !important;
            padding: 10px 20px !important;
        }
        
        .fas.fa-lightbulb {
            font-size: 1.8rem !important;
        }
        
        .navbar-brand, .nav-link {
            color:rgb(161, 159, 7) !important;
            transition: transform 0.2s;
        }
        
        .navbar-brand:hover, .nav-link:hover {
            transform: scale(1.05);
            color: #FFFD55 !important;
        }
        
        .btn-primary {
            background-color: #FFFD55 !important;
            border-color: #FFFD55 !important;
            color: #080808 !important;
        }
        
        .btn-primary:hover {
            background-color: #e6e44c !important;
            border-color: #e6e44c !important;
        }
        
        .dropdown-menu {
            background-color: #080808 !important;
            border: 1px solid #FFFD55 !important;
        }
        
        .dropdown-item {
            color: #FFFD55 !important;
        }
        
        .dropdown-item:hover {
            background-color: #FFFD55 !important;
            color: #080808 !important;
        }
        
        .dropdown-divider {
            border-color: #FFFD55 !important;
        }
        
        .ms-3 {
            color: #FFFD55 !important;
        }

        .navbar-nav .nav-link {
            position: relative;
            padding: 8px 15px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #FFFD55;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover {
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<center>
<?php
    if (isset($_SESSION['email']) && isset($_SESSION['role']) && strtolower($_SESSION['role']) === "admin") {
        require_once("template/header_admin.php");
    } else {
        require_once("template/header.php");
    }
    
   
    // Gestion des pages
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    switch ($page) {
        case 1: 
        default: require_once("controleur/home.php"); break;
        case 2: require_once("controleur/gestion_clients.php"); break;
        case 3: require_once("controleur/gestion_techniciens.php"); break;
        case 4: require_once("controleur/gestion_produits.php"); break;
        case 5: require_once("controleur/gestion_cat_produits.php"); break;
        case 6: require_once("controleur/gestion_commandes.php"); break;
        case 7: require_once("controleur/gestion_devis.php"); break;
        case 8: require_once("controleur/gestion_ligne_com.php"); break;
        case 9: require_once("controleur/gestion_interventions.php"); break;
        case 10: /* Déconnexion - handled at the beginning of the file */ break;

        case 'connexion':
            require_once("vue/vue_connexion.php");
            break;

        case 'connexion_admin':
            require_once("vue/vue_connexion_admin.php");
            break;

        case 'categorie':
            require_once("vue/partie_utilisateur/categorie.php");
            break;

        case 'produit':
            require_once("vue/partie_utilisateur/produits.php");
            break;

        case 'inscription_client':
            require_once("vue/partie_utilisateur/vue_inscription_client.php");
            break;

        case 'inscription_technicien':
            require_once("vue/partie_utilisateur/vue_inscription_technicien.php");
            break;

        case 'contact':
            require_once("vue/partie_utilisateur/contact.php");
            break;

        case 'gestion_utilisateur':
            require_once("controleur/gestion_utilisateur.php");
            break;

        case 'gestion_admin':
            require_once("controleur/gestion_admin.php");
            break;

        case 'panier':
            require_once("vue/partie_utilisateur/panier.php");
            break;

        case 'mes_commandes':
            require_once("vue/partie_utilisateur/mes_commandes.php");
            break;


            case 'profil':
                require_once("vue/partie_utilisateur/profil.php");
                break;
    }

    require_once("template/footer.php");
?>

</center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

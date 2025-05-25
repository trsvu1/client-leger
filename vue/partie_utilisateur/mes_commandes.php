<?php
require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// Vérifier que l'utilisateur est connecté et est un client
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'client') {
    echo '<div class="alert alert-danger mt-4" role="alert">
            <h4 class="alert-heading">Accès refusé</h4>
            <p>Vous devez être connecté en tant que client pour accéder à cette page.</p>
            <hr>
            <p class="mb-0">
                <a href="index.php?page=connexion" class="btn btn-primary">Se connecter</a>
            </p>
        </div>';
    exit;
}

// Récupérer l'ID du client connecté
$idclient = $_SESSION['idclient'];

// Récupérer toutes les commandes du client
$lesCommandes = $unControleur->getCommandesClient($idclient);

// Gestion de la suppression d'une commande
if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['idcommande'])) {
    $idcommande = intval($_GET['idcommande']);
    $resultat = $unControleur->deleteCommande($idcommande);
    // Redirection pour éviter de retraiter la suppression lors d'un rafraîchissement
    echo '<script>
    window.location.href = "index.php?page=mes_commandes&suppression=success";
</script>';
exit; 
}

// Récupération des détails d'une commande spécifique si demandé
$detailsCommande = null;
$commandeSelectionnee = null;
if(isset($_GET['details']) && is_numeric($_GET['details'])) {
    $idcommande = intval($_GET['details']);
    $detailsCommande = $unControleur->getDetailsCommande($idcommande);
    
    // Récupérer les informations de la commande sélectionnée
    foreach($lesCommandes as $commande) {
        if($commande['idcommande'] == $idcommande) {
            $commandeSelectionnee = $commande;
            break;
        }
    }
}

// Fonction pour formater le statut de la commande
function formatStatut($statut) {
    switch(strtolower($statut)) {
        case 'en attente':
            return '<span class="badge bg-warning text-dark">En attente</span>';
        case 'validée':
        case 'validee':
            return '<span class="badge bg-success">Validée</span>';
        case 'expédiée':
        case 'expediee':
            return '<span class="badge bg-info">Expédiée</span>';
        case 'livrée':
        case 'livree':
            return '<span class="badge bg-primary">Livrée</span>';
        case 'annulée':
        case 'annulee':
            return '<span class="badge bg-danger">Annulée</span>';
        default:
            return '<span class="badge bg-secondary">'.$statut.'</span>';
    }
}

// Fonction pour obtenir la classe CSS du statut
function getStatusClass($statut) {
    switch(strtolower($statut)) {
        case 'en attente': return 'status-pending';
        case 'validée': 
        case 'validee': return 'status-validated';
        case 'expédiée': 
        case 'expediee': return 'status-shipped';
        case 'livrée': 
        case 'livree': return 'status-delivered';
        case 'annulée': 
        case 'annulee': return 'status-cancelled';
        default: return '';
    }
}

// Fonction pour formater un prix
function formatPrix($prix) {
    return number_format($prix, 2, ',', ' ') . ' €';
}

// Fonction pour formater une date (sans l'heure)
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d/m/Y', $timestamp);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes commandes - ALUME</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .orders-header {
            background: linear-gradient(135deg, #080808 0%, #333333 100%);
            padding: 40px 0;
            margin-bottom: 30px;
            color: white;
            text-align: center;
            border-bottom: 3px solid #FFFD55;
        }
        
        .orders-header h1 {
            font-weight: 600;
            color: #FFFD55;
            margin-bottom: 10px;
        }
        
        .orders-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }
        
        .order-card {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .order-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-3px);
            border-color: #FFFD55;
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        
        .order-id {
            font-weight: 600;
            font-size: 1.1rem;
            color: #080808;
        }
        
        .order-date {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .order-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .order-total {
            font-weight: 600;
            color: #080808;
            font-size: 1.1rem;
        }
        
        .order-items {
            color: #6c757d;
        }
        
        .order-status {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        
        .btn-details {
            background-color: #080808;
            color: #FFFD55;
            border: none;
            padding: 5px 15px;
            border-radius: 20px;
            margin-left: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-details:hover {
            background-color: #FFFD55;
            color: #080808;
            transform: translateY(-2px);
        }
        
        .empty-orders {
            text-align: center;
            padding: 40px 0;
            color: #6c757d;
        }
        
        .empty-orders i {
            font-size: 60px;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        
        .order-details {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
        }
        
        .order-details-header {
            border-bottom: 2px solid #FFFD55;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .order-details-title {
            font-weight: 600;
            font-size: 1.3rem;
            color: #080808;
        }
        
        .order-details-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .order-details-info-item {
            margin-bottom: 10px;
            flex: 1;
            min-width: 200px;
        }
        
        .order-details-info-label {
            font-weight: 500;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .order-details-info-value {
            font-weight: 600;
            color: #080808;
        }
        
        .order-details-items {
            margin-top: 20px;
        }
        
        .order-details-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .order-details-item:last-child {
            border-bottom: none;
        }
        
        .order-details-item-image {
            flex: 0 0 80px;
            height: 80px;
            margin-right: 15px;
            text-align: center;
            line-height: 80px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        
        .order-details-item-image img {
            max-width: 100%;
            max-height: 100%;
            vertical-align: middle;
        }
        
        .order-details-item-info {
            flex: 1;
        }
        
        .order-details-item-name {
            font-weight: 600;
            color: #080808;
            margin-bottom: 5px;
        }
        
        .order-details-item-category {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .order-details-item-price {
            text-align: right;
            flex: 0 0 100px;
            font-weight: 600;
            color: #080808;
        }
        
        .order-details-summary {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
            text-align: right;
        }
        
        .order-details-total {
            font-size: 1.3rem;
            font-weight: 700;
            color: #080808;
        }
        
        .order-details-total-label {
            color: #6c757d;
        }
        
        .btn-back {
            background-color: #080808;
            color: #FFFD55;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background-color: #FFFD55;
            color: #080808;
        }
        
        .order-timeline {
            position: relative;
            padding-left: 30px;
            margin: 20px 0;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        
        .timeline-item:before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #dee2e6;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #dee2e6;
        }
        
        .timeline-item:after {
            content: '';
            position: absolute;
            left: -24px;
            top: 15px;
            width: 2px;
            height: calc(100% - 15px);
            background-color: #dee2e6;
        }
        
        .timeline-item:last-child:after {
            display: none;
        }
        
        .timeline-item.active:before {
            background-color: #FFFD55;
            box-shadow: 0 0 0 2px #FFFD55;
        }
        
        .timeline-item-date {
            color: #6c757d;
            font-size: 0.8rem;
            margin-bottom: 2px;
        }
        
        .timeline-item-title {
            font-weight: 600;
            color: #080808;
        }
        
        .timeline-item-description {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* Classes de statut pour les commandes */
        .status-pending .timeline-item:nth-child(1):before {
            background-color: #FFFD55;
            box-shadow: 0 0 0 2px #FFFD55;
        }
        
        .status-validated .timeline-item:nth-child(-n+2):before {
            background-color: #FFFD55;
            box-shadow: 0 0 0 2px #FFFD55;
        }
        
        .status-shipped .timeline-item:nth-child(-n+3):before {
            background-color: #FFFD55;
            box-shadow: 0 0 0 2px #FFFD55;
        }
        
        .status-delivered .timeline-item:nth-child(-n+4):before {
            background-color: #FFFD55;
            box-shadow: 0 0 0 2px #FFFD55;
        }
        
        .status-cancelled .timeline-item:nth-child(5):before {
            background-color: #dc3545;
            box-shadow: 0 0 0 2px #dc3545;
        }
        
        /* Style pour les messages de succès */
        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background: linear-gradient(135deg, #080808 0%, #333333 100%);
            color: #FFFD55;
            border-left: 5px solid #FFFD55;
            border-radius: 5px;
            padding: 15px 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            animation: slideIn 0.5s ease, fadeOut 0.5s ease 5s forwards;
            max-width: 350px;
        }
        
        .success-message i {
            font-size: 24px;
            margin-right: 15px;
        }
        
        .success-message-content {
            flex: 1;
        }
        
        .success-message h4 {
            margin: 0 0 5px 0;
            font-weight: 600;
        }
        
        .success-message p {
            margin: 0;
            color: #fff;
            font-size: 0.9rem;
        }
        
        .success-message .close-btn {
            color: #fff;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            margin-left: 15px;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; visibility: hidden; }
        }
    </style>
</head>
<body>
    <!-- Message de succès (s'affiche uniquement si suppression=success est dans l'URL) -->
    <?php if(isset($_GET['suppression']) && $_GET['suppression'] == 'success'): ?>
        <div class="success-message" id="success-notification">
            <i class="fas fa-check-circle"></i>
            <div class="success-message-content">
                <h4>Suppression réussie !</h4>
                <p>Votre commande a bien été supprimée.</p>
            </div>
            <button class="close-btn" onclick="document.getElementById('success-notification').style.display='none';">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <div class="orders-header">
        <div class="container">
            <h1>Mes Commandes</h1>
            <p>Suivez l'historique et l'état de toutes vos commandes</p>
        </div>
    </div>
    
    <div class="container">
        <?php if(isset($detailsCommande) && !empty($detailsCommande) && $commandeSelectionnee): ?>
            <!-- Affichage des détails d'une commande spécifique -->
            <div class="orders-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="index.php?page=mes_commandes" class="btn btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux commandes
                    </a>
                </div>
                
                <div class="order-details">
                    <div class="order-details-header">
                        <h2 class="order-details-title">Commande #<?php echo $commandeSelectionnee['idcommande']; ?></h2>
                        <div class="d-flex justify-content-between mt-2">
                            <div>
                                <span class="text-muted">Date de commande:</span>
                                <span class="ms-2 fw-bold"><?php echo formatDate($commandeSelectionnee['datedevis']); ?></span>
                            </div>
                            <div>
                                <?php echo formatStatut($commandeSelectionnee['etatcom']); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="order-details-info">
                        <div class="order-details-info-item">
                            <div class="order-details-info-label">État actuel</div>
                            <div class="order-details-info-value">Confirmée</div>
                        </div>
                        <div class="order-details-info-item">
                            <div class="order-details-info-label">Numéro de commande</div>
                            <div class="order-details-info-value">#<?php echo $commandeSelectionnee['idcommande']; ?></div>
                        </div>
                        <div class="order-details-info-item">
                            <div class="order-details-info-label">Devis référence</div>
                            <div class="order-details-info-value">#<?php echo $commandeSelectionnee['codedevis']; ?></div>
                        </div>
                        <div class="order-details-info-item">
                            <div class="order-details-info-label">Total</div>
                            <div class="order-details-info-value"><?php echo formatPrix($commandeSelectionnee['montantTotal']); ?></div>
                        </div>
                    </div>
                    
                    <!-- Ajout du bouton de suppression -->
                    <div class="text-end mb-4">
                        <a href="index.php?page=mes_commandes&action=supprimer&idcommande=<?php echo $commandeSelectionnee['idcommande']; ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande? Cette action est irréversible.');">
                            <i class="fas fa-trash-alt me-2"></i>Supprimer cette commande
                        </a>
                    </div>
                    
                    <!-- Chronologie de la commande -->
                    <div class="order-timeline <?php echo getStatusClass($commandeSelectionnee['etatcom']); ?>">
                        <div class="timeline-item active">
                            <div class="timeline-item-date"><?php echo formatDate($commandeSelectionnee['datedevis']); ?></div>
                            <div class="timeline-item-title">Commande reçue</div>
                            <div class="timeline-item-description">Votre commande a été enregistrée avec succès.</div>
                        </div>
                       
                    </div>
                    
                    <h3 class="mt-4 mb-3">Articles commandés</h3>
                    <div class="order-details-items">
                        <?php foreach($detailsCommande as $detail): ?>
                            <div class="order-details-item">
                                <div class="order-details-item-image">
                                    <?php if(!empty($detail['image'])): ?>
                                        <img src="<?php echo $detail['image']; ?>" alt="<?php echo $detail['nomproduit']; ?>">
                                    <?php else: ?>
                                        <i class="fas fa-box fa-2x text-secondary"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="order-details-item-info">
                                    <div class="order-details-item-name"><?php echo $detail['nomproduit']; ?></div>
                                    <div class="order-details-item-category">
                                        Catégorie: <?php echo $detail['categorie']; ?> | 
                                        Quantité: <?php echo $detail['quantite']; ?> x <?php echo formatPrix($detail['prix_unit']); ?>
                                    </div>
                                </div>
                                <div class="order-details-item-price"><?php echo formatPrix($detail['sousTotal']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="order-details-summary">
                        <div class="order-details-total">
                            <span class="order-details-total-label">Total: </span>
                            <?php echo formatPrix($commandeSelectionnee['montantTotal']); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Liste des commandes -->
            <div class="orders-container">
                <h2 class="mb-4">Historique de vos commandes</h2>
                
                <?php if(empty($lesCommandes)): ?>
                    <div class="empty-orders">
                        <i class="fas fa-shopping-cart"></i>
                        <h4>Vous n'avez pas encore de commandes</h4>
                        <p>Vos commandes passées s'afficheront ici.</p>
                        <a href="index.php?page=produit" class="btn btn-back mt-3">
                            <i class="fas fa-shopping-bag me-2"></i>Découvrir nos produits
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Vous pouvez cliquer sur "Détails" pour voir toutes les informations d'une commande.
                            </div>
                        </div>
                    </div>
                    
                    <?php foreach($lesCommandes as $commande): ?>
                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-id">
                                    Commande #<?php echo $commande['idcommande']; ?>
                                </div>
                                <div class="order-date">
                                    <?php echo formatDate($commande['datedevis']); ?>
                                </div>
                            </div>
                            <div class="order-info">
                                <div>
                                    <div class="order-items">
                                        <?php echo $commande['nbArticles']; ?> article(s)
                                    </div>
                                    <div class="order-total">
                                        Total: <?php echo formatPrix($commande['montantTotal']); ?>
                                    </div>
                                </div>
                                <div class="order-status">
                                    <span class="badge bg-success">Confirmée</span>
                                    <a href="index.php?page=mes_commandes&details=<?php echo $commande['idcommande']; ?>" class="btn btn-details ms-2">
                                        Détails
                                    </a>
                                    <a href="index.php?page=mes_commandes&action=supprimer&idcommande=<?php echo $commande['idcommande']; ?>" 
                                       class="btn btn-sm btn-danger ms-2"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-fermeture du message de succès après 5 secondes
        setTimeout(function() {
            var successMessage = document.getElementById('success-notification');
            if (successMessage) {
                var newURL = window.location.href.split('?')[0] + '?page=mes_commandes';
                window.history.replaceState({}, document.title, newURL); // Supprime les paramètres de l'URL
            }
        }, 5000);
    </script>
</body>
</html>

<?php
// Vérification que l'utilisateur est bien connecté
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    echo '<div class="alert alert-warning">
            <h4 class="alert-heading">Accès non autorisé</h4>
            <p>Vous devez être connecté pour accéder à cette page.</p>
            <hr>
            <a href="index.php?page=connexion" class="btn btn-primary">Se connecter</a>
          </div>';
    exit;
}

require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// Récupération des informations de l'utilisateur selon son rôle
$infoUser = null;
$idUser = null;
$message = '';
$messageType = '';

if ($_SESSION['role'] == 'client' && isset($_SESSION['idclient'])) {
    $idUser = $_SESSION['idclient'];
    $infoUser = $unControleur->selectWhereClient($idUser);
    $userType = 'client';
} elseif ($_SESSION['role'] == 'technicien' && isset($_SESSION['idtechnicien'])) {
    $idUser = $_SESSION['idtechnicien'];
    $infoUser = $unControleur->selectWhereTechnicien($idUser);
    $userType = 'technicien';
} else {
    echo '<div class="alert alert-danger">
            <h4 class="alert-heading">Erreur</h4>
            <p>Impossible de récupérer les informations de votre profil.</p>
          </div>';
    exit;
}

// Traitement du formulaire de modification
if (isset($_POST['modifier_profil'])) {
    $erreurs = [];
    
    // Validation des champs communs
    if (empty($_POST['email'])) {
        $erreurs[] = "L'email est obligatoire";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "Format d'email invalide";
    }

    // Si pas d'erreurs, on procède à la mise à jour
    if (empty($erreurs)) {
        if ($userType == 'client') {
            $tab = [
                'idclient' => $idUser,
                'nom' => $_POST['nom'],
                'ville' => $_POST['ville'],
                'codepostal' => $_POST['codepostal'],
                'rue' => $_POST['rue'],
                'numrue' => $_POST['numrue'],
                'email' => $_POST['email'],
                'tel' => $_POST['tel'],
                'mdp' => !empty($_POST['nouveau_mdp']) ? $_POST['nouveau_mdp'] : $infoUser['mdp']
            ];
            $unControleur->updateClient($tab);
            $message = "Votre profil a été mis à jour avec succès !";
            $messageType = "success";
            
            // Mettre à jour les infos dans la session
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['unUser']['nom'] = $_POST['nom'];
            
            // Actualiser les informations après modification
            $infoUser = $unControleur->selectWhereClient($idUser);
            
        } elseif ($userType == 'technicien') {
            $tab = [
                'idtechnicien' => $idUser,
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'specialite' => $infoUser['specialite'], // On conserve la spécialité actuelle
                'mdp' => !empty($_POST['nouveau_mdp']) ? $_POST['nouveau_mdp'] : $infoUser['mdp']
            ];
            $unControleur->updateTechnicien($tab);
            $message = "Votre profil a été mis à jour avec succès !";
            $messageType = "success";
            
            // Mettre à jour les infos dans la session
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['unUser']['nom'] = $_POST['nom'];
            $_SESSION['unUser']['prenom'] = $_POST['prenom'];
            
            // Actualiser les informations après modification
            $infoUser = $unControleur->selectWhereTechnicien($idUser);
        }
    } else {
        $message = "Erreurs dans le formulaire :<br>".implode("<br>", $erreurs);
        $messageType = "danger";
    }
}

// Récupération des commandes si c'est un client
$commandesClient = [];
if ($userType == 'client') {
    $commandesClient = $unControleur->getCommandesClient($idUser);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - ALUME</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .page-header {
            background: linear-gradient(135deg, #080808 0%, #333333 100%);
            padding: 50px 0;
            margin-bottom: 40px;
            color: white;
            position: relative;
        }
        
        .page-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #FFFD55;
        }
        
        .page-header h1 {
            color: #FFFD55;
            font-weight: 600;
        }
        
        .profile-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 40px;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #080808;
            color: #FFFD55;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin-right: 20px;
        }
        
        .profile-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .profile-role {
            font-size: 16px;
            color: #6c757d;
            text-transform: capitalize;
        }
        
        .profile-tabs {
            margin-bottom: 30px;
        }
        
        .nav-tabs .nav-link {
            color: #080808;
            font-weight: 500;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 12px 20px;
        }
        
        .nav-tabs .nav-link.active {
            border-color:rgb(32, 32, 6);
            color: #080808;
            background-color: transparent;
        }
        
        .tab-content {
            padding: 20px 0;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #080808;
        }
        
        .form-control {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px 15px;
        }
        
        .form-control:focus {
            border-color:rgb(173, 171, 10);
            box-shadow: 0 0 0 0.25rem rgba(255, 253, 85, 0.25);
        }
        
        .btn-yellow {
            background-color: #FFFD55;
            border-color: #FFFD55;
            color: #080808;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-yellow:hover {
            background-color: #e6e44c;
            border-color: #e6e44c;
            color: #080808;
            transform: translateY(-2px);
        }
        
        .btn-dark {
            background-color: #080808;
            border-color: #080808;
            color:rgb(104, 102, 4);
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-dark:hover {
            background-color: #1c1c1c;
            color: #FFFD55;
            transform: translateY(-2px);
        }
        
        .info-item {
            margin-bottom: 15px;
        }
        
        .info-label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #080808;
        }
        
        .info-value {
            color: #6c757d;
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        
        .password-toggle {
            cursor: pointer;
        }
        
        .order-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        
        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-color: #FFFD55;
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        
        .order-number {
            font-weight: 600;
            color: #080808;
        }
        
        .order-date {
            color: #6c757d;
        }
        
        .order-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .order-status.pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .order-status.delivered {
            background-color: #d4edda;
            color: #155724;
        }
        
        .order-status.cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .empty-orders {
            text-align: center;
            padding: 50px 0;
            color: #6c757d;
        }
        
        .empty-orders i {
            font-size: 50px;
            color: #dee2e6;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <h1>Mon Profil</h1>
            <p>Gérez vos informations personnelles et suivez vos commandes</p>
        </div>
    </div>
    
    <div class="container mb-5">
        <!-- Messages de notification -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h2 class="profile-name">
                        <?php 
                        if ($userType == 'client') {
                            echo htmlspecialchars($infoUser['nom']);
                        } elseif ($userType == 'technicien') {
                            echo htmlspecialchars($infoUser['prenom'] . ' ' . $infoUser['nom']);
                        }
                        ?>
                    </h2>
                    <div class="profile-role">
                        <span class="badge bg-dark"><?php echo $userType; ?></span>
                        <span class="ms-2"><?php echo htmlspecialchars($infoUser['email']); ?></span>
                    </div>
                </div>
            </div>
            
            <ul class="nav nav-tabs profile-tabs" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                        <i class="fas fa-info-circle me-2"></i>Mes informations
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab">
                        <i class="fas fa-edit me-2"></i>Modifier mon profil
                    </button>
                </li>
                <?php if ($userType == 'client'): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab">
                        <i class="fas fa-shopping-bag me-2"></i>Mes commandes
                    </button>
                </li>
                <?php endif; ?>
            </ul>
            
            <div class="tab-content" id="profileTabsContent">
                <!-- Onglet Informations -->
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value"><?php echo htmlspecialchars($infoUser['email']); ?></div>
                            </div>
                            
                            <?php if ($userType == 'client'): ?>
                                <div class="info-item">
                                    <div class="info-label">Nom</div>
                                    <div class="info-value"><?php echo htmlspecialchars($infoUser['nom']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Téléphone</div>
                                    <div class="info-value"><?php echo htmlspecialchars($infoUser['tel']); ?></div>
                                </div>
                            <?php elseif ($userType == 'technicien'): ?>
                                <div class="info-item">
                                    <div class="info-label">Prénom</div>
                                    <div class="info-value"><?php echo htmlspecialchars($infoUser['prenom']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Nom</div>
                                    <div class="info-value"><?php echo htmlspecialchars($infoUser['nom']); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-md-6">
                            <?php if ($userType == 'client'): ?>
                                <div class="info-item">
                                    <div class="info-label">Adresse</div>
                                    <div class="info-value">
                                        <?php echo htmlspecialchars($infoUser['numrue'] . ' ' . $infoUser['rue']); ?><br>
                                        <?php echo htmlspecialchars($infoUser['codepostal'] . ' ' . $infoUser['ville']); ?>
                                    </div>
                                </div>
                            <?php elseif ($userType == 'technicien'): ?>
                                <div class="info-item">
                                    <div class="info-label">Spécialité</div>
                                    <div class="info-value"><?php echo htmlspecialchars($infoUser['specialite']); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Onglet Modification du profil -->
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                    <form method="post" action="">
                        <div class="row">
                            <?php if ($userType == 'client'): ?>
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($infoUser['nom']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="tel" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($infoUser['tel']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($infoUser['email']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="codepostal" class="form-label">Code postal</label>
                                    <input type="text" class="form-control" id="codepostal" name="codepostal" value="<?php echo htmlspecialchars($infoUser['codepostal']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" class="form-control" id="ville" name="ville" value="<?php echo htmlspecialchars($infoUser['ville']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="rue" class="form-label">Rue</label>
                                    <input type="text" class="form-control" id="rue" name="rue" value="<?php echo htmlspecialchars($infoUser['rue']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="numrue" class="form-label">Numéro de rue</label>
                                    <input type="text" class="form-control" id="numrue" name="numrue" value="<?php echo htmlspecialchars($infoUser['numrue']); ?>" required>
                                </div>
                            <?php elseif ($userType == 'technicien'): ?>
                                <div class="col-md-6 mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($infoUser['prenom']); ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($infoUser['nom']); ?>" required>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($infoUser['email']); ?>" required>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="specialite" class="form-label">Spécialité</label>
                                    <input type="text" class="form-control" id="specialite" name="specialite" value="<?php echo htmlspecialchars($infoUser['specialite']); ?>" readonly>
                                    <small class="text-muted">La spécialité ne peut pas être modifiée.</small>
                                </div>
                            <?php endif; ?>
                            
                            <div class="col-md-12 mt-3 mb-3">
                                <hr>
                                <h5>Changer votre mot de passe</h5>
                                <p class="text-muted small">Laissez ces champs vides si vous ne souhaitez pas modifier votre mot de passe.</p>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="nouveau_mdp" class="form-label">Nouveau mot de passe</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="nouveau_mdp" name="nouveau_mdp">
                                    <span class="input-group-text password-toggle" onclick="togglePassword('nouveau_mdp')">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="confirm_mdp" class="form-label">Confirmer le mot de passe</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm_mdp" name="confirm_mdp">
                                    <span class="input-group-text password-toggle" onclick="togglePassword('confirm_mdp')">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4 text-end">
                                <button type="reset" class="btn btn-outline-secondary me-2">Annuler</button>
                                <button type="submit" name="modifier_profil" class="btn btn-yellow">
                                    <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Onglet Commandes (uniquement pour les clients) -->
                <?php if ($userType == 'client'): ?>
                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <?php if(empty($commandesClient)): ?>
                    <div class="empty-orders">
                        <i class="fas fa-shopping-cart"></i>
                        <h4>Vous n'avez pas encore de commandes</h4>
                        <p>Vos commandes passées apparaîtront ici.</p>
                        <a href="index.php?page=produit" class="btn btn-dark mt-3">
                            <i class="fas fa-shopping-bag me-2"></i>Découvrir nos produits
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="mb-4">
                        <h4>Vos dernières commandes</h4>
                        <p class="text-muted">Cliquez sur "Détails" pour voir tous les produits d'une commande</p>
                    </div>
                    
                    <?php foreach(array_slice($commandesClient, 0, 3) as $commande): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-number">Commande #<?php echo $commande['idcommande']; ?></div>
                            <div class="order-date"><?php echo date('d/m/Y', strtotime($commande['datedevis'])); ?></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div><?php echo $commande['nbArticles']; ?> article(s)</div>
                                <div class="fw-bold">Total: <?php echo number_format($commande['montantTotal'], 2, ',', ' '); ?> €</div>
                            </div>
                            <div>
                                <span class="badge bg-success">Confirmée</span>
                                <a href="index.php?page=mes_commandes&details=<?php echo $commande['idcommande']; ?>" class="btn btn-sm btn-dark ms-2">Détails</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <?php if(count($commandesClient) > 3): ?>
                    <div class="text-center mt-4">
                        <a href="index.php?page=mes_commandes" class="btn btn-dark">
                            <i class="fas fa-list me-2"></i>Voir toutes mes commandes
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
        
        // Validation du formulaire pour s'assurer que les mots de passe correspondent
        document.querySelector('form').addEventListener('submit', function(e) {
            const nouveauMdp = document.getElementById('nouveau_mdp').value;
            const confirmMdp = document.getElementById('confirm_mdp').value;
            
            if (nouveauMdp !== '' && nouveauMdp !== confirmMdp) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
            }
        });
        
        // Vérification du mot de passe en temps réel
        document.getElementById('confirm_mdp').addEventListener('input', function() {
            const nouveauMdp = document.getElementById('nouveau_mdp').value;
            const confirmMdp = this.value;
            
            if (nouveauMdp === confirmMdp) {
                this.style.borderColor = '#28a745';
            } else {
                this.style.borderColor = '#dc3545';
            }
        });
        
        // Auto-hide des messages d'alerte après 5 secondes
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

<?php
if (isset($_POST["ConnexionAdmin"])){
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    
    // Vérification des identifiants administrateur
    $admin = $unControleur->verifConnexionAdmin($email, $mdp);
    
    if ($admin) {
        // Si la connexion est réussie
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $admin['role'] ?? 'admin';
        $_SESSION['nom'] = $admin['nom'] ?? '';
        $_SESSION['prenom'] = $admin['prenom'] ?? '';
        $_SESSION['idadmin'] = $admin['idadmin'] ?? 0;
        
        $message = "Connexion administrateur réussie ! Redirection vers le panel admin...";
        $success = true;
        
        // Redirection vers la page d'administration après un court délai
        echo "<script>
           
                window.location.href = 'index.php?page=1';
        </script>";
    } else {
        // Si la connexion échoue
        $message = "<strong>Échec de connexion</strong><br>Email ou mot de passe administrateur incorrect.<br>Veuillez vérifier vos identifiants et réessayer.";
        $success = false;
        
        // Log de la tentative échouée (optionnel)
        $date = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        error_log("[$date] Tentative de connexion admin échouée pour l'email: $email depuis l'IP: $ip");
        
        // Afficher à nouveau le formulaire avec les messages d'erreur
        require_once("vue/vue_connexion_admin.php");
    }
}

// Si aucune action de connexion, on affiche simplement la vue
if (!isset($_POST["ConnexionAdmin"])) {
    require_once("vue/vue_connexion_admin.php");
}
?>

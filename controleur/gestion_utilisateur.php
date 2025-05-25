<?php
if (isset($_POST["Connexion"])){
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    
    // Vérification des identifiants
    $resultat = $unControleur->verifConnexion($email, $mdp);
    
    if ($resultat && $resultat['success']) {
        // Si la connexion est réussie
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $resultat['role']; // Le rôle est défini par la méthode verifConnexion
        
        // Stockage de l'utilisateur complet dans la session
        $_SESSION['unUser'] = $resultat['data'];
        
        // Stockons l'ID de l'utilisateur selon son rôle
        if ($resultat['role'] == 'client') {
            $_SESSION['idclient'] = $resultat['data']['idclient'];
        } elseif ($resultat['role'] == 'technicien') {
            $_SESSION['idtechnicien'] = $resultat['data']['idtechnicien'];
        }
        
        $message = $resultat['message'];
        $success = true;
        
        // Redirection vers la page d'accueil après un court délai
        echo "<script>
           
                window.location.href = 'index.php?page=1';
           
        </script>";
    } else {
        // Si la connexion échoue, on affiche un message d'erreur
        $message = $resultat ? $resultat['message'] : "Erreur de connexion.";
        $success = false;
    }
}

// Gestion de la déconnexion
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    // Destruction de la session
    session_destroy();
    unset($_SESSION);
    
    // Redirection vers la page d'accueil
    echo "<script>
           
    window.location.href = 'index.php?page=1';

</script>";
}
?>
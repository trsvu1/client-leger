<br>
<h2>Gestion des commandes</h2>

<?php
$laCommande = null;
if(isset($_GET['action']) && isset($_GET['idcommande'])){
    $action = $_GET['action'];
    $idcommande = $_GET['idcommande'];
    switch($action){
        case 'sup': 
            $unControleur->deleteCommande($idcommande);
            echo "<div id='message' style='color: green;'>✔️ Suppression réussie.</div>";
            break;
        case 'edit':
            $laCommande = $unControleur->selectWhereCommande($idcommande);
            // Ajout d'une vérification pour déboguer
            if ($laCommande === false || empty($laCommande)) {
                echo "<div id='message' style='color: red;'>⚠️ Impossible de récupérer les données de la commande #$idcommande.</div>";
            }
            break;
    }
}

// Affichage du formulaire d'insertion/modification
require_once("vue/vue_insert_commande.php");

// Traitement du formulaire d'insertion
if(isset($_POST['Valider'])){
    $unControleur->insertCommande($_POST);
    echo "<div id='message' style='color: green;'>✔️ Insertion réussie.</div>";
}

// Traitement du formulaire de modification
if(isset($_POST['Modifier'])){
    $unControleur->updateCommande($_POST);
    // Afficher un message de succès et rediriger après un délai
    echo "<div id='message' style='color: green; font-weight: bold; padding: 10px; background-color: #f0fff0; border: 1px solid green; border-radius: 5px; margin: 10px 0;'>✅ Modification réussie ! Redirection dans 2 secondes...</div>";
    echo "<script>
        setTimeout(function() {
            window.location.href = 'index.php?page=6';
        }, 2000); // Redirection après 2 secondes
    </script>";
}

// Récupération des commandes avec filtrage
if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
}else{
    $filtre = "";
}
$lesCommandes = $unControleur->selectAllCommandes($filtre);

// Affichage de la vue liste des commandes
require_once("vue/vue_select_commandes.php");
?>

<script>
    // Attendre 3 secondes (3000ms), puis cacher le message
    setTimeout(function() {
        const message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000); // 3 secondes
</script>
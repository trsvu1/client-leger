<br>
<h2> Gestion des produits </h2>

<?php
$leProduit = null;

// Gestion des actions
if (isset($_GET['action']) && isset($_GET['idproduit'])) {
    $action = $_GET['action'];
    $idproduit = $_GET['idproduit']; 
    switch ($action) {
        case "sup":
            $unControleur->deleteProduit($idproduit);
            echo "<div id='message' style='color: green;'>✔️ Suppression réussie.</div>";
            break;

        case "edit":
            $leProduit = $unControleur->selectWhereProduit($idproduit);
            break;
    }
}

// Affichage du formulaire d'insertion/modification
require_once("vue/vue_insert_produit.php");

// Traitement du formulaire d'insertion
if (isset($_POST["Valider"])){
    $unControleur->insertProduit($_POST);
    echo "<br> <div id='message' style='color: green;'>✔️ Insertion réussie.</div>";
}

// Traitement du formulaire de modification
if (isset($_POST["Modifier"])){
    $unControleur->updateProduit($_POST);
    // Afficher un message de succès et rediriger après un délai
    echo "<div id='message' style='color: green; font-weight: bold; padding: 10px; background-color: #f0fff0; border: 1px solid green; border-radius: 5px; margin: 10px 0;'>✅ Modification réussie ! Redirection dans 2 secondes...</div>";
    echo "<script>
        setTimeout(function() {
            window.location.href = 'index.php?page=4';
        }, 2000); // Redirection après 2 secondes
    </script>";
}

// Récupération des produits
if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
}else{
    $filtre = "";
}
$lesProduits = $unControleur->selectAllProduits($filtre);

// Affichage de la vue de liste des produits
require_once("vue/vue_select_produits.php");
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

<style>
.flash-message {
    padding: 15px 25px;
    background-color: #d4edda;
    color: #155724;
    font-size: 18px;
    font-weight: bold;
    border: 2px solid #c3e6cb;
    border-radius: 5px;
    margin: 15px 0;
    width: fit-content;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    transition: opacity 1s ease;
}
.fade-out {
    opacity: 0;
}
</style>


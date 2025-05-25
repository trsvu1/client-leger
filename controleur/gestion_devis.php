<?php
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur();
?>

<br>
<h2>Gestion des devis</h2>

<?php
// Initialisation des variables
$unDevis = null;

// Traitement des actions GET (suppression, édition)
if(isset($_GET['action']) && isset($_GET['iddevis'])){
    $action = $_GET['action'];
    $iddevis = $_GET['iddevis'];
    switch($action){
        case "sup":
            $unControleur->deleteDevis($iddevis);
            echo "<div id='message' style='color: green;'>✔️ Suppression réussie.</div>";
            break;
        case "edit":
            $unDevis = $unControleur->selectWhereDevis($iddevis);
            // Ajout d'une vérification pour déboguer
            if ($unDevis === false || empty($unDevis)) {
                echo "<div id='message' style='color: red;'>⚠️ Impossible de récupérer les données du devis #$iddevis.</div>";
            }
            break;
    }
}

// Affichage du formulaire d'insertion/modification
require_once("vue/vue_insert_devis.php");

// Traitement du formulaire d'insertion
if(isset($_POST['Enregistrer'])){
    $tab = array(
        "datedevis" => $_POST['datedevis'],
        "etatdevis" => $_POST['etatdevis'],
        "idclient" => $_POST['idclient']
    );
    $unControleur->insertDevis($tab);
    echo "<div id='message' style='color: green;'>✔️ Insertion réussie.</div>";
}

// Traitement du formulaire de modification
if(isset($_POST['Modifier'])){
    $tab = array(
        "iddevis" => $_POST['iddevis'],
        "datedevis" => $_POST['datedevis'],
        "etatdevis" => $_POST['etatdevis'],
        "idclient" => $_POST['idclient']
    );
    $unControleur->updateDevis($tab);
    // Afficher un message de succès et rediriger après un délai
    echo "<div id='message' style='color: green; font-weight: bold; padding: 10px; background-color: #f0fff0; border: 1px solid green; border-radius: 5px; margin: 10px 0;'>✅ Modification réussie ! Redirection dans 2 secondes...</div>";
    echo "<script>
        setTimeout(function() {
            window.location.href = 'index.php?page=7';
        }, 2000); // Redirection après 2 secondes
    </script>";
}

// Récupération des devis avec filtre
if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
} else {
    $filtre = "";
}
$lesDevis = $unControleur->selectAllDevis($filtre);

// Affichage de la liste des devis
require_once("vue/vue_select_devis.php");
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

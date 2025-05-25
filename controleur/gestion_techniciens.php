<br>
<h2> Gestion des techniciens </h2>

<?php
	$leTechnicien = null;
	if (isset($_GET['action']) && isset($_GET['idtechnicien'])) {
		$action = $_GET['action'];
		$idtechnicien = $_GET['idtechnicien'];
		switch ($action) {
			case "sup":
				$unControleur->deleteTechnicien($idtechnicien);
				echo "<div id='message' style='color: green;'>✔️ Suppression réussie.</div>";
				break;

			case "edit":
				$leTechnicien = $unControleur->selectWhereTechnicien($idtechnicien);
				break;
		}
	}
	else{
		$action = "";
	}

	// Affichage du formulaire d'insertion/modification
	require_once("vue/vue_insert_technicien.php");

	if (isset($_POST["Valider"])){
		// Insertion des données dans la base
		$unControleur->insertTechnicien($_POST);
		echo "<div id='message' style='color: green;'>✔️ Insertion réussie.</div>";
		
	}
	
	// Traitement du formulaire de modification
	if (isset($_POST["Modifier"])){
		// Mise à jour des données dans la base
		$unControleur->updateTechnicien($_POST);
		// Afficher un message de succès et rediriger après un délai
		echo "<div id='message' style='color: green; font-weight: bold; padding: 10px; background-color: #f0fff0; border: 1px solid green; border-radius: 5px; margin: 10px 0;'>✅ Modification réussie ! Redirection dans 2 secondes...</div>";
		echo "<script>
			setTimeout(function() {
				window.location.href = 'index.php?page=3';
			}, 2000); // Redirection après 2 secondes
		</script>";
	}

	//recuperation des clients de la base de données
	if(isset($_POST['Filtrer'])){
		$filtre = $_POST['filtre'];
	}else{
		$filtre = "";
	}
	$lesTechniciens = $unControleur->selectAllTechniciens($filtre);
	require_once ("vue/vue_select_techniciens.php");

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
<br>
<h2> Gestion des techniciens </h2>

<?php
	$leTechnicien = null;
	if (isset($_GET['action'])&& isset($_GET['idtech'])){
		$action = $_GET['action'];
		$idtechnicien = $_GET['idtech'];
		switch ($action){
			case "sup" : 
				$unControleur->deleteTechnicien($idtechnicien);
				echo " <br> Suppression réussie.";
				break;

			case "edit" : 
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
		echo "<br> Insertion réussie.";
		// Redirection pour éviter un double envoi
		header('Location: index.php?page=3');
		exit();  // Toujours faire un exit après une redirection
	}
	
	// Traitement du formulaire de modification
	if (isset($_POST["Modifier"])){
		// Mise à jour des données dans la base
		$unControleur->updateTechnicien($_POST);
		echo "<br> Modification réussie";
		// Redirection après modification pour actualiser la page
		header("Location: index.php?page=3");
		exit();  // Toujours faire un exit après une redirection
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
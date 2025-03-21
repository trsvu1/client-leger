<br>
<h2> Gestion des clients </h2>

<?php
	if(isset($_SESSION['role']) && $_SESSION['role']=="admin"){
		$leClient = null;
		if (isset($_GET['action'])&& isset($_GET['idclient'])){
			$action = $_GET['action'];
			$idclient = $_GET['idclient'];
			switch ($action){
				case "sup" : 
					$unControleur->deleteClient($idclient);
					echo " <br> Suppression réussie.";
					break;

				case "edit" : 
					$leClient = $unControleur->selectWhereClient($idclient);
					break;
			}
		}
		else{
			$action = "";
		}

		// Affichage du formulaire d'insertion/modification
		require_once("vue/vue_insert_client.php");

		if (isset($_POST["Valider"])){
			// Insertion des données dans la base
			$unControleur->insertClient($_POST);
			echo "<br> Insertion réussie.";
			// Redirection pour éviter un double envoi
			header('Location: index.php?page=2');
			 // Toujours faire un exit après une redirection
		}
}
	 
	// Traitement du formulaire de modification
	if (isset($_POST["Modifier"])){
		// Mise à jour des données dans la base
		$unControleur->updateClient($_POST);
		// Redirection après modification pour actualiser la page
		header("Location: index.php?page=2");
		exit();  // Toujours faire un e
	}

	//recuperation des clients de la base de données
	if(isset($_POST['Filtrer'])){
		$filtre = $_POST['filtre'];
	}else{
		$filtre = "";
	}
	$lesClients = $unControleur->selectAllClients($filtre);
	require_once("vue/vue_select_clients.php");
	 
	?>
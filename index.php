<?php
	session_start();	
	require_once("controleur/controleur.class.php"); 
	//instancier la classe controleur : 
	$unControleur = new Controleur();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Site ALU-ME</title>
</head>
<body>
<center>
<h1> Site ALU-ME pour la gestion des projets d'équipement </h1> 
<br>

<?php
	if( ! isset($_SESSION["email"])){
		require_once("vue/vue_connexion.php");
	}

	if(isset($_POST["Connexion"])){
		$email = $_POST["email"];
		$mdp = $_POST["mdp"];

		//on verifie dans la BDD - User
		$unUser = $unControleur->verifConnexion($email, $mdp);
		if($unUser){
			//enregistrement de la session
			$_SESSION["nom"] = $unUser["nom"];
			$_SESSION["prenom"] = $unUser["prenom"];
			$_SESSION["email"] = $unUser["email"];
			$_SESSION["role"] = $unUser["role"];
			//actualisation de la page
			header("Location: index.php?page=1");

		}
		else{
			echo "<br> Veuillez vérifier vos identifiants.";
		}
	}
	if (isset($_SESSION['email'])) {
		echo '<div id="navbar" style="background-color: #f0f0f0; padding: 10px; display: flex; align-items: center; justify-content: space-around; flex-wrap: wrap;">
		
		<a href="index.php?page=1" style="text-decoration: none; color: black; text-align: center;">
			<div>ACCEUIL</div>
			<img src="img/Logo.png" height="100" width="100">
		</a>
		
		<a href="index.php?page=2" style="text-decoration: none; color: black; text-align: center;">
			<div>CLIENT</div>
			<img src="img/client.jpeg" height="100" width="100">
		</a>
		<a href="index.php?page=3" style="text-decoration: none; color: black; text-align: center;">
			<div>TECHNICIEN</div>
			<img src="img/technicien.jpeg" height="100" width="100">
		</a>
		
		<a href="index.php?page=4" style="text-decoration: none; color: black; text-align: center;">
			<div>PRODUIT</div>
			<img src="img/produit.jpeg" height="100" width="100">
		</a>
	
		<a href="index.php?page=5" style="text-decoration: none; color: black; text-align: center;">
			<div>CATEGORIE</div>
			<img src="img/categorie.png" height="100" width="100">
		</a>
	
		<a href="index.php?page=6" style="text-decoration: none; color: black; text-align: center;">
			<div>COMMANDE</div>
			<img src="img/commande.webp" height="100" width="100">
		</a>
	
		<a href="index.php?page=7" style="text-decoration: none; color: black; text-align: center;">
			<div>DEVIS</div>
			<img src="img/devis.png" height="100" width="100">
		</a>
	
		<a href="index.php?page=8" style="text-decoration: none; color: black; text-align: center;">
			<div>LIGNE DE COM</div>
			<img src="img/ligne_com.jpg" height="100" width="100">
		</a>
		
		<a href="index.php?page=9" style="text-decoration: none; color: black; text-align: center;">
			<div>INTERVENTION</div>
			<img src="img/intervention.png" height="100" width="100">
		</a>
		<a href="index.php?page=10" style="text-decoration: none; color: black; text-align: center;">
			<div>DECONNEXION</div>
			<img src="img/deconnexion.png" height="100" width="100">
		</a>
		
		</div>';
	
	 
		if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else {
			$page = 1 ;
		}
		switch ($page) {
			case 1 : require_once ("controleur/home.php"); break;
			case 2 : require_once ("controleur/gestion_clients.php"); break;
			case 3 : require_once ("controleur/gestion_techniciens.php"); break;
			case 4 : require_once ("controleur/gestion_produits.php"); break;
			case 5 : require_once ("controleur/gestion_cat_produits.php"); break;
			case 6 : require_once ("controleur/gestion_commandes.php"); break;
			case 7 : require_once ("controleur/gestion_devis.php"); break;
			case 8 : require_once ("controleur/gestion_ligne_com.php"); break;
			case 9 : require_once ("controleur/gestion_interventions.php"); break;
			case 10 : session_destroy(); unset($_SESSION['email']);
			header("Location: index.php");
			break;
		}
	}//fin de la session
?>

</center>
<div id="footer" style="font-size:smaller ;"></div>
<script>
    fetch('vue/vue_footer.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer').innerHTML = data;
            document.getElementById('footer').style.backgroundColor = '#f0f0f0'; // Fond gris
            document.getElementById('footer').style.padding = '20px';
 
        });
</script>
</body>
</html>
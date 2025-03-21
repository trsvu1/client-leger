<?php
class Modele {
	private $unPdo ; 
	//connexion via la classe PDO : PHP DATA Object 

	public function __construct(){
		$serveur = "localhost"; 
		$bdd = "ALUME"; 
		$user = "root";
		$mdp = ""; 
		try{
		$this->unPdo = new PDO("mysql:host=".$serveur.";dbname=".$bdd,$user, $mdp);
		}
		catch(PDOException $exp){
			echo "Erreur de connexion à la BDD";
		}
	}
	/**************** Gestion des clients ************/
	public function insertClient($tab){
		$requete = "insert into client values (null, :nom, :ville, :codepostal, :rue, :numrue, :email, :mdp, :tel);";
		$donnees = array(':nom' => $tab['nom'],
						 ':ville' => $tab['ville'],
						 ':codepostal' => $tab['codepostal'],
                         ':rue' => $tab['rue'],
                         ':numrue' => $tab['numrue'],
						 ':email' => $tab['email'],
						 ':mdp' => $tab['mdp'],
						 ':tel' => $tab['tel']
						); 
		//on prépare la requete 
		$exec = $this->unPdo->prepare ($requete);
		//exécuter la requete 
		$exec->execute ($donnees);
	}
 

	public function selectAllClients ($filtre){
		if($filtre == ""){
			$requete = "select * from client ;";
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ();
		}else{
			$requete = "select * from client where nom like :filtre or ville like :filtre or email like :filtre or tel like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%") ;
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ($donnees);
		}
		
		return $exec->fetchAll(); //extraire tous les clients
	}
	public function deleteClient($idclient){
		$requete = "delete from client where idclient = :idclient;";
		$donnees = array (':idclient' => $idclient);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function updateClient($tab){
		$requete = "update client set nom = :nom, ville = :ville, codepostal = :codepostal, rue = :rue, numrue = :numrue, email = :email, mdp = :mdp, tel = :tel where idclient = :idclient;";
		$donnees = array (':idclient' => $tab['idclient'],
						':nom' => $tab['nom'],
						':ville' => $tab['ville'],
						':codepostal' => $tab['codepostal'],
						':rue' => $tab['rue'],
						':numrue' => $tab['numrue'],
						':email' => $tab['email'],
						':mdp' => $tab['mdp'],
						':tel' => $tab['tel'],
						);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function selectWhereClient($idclient){
		$requete = "select * from client where idclient = :idclient;";
		$donnees = array (':idclient' => $idclient);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		$unClient = $exec->fetch(); //extraire un seul client
		return $unClient;
	}

	/**************** Gestion des techniciens ************/
	public function insertTechnicien($tab){
		$requete = "insert into technicien values (null, :nom, :prenom, :specialite, :email, :mdp);";
		$donnees = array(':nom' => $tab['nom'],
						':prenom' => $tab['prenom'],
						':specialite' => $tab['specialite'],
						':email' => $tab['email'],
						':mdp' => $tab['mdp'],
						); 
		//on prépare la requete 
		$exec = $this->unPdo->prepare ($requete);
		//exécuter la requete 
		$exec->execute ($donnees);
	}


	public function selectAllTechniciens ($filtre){
		
		if($filtre == ""){
			$requete = "select * from technicien ;";
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ();
		}else{
			$requete = "select * from technicien where nom like :filtre or prenom like :filtre or specialite like :filtre or email like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%") ;
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ($donnees);
		}

		return $exec->fetchAll(); //extraire tous les techniciens
		}
		public function deleteTechnicien($idtechnicien){
		$requete = "delete from technicien where idtech = :idtech;";
		$donnees = array (':idtech' => $idtechnicien);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		}
		public function updateTechnicien($tab){
		$requete = "update technicien set nom = :nom, prenom = :prenom, specialite = :specialite, email = :email, mdp = :mdp where idtech = :idtech;";
		$donnees = array (':idtech' => $tab['idtech'],
						':nom' => $tab['nom'],
						':prenom' => $tab['prenom'],
						':specialite' => $tab['specialite'],
						':email' => $tab['email'],
						':mdp' => $tab['mdp'],
						);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		}
		public function selectWhereTechnicien($idtechnicien){
		$requete = "select * from technicien where idtech = :idtech;";
		$donnees = array (':idtech' => $idtechnicien);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		$unTechnicien = $exec->fetch(); //extraire un seul client
		return $unTechnicien;
		}

		/**************** Gestion des produits ************/
	public function insertProduit($tab){
		$requete = "insert into produit values (null, :nomproduit, :prix_unit, :codecat);";
		$donnees = array(':nomproduit' => $tab['nomproduit'],
						 ':prix_unit' => $tab['prix_unit'],
						 ':codecat' => $tab['codecat']
						); 
		//on prépare la requete 
		$exec = $this->unPdo->prepare ($requete);
		//exécuter la requete 
		$exec->execute ($donnees);
	}
 

	public function selectAllProduits ($filtre){
		if($filtre == ""){
			$requete = "select * from produit ;";
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ();
		}else{
			$requete = "select * from produit where nomproduit like :filtre or prix_unit like :filtre or codecat like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%") ;
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ($donnees);
		}
		
		return $exec->fetchAll(); //extraire tous les clients
	}
	public function deleteProduit($idclient){
		$requete = "delete from produit where idproduit = :idproduit;";
		$donnees = array (':idproduit' => $idproduit);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function updateProduit($tab){
		$requete = "update produit set nomproduit = :nomproduit, prix_unit = :prix_unit, codecat = :codecat where idproduit = :idproduit;"; 
		$donnees = array (':idproduit' => $tab['idproduit'],
						':nomproduit' => $tab['nomproduit'],
						':prix_unit' => $tab['prix_unit'],
						':codecat' => $tab['codecat']
						);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function selectWhereProduit($idproduit){
		$requete = "select * from produit where idproduit = :idproduit;";
		$donnees = array (':idproduit' => $idproduit);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		$unProduit = $exec->fetch(); //extraire un seul PRODUIT
		return $unClient;
	}


	/********************************Gestions des users********************************************/

	public function verifConnexion($email, $mdp){
		$requete = "select * from user where email =:email and mdp=:mdp;";
		$exec =$this->unPdo->prepare($requete);
		$donnees = array(":email"=>$email, ":mdp"=>$mdp);
		$exec->execute($donnees);
		return $exec->fetch();
	}
}

?>
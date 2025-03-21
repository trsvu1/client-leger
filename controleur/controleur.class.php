<?php
	require_once ("modele/modele.class.php");
	class Controleur {
		private $unModele ; 

		public function   __construct(){
			//instancier la classe modele 
			$this->unModele = new Modele (); 
		}
		/****************** Gestion des clients ******/
		public function   insertClient($tab){
			//controler les donnees avant leur insertion dans la BDD 

			//appel au modele pour inserer les données
			$this->unModele->insertClient($tab);
		}
		public function selectAllClients($filtre){
			$lesClients = $this->unModele->selectAllClients($filtre);

			//controler les données 
			return $lesClients;
		}
		public function deleteClient($idclient){
			//on doit vérifier que le client existe dans la table
			$this->unModele->deleteClient($idclient);
		}
		public function updateClient($tab){
			//on doit vérifier que le client existe dans la table
			$this->unModele->updateClient($tab);
		}
		public function selectWhereClient($idclient){
		
			return $this->unModele->selectWhereClient($idclient);
		}

		/****************** Gestion des techniciens ******/
		public function   insertTechnicien($tab){
			//controler les donnees avant leur insertion dans la BDD 

			//appel au modele pour inserer les données
			$this->unModele->insertTechnicien($tab);
		}
		public function selectAllTechniciens($filtre){
			$lesTechniciens = $this->unModele->selectAllTechniciens($filtre);

			//controler les données 
			return $lesTechniciens;
		}
		public function deleteTechnicien($idtechnicien){
			//on doit vérifier que le client existe dans la table
			$this->unModele->deleteTechnicien($idtechnicien);
		}
		public function updateTechnicien($tab){
			//on doit vérifier que le client existe dans la table
			$this->unModele->updateTechnicien($tab);
		}
		public function selectWhereTechnicien($idtechnicien){
			return $this->unModele->selectWhereTechnicien($idtechnicien);
		}

		/****************** Gestion des produits ******/
		public function   insertProduit($tab){
			//controler les donnees avant leur insertion dans la BDD 

			//appel au modele pour inserer les données
			$this->unModele->insertProduit($tab);
		}
		public function selectAllProduits($filtre){
			$lesProduits = $this->unModele->selectAllProduits($filtre);

			//controler les données 
			return $lesProduits;
		}
		public function deleteProduit($idproduit){
			//on doit vérifier que le client existe dans la table
			$this->unModele->deleteProduit($idproduit);
		}
		public function updateProduit($tab){
			//on doit vérifier que le client existe dans la table
			$this->unModele->updateProduit($tab);
		}
		public function selectWhereProduit($idproduit){
		
			return $this->unModele->selectWhereProduit($idproduit);
		}


		/*******Gestion des users ******************************* */
		public function verifConnexion($email, $mdp){
			//controler les donnees email et mdp

			//appel du modele
			return $this->unModele->verifConnexion($email, $mdp);
		}
    }
?>
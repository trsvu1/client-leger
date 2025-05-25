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

		/****************** Gestion des catégories ******/
		public function insertCategorie($tab){
			$this->unModele->insertCategorie($tab);
		}
		
		public function selectAllCategories($filtre = ""){
			return $this->unModele->selectAllCategories($filtre);
		}
		
		public function deleteCategorie($codecat){
			$this->unModele->deleteCategorie($codecat);
		}
		
		public function updateCategorie($tab){
			$this->unModele->updateCategorie($tab);
		}
		
		public function selectWhereCategorie($codecat){
			return $this->unModele->selectWhereCategorie($codecat);
		}
		
		/****************** Gestion des produits frontend ******/
		public function selectAllProduitsFrontend(){
			return $this->unModele->selectAllProduitsFrontend();
		}
		
		public function selectProduitsByCategorie($categorie){
			return $this->unModele->selectProduitsByCategorie($categorie);
		}
		
		public function searchProduits($keyword){
			return $this->unModele->searchProduits($keyword);
		}
		
		public function selectDistinctCategories(){
			return $this->unModele->selectDistinctCategories();
		}

		/*******Gestion des users ******************************* */
		public function verifConnexion($email, $mdp){
			//controler les donnees email et mdp

			//appel du modele
			return $this->unModele->verifConnexion($email, $mdp);
		}

		/*******Gestion des interventions ******************************* */
		public function insertIntervention($tab){
			//contrôler les données avant insertion
			$this->unModele->insertIntervention($tab);
		}

		public function selectAllInterventions($filtre){
			$lesInterventions = $this->unModele->selectAllInterventions($filtre);
			//contrôler les données 
			return $lesInterventions;
		}

		public function deleteIntervention($idtechnicien, $codecom, $datehd){
			$this->unModele->deleteIntervention($idtechnicien, $codecom, $datehd);
		}

		public function updateIntervention($tab){
			$this->unModele->updateIntervention($tab);
		}

		public function selectWhereIntervention($idtechnicien, $codecom, $datehd){
			return $this->unModele->selectWhereIntervention($idtechnicien, $codecom, $datehd);
		}

		/****************** Gestion des commandes ******/
		public function insertCommande($tab){
			$this->unModele->insertCommande($tab);
		}

		public function selectAllCommandes($filtre){
			return $this->unModele->selectAllCommandes($filtre);
		}

		public function deleteCommande($idcommande){
			$this->unModele->deleteCommande($idcommande);
		}

		public function updateCommande($tab){
			$this->unModele->updateCommande($tab);
		}

		public function selectWhereCommande($idcommande){
			return $this->unModele->selectWhereCommande($idcommande);
		}

		/****************** Gestion des commandes client ******/
		public function getCommandesClient($idclient){
			return $this->unModele->getCommandesClient($idclient);
		}

		public function getDetailsCommande($idcommande){
			return $this->unModele->getDetailsCommande($idcommande);
		}

		/****************** Gestion des devis ******/
		public function insertDevis($tab){
			$this->unModele->insertDevis($tab);
		}

		public function selectAllDevis($filtre){
			return $this->unModele->selectAllDevis($filtre);
		}

		public function deleteDevis($iddevis){
			$this->unModele->deleteDevis($iddevis);
		}

		public function updateDevis($tab){
			$this->unModele->updateDevis($tab);
		}

		public function selectWhereDevis($iddevis){
			return $this->unModele->selectWhereDevis($iddevis);
		}

		/****************** Gestion des administrateurs ******/
		public function insertAdmin($tab){
			$this->unModele->insertAdmin($tab);
		}

		public function selectAllAdmins($filtre){
			return $this->unModele->selectAllAdmins($filtre);
		}

		public function deleteAdmin($idadmin){
			$this->unModele->deleteAdmin($idadmin);
		}

		public function updateAdmin($tab){
			$this->unModele->updateAdmin($tab);
		}

		public function selectWhereAdmin($idadmin){
			return $this->unModele->selectWhereAdmin($idadmin);
		}

		public function verifConnexionAdmin($email, $mdp){
			return $this->unModele->verifConnexionAdmin($email, $mdp);
		}

		/****************** Gestion du panier ******/
		public function getPanierActif($idclient){
			return $this->unModele->getPanierActif($idclient);
		}

		public function ajouterProduitPanier($idpanier, $idproduit, $quantite = 1){
			return $this->unModele->ajouterProduitPanier($idpanier, $idproduit, $quantite);
		}

		public function getProduitsPanier($idpanier){
			return $this->unModele->getProduitsPanier($idpanier);
		}

		public function modifierQuantitePanier($idpanier, $idproduit, $quantite){
			return $this->unModele->modifierQuantitePanier($idpanier, $idproduit, $quantite);
		}

		public function supprimerProduitPanier($idpanier, $idproduit){
			return $this->unModele->supprimerProduitPanier($idpanier, $idproduit);
		}

		public function viderPanier($idpanier){
			return $this->unModele->viderPanier($idpanier);
		}

		public function getTotalPanier($idpanier){
			return $this->unModele->getTotalPanier($idpanier);
		}

		public function getNombreArticlesPanier($idpanier){
			return $this->unModele->getNombreArticlesPanier($idpanier);
		}

		public function validerPanier($idpanier, $idclient){
			return $this->unModele->validerPanier($idpanier, $idclient);
		}
	}
?>
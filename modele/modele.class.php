<?php
class Modele {
	private $unPdo ; 
	//connexion via la classe PDO : PHP DATA Object 

	public function __construct(){
		$serveur = "localhost"; 
		$bdd = "alume"; 
		$user = "root";
		$mdp = "root"; 
		try{
		$this->unPdo = new PDO("mysql:host=".$serveur.";dbname=".$bdd,$user, $mdp);
		}
		catch(PDOException $exp){
			echo "Erreur de connexion à la BDD";
		}
	}
	/**************** Gestion des clients ************/
	public function insertClient($tab){
		$requete = "insert into client (nom, ville, codepostal, rue, numrue, email, tel, mdp, role) 
					values (:nom, :ville, :codepostal, :rue, :numrue, :email, :tel, :mdp, :role);";
		$donnees = array(
			':nom' => $tab['nom'],
			':ville' => $tab['ville'],
			':codepostal' => $tab['codepostal'],
			':rue' => $tab['rue'],
			':numrue' => $tab['numrue'],
			':email' => $tab['email'],
			':tel' => $tab['tel'],
			':mdp' => $tab['mdp'],
			':role' => isset($tab['role']) ? $tab['role'] : 'client' // Valeur par défaut 'client'
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
		$requete = "delete from technicien where idtechnicien = :idtechnicien;";
		$donnees = array (':idtechnicien' => $idtechnicien);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		}
		public function updateTechnicien($tab){
		$requete = "update technicien set nom = :nom, prenom = :prenom, specialite = :specialite, email = :email, mdp = :mdp where idtechnicien = :idtechnicien;";
		$donnees = array (
			':idtechnicien' => $tab['idtechnicien'],
			':nom' => $tab['nom'],
			':prenom' => $tab['prenom'],
			':specialite' => $tab['specialite'],
			':email' => $tab['email'],
			':mdp' => $tab['mdp']
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		}
		public function selectWhereTechnicien($idtechnicien){
		$requete = "select * from technicien where idtechnicien = :idtechnicien;";
		$donnees = array (':idtechnicien' => $idtechnicien);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		$unTechnicien = $exec->fetch(); //extraire un seul client
		return $unTechnicien;
		}

		/**************** Gestion des produits ************/
	public function insertProduit($tab){
		$requete = "insert into produit values (null, :nomproduit, :prix_unit, :categorie);";
		$donnees = array(
			':nomproduit' => $tab['nomproduit'],
			':prix_unit' => $tab['prix_unit'],
			':categorie' => $tab['categorie']  
		); 
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
 

	public function selectAllProduits ($filtre){
		if($filtre == ""){
			$requete = "select * from produit ;";
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ();
		}else{
			$requete = "select * from produit where nomproduit like :filtre or prix_unit like :filtre or categorie like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%") ;
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ($donnees);
		}
		
		return $exec->fetchAll(); //extraire tous les clients
	}
	public function deleteProduit($idproduit){
		$requete = "delete from produit where idproduit = :idproduit;";
		$donnees = array (':idproduit' => $idproduit);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function updateProduit($tab){
		$requete = "update produit set nomproduit = :nomproduit, prix_unit = :prix_unit, categorie = :categorie where idproduit = :idproduit;"; 
		$donnees = array (':idproduit' => $tab['idproduit'],
						':nomproduit' => $tab['nomproduit'],
						':prix_unit' => $tab['prix_unit'],
						':categorie' => $tab['categorie']
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
		return $unProduit;
	}

	/**************** Gestion des catégories de produits ************/
	public function insertCategorie($tab){
		$requete = "insert into cat_produit values (:codecat, :nomcat);";
		$donnees = array(
			':codecat' => $tab['codecat'],
			':nomcat' => $tab['nomcat']
		); 
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	
	public function selectAllCategories($filtre = ""){
		if($filtre == ""){
			$requete = "select * from cat_produit order by nomcat;";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute();
		}else{
			$requete = "select * from cat_produit where nomcat like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%");
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($donnees);
		}
		return $exec->fetchAll();
	}
	
	public function deleteCategorie($codecat){
		$requete = "delete from cat_produit where codecat = :codecat;";
		$donnees = array(':codecat' => $codecat);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	
	public function updateCategorie($tab){
		$requete = "update cat_produit set nomcat = :nomcat where codecat = :codecat;";
		$donnees = array(
			':codecat' => $tab['codecat'],
			':nomcat' => $tab['nomcat']
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	
	public function selectWhereCategorie($codecat){
		$requete = "select * from cat_produit where codecat = :codecat;";
		$donnees = array(':codecat' => $codecat);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		return $exec->fetch();
	}
	
	/**************** Récupération des produits pour l'affichage frontend ************/
	public function selectAllProduitsFrontend(){
		$requete = "select * from produit order by nomproduit;";
		$exec = $this->unPdo->prepare($requete);
		$exec->execute();
		return $exec->fetchAll();
	}
	
	public function selectProduitsByCategorie($categorie){
		$requete = "select * from produit where categorie = :categorie order by nomproduit;";
		$donnees = array(':categorie' => $categorie);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		return $exec->fetchAll();
	}
	
	public function searchProduits($keyword){
		$requete = "select * from produit where nomproduit like :keyword or categorie like :keyword;";
		$donnees = array(':keyword' => '%'.$keyword.'%');
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		return $exec->fetchAll();
	}
	
	/**************** Récupération des catégories distinctes des produits ************/
	public function selectDistinctCategories(){
		$requete = "select distinct categorie from produit order by categorie;";
		$exec = $this->unPdo->prepare($requete);
		$exec->execute();
		return $exec->fetchAll();
	}

	/********************************Gestions des users********************************************/

	public function verifConnexion($email, $mdp){
		try {
			// Vérification dans la table technicien
			$requete = "select * from technicien where email =:email and mdp=:mdp;";
			$exec = $this->unPdo->prepare($requete);
			$donnees = array(":email"=>$email, ":mdp"=>$mdp);
			$exec->execute($donnees);
			$resultat = $exec->fetch();
			
			if($resultat) {
				return array(
					"success" => true,
					"message" => "Connexion technicien réussie !",
					"data" => $resultat,
					"role" => $resultat['role'] ? $resultat['role'] : 'technicien'
				);
			} 
			
			// Si pas de technicien trouvé, vérification dans la table client
			$requete = "select * from client where email = :email and mdp = :mdp;";
			$donnees = array(':email' => $email, ':mdp' => $mdp);
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($donnees);
			$resultat = $exec->fetch();
			
			if($resultat) {
				return array(
					"success" => true,
					"message" => "Connexion client réussie !",
					"data" => $resultat,
					"role" => $resultat['role'] ? $resultat['role'] : 'client'
				);
			} else {
				return array(
					"success" => false,
					"message" => "Email ou mot de passe incorrect"
				);
			}
		} catch(PDOException $e) {
			return array(
				"success" => false,
				"message" => "Erreur de connexion : " . $e->getMessage()
			);
		}
	}
	
	public function verifConnexionClient($email, $mdp){
		try {
			$requete = "select * from client where email = :email and mdp = :mdp;";
			$donnees = array(':email' => $email, ':mdp' => $mdp);
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($donnees);
			$resultat = $exec->fetch();
			
			if($resultat) {
				return array(
					"success" => true,
					"message" => "Connexion client réussie !",
					"data" => $resultat,
					"role" => "client"
				);
			} else {
				return array(
					"success" => false,
					"message" => "Email ou mot de passe incorrect"
				);
			}
		} catch(PDOException $e) {
			return array(
				"success" => false,
				"message" => "Erreur de connexion : " . $e->getMessage()
			);
		}
	}

	/********************************Gestions des interventions********************************************/
	public function insertIntervention($tab){
		$requete = "insert into intervention values (:idtechnicien, :codecom, :datehd, :datehf, :etat);";
		$donnees = array(
			':idtechnicien' => $tab['idtechnicien'],
			':codecom' => $tab['codecom'],
			':datehd' => $tab['datehd'],
			':datehf' => $tab['datehf'],
			':etat' => $tab['etat']
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}

	public function selectAllInterventions($filtre){
		if($filtre == ""){
			$requete = "select * from intervention ;";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute();
		}else{
			$requete = "select * from intervention where idtechnicien like :filtre or codecom like :filtre or etat like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%");
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($donnees);
		}
		return $exec->fetchAll();
	}

	public function deleteIntervention($idtechnicien, $codecom, $datehd){
		$requete = "delete from intervention where idtechnicien = :idtechnicien and codecom = :codecom and datehd = :datehd;";
		$donnees = array(
			':idtechnicien' => $idtechnicien,
			':codecom' => $codecom,
			':datehd' => $datehd
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}

	public function updateIntervention($tab){
		$requete = "update intervention set datehf = :datehf, etat = :etat where idtechnicien = :idtechnicien and codecom = :codecom and datehd = :datehd;";
		$donnees = array(
			':idtechnicien' => $tab['idtechnicien'],
			':codecom' => $tab['codecom'],
			':datehd' => $tab['datehd'],
			':datehf' => $tab['datehf'],
			':etat' => $tab['etat']
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}

	public function selectWhereIntervention($idtechnicien, $codecom, $datehd){
		$requete = "select * from intervention where idtechnicien = :idtechnicien and codecom = :codecom and datehd = :datehd;";
		$donnees = array(
			':idtechnicien' => $idtechnicien,
			':codecom' => $codecom,
			':datehd' => $datehd
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		return $exec->fetch();
	}

	/********************************Gestions des commandes********************************************/
    public function insertCommande($tab){
        $requete = "insert into commande values (null, :etatcom, :codedevis);";
        $donnees = array(
            ':etatcom' => $tab['etatcom'],
            ':codedevis' => $tab['codedevis']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectAllCommandes($filtre){
        if($filtre == ""){
            $requete = "select * from commande;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
        }else{
            $requete = "select * from commande where etatcom like :filtre or codedevis like :filtre;";
            $donnees = array(":filtre"=>"%".$filtre."%");
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        return $exec->fetchAll();
    }

    public function deleteCommande($idcommande){
        $requete = "delete from commande where idcommande = :idcommande;";
        $donnees = array(':idcommande' => $idcommande);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function updateCommande($tab){
        $requete = "update commande set etatcom = :etatcom, codedevis = :codedevis where idcommande = :idcommande;";
        $donnees = array(
            ':idcommande' => $tab['idcommande'],
            ':etatcom' => $tab['etatcom'],
            ':codedevis' => $tab['codedevis']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectWhereCommande($idcommande){
        $requete = "select * from commande where idcommande = :idcommande;";
        $donnees = array(':idcommande' => $idcommande);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
        return $exec->fetch();
    }

	public function getCommandesClient($idclient) {
		try {
			$requete = "SELECT c.idcommande, c.etatcom, c.codedevis, d.datedevis, 
						SUM(lc.quantite) as nbArticles, 
						SUM(lc.quantite * p.prix_unit) as montantTotal 
						FROM commande c 
						INNER JOIN devis d ON c.codedevis = d.iddevis 
						INNER JOIN ligne_com lc ON c.idcommande = lc.codecom 
						INNER JOIN produit p ON lc.idproduit = p.idproduit 
						WHERE d.idclient = :idclient 
						GROUP BY c.idcommande, c.etatcom, c.codedevis, d.datedevis
						ORDER BY d.datedevis DESC";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idclient' => $idclient));
			return $exec->fetchAll();
		} catch (PDOException $e) {
			echo "Erreur lors de la récupération des commandes: " . $e->getMessage();
			return array();
		}
	}

	public function getDetailsCommande($idcommande) {
		try {
			$requete = "SELECT lc.*, p.nomproduit, p.prix_unit, p.categorie, p.image, 
						(lc.quantite * p.prix_unit) as sousTotal 
						FROM ligne_com lc 
						INNER JOIN produit p ON lc.idproduit = p.idproduit 
						WHERE lc.codecom = :idcommande";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idcommande' => $idcommande));
			return $exec->fetchAll();
		} catch (PDOException $e) {
			echo "Erreur lors de la récupération des détails de commande: " . $e->getMessage();
			return array();
		}
	}

	/********************************Gestions des devis********************************************/
    public function insertDevis($tab){
        $requete = "insert into devis values (null, :datedevis, :etatdevis, :idclient);";
        $donnees = array(
            ':datedevis' => $tab['datedevis'],
            ':etatdevis' => $tab['etatdevis'],
            ':idclient' => $tab['idclient']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectAllDevis($filtre){
        if($filtre == ""){
            $requete = "select d.*, c.nom as nom_client from devis d 
                       inner join client c on d.idclient = c.idclient;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
        }else{
            $requete = "select d.*, c.nom as nom_client from devis d 
                       inner join client c on d.idclient = c.idclient 
                       where datedevis like :filtre or etatdevis like :filtre 
                       or c.nom like :filtre;";
            $donnees = array(":filtre"=>"%".$filtre."%");
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        return $exec->fetchAll();
    }

    public function deleteDevis($iddevis){
        $requete = "delete from devis where iddevis = :iddevis;";
        $donnees = array(':iddevis' => $iddevis);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function updateDevis($tab){
        $requete = "update devis set datedevis = :datedevis, etatdevis = :etatdevis, 
                    idclient = :idclient where iddevis = :iddevis;";
        $donnees = array(
            ':iddevis' => $tab['iddevis'],
            ':datedevis' => $tab['datedevis'],
            ':etatdevis' => $tab['etatdevis'],
            ':idclient' => $tab['idclient']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectWhereDevis($iddevis){
        $requete = "select d.*, c.nom as nom_client from devis d 
                   inner join client c on d.idclient = c.idclient 
                   where iddevis = :iddevis;";
        $donnees = array(':iddevis' => $iddevis);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
        return $exec->fetch();
    }

	/********************************Gestions des administrateurs********************************************/
    public function insertAdmin($tab){
        $requete = "insert into administrateur values (null, :nom, :prenom, :email, :mdp);";
        $donnees = array(
            ':nom' => $tab['nom'],
            ':prenom' => $tab['prenom'],
            ':email' => $tab['email'],
            ':mdp' => $tab['mdp'],
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectAllAdmins($filtre){
        if($filtre == ""){
            $requete = "select * from administrateur;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
        }else{
            $requete = "select * from administrateur where nom like :filtre or prenom like :filtre or email like :filtre;";
            $donnees = array(":filtre"=>"%".$filtre."%");
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        return $exec->fetchAll();
    }

    public function deleteAdmin($idadmin){
        $requete = "delete from administrateur where idadmin = :idadmin;";
        $donnees = array(':idadmin' => $idadmin);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function updateAdmin($tab){
        $requete = "update administrateur set nom = :nom, prenom = :prenom, email = :email, mdp = :mdp where idadmin = :idadmin;";
        $donnees = array(
            ':idadmin' => $tab['idadmin'],
            ':nom' => $tab['nom'],
            ':prenom' => $tab['prenom'],
            ':email' => $tab['email'],
            ':mdp' => $tab['mdp'],
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectWhereAdmin($idadmin){
        $requete = "select * from administrateur where idadmin = :idadmin;";
        $donnees = array(':idadmin' => $idadmin);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
        return $exec->fetch();
    }

    public function verifConnexionAdmin($email, $mdp) {
		try {
			$requete = "select * from administrateur where email = :email and mdp = :mdp;";
			$donnees = array(':email' => $email, ':mdp' => $mdp);
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($donnees);
			$resultat = $exec->fetch();
			return $resultat;  // Retourne false si aucun administrateur trouvé
		} catch(PDOException $e) {
			echo "Erreur de connexion admin : " . $e->getMessage();
			return false;
		}
	}

    public function deconnexion() {
        session_start();
        session_destroy();
        unset($_SESSION);
        return true;
    }

	/********************************Gestions des paniers********************************************/
	public function getPanierActif($idclient) {
		try {
			// Vérifier si le client a déjà un panier actif
			$requete = "SELECT * FROM panier WHERE idclient = :idclient AND statut = 'actif'";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idclient' => $idclient));
			$panier = $exec->fetch();
			
			// Si aucun panier actif n'existe, en créer un nouveau
			if (!$panier) {
				$requete = "INSERT INTO panier (idclient, statut) VALUES (:idclient, 'actif')";
				$exec = $this->unPdo->prepare($requete);
				$exec->execute(array(':idclient' => $idclient));
				
				// Récupérer le panier nouvellement créé
				$idpanier = $this->unPdo->lastInsertId();
				$requete = "SELECT * FROM panier WHERE idpanier = :idpanier";
				$exec = $this->unPdo->prepare($requete);
				$exec->execute(array(':idpanier' => $idpanier));
				$panier = $exec->fetch();
			}
			
			return $panier;
		} catch (PDOException $e) {
			echo "Erreur lors de la récupération du panier: " . $e->getMessage();
			return false;
		}
	}

	public function ajouterProduitPanier($idpanier, $idproduit, $quantite = 1) {
		try {
			// Récupérer le prix du produit
			$requete = "SELECT prix_unit FROM produit WHERE idproduit = :idproduit";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idproduit' => $idproduit));
			$produit = $exec->fetch();
			
			if (!$produit) {
				return array('success' => false, 'message' => 'Produit non trouvé');
			}
			
			// Vérifier si le produit est déjà dans le panier
			$requete = "SELECT * FROM panier_produit WHERE idpanier = :idpanier AND idproduit = :idproduit";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier, ':idproduit' => $idproduit));
			$produitPanier = $exec->fetch();
			
			if ($produitPanier) {
				// Mettre à jour la quantité si le produit est déjà dans le panier
				$nouvelleQuantite = $produitPanier['quantite'] + $quantite;
				$requete = "UPDATE panier_produit SET quantite = :quantite WHERE idpanier = :idpanier AND idproduit = :idproduit";
				$exec = $this->unPdo->prepare($requete);
				$exec->execute(array(
					':quantite' => $nouvelleQuantite,
					':idpanier' => $idpanier,
					':idproduit' => $idproduit
				));
			} else {
				// Ajouter le produit au panier
				$requete = "INSERT INTO panier_produit (idpanier, idproduit, quantite, prixUnitaire) 
							VALUES (:idpanier, :idproduit, :quantite, :prixUnitaire)";
				$exec = $this->unPdo->prepare($requete);
				$exec->execute(array(
					':idpanier' => $idpanier,
					':idproduit' => $idproduit,
					':quantite' => $quantite,
					':prixUnitaire' => $produit['prix_unit']
				));
			}
			
			return array('success' => true, 'message' => 'Produit ajouté au panier');
		} catch (PDOException $e) {
			return array('success' => false, 'message' => 'Erreur: ' . $e->getMessage());
		}
	}

	public function getProduitsPanier($idpanier) {
		try {
			$requete = "SELECT pp.*, p.nomproduit, p.categorie, p.image, p.description 
						FROM panier_produit pp 
						JOIN produit p ON pp.idproduit = p.idproduit 
						WHERE pp.idpanier = :idpanier";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier));
			return $exec->fetchAll();
		} catch (PDOException $e) {
			echo "Erreur lors de la récupération des produits du panier: " . $e->getMessage();
			return array();
		}
	}

	public function modifierQuantitePanier($idpanier, $idproduit, $quantite) {
		try {
			if ($quantite > 0) {
				$requete = "UPDATE panier_produit SET quantite = :quantite 
							WHERE idpanier = :idpanier AND idproduit = :idproduit";
				$exec = $this->unPdo->prepare($requete);
				$exec->execute(array(
					':quantite' => $quantite,
					':idpanier' => $idpanier,
					':idproduit' => $idproduit
				));
				return array('success' => true, 'message' => 'Quantité modifiée');
			} else {
				return $this->supprimerProduitPanier($idpanier, $idproduit);
			}
		} catch (PDOException $e) {
			return array('success' => false, 'message' => 'Erreur: ' . $e->getMessage());
		}
	}

	public function supprimerProduitPanier($idpanier, $idproduit) {
		try {
			$requete = "DELETE FROM panier_produit WHERE idpanier = :idpanier AND idproduit = :idproduit";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier, ':idproduit' => $idproduit));
			return array('success' => true, 'message' => 'Produit supprimé du panier');
		} catch (PDOException $e) {
			return array('success' => false, 'message' => 'Erreur: ' . $e->getMessage());
		}
	}

	public function viderPanier($idpanier) {
		try {
			$requete = "DELETE FROM panier_produit WHERE idpanier = :idpanier";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier));
			return array('success' => true, 'message' => 'Panier vidé avec succès');
		} catch (PDOException $e) {
			return array('success' => false, 'message' => 'Erreur: ' . $e->getMessage());
		}
	}

	public function getTotalPanier($idpanier) {
		try {
			$requete = "SELECT SUM(quantite * prixUnitaire) as total FROM panier_produit WHERE idpanier = :idpanier";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier));
			$result = $exec->fetch();
			return $result['total'] ? $result['total'] : 0;
		} catch (PDOException $e) {
			echo "Erreur lors du calcul du total: " . $e->getMessage();
			return 0;
		}
	}

	public function getNombreArticlesPanier($idpanier) {
		try {
			$requete = "SELECT SUM(quantite) as nombre FROM panier_produit WHERE idpanier = :idpanier";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier));
			$result = $exec->fetch();
			return $result['nombre'] ? $result['nombre'] : 0;
		} catch (PDOException $e) {
			echo "Erreur lors du comptage des articles: " . $e->getMessage();
			return 0;
		}
	}

	public function validerPanier($idpanier, $idclient) {
		try {
			// Démarrer une transaction
			$this->unPdo->beginTransaction();
			
			// Vérifier que le panier existe et appartient au client
			$requete = "SELECT * FROM panier WHERE idpanier = :idpanier AND idclient = :idclient AND statut = 'actif'";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier, ':idclient' => $idclient));
			$panier = $exec->fetch();
			
			if (!$panier) {
				$this->unPdo->rollBack();
				return array('success' => false, 'message' => 'Panier non trouvé ou déjà validé');
			}
			
			// Vérifier que le panier contient des produits
			$requete = "SELECT COUNT(*) as nbProduits FROM panier_produit WHERE idpanier = :idpanier";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier));
			$nbProduits = $exec->fetch()['nbProduits'];
			
			if ($nbProduits == 0) {
				$this->unPdo->rollBack();
				return array('success' => false, 'message' => 'Le panier est vide');
			}
			
			// Créer un devis
			$dateDevis = date('Y-m-d');
			$requete = "INSERT INTO devis (datedevis, etatdevis, idclient) VALUES (:datedevis, 'acceptee', :idclient)";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':datedevis' => $dateDevis, ':idclient' => $idclient));
			$iddevis = $this->unPdo->lastInsertId();
			
			// Créer une commande
			$requete = "INSERT INTO commande (etatcom, codedevis) VALUES ('en attente', :codedevis)";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':codedevis' => $iddevis));
			$idcommande = $this->unPdo->lastInsertId();
			
			// Transférer les produits du panier vers la commande
			$produits = $this->getProduitsPanier($idpanier);
			foreach ($produits as $produit) {
				$requete = "INSERT INTO ligne_com (idproduit, codecom, quantite) VALUES (:idproduit, :codecom, :quantite)";
				$exec = $this->unPdo->prepare($requete);
				$exec->execute(array(
					':idproduit' => $produit['idproduit'],
					':codecom' => $idcommande,
					':quantite' => $produit['quantite']
				));
			}
			
			// Marquer le panier comme validé
			$requete = "UPDATE panier SET statut = 'validé' WHERE idpanier = :idpanier";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute(array(':idpanier' => $idpanier));
			
			// Valider la transaction
			$this->unPdo->commit();
			
			return array(
				'success' => true, 
				'message' => 'Commande validée avec succès', 
				'iddevis' => $iddevis, 
				'idcommande' => $idcommande
			);
		} catch (PDOException $e) {
			$this->unPdo->rollBack();
			return array('success' => false, 'message' => 'Erreur lors de la validation: ' . $e->getMessage());
		}
	}
}
?>
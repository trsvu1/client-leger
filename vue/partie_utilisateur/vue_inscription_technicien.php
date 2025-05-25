<?php
require_once ("modele/modele.class.php");
    $unModele = new Modele();
    
    if(isset($_POST['Inscrire'])){
        $tab = array(
            "nom"=>$_POST['nom'],
            "prenom"=>$_POST['prenom'],
            "specialite"=>$_POST['specialite'],
            "email"=>$_POST['email'],
            "mdp"=>$_POST['mdp']
        );
        $unModele->insertTechnicien($tab);
        echo "<script>alert('Inscription réussie !'); window.location.href='index.php?page=1';</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription Technicien</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="custom-title container"> Site ALU-ME pour la gestion des projets d'équipement </h1>
    <br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-4">Inscription Technicien</h3>
                        <img src="img/Logo.png" height="100" width="100" class="mb-4">
                        
                        <form method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                            </div>
                            <div class="mb-3">
                                <select name="specialite" class="form-control" required>
                                    <option value="" disabled selected>Choisir une spécialité</option>
                                    <option value="Services">Services</option>
                                    <option value="Ateliers">Ateliers</option>
                                    <option value="Autres">Autres</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="Inscrire" class="btn btn-primary">Inscription</button>
                                <button type="reset" name="Annuler" class="btn btn-secondary">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

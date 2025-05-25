<?php

require_once ("modele/modele.class.php");
$unModele = new Modele();

if (isset($_POST['Inscription'])) {
    // Création du tableau de données
    $tab = array(
        "nom" => $_POST['nom'],
        "ville" => $_POST['ville'],
        "codepostal" => $_POST['codepostal'],
        "rue" => $_POST['rue'],
        "numrue" => $_POST['numrue'],
        "tel" => $_POST['tel'],
        "email" => $_POST['email'],
        "mdp" => $_POST['mdp'] // Mot de passe sans hashage
    );
    
    // Insertion dans la base de données
    $unModele->insertClient($tab);
    
    // Redirection après inscription
    echo "<script>alert('Inscription réussie !'); window.location.href='index.php?page=1';</script>";

}
?>

<h1 class="custom-title container">Site ALU-ME pour la gestion des projets d'équipement</h1>
<br>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="mb-4">Inscription au Site ALU-ME</h3>
                    <img src="img/Logo.png" height="100" width="100" class="mb-4">

                    <form method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="ville" placeholder="Ville" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="codepostal" placeholder="Code Postal" maxlength="5" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="rue" placeholder="Rue" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" name="numrue" placeholder="Numéro de rue" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" name="tel" placeholder="Téléphone" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        
                        <div class="mb-3">
                            <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="Inscription" class="btn btn-primary">Inscription</button>
                            <button type="reset" name="Annuler" class="btn btn-secondary">Annuler</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



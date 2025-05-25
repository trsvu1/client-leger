<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
                        <h3 class="mb-4">Inscription au Site ALUME</h3>
                        <img src="img/Logo.png" height="100" width="100" class="mb-4">
                        
                        <form method="post">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe">
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
</body>
</html>
<h1 class="custom-title container"> Administration du site ALU-ME </h1> 
<br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-4">Connexion Administrateur</h3>
                        <img src="img/Logo.png" height="100" width="100" class="mb-4">
                        
                        <?php if(isset($message)): ?>
                            <div class="alert <?= isset($success) && $success ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                                <i class="bi <?= isset($success) && $success ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?> me-2"></i>
                                <?= $message ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" action="index.php?page=gestion_admin">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" placeholder="Email administrateur" required 
                                           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="ConnexionAdmin" class="btn btn-primary">
                                    <i class="bi bi-person-badge me-2"></i>Connexion Admin
                                </button>
                                <button type="reset" name="Annuler" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Annuler
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

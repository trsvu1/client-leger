<div class="register-container py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="fade-up">
                <div class="card border-0 shadow-lg">
                    <div class="card-header text-center border-0 bg-gradient">
                        <h2 class="my-4 text-black center">
                            <i class="fas fa-user-plus me-2"></i>
                            Inscription
                        </h2>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control custom-input" id="nom" name="nom" placeholder="Votre nom" required>
                                <label for="nom"><i class="fas fa-user me-2"></i>Nom</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control custom-input" id="prenom" name="prenom" placeholder="Votre prénom" required>
                                <label for="prenom"><i class="fas fa-user me-2"></i>Prénom</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control custom-input" id="email" name="email" placeholder="Votre email" required>
                                <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control custom-input" id="password" name="password" placeholder="Votre mot de passe" required>
                                <label for="password"><i class="fas fa-lock me-2"></i>Mot de passe</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control custom-input" id="confirm_password" name="confirm_password" placeholder="Confirmez votre mot de passe" required>
                                <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirmer le mot de passe</label>
                            </div>


                            <button type="submit" class="btn btn-custom w-100 mb-4 py-3">
                                <i class="fas fa-user-plus me-2"></i>Créer mon compte
                            </button>

                            <div class="text-center">
                                Déjà membre ? 
                                <a href="index.php?page=connexion" class="text-decoration-none link-custom">
                                    Connectez-vous
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.register-container {
    background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);
    min-height: 100vh;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(to right, #1a1a1a, #363636);
}

.custom-input {
    border: 2px solid #eee;
    border-radius: 10px;
}

.custom-input:focus {
    border-color: #ffd700;
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
}

.btn-custom {
    background: linear-gradient(to right, #ffd700, #ffed4a);
    border: none;
    border-radius: 10px;
    color: #1a1a1a;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-custom:hover {
    background: linear-gradient(to right, #1a1a1a, #363636);
    color: #ffd700;
    transform: translateY(-2px);
}

.form-check-input:checked {
    background-color: #ffd700;
    border-color: #ffd700;
}

.link-custom {
    color: #ffd700;
    font-weight: 600;
}

.link-custom:hover {
    color: #ffed4a;
}

.form-floating label {
    color: #666;
}

.form-floating>.form-control:focus~label {
    color: #ffd700;
}

.card {
    animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>


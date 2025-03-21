<body>
    <!-- En-tête -->
    <header class="py-5 position-relative" style="background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="display-4 text-light">Bienvenue chez Alume</h1>
                    <p class="lead text-light mb-4">Votre partenaire de confiance pour tous vos besoins en éclairage</p>
                    <a href="#services" class="btn btn-warning btn-lg">Découvrir nos services</a>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="./src/assets/images/accueil.png" alt="Éclairage moderne" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->  
    <main class="container my-5">
        <section class="features-section py-5">
            <h2 class="text-center mb-5" data-aos="fade-up">Nos Solutions</h2>
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-box fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Nos Produits</h5>
                            <p class="card-text">Découvrez notre gamme complète de solutions d'éclairage innovantes.</p>
                            <a href="index.php?page=produits" class="btn btn-outline-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-tools fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Services</h5>
                            <p class="card-text">Installation professionnelle, maintenance experte et conseil personnalisé.</p>
                            <a href="index.php?page=services" class="btn btn-outline-success">Nos services</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-comments fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title">Contact</h5>
                            <p class="card-text">Une question ? Notre équipe d'experts est là pour vous accompagner.</p>
                            <a href="index.php?page=contact" class="btn btn-outline-warning">Contactez-nous</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .feature-icon {
        transition: transform 0.3s ease;
    }
    .hover-card:hover .feature-icon {
        transform: scale(1.1);
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

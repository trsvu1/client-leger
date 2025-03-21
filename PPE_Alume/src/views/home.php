<div class="home-container py-5">
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section text-center text-white mb-5">
            <h1 class="display-4 fw-bold">Bienvenue chez Alume</h1>
            <p class="lead">Découvrez notre collection exclusive</p>
            <a href="index.php?page=catalogue" class="btn btn-custom btn-lg">Explorer</a>
        </div>

        <!-- Featured Products -->
        <div class="row g-4 mb-5">
            <h2 class="text-white mb-4">Produits en vedette</h2>
            <!-- Product Card -->
            <div class="col-md-4">
                <div class="card product-card border-0 shadow-lg">
                    <img src="path_to_image.jpg" class="card-img-top" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Nom du produit</h5>
                        <p class="card-text">Prix: 99.99 €</p>
                        <a href="index.php?page=product&id=1" class="btn btn-custom w-100">Voir détails</a>
                    </div>
                </div>
            </div>
            <!-- Repeat for other products -->
        </div>
    </div>
</div>

<style>
/*...existing code from previous file...*/

.product-card {
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-10px);
}

.hero-section {
    padding: 100px 0;
    background: linear-gradient(rgba(26, 26, 26, 0.8), rgba(54, 54, 54, 0.8)), 
                url('path_to_hero_image.jpg') center/cover;
    border-radius: 15px;
    margin-bottom: 50px;
}
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alume - <?= ucfirst($page) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .navbar {
            background: linear-gradient(to right, #1a1a1a, #363636) !important;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ffd700 !important;
        }
        .nav-link {
            font-size: 1.1rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #ffd700 !important;
        }
        .nav-link.active {
            color: #ffd700 !important;
            font-weight: bold;
        }
        .main-menu {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .auth-buttons .btn {
            margin-left: 10px;
            border-radius: 20px;
        }
        .btn-login {
            background-color: transparent;
            border: 2px solid #ffd700;
            color: #ffd700;
        }
        .btn-login:hover {
            background-color: #ffd700;
            color: #1a1a1a;
        }
        .btn-register {
            background-color: #ffd700;
            border: 2px solid #ffd700;
            color: #1a1a1a;
        }
        .btn-register:hover {
            background-color: transparent;
            color: #ffd700;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-lightbulb me-2"></i>Alume
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav main-menu">
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=contact">Contact</a>
                    </li>
                </ul>
                <div class="auth-buttons ms-auto">
                    <a href="index.php?page=connexion" class="btn btn-login">Connexion</a>
                    <a href="index.php?page=inscription" class="btn btn-register">Inscription</a>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>

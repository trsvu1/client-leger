<?php
require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

$message = '';
$messageType = '';

// Traitement du formulaire de contact
if (isset($_POST['submit_contact'])) {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message_contenu = htmlspecialchars($_POST['message']);
    
    // Validation des données
    if (empty($nom) || empty($email) || empty($sujet) || empty($message_contenu)) {
        $message = "Veuillez remplir tous les champs du formulaire.";
        $messageType = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "L'adresse email n'est pas valide.";
        $messageType = 'danger';
    } else {
        // Ici vous pourriez ajouter le code pour enregistrer le message dans la base de données
        // ou envoyer un email
        
        // Simulation d'une réussite
        $message = "Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.";
        $messageType = 'success';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - ALUME</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 40px 0;
            background: linear-gradient(135deg, #080808, #333333);
            color: white;
            margin-bottom: 40px;
            border-bottom: 3px solid #FFFD55;
        }
        
        .header h1 {
            font-weight: 600;
            color: #FFFD55;
            margin-bottom: 10px;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 40px 0;
        }

        @media (max-width: 991px) {
            .contact-container {
                grid-template-columns: 1fr;
            }
        }

        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid #eaeaea;
        }

        .contact-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #FFFD55;
        }

        .contact-form h2 {
            color: #080808;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #FFFD55;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 253, 85, 0.25);
        }

        .submit-btn {
            background: #080808;
            color: #FFFD55;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #FFFD55;
            color: #080808;
        }

        .contact-info {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid #eaeaea;
        }

        .contact-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #FFFD55;
        }

        .contact-info h2 {
            color: #080808;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .info-item {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .info-icon {
            background: #f5f5f5;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: #080808;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .info-item:hover .info-icon {
            background: #FFFD55;
            color: #080808;
        }

        .info-content h3 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #080808;
        }

        .info-content p {
            color: #666;
            line-height: 1.6;
        }

        .social-media {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: #f5f5f5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #080808;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: #FFFD55;
            color: #080808;
            transform: translateY(-3px);
        }

        .map-container {
            margin-top: 40px;
            border-radius: 20px;
            overflow: hidden;
            height: 400px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #eaeaea;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Contactez-nous</h1>
        <p>Nous sommes à votre écoute pour toutes vos questions</p>
    </div>

    <div class="container">
        <!-- Messages de notification -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="contact-container">
            <!-- Formulaire de contact -->
            <div class="contact-form">
                <h2>Envoyez-nous un message</h2>
                <form method="post" action="index.php?page=contact">
                    <div class="form-group">
                        <label for="nom">Nom complet</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Votre email">
                    </div>
                    <div class="form-group">
                        <label for="sujet">Sujet</label>
                        <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Sujet de votre message">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message"></textarea>
                    </div>
                    <button type="submit" name="submit_contact" class="submit-btn">
                        <i class="fas fa-paper-plane me-2"></i>Envoyer
                    </button>
                </form>
            </div>

            <!-- Informations de contact -->
            <div class="contact-info">
                <h2>Nos coordonnées</h2>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Notre adresse</h3>
                        <p>123 Avenue de la Lumière<br>75000 Paris, France</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p>+33 1 23 45 67 89</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>contact@alume.com</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-content">
                        <h3>Horaires d'ouverture</h3>
                        <p>Lundi - Vendredi: 9h00 - 18h00<br>Samedi: 10h00 - 16h00</p>
                    </div>
                </div>

                <div class="social-media">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <!-- Carte Google Maps -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.76457393041!2d2.2769949150882823!3d48.85895248190256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis%2C%20France!5e0!3m2!1sfr!2sfr!4v1685467680417!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>

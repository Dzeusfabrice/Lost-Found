<?php
$pageTitle = "Bienvenue chez Lost & Found";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/frontend/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body style="overflow: hidden; height: 100vh;">

    <!-- Background with Ken Burns effect -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;">
        <img src="<?= BASE_URL ?>/frontend/public/img/welcome.png"
            style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.7) contrast(1.1); animation: zoomIn 20s infinite alternate;">
    </div>

    <!-- Glassmorphism content card -->
    <div
        style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle at center, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%);">

        <div
            style="text-align: center; color: white; padding: 4rem; max-width: 900px; animation: fadeInUp 1.2s ease-out;">

            <div
                style="display: inline-flex; align-items: center; gap: 1rem; margin-bottom: 2.5rem; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 8px 24px; border-radius: 99px; border: 1px solid rgba(255,255,255,0.2);">
                <i class="fas fa-search-location" style="color: var(--primary-light); font-size: 1.5rem;"></i>
                <span style="font-weight: 800; font-size: 1.2rem; letter-spacing: 1px; color: white;">LOST<span
                        style="color: var(--primary-light);">FOUND</span> COMMUNITY</span>
            </div>

            <h1
                style="font-size: 5rem; font-weight: 800; letter-spacing: -3px; line-height: 0.95; margin-bottom: 2rem; text-shadow: 0 10px 40px rgba(0,0,0,0.5);">
                Ne perdez plus <br> <span
                    style="background: linear-gradient(135deg, var(--primary-light), #fff); -webkit-background-clip: text; color: transparent;">jamais
                    rien.</span>
            </h1>

            <p
                style="font-size: 1.5rem; font-weight: 500; color: rgba(255,255,255,0.9); margin-bottom: 4rem; line-height: 1.6; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                La plateforme citoyenne qui connecte les cœurs et les objets égarés. Simple, moderne et solidaire, pour
                que chaque perte ait une fin heureuse.
            </p>

            <div style="display: flex; gap: 2rem; justify-content: center;">
                <a href="<?= BASE_URL ?>/index.php?action=home" class="btn btn-primary"
                    style="padding: 1.5rem 3.5rem; font-size: 1.2rem; border-radius: var(--radius-lg); background: white; color: var(--text-main); box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                    <i class="fas fa-rocket"></i> Commencer l'aventure
                </a>
                <a href="<?= BASE_URL ?>/index.php?action=ads" class="btn btn-outline"
                    style="padding: 1.5rem 3.5rem; font-size: 1.2rem; border-radius: var(--radius-lg); color: blue; border: 2px solid rgba(255,255,255,0.4); backdrop-filter: blur(10px);">
                    Découvrir les annonces
                </a>
            </div>

            <!-- Scroll down indicator -->
            <div style="margin-top: 6rem; opacity: 0.7; animation: bounce 2s infinite;">
                <i class="fas fa-chevron-down" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </div>

    <style>
        @keyframes zoomIn {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.15);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .btn-primary:hover {
            transform: translateY(-5px) scale(1.02) !important;
            background: #f1f5f9 !important;
        }
    </style>

</body>

</html>
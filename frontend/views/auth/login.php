<?php
/**
 * views/auth/login.php — Login Style Pro (Image inspired)
 */
$pageTitle = "Connexion";
// On n'utilise pas le header standard pour avoir le fond ciel complet
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | LostFound</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/frontend/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { margin: 0; padding: 0; }
        .auth-page-bg {
            background: url('https://images.unsplash.com/photo-1513002749550-c59d786b8e6c?auto=format&fit=crop&q=80&w=2000') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="auth-page-bg">

<div class="form-pro-card">
    <div class="form-icon-header">
        <i class="fas fa-sign-in-alt"></i>
    </div>

    <h1 class="form-pro-title">Connectez-vous</h1>
    <p class="form-pro-subtitle">Connectez-vous à votre compte pour gérer vos objets perdus et trouvés en toute simplicité.</p>

    <?php if ($error): ?>
        <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 1rem; border-radius: 14px; margin-bottom: 2rem; font-weight: 700; font-size: 0.9rem;">
            <?= e($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/index.php?action=login" method="POST">
        <div class="input-group-pro">
            <i class="fas fa-envelope main-icon"></i>
            <input type="email" name="email" class="form-control-pro" placeholder="Email" required autofocus>
        </div>
        
        <div class="input-group-pro">
            <i class="fas fa-lock main-icon"></i>
            <input type="password" name="password" id="password" class="form-control-pro" placeholder="Mot de passe" required>
            <i class="fas fa-eye-slash toggle-icon" onclick="togglePassword()"></i>
        </div>

        <div style="text-align: right; margin-bottom: 2rem;">
            <a href="#" style="color: #64748b; font-size: 0.85rem; text-decoration: none; font-weight: 700;">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="btn-black-pro">Se connecter</button>
    </form>

    <div class="divider-pro">
        <span>Ou continuer avec</span>
    </div>

    <div class="social-links-pro">
        <div class="social-btn-pro"><img src="https://img.icons8.com/color/48/000000/google-logo.png" style="width: 24px;"></div>
        <div class="social-btn-pro"><i class="fab fa-facebook-f" style="color: #1877f2;"></i></div>
        <div class="social-btn-pro"><i class="fab fa-apple" style="color: #000000;"></i></div>
    </div>

    <div style="margin-top: 3rem; color: #64748b; font-size: 0.95rem; font-weight: 500;">
        Pas encore de compte ? 
        <a href="<?= BASE_URL ?>/index.php?action=register" style="color: #1e293b; font-weight: 800; text-decoration: none;">S'inscrire</a>
    </div>
</div>

<script>
function togglePassword() {
    const pwd = document.getElementById('password');
    const icon = document.querySelector('.toggle-icon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        pwd.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}
</script>

</body>
</html>

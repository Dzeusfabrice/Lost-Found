<?php
/**
 * views/auth/register.php — Inscription Style Pro (Inspiré par l'image)
 */
$pageTitle = "Inscription";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire | LostFound</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/frontend/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { margin: 0; padding: 0; }
        .auth-page-bg {
            background: url('https://images.unsplash.com/photo-1533038590840-1cde6e668a91?auto=format&fit=crop&q=80&w=2000') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="auth-page-bg">

<div class="form-pro-card" style="max-width: 520px; padding: 4rem 3.5rem;">
    <div class="form-icon-header">
        <i class="fas fa-user-plus"></i>
    </div>

    <h1 class="form-pro-title">Créer un compte</h1>
    <p class="form-pro-subtitle">Rejoignez la plus grande communauté de recherche d'objets perdus et trouvés gratuitement.</p>

    <form action="<?= BASE_URL ?>/index.php?action=register" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
        
        <div class="input-group-pro">
            <i class="fas fa-user main-icon"></i>
            <input type="text" name="name" class="form-control-pro" placeholder="Nom complet" value="<?= e($old['name'] ?? '') ?>" required autofocus>
            <?php if (isset($errors['name'])): ?>
                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; display: block; margin-top: 5px; text-align: left; padding-left: 1rem;"><?= e($errors['name']) ?></span>
            <?php endif; ?>
        </div>
        
        <div class="input-group-pro">
            <i class="fas fa-envelope main-icon"></i>
            <input type="email" name="email" class="form-control-pro" placeholder="Email professionnel" value="<?= e($old['email'] ?? '') ?>" required>
            <?php if (isset($errors['email'])): ?>
                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; display: block; margin-top: 5px; text-align: left; padding-left: 1rem;"><?= e($errors['email']) ?></span>
            <?php endif; ?>
        </div>
        
        <div class="input-group-pro">
            <i class="fas fa-lock main-icon"></i>
            <input type="password" name="password" id="password" class="form-control-pro" placeholder="Mot de passe secret" required>
            <i class="fas fa-eye-slash toggle-icon" onclick="togglePassword()"></i>
            <?php if (isset($errors['password'])): ?>
                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; display: block; margin-top: 5px; text-align: left; padding-left: 1rem;"><?= e($errors['password']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-black-pro">Créer mon compte</button>
    </form>

    <div class="divider-pro">
        <span>Ou s'inscrire avec</span>
    </div>

    <div class="social-links-pro">
        <div class="social-btn-pro"><img src="https://img.icons8.com/color/48/000000/google-logo.png" style="width: 24px;"></div>
        <div class="social-btn-pro"><i class="fab fa-facebook-f" style="color: #1877f2;"></i></div>
        <div class="social-btn-pro"><i class="fab fa-apple" style="color: #000000;"></i></div>
    </div>

    <div style="margin-top: 3rem; color: #64748b; font-size: 0.95rem; font-weight: 500;">
        Déjà un compte ? 
        <a href="<?= BASE_URL ?>/index.php?action=login" style="color: #1e293b; font-weight: 800; text-decoration: none;">Accéder à mon compte</a>
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

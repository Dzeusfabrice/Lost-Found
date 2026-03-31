<?php
/**
 * footer.php — Pied de page HTML commun
 * Responsable : P3 — HILARY
 */
?>
</main> <!-- Fin du containeur principal -->

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-logo-desc">
                <a href="<?= BASE_URL ?>" class="logo">Lost<span class="text-gradient">Found</span></a>
                <p>La solution premium pour reconnecter les objets perdus à leurs propriétaires. Sécurité, rapidité et fiabilité au cœur de notre mission.</p>
            </div>
            
            <div>
                <h4 class="footer-title">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="<?= BASE_URL ?>/index.php?action=ads">Toutes les annonces</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?action=search">Recherche filtrée</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?action=ads.create">Publier une annonce</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="footer-title">Aide & Légal</h4>
                <ul class="footer-links">
                    <li><a href="#">Conditions d'utilisation</a></li>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="footer-title">Suivez-nous</h4>
                <div style="display: flex; gap: 1rem;">
                    <a href="#" class="social-btn-pro" style="width: 44px; height: 44px; border-radius: 12px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);"><i class="fab fa-facebook-f" style="color: #94a3b8;"></i></a>
                    <a href="#" class="social-btn-pro" style="width: 44px; height: 44px; border-radius: 12px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);"><i class="fab fa-twitter" style="color: #94a3b8;"></i></a>
                    <a href="#" class="social-btn-pro" style="width: 44px; height: 44px; border-radius: 12px; border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);"><i class="fab fa-instagram" style="color: #94a3b8;"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom res-flex">
            <p style="margin: 0;">&copy; <?= date('Y') ?> Lost & Found. Réalisé dans le cadre du cours de qualité logicielle.</p>
            <p style="margin: 0;">Développé avec <span style="color: #ef4444;">❤</span> par l'équipe L&F.</p>
        </div>
    </div>
</footer>

<script>
    // Confirmation avant toute action destructrice (Exigences P1-UI)
    document.querySelectorAll('.btn-confirm').forEach(button => {
        button.addEventListener('click', (e) => {
            if (!confirm('Êtes-vous sûr de vouloir effectuer cette action ?')) {
                e.preventDefault();
            }
        });
    });
</script>

</body>
</html>

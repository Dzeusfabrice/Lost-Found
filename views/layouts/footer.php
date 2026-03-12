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
                <a href="<?= BASE_URL ?>" class="logo">Lost & Found</a>
                <p>La solution simple et efficace pour retrouver vos objets égarés et rendre les objets trouvés à leurs propriétaires.</p>
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
                <div style="display: flex; gap: 15px;">
                    <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="nav-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Lost & Found. Réalisé dans le cadre du cours de qualité logicielle.</p>
            <p>Développé avec <i class="fas fa-heart" style="color: var(--danger);"></i> par l'équipe L&F.</p>
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

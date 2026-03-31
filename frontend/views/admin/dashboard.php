<?php
/**
 * views/admin/dashboard.php — Dashboard Admin Pro
 */
$pageTitle = "Administration centrale";
require VIEWS_PATH . '/layouts/header.php';
?>

<div class="admin-dashboard res-padding">
    <div class="res-flex" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem;">
        <div>
            <h1 style="font-size: 2.25rem; font-weight: 800; letter-spacing: -1px; margin-bottom: 0.5rem; color: var(--text-main);">Système de contrôle</h1>
            <p class="text-muted" style="font-size: 1.1rem;">Bienvenue dans le panneau d'administration centralisé.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline" style="border-radius: 99px; padding: 0.5rem 1.25rem; font-size: 0.85rem;"><i class="fas fa-eye"></i> Aperçu du site</a>
            <button class="btn btn-primary" style="border-radius: 99px; padding: 0.5rem 1.25rem; font-size: 0.85rem;"><i class="fas fa-file-export"></i> Exporter les données</button>
        </div>
    </div>

    <!-- KPIs Ultra-Modernes -->
    <div class="res-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; margin-bottom: 3rem;">
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <div style="width: 44px; height: 44px; background: #e0e7ff; color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;"><i class="fas fa-users"></i></div>
                <span style="font-size: 0.8rem; font-weight: 800; color: var(--success); background: #dcfce7; padding: 2px 8px; border-radius: 99px;">+12%</span>
            </div>
            <div class="stat-value"><?= e($stats['total_users'] ?? 0) ?></div>
            <div class="text-muted" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">Utilisateurs actifs</div>
        </div>

        <div class="stat-card" style="background-image: radial-gradient(at 0% 0%, rgba(239, 68, 68, 0.05) 0%, transparent 50%);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <div style="width: 44px; height: 44px; background: #fee2e2; color: #ef4444; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;"><i class="fas fa-search"></i></div>
                <span style="font-size: 0.8rem; font-weight: 800; color: #94a3b8;">En cours</span>
            </div>
            <div class="stat-value"><?= e($stats['total_lost'] ?? 0) ?></div>
            <div class="text-muted" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">Objets perdus</div>
        </div>

        <div class="stat-card" style="background-image: radial-gradient(at 0% 0%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <div style="width: 44px; height: 44px; background: #fef3c7; color: #f59e0b; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;"><i class="fas fa-hand-holding-heart"></i></div>
                <span style="font-size: 0.8rem; font-weight: 800; color: #94a3b8;">Sécurisés</span>
            </div>
            <div class="stat-value"><?= e($stats['total_found'] ?? 0) ?></div>
            <div class="text-muted" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">Objets trouvés</div>
        </div>

        <div class="stat-card" style="background-image: radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <div style="width: 44px; height: 44px; background: #dcfce7; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;"><i class="fas fa-check-double"></i></div>
                <span style="font-size: 0.8rem; font-weight: 800; color: var(--success); background: #dcfce7; padding: 2px 8px; border-radius: 99px;">Terminé</span>
            </div>
            <div class="stat-value"><?= e($stats['total_resolved'] ?? 0) ?></div>
            <div class="text-muted" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">Affaires résolues</div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="res-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">
        <div class="card" style="border: none;">
            <h3 style="margin-bottom: 2rem; font-weight: 800; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-bolt" style="color: var(--accent);"></i> Actions de gestion prioritaires
            </h3>
            <div class="res-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                <a href="<?= BASE_URL ?>/index.php?action=admin_users" class="btn btn-outline" style="justify-content: flex-start; padding: 1.5rem; text-align: left; height: auto;">
                    <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1rem;"><i class="fas fa-user-shield"></i></div>
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem; margin-bottom: 4px;">Utilisateurs</div>
                        <p class="text-muted" style="font-size: 0.8rem; font-weight: 400;">Gérer les comptes et les accès système.</p>
                    </div>
                </a>
                <a href="<?= BASE_URL ?>/index.php?action=admin_ads" class="btn btn-outline" style="justify-content: flex-start; padding: 1.5rem; text-align: left; height: auto;">
                    <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1rem;"><i class="fas fa-th-list"></i></div>
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem; margin-bottom: 4px;">Modération</div>
                        <p class="text-muted" style="font-size: 0.8rem; font-weight: 400;">Surveiller et valider les signalements.</p>
                    </div>
                </a>
                <a href="<?= BASE_URL ?>/index.php?action=messages" class="btn btn-outline" style="justify-content: flex-start; padding: 1.5rem; text-align: left; height: auto;">
                    <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1rem;"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem; margin-bottom: 4px;">Messagerie</div>
                        <p class="text-muted" style="font-size: 0.8rem; font-weight: 400;">Ma messagerie personnelle admin.</p>
                    </div>
                </a>
                <a href="#" class="btn btn-outline" style="justify-content: flex-start; padding: 1.5rem; text-align: left; height: auto;">
                    <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1rem;"><i class="fas fa-cog"></i></div>
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem; margin-bottom: 4px;">Configuration</div>
                        <p class="text-muted" style="font-size: 0.8rem; font-weight: 400;">Paramètres généraux du système.</p>
                    </div>
                </a>
            </div>
        </div>

        <div>
            <div class="card" style="border: none; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; padding: 2.5rem; margin-bottom: 2rem;">
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem; font-weight: 700;">Besoin d'aide ?</h3>
                <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.95rem; margin-bottom: 2rem; line-height: 1.6;">Consultez la documentation technique pour comprendre les métriques et les accès modérateur.</p>
                <a href="#" class="btn" style="background: white; color: var(--primary); width: 100%;">Consulter la documentation</a>
            </div>
            
            <div class="card" style="border: none; padding: 1.5rem;">
                <h4 style="font-weight: 800; margin-bottom: 1rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.1em;">Activités système</h4>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div style="font-size: 0.85rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
                         <div style="font-weight: 700; color: var(--text-main);">Backup automatique</div>
                         <div class="text-muted">Il y a 2 heures • Succès</div>
                    </div>
                    <div style="font-size: 0.85rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
                         <div style="font-weight: 700; color: var(--text-main);">Nettoyage cache</div>
                         <div class="text-muted">Hier à 23:45 • Succès</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>

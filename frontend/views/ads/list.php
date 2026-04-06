<?php
/**
 * views/ads/list.php — Galerie d'annonces Pro (Ultra-Refined)
 */
$pageTitle = "Explorer les annonces";
require VIEWS_PATH . '/layouts/header.php';
?>

<!-- Carousel Header Pro -->
<div class="carousel-pro">
    <div class="carousel-inner" id="carousel">
        <div class="carousel-item active">
            <img src="<?= BASE_URL ?>/frontend/public/img/carousel/slide1.png" class="carousel-img" alt="Slide 1">
            <div class="carousel-content">
                <div class="glass" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 99px; margin-bottom: 2rem; color: white;">
                    <span style="width: 8px; height: 8px; background: var(--success); border-radius: 50%; display: inline-block; box-shadow: 0 0 10px var(--success);"></span>
                    <span style="font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Live Activity</span>
                </div>
                <h2>Reconnectez les <br><span class="text-gradient" style="background: linear-gradient(135deg, #fff, var(--primary-light)); -webkit-background-clip: text; color: transparent;">objets égarés.</span></h2>
                <p>La technologie au service de l'honnêteté. Rejoignez des milliers de citoyens qui s'entraident chaque jour.</p>
                <div style="display: flex; gap: 1.5rem;">
                    <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary" style="padding: 1.25rem 2.5rem; border-radius: 20px;">
                        <i class="fas fa-plus-circle"></i> Signaler une perte
                    </a>
                    <a href="#gallery" class="btn glass" style="padding: 1.25rem 2.5rem; border-radius: 20px; color: white; border-color: rgba(255,255,255,0.2);">
                        <i class="fas fa-eye"></i> Parcourir la galerie
                    </a>
                </div>
            </div>
        </div>
        <!-- Other slides would follow the same pattern if they existed -->
    </div>

    <!-- Pagination dots -->
    <div class="carousel-dots" id="dots" style="bottom: 40px; position: absolute; left: 50%; transform: translateX(-50%); z-index: 30; display: flex; gap: 1rem;">
        <div class="carousel-dot active" style="width: 12px; height: 12px; background: white; border-radius: 50%; cursor: pointer; opacity: 0.5; transition: 0.3s;" onclick="setSlide(0)"></div>
        <div class="carousel-dot" style="width: 12px; height: 12px; background: white; border-radius: 50%; cursor: pointer; opacity: 0.5; transition: 0.3s;" onclick="setSlide(1)"></div>
        <div class="carousel-dot" style="width: 12px; height: 12px; background: white; border-radius: 50%; cursor: pointer; opacity: 0.5; transition: 0.3s;" onclick="setSlide(2)"></div>
    </div>
</div>

<!-- Professional Filter & Search Bar -->
<div id="gallery" style="margin-top: -3rem; position: relative; z-index: 50; margin-bottom: 6rem;">
    <div class="card glass" style="max-width: 1200px; margin: 0 auto; border-radius: 30px; box-shadow: 0 40px 80px -20px rgba(0,0,0,0.15); padding: 1.5rem 2.5rem;">
        <form action="<?= BASE_URL ?>/index.php" method="GET" style="display: flex; gap: 2rem; align-items: center;">
            <input type="hidden" name="action" value="search">
            
            <div style="flex: 2; position: relative;">
                <i class="fas fa-search" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--text-soft);"></i>
                <input type="text" name="q" placeholder="Quel objet cherchez-vous ?" 
                       style="width: 100%; border: none; background: #f8fafc; padding: 1.25rem 1.25rem 1.25rem 3.5rem; border-radius: 18px; font-weight: 600; font-family: inherit; font-size: 1rem; color: var(--text-main); outline: none; border: 2px solid transparent; transition: 0.3s;"
                       onfocus="this.style.borderColor='var(--primary-light)'; this.style.background='white';">
            </div>

            <div style="flex: 1;">
                <select name="category" style="width: 100%; border: none; background: #f8fafc; padding: 1.25rem; border-radius: 18px; font-weight: 700; font-family: inherit; color: var(--text-muted); cursor: pointer; outline: none; appearance: none;">
                    <option value="">Toutes catégories</option>
                    <option value="electronics">Électronique</option>
                    <option value="pets">Animaux</option>
                    <option value="documents">Documents</option>
                    <option value="keys">Clés</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 1.25rem 2.5rem; border-radius: 18px; width: auto;">
                <i class="fas fa-filter"></i> Filtrer
            </button>
        </form>
    </div>
</div>

<!-- Ads Marquee Ribbon (Live Feed Look) -->
<?php if (!empty($ads)): ?>
<div style="margin-bottom: 8rem;">
    <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
        <div style="padding: 4px 12px; background: #fee2e2; color: #ef4444; border-radius: 6px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase;">Direct</div>
        <h3 style="font-weight: 800; color: var(--text-muted);">Dernières activités dans la communauté</h3>
    </div>
    <div class="ads-marquee-container" style="background: white; border-radius: 20px; padding: 2rem 0; box-shadow: inset 0 0 40px rgba(0,0,0,0.02);">
        <div class="ads-marquee-inner">
            <?php 
            $marqueeAds = array_merge($ads, $ads);
            foreach ($marqueeAds as $ad): 
            ?>
                <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="marquee-item" style="background: white; border: 1px solid #f1f5f9; padding: 1rem; border-radius: 16px; min-width: 280px; display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 60px; height: 60px; border-radius: 12px; overflow: hidden; background: #f8fafc;">
                        <?php if ($ad['photo_path']): ?>
                            <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <i class="fas fa-camera" style="margin: 20px; color: #cbd5e1;"></i>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 800; color: var(--<?= $ad['type'] === 'lost' ? 'danger' : 'success' ?>); text-transform: uppercase;"><?= $ad['type'] === 'lost' ? 'Perdu' : 'Trouvé' ?></div>
                        <div style="font-weight: 700; font-size: 0.95rem; color: var(--text-main); white-space: nowrap;"><?= e($ad['title']) ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div style="margin-bottom: 6rem;">
    <!-- Gallery Grid -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem;">
        <div>
            <div style="color: var(--primary); font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem;">Catalogue Officiel</div>
            <h2 style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; line-height: 1.1;">Tous les <span class="text-gradient">signalements.</span></h2>
        </div>
        <div class="text-muted" style="font-weight: 600; font-size: 1.1rem;"><?= count($ads) ?> objets listés actuellement</div>
    </div>

    <?php if (empty($ads)): ?>
        <div class="card" style="text-align: center; padding: 8rem; border: none; border-radius: 40px; background: rgba(255,255,255,0.5); backdrop-filter: blur(20px);">
            <div style="width: 120px; height: 120px; background: white; border-radius: 40px; display: flex; align-items: center; justify-content: center; margin: 0 auto 3rem; font-size: 4rem; color: #cbd5e1; box-shadow: var(--shadow-md);">
                <i class="fas fa-box-open"></i>
            </div>
            <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem; letter-spacing: -1px;">Aucun signalement</h2>
            <p class="text-muted" style="max-width: 500px; margin: 0 auto 3.5rem; font-size: 1.25rem;">La base de données est actuellement vide. Repassez plus tard ou facilitez une rencontre en publiant une annonce.</p>
            <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary" style="padding: 1.25rem 3rem; border-radius: 20px;">Lancer le premier signalement</a>
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 3.5rem;">
            <?php foreach ($ads as $ad): ?>
                <div class="card" style="padding: 0; border: none; background: white; transition: 0.5s cubic-bezier(0.23, 1, 0.32, 1);">
                    <!-- Photo Header -->
                    <div style="width: 100%; height: 320px; position: relative; overflow: hidden; border-radius: 2.5rem;">
                        <?php if ($ad['photo_path']): ?>
                            <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: 0.8s transform cubic-bezier(0.23, 1, 0.32, 1);">
                        <?php else: ?>
                            <div style="width: 100%; height: 100%; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 4rem;">
                                <i class="fas fa-camera"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Floating Badge Status -->
                        <div style="position: absolute; top: 30px; left: 30px; z-index: 10;">
                            <span class="badge-status" style="background: <?= $ad['type'] === 'lost' ? 'var(--danger)' : 'var(--success)' ?>; color: white; padding: 10px 24px; border-radius: 99px; font-weight: 800; font-size: 0.8rem; box-shadow: 0 10px 20px rgba(0,0,0,0.2); border: 2px solid rgba(255,255,255,0.3); backdrop-filter: blur(10px);">
                                <i class="<?= $ad['type'] === 'lost' ? 'fas fa-exclamation-triangle' : 'fas fa-check-circle' ?>" style="margin-right: 8px;"></i>
                                OBJET <?= strtoupper($ad['type'] === 'lost' ? 'PERDU' : 'TROUVÉ') ?>
                            </span>
                        </div>

                        <!-- Location Overlay -->
                        <div class="glass" style="position: absolute; bottom: 20px; left: 20px; padding: 10px 20px; border-radius: 16px; color: var(--text-main); font-weight: 800; font-size: 0.9rem; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-location-dot" style="color: var(--primary);"></i>
                            <?= e($ad['city']) ?>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div style="padding: 2.5rem;">
                        <h3 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 1rem; letter-spacing: -1px;"><?= e($ad['title']) ?></h3>
                        <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.6; margin-bottom: 2.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= e($ad['description'] ?? 'Aucune description disponible pour cet objet.') ?>
                        </p>

                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 2rem; border-top: 1px solid #f1f5f9;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 44px; height: 44px; border-radius: 12px; background: #e0e7ff; color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.9rem;">
                                    <?= strtoupper(substr($ad['category'] ?? 'O', 0, 1)) ?>
                                </div>
                                <div style="display: flex; flex-direction: column;">
                                    <span style="font-size: 0.75rem; color: var(--text-soft); font-weight: 800; text-transform: uppercase;">Publié par</span>
                                    <span style="font-size: 1rem; font-weight: 700; color: var(--text-main);"><?= e($ad['user_name'] ?? 'Utilisateur') ?></span>
                                </div>
                            </div>
                            <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-primary" style="padding: 1rem 2rem; border-radius: 16px; font-weight: 800;">
                                Détails <i class="fas fa-chevron-right" style="margin-left: 8px; font-size: 0.8rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination Pro -->
        <?php if ($pagination['pages'] > 1): ?>
            <div style="display: flex; justify-content: center; gap: 15px; margin-top: 8rem; align-items: center;">
                <a href="<?= $pagination['page'] > 1 ? BASE_URL . '/index.php?action=ads&page=' . ($pagination['page'] - 1) : '#' ?>" 
                   class="btn glass" style="width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; <?= $pagination['page'] <= 1 ? 'opacity: 0.3; pointer-events: none;' : '' ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>
                
                <?php for($i = 1; $i <= $pagination['pages']; $i++): ?>
                    <a href="<?= BASE_URL ?>/index.php?action=ads&page=<?= $i ?>" 
                       class="btn <?= $i == $pagination['page'] ? 'btn-primary' : 'glass' ?>" 
                       style="width: 60px; height: 60px; border-radius: 20px; font-weight: 800; font-size: 1.1rem; box-shadow: <?= $i == $pagination['page'] ? '0 15px 30px rgba(79, 70, 229, 0.3)' : 'none' ?>;">
                       <?= $i ?>
                    </a>
                <?php endfor; ?>

                <a href="<?= $pagination['page'] < $pagination['pages'] ? BASE_URL . '/index.php?action=ads&page=' . ($pagination['page'] + 1) : '#' ?>" 
                   class="btn glass" style="width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; <?= $pagination['page'] >= $pagination['pages'] ? 'opacity: 0.3; pointer-events: none;' : '' ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        <?php endif; ?>

        <!-- Premium Social Proof -->
        <section style="margin-top: 12rem; margin-bottom: 4rem;">
            <div class="card glass" style="padding: 6rem; border-radius: 50px; text-align: center; border: 1px solid rgba(255,255,255,0.4);">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: #d1fae5; color: #10b981; padding: 8px 16px; border-radius: 99px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; margin-bottom: 2rem;">Communauté de Confiance</div>
                <h2 style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 1.5rem; line-height: 1.1;">Rejoignez la révolution <br> de la <span class="text-gradient">solidarité locale.</span></h2>
                <p class="text-muted" style="font-size: 1.25rem; max-width: 700px; margin: 0 auto 4rem;">Plus de 10 000 objets ont déjà retrouvé le chemin de la maison. Votre honnêteté est notre plus grande valeur.</p>
                
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; max-width: 900px; margin: 0 auto;">
                    <div>
                        <div style="font-size: 3rem; font-weight: 800; color: var(--text-main);">98%</div>
                        <div style="font-weight: 700; color: var(--text-soft); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">Taux de satisfaction</div>
                    </div>
                    <div>
                        <div style="font-size: 3rem; font-weight: 800; color: var(--text-main);">12k</div>
                        <div style="font-weight: 700; color: var(--text-soft); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">Membres actifs</div>
                    </div>
                    <div>
                        <div style="font-size: 3rem; font-weight: 800; color: var(--text-main);">45min</div>
                        <div style="font-weight: 700; color: var(--text-soft); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">Délai moyen de contact</div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>

<style>
    .card { cursor: default; }
    .card:hover h3 { color: var(--primary); }
    .card:hover img { transform: scale(1.05); }
    
    .carousel-dot:hover { opacity: 1 !important; transform: scale(1.2); }
    .carousel-dot.active { opacity: 1 !important; width: 40px !important; border-radius: 10px !important; }
    
    .marquee-item:hover { border-color: var(--primary-light) !important; box-shadow: var(--shadow-md); transform: translateY(-3px); }
</style>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>

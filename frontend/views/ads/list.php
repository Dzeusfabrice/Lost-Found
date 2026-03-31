<?php
/**
 * views/ads/list.php — Galerie d'annonces Pro
 */
$pageTitle = "Catalogue d'objets";
require VIEWS_PATH . '/layouts/header.php';
?>

<!-- Carousel Header Pro -->
<div class="carousel-pro">
    <div class="carousel-inner" id="carousel">
        <div class="carousel-item active">
            <img src="<?= BASE_URL ?>/frontend/public/img/carousel/slide1.png" class="carousel-img" alt="Slide 1">
            <div class="carousel-content">
                <h2>Explorer les <br><span class="text-gradient" style="background: linear-gradient(135deg, #fff, #cbd5e1); -webkit-background-clip: text; color: transparent;">annonces.</span></h2>
                <p>Découvrez les objets signalés dans votre communauté aujourd'hui. Chaque annonce est une chance de plus de réunir un objet et son propriétaire.</p>
                <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary" style="padding: 1.25rem 2.5rem; border-radius: 99px;">
                    <i class="fas fa-plus-circle"></i> Publier un signalement
                </a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>/frontend/public/img/carousel/slide2.png" class="carousel-img" alt="Slide 2">
            <div class="carousel-content">
                <h2>Rendre <br><span class="text-gradient" style="background: linear-gradient(135deg, #fff, #fef3c7); -webkit-background-clip: text; color: transparent;">service.</span></h2>
                <p>Vous avez trouvé un objet ? Votre geste solidaire peut soulager quelqu'un d'autre. Signalez-le en quelques secondes.</p>
                <a href="<?= BASE_URL ?>/index.php?action=ads.create" class="btn btn-primary" style="padding: 1.25rem 2.5rem; border-radius: 99px;">
                    <i class="fas fa-hand-holding-heart"></i> J'ai trouvé un objet
                </a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>/frontend/public/img/carousel/slide3.png" class="carousel-img" alt="Slide 3">
            <div class="carousel-content">
                <h2>Solidarité <br><span class="text-gradient" style="background: linear-gradient(135deg, #fff, #e0e7ff); -webkit-background-clip: text; color: transparent;">locale.</span></h2>
                <p>Une plateforme moderne et sécurisée pour connecter les citoyens. Plus de 500 objets restitués ce mois-ci.</p>
                <a href="<?= BASE_URL ?>/index.php?action=register" class="btn btn-primary" style="padding: 1.25rem 2.5rem; border-radius: 99px;">
                    <i class="fas fa-user-plus"></i> Rejoindre la communauté
                </a>
            </div>
        </div>
    </div>

    <!-- Pagination dots -->
    <div class="carousel-dots" id="dots">
        <div class="carousel-dot active" onclick="setSlide(0)"></div>
        <div class="carousel-dot" onclick="setSlide(1)"></div>
        <div class="carousel-dot" onclick="setSlide(2)"></div>
    </div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const dots = document.querySelectorAll('.carousel-dot');
    let slideInterval = setInterval(nextSlide, 6000);

    function nextSlide() {
        setSlide((currentSlide + 1) % slides.length);
    }

    function setSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        currentSlide = index;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
        
        // Reset timer
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 6000);
    }
<!-- Ads Marquee Ribbon -->
<?php if (!empty($ads)): ?>
<div class="ads-marquee-container">
    <div class="ads-marquee-inner">
        <?php 
        // We duplicate the ads array a few times to ensure a smooth infinite scroll feel
        $marqueeAds = array_merge($ads, $ads, $ads);
        foreach ($marqueeAds as $ad): 
        ?>
            <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="marquee-item">
                <?php if ($ad['photo_path']): ?>
                    <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" class="marquee-img" alt="<?= e($ad['title']) ?>">
                <?php else: ?>
                    <div style="width: 100%; height: 100%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #cbd5e1;"><i class="fas fa-camera"></i></div>
                <?php endif; ?>
                <div class="marquee-overlay">
                    <span class="m-city"><?= e($ad['city']) ?></span>
                    <span class="m-title"><?= e($ad['title']) ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div style="margin-top: 6rem; margin-bottom: 4rem;">
    <!-- Gallery Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem; padding-left: 1rem; border-left: 6px solid var(--primary);">
        <div>
            <h2 style="font-size: 2.5rem; font-weight: 800; letter-spacing: -1px; margin-bottom: 0.5rem;">Tous les <span class="text-gradient">signalements.</span></h2>
            <p class="text-muted" style="font-size: 1.1rem;">Explorez la base de données complète des objets perdus et trouvés.</p>
        </div>
        <div style="display: flex; gap: 1rem;">
             <a href="<?= BASE_URL ?>/index.php?action=search" class="btn btn-outline" style="border-radius: 99px;"><i class="fas fa-filter"></i> Filtrer</a>
        </div>
    </div>
    <?php if (empty($ads)): ?>
        <div class="card" style="text-align: center; padding: 6rem; border: none; border-radius: 3rem; box-shadow: var(--shadow-lg);">
            <div style="width: 100px; height: 100px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 3rem; color: #cbd5e1;">
                <i class="fas fa-box-open"></i>
            </div>
            <h2 style="font-weight: 800; margin-bottom: 1rem;">Aucun signalement actuel</h2>
            <p class="text-muted" style="max-width: 450px; margin: 0 auto 2.5rem; font-size: 1.1rem;">La plateforme est toute calme. Profitez-en pour parcourir les autres sections.</p>
            <a href="<?= BASE_URL ?>/index.php?action=search" class="btn btn-outline" style="padding: 1rem 2.5rem; border-radius: 99px;">Lancer une recherche précise</a>
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 3rem;">
            <?php foreach ($ads as $ad): ?>
                <div class="card" style="padding: 0; background: white; border-radius: 2.5rem; border: none; box-shadow: var(--shadow-lg); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); overflow: hidden; position: relative;">
                    <!-- Floating Type Badge Pro -->
                    <div style="position: absolute; top: 25px; left: 25px; z-index: 10; display: flex; flex-direction: column; gap: 8px;">
                        <span class="badge-status badge-<?= strtolower(e($ad['type'])) ?>" style="font-size: 0.75rem; font-weight: 800; padding: 10px 20px; border-radius: 99px; box-shadow: 0 10px 15px rgba(0,0,0,0.1); border: 2px solid white;">
                            <i class="<?= $ad['type'] === 'lost' ? 'fas fa-search' : 'fas fa-check-circle' ?>" style="margin-right: 5px;"></i>
                            OBJET <?= strtoupper($ad['type'] === 'lost' ? 'PERDU' : 'TROUVÉ') ?>
                        </span>
                    </div>
                    
                    <!-- Preview Image -->
                    <div style="width: 100%; height: 260px; overflow: hidden; position: relative;">
                        <?php if ($ad['photo_path']): ?>
                            <img src="<?= UPLOADS_URL ?>/<?= e($ad['photo_path']) ?>" alt="<?= e($ad['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: var(--transition);">
                        <?php else: ?>
                            <div style="width: 100%; height: 100%; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 3rem;">
                                <i class="fas fa-camera"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Info Area -->
                    <div style="padding: 2rem;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary); font-size: 0.8rem;"></i>
                            <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;"><?= e($ad['city']) ?></span>
                        </div>
                        
                        <h3 style="font-size: 1.4rem; font-weight: 800; margin-bottom: 0.75rem; letter-spacing: -0.5px; line-height: 1.2; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><?= e($ad['title']) ?></h3>
                        
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 2rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; position: relative; line-height: 1.5;">
                             <?= e($ad['description'] ?? '') ?>
                        </p>

                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #f1f5f9;">
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-size: 0.7rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Signalé le</span>
                                <span style="font-size: 0.9rem; font-weight: 800; color: var(--text-main);"><?= date('d.m.Y', strtotime($ad['event_date'])) ?></span>
                            </div>
                            <a href="<?= BASE_URL ?>/index.php?action=ads.view&id=<?= $ad['id'] ?>" class="btn btn-primary" style="width: 48px; height: 48px; padding: 0; border-radius: 16px; box-shadow: none;">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination Pro -->
        <?php if ($pagination['pages'] > 1): ?>
            <div style="display: flex; justify-content: center; gap: 12px; margin-top: 5rem; align-items: center;">
                <span class="text-muted" style="font-size: 0.9rem; font-weight: 600; margin-right: 1.5rem;">Page <?= $pagination['page'] ?> sur <?= $pagination['pages'] ?></span>
                <?php for($i = 1; $i <= $pagination['pages']; $i++): ?>
                    <a href="<?= BASE_URL ?>/index.php?action=ads&page=<?= $i ?>" 
                       class="btn <?= $i == $pagination['page'] ? 'btn-primary' : 'btn-outline' ?>" 
                       style="width: 44px; height: 44px; padding: 0; border-radius: 14px; box-shadow: <?= $i == $pagination['page'] ? 'var(--shadow-md)' : 'none' ?>;">
                       <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <!-- Testimonials Section Pro -->
        <section class="testimonials-section">
            <div style="text-align: center; margin-bottom: 6rem;">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: var(--success); color: white; padding: 6px 16px; border-radius: 99px; font-size: 0.7rem; font-weight: 800; margin-bottom: 1.5rem; text-transform: uppercase;">Retours d'expérience</div>
                <h2 style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 1.5rem; display: block;">Ils ont retrouvé <span class="text-gradient">le sourire.</span></h2>
                <p class="text-muted" style="font-size: 1.25rem; max-width: 600px; margin: 0 auto;">Chaque jour, notre communauté prouve que la solidarité peut faire des miracles.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem;">
                <div class="testimonial-card">
                    <p class="testimonial-text">"J'avais perdu mon alliance à la plage. Je n'y croyais plus, mais grâce au signalement de Marc sur cette appli, j'ai pu la récupérer le lendemain. Un service incroyable !"</p>
                    <div class="testimonial-author">
                        <div class="t-avatar" style="background: #fee2e2; color: #ef4444;">S</div>
                        <div class="t-info">
                            <h4>Sophie L.</h4>
                            <span>Alliance retrouvée</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"Retrouver mon chat après 3 jours d'angoisse a été le plus beau jour de ma vie. Merci à tous ceux qui gardent l'œil ouvert sur LostFound. Une vraie famille."</p>
                    <div class="testimonial-author">
                        <div class="t-avatar" style="background: #e0e7ff; color: var(--primary);">J</div>
                        <div class="t-info">
                            <h4>Jean-Pierre M.</h4>
                            <span>Siamois retrouvé</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"Une interface simple, propre et efficace. J'ai trouvé un portefeuille et en 10 minutes, le propriétaire m'a contacté. C'est l'outil qui nous manquait en ville."</p>
                    <div class="testimonial-author">
                        <div class="t-avatar" style="background: #dcfce7; color: #10b981;">A</div>
                        <div class="t-info">
                            <h4>Amandine T.</h4>
                            <span>Actrice solidaire</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>
</div>

<style>
    .card:hover {
        transform: translateY(-8px);
    }
    .card:hover img {
        transform: scale(1.05);
    }
</style>

<?php require VIEWS_PATH . '/layouts/footer.php'; ?>

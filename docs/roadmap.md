# 🗺️ Lost & Found — Feuille de Route d'Implémentation

Ce document définit précisément les modules, les fichiers et les responsabilités de chacun.

## 👥 Répartition des Pôles

| Pôle | Équipier | Domaine de responsabilité |
| :--- | :--- | :--- |
| **UI (Interfaces)** | **P1 (Tatou)** | Messagerie + Administration |
| | **P2 (Pink baby)** | Annonces + Recherche |
| | **P3 (Hilary)** | Authentification + Profil + Layouts |
| **Logique (Backend)** | **P4 (Noumi)** | Sécurité + Authentification + Sessions |
| | **P5 (Etaba)** | Annonces + Recherche + Upload |
| | **P6 (Noumi)** | Messagerie + Admin + Infrastructure BDD |

---

## 🛠️ Missions Détaillées & Fichiers

### 🔵 Pôle UI (Vues & Design)
*Règle d'or : Utiliser `e($var)` pour tout affichage et ne JAMAIS faire de SQL dans la vue.*

#### **P1 (Tatou) — Messagerie & Admin**
- `views/messages/list.php`
- `views/messages/view.php`
- `views/admin/dashboard.php`
- `views/admin/users.php`
- `views/admin/ads.php`
- `views/errors/404.php` & `403.php`

#### **P2 (Pink baby) — Annonces & Recherche**
- `views/ads/list.php`
- `views/ads/view.php`
- `views/ads/create.php`
- `views/ads/edit.php`
- `views/search/results.php`

#### **P3 (Hilary) — Auth & Profil**
- `views/layouts/header.php` & `footer.php`
- `views/auth/login.php`
- `views/auth/register.php`
- `views/profile/index.php`
- `views/profile/edit.php`

---

### 🟢 Pôle Logique (Modèles & Contrôleurs)
*Règle d'or : Respecter les seuils de Complexité Cyclomatique (CC <= 10).*

#### **P4 (Noumi) — Sécurité & Auth**
- `controllers/AuthController.php`
- `models/UserModel.php`
- `includes/auth.php`
- `includes/csrf.php`

#### **P5 (Etaba) — Annonces & Recherche**
- `controllers/AdController.php`
- `controllers/SearchController.php`
- `models/AdModel.php`
- `services/UploadService.php`

#### **P6 (Noumi) — Messagerie & BDD**
- `controllers/MessageController.php`
- `models/ConversationModel.php`
- `models/MessageModel.php`
- `controllers/AdminController.php`
- `config/bootstrap.php`
- `core/Database.php`

---

## 📈 Critères de Qualité (Seuils de réussite)
- CC <= 10 (Complexité)
- MI >= 65 (Maintenabilité)
- Couverture Tests >= 80%
- MVC Strict : Pas de SQL dans les Vues, pas de HTML dans les Modèles.

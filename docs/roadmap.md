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
- `frontend/views/messages/list.php`
- `frontend/views/messages/view.php`
- `frontend/views/admin/dashboard.php`
- `frontend/views/admin/users.php`
- `frontend/views/admin/ads.php`
- `frontend/views/errors/404.php` & `403.php`

#### **P2 (Pink baby) — Annonces & Recherche**
- `frontend/views/ads/list.php`
- `frontend/views/ads/view.php`
- `frontend/views/ads/create.php`
- `frontend/views/ads/edit.php`
- `frontend/views/search/results.php`

#### **P3 (Hilary) — Auth & Profil**
- `frontend/views/layouts/header.php` & `footer.php`
- `frontend/views/auth/login.php`
- `frontend/views/auth/register.php`
- `frontend/views/profile/index.php`
- `frontend/views/profile/edit.php`

---

### 🟢 Pôle Logique (Modèles & Contrôleurs)
*Règle d'or : Respecter les seuils de Complexité Cyclomatique (CC <= 10).*

#### **P4 (Noumi) — Sécurité & Auth**
- `backend/controllers/AuthController.php`
- `backend/models/UserModel.php`
- `backend/includes/auth.php`
- `backend/includes/csrf.php`

#### **P5 (Etaba) — Annonces & Recherche**
- `backend/controllers/AdController.php`
- `backend/controllers/SearchController.php`
- `backend/models/AdModel.php`
- `backend/services/UploadService.php`

#### **P6 (Noumi) — Messagerie & BDD**
- `backend/controllers/MessageController.php`
- `backend/models/ConversationModel.php`
- `backend/models/MessageModel.php`
- `backend/controllers/AdminController.php`
- `backend/config/bootstrap.php`
- `backend/core/Database.php`

---

## 📈 Critères de Qualité (Seuils de réussite)
- CC <= 10 (Complexité)
- MI >= 65 (Maintenabilité)
- Couverture Tests >= 80%
- MVC Strict : Pas de SQL dans les Vues, pas de HTML dans les Modèles.

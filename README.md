# Livre d'Or - Architecture MVC Procédurale

Un livre d'or développé en PHP avec une architecture **MVC procédurale** bien organisée.

## 🏗️ Architecture MVC Procédurale

Cette application suit le pattern MVC (Model-View-Controller) de manière procédurale :

### **📁 Structure des dossiers**

```
├── index.php              # Page d'accueil (point d'entrée)
├── inscription.php        # Page d'inscription
├── connexion.php          # Page de connexion
├── livre-or.php           # Page livre d'or
├── commentaire.php        # Page ajout commentaire
├── profil.php            # Page profil utilisateur
├── config.php            # Configuration de l'application
│
├── models/               # MODELS - Logique métier
│   ├── UserModel.php     # Gestion des utilisateurs
│   └── CommentModel.php  # Gestion des commentaires
│
├── views/                # VIEWS - Interface utilisateur
│   ├── layouts/
│   │   └── main.php      # Layout principal
│   ├── home.php          # Vue page d'accueil
│   ├── register.php      # Vue inscription
│   ├── login.php         # Vue connexion
│   ├── livre-or.php      # Vue livre d'or
│   ├── add-comment.php   # Vue ajout commentaire
│   └── profile.php       # Vue profil
│
├── controllers/          # CONTROLLERS - Logique applicative
│   ├── HomeController.php     # Contrôleur accueil
│   ├── AuthController.php     # Contrôleur authentification
│   ├── BookController.php     # Contrôleur livre d'or
│   └── ProfileController.php  # Contrôleur profil
│
├── includes/
│   └── functions.php     # Fonctions communes et utilitaires
│
├── public/css/          # Assets CSS
└── storage/            # Base de données SQL
```

## 🚀 Fonctionnalités

- **Page d'accueil** : Présentation du site avec navigation
- **Inscription** : Création de compte utilisateur avec validation
- **Connexion** : Authentification des utilisateurs
- **Livre d'or** : Affichage des commentaires (du plus récent au plus ancien)
- **Ajout de commentaire** : Interface pour poster un nouveau commentaire (connectés uniquement)
- **Profil utilisateur** : Modification du login et mot de passe

## 📋 Structure de la base de données

### Table `utilisateurs`

```sql
- id (int, clé primaire, auto-increment)
- login (varchar 255)
- password (varchar 255)
```

### Table `commentaires`

```sql
- id (int, clé primaire, auto-increment)
- commentaire (text)
- id_utilisateur (int, clé étrangère)
- date (datetime)
```

## 🔧 Architecture MVC Détaillée

### **MODELS (models/)**

Contiennent la logique métier et l'accès aux données :

- `UserModel.php` : Fonctions pour créer, authentifier, modifier les utilisateurs
- `CommentModel.php` : Fonctions pour gérer les commentaires

### **VIEWS (views/)**

Contiennent uniquement l'affichage HTML :

- Templates PHP purs sans logique métier
- Layout principal réutilisable
- Séparation claire présentation/logique

### **CONTROLLERS (controllers/)**

Contiennent la logique applicative :

- Traitent les requêtes HTTP
- Appellent les models appropriés
- Chargent les vues avec les données

### **Point d'entrée unique**

Chaque page PHP principale :

- Démarre la session
- Charge les fonctions communes
- Inclut les models nécessaires
- Appelle le contrôleur approprié

## 🛠️ Installation

1. **Base de données** :

   - Créer une base de données nommée `livreor`
   - Importer le fichier `storage/livreor.sql`

2. **Configuration** :

   - Les paramètres de connexion sont dans `config.php`
   - Ajuster si nécessaire (host, utilisateur, mot de passe)

3. **Serveur web** :
   - Placer le projet dans le dossier web de votre serveur (htdocs, www, etc.)
   - Accéder via `http://localhost/livre-or-mvc/`

## 🎨 Fonctionnalités techniques

- **MVC Procédural** : Architecture bien organisée sans POO
- **Sécurité** : Hash des mots de passe, requêtes préparées, échappement HTML
- **Validation** : Vérification des données côté serveur
- **Sessions** : Gestion de l'authentification utilisateur
- **Responsive** : Design adaptatif mobile/desktop
- **Code réutilisable** : Fonctions communes, layout partagé

## 🔐 Sécurité

- Mots de passe hachés avec `PASSWORD_DEFAULT`
- Échappement des données avec `htmlspecialchars()`
- Requêtes préparées pour éviter les injections SQL
- Validation stricte des données utilisateur
- Protection des pages nécessitant une authentification

## 🌐 Navigation

- **Public** : Accueil, Livre d'or (lecture), Inscription, Connexion
- **Connecté** : + Ajout commentaire, Profil, Déconnexion

## 📝 Exemple de flux MVC

1. **Utilisateur** accède à `inscription.php`
2. **Page principale** charge les fonctions et models
3. **Contrôleur** `AuthController::registerController()` traite la logique
4. **Model** `UserModel::createUser()` gère la base de données
5. **Vue** `views/register.php` affiche le résultat dans le layout

---

**Architecture** : MVC Procédural | **Lien GitHub** : [sadio-kanoute/livre-or-mvc](https://github.com/sadio-kanoute/livre-or-mvc)

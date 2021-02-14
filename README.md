# Site d'annonce immobilières

### Cette application a été réalisée avec :
- Laravel 8
- Bootstrap 4.6
- SASS / JS vanilla

### L'application se compose :
- d'une page d'accueil listant les annonces immobilières,
- d'une section administration permettant de réaliser toutes les opérations CRUD de la table "annonces".

Dans l'administration, la page listant les annonces peut être triée en fonction des différents champs de la table annonce et possède une pagination.

### Installation du projet
1. Cloner ce repos
2. A la racine du dossier laravel-immo, lancer la commande `composer install` pour installer les dépendances
3. Toujours à la racine du dossier, créer un fichier .env en ajoutant les informations concernant votre base de données.
4. Créer les migrations avec la commande `php artisan migrate`
5. Charger les données tests grâce aux seeds avec la commande `php artisan db:seed`
6. Lancer le serveur local avec la commande `php artisan serve`
# ecommerce_sf

Site web ecommerce développé sous symfony

symfony new --webapp ecommerce_sf --version=5.4.\*

php bin/console make:user
/_crée l'entité utilisateur avec le config security.yaml updated avec_/

php bin/console doctrine:migrations:status
/_statut de la migration base de données_/

php bin/console make:migration
/_creation fichier de la migration dans migrations/ _/
php bin/console doctrine:migrations:migrate
php bin/console doctrine:migrations:migrate 'DoctrineMigrations\Version20180605025653'
/_execute la migration_/

php bin/console make:auth
/_crée le formulaire d'authentification _/

php bin/console make:crud
/_ cree une interface crud _/

php bin/console make:entity
/_creation entite
le id autoincrement est créer par defaut_/

//creer getter et setter par namespace
php bin/console make:entity --regenerate
/_il faut egalement déclarer le repository dans l'annotation pour pouvoir le générer_/

//install easyadmin 3
composer require easycorp/easyadmin-bundle
symfony console make:admin:crud

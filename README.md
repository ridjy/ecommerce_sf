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
php bin/console doctrine:migrations:migrate DoctrineMigrations\Version20180605025653
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

//lister les services disponibles dans le conteneur de services
php bin/console debug:autowiring

//envoi mail sous symfony
composer require symfony/mailer
modifier le .env pour le param smtp sous MAILERDSN
composer require symfony/google-mailer
//google mailer pour google

//creation s'un subscriber
php bin/console make:subscriber TwigEventSubscriber
//un listener avec une méthode statique getSubscribedEvents() qui retourne sa configuration.
//Ceci permet aux subscribers d'être enregistrés automatiquement dans le dispatcher Symfony.

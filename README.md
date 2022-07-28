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
/_execute la migration_/

php bin/console make:auth
/_crée le formulaire d'authentification _/

php bin/console make:crud 
/* cree une interface crud */

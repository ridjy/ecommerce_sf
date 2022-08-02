<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802171003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, remise INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code_promo (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, code VARCHAR(50) NOT NULL, date_peremption DATE NOT NULL, INDEX IDX_5C4683B76B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_panier INT DEFAULT NULL, date_paiement DATETIME DEFAULT NULL, type_paiement VARCHAR(255) DEFAULT NULL, adresse_livraison LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_6EEAA67D2FBB81F (id_panier), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, date_panier DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, prix BIGINT NOT NULL, remise INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, stock INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits_categories (produit_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_3A9B64EDF347EFB (produit_id), INDEX IDX_3A9B64EDBCF5E72D (categorie_id), PRIMARY KEY(produit_id, categorie_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE code_promo ADD CONSTRAINT FK_5C4683B76B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D2FBB81F FOREIGN KEY (id_panier) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE produits_categories ADD CONSTRAINT FK_3A9B64EDF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_categories ADD CONSTRAINT FK_3A9B64EDBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_categories DROP FOREIGN KEY FK_3A9B64EDBCF5E72D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D2FBB81F');
        $this->addSql('ALTER TABLE produits_categories DROP FOREIGN KEY FK_3A9B64EDF347EFB');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE code_promo');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produits_categories');
    }
}

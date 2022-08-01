<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220801113333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE code_promo (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, code VARCHAR(50) NOT NULL, date_peremption DATE NOT NULL, INDEX IDX_5C4683B76B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_panier INT DEFAULT NULL, date_paiement DATETIME DEFAULT NULL, type_paiement VARCHAR(255) DEFAULT NULL, adresse_livraison LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_6EEAA67D2FBB81F (id_panier), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, date_panier DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE code_promo ADD CONSTRAINT FK_5C4683B76B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D2FBB81F FOREIGN KEY (id_panier) REFERENCES panier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D2FBB81F');
        $this->addSql('DROP TABLE code_promo');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE panier');
    }
}

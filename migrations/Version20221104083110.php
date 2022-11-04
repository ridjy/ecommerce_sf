<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104083110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE citation (id INT AUTO_INCREMENT NOT NULL, citation LONGTEXT NOT NULL, auteur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        //ajout des citations recueillis 
        /*insert  into `citation`(`id`,`citation`,`auteur`) values (1,'L’erreur est humaine, le pardon, divin',NULL);
        insert  into `citation`(`id`,`citation`,`auteur`) values (2,'Plus tard signifie jamais','LeBlanc');
        insert  into `citation`(`id`,`citation`,`auteur`) values (3,'L\'honnêteté dans les petites chose n\'est pas une petite chose',NULL);
        Soyez ouvert, amical et positif avec toutes les personnes que vous rencontrez; tout le monde mène un combat long et difficile. Socrate*/
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE citation');
    }
}

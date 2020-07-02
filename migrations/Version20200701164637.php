<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701164637 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_voiture (pays_id INT NOT NULL, voiture_id INT NOT NULL, INDEX IDX_F53FE03AA6E44244 (pays_id), INDEX IDX_F53FE03A181A8BA (voiture_id), PRIMARY KEY(pays_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, personne_id INT DEFAULT NULL, numero VARCHAR(15) NOT NULL, type VARCHAR(20) NOT NULL, annee DATE NOT NULL, carburant VARCHAR(20) NOT NULL, prix INT NOT NULL, couleur VARCHAR(20) NOT NULL, kilometrage INT NOT NULL, dedouaner TINYINT(1) NOT NULL, INDEX IDX_E9E2810FA21BD112 (personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pays_voiture ADD CONSTRAINT FK_F53FE03AA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_voiture ADD CONSTRAINT FK_F53FE03A181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays_voiture DROP FOREIGN KEY FK_F53FE03AA6E44244');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FA21BD112');
        $this->addSql('ALTER TABLE pays_voiture DROP FOREIGN KEY FK_F53FE03A181A8BA');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE pays_voiture');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE voiture');
    }
}

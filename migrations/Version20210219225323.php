<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219225323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campus (no_campus INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(no_campus)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (no_etat INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(no_etat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (sortie_no_sortie_id INT NOT NULL, participant_no_participant_id INT NOT NULL, date_inscription DATETIME NOT NULL, INDEX IDX_5E90F6D6D918BFBE (sortie_no_sortie_id), INDEX IDX_5E90F6D67E276A27 (participant_no_participant_id), PRIMARY KEY(sortie_no_sortie_id, participant_no_participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (no_lieu INT AUTO_INCREMENT NOT NULL, ville_no_ville_id INT NOT NULL, nom_lieu VARCHAR(30) NOT NULL, rue VARCHAR(30) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2F577D595F3DE697 (ville_no_ville_id), PRIMARY KEY(no_lieu)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sortie (no_sortie INT AUTO_INCREMENT NOT NULL, organisateur_id INT NOT NULL, lieu_no_lieu_id INT NOT NULL, etats_no_etat_id INT NOT NULL, nom VARCHAR(30) NOT NULL, date_debut DATETIME NOT NULL, duree INT DEFAULT NULL, date_cloture DATETIME NOT NULL, nb_inscription_max INT NOT NULL, description_infos VARCHAR(500) DEFAULT NULL, url_photo VARCHAR(250) DEFAULT NULL, INDEX IDX_3C3FD3F2D936B2FA (organisateur_id), INDEX IDX_3C3FD3F281CC7EAC (lieu_no_lieu_id), INDEX IDX_3C3FD3F2A04E64FD (etats_no_etat_id), PRIMARY KEY(no_sortie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (no_ville INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(30) NOT NULL, code_postal VARCHAR(10) NOT NULL, PRIMARY KEY(no_ville)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D918BFBE FOREIGN KEY (sortie_no_sortie_id) REFERENCES sortie (no_sortie)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D67E276A27 FOREIGN KEY (participant_no_participant_id) REFERENCES participant (no_participant)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D595F3DE697 FOREIGN KEY (ville_no_ville_id) REFERENCES ville (no_ville)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2D936B2FA FOREIGN KEY (organisateur_id) REFERENCES participant (no_participant)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F281CC7EAC FOREIGN KEY (lieu_no_lieu_id) REFERENCES lieu (no_lieu)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2A04E64FD FOREIGN KEY (etats_no_etat_id) REFERENCES etat (no_etat)');
        $this->addSql('ALTER TABLE participant MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE participant DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE participant ADD campus_no_campus_id INT NOT NULL, ADD nom VARCHAR(30) NOT NULL, ADD prenom VARCHAR(30) NOT NULL, ADD telephone VARCHAR(15) DEFAULT NULL, ADD mail VARCHAR(20) NOT NULL, ADD actif TINYINT(1) NOT NULL, CHANGE id no_participant INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B112A5DBDD1 FOREIGN KEY (campus_no_campus_id) REFERENCES campus (no_campus)');
        $this->addSql('CREATE INDEX IDX_D79F6B112A5DBDD1 ON participant (campus_no_campus_id)');
        $this->addSql('ALTER TABLE participant ADD PRIMARY KEY (no_participant)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B112A5DBDD1');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F2A04E64FD');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F281CC7EAC');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6D918BFBE');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D595F3DE697');
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('DROP TABLE ville');
        $this->addSql('ALTER TABLE participant MODIFY no_participant INT NOT NULL');
        $this->addSql('DROP INDEX IDX_D79F6B112A5DBDD1 ON participant');
        $this->addSql('ALTER TABLE participant DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE participant DROP campus_no_campus_id, DROP nom, DROP prenom, DROP telephone, DROP mail, DROP actif, CHANGE no_participant id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD PRIMARY KEY (id)');
    }
}

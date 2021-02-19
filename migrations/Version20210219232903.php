<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219232903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campus (no_campus INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL,CONSTRAINT PK_Campus PRIMARY KEY(no_campus)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (no_etat INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL,CONSTRAINT PK_Etat PRIMARY KEY(no_etat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (sortie_no_sortie INT NOT NULL, participant_no_participant INT NOT NULL, date_inscription DATETIME NOT NULL, INDEX IDX_5E90F6D664821932 (sortie_no_sortie), INDEX IDX_5E90F6D6B4B594F2 (participant_no_participant),CONSTRAINT PK_Inscription PRIMARY KEY(sortie_no_sortie, participant_no_participant)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (no_lieu INT AUTO_INCREMENT NOT NULL, ville_no_ville INT NOT NULL, nom_lieu VARCHAR(30) NOT NULL, rue VARCHAR(30) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2F577D5967652F1E (ville_no_ville),CONSTRAINT PK_Lieu PRIMARY KEY(no_lieu)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (no_participant INT AUTO_INCREMENT NOT NULL, campus_no_campus INT NOT NULL, pseudo VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, mail VARCHAR(20) NOT NULL, actif TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D79F6B1186CC499D (pseudo), INDEX IDX_D79F6B11712EC8C3 (campus_no_campus),CONSTRAINT PK_Participant PRIMARY KEY(no_participant)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sortie (no_sortie INT AUTO_INCREMENT NOT NULL, organisateur INT NOT NULL, lieu_no_lieu INT NOT NULL, etats_no_etat INT NOT NULL, nom VARCHAR(30) NOT NULL, date_debut DATETIME NOT NULL, duree INT DEFAULT NULL, date_cloture DATETIME NOT NULL, nb_inscription_max INT NOT NULL, description_infos VARCHAR(500) DEFAULT NULL, url_photo VARCHAR(250) DEFAULT NULL, INDEX IDX_3C3FD3F24BD76D44 (organisateur), INDEX IDX_3C3FD3F2EA9397F7 (lieu_no_lieu), INDEX IDX_3C3FD3F2FCD21D77 (etats_no_etat),CONSTRAINT PK_Sortie PRIMARY KEY(no_sortie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (no_ville INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(30) NOT NULL, code_postal VARCHAR(10) NOT NULL,CONSTRAINT PK_Ville PRIMARY KEY(no_ville)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_SortieInscription FOREIGN KEY (sortie_no_sortie) REFERENCES sortie (no_sortie)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_ParticipantInscription FOREIGN KEY (participant_no_participant) REFERENCES participant (no_participant)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_VilleLieu FOREIGN KEY (ville_no_ville) REFERENCES ville (no_ville)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_CampusParticipant FOREIGN KEY (campus_no_campus) REFERENCES campus (no_campus)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_OrganisateurSortie FOREIGN KEY (organisateur) REFERENCES participant (no_participant)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_LieuSortie FOREIGN KEY (lieu_no_lieu) REFERENCES lieu (no_lieu)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_EtatSortie FOREIGN KEY (etats_no_etat) REFERENCES etat (no_etat)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_CampusParticipant');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_EtatSortie');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_LieuSortie');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_ParticipantInscription');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_OrganisateurSortie');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_SortieInscription');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_VilleLieu');
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('DROP TABLE ville');
    }
}

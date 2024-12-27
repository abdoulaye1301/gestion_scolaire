<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606221318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_scolaire (id INT AUTO_INCREMENT NOT NULL, annee VARCHAR(9) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, all_day TINYINT(1) NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom_classe VARCHAR(255) NOT NULL, capacite_accueil INT NOT NULL, montant_isncription DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition (id INT AUTO_INCREMENT NOT NULL, nom_evaluation_id INT NOT NULL, matiere_id INT NOT NULL, semestre_id INT NOT NULL, email_id INT NOT NULL, note INT NOT NULL, date_composition DATE NOT NULL, INDEX IDX_C7F4347C932ECD8 (nom_evaluation_id), INDEX IDX_C7F4347F46CD258 (matiere_id), INDEX IDX_C7F43475577AFDB (semestre_id), INDEX IDX_C7F4347A832C1C9 (email_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, type_contrat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, matiere_id INT NOT NULL, enseignant_id INT NOT NULL, semestre_id INT NOT NULL, type_cours_id INT NOT NULL, etat_id INT NOT NULL, debut_cours TIME NOT NULL, fin_cours TIME NOT NULL, date_cours DATE NOT NULL, INDEX IDX_FDCA8C9C8F5EA509 (classe_id), INDEX IDX_FDCA8C9CF46CD258 (matiere_id), INDEX IDX_FDCA8C9CE455FCC0 (enseignant_id), INDEX IDX_FDCA8C9C5577AFDB (semestre_id), INDEX IDX_FDCA8C9CB3305F4C (type_cours_id), INDEX IDX_FDCA8C9CD5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devoir (id INT AUTO_INCREMENT NOT NULL, nom_evaluation_id INT NOT NULL, semestre_id INT NOT NULL, matiere_id INT NOT NULL, email_id INT NOT NULL, date_devoir DATE NOT NULL, note DOUBLE PRECISION NOT NULL, INDEX IDX_749EA771C932ECD8 (nom_evaluation_id), INDEX IDX_749EA7715577AFDB (semestre_id), INDEX IDX_749EA771F46CD258 (matiere_id), INDEX IDX_749EA771A832C1C9 (email_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleves (id INT AUTO_INCREMENT NOT NULL, telephone_parent_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, date_enregistrement DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', sexe VARCHAR(1) NOT NULL, telephone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, prenom_pere VARCHAR(255) NOT NULL, prenom_mere VARCHAR(255) NOT NULL, nom_mere VARCHAR(255) NOT NULL, nom_tuteur VARCHAR(255) NOT NULL, prenom_tuteur VARCHAR(255) NOT NULL, telephone_tuteur INT DEFAULT NULL, image_file_name VARCHAR(255) DEFAULT NULL, INDEX IDX_383B09B141AD616D (telephone_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emargement (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, semestre_id INT NOT NULL, annee_scolaire_id INT NOT NULL, professeurs_id INT NOT NULL, matieres_id INT NOT NULL, titre_cours VARCHAR(255) NOT NULL, date_emargement DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', duree VARCHAR(255) NOT NULL, debut TIME NOT NULL, fin TIME NOT NULL, INDEX IDX_71BBB2508F5EA509 (classe_id), INDEX IDX_71BBB2505577AFDB (semestre_id), INDEX IDX_71BBB2509331C741 (annee_scolaire_id), INDEX IDX_71BBB2503E1D55D7 (professeurs_id), INDEX IDX_71BBB25082350831 (matieres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emploi_temps (id INT AUTO_INCREMENT NOT NULL, nom_salle_id INT NOT NULL, prenom_id INT NOT NULL, matiere_id INT NOT NULL, jour VARCHAR(20) NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_50D1B05E497A85BC (nom_salle_id), INDEX IDX_50D1B05E58819F9E (prenom_id), INDEX IDX_50D1B05EF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_cours (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, nom_evaluation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, nom_evenement VARCHAR(255) NOT NULL, description VARCHAR(10000) NOT NULL, date_publication DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, annee_id INT NOT NULL, eleve_id INT NOT NULL, nom_classe_id INT NOT NULL, date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', montant DOUBLE PRECISION NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_5E90F6D6543EC5F0 (annee_id), INDEX IDX_5E90F6D6A6CC7B2 (eleve_id), INDEX IDX_5E90F6D61BAFD448 (nom_classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (id INT AUTO_INCREMENT NOT NULL, matiere VARCHAR(255) NOT NULL, coef_matiere INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom_parent VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, sexe VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeurs (id INT AUTO_INCREMENT NOT NULL, contrat_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, sexe VARCHAR(1) NOT NULL, date_enregistrement DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', email VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, diplome VARCHAR(255) NOT NULL, salaire DOUBLE PRECISION NOT NULL, debut_contrat DATE NOT NULL, fin_contrat DATE DEFAULT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_92CA41B91823061F (contrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salles (id INT AUTO_INCREMENT NOT NULL, nom_classe_id INT NOT NULL, nom_salle VARCHAR(50) NOT NULL, capacite_accueil INT NOT NULL, emplacement VARCHAR(100) NOT NULL, INDEX IDX_799D45AA1BAFD448 (nom_classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, semestre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sexe (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_cours (id INT AUTO_INCREMENT NOT NULL, type_cours VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, sexe VARCHAR(1) NOT NULL, UNIQUE INDEX UNIQ_497B315EE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347C932ECD8 FOREIGN KEY (nom_evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347F46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43475577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347A832C1C9 FOREIGN KEY (email_id) REFERENCES eleves (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES professeurs (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CB3305F4C FOREIGN KEY (type_cours_id) REFERENCES type_cours (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CD5E86FF FOREIGN KEY (etat_id) REFERENCES etat_cours (id)');
        $this->addSql('ALTER TABLE devoir ADD CONSTRAINT FK_749EA771C932ECD8 FOREIGN KEY (nom_evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE devoir ADD CONSTRAINT FK_749EA7715577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE devoir ADD CONSTRAINT FK_749EA771F46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE devoir ADD CONSTRAINT FK_749EA771A832C1C9 FOREIGN KEY (email_id) REFERENCES eleves (id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B141AD616D FOREIGN KEY (telephone_parent_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE emargement ADD CONSTRAINT FK_71BBB2508F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE emargement ADD CONSTRAINT FK_71BBB2505577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE emargement ADD CONSTRAINT FK_71BBB2509331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE emargement ADD CONSTRAINT FK_71BBB2503E1D55D7 FOREIGN KEY (professeurs_id) REFERENCES professeurs (id)');
        $this->addSql('ALTER TABLE emargement ADD CONSTRAINT FK_71BBB25082350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE emploi_temps ADD CONSTRAINT FK_50D1B05E497A85BC FOREIGN KEY (nom_salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE emploi_temps ADD CONSTRAINT FK_50D1B05E58819F9E FOREIGN KEY (prenom_id) REFERENCES professeurs (id)');
        $this->addSql('ALTER TABLE emploi_temps ADD CONSTRAINT FK_50D1B05EF46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleves (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D61BAFD448 FOREIGN KEY (nom_classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE professeurs ADD CONSTRAINT FK_92CA41B91823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA1BAFD448 FOREIGN KEY (nom_classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composition DROP FOREIGN KEY FK_C7F4347C932ECD8');
        $this->addSql('ALTER TABLE composition DROP FOREIGN KEY FK_C7F4347F46CD258');
        $this->addSql('ALTER TABLE composition DROP FOREIGN KEY FK_C7F43475577AFDB');
        $this->addSql('ALTER TABLE composition DROP FOREIGN KEY FK_C7F4347A832C1C9');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C8F5EA509');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF46CD258');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CE455FCC0');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C5577AFDB');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CB3305F4C');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CD5E86FF');
        $this->addSql('ALTER TABLE devoir DROP FOREIGN KEY FK_749EA771C932ECD8');
        $this->addSql('ALTER TABLE devoir DROP FOREIGN KEY FK_749EA7715577AFDB');
        $this->addSql('ALTER TABLE devoir DROP FOREIGN KEY FK_749EA771F46CD258');
        $this->addSql('ALTER TABLE devoir DROP FOREIGN KEY FK_749EA771A832C1C9');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B141AD616D');
        $this->addSql('ALTER TABLE emargement DROP FOREIGN KEY FK_71BBB2508F5EA509');
        $this->addSql('ALTER TABLE emargement DROP FOREIGN KEY FK_71BBB2505577AFDB');
        $this->addSql('ALTER TABLE emargement DROP FOREIGN KEY FK_71BBB2509331C741');
        $this->addSql('ALTER TABLE emargement DROP FOREIGN KEY FK_71BBB2503E1D55D7');
        $this->addSql('ALTER TABLE emargement DROP FOREIGN KEY FK_71BBB25082350831');
        $this->addSql('ALTER TABLE emploi_temps DROP FOREIGN KEY FK_50D1B05E497A85BC');
        $this->addSql('ALTER TABLE emploi_temps DROP FOREIGN KEY FK_50D1B05E58819F9E');
        $this->addSql('ALTER TABLE emploi_temps DROP FOREIGN KEY FK_50D1B05EF46CD258');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6543EC5F0');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A6CC7B2');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D61BAFD448');
        $this->addSql('ALTER TABLE professeurs DROP FOREIGN KEY FK_92CA41B91823061F');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA1BAFD448');
        $this->addSql('DROP TABLE annee_scolaire');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE composition');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE devoir');
        $this->addSql('DROP TABLE eleves');
        $this->addSql('DROP TABLE emargement');
        $this->addSql('DROP TABLE emploi_temps');
        $this->addSql('DROP TABLE etat_cours');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE evenements');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE matieres');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE professeurs');
        $this->addSql('DROP TABLE salles');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE sexe');
        $this->addSql('DROP TABLE type_cours');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

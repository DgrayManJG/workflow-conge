<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191024133752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Demande (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, featured_image VARCHAR(180) DEFAULT NULL, date_conge_debut DATETIME NOT NULL, date_conge_fin DATETIME NOT NULL, created_date DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, status LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', days INT NOT NULL, if_evenemen_familial TINYINT(1) DEFAULT NULL, joursEvenementFamilial INT DEFAULT NULL, nature_evenement_familial VARCHAR(255) DEFAULT NULL, date_evenement_familial DATETIME NOT NULL, if_conge_paye TINYINT(1) DEFAULT NULL, jours_conge_paye INT DEFAULT NULL, if_rtt TINYINT(1) DEFAULT NULL, mois_acquisition_rtt VARCHAR(255) DEFAULT NULL, if_conge_sans_solde TINYINT(1) DEFAULT NULL, jours_conge_sans_solde INT DEFAULT NULL, if_autre TINYINT(1) DEFAULT NULL, jours_autre INT DEFAULT NULL, observation VARCHAR(255) DEFAULT NULL, DemandeManagerObservation_id INT DEFAULT NULL, INDEX IDX_E929EE3964316868 (DemandeManagerObservation_id), INDEX IDX_23A0E66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_manager_observation (id INT AUTO_INCREMENT NOT NULL, observation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ass_employee_manager (id INT AUTO_INCREMENT NOT NULL, employee_id INT DEFAULT NULL, manager_id INT DEFAULT NULL, INDEX fk_ass_employee_manager_user2_idx (manager_id), INDEX fk_ass_employee_manager_user1_idx (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Demande ADD CONSTRAINT FK_E929EE3964316868 FOREIGN KEY (DemandeManagerObservation_id) REFERENCES demande_manager_observation (id)');
        $this->addSql('ALTER TABLE Demande ADD CONSTRAINT FK_E929EE39A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ass_employee_manager ADD CONSTRAINT FK_A786C9DC8C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ass_employee_manager ADD CONSTRAINT FK_A786C9DC783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Demande DROP FOREIGN KEY FK_E929EE3964316868');
        $this->addSql('DROP TABLE Demande');
        $this->addSql('DROP TABLE demande_manager_observation');
        $this->addSql('DROP TABLE ass_employee_manager');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT \'NULL\'');
    }
}

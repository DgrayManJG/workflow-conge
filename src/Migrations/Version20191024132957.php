<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191024132957 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande ADD if_evenemen_familial TINYINT(1) DEFAULT NULL, ADD joursEvenementFamilial INT DEFAULT NULL, ADD nature_evenement_familial VARCHAR(255) DEFAULT NULL, ADD date_evenement_familial DATETIME NOT NULL, ADD if_conge_paye TINYINT(1) DEFAULT NULL, ADD jours_conge_paye INT DEFAULT NULL, ADD if_rtt TINYINT(1) DEFAULT NULL, ADD mois_acquisition_rtt VARCHAR(255) DEFAULT NULL, ADD if_conge_sans_solde TINYINT(1) DEFAULT NULL, ADD jours_conge_sans_solde INT DEFAULT NULL, ADD if_autre TINYINT(1) DEFAULT NULL, ADD jours_autre INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE featured_image featured_image VARCHAR(180) DEFAULT NULL, CHANGE DemandeManagerObservation_id DemandeManagerObservation_id INT DEFAULT NULL, CHANGE observation observation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_E929EE3964316868 FOREIGN KEY (DemandeManagerObservation_id) REFERENCES demande_manager_observation (id)');
        $this->addSql('ALTER TABLE demande RENAME INDEX idx_23a0e66e1084bd6 TO IDX_E929EE3964316868');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE manager_id manager_id INT DEFAULT NULL, CHANGE employee_id employee_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ass_employee_manager CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE manager_id manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Demande DROP FOREIGN KEY FK_E929EE3964316868');
        $this->addSql('ALTER TABLE Demande DROP if_evenemen_familial, DROP joursEvenementFamilial, DROP nature_evenement_familial, DROP date_evenement_familial, DROP if_conge_paye, DROP jours_conge_paye, DROP if_rtt, DROP mois_acquisition_rtt, DROP if_conge_sans_solde, DROP jours_conge_sans_solde, DROP if_autre, DROP jours_autre, CHANGE user_id user_id INT DEFAULT NULL, CHANGE featured_image featured_image VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE observation observation VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE DemandeManagerObservation_id DemandeManagerObservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Demande RENAME INDEX idx_e929ee3964316868 TO IDX_23A0E66E1084BD6');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT \'NULL\'');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025133608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande ADD janvier TINYINT(1) DEFAULT NULL, ADD fevrier TINYINT(1) DEFAULT NULL, ADD mars TINYINT(1) DEFAULT NULL, ADD avril TINYINT(1) DEFAULT NULL, ADD mai TINYINT(1) DEFAULT NULL, ADD juin TINYINT(1) DEFAULT NULL, ADD juillet TINYINT(1) DEFAULT NULL, ADD aout TINYINT(1) DEFAULT NULL, ADD septembre TINYINT(1) DEFAULT NULL, ADD octobre TINYINT(1) DEFAULT NULL, ADD novembre TINYINT(1) DEFAULT NULL, ADD decembre TINYINT(1) DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE featured_image featured_image VARCHAR(180) DEFAULT NULL, CHANGE nature_evenement_familial nature_evenement_familial VARCHAR(255) DEFAULT NULL, CHANGE date_evenement_familial date_evenement_familial DATETIME DEFAULT NULL, CHANGE if_conge_paye if_conge_paye TINYINT(1) DEFAULT NULL, CHANGE jours_conge_paye jours_conge_paye INT DEFAULT NULL, CHANGE if_rtt if_rtt TINYINT(1) DEFAULT NULL, CHANGE mois_acquisition_rtt mois_acquisition_rtt VARCHAR(255) DEFAULT NULL, CHANGE if_conge_sans_solde if_conge_sans_solde TINYINT(1) DEFAULT NULL, CHANGE jours_conge_sans_solde jours_conge_sans_solde INT DEFAULT NULL, CHANGE if_autre if_autre TINYINT(1) DEFAULT NULL, CHANGE jours_autre jours_autre INT DEFAULT NULL, CHANGE observation observation VARCHAR(255) DEFAULT NULL, CHANGE DemandeManagerObservation_id DemandeManagerObservation_id INT DEFAULT NULL, CHANGE if_evenement_familial if_evenement_familial TINYINT(1) DEFAULT NULL, CHANGE jours_evenement_familial jours_evenement_familial INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE manager_id manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_moisrtt CHANGE demande_id demande_id INT DEFAULT NULL, CHANGE moisRtt_id moisRtt_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ass_employee_manager CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE manager_id manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Demande DROP janvier, DROP fevrier, DROP mars, DROP avril, DROP mai, DROP juin, DROP juillet, DROP aout, DROP septembre, DROP octobre, DROP novembre, DROP decembre, CHANGE user_id user_id INT DEFAULT NULL, CHANGE featured_image featured_image VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE if_evenement_familial if_evenement_familial TINYINT(1) DEFAULT \'NULL\', CHANGE jours_evenement_familial jours_evenement_familial INT DEFAULT NULL, CHANGE nature_evenement_familial nature_evenement_familial VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE date_evenement_familial date_evenement_familial DATETIME DEFAULT \'NULL\', CHANGE if_conge_paye if_conge_paye TINYINT(1) DEFAULT \'NULL\', CHANGE jours_conge_paye jours_conge_paye INT DEFAULT NULL, CHANGE if_rtt if_rtt TINYINT(1) DEFAULT \'NULL\', CHANGE mois_acquisition_rtt mois_acquisition_rtt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE if_conge_sans_solde if_conge_sans_solde TINYINT(1) DEFAULT \'NULL\', CHANGE jours_conge_sans_solde jours_conge_sans_solde INT DEFAULT NULL, CHANGE if_autre if_autre TINYINT(1) DEFAULT \'NULL\', CHANGE jours_autre jours_autre INT DEFAULT NULL, CHANGE observation observation VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE DemandeManagerObservation_id DemandeManagerObservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_moisrtt CHANGE demande_id demande_id INT NOT NULL, CHANGE moisRtt_id moisRtt_id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT \'NULL\'');
    }
}

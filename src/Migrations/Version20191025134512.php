<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025134512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande_moisrtt DROP FOREIGN KEY fk_demande_moisRtt_moisRtt1');
        $this->addSql('DROP TABLE demande_moisrtt');
        $this->addSql('DROP TABLE moisrtt');
        $this->addSql('ALTER TABLE demande CHANGE user_id user_id INT DEFAULT NULL, CHANGE featured_image featured_image VARCHAR(180) DEFAULT NULL, CHANGE nature_evenement_familial nature_evenement_familial VARCHAR(255) DEFAULT NULL, CHANGE date_evenement_familial date_evenement_familial DATETIME DEFAULT NULL, CHANGE if_conge_paye if_conge_paye TINYINT(1) DEFAULT NULL, CHANGE jours_conge_paye jours_conge_paye INT DEFAULT NULL, CHANGE if_rtt if_rtt TINYINT(1) DEFAULT NULL, CHANGE mois_acquisition_rtt mois_acquisition_rtt VARCHAR(255) DEFAULT NULL, CHANGE if_conge_sans_solde if_conge_sans_solde TINYINT(1) DEFAULT NULL, CHANGE jours_conge_sans_solde jours_conge_sans_solde INT DEFAULT NULL, CHANGE if_autre if_autre TINYINT(1) DEFAULT NULL, CHANGE jours_autre jours_autre INT DEFAULT NULL, CHANGE observation observation VARCHAR(255) DEFAULT NULL, CHANGE DemandeManagerObservation_id DemandeManagerObservation_id INT DEFAULT NULL, CHANGE if_evenement_familial if_evenement_familial TINYINT(1) DEFAULT NULL, CHANGE jours_evenement_familial jours_evenement_familial INT DEFAULT NULL, CHANGE janvier janvier TINYINT(1) DEFAULT NULL, CHANGE fevrier fevrier TINYINT(1) DEFAULT NULL, CHANGE mars mars TINYINT(1) DEFAULT NULL, CHANGE avril avril TINYINT(1) DEFAULT NULL, CHANGE mai mai TINYINT(1) DEFAULT NULL, CHANGE juin juin TINYINT(1) DEFAULT NULL, CHANGE juillet juillet TINYINT(1) DEFAULT NULL, CHANGE aout aout TINYINT(1) DEFAULT NULL, CHANGE septembre septembre TINYINT(1) DEFAULT NULL, CHANGE octobre octobre TINYINT(1) DEFAULT NULL, CHANGE novembre novembre TINYINT(1) DEFAULT NULL, CHANGE decembre decembre TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE manager_id manager_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE demande_moisrtt (id INT AUTO_INCREMENT NOT NULL, demande_id INT DEFAULT NULL, moisRtt_id INT DEFAULT NULL, INDEX fk_demande_moisRtt_moisRtt1_idx (moisRtt_id), INDEX fk_demande_moisRtt_demande1_idx (demande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE moisrtt (id INT AUTO_INCREMENT NOT NULL, moisRtt VARCHAR(45) DEFAULT \'NULL\' COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE demande_moisrtt ADD CONSTRAINT fk_demande_moisRtt_demande1 FOREIGN KEY (demande_id) REFERENCES demande (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE demande_moisrtt ADD CONSTRAINT fk_demande_moisRtt_moisRtt1 FOREIGN KEY (moisRtt_id) REFERENCES moisrtt (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE manager_id manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Demande CHANGE user_id user_id INT DEFAULT NULL, CHANGE featured_image featured_image VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE if_evenement_familial if_evenement_familial TINYINT(1) DEFAULT \'NULL\', CHANGE jours_evenement_familial jours_evenement_familial INT DEFAULT NULL, CHANGE nature_evenement_familial nature_evenement_familial VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE date_evenement_familial date_evenement_familial DATETIME DEFAULT \'NULL\', CHANGE if_conge_paye if_conge_paye TINYINT(1) DEFAULT \'NULL\', CHANGE jours_conge_paye jours_conge_paye INT DEFAULT NULL, CHANGE if_rtt if_rtt TINYINT(1) DEFAULT \'NULL\', CHANGE janvier janvier TINYINT(1) DEFAULT \'NULL\', CHANGE fevrier fevrier TINYINT(1) DEFAULT \'NULL\', CHANGE mars mars TINYINT(1) DEFAULT \'NULL\', CHANGE avril avril TINYINT(1) DEFAULT \'NULL\', CHANGE mai mai TINYINT(1) DEFAULT \'NULL\', CHANGE juin juin TINYINT(1) DEFAULT \'NULL\', CHANGE juillet juillet TINYINT(1) DEFAULT \'NULL\', CHANGE aout aout TINYINT(1) DEFAULT \'NULL\', CHANGE septembre septembre TINYINT(1) DEFAULT \'NULL\', CHANGE octobre octobre TINYINT(1) DEFAULT \'NULL\', CHANGE novembre novembre TINYINT(1) DEFAULT \'NULL\', CHANGE decembre decembre TINYINT(1) DEFAULT \'NULL\', CHANGE mois_acquisition_rtt mois_acquisition_rtt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE if_conge_sans_solde if_conge_sans_solde TINYINT(1) DEFAULT \'NULL\', CHANGE jours_conge_sans_solde jours_conge_sans_solde INT DEFAULT NULL, CHANGE if_autre if_autre TINYINT(1) DEFAULT \'NULL\', CHANGE jours_autre jours_autre INT DEFAULT NULL, CHANGE observation observation VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE DemandeManagerObservation_id DemandeManagerObservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT \'NULL\'');
    }
}

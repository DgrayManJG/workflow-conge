<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017085052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD observation VARCHAR(255) NOT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE ArticleManagerObservation_id ArticleManagerObservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE manager_id manager_id INT DEFAULT NULL, CHANGE employee_id employee_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP observation, CHANGE user_id user_id INT DEFAULT NULL, CHANGE ArticleManagerObservation_id ArticleManagerObservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE manager_id manager_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT \'NULL\'');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016152119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_manager_observation (id INT AUTO_INCREMENT NOT NULL, observation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD ArticleManagerObservation_id INT DEFAULT NULL, DROP observation, CHANGE user_id user_id INT DEFAULT NULL, CHANGE featured_image featured_image VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E1084BD6 FOREIGN KEY (ArticleManagerObservation_id) REFERENCES article_manager_observation (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66E1084BD6 ON article (ArticleManagerObservation_id)');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE manager_id manager_id INT DEFAULT NULL, CHANGE employee_id employee_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66E1084BD6');
        $this->addSql('DROP TABLE article_manager_observation');
        $this->addSql('DROP INDEX IDX_23A0E66E1084BD6 ON article');
        $this->addSql('ALTER TABLE article ADD observation VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, DROP ArticleManagerObservation_id, CHANGE user_id user_id INT NOT NULL, CHANGE featured_image featured_image VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE ass_employee_manager CHANGE employee_id employee_id INT NOT NULL, CHANGE manager_id manager_id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE last_connection_date last_connection_date DATETIME DEFAULT \'NULL\', CHANGE roles roles LONGTEXT DEFAULT \'NULL\' COLLATE utf8_general_ci COMMENT \'(DC2Type:array)\'');
    }
}

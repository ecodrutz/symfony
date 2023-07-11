<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230710124237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FE38F84471F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84471F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84471F7E88B');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE event');
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery('INSERT INTO event (name) VALUES (\'test1\')');
        $this->connection->executeQuery('INSERT INTO event (name) VALUES (\'test2\')');
        $this->connection->executeQuery('INSERT INTO appointment (event_id, date) VALUES (1, \'2023-01-01\')');
        $this->connection->executeQuery('INSERT INTO appointment (event_id, date) VALUES (1, \'2023-01-02\')');
        $this->connection->executeQuery('INSERT INTO appointment (event_id, date) VALUES (1, \'2023-01-03\')');
        $this->connection->executeQuery('INSERT INTO appointment (event_id, date) VALUES (2, \'2023-01-04\')');
        $this->connection->executeQuery('INSERT INTO appointment (event_id, date) VALUES (2, \'2023-01-05\')');
    }
}

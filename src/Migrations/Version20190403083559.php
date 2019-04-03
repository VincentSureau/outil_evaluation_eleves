<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403083559 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sntask ADD specialisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE sntask ADD CONSTRAINT FK_694C13D95627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('CREATE INDEX IDX_694C13D95627D44C ON sntask (specialisation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sntask DROP FOREIGN KEY FK_694C13D95627D44C');
        $this->addSql('DROP INDEX IDX_694C13D95627D44C ON sntask');
        $this->addSql('ALTER TABLE sntask DROP specialisation_id');
    }
}

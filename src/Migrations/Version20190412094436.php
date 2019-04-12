<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412094436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE melecsub_competence ADD specialisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE melecsub_competence ADD CONSTRAINT FK_1A9CA8FA5627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('CREATE INDEX IDX_1A9CA8FA5627D44C ON melecsub_competence (specialisation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE melecsub_competence DROP FOREIGN KEY FK_1A9CA8FA5627D44C');
        $this->addSql('DROP INDEX IDX_1A9CA8FA5627D44C ON melecsub_competence');
        $this->addSql('ALTER TABLE melecsub_competence DROP specialisation_id');
    }
}

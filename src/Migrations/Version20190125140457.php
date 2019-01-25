<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190125140457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33CAB27BA7');
        $this->addSql('DROP INDEX IDX_B723AF33CAB27BA7 ON student');
        $this->addSql('ALTER TABLE student CHANGE specialiation_id specialisation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF335627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('CREATE INDEX IDX_B723AF335627D44C ON student (specialisation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF335627D44C');
        $this->addSql('DROP INDEX IDX_B723AF335627D44C ON student');
        $this->addSql('ALTER TABLE student CHANGE specialisation_id specialiation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33CAB27BA7 FOREIGN KEY (specialiation_id) REFERENCES specialisation (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33CAB27BA7 ON student (specialiation_id)');
    }
}

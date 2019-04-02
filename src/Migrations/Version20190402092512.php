<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402092512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE snsub_competence (id INT AUTO_INCREMENT NOT NULL, competence_id INT NOT NULL, label LONGTEXT NOT NULL, INDEX IDX_DCFC935D15761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE melecsub_competence (id INT AUTO_INCREMENT NOT NULL, competence_id INT NOT NULL, label LONGTEXT NOT NULL, INDEX IDX_1A9CA8FA15761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE melectask (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT NOT NULL, reference VARCHAR(255) NOT NULL, label LONGTEXT NOT NULL, INDEX IDX_6AA96D5E5627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meleccompetence (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT NOT NULL, reference VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_FB4D5DC15627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE snsub_competence ADD CONSTRAINT FK_DCFC935D15761DAB FOREIGN KEY (competence_id) REFERENCES sncompetence (id)');
        $this->addSql('ALTER TABLE melecsub_competence ADD CONSTRAINT FK_1A9CA8FA15761DAB FOREIGN KEY (competence_id) REFERENCES meleccompetence (id)');
        $this->addSql('ALTER TABLE melectask ADD CONSTRAINT FK_6AA96D5E5627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE meleccompetence ADD CONSTRAINT FK_FB4D5DC15627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE sntask DROP FOREIGN KEY FK_694C13D915761DAB');
        $this->addSql('DROP INDEX IDX_694C13D915761DAB ON sntask');
        $this->addSql('ALTER TABLE sntask DROP competence_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE melecsub_competence DROP FOREIGN KEY FK_1A9CA8FA15761DAB');
        $this->addSql('DROP TABLE snsub_competence');
        $this->addSql('DROP TABLE melecsub_competence');
        $this->addSql('DROP TABLE melectask');
        $this->addSql('DROP TABLE meleccompetence');
        $this->addSql('ALTER TABLE sntask ADD competence_id INT NOT NULL');
        $this->addSql('ALTER TABLE sntask ADD CONSTRAINT FK_694C13D915761DAB FOREIGN KEY (competence_id) REFERENCES sncompetence (id)');
        $this->addSql('CREATE INDEX IDX_694C13D915761DAB ON sntask (competence_id)');
    }
}

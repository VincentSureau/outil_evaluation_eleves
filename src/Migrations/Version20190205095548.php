<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190205095548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_competence DROP FOREIGN KEY FK_CD6BF88F15761DAB');
        $this->addSql('CREATE TABLE tp_task (tp_id INT NOT NULL, task_id INT NOT NULL, INDEX IDX_47107AA4384F0DAC (tp_id), INDEX IDX_47107AA48DB60186 (task_id), PRIMARY KEY(tp_id, task_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_527EDB255627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tp_task ADD CONSTRAINT FK_47107AA4384F0DAC FOREIGN KEY (tp_id) REFERENCES tp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_task ADD CONSTRAINT FK_47107AA48DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB255627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE tp_competence');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_task DROP FOREIGN KEY FK_47107AA48DB60186');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_94D4687F5627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tp_competence (tp_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_CD6BF88F384F0DAC (tp_id), INDEX IDX_CD6BF88F15761DAB (competence_id), PRIMARY KEY(tp_id, competence_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F5627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE tp_competence ADD CONSTRAINT FK_CD6BF88F15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_competence ADD CONSTRAINT FK_CD6BF88F384F0DAC FOREIGN KEY (tp_id) REFERENCES tp (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tp_task');
        $this->addSql('DROP TABLE task');
    }
}

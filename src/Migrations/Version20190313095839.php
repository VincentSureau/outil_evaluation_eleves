<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190313095839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL,
        roles JSON NOT NULL,
        password VARCHAR(255) NOT NULL,
        firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL,
        email VARCHAR(255) DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, grade VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_task ADD CONSTRAINT FK_15E6D13E15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_task ADD CONSTRAINT FK_15E6D13E8DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review_tp ADD CONSTRAINT FK_DB982EFA3E2E969B FOREIGN KEY (review_id) REFERENCES review (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review_tp ADD CONSTRAINT FK_DB982EFA384F0DAC FOREIGN KEY (tp_id) REFERENCES tp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF335627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33EF2A5E9F FOREIGN KEY (srm_id) REFERENCES srm (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336F6AD364 FOREIGN KEY (cirfa_id) REFERENCES cirfa (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3335E47E35 FOREIGN KEY (referent_id) REFERENCES referent (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF333E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33B1EF60FB FOREIGN KEY (bordee_id) REFERENCES bordee (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB255627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE tp ADD CONSTRAINT FK_5A8FDF315627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE tp_task ADD CONSTRAINT FK_47107AA4384F0DAC FOREIGN KEY (tp_id) REFERENCES tp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_task ADD CONSTRAINT FK_47107AA48DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE competence_task DROP FOREIGN KEY FK_15E6D13E15761DAB');
        $this->addSql('ALTER TABLE competence_task DROP FOREIGN KEY FK_15E6D13E8DB60186');
        $this->addSql('ALTER TABLE review_tp DROP FOREIGN KEY FK_DB982EFA3E2E969B');
        $this->addSql('ALTER TABLE review_tp DROP FOREIGN KEY FK_DB982EFA384F0DAC');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF335627D44C');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33EF2A5E9F');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336F6AD364');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33C32A47EE');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3335E47E35');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF333E2E969B');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33B1EF60FB');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB255627D44C');
        $this->addSql('ALTER TABLE tp DROP FOREIGN KEY FK_5A8FDF315627D44C');
        $this->addSql('ALTER TABLE tp_task DROP FOREIGN KEY FK_47107AA4384F0DAC');
        $this->addSql('ALTER TABLE tp_task DROP FOREIGN KEY FK_47107AA48DB60186');
    }
}

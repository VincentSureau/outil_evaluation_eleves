<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403091623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT DEFAULT NULL, srm_id INT DEFAULT NULL, cirfa_id INT DEFAULT NULL, school_id INT DEFAULT NULL, referent_id INT DEFAULT NULL, review_id INT DEFAULT NULL, bordee_id INT NOT NULL, city VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, birthplace VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, INDEX IDX_B723AF335627D44C (specialisation_id), INDEX IDX_B723AF33EF2A5E9F (srm_id), INDEX IDX_B723AF336F6AD364 (cirfa_id), INDEX IDX_B723AF33C32A47EE (school_id), INDEX IDX_B723AF3335E47E35 (referent_id), UNIQUE INDEX UNIQ_B723AF333E2E969B (review_id), INDEX IDX_B723AF33B1EF60FB (bordee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meleccompetence (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT NOT NULL, reference VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_FB4D5DC15627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialisation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE srm (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sntask (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT NOT NULL, label LONGTEXT NOT NULL, INDEX IDX_694C13D95627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE melecsub_competence (id INT AUTO_INCREMENT NOT NULL, competence_id INT NOT NULL, label LONGTEXT NOT NULL, INDEX IDX_1A9CA8FA15761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, academy VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, datas JSON DEFAULT NULL, INDEX IDX_5A8FDF315627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sncompetence (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT NOT NULL, reference VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_5DFD285C5627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, grade VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bordee (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cirfa (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE melectask (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT NOT NULL, reference VARCHAR(255) NOT NULL, label LONGTEXT NOT NULL, INDEX IDX_6AA96D5E5627D44C (specialisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referent (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE snsub_competence (id INT AUTO_INCREMENT NOT NULL, competence_id INT NOT NULL, label LONGTEXT NOT NULL, INDEX IDX_DCFC935D15761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, report VARCHAR(255) DEFAULT NULL, notes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', comment LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review_tp (review_id INT NOT NULL, tp_id INT NOT NULL, INDEX IDX_DB982EFA3E2E969B (review_id), INDEX IDX_DB982EFA384F0DAC (tp_id), PRIMARY KEY(review_id, tp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF335627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33EF2A5E9F FOREIGN KEY (srm_id) REFERENCES srm (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336F6AD364 FOREIGN KEY (cirfa_id) REFERENCES cirfa (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3335E47E35 FOREIGN KEY (referent_id) REFERENCES referent (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF333E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33B1EF60FB FOREIGN KEY (bordee_id) REFERENCES bordee (id)');
        $this->addSql('ALTER TABLE meleccompetence ADD CONSTRAINT FK_FB4D5DC15627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE sntask ADD CONSTRAINT FK_694C13D95627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE melecsub_competence ADD CONSTRAINT FK_1A9CA8FA15761DAB FOREIGN KEY (competence_id) REFERENCES meleccompetence (id)');
        $this->addSql('ALTER TABLE tp ADD CONSTRAINT FK_5A8FDF315627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE sncompetence ADD CONSTRAINT FK_5DFD285C5627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE melectask ADD CONSTRAINT FK_6AA96D5E5627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE snsub_competence ADD CONSTRAINT FK_DCFC935D15761DAB FOREIGN KEY (competence_id) REFERENCES sncompetence (id)');
        $this->addSql('ALTER TABLE review_tp ADD CONSTRAINT FK_DB982EFA3E2E969B FOREIGN KEY (review_id) REFERENCES review (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review_tp ADD CONSTRAINT FK_DB982EFA384F0DAC FOREIGN KEY (tp_id) REFERENCES tp (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE melecsub_competence DROP FOREIGN KEY FK_1A9CA8FA15761DAB');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF335627D44C');
        $this->addSql('ALTER TABLE meleccompetence DROP FOREIGN KEY FK_FB4D5DC15627D44C');
        $this->addSql('ALTER TABLE sntask DROP FOREIGN KEY FK_694C13D95627D44C');
        $this->addSql('ALTER TABLE tp DROP FOREIGN KEY FK_5A8FDF315627D44C');
        $this->addSql('ALTER TABLE sncompetence DROP FOREIGN KEY FK_5DFD285C5627D44C');
        $this->addSql('ALTER TABLE melectask DROP FOREIGN KEY FK_6AA96D5E5627D44C');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33EF2A5E9F');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33C32A47EE');
        $this->addSql('ALTER TABLE review_tp DROP FOREIGN KEY FK_DB982EFA384F0DAC');
        $this->addSql('ALTER TABLE snsub_competence DROP FOREIGN KEY FK_DCFC935D15761DAB');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33B1EF60FB');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336F6AD364');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3335E47E35');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF333E2E969B');
        $this->addSql('ALTER TABLE review_tp DROP FOREIGN KEY FK_DB982EFA3E2E969B');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE meleccompetence');
        $this->addSql('DROP TABLE specialisation');
        $this->addSql('DROP TABLE srm');
        $this->addSql('DROP TABLE sntask');
        $this->addSql('DROP TABLE melecsub_competence');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE tp');
        $this->addSql('DROP TABLE sncompetence');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE bordee');
        $this->addSql('DROP TABLE cirfa');
        $this->addSql('DROP TABLE melectask');
        $this->addSql('DROP TABLE referent');
        $this->addSql('DROP TABLE snsub_competence');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE review_tp');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423205549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresses (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, channel_number INT NOT NULL, channel_name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code INT NOT NULL, INDEX IDX_6FCA7516979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies (id INT AUTO_INCREMENT NOT NULL, legal_form_id INT NOT NULL, siren VARCHAR(255) NOT NULL, INDEX IDX_8244AA3A98CD0513 (legal_form_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legal_forms (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE versions (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, name VARCHAR(255) NOT NULL, registration_city VARCHAR(255) NOT NULL, registration_date DATETIME NOT NULL, capital DOUBLE PRECISION NOT NULL, INDEX IDX_19DC40D2979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA7516979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE companies ADD CONSTRAINT FK_8244AA3A98CD0513 FOREIGN KEY (legal_form_id) REFERENCES legal_forms (id)');
        $this->addSql('ALTER TABLE versions ADD CONSTRAINT FK_19DC40D2979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA7516979B1AD6');
        $this->addSql('ALTER TABLE versions DROP FOREIGN KEY FK_19DC40D2979B1AD6');
        $this->addSql('ALTER TABLE companies DROP FOREIGN KEY FK_8244AA3A98CD0513');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE legal_forms');
        $this->addSql('DROP TABLE versions');
    }
}

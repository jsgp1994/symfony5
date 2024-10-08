<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909205657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE laptop ADD brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE laptop ADD CONSTRAINT FK_E001563B44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E001563B44F5D008 ON laptop (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE laptop DROP CONSTRAINT FK_E001563B44F5D008');
        $this->addSql('DROP INDEX IDX_E001563B44F5D008');
        $this->addSql('ALTER TABLE laptop DROP brand_id');
    }
}

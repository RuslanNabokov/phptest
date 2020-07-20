<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720085951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE commentexit_id_seq CASCADE');
        $this->addSql('DROP TABLE commentexit');
        $this->addSql('ALTER TABLE comment ADD text TEXT NOT NULL');
        $this->addSql('ALTER TABLE conference ADD is_international BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER id TYPE INT');
        $this->addSql('ALTER TABLE "user" ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE commentexit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE commentexit (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE conference DROP is_international');
        $this->addSql('ALTER TABLE comment DROP text');
        $this->addSql('ALTER TABLE "user" ALTER id TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE "user" ALTER id DROP DEFAULT');
    }
}

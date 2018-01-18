<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117090301 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE announcement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE area_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE announcement (id INT NOT NULL, area_id INT NOT NULL, city_id INT NOT NULL, category_id INT NOT NULL, title VARCHAR(100) NOT NULL, description TEXT NOT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, delete_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4DB9D91CBD0F409C ON announcement (area_id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C8BAC62AF ON announcement (city_id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C12469DE2 ON announcement (category_id)');
        $this->addSql('CREATE TABLE area (id INT NOT NULL, name VARCHAR(255) NOT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, delete_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, delete_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, area_id INT NOT NULL, name VARCHAR(255) NOT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, delete_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D5B0234BD0F409C ON city (area_id)');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91CBD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE announcement DROP CONSTRAINT FK_4DB9D91CBD0F409C');
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B0234BD0F409C');
        $this->addSql('ALTER TABLE announcement DROP CONSTRAINT FK_4DB9D91C12469DE2');
        $this->addSql('ALTER TABLE announcement DROP CONSTRAINT FK_4DB9D91C8BAC62AF');
        $this->addSql('DROP SEQUENCE announcement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE area_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP TABLE announcement');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
    }
}

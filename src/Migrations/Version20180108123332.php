<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180108123332 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE eye (id INTEGER NOT NULL, short_code VARCHAR(5) NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP INDEX IDX_C8B28E4482F1BAF4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__candidate AS SELECT id, language_id FROM candidate');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('CREATE TABLE candidate (id INTEGER NOT NULL, language_id INTEGER DEFAULT NULL, eye_id INTEGER DEFAULT NULL, size INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_C8B28E4482F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C8B28E4488C1A6E7 FOREIGN KEY (eye_id) REFERENCES eye (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO candidate (id, language_id) SELECT id, language_id FROM __temp__candidate');
        $this->addSql('DROP TABLE __temp__candidate');
        $this->addSql('CREATE INDEX IDX_C8B28E4482F1BAF4 ON candidate (language_id)');
        $this->addSql('CREATE INDEX IDX_C8B28E4488C1A6E7 ON candidate (eye_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D64991BD8781');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, candidate_id, first_name, last_name, email, zip_code, city, birth_date, phone, password, is_active, is_admin, created, updated, confirmation_token FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, candidate_id INTEGER DEFAULT NULL, first_name VARCHAR(100) NOT NULL COLLATE BINARY, last_name VARCHAR(100) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, zip_code INTEGER NOT NULL, city VARCHAR(150) NOT NULL COLLATE BINARY, birth_date DATE NOT NULL, phone VARCHAR(20) NOT NULL COLLATE BINARY, password VARCHAR(90) NOT NULL COLLATE BINARY, is_active BOOLEAN NOT NULL, is_admin BOOLEAN NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, confirmation_token VARCHAR(100) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_8D93D64991BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, candidate_id, first_name, last_name, email, zip_code, city, birth_date, phone, password, is_active, is_admin, created, updated, confirmation_token) SELECT id, candidate_id, first_name, last_name, email, zip_code, city, birth_date, phone, password, is_active, is_admin, created, updated, confirmation_token FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64991BD8781 ON user (candidate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE eye');
        $this->addSql('DROP INDEX IDX_C8B28E4482F1BAF4');
        $this->addSql('DROP INDEX IDX_C8B28E4488C1A6E7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__candidate AS SELECT id, language_id FROM candidate');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('CREATE TABLE candidate (id INTEGER NOT NULL, language_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO candidate (id, language_id) SELECT id, language_id FROM __temp__candidate');
        $this->addSql('DROP TABLE __temp__candidate');
        $this->addSql('CREATE INDEX IDX_C8B28E4482F1BAF4 ON candidate (language_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX UNIQ_8D93D64991BD8781');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, candidate_id, first_name, last_name, email, zip_code, city, birth_date, phone, password, is_active, is_admin, created, updated, confirmation_token FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, candidate_id INTEGER DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, zip_code INTEGER NOT NULL, city VARCHAR(150) NOT NULL, birth_date DATE NOT NULL, phone VARCHAR(20) NOT NULL, password VARCHAR(90) NOT NULL, is_active BOOLEAN NOT NULL, is_admin BOOLEAN NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, confirmation_token VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, candidate_id, first_name, last_name, email, zip_code, city, birth_date, phone, password, is_active, is_admin, created, updated, confirmation_token) SELECT id, candidate_id, first_name, last_name, email, zip_code, city, birth_date, phone, password, is_active, is_admin, created, updated, confirmation_token FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64991BD8781 ON user (candidate_id)');
    }
}

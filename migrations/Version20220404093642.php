<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404093642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ts_users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFC16263AA08CB10 ON ts_users (login)');
        $this->addSql('DROP INDEX IDX_A9BDCD20964A220');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sb_critiques AS SELECT id, id_film, note, avis FROM sb_critiques');
        $this->addSql('DROP TABLE sb_critiques');
        $this->addSql('CREATE TABLE sb_critiques (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_film INTEGER NOT NULL, note INTEGER DEFAULT NULL, avis CLOB NOT NULL, CONSTRAINT FK_A9BDCD20964A220 FOREIGN KEY (id_film) REFERENCES sb_film (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sb_critiques (id, id_film, note, avis) SELECT id, id_film, note, avis FROM __temp__sb_critiques');
        $this->addSql('DROP TABLE __temp__sb_critiques');
        $this->addSql('CREATE INDEX IDX_A9BDCD20964A220 ON sb_critiques (id_film)');
        $this->addSql('DROP INDEX UNIQ_79715339F347EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ts_manuel AS SELECT id, produit_id, url, sommaire FROM ts_manuel');
        $this->addSql('DROP TABLE ts_manuel');
        $this->addSql('CREATE TABLE ts_manuel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, produit_id INTEGER NOT NULL, url VARCHAR(255) NOT NULL, sommaire CLOB DEFAULT NULL, CONSTRAINT FK_79715339F347EFB FOREIGN KEY (produit_id) REFERENCES ts_produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ts_manuel (id, produit_id, url, sommaire) SELECT id, produit_id, url, sommaire FROM __temp__ts_manuel');
        $this->addSql('DROP TABLE __temp__ts_manuel');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_79715339F347EFB ON ts_manuel (produit_id)');
        $this->addSql('DROP INDEX IDX_1D074141F347EFB');
        $this->addSql('DROP INDEX IDX_1D074141A6E44244');
        $this->addSql('CREATE TEMPORARY TABLE __temp__produit_pays AS SELECT produit_id, pays_id FROM produit_pays');
        $this->addSql('DROP TABLE produit_pays');
        $this->addSql('CREATE TABLE produit_pays (produit_id INTEGER NOT NULL, pays_id INTEGER NOT NULL, PRIMARY KEY(produit_id, pays_id), CONSTRAINT FK_1D074141F347EFB FOREIGN KEY (produit_id) REFERENCES ts_produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1D074141A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO produit_pays (produit_id, pays_id) SELECT produit_id, pays_id FROM __temp__produit_pays');
        $this->addSql('DROP TABLE __temp__produit_pays');
        $this->addSql('CREATE INDEX IDX_1D074141F347EFB ON produit_pays (produit_id)');
        $this->addSql('CREATE INDEX IDX_1D074141A6E44244 ON produit_pays (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ts_users');
        $this->addSql('DROP INDEX IDX_1D074141F347EFB');
        $this->addSql('DROP INDEX IDX_1D074141A6E44244');
        $this->addSql('CREATE TEMPORARY TABLE __temp__produit_pays AS SELECT produit_id, pays_id FROM produit_pays');
        $this->addSql('DROP TABLE produit_pays');
        $this->addSql('CREATE TABLE produit_pays (produit_id INTEGER NOT NULL, pays_id INTEGER NOT NULL, PRIMARY KEY(produit_id, pays_id))');
        $this->addSql('INSERT INTO produit_pays (produit_id, pays_id) SELECT produit_id, pays_id FROM __temp__produit_pays');
        $this->addSql('DROP TABLE __temp__produit_pays');
        $this->addSql('CREATE INDEX IDX_1D074141F347EFB ON produit_pays (produit_id)');
        $this->addSql('CREATE INDEX IDX_1D074141A6E44244 ON produit_pays (pays_id)');
        $this->addSql('DROP INDEX IDX_A9BDCD20964A220');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sb_critiques AS SELECT id, id_film, note, avis FROM sb_critiques');
        $this->addSql('DROP TABLE sb_critiques');
        $this->addSql('CREATE TABLE sb_critiques (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_film INTEGER NOT NULL, note INTEGER DEFAULT NULL, avis CLOB NOT NULL)');
        $this->addSql('INSERT INTO sb_critiques (id, id_film, note, avis) SELECT id, id_film, note, avis FROM __temp__sb_critiques');
        $this->addSql('DROP TABLE __temp__sb_critiques');
        $this->addSql('CREATE INDEX IDX_A9BDCD20964A220 ON sb_critiques (id_film)');
        $this->addSql('DROP INDEX UNIQ_79715339F347EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ts_manuel AS SELECT id, produit_id, url, sommaire FROM ts_manuel');
        $this->addSql('DROP TABLE ts_manuel');
        $this->addSql('CREATE TABLE ts_manuel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, produit_id INTEGER NOT NULL, url VARCHAR(255) NOT NULL, sommaire CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO ts_manuel (id, produit_id, url, sommaire) SELECT id, produit_id, url, sommaire FROM __temp__ts_manuel');
        $this->addSql('DROP TABLE __temp__ts_manuel');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_79715339F347EFB ON ts_manuel (produit_id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216102147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje ADD enviado_id INT NOT NULL, ADD recibidos_id INT NOT NULL');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D0161AB9A50 FOREIGN KEY (enviado_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01BC5A7B82 FOREIGN KEY (recibidos_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_9B631D0161AB9A50 ON mensaje (enviado_id)');
        $this->addSql('CREATE INDEX IDX_9B631D01BC5A7B82 ON mensaje (recibidos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscripcion CHANGE tagname tagname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D0161AB9A50');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01BC5A7B82');
        $this->addSql('DROP INDEX IDX_9B631D0161AB9A50 ON mensaje');
        $this->addSql('DROP INDEX IDX_9B631D01BC5A7B82 ON mensaje');
        $this->addSql('ALTER TABLE mensaje DROP enviado_id, DROP recibidos_id, CHANGE mensaje mensaje VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE modalidad CHANGE modalidad modalidad VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE opinion CHANGE texto texto VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE plataforma CHANGE plataforma plataforma VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE torneo CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagen imagen VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario CHANGE nombre nombre VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE correo correo VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contrasenya contrasenya VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE foto foto VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE role role VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

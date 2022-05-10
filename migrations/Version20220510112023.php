<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510112023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD retranmision VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscripcion CHANGE tagname tagname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mensaje CHANGE mensaje mensaje VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE modalidad CHANGE modalidad modalidad VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE opinion CHANGE texto texto VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE plataforma CHANGE plataforma plataforma VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE torneo CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagen imagen VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE retransmision retransmision VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario DROP retranmision, CHANGE nombre nombre VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE correo correo VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contrasenya contrasenya VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE foto foto VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE role role VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cuenta cuenta VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE directo directo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cuenta_sony cuenta_sony VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cuenta_microsoft cuenta_microsoft VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cuenta_epic cuenta_epic VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

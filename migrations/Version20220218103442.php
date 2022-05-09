<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218103442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinion ADD torneo_id INT NOT NULL, ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027A0139802 FOREIGN KEY (torneo_id) REFERENCES torneo (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_AB02B027A0139802 ON opinion (torneo_id)');
        $this->addSql('CREATE INDEX IDX_AB02B027DB38439E ON opinion (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscripcion CHANGE tagname tagname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mensaje CHANGE mensaje mensaje VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE modalidad CHANGE modalidad modalidad VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027A0139802');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027DB38439E');
        $this->addSql('DROP INDEX IDX_AB02B027A0139802 ON opinion');
        $this->addSql('DROP INDEX IDX_AB02B027DB38439E ON opinion');
        $this->addSql('ALTER TABLE opinion DROP torneo_id, DROP usuario_id, CHANGE texto texto VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE plataforma CHANGE plataforma plataforma VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE torneo CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagen imagen VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE usuario CHANGE nombre nombre VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE correo correo VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contrasenya contrasenya VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE foto foto VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE role role VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

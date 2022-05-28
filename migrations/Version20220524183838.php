<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524183838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscripcion (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, torneo_id INT NOT NULL, tagname VARCHAR(255) NOT NULL, INDEX IDX_935E99F0DB38439E (usuario_id), INDEX IDX_935E99F0A0139802 (torneo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, enviado_id INT NOT NULL, recibidos_id INT NOT NULL, mensaje VARCHAR(255) NOT NULL, fecha DATETIME NOT NULL, INDEX IDX_9B631D0161AB9A50 (enviado_id), INDEX IDX_9B631D01BC5A7B82 (recibidos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modalidad (id INT AUTO_INCREMENT NOT NULL, modalidad VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, torneo_id INT NOT NULL, usuario_id INT NOT NULL, texto VARCHAR(255) NOT NULL, fecha DATE NOT NULL, INDEX IDX_AB02B027A0139802 (torneo_id), INDEX IDX_AB02B027DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plataforma (id INT AUTO_INCREMENT NOT NULL, plataforma VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torneo (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, modalidad_id INT NOT NULL, plataforma_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, descripcion VARCHAR(255) NOT NULL, imagen VARCHAR(255) NOT NULL, fecha DATETIME NOT NULL, retransmision VARCHAR(255) DEFAULT NULL, codigo VARCHAR(4) NOT NULL, ganador VARCHAR(255) DEFAULT NULL, INDEX IDX_7CEB63FEDB38439E (usuario_id), INDEX IDX_7CEB63FE1E092B9F (modalidad_id), INDEX IDX_7CEB63FEEB90E430 (plataforma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, correo VARCHAR(255) NOT NULL, contrasenya VARCHAR(255) NOT NULL, foto VARCHAR(255) DEFAULT NULL, role VARCHAR(255) NOT NULL, cuenta VARCHAR(255) DEFAULT NULL, directo VARCHAR(255) DEFAULT NULL, cuenta_sony VARCHAR(255) DEFAULT NULL, cuenta_microsoft VARCHAR(255) DEFAULT NULL, cuenta_epic VARCHAR(255) DEFAULT NULL, retranmision VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscripcion ADD CONSTRAINT FK_935E99F0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE inscripcion ADD CONSTRAINT FK_935E99F0A0139802 FOREIGN KEY (torneo_id) REFERENCES torneo (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D0161AB9A50 FOREIGN KEY (enviado_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01BC5A7B82 FOREIGN KEY (recibidos_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027A0139802 FOREIGN KEY (torneo_id) REFERENCES torneo (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE torneo ADD CONSTRAINT FK_7CEB63FEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE torneo ADD CONSTRAINT FK_7CEB63FE1E092B9F FOREIGN KEY (modalidad_id) REFERENCES modalidad (id)');
        $this->addSql('ALTER TABLE torneo ADD CONSTRAINT FK_7CEB63FEEB90E430 FOREIGN KEY (plataforma_id) REFERENCES plataforma (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torneo DROP FOREIGN KEY FK_7CEB63FE1E092B9F');
        $this->addSql('ALTER TABLE torneo DROP FOREIGN KEY FK_7CEB63FEEB90E430');
        $this->addSql('ALTER TABLE inscripcion DROP FOREIGN KEY FK_935E99F0A0139802');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027A0139802');
        $this->addSql('ALTER TABLE inscripcion DROP FOREIGN KEY FK_935E99F0DB38439E');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D0161AB9A50');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01BC5A7B82');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027DB38439E');
        $this->addSql('ALTER TABLE torneo DROP FOREIGN KEY FK_7CEB63FEDB38439E');
        $this->addSql('DROP TABLE inscripcion');
        $this->addSql('DROP TABLE mensaje');
        $this->addSql('DROP TABLE modalidad');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('DROP TABLE plataforma');
        $this->addSql('DROP TABLE torneo');
        $this->addSql('DROP TABLE usuario');
    }
}
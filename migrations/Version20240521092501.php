<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521092501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE live (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, streamer VARCHAR(255) NOT NULL, date DATETIME NOT NULL, theme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE migration_versions');
        $this->addSql('ALTER TABLE news DROP created_at, CHANGE content content LONGTEXT NOT NULL, CHANGE news news VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE streamer DROP name, DROP platform, DROP created_at');
        $this->addSql('ALTER TABLE user DROP email, DROP created_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE migration_versions (version VARCHAR(191) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, executed_at DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(version)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE live');
        $this->addSql('ALTER TABLE news ADD created_at DATETIME DEFAULT \'current_timestamp()\', CHANGE content content TEXT NOT NULL, CHANGE news news VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE streamer ADD name VARCHAR(255) NOT NULL, ADD platform VARCHAR(255) NOT NULL, ADD created_at DATETIME DEFAULT \'current_timestamp()\'');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL, ADD created_at DATETIME DEFAULT \'current_timestamp()\'');
    }
}

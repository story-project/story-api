<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230807135218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_object (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, fullname VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_34DCD176A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, category_id INT NOT NULL, creater_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_EB560438EE45BDBF (picture_id), INDEX IDX_EB56043812469DE2 (category_id), INDEX IDX_EB5604382B921607 (creater_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB560438EE45BDBF FOREIGN KEY (picture_id) REFERENCES media_object (id)');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB56043812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB5604382B921607 FOREIGN KEY (creater_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176A76ED395');
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB560438EE45BDBF');
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB56043812469DE2');
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB5604382B921607');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE story');
    }
}

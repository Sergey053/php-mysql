<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727152800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tb_articles (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(200) NOT NULL, investment VARCHAR(255) DEFAULT NULL, published DATETIME NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(100) NOT NULL, INDEX IDX_877A2476A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_comments (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, article_id INT NOT NULL, text LONGTEXT NOT NULL, added DATETIME NOT NULL, INDEX IDX_67398334A76ED395 (user_id), INDEX IDX_673983347294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_users (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(50) NOT NULL, hash VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tb_articles ADD CONSTRAINT FK_877A2476A76ED395 FOREIGN KEY (user_id) REFERENCES tb_users (id)');
        $this->addSql('ALTER TABLE tb_comments ADD CONSTRAINT FK_67398334A76ED395 FOREIGN KEY (user_id) REFERENCES tb_users (id)');
        $this->addSql('ALTER TABLE tb_comments ADD CONSTRAINT FK_673983347294869C FOREIGN KEY (article_id) REFERENCES tb_articles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tb_comments DROP FOREIGN KEY FK_673983347294869C');
        $this->addSql('ALTER TABLE tb_articles DROP FOREIGN KEY FK_877A2476A76ED395');
        $this->addSql('ALTER TABLE tb_comments DROP FOREIGN KEY FK_67398334A76ED395');
        $this->addSql('DROP TABLE tb_articles');
        $this->addSql('DROP TABLE tb_comments');
        $this->addSql('DROP TABLE tb_users');
    }
}

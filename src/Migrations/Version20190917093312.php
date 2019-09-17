<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190917093312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, unit VARCHAR(255) NOT NULL, quantity VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_23A0E6612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE budget (id INT AUTO_INCREMENT NOT NULL, year DATE NOT NULL, amount NUMERIC(10, 3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivry (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, activity VARCHAR(255) NOT NULL, phone INT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institution (id INT AUTO_INCREMENT NOT NULL, ministry VARCHAR(255) NOT NULL, office VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, director VARCHAR(255) NOT NULL, economist VARCHAR(255) NOT NULL, administrator VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, phone INT NOT NULL, fax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_meal (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, meal_id INT NOT NULL, quantity NUMERIC(15, 3) NOT NULL, unit_price NUMERIC(15, 3) NOT NULL, tax VARCHAR(10) NOT NULL, INDEX IDX_15BB7D457294869C (article_id), INDEX IDX_15BB7D45639666D6 (meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_purchase (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, purchase_id INT NOT NULL, quantity NUMERIC(15, 3) NOT NULL, unit_price NUMERIC(15, 3) NOT NULL, tax VARCHAR(10) NOT NULL, INDEX IDX_B27481417294869C (article_id), INDEX IDX_B2748141558FBEB9 (purchase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, delivry_id INT NOT NULL, number VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_9EF68E9C65461A12 (delivry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase (id INT AUTO_INCREMENT NOT NULL, delivry_id INT NOT NULL, number VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_6117D13B65461A12 (delivry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, purchase_id INT NOT NULL, company VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, activity VARCHAR(255) NOT NULL, tax_number VARCHAR(255) NOT NULL, phone INT NOT NULL, address VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_9B2A6C7E558FBEB9 (purchase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE line_meal ADD CONSTRAINT FK_15BB7D457294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE line_meal ADD CONSTRAINT FK_15BB7D45639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('ALTER TABLE line_purchase ADD CONSTRAINT FK_B27481417294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE line_purchase ADD CONSTRAINT FK_B2748141558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C65461A12 FOREIGN KEY (delivry_id) REFERENCES delivry (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B65461A12 FOREIGN KEY (delivry_id) REFERENCES delivry (id)');
        $this->addSql('ALTER TABLE supplier ADD CONSTRAINT FK_9B2A6C7E558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE line_meal DROP FOREIGN KEY FK_15BB7D457294869C');
        $this->addSql('ALTER TABLE line_purchase DROP FOREIGN KEY FK_B27481417294869C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C65461A12');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B65461A12');
        $this->addSql('ALTER TABLE line_meal DROP FOREIGN KEY FK_15BB7D45639666D6');
        $this->addSql('ALTER TABLE line_purchase DROP FOREIGN KEY FK_B2748141558FBEB9');
        $this->addSql('ALTER TABLE supplier DROP FOREIGN KEY FK_9B2A6C7E558FBEB9');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE budget');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE delivry');
        $this->addSql('DROP TABLE institution');
        $this->addSql('DROP TABLE line_meal');
        $this->addSql('DROP TABLE line_purchase');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE user');
    }
}

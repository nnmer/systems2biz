<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180203000000 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(128) NOT NULL, name VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), UNIQUE INDEX UNIQ_64C19C15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_vs_product (category_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_149244D312469DE2 (category_id), INDEX IDX_149244D34584665A (product_id), PRIMARY KEY(category_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(128) NOT NULL, name VARCHAR(128) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_D34A04AD989D9B62 (slug), UNIQUE INDEX UNIQ_D34A04AD5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_vs_product ADD CONSTRAINT FK_149244D312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_vs_product ADD CONSTRAINT FK_149244D34584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_vs_product DROP FOREIGN KEY FK_149244D312469DE2');
        $this->addSql('ALTER TABLE category_vs_product DROP FOREIGN KEY FK_149244D34584665A');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_vs_product');
        $this->addSql('DROP TABLE product');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419211302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address CHANGE city_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE color ADD code_color VARCHAR(28) NOT NULL');
        $this->addSql('ALTER TABLE customer CHANGE address_id address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_order CHANGE customer_id customer_id INT DEFAULT NULL, CHANGE order_status_id order_status_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX `primary` ON line_customer');
        $this->addSql('ALTER TABLE line_customer ADD PRIMARY KEY (prize_id, customer_order_id, product_id)');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY fk_product_has_category_product1');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY fk_product_has_category_category1');
        $this->addSql('DROP INDEX fk_product_has_category_product1_idx ON product_category');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('DROP INDEX fk_product_has_category_category1_idx ON product_category');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT fk_product_has_category_product1 FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT fk_product_has_category_category1 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product_composition DROP FOREIGN KEY fk_product_has_supplied_item_product1');
        $this->addSql('ALTER TABLE product_composition DROP FOREIGN KEY fk_product_has_supplied_item_supplied_item1');
        $this->addSql('ALTER TABLE product_composition DROP quantity_product_composition');
        $this->addSql('DROP INDEX fk_product_has_supplied_item_product1_idx ON product_composition');
        $this->addSql('CREATE INDEX IDX_A050DD584584665A ON product_composition (product_id)');
        $this->addSql('DROP INDEX fk_product_has_supplied_item_supplied_item1_idx ON product_composition');
        $this->addSql('CREATE INDEX IDX_A050DD584CD01DBA ON product_composition (supplied_item_id)');
        $this->addSql('ALTER TABLE product_composition ADD CONSTRAINT fk_product_has_supplied_item_product1 FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product_composition ADD CONSTRAINT fk_product_has_supplied_item_supplied_item1 FOREIGN KEY (supplied_item_id) REFERENCES supplied_item (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE supplied_item CHANGE measurement_id measurement_id INT DEFAULT NULL, CHANGE color_id color_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE address_id address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE supplier_order CHANGE supplier_id supplier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE line_supplier DROP FOREIGN KEY fk_supplier_order_has_supplied_item_supplied_item1');
        $this->addSql('ALTER TABLE line_supplier DROP FOREIGN KEY fk_supplier_order_has_supplied_item_supplier_order1');
        $this->addSql('ALTER TABLE line_supplier DROP quantity_line_supplier');
        $this->addSql('DROP INDEX fk_supplier_order_has_supplied_item_supplier_order1_idx ON line_supplier');
        $this->addSql('CREATE INDEX IDX_48493C041605B9 ON line_supplier (supplier_order_id)');
        $this->addSql('DROP INDEX fk_supplier_order_has_supplied_item_supplied_item1_idx ON line_supplier');
        $this->addSql('CREATE INDEX IDX_48493C044CD01DBA ON line_supplier (supplied_item_id)');
        $this->addSql('ALTER TABLE line_supplier ADD CONSTRAINT fk_supplier_order_has_supplied_item_supplied_item1 FOREIGN KEY (supplied_item_id) REFERENCES supplied_item (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE line_supplier ADD CONSTRAINT fk_supplier_order_has_supplied_item_supplier_order1 FOREIGN KEY (supplier_order_id) REFERENCES supplier_order (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE address CHANGE city_id city_id INT NOT NULL');
        $this->addSql('ALTER TABLE color DROP code_color');
        $this->addSql('ALTER TABLE customer CHANGE address_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_order CHANGE order_status_id order_status_id INT NOT NULL, CHANGE customer_id customer_id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON line_customer');
        $this->addSql('ALTER TABLE line_customer ADD PRIMARY KEY (customer_order_id, product_id, prize_id)');
        $this->addSql('ALTER TABLE line_supplier DROP FOREIGN KEY FK_48493C041605B9');
        $this->addSql('ALTER TABLE line_supplier DROP FOREIGN KEY FK_48493C044CD01DBA');
        $this->addSql('ALTER TABLE line_supplier ADD quantity_line_supplier INT NOT NULL');
        $this->addSql('DROP INDEX idx_48493c044cd01dba ON line_supplier');
        $this->addSql('CREATE INDEX fk_supplier_order_has_supplied_item_supplied_item1_idx ON line_supplier (supplied_item_id)');
        $this->addSql('DROP INDEX idx_48493c041605b9 ON line_supplier');
        $this->addSql('CREATE INDEX fk_supplier_order_has_supplied_item_supplier_order1_idx ON line_supplier (supplier_order_id)');
        $this->addSql('ALTER TABLE line_supplier ADD CONSTRAINT FK_48493C041605B9 FOREIGN KEY (supplier_order_id) REFERENCES supplier_order (id)');
        $this->addSql('ALTER TABLE line_supplier ADD CONSTRAINT FK_48493C044CD01DBA FOREIGN KEY (supplied_item_id) REFERENCES supplied_item (id)');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('DROP INDEX idx_cdfc73564584665a ON product_category');
        $this->addSql('CREATE INDEX fk_product_has_category_product1_idx ON product_category (product_id)');
        $this->addSql('DROP INDEX idx_cdfc735612469de2 ON product_category');
        $this->addSql('CREATE INDEX fk_product_has_category_category1_idx ON product_category (category_id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product_composition DROP FOREIGN KEY FK_A050DD584584665A');
        $this->addSql('ALTER TABLE product_composition DROP FOREIGN KEY FK_A050DD584CD01DBA');
        $this->addSql('ALTER TABLE product_composition ADD quantity_product_composition INT NOT NULL');
        $this->addSql('DROP INDEX idx_a050dd584584665a ON product_composition');
        $this->addSql('CREATE INDEX fk_product_has_supplied_item_product1_idx ON product_composition (product_id)');
        $this->addSql('DROP INDEX idx_a050dd584cd01dba ON product_composition');
        $this->addSql('CREATE INDEX fk_product_has_supplied_item_supplied_item1_idx ON product_composition (supplied_item_id)');
        $this->addSql('ALTER TABLE product_composition ADD CONSTRAINT FK_A050DD584584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_composition ADD CONSTRAINT FK_A050DD584CD01DBA FOREIGN KEY (supplied_item_id) REFERENCES supplied_item (id)');
        $this->addSql('ALTER TABLE supplied_item CHANGE color_id color_id INT NOT NULL, CHANGE measurement_id measurement_id INT NOT NULL');
        $this->addSql('ALTER TABLE supplier CHANGE address_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE supplier_order CHANGE supplier_id supplier_id INT NOT NULL');
    }
}

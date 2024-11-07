<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241107185126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery ADD deliverer_id INT DEFAULT NULL, DROP deliverer_uuid');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10B6A6A3F4 FOREIGN KEY (deliverer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10B6A6A3F4 ON delivery (deliverer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10B6A6A3F4');
        $this->addSql('DROP INDEX IDX_3781EC10B6A6A3F4 ON delivery');
        $this->addSql('ALTER TABLE delivery ADD deliverer_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', DROP deliverer_id');
    }
}

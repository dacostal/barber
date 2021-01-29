<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210129085519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE barber_service (barber_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_B6C881ABBFF2FEF2 (barber_id), INDEX IDX_B6C881ABED5CA9E6 (service_id), PRIMARY KEY(barber_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE barber_service ADD CONSTRAINT FK_B6C881ABBFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE barber_service ADD CONSTRAINT FK_B6C881ABED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE barber_service');
    }
}

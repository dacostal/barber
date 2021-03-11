<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311143214 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment_availability (appointment_id INT NOT NULL, availability_id INT NOT NULL, INDEX IDX_C675B5B2E5B533F9 (appointment_id), INDEX IDX_C675B5B261778466 (availability_id), PRIMARY KEY(appointment_id, availability_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE barber_service (barber_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_B6C881ABBFF2FEF2 (barber_id), INDEX IDX_B6C881ABED5CA9E6 (service_id), PRIMARY KEY(barber_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE barber_availability (barber_id INT NOT NULL, availability_id INT NOT NULL, INDEX IDX_D3E0D757BFF2FEF2 (barber_id), INDEX IDX_D3E0D75761778466 (availability_id), PRIMARY KEY(barber_id, availability_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment_availability ADD CONSTRAINT FK_C675B5B2E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_availability ADD CONSTRAINT FK_C675B5B261778466 FOREIGN KEY (availability_id) REFERENCES availability (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE barber_service ADD CONSTRAINT FK_B6C881ABBFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE barber_service ADD CONSTRAINT FK_B6C881ABED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE barber_availability ADD CONSTRAINT FK_D3E0D757BFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE barber_availability ADD CONSTRAINT FK_D3E0D75761778466 FOREIGN KEY (availability_id) REFERENCES availability (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BFBFF2FEF2');
        $this->addSql('DROP INDEX IDX_3FB7A2BFBFF2FEF2 ON availability');
        $this->addSql('ALTER TABLE availability DROP barber_id');
        $this->addSql('ALTER TABLE service ADD category VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appointment_availability');
        $this->addSql('DROP TABLE barber_service');
        $this->addSql('DROP TABLE barber_availability');
        $this->addSql('ALTER TABLE availability ADD barber_id INT NOT NULL');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BFBFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3FB7A2BFBFF2FEF2 ON availability (barber_id)');
        $this->addSql('ALTER TABLE service DROP category');
    }
}

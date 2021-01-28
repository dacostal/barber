<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128182137 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment ADD customer_id INT NOT NULL, ADD barber_id INT NOT NULL, ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844BFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_FE38F8449395C3F3 ON appointment (customer_id)');
        $this->addSql('CREATE INDEX IDX_FE38F844BFF2FEF2 ON appointment (barber_id)');
        $this->addSql('CREATE INDEX IDX_FE38F844ED5CA9E6 ON appointment (service_id)');
        $this->addSql('ALTER TABLE availability ADD barber_id INT NOT NULL');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BFBFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id)');
        $this->addSql('CREATE INDEX IDX_3FB7A2BFBFF2FEF2 ON availability (barber_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8449395C3F3');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844BFF2FEF2');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844ED5CA9E6');
        $this->addSql('DROP INDEX IDX_FE38F8449395C3F3 ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F844BFF2FEF2 ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F844ED5CA9E6 ON appointment');
        $this->addSql('ALTER TABLE appointment DROP customer_id, DROP barber_id, DROP service_id');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BFBFF2FEF2');
        $this->addSql('DROP INDEX IDX_3FB7A2BFBFF2FEF2 ON availability');
        $this->addSql('ALTER TABLE availability DROP barber_id');
    }
}

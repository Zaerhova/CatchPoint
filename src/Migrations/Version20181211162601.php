<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181211162601 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parcours CHANGE lat lat NUMERIC(10, 5) NOT NULL, CHANGE `long` `long` NUMERIC(10, 5) NOT NULL');
        $this->addSql('ALTER TABLE points CHANGE lat lat NUMERIC(10, 5) NOT NULL, CHANGE lng lng NUMERIC(10, 5) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parcours CHANGE lat lat NUMERIC(10, 2) NOT NULL, CHANGE `long` `long` NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE points CHANGE lat lat NUMERIC(10, 2) NOT NULL, CHANGE lng lng NUMERIC(10, 2) NOT NULL');
    }
}

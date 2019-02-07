<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130070839 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE point_trouve (id INT AUTO_INCREMENT NOT NULL, point_id INT DEFAULT NULL, score_id INT DEFAULT NULL, trouve TINYINT(1) DEFAULT NULL, INDEX IDX_BE04ACECC028CEA2 (point_id), INDEX IDX_BE04ACEC12EB0A51 (score_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE point_trouve ADD CONSTRAINT FK_BE04ACECC028CEA2 FOREIGN KEY (point_id) REFERENCES points (id)');
        $this->addSql('ALTER TABLE point_trouve ADD CONSTRAINT FK_BE04ACEC12EB0A51 FOREIGN KEY (score_id) REFERENCES score (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE point_trouve');
    }
}

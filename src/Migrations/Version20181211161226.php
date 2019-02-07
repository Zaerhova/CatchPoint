<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181211161226 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, nom_parcours VARCHAR(255) NOT NULL, longueur_parcours NUMERIC(10, 2) NOT NULL, type_parcours VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, lat NUMERIC(10, 2) NOT NULL, `long` INT NOT NULL, zoom INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours_user (parcours_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1D5670836E38C0DB (parcours_id), INDEX IDX_1D567083A76ED395 (user_id), PRIMARY KEY(parcours_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE points (id INT AUTO_INCREMENT NOT NULL, parcours_id INT NOT NULL, titre VARCHAR(255) NOT NULL, lat NUMERIC(10, 2) NOT NULL, lng NUMERIC(10, 2) NOT NULL, INDEX IDX_27BA8E296E38C0DB (parcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parcours_user ADD CONSTRAINT FK_1D5670836E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcours_user ADD CONSTRAINT FK_1D567083A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE points ADD CONSTRAINT FK_27BA8E296E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parcours_user DROP FOREIGN KEY FK_1D5670836E38C0DB');
        $this->addSql('ALTER TABLE points DROP FOREIGN KEY FK_27BA8E296E38C0DB');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE parcours_user');
        $this->addSql('DROP TABLE points');
    }
}

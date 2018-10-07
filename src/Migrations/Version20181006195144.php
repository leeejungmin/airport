<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181006195144 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, volnum_id INT DEFAULT NULL, INDEX IDX_3BEFE8DD73ED081E (volnum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pilote (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passenger ADD CONSTRAINT FK_3BEFE8DD73ED081E FOREIGN KEY (volnum_id) REFERENCES vol (id)');
        $this->addSql('ALTER TABLE vol ADD pilote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBF510AAE9 FOREIGN KEY (pilote_id) REFERENCES pilote (id)');
        $this->addSql('CREATE INDEX IDX_95C97EBF510AAE9 ON vol (pilote_id)');
        $this->addSql('ALTER TABLE vollist DROP passenger, DROP pilot, DROP depart, DROP arrive');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBF510AAE9');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE pilote');
        $this->addSql('DROP INDEX IDX_95C97EBF510AAE9 ON vol');
        $this->addSql('ALTER TABLE vol DROP pilote_id');
        $this->addSql('ALTER TABLE vollist ADD passenger VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD pilot VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD depart INT DEFAULT NULL, ADD arrive INT DEFAULT NULL');
    }
}

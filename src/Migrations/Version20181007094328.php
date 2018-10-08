<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181007094328 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_vol (user_id INT NOT NULL, vol_id INT NOT NULL, INDEX IDX_E24AF660A76ED395 (user_id), INDEX IDX_E24AF6609F2BFB7A (vol_id), PRIMARY KEY(user_id, vol_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_vol ADD CONSTRAINT FK_E24AF660A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_vol ADD CONSTRAINT FK_E24AF6609F2BFB7A FOREIGN KEY (vol_id) REFERENCES vol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vol ADD pilote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBF510AAE9 FOREIGN KEY (pilote_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_95C97EBF510AAE9 ON vol (pilote_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_vol');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBF510AAE9');
        $this->addSql('DROP INDEX IDX_95C97EBF510AAE9 ON vol');
        $this->addSql('ALTER TABLE vol DROP pilote_id');
    }
}

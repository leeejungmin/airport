<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181006202933 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE passenger_vol (passenger_id INT NOT NULL, vol_id INT NOT NULL, INDEX IDX_5F15684A4502E565 (passenger_id), INDEX IDX_5F15684A9F2BFB7A (vol_id), PRIMARY KEY(passenger_id, vol_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passenger_vol ADD CONSTRAINT FK_5F15684A4502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE passenger_vol ADD CONSTRAINT FK_5F15684A9F2BFB7A FOREIGN KEY (vol_id) REFERENCES vol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE passenger DROP FOREIGN KEY FK_3BEFE8DD73ED081E');
        $this->addSql('DROP INDEX IDX_3BEFE8DD73ED081E ON passenger');
        $this->addSql('ALTER TABLE passenger CHANGE volnum_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE passenger ADD CONSTRAINT FK_3BEFE8DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BEFE8DDA76ED395 ON passenger (user_id)');
        $this->addSql('ALTER TABLE pilote DROP FOREIGN KEY FK_6A3254DD4502E565');
        $this->addSql('DROP INDEX UNIQ_6A3254DD4502E565 ON pilote');
        $this->addSql('ALTER TABLE pilote DROP passenger_id, DROP volnumber');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EB73ED081E');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBF510AAE9');
        $this->addSql('DROP INDEX IDX_95C97EB73ED081E ON vol');
        $this->addSql('DROP INDEX IDX_95C97EBF510AAE9 ON vol');
        $this->addSql('ALTER TABLE vol ADD pilot_id INT DEFAULT NULL, ADD volnum VARCHAR(100) NOT NULL, DROP volnum_id, DROP pilote_id');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBCE55439B FOREIGN KEY (pilot_id) REFERENCES pilote (id)');
        $this->addSql('CREATE INDEX IDX_95C97EBCE55439B ON vol (pilot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE passenger_vol');
        $this->addSql('ALTER TABLE passenger DROP FOREIGN KEY FK_3BEFE8DDA76ED395');
        $this->addSql('DROP INDEX UNIQ_3BEFE8DDA76ED395 ON passenger');
        $this->addSql('ALTER TABLE passenger CHANGE user_id volnum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE passenger ADD CONSTRAINT FK_3BEFE8DD73ED081E FOREIGN KEY (volnum_id) REFERENCES vol (id)');
        $this->addSql('CREATE INDEX IDX_3BEFE8DD73ED081E ON passenger (volnum_id)');
        $this->addSql('ALTER TABLE pilote ADD passenger_id INT DEFAULT NULL, ADD volnumber VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DD4502E565 FOREIGN KEY (passenger_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A3254DD4502E565 ON pilote (passenger_id)');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBCE55439B');
        $this->addSql('DROP INDEX IDX_95C97EBCE55439B ON vol');
        $this->addSql('ALTER TABLE vol ADD pilote_id INT DEFAULT NULL, DROP volnum, CHANGE pilot_id volnum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EB73ED081E FOREIGN KEY (volnum_id) REFERENCES vollist (id)');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBF510AAE9 FOREIGN KEY (pilote_id) REFERENCES pilote (id)');
        $this->addSql('CREATE INDEX IDX_95C97EB73ED081E ON vol (volnum_id)');
        $this->addSql('CREATE INDEX IDX_95C97EBF510AAE9 ON vol (pilote_id)');
    }
}

<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181007093250 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE passenger_vol DROP FOREIGN KEY FK_5F15684A4502E565');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBCE55439B');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE passenger_vol');
        $this->addSql('DROP TABLE pilote');
        $this->addSql('DROP INDEX IDX_95C97EBCE55439B ON vol');
        $this->addSql('ALTER TABLE vol DROP pilot_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_3BEFE8DDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger_vol (passenger_id INT NOT NULL, vol_id INT NOT NULL, INDEX IDX_5F15684A4502E565 (passenger_id), INDEX IDX_5F15684A9F2BFB7A (vol_id), PRIMARY KEY(passenger_id, vol_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pilote (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_6A3254DDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passenger ADD CONSTRAINT FK_3BEFE8DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE passenger_vol ADD CONSTRAINT FK_5F15684A4502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE passenger_vol ADD CONSTRAINT FK_5F15684A9F2BFB7A FOREIGN KEY (vol_id) REFERENCES vol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vol ADD pilot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBCE55439B FOREIGN KEY (pilot_id) REFERENCES pilote (id)');
        $this->addSql('CREATE INDEX IDX_95C97EBCE55439B ON vol (pilot_id)');
    }
}

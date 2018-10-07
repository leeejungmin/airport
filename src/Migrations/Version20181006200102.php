<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181006200102 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pilote ADD user_id INT DEFAULT NULL, ADD passenger_id INT DEFAULT NULL, ADD volnumber VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DD4502E565 FOREIGN KEY (passenger_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A3254DDA76ED395 ON pilote (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A3254DD4502E565 ON pilote (passenger_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pilote DROP FOREIGN KEY FK_6A3254DDA76ED395');
        $this->addSql('ALTER TABLE pilote DROP FOREIGN KEY FK_6A3254DD4502E565');
        $this->addSql('DROP INDEX UNIQ_6A3254DDA76ED395 ON pilote');
        $this->addSql('DROP INDEX UNIQ_6A3254DD4502E565 ON pilote');
        $this->addSql('ALTER TABLE pilote DROP user_id, DROP passenger_id, DROP volnumber');
    }
}

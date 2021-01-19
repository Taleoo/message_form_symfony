<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210118152033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE temail (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tmsg (id INT AUTO_INCREMENT NOT NULL, id_emailmsg_id INT NOT NULL, subject VARCHAR(255) NOT NULL, msg LONGTEXT NOT NULL, INDEX IDX_52D26E6A8B4C9444 (id_emailmsg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tperson (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(45) DEFAULT NULL, last_name VARCHAR(45) DEFAULT NULL, phone VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tperson_temail (tperson_id INT NOT NULL, temail_id INT NOT NULL, INDEX IDX_B16856B0DB5AE27D (tperson_id), INDEX IDX_B16856B0865698D7 (temail_id), PRIMARY KEY(tperson_id, temail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tmsg ADD CONSTRAINT FK_52D26E6A8B4C9444 FOREIGN KEY (id_emailmsg_id) REFERENCES temail (id)');
        $this->addSql('ALTER TABLE tperson_temail ADD CONSTRAINT FK_B16856B0DB5AE27D FOREIGN KEY (tperson_id) REFERENCES tperson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tperson_temail ADD CONSTRAINT FK_B16856B0865698D7 FOREIGN KEY (temail_id) REFERENCES temail (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tmsg DROP FOREIGN KEY FK_52D26E6A8B4C9444');
        $this->addSql('ALTER TABLE tperson_temail DROP FOREIGN KEY FK_B16856B0865698D7');
        $this->addSql('ALTER TABLE tperson_temail DROP FOREIGN KEY FK_B16856B0DB5AE27D');
        $this->addSql('DROP TABLE temail');
        $this->addSql('DROP TABLE tmsg');
        $this->addSql('DROP TABLE tperson');
        $this->addSql('DROP TABLE tperson_temail');
    }
}

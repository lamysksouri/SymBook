<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513143938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_livre (id INT AUTO_INCREMENT NOT NULL, quntite INT NOT NULL, client_id INT NOT NULL, livres_id INT DEFAULT NULL, INDEX IDX_F0ED32E19EB6921 (client_id), INDEX IDX_F0ED32EEBF07F38 (livres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE client_livre ADD CONSTRAINT FK_F0ED32E19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client_livre ADD CONSTRAINT FK_F0ED32EEBF07F38 FOREIGN KEY (livres_id) REFERENCES livres (id)');
        $this->addSql('ALTER TABLE commande ADD etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_livre DROP FOREIGN KEY FK_F0ED32E19EB6921');
        $this->addSql('ALTER TABLE client_livre DROP FOREIGN KEY FK_F0ED32EEBF07F38');
        $this->addSql('DROP TABLE client_livre');
        $this->addSql('ALTER TABLE commande DROP etat');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}

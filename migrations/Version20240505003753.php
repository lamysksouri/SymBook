<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505003753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date_commande DATE NOT NULL, etat TINYINT(1) NOT NULL, utilisateur VARCHAR(255) NOT NULL, adresse_livraison VARCHAR(255) NOT NULL, total DOUBLE PRECISION NOT NULL, mode_paiement VARCHAR(255) NOT NULL, frais_livrasion VARCHAR(255) DEFAULT NULL, remis DOUBLE PRECISION DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, numero_tracking VARCHAR(255) DEFAULT NULL, transporteur VARCHAR(255) NOT NULL, date_livraison DATE NOT NULL, adresse_facturation VARCHAR(255) NOT NULL, adresse_facturtion VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, no VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commande_livres (commande_id INT NOT NULL, livres_id INT NOT NULL, INDEX IDX_90257C7182EA2E54 (commande_id), INDEX IDX_90257C71EBF07F38 (livres_id), PRIMARY KEY(commande_id, livres_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE commande_livres ADD CONSTRAINT FK_90257C7182EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_livres ADD CONSTRAINT FK_90257C71EBF07F38 FOREIGN KEY (livres_id) REFERENCES livres (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_livres DROP FOREIGN KEY FK_90257C7182EA2E54');
        $this->addSql('ALTER TABLE commande_livres DROP FOREIGN KEY FK_90257C71EBF07F38');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_livres');
    }
}

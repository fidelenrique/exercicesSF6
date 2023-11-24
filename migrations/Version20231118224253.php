<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231118224253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, geo_point VARCHAR(255) NOT NULL, geo_shape VARCHAR(255) NOT NULL, objectid VARCHAR(255) NOT NULL, id_ref_zdl VARCHAR(255) NOT NULL, gares_id VARCHAR(255) NOT NULL, nom_gare VARCHAR(255) NOT NULL, nomlong VARCHAR(255) NOT NULL, nom_iv VARCHAR(255) NOT NULL, num_mod VARCHAR(255) NOT NULL, mode_ VARCHAR(255) NOT NULL, fer VARCHAR(255) NOT NULL, train VARCHAR(255) NOT NULL, rer VARCHAR(255) NOT NULL, metro VARCHAR(255) NOT NULL, tramway VARCHAR(255) NOT NULL, navette VARCHAR(255) NOT NULL, val VARCHAR(255) NOT NULL, terfer VARCHAR(255) NOT NULL, tertrain VARCHAR(255) NOT NULL, terrer VARCHAR(255) NOT NULL, termetro VARCHAR(255) NOT NULL, tertram VARCHAR(255) NOT NULL, ternavette VARCHAR(255) NOT NULL, terval VARCHAR(255) NOT NULL, idrefliga VARCHAR(255) NOT NULL, idrefligc VARCHAR(255) DEFAULT NULL, ligne VARCHAR(255) NOT NULL, cod_ligf VARCHAR(255) NOT NULL, ligne_code VARCHAR(255) NOT NULL, indice_lig VARCHAR(255) NOT NULL, reseau VARCHAR(255) NOT NULL, res_com VARCHAR(255) NOT NULL, cod_resf VARCHAR(255) NOT NULL, res_stif VARCHAR(255) NOT NULL, exploitant VARCHAR(255) NOT NULL, num_psr VARCHAR(255) NOT NULL, idf VARCHAR(255) NOT NULL, principal VARCHAR(255) NOT NULL, x VARCHAR(255) NOT NULL, y VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

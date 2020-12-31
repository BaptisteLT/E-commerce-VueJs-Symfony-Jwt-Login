<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200907133406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, nom_prenom VARCHAR(70) NOT NULL, adresse_ligne1 VARCHAR(255) NOT NULL, adresse_ligne2 VARCHAR(255) DEFAULT NULL, ville VARCHAR(50) NOT NULL, etat_province_region VARCHAR(255) NOT NULL, code_postal VARCHAR(20) NOT NULL, instructions LONGTEXT DEFAULT NULL, code_acces VARCHAR(50) DEFAULT NULL, INDEX IDX_C35F0816A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coloris_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, couleur VARCHAR(255) DEFAULT NULL, image LONGTEXT NOT NULL, INDEX IDX_EA0B6ED5F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_achat (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, nombre INT NOT NULL, INDEX IDX_68295E2519EB6921 (client_id), INDEX IDX_68295E25F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, type_produit_id INT DEFAULT NULL, collection_produit_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_29A5EC271237A8DE (type_produit_id), INDEX IDX_29A5EC27ACAE563F (collection_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_user (produit_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A40BABA6F347EFB (produit_id), INDEX IDX_A40BABA6A76ED395 (user_id), PRIMARY KEY(produit_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tel_fix_prefix (id INT AUTO_INCREMENT NOT NULL, prefix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tel_fixe (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tel_fix_prefix_id INT NOT NULL, numero INT NOT NULL, INDEX IDX_D2B68A23A76ED395 (user_id), INDEX IDX_D2B68A234650BDC5 (tel_fix_prefix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tel_portable (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tel_portable_prefix_id INT DEFAULT NULL, numero INT NOT NULL, INDEX IDX_BC6555CAA76ED395 (user_id), INDEX IDX_BC6555CA394FFFB9 (tel_portable_prefix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tel_portable_prefix (id INT AUTO_INCREMENT NOT NULL, prefix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(20) DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, phone_number VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE coloris_produit ADD CONSTRAINT FK_EA0B6ED5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE historique_achat ADD CONSTRAINT FK_68295E2519EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE historique_achat ADD CONSTRAINT FK_68295E25F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC271237A8DE FOREIGN KEY (type_produit_id) REFERENCES type_produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27ACAE563F FOREIGN KEY (collection_produit_id) REFERENCES collection_produit (id)');
        $this->addSql('ALTER TABLE produit_user ADD CONSTRAINT FK_A40BABA6F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_user ADD CONSTRAINT FK_A40BABA6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tel_fixe ADD CONSTRAINT FK_D2B68A23A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tel_fixe ADD CONSTRAINT FK_D2B68A234650BDC5 FOREIGN KEY (tel_fix_prefix_id) REFERENCES tel_fix_prefix (id)');
        $this->addSql('ALTER TABLE tel_portable ADD CONSTRAINT FK_BC6555CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tel_portable ADD CONSTRAINT FK_BC6555CA394FFFB9 FOREIGN KEY (tel_portable_prefix_id) REFERENCES tel_portable_prefix (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27ACAE563F');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A6E44244');
        $this->addSql('ALTER TABLE coloris_produit DROP FOREIGN KEY FK_EA0B6ED5F347EFB');
        $this->addSql('ALTER TABLE historique_achat DROP FOREIGN KEY FK_68295E25F347EFB');
        $this->addSql('ALTER TABLE produit_user DROP FOREIGN KEY FK_A40BABA6F347EFB');
        $this->addSql('ALTER TABLE tel_fixe DROP FOREIGN KEY FK_D2B68A234650BDC5');
        $this->addSql('ALTER TABLE tel_portable DROP FOREIGN KEY FK_BC6555CA394FFFB9');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC271237A8DE');
        $this->addSql('ALTER TABLE historique_achat DROP FOREIGN KEY FK_68295E2519EB6921');
        $this->addSql('ALTER TABLE produit_user DROP FOREIGN KEY FK_A40BABA6A76ED395');
        $this->addSql('ALTER TABLE tel_fixe DROP FOREIGN KEY FK_D2B68A23A76ED395');
        $this->addSql('ALTER TABLE tel_portable DROP FOREIGN KEY FK_BC6555CAA76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE collection_produit');
        $this->addSql('DROP TABLE coloris_produit');
        $this->addSql('DROP TABLE historique_achat');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_user');
        $this->addSql('DROP TABLE tel_fix_prefix');
        $this->addSql('DROP TABLE tel_fixe');
        $this->addSql('DROP TABLE tel_portable');
        $this->addSql('DROP TABLE tel_portable_prefix');
        $this->addSql('DROP TABLE type_produit');
        $this->addSql('DROP TABLE user');
    }
}

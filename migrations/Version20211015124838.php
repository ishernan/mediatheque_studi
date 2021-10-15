<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211015124838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE borrow (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', borrow_date DATETIME NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_55DBA8B0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE borrow_details (id INT AUTO_INCREMENT NOT NULL, borrow_id INT NOT NULL, item VARCHAR(255) NOT NULL, quantity INT NOT NULL, INDEX IDX_2CD60D0ED4C006C8 (borrow_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE borrow_details ADD CONSTRAINT FK_2CD60D0ED4C006C8 FOREIGN KEY (borrow_id) REFERENCES borrow (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrow_details DROP FOREIGN KEY FK_2CD60D0ED4C006C8');
        $this->addSql('DROP TABLE borrow');
        $this->addSql('DROP TABLE borrow_details');
    }
}

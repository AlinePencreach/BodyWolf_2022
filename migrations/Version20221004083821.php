<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004083821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle_permission (salle_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_8BC56732DC304035 (salle_id), INDEX IDX_8BC56732FED90CCA (permission_id), PRIMARY KEY(salle_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salle_permission ADD CONSTRAINT FK_8BC56732DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_permission ADD CONSTRAINT FK_8BC56732FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission_salle DROP FOREIGN KEY FK_9810132FDC304035');
        $this->addSql('ALTER TABLE permission_salle DROP FOREIGN KEY FK_9810132FFED90CCA');
        $this->addSql('DROP TABLE permission_salle');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permission_salle (permission_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_9810132FDC304035 (salle_id), INDEX IDX_9810132FFED90CCA (permission_id), PRIMARY KEY(permission_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE permission_salle ADD CONSTRAINT FK_9810132FDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission_salle ADD CONSTRAINT FK_9810132FFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_permission DROP FOREIGN KEY FK_8BC56732DC304035');
        $this->addSql('ALTER TABLE salle_permission DROP FOREIGN KEY FK_8BC56732FED90CCA');
        $this->addSql('DROP TABLE salle_permission');
    }
}

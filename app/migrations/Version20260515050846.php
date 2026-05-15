<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260515050846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE aboba SET updated_at = created_at, slug = id');

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aboba ALTER updated_at SET NOT NULL');
        $this->addSql('ALTER TABLE aboba ALTER slug SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDAA429E989D9B62 ON aboba (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_DDAA429E989D9B62');
        $this->addSql('ALTER TABLE aboba ALTER updated_at DROP NOT NULL');
        $this->addSql('ALTER TABLE aboba ALTER slug DROP NOT NULL');
    }
}

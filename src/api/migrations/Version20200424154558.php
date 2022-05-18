<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use RuntimeException;
use TheCodingMachine\FluidSchema\TdbmFluidSchema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200424154558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create products tables.';
    }

    public function up(Schema $schema): void
    {
        $db = new TdbmFluidSchema($schema);

        $db->table('product')
            ->column('id')->guid()->primaryKey()->comment('@UUID')
            ->column('product_id')->string(255)->notNull()
            ->column('product_name')->string(255)->notNull()
            ->column('part_number')->string(255)->notNull()
            ->column('price')->string(255)->notNull();
    }

    public function down(Schema $schema): void
    {
        throw new RuntimeException('Never rollback a migration!');
    }
}

<?php


use Phinx\Migration\AbstractMigration;

class CreateMediaTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        $table = $this->table('Media');
        $table->addColumn('mediaID', 'string', ['limit' => 255])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('localFile', 'string', ['limit' => 255])
            ->addColumn('type', 'string', ['limit' => 255])
            ->addColumn('ownerId', 'integer')
            ->addForeignKey('ownerId', 'User', ['id'],
                ['constraint' => 'media_owner'])
            ->addColumn('modifiedDate', 'datetime')
            ->addColumn('createdDate', 'datetime')
            ->create();

    }
}

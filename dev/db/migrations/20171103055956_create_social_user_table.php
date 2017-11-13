<?php


use Phinx\Migration\AbstractMigration;

class CreateSocialUserTable extends AbstractMigration
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
        $table = $this->table('SocialUser');
        $table->addColumn('socialId', 'string', ['limit' => 255])
            ->addColumn('firstName', 'string', ['limit' => 255])
            ->addColumn('lastName', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('profileURL', 'string', ['limit' => 255])
            ->addColumn('roles', 'string', ['limit' => 255])
            ->addColumn('modifiedDate', 'datetime')
            ->addColumn('createdDate', 'datetime')
            ->create();
    }
}

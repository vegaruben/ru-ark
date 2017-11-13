<?php


use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     */
    public function change()
    {
        // create the table
        $table = $this->table('User');
        $table->addColumn('firstName', 'string', ['limit' => 255])
			->addColumn('lastName', 'string', ['limit' => 255])
			->addColumn('email', 'string', ['limit' => 255])
			->addColumn('password', 'string', ['limit' => 255])
			->addColumn('roles', 'string', ['limit' => 255])			
			->addColumn('modifiedDate', 'datetime')
			->addColumn('createdDate', 'datetime')
			->create();
    }

    /**
     * Migrate Up.
     */
    public function up()
    {
		
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}

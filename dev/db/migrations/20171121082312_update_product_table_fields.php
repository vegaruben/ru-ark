<?php


use Phinx\Migration\AbstractMigration;

class UpdateProductTableFields extends AbstractMigration
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
        $table = $this->table('Product')
            ->addColumn('productType', 'string', ['limit' => 255, 'null'=>true])
            ->addColumn('vendor', 'string',  ['limit' => 255, 'null'=>true])
            ->addColumn('salePrice', 'float',  ['null'=>true])
            ->addColumn('regularPrice', 'float',  [ 'null'=>true])
            ->addColumn('requiresShipping', 'integer', ['null'=>true])
            ->addColumn('weightLbs', 'float', ['null'=>true])
            ->addColumn('HSTariffCode', 'string', ['limit' => 255, 'null'=>true])
            ->update();
    }
}

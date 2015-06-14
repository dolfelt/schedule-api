<?php

use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table("shifts");
        $table->addColumn('user_id', 'integer')
              ->addColumn('start_time', 'datetime')
              ->addColumn('end_time', 'datetime')
              ->addIndex(['user_id'])
              ->create();
    }
}

<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AuthMigration extends AbstractMigration
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
        // Table for storing login information
        $table = $this->table("logins");
        $table->addColumn('first_name', 'string', ['limit' => 60])
            ->addColumn('last_name', 'string', ['limit' => 60])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('password', 'datetime')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addIndex(['email'])
            ->create();

        // Table for user info and linking logins to accounts.
        $table = $this->table("users");
        $table
            ->addColumn('login_id', 'integer')
            ->addColumn('account_id', 'integer')
            ->addColumn('role', 'integer', ['limit' => MysqlAdapter::INT_TINY])
            ->addColumn('first_name', 'string', ['limit' => 60])
            ->addColumn('last_name', 'string', ['limit' => 60])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addIndex(['login_id', 'account_id'])
            ->create();

    }
}

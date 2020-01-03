<?php

use Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersRolesTable extends Migration
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
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $this->schema->create('roles', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->increments('id');
            $table->string('role',50);
        });

        $this->schema->table('users', function (Illuminate\Database\Schema\Blueprint $table) {
            // Auto-increment id
            $table->unsignedInteger('role_id');
        });
    }
    public function down()
    {
       $this->schema->drop('roles');
    }
}

<?php


use Phinx\Seed\AbstractSeed;

class CreateUsersRolesTableSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $this->insert('roles', ['role' => 'superadmin']);
        $this->insert('roles', ['role' => 'editor']);
    }
}

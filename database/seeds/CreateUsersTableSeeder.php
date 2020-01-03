<?php


use Phinx\Seed\AbstractSeed;

class CreateUsersTableSeeder extends AbstractSeed
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
        $now = date('Y-m-d H:i:s', time());
        $this->insert('users', ['name' => 'Aleix', 'email'=>'alemasar@gmail.com', 'created_at'=>$now, 'updated_at'=>$now, 'password'=>hash('gost', 'Meridiana_123'.'Aleix'.$now), 'role_id'=>1]);
    }
}

<?php
namespace Migrations;

use Selective\Config\Configuration;
use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var \Illuminate\Database\Schema\Builder $schema */
    public $schema;
    public function init()
    {
        $settings = new Configuration(require __DIR__ . '/../config/settings.php');
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => $settings->getString('db.driver'),
            'host' => $settings->getString('db.host'),
            'port' => '3306',
            'database' => $settings->getString('db.database'),
            'username' => $settings->getString('db.username'),
            'password' => $settings->getString('db.password'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);
        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}

<?php

namespace Azzarip\Keap\Tests;

use Azzarip\Keap\KeapServiceProvider;
use Azzarip\Keap\Tests\Classes\Contact;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public $contact;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase(app());

    }

    protected function getPackageProviders($app)
    {
        return [
            KeapServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

    }

    protected function setUpDatabase($app)
    {
        $schema = $app['db']->connection()->getSchemaBuilder();

        $schema->create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->foreignId('keap_id')->nullable();
        });
    }
}

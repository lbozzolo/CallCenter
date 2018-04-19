<?php

use SmartLine\User as User;
use Faker\Factory as Faker;
use Bican\Roles\Models\Role;


class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * @return static
     */
    public function createUser($role = 'superadmin')
    {
        $faker = Faker::create();
        $user = User::create([
            'nombre' => $faker->name,
            'apellido' => $faker->lastName,
            'email' => $faker->email,
            'estado_id' => '1',
            'password' => bcrypt('123456'),
        ]);

        $roleAttached = Role::where('slug', '=', $role)->first();
        $user->attachRole($roleAttached);
        $user->save();

        $this->seeInDatabase('role_user', ['role_id' => $roleAttached->id, 'user_id' => $user->id]);

        return $user;
    }
}

<?php

use Illuminate\Database\Seeder;

class FakerSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(FakerUsersSeeder::class);
        $this->call(FakerClientesSeeder::class);
        $this->call(FakerProductosSeeder::class);
        $this->call(FakerVentasSeeder::class);
        $this->call(FakerLlamadasSeeder::class);

    }
}

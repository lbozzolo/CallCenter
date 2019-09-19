<?php

use Illuminate\Database\Seeder;

class FakerMarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert([
            ['nombre' => 'Alfa Romeo', 'descripcion' => '',],
            ['nombre' => 'Audi', 'descripcion' => '',],
            ['nombre' => 'BAIC', 'descripcion' => '',],
            ['nombre' => 'BMW', 'descripcion' => '',],
            ['nombre' => 'Chery', 'descripcion' => '',],
            ['nombre' => 'Chevrolet', 'descripcion' => '',],
            ['nombre' => 'Chrysler', 'descripcion' => '',],
            ['nombre' => 'Citroën', 'descripcion' => '',],
            ['nombre' => 'Coefix', 'descripcion' => '',],
            ['nombre' => 'DFSK', 'descripcion' => '',],
            ['nombre' => 'Daewoo', 'descripcion' => '',],
            ['nombre' => 'DS', 'descripcion' => '',],
            ['nombre' => 'Dodge', 'descripcion' => '',],
            ['nombre' => 'Datsun', 'descripcion' => '',],
            ['nombre' => 'Ferrari', 'descripcion' => '',],
            ['nombre' => 'Ford', 'descripcion' => '',],
            ['nombre' => 'Fiat', 'descripcion' => '',],
            ['nombre' => 'Foton', 'descripcion' => '',],
            ['nombre' => 'Geely', 'descripcion' => '',],
            ['nombre' => 'Honda', 'descripcion' => '',],
            ['nombre' => 'Hyundai', 'descripcion' => '',],
            ['nombre' => 'Isuzu', 'descripcion' => '',],
            ['nombre' => 'Jeep', 'descripcion' => '',],
            ['nombre' => 'Kia', 'descripcion' => '',],
            ['nombre' => 'Land Rover', 'descripcion' => '',],
            ['nombre' => 'Lifan', 'descripcion' => '',],
            ['nombre' => 'Maserati', 'descripcion' => '',],
            ['nombre' => 'Mazda', 'descripcion' => '',],
            ['nombre' => 'Mercedes Benz', 'descripcion' => '',],
            ['nombre' => 'Mini', 'descripcion' => '',],
            ['nombre' => 'Mitsubishi', 'descripcion' => '',],
            ['nombre' => 'Nissan', 'descripcion' => '',],
            ['nombre' => 'Peugeot', 'descripcion' => '',],
            ['nombre' => 'Porsche', 'descripcion' => '',],
            ['nombre' => 'Ram', 'descripcion' => '',],
            ['nombre' => 'Renault', 'descripcion' => '',],
            ['nombre' => 'Rover', 'descripcion' => '',],
            ['nombre' => 'Saab', 'descripcion' => '',],
            ['nombre' => 'Smart', 'descripcion' => '',],
            ['nombre' => 'Susuki', 'descripcion' => '',],
            ['nombre' => 'Seat', 'descripcion' => '',],
            ['nombre' => 'Saangyong', 'descripcion' => '',],
            ['nombre' => 'Shineray', 'descripcion' => '',],
            ['nombre' => 'Subaru', 'descripcion' => '',],
            ['nombre' => 'Tata', 'descripcion' => '',],
            ['nombre' => 'Toyota', 'descripcion' => '',],
            ['nombre' => 'Volkswagen', 'descripcion' => '',],
            ['nombre' => 'Volvo', 'descripcion' => '',],
        ]);
    }
}

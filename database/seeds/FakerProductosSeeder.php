<?php

use Illuminate\Database\Seeder;
use SmartLine\Entities\Producto;
use SmartLine\Entities\Marca;
use Faker\Factory as Faker;
use SmartLine\Entities\Categoria;
use SmartLine\Entities\Institucion;

class FakerProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFakerProductos(25);
    }

    private function createFakerProductos($cantidad)
    {
        $faker = Faker::create();
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $categoriasTotal = $categorias->count();
        $institucion = Institucion::all();

        for ($i = 0; $i <= $cantidad; $i++) {
            $fecha = $faker->dateTime;
            $producto = Producto::create([
                'nombre' => $faker->word,
                'descripcion' => $faker->text,
                'fecha_inicio' => $faker->dateTime,
                'fecha_finalizacion' => $faker->dateTime,
                'estado_id' => rand(1, 2),
                'unidad_medida_id' => rand(1, 4),
                'cantidad_medida' => rand(1, 100),
                'stock' => rand(0, 1000),
                'alerta_stock' => rand(1, 1000),
                'marca_id' => ($marcas->count() != 0)? $marcas->random()->id : null,
                'precio' => rand(0, 9000),
                'institucion_id' => ($institucion->count() > 0)? $institucion->random()->id : null,
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);

            for($b = rand(1, $categoriasTotal); $b <= $categoriasTotal; $b++){
                $cat = $categorias->random();
                if(!$producto->categorias()->where('categoria_id', '=', $cat->id)->first()){
                    $producto->categorias()->attach($cat);
                }
            }

        }
    }
}

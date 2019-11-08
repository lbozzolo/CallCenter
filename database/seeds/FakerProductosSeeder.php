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
        //$this->createFakerProductos(25);
        $this->createFakerCursos();
    }

    private function createFakerProductos($cantidad)
    {
        $faker = Faker::create('es_AR');
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

    private function createFakerCursos()
    {
        $faker = Faker::create('es_AR');
        $categoria = Categoria::where('slug', 'cursos')->first();
        $coefix = Marca::where('nombre', 'Coefix')->first();
        $institucion = Institucion::all();

        $courses = [0 => 'Instalación de Cámaras de Seguridad I', 1 => 'Instalación de Cámaras de Seguridad II', 2 => 'Administración de Empresas', 3 => 'Administración de PYMES', 4 => 'Marketing Digital I', 5 => 'Marketing Digital II'];

        foreach ($courses as $key => $course) {

            $fecha = $faker->dateTime;
            $curso = Producto::create([
                'nombre' => $course,
                'descripcion' => $faker->text,
                'fecha_inicio' => $faker->dateTime,
                'fecha_finalizacion' => $faker->dateTime,
                'estado_id' => 1,
                'unidad_medida_id' => rand(1, 4),
                'cantidad_medida' => rand(1, 100),
                'stock' => rand(0, 1000),
                'alerta_stock' => rand(1, 1000),
                'marca_id' => $coefix->id,
                'precio' => rand(19000, 24000),
                'institucion_id' => ($institucion->count() > 0)? $institucion->random()->id : null,
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);

            $curso->categorias()->attach($categoria);

        }
    }
}

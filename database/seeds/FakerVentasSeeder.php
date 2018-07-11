<?php

use Illuminate\Database\Seeder;
use SmartLine\Entities\Venta;
use SmartLine\Entities\Producto;
use SmartLine\User;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\MetodoPago;
use SmartLine\Entities\FormaPago;
use SmartLine\Entities\Etapa;
use SmartLine\Entities\Promocion;
use Faker\Factory as Faker;

class FakerVentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFakerVentas(25);
    }

    private function createFakerVentas($cantidad)
    {
        $faker = Faker::create();
        $users = User::all();
        $clientes = Cliente::all();
        $productos = Producto::all();
        $estadosVentas = EstadoVenta::all();
        $metodosPago = MetodoPago::all();
        $formasPago = FormaPago::all();
        $etapas = Etapa::all();
        $promociones = Promocion::all();

        for ($i = 0; $i <= $cantidad; $i++) {
            $fecha = $faker->dateTime;
            Venta::create([
                'user_id' => ($users->count() > 0)? $users->random()->id : null,
                'cliente_id' => ($clientes->count() > 0)? $clientes->random()->id : null,
                'estado_id' => ($estadosVentas->count() > 0)? $estadosVentas->random()->id : null,
                'metodo_pago_id' => ($metodosPago->count() > 0)? $metodosPago->random()->id : null,
                'forma_pago_id' => ($formasPago->count() > 0)? $formasPago->random()->id : null,
                'etapa_id' => ($etapas->count() > 0)? $etapas->random()->id : null,
                'promocion_id' => ($promociones->count() > 0)? $promociones->random()->id : null,
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);


        }

        $ventas = Venta::all();

        foreach ($ventas as $venta){

            $max = rand(1, 3);
            for($i = 1; $i <= $max; $i++){
                $venta->productos()->save($productos->random());
            }

        }

    }

}

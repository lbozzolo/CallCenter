<?php

use Illuminate\Database\Seeder;

class FormaPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tarjetas = \SmartLine\Entities\MarcaTarjeta::where('tipo', 'credito')->get();
        $bancos = \SmartLine\Entities\Banco::all();
        $cuotas = config('sistema.ventas.cuotas');

        foreach ($tarjetas as $tarjeta){

            foreach ($bancos as $banco) {

                foreach ($cuotas as $cuota) {

                    DB::table('forma_pago')->insert([
                        [
                            'marca_tarjeta_id' => $tarjeta->id,
                            'banco_id' => $banco->id,
                            'cuota_cantidad' => $cuota,
                            'interes' => null,
                            'descuento' => null
                        ],
                    ]);

                }

            }

        }

    }
}

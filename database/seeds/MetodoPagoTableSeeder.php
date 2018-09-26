<?php

use Illuminate\Database\Seeder;

class MetodoPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metodo_pago')->insert([
            ['nombre' => 'Efectivo', 'slug' => 'efectivo'],
            ['nombre' => 'Tarjeta de crédito', 'slug' => 'credito'],
            ['nombre' => 'Tarjeta de débito', 'slug' => 'debito'],
            ['nombre' => 'Cheque', 'slug' => 'cheque'],
            ['nombre' => 'Transferencia', 'slug' => 'transferencia'],
            ['nombre' => 'Mercado Pago', 'slug' => 'mercadopago'],
            ['nombre' => 'Todo Pago', 'slug' => 'todopago'],
            ['nombre' => 'Contra reembolso', 'slug' => 'contrareembolso'],
        ]);
    }
}

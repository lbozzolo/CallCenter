<?php

use Illuminate\Database\Seeder;

class BancosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bancos')->insert([
            ['nombre' => 'BANCO DE GALICIA Y BUENOS AIRES S.A.'],
            ['nombre' => 'BANCO DE LA NACION ARGENTINA'],
            ['nombre' => 'BANCO DE LA PROVINCIA DE BUENOS AIRES'],
            ['nombre' => 'CITIBANK N.A.'],
            ['nombre' => 'BBVA BANCO FRANCES S.A.'],
            ['nombre' => 'BANCO SUPERVIELLE S.A.'],
            ['nombre' => 'BANCO DE LA CIUDAD DE BUENOS AIRES'],
            ['nombre' => 'BANCO PATAGONIA S.A.'],
            ['nombre' => 'BANCO HIPOTECARIO S.A.'],
            ['nombre' => 'BANCO DE SAN JUAN S.A.'],
            ['nombre' => 'BANCO DEL TUCUMAN S.A.'],
            ['nombre' => 'BANCO SANTANDER RIO S.A.'],
            ['nombre' => 'HSBC BANK ARGENTINA S.A.'],
            ['nombre' => 'BANCO CREDICOOP COOPERATIVO LIMITADO'],
            ['nombre' => 'BANCO ITAU ARGENTINA S.A.'],
            ['nombre' => 'BNP PARIBAS'],
            ['nombre' => 'BANCO MACRO S.A.'],
            ['nombre' => 'BANCO COMAFI SOCIEDAD ANONIMA'],
     ]);
    }
}

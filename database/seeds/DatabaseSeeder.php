<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UnidadesMedidaTableSeeder::class);
        $this->call(EstadosClientesTableSeeder::class);
        $this->call(EstadosInstitucionesTableSeeder::class);
        $this->call(EstadosProductosTableSeeder::class);
        $this->call(EstadosReclamosTableSeeder::class);
        $this->call(EstadosUsersTableSeeder::class);
        $this->call(EstadosVentasTableSeeder::class);
        $this->call(BancosTableSeeder::class);
        $this->call(MarcasTarjetasTableSeeder::class);
        $this->call(FormaPagoTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(SuperAdminPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(ResultadosLlamadasTableSeeder::class);
        $this->call(MetodoPagoTableSeeder::class);
        $this->call(LocalidadesPartidosProvinciasSeeder::class);
        $this->call(TicketsLevelsTableSeeder::class);
        $this->call(EstadosTicketsSeeder::class);

        Model::reguard();
    }
}

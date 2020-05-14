<?php

use App\Project;
use App\Standard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Initial Projects

        Project::insert([/* id => 1 */'name' => 'Tuneles']);
        Project::insert([/* id => 2 */'name' => 'Aracataca']);


        // Create Standards

        Standard::insert([/* id => 1 */'name' => 'Gestión Ambiental (14001)']);
        Standard::insert([/* id => 2 */'name' => 'SST (45001)']);
        Standard::insert([/* id => 3 */'name' => 'Gestión de la Energía (50001)']);

        Standard::insert([/* id => 4 */'name' => 'Vehículos', 'standard_id' => 3]);
        Standard::insert([/* id => 5 */'name' => 'Generadores de gasolina', 'standard_id' => 3]);
        Standard::insert([/* id => 6 */'name' => 'Plataformas Manlif', 'standard_id' => 3]);


        // Create Relationshipt between Projects and Standards

        DB::table('project_standard')->insert([/* id => 1 */'project_id' => 1, 'standard_id' => 1]);
        DB::table('project_standard')->insert([/* id => 2 */'project_id' => 1, 'standard_id' => 2]);
        DB::table('project_standard')->insert([/* id => 3 */'project_id' => 1, 'standard_id' => 3]);

        DB::table('project_standard')->insert([/* id => 4 */'project_id' => 2, 'standard_id' => 1]);
        DB::table('project_standard')->insert([/* id => 5 */'project_id' => 2, 'standard_id' => 2]);
        DB::table('project_standard')->insert([/* id => 6 */'project_id' => 2, 'standard_id' => 3]);


        // Placa numbers

        DB::table('no_placas')->insert([/* id => 1 */'name' => 'Placa 1']);
        DB::table('no_placas')->insert([/* id => 2 */'name' => 'Placa 2']);
        DB::table('no_placas')->insert([/* id => 3 */'name' => 'Placa 3']);

        // Bombas de abastecimiento

        DB::table('bombas_abastecimiento')->insert([/* id => 1 */'name' => 'Bomba 1']);
        DB::table('bombas_abastecimiento')->insert([/* id => 2 */'name' => 'Bomba 2']);
        DB::table('bombas_abastecimiento')->insert([/* id => 3 */'name' => 'Bomba 3']);

        // Sistemas de amortiguacion

        DB::table('sistemas_amortiguacion')->insert([/* id => 1 */'name' => 'Sistema amortiguación 1']);
        DB::table('sistemas_amortiguacion')->insert([/* id => 2 */'name' => 'Sistema amortiguación 2']);
        DB::table('sistemas_amortiguacion')->insert([/* id => 3 */'name' => 'Sistema amortiguación 3']);

        // Estados de medicion

        DB::table('estados_medicion')->insert([/* id => 1 */'name' => 'Estado medición 1']);
        DB::table('estados_medicion')->insert([/* id => 2 */'name' => 'Estado medición 2']);
        DB::table('estados_medicion')->insert([/* id => 3 */'name' => 'Estado medición 3']);

        // Generadores de gasolina

        DB::table('generadores_gasolina')->insert([/* id => 1 */'name' => 'Generador gasolina 1']);
        DB::table('generadores_gasolina')->insert([/* id => 2 */'name' => 'Generador gasolina 2']);
        DB::table('generadores_gasolina')->insert([/* id => 3 */'name' => 'Generador gasolina 3']);
    }
}

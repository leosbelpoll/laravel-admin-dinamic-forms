<?php

use App\FieldTypeEnum;
use App\Project;
use App\SelectorEnum;
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
        // Initial Fields

        DB::table('fields')->insert([/* id => 1 */'name' => 'Peligrosos', 'label' => 'Peligrosos', 'type' => FieldTypeEnum::NUMBER, 'placeholder' => 'Kg', 'rules' => 'required']);
        DB::table('fields')->insert([/* id => 2 */'name' => 'Orgánicos', 'label' => 'Orgánicos', 'type' => FieldTypeEnum::NUMBER, 'placeholder' => 'Kg', 'rules' => 'required']);
        DB::table('fields')->insert([/* id => 3 */'name' => 'Plásticos', 'label' => 'Plásticos', 'type' => FieldTypeEnum::NUMBER, 'placeholder' => 'Kg', 'rules' => 'required']);
        DB::table('fields')->insert([/* id => 4 */'name' => 'Otros', 'label' => 'Otros', 'type' => FieldTypeEnum::NUMBER, 'placeholder' => 'Kg', 'rules' => 'required']);
        DB::table('fields')->insert([/* id => 5 */'name' => 'Impacto ambiental', 'label' => 'Describa el impacto ambiental de las actividades realizadas', 'type' => FieldTypeEnum::LONG_TEXT, 'rules' => 'required']);
        DB::table('fields')->insert([/* id => 6 */'name' => 'Generador de gasolina', 'label' => 'Cuál generador abasteció hoy?', 'type' => FieldTypeEnum::SELECTOR, 'selector' => SelectorEnum::GENERADOR_GASOLINA, 'placeholder' => 'No', 'rules' => 'required']);
        DB::table('fields')->insert([/* id => 7 */'name' => 'Galones comprados', 'label' => 'Galones comprados', 'type' => FieldTypeEnum::NUMBER, 'placeholder' => 'No', 'rules' => 'required']);
        DB::table('fields')->insert([/* id => 8 */'name' => 'Horas de uno?', 'label' => 'Horas de uno?', 'type' => FieldTypeEnum::NUMBER, 'placeholder' => 'No', 'rules' => 'required']);

        // Initial Forms

        DB::table('formularios')->insert([/* id => 1 */'name' => 'Norma ISO 14001', 'description' => 'Disposición de residuos (Incluir en la descripción de actividades)']);
        DB::table('formularios')->insert([/* id => 2 */'name' => 'Norma ISO 45001', 'description' => 'Disposición de residuos (Incluir en la descripción de actividades)']);
        DB::table('formularios')->insert([/* id => 3 */'name' => 'Generadores de Gasolina']);
        DB::table('formularios')->insert([/* id => 4 */'name' => 'Plataformas Manlift']);

        DB::table('field_formulario')->insert([/* id => 1 */'formulario_id' => 1, 'field_id' => 1]);
        DB::table('field_formulario')->insert([/* id => 2 */'formulario_id' => 1, 'field_id' => 2]);
        DB::table('field_formulario')->insert([/* id => 3 */'formulario_id' => 1, 'field_id' => 3]);
        DB::table('field_formulario')->insert([/* id => 4 */'formulario_id' => 1, 'field_id' => 4]);
        DB::table('field_formulario')->insert([/* id => 5 */'formulario_id' => 1, 'field_id' => 5]);

        DB::table('field_formulario')->insert([/* id => 6 */'formulario_id' => 2, 'field_id' => 1]);
        DB::table('field_formulario')->insert([/* id => 7 */'formulario_id' => 2, 'field_id' => 2]);
        DB::table('field_formulario')->insert([/* id => 8 */'formulario_id' => 2, 'field_id' => 3]);
        DB::table('field_formulario')->insert([/* id => 9 */'formulario_id' => 2, 'field_id' => 4]);
        DB::table('field_formulario')->insert([/* id => 10 */'formulario_id' => 2, 'field_id' => 5]);

        DB::table('field_formulario')->insert([/* id => 11 */'formulario_id' => 3, 'field_id' => 6]);
        DB::table('field_formulario')->insert([/* id => 12 */'formulario_id' => 3, 'field_id' => 7]);
        DB::table('field_formulario')->insert([/* id => 13 */'formulario_id' => 3, 'field_id' => 8]);

        DB::table('field_formulario')->insert([/* id => 14 */'formulario_id' => 4, 'field_id' => 6]);
        DB::table('field_formulario')->insert([/* id => 15 */'formulario_id' => 4, 'field_id' => 7]);
        DB::table('field_formulario')->insert([/* id => 16 */'formulario_id' => 4, 'field_id' => 8]);

        // Create Initial Projects

        Project::insert([/* id => 1 */'name' => 'Tuneles']);
        Project::insert([/* id => 2 */'name' => 'Aracataca']);


        // Create Standards

        Standard::insert([/* id => 1 */'name' => 'Gestión Ambiental (14001)', 'type' => 'FORM', 'formulario_id' => 1]);
        Standard::insert([/* id => 2 */'name' => 'SST (45001)', 'type' => 'FORM', 'formulario_id' => 2]);
        Standard::insert([/* id => 3 */'name' => 'Gestión de la Energía (50001)', 'type' => 'FORM']);

        Standard::insert([/* id => 4 */'name' => 'Vehículos', 'standard_id' => 3, 'type' => 'VEHICLE']);
        Standard::insert([/* id => 5 */'name' => 'Generadores de gasolina', 'standard_id' => 3, 'type' => 'FORM', 'formulario_id' => 3]);
        Standard::insert([/* id => 6 */'name' => 'Plataformas Manlif', 'standard_id' => 3, 'type' => 'FORM', 'formulario_id' => 4]);


        // Create Relationshipt between Projects and Standards

        DB::table('project_standard')->insert([/* id => 1 */'project_id' => 1, 'standard_id' => 1]);
        DB::table('project_standard')->insert([/* id => 2 */'project_id' => 1, 'standard_id' => 2]);
        DB::table('project_standard')->insert([/* id => 3 */'project_id' => 1, 'standard_id' => 3]);

        DB::table('project_standard')->insert([/* id => 4 */'project_id' => 2, 'standard_id' => 1]);
        DB::table('project_standard')->insert([/* id => 5 */'project_id' => 2, 'standard_id' => 2]);
        DB::table('project_standard')->insert([/* id => 6 */'project_id' => 2, 'standard_id' => 3]);



        // TODO: Remove FAKE data

        // Marcas

        DB::table('marcas')->insert([/* id => 1 */'name' => 'Ferrari']);
        DB::table('marcas')->insert([/* id => 2 */'name' => 'Tesla']);
        DB::table('marcas')->insert([/* id => 3 */'name' => 'Honda']);

        // Modelos

        DB::table('modelos')->insert([/* id => 1 */'name' => '488 GTB', 'marca_id' => 1]);
        DB::table('modelos')->insert([/* id => 2 */'name' => '812 Superfast', 'marca_id' => 1]);
        DB::table('modelos')->insert([/* id => 3 */'name' => 'Civic', 'marca_id' => 3]);
        DB::table('modelos')->insert([/* id => 4 */'name' => 'Jazz', 'marca_id' => 3]);
        DB::table('modelos')->insert([/* id => 5 */'name' => 'Roadster', 'marca_id' => 2]);
        DB::table('modelos')->insert([/* id => 6 */'name' => 'Cybertruck', 'marca_id' => 2]);

        // Tipos de Vehiculos

        DB::table('tipos_vehiculo')->insert([/* id => 1 */'name' => 'Tipo vehiculo 1']);
        DB::table('tipos_vehiculo')->insert([/* id => 2 */'name' => 'Tipo vehiculo 2']);
        DB::table('tipos_vehiculo')->insert([/* id => 3 */'name' => 'Tipo vehiculo 3']);

        // Tipos de combustible

        DB::table('tipos_combustible')->insert([/* id => 1 */'name' => 'Tipo de combustible 1']);
        DB::table('tipos_combustible')->insert([/* id => 2 */'name' => 'Tipo de combustible 2']);
        DB::table('tipos_combustible')->insert([/* id => 3 */'name' => 'Tipo de combustible 3']);

        // Automoviles

        DB::table('automoviles')->insert([/* id => 1 */'name' => 'Placa 1', 'marca_id' => 1, 'modelo_id' => 1, 'tipo_vehiculo_id' => 2, 'tipo_combustible_id' => 1, 'cilindraje' => 3000]);
        DB::table('automoviles')->insert([/* id => 2 */'name' => 'Placa 2', 'marca_id' => 1, 'modelo_id' => 2, 'tipo_vehiculo_id' => 1, 'tipo_combustible_id' => 3, 'cilindraje' => 2500]);
        DB::table('automoviles')->insert([/* id => 3 */'name' => 'Placa 3', 'marca_id' => 3, 'modelo_id' => 3, 'tipo_vehiculo_id' => 2, 'tipo_combustible_id' => 1, 'cilindraje' => 6000]);
        DB::table('automoviles')->insert([/* id => 4 */'name' => 'Placa 4', 'marca_id' => 2, 'modelo_id' => 5, 'tipo_vehiculo_id' => 3, 'tipo_combustible_id' => 2, 'cilindraje' => 1000]);
        DB::table('automoviles')->insert([/* id => 5 */'name' => 'Placa 5', 'marca_id' => 2, 'modelo_id' => 6, 'tipo_vehiculo_id' => 2, 'tipo_combustible_id' => 2, 'cilindraje' => 1300]);

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

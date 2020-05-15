<?php

namespace App\Admin\Controllers;

use App\BombaAbastecimiento;
use App\EstadoMedicion;
use App\NoPlaca;
use App\Project;
use App\SistemaAmortiguacion;
use App\Standard;
use App\User;
use App\Vehicle;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VehicleController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vehicle());

        $grid->user('Usuario')->display(function ($user) {
            if ($user) {
                return "<span>{$user['name']}</span>";
            }
        });

        $grid->project('Proyecto')->display(function ($project) {
            if ($project) {
                return "<span>{$project['name']}</span>";
            }
        });

        $grid->standard('Norma')->display(function ($standard) {
            if ($standard) {
                return "<span>{$standard['name']}</span>";
            }
        });

        $grid->noplaca('Número de placa')->display(function ($noPlaca) {
            if ($noPlaca) {
                return "<span>{$noPlaca['name']}</span>";
            }
        });

        $grid->column('recorrido_inicial', 'Recorrido inicial')->sortable();
        $grid->column('recorrido_final', 'Recorrido final')->sortable();
        $grid->column('galones_comprados', 'Galones comprados')->sortable();

        $grid->bombaabastecimiento('Bomba de abastecimiento')->display(function ($bombaAbastecimiento) {
            if ($bombaAbastecimiento) {
                return "<span>{$bombaAbastecimiento['name']}</span>";
            }
        });

        $grid->sistemaamortiguacion('Sistemas de amortiguación')->display(function ($sistemaAmortiguacion) {
            if ($sistemaAmortiguacion) {
                return "<span>{$sistemaAmortiguacion['name']}</span>";
            }
        });

        $grid->estadomedicion('Estado de medición')->display(function ($estadoMedicion) {
            if ($estadoMedicion) {
                return "<span>{$estadoMedicion['name']}</span>";
            }
        });

        $grid->column('presion_neumaticos', 'Presión de neumáticos')->sortable();

        $grid->model()->orderBy('id', 'asc');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Vehicle::findOrFail($id));

        $show->field('name', __('Título'));
        $show->field('description', __('Descripción'));
        $show->field('created_at', __('Creado'));
        $show->field('updated_at', __('Modificado'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Vehicle());

        $users = User::where('id', '>', 2)->pluck('name', 'id')->toArray();
        $form->select('user_id', 'Usuario')->options($users);

        $projects = Project::all()->pluck('name', 'id')->toArray();
        $form->select('project_id', 'Proyecto')->options($projects);

        $standards = Standard::all()->pluck('name', 'id')->toArray();
        $form->select('standard_id', 'Norma')->options($standards);

        $noPlacas = NoPlaca::all()->pluck('name', 'id')->toArray();
        $form->select('no_placa_id', 'Número de Placa')->options($noPlacas);

        $form->text('recorrido_inicial', 'Recorrido inicial')->pattern('[0-9]+')->placeholder('Km/h');

        $form->image('recorrido_inicial_image', 'Imagen del Recorrido inicial');

        $form->text('recorrido_final', 'Recorrido final')->pattern('[0-9]+')->placeholder('Km/h');

        $form->image('recorrido_final_image', 'Imagen del Recorrido final');

        $form->text('galones_comprados', 'Galones comprados')->pattern('[0-9]+')->placeholder('Cant');

        $form->image('galones_comprados_image', 'Imagen de los Galones comprados');

        $bombasAbastecimiento = BombaAbastecimiento::all()->pluck('name', 'id')->toArray();
        $form->select('bomba_abastecimiento_id', 'Bomba de abastecimiento')->options($bombasAbastecimiento);

        $sistemasAmortiguacion = SistemaAmortiguacion::all()->pluck('name', 'id')->toArray();
        $form->select('sistema_amortiguacion_id', 'Sistema de amortiguación')->options($sistemasAmortiguacion);

        $form->textarea('explicacion_capacitacion', 'Breve explicación de la capacitación de buenas prácticas de hoy')->rows(10)->placeholder('Escriba');

        $estadosMedicion = EstadoMedicion::all()->pluck('name', 'id')->toArray();
        $form->select('estado_medicion_id', 'Estado de Medición del Vehículo')->options($estadosMedicion);

        $form->text('presion_neumaticos', 'Presión de los neumáticos')->pattern('[0-9]+')->placeholder('Psi');

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Automovil;
use App\Marca;
use App\Modelo;
use App\TipoCombustible;
use App\TipoVehiculo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AutomovilController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Números de Placas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Automovil());

        $grid->disableExport();

        $grid->column('no_placa', 'Número de placa');

        $grid->marca('Marca')->display(function ($item) {
            if ($item) {
                return "<span>{$item['name']}</span>";
            }
        });

        $grid->modelo('Modelo')->display(function ($item) {
            if ($item) {
                return "<span>{$item['name']}</span>";
            }
        });

        $grid->column('tipovehiculo', 'Tipo de vehículo')->display(function ($item) {
            if ($item) {
                return "<span>{$item['name']}</span>";
            }
        });

        $grid->column('tipocombustible', 'Tipo de combustible')->display(function ($item) {
            if ($item) {
                return "<span>{$item['name']}</span>";
            }
        });

        $grid->column('cilindraje', 'Cilindraje');

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', 'name');
        });

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
        $show = new Show(Automovil::findOrFail($id));

        $show->field('no_placa', __('Número de Placa'));

        $show->field('marca_id', 'Marca')->as(function ($id) {
            $item = Marca::find($id);
            return $item->name;
        });

        $show->field('modelo_id', 'Modelo')->as(function ($id) {
            $item = Modelo::find($id);
            return $item->name;
        });

        $show->field('tipo_vehiculo_id', 'Tipo de Vehículo')->as(function ($id) {
            $item = TipoVehiculo::find($id);
            return $item->name;
        });

        $show->field('tipo_combustible_id', 'Tipo de combustible')->as(function ($id) {
            $item = TipoCombustible::find($id);
            return $item->name;
        });

        $show->field('cilindraje', __('Cilindraje'));

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
        $form = new Form(new Automovil());

        $form->text('no_placa', 'Número de placa')
            ->required()
            ->creationRules(['required', "unique:automoviles"])
            ->updateRules(['required', "unique:automoviles,no_placa,{{id}}"]);

        $marcas = Marca::all()->pluck('name', 'id')->toArray();
        $form->select('marca_id', 'Marca')->options($marcas)->required();

        $modelos = Modelo::all()->pluck('name', 'id')->toArray();
        $form->select('modelo_id', 'Modelo')->options($modelos)->required();

        $tiposVehiculo = TipoVehiculo::all()->pluck('name', 'id')->toArray();
        $form->select('tipo_vehiculo_id', 'Tipo de Vehículo')->options($tiposVehiculo)->required();

        $tiposCombustible = TipoCombustible::all()->pluck('name', 'id')->toArray();
        $form->select('tipo_combustible_id', 'Tipo de Combustible')->options($tiposCombustible)->required();

        $form->number('cilindraje', 'Cilindraje');

        $form->textarea('description', 'Descripción');

        return $form;
    }
}

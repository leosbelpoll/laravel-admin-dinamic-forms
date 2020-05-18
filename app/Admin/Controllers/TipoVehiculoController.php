<?php

namespace App\Admin\Controllers;

use App\TipoVehiculo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TipoVehiculoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tipos de vehículos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TipoVehiculo());

        $grid->disableExport();

        $grid->column('name', 'Nombre');
        $grid->column('description', 'Descripción');

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
        $show = new Show(TipoVehiculo::findOrFail($id));

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
        $form = new Form(new TipoVehiculo());

        $form->text('name', 'Título')
            ->required()
            ->creationRules(['required', "unique:tipos_vehiculo"])
            ->updateRules(['required', "unique:tipos_vehiculo,name,{{id}}"]);

        $form->textarea('description', 'Descripción');

        return $form;
    }
}

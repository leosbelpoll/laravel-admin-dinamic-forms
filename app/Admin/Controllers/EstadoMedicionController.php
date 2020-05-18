<?php

namespace App\Admin\Controllers;

use App\EstadoMedicion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EstadoMedicionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Estado de Medición';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EstadoMedicion());

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
        $show = new Show(EstadoMedicion::findOrFail($id));

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
        $form = new Form(new EstadoMedicion());

        $form->text('name', 'Título')
            ->required()
            ->creationRules(['required', "unique:estados_medicion"])
            ->updateRules(['required', "unique:estados_medicion,name,{{id}}"]);

        $form->textarea('description', 'Descripción');

        return $form;
    }
}

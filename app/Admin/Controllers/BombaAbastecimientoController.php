<?php

namespace App\Admin\Controllers;

use App\BombaAbastecimiento;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BombaAbastecimientoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Bombas de Abastecimiento';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BombaAbastecimiento());

        $grid->column('name')->sortable();
        $grid->column('description');

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
        $show = new Show(BombaAbastecimiento::findOrFail($id));

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
        $form = new Form(new BombaAbastecimiento());

        $form->text('name', 'Título')
            ->required()
            ->creationRules(['required', "unique:bombas_abastecimiento"])
            ->updateRules(['required', "unique:bombas_abastecimiento,name,{{id}}"]);

        $form->textarea('description', 'Descripción');

        return $form;
    }
}

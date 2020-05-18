<?php

namespace App\Admin\Controllers;

use App\Field;
use App\Formulario;
use App\Standard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormularioController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Formularios';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Formulario());

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });

        $grid->disableExport();

        $grid->column('name', __('Nombre'));
        $grid->column('description', __('Descripción'));

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
        $show = new Show(Formulario::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('standard_id', __('Standard id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Formulario());

        $form->text('name')
            ->required()
            ->creationRules(['required', "unique:formularios"])
            ->updateRules(['required', "unique:formularios,name,{{id}}"]);
        $form->text('description');

        $fields = Field::all()->pluck('name', 'id')->toArray();
        $form->multipleSelect('fields', 'Campos')->options($fields);

        return $form;
    }
}

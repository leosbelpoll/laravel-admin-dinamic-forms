<?php

namespace App\Admin\Controllers;

use App\Field;
use App\Formulario;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FieldController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Field';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Field());

        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('type', __('Type'));
        $grid->column('rules', __('Rules'));
        $grid->column('position', __('Position'));

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
        $show = new Show(Field::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('type', __('Type'));
        $show->field('rules', __('Rules'));
        $show->field('position', __('Position'));
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
        $form = new Form(new Field());

        $form->text('name')
            ->required()
            ->creationRules(['required', "unique:fields"])
            ->updateRules(['required', "unique:fields,name,{{id}}"]);
        $form->text('description', __('Descripción'));
        $form->select('type', __('Tipo'))
            ->options(['TEXT' => 'Texto', 'NUMBER' => 'Número', 'IMAGE' => 'Imágen'])
            ->required();
        $form->multipleSelect('rules', __('Reglas'))
            ->options(['required' => 'Requerido']);
        $form->number('position', __('Posición'));

        $formularios = Formulario::all()->pluck('name', 'id')->toArray();
        $form->multipleSelect('formularios', 'Formularios')->options($formularios);

        return $form;
    }
}

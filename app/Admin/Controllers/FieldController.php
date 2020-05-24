<?php

namespace App\Admin\Controllers;

use App\Model\Field;
use App\Model\FieldTypeEnum;
use App\Model\Formulario;
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
    protected $title = 'Campos';

    private $types = [
        FieldTypeEnum::NUMBER => 'Número',
        FieldTypeEnum::IMAGE => 'Imágen',
        FieldTypeEnum::SHORT_TEXT => 'Texto corto',
        FieldTypeEnum::LONG_TEXT => 'Texto largo',
        FieldTypeEnum::SELECTOR_OPTIONS => 'Selector',
        FieldTypeEnum::CHECK_OPTIONS_SI_NO_OTRO => 'Check tipo Si/No/Otro',
        FieldTypeEnum::CHECK_OPTIONS => 'Check tipo opciones',
        FieldTypeEnum::DATE => 'Fecha',
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Field());

        $grid->disableExport();

        $grid->column('name', __('Nombre'));
        $grid->column('label', __('Label'));
        $grid->column('placeholder', __('Placeholder'));
        $grid->column('description', __('Descripción'));
        $grid->column('type', __('Tipo'));
        $grid->column('options', __('Opciones'));
        $grid->column('rules', 'Reglas')->display(function ($rules) {
            $text = $rules ? implode('|', $rules) : "";
            return "<span>{$text}</span>";
        });
        $grid->column('position', __('Posición'));

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
        $show->field('options', __('Options'));
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
        $form->text('label', __('Label'));
        $form->text('placeholder', __('Placeholder'));
        $form->select('type', __('Tipo'))
            ->options($this->types)
            ->required();

        $form->text('options', __('Opciones separadas por: "|"'));

        $form->multipleSelect('rules', __('Reglas'))
            ->options(['required' => 'Obligatorio']);
        $form->number('position', __('Posición'));

        $formularios = Formulario::all()->pluck('name', 'id')->toArray();
        $form->multipleSelect('formularios', 'Formularios')->options($formularios);

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Field;
use App\FieldTypeEnum;
use App\Formulario;
use App\SelectorEnum;
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

    private $types = [FieldTypeEnum::NUMBER => 'Número', FieldTypeEnum::SHORT_TEXT => 'Texto corto', FieldTypeEnum::LONG_TEXT => 'Texto largo', FieldTypeEnum::SELECTOR => 'Selector', FieldTypeEnum::IMAGE => 'Imágen'];

    private $selectors = [SelectorEnum::NO_PLACA => 'Número de placa', SelectorEnum::BOMBA_ABASTECIMIENTO => 'Bomba de abastecimiento', SelectorEnum::SISTEMA_AMORTIGUACION => 'Sistema de amortiguación', SelectorEnum::ESTADO_MEDICION => 'Estado de medición', SelectorEnum::GENERADOR_GASOLINA => 'Generador de gasolina'];

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
        $grid->column('selector', __('Selector'));
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

        $form->select('selector', __('Selector'))
            ->options($this->selectors);

        $form->multipleSelect('rules', __('Reglas'))
            ->options(['required' => 'Requerido']);
        $form->number('position', __('Posición'));

        $formularios = Formulario::all()->pluck('name', 'id')->toArray();
        $form->multipleSelect('formularios', 'Formularios')->options($formularios);

        return $form;
    }
}

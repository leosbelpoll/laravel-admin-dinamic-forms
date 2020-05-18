<?php

namespace App\Admin\Controllers;

use App\Marca;
use App\Modelo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ModeloController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Modelos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Modelo());

        $grid->disableExport();

        $grid->column('name', 'Nombre');
        $grid->marca('Marca')->display(function ($marca) {
            if ($marca) {
                return "<span>{$marca['name']}</span>";
            }
        });
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
        $show = new Show(Modelo::findOrFail($id));

        $show->field('name', __('Título'));
        $show->field('marca_id', 'Marca')->as(function ($id) {
            $item = Marca::find($id);
            return $item->name;
        });
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
        $form = new Form(new Modelo());

        $form->text('name', 'Título')
            ->required()
            ->creationRules(['required', "unique:modelos"])
            ->updateRules(['required', "unique:modelos,name,{{id}}"]);

        $marcas = Marca::all()->pluck('name', 'id')->toArray();
        $form->select('marca_id', 'Marca')->options($marcas);

        $form->textarea('description', 'Descripción');

        return $form;
    }
}

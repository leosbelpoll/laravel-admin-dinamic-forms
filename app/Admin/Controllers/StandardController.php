<?php

namespace App\Admin\Controllers;

use App\Project;
use App\Standard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StandardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Normas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Standard());

        $grid->column('name', __('Título'))->sortable();
        $grid->column('description', __('Descripción'));

        $grid->standard('Norma superior')->display(function ($standard) {
            if ($standard) {
                return "<span>{$standard['name']}</span>";
            }
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
        $show = new Show(Standard::findOrFail($id));

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
        $form = new Form(new Standard());

        $form->text('name', 'Título');
        $form->textarea('description', 'Descripción');

        $standards = Standard::all()->pluck('name', 'id')->toArray();
        $form->select('standard_id', 'Norma superior')->options($standards);

        // $form->multipleSelect('standards', 'Sub normas')->options($standards);

        $projects = Project::all()->pluck('name', 'id')->toArray();
        $form->multipleSelect('projects', 'Proyectos')->options($projects);

        return $form;
    }
}

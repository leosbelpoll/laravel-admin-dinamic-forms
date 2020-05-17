<?php

namespace App\Admin\Controllers;

use App\Value;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ValueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Valores';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Value());

        $grid->user('Usuario')->display(function ($user) {
            if ($user) {
                return "<span>{$user['name']}</span>";
            }
        });

        $grid->project('Proyecto')->display(function ($project) {
            if ($project) {
                return "<span>{$project['name']}</span>";
            }
        });

        $grid->standard('Norma')->display(function ($standard) {
            if ($standard) {
                return "<span>{$standard['name']}</span>";
            }
        });

        $grid->formulario('Formulario')->display(function ($formulario) {
            if ($formulario) {
                return "<span>{$formulario['name']}</span>";
            }
        });

        $grid->field('Campo')->display(function ($field) {
            if ($field) {
                return "<span>{$field['name']}</span>";
            }
        });

        $grid->column('value', __('Valor'));
        // $grid->column('unique_group', __('Unique group'));

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->where(function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('name', 'ilike', "%{$this->input}%");
                });
            }, 'Usuario');

            $filter->where(function ($query) {
                $query->whereHas('project', function ($query) {
                    $query->where('name', 'ilike', "%{$this->input}%");
                });
            }, 'Proyecto');

            $filter->where(function ($query) {
                $query->whereHas('standard', function ($query) {
                    $query->where('name', 'ilike', "%{$this->input}%");
                });
            }, 'Norma');

            $filter->where(function ($query) {
                $query->whereHas('formulario', function ($query) {
                    $query->where('name', 'ilike', "%{$this->input}%");
                });
            }, 'Formulario');

            $filter->where(function ($query) {
                $query->whereHas('field', function ($query) {
                    $query->where('name', 'ilike', "%{$this->input}%");
                });
            }, 'Campo');
        });



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
        $show = new Show(Value::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('value', __('Value'));
        $show->field('unique_group', __('Unique group'));
        $show->field('user_id', __('User id'));
        $show->field('project_id', __('Project id'));
        $show->field('standard_id', __('Standard id'));
        $show->field('formulario_id', __('Formulario id'));
        $show->field('field_id', __('Field id'));
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
        $form = new Form(new Value());

        $form->textarea('value', __('Value'));
        $form->textarea('unique_group', __('Unique group'));
        $form->number('user_id', __('User id'));
        $form->number('project_id', __('Project id'));
        $form->number('standard_id', __('Standard id'));
        $form->number('formulario_id', __('Formulario id'));
        $form->number('field_id', __('Field id'));

        return $form;
    }
}

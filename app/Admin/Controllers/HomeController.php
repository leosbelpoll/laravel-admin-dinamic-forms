<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Field;
use App\Model\Formulario;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $content->row(function (Row $row) {
            $fieldsCount = Field::count();
            $formsCounter = Formulario::count();

            $fieldsWidget = view('dashboard.fields-widget', ['count' => $fieldsCount])->render();
            $formsWidget = view('dashboard.forms-widget', ['count' => $formsCounter])->render();

            $row->column(6, $fieldsWidget);
            $row->column(6, $formsWidget);
        });

        return $content;
    }
}

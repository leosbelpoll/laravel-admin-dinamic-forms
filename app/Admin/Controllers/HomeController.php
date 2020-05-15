<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use App\Standard;
use App\Vehicle;
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
            $projectsCounter = Project::count();
            $standardsCounter = Standard::where('standard_id', null)->count();
            $vehiclesCounter = Vehicle::count();

            $projectsWidget = view('dashboard.projects-widget', ['count' => $projectsCounter])->render();
            $standardsWidget = view('dashboard.standards-widget', ['count' => $standardsCounter])->render();
            $formsWidget = view('dashboard.vehicles-widget', ['count' => $vehiclesCounter])->render();

            $row->column(4, $projectsWidget);
            $row->column(4, $standardsWidget);
            $row->column(4, $formsWidget);
        });

        return $content;
    }
}

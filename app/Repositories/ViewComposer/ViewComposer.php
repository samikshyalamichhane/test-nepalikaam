<?php
namespace App\Repositories\ViewComposer;

use App\Repositories\Dashboard\DashboardRepository;
use Illuminate\View\View;

use App\Models\Rate;


class ViewComposer
{
    private $dashboard;

    public function __construct(DashboardRepository $dashboard)
    {
        $this->dashboard = $dashboard;

    }
    public function compose(View $view)
    {
        $dashboard = $this->dashboard->first();
        $rates = Rate::orderBy('updated_at', 'desc')->first();

        $view->with(['dashboard_composer' => $dashboard, 'composer__rate' => $rates]);
    }

}

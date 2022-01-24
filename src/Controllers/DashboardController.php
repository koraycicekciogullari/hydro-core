<?php

namespace Koraycicekciogullari\HydroCore\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroAdministrator\Helpers\AdminPanelHelpers;
use Koraycicekciogullari\HydroContact\Models\Contact;
use Koraycicekciogullari\HydroCore\Resources\DashboardResource;

class DashboardController extends Controller
{

    public function index(): DashboardResource
    {
        $VisitorsAndPageViews = AdminPanelHelpers::getFetchVisitorsAndPageViews(7);
        return new DashboardResource(
            [
                'fetchVisitorsAndPageViews' => [
                    'dates'         =>  AdminPanelHelpers::googleChartDateNormalize($VisitorsAndPageViews->pluck('date')),
                    'visitors'      =>  $VisitorsAndPageViews->pluck('visitors'),
                    'pageViews'     =>  $VisitorsAndPageViews->pluck('pageViews'),
                ],
                'fetchMostVisitedPages'     => AdminPanelHelpers::getFetchMostVisitedPages(7),
                'fetchTopReferrers'         => AdminPanelHelpers::getFetchTopReferrers(7),
                'fetchTodayVisitors'        => $VisitorsAndPageViews->pluck('visitors')->last(),
                'totalContact'              => Contact::count(),
            ]
        );
    }

}

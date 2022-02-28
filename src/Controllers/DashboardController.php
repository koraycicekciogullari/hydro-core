<?php

namespace Koraycicekciogullari\HydroCore\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroContact\Models\Contact;
use Koraycicekciogullari\HydroCore\Helpers\DashboardHelper;
use Koraycicekciogullari\HydroCore\Resources\DashboardResource;

class DashboardController extends Controller
{

    public function index(): DashboardResource
    {
        $VisitorsAndPageViews = DashboardHelper::getFetchTotalVisitorsAndPageViews(1);
        return new DashboardResource(
            [
                'fetchVisitorsAndPageViews' => [
                    'dates'         =>  DashboardHelper::googleChartDateNormalize($VisitorsAndPageViews->pluck('date')),
                    'visitors'      =>  $VisitorsAndPageViews->pluck('visitors'),
                    'pageViews'     =>  $VisitorsAndPageViews->pluck('pageViews'),
                ],
                'fetchMostVisitedPages'     => DashboardHelper::getFetchMostVisitedPages(7),
                'fetchTopReferrers'         => DashboardHelper::getFetchTopReferrers(7),
                'fetchTodayVisitors'        => $VisitorsAndPageViews->pluck('visitors')->last(),
                'totalContact'              => Contact::count(),
            ]
        );
    }

}

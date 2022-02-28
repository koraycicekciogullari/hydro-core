<?php

namespace Koraycicekciogullari\HydroCore\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\Analytics\Period;
use Analytics;

/**
 * Class DashboardHelper
 */
class DashboardHelper
{

    /**
     * @param $days
     * @return Collection
     */
    public static function getFetchVisitorsAndPageViews($days): Collection
    {
        return Analytics::fetchVisitorsAndPageViews(Period::days($days));
    }

    /**
     * @param $months
     * @return Collection
     */
    public static function getFetchTotalVisitorsAndPageViews($months): Collection
    {
        return Analytics::fetchTotalVisitorsAndPageViews(Period::months($months));
    }

    /**
     * @param $months
     * @return Collection
     */
    public static function getFetchTopReferrers($months): Collection
    {
        return Analytics::fetchTopReferrers(Period::months($months));
    }

    /**
     * @param $months
     * @return Collection
     */
    public static function getFetchMostVisitedPages($months): Collection
    {
        return Analytics::fetchMostVisitedPages(Period::months($months));
    }

    /**
     * @param $date
     * @return mixed
     */
    public static function googleChartDateNormalize($date): mixed
    {
        return $date->map(function($query){
            return Carbon::parse($query)->format('d/m/Y');
        });
    }
}

<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Analytics;
use Spatie\Analytics\Period;

class DashboardController extends EmployeeController
{
    public function __construct()
    {
        parent::__construct();
        $this->page['title'] = 'Dashboard';
    }

    public function initContent()
    {
        $this->page = [
          'title' => 'Dashboard',
          'action_links' => []
        ];

        if (config('adlara.dashboard_analytics')) {
          $most_visited = Analytics::fetchMostVisitedPages(Period::days(30), 10);
          $top_browsers = Analytics::fetchTopBrowsers(Period::months(6), 5);
          $top_referrers = Analytics::fetchTopReferrers(Period::months(2), 5);
        } else {
          $most_visited = [];
          $top_browsers = [];
          $top_referrers = [];
        }

        // $this->page['panel'] = false;
        // $this->page['title'] = 'Dashboard';

        $this->assign = [
          'most_visited' => $most_visited,
          'top_browsers' => $top_browsers,
          'top_referrers' => $top_referrers
        ];

        return $this->template('dashboard.view');
    }

    public function initProcessGetLiveUsers()
    {
        $users = Analytics::getAnalyticsService()->data_realtime->get('ga:'.config('analytics.view_id').'', 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];

        return response()->json($users);
    }

    public function initProcessTopOS()
    {
        $ga = 'ga:' . config('analytics.view_id');
        $string = 'ga:operatingSystem,ga:operatingSystemVersion,ga:browser,ga:browserVersion';
        $dimensions = [
          'dimensions' => $string,
        ];

        $resp = Analytics::getAnalyticsService()->data_ga->get($ga, '120daysAgo', 'yesterday', ['ga:sessions'], $dimensions);
        $os = $resp->rows;


        $operating_system =  [];
        $browsers = [];
        $ouput = [];

        foreach ($os as $o) {
            $operating_system[$o[0]] = $o[0];
            $browsers[$o[2]] = $o[2];
            $output[$o[0]][$o[2]] = $o[4];
        }

        $datasets = [];
        $datasets['labels'] = $operating_system;
        $datasets['sets'] = [];
        $bg = ['#ff6096', 'orange', 'blue', 'red', 'green', 'yellow', 'black', 'maroon'];

        $i = 0;
        foreach ($browsers as $brow) {
            if (!isset($datasets['sets'][$i])) {
              continue;
            }
            $datasets['sets'][$i]['label'] = $brow;
            $datasets['sets'][$i]['bg'] = $bg[$i];
            foreach ($operating_system as $oos) {
                $visit = 0;
                if (isset($output[$oos][$brow])) {
                    $visit = $output[$oos][$brow];
                }
                $datasets['sets'][$i]['data'][] = $visit;
            }
            $i++;
        }

        return response()->json($datasets);
    }

    public function initProcessDailyVisits()
    {
        $visits = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $visit_data = [];
        $data = [];
        $set_labels = ['Visitors', 'Pageviews'];
        $bg = ['#ff6096', 'orange'];

        foreach ($visits as $visit) {
            $date = date('jS M', $visit['date']->timestamp);
            if (!isset($visit_data[$date])) {
                $visit_data[$date]['visitors'] = 0;
                $visit_data[$date]['pageviews'] = 0;
            }
            $visit_data[$date]['visitors'] += (int) $visit['visitors'];
            $visit_data[$date]['pageviews'] += (int) $visit['pageViews'];
        }

        $data['labels'] = array_keys($visit_data);

        $i = 0;
        foreach ($set_labels as $label) {
          $label = strtolower($label);
          $data['sets'][$i]['label'] = $label;
          foreach ($data['labels'] as $date) {
            $data['sets'][$i]['data'][] = $visit_data[$date][$label];
          }
          $data['sets'][$i]['bg'] = $bg[$i];
          $i++;
        }

        return $data;
    }
}

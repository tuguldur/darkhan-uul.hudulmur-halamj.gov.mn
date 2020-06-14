<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class StatisticController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function getIndexPageStatisticNumbers() {
        $backData = "";

        //$this->dbMan->where("is_active", 1);
        //$this->dbMan->orderBy("date", "DESC");
        $complaints = $this->dbMan->get('complaint');
        $countComplaintRecords = $this->dbMan->count;

        $contents = $this->dbMan->get('content');
        $countContentRecords = $this->dbMan->count;

        $events = $this->dbMan->get('events');
        $countEventRecords = $this->dbMan->count;

        $faq = $this->dbMan->get('faq');
        $countFAQRecords = $this->dbMan->count;
        
        $counterIPs = $this->dbMan->get('counter_ips');
        $countCounterIPs = $this->dbMan->count;
        
        $contentViewCountTable = $this->dbMan->getOne('content', 'sum(view_count) as totalReadCount');
        $allContentViewCount = $contentViewCountTable['totalReadCount'];

        $backData = "<div class='row tile_count'>
                        <div class='col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
                            <span class='count_top'><i class='fa fa-user'></i> Үйл ажиллагаа</span>
                            <div class='count'>{$countEventRecords}</div>
                            <span class='count_bottom'><i class='green'>4% </i> From last Week</span>
                        </div>
                        <div class='col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
                            <span class='count_top'><i class='fa fa-clock-o'></i> Нийт мэдээ</span>
                            <div class='count'>{$countContentRecords}</div>
                            <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i>3% </i> From last Week</span>
                        </div>
                        <div class='col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
                            <span class='count_top'><i class='fa fa-user'></i> Санал, хүсэлт</span>
                            <div class='count green'>{$countComplaintRecords}</div>
                            <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i>34% </i> From last Week</span>
                        </div>
                        <div class='col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
                            <span class='count_top'><i class='fa fa-user'></i> Түгээмэл асуулт</span>
                            <div class='count'>{$countFAQRecords}</div>
                            <span class='count_bottom'><i class='red'><i class='fa fa-sort-desc'></i>12% </i> From last Week</span>
                        </div>
                        <div class='col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
                            <span class='count_top'><i class='fa fa-user'></i> Нийт мэдээ уншсан тоо</span>
                            <div class='count'>{$allContentViewCount}</div>
                            <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i>34% </i> From last Week</span>
                        </div>
                        <div class='col-md-2 col-sm-4 col-xs-6 tile_stats_count'>
                            <span class='count_top'><i class='fa fa-user'></i> Нийт хандалт /2018-02-01 хойш/</span>
                            <div class='count'>{$countCounterIPs}</div>
                            <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i>34% </i> From last Week</span>
                        </div>
                    </div>";

        return $backData;
    }

}

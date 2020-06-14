<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class JobController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
        ///https://demo.themeregion.com/jobs-updated/index.html
    }

    public function loadActiveMongoliaJobsInJSON() {
        $loadedAllActiveJobs = file_get_contents("https://service.hudulmur-halamj.gov.mn/webservices/aimag-niislel-jobs-count.php");
        return json_encode($loadedAllActiveJobs);
    }

    public function loadSectorActiveJobsInJSON($sectorId) {
        $decodedActiveJobsByCode = array();

        if (strlen($sectorId) > 7) {
            $sectorId = substr($sectorId, 0, 7);
        }

        if ($sectorId != "") {
            $loadedActiveJobsByCode = file_get_contents("https://service.hudulmur-halamj.gov.mn/webservices/sectors-jobs-v2.php/?sectorId=" . $sectorId);
            $decodedActiveJobsByCode = json_decode($loadedActiveJobsByCode);
        }

        return view('pages.page_sector_active_jobs_list')->with(['arrayActiveJobs' => $decodedActiveJobsByCode]);
    }

    public function loadActiveProvinceJobsInJSON($jobMapId) {
        $codeAimagNiislel = "";
        $nameAimagNiislel = "";

        if (strlen($jobMapId) > 7) {
            $jobMapId = substr($jobMapId, 0, 7);
        }

        switch ($jobMapId) {
            case "MN-1":
                $codeAimagNiislel = "1912";
                $nameAimagNiislel = "Улаанбаатар хотын ";
                break;
            case "MN-043":
                $codeAimagNiislel = "12942";
                $nameAimagNiislel = "Ховд аймгийн ";
                break;
            case "MN-046":
                $codeAimagNiislel = "12941";
                $nameAimagNiislel = "Увс аймгийн ";
                break;
            case "MN-064":
                $codeAimagNiislel = "12936";
                $nameAimagNiislel = "Говьсүмбэр аймгийн ";
                break;
            case "MN-071":
                $codeAimagNiislel = "3470";
                $nameAimagNiislel = "Баян-Өлгий аймгийн ";
                break;
            case "MN-057":
                $codeAimagNiislel = "12937";
                $nameAimagNiislel = "Завхан аймгийн ";
                break;
            case "MN-065":
                $codeAimagNiislel = "3490";
                $nameAimagNiislel = "Говь-Алтай аймгийн ";
                break;
            case "MN-041":
                $codeAimagNiislel = "2";
                $nameAimagNiislel = "Хөвсгөл аймгийн ";
                break;
            case "MN-073":
                $codeAimagNiislel = "3489";
                $nameAimagNiislel = "Архангай аймгийн ";
                break;
            case "MN-069":
                $codeAimagNiislel = "3471";
                $nameAimagNiislel = "Баянхонгор аймгийн ";
                break;
            case "MN-067":
                $codeAimagNiislel = "10586";
                $nameAimagNiislel = "Булган аймгийн ";
                break;
            case "MN-055":
                $codeAimagNiislel = "9471";
                $nameAimagNiislel = "Өвөрхангай аймгийн ";
                break;
            case "MN-053":
                $codeAimagNiislel = "3474";
                $nameAimagNiislel = "Өмнөговь аймгийн ";
                break;
            case "MN-035":
                $codeAimagNiislel = "12938";
                $nameAimagNiislel = "Орхон аймгийн ";
                break;
            case "MN-049":
                $codeAimagNiislel = "12940";
                $nameAimagNiislel = "Сэлэнгэ аймгийн ";
                break;
            case "MN-037":
                $codeAimagNiislel = "12872";
                $nameAimagNiislel = "Дархан-Уул аймгийн ";
                break;
            case "MN-047":
                $codeAimagNiislel = "1361";
                $nameAimagNiislel = "Төв аймгийн ";
                break;
            case "MN-059":
                $codeAimagNiislel = "3472";
                $nameAimagNiislel = "Дундговь аймгийн ";
                break;
            case "MN-063":
                $codeAimagNiislel = "3473";
                $nameAimagNiislel = "Дорноговь аймгийн ";
                break;
            case "MN-039":
                $codeAimagNiislel = "12944";
                $nameAimagNiislel = "Хэнтий аймгийн ";
                break;
            case "MN-051":
                $codeAimagNiislel = "12939";
                $nameAimagNiislel = "Сүхбаатар аймгийн ";
                break;
            case "MN-061":
                $codeAimagNiislel = "12873";
                $nameAimagNiislel = "Дорнод аймгийн ";
                break;
            default:
                $codeAimagNiislel = "";
                break;
        }

        $decodedActiveJobsByCode = array();

        if ($codeAimagNiislel != "") {
            $loadedActiveJobsByCode = file_get_contents("https://service.hudulmur-halamj.gov.mn/webservices/opens-jobs-aimag-niislel-v2.php/?aimagNiislelId=" . $codeAimagNiislel);
            $decodedActiveJobsByCode = json_decode($loadedActiveJobsByCode);
        }

        return view('pages.page_active_jobs_list')->with(['arrayActiveJobs' => $decodedActiveJobsByCode, 'activeJobZoneName' => $nameAimagNiislel]);
    }

}

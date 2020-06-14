<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class AdvertisementController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function getHeaderMarqueeText() {
        $backData = "";
        $nowDate = date('Y-m-d');

        $this->dbMan->orderBy("ads_updated", "DESC");
        $this->dbMan->where("ads_dead", Array('>=' => $nowDate));
        $this->dbMan->where("ads_active", 1);
        $advertisement = $this->dbMan->getOne('advertisements');
        //$countRecords = $this->dbMan->count;

        if (!empty($advertisement)) {
            $backData .= "<div class='header-top'>
                <div class='auto-container'>
                    <div class='clearfix' id='topMarqueeWidth'>
                        <div class='top-left'>
                            <div class='top-text-ads-marquee'>{$advertisement['ads_text']}</div>
                        </div>
                    </div>
                </div>
            </div>";
        }

        return $backData;
    }

    public function loadAdvertisementDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedAdsID'])) {
            return "You have provided wrong marquee ID!";
        }

        $selectedAdsId = $postData['selectedAdsID'];
        $this->dbMan->where("ads_id", $selectedAdsId);
        $adsSingle = $this->dbMan->getOne('advertisements');
        //$countRecords = $this->dbMan->count;

        if (empty($adsSingle)) {
            return "null";
        } else {
            return json_encode($adsSingle);
        }
    }

    public function getMarqueeTable() {
        $backData = "";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $advertisements = $this->dbMan->get('advertisements');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>байрлал</th>
                            <th>дуусах</th>
                            <th>төлөв</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $adsId = $advertisements[$i]['ads_id'];
            $adsName = $advertisements[$i]['ads_name'];
            //$adsText = $advertisements[$i]['ads_text'];
            $adsPosition = $advertisements[$i]['ads_position'];
            $adsDeadline = $advertisements[$i]['ads_dead'];
            $adsActive = $advertisements[$i]['ads_active'];

            $backData .= "<tr>
                            <td>{$adsId}</td>
                            <td>{$adsName}</td>
                            <td>{$adsPosition}</td>
                            <td>{$adsDeadline}</td>
                            <td>{$adsActive}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-adsid='{$adsId}' data-useraction='edit' onclick='editThisAds(this);'><a>засах</a></li>
                                        <li data-adsid='{$adsId}' data-useraction='delete' onclick='deleteThisAds(this);'><a>устгах</a></li>
                                        <li data-adsid='{$adsId}' data-useraction='view' onclick='viewThisAds(this);'><a>харах</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>";
            $i++;
        }

        $backData .= "</tbody>
                </table>";

        return $backData;
    }

    public function actionMarqueeManagerDAO() {
        $postData = $_POST;
        $backData = "";
        $backStatus = "";

        if (empty($postData) || !isset($postData['marqueeManagerSaveBtn'])) {
            return "Marquee manager save method was wrong!";
        }

        if ($postData['marqueeActionTypeHidden'] == 'create') {
            $data = Array(
                'ads_name' => $postData['marqueeName'],
                'ads_text' => $postData['marqueeValue'],
                'ads_position' => $postData['marqueePosition'],
                'ads_dead' => $postData['marqueeDeadline'],
                'ads_active' => $postData['marqueeActive'],
                'ads_registered' => $this->dbMan->now(),
                'ads_updated' => $this->dbMan->now()
            );

            $new_advertisement_id = $this->dbMan->insert('advertisements', $data);

            if ($new_advertisement_id) {
                $backData .= $new_advertisement_id . ' дугаартай холбоос нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гарсан тул холбоос нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['marqueeActionTypeHidden'] == 'edit') {
            $data = Array(
                'ads_name' => $postData['marqueeName'],
                'ads_text' => $postData['marqueeValue'],
                'ads_position' => $postData['marqueePosition'],
                'ads_dead' => $postData['marqueeDeadline'],
                'ads_active' => $postData['marqueeActive'],
                'ads_updated' => $this->dbMan->now()
            );

            $this->dbMan->where('ads_id', $postData['marqueeActionCodeHidden']);

            if ($this->dbMan->update('advertisements', $data)) {
                $backData = "Гүйдэг зар амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData = "Гүйдэг зар хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['marqueeActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

}

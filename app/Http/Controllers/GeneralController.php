<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class GeneralController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function countWelcomePageVisitor(Request $request) {
        $backData = "";

        if ($request->isMethod("POST") && $request->get('dataSwitch') == 'UWVC1264') {

            $data = Array(
                'ip' => $request->ip(),
                'visit' => $this->dbMan->now()
            );

            $new_content_id = $this->dbMan->insert('counter_ips', $data);

            if ($new_content_id) {
                $backData .= 'visitor counted.';
            } else {
                $backData .= 'error when counting visitor!.';
            }
        }

        return $backData;
    }

    public function getGeneralInfoFormElements() {
        $backData = "";
        $this->dbMan->where("id", 1);
        $generalInfo = $this->dbMan->get('general_info');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $generalInfoId = $generalInfo[$i]['id'];
            $generalInfoTitle = $generalInfo[$i]['title'];
            $generalInfoHeaderPhoto = $generalInfo[$i]['header_photo'];
            $generalInfoFavicon = $generalInfo[$i]['favicon'];
            $generalInfoYoutubeURL = $generalInfo[$i]['youtube_url'];
            $generalInfoFacebookURL = $generalInfo[$i]['facebook_url'];
            $generalInfoGoogleGPS = $generalInfo[$i]['google_gps'];
            $generalInfoContactPhone = $generalInfo[$i]['contact_phone'];
            $generalInfoGreeting = $generalInfo[$i]['greeting'];
            $generalInfoAddress = $generalInfo[$i]['address'];
            $generalInfoFax = $generalInfo[$i]['fax'];
            $generalInfoEmail = $generalInfo[$i]['email'];

            $backData .= "<div class='form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='generalInfoID'>Ерөнхий мэдээ ID <span class='required'>*</span>
                            </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' name='generalInfoID' id='generalInfoID' required='required' value='{$generalInfoId}' class='form-control col-md-7 col-xs-12' readonly=''>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class='control-label col-md-3 col-sm-3 col-xs-12' for='generalInfoPageTitle'>Веб хуудасны нэр <span class='required'>*</span>
                            </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoPageTitle' name='generalInfoPageTitle' value='{$generalInfoTitle}' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoHeaderPicture' class='control-label col-md-3 col-sm-3 col-xs-12'>Толгой зураг </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoHeaderPicture' name='generalInfoHeaderPicture' value='{$generalInfoHeaderPhoto}'  class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoPageFavicon' class='control-label col-md-3 col-sm-3 col-xs-12'>Веб хуудасны дүрс </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoPageFavicon' name='generalInfoPageFavicon' value='{$generalInfoFavicon}' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoYoutubeURL' class='control-label col-md-3 col-sm-3 col-xs-12'>Youtube URL </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoYoutubeURL' name='generalInfoYoutubeURL' value='{$generalInfoYoutubeURL}' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoFacebookURL' class='control-label col-md-3 col-sm-3 col-xs-12'>Facebook URL </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoFacebookURL' name='generalInfoFacebookURL' value='{$generalInfoFacebookURL}' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoGoogleGPS' class='control-label col-md-3 col-sm-3 col-xs-12'>Google GPS Coordinate </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoGoogleGPS' name='generalInfoGoogleGPS' value='{$generalInfoGoogleGPS}' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoPhoneNumbers' class='control-label col-md-3 col-sm-3 col-xs-12'>Холбоо барих дугаар </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoPhoneNumbers' name='generalInfoPhoneNumbers' value='{$generalInfoContactPhone}' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoGreeting' class='control-label col-md-3 col-sm-3 col-xs-12'>Мэндчилгээ </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <textarea id='generalInfoGreeting' name='generalInfoGreeting' class='resizable_textarea form-control'  placeholder='энэ талбарт мэндчилгээ бичнэ үү...'>{$generalInfoGreeting}</textarea>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoAddress' class='control-label col-md-3 col-sm-3 col-xs-12'>Хаяг </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoAddress' name='generalInfoAddress' value='{$generalInfoAddress}' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoFax' class='control-label col-md-3 col-sm-3 col-xs-12'>Факс </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoFax' name='generalInfoFax' value='{$generalInfoFax}' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='generalInfoEmail' class='control-label col-md-3 col-sm-3 col-xs-12'>э-мэйл </label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' id='generalInfoEmail' name='generalInfoEmail' value='{$generalInfoEmail}' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='generalInfoActionTypeHidden' class='control-label col-md-3 col-sm-3 col-xs-12'></label>
                            <div class='col-md-6 col-sm-6 col-xs-12'>
                                <input type='text' name='generalInfoActionTypeHidden' id='generalInfoActionTypeHidden' readonly='' required='' value='edit'/>
                                <input type='text' name='generalInfoActionCodeHidden' id='generalInfoActionCodeHidden' readonly='' value='{$generalInfoId}'/>
                            </div>
                        </div>";
            $i++;
        }

        return $backData;
    }

    public function actionGeneralInfoManagerDAO() {
        $postData = $_POST;

        //echo("<pre>");
        //print_r($postData);
        //echo("</pre>");
        //return "";
        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (empty($postData) || !isset($postData['generalInfoManagerSaveBtn'])) {
            return "General info manager save method was wrong!";
        }

        if ($postData['generalInfoActionTypeHidden'] == 'create') {
            
        } elseif ($postData['generalInfoActionTypeHidden'] == 'edit') {
            $data = Array(
                'title' => $postData['generalInfoPageTitle'],
                'header_photo' => $postData['generalInfoHeaderPicture'],
                'favicon' => $postData['generalInfoPageFavicon'],
                'youtube_url' => $postData['generalInfoYoutubeURL'],
                'facebook_url' => $postData['generalInfoFacebookURL'],
                'google_gps' => $postData['generalInfoGoogleGPS'],
                'contact_phone' => $postData['generalInfoPhoneNumbers'],
                'greeting' => $postData['generalInfoGreeting'],
                'address' => $postData['generalInfoAddress'],
                'fax' => $postData['generalInfoFax'],
                'email' => $postData['generalInfoEmail']
            );

            $this->dbMan->where('id', $postData['generalInfoActionCodeHidden']);

            if ($this->dbMan->update('general_info', $data)) {
                $backData = "Ерөнхий мэдээлэл амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData = "Ерөнхий мэдээлэл хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['generalInfoActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

}

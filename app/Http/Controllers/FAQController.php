<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class FAQController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function loadFaqDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedFaqID'])) {
            return "You have provided wrong faq ID!";
        }

        $selectedFaqId = $postData['selectedFaqID'];
        $this->dbMan->where("id", $selectedFaqId);
        $faq = $this->dbMan->getOne('faq');
        //$countRecords = $this->dbMan->count;

        if (empty($faq)) {
            return "null";
        } else {
            return json_encode($faq);
        }
    }

    public function getFAQsTable() {
        $backData = "";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $faqs = $this->dbMan->get('faq');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>асуулт</th>
                            <th>үзсэн тоо</th>
                            <th>төлөв</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $faqId = $faqs[$i]['id'];
            $faqQuestion = $faqs[$i]['question'];
            //$faqAnswer = $faqs[$i]['answer'];
            $faqViewCount = $faqs[$i]['view_count'];
            $faqIsActive = $faqs[$i]['is_active'];

            if ($faqIsActive == "1") {
                $faqIsActive = "идэвхтэй";
            } else {
                $faqIsActive = "идэвхгүй";
            }

            $backData .= "<tr>
                            <td>{$faqId}</td>
                            <td>{$faqQuestion}</td>
                            <td>{$faqViewCount}</td>
                            <td>{$faqIsActive}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-faqid='{$faqId}' data-useraction='edit' onclick='editThisFAQ(this);'><a>засах</a></li>
                                        <li data-faqid='{$faqId}' data-useraction='delete' onclick='deleteThisFAQ(this);'><a>устгах</a></li>
                                        <li data-faqid='{$faqId}' data-useraction='view' onclick='viewThisFAQ(this);'><a>харах</a></li>
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

    public function actionFaqManagerDAO() {
        $postData = $_POST;

        //echo("<pre>");
        //print_r($postData);
        //echo("</pre>");
        //return "";
        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (empty($postData) || !isset($postData['faqManagerSaveBtn'])) {
            return "FAQ manager save method was wrong!";
        }

        if ($postData['faqActionTypeHidden'] == 'create') {
            $data = Array(
                'question' => $postData['faqTitle'],
                'answer' => $postData['faqContent'],
                'view_count' => $postData['faqViewCount'],
                'is_active' => $postData['faqActive']
            );

            $new_faq_id = $this->dbMan->insert('faq', $data);

            if ($new_faq_id) {
                $backData .= $new_faq_id . ' дугаартай асуулт нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гарсан тул асуулт нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['faqActionTypeHidden'] == 'edit') {
            $data = Array(
                'question' => $postData['faqTitle'],
                'answer' => $postData['faqContent'],
                'is_active' => $postData['faqActive']
            );

            $this->dbMan->where('id', $postData['faqActionCodeHidden']);

            if ($this->dbMan->update('faq', $data)) {
                $backData = "Асуулт амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData = "Асуулт хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['faqActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class LinkController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function getRelatedLinks() {
        $backData = "";
        $this->dbMan->where("is_active", 1);
        $links = $this->dbMan->get('link');
        $countRecords = $this->dbMan->count;
        $i = 0;
        while ($countRecords > $i) {
            $linkPic = $links[$i]['link_pic'];
            $linkURL = $links[$i]['link_url'];
            $backData .= "<li class='slide-item'><div class='image-box'><a href='{$linkURL}' target='_blank'><img src='{$linkPic}' alt='Хамааралтай интернет холбоос' title='Хамааралтай интернет холбоос'></a></div></li>";
            $i++;
        }
        return $backData;
    }

    public function loadLinkDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedLinkID'])) {
            return "You have provided wrong link ID!";
        }

        $selectedLinkId = $postData['selectedLinkID'];
        $this->dbMan->where("link_id", $selectedLinkId);
        $link = $this->dbMan->getOne('link');
        //$countRecords = $this->dbMan->count;

        if (empty($link)) {
            return "null";
        } else {
            return json_encode($link);
        }
    }

    public function getLinksTable() {
        $backData = "";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $links = $this->dbMan->get('link');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>холбоос</th>
                            <th>зураг</th>
                            <th>төлөв</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $linkId = $links[$i]['link_id'];
            $linkURL = $links[$i]['link_url'];
            $linkPicture = $links[$i]['link_pic'];
            $linkIsActive = $links[$i]['is_active'];

            $backData .= "<tr>
                            <td>{$linkId}</td>
                            <td><a href='{$linkURL}' target='blank'>{$linkURL}</a></td>
                            <td><img src='{$linkPicture}' style='width:60px;' /></td>
                            <td>{$linkIsActive}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-linkid='{$linkId}' data-useraction='edit' onclick='editThisLink(this);'><a>засах</a></li>
                                        <li data-linkid='{$linkId}' data-useraction='delete' onclick='deleteThisLink(this);'><a>устгах</a></li>
                                        <li data-linkid='{$linkId}' data-useraction='view' onclick='viewThisLink(this);'><a>харах</a></li>
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

    public function actionLinkManagerDAO() {
        $postData = $_POST;

        //echo("<pre>");
        //print_r($postData);
        //echo("</pre>");
        //return "";
        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (empty($postData) || !isset($postData['linkManagerSaveBtn'])) {
            return "Link manager save method was wrong!";
        }

        if ($postData['linkActionTypeHidden'] == 'create') {
            $data = Array(
                'link_url' => $postData['linkURL'],
                'link_pic' => $postData['linkPicture'],
                'is_active' => $postData['linkActive']
            );

            $new_link_id = $this->dbMan->insert('link', $data);

            if ($new_link_id) {
                $backData .= $new_link_id . ' дугаартай холбоос нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гарсан тул холбоос нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['linkActionTypeHidden'] == 'edit') {
            $data = Array(
                'link_url' => $postData['linkURL'],
                'link_pic' => $postData['linkPicture'],
                'is_active' => $postData['linkActive']
            );

            $this->dbMan->where('link_id', $postData['linkActionCodeHidden']);

            if ($this->dbMan->update('link', $data)) {
                $backData = "Холбоос амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData = "Холбоос хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['linkActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

}

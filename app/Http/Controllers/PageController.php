<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;

class PageController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function loadPageDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedPageID'])) {
            return "You have provided wrong page ID!";
        }

        $selectedPageId = $postData['selectedPageID'];
        $this->dbMan->where("page_id", $selectedPageId);
        $page = $this->dbMan->getOne('pages');
        //$countRecords = $this->dbMan->count;

        if (empty($page)) {
            return "null";
        } else {
            if (empty($page['page_url'])) {
                $page['page_url'] = url("/page/" . $page['page_id']);
            }
            $page['page_preview'] = html_entity_decode($page['page_preview']);
            $page['page_content'] = html_entity_decode($page['page_content']);
            return json_encode($page);
        }
    }

    public function getFrontTwoPages() {
        $backData = "";
        $this->dbMan->orderBy("page_updated", "DESC");
        $this->dbMan->where("page_active", 1);
        $pages = $this->dbMan->get('pages', 2);
        $countRecords = $this->dbMan->count;
        $i = 0;
        while ($countRecords > $i) {
            $backData .= "<div>" . html_entity_decode($pages[$i]["page_preview"]) . "</div>";
            $i++;
        }
        return $backData;
    }

    public function getPageTable() {
        $backData = "";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $pages = $this->dbMan->get('pages');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>хуудас гарчиг</th>
                            <th>үзсэн тоо</th>
                            <th>төлөв</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $pageId = $pages[$i]['page_id'];
            $pageTitle = $pages[$i]['page_name'];
            //$faqAnswer = $faqs[$i]['answer'];
            $pageViewCount = $pages[$i]['page_view_count'];

            $pageActive = ($pages[$i]['page_active'] == 1) ? "<span class='label label-success'>идэвхтэй</span>" : "<span class='label label-warning'>идэвхгүй</span>";

            if (empty($pages[$i]['page_url'])) {
                $pageTitle = "<a href='" . url("/page/" . $pages[$i]['page_id']) . "' target='_blank'>{$pageTitle}</a>";
            } else {
                $pageTitle = "<a href='{$pages[$i]['page_url']}' target='_blank'>{$pageTitle}</a>";
            }

            $backData .= "<tr>
                            <td>{$pageId}</td>
                            <td>{$pageTitle}</td>
                            <td>{$pageViewCount}</td>
                            <td>{$pageActive}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-pageid='{$pageId}' data-useraction='edit' onclick='editThisPage(this);'><a>засах</a></li>
                                        <li data-pageid='{$pageId}' data-useraction='delete' onclick='deleteThisPage(this);'><a>устгах</a></li>
                                        <li data-pageid='{$pageId}' data-useraction='view' onclick='viewThisPage(this);'><a>харах</a></li>
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

    public function actionPageManagerDAO(Request $request) {
        $postData = $_POST;
        
        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (!$request->isMethod("POST")) {
            return "Page manager save method was wrong!";
        }

        if ($request->get("pageActionTypeHidden") == 'create') {

            $pageCoverNewFilename = ToolsController::uplaodCoverImageOfPage($_FILES['pageCoverImageFile']);

            $data = Array(
                'page_name' => $request->get("pageTitle"),
                'page_preview' => htmlentities($request->get("pagePreview")),
                'page_content' => htmlentities($request->get("pageContent")),
                'page_view_count' => $request->get("pageViewCount"),
                'page_cover_img' => $pageCoverNewFilename,
                'page_url' => $request->get("pageUrl"),
                'page_active' => $request->get("pageActiveStatus"),
                'page_updated' => $this->dbMan->now(),
                'page_registered' => $this->dbMan->now()
            );

            $new_page_id = $this->dbMan->insert('pages', $data);

            if ($new_page_id) {
                $backData .= $new_page_id . ' дугаартай хуудас мэдээлэл нэмэгдсэн. <br/>';
                $backStatus = "form_success";
            } else {
                $backData .= 'Алдаа гарсан тул хуудас мэдээлэл нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "form_fail";
            }
        } elseif ($request->get("pageActionTypeHidden") == 'edit') {
            if (empty($request->get("pageActionCodeHidden"))) {
                session()->flash('form_fail', "Мэдээлэл засах дугаар буруу байна.");
                return Redirect::back();
            }

            $pageCoverNewFilename = "no_image_page.jpg";

            if ($request->hasFile('pageCoverImageFile')) {
                $backData .= ToolsController::deleteOldCoverImageOfPage($postData['pageCoverImageNameHidden']);
                $pageCoverNewFilename = ToolsController::uplaodCoverImageOfPage($_FILES['pageCoverImageFile']);
            }

            $data = Array(
                'page_name' => $request->get("pageTitle"),
                'page_preview' => htmlentities($request->get("pagePreview")),
                'page_content' => htmlentities($request->get("pageContent")),
                'page_url' => $request->get("pageUrl"),
                'page_active' => $request->get("pageActiveStatus"),
                'page_updated' => $this->dbMan->now()
            );

            if ($request->hasFile('pageCoverImageFile')) {
                $data['page_cover_img'] = $pageCoverNewFilename;
            }

            $this->dbMan->where('page_id', $request->get("pageActionCodeHidden"));
            if ($this->dbMan->update('pages', $data)) {
                $backData .= "<br/>Хуудас мэдээлэл амжилттай хадгалагдсан.";
                $backStatus = "form_success";
            } else {
                $backData .= "<br/>Хуудам мэдээлэл хадгалах үед алдаа гарсан.";
                $backStatus = "form_fail";
            }
        } elseif ($request->get("pageActionTypeHidden") == 'delete') {
            
        }

        if ($backStatus == "form_success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

}

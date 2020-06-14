<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\MysqliDb;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class MenuController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function sayHelloMenuFunction() {
        return "hello, i am in menu controller.";
    }

    public function updateMenuOrderingByIDs(Request $request) {
        $backData = "";
        if ($request->get("dataSwitch") != "UMOI2236") {
            return "Wrong action made when going to udate menu ordering.";
        }

        if (!$request->isMethod("POST")) {
            return "Wrong web method action made when going to udate menu ordering.";
        }

        $orderMenuKeyValues = $request->get("orderMenuKeyValues");

        foreach ($orderMenuKeyValues as $key => $orderMenuKeyValue) {
            $data = Array(
                'sort' => $orderMenuKeyValue['menuOrder']
            );

            $this->dbMan->where('menu_id', $orderMenuKeyValue['menuId']);

            if ($this->dbMan->update('menu', $data)) {
                $backData .= $orderMenuKeyValue['menuId'] . "-р цэс дараалалд орсон. | ";
            } else {
                $backData .= $orderMenuKeyValue['menuId'] . "-р цэс дараалалд ороогүй. | ";
            }
        }
        return $backData;
    }

    public function getSubMenusForOrdering(Request $request) {
        if (!$request->isMethod("POST")) {
            return array();
        }

        if (empty($request->get('selectedMenuID'))) {
            return array();
        }

        $selectedMenuID = $request->get("selectedMenuID");

        if ($selectedMenuID == "1") {
            $this->dbMan->where("parent_id", 0);
        } else {
            $this->dbMan->where("parent_id", $selectedMenuID);
        }
        $this->dbMan->orderBy("sort", "ASC");
        $sumMenus = $this->dbMan->get('menu');
        //$countRecords = $this->dbMan->count;

        return json_encode($sumMenus);
    }

    public function loadMenuDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedMenuID'])) {
            return "You have provided wrong menu ID!";
        }

        $selectedMenuId = $postData['selectedMenuID'];
        $this->dbMan->where("menu_id", $selectedMenuId);
        $menu = $this->dbMan->getOne('menu');
        //$countRecords = $this->dbMan->count;

        if (empty($menu)) {
            return "{}";
        } else {
            return json_encode($menu);
        }
    }

    public function deleteMenuByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedMenuID'])) {
            return "You have provided wrong menu ID!";
        }

        if ($postData['dataSwitch'] != 'DSMI9863') {
            return "You have made wrong action!";
        }

        $selectedMenuID = $postData['selectedMenuID'];

        $this->dbMan->where("menu_id", $selectedMenuID);
        $oneMenu = $this->dbMan->getOne('menu');

        if (empty($oneMenu)) {
            return "no";
        }

        if ($this->hasMenuChildMenus($oneMenu['menu_id'])) {
            return "menu_has_child_menus";
        }

        if ($this->hasMenuLinkedNews($oneMenu['menu_id'])) {
            return "menu_has_news";
        }

        $this->dbMan->where("menu_id", $selectedMenuID);

        if ($this->dbMan->delete('menu')) {
            return "yes";
        } else {
            return "no";
        }
    }

    private function hasMenuChildMenus($menuId) {
        $this->dbMan->where("parent_id", $menuId);
        $columns = array("menu_id");
        $menus = $this->dbMan->get('menu', null, $columns);
        $countRecords = $this->dbMan->count;
        if ($countRecords > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function hasMenuLinkedNews($menuId) {
        $this->dbMan->where("menu_id", $menuId);
        $columns = array("id");
        $contents = $this->dbMan->get('content', null, $columns);
        $countRecords = $this->dbMan->count;
        if ($countRecords > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSubMenusTableByHTML() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedMenuID'])) {
            return "You have provided wrong parent menu ID!";
        }

        $selectedMenuID = $postData['selectedMenuID'];
        if ($selectedMenuID == "1") {
            $this->dbMan->where("parent_id", 0);
        } else {
            $this->dbMan->where("parent_id", $selectedMenuID);
        }
        $this->dbMan->orderBy("sort", "ASC");
        $sumMenus = $this->dbMan->get('menu');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>ахлах цэс дугаар</th>
                            <th>URL</th>
                            <th>төлөв</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $menuId = $sumMenus[$i]['menu_id'];
            $menuName = $sumMenus[$i]['menu_name'];
            $parentID = $sumMenus[$i]['parent_id'];
            $menuURL = $sumMenus[$i]['url'];
            $menuStatus = $sumMenus[$i]['is_active'];

            if ($menuStatus == "1") {
                $menuStatus = "идэвхтэй";
            } else {
                $menuStatus = "идэвхгүй";
            }

            $backData .= "<tr>
                            <td>{$menuId}</td>
                            <td>{$menuName}</td>
                            <td>{$parentID}</td>
                            <td>{$menuURL}</td>
                            <td>{$menuStatus}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-submenuid='{$menuId}' data-useraction='edit' onclick='editThisSubMenu(this);'><a>засах</a></li>
                                        <li data-submenuid='{$menuId}' data-useraction='delete' onclick='deleteThisSubMenu(this);'><a>устгах</a></li>
                                        <li data-submenuid='{$menuId}' data-useraction='view' onclick='viewThisSubMenu(this);'><a>харах</a></li>
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

    public function actionMenuTransfer(Request $request) {
        $backData = "";
        $backStatus = "";
        $receivingMenuID = "0";

        //Array ( [movingMenuID] => 16 [receivingMenuID] => 17 [_token] => lTbgwweYHXLnJWZ6C89AH9loN5Qs603ZyF1xpQC5 [menuTransferSaveBtn] => ) 
        if (empty($request->get('movingMenuID')) || empty($request->get('receivingMenuID')) || !$request->isMethod('POST')) {
            return "Menu transfer save method was wrong!";
        }

        if ($request->get('receivingMenuID') != "1") {
            $receivingMenuID = $request->get('receivingMenuID');
        }

        $data = Array(
            'parent_id' => $receivingMenuID
        );

        $this->dbMan->where('menu_id', $request->get('movingMenuID'));

        if ($this->dbMan->update('menu', $data)) {
            $backData = "Цэс амжилттай шилжүүлэгдсэн.";
            $backStatus = "success";
        } else {
            $backData = "Цэс шилжүүлэх үед алдаа гарсан.";
            $backStatus = "fail";
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public function actionMenuManagerDAO() {
        $postData = $_POST;

        //echo("<pre>");
        //print_r($postData);
        //echo("</pre>");
        //return "";
        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (empty($postData) || !isset($postData['menuManagerSaveBtn'])) {
            return "Menu manager save method was wrong!";
        }

        if ($postData['menuActionTypeHidden'] == 'create') {
            if ($postData['parentMenuIDHidden'] == 1) {
                $postData['parentMenuIDHidden'] = 0;
            }
            $data = Array(
                'menu_name' => $postData['menuName'],
                'parent_id' => $postData['parentMenuIDHidden'],
                'url' => $postData['menuURL'],
                'is_active' => $postData['menuActive'],
                'is_clickable' => $postData['menuIsClickable'],
                'inserted_at' => $this->dbMan->now()
            );

            $new_menu_id = $this->dbMan->insert('menu', $data);

            if ($new_menu_id) {
                $backData .= $new_menu_id . ' дугаартай цэс нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гарсан тул цэс нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['menuActionTypeHidden'] == 'edit') {
            $data = Array(
                'menu_name' => $postData['menuName'],
                'parent_id' => $postData['parentMenuIDHidden'],
                'url' => $postData['menuURL'],
                'is_active' => $postData['menuActive'],
                'is_clickable' => $postData['menuIsClickable']
            );

            $this->dbMan->where('menu_id', $postData['menuActionCodeHidden']);

            if ($this->dbMan->update('menu', $data)) {
                $backData = "Цэс амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData = "Цэс хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['menuActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public function getNewsMenuAdminPage02() {
        $backData = "";

        $menus = $this->dbMan->get('menu');
        //$countRecords = $this->dbMan->count;

        $homeURL = array("menu_id" => 1,
            "menu_name" => "Нүүр",
            "parent_id" => -1,
            "sort" => 1,
            "is_static" => "",
            "url" => "");
        array_unshift($menus, $homeURL);


        //echo("<pre>");
        //print_r($menus);
        //echo("</pre>");
        $backData .= $this->build_menu_admin($menus, 0, true, -1);

        $backData = "<div id='newsMenuTree02'>" . $backData . "</div>";

        return $backData;
    }

    public function getNewsMenuAdminPage() {
        $backData = "";

        $menus = $this->dbMan->get('menu');
        //$countRecords = $this->dbMan->count;

        $homeURL = array("menu_id" => 1,
            "menu_name" => "Нүүр",
            "parent_id" => -1,
            "sort" => 1,
            "is_static" => "",
            "url" => "");
        array_unshift($menus, $homeURL);


        //echo("<pre>");
        //print_r($menus);
        //echo("</pre>");
        $backData .= $this->build_menu_admin($menus, 0, true, -1);

        $backData = "<div id='newsMenuTree'>" . $backData . "</div>";

        return $backData;
    }

    public function getMenuItemsPageTitle($menuID) {
        $backData = "";
        $menu = null;

        if (!empty($menuID)) {
            $this->dbMan->where("menu_id", $menuID);
            $cols = array('menu_id', 'menu_name');
            $menu = $this->dbMan->getOne('menu', $cols);
            //$countRecords = $this->dbMan->count; 
        }

        if (empty($menu)) {
            return "цэс нэр хоосон байна!";
        } else {
            return $menu['menu_name'] . " " . "цэсний мэдээллүүд";
        }
    }

    public function getBreadCrumbPath($menuId, $postId) {
        $backData = "";

        //$this->dbMan->where("id", $postId);
        $menus = $this->dbMan->get('menu');
        //$countRecords = $this->dbMan->count;

        $startPathItem = array("id" => "0", "name" => "Эхлэл");

        $breadCrumbsItems = $this->getBreadcrumbs($menuId, $menus, array());
        array_push($breadCrumbsItems, $startPathItem);
        $breadCrumbsItems = array_reverse($breadCrumbsItems);


        $backData .= "<section class='page-info'>
                <div class='auto-container clearfix'>
                    <div class='pull-left'>
                        <ul class='bread-crumb clearfix'>";

        foreach ($breadCrumbsItems as $key => $breadCrumbsItem) {
            if ($breadCrumbsItem['id'] == 0) {
                $backData .= "<li><a href='/'>{$breadCrumbsItem['name']}</a></li>";
            } else {
                $backData .= "<li><a href='/menu/{$breadCrumbsItem['id']}/'>{$breadCrumbsItem['name']}</a></li>";
            }
        }

        $backData .= "</ul>
                    </div>
                </div>
            </section>";

        //$this->dbMan->where("id", $postId);
        //$contents = $this->dbMan->get('content');
        //$countRecords = $this->dbMan->count;



        /*
          $i = 0;
          while ($countRecords > $i) {
          $contentId = $contents[$i]['id'];
          $contentTitle = $contents[$i]['title'];

          $backData .= "<section class='page-info'>
          <div class='auto-container clearfix'>
          <div class='pull-left'>
          <ul class='bread-crumb clearfix'>
          <li><a href='" . config('path_config.APP_PATH') . "/'>Home</a></li>
          <li><a href='" . config('path_config.APP_PATH') . "/menu/{$menuId}/'>{$this->getMenuNameByID($menuId)}</a></li>
          <li>{$contentTitle}</li>
          </ul>
          </div>
          </div>
          </section>";
          $i++;
          }
         */

        //$backData .= $this->getBreadcrumbs($menuId, $menus);

        return $backData;
    }

    private function getBreadcrumbs($menuId, $menus, $breadCrumbsArray) {
        foreach ($menus as $key => $menu) {
            if ($menu['menu_id'] == $menuId) {
                $matchedPerMenu = array("id" => $menu['menu_id'], "name" => $menu['menu_name']);
                array_push($breadCrumbsArray, $matchedPerMenu);
                if ($menu['parent_id'] != 0) {
                    $breadCrumbsArray = $this->getBreadcrumbs($menu['parent_id'], $menus, $breadCrumbsArray);
                } else {
                    break;
                }
            }
        }
        return $breadCrumbsArray;
    }

    public function getMenuSubMenus($menuSlugDetailView) {
        $backData = "";

        if (strlen($menuSlugDetailView) > 3) {
            $menuSlugDetailView = substr($menuSlugDetailView, 0, 3);
        }

        if (!is_numeric($menuSlugDetailView)) {
            return $backData;
        }

        $this->dbMan->where("parent_id", $menuSlugDetailView);
        $menus = $this->dbMan->get('menu');
        $countRecords = $this->dbMan->count;

        if ($countRecords > 0) {
            $backData .= "<div class='sidebar-widget sidebar-blog-category'>
                <div class='sidebar-title'>
                            <h3>дэд бүлэг</h3>
                        </div>";
            $backData .= "<ul class='category'>";
        }

        $i = 0;
        while ($countRecords > $i) {
            $menutId = $menus[$i]['menu_id'];
            $menuName = $menus[$i]['menu_name'];

            $backData .= "<li><a href='" . config('path_config.APP_PATH') . "/menu/{$menutId}/'>{$menuName}</a></li>";
            $i++;
        }

        if ($countRecords > 0) {
            $backData .= "</ul>"
                    . "</div>";
        }

        return $backData;
    }

    public function saveMenuDetails() {
        $postData = $_POST;
        $backData = "";
        $backStatus = "";
        if (empty($postData) && !isset($postData['menuBtnSave'])) {
            return "Menu post method was wrong!";
        }

        if ($postData['menuEditDirection'] == 'insert') {
            $maxCodeNumber = $this->getMaxColumnValue("uj_menus", "code_menu", Config::get('uj_config.minimum_code.menu_min_code'));
            $maxCodeNumber++;

            foreach (Config::get("uj_config.app_languages") as $perLang) {
                $data = Array(
                    'code_menu' => $maxCodeNumber,
                    'menu_name' => $postData['menuName'],
                    'menu_slug' => $postData['menuSlug'],
                    'menu_parent' => $postData['menuParent'],
                    'menu_type' => $postData['menuType'],
                    'menu_active' => 1,
                    'lang_iso_code' => $perLang,
                    'menu_updated' => $this->dbMan->now(),
                    'menu_registered' => $this->dbMan->now()
                );

                $new_uj_menu_id = $this->dbMan->insert('uj_menus', $data);

                if ($new_uj_menu_id) {
                    $backData .= $new_uj_menu_id . ' дугаартай мэдээлэл нэмэгдсэн. <br/>';
                    $backStatus = "success";
                } else {
                    $backData .= 'Алдаа гараад мэдээлэл нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                    $backStatus = "fail";
                }
            }
        } elseif ($postData['menuEditDirection555'] == 'update') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public function getPrintMenuItemsHTML($menuId, $currentPage = 1) {
        $backData = "";

        if (strlen($currentPage) > 4) {
            $currentPage = substr($currentPage, 0, 4);
        }
        if (!is_numeric($currentPage)) {
            return "Wrong page pagination param!.";
        }

        $itemsOnPerPage = 5;
        $x = 1;
        $range = 3;
        $offSet = ($currentPage - 1) * $itemsOnPerPage;

        $this->dbMan->orderBy("date", "DESC");
        $this->dbMan->where("menu_id", $menuId);
        $contents = $this->dbMan->withTotalCount()->get('content', Array($offSet, $itemsOnPerPage));
        $totalPages = ceil($this->dbMan->totalCount / $itemsOnPerPage);

        if ($this->dbMan->totalCount == 1) {
            $postId = $contents[0]['id'];
            $menuId = $contents[0]['menu_id'];
            return redirect()->route('readPostByIdWithMenuID', ['menuID' => $menuId, 'postID' => $postId]);
        }

        if (empty($contents)) {
            return "Мэдээ байхгүй байна.";
        }

        foreach ($contents as $i => $content) {
            $contentId = $content['id'];
            $menuId = $content['menu_id'];
            $contentTitle = $content['title'];
            $contentDate = $content['date'];
            $contentTitlePhoto = $content['title_photo'];

            if (empty($contentTitlePhoto)) {
                $contentTitlePhoto = "/images/resources/news-4.jpg";
            } else {
                $titlePhotoExtension = pathinfo($contentTitlePhoto, PATHINFO_EXTENSION);
                $titlePhotoFileName = pathinfo($contentTitlePhoto, PATHINFO_FILENAME);
                $titlePhotoPath = pathinfo($contentTitlePhoto, PATHINFO_DIRNAME);
                $contentTitlePhoto = $titlePhotoPath . "/" . $titlePhotoFileName . "-990x300" . "." . $titlePhotoExtension;
            }

            if (!FileManController::isFileExists(public_path() . $contentTitlePhoto)) {
                $contentTitlePhoto = "/images/resources/news-4.jpg";
            }

            $strToTimeContentDate = strtotime($contentDate);
            $postDateYear = date('Y', $strToTimeContentDate);
            $postDateMonth = date('n', $strToTimeContentDate);
            $postDateDay = date('j', $strToTimeContentDate);

            $backData .= "<div class = 'news-style-one'>
                <div class = 'inner-box'>
                    <div class = 'image'>
                        <a href = '" . config('path_config.APP_PATH') . "/menu/{$menuId}/post/{$contentId}/'><img src='{$contentTitlePhoto}' alt='мэдээний зураг'></a>
                        <div class = 'news-icon'>
                            <span class = 'icon fa fa-image'></span>
                        </div>
                    </div>
                    <div class = 'lower-content lower-content-other-border'>
                        <div class = 'post-date'>{$postDateYear} оны {$postDateMonth}-р сарын {$postDateDay}</div>
                        <h3><a href = '" . config('path_config.APP_PATH') . "/menu/{$menuId}/post/{$contentId}/'>{$contentTitle}</a></h3>
                        <div class = 'text'></div>
                    </div>
                </div>
            </div>";
        }
        $backData .= "<div class='styled-pagination text-right'>";
        $backData .= "<ul class='clearfix'>";
        if ($currentPage > 1) {
            $prevpage = $currentPage - 1;
            $backData .= " <li><a class='prev' href='/menu/{$menuId}/page/1/'> <span class='fa fa-angle-double-left'></span> </a></li> ";
            $backData .= " <li><a class='prev' href='/menu/{$menuId}/page/$prevpage/'> <span class='fa fa-angle-left'></span> </a></li> ";
        }

        for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
            if (($x > 0) && ($x <= $totalPages)) {
                if ($x == $currentPage) {
                    $backData .= " <li><a class='active'>$x</a></li> ";
                } else {
                    $backData .= " <li><a href='/menu/{$menuId}/page/{$x}/'>$x</a></li> ";
                }
            }
        }

        if ($currentPage != $totalPages) {
            $nextpage = $currentPage + 1;
            $backData .= " <li><a class='next' href='/menu/{$menuId}/page/$nextpage/'> <span class='fa fa-angle-right'></span> </a></li> ";
            $backData .= " <li><a class='next' href='/menu/{$menuId}/page/$totalPages/'> <span class='fa fa-angle-double-right'></span> </a></li> ";
        }
        $backData .= "</ul>";
        $backData .= "</div>";

        /* $startPointVal = ($offSet + 1);
          $endPointVal = 0;
          $dfdf = $offSet + $itemsOnPerPage;
          if ($dfdf > $this->dbMan->totalCount) {
          $endPointVal = $this->dbMan->totalCount;
          } else {
          $endPointVal = $dfdf;
          } */

        $backData .= "Нийт: {$this->dbMan->totalCount} мэдээ";
        //$backData .= "Нийт {$this->dbMan->totalCount} мэдээний {$startPointVal}-с {$endPointVal} хүртэлх мэдээг үзүүлж байна";

        return $backData;
    }

    public function printHomeHeaderMenuTree() {
        $backData = "";

        //$this->dbMan->where("lang_iso_code", Config::get("uj_config.current_app_lang"));
        //$this->dbMan->where("(code_menu = ? or code_menu = ?)", Array(2002, 2003));
        $this->dbMan->orderBy("sort", "ASC");
        $this->dbMan->where("is_active", 1);
        $menus = $this->dbMan->get('menu');
        //$countRecords = $this->dbMan->count;

        $backData .= $this->build_menu($menus, 0, true);
        return $backData;
    }

    //--------------- private function area -------------------

    private function has_children($rows, $id) {
        foreach ($rows as $row) {
            if ($row['parent_id'] == $id) {
                return true;
            }
        }
        return false;
    }

    private function getMenuNameByID($menuId) {
        $backData = "";

        $this->dbMan->where("menu_id", $menuId);
        $menu = $this->dbMan->getOne('menu');
        $countRecords = $this->dbMan->count;

        if (!empty($menu)) {
            return $menu['menu_name'];
        } else {
            return 'хоосон утга';
        }
    }

    private function build_menu($rows, $parent = 0, $hasUlClass = false) {
        if ($hasUlClass) {
            $result = "<ul class='navigation clearfix'>";
            $result .= "<li><a href='" . config('path_config.APP_PATH') . "/'>Нүүр хуудас</a></li>";
        } else {
            $result = "<ul class='dropdown clearfix'>";
        }

        foreach ($rows as $row) {
            if ($row['parent_id'] == $parent) {

                $hasChildren = $this->has_children($rows, $row['menu_id']);
                $isClickable = $row['is_clickable'];

                //$result .= "<li class='dropdown'><a href='/menu/{$row['menu_id']}/'>{$row['menu_name']}</a>";
                if ($hasChildren) {
                    if (empty($row['url'])) {
                        $result .= "<li class='dropdown'>" . (($isClickable == 1) ? "<a class='dropdown-toggle-link-clickable' href='/menu/{$row['menu_id']}/'>{$row['menu_name']}</a>" : "<a class='no-clickable-a'>{$row['menu_name']}</a>");
                    } else {
                        $result .= "<li class='dropdown'>" . (($isClickable == 1) ? "<a class='dropdown-toggle-link-clickable' href='{$row['url']}' target='_blank'>{$row['menu_name']}</a>" : "<a class='no-clickable-a'>{$row['menu_name']}</a>");
                    }
                } else {
                    if (empty($row['url'])) {
                        $result .= "<li>" . (($isClickable == 1) ? "<a class='dropdown-toggle-link-clickable' href='/menu/{$row['menu_id']}/'>{$row['menu_name']}</a>" : "<a class='no-clickable-a'>{$row['menu_name']}</a>");
                    } else {
                        $result .= "<li>" . (($isClickable == 1) ? "<a class='dropdown-toggle-link-clickable' href='{$row['url']}' target='_blank'>{$row['menu_name']}</a>" : "<a class='no-clickable-a'>{$row['menu_name']}</a>");
                    }
                }
                if ($hasChildren) {
                    $result .= $this->build_menu($rows, $row['menu_id'], false);
                }

                $result .= "</li>";
            }
        }
        $result .= "</ul>";

        return $result;
    }

    private function has_children_admin($rows, $id) {
        foreach ($rows as $row) {
            if ($row['parent_id'] == $id) {
                return true;
            }
        }
        return false;
    }

    private function build_menu_admin($rows, $parent = 0, $hasUlClass = false, $isHomePrinted = 0) {
        if ($hasUlClass) {
            $result = "<ul>";
            //$result .= "<li><a href='/'>Нүүр хуудас</a></li>";
        } else {
            $result = "<ul>";
        }

        foreach ($rows as $row) {
            if ($row['menu_id'] == "1" && $isHomePrinted == -1) {
                $result .= "<li menuid='{$row['menu_id']}'><a href='/menu/{$row['menu_id']}/'>{$row['menu_name']}</a>";
            }
            if ($row['parent_id'] == $parent) {

                $hasChildren = $this->has_children_admin($rows, $row['menu_id']);

                //$result .= "<li class='dropdown'><a href='/menu/{$row['menu_id']}/'>{$row['menu_name']}</a>";
                if ($hasChildren) {
                    $result .= "<li menuid='{$row['menu_id']}'><a href='/menu/{$row['menu_id']}/'>{$row['menu_name']}</a>";
                } else {
                    $result .= "<li menuid='{$row['menu_id']}'><a href='/menu/{$row['menu_id']}/'>{$row['menu_name']}</a>";
                }
                if ($hasChildren) {
                    $result .= $this->build_menu_admin($rows, $row['menu_id'], false, ++$isHomePrinted);
                }

                $result .= "</li>";
            }
        }
        $result .= "</ul>";

        return $result;
    }

}

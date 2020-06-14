<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;
use App\Http\Controllers\ToolsController;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Cookie;
use File;

class PostController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function updateMenuNewsReadCountInJSON() {
        $postData = $_POST;
        $backData = "";

        $menuID = $postData['menuID'];
        $postID = $postData['postID'];


        $this->dbMan->where("id", $postID);
        $this->dbMan->where("menu_id", $menuID);
        $columns = array('view_count');
        $oneContent = $this->dbMan->getOne('content', $columns);

        if (empty($oneContent)) {
            return "";
        }

        $countView = (intval($oneContent['view_count']) + 1);

        $data = Array(
            'view_count' => $countView
        );

        $this->dbMan->where('id', $postID);
        $this->dbMan->where('menu_id', $menuID);
        if ($this->dbMan->update('content', $data)) {
            $backData .= "news read counted";
        } else {
            $backData .= "news read not counted";
        }

        return $backData;
    }

    public function deleteNewsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedNewsID'])) {
            return "You have provided wrong news ID!";
        }

        if ($postData['dataSwitch'] != 'DNBI8861') {
            return "You have made wrong action!";
        }

        $selectedNewsID = $postData['selectedNewsID'];

        $this->dbMan->where("id", $selectedNewsID);
        $oneContent = $this->dbMan->getOne('content');

        if (empty($oneContent)) {
            return "no";
        }

        $contentPDFFileName = $oneContent['pdf_file'];
        $contentTitlePhotoFileName = $oneContent['title_photo'];
        $contentTitlePhotoThumbFileName = $oneContent['title_photo_th'];

        if (!empty($contentPDFFileName)) {
            $backData .= FileManController::deleteContentPDFFile($contentPDFFileName);
        }

        if (!empty($contentTitlePhotoFileName)) {
            $backData .= FileManController::deleteContentTitlePhotoFile($contentTitlePhotoFileName);
        }

        if (!empty($contentTitlePhotoThumbFileName)) {
            $backData .= FileManController::deleteContentTitlePhotoThumbFile($contentTitlePhotoThumbFileName);
        }

        $this->dbMan->where("id", $selectedNewsID);

        if ($this->dbMan->delete('content')) {
            return "yes";
        } else {
            return "no";
        }
    }

    public function getReadFAQDetails($faqID) {
        $backData = "";

        if (empty($faqID)) {
            return "FAQ Id was wrong...";
        }

        $this->dbMan->where("id", $faqID);
        $faq = $this->dbMan->getOne('faq');
        //$countRecords = $this->dbMan->count;

        $backData = "<div class='basic-info'>
                        <div class='inner-box'>
                            <div class='image'>
                                <img src='" . config('path_config.APP_PATH') . "/images/resources/faq-single.jpg' alt=''>
                            </div>
                            <div class='lower-content'>
                                <div class='upper-box'>
                                    <div class='row clearfix'>
                                        <div class='column col-md-8 col-sm-12 col-xs-12'>
                                            <!--Event Block-->
                                            <div class='event-block'>
                                                <div class='inner-box faq-title'>
                                                    <h3>{$faq['question']}</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='social-column col-md-4 col-sm-12 col-xs-12'>
                                            <ul class='social-icon-three'>
                                                <li><strong>Бусад хүнд түгээх:</strong></li>
                                                <li><a href='#'><span class='fa fa-facebook'></span></a></li>
                                                <li><a href='#'><span class='fa fa-twitter'></span></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='more-info'>
                        <div class='text'>
                            {$faq['answer']}
                        </div>
                    </div>";

        return $backData;
    }

    public function getFrontLatestContentHTML() {
        $backData = "";

        //$this->dbMan->where("is_active", 1);
        $this->dbMan->orderBy("date", "DESC");
        $contents = $this->dbMan->get('content', 10);
        $countRecords = $this->dbMan->count;

        $backData .= "<div class='text'>
                        <ul>";

        $i = 0;
        while ($countRecords > $i) {
            $contentId = $contents[$i]['id'];
            $contentTitle = $contents[$i]['title'];
            $contentMenuId = $contents[$i]['menu_id'];
            $backData .= "<li><a href='" . config('path_config.APP_PATH') . "/menu/{$contentMenuId}/post/{$contentId}/'>{$contentTitle}</a></li>";
            $i++;
        }

        $backData .= "</ul>
                    </div>";

        return $backData;
    }

    public function getFrontMostReadContentHTML() {
        $backData = "";

        //$this->dbMan->where("is_active", 1);
        $this->dbMan->orderBy("view_count", "DESC");
        $contents = $this->dbMan->get('content', 10);
        $countRecords = $this->dbMan->count;

        $backData .= "<div class='text'>
                        <ul>";

        $i = 0;
        while ($countRecords > $i) {
            $contentId = $contents[$i]['id'];
            $contentTitle = $contents[$i]['title'];
            $contentMenuId = $contents[$i]['menu_id'];
            $backData .= "<li><a href='" . config('path_config.APP_PATH') . "/menu/{$contentMenuId}/post/{$contentId}/'>{$contentTitle}</a></li>";
            $i++;
        }

        $backData .= "</ul>
                    </div>";

        return $backData;
    }

    public function getFrontFAQsHTML() {
        $backData = "";

        $this->dbMan->where("is_active", 1);
        $this->dbMan->orderBy("view_count", "DESC");
        $faqs = $this->dbMan->get('faq', 5);
        $countRecords = $this->dbMan->count;

        $backData .= "<div class='text'>
                        <ul>";

        $i = 0;
        while ($countRecords > $i) {
            $faqId = $faqs[$i]['id'];
            $faqQuestion = $faqs[$i]['question'];
            $backData .= "<li><a href='" . config('path_config.APP_PATH') . "/faq/{$faqId}/'>{$faqQuestion}</a></li>";
            $i++;
        }

        $backData .= "</ul>
                    </div>";

        return $backData;
    }

    public function actionNewsManagerDAO(Request $request) {
        $postData = $_POST;
        $backData = "";
        $backStatus = "";

        if (empty($postData) || !isset($postData['newsManagerSaveBtn'])) {
            return "News manager save method was wrong!";
        }
        if ($postData['newsActionTypeHidden'] == 'create') {
            $contentPDFNewFilename = "";
            $contentCoverNewFilename = "";

            if ($request->hasFile('newsCoverImageFile')) {
                $contentCoverNewFilename = ToolsController::uplaodCoverImageOfContent($_FILES['newsCoverImageFile']);
                $contentCoverNewFilename = config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename;
            }

            if ($request->hasFile('newsPDFFile')) {
                $contentPDFNewFilename = UploadController::uploadContentPDFFile($request);
            }

            $data = Array(
                'title' => $postData['newsTitle'],
                'date' => $postData['newsDate'],
                'title_photo' => $contentCoverNewFilename,
                'brief_text' => $postData['newsBriefText'],
                'description' => $postData['newsContent'],
                'media_type' => $postData['newsMediaType'],
                'menu_id' => $postData['newsMenuIDHidden'],
                'title_photo_th' => '',
                'pdf_file' => $contentPDFNewFilename,
                'view_count' => $postData['newsViewCount'],
                'is_breaking' => $postData['newsSpecial'],
                'inserted_at' => $this->dbMan->now(),
                'updated_at' => $this->dbMan->now()
            );

            $new_content_id = $this->dbMan->insert('content', $data);

            if ($new_content_id) {
                $backData .= $new_content_id . ' дугаартай мэдээлэл нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гараад мэдээлэл нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['newsActionTypeHidden'] == 'edit') {
            $contentCoverNewFilename = "";
            $contentPDFNewFilename = "";

            if ($request->hasFile('newsCoverImageFile')) {
                $backData .= ToolsController::deleteOldCoverImageOfContent($postData['newsCoverImageNameHidden']);
                $contentCoverNewFilename = ToolsController::uplaodCoverImageOfContent($_FILES['newsCoverImageFile']);
                $contentCoverNewFilename = config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename;
            }

            if ($request->hasFile('newsPDFFile')) {
                $backData .= UploadController::deleteContentPDFFile($postData['newsPDFFilenameHidden']);
                $contentPDFNewFilename = UploadController::uploadContentPDFFile($request);
            }

            $data = Array(
                'title' => $postData['newsTitle'],
                'date' => $postData['newsDate'],
                'brief_text' => $postData['newsBriefText'],
                'description' => $postData['newsContent'],
                'media_type' => $postData['newsMediaType'],
                'menu_id' => $postData['newsMenuIDHidden'],
                'title_photo_th' => '',
                'view_count' => $postData['newsViewCount'],
                'is_breaking' => $postData['newsSpecial'],
                'updated_at' => $this->dbMan->now()
            );

            if ($request->hasFile('newsPDFFile')) {
                $data['pdf_file'] = $contentPDFNewFilename;
            }

            if ($request->hasFile('newsCoverImageFile')) {
                $data['title_photo'] = $contentCoverNewFilename;
            }

            $this->dbMan->where('id', $postData['newsActionCodeHidden']);
            //$this->dbMan->where("lang_iso_code", Config::get("uj_config.current_app_lang"));
            if ($this->dbMan->update('content', $data)) {
                $backData .= "мэдээ амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData .= "мэдээ хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['newsActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public function getErrorMenuNewsTableByHTML() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedmenuid'])) {
            return "You have provided wrong menu ID!";
        }

        $selectedmenuid = $postData['selectedmenuid'];
        $this->dbMan->orderBy("date", "DESC");
        $this->dbMan->where("menu_id", $selectedmenuid);
        $contents = $this->dbMan->get('content');
        //$countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>алдаа</th>
                            <th>цэс</th>
                            <th>зураг</th>
                            <th>төрөл</th>
                            <th>хугацаа</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        foreach ($contents as $key => $content) {
            $contentId = $content['id'];
            $contentTitle = $content['title'];
            $contentMenuID = $content['menu_id'];
            $contentMediaType = $content['media_type'];
            $contentDate = $content['date'];
            $contentTitlePhoto = $content['title_photo'];
            $contentErrorMessage = "";
            $contentDataValid = true;
            if (!$this->checkContentTitlePhotoExists($contentTitlePhoto)) {
                $contentErrorMessage .= "<span class='label label-danger'>мэдээ зураг буруу</span><br/>";
                $contentDataValid = false;
            }

            if (empty($contentTitle) || mb_strlen($contentTitle, 'UTF-8') < 3) {
                $contentErrorMessage .= "<span class='label label-danger'>мэдээ гарчиг буруу</span><br/>";
                $contentDataValid = false;
            }

            if (mb_strlen($contentTitle, 'UTF-8') > 80) {
                $contentErrorMessage .= "<span class='label label-warning'>мэдээ гарчиг хэт урт (" . mb_strlen($contentTitle, 'UTF-8') . ")</span><br/>";
                $contentDataValid = false;
            }

            if (empty($contentDate)) {
                $contentErrorMessage .= "<span class='label label-danger'>мэдээ хугацаа буруу</span><br/>";
                $contentDataValid = false;
            }

            if (!$contentDataValid) {
                $backData .= "<tr>
                            <td>{$contentId}</td>
                            <td class='content-title-td-cell'><a target='_blank' title='энэ мэдээг үзэх' href='/menu/{$contentMenuID}/post/{$contentId}/'>{$contentTitle}</a></td>
                            <td>{$contentErrorMessage}</td>
                            <td>{$this->getMenuNameByID($contentMenuID)}</td>
                            <td><img src='{$contentTitlePhoto}' style='width:50px;' /></td>
                            <td>{$contentMediaType}</td>
                            <td>{$contentDate}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-newsid='{$contentId}' data-useraction='edit' onclick='editThisNews(this);'><a>засах</a></li>
                                        <li data-newsid='{$contentId}' data-useraction='delete' onclick='deleteThisNews(this);'><a>устгах</a></li>
                                        <li data-newsid='{$contentId}' data-useraction='view' onclick='viewThisNews(this);'><a>харах</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>";
            }
        }

        $backData .= "</tbody>
                </table>";

        return $backData;
    }

    public function geNullMenuIDTableByHTML() {
        $backData = "";

        //$this->dbMan->orderBy("date", "DESC");
        //$this->dbMan->where("menu_id", 0);
        //$contents = $this->dbMan->get('content');
        //$countRecords = $this->dbMan->count;
        
        $contents = $this->dbMan->rawQuery('SELECT * FROM content WHERE menu_id NOT IN (SELECT menu_id FROM menu) ORDER BY date DESC');
        
        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>алдаа</th>
                            <th>цэс</th>
                            <th>зураг</th>
                            <th>төрөл</th>
                            <th>хугацаа</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        foreach ($contents as $key => $content) {
            $contentId = $content['id'];
            $contentTitle = $content['title'];
            $contentMenuID = $content['menu_id'];
            $contentMediaType = $content['media_type'];
            $contentDate = $content['date'];
            $contentTitlePhoto = $content['title_photo'];
            $contentErrorMessage = "";

            $contentErrorMessage .= "<span class='label label-danger'>мэдээний цэс буруу эсвэл сонгоогүй</span><br/>";
            
            $backData .= "<tr>
                            <td>{$contentId}</td>
                            <td class='content-title-td-cell'><a target='_blank' title='энэ мэдээг үзэх' href='/menu/{$contentMenuID}/post/{$contentId}/'>{$contentTitle}</a></td>
                            <td>{$contentErrorMessage}</td>
                            <td>{$this->getMenuNameByID($contentMenuID)}</td>
                            <td><img src='{$contentTitlePhoto}' style='width:50px;' /></td>
                            <td>{$contentMediaType}</td>
                            <td>{$contentDate}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-newsid='{$contentId}' data-useraction='edit' onclick='editThisNews(this);'><a>засах</a></li>
                                        <li data-newsid='{$contentId}' data-useraction='delete' onclick='deleteThisNews(this);'><a>устгах</a></li>
                                        <li data-newsid='{$contentId}' data-useraction='view' onclick='viewThisNews(this);'><a>харах</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>";
        }

        $backData .= "</tbody>
                </table>";

        return $backData;
    }

    private function checkContentTitlePhotoExists($titlePhotoPath) {
        $titlePhotoFullPath = public_path() . $titlePhotoPath;
        if (File::exists($titlePhotoFullPath)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMenuNewsTableByHTML() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedmenuid'])) {
            return "You have provided wrong menu ID!";
        }

        $selectedmenuid = $postData['selectedmenuid'];
        $this->dbMan->orderBy("date", "DESC");
        $this->dbMan->where("menu_id", $selectedmenuid);
        $contents = $this->dbMan->get('content');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>цэс</th>
                            <th>зураг</th>
                            <th>төрөл</th>
                            <th>хугацаа</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $contentId = $contents[$i]['id'];
            $contentTitle = $contents[$i]['title'];
            $contentMenuID = $contents[$i]['menu_id'];
            $contentMediaType = $contents[$i]['media_type'];
            $contentDate = $contents[$i]['date'];
            $contentTitlePhoto = $contents[$i]['title_photo'];
            
            $backData .= "<tr>
                            <td>{$contentId}</td>
                            <td class='content-title-td-cell'><a target='_blank' title='энэ мэдээг үзэх' href='/menu/{$contentMenuID}/post/{$contentId}/'>{$contentTitle}</a></td>
                            <td>{$this->getMenuNameByID($contentMenuID)}</td>
                            <td><img src='{$contentTitlePhoto}' style='width:50px;' /></td>
                            <td>{$contentMediaType}</td>
                            <td>{$contentDate}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-newsid='{$contentId}' data-useraction='edit' onclick='editThisNews(this);'><a>засах</a></li>
                                        <li data-newsid='{$contentId}' data-useraction='delete' onclick='deleteThisNews(this);'><a>устгах</a></li>
                                        <li data-newsid='{$contentId}' data-useraction='view' onclick='viewThisNews(this);'><a>харах</a></li>
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

    public function loadNewsDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedNewsID'])) {
            return "You have provided wrong news ID!";
        }

        $selectedNewsId = $postData['selectedNewsID'];
        $this->dbMan->where("id", $selectedNewsId);
        $content = $this->dbMan->getOne('content');
        //$countRecords = $this->dbMan->count;

        if (empty($content)) {
            return "null";
        } else {
            return json_encode($content);
        }
    }

    public function getSearchFoundItems($searchKeyValue, $currentPageIndex) {
        if (!empty($searchKeyValue)) {
            return $this->getFoundItemsBySearch($searchKeyValue, $currentPageIndex);
        } else {
            return "";
        }
    }

    public function getFrontFourSlider() {
        $backData = "";

        $this->dbMan->where("media_type", 1);
        $this->dbMan->orderBy("date", "DESC");
        $contents = $this->dbMan->get('content', 4);
        $countRecords = $this->dbMan->count;

        $backData .= "<ul class='pgwSlider'>";

        $i = 0;
        while ($countRecords > $i) {
            $contentId = $contents[$i]['id'];
            $contentTitle = $contents[$i]['title'];
            $menuId = $contents[$i]['menu_id'];
            $contentPhotoName = $contents[$i]['title_photo'];
            $contentDate = $contents[$i]['date'];

            $backData .= "
                <li>
                    <a href='" . config('path_config.APP_PATH') . "/menu/{$menuId}/post/{$contentId}/'>
                        <img src='{$contentPhotoName}'>
                        <span>{$contentTitle}</span>
                    </a>
                </li>";
            $i++;
        }

        $backData .= "</ul>";

        return $backData;
    }

    public function getMenuItemPost($postSlugDetailView) {
        $backData = "";

        $this->dbMan->where("id", $postSlugDetailView);
        $contents = $this->dbMan->get('content');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $contentTitle = $contents[$i]['title'];
            $contentDesc = $contents[$i]['description'];
            $contentDate = $contents[$i]['date'];
            $contentPDFFile = $contents[$i]['pdf_file'];
            $contentTitlePhoto = $contents[$i]['title_photo'];
            $contentPDFFileCode = "";

            if (empty($contentTitlePhoto)) {
                $contentTitlePhoto = "/images/resources/news_header.jpg";
            }

            if (!FileManController::isFileExists(public_path() . $contentTitlePhoto)) {
                $contentTitlePhoto = "/images/resources/news_header.jpg";
            }

            $pdfServerFullPath = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_PDF_UPLOAD_PATH') . $contentPDFFile;

            if (!empty($contentPDFFile) && FileManController::isFileExists($pdfServerFullPath)) {
                $contentPDFFilePath = asset('/') . config('path_config.SYS_FILE_PATH.CONTENT_PDF_UPLOAD_PATH') . $contentPDFFile;
                $contentPDFFileCode = "<div>
                        <iframe src='http://docs.google.com/gview?url=" . $contentPDFFilePath . "&embedded=true' style='width:100%; height:700px;' frameborder='0'></iframe>
                        </div>";
            }

            $strToTimeContentDate = strtotime($contentDate);
            $postDateYear = date('Y', $strToTimeContentDate);
            $postDateMonth = date('n', $strToTimeContentDate);
            $postDateDay = date('j', $strToTimeContentDate);

            $backData .= "<div class='news-style-one'>
                <div class='inner-box'>
                    <div class='lower-content has-top-border'>
                    <div class='image'>
                        <img src='{$contentTitlePhoto}' alt='мэдээний зураг' title='мэдээний зураг' />
                        <div class='news-icon'>
                            <span class='icon fa fa-image'></span>
                        </div>
                    </div>
                        <h3>{$contentTitle}</h3>
                        <div class='post-date'>{$postDateYear} оны {$postDateMonth}-р сарын {$postDateDay}</div>
                        <div class='text'>
                            {$contentDesc}
                        </div>
                        {$contentPDFFileCode}
                    </div>
                </div>
            </div>";
            $i++;
        }

        return $backData;
    }

    private function getMenuPostsPagination($menuId) {

        $this->dbMan->orderBy("date", "DESC");
        $this->dbMan->where("menu_id", $menuId);
        $contents = $this->dbMan->get('content');
        $countRecords = $this->dbMan->count;

        $numRows = $countRecords;
        $rowsPerPage = 10;
        $totalPages = ceil($numRows / $rowsPerPage);
        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
            $currentPage = (int) $_GET['currentpage'];
        } else {
            $currentPage = 1;
        }
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        $offSet = ($currentPage - 1) * $rowsPerPage;

        $contents = $this->dbMan->rawQuery("SELECT * FROM content WHERE title LIKE '%Сургалт%' OR description LIKE '%Сургалт%' LIMIT ?, ?", Array($offSet, $rowsPerPage));
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $contentId = $contents[$i]['id'];
            $menuId = $contents[$i]['menu_id'];
            $contentTitle = $contents[$i]['title'];

            echo "<div class = 'news-style-one'>
                <div class = 'inner-box'>
                    <div class = 'image'>
                        <a href = '" . config('path_config.APP_PATH') . "/menu/{$menuId}/post/{$contentId}/'><img src = '/images/resources/news-3.jpg' alt = ''></a>
                        <div class = 'news-icon'>
                            <span class = 'icon fa fa-image'></span>
                        </div>
                    </div>
                    <div class = 'lower-content'>
                        <div class = 'post-date'>January 27, 2017</div>
                        <h3><a href = '" . config('path_config.APP_PATH') . "/menu/{$menuId}/post/{$contentId}/'>{$contentTitle}</a></h3>
                        <div class = 'text'></div>
                    </div>
                </div>
            </div>";
            $i++;
        }

        $range = 3;

        echo("<div class='styled-pagination text-right'>");
        echo("<ul class='clearfix'>");
        if ($currentPage > 1) {
            echo " <li><a class='prev' href='" . config('path_config.APP_PATH') . "/search/?currentpage=1'><span class='fa fa-angle-double-left'></span></a></li> ";
            $prevpage = $currentPage - 1;
            echo " <li><a class='prev' href='" . config('path_config.APP_PATH') . "/search/?currentpage=$prevpage'><span class='fa fa-angle-left'></span></a></li> ";
        }

        for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
            if (($x > 0) && ($x <= $totalPages)) {
                if ($x == $currentPage) {
                    echo " <li><a href='#' class='active'>$x</a></li> ";
                } else {
                    echo " <li><a href='" . config('path_config.APP_PATH') . "/search/?currentpage=$x'>$x</a></li> ";
                }
            }
        }
        if ($currentPage != $totalPages) {
            $nextpage = $currentPage + 1;
            echo " <li><a class='prev' href='" . config('path_config.APP_PATH') . "/search/?currentpage=$nextpage'><span class='fa fa-angle-right'></span></a></li> ";
            echo " <li><a class='prev' href='" . config('path_config.APP_PATH') . "/search/?currentpage=$totalPages'><span class='fa fa-angle-double-right'></span></a></li> ";
        }
        echo("</ul>");
        echo("</div>");
    }

    public function getFoundItemsBySearch(Request $request) {
        //print_r($request->all());
        $searchKeyValue = $request->get('searchText');
        $backData = "";
        $currentPage = 1;
        
        if (null !== $request->segment(3)) {
            $currentPage = $request->segment(3);
        }
        if (strlen($currentPage) > 4) {
            $currentPage = substr($currentPage, 0, 4);
        }
        if (!is_numeric($currentPage)) {
            $backData = "Wrong page pagination param!.";
            return view('pages.page_search_items')->with(['page_type' => 'search_found_items', 'backData' => $backData, 'menuID' => '', 'postID' => '']);
        }
        if (strlen($searchKeyValue) > 50) {
            $searchKeyValue = substr($searchKeyValue, 0, 50);
        }
        if (empty($searchKeyValue) || strlen($searchKeyValue) < 3) {
            $backData = "Хайлтын түлхүүр үг буруу байна.";
            return view('pages.page_search_items')->with(['page_type' => 'search_found_items', 'backData' => $backData, 'menuID' => '', 'postID' => '']);
        }
        
        $itemsOnPerPage = 5;
        $x = 1;
        $range = 3;
        $offSet = ($currentPage - 1) * $itemsOnPerPage;
        
        $this->dbMan->orderBy("date", "DESC");
        $this->dbMan->where("title", "%" . $searchKeyValue . "%", "LIKE");
        $this->dbMan->where("description", "%" . $searchKeyValue . "%", "LIKE");
        $contents = $this->dbMan->withTotalCount()->get('content', Array($offSet, $itemsOnPerPage));
        $totalPages = ceil($this->dbMan->totalCount / $itemsOnPerPage);
        
        if (empty($contents)) {
            $backData = "Мэдээ байхгүй байна.";
            return view('pages.page_search_items')->with(['page_type' => 'search_found_items', 'backData' => $backData, 'menuID' => '', 'postID' => '']);
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
                $contentTitlePhotos = explode(".", $contentTitlePhoto);
                $contentTitlePhoto = $contentTitlePhotos[0] . "-990x300" . "." . $contentTitlePhotos[1];
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
            $backData .= " <li><a class='prev' href='/search/page/1/'> <span class='fa fa-angle-double-left'></span> </a></li> ";
            $backData .= " <li><a class='prev' href='/search/page/$prevpage/?searchText={$searchKeyValue}'> <span class='fa fa-angle-left'></span> </a></li> ";
        }

        for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
            if (($x > 0) && ($x <= $totalPages)) {
                if ($x == $currentPage) {
                    $backData .= " <li><a class='active'>$x</a></li> ";
                } else {
                    $backData .= " <li><a href='/search/page/{$x}/?searchText={$searchKeyValue}'>$x</a></li> ";
                }
            }
        }

        if ($currentPage != $totalPages) {
            $nextpage = $currentPage + 1;
            $backData .= " <li><a class='next' href='/search/page/$nextpage/?searchText={$searchKeyValue}'> <span class='fa fa-angle-right'></span> </a></li> ";
            $backData .= " <li><a class='next' href='/search/page/$totalPages/?searchText={$searchKeyValue}'> <span class='fa fa-angle-double-right'></span> </a></li> ";
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

        return view('pages.page_search_items')->with(['page_type' => 'search_found_items', 'backData' => $backData, 'menuID' => '', 'postID' => '']);
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

}

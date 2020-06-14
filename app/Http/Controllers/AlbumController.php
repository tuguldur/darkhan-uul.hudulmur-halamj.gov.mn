<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;
use App\Http\Controllers\ToolsController;

class AlbumController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public function loadAlbumImagesByAlbumID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedValueOption'])) {
            return "You have provided wrong album ID!";
        }

        $selectedValueOption = $postData['selectedValueOption'];
        $this->dbMan->where("album_id", $selectedValueOption);
        $albumImages = $this->dbMan->get('album_images');
        //$countRecords = $this->dbMan->count;

        if (empty($albumImages)) {
            return "{}";
        } else {
            return json_encode($albumImages);
        }
    }

    public function deleteAlbumImageByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedImageID'])) {
            return "You have provided wrong image ID!";
        }

        if ($postData['dataSwitch'] != 'DAIC6548') {
            return "You have made wrong action!";
        }

        $selectedImageId = $postData['selectedImageID'];
        $this->dbMan->where("id", $selectedImageId);
        $albumImage = $this->dbMan->getOne('album_images');

        if (!empty($albumImage)) {
            ToolsController::deleteOldAlbumImage($albumImage['file_name']);
            $this->dbMan->where("id", $selectedImageId);
            if ($this->dbMan->delete('album_images')) {
                return "yes";
            } else {
                return "no";
            }
        }

        return "no";
    }

    public function uploadActionAlbumImages() {
        $backData = "";
        $backStatus = "success";
        $postFiles = $_FILES;
        $postData = $_POST;

        $uploadedFileNewNames = array();
        foreach ($postFiles as $perPostFile) {
            if (!empty($perPostFile['name'])) {
                $uploadedFileNewNames[] = ToolsController::uplaodAlbumImage($perPostFile);
            }
        }

        foreach ($uploadedFileNewNames as $value) {
            $data = Array(
                'file_name' => $value,
                'album_id' => $postData['imagesAlbum'],
                'file_uploaded_at' => $this->dbMan->now()
            );

            $new_album_img_id = $this->dbMan->insert('album_images', $data);

            if ($new_album_img_id) {
                $backData .= $new_album_img_id . ' дугаартай зураг хуулбарлагдсан. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гараад зураг хуулбарлагдаагүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public function getAlbumsForEditManager() {
        $backData = "";
        $backData .= "<select class='form-control' onchange='loadThisAlbumImages(this);' name='imagesAlbum' id='imagesAlbum'><option value='none'> - сонгох - </option>";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $albums = $this->dbMan->get('album');
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $albumId = $albums[$i]['id'];
            $albumName = $albums[$i]['name'];
            $backData .= "<option value='{$albumId}'>{$albumName}</option>";
            $i++;
        }

        $backData .= "</select>";

        return $backData;
    }

    public function getLatestGalleryImages() {
        $backData = "";
        $backData .= "
        <div class='sidebar-widget recent-gallery'>
            <div class='sidebar-title'>
                <h3>зургийн цомог</h3>
            </div>
            <div class='clearfix'>";

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $this->dbMan->orderBy("file_uploaded_at", "DESC");
        $albumImages = $this->dbMan->get('album_images', 9);
        $countRecords = $this->dbMan->count;

        $i = 0;
        while ($countRecords > $i) {
            $albumImageId = $albumImages[$i]['id'];
            $albumImageName = $albumImages[$i]['file_name'];
            $albumId = $albumImages[$i]['album_id'];
            $backData .= "<div class='image'><a href='/uploads/album/{$albumImageName}' class='lightbox-image'><img src='/uploads/album/{$albumImageName}' alt='Picture'></a></div>";
            $i++;
        }

        $backData .= "</div>
        </div>";

        return $backData;
    }

    public function loadAlbumDetailsByID() {
        $backData = "";
        $postData = $_POST;

        if (empty($postData) || !isset($postData['selectedAlbumID'])) {
            return "You have provided wrong album ID!";
        }

        $selectedAlbumID = $postData['selectedAlbumID'];
        $this->dbMan->where("id", $selectedAlbumID);
        $album = $this->dbMan->getOne('album');
        //$countRecords = $this->dbMan->count;

        if (empty($album)) {
            return "null";
        } else {
            return json_encode($album);
        }
    }

    public function getAlbumTable() {
        $backData = "";
        $postData = $_POST;

        //$this->dbMan->where("menu_id", $selectedmenuid);
        $albums = $this->dbMan->get('album');
        $countRecords = $this->dbMan->count;

        $backData .= "<table id='datatable-buttons' class='table table-striped table-bordered'>";
        $backData .= "<thead>
                        <tr>
                            <th>дугаар</th>
                            <th>нэр</th>
                            <th>зураг</th>
                            <th>төлөв</th>
                            <th>хугацаа</th>
                            <th>үйлдэл</th>
                        </tr>
                    </thead>
                        <tbody>";

        $i = 0;
        while ($countRecords > $i) {
            $albumId = $albums[$i]['id'];
            $albumTitle = $albums[$i]['name'];
            $albumMediaType = $albums[$i]['active'];
            $albumDate = $albums[$i]['date'];

            if ($albumMediaType == "1") {
                $albumMediaType = "идэвхтэй";
            } else {
                $albumMediaType = "идэвхгүй";
            }

            $backData .= "<tr>
                            <td>{$albumId}</td>
                            <td>{$albumTitle}</td>
                            <td><img src='https://pimg-guru.com/1/002/1002859/laravel-development_f0e694be-8b1c-4016-9fb1-424d4dd0fac9.jpg' style='width:50px;' /></td>
                            <td>{$albumMediaType}</td>
                            <td>{$albumDate}</td>
                            <td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-danger'>үйлдэл</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                        <span class='caret'></span>
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li data-albumid='{$albumId}' data-useraction='edit' onclick='editThisAlbum(this);'><a>засах</a></li>
                                        <li data-albumid='{$albumId}' data-useraction='delete' onclick='deleteThisAlbum(this);'><a>устгах</a></li>
                                        <li data-albumid='{$albumId}' data-useraction='view' onclick='viewThisAlbum(this);'><a>харах</a></li>
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

    public function actionAlbumManagerDAO() {
        $postData = $_POST;

        //echo("<pre>");
        //print_r($postData);
        //echo("</pre>");
        //die();

        $backData = "";
        $backStatus = "";
        //ToolsController::printDevArray($postData);

        if (empty($postData) || !isset($postData['albumManagerSaveBtn'])) {
            return "Album manager save method was wrong!";
        }
        if ($postData['albumActionTypeHidden'] == 'create') {
            $albumCoverNewFilename = ToolsController::uplaodCoverImageOfAlbum($_FILES['albumCoverImageFile']);

            $data = Array(
                'name' => $postData['albumTitle'],
                'description' => $postData['albumContent'],
                'cover_image' => ($albumCoverNewFilename),
                'date' => $postData['albumDate'],
                'active' => $postData['albumActiveStatus']
            );

            $new_album_id = $this->dbMan->insert('album', $data);

            if ($new_album_id) {
                $backData .= $new_album_id . ' дугаартай мэдээлэл нэмэгдсэн. <br/>';
                $backStatus = "success";
            } else {
                $backData .= 'Алдаа гараад мэдээлэл нэмэгдээгүй.....' . $this->dbMan->getLastError() . "<br/>";
                $backStatus = "fail";
            }
        } elseif ($postData['albumActionTypeHidden'] == 'edit') {
            $albumCoverNewFilename = "no_cover_image";

            if (!empty($_FILES['albumCoverImageFile']['name'])) {
                $backData .= ToolsController::deleteOldCoverImageOfAlbum($postData['albumCoverImageNameHidden']);
                $albumCoverNewFilename = ToolsController::uplaodCoverImageOfAlbum($_FILES['albumCoverImageFile']);
            }

            $data = Array(
                'name' => $postData['albumTitle'],
                'description' => $postData['albumContent'],
                'date' => $postData['albumDate'],
                'active' => $postData['albumActiveStatus']
            );

            if (!empty($_FILES['albumCoverImageFile']['name'])) {
                $data['cover_image'] = ($albumCoverNewFilename);
            }

            $this->dbMan->where('id', $postData['albumActionCodeHidden']);
            if ($this->dbMan->update('album', $data)) {
                $backData .= "Цомог амжилттай хадгалагдсан.";
                $backStatus = "success";
            } else {
                $backData .= "Цомог хадгалах үед алдаа гарсан.";
                $backStatus = "fail";
            }
        } elseif ($postData['albumActionTypeHidden'] == 'delete') {
            
        }

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

}

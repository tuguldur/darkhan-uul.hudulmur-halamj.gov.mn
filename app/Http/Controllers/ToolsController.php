<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use App\Http\Classes\MysqliDb;
use DateTime;

class ToolsController extends Controller {

    //
    private $dbMan = null;

    public function __construct() {
        $this->dbMan = new MysqliDb();
    }

    public static function getMonthName($dateTimeString) {
        $datetime = new DateTime($dateTimeString);
        return $datetime->format('M');
    }

    public static function getDayName($dateTimeString) {
        $datetime = new DateTime($dateTimeString);
        return $datetime->format('j');
    }

    public function resizeAllContentTitleImages($keyCodeId) {
        if (md5($keyCodeId) != "08245dcc2b356c332d2924fa92fafc1c") {
            return "check key code!";
        }

        $cols = array("title_photo");
        $contents = $this->dbMan->get('content', null, $cols);
        //$countRecords = $this->dbMan->count;
        foreach ($contents as $key => $content) {
            $titlePhoto = $content['title_photo'];
            $titlePhotoPath = public_path() . $titlePhoto;
            if ((file_exists($titlePhotoPath) && !is_dir($titlePhotoPath))) {
                $fileNameExploded = explode('/', $titlePhoto);
                $titlePhotofileName = end($fileNameExploded);
                $this->resizeAllContentTitleImage($titlePhotoPath, $titlePhotofileName);
            }
        }
        echo("All content title images are resized.");
    }

    private function resizeAllContentTitleImage($contentTitleImagePath, $imageFileName) {
        $now = new DateTime();
        $contentCoverNewFilename = "no_image_name.jpg";
        $img01 = Image::make($contentTitleImagePath);
        $img02 = Image::make($contentTitleImagePath);
        $img03 = Image::make($contentTitleImagePath);

        //$pathCoverImage = $contentTitleImagePath;
        $fileExtension = pathinfo($imageFileName, PATHINFO_EXTENSION);
        $fileName = pathinfo($imageFileName, PATHINFO_FILENAME);

        $contentCoverNewFilename = $fileName . '.' . $fileExtension;
        $contentCoverNewFilename02 = $fileName . "-" . config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_WIDTH') . "x" . config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_HEIGHT') . '.' . $fileExtension;
        $contentCoverNewFilename03 = $fileName . "-" . config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_WIDTH') . "x" . config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_HEIGHT') . '.' . $fileExtension;

        //---------------------990 x 742---------------------
        $img01->fit(config('file_sizes.CONTENT_COVER_IMAGE.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE.MAX_HEIGHT'));
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename;
        $img01->save($newFilePathName);
        //---------------------990 x 300---------------------
        //$img->resize(config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_HEIGHT'));
        $img02->crop(990, 300, 0, 50);
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename02;
        $img02->save($newFilePathName);
        //---------------------402 x null---------------------
        $img03->resize(config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_HEIGHT'));
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename03;
        $img03->save($newFilePathName);

        return true;
    }

    public static function uplaodCoverImageOfAlbum($fileObject) {
        $now = new DateTime();
        $albumCoverImageName = "album-cover-image-";
        $albumCoverNewFilename = "no_image_name.jpg";
        $img = Image::make($fileObject['tmp_name']);

        $pathCoverImage = $fileObject['name'];
        $fileExtension = pathinfo($pathCoverImage, PATHINFO_EXTENSION);

        $albumCoverImageName .= $now->format('Y-m-d') . "-" . rand(101, 999);
        $albumCoverNewFilename = $albumCoverImageName . '.' . $fileExtension;

        $img->fit(config('file_sizes.ALBUM_COVER_IMAGE.MAX_WIDTH'), config('file_sizes.ALBUM_COVER_IMAGE.MAX_HEIGHT'));

        $img->save(config('path_config.SYS_FILE_PATH.ALBUM_COVER_IMG_UPLOAD_PATH') . $albumCoverNewFilename);
        return $albumCoverNewFilename;
    }

    public static function deleteOldCoverImageOfAlbum($pathNameCoverImage) {
        $backData = "";
        $oldImagePath = public_path() . config('path_config.SYS_FILE_PATH.ALBUM_COVER_IMG_UPLOAD_PATH') . $pathNameCoverImage;
        if (file_exists($oldImagePath)) {
            //chown($oldImagePath, 666);
            if (unlink($oldImagePath)) {
                $backData .= "Цомог зураг амжилттай устгагдсан. ";
            } else {
                $backData .= "Цомог зураг устгах үед алдаа гарсан. ";
            }
        } else {
            $backData .= "Цомог зураг сервер дээр байхгүй байна. ";
        }
        return $backData;
    }

    public static function deleteOldCoverImageOfContent($pathNameCoverImage) {
        $backData = "";
        $oldImagePath = public_path() . $pathNameCoverImage;
        $titlePhotoExtension = pathinfo($pathNameCoverImage, PATHINFO_EXTENSION);
        $titlePhotoFileName = pathinfo($pathNameCoverImage, PATHINFO_FILENAME);
        $titlePhotoPath = pathinfo($pathNameCoverImage, PATHINFO_DIRNAME);
        if (file_exists($oldImagePath)) {
            //chown($oldImagePath, 666);
            if (unlink($oldImagePath)) {
                $backData .= "Мэдээний зураг амжилттай устгагдсан. <br/>";
            } else {
                $backData .= "Мэдээний зураг устгах үед алдаа гарсан. <br/>";
            }
        } else {
            $backData .= "Мэдээний зураг сервер дээр байхгүй байна. <br/>";
        }

        $oldImagePath = public_path() . $titlePhotoPath . "/" . $titlePhotoFileName . "-402x301" . "." . $titlePhotoExtension;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        } else {
            $backData .= "Мэдээний 402x301 хэмжээтэй зураг олдохгүй байгаа тул file_config шалгана уу. <br/>";
        }

        $oldImagePath = public_path() . $titlePhotoPath . "/" . $titlePhotoFileName . "-990x300" . "." . $titlePhotoExtension;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        } else {
            $backData .= "Мэдээний 990x300 хэмжээтэй зураг олдохгүй байгаа тул file_config шалгана уу. <br/>";
        }

        return $backData;
    }

    public static function uplaodCoverImageOfContent($fileObject) {
        $backData = "";
        $now = new DateTime();
        $contentCoverImageName = "content-cover-image-";
        $contentCoverNewFilename = "no_image_name.jpg";
        $img01 = Image::make($fileObject['tmp_name']);
        $img02 = Image::make($fileObject['tmp_name']);
        $img03 = Image::make($fileObject['tmp_name']);

        $pathCoverImage = $fileObject['name'];
        $fileExtension = pathinfo($pathCoverImage, PATHINFO_EXTENSION);

        $contentCoverImageName .= $now->format('Y-m-d') . "-" . rand(101, 999);
        $contentCoverNewFilename = $contentCoverImageName . '.' . $fileExtension;
        $contentCoverNewFilename02 = $contentCoverImageName . "-" . config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_WIDTH') . "x" . config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_HEIGHT') . '.' . $fileExtension;
        $contentCoverNewFilename03 = $contentCoverImageName . "-" . config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_WIDTH') . "x" . config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_HEIGHT') . '.' . $fileExtension;

        //---------------------990 x 740---------------------
        $img01->fit(config('file_sizes.CONTENT_COVER_IMAGE.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE.MAX_HEIGHT'));
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename;
        $img01->save($newFilePathName);
        //---------------------990 x 300---------------------
        //$img->resize(config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_HEIGHT'));
        $img02->crop(990, 300, 0, 50);
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename02;
        $img02->save($newFilePathName);
        //---------------------402 x null---------------------
        $img03->resize(config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_HEIGHT'));
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename03;
        $img03->save($newFilePathName);

        return $contentCoverNewFilename;
    }

    public static function uplaodCoverImageOfEvent($fileObject) {
        $now = new DateTime();
        $eventCoverImageName = "event-cover-img-";
        $eventCoverNewFilename = "no_image.jpg";
        $img = Image::make($fileObject['tmp_name']);

        $pathCoverImage = $fileObject['name'];
        $fileExtension = pathinfo($pathCoverImage, PATHINFO_EXTENSION);

        $eventCoverImageName .= $now->format('Y-m-d') . "-" . rand(101, 999);
        $eventCoverNewFilename = $eventCoverImageName . '.' . $fileExtension;

        $img->fit(config('file_sizes.EVENT_COVER_IMAGE.MAX_WIDTH'), config('file_sizes.EVENT_COVER_IMAGE.MAX_HEIGHT'));

        $img->save(public_path() . config('path_config.SYS_FILE_PATH.EVENT_IMG_UPLOAD_PATH') . $eventCoverNewFilename);
        return $eventCoverNewFilename;
    }

    public static function deleteOldCoverImageOfEvent($pathNameCoverImage) {
        $backData = "";
        $oldImagePath = public_path() . config('path_config.SYS_FILE_PATH.EVENT_IMG_UPLOAD_PATH') . $pathNameCoverImage;
        if (file_exists($oldImagePath)) {
            //chown($oldImagePath, 666);
            if (unlink($oldImagePath)) {
                $backData .= "Үйл ажиллагаа зураг амжилттай устгагдсан. ";
            } else {
                $backData .= "Үйл ажиллагаа зураг устгах үед алдаа гарсан. ";
            }
        } else {
            $backData .= "Үйл ажиллагаа зураг сервер дээр байхгүй байна. ";
        }
        return $backData;
    }

    public static function uplaodCoverImageOfPage($fileObject) {
        $now = new DateTime();
        $pageCoverImageName = "page-cover-img-";
        $pageCoverNewFilename = "no_image_page.jpg";
        $img = Image::make($fileObject['tmp_name']);
        
        $pathCoverImage = $fileObject['name'];
        $fileExtension = pathinfo($pathCoverImage, PATHINFO_EXTENSION);
        
        $pageCoverImageName .= $now->format('Y-m-d') . "-" . rand(101, 999);
        $pageCoverNewFilename = $pageCoverImageName . '.' . $fileExtension;
        
        $img->fit(config('file_sizes.PAGE_COVER_IMAGE.MAX_WIDTH'), config('file_sizes.PAGE_COVER_IMAGE.MAX_HEIGHT'));
        
        $img->save(public_path() . config('path_config.SYS_FILE_PATH.PAGE_IMG_UPLOAD_PATH') . $pageCoverNewFilename);
        return $pageCoverNewFilename;
    }

    public static function deleteOldCoverImageOfPage($pathNameCoverImage) {
        $backData = "";
        $oldImagePath = public_path() . config('path_config.SYS_FILE_PATH.PAGE_IMG_UPLOAD_PATH') . $pathNameCoverImage;

        if (file_exists($oldImagePath)) {
            //chown($oldImagePath, 666);
            if (unlink($oldImagePath)) {
                $backData .= "Хуудас зураг амжилттай устгагдсан. ";
            } else {
                $backData .= "Хуудас зураг устгах үед алдаа гарсан. ";
            }
        } else {
            $backData .= "Хуудас зураг сервер дээр байхгүй байна. ";
        }
        return $backData;
    }

    public static function uplaodAlbumImage($fileObject) {
        $backData = "";
        $now = new DateTime();
        $contentCoverImageName = "album-image-";
        $contentCoverNewFilename = "no_image_name.jpg";
        $img = Image::make($fileObject['tmp_name']);

        $pathCoverImage = $fileObject['name'];
        $fileExtension = pathinfo($pathCoverImage, PATHINFO_EXTENSION);

        $contentCoverImageName .= $now->format('Y-m-d') . "-" . rand(1001, 9999);
        $contentCoverNewFilename = $contentCoverImageName . '.' . $fileExtension;

        $img->fit(config('file_sizes.ALBUM_ITEM_IMAGE.MAX_WIDTH'), config('file_sizes.ALBUM_ITEM_IMAGE.MAX_HEIGHT'));

        $img->save(config('path_config.SYS_FILE_PATH.ALBUM_IMG_UPLOAD_PATH') . $contentCoverNewFilename);
        return $contentCoverNewFilename;
    }

    public static function deleteOldAlbumImage($nameAlbumImage) {
        $backData = true;
        $oldImagePath = public_path() . config('path_config.SYS_FILE_PATH.ALBUM_IMG_UPLOAD_PATH') . $nameAlbumImage;

        if (file_exists($oldImagePath)) {
            //chown($oldImagePath, 666);
            if (unlink($oldImagePath)) {
                $backData = true;
            } else {
                $backData = false;
            }
        } else {
            $backData = false;
        }
        return $backData;
    }

    public static function cloneAndResizeCoverImageOfContent($fileObject) {
        $backData = "";
        $now = new DateTime();
        $contentCoverImageName = "content-cover-image-";
        $contentCoverNewFilename = "no_image_name.jpg";
        $img01 = Image::make($fileObject['tmp_name']);
        $img02 = Image::make($fileObject['tmp_name']);
        $img03 = Image::make($fileObject['tmp_name']);

        $pathCoverImage = $fileObject['name'];
        $fileExtension = pathinfo($pathCoverImage, PATHINFO_EXTENSION);

        $contentCoverImageName .= $now->format('Y-m-d') . "-" . rand(101, 999);
        $contentCoverNewFilename = $contentCoverImageName . '.' . $fileExtension;
        $contentCoverNewFilename02 = $contentCoverImageName . "-" . config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_WIDTH') . "x" . config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_HEIGHT') . '.' . $fileExtension;
        $contentCoverNewFilename03 = $contentCoverImageName . "-" . config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_WIDTH') . "x" . config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_HEIGHT') . '.' . $fileExtension;

        //---------------------990 x 740---------------------
        $img01->fit(config('file_sizes.CONTENT_COVER_IMAGE.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE.MAX_HEIGHT'));
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename;
        $img01->save($newFilePathName);
        //---------------------990 x 300---------------------
        //$img->resize(config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE_02.MAX_HEIGHT'));
        $img02->crop(990, 300, 0, 50);
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename02;
        $img02->save($newFilePathName);
        //---------------------402 x null---------------------
        $img03->resize(config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_WIDTH'), config('file_sizes.CONTENT_COVER_IMAGE_03.MAX_HEIGHT'));
        $newFilePathName = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_FILE_UPLOAD_PATH') . $contentCoverNewFilename03;
        $img03->save($newFilePathName);

        return $contentCoverNewFilename;
    }

}

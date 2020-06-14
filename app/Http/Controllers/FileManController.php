<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class FileManController extends Controller {

    //

    public function readFoldersTree($rootDir) {
        $ffs = scandir($rootDir);
        $backData = '<ul id="uploadFileTreeUL" class="treeViewBrowserUL">';
        foreach ($ffs as $file) {
            if ($file != '.' && $file != '..') {
                $path = $rootDir . '/' . $file;
                if (is_dir($path)) {
                    $backData .= "<li id='uploadFileTreeLi'><a id='uploadFileTreeA' data-folderpath='" . $path . "'>$file</a></li>";
                }

                if (is_dir($rootDir . '/' . $file)) {
                    $backData .= $this->readFoldersTree($rootDir . '/' . $file);
                }
            }
        }
        $backData .= '</ul>';
        return $backData;
    }

    public static function isFileExists($fullServerFilePath) {
        if (File::exists($fullServerFilePath)) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteContentPDFFile($contentPDFFileName) {
        $backData = "";
        $oldPDFFilePath = public_path() . "/" . config('path_config.SYS_FILE_PATH.CONTENT_PDF_UPLOAD_PATH') . $contentPDFFileName;

        if (File::exists($oldPDFFilePath)) {
            $backData .= "Мэдээний " . $contentPDFFileName . " нэртэй PDF файл сервер дээр байсан. <br/>";
        } else {
            $backData .= "Мэдээний " . $contentPDFFileName . " нэртэй PDF файл сервер дээр байхгүй байсан. <br/>";
        }

        if (File::delete($oldPDFFilePath)) {
            $backData .= "Мэдээний PDF файл сервер-с амжилттай устгагдсан. <br/>";
        } else {
            $backData .= "Мэдээний PDF файл сервер-с устгах үед алдаа гарсан. <br/>";
        }

        return $backData;
    }

    public static function deleteContentTitlePhotoFile($contentTitlePhotoFileName) {
        $backData = "";
        $titlePhotoFilePath = public_path() . $contentTitlePhotoFileName;

        $titlePhotoFileExtension = pathinfo($contentTitlePhotoFileName, PATHINFO_EXTENSION);
        $titlePhotoFileName = pathinfo($contentTitlePhotoFileName, PATHINFO_FILENAME);
        $titlePhotoDirName = pathinfo($contentTitlePhotoFileName, PATHINFO_DIRNAME);

        $titlePhotoLongFilePath = public_path() . $titlePhotoDirName . "/" . $titlePhotoFileName . "-990x300" . "." . $titlePhotoFileExtension;
        $titlePhotoMiddleFilePath = public_path() . $titlePhotoDirName . "/" . $titlePhotoFileName . "-402x301" . "." . $titlePhotoFileExtension;

        if (File::exists($titlePhotoFilePath)) {
            $backData .= "Мэдээний " . $contentTitlePhotoFileName . " нэртэй зураг файл сервер дээр байсан. <br/>";
        } else {
            $backData .= "Мэдээний " . $contentTitlePhotoFileName . " нэртэй зураг файл сервер дээр байхгүй байсан. <br/>";
        }

        if (File::delete($titlePhotoFilePath)) {
            $backData .= "Мэдээний зураг файл сервер-с амжилттай устгагдсан. <br/>";
        } else {
            $backData .= "Мэдээний зураг файл сервер-с устгах үед алдаа гарсан. <br/>";
        }

        File::delete($titlePhotoLongFilePath);
        File::delete($titlePhotoMiddleFilePath);

        return $backData;
    }

    public static function deleteContentTitlePhotoThumbFile($contentTitlePhotoThFileName) {
        $backData = "";
        $titlePhotoThFilePath = public_path() . $contentTitlePhotoThFileName;

        if (File::exists($titlePhotoThFilePath)) {
            $backData .= "Мэдээний " . $contentTitlePhotoThFileName . " нэртэй зураг файл сервер дээр байсан. <br/>";
        } else {
            $backData .= "Мэдээний " . $contentTitlePhotoThFileName . " нэртэй зураг файл сервер дээр байхгүй байсан. <br/>";
        }

        if (File::delete($titlePhotoThFilePath)) {
            $backData .= "Мэдээний зураг файл сервер-с амжилттай устгагдсан. <br/>";
        } else {
            $backData .= "Мэдээний зураг файл сервер-с устгах үед алдаа гарсан. <br/>";
        }

        return $backData;
    }

}

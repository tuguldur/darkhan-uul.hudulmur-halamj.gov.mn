<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Redirect;

class UploadController extends Controller {

    //
    public function uploadActionFileManager(Request $request) {
        $postData = $_POST;
        $backData = "";

        $data = $postData['fileUploadPath'];
        $destinationPath = substr($data, strpos($data, "/uploads") + 1);

        //echo(config('path_config.SYS_FILE_PATH.CONTENT_PDF_UPLOAD_PATH'));

        if (empty($postData) && !isset($postData['fileUploadManagerSaveBtn'])) {
            return "File upload post method was wrong!";
        }

        //chmod($destinationPath, 0777);

        $choosenUploadFile = $request->file('choosenFileToBeUpload');
        //$destinationPath = config('path_config.SYS_FILE_PATH.CONTENT_PDF_UPLOAD_PATH');

        if ($choosenUploadFile->move($destinationPath, $choosenUploadFile->getClientOriginalName())) {
            $backData .= "<b>" . $choosenUploadFile->getClientOriginalName() . "</b> нэртэй файл <b>" . $destinationPath . "</b> энэ зам луу зөөгдсөн.";
            $backStatus = "success";
        } else {
            $backStatus = "error";
            $backData .= "Алдаа: <b>" . $choosenUploadFile->getClientOriginalName() . "</b> нэртэй файлыг <b>" . $destinationPath . "</b> энэ зам луу зөөх үед алдаа гарсан.";
        }

        //chmod($destinationPath, 0755);

        if ($backStatus == "success") {
            session()->flash('form_success', $backData);
        } else {
            session()->flash('form_fail', $backData);
        }
        return Redirect::back();
    }

    public static function uploadContentPDFFile(Request $request) {
        $pdfFile = $request->file('newsPDFFile');
        $destinationPath = public_path() . config('path_config.SYS_FILE_PATH.CONTENT_PDF_UPLOAD_PATH');

        $pdfFileName = "news-pdf-" . rand(1001, 9999) . "-" . date("Y") . "-" . date("m") . "." . $pdfFile->extension();

        //if ($pdfFile->move($destinationPath, $pdfFile->getClientOriginalName())) {
        if ($pdfFile->move($destinationPath, $pdfFileName)) {
            //return $pdfFile->getClientOriginalName();
            return $pdfFileName;
        } else {
            return "error";
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

    public static function showUploadFileInfo(Request $request) {
        $file = $request->file('newsPDFFile');

        //Display File Name
        echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';

        //Display File Extension
        echo 'File Extension: ' . $file->getClientOriginalExtension();
        echo '<br>';

        //Display File Real Path
        echo 'File Real Path: ' . $file->getRealPath();
        echo '<br>';

        //Display File Size
        echo 'File Size: ' . $file->getSize();
        echo '<br>';

        //Display File Mime Type
        echo 'File Mime Type: ' . $file->getMimeType();

        //Move Uploaded File
        //$destinationPath = 'uploads/delger';
        //$file->move($destinationPath, $file->getClientOriginalName());
    }

}

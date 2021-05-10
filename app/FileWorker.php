<?php


namespace app;
use finfo;

//Данный класс реилзует работу с файловой системой
class FileWorker
{
    private static int $maxFileSize = 5*1024*1024;
    private static array $fileExtensions = ['jpg','jpeg','png','gif','svg'];
    private static array $fileTypes = ['image/gif','image/jpeg','image/png','image/pjpeg','image/svg'];

    public static function validateImg($uploadImg):bool
    {
        $fi = new finfo(FILEINFO_MIME_TYPE);
        @$currFileType = $fi->file($uploadImg['tmp_name']);


        $currFileSize = filesize($uploadImg['tmp_name']);


        $currFileExt = pathinfo($uploadImg['name'])['extension'];

        if(in_array($currFileExt, self::$fileExtensions) && in_array($currFileType, self::$fileTypes) && $currFileSize<=self::$maxFileSize)
        {
            return true;
        }else{
            return false;
        }
    }

    public function hashFileName(string $name):string
    {
        return time() . $name;
    }


    public function uploadOneImg($uploadImg, $path)
    {
        if(self::validateImg($uploadImg)){
            $newFileName = $this->hashFileName($uploadImg['name']);
            move_uploaded_file($uploadImg['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/imgs/{$path}/" . $newFileName);
            return $newFileName;
        }else{
            return "default-img.jpg";
        }

    }

    public function uploadMultiImgs($uploadImgs, $path){
        $correctFileNames = [];
        foreach ($uploadImgs['error'] as $key=>$error){
            if($error == UPLOAD_ERR_OK && $uploadImgs['size'][$key] < self::$maxFileSize && in_array($uploadImgs['type'][$key],self::$fileTypes)){
                $tmpName = $uploadImgs['tmp_name'][$key];
                $newName = $this->hashFileName($uploadImgs['name'][$key]);
                move_uploaded_file($tmpName,$_SERVER['DOCUMENT_ROOT'] . "/imgs/{$path}/" . $newName);
                $correctFileNames[] = $newName;
            }
        }
        return $correctFileNames;
    }

    public function deleteOneImg($fileName,$path):bool
    {
        if(is_dir($_SERVER['DOCUMENT_ROOT']."/imgs/".$path)){
            if(is_file($_SERVER['DOCUMENT_ROOT']."/imgs/".$path."/".$fileName)){
                var_dump('dd');
                if(unlink($_SERVER['DOCUMENT_ROOT']."/imgs/".$path."/".$fileName)){
                    var_dump('dddd');
                    return true;
                }

            }
        }
        return false;
    }

    public function multiDelete($fileNames,$path)
    {
        foreach($fileNames as $fileName){
            $this->deleteOneImg($fileName,$path);
        }
    }
}
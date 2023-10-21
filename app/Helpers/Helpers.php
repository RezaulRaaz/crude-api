<?php
namespace App\Helpers;
class Helpers
{
    public static function fileUpload($bs64EncodedFile,$fileUploadPath=null){
        $bs64imageSplit = explode(';base64,',$bs64EncodedFile);
        $bs64imageExtentionSplit = explode('/',$bs64imageSplit[0]);
        $bs64imageExtention=$bs64imageExtentionSplit[1];
        $decodedBs64image = base64_decode($bs64imageSplit[1]);
        $fileName= microtime().'.'.$bs64imageExtention;
        $fileNameWithoutSpaces=preg_replace('/\s+/','',$fileName);

        $uploadePath='images/';
        if(!empty($fileUploadPath)){
            $uploadePath=$uploadePath.$fileUploadPath.'/';
        }
        if(!file_exists($uploadePath)){
             mkdir($uploadePath,0777,true);
        }
        file_put_contents($uploadePath.$fileNameWithoutSpaces,$decodedBs64image);

        return $uploadePath.$fileNameWithoutSpaces;
    }
}

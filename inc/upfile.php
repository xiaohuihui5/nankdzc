<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/6
 * Time: 10:38
 */
function uploadFile( $fileInfo,$path="./upfile/excel",$allowExt=array('jpeg','jpg','png','tif'),$maxSize=10485760
){
    $filename=$fileInfo["name"];
    $tmp_name=$fileInfo["tmp_name"];
    $size=$fileInfo["size"];
    $error=$fileInfo["error"];

//服务器端设定限制

    $ext=pathinfo($filename,PATHINFO_EXTENSION);

//目的信息
    if (!file_exists($path)) {
        mkdir($path,0777,true);
        chmod($path, 0777);
    }
    $uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
    $destination=$path."/".$uniName;
    if ($error==0) {
        if ($size>$maxSize) {
            exit("上传文件过大！");
        }
        /*if (!in_array($ext, $allowExt)) {
            exit("非法文件类型");
        }*/
        if (!is_uploaded_file($tmp_name)) {
            exit("上传方式有误，请使用post方式");
        }
        //判断是否为真实图片（防止伪装成图片的病毒一类的
        /*if (!getimagesize($tmp_name)) {//getimagesize真实返回数组，否则返回false
            exit("不是真正的图片类型");
        }*/
        if (@move_uploaded_file($tmp_name, $destination)) {//@错误抑制符，不让用户看到警告
            echo "文件".$filename."上传成功!";
        }else{
            echo "文件".$filename."上传失败!";
        }
    }else{
        switch ($error){
            case 1:
                echo "超过了上传文件的最大值，请上传2M以下文件";
                break;
            case 2:
                echo "上传文件过多，请一次上传20个及以下文件！";
                break;
            case 3:
                echo "文件并未完全上传，请再次尝试！";
                break;
            case 4:
                echo "未选择上传文件！";
                break;
            case 7:
                echo "没有临时文件夹";
                break;
        }
    }
    return $destination;
}
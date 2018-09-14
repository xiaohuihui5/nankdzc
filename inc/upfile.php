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

//���������趨����

    $ext=pathinfo($filename,PATHINFO_EXTENSION);

//Ŀ����Ϣ
    if (!file_exists($path)) {
        mkdir($path,0777,true);
        chmod($path, 0777);
    }
    $uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
    $destination=$path."/".$uniName;
    if ($error==0) {
        if ($size>$maxSize) {
            exit("�ϴ��ļ�����");
        }
        /*if (!in_array($ext, $allowExt)) {
            exit("�Ƿ��ļ�����");
        }*/
        if (!is_uploaded_file($tmp_name)) {
            exit("�ϴ���ʽ������ʹ��post��ʽ");
        }
        //�ж��Ƿ�Ϊ��ʵͼƬ����ֹαװ��ͼƬ�Ĳ���һ���
        /*if (!getimagesize($tmp_name)) {//getimagesize��ʵ�������飬���򷵻�false
            exit("����������ͼƬ����");
        }*/
        if (@move_uploaded_file($tmp_name, $destination)) {//@�������Ʒ��������û���������
            echo "�ļ�".$filename."�ϴ��ɹ�!";
        }else{
            echo "�ļ�".$filename."�ϴ�ʧ��!";
        }
    }else{
        switch ($error){
            case 1:
                echo "�������ϴ��ļ������ֵ�����ϴ�2M�����ļ�";
                break;
            case 2:
                echo "�ϴ��ļ����࣬��һ���ϴ�20���������ļ���";
                break;
            case 3:
                echo "�ļ���δ��ȫ�ϴ������ٴγ��ԣ�";
                break;
            case 4:
                echo "δѡ���ϴ��ļ���";
                break;
            case 7:
                echo "û����ʱ�ļ���";
                break;
        }
    }
    return $destination;
}
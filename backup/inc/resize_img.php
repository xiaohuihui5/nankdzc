<?php
class resizeimage
{
    //ͼƬ����
    var $type;
    //ʵ�ʿ��
    var $width;
    //ʵ�ʸ߶�
    var $height;
    //�ı��Ŀ��
    var $resize_width;
    //�ı��ĸ߶�
    var $resize_height;
    //�Ƿ��ͼ
    var $cut;
    //Դͼ��
    var $srcimg;
    //Ŀ��ͼ���ַ
    var $dstimg;
    //��ʱ������ͼ��
    var $im;
    function resizeimage($img, $wid, $hei,$c,$dstpath)
    {
        $this->srcimg = $img;
        $this->resize_width = $wid;
        $this->resize_height = $hei;
        $this->cut = $c;
        //ͼƬ������
$this->type = strtolower(substr(strrchr($this->srcimg,"."),1));

        //��ʼ��ͼ��
        $this->initi_img();
        //Ŀ��ͼ���ַ
        $this -> dst_img($dstpath);
        //--
        $this->width = imagesx($this->im);
        $this->height = imagesy($this->im);
        //����ͼ��
        $this->newimg();
        ImageDestroy ($this->im);
    }
    function newimg()
    {
        //�ı���ͼ��ı���
        $resize_ratio = ($this->resize_width)/($this->resize_height);
        //ʵ��ͼ��ı���
        $ratio = ($this->width)/($this->height);
        if(($this->cut)=="1")
        //��ͼ
        {
            if($ratio>=$resize_ratio)
            //�߶�����
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio)
            //�������
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
                ImageJpeg ($newimg,$this->dstimg);
            }
        }
        else
        //����ͼ
        {
            if($ratio>=$resize_ratio)
            {
                $newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width)/$ratio, $this->width, $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio)
            {
                $newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height)*$ratio, $this->resize_height, $this->width, $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
        }
    }
    //��ʼ��ͼ��
    function initi_img()
    {
        if($this->type=="jpg")
        {
            $this->im = imagecreatefromjpeg($this->srcimg);
        }
        if($this->type=="gif")
        {
            $this->im = imagecreatefromgif($this->srcimg);
        }
        if($this->type=="png")
        {
            $this->im = imagecreatefrompng($this->srcimg);
        }
    }
    //ͼ��Ŀ���ַ
    function dst_img($dstpath)
    {
        $full_length  = strlen($this->srcimg);
        $type_length  = strlen($this->type);
        $name_length  = $full_length-$type_length;
        $name         = substr($this->srcimg,0,$name_length-1);
        $this->dstimg = $dstpath;
//echo $this->dstimg;
    }
}
//$resizeimage = new resizeimage("upfile/20130421112003.JPG","224","300","0","upfile/999.jpg");
?>

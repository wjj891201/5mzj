<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\libs;

/**
 * Description of Upload
 *
 * @author xm_pc
 */
class Upload
{

    private $errorNo;
    private $errMsg;
    private $name;
    private $ext;
    private $allow_ext;
    private $allow_size;
    private $size;
    private $dir;
    private $sub_dir;

    const DS = DIRECTORY_SEPARATOR;

    private $tmp_name;

    public function __construct($file, $dir = 'uploads', $allow_ext = ['jpg', 'png', 'gif', 'jpeg'], $allow_size = 2097152)
    {

        $this->errorNo = $file['error'];
        $this->name = $file['name'];
        $this->size = $file['size'];
        $this->tmp_name = $file['tmp_name'];
        $this->allow_ext = $allow_ext;
        $this->allow_size = $allow_size;
        $this->dir = $dir;
    }

    public function upload()
    {

        if (!$this->checkFile())
        {

            return $this->errMsg;
        }

        $this->createDir();

        return $this->move();
    }

    private function checkFile()
    {
        if (!$this->checkError())
        {
            $this->errMsg = '上传图片有问题';
            return false;
        }

        if (!$this->checkExt())
        {

            $this->errMsg = '上传图片的扩展名有问题';
            return false;
        }

        if (!$this->checkSize())
        {
            $this->errMsg = '上传图片的大小问题';
            return false;
        }
        return true;
    }

    //检测上传信息
    private function checkError()
    {
        if ($this->errorNo != 0)
        {
            return false;
        }
        return true;
    }

    //检测扩展名
    private function checkExt()
    {
        //验证文件的扩展名
        $this->ext = pathinfo($this->name, PATHINFO_EXTENSION);

        if (!in_array($this->ext, $this->allow_ext))
        {
            return false;
        }
        return true;
    }

    //检测大小
    private function checkSize()
    {


        if ($this->size > $this->allow_size)
        {
            return false;
        }
        return true;
    }

    //创建目录
    private function createDir()
    {

        $this->sub_dir = $this->dir . self::DS . date('Y-m-d');

        if (!is_dir($this->dir))
        {
            mkdir($this->dir);
            mkdir($this->sub_dir);
        }
        elseif (!is_dir($this->sub_dir))
        {
            mkdir($this->sub_dir);
        }
    }

    //移动文件到指定目录
    private function move()
    {
        $img_name = date('YmdHis') . rand(1000, 9999) . '.' . $this->ext;
        move_uploaded_file($this->tmp_name, $this->sub_dir . self::DS . $img_name);
        return $this->sub_dir . self::DS . $img_name;
    }

}

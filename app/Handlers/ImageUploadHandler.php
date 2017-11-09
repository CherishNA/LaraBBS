<?php

namespace App\Handler;
/**
 * Created by PhpStorm.
 * User: NA-PC
 * Date: 2017/11/9
 * Time: 16:49
 * desc：ImageUpload Class 图片上传处理
 */
class ImageUploadHandler
{
    //允许上传的图片类型
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    //存储图片
    public function save($file, $folder, $file_prefix)
    {

    }
}

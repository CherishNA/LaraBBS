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
        //目录规则  uploads/images/avators/201711/20
        //文件夹分割让查找效率更高  文件夹路径
        $folder_name = "uploads/images/$folder" . date('Ym', time()) . '/' . date("d", time()) . '/';
        //文件具体存储的物理路径 public_path() 获取的是 public 文件夹的物理路径
        //值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201711/20
        $upload_path = public_path();
        //获取文件的后缀名  因为图片从剪切板里黏贴是后缀名为空  所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        //拼接文件名 加后缀是为了增加辨析度 前缀可以是相关数据模型的ID
        //文件全名
        $file_name = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
        //如果不是上传图片 将终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }
        //将图片移动到目标存储路径中
        $file->move($upload_path, $file_name);
        return ['path' => config('app.url') . "/$folder_name/$file_name"];
        
    }
}

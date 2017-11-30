<?php

namespace App\Handler;

use Intervention\Image\Facades\Image;

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
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        //目录规则  uploads/images/avators/201711/20
        //文件夹分割让查找效率更高  文件夹路径
        $folder_name = "uploads/images/$folder" . date('Ym', time()) . '/' . date("d", time()) . '/';
        //文件具体存储的物理路径 public_path() 获取的是 public 文件夹的物理路径
        //值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201711/20
        $upload_path = public_path() . '/' . $folder_name;

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
        if ($max_width && $extension != 'gif') {
            //此类封装的函数 是进行剪裁操作
        $this->reduceSize($upload_path . '/' . $file_name, $max_width);
    }

        //设置端口
        $hostPort = ':' . config('app.hostport');
        return ['path' => config('app.url') . "$hostPort/$folder_name/$file_name"];

    }

    public function reduceSize($file_path, $max_width)
    {
        //先实例化  传参是文件的物磁盘物理路径

        $image = Image::make($file_path);

        //进行大小调整
        $image->resize($max_width, null, function ($constraint) {
            //设置宽度为$max_width 高度等比缩放
            $constraint->aspectRatio();
            //防止截图时图片尺寸变大
            $constraint->upsize();


        });
        //对修改后的图片进行保存
        $image->save();
    }
}

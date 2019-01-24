<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Up extends Model
{
    public function up($req,$tb)
    {
        // 获取表单上传文件
        $imgfile = request()->file('image');
        $videofile = request()->file('videoFile');
        // 移动到指定目录下
        if($imgfile){
            $info = $imgfile
            ->validate (['ext'=>'jpg,png,gif'])
            ->move(ROOT_PATH . 'public' . DS . 'static'. DS .'img');
            if($info){// 成功上传后 获取上传信息
              // echo '扩展名'.$info->getExtension();
              // // echo 'name'.$info->getFilename();
              $videoCover=array('videoCover'=>$info->getSaveName());
              $req=array_merge($req,$videoCover);
            }else{
              // 上传失败获取错误信息
              echo("<script>alert('请重新选择封面文件！".$imgfile->getError()."');window.location.href='Javascript:history.go(-1)'</script>");
              exit;
            }
        }
        if($videofile){
            $info = $videofile
                  ->validate (['ext'=>'mp4'])
                  ->move(ROOT_PATH . 'public' . DS . 'static'. DS .'video');
            if($info){// 成功上传后 获取上传信息
              // echo '扩展名'.$info->getExtension();
              // // echo 'name'.$info->getFilename();
              $videoLink=array('videoLink'=>$info->getSaveName());
              $req=array_merge($req,$videoLink);
            }else{
              // 上传失败获取错误信息
              echo("<script>alert('请重新选择视频文件！".$videofile->getError()."');window.location.href='Javascript:history.go(-1)'</script>");
              exit;
            }
        }
        $num=Db::name($tb)->where([
            $tb.'Id' => $req[$tb.'Id']
            ])->update($req);
              // ->buildSql();
        if($num){
            echo("<script>alert('修改成功！');window.location.href='".$tb."'</script>");
        }else{
            echo("<script>alert('修改失败！');window.location.href='Javascript:history.go(-1)'</script>");
        }
    }
}
<?php
namespace app\admin\model;
use think\Model;
use app\admin\model\User;
use app\admin\model\Video;

class Dl extends Model
{
    public function dl($req,$tb)
    {
      $tb=='video'?$num=Video::destroy($req):$num=User::destroy($req);
      if($num==count($req)){
        echo("<script>alert('删除成功！');window.location.href='".$tb."'</script>");
      }else{
        echo("<script>alert('删除失败！');window.location.href='Javascript:history.go(-2)'</script>");
      }
    }
}

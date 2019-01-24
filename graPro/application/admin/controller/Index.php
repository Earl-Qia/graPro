<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\View;
use think\Db;
use app\admin\model\Video;
use app\admin\model\User;
use app\admin\model\Up;
use app\admin\model\Dl;
use app\admin\model\Sa;

class Index extends Controller
{
    public function index(Request $req)
    {
        $tb=$req->get('tb');
        empty($tb)?:session('tb',$tb);
        $tb=$req->session('tb');
        empty($tb)?$tb='video':$tb=$tb;
        return $this->play($req,$tb);
    }
    public function play($req,$tb)
    {
        $tb=='video'?$tbName='Video':$tbName="User";
        if ($req->ispost()&&count($req->post())) {
            if($req->post($tb.'Id')){
                //更改
                $dpup = new Up();
                $dpup->up($req->post(),$tb);
            }elseif($req->post('iss/a')){
                // 批量删除
                $dpdl =new Dl();
                $dpdl->dl($req->post('iss/a'),$tb);
            }else{
                //添加
                $dpdl =new Sa();
                $dpdl->sa($req->post(),$tb);
            }
        } elseif($req->get('e')){
            $i=$req->get('i');
            switch ($req->get('e')) {
                case '1':
                $dpdl =new Dl();
                $dpdl->dl($i,$tb);
                break;
                case '2':
                $tb=='video'?$sq=Video::get($i):$sq=User::get($i);
                $this->assign('sq',$sq);
                $this->assign($tb.'Id',$i);
                return $this->fetch('edit'.$tbName);
                break;
                case '3':
                    return $this->fetch('save'.$tbName);
                    break;
                default:
                break;
            }
        }elseif($req->get('vlink')){
            $this->assign('vlink',$req->get('vlink'));
            $this->assign('page',request()->action());
            return $this->fetch('showVideo');
        }else{
            // 查询数据 并且每页显示5条数据
            $tbName=='Video'?$list = Video::order('videoId','desc')->paginate(5):$list = User::order('userId','desc')->paginate(5);
            // 把分页数据赋值给模板变量list
            $this->assign('list', $list);
            // 渲染模板输出
            return $this->fetch($tb);
        }
    }

}


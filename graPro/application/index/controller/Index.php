<?php
namespace app\index\controller;
use think\Controller;
use think\Config;
use think\View;
use think\Db;
use think\Request;
use app\index\model\Video;
use app\index\model\Clear;

class Index extends Controller
{

    public function index(Request $req)
    {
        if($req->get('a')){
            $link=$req->get('link');
            return $this->playVideo($link);
            // $this->redirect("Index/playVideo");
        }
        if($req->ispost()&&count($req->post('aaa'))){
            echo "ispost".count($req->post('aaa'));
            dump($req->post('aaa'));
        }
        // 查询数据 并且每页显示8条数据
        $list = Db::name('video')->paginate(8);
        // 把分页数据赋值给模板变量list
        $this->assign('list', $list);
        // 渲染模板输出
        return $this->fetch();
    }
    public function playVideo($link)
    {
        $this->assign('vlink',$link);
        return $this->fetch('playVideo');
    }
    public function login()
    {
        return $this->fetch('login');
    }
    public function enroll()
    {
        return $this->fetch('enroll');
    }
}

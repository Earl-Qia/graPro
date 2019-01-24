<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
class Compile extends Controller
{
    public function compile(Request $req)
    {
        echo "this is compile";
    }
}
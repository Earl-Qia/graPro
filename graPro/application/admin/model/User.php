<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    use SoftDelete;
    protected $autoWriteTimestamp = true;
    protected $createTime="createTime";
    protected $updateTime=false;
    protected $deleteTime="deleteTime";

}
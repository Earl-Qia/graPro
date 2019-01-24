<?php
/**
 * @Author: Marte
 * @Date:   2018-11-19 14:51:57
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-11-21 19:05:48
 */
namespace app\index\model;
use think\Model;
use traits\model\SoftDelete;

class Video extends Model
{
    use SoftDelete;
    protected $autoWriteTimestamp = true;
    protected $createTime="videoTime";
    protected $updateTime=false;
    protected $deleteTime="deleteTime";
}

<?php
namespace app\index\model;
use traits\model\SoftDelete;
use app\index\model\Video;
/**
*
*/
class Clear
{
    use SoftDelete;
    protected $autoWriteTimestamp = true;
    protected $createTime="videoTime";
    protected $updateTime=false;
    protected $deleteTime="deleteTime";
    public function clear($id)
    {
        echo "this is clear";
        dump($id);
        $countId=count($id);
        for ($i=0; $i < $countId; $i++) {
            echo "$id[$i]";
            $sql=Video::destroy($id[$i],true);
            dump($sql);
        }
    }
}
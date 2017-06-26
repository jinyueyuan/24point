<?php
/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2015/12/26
 * Time: 20:24
 */
require_once 'produce.php';
require_once 'consume.php';
require_once 'writeDB.php';
class handle{
    private $picc;
    private $str;
    public function han() //对用户操作进行判断
    {
        if (isset($_POST['submit']) && $_POST['submit'] == "开始游戏" || isset($_POST['submitted']) && $_POST['submitted'] == "重新游戏") {
            $getpic = new produce();    //选出4张牌
            $picc = $getpic->pro();    //得到图片的路径，$picc是一个数组
            $this->picc = $picc;
            $num = $getpic->handle();   //得到4张牌的数字，$num是一个数组
            $pic_str = serialize($picc);   //对数组$picc进行序列化
            $num_str = serialize($num);   //对数组$num进行序列化
            setcookie('picc', $pic_str, time() + 3600, '/');   //将图片路径存进cookie
            setcookie('numm', $num_str, time() + 3600, '/');   //将4个数字存进cookie
        }
        if (isset($_POST['submitted']) && $_POST['submitted'] == "求解") {
            $obj = new consume();     //创建一个consume对象
            $arr_str = $_COOKIE['picc'];   //获得cookie值，即得到图片路径
            $picc = unserialize($arr_str);   //将路径非序列化成数组
            $this->picc = $picc;
            $numm_str = $_COOKIE['numm'];   //获得cookie值，即得到4个数字
            $numm = unserialize($numm_str);   //将4个数非序列化成数组
            $str = $obj->main($numm);       //对4张牌进行24点求解
            if ($str == "") {             //判断是否有解
                $str = "无法构成24点";
                $this->str = $str;
            } else{
                $this->str=$str;       //有解
                new writeDB($numm, $str);     //将所有解和4个数字写进数据库
            }
        } else {
            $str = "";
            $this->str = $str;
        }
    }
    public function getpicc(){    //返回图片路径数组
        return $this->picc;
    }
    public function getstr(){     //返回4个数数组
        return $this->str;
    }
}
?>
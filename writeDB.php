<?php
require_once 'connDB.php';
const LENGTH=4;
/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2015/12/23
 * Time: 21:01
 */
class writeDB
{
    private $num;  //存4个整数的数组
    private $string;
    public function __construct($num,$string)  //构造函数
    {
        $this->num=$num;
        $this->string=$string;
        $this->selectSort();  //对4个整数按从小到大进行排序
        $this->write();   //将所有解写进数据库
    }
    public function selectSort()  //对4个整数按从小到大进行排序
    { //对四个数进行排序，再存进数据库
        for ($i = 0; $i < LENGTH - 1; $i++) {   //利用选择选择排序算法
            $minindex = $i;
            for ($j = $i + 1; $j < LENGTH; $j++) {
                if ($this->num[$j] < $this->num[$minindex])
                    $minindex = $j;    //选出第i小的下标
            }
            if ($minindex != $i) {  //进行交换
                $temp = $this->num[$i];
                $this->num[$i] = $this->num[$minindex];
                $this->num[$minindex] = $temp;
            }
        }
    }
    private function write()    //将4个整数和所有解写进数据库
    {
        $a=$this->num[0];
        $b=$this->num[1];
        $c=$this->num[2];
        $d=$this->num[3];
        $sql="INSERT INTO 24dian(first_num,second_num,third_num,fouth_num,result) VALUES ($a,$b,$c,$d,'$this->string')";
        if(!mysql_query($sql))  //因为first_num,second_num,third_num,fouth_num四个数构成主码，所以存在重复插入失败的情况，所以不再进行插入
            echo "所有解已存在数据库中";
    }
}
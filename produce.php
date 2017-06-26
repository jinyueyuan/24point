<?php

/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2015/12/23
 * Time: 16:11
 */

class produce
{
    private $first;  //第一个数字
    private $second;
    private $third;
    private $fouth;
    private $firstpic;   //第一张牌的图片路径
    private $secondpic;
    private $thirdpic;
    private $fouthpic;

    public function pro()  //随机从52张牌中选出4张
    {
        $this->firstpic = rand(1, 52);
        $this->secondpic = rand(1, 52);
        $this->thirdpic = rand(1, 52);
        $this->fouthpic = rand(1, 52);
        $pic=array($this->firstpic,$this->secondpic,$this->thirdpic,$this->fouthpic);
        return $pic;  //返回图片路径数组
    }
    public function handle(){  //算出牌的点数
        $this->first=$this->firstpic%13==0?13:$this->firstpic%13;
        $this->second=$this->secondpic%13==0?13:$this->secondpic%13;
        $this->third=$this->thirdpic%13==0?13:$this->thirdpic%13;
        $this->fouth=$this->fouthpic%13==0?13:$this->fouthpic%13;
        $number=array($this->first,$this->second,$this->third,$this->fouth);
        return $number;  //返回点数数组
    }
}
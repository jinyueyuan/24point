<?php
const LIMIT=1E-6;
/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2015/12/23
 * Time: 16:13
 */
class consume
{
    private $countt;
    private function is24($length, $copynum, $expre)  //判断能否构成24点
    {
       static $dbd = "";
       if ($length == 1)  //当只剩一个数时，判断结果是否为24
       {
           if (abs($copynum[0] - 24) < LIMIT) {
               $dbd .= $expre[0] . ',';
               $this->countt++;
                if ($this->countt % 3 == 0)
                      $dbd =$dbd."\n" ;
               return true;
           }
       }
       for ($i = 0; $i < $length; $i++)  //两层循环，遍历4个数的组合
           for ($j = $i + 1; $j < $length; $j++) {

               $a = $copynum[$i];//存原始数据
               $b = $copynum[$j]; //存原始数据
               $exprea = $expre[$i];  //存表达式
               $expreb = $expre[$j];  //存表达式
               $copynum[$j] = $copynum[$length - 1];  //将后面的数赋值给copynum[j]，便于下次计算使用
               $expre[$j] = $expre[$length - 1];  //将后面的表达式赋值给expre[j]，便于下次使用
               if ($length == 2)
                   $expre[$i] = $exprea . '+' . $expreb;
               else
                   $expre[$i] = '(' . $exprea . '+' . $expreb . ')';  //加法的式子
               $copynum[$i] = $a + $b;
               $this->is24($length - 1, $copynum, $expre) . ',';  //递归判断
               if ($length == 2)
                   $expre[$i] = $exprea . '-' . $expreb;
               else
                   $expre[$i] = '(' . $exprea . '-' . $expreb . ')';  //减法式子要区分减数与被减数
               $copynum[$i] = $a - $b;
               $this->is24($length - 1, $copynum, $expre) . ',';
               if ($length == 2)
                   $expre[$i] = $exprea . '-' . $expreb;
               else
                   $expre[$i] = '(' . $expreb . '-' . $exprea . ')';
               $copynum[$i] = $b - $a;
               $this->is24($length - 1, $copynum, $expre) . ',';
               if ($length == 2)
                   $expre[$i] = $exprea . '*' . $expreb;
               else
                   $expre[$i] = '(' . $exprea . '*' . $expreb . ')';  //乘法式子
               $copynum[$i] = $a * $b;
               $this->is24($length - 1, $copynum, $expre) . ',';
               if ($b != 0) //除法要判断除数不为0
               {
                   if ($length == 2)
                       $expre[$i] = $exprea . '/' . $expreb;
                   else
                       $expre[$i] = '(' . $exprea . '/' . $expreb . ')';
                   $copynum[$i] = $a / $b;
                   $this->is24($length - 1, $copynum, $expre) . ',';
               }
               if ($a != 0) {
                   if ($length == 2)
                       $expre[$i] = $exprea . '/' . $expreb;
                   else
                       $expre[$i] = '(' . $expreb . '/' . $exprea . ')';
                   $copynum[$i] = $b / $a;
                   $this->is24($length - 1, $copynum, $expre) . ',';
               }
               $copynum[$i] = $a;   //若前面组合不满足24点，则复原数据，进入下一次循环
               $copynum[$j] = $b;
               $expre[$i] = $exprea;
               $expre[$j] = $expreb;
               if ($i == 2 && $j == 3)  //当循环完成，返回所有解
                   return $dbd;
           }
   }

    function main($num)    //传入一个有4个数字的数组作为参数
    {
        $copynum = array();
        $expre = array();
        for ($i = 0; $i < 4; $i++) {
            $copynum[$i] = $num[$i];  //$copynum用来存当前结果值
            $str = $copynum[$i];
            $expre[$i] = $str;    //$expre用来存当前表达式
        }
        $dbd=$this->is24(4, $copynum, $expre);  //调用is24()进行判断
        return $dbd;    //返回所有解
    }

}
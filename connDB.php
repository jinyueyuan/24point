<?php

/**
 * Created by PhpStorm.
 * User: jinzil
 * Date: 2015/12/23
 * Time: 20:56
 */
class connDB{
    var $host;
    var $user;
    var $pwd;
    var $dbname;
    var $result;
    var $conn;
    function __construct($host,$user,$pwd,$dbname){
        $this->host=$host;       //定义主机名
        $this->user=$user;       //定义用户名
        $this->pwd=$pwd;         //定义密码
        $this->dbname=$dbname;  //定义数据库名
    }
    function  getConn(){
        $this->conn=mysql_connect($this->host,$this->user,$this->pwd)or die('数据库服务器连接失败').mysql_error();
        mysql_select_db($this->dbname,$this->conn)or die('数据库访问失败').mysql_error();
        mysql_query("SET NAMES 'utf8'");
        return $this->conn;
    }
    function closeConn($result){
        $this->result=$result;
        mysql_free_result($this->result);  //释放结果集
        mysql_close($this->conn);          //断开连接
    }
}
$connDB=new connDB('localhost','root','123456','mydb');
$getConnDB=$connDB->getConn();
?>
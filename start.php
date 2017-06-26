<!--游戏开始界面-->
<?php
require_once 'handle.php';
$object=new handle();
$object->han();
$picc=$object->getpicc();
$str=$object->getstr();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>24点游戏</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div id="tolpicture">
    <div class="pic1"><img src="picture/<?php echo $picc[0].'.jpg'?>"  style="width:120px;height:180px" /></div>
    <div class="pic1"><img src="picture/<?php echo $picc[1].'.jpg'?>" style="width:120px;height:180px" /></div>
    <div class="pic1"><img src="picture/<?php echo $picc[2].'.jpg'?>" style="width:120px;height:180px" /></div>
    <div class="pic1"><img src="picture/<?php echo $picc[3].'.jpg'?>" style="width:120px;height:180px" /></div>
</div>
<div id="content" align="center">
    <p>对上面4张牌进行24点运算</p>
    <form action="start.php" method="post">
        <div>
        <input type="submit" name="submitted" value="求解" />
            &nbsp;
        <input type="submit"  name="submitted" value="重新游戏" />
        </div>
        <div id="answer">
            <textarea name="answerr" id="an" ><?php echo $str;?> </textarea>
        </div>
    </form>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<!--适应设备的宽度设置字符集-->
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" charset="UTF-8">
<title>飘动表白墙</title>
<style>
/*加入css自适应模块*/
<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 600px)" href="style/css/css600.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 600px) and (max-device-width: 980px)" href="css600-980.css" /> 
html{
    font-size:62.5%;
} 
body {
background-size: cover;//注满
background-attachment: fixed;//给他定住
background-repeat: repeat-y;//允许y轴重复
font-family: KaiTi;
font-size: 1.2rem;
color: orange; 
padding :0;
margin :0;
}
input{
			height: 40px;
			color:white;
			background-color:cornflowerblue;
			border-radius: 3px;
			border-width: 0;
            margin: 0;
            font-size: 1.2rem;
			outline: none;
            font-family: KaiTi;//input无法继承body
			text-align: center;
			cursor: pointer;
		}
		input:hover{
            background-color: gray;
        }
</style>
</head>
<body background="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1592651752180&di=b660968bde82186eed147e3ff7e78db1&imgtype=0&src=http%3A%2F%2Fimg-download.pchome.net%2Fdownload%2F1k1%2Fee%2F2k%2Folyjst-mvf.jpg">
<!--调用一言api-->
<script type="text/javascript" src="https://api.uixsj.cn/hitokoto/get?type=zha&code=js"></script><div align="center" style="color:white;opacity:0.6;
filter:alpha(opacity=60)" id="zha"><script>zha()</script></div>
<!--背景音乐Faded+If you-->
<audio autoplay="autoplay" src="http://aod.cos.tx.xmcdn.com/group14/M01/92/B4/wKgDY1dfi2XQQz6rAB_-0pTygW4326.mp3"></audio>
<br/>
<marquee>
<?php
function query($query,$mysqli){//先整个取出数据的方法
	$result = $mysqli->query($query);
	$rows = $result->fetch_all(MYSQLI_ASSOC);//取出所有查询的结果并得到一个关联数组
	$result->close();//养成好习惯
	return $rows;
}
function execute($query,$mysqli){//再整个执行的方法
	$mysqli->query($query) or die ('你网络很垃圾');
}

/*连接数据库*/
$mysqli = new mysqli("127.0.0.1","exw","fjf88888","exw","3306");
mysqli_set_charset($mysqli,"utf8");
/*查询一下是否有Post有的话插入*/
if (isset($_POST['et'])){
	execute("insert into `exw`.`words` (`wd`) values ('".$_POST['et']."') ",$mysqli);
}

$rows = query('select * from words',$mysqli);
/*记个数好换行*/
$i = 0;
$j = 3;
$n = 0;
if(count($rows)>50){
	$j = 5;
}
foreach ($rows as $value){
	foreach($value as $val){
		if(trim($val) == trim($_POST['et'])){//显红效果
		echo '<span style="border:2px dotted red;color:red;">'.$val.'</span>';
		unset($_POST['et']);
		}
		else{
			?>
			<!--彩色弹幕-->
			<span style="color:<?php printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>">
			<?php echo $val.'</span>';
		}
		$k = mt_rand(3,12);//整点随机空格弄一下效果
		while($n<$k){
			echo '&nbsp;';
			$n++;
		}
		$n=0;
		$i++;
		if($i == $j){
			echo '<br/>';
			$k = mt_rand(1,12);//整点随机空格弄一下效果
			for ($i = 0;$i < $k;$i++){
				echo '&nbsp;';
			}
			$i = 0;
		}
	}
}
$mysqli->close();//好习惯
?>	
</marquee>
<form action="#" method="post">
<div style="position:fixed;bottom:2rem;width:100%;text-align:center">
<input style="width:16%" type="submit" value="发射"/> <input id="et" name="et" style="width:80%" type="text" pattern="[\s\S]{3,40}" required title="至少三个字哦😊,不要超过四十个^_^" placeholder="说点想说的话吧，至少三个字哦😊" />
</div>
<!--署个不怎么起眼的名嘿嘿-->
<p style="opacity:0.3;filter:alpha(opacity=30);color:palegoldenrod;position:fixed;bottom:0;right:0;font-size:1rem;">Designed by Netgiant(Mr.Fu)</p>
</form>
</body>
</html>
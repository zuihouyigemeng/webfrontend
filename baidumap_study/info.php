<!DOCTYPE html> 
<?php 

$conn=mysql_connect("","","") or die("can not connect to server"); 
mysql_select_db("",$conn); 
mysql_query("set names utf8"); 
$sql0="select * from car_info where carID='20140508'order by id desc limit 1"; 
$sql1="select * from car_info where carID= '20140510' order by id desc limit 1"; 
$sql=array($sql0,$sql1); 

function htmtocode($content){ 
$content=str_replace("\n", "<br>", str_replace(" ", " ", $content)); 
return $content; 
} 
?> 
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>信息展示</title> 

<style type="text/css"> 
html{ 
height:90%;} 
body{ 
height:90%; 
width:90%; 
font-family:楷体_GB2312; 
font-size:20px} 
</style> 
</head> 
<body BGCOLOR="#CAFFFF"> 
<H1 ALIGN="CENTER"> 信息展示 </H1> 
<?php foreach ($sql as &$value) { 
$query=mysql_query($value); 
$row=mysql_fetch_array($query); 
?> 
<H2>car <?php echo $row[carID]?> 详细信息</H2> 
<HR> 
CAR ID: <?php echo $row[carID]?><br> 
经度: <?php echo $row[longitude]?> <br> 
纬度: <?php echo $row[latitude]?> <br> 
速度: <?php echo $row[speed]?> Km/h <br> 
加速度: <?php echo $row[acceleration]?><br> 
方向: <?php echo $row[direction]?> <br> 
油量: <?php echo $row[oil]?><br> 
地址: <?php echo $row[street]?><br> 
时间: <?php echo $row[date]?> 
<?php } ?> 
</body> 
</html> 
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
<title>��Ϣչʾ</title> 

<style type="text/css"> 
html{ 
height:90%;} 
body{ 
height:90%; 
width:90%; 
font-family:����_GB2312; 
font-size:20px} 
</style> 
</head> 
<body BGCOLOR="#CAFFFF"> 
<H1 ALIGN="CENTER"> ��Ϣչʾ </H1> 
<?php foreach ($sql as &$value) { 
$query=mysql_query($value); 
$row=mysql_fetch_array($query); 
?> 
<H2>car <?php echo $row[carID]?> ��ϸ��Ϣ</H2> 
<HR> 
CAR ID: <?php echo $row[carID]?><br> 
����: <?php echo $row[longitude]?> <br> 
γ��: <?php echo $row[latitude]?> <br> 
�ٶ�: <?php echo $row[speed]?> Km/h <br> 
���ٶ�: <?php echo $row[acceleration]?><br> 
����: <?php echo $row[direction]?> <br> 
����: <?php echo $row[oil]?><br> 
��ַ: <?php echo $row[street]?><br> 
ʱ��: <?php echo $row[date]?> 
<?php } ?> 
</body> 
</html> 
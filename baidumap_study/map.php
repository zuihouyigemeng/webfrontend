<!DOCTYPE html> 
<?php 
/* 
���������ݿ������ 
*/ 
$conn=mysql_connect("","","") or die("can not connect to server"); 
mysql_select_db("hdm0410292_db",$conn); 
mysql_query("set names utf8"); 
//ѡ����������������������,�������������������� 
$sql0="select * from car_info where carID='20140508'order by id desc limit 1"; 
$sql1="select * from car_info where carID= '20140510' order by id desc limit 1"; 
$sql=array($sql0,$sql1); 
?> 
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>��������Ϣչʾ</title> 

<style type="text/css"> 
	html{ 
	height:99%} 
	body{ 
	height:99.9%; 
	width:99%; 
	font-family:����_GB2312; 
	font-size:25px} 
	#container {height: 100%} 
</style> 

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=oCbw1Qz8ayXfZKlgDHKyfsWG"></script>


</head> 

<body BGCOLOR="#CAFFFF"> 
    <div id="container"></div> 
	
	<script type="text/javascript">
		var lon_center = 0; 
		var lat_center = 0; 
		var map = new BMap.Map("container"); 
		
		<!-- ��ӱ�ע�ĺ��������������������꣬��ID���Լ����ݿ����������Ϣ--> 
		function addMarker(point,index,s){ 
		var fIcon = new BMap.Icon("car1.png", new BMap.Size(55, 43), { 

		}); 
		var sIcon = new BMap.Icon("car2.png", new BMap.Size(55, 43), { 

		}); 
		var myIcon = ""; 
		// ������ע������ӵ���ͼ 
		if(index == 20140508) 
		myIcon=fIcon; 
		else 
		myIcon=sIcon; 
		var marker = new BMap.Marker(point, {icon: myIcon}); 
		map.addOverlay(marker); 
		marker.addEventListener("click",function(){ 
		var opts={width:450,height:500,title:"��ϸ��Ϣ"}; 
		var infoWindow = new BMap.InfoWindow(s,opts); 
		map.openInfoWindow(infoWindow,point); 
		}); 
		} 
		<?php 
		//���������������sql��� 
		foreach ($sql as &$value) { 
		$query=mysql_query($value); 
		$row=mysql_fetch_array($query); 
		?> 
		var lon= <?php echo $row[longitude] ?>; 
		var lat= <?php echo $row[latitude] ?>; 
		<!-- ��������������ĵ㣬��������Ϊ��ͼ��ʼ��ʱ������λ��--> 
		lon_center += lon; 
		lat_center += lat; 
		var id=<?php echo $row[id] ?>; 
		var info="<br/>"+"carID: " + "<?php echo $row[carID]?>" + " <br/> " + 
		"����: " + "<?php echo $row[longitude]?>" + " <br/> " + 
		"γ��: " + "<?php echo $row[latitude]?>" + " <br/> " + 
		"�ٶ�: " + "<?php echo $row[speed]?>" + "Km/h"��+��" <br/> " + 
		"���ٶ�: " + "<?php echo $row[acceleration]?>" + " <br/> " + 
		"����: " + "<?php echo $row[direction]?>" + " <br/> " + 
		"����: " + "<?php echo $row[oil]?>" + "<br/>" + 
		"��ַ: " + "<?php echo $row[street]?>"; 
		var point = new BMap.Point(lon, lat); 
		addMarker(point,<?php echo $row[carID] ?>,info); 
		<?php 
		} 
		?> 
		<!-- ��������������ĵ㣬��������Ϊ��ͼ��ʼ��ʱ������λ��--> 
		var center = new BMap.Point(lon_center/2,lat_center/2); 
		map.centerAndZoom(center, 17); 
		map.enableScrollWheelZoom(); 
</script> 
</body> 
	

</html> 
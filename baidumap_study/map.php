<!DOCTYPE html> 
<?php 
/* 
创建与数据库的连接 
*/ 
$conn=mysql_connect("","","") or die("can not connect to server"); 
mysql_select_db("hdm0410292_db",$conn); 
mysql_query("set names utf8"); 
//选择出两辆车插入的最新数据,并将两条语句存在数组里 
$sql0="select * from car_info where carID='20140508'order by id desc limit 1"; 
$sql1="select * from car_info where carID= '20140510' order by id desc limit 1"; 
$sql=array($sql0,$sql1); 
?> 
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>车联网信息展示</title> 

<style type="text/css"> 
	html{ 
	height:99%} 
	body{ 
	height:99.9%; 
	width:99%; 
	font-family:楷体_GB2312; 
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
		
		<!-- 添加标注的函数，参数包括，点坐标，车ID，以及数据库里的其他信息--> 
		function addMarker(point,index,s){ 
		var fIcon = new BMap.Icon("car1.png", new BMap.Size(55, 43), { 

		}); 
		var sIcon = new BMap.Icon("car2.png", new BMap.Size(55, 43), { 

		}); 
		var myIcon = ""; 
		// 创建标注对象并添加到地图 
		if(index == 20140508) 
		myIcon=fIcon; 
		else 
		myIcon=sIcon; 
		var marker = new BMap.Marker(point, {icon: myIcon}); 
		map.addOverlay(marker); 
		marker.addEventListener("click",function(){ 
		var opts={width:450,height:500,title:"详细信息"}; 
		var infoWindow = new BMap.InfoWindow(s,opts); 
		map.openInfoWindow(infoWindow,point); 
		}); 
		} 
		<?php 
		//遍历数组里的两条sql语句 
		foreach ($sql as &$value) { 
		$query=mysql_query($value); 
		$row=mysql_fetch_array($query); 
		?> 
		var lon= <?php echo $row[longitude] ?>; 
		var lat= <?php echo $row[latitude] ?>; 
		<!-- 计算两个点的中心点，并将其作为地图初始化时的中心位置--> 
		lon_center += lon; 
		lat_center += lat; 
		var id=<?php echo $row[id] ?>; 
		var info="<br/>"+"carID: " + "<?php echo $row[carID]?>" + " <br/> " + 
		"经度: " + "<?php echo $row[longitude]?>" + " <br/> " + 
		"纬度: " + "<?php echo $row[latitude]?>" + " <br/> " + 
		"速度: " + "<?php echo $row[speed]?>" + "Km/h"　+　" <br/> " + 
		"加速度: " + "<?php echo $row[acceleration]?>" + " <br/> " + 
		"方向: " + "<?php echo $row[direction]?>" + " <br/> " + 
		"油量: " + "<?php echo $row[oil]?>" + "<br/>" + 
		"地址: " + "<?php echo $row[street]?>"; 
		var point = new BMap.Point(lon, lat); 
		addMarker(point,<?php echo $row[carID] ?>,info); 
		<?php 
		} 
		?> 
		<!-- 计算两个点的中心点，并将其作为地图初始化时的中心位置--> 
		var center = new BMap.Point(lon_center/2,lat_center/2); 
		map.centerAndZoom(center, 17); 
		map.enableScrollWheelZoom(); 
</script> 
</body> 
	

</html> 
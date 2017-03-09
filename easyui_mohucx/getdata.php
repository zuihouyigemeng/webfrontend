<?php
	//echo $_POST['q'];
	if($_POST['q']=='1')
	{
		$A[0]['stcm_car_license'] = "1";
		$A[1]['stcm_car_license'] = "11";
		$A[2]['stcm_car_license'] = "111";
		$A[3]['stcm_car_license'] = "1111";
	}else{
		$A[0]['stcm_car_license'] = "2";
		$A[1]['stcm_car_license'] = "22";
		$A[2]['stcm_car_license'] = "222";
		$A[3]['stcm_car_license'] = "2222";		
	}
	echo json_encode($A);  
	
?>
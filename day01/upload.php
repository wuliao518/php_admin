<?php
	$file=$_FILES['upfile'];
	$msg=upload($file);
	echo $msg;
	function upload($file){
	 	$error=array('1'=>'类型不正确','2'=>'图片大小超图限制','3'=>'服务器未知错误');
	 	$default_type=array("jpg","gif","bmp","jpeg","png");
		$error_num=0;
		$default_size=2*1024*1024;	
		$type=$file['type'];
		$size=$file['size'];
		$path='./images/';
		$name=$name=time();
		$postfix=substr($file['name'],strpos($file['name'],'.'));
		switch ($type) {
		 	case 'image/jpeg':
		 		break; 	
		 	default:
		 		$error_num=1;
		 		return $error[$error_num];
		 		break;
		}
		if($size>$default_size){
		 	$error_num=2;
		 	return $error[$error_num];
		}
		
		if (move_uploaded_file($file['tmp_name'],$path.$name.$postfix)){
		 	return 'OK';
		}else{
		 	$error_num=3;
		 	return $error[$error_num];
		}
	}

		  
?>
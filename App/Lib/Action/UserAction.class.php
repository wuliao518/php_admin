<?php
	class UserAction extends Action{
		public function add(){
			$model=D('User');
			session_start();
			if($model->create()){
				if($user_id=$model->add()){
					$session_id=session_id();
					$username=$_POST['username'];
					session('username',$username);
					echo(json_encode(array('status'=>1,'message'=>'success','token'=>$session_id,'user_id'=>$user_id)));
				}else{
					echo(json_encode(array('status'=>0,'message'=>$model->getError(),'token'=>null,'user_id'=>null)));
				}
			}else{
				echo (json_encode(array('status'=>2,'message'=>'fail','token'=>null,'user_id'=>null)));
			}
			
		}
		public function login(){
			$model=M('User');
			session_start();
			$session_id=session_id();
			$phone_num=$_POST['phone_num'];
			$_SESSION['id']=$session_id;
			$_SESSION['phonenum']=$phone_num;		
			$condition['phone_num']=$phone_num;
			$condition['password']=md5($_POST['password']);
			if($res=$model->field('user_id,username,phone_num,modify_time')->where($condition)->select()){
				echo json_encode(array(
					'status'=>1,'token'=>$session_id,'user'=>$res
					));
			}else{
				echo json_encode(array(
					'status'=>0,'token'=>null,'user'=>null
					));
			}
		}
		public function validate(){
			$model=M('User');
			$str=$_GET['token'];
			session_id($str);
			session_start();
			$username=$_GET['phone_num'];
			if(session('phone_num')==$phone_num){
				echo json_encode(array('status'=>1,'token'=>session_id()));
			}else{
				echo json_encode(array('status'=>0,'token'=>session_id(),));
			}
			//$where['groupname']=array('like',"%{$str}%");
			
		}
		public function selectUserAtGroup(){
			$model=D('Item');
			$condition['group_id']=$_GET['group_id'];
			$arr= array();
			$res=$model->field('user_id')->where($condition)->select();
			foreach ($res as $key => $value) {
				$arr[$key]=$value['user_id'];
			}
			$result=array();
			$user=D('User');
			foreach ($arr as $key => $value) {
				$temp=$user->field('user_id,username,phone_num,modify_time')->
					where(array('user_id'=>$value))->limit(1)->select();
				$result=array_merge($temp,$result);
			}
			echo json_encode(array('status'=>1,'message'=>$result));
		}
		public function selectGroupFromUser(){
			$model=D('Group');
			$condition['user_id']=$_GET['user_id'];
			$arr= array();
			$res=$model->field('group_id')->where($condition)->select();
			foreach ($res as $key => $value) {
				$arr[$key]=$value['group_id'];
			}
			$result=array();
			$user=D('User');
			$temp=array();
			foreach ($arr as $key => $value) {
				$temp[$key]=$user->where(array('group_id'=>$value))->limit(1)->select();
				//$result=array_merge($temp,$result);
			}
			echo json_encode(array('status'=>1,'message'=>$temp));
		}
		public function test(){
			$model=D('Item');
			$user=D('Group');
			$result=array();
			$condition['user_id']=$_GET['user_id'];
			if($res=$model->field('group_id')->where($condition)->select()){
				foreach ($res as $key => $value) {
					if($temp=$user->where(array('group_id'=>$value['group_id']))->limit(1)->select()){
						$result=array_merge($temp,$result);
					}else{
						echo json_encode(array(
						'status'=>0,'groups'=>$result,'message'=>'nothing'
					));
					}
					
				}
				echo json_encode(array(
						'status'=>1,'groups'=>$result,'message'=>'success'
					));
			
			}else{
				echo json_encode(array(
						'status'=>0,'groups'=>$result,'message'=>'error'
					));
			}
			
		}
		public function exitUser(){
			$str=$_GET['token'];
			session_id($str);
			session_start();
			$phone_num=$_GET['phone_num'];
			if(session('phonenum')==$phone_num){				
				echo json_encode(array('status'=>1,'username'=>$str,'phone_num'=>session('phonenum')));
				session_destroy();
				
			}else{
				echo json_encode(array('status'=>0,'username'=>$str,'phone_num'=>session('phonenum')));
				session_destroy();
			}
		}
	}
	//select user_id from lu_item where group_id='1';
	// select username,phone_num from lu_user where user_id in (select user_id from lu_item where group_id='1');
	//select group_id from lu_item where user_id='1';
	//select * from lu_group where group_id in (select group_id from lu_item where user_id='1');
?>
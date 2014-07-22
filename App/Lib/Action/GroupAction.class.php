<?php
	class GroupAction extends Action{
		public function index(){
			$model=M('Group');
			$res=$model->select();
			if($res){
				$str=array(
						'status'=>1,
						'user'=>$res
					);
				echo json_encode($str);
			}else{
				$str=array(
						'status'=>0,
						'user'=>null
					);
				echo json_encode($str);
			}
		}
	

		public function searchGroup(){
			$model=M('Group');
			$str=$_GET['key'];
			$where['groupname']=array('like',"%{$str}%");
			$res=$model->where($where)->limit(10)->select();
			if($res){
				$str=array(
						'status'=>1,
						'user'=>$res
					);
				echo json_encode($str);
			}else{
				$str=array(
						'status'=>0,
						'user'=>null
					);
				echo json_encode($str);
			}
		}
		public function createGroup(){
			$model=M('Group');
			if($model->create()){
				if($user_id=$model->add()){
					echo(json_encode(array('status'=>1)));
				}else{
					echo(json_encode(array('status'=>0)));
				}
			}else{
				echo (json_encode(array('status'=>2)));
			}
		}
	
		public function updaterUserPassword(){
			$model=M('User');
			$data['']=$_GET[''];
			$data['']=$_GET[''];
			$model->save($data);

		}
		public function updaterUserName(){

		}
		





	}

?>
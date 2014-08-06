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
		/*public function createGroup(){
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
		}*/
	
		public function updaterUserPassword(){
			$model=M('User');
			$data['']=$_GET[''];
			$data['']=$_GET[''];
			$model->save($data);

		}
		public function updaterUserName(){

		}
		public function updaterPhone(){
			$model=M('User');
			$data['phone_num']=$_GET['phone_num'];
			$condition['user_id']=$_GET['user_id'];
			if($model->where($condition)->save($data)){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}
		public function createGroup(){
			$model=M('Group');
			$item=M('Item');
			$user=M('User');
			$data['user_id']=$_GET['user_id'];
			$data['groupname']=$_GET['groupname'];
			$data['group_desc']=$_GET['group_desc'];
			$data['modify_time']=time();
			$val=$user->field('group_num')->where(array('user_id'=>$_GET['user_id']))->select();
			if($model->where(array('groupname'=>$_GET['groupname']))->select()){
				echo json_encode(array('status'=>0,'message'=>'组名重复'));
			}else{
				if($val[0]['group_num']>=1){
					if($res=$model->add($data)){
						$items['user_id']=$_GET['user_id'];
						$items['group_id']=$res;
						$item->add($items);
						$user->where(array('user_id'=>$_GET['user_id']))->save(array('group_num'=>$val[0]['group_num']-1));
						echo json_encode(array('status'=>1,'message'=>'success'));
					}else{
						echo json_encode(array('status'=>0,'message'=>$model->getError()));
					}
				}else{
					echo json_encode(array('status'=>0,'message'=>'您不能创建更多'));
				}
			}
			
			
			
		}





	}

?>
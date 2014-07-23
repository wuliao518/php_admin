<?php
	class ItemAction extends Action{
		public function index(){
			$model=D('Item');
			$group=D('Group');
			$group_id=$_POST['group_id'];
			$condition['group_id']=$_POST['group_id'];
			$condition['user_id']=$_POST['user_id'];
			$res=$model->where($condition)->select();
			if($res){
				echo json_encode(array('status'=>3));;
			}else{
				$model=M('Item');
				if($model->create()){
					if($model->add()){
						$position['group_id']=$group_id;
						$data[modify_time]=time();
						$group->where($position)->save($data);
						$message=$group->where($position)->select();
						echo json_encode(array('status'=>1,'message'=>$message));
					}else{
						echo json_encode(array('status'=>0,'message'=>null));
					}
				}else{
					echo json_encode(array('status'=>2,'message'=>null));
				}
			}
     	}
     	public function exitGroup(){
			$model=M('Item');
			$condition['group_id']=$_GET['group_id'];
			$condition['user_id']=$_GET['user_id'];
			if($model->where($condition)->delete()){
					echo(json_encode(array('status'=>1)));
			}else{
				echo (json_encode(array('status'=>0)));
			}
		}
	}
?>
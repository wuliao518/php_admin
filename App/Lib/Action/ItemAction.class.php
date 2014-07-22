<?php
	class ItemAction extends Action{
		public function index(){
			$model=D('Item');
			$condition['group_id']=$_POST['group_id'];
			$condition['user_id']=$_POST['user_id'];
			$res=$model->where($condition)->select();
			if($res){
				echo json_encode(array('status'=>3));;
			}else{
				$model=M('Item');
				if($model->create()){
					if($model->add()){		
						echo json_encode(array('status'=>1));
					}else{
						echo json_encode(array('status'=>0));
					}
				}else{
					echo json_encode(array('status'=>2));
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
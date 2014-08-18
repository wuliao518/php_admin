<?php
	class OptionAction extends Action{
    	function addOption(){
    		$model=D('Option');
    		if($model->create()){
    			if($model->add()){
    				echo json_encode(array(
    					'status'=>1
    					));
    			}else{
    				echo json_encode(array(
    					'status'=>2
    					));
    			}
    		}else{
    			echo json_encode(array(
    					'status'=>0
    					));
    		}
    	}
}
?>
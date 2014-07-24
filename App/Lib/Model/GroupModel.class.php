<?php
	class UserModel extends Model{
			
			protected $_validate=array(
			array('group_name',		'require',		'不能为空'		),
			array('group_name',		'',		'分组名重复',   0,   'unique',   1),
			
		);
			protected $_auto=array(
			array('modify_time','time',3,'function'),
		);
		
		}
	?>
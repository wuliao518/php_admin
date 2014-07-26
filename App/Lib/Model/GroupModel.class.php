<?php
	class GroupModel extends Model{
		protected $_validate=array(
			array('groupname',		'require',		'不能为空'		),
			array('groupname',		'',		'分组名重复',   0,   'unique',   1),
			
		);
		protected $_auto=array(
			array('modify_time','time',3,'function'),
		);
		
	}
?>